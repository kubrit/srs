<?php

// Błędy
DEFINE('ERR_UNKNOWN_URL','Nieznany adres strony!');
DEFINE('ERR_FAILED_TO_SAVE','Nieudana próba zapisu, spróbuj ponownie.');
DEFINE('ERR_CHOOSE_FILE','Proszę wybrać plik.');
DEFINE('ERR_INVALID_TYPE','Nieprawidłowy typ pliku. Dozwolone: ');
DEFINE('ERR_YOU_MUST_LOG_IN','Musisz być zalogowany by to zrobić! Proszę się zalogować <a href=\'index.php\' onclick=\'window.location.href=\"index.php\"\'>tutaj</a>.');
DEFINE('ERR_ALREADY_REGISTERED_AND_LOGGED_IN','Jesteś już zarejestrowany oraz zalogowany.');
DEFINE('ERR_FIELDS_WITH_ASTERISK_ARE_REQUIRED','Pola oznaczone gwiazdką są wymagane!');
DEFINE('ERR_PASSWORD_DONT_MATCH','Wpisane hasła nie są zgodne! Powtórz...');
DEFINE('ERR_PASSWORD_CHAR_MINIMUM','Hasło musi składać się z min. 4 znaków!');
DEFINE('ERR_INCORRECT_PASSWORD','Niepoprawnie wpisałeś Twoje aktualne hasło!');
DEFINE('ERR_VALID_EMAIL_REQUIRED','Wymagany jest prawidłowy adres e-mail.');
DEFINE('ERR_IS_ALREADY_TAKEN','jest już zajęty.');
DEFINE('ERR_NO_RECIPIENT_SELECTED','Proszę wybrać odbiorcę wiadomości.');
DEFINE('ERR_SPACES_IN_LOGIN_NOT_ALLOWED','Twój login nie może zawierać odstępów.');
DEFINE('ERR_USERNAME_AND_PASSWORD_EMPTY','Musisz wpisać nazwę użytkownika i hasło!');
DEFINE('ERR_USERNAME_NOT_EXIST','Taki użytkownik nie istnieje. Jeszcze się nie rejestrowałeś?');
DEFINE('ERR_ACCOUNT_INACTIVE','Konto nieaktywne. Skontaktuj się z Administratorem.');
DEFINE('ERR_PASSWORD_TO_LONG','Hasło za długie! Maks. 32 znaki.');
DEFINE('ERR_CREATE_USER_PASSWORD_COMBINATION_INVALID','Ta kombinacja Użytkownik/Hasło jest niepoprawna!');
DEFINE('ERR_NO_RECORD_DELETED','Nie usunięto rekordu. Spróbuj ponownie.');
DEFINE('ERR_ERROR','Błąd!');
DEFINE('ERR_FAILED','Nieudane!');
DEFINE('ERR_INVALID_CONVERSATION_ID','Nieprawidłowy ID konwersacji! <a href="messages.php?messages=list">Wróć</a>');
DEFINE('ERR_DOES_NOT_EXIST','nie istnieje!');
DEFINE('ERR_INVALID_LOGIN','Wprowadzony login jest nieprawidłowy.');
DEFINE('ERR_USERS_NOT_FOUND','Tych kont nie można znaleźć: ');
DEFINE('ERR_SUBJECT_IS_EMPTY','Temat nie może być pusty.');
DEFINE('ERR_BODY_IS_EMPTY','Treść nie może być pusta.');
DEFINE('ERR_SELECT_AT_LEAST_ONE','Przynajmniej [ 1 ] checkbox musi być zaznaczony!');
DEFINE('ERR_CANT_ADD_SHIPMENTS_ALL','Nie możesz dodać przesyłki w `shipments=all`!');

// Sukcesy
DEFINE('SUC_SUCCESS','Sukces!');
DEFINE('SUC_RECORDS_CREATED','rekordy utworzone.');
DEFINE('SUC_RECORDS_DELETED','rekordy usunięte.');
DEFINE('SUC_PHOTO_UPLOADED','Zdjęcie przesłane, odśwież stronę.');
DEFINE('SUC_PASSWORD_CHANGED','Hasło zmienione pomyślnie.');
DEFINE('SUC_DATA_UPDATED','Pomślnie zaktualizowano Twoje dane.');
DEFINE('SUC_REGISTERED','Pomyślnie zarejestrowano.');
DEFINE('SUC_MESSAGE_SENT','Wiadomość wysłana.');

