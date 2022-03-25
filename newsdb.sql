-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 26 2022 г., 01:32
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `newsdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adminheader`
--

CREATE TABLE `adminheader` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `adminheader`
--

INSERT INTO `adminheader` (`id`, `title`) VALUES
(1, 'Добавление статьи'),
(2, 'Редактирование новости'),
(3, 'Удаление статьи'),
(4, 'Добавление администратора');

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `email`) VALUES
(1, 'muha', '123', 'yaluyblyuminecraft@mail.ru'),
(2, 'jmix', '$2y$10$Q2IGq0rA9vkOuigbgINVEeja0QPX8TT.mWBJA5B/poWCp4UmAkFNC', ''),
(3, 'jmix', '$2y$10$HALdSVLYr9CKe4QuKM6HF.eoYRhu1TBp3rFcPnV5scNSxypf4a..2', 'jmix@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `header`
--

CREATE TABLE `header` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `header`
--

INSERT INTO `header` (`id`, `title`) VALUES
(1, 'Главная'),
(2, 'Общество'),
(3, 'Наука'),
(4, 'Экономика'),
(5, 'Политика');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `longdesc` text NOT NULL,
  `date` date NOT NULL,
  `autor_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `image`, `longdesc`, `date`, `autor_name`, `type`) VALUES
(1, 'Депутат Госдумы раскритиковал моду на бедность', 'bednota.png', 'Депутат Государственной думы Сергей Кулябин заявил, что в России процветает “мода на бедность” – население не хочет “крутиться и иметь нестыдные деньги”, а в результате страдает имидж страны на международной арене и процветают деструктивные экономические процессы.\r\n</b>\r\n<br>\r\nПо словам политика, для многих россиян выживание на сумму до 100 тысяч рублей в месяц стало чем-то приемлемым. Они не хотят двигаться дальше и не ищут возможности.\r\n<br>\r\n“Если очень просто это всё описать, то это мода на бедность. Мода на то, чтобы работать каким-то, условно говоря, забойщиком или строителем, и всё, никуда дальше не двигаться. Человек мешает бетон на своей стройке и не думает, где купить, где продать, как крутиться. Ему не надо ничего, ему модно вот так жить, он себя там мнит кем-то. А страдает в итоге вся страна из-за таких”, – сказал он.\r\n<br>\r\nКулябин вспомнил, что свой первый миллион долларов заработал в 1990-х годах, когда ему было меньше 30 лет – будущий депутат Госдумы тогда занимался землёй и скупал разорившиеся предприятия. Он подчеркнул, что не все способны на такое, но получать “меньше условных двух-трёх тысяч условных единиц” – это стыд для любого человека.\r\n<br>\r\n“Ты тогда просто тратишь время, тебе нравится жить на такие деньги. Я иного объяснения не могу придумать, потому что не все умеют вертеться, но есть какие-то базовые вещи в этой жизни, которых мужчина, если он мужчина вообще, обязан добиться. Если тебе и так нормально, если ты Че Гевара вот этот из трущоб, это стыдно. На нас пальцами тыкают из-за наших средних зарплат в мире, говорят, сколько людей в нищете живёт при таких возможностях. Я не знаю, как объяснять людям, что этот контингент просто не хочет ничего, им и так нормально. Это позор для нас”, – заключил он.', '2022-03-26', 'Custer', 'Политика');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adminheader`
--
ALTER TABLE `adminheader`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adminheader`
--
ALTER TABLE `adminheader`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `header`
--
ALTER TABLE `header`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
