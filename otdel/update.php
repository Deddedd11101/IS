
<?php
include '../config/connect.php';


$idotdela = $_GET['id'];

$otdel = mysqli_query(connectToDB(),"SELECT * FROM OTDEL WHERE OTDEL.ID = '$idotdela'");
$otdel = mysqli_fetch_assoc($otdel);
//print_r($otdel);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylechange.css">
    <title>updateOTDEL</title>
</head>
<body>
<div class = "containerupdate">
    <div id="add">
        <form action="updateinner.php" method="post">
            <input type='hidden' value="<?=$otdel['ID']?>" name ="id" />
            <div class='input-with-label m-t26'>
                <label>Название отдела</label>
                <input type='text' placeholder='Enter the title' value="<?=$otdel['TITLE']?>" name ="title" />
            </div>
            <div class='input-with-label m-t26'>
                <label>ФИО</label>
                <input type='text' placeholder='Enter the fio'  value="<?=$otdel['F.I.O']?>" name ="fio"/>
            </div>
            <div class='input-with-label m-t26'>
                <label>Номер телефона</label>
                <input type='text' placeholder='Enter the phone number' value="<?=$otdel['NUM']?>"  name ="num"/>
            </div>
            <div class='input-with-label m-t26'>
                <label>Объем реализации</label>
                <input type='number' placeholder='Enter the scope' value="<?=$otdel['SCOPE']?>"  name ="scope"/>
            </div>
            <div class='input-with-label m-t26'>
                <button class = "btn" type="submit">Обновить</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>