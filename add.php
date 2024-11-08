<?php

require_once 'functions.php';
require_once 'lots_list.php';
require_once 'categories.php';

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
        $lot_date = formattedData($lot['lot_date']);

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
            $page_content = include_template('lot.php', [
                    'lot_name' => $lot['name'],
                    'lot_category' => $lot['category'],
                    'lot_url' => $_POST['img_url'],
                    'lot_message' => $lot['lot_message'],
                    'lot_step' => $lot['lot_step'],
                    'cur_price' => $cur_price,
                    'formatted_data' => $lot_date,
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
