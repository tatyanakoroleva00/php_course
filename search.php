<?php

require_once 'functions.php';
require_once 'init.php';
require_once 'categories.php';
require_once 'vendor/autoload.php';

print_r($_GET);
if (isset($_GET['search'])) {

    $searchQuery = $_GET['search'];

    $sql = "SELECT *
    FROM lot
    WHERE MATCH(`name`, `lot_message`) AGAINST('$searchQuery') AND
    `lot_date` > NOW()";

    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $search_array = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $page_content = include_template('search.php', [
            'search_array' => $search_array,
        ]);


    } else {
        echo "Ничего не найдено по вашему запросу!";
        $page_content = '<h1>Ничего не найдено по вашему запросу!</h1>';
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




