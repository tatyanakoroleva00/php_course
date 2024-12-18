<?php
if(isset($_SESSION)) print_r($_SESSION);
if (isset($_POST)) print_r($_POST);

?>

<section class="lot-item container">
    <h2><?= $lot_name ?? ''; ?></h2>
    <div class="lot-item__content">
        <!--        Left column-->
        <div class="lot-col">
            <div>
                <div class="lot-item__image">
                    <img src='../<?= $img_url ?? ''; ?>' width="730" height="548" alt="<? $lot_name ?? '' ?>">
                </div>
                <p class="lot-item__name"><b style="font-size: 14px;">Наименование:</b> <span><?= $lot_name ?></span>
                </p>
                <p class="lot-item__category"><b style="font-size: 14px;">Категория:</b>
                    <span><?= $category_name; ?></span></p>
                <p class="lot-item__description"><b style="font-size: 14px;">Описание:</b>
                    <span><?= $lot_message ?? '' ?></span></p>
                <p><b style="font-size: 14px;">Контакты:</b>
<!--                    <span>--><?//=  ?><!--</span></p>-->

            </div>
            <?php if (isset($_SESSION['user'])) : ?>
                <div>
                    <div class="lot-item__state">
                        <div>
                            <p class="rates__title">Добавить ставку</p>
                            <span class="lot-item__timer timer"><?= formattedDate($lot_date) ?></span>
                            <div class="lot-item__cost-state">
                                <div class="lot-item__rate">
                                    <span class="lot-item__amount">Текущая цена</span>
                                    <span class="lot-item__cost"><?= $cur_price; ?><b class="rub">р</b></span>
                                </div>
                            </div>
                        </div>
                            <form class="lot-item__form" action='show_lot.php?id=<?= $lot_id; ?>' method="post">
                                <p class="lot-item__form-item form__item form__item--invalid">
                                    <label for="cost">Ваша cумма:</label>
                                    <input id="cost" type="text" name="lot_rate" placeholder="0"
                                           value="<?php echo isset($_POST['lot_rate']) ? $_POST['lot_rate'] : ''; ?>">
                                </p>
                                <button type="submit" class="button">Разместить ставку</button>
                                <div class="lot-item__min-cost">
                                    Мин. ставка <span><?= $lot_step; ?>р</span>
                                </div>
                            </form>

                        </div>

                </div>
            <?php endif; ?>
        </div>

        <!--        Right column-->
        <div class="lot-col">
            <h3>История ставок (<span>10</span>)</h3>
            <table class="history__list">

                <?php
                $query6 = "
                SELECT lot_id, user_id, rate_date, user.id
                FROM rate, users
                INNER JOIN users ON user.id = users.id;";

                $result = mysqli_query($con, $query6);


                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='history__list'>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='history__item'>
                    <td class='history__name'>" . $row['user_id'] . "</td>
                    <td class='history__price'>" . $row['price'] . "</td>
                    <td class='history__time'>" . $row['rate_date'] . "</td>
                </tr>";
                    }
                }
               ?>
            </table>
        </div


    </div>
</section>
