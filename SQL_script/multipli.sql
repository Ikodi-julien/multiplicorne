-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 03 nov. 2020 à 19:41
-- Version du serveur :  8.0.22-0ubuntu0.20.04.2
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
  `id` int NOT NULL,
  `id_coureur` varchar(16) NOT NULL,
  `table_multiplication` varchar(16) NOT NULL,
  `melange` varchar(16) NOT NULL,
  `date_course` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temps_course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `course_multiplication`
--

INSERT INTO `course_multiplication` (`id`, `id_coureur`, `table_multiplication`, `melange`, `date_course`, `temps_course`) VALUES
(1, 'le papa', 'Toutes ', 'mélangée', '2020-07-23 10:01:52', '2 mn 8 s'),
(3, 'le papa', 'Toutes ', 'mélangée', '2020-07-25 10:34:47', '2 mn 6 s'),
(4, 'le papa', 'Toutes ', 'mélangée', '2020-07-25 12:38:34', '2 mn 2 s'),
(5, 'le papa', 'Toutes ', 'mélangée', '2020-07-27 10:04:44', '2 mn 5 s'),
(6, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-10 10:21:58', '6 mn 10 s'),
(7, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-10 10:29:19', '5 mn 38 s'),
(8, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-11 10:11:44', '5 mn 15 s'),
(9, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-11 10:17:34', '4 mn 46 s'),
(10, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-13 10:11:25', '4 mn 44 s'),
(11, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-13 10:16:32', '4 mn 28 s'),
(12, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-14 10:15:32', '4 mn 48 s'),
(13, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-14 10:20:50', '4 mn 42 s'),
(14, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-16 10:14:34', '4 mn 23 s'),
(15, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-16 10:20:54', '5 mn 0 s'),
(16, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-17 10:10:03', '4 mn 13 s'),
(17, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-17 10:15:12', '4 mn 42 s'),
(18, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-19 10:14:11', '3 mn 50 s'),
(19, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-20 10:09:02', '4 mn 2 s'),
(20, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-22 10:10:21', '4 mn 15 s'),
(21, 'lénaëlle', 'Toutes ', 'melangées', '2020-08-23 10:10:20', '4 mn 9 s'),
(22, 'lénaëlle', 'Toutes ', 'mélangées', '2020-09-19 10:09:41', '5 mn 26 s'),
(23, 'lénaëlle', 'Toutes ', 'mélangées', '2020-09-19 10:15:32', '4 mn 43 s'),
(24, 'le papa', '2', 'dans l\'ordre', '2020-10-20 15:19:27', '0 mn 18 s'),
(25, 'le papa', '2', 'dans l\'ordre', '2020-10-20 17:29:14', '0 mn 15 s'),
(28, 'le_papa', '2', 'dans l\'ordre', '2020-10-23 15:24:17', '0 mn 10 s'),
(29, 'le_papa', 'Toutes ', 'mélangées', '2020-10-23 15:32:42', '2 mn 31 s'),
(30, 'visiteur.euse', '2', 'dans l\'ordre', '2020-10-28 22:04:40', '0 mn 15 s'),
(31, 'visiteur.euse', '2', 'dans l\'ordre', '2020-10-28 22:15:38', '0 mn 9 s'),
(32, 'visiteur.euse', '2', 'dans l\'ordre', '2020-10-28 22:19:02', '0 mn 13 s'),
(33, 'le_papa', '2', 'dans l\'ordre', '2020-11-02 18:53:55', '0 mn 17 s'),
(34, 'le_papa', 'Toutes ', 'mélangées', '2020-11-02 19:04:36', '2 mn 9 s');

-- --------------------------------------------------------

--
-- Structure de la table `Profil`
--

CREATE TABLE `Profil` (
  `id` int NOT NULL,
  `Pseudo` varchar(16) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `profil_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `style` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'neutre.css',
  `avatar` varchar(30) NOT NULL DEFAULT 'licorne'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Profil`
--

INSERT INTO `Profil` (`id`, `Pseudo`, `mdp`, `profil_creation_date`, `email`, `birth_date`, `style`, `avatar`) VALUES
(1, 'le papa', '$2y$10$8leSnsT3QFHqHnbB2yZuKuYb2370Tf4KkYs67ptaJQelfdRTs0ALm', '2020-10-23 13:27:35', 'jupellin39@gmail.com', '1976-11-24 00:00:00', 'high_contrast.css', 'chevalier'),
(2, 'le_papa', '$2y$10$ZLHJJv0c7moEiU01d0rjXOvX5a0zaVbEYW6hcITdG2.1pke/wqQsW', '2020-10-23 13:27:35', '', '1976-11-24 00:00:00', 'licorne.css', 'chevalier'),
(3, 'Fred', '$2y$10$ABYytE8Mpb3D3XhrOv/VEezbPnt8PyulkA6/w5sF1zWBXq9F39gBa', '2020-10-23 13:27:35', 'jupellin39@gmail.com', NULL, 'neutre.css', 'licorne'),
(4, 'gege', '$2y$10$FJMXQTWWnXzwHXtUe83QbeaYB3Vnw21GrYK98tT4.GxCpWbfrH.YW', '2020-10-23 13:27:35', 'jupellin39@gmail.com', NULL, 'neutre.css', 'licorne'),
(5, '', '$2y$10$SFsaNFalVveCgvfgj5ejreSo8FNW3H7PVwFFgmbEgZHPfoJh2nKX.', '2020-10-28 20:25:13', '', NULL, 'neutre.css', 'licorne');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `course_multiplication`
--
ALTER TABLE `course_multiplication`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Profil`
--
ALTER TABLE `Profil`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `course_multiplication`
--
ALTER TABLE `course_multiplication`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `Profil`
--
ALTER TABLE `Profil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
