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
    <link rel="stylesheet" href="stylechange.css">
    <title>Document</title>
</head>
<body>
<!-- получение данных -->
<?php
$head = "<table class='table''> <thead>
<tr>
<th> Название </th>
<th> ФИО </th>
<th> Номер </th>
<th> Объем реализации </th>
<th> Обновление </th>
<th> Удаление </th>
</tr>
</thead>";
$otdels = mysqli_query(connectToDB(), "SELECT * FROM OTDEL;");
$otdels = mysqli_fetch_all($otdels);
//echo "<pre>";
//print_r($otdels);
//echo "</pre>";
?>


<!-- вывод таблицы-->
<div class = "container1">
    <div id = "header">
        <div class = "insideheader1">
    <h1>Добавить отдел</h1>
        </div>
        <div class = "insideheader2">
        <button class="back" type="button" onclick="window.location.href = '../work/main.php'">&#11013</button>
        </div>
    </div>
    <div>
    <?php
    echo $head;
    foreach($otdels as $o) {
        $id = $o[0];
        echo "<tr>
<td>$o[1]</td>
<td>$o[2]</td>
<td>$o[3]</td>
<td>$o[4]</td>
<td>
<a href='update.php?id=$id' class='change'>↺</a>
</td>
<td>
<form>
<a href='delete.php?id=$id' class='change'>🞩</a>
</form>
 </div> 
</td>
</tr>";
    }
    ?>


<!--    форма добавления-->
    <div>

    <div id="add">
        <form action="/otdel/add.php" method="post">
            <div class='input-with-label m-t25'>
                <label>Название отдела</label>
                <input type='text' placeholder='Enter the title'  name ="title"/>
            </div>
            <div class='input-with-label m-t25'>
                <label>ФИО</label>
                <input type='text' placeholder='Enter the fio'  name ="fio"/>
            </div>
            <div class='input-with-label m-t25'>
                <label>Номер телефона</label>
                <input type='text' placeholder='Enter the phone number'  name ="num"/>
            </div>
            <div class='input-with-label m-t25'>
                <label>Объем реализации</label>
                <input type='number' placeholder='Enter the scope'  name ="scope"/>
            </div>
            <div class='input-with-label m-t25'>
            <button class = "btn" type="submit">Добавить</button>
            </div>
        </form>
    </div>
    </div>

</div>
</body>
</html>
