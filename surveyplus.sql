-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2023 at 12:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveyplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(45) NOT NULL,
  `answer_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answer_category`
--

CREATE TABLE `answer_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answer_category`
--

INSERT INTO `answer_category` (`id`, `name`, `createdOn`) VALUES
(1, 'one choice', '2023-03-21 13:45:59'),
(2, 'multiple choice', '2023-03-21 13:45:59'),
(3, 'free text', '2023-03-21 13:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'male'),
(2, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `handle` varchar(45) DEFAULT NULL,
  `signature` varchar(45) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `first_name`, `last_name`, `username`, `dob`, `createdOn`, `handle`, `signature`, `isActive`, `user_id`, `role_id`, `gender_id`) VALUES
(1, 'Flash', 'Walker', 'flashwalker', '2023-03-08', '2023-03-19 21:46:54', '@flashwalker', 'fwalker', 1, 1, 2, 1),
(2, 'Mary', 'Huphman', 'maryhuphman', '2023-03-25', '2023-03-23 11:00:41', '@maryhuphman', 'Mary Huphman', 1, 2, 2, 2),
(3, 'Loli', 'Complex', 'lolita', '2023-03-24', '2023-03-23 11:13:17', '@lolita', 'Lolita', 1, 3, 2, 2),
(4, 'Lola', 'Mad', 'lolamad', '2023-03-24', '2023-03-23 12:06:05', '@lolamad', 'LolaMad', 1, 4, 2, 1),
(9, 'Genesis', 'Samuel', 'geney', '2023-03-24', '2023-03-23 22:42:38', '@geney', 'Genesis', 1, 5, 2, 2),
(10, 'Noise', 'Randell', 'noise', '2023-03-23', '2023-03-23 23:12:03', '@noise', 'fwalker', 1, 6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text DEFAULT NULL,
  `survey_id` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `name`, `description`, `survey_id`, `createdOn`, `answer_category_id`) VALUES
(4, 'So the existence of ecommerce is considered a', NULL, 5, '2023-03-22 08:48:06', 3),
(5, 'What type of YouTube videos do you like', NULL, 1, '2023-03-22 08:52:07', 3),
(6, 'How do you do?', NULL, 6, '2023-03-22 08:57:37', 2),
(7, 'Are alright today?', NULL, 1, '2023-03-22 08:58:50', 1),
(8, 'Are you happy?', '[\"Yes\",\"No\"]', 6, '2023-03-23 03:39:06', 1),
(9, 'Do you like long YouTube videos?', '[\"Yes\"]', 13, '2023-03-23 11:32:02', 1),
(10, 'Do you like cartoon YouTube videos?', '[\"Yes\",\"No\"]', 12, '2023-03-23 11:33:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `updatedOn` datetime DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `publishedOn` datetime DEFAULT NULL,
  `expiresOn` date DEFAULT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `updatedOn`, `name`, `description`, `published`, `createdOn`, `publishedOn`, `expiresOn`, `profile_id`) VALUES
(1, NULL, 'What type of YouTube videos do you like', 'This survey is to get information about what ', 1, '2023-03-21 14:04:28', '2023-03-21 15:04:28', '2023-03-31', 1),
(5, NULL, 'Ecommerce', 'This is a short description just to test how ', 0, '2023-03-21 20:15:55', NULL, '2023-03-24', 1),
(6, NULL, 'Another interesting Survey', 'This is to check out how it works', 1, '2023-03-21 20:19:31', '2023-03-21 21:19:31', '2023-03-23', 1),
(9, NULL, 'What type of YouTube videos do you like', 'This is quite interesting', 1, '2023-03-23 11:02:42', '2023-03-23 12:02:42', '2023-03-24', 2),
(10, NULL, 'What is wrong with your country', 'This survey is to verify and tell us what is ', 1, '2023-03-23 11:03:57', '2023-03-23 12:03:57', '2023-03-25', 2),
(11, NULL, 'Is it ok to overwork myself so much?', 'Survey to find out if i really have to overwo', 0, '2023-03-23 11:04:49', NULL, '2023-03-24', 2),
(12, '2023-03-23 12:36:27', 'This is my first survey', 'This is an interesting survey', 0, '2023-03-23 11:13:43', '0000-00-00 00:00:00', '2023-03-24', 3),
(13, NULL, 'What type of YouTube videos do you like', 'This survey is to know more about the survey ', 1, '2023-03-23 11:26:48', '2023-03-23 12:26:48', '2023-03-25', 3),
(14, NULL, 'Another survey', 'This is just another survey', 1, '2023-03-23 12:06:46', '2023-03-23 13:06:46', '2023-03-24', 4),
(15, NULL, 'What type of YouTube videos do you like', 'This is survey to check types', 0, '2023-03-23 12:08:26', NULL, '2023-04-06', 4),
(16, NULL, 'Micheal Angelo Survey', 'This survey is just a test survey', 0, '2023-03-23 22:12:47', NULL, '2023-03-25', 4),
(21, NULL, 'Survey to checkout error on creation of new a', 'Just a test to see error', 0, '2023-03-23 23:24:54', NULL, '2023-03-31', 10);

-- --------------------------------------------------------

--
-- Table structure for table `survey_taker`
--

CREATE TABLE `survey_taker` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_taker_answer`
--

CREATE TABLE `survey_taker_answer` (
  `id` int(11) NOT NULL,
  `survey_taker_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `isAdmin`, `createdOn`) VALUES
