-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 01:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rythm`
--

-- --------------------------------------------------------

--
-- Table structure for table `addsongsinevent`
--

CREATE TABLE `addsongsinevent` (
  `eventid` int(6) NOT NULL,
  `tilte` int(6) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `songslistid` int(6) NOT NULL,
  `pairname` varchar(6) NOT NULL,
  `created_by` varchar(6) NOT NULL,
  `created_on` time(6) NOT NULL,
  `singer_type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addsongsinevent`
--

INSERT INTO `addsongsinevent` (`eventid`, `tilte`, `date`, `time`, `songslistid`, `pairname`, `created_by`, `created_on`, `singer_type`) VALUES
(0, 0, '0000-00-00', '00:00:00.000000', 0, '?', '?', '14:42:42.000000', '?'),
(0, 0, '0000-00-00', '00:00:00.000000', 0, '?', '?', '14:42:43.000000', '?'),
(2, 0, '2024-03-14', '18:52:00.000000', 9, '\'kk\',\'', 'rythmw', '15:04:38.000000', 'singer'),
(1, 0, '2024-03-07', '14:46:00.000000', 18, '\'john\'', 'rythmw', '15:06:23.000000', 'singer');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `createdon` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`, `createdon`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2024-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `daily_event`
--

CREATE TABLE `daily_event` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `organizer` varchar(2000) NOT NULL,
  `amount` varchar(1000) NOT NULL,
  `songs` varchar(2000) NOT NULL,
  `singer_type` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `createdby` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_event`
--

INSERT INTO `daily_event` (`id`, `users_id`, `title`, `description`, `date`, `time`, `organizer`, `amount`, `songs`, `singer_type`, `created_on`, `createdby`) VALUES
(1, 3, 'deva', 'sdfghjuytrewsdfgfd', '2024-03-07', '14:46:00', 'deve and team', '300000', '-', 'singer', '2024-03-07 13:44:59', 'rythmwoods@gmail.in'),
(2, 3, 'u1', 'edftgyuiuytrewsxcvbnhgfrew', '2024-03-14', '18:52:00', 'u1 &team', '200000', '-', 'singer', '2024-03-07 13:47:04', 'rythmwoods@gmail.in'),
(3, 3, 'erwewer', 'werwerssweffdd', '2024-03-05', '15:52:00', 'deva and group', '5454545', '-', 'singer', '2024-03-07 13:49:19', 'rythmwoods@gmail.in'),
(4, 3, 'ddss', 'erewrewr', '2024-03-12', '15:54:00', 'dsfsdf', '4545', '-', '', '2024-03-07 13:51:47', 'rythmwoods@gmail.in'),
(5, 3, 'ssdsad', 'dfdsd', '2024-03-27', '15:58:00', 'erwer', '4545454545', '-', '', '2024-03-07 13:56:07', 'rythmwoods@gmail.in'),
(6, 3, 'asas', 'sewew', '2024-03-22', '15:59:00', 'njnjn', '3434', '-', '', '2024-03-07 13:59:43', 'rythmwoods@gmail.in'),
(7, 0, 'mkjk', 'kml', '2024-03-07', '15:02:00', 'k', '7000', '-', '', '2024-03-07 14:03:46', ''),
(8, 0, 'erer', 'werfsdf', '2024-03-17', '15:05:00', 'erwer', '32333', '-', '', '2024-03-07 14:04:33', ''),
(9, 0, 'karthis cocept', 'loiuytredcvbnklkjhgfcvbnkl', '2024-03-23', '15:08:00', 'karthick team', '400000', '-', '', '2024-03-07 14:05:36', ''),
(10, 0, 'New', 'fcsdxf', '2024-08-29', '00:52:00', 'New', '2000', '-', '', '2024-08-05 09:53:16', ''),
(11, 0, 'Singing', 'Singing', '2024-09-04', '12:00:00', 'XYZ', '10000', '-', '', '2024-09-04 14:02:55', ''),
(12, 0, '$title', '$description', '0000-00-00', '00:00:00', '$organizer', '$amount', '-', '', '2025-02-27 20:52:03', '$username'),
(13, 0, '$title', '$description', '0000-00-00', '00:00:00', '$organizer', '$amount', '-', '', '2025-03-24 14:30:56', '$username'),
(14, 0, '$title', '$description', '0000-00-00', '00:00:00', '$organizer', '$amount', '-', '', '2025-03-24 14:30:57', '$username'),
(15, 3, 'rytuu', 'ytytu', '2025-03-25', '14:19:00', 'uyyuyiui', '100000000', '-', '', '2025-03-25 12:19:22', 'rythmwoods@gmail.in'),
(16, 3, 'rytuu', 'ytytu', '2025-03-25', '14:19:00', 'uyyuyiui', '100000000', '-', '', '2025-03-25 12:19:45', 'rythmwoods@gmail.in'),
(17, 3, 'rytuu', 'ytytu', '2025-03-25', '14:19:00', 'uyyuyiui', '100000000', '-', '', '2025-03-25 12:21:20', 'rythmwoods@gmail.in'),
(19, 3, 'hhhhh', 'kkkk', '2025-04-01', '12:47:00', 'kkkk', '37642', '-', '', '2025-04-01 12:48:08', 'rythmwoods@gmail.in');

-- --------------------------------------------------------

--
-- Table structure for table `daily_task`
--

CREATE TABLE `daily_task` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `completed_date` varchar(50) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `singer_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daily_task`
--

INSERT INTO `daily_task` (`id`, `user_id`, `title`, `description`, `date`, `completed_date`, `created`, `status`, `singer_type`) VALUES
(1, 1, 'Email', ' qwerty', '2022-09-23', '2022-09-23 09:29:11', '2022-09-23', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `eventpayment`
--

CREATE TABLE `eventpayment` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `Received_type` varchar(6) NOT NULL,
  `eventid` int(11) NOT NULL,
  `createdon` date NOT NULL,
  `createdby` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eventpayment`
