<?php
function formattedDate($date) {
    date_default_timezone_set('Europe/Moscow');
    $cur_time = time();
    $finish_date = strtotime('tomorrow midnight');
    $left_time_in_seconds = $finish_date - $cur_time;
    $hours = floor($left_time_in_seconds / 3600);
    $minutes = floor(($left_time_in_seconds % 3600) / 60);
//    print("{$hours}Ч : {$minutes}М");
    return("{$hours}Ч : {$minutes}М");
}
?>

<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и
        горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <li class="promo__item promo__item--boards">
            <a class="promo__link" href="pages/all-lots.html">Имя категории</a>
        </li>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--заполните этот список из массива с товарами-->
        <?php
        $query = "SELECT lot.id, lot.name, lot_message, img_url, lot_rate, lot_date, lot_step, lot.price, cur_price, category.name AS category_name
        FROM `lot` JOIN category ON lot.category_id = category.id
        WHERE `lot_date` > NOW()";

        $lots_list = mysqli_query($con, $query);
        ?>



        <?php foreach($lots_list as $row => $elem) :?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src='<?=$elem['img_url']?>' width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$elem['category_name']?></span>
                    <h3 class="lot__title"><a class="text-link" href='show_lot.php?id=<?=$row;?>'><?=$elem['name']?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=formattedPrice($elem['price'])?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
<!--                            --><?php //echo $formatted_date?>
                            <?php echo formattedDate($elem['lot_date'])?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
