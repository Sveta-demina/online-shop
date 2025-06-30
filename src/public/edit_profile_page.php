<body>
<div class="container">
    <h1>Редактирование профиля</h1>
    <form action="edit_profile.php" method="POST">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="psw"><br><br>

        <button type="submit">Сохранить изменения</button>
    </form>
    <a href="profile.php">Назад к профилю</a>
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