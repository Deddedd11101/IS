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
    <link rel="stylesheet" href="styletovar.css">
    <title>Document</title>
</head>
<body>
<!-- получение данных таблицы-->
<?php
$head = "<table class='table''> <thead>
<tr>
<th> Название товара</th>
<th> Ед. измерения </th>
<th> Цена </th>
<th> Отдел </th>
<th> Обновить </th>
<th> Удалить </th>
</tr>
</thead>";
$tovar = mysqli_query(connectToDB(), "SELECT TOVAR.ID,TOVAR.PROD_TITLE,TOVAR.UNIT,TOVAR.PRICE, OTDEL.TITLE, OTDEL.ID FROM TOVAR, OTDEL WHERE TOVAR.ID = OTDEL.ID;");
$tovar = mysqli_fetch_all($tovar);
?>


<!-- получение доп данных-->
<?php
$otdel = mysqli_query(connectToDB(), "SELECT OTDEL.TITLE, OTDEL.ID FROM OTDEL;");
$otdel = mysqli_fetch_all($otdel);
?>


<!-- вывод таблицы-->
<div class = "container1">
    <div id = "header">
        <div class = "insideheader1">
            <h1>Добавить товар</h1>
        </div>
        <div class = "insideheader2">
            <button class="back" type="button" onclick="window.location.href = '../work/main.php'">&#11013</button>
        </div>
    </div>
    <div>
        <?php
        echo $head;
        foreach($tovar as $o) {
            echo "<tr>
<td>$o[1]</td>
<td>$o[2]</td>
<td>$o[3]</td>
<td>$o[4]</td>
<td>
<a  href='update.php?article=$o[0]&otdelname=$o[4]&otdelid=$o[5]' class='change'>↺</a>
</td>
<td>
<a href='delete.php?article=$o[0]' class='change'>🞩</a>
</td>
</tr>";
        }
        ?>
    </div>
</div>


<!--    форма добавления-->
<div>

    <div id="add">
        <form action="/tovary/add.php" method="post">
            <div class='input-with-label m-t25'>
                <label>Название товара</label>
                <input type='text' placeholder='Enter the title'  name ="title"/>
            </div>
            <div class='input-with-label m-t25'>
                <label>Ед. измерения</label>
                <input type='text' placeholder='Enter the unit'  name ="unit"/>
            </div>
            <div class='input-with-label m-t25'>
                <label>Цена</label>
                <input type='text' placeholder='Enter the price'  name ="price"/>
            </div>
            <div class='input-with-label m-t25'>
                <label>Отдел</label>
                <select class = 'select' name='otdels'>
                    <?php
                    foreach ( $otdel as $res ) {
                        echo "<option value = $res[1]>$res[0]</option>";
                    }
                    ?>
                </select>

            </div>
            <div class='input-with-label m-t25'>
                <button class = "btn" type="submit">Добавить</button>
            </div>

        </form>
    </div>
</div>


</body>
</html>
