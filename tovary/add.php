<?php
include '../config/connect.php';


$title = $_POST['title'];
$unit = $_POST['unit'];
$price = $_POST['price'];
$otdelid = $_POST['otdels'];
print_r($title);
print_r($unit);
print_r($price);
print_r($otdelid);

mysqli_query(connectToDB(), "INSERT INTO `TOVAR` (`ID`, `PROD_TITLE`, `UNIT`, `PRICE`, `ID`) VALUES (NULL, '$title', '$unit', '$price', '$otdelid')");

header('Location: tovary.php');