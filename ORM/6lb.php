<?php
session_start();
require_once 'rb-mysql.php';
//include '../config/connect.php';
R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}

$header = "<table class='table''> <thead>
<tr>
<th> Наименование товара </th>
<th> Единица измерения </th>
<th> Цена розничная, тыс. руб. </th>
<th> Дата продажи </th>
</tr>
</thead>";


$firstdate = $_GET['firstdate'];
$seconddate = $_GET['seconddate'];

$mysqli = new mysqli('localhost', 'root', '', 'Torgovl');

$mysqli->query("SET @p0='$firstdate'");
$mysqli->query("SET @p1='$seconddate'");

$q = $mysqli->query("CALL betwen(@p0, @p1)");
$res = mysqli_fetch_all($q);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="REPORT/report.css">
    <title>Document</title>
</head>
<body>
<div class = "container1">
    <div id = "header">
        <div class = "insideheader1">
            <h1>Товары проданные с <?=$firstdate?> по <?=$seconddate?></h1>
        </div>
        <div class = "insideheader2">
            <button class="back" type="button" onclick="window.location.href = 'main.php'">&#11013</button>
        </div>
    </div>
    <div>
        <?php

        echo $header;

        foreach ($res as $r) {

            echo "<tr>
<td>$r[1]</td>
<td>$r[2]</td>
<td>$r[3]</td>
<td>$r[7]</td>
</tr>";
        }
        ?>
    </div>
</div>
</body>
</html>