--

INSERT INTO `eventpayment` (`id`, `amount`, `date`, `Received_type`, `eventid`, `createdon`, `createdby`) VALUES
(1, 3000, NULL, '', 1, '2024-03-07', 'xxx'),
(0, 0, '2025-04-10', 'cash', 0, '0000-00-00', ''),
(2, 2000, '2025-04-10', 'cash', 1, '2025-04-10', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `following_details`
--

CREATE TABLE `following_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_master_id` int(11) NOT NULL,
  `following_sts` int(11) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `following_details`
--

INSERT INTO `following_details` (`id`, `user_id`, `role_master_id`, `following_sts`, `created_on`) VALUES
(1, 1, 3, 1, '2024-02-21'),
(148, 10, 3, 1, '0000-00-00'),
(149, 15, 3, 1, '0000-00-00'),
(150, 10, 1, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`id`, `user_name`, `otp`) VALUES
(4, 'devika', 6831543),
(14, 'sanjay', 2192528),
(28, 'smk', 2158751),
(39, 'basker', 2716965),
(57, 'Gopalabr', 1857094),
(67, 'Manoj ', 3205804),
(71, 'ganesan', 2451587),
(72, 'Pioneer Suresh', 5086585),
(81, 'hnspad', 8996524),
(84, 'Balaji', 8345127),
(88, 'admin', 7494447),
(91, 'CGPMG', 7739060),
(148, 'sudha65', 8423036),
(153, 'prabhu', 7484619),
(155, 'praveen', 7161862);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `language_code` varchar(255) NOT NULL,
  `singer_type` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `language_code`, `singer_type`, `status`) VALUES
