<?php
session_start();
if (!$_SESSION['user'])
{
    header('Location: index.php');
}
include '../config/connect.php';

$head = "<table class='table''> <thead>
<tr>
<th> Фото </th>
<th> ФИО </th>
<th> Почта </th>
<th> Логин </th>
<th> Статус </th>
<th> Повысить статус </th>
</tr>
</thead>";

$users = mysqli_query(connectToDB(), "SELECT `avatar`, `full_name`,`email`,`login`, `Status`, `id` FROM `Users` WHERE `Status` NOT IN ('Admin', 'Operator');");
$users = mysqli_fetch_all($users);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/users.css">
    <title>Пользователи</title>
</head>
<body>
<div class = "container1">
    <div id = "header">
        <div class = "insideheader1">
            <h1>Пользователи</h1>
        </div>
        <div class = "insideheader2">
            <button class="back" type="button" onclick="window.location.href = '../profile.php'">&#11013</button>
        </div>
    </div>
    <div>
        <?php
        echo $head;
        foreach($users as $o) {
            echo "<tr>
<td>
    <div class='img-area'>
            <div class='inner-area'>
                <img src='../$o[0]' alt=''>
    </div>
</div>
</td>
<td>$o[1]</td>
<td>$o[2]</td>
<td>$o[3]</td>
<td>$o[4]</td>
<td>

<a href='UserUpdate.php?id=$o[5]' class='change'>👍</a>
</td>
</tr>";
        }
        ?>
    </div>
</div>
</body>
</html>
