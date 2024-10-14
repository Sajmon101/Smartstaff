<?php
//!!!$_SESSION['LOGIN'] i $_SESSION['TYP'] są tu zarezerwowane dla prawidłowego logowania, nie używaj tej zmiennej do innych celów

    /*intrukcja pod spodem sprawia, że ten plik ma dostęp do sesji. Plik do którego wysyłasz też ten dostęp musi mieć */
    session_start();

    /*Połączenie z bazą danych i sprawdzenie poprawności połączenia */
    require_once "baza.php";

    /*w elsie wszystko co się dzieje gdy się połączymy z bazą danych */
    if($polaczenie->connect_errno==0)
    {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        if(ctype_alnum($login)==true)
        {
        $sql_login=$polaczenie->prepare("SELECT * FROM logowanie WHERE LOGIN = ?");
        $sql_login->bind_param('s',$login);
        }

        else
        {
            $_SESSION['error'] = '<br><br> Login może składać się tylko z liter i cyfr <br>';
            unset($_SESSION['LOGIN']);
            header('Location: index.php');
        }

        /*sprawdzenie czy zapytanie zostało dobrze naspisane oraz wysłanie zapytania do bazy i zapisanie wyniku (np.iluś wierszy) w zmiennej $rezultat*/
        if($sql_login->execute())
        {
            $rezultat = $sql_login->get_result();
            $ile_user = $rezultat ->num_rows; /*funkcja ta zwraca ile rekordów znalazło zapytanie */
            if($ile_user>0)
            {
                /*wrzucenie do zmiennej (która staje się automatycznie tablicą) */
                $wiersz = $rezultat->fetch_assoc();
                
                /*sprawdzenie zahashowanego hasła czy jest prawidłowe */
                if(password_verify($haslo,$wiersz['HASLO']))
                {
                    /*odwołanie się do elementu tablicy o nazwie login i wysłanie go sesją do innego pliku. $POST służy do wysyłania formularzem a $_SESSION do wysyłania pomiędzy plikami */
                    $_SESSION['LOGIN'] = $wiersz['LOGIN'];
                    $_SESSION['ID_PRAC'] = $wiersz['ID_PRAC'];

                    /*usuwanie zmiennej wyświetlającej błąd w logowaniu. Więcej miejsca i zabezpieczenie że npis o złym logowaniu się nagle tam nie wyświetli przy ponownym logowaniu */

                    unset($_SESSION['error']);

                    /*odczytywanie z bazy danych typu pracownika, który się loguje*/

                    $ID_PRAC = $wiersz['ID_PRAC'];
                    $sql_typ_prac = "SELECT TYP FROM pracownicy WHERE ID_PRAC = '$ID_PRAC'";
                    if($rezultat = @$polaczenie->query($sql_typ_prac))
                    {
                        $wiersz = $rezultat->fetch_assoc();
                    }
                    $_SESSION['TYP'] = $wiersz['TYP'];
                    /*usuwanie rezultatu,żeby zwolnić pamięć */
                    $rezultat->free_result();

                    /*do jakiego pliku odesłać gdy się uda logowanie */
                    if($wiersz['TYP']=='kelner')
                    {
                        header('Location: kelner.php');
                    }

                    if($wiersz['TYP']=='kucharz' || ($wiersz['TYP']=='barman'))
                    {
                        header('Location: kucharz.php');
                    }

                    if($wiersz['TYP']=='szef')
                    {
                        header('Location: szef\szef-menu.php');
                    }
                }
                else
                {
                    $_SESSION['error'] = '<br><br> Nieprawidłowy login lub hasło <br>';
                    unset($_SESSION['LOGIN']);
                    header('Location: index.php');
                }
            }

            else
            {
                $_SESSION['error'] = '<br><br> Nieprawidłowy login lub hasło <br>';
                unset($_SESSION['LOGIN']);
                header('Location: index.php');
            }
        }

        $polaczenie->close();
    }
 



?>