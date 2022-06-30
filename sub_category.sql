-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 30 juin 2022 à 12:03
-- Version du serveur : 5.7.33
-- Version de PHP : 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `qualideco`
--

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `name`) VALUES
(14, 9, 'Finition Brillante'),
(15, 9, 'Finition satinée'),
(16, 9, 'Finition soie'),
(17, 9, 'Finitions velours'),
(18, 9, 'Finitions mate'),
(19, 10, 'Enduits décoratifs'),
(20, 10, 'Peinture dépolluante'),
(21, 11, 'Impression fixateur'),
(22, 11, 'Film mince D2'),
(23, 11, 'Peinture minérale/organo-minérale'),
(24, 11, 'Revêtement Semi Epais R.S.E D3'),
(25, 11, 'Revêtement d\'imperméabilité 11-12-13-14'),
(26, 11, 'Revêtement plastique épais R.P.E'),
(27, 11, 'Lasure béton'),
(28, 11, 'Toiture'),
(29, 11, 'Hydrofuge/Antimousse'),
(30, 12, 'Impression/Saturateur'),
(31, 12, 'Peinture micropeuse de finition'),
(32, 12, 'Lasure'),
(33, 12, 'Vernis'),
(34, 13, 'Domestique'),
(35, 13, 'Industriel'),
(36, 13, 'Parquet bois'),
(37, 13, 'Sol sportif'),
(38, 13, 'Piscine'),
(39, 14, 'Primaire Anticorrosion'),
(40, 14, 'Alkyde monocomposant'),
(41, 14, 'Systéme époxy 2K'),
(42, 14, 'Systéme PU 2K'),
(43, 14, 'Systéme caoutchouc-chloré'),
(44, 14, 'Diluants');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BCE3F79812469DE2` (`category_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `FK_BCE3F79812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
