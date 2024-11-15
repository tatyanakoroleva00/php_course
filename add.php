<?php

require_once 'functions.php';
require_once 'lots_list.php';
require_once 'categories.php';
require_once 'init.php';
require_once 'vendor/autoload.php';

session_start();

$title = 'Добавить лот';
if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo "Доступ запрещен";
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

        //Проверка на наличие ошибок при заполнении формы
        if (count($errors)) {
            $page_content = include_template('addlotform.php', [
                'errors' => $errors,
                'lot' => $lot,
            ]);
        } else {
            //При изначальном добавлении лота $cur_price = $price у меня
            $formatted_cur_price = formattedPrice($_POST['cur_price']); //Отформатированная цена для публикации на странице
            $formatted_price = formattedPrice($_POST['cur_price']); //Отформатированная цена для публикации на странице
            $formatted_date = formattedDate($lot['lot_date']); //Отформатированная цена для публикации на странице


            $name = $_POST['lot_name'];
            $lot_message = $_POST['lot_message'];
            $img_url = $_POST['img_url'];
            $lot_step = $_POST['lot_step'];
            $category = $_POST['category'];
            $cur_price = $_POST['cur_price'];
            $price = $_POST['cur_price'];

            //Преобразование даты из формата 11.11.2024 в формат 2024-11-11 для БД
            $originalDate = $_POST['lot_date'];
            // Создаем объект DateTime из строки с указанным форматом
            $dateTime = DateTime::createFromFormat('d.m.Y', $originalDate);
            // Преобразуем дату в формат YYYY-MM-DD
            $lot_date = $dateTime->format('Y-m-d');

            //Поиск айди пользователя
            $user_id = $_SESSION['user']['id'];

            //Поиск по категории номера из таблицы "category", чтобы подставить в новый lot в БД.
            $query1 = "SELECT id FROM category WHERE LOWER(category.name) = LOWER('$category')";
            $result1 = mysqli_query($con, $query1);

            if ($result1 && mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $category_id = $row['id'];

                $query2 = "INSERT into `lot` SET `name` = '$name', `lot_message` = '$lot_message', `img_url` = '$img_url',
                `lot_step` = '$lot_step', `category_id` = '$category_id', `price` = '$price', `lot_date` = '$lot_date', `lot_rate` = 0, `cur_price` = '$price',
                `user_id` = '$user_id'";

                if(mysqli_query($con, $query2)) {
                    echo 'Лот успешно добавлен!';
                } else {
                    echo "Ошибка добавления лота: " . mysqli_error($con);
                }
            } else {
                echo "Категория не найдена!";
            }


            $page_content = include_template('lot.php', [
                    'lot_name' => $name,
                    'lot_category' => $category,
                    'img_url' => $img_url,
                    'lot_message' => $lot_message,
                    'lot_step' =>  $lot_step,
                    'cur_price' => $formatted_cur_price,
                    'formatted_date' => $formatted_date
                ]);

//            header("Location: /index.php");
//            exit;

        }
    } else {
        $page_content = include_template('addlotform.php', []);
    }


    $layout_content = include_template('layout.php', [
        'title' => $title,
        'content' => $page_content,
        'categories' => $categories
    ]);

    print_r($layout_content);

}
