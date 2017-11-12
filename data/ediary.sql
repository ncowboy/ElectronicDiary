-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 12 2017 г., 16:24
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ediary`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `metro` varchar(50) NOT NULL,
  `adress` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `alias`, `region`, `metro`, `adress`) VALUES
(1, 'taganka', 'Таганка', 'ЦАО', 'Таганская', 'ул-а Воронцовская, дом 35 «Б», кор-с 2'),
(2, 'sokol-gora', 'Соколиная гора', 'ВАО', 'Партизанская', 'Окружной проезд, дом 16'),
(3, 'filpark', 'Филевский парк', 'ЗАО', 'Кунцевская', ' ул-а Кастанаевская, дом 59, корпус 2');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_type_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `building_id`, `subject_id`, `group_type_id`, `teacher_id`) VALUES
(3, 2, 2, 2, 1),
(5, 2, 1, 1, 1),
(7, 1, 1, 1, 2),
(8, 1, 1, 2, NULL),
(10, 3, 1, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `group_types`
--

CREATE TABLE `group_types` (
  `id` int(11) NOT NULL,
  `type_code` varchar(20) NOT NULL,
  `type_alias` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group_types`
--

INSERT INTO `group_types` (`id`, `type_code`, `type_alias`, `description`) VALUES
(1, 'e', 'E', 'ЕГЭ'),
(2, 'o', 'О', 'ОГЭ'),
(3, 'z', 'И', 'Прочее');

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `theme` varchar(256) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `comment` varchar(1028) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `datetime`, `theme`, `group_id`, `comment`) VALUES
(5, '2018-01-19 14:50:00', 'testтема', 7, ''),
(6, '2017-10-28 14:50:00', 'Поэзия серебряного века', 5, ''),
(7, '2017-10-20 13:05:00', 'testтема', 3, ''),
(15, '2017-10-24 20:00:00', 'testтема11111', 10, 'drthrhtrh');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1505134092),
('m170829_182251_create_table_students', 1505134094),
('m170829_182531_create_table_groups', 1505134094),
('m170829_182658_create_table_teachers', 1505134094),
('m170829_183700_add_foreign_keys', 1505134096),
('m170902_060523_create_table_users', 1505134096),
('m170902_060538_create_table_user_roles', 1505134096),
('m170911_170450_create_table_users', 1505149654),
('m170911_170459_create_table_user_roles', 1505149654),
('m170925_113609_create_table_users', 1506340481),
('m170925_132555_create_tables_for_groups', 1506346751),
('m170925_134010_fill_tables_for_groups', 1506347716),
('m170925_135600_fill_table_groups', 1506347975),
('m170925_140028_add_foreign_keys_for_groups_tables', 1506349159);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(5) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `parents_name` varchar(50) DEFAULT NULL,
  `parents_number` varchar(20) DEFAULT NULL,
  `parents_email` varchar(100) NOT NULL,
  `birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `user_id`, `phone_number`, `parents_name`, `parents_number`, `parents_email`, `birth`) VALUES
(1, 4, '+7 (903) 588-42-07', 'Мария Ивановна Петрова', '+7-111-11-11', 'mail@mail.me', '1983-12-07'),
(2, 5, '+7(903) 155-15-20', 'Денисова Анна Евгеньевна', '+7(905)125-20-55', '', '1983-11-09'),
(19, 24, '89765678990', 'Мама', '87686545656', '', '1998-10-09'),
(20, 25, '89034567890', 'Папа', '89045678929', '', '1997-10-16'),
(21, 26, '89076789098', 'Мама', '89165434567', '', '2000-08-25');

-- --------------------------------------------------------

--
-- Структура таблицы `students_in_group`
--

CREATE TABLE `students_in_group` (
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students_in_group`
--

