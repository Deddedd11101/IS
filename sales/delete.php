<?php
include '../config/connect.php';
$id = $_GET['id'];
//print_r($id);

mysqli_query(connectToDB(),"DELETE FROM SALE WHERE `SALE`.`ID` = $id");

header('Location: sales.php');