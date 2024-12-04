<?php
session_start();
require_once 'vendor/autoload.php';

$_SESSION = [];
session_destroy();
setcookie('email', '', time() - 3600, '/');  // Устанавливаем в прошлое для удаления
header('Location: index.php');




