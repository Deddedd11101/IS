<?php
function dump($a)
{
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}
session_start();
require_once '../rb-mysql.php';
R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}
$head = "<table class='table''> <thead>
<tr>
<th> Название товара </th>
<th> Дата </th>
<th> Отдел </th>
<th> Количество </th>
<th> Обновить </th>
<th> Удалить </th>
</tr>
</thead>";


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylebean.css">
    <title>Document</title>
</head>
<body>




<!-- вывод таблицы-->
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
        $sales = R::dispense('sale');
        $count  = R::count('sale');
        $otdel = R::dispense('otdel');
        $prod = R::dispense('tovar');
        $c = R::getCol('SELECT `id` FROM sale');

        $sales = R::loadAll('sale', $c);


        echo $head;
        foreach ($sales as $s)
        {

            $article = $s->article;
            $prods = R::load('tovar', $article);
            $idotd = $prods->otdel;
            $otdels = R::load('otdel', $idotd);


            echo "<tr>
<td>$prods->prodtitle</td>
<td>$s->date</td>
<td>$otdels->title</td>
<td>$s->count</td>
<td>
<a href='updateface.php?id=$s->id&tovar=$article&otdel=$otdels->id' class='change'>↺</a>
</td>
<td>
<a href='delete.php?id=$s->id' class='change'>🞩</a>
</td>
</tr>";
        }
    ?>
    </div>
</div>




<!--    форма добавления-->

    <div id="add">

        <form action="add.php" method="post">

            <div class='input-with-label m-t25'>
                <label>Товар</label>
                <select class = 'select' name='tovar'>
                    <?php
                   $art = R::getCol('SELECT `id` FROM tovar' );

                    $prodz = R::loadAll('tovar', $art);
                    foreach ($prodz as $p)
                    {
                        echo "<option value = $p->id>$p->prodtitle</option>";
                    }

                    ?>
                </select>
            </div>
            <div class='input-with-label m-t25'>
                <label>Дата</label>
                <input type='date' placeholder='Enter the unit'  name ="date" required/>
            </div>

            <div class='input-with-label m-t25'>
                <label>Колличество</label>
                <input type='number' placeholder='Enter the price'  name ="count" required/>
            </div>


            <div class='input-with-label m-t25'>
                <button type="submit">Добавить</button>
            </div>

        </form>
    </div>
<?php
?>
</body>
</html>
