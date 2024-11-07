<?php
error_reporting(E_ALL & ~E_STRICT);
require_once 'functions.php';
require_once 'lots_list.php';
require_once 'categories.php';
$title = 'Регистрация';

$page_content = include_template('sign_up.php');
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => $title,
    'categories' => $categories,
]);
print($layout_content);

