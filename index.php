<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'lots_list.php';
require_once 'functions.php';
require_once 'categories.php';

session_start();

$title = 'Главная страница';

$i = 0;

$page_content = include_template('index.php', [
   'categories' => $categories,
   'lots_list' => $lots_list,
    'formatted_data' => $expiration_date,
]);

$layout_content = include_template('layout.php', [
    'title' => $title,
    'content' => $page_content,
    'categories' => $categories,
]);

print_r($layout_content);
