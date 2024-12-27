<?php
require_once 'init.php';
require_once 'functions.php';
session_start();
$title = 'Главная страница';

$i = 0;

# -----------------ВСЕ КАТЕГОРИИ
$query2 = "SELECT * FROM category";
$categories_query = mysqli_query($con, $query2);




//-------------ВЫВОД ОСНОВНЫХ ЛОТОВ
// Определяем тип лотов для отображения
$showLots = isset($_GET['show']) && $_GET['show'] === 'old';

$type_of_lots_to_show = $_GET['show'];

//ПАГИНАЦИЯ

//1. Установка количества записей на странице
$records_per_page = 12;

//2. Определение текущей страницы
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//3. Определение смещения для SQL-запроса
$offset = ($page - 1) * $records_per_page;

# Количество страниц
if(!$showLots) {
    $totalSql= "SELECT COUNT(*)
        FROM lot
        JOIN category ON lot.category_id = category.id
        WHERE lot_date > NOW();";
} else {
    # Количество страниц
    $totalSql= "SELECT COUNT(*)
        FROM lot
        JOIN category ON lot.category_id = category.id
        WHERE lot_date < NOW();";
}
$result= mysqli_query($con, $totalSql);
if(!$result) {
    die('Ошибка выполнения запроса: ' . mysqli_error($con));
}
//Извлечение результата - количество записей
$row = mysqli_fetch_array($result);
$total_records = $row[0];

//5. Вычисление общего количества страниц
$total_pages = ceil($total_records / $records_per_page);

//6. Запрос для получения данных с учетом пагинации

if(!$showLots) {
# Сортировка лотов, начиная с тех, чей срок уже почти истек, до тех, у кого поздний срок.
    $query = "SELECT lot.id, lot.name, lot_message, img_url, lot_rate, lot_date, lot_step, lot.price, cur_price, category.name AS category_name
        FROM `lot`
        JOIN category ON lot.category_id = category.id
        WHERE `lot_date` > NOW()
        ORDER BY lot_date ASC
        LIMIT $offset, $records_per_page";
} else {
    # Закрытые лоты
    $query = "SELECT lot.id, lot.name, lot_message, img_url, lot_rate, lot_date, lot_step, lot.price, cur_price, category.name AS category_name
        FROM `lot`
        JOIN category ON lot.category_id = category.id
        WHERE `lot_date` < NOW()
        ORDER BY lot_date ASC
        LIMIT $offset, $records_per_page";
}
$lots_list = mysqli_query($con, $query);
if(!$lots_list) {
    die('Ошибка выполнения запроса: ' . mysqli_error($con));
}

$result2 = mysqli_query($con, $query);

if ($result2 && mysqli_num_rows($result2) > 0) {

    $search_array = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    $page_content = include_template('index.php', [
        'categories_query' => $categories_query,
        'con' => $con,
        'page' => $page,
        'lots_list' => $lots_list,
        'totalPages' => $total_pages,
        'type_of_lots_to_show' => $type_of_lots_to_show,
        'search_array' => $search_array,
    ]);

} else {
    echo "Ничего не найдено по вашему запросу!";
    $page_content = '<h1>Ничего не найдено по вашему запросу!</h1>';
}

$layout_content = include_template('layout.php', [
    'title' => $title,
    'content' => $page_content,
    'categories_query' => $categories_query,
    'con' => $con,
]);

print_r($layout_content);
