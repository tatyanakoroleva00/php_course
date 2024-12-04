<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'functions.php';
require_once 'lots_list.php';
require_once 'searchUserByEmail.php';
require_once 'categories.php';
require_once 'init.php';
require_once 'vendor/autoload.php';

session_start();
$title = 'Вход';

//Проверка на получение данных из формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $form = $_POST;
    $required = ['email', 'password'];
    $errors = [];

    //Аутентификация

    $query = "SELECT * from `users`";
    $result = mysqli_query($con, $query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //Проверка на наличие ошибок при заполнении формы
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            if ($field === 'email') {
                $errors[$field] = 'Введите email';
            }
            if ($field === 'password') {
                $errors[$field] = 'Введите пароль';
            }
        }
    }

    //Если нет ошибок и пользователь найден в БД по мейлу
    if ($user = searchUserByEmail($form['email'], $users)) {

        //Если пароль совпадает с паролем в БД
        $passwordFromDB = $user['password'];

        if (password_verify($form['password'], $passwordFromDB)) {
            $_SESSION['user'] = $user;

        } //Если пароль не совпадает с паролем в БД
        else {
            $errors['password'] = 'Неверный пароль';
        }
    } //Если такого пользователя нет или есть ошибки
    else {
        $errors['email'] = 'Такой пользователь не найден';
    }
    //Если есть ошибки
    if (count($errors)) {
        $page_content = include_template('login.php', [
            'errors' => $errors,
            'form' => $form,
        ]);
    } //Если нет ошибок, переадресация
    else {
        if(isset($_POST['remember']) && $_POST['remember'] === 'on') {
            setcookie('email', $email, time() + (30 * 24 * 60 * 60), "/"); // cookie хранится 30 дней
        }

        header("Location: /index.php");
        exit();
    }
} // Если нет запроса POST
else {
    $page_content = include_template('login.php', []);
}

//Показываем страницу
$layout_content = include_template('layout.php', [
    'title' => $title,
    'content' => $page_content,
    'categories' => $categories,
]);

print_r($layout_content);
