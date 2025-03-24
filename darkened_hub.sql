-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2025 at 07:53 PM
-- Server version: 10.6.21-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darkened_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Concert de Crăciun', 'Ești liber pe 13 Decembrie? Te invităm la încă un concert marca <b style=\"color: var(--primary-color);\">Darkened Tunes</b> cu intrare liberă. Evenimentul se desfășoară în sala de festivități. <br>\nAdună-ți prietenii și hai să simțim spiritul Crăciunului împreună!', '2024-11-15 14:27:09', '2025-02-15 13:36:53'),
(4, 'Concert pe 2 Martie!', 'Vă invităm la cel mai bun (și cel mai întârziat) concert de Valentine\'s pe data de <b style=\"color: var(--primary-color);\">2 Martie, Duminică</b>. Concertul va avea loc în incinta liceului.', '2025-02-14 21:39:09', '2025-02-15 22:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
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

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
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

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
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

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

CREATE TABLE `concert` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(254) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 9
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`id`, `title`, `description`, `date`, `status`) VALUES
(6, 'Concert Crăciun', '', '2024-12-13 19:15:00', 9),
(7, 'Concert Halloween', '', '2024-11-17 19:00:00', 9),
(8, 'Concert Valentines Intarziat', '', '2025-03-02 19:15:00', 9),
(9, 'Concert de Primavara', '', '2025-04-01 19:00:00', 9),
(10, 'Concert de Test', 'Doar o simpla descriere.', '2025-03-08 19:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
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

CREATE TABLE `proposal` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(254) NOT NULL,
  `artist` varchar(254) NOT NULL,
  `username` varchar(254) NOT NULL,
  `info` varchar(254) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id`, `title`, `artist`, `username`, `info`, `created_at`, `updated_at`) VALUES
(6, 'Hai sa nu ne certam', 'Bosquito', 'Leo', 'PLS :P', '2024-12-04 21:12:06', '2024-12-15 20:07:20'),
(10, 'Gasoline', 'I Prevail', 'Leo', '', '2024-12-15 20:06:52', '2024-12-15 20:07:15'),
(11, 'Coruptia Ucide', 'Trooper', 'Leo', '', '2024-12-15 20:07:18', '2024-12-15 20:07:12'),
(14, 'Blackbird', 'Alter Bridge', 'Leo', '', '2024-12-17 13:58:51', '2024-12-17 11:58:51'),
(16, 'Biscuit', 'Darkened Tunes ', 'axel', 'in buzunar e-un biscuit', '2024-12-22 19:20:08', '2024-12-22 17:20:08'),
(17, 'Cigaro', 'Soad', 'Mehi', '', '2025-01-04 10:55:56', '2025-01-04 08:56:15'),
(18, 'leave me alone', 'mj', 'mariuca_dumi', '', '2025-01-04 12:28:47', '2025-01-04 10:28:47'),
(19, 'Black hole sun', 'Soundgarden', 'Tudor Late', '', '2025-02-22 10:47:54', '2025-02-22 08:48:13'),
(20, 'Stadium Arcadium', 'RHCP', 'David tobe', '', '2025-02-22 11:18:03', '2025-02-22 09:18:03'),
(21, 'hotel california', 'eagles', 'axel', '', '2025-02-22 14:22:17', '2025-02-22 12:22:17'),
(22, 'Stairway to heaven ', 'led zeppelin ', 'axel', '', '2025-02-22 14:23:12', '2025-02-22 12:23:12'),
(23, 'when a blind man cries', 'deep purple', 'axel', '', '2025-02-22 14:25:01', '2025-02-22 12:25:01'),
(24, 'like a stone', 'audioslave ', 'axel', '', '2025-02-22 14:26:46', '2025-02-22 12:26:46'),
(25, 'she-wolf', 'megadeth', 'axel', '', '2025-02-22 14:29:11', '2025-02-22 12:29:11'),
(26, 'down in a hole', 'alice in chains', 'axel', '', '2025-02-22 15:15:52', '2025-02-22 13:15:52'),
(27, 'simple man', 'lynyrd skynyrd', 'axel', '', '2025-02-22 15:56:53', '2025-02-22 13:56:53'),
(28, 'orion', 'metallica', 'axel', 'asta ar merge de inceput de concert, nu are voce dar fiecare instrument are cate un solo', '2025-02-22 16:52:42', '2025-02-22 14:53:11'),
(29, 'Pentru inimi', 'Suie Paparude', 'Mevayido', 'Nu cred ca merge sa o cantam pt ca nu avem sintetizator, dar ar suna cat de cat bine', '2025-02-26 11:44:19', '2025-02-26 09:44:19'),
(30, 'One', 'Metallica', 'Toma', 'taratataratata    taratataratata    taratataratata    taratataratata', '2025-02-26 20:37:19', '2025-02-26 18:37:19'),
(31, 'Them Bones', 'Alice In Chains ', 'raducu', 'Trebuie. ', '2025-02-27 18:28:49', '2025-02-27 16:28:49'),
(32, 'Basul și cu Toba Mare', 'Vita de Vie', 'raducu', 'headbang.', '2025-02-27 18:31:13', '2025-02-27 16:31:13'),
(33, 'Rooster', 'Alice In Chains ', 'raducu', '', '2025-02-27 18:32:13', '2025-02-27 16:32:13'),
(34, 'Crazy Train ', 'Ozzy Osbourne ', 'raducu', 'E un must și asta.', '2025-02-27 18:33:15', '2025-02-27 16:33:15'),
(35, 'Open your eyes', 'Guano Apes', 'Toma', '', '2025-02-27 20:34:06', '2025-02-27 18:34:06'),
(36, 'Blînd ', 'Cucuruz', 'Toma', '', '2025-02-27 20:37:23', '2025-02-27 18:37:23'),
(37, 'You could be mine', 'Guns n Roses', 'Toma', '', '2025-02-27 20:38:10', '2025-02-27 18:38:10'),
(38, 'Civil War', 'Guns N Roses ', 'raducu', '', '2025-02-28 10:43:59', '2025-02-28 08:43:59'),
(39, 'Wings of a butterfly', 'HIM', 'Toma', '', '2025-02-28 16:48:16', '2025-02-28 14:48:16'),
(40, 'Wicked game ', 'HIM', 'Toma', '', '2025-02-28 16:48:32', '2025-02-28 14:48:32'),
(41, 'Get Lucky ', 'Daft Punk', 'axel', '', '2025-03-01 17:25:31', '2025-03-01 15:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `public_proposal`
--

CREATE TABLE `public_proposal` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(254) NOT NULL,
  `artist` varchar(254) NOT NULL,
  `info` varchar(254) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `public_proposal`
--

INSERT INTO `public_proposal` (`id`, `title`, `artist`, `info`, `created_at`, `updated_at`) VALUES
(1, 'Nebun de Alb', 'Emeric Imre', 'test', '2024-12-04 19:41:55', '2024-12-16 12:59:22'),
(2, 'Wicked Game', 'HIM', 'test2', '2024-12-04 19:54:35', '2024-12-16 12:59:21'),
(3, 'Ego Brain', 'System of A Down', 'Raluca', '2024-12-04 19:56:07', '2024-12-16 12:59:20'),
(4, 'I Hate Everything About You', 'Three Days Grace', 'Dedicata tie Tudor', '2024-12-04 21:09:24', '2024-12-16 12:59:18'),
(5, 'Gasoline', 'I Prevail', 'Nu prea merge live dar am descoperit-o ieri si efectiv o iubesc e cea mai tare nu pot trai fara ea cred ca o sa mor ', '2024-12-04 21:11:40', '2024-12-16 12:59:17'),
(6, 'Hai sa nu ne certam', 'Bosquito', 'PLS :P', '2024-12-04 21:12:06', '2024-12-16 12:59:14'),
(12, 'Leave Me Alone', 'Michael Jackson', 'VREAU', '2024-12-22 18:09:33', '2024-12-22 18:37:13'),
(13, 'Wherever I May Roam', 'Metallica', 'Metallica e jmecher', '2025-01-04 20:20:13', '2025-01-04 18:20:13'),
(14, 'Layla', 'Eric Clapton', '(Unplugged)', '2025-01-09 14:04:26', '2025-01-09 12:04:26'),
(15, 'Biscuit', 'Darkened Tunes', 'deci am fost acu de dimineata in statia de autobuz si am asteptat 15 minute ca sa vina si am injurat stb de toti mortii\r\nin buzunar un biscuit', '2025-01-23 07:57:38', '2025-01-23 05:57:38'),
(16, 'Sonne', 'Rammstein', '', '2025-02-04 14:11:47', '2025-02-04 12:11:47'),
(17, 'de ce plang chitarele ', 'o-zone ', '', '2025-02-16 01:36:10', '2025-02-19 16:06:37'),
(18, 'Knee Socks', 'Arctic Monkeys', '', '2025-02-22 14:37:21', '2025-02-22 12:37:21'),
(19, 'Fein', 'Travis Scott', '', '2025-02-22 15:27:23', '2025-02-22 13:27:23'),
(20, 'Eyeless', 'Slipknot', 'Nu.', '2025-02-22 17:37:51', '2025-02-22 15:37:51'),
(21, 'I Don’t Want To Miss a Thing', 'Aerosmith', '', '2025-02-23 08:37:58', '2025-02-23 06:37:58'),
(22, 'Valurile', 'om la luna', '', '2025-02-24 00:09:37', '2025-02-23 22:09:37'),
(23, 'Arise', 'Sepultura', '', '2025-02-28 10:42:08', '2025-02-28 08:42:08'),
(24, 'A fine day to die', 'Bathory', '', '2025-02-28 10:42:51', '2025-02-28 08:42:51'),
(25, 'Chopped in half', 'Obituary', '', '2025-02-28 10:43:24', '2025-02-28 08:43:24'),
(26, 'Becoming', 'Pantera', '', '2025-02-28 10:43:55', '2025-02-28 08:43:55'),
(27, 'Ocean planet', 'Gojira', '', '2025-02-28 10:44:11', '2025-02-28 08:44:11'),
(28, 'La inima m ai ars', 'Florin salam', '', '2025-02-28 10:44:58', '2025-02-28 08:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(11) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `is_in_concert`, `setlist_spot`, `state`, `title`, `artist`, `first_guitar`, `second_guitar`, `bass`, `drums`, `piano`, `first_voice`, `second_voice`, `created_at`, `updated_at`) VALUES
(33, 0, NULL, 2, '(I Just) Died in your arms tonight', 'Cutting Crew', 'raducu', 'axel', 'Mehi', 'David tobe', 'liz', 'mariuca_dumi', 'David_Picard', '2024-12-31 10:09:13', '2025-03-03 16:54:42'),
(34, 0, NULL, 3, 'Still loving you', 'Scorpions', 'Tudor Late', 'raducu', 'Tori', 'David tobe', '', 'ioana', '', '2024-12-31 10:10:01', '2025-03-03 16:54:46'),
(35, 1, NULL, 3, 'Nothing else matters', 'Metallica', 'raducu', 'Alex', 'Mosti', 'David tobe', '', 'ioana', '', '2024-12-31 10:11:12', '2025-02-13 11:44:02'),
(36, 0, NULL, 3, 'cant take my eyes off you', 'Muse', 'Tudor Late', 'Toma', 'Mehi', 'David tobe', '', 'David_Picard', 'liz', '2024-12-31 10:11:47', '2025-03-03 16:55:33'),
(37, 0, NULL, 3, 'Die with a smile', 'Lady Gaga', 'Tudor Late', 'Toma', 'Otilia-Istrate', 'David tobe', '', 'mariuca_dumi', '', '2024-12-31 10:13:05', '2025-03-03 16:55:24'),
(38, 0, NULL, 2, 'Crazy ', 'Aerosmith', 'axel', 'Toma', 'Tori', 'David tobe', 'liz', 'ioana', '', '2024-12-31 10:13:59', '2025-03-03 16:55:04'),
(39, 0, NULL, 4, 'Ce seara minunata ', 'Ion Suruceanu ', 'Tudor Late', 'axel', 'Mosti', 'Leo', 'liz', 'David_Picard', '', '2024-12-31 10:14:22', '2025-03-03 16:55:38'),
(40, 1, NULL, 3, 'lonely day', 'System of a Down', 'Tudor Late', 'Alex', 'Mehi', 'Leo', '', 'mariuca_dumi', '', '2024-12-31 10:15:10', '2025-02-02 16:26:10'),
(41, 1, NULL, 4, 'are you gonna be my girl', 'Jet', 'Tudor Late', 'Toma', 'Tori', 'Leo', '', 'ioana', '', '2024-12-31 10:15:46', '2025-01-27 15:24:00'),
(42, 1, NULL, 2, 'Stairway to heaven', 'Led Zeppelin', 'axel', 'raducu', 'Mosti', 'David tobe', '', 'mariuca_dumi', '', '2024-12-31 10:17:05', '2025-03-03 16:58:21'),
(43, 0, NULL, 3, 'Fata din vis', 'Compact', 'Tudor Late', 'axel', 'Tori', 'Leo', '', 'David_Picard', '', '2024-12-31 10:17:56', '2025-03-03 16:55:45'),
(44, 0, NULL, 2, 'Sa nu-mi iei niciodata dragostea', 'Holograf', 'Tudor Late', 'Alex', 'Otilia-Istrate', 'Leo', 'liz', 'ioana', '', '2024-12-31 10:18:46', '2025-03-03 16:55:50'),
(45, 1, NULL, 4, 'Wish you were here', 'Pink Floyd', 'axel', 'Tudor Late', 'Mosti', 'Leo', 'liz', 'mariuca_dumi', 'axel', '2024-12-31 10:19:24', '2025-02-13 11:44:58'),
(46, 0, NULL, 3, 'Angel of small death and the codeine scene', 'Hozier', 'Toma', 'Tudor Late', 'Otilia-Istrate', 'David tobe', '', 'ioana', '', '2024-12-31 10:20:39', '2025-03-03 16:55:57'),
(47, 1, NULL, 3, 'no surprises', 'Radiohead', 'Alex', 'Toma', 'Mehi', 'Leo', 'liz', 'mariuca_dumi', '', '2024-12-31 10:21:15', '2025-02-18 12:58:24'),
(49, 0, NULL, 5, 'Heart Shaped Box ', 'Nirvana ', 'Toma', '', '', 'David tobe', '', '', '', '2025-02-20 18:30:08', '2025-02-20 16:37:55'),
(50, 1, NULL, 4, 'Enter Sandman', 'Metallica', 'Toma', 'Leo', '', 'ioana', '', 'ioana', '', '2025-03-03 18:56:18', '2025-03-03 16:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(22, 'Ama', 'amalia.radoi20@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, '5oYS_UleTosvn2XoUT_vHpzGXj8Zv2ia', '$2y$13$O6lqr0o.76wkuJGAbweIO.LMp4Cae39Jxw.G82oJGLl5pRkSdDeji', NULL, NULL, '2024-12-31 10:55:56', '2025-02-26 11:56:28'),
(23, 'Mosti', 'tudormosteanu2@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'IooI9Xy-KFyzZITiuJmJzU-qpaODufQp', '$2y$13$3NnP5fudJhWtD/qjgffkROOO9TakMQ00LbzO69b0rskB/4OvhCHru', NULL, NULL, '2024-12-31 10:56:24', '2024-12-31 08:56:24'),
(24, 'David tobe', 'davidstefanroman2000@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'ZXK1Ruw6T-BQ9xMAWLTW3c-g9vPokPXx', '$2y$13$pYVU./EuZAvv3Er/5615vOBunaqS64nlE5ug.CU07jhP.fyNG6DUC', NULL, NULL, '2024-12-31 10:57:51', '2024-12-31 08:57:51'),
(25, 'Toma', 'Alextomalupu@gmail.com', NULL, NULL, NULL, NULL, NULL, 10, 'BC-VsaWwEVh3tkx7sqEa2RpqHXHHIldx', '$2y$13$w8q7ElyYcmGG3qMxRqhAAurLf2KnSd0RCu6FpjN3uNA5kxOV6CPXu', NULL, NULL, '2024-12-31 12:11:31', '2024-12-31 10:11:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `idx-auth_item-type` (`type`),
  ADD KEY `rule_name` (`rule_name`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `date` (`date`) USING BTREE;

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_proposal`
--
ALTER TABLE `public_proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD UNIQUE KEY `auth_key` (`auth_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `concert`
--
ALTER TABLE `concert`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `public_proposal`
--
ALTER TABLE `public_proposal`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
