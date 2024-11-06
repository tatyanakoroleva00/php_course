-- Добавляем в таблицу "категории" названия категорий.

-- INSERT INTO `categories` (`id`, `name`) VALUES
-- (1, 'Доски и лыжи'),
-- (2, 'Крепления'), (3, 'Ботинки'), (4, 'Одежда'), (5, 'Инструменты'), (6, 'Разное');

-- Дамп данных таблицы `users

INSERT INTO `users` (`id`, `email`, `password`, `name`) VALUES
(1, 'ignat.v@gmail.com', 'ugOGdVMi', 'Ignat'),
(2, 'kitty_93@li.ru', 'daecNazD', 'Kitty'),
(3, 'warrior07@mail.ru', 'oixb3aL8', 'Warrior'),
(4, 'tatyanakoroleva00@mail.ru', '12345', 'Tatiana');

-- Дамп данных таблицы `lot`

INSERT INTO `lot` (`id`, `name`, `lot_rate`, `image`, `category_id`) VALUES
(1, '2014 Rossignol District Snowboard',  10999, 'img/lot-1.jpg', 1),
(2, 'DC Ply mens 2016/2017 Snowboard', 159999, 'img/lot-2.jpg', 1),
(3, 'Крепления Union Contact Pro 2015 года размер L/XL', 8000, 'img/lot-3.jpg', ),
(4, 'Ботинки для сноуборда DC Mutiny Charocal', 10999, 'img/lot-4.jpg'),
(5, 'Куртка для сноуборда DC Mutiny Charocal', 7500, 'img/lot-5.jpg'),
(6, 'Маска Oakley Canopy', 5400, 'img/lot-6.jpg');

--Получить самые новые, открытые лоты. Каждый лот включает
--название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории
SELECT `name`, `start_price`, `image`, `cur_price`, `number_of_bets`, `category` from `lots_list`
WHERE `lot_date` >= CURRENT_DATE;

--Показать лот по его id. Получить название категории, к которой принадлежит лот.
SELECT `lot.id`, `lot.name`, `lot_rate`, `lot.image`,
       `category.name` AS `category_name`
FROM `lot`
WHERE `lot.id` = ?;

--Обновить название лота по его id
UPDATE `lot`
SET `name` = 'Pencil'
WHERE `id` = ?;

--Получить список самых свежих ставок для лота по id
SELECT
    SUBSTRING_INDEX (SUBSTRING_INDEX(bets, ',', -2), ',', 1) AS second_last_bet,
    SUBSTRING_INDEX (bets, ',', -1) AS last_bet
FROM
    `lot`
WHERE
    `lot.id` = ?;


--ВЫБОРКА всех данных из таблицы `category`
SELECT `name` from `category`;

--ВЫБОРКА всех данных из таблицы `users`
SELECT * FROM `users`;

