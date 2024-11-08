<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'functions.php';
require_once 'lots_list.php';
require_once 'searchUserByEmail.php';
require_once 'userdata.php';
require_once 'categories.php';

$title = 'Регистрация';
session_start();
$login_page = 'login.php';
$errors = [1, 2, 3];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $form = $_POST;
    $required = ['email', 'password', 'name', 'message'];
    $errors = [];

    //Проверка на наличие ошибок при заполнении формы
    foreach ($required as $field) {
        if (empty($form[$field])) {
            if($field === 'email') {
                $errors[$field] = 'Введите email';
            }
            if($field === 'password') {
                $errors[$field] = 'Введите пароль';
            }
            if($field === 'name') {
                $errors[$field] = 'Введите имя';
            }
            if($field === 'message') {
                $errors[$field] = 'Напишите как с вами связаться';
            }
    }
    }

    //Аутентификация

    //Если нет ошибок и пользователь найден в БД по мейлу
    if ($user = searchUserByEmail($form['email'], $users)) {

        $errors['email'] = 'Такой пользователь уже существует';
    }

    //Если после проверок нет ошибок, то показываем определенную страницу
    if(!count($errors)) {
        $page_content = include_template('login.php', [
            'login_page' => $login_page,
        ]);
    }
    //Если после проверок есть ошибки, то остаемся на текущей странице
    else {
        $page_content = include_template('sign_up.php', [
            'login_page' => $login_page,
            'errors' => $errors,
        ]);
    }

}
else {
    $page_content = include_template('sign_up.php', [
        'login_page' => $login_page,
    ]);
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => $title,
    'categories' => $categories,
]);
print($layout_content);

