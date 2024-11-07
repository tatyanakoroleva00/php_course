<?php

require_once 'functions.php';
require_once 'categories.php';
require_once 'lots_list.php';

session_start();
print_r($_GET);
print_r($_COOKIE);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $indexArr = [];
    foreach ($lots_list as $key => $value) {
        array_push($indexArr, $key);
    }
    //Проверка, есть ли такой айдишник в списке айдишников лотов

    if (in_array($id, $indexArr)) {
        $lot = $lots_list[$_GET['id']];

        $page_content = include_template('lot.php', [
            'lot_name' => $lot['name'],
            'lot_category' => $lot['category'],
//            'lot_price' => $lot['price'],
            'lot_url' => $lot['img_url'],
            'lot_message' => $lot['lot_message'],
            'lot_rate' => $lot['lot_rate'],
            'lot_step' => $lot['lot_step'],
            'cur_price' => formattedPrice($lot['cur_price']),
//            'lot_price' => formattedPrice($lot['price']),
            'formatted_data' => $expiration_date,
        ]);
    } else {
//    echo "ID не найден.";
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

//Для history.php - собираем индексы, чтобы потом отобразить на странице



//Стереть Cookies
//    setcookie('ids', implode(',', $ids), time() - 3600, '/'); // COOKIE будет действительна 1 час



//    // Инициализируем массив ids
//    $ids = [];
//
//    // Проверяем, существуют ли уже данные в COOKIE
//    if (isset($_COOKIE['ids'])) {
//        // Получаем текущие сохраненные id из COOKIE и преобразуем их в массив
//        $ids = explode(',', $_COOKIE['ids']);
//    }
//
//    // Проверяем, есть ли id в массиве
//    if (!in_array($id, $ids)) {
//        // Если id нет в массиве, добавляем его
//        $ids[] = $id;
//
//        // Обновляем COOKIE с новым списком id
//        setcookie('ids', implode(',', $ids), time() + 3600, '/'); // COOKIE будет действительна 1 час
//
////        echo "ID добавлен в COOKIE.";
//    } else {
////        echo "ID уже существует в COOKIE.";
//    }
