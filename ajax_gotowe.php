<?php
    session_start();
    require_once "baza.php";
    if($polaczenie->connect_errno==0)
    {
        $id_zam = $_POST['id_zam'];
        $id_prac = $_POST['id_prac'];
        $sql_usun_wyk = "DELETE FROM wykonawcy WHERE ID_ZAM = '$id_zam' && ID_PRAC = '$id_prac'";
        $sql_change_check = "UPDATE zamówienia SET KUCHARZ_CHECK = 1 WHERE ID_ZAM = '$id_zam'";
        $polaczenie->query($sql_usun_wyk);
        $polaczenie->query($sql_change_check);
    }
    $polaczenie->close();
?>