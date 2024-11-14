<?php
session_start();
require_once 'vendor/autoload.php';

$_SESSION = [];
session_destroy();
header('Location: index.php');




