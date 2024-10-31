<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'functions.php';
require_once 'lots_list.php';
require_once 'searchUserByEmail.php';
require_once 'userdata.php';

session_start();

$is_auth = rand(0, 1);
$user_avatar = 'https://images.unsplash.com/photo-1729512680463-bc583c395b61?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
$user_name = 'Tatiana'; // укажите здесь ваше имя
$title = 'Главная страница';

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$i = 0;

//Проверка на получение данных из формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = $_POST;
    $required = ['email', 'password'];
    $errors = [];

    //Проверка на наличие ошибок при заполнении формы
    foreach ($required as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Это поле нужно заполнить';
        }
    }
//    if (count($errors)) {
//        $page_content = include_template('login.php', [
//            'errors' => $errors,
//            'form' => $form,
//        ]);
//    }

    //Аутентификация

    //Если нет ошибок и пользователь найден в БД по мейлу
    if (!count($errors) and $user = searchUserByEmail($form['email'], $users)) {

        //Если пароль совпадает с паролем в БД

        $password = $user['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        print_r($hashed_password);
//        if (password_verify($form['password'], $user['password'])) {
        if (password_verify($form['password'], $hashed_password)) {
            $_SESSION['user'] = $user;


        //Если пароль не совпадает с паролем в БД
        } else {
            $errors['password'] = 'Неверный пароль';
            print_r($form['password']);
        }

        //Если такого пользователя нет или есть ошибки
    } else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    if(count($errors)) {
        $page_content = include_template('login.php', [
            'errors' => $errors,
            'form' => $form,
        ]);
    } else {
    header("Location: /index.php");
    exit();
//    $page_content = include_template('index.php', [
//        'categories' => $categories,
//        'lots_list' => $lots_list,
//        'formatted_data' => formattedData("20.10.2024")
//    ]);
    }
} // Если нет запроса POST
else {
    $page_content = include_template('login.php', []);
}



//print_r($errors);

//Показываем страницу
$layout_content = include_template('layout.php', [
    'title' => $title,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'content' => $page_content,
    'categories' => $categories,
    'is_auth' => $is_auth,
]);

print_r($layout_content);
