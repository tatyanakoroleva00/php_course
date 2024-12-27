<?php

require_once 'functions.php';
require_once 'init.php';
require_once 'categories.php';
require_once 'vendor/autoload.php';
session_start();
$searchQuery = '';

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    // Обрабатываем строку для безопасного вывода
    $searchQuery = htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8');
    $searchQuery = trim($searchQuery);
    // Удаляем все пробелы из строки
    $searchQuery = str_replace(' ', '', $searchQuery);

    if (empty($searchQuery)) {
        $page_content = '<h1>Вы ввели пустую строку! </h1>';
    }
    else {

        //ПАГИНАЦИЯ

        //1. Установка количества записей на странице
        $records_per_page = 9;

        //2. Определение текущей страницы
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        //3. Определение смещения для SQL-запроса
        $offset = ($page - 1) * $records_per_page;

        //4. Получение общего количества записей
        $total_sql = "
        SELECT COUNT(*)
        FROM lot
        WHERE (name LIKE '%$searchQuery%' OR lot_message LIKE '%$searchQuery%');";

        $result = mysqli_query($con, $total_sql);
        $row = mysqli_fetch_array($result);
        $total_records = $row[0];

        //5. Вычисление общего количества страниц
        $total_pages = ceil($total_records / $records_per_page);

        //6. Запрос для получения данных с учетом пагинации

        $sql = "SELECT *
            FROM lot
            WHERE (name LIKE '%$searchQuery%' OR lot_message LIKE '%$searchQuery%')
            ORDER BY lot_date ASC
            LIMIT $offset, $records_per_page;";

        $result2 = mysqli_query($con, $sql);

        if ($result2 && mysqli_num_rows($result2) > 0) {

            $search_array = mysqli_fetch_all($result2, MYSQLI_ASSOC);

            $page_content = include_template('search.php', [
                'search_array' => $search_array,
                'page' => $page,
                'totalPages' => $total_pages,
                'searchQuery' => $searchQuery,
            ]);

        } else {
            echo "Ничего не найдено по вашему запросу!";
            $page_content = '<h1>Ничего не найдено по вашему запросу!</h1>';
        }
    }
    $layout = include_template('layout.php', [
        'content' => $page_content,
        'categories' => $categories,
    ]);

    print_r($layout);
} else {
    $page_content = include_template('search.php', []);
    $layout = include_template('layout.php', [
        'content' => $page_content,
        'categories' => $categories,
    ]);
    print_r($layout);
}




