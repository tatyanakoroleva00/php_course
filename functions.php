<?php
require_once 'init.php';
require_once 'vendor/autoload.php';

function include_template($name, array $data = [])
{
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function formattedDate($date) {
    date_default_timezone_set('Europe/Moscow');
    $cur_time = time();
    $finish_date = strtotime($date);
    $left_time_in_seconds = $finish_date - $cur_time;


    $hours = floor($left_time_in_seconds / 3600);
    $minutes = floor(($left_time_in_seconds % 3600) / 60);

    if($left_time_in_seconds < 0) {
        return("Время истекло");
    }
    return("{$hours}ч : {$minutes}м");
}

//$expiration_date = formattedDate("11.11.2024");

function formattedPrice($arg)
{
    $rounded_number = ceil($arg);
    if ($rounded_number < 1000) return $rounded_number;
    elseif ($rounded_number > 1000) {
        return number_format($rounded_number, 0, ' ', ' ');
    }
}

function humanReadableTimeDifference($datetime) {
    $timestamp = strtotime($datetime);
    $currentTime = time();
    $timeDifference = $currentTime - $timestamp;

    if ($timeDifference < 60) {
        return $timeDifference . " секунд назад";
    } elseif ($timeDifference < 3600) {
        $minutes = floor($timeDifference / 60);
        return $minutes . " минут" . ($minutes == 1 ? "а" : "") . " назад";
    } elseif ($timeDifference < 86400) {
        $hours = floor($timeDifference / 3600);
        return $hours . " час" . ($hours == 1 ? "" : ($hours < 5 ? "а" : "ов")) . " назад";
    } elseif ($timeDifference < 2592000) {
        $days = floor($timeDifference / 86400);
        return $days . " д" . ($days == 1 ? "ень" : ($days < 5 ? "ня" : "ней")) . " назад";
    } elseif ($timeDifference < 31104000) {
        $months = floor($timeDifference / 2592000);
        return $months . " месяц" . ($months == 1 ? "" : ($months < 5 ? "а" : "ев")) . " назад";
    } else {
        $years = floor($timeDifference / 31104000);
        return $years . " год" . ($years == 1 ? "" : ($years < 5 ? "а" : "лет")) . " назад";
    }
}
