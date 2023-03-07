<?php
include '../config/connect.php';

$id = $_GET['id'];


mysqli_query(connectToDB(), "UPDATE `Users` SET `Status` = 'Operator' WHERE `Users`.`id` = '$id'");

header('Location: UsersForAdmin.php');