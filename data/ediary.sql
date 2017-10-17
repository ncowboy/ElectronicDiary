-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 17 2017 г., 19:06
-- Версия сервера: 5.7.19
-- Версия PHP: 7.1.7

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
  `teacher_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `building_id`, `subject_id`, `group_type_id`, `teacher_id`) VALUES
(2, 3, 3, 2, 1),
(3, 2, 2, 2, 3),
(5, 2, 1, 1, 3),
(7, 1, 1, 1, 1),
(8, 1, 2, 3, 0);

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
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `datetime`, `theme`, `group_id`, `subject_id`) VALUES
(3, '2017-10-24 20:00:00', 'Глаголы', 2, 2),
(4, '2017-10-31 18:00:00', 'Фонетика', 2, 2),
(5, '2017-10-24 20:00:00', 'testтема', 7, 1);

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
  `group_id` int(5) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `parents_name` varchar(50) DEFAULT NULL,
  `parents_number` varchar(20) DEFAULT NULL,
  `birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `user_id`, `group_id`, `phone_number`, `parents_name`, `parents_number`, `birth`) VALUES
(1, 4, NULL, '+1 (111) 111-11-11', 'Мария Ивановна Петрова', '+1 (111) 111-11-11', '1983-11-09'),
(2, 5, 2, '+7(903) 155-55-45', 'Тестстудентовна', '+7(905)125-28-41', '1983-11-09');

-- --------------------------------------------------------

--
-- Структура таблицы `students_in_group`
--

CREATE TABLE `students_in_group` (
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students_in_group`
--

INSERT INTO `students_in_group` (`student_id`, `group_id`) VALUES
(1, 2),
(2, 2),
(1, 3),
(1, 7),
(2, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `students_in_lesson`
--

CREATE TABLE `students_in_lesson` (
  `lesson_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` tinyint(1) DEFAULT NULL,
  `mark_work_at_lesson` tinyint(4) DEFAULT NULL,
  `mark_homework` tinyint(4) DEFAULT NULL,
  `mark_dictation` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students_in_lesson`
--

INSERT INTO `students_in_lesson` (`lesson_id`, `student_id`, `attendance`, `mark_work_at_lesson`, `mark_homework`, `mark_dictation`) VALUES
(3, 1, 1, NULL, NULL, NULL),
(3, 2, NULL, NULL, NULL, NULL),
(5, 1, NULL, NULL, NULL, NULL);

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
  `user_id` int(11) DEFAULT NULL,
  `specialization` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `specialization`) VALUES
(0, NULL, ''),
(1, 8, 'Математика'),
(3, 9, 'Информатика');

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
  `email` varchar(100) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `patronymic` varchar(20) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT '0',
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
(4, 'student', '4369c4fb2a7b43d39634be616efdd8a8', 'student@student.st', 'Петрова ', 'Анна ', 'Николаевна', 5, '2017-09-25 14:58:43', '2017-10-09 18:19:20'),
(5, 'student1', '4369c4fb2a7b43d39634be616efdd8a8', 'student@student.st', 'Денисов', 'Артем ', 'Валерьевич', 5, '2017-09-25 14:58:43', '2017-10-10 17:52:08'),
(8, 'teacher1', '92d2ae7c028098db472bcf582f212b78', 'teacher@teacher.te', 'Гусынин', 'Владислав ', 'Игоревич', 4, '2017-10-10 18:32:17', '2017-10-10 18:35:43'),
(9, 'teacher2', 'ccffb0bb993eeb79059b31e1611ec353', 'teacher2@teacher.te', 'Петрова', 'Анна', 'Юревна', 4, '2017-10-10 18:35:18', '2017-10-10 18:35:18');

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
(0, 'not selected', 'Роль не выбрана'),
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
  ADD KEY `grouptype_ibfk_1` (`group_type_id`),
  ADD KEY `teacher_id` (`teacher_id`);

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
  ADD KEY `group_id` (`group_id`),
  ADD KEY `subject_id` (`subject_id`);

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
  ADD KEY `students_ibfk_1` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `students_in_group`
--
ALTER TABLE `students_in_group`
  ADD KEY `group_id` (`group_id`),
  ADD KEY `student_id` (`student_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_ibfk_1` (`user_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`user_role`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `group_types`
--
ALTER TABLE `group_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `test_ege`
--
ALTER TABLE `test_ege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `grouptype_ibfk_1` FOREIGN KEY (`group_type_id`) REFERENCES `group_types` (`id`),
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Ограничения внешнего ключа таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students_in_group`
--
ALTER TABLE `students_in_group`
  ADD CONSTRAINT `students_in_group_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `students_in_group_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Ограничения внешнего ключа таблицы `students_in_lesson`
--
ALTER TABLE `students_in_lesson`
  ADD CONSTRAINT `students_in_lesson_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`),
  ADD CONSTRAINT `students_in_lesson_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `test_ege`
--
ALTER TABLE `test_ege`
  ADD CONSTRAINT `test_ege_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `test_ege_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`id_user_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
