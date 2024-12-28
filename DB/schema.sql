-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 28 2024 г., 14:19
-- Версия сервера: 5.7.39
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `schema`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_eng` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `name_eng`) VALUES
(1, 'доски и лыжи', 'boards_and_skis'),
(2, 'ботинки', 'boots'),
(3, 'одежда', 'clothes'),
(4, 'инструменты', 'tools'),
(5, 'разное', 'different'),
(6, 'крепления', 'fasteners');

-- --------------------------------------------------------

--
-- Структура таблицы `lot`
--

CREATE TABLE `lot` (
  `id` int(11) NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lot_message` text COLLATE utf8mb4_unicode_ci,
  `img_url` text COLLATE utf8mb4_unicode_ci,
  `lot_rate` text COLLATE utf8mb4_unicode_ci,
  `lot_date` date DEFAULT NULL,
  `lot_step` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `cur_price` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lot`
--

INSERT INTO `lot` (`id`, `name`, `lot_message`, `img_url`, `lot_rate`, `lot_date`, `lot_step`, `price`, `cur_price`, `category_id`, `user_id`, `created_at`) VALUES
(134, '1231', '1111111', '/img/lots/paris.jpg', '[\"350\",\"560\",\"550\",\"901\",\"2605\",\"5219\",\"10429\",\"20858\"]', '2024-12-21', 22, 222, 41694, 2, 67, '2024-12-18 15:17:54'),
(135, 'new lot', '555555', '/img/lots/White-Snowboard-With-Bindings.jpg', '[\"3500\",\"4500\"]', '2024-12-18', 500, 1500, 9500, 2, 59, '2024-12-18 15:22:28'),
(136, 'Помидорка', 'Помидоры, они же — томаты, — сочные плоды, как правило имеющие красный цвет и круглую форму. В ботанике их принято относить к ягодам, однако в народе и при взимании торговых пошлин их называют овощами. В статье будем придерживаться второго варианта.\r\nИнтересен тот факт, что изначально помидоры были желтыми, потом их привезли в Европу, и уже там, через пару сотен лет, они приобрели всем знакомый красный цвет. На сегодняшний день в мире насчитывается порядка 10 тысяч сортов, отличающихся по размерам, форме и цвету.\r\nНапример, всем известна самая маленькая разновидность — помидоры черри. Маленькие, аккуратненькие и симпатичные помидорки используются как украшение многих блюд: канапе, тарталетки, закусочные шашлычки, бутерброды, салаты, мясные и рыбные блюда. Имеют насыщенный вкус и аромат.\r\nПолная противоположность черри — сорт бычье сердце. Это большие плоды, достигающие порой 15 сантиметров в диаметре. Плотные, мясистые и очень красивые. Замечательно подойдут для бургеров, сэндвичей и пиццы — везде, где нужны красивые большие тоненькие кружочки томатов.\r\nОбычные по размерам, но необычные по форме сливовидные сорта со своей мякотью, содержащей влаги меньше, чем остальные сорта, хороши для приготовления соусов, а также для завяливания и соления.\r\nМожно встретить и необычные по цвету оранжевые, желтые и зеленые разновидности томатов. Первые два довольно сладкие, а вот зеленые обладают приятной кислинкой. Такие сорта прекрасно подойдут как для салатов, так и для засолки.', '/img/lots/pomo.jpg', '[\"150\",\"500\",\"550\",\"1500\"]', '2024-12-23', 50, 20, 2720, 5, 59, '2024-12-18 17:50:27'),
(137, 'new one', '123123123123', '/img/lots/boots.jpg', '0', '2024-12-22', 500, 1500, 1500, 2, 67, '2024-12-19 15:47:18'),
(138, 'Book', 'ookdfjskjdf', '/img/lots/bg_green_icon6.png', '[\"800\",\"1500\",\"3000\",\"6000\",\"12000\"]', '2024-12-22', 200, 500, 23800, 5, 67, '2024-12-19 15:47:55'),
(139, '123', '123123', '/img/lots/pomo.jpg', '0', '2024-12-21', 50, 200, 200, 6, 67, '2024-12-19 17:04:07'),
(140, '123', '123', '/img/lots/scorochtenie.png', '[\"4000\",\"4250\",\"10000\"]', '2024-12-27', 50, 100, 18350, 6, 59, '2024-12-23 17:53:17'),
(141, '2222222', 'You can call me: \'my name is....\' Phone: 020000202', '/img/lots/poster.png', '[\"5000\"]', '2024-12-23', 22, 2222, 7222, 2, 67, '2024-12-22 17:54:34'),
(142, 'test Lot', 'test lot', '/img/lots/Lesson2, task1.png', '[\"1100\"]', '2022-12-28', 100, 1000, 2100, 5, 68, '2022-12-24 12:18:24'),
(143, '55555555', '12333333', '/img/lots/bg_green_icon6.png', '[\"1600\",\"3100\"]', '2024-12-28', 500, 1000, 3100, 3, 67, '2024-12-24 12:26:01'),
(144, 'Apple', 'testing', '/img/lots/apple.jpg', '[\"600\",\"1200\"]', '2024-12-28', 100, 500, 2300, 5, 68, '2024-12-24 13:48:21'),
(145, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/blackblack.shirt.jpg', '0', '2024-12-25', 100, 100, 100, 3, 59, '2024-12-24 15:33:44'),
(146, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/brown_shirt.jpg', '0', '2024-12-26', 100, 100, 100, 3, 59, '2024-12-24 15:34:13'),
(147, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/yellow_shirt.jpg', '0', '2024-12-27', 500, 1000, 1000, 3, 59, '2024-12-24 15:34:41'),
(148, 'T-shirt', '\r\nA T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/strange_shirt.jpg', '[\"1501\",\"3001\"]', '2024-12-26', 500, 1000, 5502, 3, 59, '2024-12-24 15:35:32'),
(149, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/crossed_shirt.jpg', '0', '2024-12-27', 500, 1000, 1000, 3, 59, '2024-12-24 15:38:23'),
(150, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/blue_shirt.jpg', '0', '2024-12-27', 500, 1000, 1000, 3, 59, '2024-12-24 15:38:49'),
(151, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/orange_shirt.jpg', '0', '2024-12-28', 500, 1000, 1000, 3, 59, '2024-12-24 15:39:07'),
(152, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/green_shirt.jpg', '0', '2024-12-28', 500, 1100, 1100, 3, 59, '2024-12-24 15:39:24'),
(153, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/grey_shirt.jpg', '[\"1600\",\"2100\",\"2600\"]', '2024-12-30', 500, 1100, 2600, 3, 59, '2024-12-24 15:39:46'),
(154, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/grey_shirt.jpg', '0', '2024-12-25', 500, 2000, 2000, 3, 59, '2024-12-24 15:40:41'),
(155, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/black_shirt.jpg', '0', '2024-12-28', 500, 1000, 1000, 3, 59, '2024-12-24 15:41:08'),
(156, 'T-shirt', 'A T-shirt (also spelled tee shirt, or tee for short) is a style of fabric shirt named after the T shape of its body and sleeves. Traditionally, it has short sleeves and a round neckline, known as a crew neck, which lacks a collar.', '/img/lots/shirt.jpg', '0', '2024-12-25', 500, 1000, 1000, 3, 59, '2024-12-24 15:41:25'),
(157, 'shirt', 'sdfsdf', '/img/lots/crossed_shirt.jpg', '0', '2024-12-28', 22, 1222, 1222, 3, 59, '2024-12-25 10:58:01'),
(158, 'another', 'Что-то еще, для тестирования', '/img/lots/scorochtenie.png', '[\"623\",\"1346\",\"2600\",\"3500\"]', '2024-12-31', 500, 123, 3500, 4, 67, '2024-12-25 17:48:02'),
(159, 'дждд', 'ддд', '/img/lots/bg_green_icon6.png', '0', '2024-12-30', 1, 1, 1, 1, 67, '2024-12-26 17:11:25'),
(160, 'NEW LOT', '151616', '/img/lots/website.jpg', '0', '2024-12-29', 500, 50000, 50000, 2, 67, '2024-12-28 13:39:24');

-- --------------------------------------------------------

--
-- Структура таблицы `rate`
--

CREATE TABLE `rate` (
  `ID` int(11) NOT NULL,
  `rate_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `price` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `lot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rate`
