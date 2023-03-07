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
    <link rel="stylesheet" href="stylesales.css">

    <title>Document</title>
</head>
<body>


<!-- получение данных таблицы-->
<?php
$head = "<table class='table''> <thead>
<tr>
<th> Название товара </th>
<th> Дата </th>
<th> Отдел </th>
<th> Колличество </th>
<th> Обновить </th>
<th> Удалить </th>
</tr>
</thead>";
$sale = mysqli_query(connectToDB(), "SELECT SALE.ID, SALE.ARTICLE, TOVAR.PROD_TITLE, SALE.DATE, SALE.OTDEL, OTDEL.TITLE, SALE.COUNT FROM SALE, OTDEL, TOVAR WHERE SALE.OTDEL = OTDEL.ID AND SALE.ARTICLE = TOVAR.ARTICLE;");
$sale = mysqli_fetch_all($sale);

?>

<!-- получение доп данных -->
<?php
$tovar = mysqli_query(connectToDB(), "SELECT TOVAR.PROD_TITLE, TOVAR.ID,  OTDEL.ID FROM TOVAR, OTDEL WHERE TOVAR.ID = OTDEL.ID;");
$tovar = mysqli_fetch_all($tovar);
?>


<!-- вывод таблицы-->
<div class = "container1">
    <div id = "header">
        <div class = "insideheader1">
            <h1>Добавить продажу</h1>
        </div>
        <div class = "insideheader2">
            <button class="back" type="button" onclick="window.location.href = '../work/main.php'">&#11013</button>
        </div>
    </div>
    <div>
        <?php
        echo $head;
        foreach($sale as $o) {
            echo "<tr>
<td>$o[2]</td>
<td>$o[3]</td>
<td>$o[5]</td>
<td>$o[6]</td>
<td>
<a href='update.php?id=$o[0]&title=$o[2]&article=$o[1]' class='change'>↺</a>
</td>
<td>
<a href='delete.php?id=$o[0]' class='change'>🞩</a>
</td>
</tr>";
        }
        ?>
    </div>
</div>


<!--    форма добавления-->
<div>

    <div id="add">

        <form action="/sales/add.php" method="post">

            <div class='input-with-label m-t25'>
                <label>Товар</label>
                <select class = 'select' name='tovar'>
                    <?php
                    foreach ( $tovar as $res ) {
                        echo "<option value = $res[1]>$res[0]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class='input-with-label m-t25'>
                <label>Дата</label>
                <input type='date' placeholder='Enter the unit'  name ="date"/>
            </div>

            <div class='input-with-label m-t25'>
                <label>Колличество</label>
                <input type='number' placeholder='Enter the price'  name ="count"/>
            </div>


            <div class='input-with-label m-t25'>
                <button class = "btn" type="submit">Добавить</button>
            </div>

        </form>
    </div>
</div>


</body>
</html>
