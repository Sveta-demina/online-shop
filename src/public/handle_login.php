<?php
function isValidData(array $data): array
{
    $errors = [];

    if (!isset($data['username'])) {
        $errors['username'] = 'Электронная почта должна быть заполнена' . "<pre>";
    }

    if (!isset($data['password'])) {
        $errors['password'] = 'Пароль должен быть заполнен' . "<pre>"; // первичная валидация данных
    }
    return $errors;
}

$errors = isValidData($_POST);
if (empty($errors)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");//из БД запрос на существование емэйл
    $statement->execute(['email' => $username]);
    $user = $statement->fetch(); // феч отдает либо array либо false

    if ($user === false) {
        $errors['username'] = 'Логин или пароль указаны неверно' . "<pre>";
    } else {
        $passwordDb = $user['password']; // хэшированный пароль из бд
        if (password_verify($password, $passwordDb)) {
            //проверяем хэшированный пароль и оригинальный пароль пользователя

            //успешный вход через куки
            //setcookie('user_id', $user['id']);
            // // set-cookie: user_id = 5

            //успешный вход через сессии
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: /catalog");


            //отдаем страницу каталога с помощью редиректа-перенаправления статус код 302
        } else {
            $errors['username'] = 'Логин или пароль указаны неверно' . "<pre>";
        }
    }
}



require_once './login_form.php';

