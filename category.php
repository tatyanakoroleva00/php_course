<?php
require_once 'functions.php';
require_once 'categories.php';
require_once 'init.php';


if(isset($_GET['category'])) {
    print_r($_GET);
    $category = $_GET['category']; #English

    $sql = "SELECT name FROM category WHERE name_eng = '$category';";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
        $category_name = mysqli_fetch_assoc($query);
        $category_name = $category_name['name'];
        $title = "Все лоты в категории " . '"' . "$category_name" . '"';
}

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
        JOIN category ON lot.category_id = category.id
        WHERE category.name = '$category_name'";

    $result = mysqli_query($con, $total_sql);
    $row = mysqli_fetch_array($result);
    $total_records = $row[0];

    //5. Вычисление общего количества страниц
    $total_pages = ceil($total_records / $records_per_page);

    //6. Запрос для получения данных с учетом пагинации

    $lots = "SELECT *
    FROM lot
    JOIN category ON lot.category_id = category.id
    WHERE category.name = '$category_name'
    ORDER BY lot.created_at DESC
    LIMIT $offset, $records_per_page;";

    $query2 = mysqli_query($con, $lots);

    if ($query2 && mysqli_num_rows($query2) > 0) {

        $search_array = mysqli_fetch_all($query2, MYSQLI_ASSOC);

        $page_content = include_template('category.php', [
            'title' => $title,
            'lots_list' => $query2,
            'search_array' => $search_array,
            'page' => $page,
            'totalPages' => $total_pages,
            'category' => $category,
        ]);
    }
    else {
        $page_content = '<h1>Нет товаров в данной категории</h1>';
    }


} else {
    $page_content = '<h1>Категория не выбрана</h1>';
}
$layout_content = include_template('layout.php', [
    'title' => $title,
    'content' => $page_content,
    'categories' => $categories,
]);

print_r($layout_content);


