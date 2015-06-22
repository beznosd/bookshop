-- phpMyAdmin SQL Dump
-- version 4.4.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 22 2015 г., 19:15
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id_book`, `title`, `author`, `cover`, `desc`, `pages`, `price`, `category`, `count_of`, `id_supply`) VALUES
(1, 'Android 2. Программирование приложений для планшетных компьютеров и смартфонов', 'Рето Майер', '1.jpg', 'Эта книга – "Android 2. Программирование приложений для планшетных компьютеров и смартфонов" - лучшее пособие для тех, кто желает самостоятельно создавать программные приложения для широко распространенной ОС мобильных устройств. Содержание основано на базе наиболее популярной и стабильной версии платформы - Android 2.х. Характер построения материала – практический курс. Обилие примеров из реальной практики дает возможность легко освоить даваемые теоретические сведения.  Для успешного усвоения предлагаемого автором материала читатель должен иметь минимальные навыки программирования. Знание основ языка Java значительно ускорит применение полученной информации в деле.Уровень изложения материала доступен для понимания начинающими программистами. В книге разбираются и сложные задачи. Так что она будет полезна и для опытных разработчиков.', 672, 300, 'Android', 20, 1),
(2, 'Android для программистов. Создаем приложения', 'Дейтел П., Дейтел Х., Дейтел Э., Моргано М.', '2.jpg', 'Приложения Android Market (в настоящее время Google Play) скачаны уже более миллиарда раз! Эта книга даст вам всё, что нужно, для начала разработки приложений для Android и быстрой публикации их на Android Market. Авторы используют приложение-ориентированный подход, при котором описание каждой технологии рассматривается на примере 16 полностью протестированных приложений для Android. Кроме описания процесса создания приложений, в книге дано пошаговое руководство по размещению ваших приложений на Android Market и примеры успешных публикаций.', 560, 350, 'Android', 15, 1),
(3, 'Assembler. Практикум', 'Юров В. И.', '3.jpg', 'Цель книги - дополнить учебник "Assembler" того же автора практическим материалом, используя который можно разрабатывать сложные полнофункциональные программы для различных операционных платформ.\r\n\r\nКаждая из двенадцати глав практикума посвящена определенной прикладной теме. Исчерпывающе рассмотрены вопросы организации взаимодействия программ на ассемблере с внешним миром. Приведены варианты ассемблерной реализации многих известных и востребованных на практике алгоритмов. Изложение базовых вопросов прикладного программирования сопровождается рассмотрением ряда интересных примеров.\r\n\r\nКнига предназначена для студентов и специалистов, применяющих ассемблер для решения задач прикладного и системного программирования.\r\n\r\nДопущено Министерством образования Российской Федерации в качестве учебного пособия для студентов высших учебных заведений, обучающихся по направлению подготовки дипломированных специалистов "Информатика и вычислительная техника".', 399, 230, 'Assembler', 10, 1),
(4, 'ActionScript 3.0 Шаблоны проектирования', 'Уильям Сандерс', '4.jpg', 'Теперь, когда язык ActionScript стал полноценным языком объектно-ориентированного программирования (ООП), часто используемые шаблоны проектирования являются идеальным средством решения многих повторяющихся задач во Flash- и Flex-приложениях. Использование шаблонов не только упрощает планирование и разработку сложных приложений, но и предоставляет решения для многих стандартных проблем, помогает в поддержке и развитии готовых приложений. В данном издании представлены ключевые особенности ActionScript 3.0, основные ООП-концепции, такие как классы, абстрактность, наследование и полиморфизм, а также преимущества использования шаблонов проектирования. Затем детально рассматриваются конкретные шаблоны: Фабричный метод, Одиночка, Декоратор, Адаптер, Композиция, Команда, Наблюдатель, Стратегия, Состояние, Модель-Представление-Контроллер и Симметричный заместитель. Авторы приводят множество примеров различной степени сложности: веб-приложения для электронной коммерции, динамичные игры, запись и воспроизведение видео и многие другие.\r\n\r\nЭта книга необходима любому разработчику Flash или Flex, желающему использовать продвинутые технологии ActionScript 3.0 в создании элегантных программных решений.', 592, 370, 'ActionScript', 12, 1),
(5, 'Dojo. Подробное руководство', 'Мэтью А. Расселл', '5.jpg', 'Dojo - это высоконадежный инструментарий JavaScript, позволяющий быстрее и проще создавать веб-приложения и сайты, основанные на применении JavaScript или технологии Ajax. Это издание представляет собой наиболее полный сборник документации по инструментарию Dojo, снабженный развернутыми комментариями.\r\n\r\nДемонстрируются эффективные приемы работы с обширным набором утилит, реализация различных пользовательских механизмов, методы воспроизведения анимационных эффектов. Также рассматриваются проекты, входящие в состав библиотеки DojoX, инструменты сборки и платформы модульного тестирования.\r\n\r\nКнига предназначена для разработчиков, уже имеющих некоторый опыт работы с технологиями JavaScript и Ajax. Использование Dojo поможет эффективнее воплощать новые идеи по созданию интерактивных веб-приложений, значительно разнообразить интерфейс и предоставить пользователю намного больше удобств в работе.', 556, 340, 'JavaScript', 10, 1),
(6, 'Java. Эффективное программирование', 'Джошуа Блох', '6.jpg', 'Прислано одним из наших читателей. Спасибо большое!\r\n\r\nКнига "Java. Эффективное программирование", содержащая пятьдесят семь ценных правил, предлагает решение задач программирования, с которыми большинство разработчиков сталкиваются каждый день.\r\n\r\nВсесторонне описывая приемы, которыми пользуются эксперты, создававшие платформу Java, эта книга показывает, что следует делать, а чего делать не следует для получения понятного, надежного и эффективного программного кода.\r\n\r\nКаждое правило, представленное в виде короткого законченного эссе, содержит описание проблемы, примеры программного кода, а также случаи из практики этого необычайно компетентного автора.\r\n\r\nВ эссе включены специальные советы, обсуждение тонкостей языка Java, для иллюстрации выбраны превосходные примеры программ.\r\n\r\nНа протяжении всей книги критически оцениваются распространенные идиомы языка Java и шаблоны разработки, даются полезные советы и методики.', 220, 240, 'Java', 10, 1),
(7, 'Swing руководство для начинающих ', 'Г. Шилдт', '7.jpg', 'Автор данного руководства, известный специалист в области программирования, Герберт Шилдт, рассказывает читателю о базовых средствах библиотеки SWING, используемой для создания графических пользовательских интерфейсов Java-программ. Книга разделена на 10 модулей, каждый из которых посвящен группе сходных между собой управляющих элементов, а завершается она обсуждением технологий, используемых для обеспечения нормальной работы компонентов в реальных приложениях. Данная книга ориентирована на программистов-практиков, поэтому уже в первом модуле рассматриваются коды реальных программ. Материал остальных модулей также сопровождается большим количеством примеров. Освоив материал данной книги, читатель получит знания, которые позволят ему приступить к изучению более сложных вопросов.', 705, 300, 'Java', 15, 1),
(8, 'Django. Разработка веб-приложений на Python', 'Дж. Форсье, П. Биссекс, У. Чан', '8.jpg', 'На базе простой и очень надежной платформы Django на Python Вы имеете возможность проектировать мощные веб-решения всего лишь из нескольких строк программного кода. Авторы книги "Django. Разработка веб-приложений на Python" детально описывают все инструменты, приемы и концепции, которые нужно знать, чтобы максимально эффективно использовать Django версии 1.0, включая все главные характерные особенности последней версии. Следует отметить, что это руководство начинается со своеобразного введения в Python, после чего подробно рассматриваются ключевые компоненты Django, а также порядок организации взаимодействия между указанными выше продуктами. В данной книге описываются способы создания конкретных приложений: фотогалерея, система управления содержимым, блог, а также инструмент публикации фрагментов программного кода с подсветкой синтаксиса. После всего этого рассматриваются более трудные для восприятия темы: синдицирование, тестирование веб-приложений, а также, настройка приложения администрирования. Авторы открывают секреты Django, давая детальные разъяснения и предоставляя множество примеров кода, сопровождая их описанием и иллюстрациями.', 456, 340, 'Python', 8, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_order`
--

