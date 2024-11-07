<?php
if (isset($_POST)) {
    extract($_POST);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $indexArr = [];

        foreach ($lots_list as $key => $value) {
            array_push($indexArr, $key);
        }
    if (in_array($id, $indexArr)) { ?>

<div class="page-wrapper">
    <section class="lot-item container">
        <!--        Блок с описанием лота -->
        <h2><?= $lot_name; ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src='../img/<?= $lot_url; ?>' width="730" height="548" alt="<?= $lot_name; ?>">
                </div>
                <p class="lot-item__category">Категория: <span><?= $category; ?></span></p>
                <p class="lot-item__description"><?= $message ?></p>
            </div>

            <!--        Блок со ставки справа от лота -->
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div>
                        <span class="lot-item__timer timer">
                            <?= $formatted_data; ?>
                        </span>
                    </div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost"><?= $lot_rate; ?></span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span><?php echo $lot_step ?>р</span>
                        </div>
                    </div>
                    <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post"
                          autocomplete="off">
                        <p class="lot-item__form-item form__item form__item--invalid">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="text" name="cost" placeholder="12 000">
                            <span class="form__error">Введите наименование лота</span>
                        </p>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>

<?php
}}

else {
        http_response_code(404);
        echo "<h1>Ошибка 404: Страница не найдена</h1>";
    }
?>

</body>
</html>
