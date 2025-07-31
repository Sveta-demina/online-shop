<form action="/add-product" method = "POST">
    <div class="container">
        <a href="/catalog">перейти в каталог товаров</a><pre>
        <a href="/cart">перейти в Мою корзину</a><pre>
        <h1>Add product</h1>
        <hr>

        <label for="product_id"><b>Product_id</b></label>
        <?php if (isset($errors['product_id'])): ?>
            <label style="color: red"> <?php echo $errors['product_id'];?> </label>
        <?php endif; ?>
        <input type="text" placeholder="Enter Product_id" name="product_id" id="product_id" required>

        <label for="amount"><b>Amount</b></label>
        <?php if (isset($errors['amount'])): ?>
            <label style="color: red"> <?php echo $errors['amount'];?> </label>
        <?php endif; ?>
        <input type="text" placeholder="Enter amount" name="amount" id="amount" required>

        <hr>

        <button type="submit" class="registerbtn">Add product</button>
    </div>

</form>




<style>

    * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: coral;
        color: #f1f1f1;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }

</style>
