<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';
//$db = require_once 'config/db.php';

$con = mysqli_connect("localhost", "root", "", "schema");

if($con == false) {
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
} else {
    print("Соединение установлено");
}
mysqli_set_charset($con, "utf8");


