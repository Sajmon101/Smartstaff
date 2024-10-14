<?php
    session_start();
    require_once "baza.php";
    if($polaczenie->connect_errno==0)
    {
        //Zapisanie do bazy danych wartości checkboxa

        $id_zam = $_POST['id_zam'];
        $nr = $_POST['nr'];
        if($nr==1)
        $kel_ku = "KELNER_CHECK";
        else
        $kel_ku = "KUCHARZ_CHECK";
        
        //sprawdzenie czy checkbox jest zaznaczony czy nie
        $sql ="SELECT $kel_ku FROM zamówienia WHERE ID_ZAM = '$id_zam'";
        if($rezultat = @$polaczenie->query($sql))
        {
            $wynik = $rezultat->fetch_assoc();
            $rezultat->free_result();
            $czy_zaznaczone = $wynik[$kel_ku];
            
            if($czy_zaznaczone == NULL || $czy_zaznaczone == 0)
            $czy_zaznaczone = 1;
            else
            $czy_zaznaczone = 0;

        }

        $sql_checkbox="UPDATE zamówienia set $kel_ku = $czy_zaznaczone WHERE ID_ZAM = '$id_zam';";
        @$polaczenie->query($sql_checkbox);
    }
    $polaczenie->close();

    if($nr==2)
    $_SESSION['checkbox'] = "checkbox_ch";
?>