<?php
session_start();
//zabezpieczenie żeby nie dało się po wylogowaniu strzałką cofnij wrócić na konto oraz żeby nie dało się zmianą końcówki adresu URL wejść na konto
if($_SESSION['TYP']!='szef')
{
    header('Location:http://localhost/Smartstaff/index.php');
}
//

unset($_SESSION['f_Nazwa']);
unset($_SESSION['f_Typ']);
unset($_SESSION['f_Cena']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web application that support organisation of a restaurant"/>
    <link rel="stylesheet" href="style-szef.css" type="text/css" />
    <title>Szef - Dodano danie</title>
</head>
<body>
    <div class="container">

        <div style="width:550px; height:130px; font-size: 27px;" class="panel">Dodano nowe danie!<br>
            <div style="float:left;" class="przycisk-szef-umiejscowienie"><a  class ="przycisk-szef" href="szef-menu.php"> Powrót do menu </a></div>
            <div class="przycisk-szef-umiejscowienie"><a  class ="przycisk-szef" href="szef-nowe_danie.php"> Dodaj kolejne danie </a></div>
            <div style="clear:both;"></div>
        </div>

    </div>
</body>
</html>