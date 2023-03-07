<?php
require_once '../rb-mysql.php';
R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}
$date = $_POST['date'];
$count = $_POST['count'];
$article = $_POST['tovar'];
$otdel = R::getCell( 'SELECT `otdel` FROM `tovar` WHERE `id` = ? LIMIT 1',[ $article ] );

$sale = R::dispense('sale');
$sale -> article = $article;
$sale -> date = $date;
$sale -> otdel = $otdel;
$sale -> count = $count;

R::store($sale);

header('Location: crudSALE.php');

