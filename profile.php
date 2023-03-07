<?php
session_start();
if (!$_SESSION['user'])
{
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="styles/profile.css">
    <title>Профиль пользователя</title>
</head>
<body>

    <div class="wrapper">
        <div class="img-area">
            <div class="inner-area">
                <img src="<?=$_SESSION['user']['avatar']?>" alt="">
            </div>
        </div>
        <a href="authorization/logout.php" class="icon arrow"><i class="fas fa-arrow-left"></i></a>
        <div class="name"><?=$_SESSION['user']['full_name']?></div>
        <div class="about"><?=$_SESSION['user']['status']?></div>
        <div class="social-icons">
            <a href="#" class="fb"><?=$_SESSION['user']['email']?></a>
        </div>
        <div class="buttons">
            <?php
                    if ($_SESSION['user']['status'] == 'Admin')
        {
            $_SESSION['Admin'] = "Работа с БД";
            $_SESSION['Admin2'] = "Пользователи";
            $_SESSION['Admin3'] = "RedBean";
             echo '<a class ="manage" href="work/main.php"> ' . $_SESSION['Admin']. '</a> ';
                echo '<a class ="manage" href="work/UsersForAdmin.php"> '. $_SESSION['Admin2']. '</a> ';
            echo '<a class ="manage" href="ORM/main.php"> ' . $_SESSION['Admin3']. '</a> ';
        }

               if ($_SESSION['user']['status'] == 'Operator')
        {
            $_SESSION['Operator'] = "Работа с отчётами";
            echo '<a class ="manageop" href="work/Operator.php"> '. $_SESSION['Operator']. '</a> ';
        }

            if ($_SESSION['user']['status'] == 'Guest')
            {
                $_SESSION['Guest'] = "Вам не доступны действия";
                echo '<p class="guest"> '. $_SESSION['Guest']. '</p> ';
            }

            ?>
        </div>
    </div>

</body>
</html>