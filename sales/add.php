<?php

include '../config/connect.php';



$article = $_POST['tovar'];
$date = $_POST['date'];
$count = $_POST['count'];

$id = mysqli_query(connectToDB(), "SELECT OTDEL.ID FROM OTDEL, TOVAR WHERE OTDEL.ID = TOVAR.ID AND TOVAR.ID = '$article'");
$id = mysqli_fetch_array($id);
$row = $id[0];

mysqli_query(connectToDB(), "INSERT INTO `SALE`(`ID`, `DATE`, `OTDEL`, `COUNT`) VALUES ('$article','$date','$row','$count')");

header('Location: sales.php');
