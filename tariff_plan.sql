-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 16 2024 г., 13:50
-- Версия сервера: 5.7.39
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tariff_plan`
--

-- --------------------------------------------------------

--
-- Структура таблицы `change_history`
--

CREATE TABLE `change_history` (
  `id` int(11) NOT NULL,
  `id_sub` int(11) NOT NULL,
  `old_tp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_tp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `change_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `change_history`
--

INSERT INTO `change_history` (`id`, `id_sub`, `old_tp`, `new_tp`, `change_date`) VALUES
(7, 4, 'Тарифный план A', 'Тарифный план B', '2024-05-10 20:36:25'),
(8, 5, 'Тарифный план B', 'Тарифный план C', '2024-05-10 20:36:44'),
(9, 4, 'Тарифный план A', 'Тарифный план A', '2024-05-14 12:46:20'),
(10, 5, 'Тарифный план B', 'Тарифный план B', '2024-05-14 12:52:11');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tariff_plan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocking` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscribers`
--

INSERT INTO `subscribers` (`id`, `full_name`, `contract_number`, `phone_number`, `address`, `tariff_plan`, `blocking`) VALUES
(1, 'Улямаева Валерия Алексеевна', '17', '+375(29)876-54-32', 'г.Минск, ул.Белградская 1', 'Месячный', 0),
(2, 'Улямаева Валерия Алексеевна', '17', '+375(29)876-54-32', 'г.Минск, ул.Белградская 1', 'Месячный', 0),
(3, 'Олесик Алексей Валентинович', '1723219345', '+375(29)876-54-32', 'г.Минск, ул.Белградская 1', 'Месячный', 0),
(4, 'Улямаева Валерия Алексеевна', '16216273', '+375(29)876-54-32', 'г.Минск, ул.Белградская 1', 'Тарифный план A', 1),
(5, 'Олесик Алексей Валентинович', '21212345', '+375(29)876-54-32', 'г.Минск, ул.Белградская 1', 'Тарифный план B', 0),
(6, 'Петрусева Милана Витальевна', '15234567', '+375(33)234-67-39', 'г.Витебск, ул.Советская 22', 'Тарифный план C', 0),
(7, 'Гордиенко Александра Владимировна', '22220096', '+375(44)509-00-14', 'ул. Северная 34', 'Тарифный план B', 1),
(8, 'Гордиенко Александра Владимировна', '22220096', '+375(44)509-00-14', 'ул. Северная 34', 'Тарифный план C', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `change_history`
--
ALTER TABLE `change_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sub` (`id_sub`);

--
-- Индексы таблицы `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `change_history`
--
ALTER TABLE `change_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `change_history`
--
ALTER TABLE `change_history`
  ADD CONSTRAINT `change_history_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `subscribers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
