-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2023 at 10:39 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neha`
--

-- --------------------------------------------------------

--
-- Table structure for table `meetinginsert`
--

DROP TABLE IF EXISTS `meetinginsert`;
CREATE TABLE IF NOT EXISTS `meetinginsert` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `organizer` varchar(250) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `songs` varchar(250) NOT NULL,
  `createdby` varchar(250) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;;

--
-- Dumping data for table `meetinginsert`
--

INSERT INTO `meetinginsert` (`id`, `date`, `time`, `title`, `description`, `organizer`, `amount`, `songs`, `createdby`, `created_on`) VALUES
(1, '2023-11-21', '00:00:00', 'deva conceptwewewewe', 'Strange and Weird Song Ideas. Here are some strange and weird topics for your trippy music! Marshmallow donkey; Alien superstar; Stuck', 'Deva and team', '4400000', 'Thean thean song', 'user', '0000-00-00'),
(2, '2023-11-21', '13:08:00', 'u1 concept2', 'Strange and Weird Song Ideas. Here are some strange and weird topics for your trippy music! Marshmallow donkey; Alien superstar; Stuck', 'Deva and team23', '40000', 'Thean thean song', 'user', '0000-00-00'),
(3, '2023-11-21', '00:00:00', 'ded', 'ddd', 'ww', '33', 'cc', 'user', '2023-11-21'),
(4, '2023-11-21', '00:00:00', 'ded', 'ddd', 'ww', '33', 'cc', 'user', '2023-11-21'),
(5, '2023-11-21', '00:00:00', 'ded', 'ddd', 'ww', '33', 'cc', 'user', '2023-11-21'),
(6, '2023-11-21', '00:00:00', 'ded', 'ddd', 'ww', '33', 'cc', 'user', '2023-11-21'),
(7, '2023-11-21', '00:00:00', 'ded', 'ddd', 'ww', '33', 'cc', 'user', '2023-11-21'),
(8, '2023-11-19', '00:00:00', 'deva concept', 'Strange and Weird Song Ideas. Here are some strange and weird topics for your trippy music! Marshmallow donkey; Alien superstar; Stuck', 'Deva and team', '400000', 'Thean thean song', 'user', '2023-11-21'),
(9, '2023-11-22', '16:03:00', 'xxxxxxxx', 'yyyyyyyyyyyy', 'zzzzzzzzzz', '44444', 'nnnnnnnnnnnnn', 'user', '2023-11-22'),
(10, '2023-11-20', '16:41:00', 'visali', 'sdfghj', 'nbv', '300000', 'cvbnm', 'user', '2023-11-22'),
(11, '2023-11-23', '15:43:00', 'priyaaa', 'vhvhvhvh', 'njnjn', '30000', 'eeee', 'user', '2023-11-22'),
(12, '2023-11-24', '15:44:00', 'visali222', 'sdfghjk', 'xcvbn', '300000', 'mnbv', 'user', '2023-11-22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
