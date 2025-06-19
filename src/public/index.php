<?php
//взаимодействие с бд php
//HTML, css
//pdo
//регистрация
// супер глобальные переменные php
//валидация


$pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

//$pdo->exec("INSERT INTO users (name, email, password) VALUES ('Irina', 'Irina@gmail.com', 'qwerty123')");
$statement = $pdo->query("SELECT * FROM users");
$data = $statement->fetchAll();
echo "<pre>";
print_r($data);
echo "<pre>";



