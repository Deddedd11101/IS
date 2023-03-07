<?php
include '../config/connect.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../config/style.css">
    <title>Report</title>
</head>
<body>
<div class="container_create">
    <?php
    $header = "<table class='table''> <thead>
<tr>
<th> Наименование товара </th>
<th> Единица измерения </th>
<th> Цена розничная, тыс. руб. </th>
<th> Количество товара </th>
<th> Выручка, тыс. руб. </th>
</tr>
</thead>";
    $month = !empty($_GET['month']) ? $_GET['month'] : 'all';
    $year = !empty($_GET['year']) ? $_GET['year'] : 'all';
    $query = ("SELECT  OTDEL.TITLE AS otdel, TOVAR.PROD_TITLE AS tovar, TOVAR.UNIT AS unit, TOVAR.PRICE AS price, SALE.DATE AS date, SALE.COUNT AS count, (SALE.COUNT * TOVAR.PRICE) AS sum 
     FROM TOVAR, OTDEL, SALE
     WHERE TOVAR.ID = SALE.ARTICLE AND SALE.OTDEL = OTDEL.ID");
    $date = "Выручка от продажи товаров за ";
    if ($month == 'all' and $year == 'all')
    {
        $date .= " всё время.";

    }
    if ($month != 'all')
    {
        $query .= " AND MONTH(SALE.DATE) = '$month'";
        $date .= " $month месяц ";
    }
    if ($year != 'all')
    {
        $query .= " AND YEAR(SALE.DATE) = '$year'";
        $date .= " $year года";
    }
    ?>
    <div class="center-div">
        <h1><?=$date?></h1>
    </div>
    <?php
            $result = mysqli_query(connectToDB(), $query);
            $result = mysqli_fetch_all($result);
    $query_for_count = "SELECT COUNT(OTDEL.ID) FROM OTDEL;";
    $result1 = mysqli_query(connectToDB(), $query_for_count);
    $row=mysqli_fetch_array($result1);
    $count_of_departments = $row[0];
    $shop = 0;
                 for ($i = 0; $i <= $count_of_departments; $i++) {
                     $sumotdel = 0;

                         $new_query = $query . " AND OTDEL.ID = '$i';";
                         $result = mysqli_query(connectToDB(), $new_query);

            if (!$result) {
            printf("Ошибка запроса к базе данных: %s\n", mysqli_error(connectToDB()));
            exit();
        }



                     if (mysqli_num_rows($result) != 0)
                     {
                         echo '<div class="container_table">';
                         echo $header;
            while ($row = mysqli_fetch_array($result))
            {


                    $param1 = $row['tovar'];
                    $param2 = $row['unit'];
                    $param3 = $row['price'];
                    $param4 = $row['count'];
                    $param5 = $row['sum'];

                    $sumotdel += $param5;
                    $title = $row['otdel'];
                    echo "<tr><td>$param1</td><td>$param2</td><td>$param3</td><td>$param4</td><td>$param5</td></tr>";


            }
                         echo "</table>";
                         echo "<hr/>";
                         echo "<h2>Отдел: $title</h2>";
                         echo "<h2>Итого по отделу: $sumotdel</h2>";
                         echo '</div>';
                         $shop += $sumotdel;
                     }

        }
    ?>

       <hr id = 'line'/>
    <div id = 'footer'>
        <h2>Итого по магазину: <?=$shop?></h2>
        <button class="back" type="button" onclick="javascript:history.back()">&#11013</button>
    </div>
</div>
</body>
</html>
