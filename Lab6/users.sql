-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2017 at 01:46 PM
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `created`) VALUES
(1, 'josh@email.com', 'test', '2017-11-15 16:39:58'),
(2, 'josh2@email.com', '123', '2017-11-15 16:42:33'),
(3, 'abc@email.com', '$2y$10$6n8kiOPYRWrlwV0NgYQnIOvFt428HC/rbxwKZD1GDnfbWyghu0Kzm', '2017-11-15 16:45:48'),
(4, 'sample@email.com', '$2y$10$uY2f03N5zuKu1UIHbdE/S.FYhpoa6tJYtPsowiYQAduUWsLNtDHo6', '2017-11-17 16:17:24'),
(5, 'josh3@email.com', '$2y$10$/zMXc2pL37QheqJ.yWmsnuLoFhgxCQJUKXNC/9Sa7zUur87CimU1e', '2017-11-18 22:28:56'),
(6, 'josh4@email.com', '$2y$10$NBzwQXKuB1KbywmjG6SvweVkZ/0uzaRKrIxMMFM3mupK.PyPEer8a', '2017-11-18 22:29:56'),
(7, 'test@email.com', '$2y$10$8ijj0.yr1oxz.sR7lYGA4uESk0UxLTK7qfy4uUM1m3snleNy5oG7O', '2017-11-27 17:12:00'),
(8, 'test2@email.com', '$2y$10$VKC4R25lOHX0qDVxYj5fgupivZwQE1GrONf8munomGpU/sQ1DF7Bm', '2017-11-27 17:13:31'),
(9, 'josh.lloyd@yandex.com', '$2y$10$NzkiCTbl6kwWh9PYUz33XeKA7qDsDSti6EQBHUBQjaC5KZiMapAR2', '2017-12-04 14:55:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
