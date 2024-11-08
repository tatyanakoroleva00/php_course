<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'functions.php';
require_once 'lots_list.php';
require_once 'searchUserByEmail.php';
require_once 'userdata.php';
require_once 'categories.php';

session_start();
print_r($_POST);

$title = 'Вход';

//$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
//$i = 0;

//Проверка на получение данных из формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;
    $required = ['email', 'password'];
    $errors = [];

    //Проверка на наличие ошибок при заполнении формы
//    foreach ($required as $field) {
//        if (empty($form[$field])) {
//            $errors[$field] = 'Это поле нужно заполнить';
//        }
//    }

    //Аутентификация

    //Если нет ошибок и пользователь найден в БД по мейлу
    if ($user = searchUserByEmail($form['email'], $users)) {

        //Если пароль совпадает с паролем в БД

        $password = $user['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if (password_verify($form['password'], $hashed_password)) {
            $_SESSION['user'] = $user;
        //Если пароль не совпадает с паролем в БД
        } else {
            $errors['password'] = 'Неверный пароль';
        }

        //Если такого пользователя нет или есть ошибки
    } else {
        $errors['email'] = 'Такой пользователь не найден';
        $errors['password'] = 'Неверный пароль';
    }

    if(count($errors)) {
        $page_content = include_template('login.php', [
            'errors' => $errors,
            'form' => $form,
        ]);
    } else {
    header("Location: /index.php");
    exit();
    }
    print_r($errors);
} // Если нет запроса POST
else {
    $page_content = include_template('login.php', []);
}



//print_r($errors);

//Показываем страницу
$layout_content = include_template('layout.php', [
    'title' => $title,
    'content' => $page_content,
    'categories' => $categories,
]);

print_r($layout_content);
