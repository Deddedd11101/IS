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
    <title>Document</title>
</head>
<body>
<div id = 'block_container'>
    <div id = "bloc1">
        <h1>Создание отчета</h1>

        <form action="report.php" method="GET">
            <div class = 'field'>
                <?php
                $result = mysqli_query(connectToDB(), "SELECT DISTINCT MONTH(DATE) as month FROM SALE" );
                echo "<select class='select' name = 'month'>";
                echo "<option  value = 'all' disabled  selected>Выберите месяц</option>";
                $result=mysqli_fetch_all($result);
                foreach ( $result as $resul ) {
                    foreach ( $resul as $key => $value ) {
                        echo "<option value = $value>$value</option>";
                    }
                }
                echo "</select>";
                ?>
            </div>

            <div class = 'field'>
                <?php
                $result = mysqli_query(connectToDB(), "SELECT DISTINCT YEAR(DATE) as month FROM SALE" );
                echo "<select class='select' name = 'year'>";
                echo "<option  value = 'all' disabled  selected>Выберите год</option>";
                $result=mysqli_fetch_all($result);
                foreach ( $result as $resul ) {
                    foreach ( $resul as $key => $value ) {
                        echo "<option value = $value>$value</option>";
                    }
                }
                echo "</select>";
                ?>
            </div>
            <input id="btn" type="submit" name="submit" value="Создать отчёт"/>
        </form>
    </div>
    <div id = "bloc2">
        <h1>Изменение данных</h1>
        <form class="table" action="../otdel/otdel.php">
            <input id="btn" type="submit" name="submit" value="Отделы"/>
        </form>
        <form class="table" action="../tovary/tovary.php">
            <input id="btn" type="submit" name="submit" value="Товары"/>
        </form>
        <form class="table" action="../sales/sales.php">
            <input id="btn" type="submit" name="submit" value="Продажи"/>
        </form>
</div>
</div>
<button class="back" type="button" onclick="window.location.href = '../profile.php'">&#11013</button>
</body>
</html>
