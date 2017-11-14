-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2017 at 07:15 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpclassfall2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`site_id`, `site`, `date`) VALUES
(1, '', '2017-11-11 22:36:45'),
(2, 'www.bbc.com', '2017-11-11 22:38:13'),
(3, 'www.bbc.com', '2017-11-11 22:41:53'),
(4, 'www.bbc.com', '2017-11-11 22:42:34'),
(5, 'www.cnn.com', '2017-11-11 22:52:44'),
(6, 'www.cnn.com', '2017-11-11 22:53:30'),
(7, 'www.cnn.com', '2017-11-11 22:54:00'),
(8, 'www.cnn.com', '2017-11-11 22:55:22'),
(9, 'www.cnn.com', '2017-11-11 22:56:36'),
(10, 'www.cnn.com', '2017-11-11 22:56:52'),
(11, 'www.cnn.com', '2017-11-11 22:58:17'),
(12, 'www.cnn.com', '2017-11-11 22:58:54'),
(13, 'www.facebook.com', '2017-11-12 15:14:06'),
(14, 'www.abc.com', '2017-11-12 15:16:34'),
(15, 'www.nbc.com', '2017-11-12 15:21:33'),
(16, 'www.bbc.com', '2017-11-12 15:35:35'),
(17, 'www.bbc.com', '2017-11-12 15:41:42'),
(18, 'www.bbc.com', '2017-11-12 15:42:16'),
(19, 'www.bbc.com', '2017-11-12 15:43:22'),
(20, 'www.bbc.com', '2017-11-12 15:46:10'),
(21, 'www.cnn.com', '2017-11-12 15:47:13'),
(22, 'www.bbc.com', '2017-11-12 15:54:53'),
(23, 'www.bbc.com', '2017-11-12 15:55:27'),
(24, 'www.bbc.com', '2017-11-12 16:01:56'),
(25, 'www.bbc.com', '2017-11-12 16:02:13'),
(26, 'www.bbc.com', '2017-11-12 16:02:48'),
(27, 'www.bbc.com', '2017-11-12 16:03:29'),
(28, 'www.bbc.com', '2017-11-12 16:03:43'),
(29, 'www.bbc.com', '2017-11-12 16:05:51'),
(30, 'www.cnn.com', '2017-11-12 16:33:19'),
(31, 'www.bbc.com', '2017-11-12 16:35:36'),
(32, 'www.bbc.com', '2017-11-12 16:36:39'),
(33, 'www.bbc.com', '2017-11-12 16:38:35'),
(34, 'www.bbc.com', '2017-11-12 16:39:26'),
(35, 'www.nbc.com', '2017-11-12 17:17:42'),
(36, 'www.abc.com', '2017-11-12 17:21:45'),
(37, 'www.wikipedia.org', '2017-11-12 17:24:12'),
(38, 'www.wikipedia.org', '2017-11-12 17:24:36'),
(39, 'www.wikipedia.org', '2017-11-12 17:25:14'),
(40, 'www.caranddriver.com', '2017-11-12 20:04:23'),
(41, 'www.test.com', '0005-05-17 00:00:00'),
(42, 'www.facebook.com', '2017-11-12 23:55:58'),
(43, 'www.facebook.com', '2017-11-12 23:56:22'),
(44, 'www.facebook.com', '2017-11-12 23:56:41'),
(45, 'www.cnn.com', '2017-11-12 23:56:50'),
(46, 'kjertl', '2017-11-13 00:11:13'),
(47, 'kop', '2017-11-13 00:12:04'),
(48, 'http://cnn.com', '2017-11-13 13:45:23'),
(49, 'http://www.caranddriver.com', '2017-11-13 13:52:47'),
(50, 'http://www.cnn.com', '2017-11-13 13:53:18'),
(51, 'http://www.cnn.com', '2017-11-13 13:54:10'),
(52, 'http://www.cnn.com', '2017-11-13 13:55:25'),
(53, 'http://www.cnn.com', '2017-11-13 13:58:24'),
(54, 'http://www.cnn.com', '2017-11-13 13:59:18'),
(55, 'http://cnn.com', '2017-11-13 14:05:20'),
(56, 'http://cnn.com', '2017-11-13 14:06:03'),
(57, 'http://cnn.com', '2017-11-13 14:07:04'),
(58, 'http://cnn.com', '2017-11-13 14:07:34'),
(59, 'http://cnn.com', '2017-11-13 14:07:35'),
(60, 'http://cnn.com', '2017-11-13 14:08:22'),
(61, 'http://www.cnn.com', '2017-11-13 14:08:44'),
(62, 'http://bbc.com', '2017-11-13 14:10:45'),
(63, 'http://bbc.com', '2017-11-13 14:11:19'),
(64, 'http://www.cnn.com', '2017-11-13 14:11:51'),
(65, 'http://www.cnn.com', '2017-11-13 14:12:43'),
(66, 'http://www.cnn.com', '2017-11-13 14:16:28'),
(67, 'http://www.cnn.com', '2017-11-13 14:16:29'),
(68, 'http://www.cnn.com', '2017-11-13 14:17:10'),
(69, 'http://www.cnn.com', '2017-11-13 14:17:28'),
(70, 'http://www.cnn.com', '2017-11-13 14:20:03'),
(71, 'http://www.cnn.com', '2017-11-13 14:20:42'),
(72, 'http://www.cnn.com', '2017-11-13 14:22:11'),
(73, 'http://www.cnn.com', '2017-11-13 14:22:26'),
(74, 'http://www.cnn.com', '2017-11-13 14:23:31'),
(75, 'http://www.cnn.com', '2017-11-13 14:24:47'),
(76, 'http://www.cnn.com', '2017-11-13 14:25:24'),
(77, 'http://www.cnn.com', '2017-11-13 14:25:42'),
(78, 'http://www.', '2017-11-13 14:41:34'),
(79, 'http://www.', '2017-11-13 14:42:06'),
(80, 'http://www.', '2017-11-13 14:42:24'),
(81, 'http://www.cnn.com', '2017-11-13 14:42:47'),
(82, 'https://www.caranddriver.com/', '2017-11-13 14:43:26'),
(83, 'https://www.caranddriver.com', '2017-11-13 14:43:31'),
(84, 'http://www.cnn.com', '2017-11-13 14:52:57'),
(85, 'https://www.cargurus.com', '2017-11-13 14:54:34'),
(86, 'https://www.autotrader.com/', '2017-11-13 14:55:12'),
(87, 'https://www.autotrader.com', '2017-11-13 14:55:17'),
(88, 'https://stackoverflow.com/', '2017-11-13 14:56:50'),
(89, 'http://wpri.com/', '2017-11-13 14:57:56'),
(90, 'https://www.youtube.com/', '2017-11-13 15:13:53'),
(91, 'https://www.youtube.com', '2017-11-13 15:14:26'),
(92, 'https://www.usatoday.com/', '2017-11-13 15:14:53'),
(93, 'http://time.com/', '2017-11-13 15:15:03'),
(94, 'http://www.foxnews.com/', '2017-11-13 15:15:45'),
(95, 'http://example.com', '2017-11-13 15:19:14'),
(96, 'https://www.forbes.com/#603027fd2254', '2017-11-13 15:19:56'),
(97, 'http://www.niemanlab.org/', '2017-11-13 15:20:30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
