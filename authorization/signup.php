<?php
session_start();
include '../config/connect.php';

 $full_name = $_POST['full_name'];
$login = $_POST['login'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];


$validmail = mysqli_query(connectToDB(), "SELECT * FROM `Users` WHERE `Users`.`email` = '$mail' AND `Users`.`login` = '$login'");
$validlogin = mysqli_query(connectToDB(), "SELECT * FROM `Users` WHERE `Users`.`login` = '$login'");


    if (mysqli_num_rows($validmail) > 0)
    {
        $_SESSION['mail_valid'] = "Почта уже используется";
        header('Location: ../registr.php');
    }

    elseif (mysqli_num_rows($validlogin) > 0)
    {
        $_SESSION['login_valid'] = "Логин уже занят";
        header('Location: ../registr.php');
    }
    else{



 if ($password === $password_confirm)
 {

     $path = 'uploads/' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'],'../'. $path ))
    {
        $_SESSION['error_message'] = "Ошибка при загрузке сообщения";
        header('Location: ../registr.php');
    }
    $password = md5($password);
    mysqli_query(connectToDB(), "INSERT INTO `Users` (`id`, `full_name`, `email`, `password`, `avatar`, `login`, `Status`) VALUES (NULL, '$full_name', '$mail', '$password', '$path', '$login', 'Guest')");

     $_SESSION['Success_reg'] = "Регистрация прошла успешно!";
     header('Location: ../index.php');
 }
 else
 {
$_SESSION['pass_confirm'] = "Пароли не совпадают";
header('Location: ../registr.php');
 }
    }