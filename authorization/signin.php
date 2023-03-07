<?php
session_start();
include '../config/connect.php';

$url = "https://www.google.com/recaptcha/api/siteverify";
$key = "6LfndekiAAAAADg1JGDsncIDzujSf4Ta3pzBxIWX";
$query = $url.'?secret='.$key.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR'];
$data = json_decode(file_get_contents($query));


            if (!($data->success))
                {
                  $_SESSION['CaptchaErr'] = "Вы робот?";
                  header('Location: ../index.php');
                }
            else
                {
                    $login = $_POST['login'];
                    $pass = $_POST['password'];
                    $password = md5($pass);
                    $check_user = mysqli_query(connectToDB(), "SELECT * FROM Users WHERE login = '$login' AND password = '$password';");

            if (mysqli_num_rows($check_user) > 0)
                {
                      $user = mysqli_fetch_assoc($check_user);
                                                            setcookie('login', $login, 0, '/');
                                                            setcookie('password', $pass, 0, '/');
                        $_SESSION['user'] = [
                            "login" => $user['login'],
                            "full_name" => $user['full_name'],
                            "avatar" => $user['avatar'],
                            "email" => $user['email'],
                            "status" => $user['Status']
                        ];

                              header('Location: ../profile.php');
                }
                    else
                    {
                        $_SESSION['SigninError'] = "Неверный логин или пароль";
                        header('Location: ../index.php');
                    }
}

