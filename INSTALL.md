# Instrukcja Uruchomienia Aplikacji SmartStaff

Ta instrukcja opisuje kroki, które pozwolą Ci uruchomić aplikację **SmartStaff** na lokalnym serwerze, takim jak **XAMPP** lub **WAMP**. Aplikacja została przetestowana i uruchomiona w środowisku lokalnym (localhost), więc jeśli zdecydujesz się na inną konfigurację, kroki mogą się różnić.

## Krok 1: Zainstaluj XAMPP lub WAMP

1. **Pobierz** i **zainstaluj** XAMPP lub WAMP:
   - XAMPP: [Oficjalna strona pobierania XAMPP](https://www.apachefriends.org/index.html)
   - WAMP: [Oficjalna strona pobierania WAMP](http://www.wampserver.com/)

2. **Uruchom lokalny serwer** (Apache) oraz bazę danych (MySQL) za pomocą panelu kontrolnego XAMPP lub WAMP.

## Krok 2: Skopiuj pliki aplikacji do katalogu serwera

1. Skopiuj folder aplikacji do katalogu `htdocs` (dla XAMPP) lub `www` (dla WAMP). Katalog docelowy powinien wyglądać następująco:
   - Dla XAMPP: `C:/xampp/htdocs/SmartStaff`
   - Dla WAMP: `C:/wamp/www/SmartStaff`

## Krok 3: Utwórz bazę danych

1. Otwórz przeglądarkę internetową i przejdź do [phpMyAdmin](http://localhost/phpmyadmin/).

2. Utwórz nową bazę danych:
   - Kliknij „New” w menu po lewej stronie.
   - Wpisz nazwę bazy danych (np. `smartstaff`) i kliknij „Create”.

3. **Zaimportuj strukturę bazy danych**:
   - Przejdź do zakładki „Import” w phpMyAdmin.
   - Wybierz plik `.sql` zawierający strukturę bazy danych dla SmartStaff (możesz go znaleźć w repozytorium projektu w folderze "DB").
   - Kliknij „Import”, aby zaimportować strukturę bazy danych.

## Krok 4: Skonfiguruj połączenie z bazą danych

1. Otwórz plik konfiguracyjny `baza.php` w folderze projektu SmartStaff.

2. Ewentualnie zaktualizuj ustawienia bazy danych, aby odpowiadały twojemu środowisku. Przykładowa konfiguracja wygląda następująco:

   ```php
   <?php
   $host = 'localhost';
   $db   = 'smartstaff';
   $user = 'root';
   $pass = '';
   $charset = 'utf8mb4';
   ?>
   
- user: Upewnij się, że używasz właściwego użytkownika MySQL. Dla domyślnych instalacji XAMPP/WAMP, użytkownikiem jest zazwyczaj root.
- pass: Domyślnie w XAMPP/WAMP hasło jest puste (''), chyba że ustawiłeś inne.
Zapisz plik po modyfikacjach.

## Krok 5: Uruchom aplikację

1. Przejdź do przeglądarki internetowej i wpisz adres lokalnego serwera:

http://localhost/SmartStaff
   
2. Powinna załadować się strona główna aplikacji SmartStaff. Możesz teraz zalogować się na różne konta i przetestować funkcjonalność aplikacji.

**Uwaga**: Hasła w bazie danych są szyfrowane, więc nie są bezpośrednio widoczne. W celu ułatwienia testów, każde konto testowe ma ustawione hasło takie samo jak jego login.
 
## Krok 6: Rozwiązywanie problemów

- **Błąd połączenia z bazą danych**: Sprawdź, czy serwer MySQL w panelu XAMPP jest uruchomiony i czy dane w `baza.php` są poprawne.
- **Błąd 404**: Upewnij się, że folder projektu znajduje się w odpowiednim katalogu serwera (`htdocs` dla XAMPP lub `www` dla WAMP).
- **Problemy z uprawnieniami**: Sprawdź, czy masz odpowiednie uprawnienia dostępu do folderów projektu i bazy danych.

---

**Uwaga**: Instrukcja oparta jest na konfiguracji na lokalnym serwerze (localhost), która została użyta podczas tworzenia i testowania aplikacji. Inne konfiguracje mogą wymagać dodatkowych kroków lub modyfikacji.

