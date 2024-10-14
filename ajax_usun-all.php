<?php
    session_start();
    require_once "baza.php";
    $i=0;
    if($polaczenie->connect_errno==0)
    {
        $nr_stol = $_POST['nr_stol'];

        //zwiększenie przychodu firmy
        $now = date("Y-m-d");
        $sql_suma = "SELECT SUM(CENA) FROM dania INNER JOIN zamówienia ON dania.ID_DANIA = zamówienia.ID_DANIA WHERE zamówienia.NR_STOLIKA = '$nr_stol'";
        if($rezultat = @$polaczenie->query($sql_suma))
        {
            $wynik = $rezultat->fetch_assoc();
            $suma = $wynik['SUM(CENA)'];
            $rezultat->free_result();
            $sql_stat = "UPDATE stat_firmy SET  PRZYCHOD = PRZYCHOD + '$suma' WHERE MIESIAC ='$now'";
            @$polaczenie->query($sql_stat);
        }

        //usuwanie wszystkich zamówień z tego stolika
        $sql_find_id = "SELECT ID_ZAM FROM zamówienia WHERE NR_STOLIKA = '$nr_stol'";
        if($rezultat = $polaczenie->query($sql_find_id))
        {
            while ($wiersz = $rezultat->fetch_assoc()) 
            {
                $id = $wiersz['ID_ZAM'];
                $sql_usun_wyk = "DELETE FROM wykonawcy WHERE ID_ZAM = '$id'";
                $sql_usun_zam = "DELETE FROM zamówienia WHERE ID_ZAM = '$id'";
                $polaczenie->query($sql_usun_wyk);
                $polaczenie->query($sql_usun_zam);
                $i++;
            }
        }

        $rezultat->free_result();
    }

    $polaczenie->close();
?>