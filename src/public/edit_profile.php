<?php
session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: /login_form.php");
}

$pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

function isValidData(array $data): array
{
    $errors = [];

    if (!isset($data['name'])) {
        $errors['name'] = 'Имя должно быть заполнено' . "<pre>";
    }

    if (!isset($data['email'])) {
        $errors['email'] = 'Электронная почта должна быть заполнена' . "<pre>";
    }

    if (!isset($data['psw'])) {
        $errors['psw'] = 'Пароль должен быть заполнен' . "<pre>";
    }
    return $errors;
}

$errors = isValidData($_POST);

if(empty($errors)){
    $userId = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];

    $password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->query( "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$userId'");
  //select
} else {
    print_r($errors);
}



require_once './edit_profile_page.php';



