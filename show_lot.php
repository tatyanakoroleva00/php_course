<?php

require_once 'functions.php';
require_once 'categories.php';
require_once 'init.php';

session_start();

if (isset($_GET['id'])) {
    $lot_id = $_GET['id'];

    //**Добавление лотов в favourites для показа на странице history.php**
    // Проверяем, существует ли массив избранных лотов в сессии
    if(!isset($_SESSION['favourite_lots'])) {
        $_SESSION['favourite_lots'] = [];
    }

    // Добавляем текущий лот в массив избранных, если его там еще нет
    if(!in_array($lot_id, $_SESSION['favourite_lots'])) {
        $_SESSION['favourite_lots'][] = $lot_id;
    }

    // Здесь можно вывести информацию о лоте
//    echo "<p>Вы просматриваете лот с ID: $lot_id</p>";

    //Делаем запрос в БД, ищем лот по id
    $query = "SELECT lot.id, lot.name, lot_message, img_url, lot_rate, lot_date, lot_step, lot.price, cur_price, category.name AS category_name
        FROM `lot`
        JOIN category ON lot.category_id = category.id
        WHERE lot.id = '$lot_id'";

    $chosen_lot = mysqli_query($con, $query);

    if($chosen_lot  && mysqli_num_rows($chosen_lot) > 0) {

        $name = ''; $lot_message = ''; $img_url = ''; $lot_rate = ''; $lot_date = ''; $lot_step = ''; $price = ''; $cur_price = ''; $category_name = '';

        foreach($chosen_lot  as $row => $elem) {
            $lot_name = $elem['name'];
            $lot_message = $elem['id'];
            $img_url = $elem['img_url'];
            $lot_rate = $elem['lot_rate'];
            $lot_date = $elem['lot_date'];
            $lot_step = $elem['lot_step'];
            $price = $elem['price'];
            $cur_price = $elem['cur_price'];
            $category_name = $elem['category_name'];
        }

        $page_content = include_template('lot.php', [
            'chosen_lot' => $chosen_lot,
            'lot_name' => $lot_name,
            'message' => $lot_message,
            'img_url' => $img_url,
            'lot_date' => $lot_date,
            'lot_rate' => $lot_rate,
            'lot_step' => $lot_step,
            'price' => $price,
            'cur_price' => $cur_price,
            'category_name' => $category_name
        ]);

    } else {
//        echo "Ошибка добавления лота: " . mysqli_error($con);
        http_response_code(404);
        $page_content = '<h1>Ошибка 404: Страница не найдена</h1>';
    }
    }

//Нет запроса на поиск лота по айди
else {
    http_response_code(404);
    $page_content = '<h1>Ошибка 404: Страница не найдена</h1>';
}

$layout_content = include_template('layout.php', [
    'title' => 'Лот',
    'content' => $page_content,
    'categories' => $categories,
]);

print_r($layout_content);
