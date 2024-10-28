<?php
//require_once '.'
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $textareaContent = isset($_POST['message']) ? $_POST['message'] : '';
}

//print_r($errors);
?>
<form class="form form--add-lot container form--invalid" action="../add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
            <label for="lot-name">Наименование <sup>*</sup></label>
            <input id="lot-name" type="text" name="lot_name" value="<?= $_POST['lot_name'] ?? '';?>" placeholder="Введите наименование лота">

                <span class="form__error">Введите наименование лота</span>

        </div>
        <div class="form__item form__item--invalid">
            <label for="category">Категория <sup>*</sup></label>
            <select id="category" name="category" >
                <option value="Choose a category" >Выберите категорию</option>
                <option value="Boards and ski" <?php echo $_POST['category'] === 'Boards and ski' ? 'selected' : '';?>>Доски и лыжи</option>
                <option value="Fastening" <?php echo $_POST['category'] === 'Fastening' ? 'selected' : '';?>>Крепления</option>
                <option value="Boots" <?php echo $_POST['category'] === 'Boots' ? 'selected' : '';?>>Ботинки</option>
                <option value="Clothes" <?php echo $_POST['category'] === 'Clothes' ? 'selected' : '';?>>Одежда</option>
                <option value="Tools" <?php echo $_POST['category'] === 'Tools' ? 'selected' : '';?>>Инструменты</option>
                <option value="Different" <?php echo $_POST['category'] === 'Different' ? 'selected' : '';?>>Разное</option>
            </select>
            <span class="form__error">Выберите категорию</span>
        </div>
    </div>
    <div class="form__item form__item--wide form__item--invalid">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"><?php echo htmlspecialchars($textareaContent); ?></textarea>
        <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file form__item--invalid">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot_img" value="" name="image">
            <label for="lot-img">
                Добавить
            </label>
        </div>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small form__item--invalid">
            <label for="lot-rate">Начальная цена <sup>*</sup></label>
            <input id="lot-rate" type="text" value="<?= $_POST['lot_rate'] ?? '';?>" name="lot_rate" placeholder="0">
            <?php if ($errors['lot_rate']) : ?>
            <span class="form__error">Введите начальную цену</span>
            <?php endif ?>
        </div>
        <div class="form__item form__item--small form__item--invalid">
            <label for="lot-step">Шаг ставки <sup>*</sup></label>
            <input id="lot-step" type="text" value="<?= $_POST['lot_step'] ?? '';?>" name="lot_step" placeholder="0">
            <?php if ($errors['lot_step']) : ?>
            <span class="form__error">Введите шаг ставки</span>
            <?php endif ?>
        </div>
        <div class="form__item form__item--invalid">
            <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="lot-date" value="<?= $_POST['lot_date'] ?? '';?>" type="text" name="lot_date" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <?php if ($errors['message']) : ?>
            <span class="form__error">Введите дату завершения торгов</span>
            <?php endif ?>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
