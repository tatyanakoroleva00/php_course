<?php
error_reporting(E_ALL & ~E_STRICT);

$is_auth = rand(0, 1);
$user_avatar = 'https://images.unsplash.com/photo-1729512680463-bc583c395b61?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
$user_name = 'Tatiana'; // укажите здесь ваше имя
$title = 'Главная страница';

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$i = 0;

$lots_list = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'img_url' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'img_url' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'img_url' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'img_url' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'img_url' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'img_url' => 'img/lot-6.jpg'
    ]
];

function formattedPrice($arg) {
    $rounded_number = ceil($arg);
    if ($rounded_number < 1000) return $rounded_number;
    elseif ($rounded_number > 1000) {
        return number_format($rounded_number, 0, ' ' , ' ');
    }
}


function formattedData($date) {
    date_default_timezone_set('Europe/Moscow');
    $cur_time = time();
    $finish_date = strtotime('tomorrow midnight');
    $left_time_in_seconds = $finish_date - $cur_time;
    $hours = floor($left_time_in_seconds / 3600);
    $minutes = floor(($left_time_in_seconds % 3600) / 60);
    print("{$hours}Ч : {$minutes}М");
}

include 'templates/layout.php';


