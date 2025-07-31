<body>
<div class="cart">
    <h1>Корзина</h1>
    <ul class="cart-items">
        <?php $sum = 0; ?>
        <?php foreach ($array as $key => $elem): ?>
            <li class="cart-item">
                <span class="item-name"><?php echo $elem['name'];?></span>
                <span class="item-quantity">
                <span class="quantity"><?php echo $elem['amount'] . 'шт.   ';?></span>
                <span class="quantity"><?php echo $elem['price'] . 'руб./шт.   ';?></span>
                <span class="quantity"><?php echo 'Итого:' . $sum1 = $elem['price'] * $elem['amount'] . 'руб.';?></span>
                </span>
            </li>
        <?php $sum += $elem['price'] * $elem['amount']; ?>
        <?php endforeach; ?>



    </ul>
    <div class="cart-total">
        Общая стоимость: <span class="total-amount"><?php echo $sum . 'руб.';?></span>
    </div>
</div>
</body>



<style>
    .cart {
        width: 400px;
        margin: 20px;
        padding: 10px;
        border: 1px solid #ccc;
    }

    .cart-items {
        list-style: none;
        padding: 0;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 0;
        border-bottom: 1px solid #eee;
    }

    .item-name {
        flex-grow: 1;
    }

    .item-quantity {
        display: flex;
        align-items: center;
    }

    .item-quantity button {
        margin: 0 5px;
    }

    .item-total {
        font-weight: bold;
    }

    .cart-total {
        margin-top: 10px;
        text-align: right;
        font-weight: bold;
    }
</style>
