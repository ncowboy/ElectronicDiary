-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 10 2018 г., 23:05
-- Версия сервера: 5.6.37
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
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '29', NULL),
('curator', '3', 1512294685),
('curator', '32', 1511722365),
('curator', '54', 1512291843),
('student', '24', 1512291161),
('student', '26', 1512290411),
('student', '35', 1511897128),
('student', '36', 1512291427),
('student', '37', 1512209120),
('student', '38', 1512209344),
('student', '39', 1512209367),
('student', '40', 1512209386),
('student', '41', 1512209452),
('student', '42', 1512209610),
('student', '43', 1512210087),
('student', '44', 1512210133),
('student', '45', 1512210259),
('student', '46', 1512210287),
('student', '47', 1512210372),
('student', '48', 1512210391),
('student', '49', 1512210438),
('student', '50', 1512210477),
('student', '52', 1512213413),
('student', '53', 1512214517),
('super', '2', 1511899427),
('super', '34', 1511722660),
('teacher', '23', 1512292363),
('teacher', '4', 1512212829),
('teacher', '51', 1512211167);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1511624927, 1511624927),
('curator', 1, NULL, NULL, NULL, NULL, NULL),
('groups_crud', 2, NULL, NULL, NULL, NULL, NULL),
('groups_crud_self', 2, NULL, NULL, NULL, NULL, NULL),
('menu_catalog', 2, NULL, NULL, NULL, NULL, NULL),
('menu_groups', 2, NULL, NULL, NULL, NULL, NULL),
('menu_lessons', 2, NULL, NULL, NULL, NULL, NULL),
('menu_students', 2, NULL, NULL, NULL, NULL, NULL),
('menu_teachers', 2, NULL, NULL, NULL, NULL, NULL),
('menu_users', 2, NULL, NULL, NULL, NULL, NULL),
('student', 1, NULL, NULL, NULL, NULL, NULL),
('super', 1, NULL, NULL, NULL, 1511624927, 1511624927),
('teacher', 1, NULL, NULL, NULL, NULL, NULL),
('user', 1, NULL, NULL, NULL, NULL, NULL),
('user_index', 2, NULL, NULL, NULL, NULL, NULL),
('users_admin_crud', 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'groups_crud'),
('super', 'groups_crud'),
('teacher', 'groups_crud_self'),
('admin', 'menu_catalog'),
('super', 'menu_catalog'),
('admin', 'menu_groups'),
('super', 'menu_groups'),
('teacher', 'menu_groups'),
('admin', 'menu_lessons'),
('super', 'menu_lessons'),
('admin', 'menu_students'),
('super', 'menu_students'),
('admin', 'menu_teachers'),
('super', 'menu_teachers'),
('admin', 'menu_users'),
('super', 'menu_users'),
('admin', 'user_index'),
('super', 'user_index'),
('admin', 'users_admin_crud');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(5, 2, 1, 1, 2),
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
('m140506_102106_rbac_init', 1511623123),
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
('m170925_140028_add_foreign_keys_for_groups_tables', 1506349159),
('m171125_152804_rbac_init', 1511624927);

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
(19, 24, '89765678990', 'Мама', '87686545656', '', '1998-10-09'),
(21, 26, '89076789098', 'Мама', '89165434567', '', '2000-08-25'),
(32, 53, '0', '0', '0', 'mail@mail.me', NULL),
(33, 36, '0', '0', '0', 'mail@mail.me', NULL),
(34, 54, '0', '0', '0', 'mail@mail.me', NULL);

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
(3, 19),
(3, 21),
(5, 19),
(5, 21),
(7, 19),
(7, 21),
(10, 19),
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
(7, 19, 1, 1, 1, 5, ''),
(7, 21, 1, 1, 1, 3, ''),
(15, 19, 1, 4, NULL, NULL, ''),
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
  `specialization` varchar(50) DEFAULT NULL,
  `group_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `specialization`, `group_id`) VALUES
(1, 22, 'Информатика', NULL),
(2, 23, 'Программирование', NULL),
(4, 4, NULL, NULL),
(5, 54, NULL, NULL);

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
  `email` varchar(128) NOT NULL,
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
(2, 'super', '2ed5d4a15b8e2e9cc22a941e4d32b2cf', 'super@super.su', 'Супер', 'Супер', 'Суперович', 2, '2017-09-25 14:57:17', '2017-11-28 23:03:47'),
(3, 'curator', '6c59130367269a109416e834e17fa55a', 'curator@curator.cu', 'Кураторов', 'Куратор', 'Кураторович', 3, '2017-09-25 14:57:57', '2017-12-03 12:51:25'),
(22, 'vladgus', '1b12491c473c1e74bd068e65c5842f17', 'gusynin.vlad@gmail.c', 'Гусынин', 'Владислав', 'Игоревич', 4, '2017-10-14 15:23:24', '2017-10-14 15:23:24'),
(23, 'iborisov', 'd54d1702ad0f8326224b817c796763c9', 'latentpickuper@gmail.com', 'Борисов', 'Игорь', 'Владимирович', 4, '2017-10-14 15:24:21', '2017-12-03 12:12:43'),
(24, 'student2', '5a3ce88ba9858971291d11275138143c', 'polina@gmail.com', 'Гагарина', 'Полина', 'Сергеевна', 5, '2017-10-15 03:22:19', '2017-12-03 11:52:41'),
(26, 'student3', '2f029a1250c44708d7865338918648af', 'hmel89@mail.ru', 'Хмелева ', 'Наталия ', 'Степановна', 5, '2017-10-15 03:25:04', '2017-12-03 11:40:11'),
(29, 'admin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin@admin.ad', 'Админов', 'Админ', 'Админович', 1, '2017-11-26 21:06:40', '2017-11-26 21:06:40'),
(35, 'supernew', '1c73ade821422451c70da029749aae47', 'latentpickuper@gmail.com', 'BORISOV', 'IGOR', 'Админович', 5, '2017-11-26 21:59:50', '2017-11-28 22:25:28'),
(36, 'igornewstudent', '9ee9d1add6b44588b12df58123d1887e', 'latentpickuper@gmail.com', 'BORISOV', 'IGOR', 'qweqeqweqwe', 5, '2017-11-28 22:26:25', '2017-12-03 11:57:07'),
(53, 'student', '3e3988589fb84f02911017e5255ac63f', 'student@student.st', 'Студентов', 'Студент', 'Студентович', 5, '2017-12-02 14:21:59', '2017-12-02 14:35:17'),
(54, 'teststudent', '41a96e5c9d2139bf3af2555ca21f0bf2', 'latentpickuper@gmail.com', 'teststudent', 'teststudent', 'teststudent', 3, '2017-12-03 11:57:58', '2017-12-03 12:04:03');

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
(0, 'no_role', 'Роль не задана'),
(1, 'admin', 'Администратор'),
(2, 'super', 'Супервайзер'),
(3, 'curator', 'Куратор'),
(4, 'teacher', 'Преподаватель'),
(5, 'student', 'Ученик');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `test_ege`
--
ALTER TABLE `test_ege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблицы `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id_user_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

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
