<?php

//if (!isset($_COOKIE['user_id'])) {
  //  header("Location: /login_form.php");
//}
session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: /login_form.php");
} else {
    $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->query( 'SELECT * FROM products');
    $products = $stmt->fetchAll();
}

//авторизация - это процесс проверки прав доступа для пользователя

require_once './catalog_page.php';
