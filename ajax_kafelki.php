<?php
session_start();

require_once "baza.php";
if($polaczenie->connect_errno==0)
{
    //zapytanie w celu uzyskania indeksów dań w postaci tablicy $numer. $i przechowuje ile elementów ma tablica. !Jest to liczba o 1 większa niż ostani indeks tablicy bo jest numeracja od 0!
    //wyświetlanie kafelek z daniami do wyboru
    $i=0;
    $list = "";
    $jakie = $_POST['nazwa'];
    $nr_stol = $_SESSION['nr_stolika'];
    $sql_liczby = "SELECT ID_DANIA,NAZWA,ZDJ FROM dania WHERE TYP = '$jakie'";
    if($rezultat = @$polaczenie->query($sql_liczby))
    {
        while ($wiersz = $rezultat->fetch_assoc()) 
        {
            $numer[$i] = $wiersz['ID_DANIA'];
            $nazwa[$i] = $wiersz['NAZWA'];
            $zdj[$i] = $wiersz['ZDJ'];
            $list = $list.'<div class = "kafelek" id="d'.$numer[$i].'" onclick="dodaj('.$numer[$i].','.$nr_stol.')" style="cursor:pointer;"> <div class="j"><img class="img" src="szef/'.$zdj[$i].'"></div><div style="margin-top:5px;"> '.$numer[$i].'.'.$nazwa[$i].'</div></div>';
            $i++;
        }
        echo $list;
        $rezultat->free_result();
    }
    $polaczenie->close();
}
    ?>
