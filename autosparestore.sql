-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 23 2021 г., 16:56
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autosparestore`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `date`, `user_id`) VALUES
(1, '2021-11-01', 6),
(2, '2021-11-01', 3),
(3, '2021-10-16', 2),
(4, '2021-11-04', 2),
(5, '2021-11-02', 3),
(6, '2021-10-20', 3),
(7, '2021-09-15', 6),
(8, '2021-10-14', 8),
(9, '2021-10-10', 3),
(10, '2021-11-04', 6),
(130, '2021-12-06', 6),
(134, '2021-12-06', 3),
(135, '2021-12-06', 3),
(143, '2021-12-14', 1),
(147, '2021-12-23', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `text` text DEFAULT NULL,
  `spare_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `date`, `text`, `spare_id`, `user_id`, `rating`) VALUES
(1, '2021-11-04 20:24:51', '5', 6, 1, 5),
(2, '2021-11-04 20:24:51', '5', 6, 1, 5),
(3, '2021-11-04 20:24:51', '5', 3, 1, 5),
(4, '2021-11-04 20:24:51', '5', 4, 1, 5),
(5, '2021-11-04 20:24:51', '1', 2, 1, 1),
(6, '2021-11-04 20:24:51', '5', 8, 2, 5),
(7, '2021-11-04 20:24:51', '5', 9, 2, 5),
(8, '2021-11-04 20:24:51', '1', 10, 3, 1),
(9, '2021-11-04 20:24:51', '4', 4, 3, 4),
(10, '2021-11-04 20:24:51', '5', 1, 6, 5),
(11, '2021-11-04 20:24:51', '4', 7, 8, 4),
(12, '2021-11-04 20:24:51', '4', 9, 3, 4),
(13, '2021-11-04 20:24:51', '1', 2, 1, 1),
(33, '2021-12-05 23:42:24', '5', 3, 6, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `spare`
--

CREATE TABLE `spare` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `spare`
--

INSERT INTO `spare` (`id`, `name`, `price`, `store_id`) VALUES
(1, 'Амортизатор передній для Kia Rio', 2000, 1),
(2, 'Лобове скло для Daewoo Lanos', 1500, 1),
(3, 'Фара передня ліва для Honda Civic', 2500, 1),
(4, 'Набір килимків для Volkswagen Polo', 600, 2),
(5, 'Олива моторна Total, 5л', 700, 2),
(6, 'Фара передня права для Honda Civic', 2500, 1),
(7, 'Амортизатор задній для Kia Rio', 2000, 1),
(8, 'Щітка склоочисна Bosch', 150, 1),
(9, 'Свічка запалювання Bosch', 90, 2),
(10, 'Набір порогів для Volkswagen Polo', 800, 2),
(11, 'Амортизатор передній для Kia Rio', 2000, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `spare_order`
--

CREATE TABLE `spare_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `spare_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `spare_order`
--

INSERT INTO `spare_order` (`id`, `spare_id`, `order_id`) VALUES
(3, 5, 2),
(4, 8, 3),
(5, 9, 4),
(6, 10, 5),
(7, 4, 6),
(8, 1, 7),
(9, 7, 8),
(10, 9, 9),
(12, 9, 6),
(13, 2, 10),
(16, 10, 10),
(199, 10, 134),
(200, 3, 135),
(201, 6, 135),
(204, 9, 1),
(205, 10, 1),
(228, 1, 1),
(229, 1, 143),
(230, 2, 143),
(231, 7, 143),
(236, 1, 147),
(238, 3, 147),
(239, 8, 147);

-- --------------------------------------------------------

--
-- Структура таблицы `store`
--

CREATE TABLE `store` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store`
--

INSERT INTO `store` (`id`, `address`) VALUES
(1, 'Довга, 12а'),
(2, 'Миру, 51');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `pass` varchar(33) NOT NULL,
  `role` varchar(30) NOT NULL,
  `phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `pass`, `role`, `phone`) VALUES
(1, 'Petrenko Egor Sergeevich', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380504564368'),
(2, 'Danilov Ivan Pavlovich', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380666456974'),
(3, 'Gromov Oleg Petrovich', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380504329975'),
(4, 'Ivanov Alexey Mikhailovich	', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380671226641'),
(5, 'Grigorchuk Hryhoriy Ihorovych', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380739867961'),
(6, 'Shalabay Denis Igorovich', '21232f297a57a5a743894a0e4a801fc3', 'admin', '+380506325515'),
(7, 'Petrov Alexander Egorovich', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380508394756'),
(8, 'Voronin Petro Stepanovych', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380952345234'),
(9, 'Gorbunov Mikhail Dmitrievich', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380704539956'),
(10, 'Mironov Vitaliy Oleksiyovych', 'b0baee9d279d34fa1dfd71aadb908c3f', 'customer', '+380568691123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `order_ibfk_1` (`user_id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `spare_id` (`spare_id`);

--
-- Индексы таблицы `spare`
--
ALTER TABLE `spare`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `store_id` (`store_id`);

--
-- Индексы таблицы `spare_order`
--
ALTER TABLE `spare_order`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `spare_id` (`spare_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `store`
--
ALTER TABLE `store`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `spare`
--
ALTER TABLE `spare`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `spare_order`
--
ALTER TABLE `spare_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT для таблицы `store`
--
ALTER TABLE `store`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`spare_id`) REFERENCES `spare` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `spare`
--
ALTER TABLE `spare`
  ADD CONSTRAINT `spare_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`);

--
-- Ограничения внешнего ключа таблицы `spare_order`
--
ALTER TABLE `spare_order`
  ADD CONSTRAINT `spare_order_ibfk_1` FOREIGN KEY (`spare_id`) REFERENCES `spare` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `spare_order_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
