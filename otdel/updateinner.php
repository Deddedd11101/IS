<?php

include '../config/connect.php';


$id = $_POST['id'];
$title = $_POST['title'];
$fio = $_POST['fio'];
$num = $_POST['num'];
$scope = $_POST['scope'];

mysqli_query(connectToDB(), "UPDATE `OTDEL` SET `TITLE` = '$title', `F.I.O` = '$fio', `NUM` = '$num', `SCOPE` = '$scope' WHERE `OTDEL`.`ID` = '$id'");
header('Location: otdel.php');
