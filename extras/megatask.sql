-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2013 at 01:27 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `megatask`
--
CREATE DATABASE IF NOT EXISTS `megatask` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `megatask`;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_file_name` varchar(100) NOT NULL,
  `server_file_name` varchar(40) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `original_file_name`, `server_file_name`, `message_id`) VALUES
(1, '', '', 10),
(2, 'zarki.jpg', 'b1ba01a13c7ba2d0ba726acdacab24', 22),
(3, 'zarki.jpg', 'c7ef08d561287f8b147937e8b86d63', 23);

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `email`, `project_id`, `date_sent`) VALUES
(1, 'ma@nabijem.te', 1, '2013-09-12 19:27:11'),
(2, 'ma2@nabijem.te', 1, '2013-09-12 19:34:02'),
(3, 'ma3@nabijem.te', 1, '2013-09-12 19:35:18'),
(4, 'ma@nabijem.te', 10, '2013-09-12 20:03:46'),
(5, 'zzzzzzzz@ue.co.rs', 10, '2013-09-12 22:29:45'),
(6, 'zlatkomicic@yahoo.com', 10, '2013-09-12 22:40:06'),
(7, 'info@ue.co.rs', 10, '2013-09-12 22:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_seen` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `text`, `user_id`, `task_id`, `date`, `user_seen`) VALUES
(1, 'test 1', 1, 1, '2013-09-02 01:00:00', ''),
(2, 'test 2', 2, 1, '2013-09-02 14:00:00', ''),
(3, 'test 1', 1, 2, '2013-09-03 01:00:00', ''),
(4, 'test 2', 2, 2, '2013-09-03 12:00:00', ''),
(5, 'test 3', 2, 3, '2013-09-05 16:31:36', ''),
(6, 'post test', 1, 2, '2013-09-13 10:30:20', ''),
(7, 'back input', 1, 2, '2013-09-13 10:30:44', ''),
(8, 'it''s working now', 1, 2, '2013-09-13 10:33:40', ''),
(9, 'zarki', 1, 2, '2013-09-13 13:59:09', ''),
(10, 'zarki', 1, 2, '2013-09-13 14:02:03', ''),
(11, 'zarki final', 1, 2, '2013-09-13 14:15:57', ''),
(12, 'zarki final', 1, 2, '2013-09-13 14:18:20', ''),
(13, 'zarki final', 1, 2, '2013-09-13 14:18:28', ''),
(14, 'zarki final', 1, 2, '2013-09-13 14:20:46', ''),
(15, 'zarki final', 1, 2, '2013-09-13 14:27:18', ''),
(16, 'zarki final', 1, 2, '2013-09-13 14:28:21', ''),
(17, 'zarki final', 1, 2, '2013-09-13 14:29:33', ''),
(18, 'zarki final', 1, 2, '2013-09-13 14:29:40', ''),
(19, 'zarki final', 1, 2, '2013-09-13 14:30:00', ''),
(20, 'zarki final', 1, 2, '2013-09-13 15:21:42', ''),
(21, 'zzzz', 1, 2, '2013-09-13 15:22:19', ''),
(22, 'zzzz', 1, 2, '2013-09-13 15:23:02', ''),
(23, 'zzzz', 1, 2, '2013-09-13 15:23:16', ''),
(24, 'test invalid file', 1, 2, '2013-09-13 15:25:13', ''),
(25, 'test invalid file', 1, 2, '2013-09-13 15:31:15', ''),
(26, 'not', 1, 2, '2013-09-13 15:31:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `date_created`, `user_id`) VALUES
(1, 'WebProgrammer PHP 21', '2013-09-02 22:00:00', 1),
(2, 'second project', '2013-09-05 22:00:00', 2),
(10, 'sdfsdffgdg', '2013-09-09 17:14:01', 1),
(11, 'zsd', '2013-09-11 07:28:25', 1),
(12, 'asd', '2013-09-11 07:29:14', 1),
(13, 'asd', '2013-09-11 07:29:55', 1),
(14, 'asd', '2013-09-11 07:30:09', 1),
(15, 'sadfgf', '2013-09-11 07:44:54', 1),
(16, 'asdasd', '2013-09-11 07:45:17', 1),
(17, 'asdasd', '2013-09-11 07:46:15', 1),
(18, 'a2', '2013-09-11 07:46:52', 1),
(19, 'a2', '2013-09-11 07:47:13', 1),
(20, 'test project', '2013-09-12 18:18:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE IF NOT EXISTS `project_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_accept` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `email_notification` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`project_id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `user_id`, `project_id`, `active`, `date_sent`, `date_accept`, `checked`, `email_notification`) VALUES
(1, 1, 1, 1, '2013-09-01 22:00:00', '2013-09-03 00:00:00', 1, 0),
(2, 2, 1, 1, '2013-09-01 22:00:00', '2013-09-03 00:00:00', 1, 0),
(3, 2, 2, 1, '2013-09-05 16:37:40', '0000-00-00 00:00:00', 0, 0),
(5, 1, 10, 1, '2013-09-09 17:14:02', '2013-09-09 19:14:02', 1, 0),
(6, 1, 11, 1, '2013-09-11 07:28:25', '2013-09-11 09:28:25', 1, 0),
(7, 1, 12, 1, '2013-09-11 07:29:14', '2013-09-11 09:29:14', 1, 0),
(8, 1, 13, 1, '2013-09-11 07:29:55', '2013-09-11 09:29:55', 1, 0),
(9, 1, 14, 1, '2013-09-11 07:30:09', '2013-09-11 09:30:09', 1, 0),
(10, 1, 15, 1, '2013-09-11 07:44:54', '2013-09-11 09:44:54', 1, 0),
(11, 1, 16, 1, '2013-09-11 07:45:17', '2013-09-11 09:45:17', 1, 0),
(12, 1, 17, 1, '2013-09-11 07:46:15', '2013-09-11 09:46:15', 1, 0),
(13, 1, 18, 1, '2013-09-11 07:46:52', '2013-09-11 09:46:52', 1, 0),
(14, 1, 19, 1, '2013-09-11 07:47:13', '2013-09-11 09:47:13', 1, 0),
(16, 1, 20, 1, '2013-09-12 18:18:25', '2013-09-12 20:18:25', 1, 0),
(17, 2, 20, 0, '2013-09-12 18:22:40', '0000-00-00 00:00:00', 0, 0),
(18, 2, 10, 0, '2013-09-12 22:31:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('3a85f349820e250ff7b8c2139a3c2f2f', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:23.0) Gecko/20100101 Firefox/23.0', 1379373884, ''),
('eed527df243706eed325ab9722d80e4d', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:23.0) Gecko/20100101 Firefox/23.0', 1379086275, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:2:{s:7:"user_id";s:1:"1";s:4:"name";s:6:"Zlatko";}}');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `priority` tinyint(1) NOT NULL,
  `due_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_finished` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `finished_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `project_id` (`project_id`),
  KEY `finished_by` (`finished_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `user_id`, `project_id`, `date_created`, `active`, `priority`, `due_date`, `date_finished`, `finished_by`) VALUES
