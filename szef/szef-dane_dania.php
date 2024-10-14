<?php
session_start();
//zabezpieczenie żeby nie dało się po wylogowaniu strzałką cofnij wrócić na konto oraz żeby nie dało się zmianą końcówki adresu URL wejść na konto
if($_SESSION['TYP']!='szef')
{
    header('Location:http://localhost/Smartstaff/index.php');
}
//

if(isset($_POST['nazwa']))
{
    if($_POST['nazwa']!=NULL)
    {
        require 'baza.php';
        if($polaczenie->connect_errno==0)
        {
            $nazwa = $_POST['nazwa'];

                $sql_find_dish = "SELECT * FROM dania WHERE nazwa='$nazwa'";

            if($rezultat_sql_find_dish = @$polaczenie->query($sql_find_dish))
            {
                if($rezultat_sql_find_dish ->num_rows==1)
                {
                    $dane = $rezultat_sql_find_dish->fetch_assoc();

                    $_SESSION['id'] = $dane['ID_DANIA'];
                    $id = $dane['ID_DANIA'];
                    $_SESSION['nazwa'] = $dane['NAZWA'];
                    $_SESSION['cena'] = $dane['CENA'];
                    $_SESSION['typ'] = $dane['TYP'];
                    $_SESSION['sprz_sztuk'] = $dane['SPRZ_SZTUK'];
                    $_SESSION['zdj'] = $dane['ZDJ'];


                    //odczytywanie archiwalnych statystyk pracowników
                    $sql_dania_stat = "SELECT MIESIAC, STAT FROM stat_dania_arch WHERE ID_DANIA = '$id' ORDER BY MIESIAC DESC";

                    if($rezultat_arch_stat = @$polaczenie->query($sql_dania_stat))
                    {
                        $i = 1;
                        while(($dane1 = $rezultat_arch_stat->fetch_assoc()) && $i<=12)
                        {
                            $_SESSION['miesiac'.$i] = $dane1['MIESIAC'];
                            $_SESSION['stat'.$i] = $dane1['STAT'];
                            $i++;
                        }
                    }
                }

                elseif($rezultat_sql_find_dish ->num_rows==0)
                {
                    $_SESSION['error'] = "Nie znaleniono dania o takiej nazwie";
                }   
            }
            
            $polaczenie->close();
        }   
    }   

    else
    {
        $_SESSION['error'] = "Pole nazwa nie może być puste";
    }
}
?>



<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web application that support organisation of a restaurant"/>
    <link rel="stylesheet" href="style-szef.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Szef - Przeglądaj dania</title>
</head>
<body>
    <a class="przycisk-powrot-2" href="szef-menu.php">&#8592</a>
    <div>
        <div style="width:400px;" class="panel">
            <form method="post">
                <div style="font-size: 20px;"> Wyszukaj danie </div> <br><br>
                <div style="margin-left:30px;">
                    <input class="pole-text" style="float:left; width:45%; margin-left:15px; margin-right:15px;" type="text" placeholder="Nazwa dania" name="nazwa">
                    <div class="przycisk" style="float:left; margin-left:15px; margin-right:-150px; margin-top:4px; padding:7px;"><i class="fa fa-search"></i><input style="border:none; background:none; font-family: Andale Mono, monospace; font-size: 15px;" type="submit" value= 'Szukaj'></input></div>
                    <div style="clear:both;"></div>
                </div>
                <?php
                    if(isset($_SESSION['error']))
                    {
                        echo '<br><div class = "error">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                ?>
            </form>
        </div>

        <?php
        if(isset($_SESSION['id']))
        {
        ?>

        <div class="dane" style="height: 210px;">
            <?php
            //w bazie danych nie ma polskich znaków więc żeby na ekranie zamiast danie_glowne wyświetlało się danie główne to jest ten if
            if($_SESSION['typ']=="danie_glowne")
            {
                $typ = "danie główne";
            }
            else
            {
                $typ = $_SESSION['typ'];
            }
                $zdj = $_SESSION['zdj'];

                //wyświetlanie wyniku
                echo '<div style="font-size:23px; text-align:center;"><b>'.$_SESSION['nazwa'].'</b></div><br><br><div style="float:left; width:164px; height:160px; display: flex; justify-content: center; align-items: center; margin-top:-6px; margin-left:-6px;"><img src="'.$zdj.'"></div><div style="float:left; margin-left:29px";>ID dania: '.$_SESSION['id'].'<br><br>Typ dania: '.$typ.'<br><br>Cena: '.$_SESSION['cena'].'<br><br>Ilość sprzedanych <br> sztuk w tym miesiącu: '.$_SESSION['sprz_sztuk'].'</div>';
            ?>
        </div>

        <div class = "arch">

            <div class="header">
            Ilość sprzedanych sztuk </br> Dane archiwalne
            </div>

            <div style="padding-top:4px; padding-bottom:4px;">
                <?php
                    $i = 1;
                    while(isset($_SESSION['miesiac'.$i]) && $i<13)
                    {
                        if($i>1)
                        {echo '<hr style="background-color: antiquewhite;">';}
                        $miesiac = substr($_SESSION['miesiac'.$i], 0, 7);
                        echo '<div class="wiersz"><div class = komorka>'.$_SESSION['stat'.$i].'</div><div class="komorka">'.$miesiac.'</div></div>';
                        echo '<div style = "clear:both"></div>';
                        $i++;
                    }
                ?>
            </div>
        </div>

        <?php
        }
        unset($_SESSION['id']);
        unset($_SESSION['nazwa']);
        unset($_SESSION['cena']);
        unset($_SESSION['typ']);
        unset($_SESSION['sprz_sztuk']);
        unset($_SESSION['zdj']);
        ?>
    </div>
    
</body>
</html>