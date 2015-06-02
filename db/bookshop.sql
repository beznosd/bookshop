-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 02 2015 г., 15:28
-- Версия сервера: 10.0.17-MariaDB
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bookshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id_book` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(150) NOT NULL,
  `cover` varchar(150) NOT NULL,
  `desc` varchar(2000) NOT NULL,
  `pages` int(4) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `count_of` int(11) NOT NULL,
  `id_supply` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id_book`, `title`, `author`, `cover`, `desc`, `pages`, `price`, `category`, `count_of`, `id_supply`) VALUES
(1, 'Android 2. Программирование приложений для планшетных компьютеров и смартфонов', 'Рето Майер', '1.jpg', '', 672, 300, 'Android', 20, 1),
(2, 'Android для программистов. Создаем приложения', 'Дейтел П., Дейтел Х., Дейтел Э., Моргано М.', '2.jpg', 'Приложения Android Market (в настоящее время Google Play) скачаны уже более миллиарда раз! Эта книга даст вам всё, что нужно, для начала разработки приложений для Android и быстрой публикации их на Android Market. Авторы используют приложение-ориентированный подход, при котором описание каждой технологии рассматривается на примере 16 полностью протестированных приложений для Android. Кроме описания процесса создания приложений, в книге дано пошаговое руководство по размещению ваших приложений на Android Market и примеры успешных публикаций.', 560, 350, 'Android', 15, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `book_order`
--

CREATE TABLE IF NOT EXISTS `book_order` (
  `id_book_order` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `summ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_object` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(150) NOT NULL,
  `cover` varchar(150) NOT NULL,
  `pages` int(4) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `sid` char(128) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `couriers`
--

CREATE TABLE IF NOT EXISTS `couriers` (
  `id_courier` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id_customer` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `pass` char(32) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id_customer`, `name`, `surname`, `email`, `address`, `phone`, `pass`, `admin`) VALUES
(1, 'Дима', 'Безнос', 'beznos.d@gmail.com', '', '', 'c825b89f80009516f2f8f8184a791b21', 1),
(2, 'Vasya', 'Pupkin', 'vasya.p@gmail.com', '', '', '2b4565c03d6bc454d69f8da91f5791e5', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
  `id_delivery` int(11) NOT NULL,
  `id_courier` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `date` datetime NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `id_manager` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `login` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_manager` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `state` varchar(20) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `delivery_type` varchar(20) NOT NULL,
  `order_summ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `sid` varchar(30) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_finish` int(11) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id_session`, `id_customer`, `sid`, `time_start`, `time_finish`, `admin`) VALUES
(22, 1, 'sg0raehjtiijh2imkhnqndbf17', 1433258255, 1433259494, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id_supplier` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `supplies`
--

CREATE TABLE IF NOT EXISTS `supplies` (
  `id_supply` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `supply_book`
--

CREATE TABLE IF NOT EXISTS `supply_book` (
  `id_supply_book` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_supply` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id_book`);

--
-- Индексы таблицы `book_order`
--
ALTER TABLE `book_order`
  ADD PRIMARY KEY (`id_book_order`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_object`);

--
-- Индексы таблицы `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id_courier`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`);

--
-- Индексы таблицы `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id_delivery`);

--
-- Индексы таблицы `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id_manager`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id_session`);

--
-- Индексы таблицы `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id_supply`);

--
-- Индексы таблицы `supply_book`
--
ALTER TABLE `supply_book`
  ADD PRIMARY KEY (`id_supply_book`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `book_order`
--
ALTER TABLE `book_order`
  MODIFY `id_book_order` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id_courier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id_delivery` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `managers`
--
ALTER TABLE `managers`
  MODIFY `id_manager` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id_supply` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `supply_book`
--
ALTER TABLE `supply_book`
  MODIFY `id_supply_book` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
