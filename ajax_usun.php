<?php
    session_start();
    require_once "baza.php";
    if($polaczenie->connect_errno==0)
    {
        $id = $_POST['id'];
        //odejmowanie ze statystyk kucharza/barmana i kelnera
        $sql_find = "SELECT ID_PRAC FROM wykonawcy WHERE ID_ZAM = '$id'";
        if($rezultat = @$polaczenie->query($sql_find))
        {
        while ($wiersz = $rezultat->fetch_assoc())
        {
            $id_prac = $wiersz['ID_PRAC'];
            $sql_stat = "UPDATE pracownicy SET  STAT = STAT - 1  WHERE ID_PRAC ='$id_prac'";
            @$polaczenie->query($sql_stat);
        }
        $rezultat->free_result();


        }

        //zmniejszanie statystyk dania
        $sql = "SELECT ID_DANIA FROM zamówienia WHERE ID_ZAM = '$id'";
        if($rezultat = @$polaczenie->query($sql))
        {
            $wiersz = $rezultat->fetch_assoc();
            $id_dania = $wiersz['ID_DANIA'];
            $sql_stat_da = "UPDATE dania SET  SPRZ_SZTUK = SPRZ_SZTUK - 1  WHERE ID_DANIA ='$id_dania'";
            @$polaczenie->query($sql_stat_da);
        }

        //usuwanie zamówienia z bazy
        $sql_usun_wyk = "DELETE FROM wykonawcy WHERE ID_ZAM = '$id'";
        $sql_usun_zam = "DELETE FROM zamówienia WHERE ID_ZAM = '$id'";
        $polaczenie->query($sql_usun_wyk);
        $polaczenie->query($sql_usun_zam);
    }

    $polaczenie->close();
?>