// Info
// DEFINE('INFO_TEST','Info testing.');

// Teksty
DEFINE('TXT_CHOOSE','Wybierz...');
DEFINE('TXT_SEND_ANOTHER_PHOTO','Wyślij inne zdjęcie...');
DEFINE('TXT_PERSONAL_INFORMATION','Informacje personalne');
DEFINE('TXT_LOGIN','Login');
DEFINE('TXT_FIRST_NAME','Imię');
DEFINE('TXT_LAST_NAME','Nazwisko');
DEFINE('TXT_EMAIL','E-mail');
DEFINE('TXT_LANDLINE_PHONE','Tel. Stacjonarny');
DEFINE('TXT_CELLPHONE','Tel. Komórkowy');
DEFINE('TXT_COMPANY','Firma');
DEFINE('TXT_PROFILE','Profil');
DEFINE('TXT_SETTINGS','Ustawienia');
DEFINE('TXT_LANGUAGE','Język');
DEFINE('TXT_CHANGE_PASSWORD','Zmień hasło');
DEFINE('TXT_CURRENT_PASSWORD','Obecne hasło');
DEFINE('TXT_NEW_PASSWORD','Nowe hasło');
DEFINE('TXT_REPEAT_PASSWORD','Powtórz hasło');
DEFINE('TXT_CHANGE_PHOTO','Zmień zdjęcie');
DEFINE('TXT_HERE','tutaj');
DEFINE('TXT_RECEIVE_IMPORTANT_INFORMATION','Chcę otrzymywać ważne informacje na maila.');
DEFINE('TXT_SIGN_UP','Zarejestruj się');
DEFINE('TXT_WELCOME','Witaj w Systemie Ewidencji Przesyłek');
DEFINE('TXT_ABOUT','Ta aplikacja została stworzona by wygodnie prowadzić ewidencję przesyłek między nadawcą, a odbiorcą. Znacznie przydatne przy dużym rozproszeniu terytorialnym firmy.');
DEFINE('TXT_CONTACT','Kontakt');
DEFINE('TXT_APP_DEVELOPER','Developer Aplikacji');
DEFINE('TXT_ARE_YOU_SURE','Czy na pewno usunąć record?');
DEFINE('TXT_SELECT','Zaznacz');
DEFINE('TXT_DESELECT','Odznacz Wszystkie');
DEFINE('TXT_SELECTED','Zaznaczone');
DEFINE('TXT_SHIPMENTS','Przesyłki');
DEFINE('TXT_YOUR_MESSAGES','Twoje wiadomości');
DEFINE('TXT_NEW_MESSAGE','Nowa wiadomość');
DEFINE('TXT_FIND_USER','Znajdź użytkownika!');
DEFINE('TXT_CONVERSATION_WITH','Rozmowa z: ');
DEFINE('TXT_NEW','Nowa');
DEFINE('TXT_ME','Ja');
DEFINE('TXT_CONFIRM_DELETE','Czy na pewno usunąć rekordy?');
DEFINE('TXT_ADD_NEW_SHIPMENTS','Dodaj nowe przeyłki');

// Rodzaje przesyłek
DEFINE('SHT_ID_0','Nieznane');
DEFINE('SHT_ID_1','List Polecony');
DEFINE('SHT_ID_2','List Priorytetowy');
DEFINE('SHT_ID_3','Przedpłata');

// Menu
DEFINE('MENU_HOME','Dom');
DEFINE('MENU_SHIPMENTS','Przesyłki');
DEFINE('MENU_CONTACT','Kontakt');
DEFINE('MENU_MESSAGES','Wiadomości');
DEFINE('MENU_PROFILE','Profil');
DEFINE('MENU_SETTINGS','Ustawienia');
DEFINE('MENU_CHANGE_PASSWORD','Zmień hasło');
DEFINE('MENU_SUPPORT','Wsparcie');
DEFINE('MENU_LOGOUT','Wyloguj');

