<?php
session_start();
//zabezpieczenie żeby nie dało się po wylogowaniu strzałką cofnij wrócić na konto oraz żeby nie dało się zmianą końcówki adresu URL wejść na konto
if($_SESSION['TYP']!='kelner')
{
    header('Location:http://localhost/Smartstaff/index.php');
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web application that support organisation of a restaurant"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style1.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" type="text/css" />
    <title>Kelner - zamowienie</title>
</head>
<body>
<div id="all">
    <div class="panel_kel">
        <div class = "wiersz" style="background-color: rgb(244, 206, 156) ;"><div class="nr"><b>Nr</b></div><div class = "nazwa"><b>Nazwa dania</b></div><div class = "cena"><b>Cena</b></div><div class = "ch_ku" style="font-size:12px; text-align:center; margin-top: 0px;"><b>Danie gotowe</b></div><div class = "ch_kel" style="font-size:12px; text-align:center; margin-top: 0px;"><b>Danie zaniesione</b></div><div class = "usun" style="margin-top: 0px;"></div></div>

        <?php
            require_once "baza.php";
            if($polaczenie->connect_errno==0)
            {
                //Odczytywanie z bazy danych zamówień, które już są złożone dla tego stolika przez tego kelnera, który jest zalogowany
                $nr_stol = $_SESSION['nr_stolika'];
                $id_prac = $_SESSION['ID_PRAC'];
                $sql_zam = "SELECT wykonawcy.ID_ZAM, NAZWA, CENA, KELNER_CHECK, KUCHARZ_CHECK FROM zamówienia INNER JOIN dania ON zamówienia.ID_DANIA = dania.ID_DANIA INNER JOIN wykonawcy ON zamówienia.ID_ZAM = wykonawcy.ID_ZAM WHERE NR_STOLIKA = '$nr_stol' AND ID_PRAC = '$id_prac'";
                if($rezultat = @$polaczenie->query($sql_zam))
                {
                    $k = 0;
                    while ($wyn = $rezultat->fetch_assoc()) 
                    {
                        $id[$k] = $wyn['ID_ZAM'];
                        $nazwa[$k] = $wyn['NAZWA'];
                        $cena[$k] = $wyn['CENA'];
                        $kelner_check[$k] = $wyn['KELNER_CHECK'];
                        $kucharz_check[$k] = $wyn['KUCHARZ_CHECK'];
                        //warunki czy checkboxy są automatycznie zaznaczone czy nie
                        if($kelner_check[$k]==1)
                        $checked_kel = "checked";
                        else
                        $checked_kel = "";

                        if($kucharz_check[$k]==1 ||  $kelner_check[$k]==1)
                        $checked_ku = "checked";
                        else
                        $checked_ku = "";

                        echo '<div id="z'.$id[$k].'"class = "wiersz"><div class="nr">'.$id[$k].'</div><div class = "nazwa">'.$nazwa[$k].'</div><div class = "cena">'.$cena[$k].'</div><div class = "ch_ku"><input type="checkbox" onclick="checkbox('.$id[$k].',2)" class = "checkbox-trans" id="ch_ku'.$id[$k].'"'.$checked_ku.' disabled></div><div class = "ch_kel"><input type="checkbox" onclick="checkbox('.$id[$k].',1)" class = "checkbox-trans" id="ch_kel'.$id[$k].'"'.$checked_kel.'></div><div class = "usun"><input class  = "usun_but" onclick = "usun('.$id[$k].','.$nr_stol.')" type = "button" value = "usuń"></div></div>';
                        echo '<div style="clear:both"></div>';
                        $k++;
                    }
                }

                $rezultat->free_result();
        ?>
                <div id="cegly"></div>
                <hr>
                <script>
                window.onload = function() {
                razem(<?php echo $nr_stol ?>);
                };
                </script>
        <?php
            //Odczytywanie z bazy danych zamówień, które już są złożone dla tego stolika przez INNYCH kelnerów niż ten zalogowany
            $nr_stol = $_SESSION['nr_stolika'];
            $id_prac = $_SESSION['ID_PRAC'];
            $sql_zam2 = "SELECT wykonawcy.ID_ZAM, NAZWA, CENA, KELNER_CHECK, KUCHARZ_CHECK FROM zamówienia INNER JOIN dania ON zamówienia.ID_DANIA = dania.ID_DANIA INNER JOIN wykonawcy ON zamówienia.ID_ZAM = wykonawcy.ID_ZAM INNER JOIN pracownicy ON wykonawcy.ID_PRAC = pracownicy.ID_PRAC WHERE NR_STOLIKA = '$nr_stol' AND pracownicy.TYP = 'kelner' AND NOT(wykonawcy.ID_PRAC = '$id_prac')";
            if($rezultat = @$polaczenie->query($sql_zam2))
            {
                $j = 0;
                while ($wyn2 = $rezultat->fetch_assoc()) 
                {
                    $id[$j] = $wyn2['ID_ZAM'];
                    $nazwa[$j] = $wyn2['NAZWA'];
                    $cena[$j] = $wyn2['CENA'];
                    $kelner_check[$j] = $wyn2['KELNER_CHECK'];
                    $kucharz_check[$j] = $wyn2['KUCHARZ_CHECK'];
                    //warunki czy checkboxy są automatycznie zaznaczone czy nie
                    if($kelner_check[$j]==1)
                    $checked_kel = "checked";
                    else
                    $checked_kel = "";

                    if($kucharz_check[$j]==1 || $kelner_check[$j]==1)
                    $checked_ku = "checked";
                    else
                    $checked_ku = "";

                    echo '<div id="z'.$id[$j].'"class = "wiersz-trans"><div class="nr">'.$id[$j].'</div><div class = "nazwa">'.$nazwa[$j].'</div><div class = "cena">'.$cena[$j].'</div><div class = "ch_ku"><input type="checkbox" onclick="checkbox('.$id[$j].',2)" class = "checkbox-trans" id="ch_ku'.$id[$j].'"'.$checked_ku.' disabled></div><div class = "ch_kel"><input type="checkbox" onclick="checkbox('.$id[$j].',1)" class = "checkbox-trans" id="ch_kel'.$id[$j].'"'.$checked_kel.'></div><div class = "usun"><input class  = "usun_but" onclick = "usun('.$id[$j].','.$nr_stol.')" type = "button" value = "usuń"></div></div>';
                    echo '<div style="clear: both;"></div>';

                    $j++;
                }
            }

            $rezultat->free_result();
            $polaczenie->close();
        }
        ?>
    </div>

    <div class="panel_kel">
        <div class="wyrownanie">
            <div class = "przycisk-wybor" style="margin-left: 0px;" onclick = 'kafelki("danie_glowne")'>Dania główne</div>
            <div class = "przycisk-wybor" onclick = 'kafelki("napoj")'>Napoje</div>
            <div class = "przycisk-wybor" onclick = 'kafelki("deser")'>Desery</div>
        </div>
        <div style="clear: both;"></div>
        <hr>
        <div id = "kafelki"></div>
    </div>

    <div style="clear: both;"></div>
    <div id="razem">
        <div style = "width : 560px; float: left;"><b>Razem</b></div>
        <?php
        echo '<div id="wynik" style = "width: 30px; float: left;"><b>0,00</b></div>';
        ?>
    </div>
    <a class="przycisk-powrot" href="kelner.php">&#8592 Powrót</a>
    <div id="rachunek" onclick="rachunek()">
        Rachunek
    </div>
</div>

<div class="poup">

    <div id="krzyzyk"><i onclick="close_rachunek()" class="fas fa-times-circle"></i></div>

    <div id="poup_wynik" class="wyrownanie">
        Razem:
        <div id="suma" class="wyrownanie">
        </div>
    </div>

    <div onclick='final_rachunek("<?php echo $nr_stol ?>")' class="przycisk-wybor" style="margin-left:0px; cursor:pointer">
    Zapłacono
    </div>
</div>

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="animacja.js"></script>

</body>
</html>