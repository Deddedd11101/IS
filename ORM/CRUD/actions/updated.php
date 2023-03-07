<?php
require_once '../../rb-mysql.php';

R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}
$idSale = $_POST['id'];
$prodArt = $_POST['prod_title'];
$date = $_POST['date'];
$count = $_POST['count'];
$idOtdel = $_POST['otdelid'];

$tovar = R::dispense('tovar');
$tovar = R::load('tovar', $prodArt);
$article = $tovar->id;





$sale = R::dispense('sale');
$sale= R::load('sale', $idSale);
$sale->date = $date;
$sale->count = $count;
$sale->article = $article;
R::store($sale);
header('Location: ../crudSALE.php');

