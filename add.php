<?php

require_once 'functions.php';
require_once 'lots_list.php';

session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo "Доступ запрещен";
    exit;
}
else {


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = $_POST;

        $required = ['lot_name', 'category', 'message', 'image', 'lot_rate', 'lot_step', 'lot_date'];
        $dict = ['lot_name' => 'Название лота', 'category' => 'Категория', 'message' => 'Описание лота', 'image' => 'Изображение',
            'lot_rate' => 'Начальная цена', 'lot_step' => 'Ставка', 'lot_date' => 'Дата завершения торгов'];
        $errors = [];

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
                $_POST['path'] = $path;
            }
        } else {
            $errors['Файл'] = 'Вы не загрузили файл';
        }


        if (count($errors)) {
            $page_content = include_template('addlotform.php', [
                'errors' => $errors,
                'data' => $data
            ]);
        } else {
            $page_content = include_template('lot2.php', [
                'data' => $data,
                'formatted_data' => formattedData($data['lot_date'])
            ]);
        }


    } else {
        $page_content = include_template('addlotform.php', []);
    }


    print_r($page_content);

}