(1, 'nani@email.com', '$2y$10$WaW/QXCK/Mla.h7renVvrOXvx5gCKpp0hkMAvTAV5f8bAQZ5BOACe', 0, '2023-03-18 14:31:53'),
(2, 'mary@email.com', '$2y$10$.95aWlT6sV/9Ipif8zxMVuZqYZ1N0NWxVddWgAQyOMro2VsmPuKkC', 0, '2023-03-20 01:20:35'),
(3, 'loli@email.com', '$2y$10$hklmHHHlI3tpV2uqesxcEuD2DoZM1QOooQvJlFOmJwle4eZo7Z7ey', 0, '2023-03-23 11:12:49'),
(4, 'lola@email.com', '$2y$10$1MoHth6GWLiraQc01KAR5eJToULlvI7LIh.cBEzLkjgHEYu5DyAsa', 0, '2023-03-23 12:05:30'),
(5, 'genesis@email.com', '$2y$10$3TmfphU8qJhovzmWK9Wl4.5.d.ued.pMKIJI/q3Sfd3Z01sW6//8q', 0, '2023-03-23 22:41:55'),
(6, 'noise@email.com', '$2y$10$WkjpFE0LFQIk40yzAOgWO.ibikkOGTmsd875GItT9rAnY3.cy7V7G', 0, '2023-03-23 23:11:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answer_answer_category1_idx` (`answer_category_id`);

--
-- Indexes for table `answer_category`
--
ALTER TABLE `answer_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_profile_user1_idx` (`user_id`),
  ADD KEY `fk_profile_role1_idx` (`role_id`),
  ADD KEY `fk_profile_gender1_idx` (`gender_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_survey2_idx` (`survey_id`),
  ADD KEY `fk_question_answer_category1_idx` (`answer_category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_survey_user_idx` (`profile_id`);

--
-- Indexes for table `survey_taker`
--
ALTER TABLE `survey_taker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`,`survey_id`),
  ADD KEY `fk_Survey_taker_survey1_idx` (`survey_id`);

--
-- Indexes for table `survey_taker_answer`
--
ALTER TABLE `survey_taker_answer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `survey_taker_id_UNIQUE` (`survey_taker_id`,`question_id`,`answer_id`),
  ADD KEY `fk_survey_taker_answer_survey_taker1_idx` (`survey_taker_id`),
  ADD KEY `fk_survey_taker_answer_question1_idx` (`question_id`),
  ADD KEY `fk_survey_taker_answer_answer1_idx` (`answer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answer_category`
--
ALTER TABLE `answer_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `survey_taker`
--
ALTER TABLE `survey_taker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_taker_answer`
--
ALTER TABLE `survey_taker_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `fk_answer_answer_category1` FOREIGN KEY (`answer_category_id`) REFERENCES `answer_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profile_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profile_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_answer_category1` FOREIGN KEY (`answer_category_id`) REFERENCES `answer_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_question_survey2` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `fk_survey_user` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `survey_taker`
--
ALTER TABLE `survey_taker`
  ADD CONSTRAINT `fk_Survey_taker_survey1` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `survey_taker_answer`
--
ALTER TABLE `survey_taker_answer`
  ADD CONSTRAINT `fk_survey_taker_answer_answer1` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_survey_taker_answer_question1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_survey_taker_answer_survey_taker1` FOREIGN KEY (`survey_taker_id`) REFERENCES `survey_taker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
