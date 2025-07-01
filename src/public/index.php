<?php

//echo "<pre>";
//print_r($_SERVER);
//echo "<pre>";

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/registration') {
    if($requestMethod === 'GET') {
        require_once './registration_form.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handle_registration_form.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} elseif ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        require_once './login_form.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handle_login.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }
} elseif ($requestUri === '/catalog') {
    if ($requestMethod === 'GET') {
        require_once './catalog.php';
    //} elseif ($requestMethod === 'POST') {
     //   require_once './catalog.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} elseif ($requestUri === '/profile') {
    if ($requestMethod === 'GET') {
        require_once './profile.php';
   // } elseif ($requestMethod === 'POST') {
    //    require_once './profile.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} elseif ($requestUri === '/edit') {
    if ($requestMethod === 'GET') {
        require_once './edit_profile_page.php';
    }  elseif ($requestMethod === 'POST') {
        require_once './edit_profile.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} else {
    http_response_code(404);
    require_once './404.php';
}


//$pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

//$pdo->exec("INSERT INTO users (name, email, password) VALUES ('Irina', 'Irina@gmail.com', 'qwerty123')");
//$statement = $pdo->query("SELECT * FROM users");
//$data = $statement->fetchAll();
//echo "<pre>";
//print_r($data);
//echo "<pre>";



