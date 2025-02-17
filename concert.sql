-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2024 at 02:23 PM
-- Server version: 11.3.2-MariaDB
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darkenedhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

DROP TABLE IF EXISTS `concert`;
CREATE TABLE IF NOT EXISTS `concert` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(254) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`id`, `date`) VALUES
(1, '2024-12-13 19:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
