<?php
session_start();
require_once '../rb-mysql.php';
R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}

$header = "<table class='table''> <thead>
<tr>
<th> Наименование товара </th>
<th> Единица измерения </th>
<th> Цена розничная, тыс. руб. </th>
<th> Количество продаж </th>
<th> Выручка, тыс. руб. </th>
<th> Зав. отдела </th>
</tr>
</thead>";

$month = $_GET['month'];
$year = $_GET['year'];
$fio = $_GET['fio'];
$sort= $_GET['sort'];

$month = !empty($_GET['month']) ? $_GET['month'] : 'all';
$year = !empty($_GET['year']) ? $_GET['year'] : 'all';
$fio = !empty($_GET['fio']) ? $_GET['fio'] : 'all';


$sale = R::dispense('sale');
$tovar = R::dispense('tovar');
$otdel = R::dispense('otdel');


$query = "SELECT * FROM sale WHERE count > 0";

$col = R::getCol('SELECT `id` FROM sale');

$res = R::loadAll('sale', $col);

if ($month != 'all')
{
    $query .=" AND MONTH(date) = '$month'";
}
if ($year !='all')
{
    $query .=" AND YEAR(date) = '$year'";
}
if ($fio !='all')
{
    $zav = R::load('otdel', $fio);
    $query .=" AND otdel = '$zav->id'";
}
if (!empty($sort))
{
    $query .= " ORDER BY count " . $sort;
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="report.css">
    <title>Document</title>
</head>
<body>

<div class = "container1">
    <div id = "header">
        <div class = "insideheader1">
            <h1>Продажи</h1>
        </div>
        <div class = "insideheader2">
            <button class="back" type="button" onclick="window.location.href = '../main.php'">&#11013</button>
        </div>
    </div>
    <div>
        <?php
        $res = R::getAll($query);

            echo $header;
            foreach ($res as $re) {
                $art = $re['id'];
                $otdelId = $re['otdel'];
                $tovarz = R::load('tovar', $art);
                $otdelz = R::load('otdel', $otdelId);
                    $cout = $re['count'];
                    $price = $tovarz->price;
                    $viruc = $cout*$price;
                echo "<tr>
<td>$tovarz->prodtitle</td>
<td>$tovarz->unit</td>
<td>$tovarz->price</td>
<td>$re[count]</td>
<td>$viruc</td>
<td>$otdelz->fio</td>
</tr>";
        }
        ?>
    </div>
</div>

</body>
</html>
