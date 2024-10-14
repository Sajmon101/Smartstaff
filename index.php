<!-- DO ZALOGOWANIA: HASŁO JEST TAKIE SAMO JAK LOGIN-->
<?php
//jeśli ktoś jest już zalogowany to go odrazu przerzuci na jego konto i nie wyświetli się panel logowania
session_start();

if(isset($_SESSION['LOGIN']))
{
    if($_SESSION['TYP']=='kelner')
    {
        header('Location: kelner.php');
    }

    if($_SESSION['TYP']=='kucharz' || ($_SESSION['TYP']=='barman'))
    {
        header('Location: kucharz.php');
    }

    if($_SESSION['TYP']=='szef')
    {
        header('Location: szef\szef-menu.php');
    }
}

//zapisywanie do archiwum statystyk pracowników oraz firmy z poprzedniego miesiąca i usuwanie danych w celu zliczania statystyk z aktualnego, nowego miesiąca
require_once "baza.php";
if($polaczenie->connect_errno==0)
{
    $d = "SELECT MIESIAC FROM stat_firmy WHERE LP=1";  //tu przechowywany jest obecny miesiąc i obecny przychód bieżący z tego miesiąca
    if($rezultat = $polaczenie->query($d))
    {
        $wiersz = $rezultat->fetch_assoc();

        $g = $wiersz['MIESIAC'];
        $rezultat->free_result();

        $month = date("y-m",strtotime($g)); //wyciąga z daty tylko miesiąc i rok

        //sprawdzanie czy zaczął się nowy miesiąc
        $now = date("y-m");

        if($month<$now)
        {
            //przepisywanie dla każdego pracownika statystyk
            $sql_find_id = "SELECT ID_PRAC, STAT FROM pracownicy";
            if($rezultat = $polaczenie->query($sql_find_id))
            {
                //dla każdego znalezionego id pracownika przepisujemy statystyki do archiwum
                while ($wynik = $rezultat->fetch_assoc()) 
                {
                    $id = $wynik['ID_PRAC'];
                    $current_stat = $wynik['STAT'];

                    $arch_stat = "INSERT INTO stat_prac_arch (ID_PRAC, MIESIAC, STAT) VALUES('$id','$g','$current_stat')";
                    $polaczenie->query($arch_stat);
                }

                //zmiana bieżących statystyk pracowników na 0
                $update = "UPDATE pracownicy SET STAT = 0";
                $polaczenie->query($update);


            //przepisywanie dla każdego dania statystyk
            $sql_find_id = "SELECT ID_DANIA, SPRZ_SZTUK FROM dania";
            if($rezultat = $polaczenie->query($sql_find_id))
            {
                //dla każdego znalezionego id dania przepisujemy statystyki do archiwum
                while ($wynik = $rezultat->fetch_assoc()) 
                {
                    $id = $wynik['ID_DANIA'];
                    $current_stat = $wynik['SPRZ_SZTUK'];

                    $arch_stat = "INSERT INTO stat_dania_arch (ID_DANIA, MIESIAC, STAT) VALUES('$id','$g','$current_stat')";
                    $polaczenie->query($arch_stat);
                }

                //zmiana bieżących statystyk dań na 0
                $update = "UPDATE dania SET SPRZ_SZTUK = 0";
                $polaczenie->query($update);
            }


                //przepisanie bieżących zarobków do archiwum
                $stat_firmy = "INSERT INTO stat_firmy (MIESIAC,PRZYCHOD) SELECT '$g', PRZYCHOD FROM stat_firmy WHERE LP=1";
                $polaczenie->query($stat_firmy);

                //zmiana biężącej statystyki zarobków firmy na 0 oraz ustawianie miesiąca w tym wierszu na nowy ten który się właśnie zaczął (bieżące statystyki są przechowywane w pierwszym wierszu tabeli stat_firmy)
                $now_full = date("Y-m-d");
                $update = "UPDATE stat_firmy SET PRZYCHOD = 0, MIESIAC = '$now_full' WHERE LP=1";
                $polaczenie->query($update);
            }
        }
    }
}
$polaczenie->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web application that support organisation of a restaurant"/>
    <link rel="stylesheet" href="style1.css" type="text/css" />
    <title>SmartStaff - Logowanie</title>
</head>
<body>
    
    <div id="container">
        <div id="logo">
            SmartStaff
            <img src="zdj\logo2.png" width="90px" height="45px"/>          
        </div>

        <form action="db_zaloguj.php" method="post">
            <div class="panel">
                <br>
                    <label class="napis" for="Login">Login</label>
                    <br><br>
                    <input id="Login" type="text" name="login">
                    <br><br>
                    <label class="napis" for="Hasło">Hasło</label>
                    <br><br>
                    <input id="Hasło" type="password" name="haslo">
                    <?php
                        if(isset($_SESSION['error'])) echo "<div class=error>".$_SESSION['error']."</div>";
                        unset($_SESSION['error']);
                    ?>
                    <input class="przycisk-zaloguj" type="submit" value="Zaloguj">

            </div>
        </form>
    </div>


</body>
</html>
