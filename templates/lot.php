<?php
session_start();
?>
                <section class="lot-item container">
                    <h2><?= $lot_name ?? ''; ?></h2>
                    <div class="lot-item__content">
                        <div class="lot-item__left">
                            <div class="lot-item__image">
                                <img src='../<?= $img_url ?? ''; ?>' width="730" height="548" alt="<?$lot_name ?? ''?>">
                            </div>
                            <p class="lot-item__category">Категория: <span><?= $category_name; ?></span></p>
                            <p class="lot-item__description">Описание: <span><?=$lot_message ?? ''?></span></p>
                        </div>

                        <?php if(isset($_SESSION['user'])):?>

                        <div class="lot-item__right">

                            <div class="lot-item__right">
                                <div class="lot-item__state">
                                    <div>
                        <span class="lot-item__timer timer">
                            <?= formattedDate($lot_date) ?>
                        </span>
                                    </div>
                                    <div class="lot-item__cost-state">
                                        <div class="lot-item__rate">
                                            <span class="lot-item__amount">Текущая цена</span>
                                            <span class="lot-item__cost"><?= formattedPrice($cur_price); ?><b class="rub">р</b></span>
                                        </div>
                                        <div class="lot-item__min-cost">
                                            Мин. ставка <span><?= $lot_step;?>р</span>
                                        </div>
                                    </div>
                                    <form class="lot-item__form" action='show_lot.php?id=<?=$lot_id;?>' method="post">
                                        <p class="lot-item__form-item form__item form__item--invalid">
                                            <label for="cost">Ваша ставка</label>
                                            <input id="cost" type="text" name="lot_rate" placeholder="0" value="<?php echo isset($_POST['lot_rate']) ? $_POST['lot_rate'] : '';?>">
<!--                                            <span class="form__error">Введите наименование лота</span>-->
                                        </p>
                                        <button type="submit" class="button">Сделать ставку</button>
                                    </form>
                                </div>

                            </div>
                            <div class="history">
                                <h3>История ставок (<span>10</span>)</h3>
                                <table class="history__list">
                                    <tr class="history__item">
                                        <td class="history__name">Иван</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">5 минут назад</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Константин</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">20 минут назад</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Евгений</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">Час назад</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Игорь</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">19.03.17 в 08:21</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Енакентий</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">19.03.17 в 13:20</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Семён</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">19.03.17 в 12:20</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Илья</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">19.03.17 в 10:20</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Енакентий</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">19.03.17 в 13:20</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Семён</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">19.03.17 в 12:20</td>
                                    </tr>
                                    <tr class="history__item">
                                        <td class="history__name">Илья</td>
                                        <td class="history__price">10 999 р</td>
                                        <td class="history__time">19.03.17 в 10:20</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <?php endif; ?>
                    </div>
                </section>
