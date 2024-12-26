<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'init.php';
require_once 'functions.php';
//require_once 'categories.php';
require_once 'vendor/autoload.php';
session_start();
$title = 'Главная страница';

$i = 0;

# Сортировка лотов, начиная с тех, чей срок уже почти истек, до тех, у кого поздний срок.

$query = "SELECT lot.id, lot.name, lot_message, img_url, lot_rate, lot_date, lot_step, lot.price, cur_price, category.name AS category_name
        FROM `lot`
        JOIN category ON lot.category_id = category.id
        WHERE `lot_date` > NOW()
        ORDER BY lot_date ASC
        LIMIT 15";


$lots_list = mysqli_query($con, $query);

$query2 = "SELECT * FROM category";
$categories_query = mysqli_query($con, $query2);

$query3 = "SELECT lot.id, lot.name, lot_message, img_url, lot_rate, lot_date, lot_step, lot.price, cur_price, category.name AS category_name
        FROM `lot`
        JOIN category ON lot.category_id = category.id
        WHERE `lot_date` < NOW()
        ORDER BY lot_date ASC
        LIMIT 15";
$expired_lots = mysqli_query($con, $query3);


$page_content = include_template('index.php', [
   'categories_query' => $categories_query,
    'con' => $con,
    'lots_list' => $lots_list,
    'expired_lots' => $expired_lots,
]);

$layout_content = include_template('layout.php', [
    'title' => $title,
    'content' => $page_content,
//    'categories' => $categories,
    'categories_query' => $categories_query,
    'con' => $con,
]);

print_r($layout_content);
