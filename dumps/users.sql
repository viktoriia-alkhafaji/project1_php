-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 09 2021 г., 22:19
-- Версия сервера: 10.2.31-MariaDB-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `stage2_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hash` varchar(32) NOT NULL DEFAULT '',
  `ip` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `hash`, `ip`) VALUES
(1, 'admin', '1f32aa4c9a1d2ea010adcf2348166a04', '', 0),
(2, 'admin1', '1f32aa4c9a1d2ea010adcf2348166a04', '', 0),
(3, 'vasiliy', '1f32aa4c9a1d2ea010adcf2348166a04', '', 0),
(4, 'krokodil', '1f32aa4c9a1d2ea010adcf2348166a04', '', 0),
(5, 'linaam', '1f32aa4c9a1d2ea010adcf2348166a04', '', 0),
(6, 'admin2', '1f32aa4c9a1d2ea010adcf2348166a04', '', 0),
(7, 'alexandr', '1f32aa4c9a1d2ea010adcf2348166a04', '', 0),
(8, 'asdfga', '5259ee4a034fdeddd1b65be92debe731', '', 0),
(9, 'viktoriya.stch@skyeng.ru', 'cff3535a7159d65b112589bda738b1ca', '', 0),
(10, 'viktoriia-alkhafaji', 'd9b1d7db4cd6e70935368a1efb10e377', '', 0),
(11, 'dfasfadf', '1597dd4c68990a23792bda1b8f0596f6', '', 0),
(12, '1234ddg', '5259ee4a034fdeddd1b65be92debe731', '', 0),
(13, '12322323', '4a0f84dd91471107bf6a1dfce1d62fc0', '', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
