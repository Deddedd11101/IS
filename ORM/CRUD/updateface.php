<?php
require_once '../rb-mysql.php';

R::setup('mysql:host=localhost;dbname=Torgovl',
    'root', ''  );
if (!R::testConnection())
{
    echo "Error connection";
}
$idsale = $_GET['id'];
$article = $_GET['tovar'];
$idotdel = $_GET['otdel'];

$sale = R::dispense('sale');
$sale = R::load('sale', $idsale);

$tovar = R::dispense('tovar');

$tovarselected = R::load('tovar', $article);

$otdel = R::dispense('otdel');
$otdelselected = R::load('otdel', $idotdel);

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
<div class = "containerupdate">
    <div id="update">
        <form action="actions/updated.php" method="post">
            <input type='hidden' value="<?=$sale->id?>" name ="id" />
            <input type='hidden' value="<?=$sale->otdel?>" name ="otdel" />
            <div class='input-with-label m-t26'>
                <label>Товар</label>
                <select class = 'select' name='prod_title'>
                    <?php
                    echo "<option value = $tovarselected->id selected>$tovarselected->prodtitle</option>";
                    $numRows = R::count('tovar');
                    $art[] = 1;
                    for ($i=1; $i<=$numRows; $i++)
                    {
                        $art[$i] = $i;
                    }

                    $prodz = R::loadAll('tovar', $art);
                    foreach ($prodz as $p)
                    {
                        echo "<option value = $p->id>$p->prodtitle</option>";
                    }
                    ?>
                </select>
            </div>
            <div class='input-with-label m-t26'>
                <label>Дата</label>
                <input type='date'  value="<?=$sale->date?>" name ="date"/>
            </div>
            <div class='input-with-label m-t26'>
                <label>Количество</label>
                <input type='number' value="<?=$sale->count?>"  name ="count"/>
            </div>
            <div class='input-with-label m-t26'>
                <button class = "btn" type="submit">Обновить</button>
            </div>

        </form>
    </div>
</div>
</body>
</html>
