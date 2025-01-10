<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">

        <?php
        foreach ($my_bets as $row => $bet) : ?>
        <?php
            $lot_id = $bet['lot_id'];
            $cur_time = time();
            $lot_expiration_date = strtotime($bet['lot_date']);

            //Лоты, которые еще не истекли
            if ($lot_expiration_date - $cur_time > 0) : ?>
                <tr class="rates__item">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img src="<?= $bet['img_url'] ?>" width="54" height="40" alt="<?= $bet['lot_name'] ?>">
                        </div>
                        <h3 class="rates__title"><a href="show_lot.php?id=<?=$lot_id?>"><?= $bet['lot_name'] ?></a></h3>
                    </td>
                    <td class="rates__category"> <?= $bet['category_name']; ?>
                    </td>
                    <td class="rates__timer">
                        <div class="timer timer--finishing"><?= formattedDate($bet['lot_date']); ?></div>
                    </td>
                    <td class="rates__price">
                        <span><?= $bet['rate_price'] ?></span>
                    </td>
                    <td class="rates__time">
                        <?= humanReadableTimeDifference($bet['rate_date']); ?>
                    </td>
                </tr>

            <? endif; ?>


            <!--        победивший лот -->
        <?php
            $sql = "
            SELECT *, rate.user_id
            FROM rate
            WHERE rate.lot_id = ?
            ORDER BY rate_date DESC;";

            $stmt2 = $con->prepare($sql);
            $stmt2->bind_param('i', $lot_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            $last_user_id = mysqli_fetch_assoc($result2);
            $last_rate_date = strtotime($last_user_id['rate_date']);

            ?>

        <?php

            if($lot_expiration_date  - $cur_time < 0 && $last_user_id['user_id'] == $_SESSION['user']['id'] ) : ?>
            <tr class="rates__item rates__item--win">
                <td class="rates__info">
                    <div class="rates__img">
                        <img src="<?= $bet['img_url'] ?>" width="54" height="40" alt="<?= $bet['lot_name'] ?>">
                    </div>
                    <div>
                        <h3 class="rates__title"><a href="show_lot.php?id=<?=$lot_id?>"><?= $bet['lot_name'] ?></a></h3>
                        <p><?=$bet['lot_message']; ?></p>
                    </div>
                </td>
                <td class="rates__category">
                    <?= $bet['category_name']; ?>
                </td>
                <td class="rates__timer">
                    <div class="timer timer--win">Ставка выиграла</div>
                </td>
                <td class="rates__price">
                    <?= $bet['rate_price'] ?>
                </td>
                <td class="rates__time">
                    <?= humanReadableTimeDifference($bet['rate_date']); ?>
                </td>
            </tr>

        <?php endif; ?>

            <!--            Лоты, которые уже истекли-->
            <?php if (($lot_expiration_date - $cur_time < 0) && $last_user_id['user_id'] != $_SESSION['user']['id']) : ?>
                <tr class="rates__item rates__item--end">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img src="<?= $bet['img_url'] ?>" width="54" height="40" alt="<?= $bet['lot_name'] ?>">
                        </div>
                        <h3 class="rates__title"><a href="show_lot.php?id=<?=$lot_id?>"> <?= $bet['lot_name'] ?></a></h3>
                    </td>
                    <td class="rates__category"> <?= $bet['category_name']; ?>
                    </td>
                    <td class="rates__timer">
                        <div class="timer timer--end"><?= formattedDate($bet['lot_date']); ?></div>
                    </td>
                    <td class="rates__price">
                        <span><?= $bet['rate_price'] ?></span>
                    </td>
                    <td class="rates__time">
                        <?= humanReadableTimeDifference($bet['rate_date']); ?>
                    </td>
                </tr>


            <? endif; ?>


        <?php endforeach; ?>


    </table>
</section>
