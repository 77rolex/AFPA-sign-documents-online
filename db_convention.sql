-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 03 2025 г., 14:49
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_convention`
--

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, '1ere'),
(2, '2eme');

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250828072206', '2025-08-28 09:22:12', 711),
('DoctrineMigrations\\Version20250828130952', '2025-08-28 15:10:09', 199),
('DoctrineMigrations\\Version20250828132537', '2025-08-28 15:25:45', 150),
('DoctrineMigrations\\Version20250828134428', '2025-08-28 15:44:39', 135),
('DoctrineMigrations\\Version20250828140441', '2025-08-28 16:04:52', 138),
('DoctrineMigrations\\Version20250828150000', '2025-09-01 10:41:37', 244),
('DoctrineMigrations\\Version20250901134456', '2025-09-01 15:45:08', 154),
('DoctrineMigrations\\Version20250901140030', '2025-09-01 16:00:38', 435),
('DoctrineMigrations\\Version20250901140425', '2025-09-01 16:04:31', 259),
('DoctrineMigrations\\Version20250901140629', '2025-09-01 16:06:35', 159),
('DoctrineMigrations\\Version20250901140926', '2025-09-01 16:09:31', 328),
('DoctrineMigrations\\Version20250901142125', '2025-09-01 16:21:30', 129),
('DoctrineMigrations\\Version20250903064534', '2025-09-03 08:46:14', 223),
('DoctrineMigrations\\Version20250903081117', '2025-09-03 10:11:27', 18),
('DoctrineMigrations\\Version20250903114621', '2025-09-03 13:46:28', 26),
('DoctrineMigrations\\Version20250918141915', '2025-09-18 16:19:35', 652),
('DoctrineMigrations\\Version20250918144011', '2025-09-18 16:40:26', 195),
('DoctrineMigrations\\Version20250918145208', '2025-09-18 16:52:45', 10),
('DoctrineMigrations\\Version20250918150145', '2025-09-18 17:01:52', 232);

-- --------------------------------------------------------

--
-- Структура таблицы `formulaire`
--

CREATE TABLE `formulaire` (
  `id` int(11) NOT NULL,
  `society_name` varchar(255) NOT NULL,
  `society_adress` varchar(255) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `guardian_name` varchar(255) NOT NULL,
  `guardian_email` varchar(255) NOT NULL,
  `guardian_phone` varchar(20) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `training_advisor` varchar(255) NOT NULL,
  `trainer_of_intern` varchar(255) NOT NULL,
  `siretsiren` varchar(14) NOT NULL,
  `commandant_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_signature` longtext DEFAULT NULL,
  `commandant_signature` longtext DEFAULT NULL,
  `director_signature` longtext DEFAULT NULL,
  `society_signature` longtext DEFAULT NULL,
  `society_sign_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `company_id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(8, NULL, 'director@mail.com', '[\"ROLE_DIRECTOR\"]', '$2y$13$YYLVla4Kddl0QVSR6DQYFONFWTRNRbqYQ6vXgdm2.FUOqxvy927tm', 'Jason', 'Stathem'),
(9, 1, 'commandant_1@mail.com', '[\"ROLE_COMMANDANT\"]\r\n', '$2y$13$fBMzXvPgHBHllwL9I6MsF.cuHUJNG7jcbQtTmQDkZnbBAU5GkAeOS', 'John', 'Snow'),
(13, 2, 'commandant_2@gmail.com', '[\"ROLE_COMMANDANT\"]', '$2y$13$fBMzXvPgHBHllwL9I6MsF.cuHUJNG7jcbQtTmQDkZnbBAU5GkAeOS', 'Harry', 'Potter');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `formulaire`
--
ALTER TABLE `formulaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5BDD01A87D1597EE` (`society_sign_token`),
  ADD KEY `IDX_5BDD01A830A52636` (`commandant_id`),
  ADD KEY `IDX_5BDD01A8899FB366` (`director_id`),
  ADD KEY `IDX_5BDD01A8CB944F1A` (`student_id`);

--
-- Индексы таблицы `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  ADD KEY `IDX_8D93D649979B1AD6` (`company_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `formulaire`
--
ALTER TABLE `formulaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `formulaire`
--
ALTER TABLE `formulaire`
  ADD CONSTRAINT `FK_5BDD01A830A52636` FOREIGN KEY (`commandant_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5BDD01A8899FB366` FOREIGN KEY (`director_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5BDD01A8CB944F1A` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
