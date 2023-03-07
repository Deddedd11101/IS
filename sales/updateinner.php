<?php

include '../config/connect.php';

$article = $_POST['prod_title'];
$id = $_POST['id'];
$date = $_POST['date'];
$count = $_POST['count'];
$otdelsid = $_POST['otdel'];
print_r($article);
print_r($id);
print_r($date);
print_r($count);
print_r($otdelsid);


mysqli_query(connectToDB(), "UPDATE `SALE` SET `ARTICLE` = '$article', `DATE` = '$date', `OTDEL` = '$otdelsid', `COUNT` = '$count' WHERE `SALE`.`ID` = '$id'");
header('Location: sales.php');