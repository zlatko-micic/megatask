-- phpMyAdmin SQL Dump
-- version 4.0.7-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2013 at 12:15 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `original_file_name` varchar(100) NOT NULL,
  `server_file_name` varchar(40) NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `original_file_name`, `server_file_name`, `message_id`) VALUES
(1, '', '', 10),
(2, 'zarki.jpg', 'b1ba01a13c7ba2d0ba726acdacab24', 22),
(3, 'zarki.jpg', 'c7ef08d561287f8b147937e8b86d63', 23),
(4, 'h3.jpg', '04c7ed1d439d551aa5fd29e781d23ee9.jpg', 27),
(5, 'h4.jpg', '5efa3797e8aa2093ff4d227dbeb75122.jpg', 37),
(6, 'h2.jpg', 'a09b42fc1e8b26b98526f520b3471571.jpg', 42),
(7, 'h2.jpg', '3e5e3afce2e438f3240079a7648d7d93.jpg', 43),
(8, 'h3.jpg', '77005714997584acbce852b7546b8dde.jpg', 44);

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `email`, `project_id`, `date_sent`) VALUES
(10, 'zlatko@ue.co.rs', 1, '2013-09-26 15:17:55'),
(11, 'sdasda@ue.co.rs', 1, '2013-09-26 15:28:20'),
(12, 'fgchfxdz@ue.co.rs', 1, '2013-09-26 15:29:06'),
(13, 'zlatko@ue.co.rs', 23, '2013-09-26 15:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

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
(26, 'not', 1, 2, '2013-09-13 15:31:45', ''),
(27, 'mnasbdakjsdb', 1, 2, '2013-09-19 17:20:23', ''),
(28, 'test msg', 1, 9, '2013-09-26 06:40:28', ''),
(29, 'asdasdasd', 1, 8, '2013-09-26 07:09:27', ''),
(30, 'asdasdasd', 1, 8, '2013-09-26 07:10:07', ''),
(31, 'asdasdasd', 1, 8, '2013-09-26 07:12:19', ''),
(32, 'dgfdghs', 1, 8, '2013-09-26 07:12:26', ''),
(33, 'fdfdfd', 1, 8, '2013-09-26 07:12:42', ''),
(34, 'fdsghf', 1, 9, '2013-09-26 07:13:34', ''),
(35, 'sadasdasd', 1, 9, '2013-09-26 07:14:50', ''),
(36, 'asd', 1, 9, '2013-09-26 07:16:52', ''),
(37, 'asdasdasdasd', 1, 9, '2013-09-26 07:17:26', ''),
(38, 'test message', 1, 1, '2013-09-26 16:23:54', ''),
(39, 'asdasd', 1, 1, '2013-09-26 16:26:00', ''),
(40, 'asdasd', 1, 1, '2013-09-26 16:26:13', ''),
(41, 'test', 1, 1, '2013-09-26 16:28:09', ''),
(42, 'kjshfkasjfb', 1, 1, '2013-09-26 16:29:07', ''),
(43, 'kjshfkasjfb', 1, 1, '2013-09-26 16:31:08', ''),
(44, 'jhvhjhjm', 1, 3, '2013-09-26 16:44:54', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `date_created`, `user_id`) VALUES
(1, 'WebProgrammer PHP 21', '2013-09-02 22:00:00', 1),
(2, 'second project', '2013-09-05 22:00:00', 2),
(10, 'Third project', '2013-09-09 17:14:01', 3),
(11, 'zsd', '2013-09-11 07:28:25', 1),
(12, 'asd', '2013-09-11 07:29:14', 1),
(13, 'asd', '2013-09-11 07:29:55', 1),
(14, 'asd', '2013-09-11 07:30:09', 1),
(15, 'sadfgf', '2013-09-11 07:44:54', 1),
(16, 'asdasd', '2013-09-11 07:45:17', 1),
(17, 'asdasd', '2013-09-11 07:46:15', 1),
(18, 'a2', '2013-09-11 07:46:52', 1),
(19, 'a2', '2013-09-11 07:47:13', 1),
(20, 'test project', '2013-09-12 18:18:25', 1),
(21, 'title', '2013-09-19 17:14:58', 1),
(22, 'My first project', '2013-09-24 14:55:45', 5),
(23, 'test', '2013-09-26 14:08:47', 1),
(24, 'full project', '2013-09-26 16:19:45', 1),
(25, 'eyrurtury', '2013-09-26 16:52:54', 1),
(26, 'third', '2013-09-26 21:49:44', 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

DROP TABLE IF EXISTS `project_users`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `user_id`, `project_id`, `active`, `date_sent`, `date_accept`, `checked`, `email_notification`) VALUES
(1, 1, 1, 1, '2013-09-01 22:00:00', '2013-09-03 00:00:00', 1, 0),
(2, 2, 1, 1, '2013-09-01 22:00:00', '2013-09-03 00:00:00', 1, 0),
(3, 2, 2, 1, '2013-09-05 16:37:40', '0000-00-00 00:00:00', 0, 0),
(5, 3, 10, 1, '2013-09-09 17:14:02', '2013-09-09 19:14:02', 1, 0),
(6, 1, 2, 1, '2013-09-11 07:28:25', '2013-09-11 09:28:25', 1, 0),
(7, 1, 12, 1, '2013-09-11 07:29:14', '2013-09-11 09:29:14', 1, 0),
(8, 1, 13, 1, '2013-09-11 07:29:55', '2013-09-11 09:29:55', 1, 0),
(9, 1, 14, 1, '2013-09-11 07:30:09', '2013-09-11 09:30:09', 1, 0),
(10, 1, 15, 1, '2013-09-11 07:44:54', '2013-09-11 09:44:54', 1, 0),
(11, 1, 16, 1, '2013-09-11 07:45:17', '2013-09-11 09:45:17', 1, 0),
(12, 1, 17, 1, '2013-09-11 07:46:15', '2013-09-11 09:46:15', 1, 0),
(13, 1, 18, 1, '2013-09-11 07:46:52', '2013-09-11 09:46:52', 1, 0),
(14, 1, 19, 1, '2013-09-11 07:47:13', '2013-09-11 09:47:13', 1, 0),
(16, 1, 20, 1, '2013-09-12 18:18:25', '2013-09-12 20:18:25', 1, 0),
(17, 1, 10, 1, '2013-09-12 18:22:40', '0000-00-00 00:00:00', 0, 0),
(18, 2, 10, 0, '2013-09-12 22:31:00', '0000-00-00 00:00:00', 0, 0),
(21, 1, 21, 1, '2013-09-19 17:14:58', '2013-09-19 19:14:58', 1, 0),
(22, 3, 1, 0, '2013-09-19 17:35:10', '0000-00-00 00:00:00', 0, 0),
(23, 5, 22, 1, '2013-09-24 14:55:45', '2013-09-24 16:55:45', 1, 0),
(24, 1, 23, 1, '2013-09-26 14:08:47', '2013-09-26 16:08:47', 1, 0),
(25, 3, 23, 0, '2013-09-26 15:33:22', '0000-00-00 00:00:00', 0, 0),
(26, 1, 24, 1, '2013-09-26 16:19:45', '2013-09-26 18:19:45', 1, 0),
(27, 1, 25, 1, '2013-09-26 16:52:54', '2013-09-26 18:52:54', 1, 0),
(28, 1, 22, 0, '2013-09-26 21:48:14', '0000-00-00 00:00:00', 0, 0),
(29, 2, 26, 1, '2013-09-26 21:49:44', '2013-09-26 23:49:44', 1, 0),
(30, 1, 26, 0, '2013-09-26 21:49:48', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
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
('b1c8d01b0d0c1400040829d0b29ce783', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:23.0) Gecko/20100101 Firefox/23.0', 1380233435, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:2:{s:7:"user_id";s:1:"1";s:4:"name";s:6:"Zlatko";}}');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `user_id`, `project_id`, `date_created`, `active`, `priority`, `due_date`, `date_finished`, `finished_by`) VALUES
(1, 'Task 1', 'descripion 1', 1, 1, '2013-09-02 22:00:00', 1, 1, '2013-09-30 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 'Task 2', '', 2, 1, '2013-09-02 22:00:00', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 'task 3', 'description of task 3', 2, 1, '2013-09-05 16:30:59', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'new task', 'description', 1, 1, '2013-09-26 06:25:27', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 'task 4', 'something to do', 1, 1, '2013-09-26 06:27:12', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(6, 'more users', 'testing', 1, 1, '2013-09-26 06:36:43', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(7, 'moaaaar', 'bla bla', 1, 1, '2013-09-26 06:38:13', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(8, 'moaaaar', 'bla bla', 1, 1, '2013-09-26 06:38:59', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(9, 'asdasd', 'asd', 1, 1, '2013-09-26 06:39:32', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(10, 'asd', 'asd', 1, 1, '2013-09-26 06:47:12', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(11, 'asd', 'asd', 1, 1, '2013-09-26 06:49:52', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(12, 'ttttt', 'ttttt', 1, 23, '2013-09-26 14:09:07', 0, 1, '2013-09-26 09:00:00', '0000-00-00 00:00:00', NULL),
(13, 'asdasd', 'asdasd', 1, 23, '2013-09-26 14:19:20', 1, 1, '2013-09-18 00:00:00', '0000-00-00 00:00:00', NULL),
(14, 'title', 'decription', 1, 24, '2013-09-26 16:20:14', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(15, 'due date test', 'test', 1, 24, '2013-09-26 16:20:36', 1, 1, '2013-09-27 00:00:00', '0000-00-00 00:00:00', NULL),
(16, 'first task', 'desc', 5, 22, '2013-09-26 21:44:22', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_users`
--

DROP TABLE IF EXISTS `task_users`;
CREATE TABLE IF NOT EXISTS `task_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`task_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `task_users`
--

INSERT INTO `task_users` (`id`, `user_id`, `task_id`) VALUES
(1, 1, 1),
(3, 1, 2),
(6, 1, 8),
(9, 1, 11),
(10, 1, 12),
(11, 1, 13),
(12, 1, 14),
(13, 1, 15),
(2, 2, 1),
(7, 2, 8),
(8, 2, 9),
(5, 3, 1),
(4, 3, 3),
(14, 5, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(70) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `avatar` varchar(35) NOT NULL,
  `email_notification` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `avatar`, `email_notification`) VALUES
(1, 'zlatkomicic@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Zlatko', 'Mićić', '', 0),
(2, 'dominique@pixelcup.ch', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Dominique', 'Eardly', '', 0),
(3, 'karl-huber@bluewin.ch', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Karl', 'Huber', '', 0),
(5, 'ph@nomail.ch', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Peter', 'Hans', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

DROP TABLE IF EXISTS `working_hours`;
CREATE TABLE IF NOT EXISTS `working_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finished` datetime NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`task_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `user_id`, `task_id`, `started`, `finished`, `description`) VALUES
(1, 2, 2, '2013-09-08 03:00:00', '2013-09-08 06:05:00', 'description'),
(2, 1, 2, '2013-09-06 22:00:00', '2013-09-07 00:20:00', 'desc'),
(3, 3, 2, '2013-09-01 22:00:00', '2013-09-02 00:28:00', ''),
(5, 1, 2, '2013-09-26 12:00:00', '2013-09-26 16:15:27', ''),
(7, 1, 1, '2013-09-26 14:45:19', '2013-09-26 16:45:41', 'description'),
(8, 1, 1, '2013-09-26 14:45:50', '2013-09-26 16:58:47', ''),
(9, 1, 7, '2013-09-26 14:59:41', '2013-09-26 16:59:46', ''),
(10, 1, 7, '2013-09-26 14:59:49', '2013-09-26 17:00:48', ''),
(11, 1, 1, '2013-09-26 15:00:50', '2013-09-26 17:26:44', ''),
(12, 1, 2, '2013-09-26 16:50:39', '2013-09-26 18:53:15', ''),
(13, 1, 13, '2013-09-26 17:36:56', '2013-09-26 19:37:33', ''),
(14, 1, 13, '2013-09-26 17:40:08', '2013-09-26 19:48:46', ''),
(15, 5, 16, '2013-09-26 21:45:58', '2013-09-26 23:46:08', ''),
(16, 1, 14, '2013-09-26 21:53:55', '2013-09-26 23:54:21', '');

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
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_users`
--
ALTER TABLE `project_users`
  ADD CONSTRAINT `project_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_users_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`finished_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_users`
--
ALTER TABLE `task_users`
  ADD CONSTRAINT `task_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_users_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD CONSTRAINT `working_hours_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `working_hours_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
