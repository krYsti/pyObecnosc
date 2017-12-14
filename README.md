# pyObecnosc
Lista obecności na środowe warsztaty.
Dla wykładowcy jest plik *clock.php*. Po wciśnięciu przycisku Start rozpoczyna się odliczanie 3 minut. Po zakończeniu odliczania
w bieżącym folderze tworzy się plik, którego obecność jest sprawdzana podczas zapisu danych do bazy.

Dla uczestników jest plik *index.php*, gdzie uzupełniają formularz.

Plik *sendfirm.php* wysyła do bazy dane z formularza.

Plik *stopclock.php* tworzy plik tekstowy na serwerze.

# Wymagania
PHP + MySQL

# Ustawienia SQL
plik *sendform.php* wiersze 44 do 47.