// Przyciski
DEFINE('BTN_SAVE','Zapisz');
DEFINE('BTN_DELETE','Usuń');
DEFINE('BTN_CANCEL','Anuluj');
DEFINE('BTN_BACK','Wróć');
DEFINE('BTN_SEND','Wyślij');
DEFINE('BTN_CREATE','Utwórz');
DEFINE('BTN_CREATE_ACCOUNT','Utwórz konto');
DEFINE('BTN_LOG_IN','Loguj');
DEFINE('BTN_LOG_IN_PAGE','Strona logowania');
DEFINE('BTN_EDIT','Edytuj');
DEFINE('BTN_CHANGE_SHIPMENTS_COUNT','Zmień ilość przesyłek');
DEFINE('BTN_ALL','Wszystkie');
DEFINE('BTN_RECEIVED','Odebrane');
DEFINE('BTN_SENT','Wysłane');
DEFINE('BTN_SEARCH','Szukaj');
DEFINE('BTN_ADD','Dodaj');
DEFINE('BTN_EXPORT','Eksport');
DEFINE('BTN_CSV','CSV');
DEFINE('BTN_PDF','PDF');
DEFINE('BTN_PREVIEW_ALL','Podgląd wszystkich');
DEFINE('BTN_NEXT','Dalej');
DEFINE('BTN_UPDATE_ALL','Uaktualnij wszystkie');

// Tabele
DEFINE('TBL_NUMERO','LP.');
DEFINE('TBL_SENT_DATE','Data wysłania');
DEFINE('TBL_RECIPIENT','Odbiorca');
DEFINE('TBL_RECIPIENT_ADDRESS','Adres odbiorcy');
DEFINE('TBL_BODY','Treść');
DEFINE('TBL_SHIPMENT_TYPE','Rodzaj przesyłki');
DEFINE('TBL_REGISTERED_BY','Zarejestrował');
DEFINE('TBL_UPDATED_BY','Uaktualnił');
DEFINE('TBL_ACTION','Akcja');
DEFINE('TBL_NO_RESULTS','Brak wyników...');
DEFINE('TBL_HOW_MANY_TO_ADD','Wpisz ile przesyłek chcesz dodać');
DEFINE('TBL_SENDER','Nadawca');
DEFINE('TBL_SUBJECT','Temat');
DEFINE('TBL_LAST_UPDATE','Ost. Aktualizacja');
DEFINE('TBL_STATUS','Status');
DEFINE('TBL_ME','Ja');
DEFINE('TBL_NEW','Nowa');
DEFINE('TBL_NO_NEW_MESSAGES','Nie masz wiadomości');
DEFINE('TBL_MESSAGE','Wiadomość');
DEFINE('TBL_LOGIN','Login');
DEFINE('TBL_FIRST_NAME','Imię');
DEFINE('TBL_LAST_NAME','Nazwisko');

// Placeholders
DEFINE('PLH_CONTENT_OF_SENT_CORRESPONDENCE','Treść korespondencji');
DEFINE('PLH_SEARCH','Szukaj...');
DEFINE('PLH_HOW_MANY_ITEMS_TO_ADD','Ile elementów chcesz dodać? Np.: 1, 2, 3, 5... maks. 99');
DEFINE('PLH_SENT_TO_FEW','Wprowadź np: sadmin, admin, jkowalski by wysłać do wielu');
DEFINE('PLH_SEARCH_FOR_USER','Szukaj użytkownika...');
DEFINE('PLH_ANSWER_HERE','Tutaj możesz odpiasać na wiadomość');
DEFINE('PLH_SENT_DATE','Data wysłania');
DEFINE('PLH_RECIPIENT','Odbiorca');
DEFINE('PLH_RECIPIENT_ADDRESS','Adres odbiorcy');
DEFINE('PLH_LOGIN','Login');
DEFINE('PLH_FIRST_NAME','Imię');
DEFINE('PLH_LAST_NAME','Nazwisko');
DEFINE('PLH_EMAIL','E-mail');
DEFINE('PLH_PASSWORD','Hasło');
DEFINE('PLH_REPEAT_PASSWORD','Powtórz hasło');
DEFINE('PLH_ENTER_LOGIN','Wpisz swój login');
DEFINE('PLH_ENTER_PASSWORD','Wpisz swoje hasło');

// Alts
DEFINE('ALT_PROFILE_PHOTO','Zdjęcie profilu');
DEFINE('ALT_AVATAR','Avatar');

?>
