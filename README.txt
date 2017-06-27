Należy przejsc do katalogu gdzie znajduje sie plik api.php, 
nalezy uruchomic serwer za pomoca polecenia php -S localhost:8080 api.php.

Do dyspozycji mamy 4 funkcje

- /todo/list        - generowanie listy rzeczy do zrobienia (metoda HTTP: GET)
- /todo/add         - dodawanie nowego wpisu na liście (metoda HTTP: PUT)
- /todo/remove      - usuwanie wybranego wpisu z list (metoda HTTP: DELETE)
- /todo/mark-as-don - oznaczanie zadania jako wykonane (metoda HTTP: POST)

Przykladowy test dzialania api

Przyklad uzycia api, który mozna wywolac w konsoli 

curl "http://localhost:8080/api.php?/todo/list" &&
curl -X PUT "http://localhost:8080/api.php?/todo/add" -d simple_label0 &&
curl -X PUT "http://localhost:8080/api.php?/todo/add" -d simple_label1 &&
curl -X PUT "http://localhost:8080/api.php?/todo/add" -d simple_label2 &&
curl -X PUT "http://localhost:8080/api.php?/todo/add" -d simple_label3 &&
curl "http://localhost:8080/api.php?/todo/list" &&
curl -X DELETE "http://localhost:8080/api.php?/todo/remove" -d 2 &&
curl -X POST "http://localhost:8080/api.php?/todo/mark-as-don" -d 3 &&
curl -X PUT "http://localhost:8080/api.php?/todo/add" -d simple_label4 &&
curl "http://localhost:8080/api.php?/todo/list"
