<?php

//print_r($_SESSION);

if (session_status() === PHP_SESSION_ACTIVE) {
//    echo "Сессия открыта.";
} else {
//    echo "Сессия не открыта.";
}
//session_destroy();
?>
        <form class="form container" method="post" action="../login.php">
        <h2>Вход</h2>
            <div class="form__item"> <!-- form__item--invalid -->
                <label for="email">E-mail <sup>*</sup></label>
                <input id="email" type="text" name="email" placeholder="Введите e-mail">
                <span class="form__error">Введите e-mail</span>
            </div>
            <div class="form__item form__item--last">
                <label for="password">Пароль <sup>*</sup></label>
                <input id="password" type="password" name="password" placeholder="Введите пароль">
                <span class="form__error">Введите пароль</span>
            </div>
            <button type="submit" class="button">Войти</button>
        </form>
