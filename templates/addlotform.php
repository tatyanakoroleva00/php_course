<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $textareaContent = isset($_POST['message']) ? $_POST['message'] : '';
}
?>
    <form class="form form--add-lot container <?php echo !empty($errors) ? 'form--invalid' : '' ?>" action="../add.php"
          method="post" enctype="multipart/form-data"> <!-- form--invalid -->
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot_name" value="<?= $_POST['lot_name'] ?? ''; ?>"
                       placeholder="Введите наименование лота">
                <span
                    class="form__error"><?php echo isset($errors['lot_name']) ? 'Введите наименование лота' : '' ?></span>

            </div>
            <div class="form__item <?php echo isset($errors['category']) ? 'form__item--invalid' : ''; ?>">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="category">
                    <option value="">Выберите категорию</option>
                    <option
                        value="Boards and ski" <?php echo $_POST['category'] === 'Boards and ski' ? 'selected' : ''; ?>>
                        Доски и лыжи
                    </option>
                    <option value="Fastening" <?php echo $_POST['category'] === 'Fastening' ? 'selected' : ''; ?>>
                        Крепления
                    </option>
                    <option value="Boots" <?php echo $_POST['category'] === 'Boots' ? 'selected' : ''; ?>>Ботинки
                    </option>
                    <option value="Clothes" <?php echo $_POST['category'] === 'Clothes' ? 'selected' : ''; ?>>Одежда
                    </option>
                    <option value="Tools" <?php echo $_POST['category'] === 'Tools' ? 'selected' : ''; ?>>Инструменты
                    </option>
                    <option value="Different" <?php echo $_POST['category'] === 'Different' ? 'selected' : ''; ?>>
                        Разное
                    </option>
                </select>
                <span class="form__error"><?php echo isset($errors['category']) ? 'Выберите категорию' : '' ?></span>
            </div>
        </div>
        <div class="form__item form__item--wide <?php echo isset($errors['message']) ? 'form__item--invalid' : ''; ?>">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="message"
                      placeholder="Напишите описание лота"><?php echo htmlspecialchars($textareaContent); ?></textarea>
            <span class="form__error"><?php echo isset($errors['message']) ? 'Напишите описание лота' : '' ?></span>
        </div>
        <div>
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input type="file" id="lot_img" name="image">

            </div>
        </div>
        <div class="form__container-three">
            <div
                class="form__item form__item--small <?php echo isset($errors['lot_rate']) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-rate">Начальная цена <sup>*</sup></label>
                <input id="lot-rate" type="number" value="<?= $_POST['lot_rate'] ?? ''; ?>" name="lot_rate"
                       placeholder="0">
                <span
                    class="form__error"><?php echo isset($errors['lot_rate']) ? 'Введите начальную цену' : '' ?></span>
            </div>
            <div
                class="form__item form__item--small <?php echo isset($errors['lot_step']) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-step">Шаг ставки <sup>*</sup></label>
                <input id="lot-step" type="number" value="<?= $_POST['lot_step'] ?? ''; ?>" name="lot_step"
                       placeholder="0">
                <span class="form__error"><?php echo isset($errors['lot_step']) ? 'Введите шаг ставки' : '' ?></span>
            </div>
            <div class="form__item <?php echo isset($errors['lot_date']) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="lot-date" value="<?= $_POST['lot_date'] ?? ''; ?>" type="text"
                       name="lot_date" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
                <span
                    class="form__error"><?php echo isset($errors['lot_date']) ? 'Введите дату завершения торгов' : '' ?></span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</div>
</body>
</html>
