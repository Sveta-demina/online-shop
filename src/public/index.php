<?php

//echo "<pre>";
//print_r($_SERVER);
//echo "<pre>";

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/registration') {
    require_once './classes/user.php';
    $user = new User();
    if($requestMethod === 'GET') {
        require_once './html/registration_form.php';
    } elseif ($requestMethod === 'POST') {
        $user->registrate();
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} elseif ($requestUri === '/login') {
    require_once './classes/user.php';
    $user = new User();
    if ($requestMethod === 'GET') {
        require_once './html/login_form.php';
    } elseif ($requestMethod === 'POST') {
        $user->avtorization();
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }
} elseif ($requestUri === '/catalog') {
    require_once './classes/product.php';
    $product = new Product();
    if ($requestMethod === 'GET') {
        $product->getProducts();
    } elseif ($requestMethod === 'POST') {
        require_once './html/catalog_page.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} elseif ($requestUri === '/profile') {
    require_once './classes/user.php';
    $user = new User();
    if ($requestMethod === 'GET') {
        $user->profile();
    } elseif ($requestMethod === 'POST') {
        //$user->profile();
        require_once './html/profile_page.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} elseif ($requestUri === '/edit') {
    require_once './classes/user.php';
    $user = new User();
    if ($requestMethod === 'GET') {
        require_once './html/edit_profile_page.php';
    } elseif ($requestMethod === 'POST') {
        $user->editProfile();
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается.";
    }

} elseif ($requestUri === '/add-product') {
    require_once './classes/product.php';
    $product = new Product();
    //if ($requestMethod === 'GET') {
    //    require_once './html/add_product_form.php';
     //   //require_once './html/catalog_page.php';
    //} else
    if ($requestMethod === 'POST') {
        $product->addProduct();
    }
   // } else {
     //   echo "$requestMethod для адреса $requestUri не поддерживается.";
   // }

} elseif ($requestUri === '/cart') {
    require_once './classes/cart.php';
    $cart = new Cart();
    if ($requestMethod === 'GET') {
        $cart->showCart();
   // } elseif ($requestMethod === 'POST') {
    //    require_once './html/cart_page.php';
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



