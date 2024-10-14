<?php
require_once "baza.php";
if($polaczenie->connect_errno==0)
{
    //Zliczanie sumy zamówienia
    $nr_stol = $_POST['nr_stol'];
    $suma = "SELECT SUM(CENA) FROM dania INNER JOIN zamówienia ON dania.ID_DANIA = zamówienia.ID_DANIA WHERE zamówienia.NR_STOLIKA = '$nr_stol'";
    if($rezultat = @$polaczenie->query($suma))
    {
        $wynik = $rezultat->fetch_assoc();
        echo $wynik['SUM(CENA)'];
        $rezultat->free_result();
    }
}
//echo '<div id="wynik" style = "width: 30px; height: 35px; float: left;"><b>888</b></div>';
$polaczenie->close();
?>