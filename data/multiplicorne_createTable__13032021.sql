-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 13 mars 2021 à 17:21
-- Version du serveur :  10.3.25-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `multipli`
--

-- --------------------------------------------------------

--
-- Structure de la table `course_multiplication`
--

CREATE TABLE `course_multiplication` (
  `id` int(11) NOT NULL,
  `id_coureur` varchar(16) NOT NULL,
  `race_type` tinytext NOT NULL,
  `operation_type` tinytext NOT NULL,
  `table_multiplication` varchar(16) DEFAULT NULL,
  `melange` varchar(16) DEFAULT NULL,
  `date_course` datetime NOT NULL DEFAULT current_timestamp(),
  `temps_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `course_multiplication`
--

INSERT INTO `course_multiplication` (`id`, `id_coureur`, `race_type`, `operation_type`, `table_multiplication`, `melange`, `date_course`, `temps_course`) VALUES
(1, 'le_papa', 'marathon', 'multipli', 'Toutes ', 'mélangée', '2020-07-23 10:01:52', 128),
(3, 'le_papa', 'marathon', 'multipli', 'Toutes ', 'mélangée', '2020-07-24 10:34:47', 124),
(4, 'le_papa', 'marathon', 'multipli', 'Toutes ', 'mélangée', '2020-07-25 10:34:47', 126),
(11, 'le_papa', 'marathon', 'multipli', 'Toutes ', 'mélangée', '2020-07-25 12:38:34', 122),
(12, 'le_papa', 'marathon', 'multipli', 'Toutes ', 'mélangée', '2020-07-27 10:04:44', 125),
(33, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-10 10:21:58', 370),
(34, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-10 10:29:19', 338),
(35, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-11 10:11:44', 315),
(36, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-11 10:17:34', 286),
(37, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-13 10:11:25', 284),
(38, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-13 10:16:32', 268),
(41, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-14 10:15:32', 288),
(42, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-14 10:20:50', 282),
(45, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-16 10:14:34', 263),
(46, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-16 10:20:54', 300),
(47, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-17 10:10:03', 253),
(48, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-17 10:15:12', 282),
(49, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-19 10:14:11', 230),
(50, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-20 10:09:02', 242),
(51, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-22 10:10:21', 255),
(52, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'melangées', '2020-08-23 10:10:20', 249),
(53, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-09-19 10:09:41', 326),
(54, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-09-19 10:15:32', 283),
(55, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-09-20 10:06:24', 282),
(56, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-09-20 10:12:10', 274),
(57, 'le papa', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-09-26 13:22:51', 213),
(58, 'julien', 'sprint', 'multipli', '3', 'mélangée', '2020-09-29 08:05:39', 16),
(59, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-03 08:10:21', 395),
(60, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-03 08:16:45', 342),
(61, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-04 08:06:19', 268),
(62, 'lénaélle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-04 08:10:53', 230),
(63, 'popi', 'sprint', 'multipli', '7', 'dans l\'ordre', '2020-10-09 21:03:04', 38),
(64, 'le papa', 'sprint', 'multipli', '3', 'mélangée', '2020-10-12 07:09:50', 17),
(65, 'Celine', 'sprint', 'multipli', '2', 'dans l\'ordre', '2020-10-15 16:04:48', 163),
(66, 'Celine', 'sprint', 'multipli', '2', 'dans l\'ordre', '2020-10-15 16:08:44', 157),
(67, 'Celine', 'sprint', 'multipli', '3', 'dans l\'ordre', '2020-10-15 16:11:34', 148),
(68, 'Celine', 'sprint', 'multipli', '4', 'dans l\'ordre', '2020-10-15 16:13:46', 116),
(69, 'Celine', 'sprint', 'multipli', '5', 'dans l\'ordre', '2020-10-15 16:16:06', 106),
(70, 'Celine', 'sprint', 'multipli', '6', 'dans l\'ordre', '2020-10-15 16:22:37', 333),
(71, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-17 08:13:24', 340),
(72, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-17 08:20:13', 342),
(73, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-18 08:08:18', 282),
(74, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-18 08:15:35', 293),
(75, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-19 08:18:45', 234),
(76, 'Sylvain', 'sprint', 'multipli', '5', 'mélangée', '2020-10-19 09:17:19', 68),
(77, 'Sylvain', 'sprint', 'multipli', '5', 'mélangée', '2020-10-19 09:19:28', 80),
(78, 'Sylvain', 'sprint', 'multipli', '5', 'mélangée', '2020-10-19 09:22:38', 152),
(79, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-20 08:28:52', 230),
(80, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-20 08:28:53', 230),
(81, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-20 08:33:37', 209),
(82, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-21 08:11:41', 265),
(83, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-21 08:15:32', 219),
(84, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-22 08:10:41', 220),
(85, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-22 08:14:25', 201),
(86, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-23 08:11:30', 241),
(87, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-23 08:17:41', 229),
(88, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-23 08:22:19', 240),
(89, 'le papa', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-23 08:25:31', 120),
(90, 'le papa', 'sprint', 'multipli', '7', 'mélangée', '2020-10-23 08:26:47', 16),
(91, 'le papa', 'sprint', 'multipli', '3', 'mélangée', '2020-10-23 15:32:10', 27),
(92, 'Ms', 'sprint', 'multipli', '2', 'dans l\'ordre', '2020-10-24 20:08:11', 35),
(93, 'visiteur.euse', 'sprint', 'multipli', '2', 'dans l\'ordre', '2020-10-28 21:18:58', 8),
(94, 'visiteur.euse', 'sprint', 'multipli', '7', 'mélangée', '2020-10-31 08:46:27', 50),
(95, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-31 09:24:54', 255),
(96, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-10-31 09:30:08', 164),
(97, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-01 09:12:27', 243),
(98, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-01 09:16:38', 233),
(99, 'le papa', 'sprint', 'multipli', '2', 'dans l\'ordre', '2020-11-02 19:49:03', 13),
(100, 'visiteur.euse', 'sprint', 'multipli', '4', 'mélangée', '2020-11-04 07:21:25', 31),
(104, 'visiteur.euse', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-04 07:26:51', 208),
(105, 'Celine', 'sprint', 'multipli', '2', 'dans l\'ordre', '2020-11-08 12:15:09', 72),
(106, 'Celine', 'sprint', 'multipli', '3', 'dans l\'ordre', '2020-11-08 12:18:38', 58),
(107, 'Celine', 'sprint', 'multipli', '4', 'dans l\'ordre', '2020-11-08 12:21:51', 71),
(108, 'Celine', 'sprint', 'multipli', '5', 'dans l\'ordre', '2020-11-08 12:24:10', 60),
(109, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-14 09:10:06', 262),
(110, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-14 09:16:58', 214),
(111, 'visiteur.euse', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-14 21:23:11', 179),
(112, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-15 09:18:03', 242),
(113, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-15 09:22:28', 238),
(114, 'le papa', 'sprint', 'multipli', '5', 'mélangée', '2020-11-25 11:08:40', 17),
(115, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-28 09:12:13', 301),
(116, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-28 09:16:49', 267),
(117, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-28 09:21:51', 291),
(118, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-29 09:07:11', 243),
(119, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-29 09:13:22', 244),
(120, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-11-29 09:18:00', 224),
(121, 'visiteur.euse', 'sprint', 'multipli', '6', 'mélangée', '2020-12-02 10:52:05', 14),
(122, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-12 09:06:23', 302),
(123, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-12 09:10:54', 245),
(124, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-13 09:10:02', 259),
(125, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-13 09:14:57', 245),
(126, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-27 09:07:27', 291),
(127, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-27 09:12:54', 295),
(128, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-28 09:14:25', 256),
(129, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-28 09:19:22', 283),
(130, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-28 09:24:09', 244),
(131, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-29 09:12:04', 219),
(132, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-29 09:17:02', 219),
(133, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-30 09:06:19', 261),
(134, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-30 09:10:38', 237),
(135, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-30 09:15:32', 266),
(136, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-31 09:08:21', 216),
(137, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2020-12-31 09:12:27', 209),
(138, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-01-09 09:08:27', 247),
(139, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-01-09 09:13:32', 241),
(140, 'lenaelle', 'sprint', 'multipli', '5', 'mélangée', '2021-01-09 09:18:13', 48),
(141, 'lenaelle', 'sprint', 'multipli', '6', 'dans l\'ordre', '2021-01-09 09:23:46', 163),
(142, 'lenaelle', 'sprint', 'multipli', '5', 'dans l\'ordre', '2021-01-10 09:07:39', 93),
(143, 'lenaelle', 'sprint', 'multipli', '3', 'dans l\'ordre', '2021-01-10 09:09:06', 61),
(144, 'lenaelle', 'sprint', 'multipli', '3', 'dans l\'ordre', '2021-01-10 09:17:13', 54),
(145, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-01-23 09:23:32', 329),
(146, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-01-23 09:32:34', 266),
(147, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-01-23 09:37:18', 268),
(148, 'lenaelle', 'sprint', 'multipli', '6', 'dans l\'ordre', '2021-01-23 09:40:42', 127),
(149, 'lenaelle', 'sprint', 'multipli', '3', 'dans l\'ordre', '2021-01-24 09:02:14', 40),
(150, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-01-24 09:11:57', 519),
(151, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-02-06 09:17:22', 242),
(152, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-02-06 09:22:31', 255),
(153, 'lenaelle', 'sprint', 'multipli', '2', 'dans l\'ordre', '2021-02-11 09:40:37', 81),
(154, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-02-21 09:08:03', 328),
(155, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-02-21 09:13:42', 325),
(156, 'lenaelle', 'sprint', 'multipli', '2', 'dans l\'ordre', '2021-02-21 09:16:27', 73),
(157, 'lenaelle', 'sprint', 'multipli', '3', 'dans l\'ordre', '2021-02-21 09:17:49', 57),
(158, 'lenaelle', 'sprint', 'multipli', '3', 'dans l\'ordre', '2021-02-21 09:20:00', 52),
(159, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-03-06 09:05:55', 250),
(160, 'lenaelle', 'marathon', 'multipli', 'Toutes ', 'mélangées', '2021-03-06 09:10:50', 238),
(161, 'lenaelle', 'sprint', 'multipli', '2', 'dans l\'ordre', '2021-03-06 16:23:51', 13),
(162, 'le papa', 'sprint', 'multipli', '2', 'dans l\'ordre', '2021-03-12 18:45:57', 16),
(163, 'le papa', 'sprint', 'multipli', '2', 'dans l\'ordre', '2021-03-12 19:39:01', 9),
(170, 'le papa', 'sprint', 'add', '', '', '2021-03-13 14:47:41', 4),
(171, 'le papa', 'marathon', 'add_sub', '', '', '2021-03-13 14:49:16', 11),
(172, 'le papa', 'marathon', 'add_sub', '', '', '2021-03-13 14:51:12', 6),
(173, 'le papa', 'marathon', 'multipli', '', '', '2021-03-13 14:51:36', 4),
(174, 'le papa', 'sprint', 'add', '', '', '2021-03-13 14:52:30', 4),
(175, 'le papa', 'sprint', 'sub', '', '', '2021-03-13 14:52:43', 4),
(176, 'le papa', 'sprint', 'multipli', '3', 'dans l\'ordre', '2021-03-13 14:52:58', 3),
(177, 'le papa', 'sprint', 'multipli', '4', 'mélangée', '2021-03-13 14:53:35', 5),
(178, 'le papa', 'marathon', 'multipli', '', '', '2021-03-13 14:54:21', 4),
(179, 'le papa', 'sprint', 'sub', '', '', '2021-03-13 14:54:35', 5);



--
-- Index pour les tables déchargées
--

--
-- Index pour la table `course_multiplication`
--
ALTER TABLE `course_multiplication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `course_multiplication`
--
ALTER TABLE `course_multiplication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
