<body>
<div class="profile-container">
    <div class="profile-header">
        <img src="profile_picture.jpg" alt="Фото профиля" class="profile-picture">
        <div class="profile-info">
            <h1> ЛИЧНЫЙ КАБИНЕТ</h1>
        </div>
    </div>
    <div class="profile-details">
        <p><strong>Имя:</strong> <?php echo $profile['name'];?></p>
        <p><strong>Email:</strong><?php echo $profile['email'];?></p>
        <p><strong>Пароль:</strong><?php echo $profile['password'];?></p>
        <a href="/edit_profile.php">Редактировать</a>
    </div>
</div>
</body>

<style>
    .profile-container {
        width: 600px;
        margin: 20px auto;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 8px;
    }

    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-picture {
        width: 100px;
        height: 1 പോയിന്റ് size
        border-radius: 50%;
        margin-right: 20px;
    }

    .profile-info h1 {
        margin: 0;
        font-size: 24px;
    }

    .username {
        color: #777;
        font-size: 14px;
    }

    .profile-details {
        font-size: 16px;
    }

    .profile-details p {
        margin-bottom: 10px;
    }
</style>
