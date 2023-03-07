<?php
include '../config/connect.php';


$article = $_GET['article'];
$idotdel = $_GET['otdelid'];
$otdelname = $_GET['otdelname'];

$tovar = mysqli_query(connectToDB(),"SELECT * FROM TOVAR WHERE TOVAR.ID = '$article'");
$tovar = mysqli_fetch_assoc($tovar);

$otdelchek = mysqli_query(connectToDB(), "SELECT OTDEL.TITLE, OTDEL.ID FROM OTDEL;");
$otdelchek = mysqli_fetch_all($otdelchek);

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
<div class = "containerupdate">
    <div id="add">
        <form action="updateinner.php" method="post">
            <input type='hidden' value="<?=$tovar['ARTICLE']?>" name ="article" />
            <div class='input-with-label m-t26'>
                <label>Название товара</label>
                <input class="updating" type='text' value="<?=$tovar['PROD_TITLE']?>" name ="title" />
            </div>
            <div class='input-with-label m-t26'>
                <label>Ед. измерения</label>
                <input class="updating" type='text'  value="<?=$tovar['UNIT']?>" name ="unit"/>
            </div>
            <div class='input-with-label m-t26'>
                <label>Цена</label>
                <input class="updating" type='number' value="<?=$tovar['PRICE']?>"  name ="price"/>
            </div>
            <div class='input-with-label m-t26'>
                <label>Отдел</label>

                <select class = 'select' name='otdels'>
                    <?php
                    foreach ( $otdelchek as $res ) {
                        echo "<option value = $idotdel selected>$otdelname</option>";
                        echo "<option value = $res[1] >$res[0]</option>";
                    }
                    ?>
                </select>

            </div>
            <div class='input-with-label m-t25'>
                <button class = "btn" type="submit">Обновить</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>