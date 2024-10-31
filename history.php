<?php

// Выводим список просмотренных лотов
if(isset($_COOKIE)) {
    $viewed_lots_ids = explode(',', $_COOKIE['ids']);
}
