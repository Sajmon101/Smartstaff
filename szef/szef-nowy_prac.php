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
    if(isset($_POST['Pesel']))
    {
        /*flaga która zmienia się na false jeśli jakiś warunek walidacji nie jest spełniony */
        $wszystko_ok = true;

        //ładowanie zdjęcia
        if($_FILES['zdj']['size']==0)
        {
            $img_uploaded_path = "uploaded_zdj/pracownicy/default.png";
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
                        $gotowe_zdj = uniqid("IMG-",true).'.'.$img_ex_lc;
                        $img_uploaded_path = 'uploaded_zdj/pracownicy/'.$gotowe_zdj;
                        //zapisanie zdjęcia
                        move_uploaded_file($tmp_name,$img_uploaded_path);

                        /*skalowanie zdjęcia do odpowiedniej wielkości*/
                        //tworzenie pustego miejsca o rozdzieloczości do której chcemy skalować zdjęcie
                        $small = imagecreatetruecolor(120,150);
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
                        
                        //ściąganie rozmiarów oryginalnego zdjęcia
                        $original_dimensions = getimagesize($img_uploaded_path);
                        $width = $original_dimensions[0];
                        $height = $original_dimensions[1];

                        //dodawanie tła do obrazu
                        $with_background = imagecreatetruecolor($width, $height);
                        $lighter = imagecolorallocate($with_background, 26, 72, 93);
                        imagefill($with_background, 0, 0, $lighter);
                        imagecopy($with_background, $source, 0, 0, 0, 0, $width, $height);

                        /*skalowanie zdjęcia do odpowiedniej wielkości z zachowaniem proporcji*/
                            $new_height = 150;
                            $aspect = $height/$new_height;
                            $new_width = $width/$aspect;

                        //tworzenie pustego miejsca o rozdzieloczości do której chcemy skalować zdjęcie
                        $small = imagecreatetruecolor($new_width,$new_height);

                        //włożenie zdjęcia oryginalnego do stworzonej ramki o wybranych rozmiarach najpierw na stronę szefa większy format
                        imagecopyresampled($small, $with_background, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        //usunięcie oryginału (w przypadku innego błędu w formularzu, oryginał by się zapisał i by został niepotrzebnie)
                        unlink('uploaded_zdj/pracownicy/'.$gotowe_zdj);
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
        if(strlen($_POST['Imie'])==0)
        {
            $wszystko_ok = false;
            $_SESSION['e-Imie'] = "Pole musi być wypełnione";
        }

        if(strlen($_POST['Nazwisko'])==0)
        {
            $wszystko_ok = false;
            $_SESSION['e-Nazwisko'] = "Pole musi być wypełnione";
        }

        if($_POST['Data_zatrudnienia']==NULL)
        {
            $wszystko_ok = false;
            $_SESSION['e-Data_zatrudnienia'] = "Pole musi być wypełnione";
        }

        if(is_numeric($_POST['Pesel'])==false)
        {
            $wszystko_ok = false;
            $_SESSION['e-Pesel'] = "Pole może zawierać tylko cyfry";
        }

        if(strlen($_POST['Pesel'])<11)
        {
            $wszystko_ok = false;
            $_SESSION['e-Pesel'] = "Pesel za krótki";
        } 

        if(strlen($_POST['Pesel'])>11)
        {
            $wszystko_ok = false;
            $_SESSION['e-Pesel'] = "Pesel za długi";
        } 

        if(is_numeric($_POST['Pensja'])==false)
        {
            $wszystko_ok = false;
            $_SESSION['e-Pensja'] = "Pole może zawierać tylko cyfry";
        }

        if(strlen($_POST['Pensja'])==0)
        {
            $wszystko_ok = false;
            $_SESSION['e-Pensja'] = "Pole musi być wypełnione";
        }

        
        if(ctype_alnum($_POST['Login'])==false)
        {
            $wszystko_ok = false;
            $_SESSION['e-Login'] = "Login może się składać tylko z liter <br> i cyfr (bez polskich znaków)";
        }

        if(strlen($_POST['Login'])==0)
        {
            $wszystko_ok = false;
            $_SESSION['e-Login'] = "Pole musi być wypełnione";
        }
            //sprawdzanie czy wpisany login już nie istnieje w bazie
            require 'baza.php';

            if($polaczenie->connect_errno==0)
            {
                $login = $_POST['Login'];
                $sql_login_check="SELECT * FROM logowanie WHERE LOGIN='$login'";

                if($rezultat_sql_login_check = @$polaczenie->query($sql_login_check))
                {
                    $ile_user = $rezultat_sql_login_check ->num_rows;
                    if($ile_user>0)
                    {
                        $wszystko_ok = false;
                        $_SESSION['e-Login'] = "Taki login już istnieje";
                    }
                    $rezultat_sql_login_check->free_result();
                }

                $polaczenie->close();
            }

        if(ctype_alnum($_POST['Haslo'])==false)
        {
            $wszystko_ok = false;
            $_SESSION['e-Haslo'] = "Hasło może się składać tylko z liter <br> i cyfr (bez polskich znaków)";
        }

        if(strlen($_POST['Haslo'])==0)
        {
            $wszystko_ok = false;
            $_SESSION['e-Haslo'] = "Pole musi być wypełnione";
        }

        $haslo = $_POST['Haslo'];
        $haslo2 = $_POST['Haslo2'];
        if($haslo!=$haslo2)
        {
            $wszystko_ok = false;
            $_SESSION['e-Haslo'] = "Podane hasla są różne";
            $_SESSION['e-Haslo2'] = "Podane hasla są różne";
        }

    $haslo = password_hash($_POST['Haslo'], /*PASSWORD_ARGON2I*/PASSWORD_DEFAULT);

        //pamiętanie danych w przypadku nieudanej walidacji
        $login = $_POST['Login'];
        $Imie = $_POST['Imie'];
        $Nazwisko = $_POST['Nazwisko'];
        $Data_zatrudnienia = $_POST['Data_zatrudnienia'];
        $Pesel = $_POST['Pesel'];
        $Typ = $_POST['Typ'];
        $Pensja = $_POST['Pensja'];

        $_SESSION['f_Login'] = $login;
        $_SESSION['f_Imie'] = $Imie;
        $_SESSION['f_Nazwisko'] = $Nazwisko;
        $_SESSION['f_Data_zatrudnienia'] = $Data_zatrudnienia;
        $_SESSION['f_Pesel'] = $Pesel;
        $_SESSION['f_Typ'] = $Typ;
        $_SESSION['f_Pensja'] = $Pensja;

        /*gdy walidacja przejdzie poprawnie*/
        if($wszystko_ok==true)
        {
            //sprawdzanie czy zdjęcie zostało dodane
            if($dodano_zdj==1)
            {
                //konwersja obiektu zdjęcia na rzeczywiste zdjęcie i zapisanie go do pliku
                imagepng($small, 'uploaded_zdj/pracownicy/'.$gotowe_zdj);
            }

            require 'baza.php';
            if($polaczenie->connect_errno==0)
            {
                //szukamy najwyższego ID pracownika w bazie
                $sql_highest_ID="SELECT MAX(ID_PRAC) FROM logowanie";
                
                if($rezultat_sql_highest_ID = @$polaczenie->query($sql_highest_ID))
                {
                    if($rezultat_sql_highest_ID ->num_rows>0)
                    {
                        $highest_ID = $rezultat_sql_highest_ID->fetch_assoc();
                        $new_ID = $highest_ID['MAX(ID_PRAC)'] + 1;

                        //wpisanie do bazy pracownika z ID o jeeden wyżej niż znalezione maksymalne
                        
                        $sql_insert_account="INSERT INTO logowanie VALUES('$new_ID','$login','$haslo')";
                        $sql_insert_worker="INSERT INTO pracownicy VALUES('$new_ID','$Imie','$Nazwisko','$Data_zatrudnienia', '$Pesel','$Typ','$Pensja','0','$img_uploaded_path')";

                        if(@$polaczenie->query($sql_insert_account) && @$polaczenie->query($sql_insert_worker))
                        {
                            header('Location: szef-dodaj_prac_success.php');
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
    <title>Szef - Dodaj nowego pracownika</title>
</head>
<body>
    <a class="przycisk-powrot" href="szef-menu.php">&#8592</a>
    <div class="container">
        <!-- Jeżeli w form nie damy parametru action mówiącego w jakim pliku dane formularza mają się przetworzyć to przetworzą się w tym samym w którym jest formularz (u mnie na samej góze) -->
        <form method="post" enctype="multipart/form-data">

            <div class="panel-rejestracji">
                <div ><label class="napis" for="Imie">Imię</label></div>
                <div ><input id="Imie" class="pole-text" type="text" value="<?php
                
                    if(isset($_SESSION['f_Imie']))
                    {
                        echo $_SESSION['f_Imie'];
                        unset ($_SESSION['f_Imie']);
                    }

                
                ?>" name="Imie"></div>
                
                <?php
                    if(isset($_SESSION['e-Imie']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Imie'].'</div>';
                        unset($_SESSION['e-Imie']);
                    }

                ?>

                <div ><label class="napis" for="Nazwisko">Nazwisko</label></div>
                <div ><input id="Nazwisko" class="pole-text" type="text" value="<?php
                
                    if(isset($_SESSION['f_Nazwisko']))
                    {
                        echo $_SESSION['f_Nazwisko'];
                        unset ($_SESSION['f_Nazwisko']);
                    }

            
                ?>" name="Nazwisko"></div>

                <?php
                    if(isset($_SESSION['e-Nazwisko']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Nazwisko'].'</div>';
                        unset($_SESSION['e-Nazwisko']);
                    }

                ?>

                <div ><label class="napis" for="Data_zatrudnienia">Data przyjęcia</label></div>
                <div ><input id="Data_zatrudnienia" class="pole-text" type="date" value="<?php
                
                    if(isset($_SESSION['f_Data_zatrudnienia']))
                    {
                        echo $_SESSION['f_Data_zatrudnienia'];
                        unset ($_SESSION['f_Data_zatrudnienia']);
                    }

            
                ?>" name="Data_zatrudnienia"></div>

                <?php
                    if(isset($_SESSION['e-Data_zatrudnienia']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Data_zatrudnienia'].'</div>';
                        unset($_SESSION['e-Data_zatrudnienia']);
                    }

                ?>

                <div ><label class="napis" for="Pesel">Pesel</label></div>
                <div ><input id="Pesel" class="pole-text" type="number" value="<?php
                
                    if(isset($_SESSION['f_Pesel']))
                    {
                        echo $_SESSION['f_Pesel'];
                        unset ($_SESSION['f_Pesel']);
                    }

            
                ?>" name="Pesel"></div>

                <?php
                    if(isset($_SESSION['e-Pesel']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Pesel'].'</div>';
                        unset($_SESSION['e-Pesel']);
                    }

                ?>

                <div ><label class="napis" for="Pensja">Pensja</label></div>
                <div ><input id="Pensja" class="pole-text" type="number" value="<?php
                
                    if(isset($_SESSION['f_Pensja']))
                    {
                        echo $_SESSION['f_Pensja'];
                        unset ($_SESSION['f_Pensja']);
                    }

                ?>" name="Pensja"></div>

                <?php
                    if(isset($_SESSION['e-Pensja']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Pensja'].'</div>';
                        unset($_SESSION['e-Pensja']);
                    }
                ?>

            </div>

            <div class="panel-rejestracji">

                <div ><label class="napis" for="Typ">Typ</label></div>
                <div ><select id="Typ" class="pole-text" name="Typ">
                    <option value = "kucharz">kucharz</option>

                    <option value = "kelner" <?php
                        if(isset($_SESSION['f_Typ']))
                        {
                            if($_SESSION['f_Typ'] == "kelner")
                            {
                                echo "selected";
                                unset($_SESSION['f_Typ']);
                            }
                        }
                        ?>>kelner</option>

                    <option value = "barman" <?php
                        if(isset($_SESSION['f_Typ']))
                        {
                            if($_SESSION['f_Typ'] == "barman")
                            {
                                echo "selected";
                                unset($_SESSION['f_Typ']);
                            }
                        }
                        ?>>barman</option>
                </select></div>

                <div ><label class="napis" for="Login">Login</label></div>
                <div ><input id="Login" class="pole-text" type="text" value="<?php
                    
                    if(isset($_SESSION['f_Login']))
                    {
                        echo $_SESSION['f_Login'];
                        unset ($_SESSION['f_Login']);
                    }

                ?>"  name="Login"></div>

                <?php
                    if(isset($_SESSION['e-Login']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Login'].'</div>';
                        unset($_SESSION['e-Login']);
                    }
                ?>

                <div ><label class="napis" for="Haslo">Hasło</label></div>
                <div ><input id="Haslo" class="pole-text" type="password" name="Haslo"></div>

                <?php
                    if(isset($_SESSION['e-Haslo']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Haslo'].'</div>';
                        unset($_SESSION['e-Haslo']);
                    }

                ?>

                <div ><label class="napis" for="Haslo2">Powtórz hasło</label></div>
                <div ><input id="Haslo2" class="pole-text" type="password" name="Haslo2"></div>

                <?php
                    if(isset($_SESSION['e-Haslo2']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-Haslo2'].'</div>';
                        unset($_SESSION['e-Haslo2']);
                    }
                ?>

                <div ><label class="napis" for="zdj">Dodaj zdjęcie</label></div>
                <div ><input id="zdj" class="pole-text" type="file" name="zdj"></div>

                <?php
                    if(isset($_SESSION['e-zdj']))
                    {
                        echo '<div class = "error">'.$_SESSION['e-zdj'].'</div>';
                        unset($_SESSION['e-zdj']);
                    }
                ?>

                <div style="margin-top:-15px; font-size:13px;">Dozwolone formaty: jpg, jpeg, png, bmp</div>
                <div><input class="przycisk" type="submit" value="Dodaj pracownika"></div>
            </div>
        </form>
    
    </div>

</body>
</html>
