-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2024 at 09:17 AM
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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('superadmin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `rule_name` (`rule_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator, some minor restrictions', NULL, NULL, NULL, NULL),
('member', 1, 'Registered users, members of this site', NULL, NULL, NULL, NULL),
('superadmin', 1, 'Unlimited powa!!!', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('superadmin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1716324039),
('m130524_201442_init', 1716324043),
('m190124_110200_add_verification_token_column_to_user_table', 1716324043),
('m240518_142815_base_structure', 1716324044),
('m240519_150049_initial_datas', 1716324044),
('m240701_074339_update_chimes', 1719820041),
('m240701_091010_update_chimes_bpm', 1719825209);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
CREATE TABLE IF NOT EXISTS `proposal` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(254) NOT NULL,
  `artist` varchar(254) NOT NULL,
  `username` varchar(254) NOT NULL,
  `info` varchar(254) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `title`, `artist`, `username`, `info`, `created_at`, `updated_at`) VALUES
(6, 'Hai sa nu ne certam', 'Bosquito', 'Leo', 'PLS :P', '2024-12-04 21:12:06', '2024-12-15 20:07:20'),
(9, 'Ego Brain', 'System of A Down', 'Leo', 'Am o arma la tampla\r\nPLZ SEND HELP', '2024-12-04 22:41:55', '2024-12-15 20:07:18'),
(10, 'Gasoline', 'I Prevail', 'Leo', '', '2024-12-15 20:06:52', '2024-12-15 20:07:15'),
(11, 'Coruptia Ucide', 'Trooper', 'Leo', '', '2024-12-15 20:07:18', '2024-12-15 20:07:12'),
(14, 'Blackbird', 'Alter Bridge', 'Leo', '', '2024-12-17 13:58:51', '2024-12-17 11:58:51');

-- --------------------------------------------------------

--
-- Table structure for table `public_proposal`
--

DROP TABLE IF EXISTS `public_proposal`;
CREATE TABLE IF NOT EXISTS `public_proposal` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(254) NOT NULL,
  `artist` varchar(254) NOT NULL,
  `info` varchar(254) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `public_proposal`
--

INSERT INTO `public_proposal` (`id`, `title`, `artist`, `info`, `created_at`, `updated_at`) VALUES
(1, 'Nebun de Alb', 'Emeric Imre', 'test', '2024-12-04 19:41:55', '2024-12-16 12:59:22'),
(2, 'Wicked Game', 'HIM', 'test2', '2024-12-04 19:54:35', '2024-12-16 12:59:21'),
(3, 'Ego Brain', 'System of A Down', 'Raluca', '2024-12-04 19:56:07', '2024-12-16 12:59:20'),
(4, 'I Hate Everything About You', 'Three Days Grace', 'Dedicata tie Tudor', '2024-12-04 21:09:24', '2024-12-16 12:59:18'),
(5, 'Gasoline', 'I Prevail', 'Nu prea merge live dar am descoperit-o ieri si efectiv o iubesc e cea mai tare nu pot trai fara ea cred ca o sa mor ', '2024-12-04 21:11:40', '2024-12-16 12:59:17'),
(6, 'Hai sa nu ne certam', 'Bosquito', 'PLS :P', '2024-12-04 21:12:06', '2024-12-16 12:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
CREATE TABLE IF NOT EXISTS `song` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_in_concert` tinyint(2) UNSIGNED NOT NULL DEFAULT 0,
  `setlist_spot` int(3) UNSIGNED DEFAULT 1,
  `state` int(3) UNSIGNED NOT NULL DEFAULT 5,
  `title` varchar(254) NOT NULL,
  `artist` varchar(254) NOT NULL,
  `first_guitar` varchar(254) NOT NULL,
  `second_guitar` varchar(254) NOT NULL,
  `bass` varchar(254) NOT NULL,
  `drums` varchar(254) NOT NULL,
  `piano` varchar(254) NOT NULL,
  `first_voice` varchar(254) NOT NULL,
  `second_voice` varchar(254) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `is_in_concert`, `setlist_spot`, `state`, `title`, `artist`, `first_guitar`, `second_guitar`, `bass`, `drums`, `piano`, `first_voice`, `second_voice`, `created_at`, `updated_at`) VALUES
(11, 0, 2, 1, 'Thriller', 'Michael Jackson', '', '', '', '', '', '', '', '2024-12-02 22:54:43', '2024-12-20 00:37:18'),
(12, 0, 1, 4, 'Enter Sandman', 'Metallica', '', 'Leo', '', '', '', '', '', '2024-12-02 22:55:32', '2024-12-20 00:37:11'),
(13, 0, 3, 4, 'Toxicity', 'System of A Down', '', '', '', 'Leo', '', '', '', '2024-12-02 22:56:03', '2024-12-20 00:37:23'),
(14, 0, 1, 3, 'Seek and Destroy', 'Metallica', '', '', '', 'Leo', '', '', '', '2024-12-02 22:56:40', '2024-12-20 09:12:49'),
(15, 1, 1, 4, 'Black No.1', 'Nush', '', '', '', 'Leo', '', '', '', '2024-12-02 22:57:30', '2024-12-20 08:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `firstname` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lastname` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sex` enum('F','M') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `phone` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password_hash` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `verification_token` varchar(254) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `auth_key` (`auth_key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `firstname`, `lastname`, `sex`, `phone`, `birth_date`, `status`, `auth_key`, `password_hash`, `password_reset_token`, `verification_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'urecheatu007@gmail.com', 'Leo', 'Hutanu', 'M', '', NULL, 10, '62XosHOiCccwkrTCij676SF_rXyUQLl2', '$2y$13$M8mo4D3ct94rBqDMcqr2uuq8Yz3CTujfxeEg7a13yHETP3NS/apRi', NULL, NULL, '2024-05-21 08:05:44', '2024-12-12 19:51:52'),
(2, 'ADMIN', 'littlegamerdeiu@gmail.com', 'Hutanu', 'Deiu', NULL, NULL, NULL, 10, 'GlSQdASMDtccXTF67Owwti_Fb8PT8fZV', '$2y$13$plSTsq1fcyMhiUVogIvZ8.Y8qEdQVSFOEIRHQ3eS/A1ANlPomMacC', NULL, NULL, '2024-05-23 23:34:23', '2024-12-19 23:09:18'),
(3, 'Leo', 'andreileontinhutanu@gmail.com', 'Andrei', 'Hutanu', 'M', NULL, '2007-07-30', 10, 'hMmtbqHbunydWqwEGLnU0DMCRqFgnIbo', '$2y$13$BA5OsniwY.GW.B7D3n.4SurN8GTcOKyw9KI1VhLRD9UQ28gNcogW6', 'BECjvL5xg0xgnTCvECHShVWLTwxV6jdE_1720727147', NULL, '2024-05-22 00:12:27', '2024-12-19 23:09:20'),
(4, 'Robi', 'ghost@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, '2024-12-12 19:47:25', '2024-12-19 23:08:38'),
(6, 'Rares', 'ghost2@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, '2024-12-12 19:47:25', '2024-12-19 23:08:42'),
(7, 'Bogdan', 'ghost3@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, '2024-12-12 19:47:25', '2024-12-19 23:08:47');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
