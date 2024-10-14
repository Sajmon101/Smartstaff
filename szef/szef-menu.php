<?php
session_start();
//zabezpieczenie żeby nie dało się po wylogowaniu strzałką cofnij wrócić na konto oraz żeby nie dało się zmianą końcówki adresu URL wejść na konto
if($_SESSION['TYP']!='szef')
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
    <link rel="stylesheet" href="style-szef.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>SmartStaff - Logowanie</title>
</head>

<body>
    <div class="container">
        <div class="panel">

            <div class="przycisk-szef-umiejscowienie"><a  class ="przycisk-szef" href="szef-nowy_prac.php"> Dodaj pracownika </a></div>
            <div class="przycisk-szef-umiejscowienie"><a  class ="przycisk-szef" href="szef-dane_prac.php"> Dane pracowników </a></div>
            <div class="przycisk-szef-umiejscowienie"><a  class ="przycisk-szef" href="szef-nowe_danie.php"> Dodaj nowe danie </a></div>
            <div class="przycisk-szef-umiejscowienie"><a  class ="przycisk-szef" href="szef-dane_dania.php"> Przeglądaj dania </a></div>

        </div>
        <a class="wyloguj" href="wyloguj.php">Wyloguj <i class="fa">&#xf08b;</i></a>
        </div>

</body>

</html>
