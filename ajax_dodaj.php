<?php
    session_start();

    require_once "baza.php";
    if($polaczenie->connect_errno==0)
    {
        //Znalezienie najwiekszego nr zamówienia w celu wstawienia nowego z nr o jeden większym
        $sql_highest="SELECT MAX(ID_ZAM) FROM zamówienia";
        if($rezultat = @$polaczenie->query($sql_highest))
        {
            $wynik = $rezultat->fetch_assoc();
            $rezultat->free_result();
            $highest = $wynik['MAX(ID_ZAM)'];
            $highest++;
        }

        //Wkładanie zamówienia do tablicy "zamówienia" oraz "wykonawcy" używając odczytanych danych podczas logowania, w zależności od klikniętego stolika i dania
        $nr_dania = $_POST['nr'];
        $log = $_SESSION['ID_PRAC'];
        $nr_stolika = $_SESSION['nr_stolika'];

        $sql_in = "INSERT INTO zamówienia VALUES('$highest','$nr_stolika','$nr_dania',NULL,NULL,NULL)";
        @$polaczenie->query($sql_in);
        $sql_in2 = "INSERT INTO wykonawcy(ID_PRAC, ID_ZAM) VALUES('$log','$highest')";
        @$polaczenie->query($sql_in2);

        //wyciąganie danych z konkretnego dania w zależności od przyciśniętego przycisku
        $sql = "SELECT * FROM dania WHERE ID_DANIA ='$nr_dania'";
        if($rezultat = @$polaczenie->query($sql))
        {
            $ile_user = $rezultat ->num_rows; /*funkcja ta zwraca ile rekordów znalazło zapytanie */
            if($ile_user>0)
            {
                $wiersz = $rezultat->fetch_assoc();
                $rezultat->free_result();
                //to co jest w echo jest zwracane do animacja.js jako result
                echo '<div id="z'.$highest.'"class = "wiersz"><div class="nr">'.$highest.'</div><div class = "nazwa">'.$wiersz['NAZWA'].'</div><div class = "cena">'.$wiersz['CENA'].'</div><div class = "ch_ku"><input type="checkbox" onclick="checkbox('.$highest.',2)" class = "checkbox" id="ch_ku'.$highest.'" disabled></div><div class = "ch_kel"><input type="checkbox" onclick="checkbox('.$highest.',1)" class = "checkbox" id="ch_kel'.$highest.'"></div><div class = "usun"><input class  = "usun_but" onclick = usun('.$highest.','.$nr_stolika.') type = "button" value = "usuń"></div></div>';
                echo '<div style="clear:both"></div>';
            }
        }
    }

        //wyszukanie ID pracowników których dotyczy zamówienie zamówienia do konkretnego kucharza/barmana
        $typ_dania = $wiersz['TYP'];
        if($typ_dania=="danie_glowne")
        {
            $sql_set = "SELECT ID_PRAC from pracownicy WHERE TYP = 'kucharz'";
        }
        elseif($typ_dania=="napoj" || $typ_dania=="deser")
        {
            $sql_set ="SELECT ID_PRAC from pracownicy WHERE TYP = 'barman'";
        }
        if($rezultat = @$polaczenie->query($sql_set))
        {
            $l=0;
            while ($wiersz2 = $rezultat->fetch_assoc()) 
            {
                $nr[$l] = $wiersz2['ID_PRAC'];
                $l++;
            }
        }
        //znalezienie ilości zamówień, które obecny kucharz/barman ma do zrealizowania
            for($h=0;$h<$l;$h++)
            {
                $sql_count = "SELECT COUNT(ID) FROM wykonawcy WHERE ID_PRAC='$nr[$h]'";
                if($rezultat = @$polaczenie->query($sql_count))
                {
                    $wiersz2 = $rezultat->fetch_assoc();
                    $ile_zam[$h] = $wiersz2['COUNT(ID)'];
                }
            }
        //znalezenie jaka liczba bieżących zamówień u pracowników to najmniejsza
        $ile_to_najmniej = min($ile_zam);
       
        //szukanie indeksu tablicy, w której ta minimalna wartość jest
        $j = 0;
        for($h=0;$h<$l;$h++)
        {
            if($ile_zam[$h]==$ile_to_najmniej)
            {
                $id_do_losowania[$j] = $nr[$h]; 
                $j++;
            }
        }

        //jeżeli jedna osoba ma najmniejszą liczbę bieżących zamówień to ona otrzymuje zamówienie a jeśli jest więcej osób z taką samą liczbą to wykonawca jest losowany
        $tt = count($id_do_losowania);
        if($tt>1)
        {
        $idx = array_rand($id_do_losowania, 1);
        $wybrany = $id_do_losowania[$idx];
        }
        else
        $wybrany = $id_do_losowania[0];

        //przypisanie zamówienia do wybranego kucharza/barmana
        $sql_in3 = "INSERT INTO wykonawcy(ID_PRAC, ID_ZAM) VALUES('$wybrany','$highest')";
        @$polaczenie->query($sql_in3);

        //zwiększenie statystyk kucharza o 1
        $sql_ku_stat = "UPDATE pracownicy SET  STAT = STAT + 1  WHERE ID_PRAC ='$wybrany'";
        @$polaczenie->query($sql_ku_stat);

        //zwiększenie statystyk kelnera o 1
        $id = $_SESSION['ID_PRAC'];
        $sql_stat = "UPDATE pracownicy SET  STAT = STAT + 1  WHERE ID_PRAC ='$id'";
        @$polaczenie->query($sql_stat);

        //zwiększenie statystyk dania o 1
        $sql_da_stat = "UPDATE dania SET  SPRZ_SZTUK = SPRZ_SZTUK + 1  WHERE ID_DANIA ='$nr_dania'";
        @$polaczenie->query($sql_da_stat);

    $polaczenie->close();
?>