--

INSERT INTO `rate` (`ID`, `rate_date`, `price`, `user_id`, `lot_id`) VALUES
(37, '2024-12-22 15:28:53', 3000, 59, 138),
(38, '2024-12-22 15:30:21', 6000, 68, 138),
(39, '2024-12-22 15:30:44', 12000, 59, 138),
(40, '2024-12-23 17:54:45', 5000, 59, 141),
(41, '2024-12-23 17:54:46', 5000, 68, 141),
(42, '2024-12-24 12:17:05', 4000, 67, 140),
(43, '2024-12-24 12:17:51', 4250, 68, 140),
(44, '2024-12-22 12:19:01', 1100, 59, 142),
(45, '2024-12-24 12:26:11', 1600, 59, 143),
(46, '2024-12-24 13:48:39', 600, 59, 144),
(47, '2024-12-24 13:53:39', 10000, 68, 140),
(48, '2024-12-25 17:43:31', 1200, 67, 144),
(49, '2024-12-25 17:50:38', 1501, 67, 148),
(50, '2024-12-25 17:51:05', 3001, 67, 148),
(51, '2024-12-25 17:51:48', 623, 59, 158),
(52, '2024-12-25 17:57:48', 1346, 70, 158),
(53, '2024-12-26 10:42:05', 1600, 70, 153),
(54, '2024-12-26 10:42:26', 2100, 70, 153),
(55, '2024-12-26 10:55:37', 2600, 70, 153),
(56, '2024-12-26 10:55:49', 3100, 70, 143),
(57, '2024-12-26 15:27:31', 2600, 59, 158),
(58, '2024-12-26 15:27:46', 3500, 59, 158);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `contacts` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `created_at`, `email`, `name`, `password`, `avatar`, `contacts`) VALUES
(59, '2024-12-04 11:15:27', 'tatyanakoroleva00@mail.ru', 'tatiana', '$2y$10$sp4Lvy5V2ebmdoTV2vPLZeD2sr9hBG1QCCQjPcq1rn3UcKZyF/2D.', '/img/avatars/bg_purple_icon_7.png', '123151'),
(67, '2024-12-18 13:26:33', 'alex@mail.ru', 'Alex Kovalev', '$2y$10$IAp6W4pUrozcMkApcJ9WZO9xhqNX8FUvs.ywP1d/.BOXUyNbrW/Ga', '/img/avatars/bg_purple_icon_7.png', 'My name is Alex Kovalev'),
(68, '2024-12-23 15:29:42', 'nina@mail.ru', 'Nina', '$2y$10$A9Tko3ff38nuRe1bhVxr2OXAi9qV1bpTJuSoHibH5KfVWSSUk2/eG', '/img/avatars/scorochtenie.png', 'Hi, my name is Nina '),
(69, '2024-12-25 17:53:31', 'test@test.test', 'test', '$2y$10$MOSsC.p0B2DrPC4k.6STiO6TX6GKZM/KIlWYkQGz1S9VLmgEKT4me', '/img/avatars/avatar.jpg', 'test'),
(70, '2024-12-25 17:54:12', 'test2@test.test', '123', '$2y$10$Mgi9gM/0ZxBKNatAoT3PjO1sOGHbVV702EKQFN3CyP2lz7KoeW.3e', '/img/avatars/bg_green_icon6.png', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `lot` ADD FULLTEXT KEY `lot_search` (`name`,`lot_message`);

--
-- Индексы таблицы `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `lot`
--
ALTER TABLE `lot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT для таблицы `rate`
--
ALTER TABLE `rate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
