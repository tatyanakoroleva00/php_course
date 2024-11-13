-- CREATE DATABASE IF NOT EXISTS yeticave
-- DEFAULT CHARACTER set utf8
-- -- DEFAULT COLLATE utf_general_ci
-- USE yeticave
--
-- CREATE TABLE IF NOT EXISTS category (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name CHAR(64)
-- );

CREATE DATABASE IF NOT EXISTS my_new_database;

-- Подключение к созданной базе данных
USE my_new_database;

-- Создание таблицы в этой базе данных
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE FULLTEXT INDEX lot_search
ON lot(`name`, `lot_message`);