(1, 'Task 1', 'descripion 1', 1, 1, '2013-09-02 22:00:00', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 'Task 2', '', 2, 1, '2013-09-02 22:00:00', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 'task 3', 'description of task 3', 2, 2, '2013-09-05 16:30:59', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_users`
--

CREATE TABLE IF NOT EXISTS `task_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`task_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `task_users`
--

INSERT INTO `task_users` (`id`, `user_id`, `task_id`) VALUES
(1, 1, 1),
(3, 1, 2),
(2, 2, 1),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `avatar` varchar(35) NOT NULL,
  `email_notification` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `avatar`, `email_notification`) VALUES
(1, 'zlatkomicic@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Zlatko', 'Mićić', '', 0),
(2, 'dominique@pixelcup.ch', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Dominique', 'Eardly', '', 0),
(3, 'zlatkomicic@ue.co.rs', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'zzz', 'zzz', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE IF NOT EXISTS `working_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `started` datetime NOT NULL,
  `finished` datetime NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`task_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `user_id`, `task_id`, `started`, `finished`, `description`) VALUES
(1, 2, 2, '2013-09-08 05:00:00', '2013-09-08 06:05:00', 'description'),
(2, 1, 2, '2013-09-07 00:00:00', '2013-09-07 00:20:00', 'desc'),
(3, 3, 2, '2013-09-02 00:00:00', '2013-09-02 00:28:00', ''),
(4, 1, 2, '2013-09-12 00:00:00', '2013-09-12 00:21:00', ''),
(5, 2, 2, '2013-09-02 00:00:00', '2013-09-02 00:13:00', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_users`
--
ALTER TABLE `project_users`
  ADD CONSTRAINT `project_users_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`finished_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_users`
--
ALTER TABLE `task_users`
  ADD CONSTRAINT `task_users_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD CONSTRAINT `working_hours_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `working_hours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
