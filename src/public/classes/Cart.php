<?php

class Cart
{

    public function showCart(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("Location: /login");
            exit();
        } else {
            $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
            $userId = $_SESSION['user_id'];
            $stmt = $pdo->query("SELECT product_id, amount FROM user_products WHERE user_id = '$userId'");
            $data = $stmt->fetchAll();

            $array = [];
            foreach ($data as $key => $value) {
                $productId = $value['product_id'];
                $amount = $value['amount'];

                $stmt = $pdo->query("SELECT name, price FROM products WHERE id = '$productId'");
                $products = $stmt->fetch();
                $products['amount'] = $amount;
                $array[]= $products;
            }
            echo "<pre>";
            print_r($array);
            echo "<pre>";
            require_once './html/cart_page.php';
        }

        //$stmt = $pdo->query("SELECT * FROM user_products INNER JOIN products ON user_products.product_id = products.id");
        //$card = $stmt->fetchAll();

        //echo "<pre>";
        //print_r($card);
        //echo "<pre>";
    }
}