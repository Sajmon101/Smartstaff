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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style1.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Kelner - menu</title>
</head>

<body>
    <?php $login = $_SESSION['LOGIN'];?>
    
    <div id="sala">

        <div style="position: absolute; margin-left: 670px; margin-top: 70px;"><img src="zdj/pulpit.png" width="30px" height="30px"></div>
        <div id="bar">
            <div style="margin-left: 90px; margin-top: 15px;"><img src="zdj/shaker.png" width="40px" height="40px"></div>
        </div>

        <div class="login-wyloguj">
            <?php echo $login?>
            <a class="wyloguj" href="wyloguj.php"><br>Wyloguj <i class="fa">&#xf08b;</i></a>
        </div>

        <div style="clear: both;"></div>

        <div id="jadalnia">
           
            <?php
            require_once "baza.php";

            if($polaczenie->connect_errno==0)
            {

            
            $_SESSION['jaki_stolik'] = 1;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 2;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>
            
            <?php
            $_SESSION['jaki_stolik'] = 3;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 4;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 5;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 6;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>
            
            <?php
            $_SESSION['jaki_stolik'] = 7;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 8;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 9;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 10;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 11;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 12;
            require "stolik.php";
            ?>
            
            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 13;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 14;
            require "stolik.php";
            ?>

            <div style="clear:both"></div>

            <?php
            $_SESSION['jaki_stolik'] = 15;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 16;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>
            
            <?php
            $_SESSION['jaki_stolik'] = 17;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 18;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 19;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 20;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>
            
            <?php
            $_SESSION['jaki_stolik'] = 21;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 22;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 23;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 24;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 25;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 26;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 27;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 28;
            require "stolik.php";
            ?>

            <div style="clear:both"></div>

            <?php
            $_SESSION['jaki_stolik'] = 29;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 30;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>
            
            <?php
            $_SESSION['jaki_stolik'] = 31;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 32;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 33;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 34;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>
            
            <?php
            $_SESSION['jaki_stolik'] = 35;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 36;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 37;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 38;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 39;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 40;
            require "stolik.php";
            ?>

            <div class="doniczka"><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/><br><img src="zdj\krzak1.png" width="20px" height="21px"/></div>

            <?php
            $_SESSION['jaki_stolik'] = 41;
            require "stolik.php";
            ?>

            <?php
            $_SESSION['jaki_stolik'] = 42;
            require "stolik.php";
            ?>
            
            

            <?php
            }
            $polaczenie->close();
            ?>
        </div>

    </div>

</body>

</html>