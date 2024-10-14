<?php
    session_start();
//zabezpieczenie żeby nie dało się po wylogowaniu strzałką cofnij wrócić na konto oraz żeby nie dało się zmianą końcówki adresu URL wejść na konto
if($_SESSION['TYP']!='szef')
{
    header('Location:http://localhost/Smartstaff/index.php');
}
//

    /* co się dzieje po zatwierdzeniu formularza: */
    /*wystarczy sprawdzić czy został stworzony pojemnik w POSTcie tylko na jedną zmienną bo jest to sprawdzenie czy formularz został już wysłany */
    if(isset($_POST['Nazwa']))
    {
        /*flaga która zmienia się na false jeśli jakiś warunek walidacji nie jest spełniony */
        $wszystko_ok = true;

        //ładowanie zdjęcia
        if($_FILES['zdj']['size']==0)
        {
            $img_uploaded_path = "uploaded_zdj/dania/default.png";
        }

        else
        {
            $img_name = $_FILES['zdj']['name'];
            $img_size = $_FILES['zdj']['size'];
            $tmp_name = $_FILES['zdj']['tmp_name'];
            $error = $_FILES['zdj']['error'];
        

            if($error==0)
            {
                if($img_size > 3145728) /*3 MB ograniczenie*/
                {
                    $wszystko_ok = false;
                    $_SESSION['e-zdj'] = "Zdjęcie nie może być większe niż 3MB";
                }

                else
                {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg","jpeg","png","bmp");

                    if(in_array($img_ex_lc, $allowed_exs))
                    {
                        //tworzenie nazwy zdjęcia, które zapisujemy do pliku
                        $gotowe_zdj = uniqid("IMG-",true).'.'.$img_ex_lc;
                        //tworzenie ścieżki, miejsca hdzie zapiszemy zdjęcie
                        $img_uploaded_path = 'uploaded_zdj/dania/'.$gotowe_zdj;
                        //zapisanie zdjęcia
                        move_uploaded_file($tmp_name,$img_uploaded_path);

                        //tworzenie obiektu zdjęcia (w zależności od rozszerzenia należy użyć innej funkcji)
                        if($img_ex_lc=="png")
                        {
                            $source = imagecreatefrompng($img_uploaded_path);
                        }

                        elseif($img_ex_lc=="jpg"||$img_ex_lc=="jpeg")
                        {
                            $source = imagecreatefromjpeg($img_uploaded_path);
                        }

                        elseif($img_ex_lc=="bmp")
                        {
                            $source = imagecreatefrombmp($img_uploaded_path);
                        }
                        
                        //pozyskiwanie rozmiarów oryginalnego zdjęcia
                        $original_dimensions = getimagesize($img_uploaded_path);
                        $width = $original_dimensions[0];
                        $height = $original_dimensions[1];

                        //dodawanie tła do obrazu
                        $with_background = imagecreatetruecolor($width, $height);
                        $lighter = imagecolorallocate($with_background, 26, 72, 93);
                        imagefill($with_background, 0, 0, $lighter);
                        imagecopy($with_background, $source, 0, 0, 0, 0, $width, $height);

                        /*skalowanie zdjęcia do odpowiedniej wielkości z zachowaniem proporcji*/
                        if($width>$height)
                        {
                            $new_width = 160;
                            $aspect = $width/$new_width;
                            $new_height = $height/$aspect;
                        }
                        else
                        {
                            $new_height = 160;
                            $aspect = $height/$new_height;
                            $new_width = $width/$aspect;
                        }

                        //tworzenie pustego miejsca o rozdzieloczości do której chcemy skalować zdjęcie
                        $small = imagecreatetruecolor($new_width,$new_height);

                        //włożenie zdjęcia oryginalnego do stworzonej ramki o wybranych rozmiarach najpierw na stronę szefa większy format
                        imagecopyresampled($small, $with_background, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        //usunięcie oryginału (w przypadku innego błędu w formularzu, oryginał by się zapisał i by został niepotrzebnie)
                        unlink('uploaded_zdj/dania/'.$gotowe_zdj);
                        $dodano_zdj = 1;
                    }

                    else
                    {
                        $wszystko_ok = false;
                        $_SESSION['e-zdj'] = "Niedozwolony format pliku";
                    }
                }
            }

            else
            {
                $wszystko_ok = false;
                $_SESSION['e-zdj'] = "Nieznany błąd";
            }
        }

        /*obsługa błedów*/
        if(strlen($_POST['Nazwa'])==0)
        {
            $wszystko_ok = false;
            $_SESSION['e-Nazwa'] = "Pole musi być wypełnione";
        }

        if(strlen($_POST['Cena'])==0)
        {
            $wszystko_ok = false;
            $_SESSION['e-Cena'] = "Pole musi być wypełnione";
        }

            //sprawdzanie czy wpisany login już nie istnieje w bazie
            require 'baza.php';

            if($polaczenie->connect_errno==0)
            {
                $nazwa = $_POST['Nazwa'];
                $sql_nazwa_check="SELECT * FROM Dania WHERE NAZWA='$nazwa'";

                if($rezultat_sql_nazwa_check = @$polaczenie->query($sql_nazwa_check))
                {
                    $ile_nazwa = $rezultat_sql_nazwa_check ->num_rows;
                    if($ile_nazwa>0)
                    {
                        $wszystko_ok = false;
                        $_SESSION['e-Nazwa'] = "Taka nazwa dania już istnieje";
                    }
                    $rezultat_sql_nazwa_check->free_result();
                }

                $polaczenie->close();
            }

        //pamiętanie danych w przypadku nieudanej walidacji
        $nazwa = $_POST['Nazwa'];
        $typ = $_POST['Typ'];
        $cena = $_POST['Cena'];

        $_SESSION['f_Nazwa'] = $nazwa;
        $_SESSION['f_Typ'] = $typ;
        $_SESSION['f_Cena'] = $cena;

        /*gdy walidacja przejdzie poprawnie*/
        if($wszystko_ok==true)
        {
            //sprawdzanie czy zdjęcie zostało dodane
            if($dodano_zdj==1)
            {
                //konwersja obiektu zdjęcia na rzeczywiste zdjęcie i zapisanie go do pliku
                imagepng($small, 'uploaded_zdj/dania/'.$gotowe_zdj);
            }

            //zapisanie danych do bazy
            require 'baza.php';
            if($polaczenie->connect_errno==0)
            {
                //szukamy najwyższego ID pracownika w bazie
                $sql_highest_ID="SELECT MAX(ID_DANIA) FROM Dania";
                
                if($rezultat_sql_highest_ID = @$polaczenie->query($sql_highest_ID))
                {
                    if($rezultat_sql_highest_ID ->num_rows>0)
                    {
                        $highest_ID = $rezultat_sql_highest_ID->fetch_assoc();
                        $new_ID = $highest_ID['MAX(ID_DANIA)'] + 1;

                        //wpisanie do bazy dania z ID o jeeden wyżej niż znalezione maksymalne
                        
                        $sql_insert_dish="INSERT INTO Dania VALUES('$new_ID','$nazwa','$typ','$cena','$img_uploaded_path','0')";

                        if(@$polaczenie->query($sql_insert_dish))
                        {
                            header('Location: szef-dodaj_danie_success.php');
                        }

                        else
                        {
                            echo "Błąd";
                        }
                    }
                }
                
            $polaczenie->close();
                
            }
        }

    }


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Web application that support organisation of a restaurant"/>
    <link rel="stylesheet" href="style-szef.css" type="text/css" />
    <title>Szef - Dodaj nowe danie</title>
</head>
<body>
    <a class="przycisk-powrot" href="szef-menu.php">&#8592</a>
    <div class="container">

        <!-- Jeżeli w form nie damy parametru action mówiącego w jakim pliku dane formularza mają się przetworzyć to przetworzą się w tym samym w którym jest formularz (u mnie na samej góze) -->
        <form method="post" enctype="multipart/form-data">

            <div class="panel-rejestracji">
                <div ><label class="nazwa" for="Nazwa">Nazwa</label></div>
                <div ><input id="Nazwa" class="pole-text" type="text" value="<?php
                
                    if(isset($_SESSION['f_Nazwa']))
                    {
                        echo $_SESSION['f_Nazwa'];
                        unset ($_SESSION['f_Nazwa']);
                    }

                
                ?>" name="Nazwa"></div>
                
                <?php
                    if(isset($_SESSION['e-Nazwa']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Nazwa'].'</div>';
                        unset($_SESSION['e-Nazwa']);
                    }

                ?>

                <div ><label class="napis" for="Typ">Typ</label></div>
                <div ><select id="Typ" class="pole-text" name="Typ">
                    <option value = "danie_glowne">danie główne</option>

                    <option value = "deser" <?php
                        if(isset($_SESSION['f_Typ']))
                        {
                            if($_SESSION['f_Typ'] == "deser")
                            {
                                echo "selected";
                                unset($_SESSION['f_Typ']);
                            }
                        }
                        ?>>deser</option>

                    <option value = "napoj" <?php
                        if(isset($_SESSION['f_Typ']))
                        {
                            if($_SESSION['f_Typ'] == "napoj")
                            {
                                echo "selected";
                                unset($_SESSION['f_Typ']);
                            }
                        }
                        ?>>napój</option>
                </select></div>

                <div ><label class="napis" for="Cena">Cena</label></div>
                <div ><input id="Cena" class="pole-text" type="number" min="0" step="0.01" max="999" value="<?php
                    
                    if(isset($_SESSION['f_Cena']))
                    {
                        echo $_SESSION['f_Cena'];
                        unset ($_SESSION['f_Cena']);
                    }

                ?>"  name="Cena"></div>

                <?php
                    if(isset($_SESSION['e-Cena']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Cena'].'</div>';
                        unset($_SESSION['e-Cena']);
                    }
                ?>

                <div ><label class="napis" for="zdj">Dodaj ikonę</label></div>
                <div ><input id="zdj" class="pole-text" type="file" name="zdj"></div>

                <?php
                    if(isset($_SESSION['e-zdj']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-zdj'].'</div>';
                        unset($_SESSION['e-zdj']);
                    }
                ?>

                <div style="margin-top:-15px; font-size:13px;">Dozwolone formaty: jpg, jpeg, png, bmp</div>

                <div><input class="przycisk" type="submit" value="Dodaj danie"></div>
            </div>
        </form>
    
    </div>

</body>
</html>
