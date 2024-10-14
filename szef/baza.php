<?php
$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "smartstaff";
$polaczenie = @new mysqli($host, $db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error:" .$polaczenie->connect_errno."Opis:". $polaczenie->connect_error;
}
?>