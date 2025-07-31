<?php
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $pdo = new PDO('pgsql:host=db;port=5432;dbname=mydb', 'user', 'pass');
    $stmt = $pdo->query("SELECT * FROM users WHERE id = '$userId'");
    $user = $stmt->fetch();
} else {
    header("Location: ./login");
}
?>


<body>
<div class="container">
    <h1>Редактирование профиля</h1>
    <form action="/edit" method="POST">
        <label for="name">Имя:</label>
        <?php if (isset($errors['name'])): ?>
            <label style="color: red"> <?php echo $errors['name'];?> </label>
        <?php endif; ?>
        <input type="text" id="name" name="name" value = "<?php echo $user['name'];?>"> <br><br>

        <label for="email">Email:</label>
        <?php if (isset($errors['email'])): ?>
            <label style="color: red"> <?php echo $errors['email'];?> </label>
        <?php endif; ?>
        <input type="email" id="email" name="email"value = "<?php echo $user['email'];?>"><br><br>

        <button type="submit">Сохранить изменения</button>
    </form>
</div>
</body>


<style>
    .container {
        width: 500px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Добавляет padding в ширину элемента */
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>