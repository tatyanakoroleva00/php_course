<?php
require_once 'functions.php';
require_once 'categories.php';
require_once 'init.php';
session_start();

# Найти все мои ставки
if(isset($_SESSION)) {
    $user_id = $_SESSION['user']['id'];

    // SQL-запрос для получения самых последних ставок по дате по каждому лоту - у определенного юзера.
    $sql = "
    SELECT *, t1.price AS rate_price, lot.name AS lot_name, lot.id AS lot_id, category.name AS category_name
    FROM rate t1
    JOIN (
        SELECT lot_id, MAX(rate_date) AS max_rate_date
        FROM rate
        WHERE user_id = ?
        GROUP BY lot_id
    ) t2 ON t1.lot_id = t2.lot_id AND t1.rate_date = t2.max_rate_date
    JOIN lot ON t1.lot_id = lot.id
    JOIN category ON  lot.category_id = category.id
    WHERE t1.user_id = ?
    ORDER BY lot.lot_date DESC
;";

    $stmt = $con->prepare($sql);
    $stmt->bind_param('ii', $user_id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

//    $result = mysqli_query($con, $sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $page_content = include_template('my_bets.php', [
        'my_bets' => $result,
        'con' => $con,
    ]);

} else {
        http_response_code(404);
        $page_content = '<h1>Ошибка 404: Страница не найдена</h1>';

}
    $layout_content = include_template('layout.php', [
        'title' => 'Мои ставки',
        'content' => $page_content,
        'categories' => $categories,
    ]);
    print_r($layout_content);




