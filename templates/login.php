<form class="form container" method="post" action="../login.php">
    <h2>Вход</h2>
    <div class="form__item"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Введите e-mail">

        <?php if (empty($form['email'])): ?>
        <span class="form__error">Введите email</span>
        <?php elseif (isset($errors['email'])): ?>
        <span class="form__error">Такой пользователь не найден</span>
        <?php else : ?><span class="form__error"></span>
        <?php endif;?>

    </div>
    <div class="form__item form__item--last">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>" placeholder="Введите пароль">

        <?php if (empty($form['password'])): ?>
        <span class="form__error">Введите пароль</span>
        <?php elseif (isset($errors['password'])) : ?>
            <span class="form__error">Введите правильный пароль</span>
        <?php endif;?>

    </div>
    <button type="submit" class="button">Войти</button>
</form>
