<?php
session_start();

if (!isset($_SESSION['user_id'])){
    header("Location: /login_form.php");
} else {
    $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->query( "SELECT * FROM users WHERE id = '$user_id'");
    $profile = $stmt->fetch();
}


require_once './profile_page.php';



