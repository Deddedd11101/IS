<?php
session_start();
require_once 'rb-mysql.php';
R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}
$otdel = R::dispense('otdel');
$month = R::getAll("SELECT DISTINCT MONTH(`date`) AS month FROM `sale`");
$year = R::getAll("SELECT DISTINCT YEAR(`date`) AS year FROM `sale`");

$sale = R::dispense('sale');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<div id = 'block_container'>
    <div id = "bloc1">
        <h1>Создание отчета</h1>

        <form action="REPORT/report.php" method="GET">
            <div class = 'field'>
                <?php
                echo "<select class='select' name = 'month'>";
                echo "<option  value = 'all' disabled  selected>Выберите месяц</option>";
                foreach ($month as $m)
                {
                    echo "<option  value =$m[month]>$m[month]</option>";
                }

                echo "</select>";
                ?>
            </div>

            <div class = 'field'>
                <?php
                echo "<select class='select' name = 'year'>";
                echo "<option  value = 'all' disabled  selected>Выберите год</option>";
                foreach ($year as $y)
                {
                    echo "<option  value =$y[year]   >$y[year]</option>";
                }

                echo "</select>";
                ?>
            </div>
            <div class = 'field'>
                <?php
                echo "<select class='select' name = 'fio'>";
                echo "<option  value = 'all' disabled  selected>Зав. отдела</option>";
                $c = R::getCol('SELECT `id` FROM otdel');

                $otdel = R::loadAll('otdel', $c);
                foreach ($otdel as $y)
                {
                    echo "<option  value =$y[id]   >$y[fio]</option>";
                }

                echo "</select>";
                ?>
            </div>
            <div class = 'field'>
                <?php
                echo "<select class='select' name = 'sort'>";
                echo "<option  value = 'ASC' selected>Возрастание</option>";
                    echo "<option  value ='DESC'>Убывание</option>";
                echo "</select>";
                ?>
            </div>
            <input id="btn" type="submit" name="submit" value="Создать отчёт"/>
        </form>
    </div>
    <div id = "bloc2">
        <h1>CRUD</h1>
        <form class="table" action="CRUD/crudSALE.php">
            <input id="btn" type="submit" name="submit" value="Продажи"/>
        </form>
        <form class="table" action="6lb.php" method="GET">
        <select class='select' name="firstdate">
            <?php
            $ids = R::getCol('SELECT `id` FROM sale');
            $date = R::loadAll('sale', $ids);
            foreach ( $date as $d) {
                echo "<option value = $d[date]>$d[date]</option>";
            }
            ?>
        </select>
            <select class='select' name="seconddate">
                <?php
                $ids = R::getCol('SELECT `id` FROM sale');
                $date = R::loadAll('sale', $ids);
                foreach ( $date as $d) {
                    echo "<option value = $d[date]>$d[date]</option>";
                }
                ?>
            </select>
            <input id="btn" type="submit" name="submit" value="что-то"/>
        </form>

        <form class="table" action="addition/one/1.php">
            <input id="btn" type="submit" name="submit" value="Доп1"/>
        </form>
        <form class="table" action="addition/2.php">
            <input id="btn" type="submit" name="submit" value="Доп2"/>
        </form>
    </div>
</div>
</body>
</html>
