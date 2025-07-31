<?php

class User
{
    public function registrate()
    {
        $errors = $this->isValidRegistrate($_POST);
        if (empty($errors)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['psw'];
            $passwordRepeat = $_POST['psw-repeat'];

            $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
            $password = password_hash($password, PASSWORD_DEFAULT); // хэшифрование пароля - шифрование

            $statement = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");//процедура экранирования
            $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

            $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $statement->execute(['email' => $email]);
            //метод prepare(подготовить) используется при вставке данных в наш запрос
            // без вставки данных мы используем метод execute(выполнить)


            $data1 = $statement->fetch();
            print_r($data1);
        } else {
            print_r($errors);
        }
        require_once './html/registration_form.php';
    }


    private function isValidRegistrate(array $data): array
    {
        $errors = [];

        if (isset($data['name'])) {
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



    private function isValidAvtorization(array $data): array
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


    public function avtorization()
    {
        $errors = $this->isValidAvtorization($_POST);
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
        require_once './html/login_form.php';
    }

    public function profile()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        } else {
            $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
            $userId = $_SESSION['user_id'];
            $stmt = $pdo->query("SELECT * FROM users WHERE id = '$userId'");
            $profile = $stmt->fetch();
            require_once './html/profile_page.php';
        }
    }

    public function editProfile(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("Location: /login");
            exit;
        }

        $errors = $this->isValidEditProfile($_POST);

        if (empty($errors)) {
            $userId = $_SESSION['user_id'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt = $pdo->query("SELECT * FROM users WHERE id = '$userId'");
            $user = $stmt->fetch();

            if($user['name'] !== $name){
                $stmt = $pdo->prepare("UPDATE users SET name = :name WHERE id = '$userId'");
                $stmt->execute(['name' => $name]);
            }

            if($user['email'] !== $email){
                $stmt = $pdo->prepare("UPDATE users SET email = :email WHERE id = '$userId'");
                $stmt->execute(['email' => $email]);
            }
            header("Location: ./profile"); //редирект
            exit;
        } else {
            print_r($errors);
        }
        require_once './html/edit_profile_page.php';
    }

    private function isValidEditProfile(array $data): array
    {
        $errors = [];

        if (isset($data['name'])) {
            $name = $data['name'];
            if (strlen($name) < 2) {
                $errors['name'] = 'Имя должно быть больше 2х символов' . "<pre>";
            }
        }

        if (isset($data['email'])) {
            $email = $data['email'];
            if (strlen($email) < 5) {
                $errors['email'] = 'Недопустимая длина электронной почты' . "<pre>";
            } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Электронная почта введена некорректно' . "<pre>";
            } else {
                $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
                $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
                $statement->execute(['email' => $email]);
                $user = $statement->fetch();

                $userId = $_SESSION['user_id'];
                if ($user['id'] !== $userId) {
                    $errors['email'] = "Эта электронная почта уже зарегистрирована!";
                }
            }
        }
        return $errors;
    }

}

