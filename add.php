<?php

//require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['lot_name', 'category', 'message', 'image', 'lot_rate', 'lot_step', 'lot_date'];
    $dict = ['lot_name' => 'Название лота', 'category' => 'Категория', 'message' => 'Описание лота', 'image' => 'Изображение',
        'lot_rate' => 'Начальная цена', 'lot_step' => 'Ставка', 'lot_date' => 'Дата завершения торгов'];
    $errors = [];


    //Проверка на наличие пустых полей - и где конкретно.
    foreach ($_POST as $key => $value) {
        if (in_array($key, $required)) {
            if (!$value) {
                $errors[$dict[$key]] = 'Это поле надо заполнить!';
            }
        }
    }

    if(count($errors)) {
        include 'templates/addlotform.php';
    }
    else {
        include 'add.php';
    }
}


