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
    <title>Sign in</title>
</head>
<body>
<form action="authorization/signin.php" method="post">
<div class="container">
    <div class="brand-title">Авторизация</div>
    <?php
                if ($_SESSION['Success_reg'])
                     {
                         echo '<p class = "msgSuccess"> '. $_SESSION['Success_reg']. '</p> ';
                     }
                         unset($_SESSION['Success_reg']);
    ?>
    <div class="inputs">
        <div class = "inputdate">
             <label>Логин</label>
                <input required type="text" name= "login" placeholder="Ваш логин" />
        </div>
        <div class = "inputdate">
            <label>Пароль</label>
                 <input required type="password" name= "password" placeholder="Ваш пароль" />
        </div>
        <?php
                 if ($_SESSION['SigninError'])
                     {
                         echo '<p class = "msg"> '. $_SESSION['SigninError']. '</p> ';
                     }
                         unset($_SESSION['SigninError']);
        ?>
        <br>
        <div class="g-recaptcha" data-sitekey="6LfndekiAAAAALTHbQTe7UjgqugS1LAknOu7vYqw"></div>
        <?php
        if ($_SESSION['CaptchaErr'])
        {
            echo '<p class = "msg"> '. $_SESSION['CaptchaErr']. '</p> ';
        }
        unset($_SESSION['CaptchaErr']);
        ?>
        <button type="submit">Войти</button>
        <div class = "reg">
        <a href="registr.php">зарегистрироваться</a>
        </div>
    </div>
</div>

</form>
</body>
</html>
