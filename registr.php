<?php
session_start();
    if ($_SESSION['user'])
    {
        header('Location: profile.php');
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="styles/auth.css">
    <title>Sign up</title>
</head>
<body>
<form action="authorization/signup.php" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="brand-title">Регистрация</div>
        <div class="inputs">
            <div class = "inputdate">
            <label>ФИО</label>
            <input required type="text" name = "full_name" placeholder="Введите полное имя" />
            </div>

            <div class = "inputdate">
            <label>Логин</label>
            <input required type="text" name = "login" placeholder="Придумайте логин" />
            </div>

            <div class = "inputdate">
            <label>Изображение профиля</label>
            </div>

            <div class = "inputdate">
            <input required class ="avatar"  name = "avatar" type="file"/>
            </div>

            <div class = "inputdate">
            <label>Почта</label>
            <input required type="email"  name = "mail" placeholder="Введите адрес своей почты" />
            </div>

            <div class = "inputdate">
            <label>Пароль</label>
            <input required type="password"  name = "password" placeholder="Минимум 3 символа" minlength="3"
                   maxlength="6"/>
            </div>

            <div class = "inputdate">
            <label>Подтверждение пароля</label>
            <input required type="password"  name = "password_confirm" placeholder="Подтвердите пароль" minlength="3"
                   maxlength="6"/>
            </div>
            <?php
            if ($_SESSION['pass_confirm'])
            {
                echo '<p class = "msg"> '. $_SESSION['pass_confirm']. '</p> ';
            }
            unset($_SESSION['pass_confirm']);
            ?>
            <?php
            if ($_SESSION['mail_valid'])
            {
                echo '<p class = "msg"> '. $_SESSION['mail_valid']. '</p> ';
            }
            unset($_SESSION['mail_valid']);
            ?>
            <?php
            if ($_SESSION['login_valid'])
            {
                echo '<p class = "msg"> '. $_SESSION['login_valid']. '</p> ';
            }
            unset($_SESSION['login_valid']);
            ?>
             <button type="submit">Зарегистрироваться</button>

            <div class = "reg">
                <a href="index.php">Уже есть аккаунт</a>
            </div>
        </div>
    </div>
</form>


</body>
</html>
