<?php
function connectToDB()
{
    static $link;
    return !isset($link) ? $link = mysqli_connect('localhost', 'root', null, 'Torgovl') : $link;
}



