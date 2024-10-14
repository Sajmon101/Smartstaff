<?php
    session_start();
    //zabezpieczenie żeby nie dało się po wylogowaniu strzałką cofnij wrócić na konto oraz żeby nie dało się zmianą końcówki adresu URL wejść na konto
    if($_SESSION['TYP']=='kucharz' || $_SESSION['TYP']=='barman')
    {}
    else
    {
        header('Location:http://localhost/Smartstaff/index.php');
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="30">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web application that support organisation of a restaurant"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style1.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Kucharz</title>
</head>
<body>
    <div class="wyrownanie" style="align-items: flex-start;">
        <div class = "panel">
            <div class = "wiersz" style="background-color: rgb(244, 206, 156) ;"><div class="nr"><b>Nr</b></div><div class = "nazwa"><b>Nazwa dania</b></div><div class = "cena"><b>Cena</b></div><div class = "ch_ku" style="font-size:12px; text-align:center; margin-top: 0px; margin-left: 70px;"><b>Danie gotowe</b></div></div>
            
            <?php
            require_once "baza.php";
            if($polaczenie->connect_errno==0)
            {
                //Odczytywanie z bazy danych zamówień, które już są złożone dla tego stolika przez tego kelnera, który jest zalogowany

                $id_prac = $_SESSION['ID_PRAC'];
                $sql_zam = "SELECT wykonawcy.ID_ZAM, NAZWA, CENA, KELNER_CHECK, KUCHARZ_CHECK FROM zamówienia INNER JOIN dania ON zamówienia.ID_DANIA = dania.ID_DANIA INNER JOIN wykonawcy ON zamówienia.ID_ZAM = wykonawcy.ID_ZAM WHERE ID_PRAC = '$id_prac'";
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

                        echo '<div id="z'.$id[$k].'"class = "wiersz"><div class="nr">'.$id[$k].'</div><div class = "nazwa">'.$nazwa[$k].'</div><div class = "cena">'.$cena[$k].'</div><div class = "usun"><input onclick = "gotowe('.$id[$k].','.$id_prac.')" style="margin-left: 140px;" class  = "usun_but" type = "button" value = "Gotowe"></div></div>';
                        echo '<div style="clear:both"></div>';
                        $k++;
                    }
                }

                $rezultat->free_result();
                $polaczenie->close();
            }
        ?>

        </div>

        <div class="login-wyloguj-ku">
            <?php
            $login = $_SESSION['LOGIN'];
            echo $login;
            ?>
            <a class="wyloguj" href="wyloguj.php"><br>Wyloguj <i class="fa">&#xf08b;</i></a>
        </div>
    </div>

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="animacja.js"></script>

</body>
</html>