INSERT INTO `students_in_group` (`group_id`, `student_id`) VALUES
(3, 1),
(3, 2),
(3, 19),
(3, 20),
(3, 21),
(5, 1),
(5, 2),
(5, 19),
(5, 20),
(5, 21),
(7, 1),
(7, 2),
(7, 19),
(7, 20),
(7, 21),
(10, 1),
(10, 2),
(10, 19),
(10, 20),
(10, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `students_in_lesson`
--

CREATE TABLE `students_in_lesson` (
  `lesson_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` tinyint(1) NOT NULL DEFAULT '0',
  `mark_work_at_lesson` tinyint(4) DEFAULT NULL,
  `mark_homework` tinyint(4) DEFAULT NULL,
  `mark_dictation` tinyint(4) DEFAULT NULL,
  `comment` varchar(1028) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students_in_lesson`
--

INSERT INTO `students_in_lesson` (`lesson_id`, `student_id`, `attendance`, `mark_work_at_lesson`, `mark_homework`, `mark_dictation`, `comment`) VALUES
(5, 1, 0, NULL, NULL, NULL, ''),
(7, 1, 1, 4, 5, 3, ''),
(7, 2, 1, 5, 3, 4, ''),
(7, 19, 1, 1, 1, 5, ''),
(7, 20, 1, 5, 1, 5, ''),
(7, 21, 1, 1, 1, 3, ''),
(15, 1, 1, 5, NULL, NULL, 'Все хорошо'),
(15, 2, 1, 5, 3, NULL, ''),
(15, 19, 1, 4, NULL, NULL, ''),
(15, 20, 1, 4, NULL, NULL, ''),
(15, 21, 1, 4, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `alias`) VALUES
(1, 'math', 'Математика'),
(2, 'english', 'Английский язык'),
(3, 'informathics', 'Информатика');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `specialization` varchar(50) DEFAULT NULL,
  `group_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `name`, `specialization`, `group_id`) VALUES
(1, 22, '', 'Информатика', NULL),
(2, 23, '', 'Программирование', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `test_ege`
--

CREATE TABLE `test_ege` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `mark` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `patronymic` varchar(20) NOT NULL,
  `user_role` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `surname`, `name`, `patronymic`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin@admin.ad', 'Админов', 'Админ', 'Админович', 1, NULL, '2017-09-25 15:06:37'),
(2, 'super', '727dfbdc1a4ee249f3f08c247a5669d5', 'super@super.su', 'Супер', 'Супер', 'Суперович', 2, '2017-09-25 14:57:17', '2017-09-25 14:57:17'),
(3, 'curator', '8a08422b4ca8a0ab0f443628d627c96b', 'curator@curator.cu', 'Кураторов', 'Куратор', 'Кураторович', 3, '2017-09-25 14:57:57', '2017-09-25 14:57:57'),
(4, 'student', 'abd842186026b1110b67d3e39a96e809', 'student@student.st', 'Петрова ', 'Анна ', 'Николаевна', 5, '2017-09-25 14:58:43', '2017-10-03 18:36:47'),
(5, 'student1', 'abd842186026b1110b67d3e39a96e809', 'student@student.st', 'Денисов', 'Артем ', 'Валерьевич', 5, '2017-09-25 14:58:43', '2017-10-03 18:37:23'),
(22, 'vladgus', '1b12491c473c1e74bd068e65c5842f17', 'gusynin.vlad@gmail.c', 'Гусынин', 'Владислав', 'Игоревич', 4, '2017-10-14 15:23:24', '2017-10-14 15:23:24'),
(23, 'iborisov', '2a803100dee39458287b9c0a04503eb7', 'latentpickuper@gmail', 'Борисов', 'Игорь', 'Владимирович', 4, '2017-10-14 15:24:21', '2017-10-14 15:24:21'),
(24, 'student2', '213ee683360d88249109c2f92789dbc3', 'polina@gmail.com', 'Гагарина', 'Полина', 'Сергеевна', 5, '2017-10-15 03:22:19', '2017-10-15 03:22:19'),
(25, 'student3', 'f6fdffe48c908deb0f4c3bd36c032e72', 'arkadiev@yahoo.com', 'Аркадьев ', 'Петр ', 'Сергеевич', 5, '2017-10-15 03:23:58', '2017-10-15 03:23:58'),
(26, 'admin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'hmel89@mail.ru', 'Хмелева ', 'Наталия ', 'Степановна', 5, '2017-10-15 03:25:04', '2017-10-15 03:25:04');

-- --------------------------------------------------------

--
-- Структура таблицы `user_roles`
--

CREATE TABLE `user_roles` (
  `id_user_role` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_alias` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_roles`
--

INSERT INTO `user_roles` (`id_user_role`, `role_name`, `role_alias`) VALUES
(1, 'Administrator', 'Администратор'),
(2, 'Superviser', 'Супервайзер'),
(3, 'Curator', 'Куратор'),
(4, 'Teacher', 'Преподаватель'),
(5, 'Student', 'Ученик');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `building_ibfk_1` (`building_id`),
  ADD KEY `subjects_ibfk_1` (`subject_id`),
  ADD KEY `grouptype_ibfk_1` (`group_type_id`);

--
-- Индексы таблицы `group_types`
--
ALTER TABLE `group_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `students_in_group`
--
ALTER TABLE `students_in_group`
  ADD PRIMARY KEY (`student_id`,`group_id`),
  ADD KEY `students_in_group_ibfk_1` (`group_id`);

--
-- Индексы таблицы `students_in_lesson`
--
ALTER TABLE `students_in_lesson`
  ADD PRIMARY KEY (`lesson_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `test_ege`
--
ALTER TABLE `test_ege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id_user_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `group_types`
--
ALTER TABLE `group_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `test_ege`
--
ALTER TABLE `test_ege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id_user_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `building_ibfk_1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`),
  ADD CONSTRAINT `grouptype_ibfk_1` FOREIGN KEY (`group_type_id`) REFERENCES `group_types` (`id`),
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Ограничения внешнего ключа таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students_in_group`
--
ALTER TABLE `students_in_group`
  ADD CONSTRAINT `students_in_group_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_in_group_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students_in_lesson`
--
ALTER TABLE `students_in_lesson`
  ADD CONSTRAINT `students_in_lesson_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_in_lesson_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `test_ege`
--
ALTER TABLE `test_ege`
  ADD CONSTRAINT `test_ege_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `test_ege_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
