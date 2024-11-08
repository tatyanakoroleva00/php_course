<form class="form container" method="post" action="../login.php">
    <h2>Вход</h2>
    <div class="form__item"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Введите e-mail">
        <span class="form__error"><?=$errors['email'] ?? ''?></span>

    </div>
    <div class="form__item form__item--last">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" placeholder="Введите пароль">
        <span class="form__error"><?=$errors['password'] ?? ''?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>
