<?php
include '../config/connect.php';


$article = $_POST['article'];
$prod_title = $_POST['title'];
$unit = $_POST['unit'];
$price = $_POST['price'];
$otdels = $_POST['otdels'];

mysqli_query(connectToDB(), "UPDATE `TOVAR` SET `PROD_TITLE` = '$prod_title', `UNIT` = '$unit', `PRICE` = '$price', `ID` = '$otdels' WHERE `TOVAR`.`ID` = '$article'");
header('Location: tovary.php');