INSERT INTO `book_order` (`id_book_order`, `id_book`, `id_order`, `count`, `summ`) VALUES
(1, 1, 1, 2, 600),
(2, 1, 2, 2, 600),
(3, 3, 2, 3, 690),
(4, 2, 3, 1, 350),
(5, 3, 3, 2, 460),
(6, 1, 4, 1, 300),
(7, 2, 4, 1, 350),
(8, 4, 5, 2, 740),
(9, 7, 6, 1, 300);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id_customer`, `name`, `surname`, `email`, `address`, `phone`, `pass`, `admin`) VALUES
(1, 'Дима', 'Безнос', 'beznos.d@gmail.com', 'г. Запорожье, ул. Жукова, д.3, кв.35', '+380950710965', 'c825b89f80009516f2f8f8184a791b21', 1),
(2, 'Вася', 'Пупкин', 'vasya.p@gmail.com', 'г. Полтава, ул. Пупкина, д.34, кв.107', '+380950710965', '2b4565c03d6bc454d69f8da91f5791e5', 0),
(3, 'Петя', 'Иванов', 'petya.i@gmail.com', 'г.Львов, ул. Леси Украинки, д.30, кв 154', '+380556581486', '2b4565c03d6bc454d69f8da91f5791e5', 0),
(4, 'Петя', 'Кондрашов', 'petya.k@gmail.com', 'г. Запорожье, ул. Жукова, д.3, кв.35', '+380950710965', '2b4565c03d6bc454d69f8da91f5791e5', 0),
(5, 'Вася', 'Пупкин', 'vasya.pp@gmail.com', '', '', '2b4565c03d6bc454d69f8da91f5791e5', 0);

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
  `date` int(11) NOT NULL,
  `state` int(1) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `delivery_type` varchar(20) NOT NULL,
  `order_summ` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_customer`, `date`, `state`, `payment_type`, `delivery_type`, `order_summ`) VALUES
(1, 4, 1433414464, 2, '', '', 600),
(2, 2, 1433501077, 2, '', '', 1290),
(3, 2, 1433531646, 2, '', '', 810),
(4, 2, 1434009453, 1, '', '', 650),
(5, 2, 1434010084, 0, '', '', 740),
(6, 2, 1434013604, 0, '', '', 300);

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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id_session`, `id_customer`, `sid`, `time_start`, `time_finish`, `admin`) VALUES
(48, 2, '6un1imocejafbqdak6i1tuo2q4', 1433392021, 1433393407, 0),
(59, 1, 'sg0raehjtiijh2imkhnqndbf17', 1433414499, 1433421964, 1),
(67, 1, '4cqg422q5cala6d4n70cuj97b2', 1433531711, 1433532413, 1),
(74, 1, '2br7panjmpo7ec8bd4dip46ce6', 1434031875, 1434127327, 1),
(76, 1, '0aoo9tr2pebg4vtfl4vgku58h4', 1434464935, 1434465560, 1);

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
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `book_order`
--
ALTER TABLE `book_order`
  MODIFY `id_book_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id_object` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id_courier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
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
