<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'lots_list.php';
require_once 'functions.php';

$is_auth = rand(0, 1);
$user_avatar = 'https://images.unsplash.com/photo-1729512680463-bc583c395b61?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
$user_name = 'Tatiana'; // укажите здесь ваше имя
$title = 'Главная страница';

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$i = 0;

$page_content = include_template('index.php', [
   'categories' => $categories,
   'lots_list' => $lots_list,
    'formatted_data' => formattedData("20.10.2024")
]);

$layout_content = include_template('layout.php', [
    'title' => $title,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'content' => $page_content,
    'categories' => $categories,
    'is_auth' => $is_auth,
]);

print_r($layout_content);
