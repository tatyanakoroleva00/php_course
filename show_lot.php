<?php

require_once 'functions.php';
require_once 'categories.php';
require_once 'init.php';
require_once 'vendor/autoload.php';

session_start();

if (isset($_GET['id'])) {
    $lot_id = $_GET['id'];

    //**Добавление лотов в favourites для показа на странице history.php**
    // Проверяем, существует ли массив избранных лотов в сессии
    if (!isset($_SESSION['favourite_lots'])) {
        $_SESSION['favourite_lots'] = [];
    }

    // Добавляем текущий лот в массив избранных, если его там еще нет
    if (!in_array($lot_id, $_SESSION['favourite_lots'])) {
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

    if ($chosen_lot && mysqli_num_rows($chosen_lot) > 0) {

        $name = '';
        $lot_message = '';
        $img_url = '';
        $lot_rate = '';
        $lot_date = '';
        $lot_step = '';
        $price = '';
        $cur_price = '';
        $category_name = '';

        foreach ($chosen_lot as $row => $elem) {
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

        if (isset($_POST['lot_rate'])) {
            $lot_rate = $_POST['lot_rate'];
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
            'category_name' => $category_name,
            'lot_id' => $lot_id,
        ]);

        if (isset($_POST['lot_rate'])) {
            $lot_rate = $_POST['lot_rate'];
            $query = "SELECT lot_rate, cur_price from lot WHERE id = '$lot_id'";
            $result = mysqli_query($con, $query);
            $cur_price = $lot_rate + $cur_price;

            if ($result && mysqli_num_rows($result) > 0 && $lot_rate > $lot_step) {
                $row = mysqli_fetch_assoc($result);
                $data = json_decode($row['lot_rate'], true);


                print_r($data);

                // Добавление нового значения
                if (!is_array($data)) {
                    $data = [];
                }
                $data[] = $lot_rate;

                // Обновление данных в базе
                $json_data = mysqli_real_escape_string($con, json_encode($data));

                $update_query = "UPDATE lot SET lot_rate = '$json_data', cur_price = '$cur_price' WHERE id = '$lot_id'";

                if (mysqli_query($con, $update_query)) {
                    echo "Данные успешно обновлены!";
                    header("Location: " . $_SERVER['REQUEST_URI']);exit;
                } else {
                    echo "Ошибка обновления: " . mysqli_error($con);
                }


            }

        }

    } else {
//        echo "Ошибка добавления лота: " . mysqli_error($con);
            http_response_code(404);
            $page_content = '<h1>Ошибка 404: Страница не найдена</h1>';
        }


}


    $layout_content = include_template('layout.php', [
        'title' => 'Лот',
        'content' => $page_content,
        'categories' => $categories,
    ]);

    print_r($layout_content);



