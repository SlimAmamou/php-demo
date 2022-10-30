-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 03 avr. 2022 à 23:50
-- Version du serveur :  10.4.11-MariaDB
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
-- Base de données : `gestion_evaluations`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` varchar(3) NOT NULL,
  `description_matiere` varchar(100) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `description_matiere`, `duree`) VALUES
('ARP', 'Approche structurée à la résolution de problèmes', 60),
('AWB', 'D&eacute;veloppement web 2', 60),
('BD1', 'Base de données 1', 60),
('BD2', 'Base de données 2', 60),
('DCS', 'Développement Web côté serveur', 60),
('DGP', 'Développement et gestion de projets', 60),
('DM1', 'Développement applications mobiles 1', 60),
('DM2', 'Développement applications mobiles 2', 60),
('DW1', 'Développement web 1 ', 60),
('DW2', 'Développement web 2', 60),
('INF', 'Infonuagique', 60),
('NTE', 'Nouvelles technologies', 60),
('P11', 'Projet d’intégration 1 – Programmation orienté objet ', 60),
('P12', 'Projet d’intégration 2 – Programmation WEB', 60),
('PFE', 'Projet de fin d\'études  – Intégration', 270),
('PO1', 'Programmation orientée objet 1', 60),
('PO2', 'Programmation orientée objet 2', 60),
('PPA', 'Profession de programmeur-analyste', 60),
('PWB', 'Programmation web', 60),
('TDD', 'Traitement de données', 60);

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL,
  `codeCours` varchar(3) NOT NULL,
  `ponderation` int(11) NOT NULL,
  `evaluation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evaluations`
--

INSERT INTO `evaluations` (`id`, `codeCours`, `ponderation`, `evaluation`) VALUES
(1, 'PPA', 25, 'Examen intra'),
(2, 'PPA', 30, 'Examen final'),
(3, 'PPA', 45, 'Projet 1'),
(4, 'DW1', 25, 'Examen intra'),
(5, 'DW1', 30, 'Examen final'),
(6, 'DW1', 45, 'Projet 1'),
(7, 'ARP', 25, 'Examen intra'),
(8, 'ARP', 30, 'Examen final'),
(9, 'ARP', 45, 'Projet 1'),
(10, 'DW2', 25, 'Examen intra'),
(11, 'DW2', 30, 'Examen final'),
(12, 'DW2', 45, 'Projet 1'),
(13, 'AWB', 25, 'Examen intra'),
(14, 'AWB', 30, 'Examen final'),
(15, 'AWB', 45, 'Projet 1'),
(16, 'PO1', 25, 'Examen intra'),
(17, 'PO1', 30, 'Examen final'),
(18, 'PO1', 45, 'Projet 1'),
(19, 'PO2', 25, 'Examen intra'),
(20, 'PO2', 30, 'Examen final'),
(21, 'PO2', 45, 'Projet 1'),
(22, 'BD1', 25, 'Examen intra'),
(23, 'BD1', 30, 'Examen final'),
(24, 'BD1', 45, 'Projet 1'),
(25, 'BD2', 25, 'Examen intra'),
(26, 'BD2', 30, 'Examen final'),
(27, 'BD2', 45, 'Projet 1'),
(28, 'TDD', 25, 'Examen intra'),
(29, 'TDD', 30, 'Examen final'),
(30, 'TDD', 45, 'Projet 1'),
(31, 'DCS', 25, 'Examen intra'),
(32, 'DCS', 30, 'Examen final'),
(33, 'DCS', 45, 'Projet 1'),
(34, 'PWB', 25, 'Examen intra'),
(35, 'PWB', 30, 'Examen final'),
(36, 'PWB', 45, 'Projet 1'),
(37, 'DM1', 25, 'Examen intra'),
(38, 'DM1', 30, 'Examen final'),
(39, 'DM1', 45, 'Projet 1'),
(40, 'DM2', 25, 'Examen intra'),
(41, 'DM2', 30, 'Examen final'),
(42, 'DM2', 45, 'Projet 1'),
(43, 'INF', 25, 'Examen intra'),
(44, 'INF', 30, 'Examen final'),
(45, 'INF', 45, 'Projet 1'),
(46, 'NTE', 25, 'Examen intra'),
(47, 'NTE', 30, 'Examen final'),
(48, 'NTE', 45, 'Projet 1'),
(49, 'DGP', 25, 'Examen intra'),
(50, 'DGP', 30, 'Examen final'),
(51, 'DGP', 45, 'Projet 1'),
(52, 'P11', 100, 'Projet 1'),
(53, 'P12', 100, 'Projet 1'),
(54, 'PFE', 100, 'Projet 1');

-- --------------------------------------------------------

--
-- Structure de la table `resultas`
--

CREATE TABLE `resultas` (
  `id` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `resultas`
--

INSERT INTO `resultas` (`id`, `note`) VALUES
(1, 92),
(2, 96),
(3, 100),
(4, 97),
(5, 72),
(6, 92),
(7, 93),
(8, 96),
(9, 96),
(10, 93),
(11, 84),
(12, 95),
(13, 97),
(14, 68),
(15, 90),
(16, 80),
(17, 56),
(18, 94),
(19, 100),
(20, 74),
(21, 100),
(22, 78),
(23, 80),
(24, 91),
(25, 80),
(26, 95),
(27, 88),
(28, 96),
(29, 76),
(30, 92),
(31, 50),
(32, 88),
(33, NULL),
(34, NULL),
(35, NULL),
(36, NULL),
(37, NULL),
(38, NULL),
(39, NULL),
(40, NULL),
(41, NULL),
(42, NULL),
(43, NULL),
(44, NULL),
(45, NULL),
(46, NULL),
(47, NULL),
(48, NULL),
(49, NULL),
(50, NULL),
(51, NULL),
(52, NULL),
(53, NULL),
(54, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codeCours` (`codeCours`);

--
-- Index pour la table `resultas`
--
ALTER TABLE `resultas`
  ADD PRIMARY KEY (`id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`codeCours`) REFERENCES `cours` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `resultas`
--
ALTER TABLE `resultas`
  ADD CONSTRAINT `resultas_ibfk_1` FOREIGN KEY (`id`) REFERENCES `evaluations` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
