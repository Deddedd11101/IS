<?php
require_once '../rb-mysql.php';
R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}
else{
    echo "success";
}
$id = $_GET['id'];
print_r($id);
$row = R::dispense('sale');
$row= R::load('sale', $id);
R::trash($row);

header('Location: crudSALE.php');