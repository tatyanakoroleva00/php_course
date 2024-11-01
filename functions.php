<?php

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

function formattedData($date) {
    date_default_timezone_set('Europe/Moscow');
    $cur_time = time();
    $finish_date = strtotime('tomorrow midnight');
    $left_time_in_seconds = $finish_date - $cur_time;
    $hours = floor($left_time_in_seconds / 3600);
    $minutes = floor(($left_time_in_seconds % 3600) / 60);
//    print("{$hours}Ч : {$minutes}М");
    return("{$hours}Ч : {$minutes}М");
}

function formattedPrice($arg)
{
    $rounded_number = ceil($arg);
    if ($rounded_number < 1000) return $rounded_number;
    elseif ($rounded_number > 1000) {
        return number_format($rounded_number, 0, ' ', ' ');
    }
}
