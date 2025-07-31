<?php

class Product
{
    public function getProducts(){

        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header("Location: /login");
        } else {
            $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
            $stmt = $pdo->query( 'SELECT * FROM products');
            $products = $stmt->fetchAll();
            require_once './html/catalog_page.php';
        }
//авторизация - это процесс проверки прав доступа для пользователя
    }


    public function addProduct(){

        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        if (!isset($_SESSION['user_id'])){
            header("Location: /login");
            exit();
        }// проверка наличия пользователя

        $errors = $this->isValideAddProduct($_POST);

        if(empty($errors)){
            $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');

            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'];
            $amount = $_POST['amount'];

            $stmt = $pdo->prepare( "SELECT * FROM user_products WHERE user_id = :userId AND product_id = :productId");
            $stmt->execute(['userId' => $userId, 'productId' => $productId]);
            $userInfo = $stmt->fetch();

            if($userInfo === false) {
                $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:userId, :productId, :amount)");
                $stmt->execute(['userId' => $userId, 'productId' => $productId, 'amount' => $amount]);
            } else {
                $amount = $userInfo['amount'] + $amount;
                $stmt = $pdo->prepare("UPDATE user_products SET amount = :amount WHERE user_id = :userId AND product_id = :productId");
                $stmt->execute(['amount' => $amount, 'userId' => $userId, 'productId' => $productId]);//пресхолдер
            }
        } else {
            print_r($errors);
        }
        header("Location: /catalog");
    }



    private function isValideAddProduct(array $data): array
    {
        $errors = [];
         //if (!isset($data['product_id'])) {
         //  $errors['product_id'] = 'Product_id должен быть заполнен' . "<pre>";
        // } else {
         //    $productId = (int) $data['product_id'];
         //    $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
         //    $stmt = $pdo->prepare("SELECT * FROM products WHERE id =:productId");
         //    $stmt->execute(['productId' => $productId]);
         //    $data = $stmt->fetch();

         //    if ($data === false) {
          //      $errors['product_id'] = "Продукт не найден!";
          //   }
        // }

        if (!isset($data['amount'])) {
            $errors['amount'] = 'Amount должен быть заполнен' . "<pre>";
        } else {
            $amount = (int)$data['amount'];
            if ($amount <= 0 or $amount > 100) {
                $errors['amount'] = 'Количество в поле Amount должно быть от 1 до 100' . "<pre>";
            }
        }
        return $errors;
    }
}