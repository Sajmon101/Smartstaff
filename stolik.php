<?php

ob_start();
$jaki_stolik = $_SESSION['jaki_stolik'];
$id_prac = $_SESSION['ID_PRAC'];


$sql_status_stolika = "SELECT * FROM zamówienia INNER JOIN wykonawcy ON zamówienia.ID_ZAM = wykonawcy.ID_ZAM WHERE NR_STOLIKA = '$jaki_stolik' && ID_PRAC = '$id_prac'";
if($rezultat = @$polaczenie->query($sql_status_stolika))
{
    $stolik = $rezultat ->num_rows; /*funkcja ta zwraca ile rekordów znalazło zapytanie */
    if($stolik>0)
    {
        $table_color = '#6bbaff';
    }

    else
    {
        $table_color= '#1a485d';
    }
}

if (@$_GET['action'] == $jaki_stolik) 
{
    $_SESSION['nr_stolika'] = $jaki_stolik;
    header('Location: kelner_zam.php');
} 

$flag = 0;
while($wynik = $rezultat->fetch_assoc())
{
    if($wynik['KUCHARZ_CHECK']==1 && $wynik['KELNER_CHECK']==0)
    {
        $flag = 1;
    }
}

if($flag == 1)
$kolko = '<div class = "czerwone_kolko"></div>';
else
$kolko = '';
$rezultat->free_result();
ob_flush();
?>

<div class = "ramka_table">
    <input class = "table" onclick="window.location=document.location.href+'?action=<?php echo $jaki_stolik ?>'" type="button" value="<?php echo $jaki_stolik ?>" style="background-color: <?php echo $table_color ?>">
    <?php
        echo $kolko;
    ?>
</div>
