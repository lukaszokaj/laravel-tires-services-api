

Aplikacja korzysta z bazy SQLite w której już są przykładowe dane.

PANEL ADMINISTRATORA
Dostęp tylko z tokenem, aby cokolwiek zrobić należy uzyskać token poprzez zalogowanie.
Zalogować można się tylko pod adresem:

(POST)  .../api/login
    W ciele zapytania przekazać
      email => admin@admin.com
      password => password

      Po zalogowaniu dostaniemy token, który należy przekazywać podczas dalszych zapytań.

Wyświetlanie wszystkich terminów:
(GET)   .../api/admin/date

Wyświetlanie zajętych/zarezerwowanych terminów
(GET)   .../api/admin/date/busy

Dodawanie nowego terminu
(POST)  .../api/admin/date
      przykładowe dane
      swap_date => 2021-11-10 12:00:00    //daty należy podawać w tym formacie
      registration_number => ABC1234    //poprzez podanie tej wartości możemy dodać już zarezerwowany termin,
                                          nieprzekazanie tego parametru doda wolny termin.

Wyświetlanie pojedynczego terminu
(GET)   .../api/admin/date/3    //ostatni parametr (w tym przykładzie "3") wskazuje na id terminu.

Usuwanie terminu
(DELETE)  .../api/admin/date/3  //ostatni parametr (w tym przykładzie "3") wskazuje na id terminu który zostanie usunięty.

Wylogowanie administratora
(POST)  .../api/admin/logout  //spowoduje wylogowanie użytkownika - czyli token straci ważność, aby dostać nowy należy ponownie się zalogować.


PANEL KLIENTA
Wyświetlanie wolnych terminów
(GET)   .../api/user/date

Zapisanie/zarezerwowanie się na pierwszy wolny termin
(PUT)   .../api/user/book/first
        W ciele wiadomości należy przesłać numer rejestracyjny pojazdu.
        Przykładowe dane
        registration_number => WW2009

Zapisanie/zarezerwowanie się na wybrany termin
(PUT)   .../api/user/book/5 //ostatni parametr (w tym przypadku "5") wskazuje na id wybranego wolnego terminu.
        Należy również przekazać numer rejestracyjny pojazdu
        registration_number => DW3333

Zwolnienie/odwołanie rezerwacji
(PUT)   .../api/user/cancel
        Należy również przekazać numer rejestracyjny pojazdu
        registration_number => DW3333
