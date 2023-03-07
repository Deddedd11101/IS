<?php
include '../config/connect.php';


$title = $_POST['title'];
$fio = $_POST['fio'];
$num = $_POST['num'];
$scope = $_POST['scope'];
mysqli_query(connectToDB(), "INSERT INTO `OTDEL` ( `TITLE`, `F.I.O`, `NUM`, `SCOPE`) VALUES ('$title', '$fio', '$num', '$scope')");

mysqli_query(connectToDB(),"UPDATE `OTDEL` SET `ID`= MOD(OTDEL.ID, 10) WHERE OTDEL.TITLE = '$title';");
header('Location: otdel.php');