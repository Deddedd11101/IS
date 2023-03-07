<?php
include '../config/connect.php';


$id = $_GET['id'];
mysqli_query(connectToDB(),"DELETE FROM OTDEL WHERE `OTDEL`.`ID` = $id");
header('Location: otdel.php');