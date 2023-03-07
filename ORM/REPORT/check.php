<?php
session_start();
require_once '../rb-mysql.php';
R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}
$fio = $_POST['fio'];
$radio= $_POST['sort'];

$header = "<table class='table''> <thead>
<tr>
<th> Наименование товара </th>
<th> Единица измерения </th>
<th> Цена розничная, тыс. руб. </th>
<th> Количество продаж </th>
<th> Выручка, тыс. руб. </th>
</tr>
</thead>";

$month = $_GET['month'];
$year = $_GET['year'];
$month = !empty($_GET['month']) ? $_GET['month'] : 'all';
$year = !empty($_GET['year']) ? $_GET['year'] : 'all';


$sale = R::dispense('sale');
$tovar = R::dispense('tovar');
$otdel = R::dispense('otdel');
$zav = R::find('otdel', 'WHERE fio LIKE ? ', [ $fio ] );
print_r($zav);
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



        if ($month != 'all') {
            $res = R::findAll('sale', ' MONTH(date) = :month', [':month'=>$month]);
        }
        else {
            $res = R::findAll('sale');
        }
        echo $header;
        foreach ($res as $re) {
            $art = $re->id;
            $otdelId = $re->otdel;
            $tovarz = R::load('tovar', $art);
            $otdelz = R::load('otdel', $otdelId);
            $cout = $re->count;
            $price = $tovarz->price;
            $viruc = $cout*$price;
            echo "<tr>
<td>$tovarz->prodtitle</td>
<td>$tovarz->unit</td>
<td>$tovarz->price</td>
<td>$re->count</td>
<td>$viruc</td>
</tr>";
        }
        ?>
    </div>
</div>




<!--    форма добавления-->

<div id="add">

    <form action="check.php" method="post">

        <div class='input-with-label m-t25'>
            <label>Заведующий отдела</label>
            <select class = 'select' name='fio'>
                <?php
                $count = R::count('otdel');
                $ids[]= 1;
                for ($i = 1 ;$i<=$count;$i++)
                {
                    $ids[$i]=$i;
                }
                $zav = R::loadAll('otdel', $ids);
                foreach ($zav as $p)
                {
                    echo "<option value = $p->id>$p->fio</option>";
                }
                ?>
            </select>
        </div>
        <div class='input-radio'>
            <label>По возрастанию</label>
            <input class="radio" name="sort" type="radio" value="ASC"/>
        </div>
        <div class='input-radio'>
            <label>По убыванию</label>
            <input class="radio" name="sort" type="radio" checked value="DESC"/>
        </div>
        <?php


        ?>
        <div class='input-with-label m-t25'>
            <button type="submit">Найти</button>
        </div>

    </form>
</div>

</body>
</html>

