<?php
session_start();
//zabezpieczenie żeby nie dało się po wylogowaniu strzałką cofnij wrócić na konto oraz żeby nie dało się zmianą końcówki adresu URL wejść na konto
if($_SESSION['TYP']!='szef')
{
    header('Location:http://localhost/Smartstaff/index.php');
}
//

if(isset($_POST['nazwisko']))
{
    if($_POST['nazwisko']!=NULL)
    {
        require 'baza.php';
        if($polaczenie->connect_errno==0)
        {
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            //szukamy pracownika w bazie (sprawdzamy czy zostało wpisane imię bo umożliwiłem również wyszukiwanie samym nazwiskiem)
            if($_POST['imie']==NULL)
            {
                $sql_find_worker="SELECT * FROM pracownicy INNER JOIN logowanie ON pracownicy.ID_PRAC=logowanie.ID_PRAC WHERE pracownicy.NAZWISKO='$nazwisko'";
            }
            else
            {
                $sql_find_worker="SELECT * FROM pracownicy INNER JOIN logowanie ON pracownicy.ID_PRAC=logowanie.ID_PRAC WHERE pracownicy.IMIE='$imie' && pracownicy.NAZWISKO='$nazwisko'";
            }

            if($rezultat_sql_find_worker = @$polaczenie->query($sql_find_worker))
            {
                if($rezultat_sql_find_worker ->num_rows==1)
                {
                    $dane = $rezultat_sql_find_worker->fetch_assoc();

                    $_SESSION['id'] = $dane['ID_PRAC'];
                    $id = $dane['ID_PRAC'];
                    $_SESSION['data_zatr'] = $dane['DATA_ZATR'];
                    $_SESSION['pesel'] = $dane['PESEL'];
                    $_SESSION['typ'] = $dane['TYP'];
                    $_SESSION['pensja'] = $dane['PENSJA'];
                    $_SESSION['stat'] = $dane['STAT'];
                    $_SESSION['zdj'] = $dane['zdj'];
                    $_SESSION['login'] = $dane['LOGIN'];
                    $_SESSION['imie'] = $dane['IMIE'];
                    $_SESSION['nazwisko'] = $dane['NAZWISKO'];

                    //odczytywanie archiwalnych statystyk pracowników
                    $sql_arch_stat = "SELECT MIESIAC, STAT FROM stat_prac_arch WHERE ID_PRAC = '$id' ORDER BY MIESIAC DESC";

                    if($rezultat_arch_stat = @$polaczenie->query($sql_arch_stat))
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

                elseif($rezultat_sql_find_worker ->num_rows>1)
                {
                    $_SESSION['error'] = "Istnieje więcej niż jeden pracownik o tym nazwisku. Wprowadź imię";
                }
                elseif($rezultat_sql_find_worker ->num_rows==0)
                {
                    $_SESSION['error'] = "Nie znaleniono pracownika z tymi danymi";
                }
                    
                
            }

            $polaczenie->close();
        }   
    }   

    else
    {
        $_SESSION['error'] = "Pole nazwisko nie może być puste";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web application that support organisation of a restaurant"/>
    <link rel="stylesheet" href="style-szef.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Szef - Dane pracowników</title>
</head>
<body>
    <a class="przycisk-powrot-2" href="szef-menu.php">&#8592</a>
    <div>
        <div style="width:400px;" class="panel">
            <form method="post">
                <div style="font-size: 20px;"> Wyszukaj pracownika </div> <br><br>
                <input class="pole-text" style="float:left; width:20%; margin-left:15px; margin-right:15px;" type="text" placeholder="Imię" name="imie">
                <input class="pole-text" style="float:left; width:20%; margin-left:15px; margin-right:15px;" type="text" placeholder="Nazwisko" name="nazwisko">
                <div class="przycisk" style="float:left; margin-left:15px; margin-right:-150px; margin-top:4px; padding:7px;"><i class="fa fa-search"></i><input style="border:none; background:none; font-family: Andale Mono, monospace; font-size: 15px;" type="submit" value= 'Szukaj'></input></div>
                <div style="clear:both;"></div>
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
        if(isset($_SESSION['pesel']))
        {
        ?>

        <div class="dane">
        <?php
            $zdj = $_SESSION['zdj'];
            echo '<center><img src="'.$zdj.'"/></center><br><br><b>ID pracownika: </b>'.$_SESSION['id']."<br><br><b>Imię: </b>".$_SESSION['imie']."<br><br><b>Nazwisko: </b>".$_SESSION['nazwisko']."<br><br><b>Pesel: </b>".$_SESSION['pesel']."<br><br><b>Data zatrudnienia: </b>".$_SESSION['data_zatr']."<br><br><b>Typ pracownika: </b>".$_SESSION['typ']."<br><br><b>Pensja: </b>".$_SESSION['pensja']."<br><br><b>Login: </b>".$_SESSION['login']."<br><br><b>Ilość zrealizowanych zamówień w bieżącym miesiącu: </b>".$_SESSION['stat'];
        ?>
        </div>

        <div class = "arch">

            <div class="header">
            Ilość zrealizowanych zamówień pracownika </br> Dane archiwalne
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
        unset($_SESSION['data_zatr']);
        unset($_SESSION['pesel']);
        unset($_SESSION['typ']);
        unset($_SESSION['pensja']);
        unset($_SESSION['stat']);
        unset($_SESSION['zdj']);
        unset($_SESSION['login']);
        unset($_SESSION['imie']);
        unset($_SESSION['nazwisko']);
        $i=1;
        while(isset($_SESSION['miesiac'.$i]))
        {
            unset($_SESSION['miesiac'.$i]);
            unset($_SESSION['stat'.$i]);
            $i++;
        }
        ?>
    </div>
    
</body>
</html>