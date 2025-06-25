<?php

function isValidData(array $data): array
{
    $errors = [];

    if (isset($data['name'])){
        $name = $data['name'];
        if (strlen($name) < 2) {
            $errors['name'] = 'Имя должно быть больше 2х символов' . "<pre>";
        }
    } else {
        $errors['name'] = 'Имя должно быть заполнено' . "<pre>";
    }

    if (isset($data['email'])) {
        $email = $data['email'];
        if (strlen($email) < 5) {
            $errors['email'] = 'Недопустимая длина электронной почты' . "<pre>";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Электронная почта введена некорректно' . "<pre>";
        }
    } else {
        $errors['email'] = 'Электронная почта должна быть заполнена' . "<pre>";
    }


    if (isset($data['psw'])) {
        $password = $data['psw'];
        if (strlen($password) < 3) {
            $errors['psw'] = 'Недопустимая длина пароля' . "<pre>";
        }
    } else {
        $errors['psw'] = 'Пароль должен быть заполнен' . "<pre>";
    }

    if (isset($data['psw-repeat'])) {
        $passwordRepeat = $data['psw-repeat'];
        $password = $data['psw'];
        if ($password !== $passwordRepeat) {
            $errors['psw-repeat'] = 'Введенные пароли не совпадают' . "<pre>";
        }
    } else {
        $errors['psw-repeat'] = 'Повторный пароль должен быть заполнен' . "<pre>";
    }
    return $errors;
}






    $errors = isValidData($_POST);
    if (empty($errors)) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['psw'];
        $passwordRepeat = $_POST['psw-repeat'];

        $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
        $password = password_hash($password, PASSWORD_DEFAULT); // хэшифрование пароля - шифрование

        //метод prepare(подготовить) используется при вставке данных в наш запрос
        // без вставки данных мы используем метод execute(выполнить)

        $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");//процедура экранирования
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);

        $data1 = $statement->fetch();
        print_r($data1);
    } else {
        print_r($errors);
    }

require_once './registration_form.php';







