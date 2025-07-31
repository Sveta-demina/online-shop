<div class="container">
    <a href="/profile">МОЙ ПРОФИЛЬ</a><pre>
    <a href="/cart">МОЯ КОРЗИНА</a>
    <h3>КАТАЛОГ ТОВАРОВ</h3>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
            <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                        НОВИНКА!
                    </div>
                    <img class="card-img-top" src="<?php echo $product['image_url'];?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $product['name'];?></p>
                        <a href="#"><h5 class="card-title"><?php echo $product['description'];?></h5></a>
                        <div class="card-footer">
                            <?php echo $product['price'] . 'руб.';?>
                        </div>
                    </div>

                </a>
            </div>
            <form action="/add-product" method = "POST">
    <div class="container">
        <input type="hidden" placeholder="Enter Product_id" name="product_id" value = '<?php echo $product['id'];?>' id="product_id" required>

        <label for="amount"><b>Добавить</b></label>
        <?php if (isset($errors['amount'])): ?>
            <label style="color: red"> <?php echo $errors['amount'];?> </label>
        <?php endif; ?>
        <input type="text" placeholder="Enter amount" name="amount" id="amount" required>

        <hr>

        <button type="submit" class="registerbtn">Добавить в корзину</button>
    </div>

</form>

        <?php endforeach; ?>



        <style>
            body {
                font-style: normal;
            }

            a {
                text-decoration: none;
            }

            a:hover {
                text-decoration: none;
            }

            h3 {
                line-height: 3em;
            }

            .card {
                max-width: 16rem;
            }

            .card:hover {
                box-shadow: 1px 2px 10px lightgray;
                transition: 0.2s;
            }

            .card-header {
                font-size: 13px;
                color: gray;
                background-color: white;
            }

            .text-muted {
                font-size: 11px;
            }

            .card-footer{
                font-weight: bold;
                font-size: 18px;
                background-color: white;
            }

        </style>
