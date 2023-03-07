<?php
include '../config/connect.php';
$article = $_GET['article'];
//print_r($article);
mysqli_query(connectToDB(),"DELETE FROM TOVAR WHERE `TOVAR`.`ID` = $article");
header('Location: tovary.php');