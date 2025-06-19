<?php

$errors = [];

if(isset($_GET['name'])){
    $name = $_GET['name'];

    if (strlen($name) < 2) {
        $errors['name'] = 'Имя должно быть больше 2х символов' . "<pre>";
    }

} else {
    $errors['name'] = 'Имя должно быть заполнено' . "<pre>";
}

if(isset($_GET['email'])){
    $email = $_GET['email'];
    if (strlen($email) < 5) {
        $errors['email'] = 'Недопустимая длина электронной почты' . "<pre>";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $errors['email'] = 'Электронная почта введена некорректно' . "<pre>";
    }
} else {
    $errors['email'] = 'Электронная почта должна быть заполнена' . "<pre>";
}


if(isset($_GET['psw'])){
    $password = $_GET['psw'];
    if (strlen($password) < 3) {
        $errors['psw'] = 'Недопустимая длина пароля' . "<pre>";
    }
} else {
    $errors['psw'] = 'Пароль должен быть заполнен' . "<pre>";
}

if(isset($_GET['psw-repeat'])){
    $passwordRepeat = $_GET['psw-repeat'];
    if ($password !== $passwordRepeat) {
        $errors['psw-repeat'] = 'Введенные пароли не совпадают' . "<pre>";
    }
} else {
    $errors['psw-repeat'] = 'Повторный пароль должен быть заполнен' . "<pre>";
}


    if (empty($errors)) {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $password = $_GET['psw'];

        $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

        //метод prepare(подготовить) используется при вставке данных в наш запрос
        // без вставки данных мы используем метод execute(выполнить)

        $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");//процедура экранирования
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

        $statement = $pdo->query("SELECT * FROM users ORDER BY id DESC LIMIT 1"); // запрос на выдачу данных

        $data = $statement->fetch(); // cетевой запрос на сервер
        print_r($data);

    }


    require_once './registration_form.php';