(1, 'Tamil', 'ta', 'singer', 'acitve'),
(2, 'Hindi', 'hi', '', ''),
(3, 'Malayalam', 'ma', '', ''),
(4, 'Telugu', 'te', '', ''),
(5, 'Sinhala', 'si', '', ''),
(6, 'English', 'en', '', ''),
(7, 'Bengali', 'Be', '', ''),
(10, 'tamil', '', 'singer', 'active'),
(11, 'English', '', 'singer', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `lyrics`
--

CREATE TABLE `lyrics` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `language_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `singer_type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `masters_menu`
--

CREATE TABLE `masters_menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_description` varchar(255) DEFAULT NULL,
  `menu_order` varchar(255) DEFAULT NULL,
  `menu_class` varchar(255) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `call_method` varchar(125) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `masters_menu`
--

INSERT INTO `masters_menu` (`id`, `menu_name`, `menu_description`, `menu_order`, `menu_class`, `menu_url`, `call_method`, `created_by`, `created_on`) VALUES
(1, 'Neha Girish', 'Album', '1', 'emp', 'Album', 'Album()', 1, '2020-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `masters_sub_menu`
--

CREATE TABLE `masters_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `call_method` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `masters_sub_menu`
--

INSERT INTO `masters_sub_menu` (`id`, `menu_id`, `name`, `call_method`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'Music_Directors', 'music_director()', 1, 1, '2020-12-01 00:00:00', NULL, NULL),
(3, 1, 'Add_Song', 'songs()', 1, 1, '2020-12-01 00:00:00', NULL, NULL),
(4, 1, 'Event Planer', 'calendar()', 1, 1, '2020-12-01 00:00:00', NULL, NULL),
(5, 1, 'Add Event', 'calendaradd()', 1, 1, '2021-02-25 00:00:00', NULL, NULL),
(6, 1, 'Users', 'Users()', 1, 1, '2021-02-25 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(250) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `movie_name`, `created_on`, `created_by`) VALUES
(1, 'villu', '2024-03-07', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `movie_composer`
--

CREATE TABLE `movie_composer` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `composer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movie_singer`
--

CREATE TABLE `movie_singer` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `singer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_directors`
--

CREATE TABLE `music_directors` (
  `id` int(11) NOT NULL,
  `music_director_name` varchar(255) NOT NULL,
  `singer_type` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `singer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_directors`
--

INSERT INTO `music_directors` (`id`, `music_director_name`, `singer_type`, `status`, `singer_id`) VALUES
(1, 'AR Rahman', 'singer', 'inactive', 1),
(7, 'Illayaraja', '', '', 1),
(8, 'Vidyasagar', '', '', 1),
(9, 'D Imman', '', '', 1),
(10, 'Yuvan Shankar Raja', '', '', 1),
(11, 'Ilayaraja', 'singer', 'active', 0),
(12, 'illayaraj', 'singer', 'active', 0),
(13, 'Janahi', 'singer', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `otptable`
--

CREATE TABLE `otptable` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `confirmpassword` varchar(250) NOT NULL,
  `otpcode` varchar(250) NOT NULL,
  `created_on` date NOT NULL,
  `modify_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otptable`
--

INSERT INTO `otptable` (`id`, `email`, `password`, `confirmpassword`, `otpcode`, `created_on`, `modify_on`) VALUES
(15, 'priyadevi09404@gmail.com', '12345678', '12345678', '4016', '2024-01-22', '0000-00-00'),
(14, 'priyadevi09404@gmail.com', '12345678', '12345678', '8055', '2024-01-22', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `id` int(11) NOT NULL,
  `username` varchar(2000) NOT NULL,
  `username_id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `post_type` varchar(250) NOT NULL,
  `postimg` varchar(2000) NOT NULL,
  `postvideos` varchar(2000) NOT NULL,
  `location` varchar(250) NOT NULL,
  `posters_caption` varchar(2000) NOT NULL,
  `posters_hashtag` varchar(2000) NOT NULL,
  `likestatus` int(11) NOT NULL,
  `liker_id` int(11) NOT NULL,
  `likesdate` date NOT NULL,
  `ownlikessts` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `filepath` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`id`, `username`, `username_id`, `poster_id`, `post_type`, `postimg`, `postvideos`, `location`, `posters_caption`,`poster_hastag`, `likestatus`, `liker_id`, `likesdate`, `ownlikessts`, `status`, `created_on`, `filepath`) VALUES
(1, 'bluebase', 2, 1, 'video', '', '/rythm/assets/samplevedio.mp4', 'chennai', 'All is well>s>s', 2, 3, '2024-02-08', 0, 1, '2024-01-09', ''),
(2, 'ryhtmwoods', 3, 2, 'image', '/rythm/assets/postime22.jpg', '', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 1, '2024-02-08', 0, 1, '2024-01-29', ''),
(3, 'skyworld', 2, 3, 'image', '/rythm/assets/meet.jpg', '', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 2, '2023-01-11', 0, 1, '2024-01-29', ''),
(4, 'bluestar', 1, 4, 'image', '/rythm/assets/postimg1.jpg', '', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 3, '2023-01-01', 0, 1, '2024-01-29', ''),
(5, 'blue', 3, 5, 'video', '', '/rythm/posters/v2.mp4', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 3, '2024-02-10', 0, 1, '2024-01-29', ''),
(6, 'quadsel', 3, 6, 'video', '', '/rythm/posters/v4.mp4', 'chennai', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 2, 2, '2024-02-08', 0, 1, '2024-01-29', ''),
(23, 'rythmwoods', 3, 23, 'image', '/rythm/posters/musiccc.jpg', '', 'hhhhhhhhhhhh', '', 0, 0, '0000-00-00', 0, 1, '2025-02-27', ''),
(24, 'nehagirish', 1, 24, 'image', '/rythm/posters/rymmmm.jpg', '', 'okokkpk', '', 0, 0, '0000-00-00', 0, 1, '2025-03-17', ''),
(25, 'rythmwoods', 3, 25, 'image', '/rythm/posters/musiccc.jpg', '', 'oooo', '', 0, 0, '0000-00-00', 0, 1, '2025-03-19', ''),
(26, 'rythmwoods', 3, 26, 'video', '/rythm/posters/v4.mp4', '', 'jjjjjjjjjj', '', 0, 0, '0000-00-00', 0, 1, '2025-03-19', ''),
(27, 'rythmwoods', 3, 27, 'image', '/rythm/posters/rymmmm.jpg', '', 'kkk', '', 0, 0, '0000-00-00', 0, 1, '2025-03-19', ''),
(28, 'rythmwoods', 3, 28, 'image', '/rythm/posters/rymmmm.jpg', '', 'kkk', '', 0, 0, '0000-00-00', 0, 1, '2025-03-19', ''),
(29, 'rythmwoods', 3, 29, 'video', '', '/rythm/posters/', 'jjjjj', '', 0, 0, '0000-00-00', 0, 1, '2025-03-24', ''),
(30, 'rythmwoods', 3, 30, 'video', '', '/rythm/posters/', 'rythms', '', 0, 0, '0000-00-00', 0, 1, '2025-03-24', ''),
(31, 'rythmwoods', 3, 31, 'video', '', '/xampp/htdocs/rythm/posters/', 'rythms', '', 0, 0, '0000-00-00', 0, 1, '2025-03-24', ''),
(32, 'rythmwoods', 3, 32, 'video', '', '/xampp/htdocs/rythm/posters/', 'news', '', 0, 0, '0000-00-00', 0, 1, '2025-03-25', ''),
(33, 'rythmwoods', 3, 33, 'video', '', '/rythm/posters/n2.mp4', 'rythm', '', 0, 0, '0000-00-00', 0, 1, '2025-03-25', ''),
(34, 'rythmwoods', 3, 34, 'video', '', '/rythm/posters/n2.mp4', 'rythm', '', 0, 0, '0000-00-00', 0, 1, '2025-03-25', ''),
(35, 'rythmwoods', 3, 35, 'image', '/rythm/posters/music.jpg', '', 'kkk', '', 0, 0, '0000-00-00', 0, 1, '2025-04-01', ''),
(36, 'rythmwoods', 3, 36, 'image', '/rythm/posters/music.jpg', '', 'kkk', '', 0, 0, '0000-00-00', 0, 1, '2025-04-01', ''),
(37, 'rythmwoods', 3, 37, 'video', '', '/rythm/posters/v3.mp4', 'kkkk', '', 0, 0, '0000-00-00', 0, 1, '2025-04-01', ''),
(38, 'rythmwoods', 3, 38, 'video', '', '/rythm/posters/n2.mp4', 'hhhhhhhhh', '', 0, 0, '0000-00-00', 0, 1, '2025-04-01', ''),
(39, 'rythmwoods', 3, 39, 'video', '', '/rythm/posters/u5.mp4', 'ooooooo', '', 0, 0, '0000-00-00', 0, 1, '2025-04-01', ''),
(40, 'rythmwoods', 3, 40, 'video', '', '/rythm/posters/u5.mp4', 'ooooooo', '', 0, 0, '0000-00-00', 0, 1, '2025-04-01', ''),
(41, 'rythmwoods', 3, 41, 'video', '', '/rythm/posters/sample.mp4', 'llll', '', 0, 0, '0000-00-00', 0, 1, '2025-04-01', ''),
(42, 'rythmwoods', 3, 42, 'video', '', '/rythm/posters/v3.mp4', 'lllllllllll', '', 1, 0, '0000-00-00', 1, 1, '2025-04-01', ''),
(43, 'rythmwoods', 3, 43, 'video', '', '/rythm/posters/u5.mp4', 'llll', '', -1, 0, '0000-00-00', 0, 1, '2025-04-16', ''),
(44, 'rythmwoods', 3, 44, 'video', '', '/rythm/posters/video.mp4.mp4', 'nature view', '', 1, 0, '0000-00-00', 1, 1, '2025-04-28', '');

-- --------------------------------------------------------

--
-- Table structure for table `posters_commads`
--

CREATE TABLE `posters_commads` (
  `id` int(11) NOT NULL,
  `posterid` int(11) NOT NULL,
  `commander_id` int(11) NOT NULL,
  `commands` varchar(2000) NOT NULL,
  `likests_cmd` int(11) NOT NULL,
  `likeorno` int(11) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posters_commads`
--

INSERT INTO `posters_commads` (`id`, `posterid`, `commander_id`, `commands`, `likests_cmd`, `likeorno`, `created_on`) VALUES
(3, 2, 2, 'this picture is very nice', 0, 0, '2024-01-27'),
(4, 2, 2, 'good', 0, 0, '2024-01-29'),
(5, 2, 2, 'nice', 0, 0, '2024-01-29'),
(6, 2, 2, 'super', 0, 0, '2024-01-29'),
(11, 1, 2, 'nice vedio=\n=\n=\n', 0, 0, '2024-01-29'),
(10, 2, 2, 'goodimggg=\n=\n', 0, 0, '2024-01-29'),
(12, 1, 2, 'dfghj', 0, 0, '2024-01-31'),
(16, 2, 3, 'verynice=\n=', 1, 0, '2024-02-02'),
(17, 1, 3, 'good vedio', 0, 0, '2024-02-02'),
(18, 6, 2, 'fsdfdsf', 0, 0, '2024-02-12'),
(19, 6, 2, 'sdasd', 0, 0, '2024-02-12'),
(20, 6, 2, 'ddad', 0, 0, '2024-02-12'),
(23, 6, 2, 'gooduuuuu', 0, 0, '2024-02-19'),
(24, 5, 2, 'sprrrrrr', 0, 0, '2024-02-19'),
(26, 5, 2, 'very nice', 0, 0, '2024-02-19'),
(27, 5, 2, 'okkk', 0, 0, '2024-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `poster_download`
--

CREATE TABLE `poster_download` (
  `id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `downloader_id` int(11) NOT NULL,
  `donwload_sts` int(11) NOT NULL,
  `poster_path` varchar(3000) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poster_download`
--

INSERT INTO `poster_download` (`id`, `poster_id`, `downloader_id`, `donwload_sts`, `poster_path`, `created_on`) VALUES
(2, 3, 3, 1, '/rythm/posters/v2.mp4', '2024-02-21'),
(1, 2, 3, 1, '/rythm/assets/postime22.jpg', '2024-02-21'),
(70, 4, 3, 1, '/rythm/assets/postimg1.jpg', '2024-08-05'),
(71, 6, 3, 1, '', '2024-08-05'),
(72, 1, 3, 1, '', '2024-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `image`, `caption`, `created_at`) VALUES
(110, 1, 'GJHGJ', 'JKUKIO', '2025-02-20 11:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `profile_details`
--

CREATE TABLE `profile_details` (
  `id` int(11) NOT NULL,
  `rolemaster_id` int(11) NOT NULL,
  `about` varchar(2000) NOT NULL,
  `facebook` varchar(1000) NOT NULL,
  `twitter` varchar(1000) NOT NULL,
  `instagram` varchar(1000) NOT NULL,
  `youtube` varchar(1000) NOT NULL,
  `imagevedioprotfloio` varchar(1000) NOT NULL,
  `title_1` varchar(200) NOT NULL,
  `title_2` varchar(200) DEFAULT NULL,
  `title_3` varchar(200) DEFAULT NULL,
  `title_4` varchar(200) DEFAULT NULL,
  `title_5` varchar(200) DEFAULT NULL,
  `title_6` varchar(200) DEFAULT NULL,
  `title_7` varchar(200) DEFAULT NULL,
  `title_8` varchar(200) DEFAULT NULL,
  `title_9` varchar(200) DEFAULT NULL,
  `title_10` varchar(200) DEFAULT NULL,
  `year_1` year(4) NOT NULL,
  `year_2` year(4) NOT NULL,
  `year_3` year(4) NOT NULL,
  `year_4` year(4) NOT NULL,
  `year_5` year(4) NOT NULL,
  `year_6` year(4) NOT NULL,
  `year_7` year(4) NOT NULL,
  `year_8` year(4) NOT NULL,
  `year_9` year(4) NOT NULL,
  `year_10` year(4) NOT NULL,
  `awardedby_1` varchar(200) NOT NULL,
  `awardedby_2` varchar(100) NOT NULL,
  `awardedby_3` varchar(100) NOT NULL,
  `awardedby_4` varchar(100) NOT NULL,
  `awardedby_5` varchar(100) NOT NULL,
  `awardedby_6` varchar(100) NOT NULL,
  `awardedby_7` varchar(100) NOT NULL,
  `awardedby_8` varchar(100) NOT NULL,
  `awardedby_9` varchar(100) NOT NULL,
  `awardedby_10` varchar(100) NOT NULL,
  `description_1` varchar(10) NOT NULL,
  `description_2` varchar(10) NOT NULL,
  `description_3` varchar(10) NOT NULL,
  `description_4` varchar(10) NOT NULL,
  `description_5` varchar(10) NOT NULL,
  `description_6` varchar(10) NOT NULL,
  `description_7` varchar(10) NOT NULL,
  `description_8` varchar(10) NOT NULL,
  `description_9` varchar(10) NOT NULL,
  `description_10` varchar(10) NOT NULL,
  `image_1` varchar(20) NOT NULL,
  `image_2` varchar(20) NOT NULL,
  `image_3` varchar(20) NOT NULL,
  `image_4` varchar(20) NOT NULL,
  `image_5` varchar(20) NOT NULL,
  `image_6` varchar(20) NOT NULL,
  `image_7` varchar(20) NOT NULL,
  `image_8` varchar(20) NOT NULL,
  `image_9` varchar(20) NOT NULL,
  `image_10` varchar(20) NOT NULL,
  `youtubeLink_1` varchar(200) NOT NULL,
  `youtubeLink_2` varchar(20) NOT NULL,
  `youtubeLink_3` varchar(20) NOT NULL,
  `youtubeLink_4` varchar(20) NOT NULL,
  `youtubeLink_5` varchar(20) NOT NULL,
  `youtubeLink_6` varchar(20) NOT NULL,
  `youtubeLink_7` varchar(20) NOT NULL,
  `youtubeLink_8` varchar(20) NOT NULL,
  `youtubeLink_9` varchar(20) NOT NULL,
  `youtubeLink_10` varchar(20) NOT NULL,
  `pjtitle_1` varchar(20) NOT NULL,
  `pjtitle_2` varchar(200) DEFAULT NULL,
  `pjtitle_3` varchar(200) DEFAULT NULL,
  `pjtitle_4` varchar(200) DEFAULT NULL,
  `pjtitle_5` varchar(200) DEFAULT NULL,
  `pjtitle_6` varchar(10) NOT NULL,
  `pjtitle_7` varchar(10) NOT NULL,
  `pjtitle_8` varchar(10) NOT NULL,
  `pjtitle_9` varchar(10) NOT NULL,
  `pjtitle_10` varchar(10) NOT NULL,
  `link_1_1` varchar(200) NOT NULL,
  `link_1_2` varchar(200) NOT NULL,
  `link_1_3` varchar(200) NOT NULL,
  `link_1_4` varchar(200) NOT NULL,
  `link_1_5` varchar(200) NOT NULL,
  `link_2_1` varchar(200) NOT NULL,
  `link_2_2` varchar(20) NOT NULL,
  `link_2_3` varchar(20) NOT NULL,
  `link_2_4` varchar(20) NOT NULL,
  `link_2_5` varchar(20) NOT NULL,
  `link_3_1` varchar(200) NOT NULL,
  `link_3_2` varchar(20) NOT NULL,
  `link_3_3` varchar(20) NOT NULL,
  `link_3_4` varchar(20) NOT NULL,
  `link_3_5` varchar(20) NOT NULL,
  `link_4_1` varchar(200) NOT NULL,
  `link_4_2` varchar(20) NOT NULL,
  `link_4_3` varchar(20) NOT NULL,
  `link_4_4` varchar(20) NOT NULL,
  `link_4_5` varchar(20) NOT NULL,
  `link_5_1` varchar(200) NOT NULL,
  `link_5_2` varchar(10) NOT NULL,
  `link_5_3` varchar(10) NOT NULL,
  `link_5_4` varchar(10) NOT NULL,
  `link_5_5` varchar(10) NOT NULL,
  `link_6_1` varchar(10) NOT NULL,
  `link_6_2` varchar(10) NOT NULL,
  `link_6_3` varchar(10) NOT NULL,
  `link_6_4` varchar(10) NOT NULL,
  `link_6_5` varchar(10) NOT NULL,
  `link_7_1` varchar(10) NOT NULL,
  `link_7_2` varchar(10) NOT NULL,
  `link_7_3` varchar(10) NOT NULL,
  `link_7_4` varchar(10) NOT NULL,
  `link_7_5` varchar(10) NOT NULL,
  `link_8_1` varchar(10) NOT NULL,
  `link_8_2` varchar(10) NOT NULL,
  `link_8_3` varchar(10) NOT NULL,
  `link_8_4` varchar(10) NOT NULL,
  `link_8_5` varchar(10) NOT NULL,
  `link_9_1` varchar(10) NOT NULL,
  `link_9_2` varchar(10) NOT NULL,
  `link_9_3` varchar(10) NOT NULL,
  `link_9_4` varchar(10) NOT NULL,
  `link_9_5` varchar(10) NOT NULL,
  `link_10_1` varchar(10) NOT NULL,
  `link_10_2` varchar(10) NOT NULL,
  `link_10_3` varchar(10) NOT NULL,
  `link_10_4` varchar(10) NOT NULL,
  `link_10_5` varchar(10) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_details`
--

INSERT INTO `profile_details` (`id`, `rolemaster_id`, `about`, `facebook`, `twitter`, `instagram`, `youtube`, `imagevedioprotfloio`, `title_1`, `title_2`, `title_3`, `title_4`, `title_5`, `title_6`, `title_7`, `title_8`, `title_9`, `title_10`, `year_1`, `year_2`, `year_3`, `year_4`, `year_5`, `year_6`, `year_7`, `year_8`, `year_9`, `year_10`, `awardedby_1`, `awardedby_2`, `awardedby_3`, `awardedby_4`, `awardedby_5`, `awardedby_6`, `awardedby_7`, `awardedby_8`, `awardedby_9`, `awardedby_10`, `description_1`, `description_2`, `description_3`, `description_4`, `description_5`, `description_6`, `description_7`, `description_8`, `description_9`, `description_10`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `image_6`, `image_7`, `image_8`, `image_9`, `image_10`, `youtubeLink_1`, `youtubeLink_2`, `youtubeLink_3`, `youtubeLink_4`, `youtubeLink_5`, `youtubeLink_6`, `youtubeLink_7`, `youtubeLink_8`, `youtubeLink_9`, `youtubeLink_10`, `pjtitle_1`, `pjtitle_2`, `pjtitle_3`, `pjtitle_4`, `pjtitle_5`, `pjtitle_6`, `pjtitle_7`, `pjtitle_8`, `pjtitle_9`, `pjtitle_10`, `link_1_1`, `link_1_2`, `link_1_3`, `link_1_4`, `link_1_5`, `link_2_1`, `link_2_2`, `link_2_3`, `link_2_4`, `link_2_5`, `link_3_1`, `link_3_2`, `link_3_3`, `link_3_4`, `link_3_5`, `link_4_1`, `link_4_2`, `link_4_3`, `link_4_4`, `link_4_5`, `link_5_1`, `link_5_2`, `link_5_3`, `link_5_4`, `link_5_5`, `link_6_1`, `link_6_2`, `link_6_3`, `link_6_4`, `link_6_5`, `link_7_1`, `link_7_2`, `link_7_3`, `link_7_4`, `link_7_5`, `link_8_1`, `link_8_2`, `link_8_3`, `link_8_4`, `link_8_5`, `link_9_1`, `link_9_2`, `link_9_3`, `link_9_4`, `link_9_5`, `link_10_1`, `link_10_2`, `link_10_3`, `link_10_4`, `link_10_5`, `created_by`, `created_on`, `admin_status`) VALUES
(34, 2, 'ASDFGHUJI', 'www/facebook.com', 'www/twitter.com', 'www/instagram.com', 'www/youtube.com', '/wamp62/www/rythm/portfolio/switch.png', '', 'dasdsad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000', '2023', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '', 'youtube', '', '', '', '', '', '', '', '', '', 'ertyhuj', '', '', '', '', '', '', '', '', '', '/wamp62/www/rythm/ac', '', '', '', '', '', '', '', '', '', 'www/award2.com', '', '', '', '', '', '', '', '', '', 'bbluebase', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', 'www/link21.in', 'www/link22.in', 'www/link23.in', 'www/link24.in', 'www/link25.in', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2', '2024-03-05', 0),
(36, 5, 'nothing', 'www/facebook.in', 'www/twitter.in', 'www/instagram.in', 'www/youtube.in', '/wamp62/www/rythm/portfolio/module_table_top.png', 'vv', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', 'dd', '', '', '', '', '', '', '', '', '', 'cc', '', '', '', '', '', '', '', '', '', '/wamp62/www/rythm/ac', '', '', '', '', '', '', '', '', '', 'www/youtubesss.in', '', '', '', '', '', '', '', '', '', 'bb', NULL, NULL, NULL, NULL, '', '', '', '', '', 'sdfghjkl', 'wertyuio', 'mnbvfd', 'poiuyt', 'asdfgh', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2024-11-05', 1),
(35, 2, '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2', '2024-08-05', 0),
(37, 7, 'xxx', 'www/facebook.in', 'www/twitter.in', 'www/instagram.in', 'www/youtube.in', '/wamp62/www/rythm/portfolio/icons8-user-64.png', 'vv', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', 'good', '', '', '', '', '', '', '', '', '', 'dfghjk', '', '', '', '', '', '', '', '', '', '/wamp62/www/rythm/ac', '', '', '', '', '', '', '', '', '', 'www/youtubesss.in', '', '', '', '', '', '', '', '', '', 'bb', NULL, NULL, NULL, NULL, '', '', '', '', '', 'oooooooo', 'hhhhhhhhhh', 'bbbbbbbbbbb', 'qqqqqqqq', 'xxxxxxxxxxxxxx', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '7', '2024-11-05', 0),
(38, 1, 'NIL', '', '', '', '', '/wamp62/www/rythm/portfolio/bluebaseLogo1.jpeg', 'super singer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', 'hhhh', '', '', '', '', '', '', '', '', '', 'ddddd', '', '', '', '', '', '', '', '', '', '/wamp62/www/rythm/ac', '', '', '', '', '', '', '', '', '', 'www.youtube.com', '', '', '', '', '', '', '', '', '', 'aaaaa', NULL, NULL, NULL, NULL, '', '', '', '', '', 'sss', 'ffff', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2024-12-28', 1),
(39, 0, '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-01', 1),
(40, 1, 'song event', 'www.facebook.com', 'www.twitter.com', 'www.instagram.com', 'www.youtube.com', '/wamp62/www/rythm/portfolio/v3.mp4', 'super singer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', 'hhhh', '', '', '', '', '', '', '', '', '', 'ddddd', '', '', '', '', '', '', '', '', '', '/wamp62/www/rythm/ac', '', '', '', '', '', '', '', '', '', 'www.youtube.com', '', '', '', '', '', '', '', '', '', 'aaaaa', NULL, NULL, NULL, NULL, '', '', '', '', '', 'sss', 'ffff', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2025-04-01', 1),
(41, 8, 'jjjj', 'www.facebook.com', 'www.twitter.com', 'www.instagram.com', 'www.youtube.com', '/wamp62/www/rythm/portfolio/profile.png', 'super singer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', 'hhhh', '', '', '', '', '', '', '', '', '', 'hhhhhhhh', '', '', '', '', '', '', '', '', '', '/wamp62/www/rythm/ac', '', '', '', '', '', '', '', '', '', 'www.youtube.com', '', '', '', '', '', '', '', '', '', 'oooo', NULL, NULL, NULL, NULL, '', '', '', '', '', 'sss', 'ffff', 'rrrrrrk', 'tttttttttt', 'lllllllll', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '8', '2025-04-01', 1),
(42, 8, 'kkkk', 'www.facebook.com', 'www.twitter.com', 'www.instagram.com', 'www.youtube.com', '/wamp62/www/rythm/portfolio/defultuserprofile.png', 'super singer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', '0000', 'hhhh', '', '', '', '', '', '', '', '', '', 'hhhhhhhh', '', '', '', '', '', '', '', '', '', '/wamp62/www/rythm/ac', '', '', '', '', '', '', '', '', '', 'www.youtube.com', '', '', '', '', '', '', '', '', '', 'oooo', NULL, NULL, NULL, NULL, '', '', '', '', '', 'sss', 'ffff', 'rrrrrrk', 'tttttttttt', 'lllllllll', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '8', '2025-04-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile_photo_uploaded`
--

CREATE TABLE `profile_photo_uploaded` (
  `id` int(11) NOT NULL,
  `rolemaster_id` int(11) NOT NULL,
  `photo_path` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `admin_status` int(11) NOT NULL,
  `profilepic_reason` varchar(2000) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile_photo_uploaded`
--

INSERT INTO `profile_photo_uploaded` (`id`, `rolemaster_id`, `photo_path`, `created_on`, `created_by`, `admin_status`, `profilepic_reason`) VALUES
(7, 3, '/rythm/profile_photos/profile.png', '2024-03-07', 'rythmwoods@gmail.in', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `role_mapping`
--

CREATE TABLE `role_mapping` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL,
  `view_only` varchar(200) NOT NULL,
  `edit_only` int(11) NOT NULL,
  `all_only` varchar(50) NOT NULL,
  `approval` int(11) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role_mapping`
--

INSERT INTO `role_mapping` (`id`, `role_id`, `menu_id`, `submenu_id`, `view_only`, `edit_only`, `all_only`, `approval`, `created_by`, `created_on`) VALUES
(1, 1, 1, 1, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(2, 1, 1, 2, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(3, 1, 1, 3, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(4, 1, 1, 4, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(5, 1, 1, 5, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(6, 1, 1, 6, '0', 0, '1', 0, '1', '2020-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`id`, `role_name`, `status`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sendingmessage`
--

CREATE TABLE `sendingmessage` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `messages` varchar(3000) NOT NULL,
  `senddatetime` datetime NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sendingmessage`
--

INSERT INTO `sendingmessage` (`id`, `sender_id`, `receiver_id`, `messages`, `senddatetime`, `created_on`) VALUES
(1, 2, 9, 'very nice', '2024-02-12 09:22:03', '2024-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `shareposter`
--

CREATE TABLE `shareposter` (
  `id` int(11) NOT NULL,
  `posters_id` int(11) NOT NULL,
  `postfrom_id` int(11) NOT NULL,
  `postto_id` int(11) NOT NULL,
  `message_content` varchar(2000) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shareposter`
--

INSERT INTO `shareposter` (`id`, `posters_id`, `postfrom_id`, `postto_id`, `message_content`, `created_on`) VALUES
(1, 2, 1, 1, 'hiii this img was very nice', '2024-02-01'),
(2, 1, 1, 9, 'this video is very nice', '2024-02-01'),
(3, 2, 1, 9, 'ok', '2024-02-01'),
(4, 1, 1, 1, 'good', '2024-02-01'),
(5, 2, 1, 1, 'good', '2024-02-01'),
(6, 2, 2, 1, 'dfgdrth', '2024-02-05'),
(7, 6, 3, 9, 'takeitt', '2024-03-01'),
(8, 6, 3, 1, '', '2024-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `singers`
--

CREATE TABLE `singers` (
  `id` int(11) NOT NULL,
  `singer_name` varchar(255) NOT NULL,
  `singer_type` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `singers`
--

INSERT INTO `singers` (`id`, `singer_name`, `singer_type`, `status`) VALUES
(1, 'S Janaki', '', ''),
(2, 'P Susheela', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `song_master`
--

CREATE TABLE `song_master` (
  `id` int(11) NOT NULL,
  `music_director` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(250) NOT NULL,
  `language_id` varchar(255) DEFAULT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `lyrics_location` varchar(255) DEFAULT NULL,
  `english_lyrics_location` varchar(2000) NOT NULL,
  `duration` varchar(250) NOT NULL,
  `singer_type` varchar(250) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `song_master`
--

INSERT INTO `song_master` (`id`, `music_director`, `title`, `description`, `language_id`, `file_location`, `lyrics_location`, `english_lyrics_location`, `duration`, `singer_type`, `movie_id`, `created_on`, `status`) VALUES
(9, '7', 'Chinna Chinna Van', 'dfghjjhgfdwerty', '3', 'Chinna Chinna Vanna Kuyil.mp3', 'Chinna Chinna Vanna Kuyil.mp3', 'Bombay_Theme.mp3', '12', 'singer', 0, '2023-02-14 10:44:18', 'active'),
(11, '', 'hhhhhhhh', 'wertyuiervdsfdf', '3', 'Bombay_Theme.mp3', 'Bombay_Theme.mp3', 'Bombay_Theme.mp3', '1', 'singer', 0, '2023-04-15 12:40:48', 'active'),
(18, '1', 'kanmani', '', '2', 'Bombay_Theme.mp3', 'load3.gif', '', '', 'singer', 0, '2025-03-21 11:55:57', ' in active'),
(19, '1', 'ffff', '', '1', 'load3.gif', 'load3.gif', '', '', 'singer', 0, '2025-03-21 11:58:57', 'active'),
(21, '9', 'chinna', '', '3', 'Paadarien.pdf', 'Paadarien.pdf', '', '', 'singer', 0, '2025-03-21 12:03:47', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `role_master_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `profile_img` varchar(2000) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `experience` varchar(11) DEFAULT NULL,
  `tamil` varchar(255) DEFAULT NULL COMMENT '0 - Unknown1 -  Known',
  `malayalam` varchar(255) DEFAULT NULL COMMENT '0 - Unknown1 - Known',
  `hindi` varchar(255) DEFAULT NULL COMMENT '0 - Unknown1 - Known',
  `status` varchar(10) NOT NULL DEFAULT '0' COMMENT '0 - Inactive 1 - Active',
  `location` varchar(250) NOT NULL,
  `followsts` int(11) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `admin_status` int(11) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `profile_update_status` int(11) NOT NULL,
  `profilepic_reason` varchar(2000) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_on` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `users_id`, `role_master_id`, `name`, `profile_img`, `last_name`, `user_name`, `password`, `email`, `title`, `gender`, `date_of_birth`, `experience`, `tamil`, `malayalam`, `hindi`, `status`, `location`, `followsts`, `mobile_no`, `admin_status`, `reason`, `profile_update_status`, `profilepic_reason`, `created_on`, `modified_on`) VALUES
(1, 1, 1, 'Janani', '', 'G', 'nehagirish', '8ace0553f2e5cbc047b699cbb260cf64', 'gkjanani89@gmail.com', 'singer', 'Female', '11-10-2010', NULL, NULL, NULL, NULL, '0', 'chennai', 0, '9789957518', 1, 'kkkkk', 1, '', '2023-02-03 12:40:20', NULL),
(9, 2, 2, 'blue', '/rythm/assets/bluebaselogooooooo.png', 'base', 'bluebase', 'cd84d683cc5612c69efe115c80d0b7dc', 'bluebase@gamil.in', 'singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 0, '8675746545', 0, '', 1, '', '2024-01-19 16:33:25', ''),
(10, 3, 3, 'rythm', '/rythm/assets/rsz_logo2.png', 'woods', 'rythmwoods', 'cd84d683cc5612c69efe115c80d0b7dc', 'rythmwoods@gmail.in', 'singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'coimbatoure', 1, '8675746545', 1, '', 1, '', '2024-01-19 16:33:25', ''),
(15, 4, 4, 'blue', '', 'base', 'Edward', '1b0fefa4fa04589f42683fe07be13d32', 'bluebase@gamil.in', 'amateur singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 1, '8675746545', 0, '', 1, '', '2024-08-05 10:03:53', ''),
(16, 5, 5, 'Neha Girish', '', 'jjj', 'Rajeshwari', '25d55ad283aa400af464c76d713c07ad', 'singernehag@gmail.com', 'singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'chennai', 0, '997865453', 1, '', 1, '', '2024-09-04 14:16:31', ''),
(17, 6, 6, 'Neha Girish', '', 'kkkk', 'Janani', 'cd84d683cc5612c69efe115c80d0b7dc', 'singernehag@gmail.com', 'fff', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'chennai', 0, '997865453', 1, '', 1, '', '2024-11-05 10:49:19', ''),
(18, 7, 7, 'priya', '', 'devi', 'priya', '9ea3a32e582d2514cf7d19032c90e4ae', 'priyadevi@gmail.com', 'user', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'erode', 0, '8676564534', 1, '', 1, '', '2024-11-05 15:13:16', ''),
(19, 8, 8, 'ishu', '\\rythm\\assets\\rythmlogo.png', 'r', 'test1', 'cd84d683cc5612c69efe115c80d0b7dc', 'ishu@gmail.com', 'user', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 0, '1234567890', 1, '', 1, '', '2024-11-08 09:35:53', ''),
(20, 1, 1, 'Janani', '', 'G', 'Janani', 'b946ed3f26085850b45808af967075e7', 'gkjanani89@gmail.com', 'singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'chennai', 0, '9789957518', 0, '', 1, '', '2024-12-27 07:38:46', ''),
(21, 1, 1, 'Janani', '', 'G', 'neha', 'e10adc3949ba59abbe56e057f20f883e', 'gkjanani89@gmail.com', 'singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'chennai', 0, '9789957518', 0, '', 1, '', '2025-04-01 19:20:55', ''),
(22, 8, 8, 'ishu', '', 'r', 'neha', 'e10adc3949ba59abbe56e057f20f883e', 'ishu@gmail.com', 'user', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 0, '1234567890', 0, '', 1, '', '2025-04-01 19:56:21', ''),
(23, 8, 8, 'ishu', '', 'r', 'neha', 'e10adc3949ba59abbe56e057f20f883e', 'ishu@gmail.com', 'user', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 0, '1234567890', 0, '', 1, '', '2025-04-01 19:56:22', ''),
(24, 8, 8, 'ishu', '', 'r', 'neha', '74d36c0725346b3b3d0d30cbe0edd219', 'ishu@gmail.com', 'user', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 0, '1234567890', 0, '', 1, '', '2025-04-02 12:48:01', ''),
(25, 8, 8, 'ishu', '', 'r', 'neha', '74d36c0725346b3b3d0d30cbe0edd219', 'ishu@gmail.com', 'user', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 0, '1234567890', 0, '', 1, '', '2025-04-02 12:48:01', ''),
(27, 8, 8, 'ishu', '', 'r', 'ishu', 'e10adc3949ba59abbe56e057f20f883e', 'ishu@gmail.com', 'user', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', '', 0, '1234567890', 0, '', 1, '', '2025-04-02 14:09:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `verification_requests`
--

CREATE TABLE `verification_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_event`
--
ALTER TABLE `daily_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_task`
--
ALTER TABLE `daily_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `following_details`
--
ALTER TABLE `following_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lyrics`
--
ALTER TABLE `lyrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masters_menu`
--
ALTER TABLE `masters_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masters_sub_menu`
--
ALTER TABLE `masters_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_composer`
--
ALTER TABLE `movie_composer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_singer`
--
ALTER TABLE `movie_singer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music_directors`
--
ALTER TABLE `music_directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otptable`
--
ALTER TABLE `otptable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posters_commads`
--
ALTER TABLE `posters_commads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poster_download`
--
ALTER TABLE `poster_download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profile_details`
--
ALTER TABLE `profile_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_photo_uploaded`
--
ALTER TABLE `profile_photo_uploaded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_mapping`
--
ALTER TABLE `role_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sendingmessage`
--
ALTER TABLE `sendingmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shareposter`
--
ALTER TABLE `shareposter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `singers`
--
ALTER TABLE `singers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song_master`
--
ALTER TABLE `song_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_requests`
--
ALTER TABLE `verification_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daily_event`
--
ALTER TABLE `daily_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `daily_task`
--
ALTER TABLE `daily_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `following_details`
--
ALTER TABLE `following_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lyrics`
--
ALTER TABLE `lyrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masters_menu`
--
ALTER TABLE `masters_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masters_sub_menu`
--
ALTER TABLE `masters_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_composer`
--
ALTER TABLE `movie_composer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_singer`
--
ALTER TABLE `movie_singer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `music_directors`
--
ALTER TABLE `music_directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `otptable`
--
ALTER TABLE `otptable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `posters_commads`
--
ALTER TABLE `posters_commads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `poster_download`
--
ALTER TABLE `poster_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `profile_details`
--
ALTER TABLE `profile_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `profile_photo_uploaded`
--
ALTER TABLE `profile_photo_uploaded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role_mapping`
--
ALTER TABLE `role_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sendingmessage`
--
ALTER TABLE `sendingmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shareposter`
--
ALTER TABLE `shareposter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `singers`
--
ALTER TABLE `singers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `song_master`
--
ALTER TABLE `song_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `verification_requests`
--
ALTER TABLE `verification_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
