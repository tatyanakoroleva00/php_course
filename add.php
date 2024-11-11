<?php

require_once 'functions.php';
require_once 'lots_list.php';
require_once 'categories.php';
require_once 'init.php';

session_start();

$title = 'Добавить лот';
if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo "Доступ запрещен";
//    exit;
} else {

    //Если отправка совершена
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $lot = $_POST;
        print_r($lot);

        $required = ['lot_name', 'category', 'lot_message', 'img_url', 'cur_price', 'lot_step', 'lot_date'];
        $dict = [
            'lot_name' => 'Название лота',
            'category' => 'Категория',
            'lot_message' => 'Описание лота',
            'img_url' => 'Изображение',
            'cur_price' => 'Начальная цена',
            'lot_step' => 'Ставка',
            'lot_date' => 'Дата завершения торгов'];
        $errors = [];

        $cur_price = formattedPrice($_POST['cur_price']);
        $lot_date = formattedDate($lot['lot_date']);

        //Проверка на наличие пустых полей - и где конкретно.
        foreach ($_POST as $key => $value) {
            if (in_array($key, $required)) {
                if (!$value) {
                    $errors[$key] = 'Это поле надо заполнить!';
                }
            }
        }
        //Картинка. Если есть картинка и нет ошибок - помещаем в папку.
        if (isset($_FILES['image']['name'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $path = $_FILES['image']['name'];

            if (!count($errors)) {
                move_uploaded_file($tmp_name, 'img/' . $path);
                $_POST['img_url'] = 'img/' . $path;
            }
        } else {
            $errors['Файл'] = 'Вы не загрузили файл';
        }

        if (count($errors)) {
            $page_content = include_template('addlotform.php', [
                'errors' => $errors,
                'lot' => $lot,
            ]);
        } else {
            $name = $lot['lot_name'];
            $lot_message = $lot['lot_message'];
            $img_url = $_POST['img_url'];
            $lot_step = $lot['lot_step'];
            $price = formattedPrice($_POST['cur_price']);
            $category = $lot['category'];

            //Преобразование даты из формата 11.11.2024 в формат 2024-11-11.
            $originalDate = $_POST['lot_date'];
            // Создаем объект DateTime из строки с указанным форматом
            $dateTime = DateTime::createFromFormat('d.m.Y', $originalDate);
            // Преобразуем дату в формат YYYY-MM-DD
            $formattedDate = $dateTime->format('Y-m-d');


            $query1 = "SELECT id FROM `category` WHERE LOWER(category.name) LIKE LOWER('$category')";

            $result = mysqli_query($con, $query1);
            print_r($result);

                // Извлекаем id категории
                $row = mysqli_fetch_assoc($result1);
                $category_id = $row['id'];



            $query2 = "INSERT into `lot` SET `name` = '$name', `lot_message` = '$lot_message', `img_url` = '$img_url', `lot_step` = '$lot_step', `category_id` = '$query1', `price` = '$price', `lot_date` = '$formattedDate', `lot_rate` = 0, `cur_price` = '$price' ";

            $result = mysqli_query($con, $query2);
            print_r($query);

            $page_content = include_template('lot.php', [
                    'lot_name' => $name,
                    'lot_category' => $lot['category'],
                    'lot_url' => $img_url,
                    'lot_message' => $lot_message,
                    'lot_step' =>  $lot_step,

                    'cur_price' => $cur_price,
                    'formatted_date' => $lot_date,
                ]
        );
        }
    } else {
        $page_content = include_template('addlotform.php', []);
    }


    $layout_content = include_template('layout.php', [
        'title' => $title,
        'content' => $page_content,
        'categories' => $categories,
    ]);

    print_r($layout_content);

}
