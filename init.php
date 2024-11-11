<?php
require_once 'functions.php';
//$db = require_once 'config/db.php';

$con = mysqli_connect("localhost", "root", "", "schema");

if($con == false) {
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    print("Соединение установлено");
}
mysqli_set_charset($con, "utf8");


//Example
//        $sql = "SELECT `id`, `name` from `category`;";
//        $result = mysqli_query($con, $sql);
//        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
//
//        foreach ($rows as $row) : ?>
    <!---->
    <!--        <li>--><?php //echo $row['name']; ?><!--</li>-->
    <!--        --><?php //endforeach;?>
