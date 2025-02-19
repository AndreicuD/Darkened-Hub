-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 19, 2025 at 08:26 PM
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
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Concert de Crăciun', 'Ești liber pe 13 Decembrie? Te invităm la încă un concert marca <b style=\"color: var(--primary-color);\">Darkened Tunes</b> cu intrare liberă. Evenimentul se desfășoară în sala de festivități. <br>\nAdună-ți prietenii și hai să simțim spiritul Crăciunului împreună!', '2024-11-15 14:27:09', '2025-02-15 13:36:53'),
(4, 'Concert pe 2 Martie!', 'Vă invităm la cel mai bun (și cel mai întârziat) concert de Valentine\'s pe data de <b style=\"color: var(--primary-color);\">2 Martie, Duminică</b>. <br>Concertul va avea loc în incinta liceului.', '2025-02-14 21:39:09', '2025-02-16 14:27:59');

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
-- Table structure for table `concert`
--

DROP TABLE IF EXISTS `concert`;
CREATE TABLE IF NOT EXISTS `concert` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(254) NOT NULL,
  `title` varchar(254) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`id`, `date`, `title`, `description`) VALUES
(1, '2025-02-19 00:10', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `title`, `artist`, `username`, `info`, `created_at`, `updated_at`) VALUES
(6, 'Hai sa nu ne certam', 'Bosquito', 'Leo', 'PLS :P', '2024-12-04 21:12:06', '2024-12-15 20:07:20'),
(9, 'Ego Brain', 'System of A Down', 'Leo', 'Am o arma la tampla\r\nPLZ SEND HELP', '2024-12-04 22:41:55', '2024-12-15 20:07:18'),
(10, 'Gasoline', 'I Prevail', 'Leo', '', '2024-12-15 20:06:52', '2024-12-15 20:07:15'),
(11, 'Coruptia Ucide', 'Trooper', 'Leo', '', '2024-12-15 20:07:18', '2024-12-15 20:07:12'),
(14, 'Blackbird', 'Alter Bridge', 'Leo', 'Test Edit dupa restructurare', '2024-12-17 13:58:51', '2024-12-21 21:58:04');

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
(3, 'Ego Brain', 'System of A Down', 'Raluca test restructurare', '2024-12-04 19:56:07', '2024-12-21 21:58:32'),
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `is_in_concert`, `setlist_spot`, `state`, `title`, `artist`, `first_guitar`, `second_guitar`, `bass`, `drums`, `piano`, `first_voice`, `second_voice`, `created_at`, `updated_at`) VALUES
(33, 1, NULL, 2, '(I Just) Died in your arms tonight', 'Cutting Crew', 'raducu', 'axel', 'Mehi', 'David tobe', 'liz', 'mariuca_dumi', 'David_Picard', '2024-12-31 10:09:13', '2025-01-27 15:24:19'),
(34, 1, NULL, 3, 'Still loving you', 'Scorpions', 'Tudor Late', 'raducu', 'Tori', 'David tobe', '', 'ioana', '', '2024-12-31 10:10:01', '2025-01-27 15:23:11'),
(35, 1, NULL, 3, 'Nothing else matters', 'Metallica', 'raducu', 'Alex', 'Mosti', 'David tobe', '', 'ioana', '', '2024-12-31 10:11:12', '2025-02-13 11:44:02'),
(36, 1, NULL, 3, 'cant take my eyes off you', 'Muse', 'Tudor Late', 'Toma', 'Mehi', 'David tobe', '', 'David_Picard', 'liz', '2024-12-31 10:11:47', '2025-02-07 20:15:23'),
(37, 0, NULL, 3, 'Die with a smile', 'Lady Gaga', 'Tudor Late', 'Toma', 'Otilia-Istrate', 'David tobe', 'Mevayido', 'mariuca_dumi', '', '2024-12-31 10:13:05', '2025-02-18 16:33:14'),
(38, 1, NULL, 2, 'Crazy ', 'Aerosmith', 'axel', 'Toma', 'Tori', 'David tobe', '', 'ioana', '', '2024-12-31 10:13:59', '2025-02-02 16:27:44'),
(39, 1, NULL, 4, 'Ce seara minunata ', 'Ion Suruceanu ', 'Tudor Late', 'axel', 'Mosti', 'Leo', 'liz', 'David_Picard', '', '2024-12-31 10:14:22', '2025-01-27 15:23:50'),
(40, 1, NULL, 3, 'lonely day', 'System of a Down', 'Tudor Late', 'Alex', 'Mehi', 'Leo', '', 'mariuca_dumi', '', '2024-12-31 10:15:10', '2025-02-02 16:26:10'),
(41, 1, NULL, 4, 'are you gonna be my girl', 'Jet', 'Tudor Late', 'Toma', 'Tori', 'Leo', '', 'ioana', '', '2024-12-31 10:15:46', '2025-01-27 15:24:00'),
(42, 1, NULL, 1, 'Stairway to heaven', 'Led Zeppelin', 'axel', 'raducu', 'Mosti', 'David tobe', '', 'mariuca_dumi', '', '2024-12-31 10:17:05', '2025-02-18 12:37:24'),
(43, 1, NULL, 3, 'Fata din vis', 'Compact', 'Tudor Late', 'axel', 'Tori', 'Leo', 'Mevayido', 'David_Picard', '', '2024-12-31 10:17:56', '2025-02-15 08:34:31'),
(44, 1, NULL, 2, 'Sa nu-mi iei niciodata dragostea', 'Holograf', 'Tudor Late', 'Alex', 'Otilia-Istrate', 'Leo', 'liz', 'ioana', '', '2024-12-31 10:18:46', '2025-02-02 16:26:31'),
(45, 1, NULL, 4, 'Wish you were here', 'Pink Floyd', 'axel', 'Tudor Late', 'Mosti', 'Leo', 'liz', 'mariuca_dumi', 'axel', '2024-12-31 10:19:24', '2025-02-13 11:44:58'),
(46, 1, NULL, 3, 'Angel of small death and the codeine scene', 'Hozier', 'Toma', 'Tudor Late', 'Otilia-Istrate', 'Leo', '', 'ioana', '', '2024-12-31 10:20:39', '2025-01-27 15:24:47'),
(47, 1, NULL, 3, 'no surprises', 'Radiohead', 'Alex', 'Toma', 'Mehi', 'Leo', '', 'mariuca_dumi', '', '2024-12-31 10:21:15', '2025-02-02 16:26:38');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `firstname`, `lastname`, `sex`, `phone`, `birth_date`, `status`, `auth_key`, `password_hash`, `password_reset_token`, `verification_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'urecheatu007@gmail.com', 'Leo', 'Hutanu', 'M', '', NULL, 10, '62XosHOiCccwkrTCij676SF_rXyUQLl2', '$2y$13$M8mo4D3ct94rBqDMcqr2uuq8Yz3CTujfxeEg7a13yHETP3NS/apRi', NULL, NULL, '2024-05-21 08:05:44', '2024-12-12 19:51:52'),
(2, 'ADMIN', 'littlegamerdeiu@gmail.com', 'Hutanu', 'Deiu', NULL, NULL, NULL, 10, 'GlSQdASMDtccXTF67Owwti_Fb8PT8fZV', '$2y$13$plSTsq1fcyMhiUVogIvZ8.Y8qEdQVSFOEIRHQ3eS/A1ANlPomMacC', NULL, NULL, '2024-05-23 23:34:23', '2024-12-19 23:09:18'),
(3, 'Leo', 'andreileontinhutanu@gmail.com', 'Andrei', 'Hutanu', 'M', NULL, '2007-07-30', 10, 'hMmtbqHbunydWqwEGLnU0DMCRqFgnIbo', '$2y$13$BA5OsniwY.GW.B7D3n.4SurN8GTcOKyw9KI1VhLRD9UQ28gNcogW6', 'BECjvL5xg0xgnTCvECHShVWLTwxV6jdE_1720727147', NULL, '2024-05-22 00:12:27', '2024-12-19 23:09:20'),
(4, 'Robi', 'ghost@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, '2024-12-12 19:47:25', '2024-12-19 23:08:38'),
(7, 'Bogdan', 'ghost2@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, '2024-12-12 19:47:25', '2024-12-22 22:48:42'),
(11, 'ioana', 'ioana_manarcescu@yahoo.com', NULL, NULL, NULL, NULL, NULL, 10, 'GULd2oVCSU5YBIAwOqV5LGsWr5yrHXod', '$2y$13$d/EBGJ/M6XlU3UJk3SEKoufcbgpNHE/ylSyIYoigtGDmR23gkkWrO', NULL, NULL, '2024-12-22 15:03:22', '2024-12-22 13:03:22'),
(12, 'Tudor Late', 'tudor1850tm@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'D73tYX890xoo2hbSJPCP1eLG-b50HuPe', '$2y$13$be8eKg5fJ5YJ6dhxm9LnVuELjx0gTCFP4kE1joGAlwhXcRDN2Izaa', NULL, NULL, '2024-12-22 15:05:48', '2024-12-22 13:05:48'),
(13, 'David_Picard', 'davidutz1406@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, '5PBV77M-w_Pz8ESXQiIr3GQ17nsY-2qA', '$2y$13$vV7qW4d/yA1/eRYF8rwBbOBM0fRqQ./Fw6Htt5p2mOXkhxshWs1YW', NULL, NULL, '2024-12-22 18:26:27', '2024-12-22 16:26:27'),
(14, 'Tori', 'patanvictoria@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'EVoBXWJWG1WITEFSdhLeNPCbfHSfIqMe', '$2y$13$Gmma97vRY6A97uJ.zXDzUutLtm6k.YIkRvJECW4m9gE1idgWA3csy', NULL, NULL, '2024-12-22 18:27:38', '2024-12-22 16:27:38'),
(15, 'Otilia-Istrate', 'andra.sara.otilia@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'uWAFB7-1gZqn1GI82tZ1CJYGu15Tw5yu', '$2y$13$XuEUha.fqV8MWo9gDZb7/OaQ/jQ5.jz9gje7WjrcZ7lpdUyPxC1Ge', NULL, NULL, '2024-12-22 18:54:36', '2025-01-18 08:47:57'),
(16, 'mariuca_dumi', 'dumitrascu.mariaioana08@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'IHQv9qOyyTZj0Xi4PyoVQsCpJ1li7bVH', '$2y$13$tbRs8ZXbaRoyZ7.V7DlppOrh31owZmFlJE0vPT8o9gHe6HwQO5M7.', NULL, NULL, '2024-12-22 19:13:21', '2024-12-22 17:13:21'),
(17, 'axel', 'bercenaruaxel@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'ukkDzQsr6YraROY4_fbU9Uo56r8dDyzr', '$2y$13$x5Bq8I5991/Tn4bub9eNfuN10jAiCKFEQw0FBmSbnqraApAx.pVra', NULL, NULL, '2024-12-22 19:16:58', '2024-12-22 17:16:58'),
(18, 'liz', 'stocole2@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, '4ltU7MBkINkaepcBcBU9GBy-7jTmU44Q', '$2y$13$FT2F7fps6ZLMfMyLxbJ.teC32S4LRWREuUxayX8F2Jucd.jncXs/C', NULL, NULL, '2024-12-22 19:18:04', '2024-12-22 17:18:04'),
(19, 'Mehi', 'mehi06mehi@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'Ln1PqZy1miLaql0Dy4pZ-zt84b4PQ1VO', '$2y$13$kANE5ArQbVubr.3jvt.uRuukjNJclTVBgnrsfGeCVJZNNaxIt9cHy', NULL, NULL, '2024-12-22 19:36:54', '2024-12-22 17:36:54'),
(20, 'raducu', 'darastef007@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'VnBX9d1LIQW7FkXci4RJVdPFGZdMDtBw', '$2y$13$i4aVnoNeWc2NH9.EUxebr.Q3qAVpy3oL/Q/aDR.TOQ0yPKC3X4l/y', NULL, NULL, '2024-12-23 17:14:51', '2024-12-23 15:14:51'),
(21, 'Alex', 'alex.parcalabu@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, '73g57TBRNM8x8qW9dLcWMm1it9qVM6Jy', '$2y$13$9m/8EFtomtCtkgXxiPF0vuzlR9Gc57AhsAsw8acHVyKRHNlFP8BL.', NULL, NULL, '2024-12-31 10:33:57', '2024-12-31 08:33:57'),
(22, 'Mevayido', 'amalia.radoi20@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, '5oYS_UleTosvn2XoUT_vHpzGXj8Zv2ia', '$2y$13$O6lqr0o.76wkuJGAbweIO.LMp4Cae39Jxw.G82oJGLl5pRkSdDeji', NULL, NULL, '2024-12-31 10:55:56', '2024-12-31 08:55:56'),
(23, 'Mosti', 'tudormosteanu2@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'IooI9Xy-KFyzZITiuJmJzU-qpaODufQp', '$2y$13$3NnP5fudJhWtD/qjgffkROOO9TakMQ00LbzO69b0rskB/4OvhCHru', NULL, NULL, '2024-12-31 10:56:24', '2024-12-31 08:56:24'),
(24, 'David tobe', 'davidstefanroman2000@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'ZXK1Ruw6T-BQ9xMAWLTW3c-g9vPokPXx', '$2y$13$pYVU./EuZAvv3Er/5615vOBunaqS64nlE5ug.CU07jhP.fyNG6DUC', NULL, NULL, '2024-12-31 10:57:51', '2024-12-31 08:57:51'),
(25, 'Toma', 'Alextomalupu@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'BC-VsaWwEVh3tkx7sqEa2RpqHXHHIldx', '$2y$13$w8q7ElyYcmGG3qMxRqhAAurLf2KnSd0RCu6FpjN3uNA5kxOV6CPXu', NULL, NULL, '2024-12-31 12:11:31', '2024-12-31 10:11:31'),
(26, 'Cont de Teste', 'contdetest@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'FrVT82c1y9yI2j2OWTyyeYpZOVvsazBr', '$2y$13$u1EDrChqHplfW2Q/mh3N6uE9b6j7ocU.gYuQ.Er2honvI6O6MTkQK', NULL, NULL, '2025-02-19 16:04:40', '2025-02-19 16:02:03');

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
