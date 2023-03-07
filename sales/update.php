<?php
include '../config/connect.php';


$idsale = $_GET['id'];

$tovarname = $_GET['title'];
$article = $_GET['article'];

$sale = mysqli_query(connectToDB(),"SELECT * FROM SALE WHERE SALE.ID = '$idsale'");
$sale = mysqli_fetch_assoc($sale);


$otdel = mysqli_query(connectToDB(), "SELECT OTDEL.TITLE, OTDEL.ID FROM OTDEL;");
$otdel = mysqli_fetch_all($otdel);

$tovar = mysqli_query(connectToDB(), "SELECT TOVAR.PROD_TITLE, TOVAR.ID FROM TOVAR;");
$tovar = mysqli_fetch_all($tovar);

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
<div class = "containerupdate">
    <div id="update">
        <form action="updateinner.php" method="post">
            <input type='hidden' value="<?=$sale['ID']?>" name ="id" />
            <input type='hidden' value="<?=$sale['OTDEL']?>" name ="otdel" />
            <div class='input-with-label m-t26'>
                <label>Товар</label>
            <select class = 'select' name='prod_title'>
                <?php
                foreach ( $tovar as $res ) {
                    echo "<option value = $article selected>$tovarname</option>";
                    echo "<option value = $res[1]>$res[0]</option>";
                }
                ?>
            </select>
            </div>
            <div class='input-with-label m-t26'>
                <label>Дата</label>
                <input type='date'  value="<?=$sale['DATE']?>" name ="date"/>
            </div>
            <div class='input-with-label m-t26'>
                <label>Количество</label>
                <input type='number' value="<?=$sale['COUNT']?>"  name ="count"/>
            </div>
            <div class='input-with-label m-t26'>
                <button class = "btn" type="submit">Обновить</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
