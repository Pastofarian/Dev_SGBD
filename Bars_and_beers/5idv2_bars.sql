-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 avr. 2023 à 06:21
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `5idv2_bars`
--

-- --------------------------------------------------------

--
-- Structure de la table `bars`
--

DROP TABLE IF EXISTS `bars`;
CREATE TABLE IF NOT EXISTS `bars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `owner` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bars`
--

INSERT INTO `bars` (`id`, `name`, `address`, `owner`) VALUES
(1, 'Beer Bar', 'LLN', 'Denis vraiment'),
(2, 'Beer Therapy', 'Wavre', 'Onconnaitpas');

-- --------------------------------------------------------

--
-- Structure de la table `bar_beer`
--

DROP TABLE IF EXISTS `bar_beer`;
CREATE TABLE IF NOT EXISTS `bar_beer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bar_id` int(11) NOT NULL,
  `beer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bar_id` (`bar_id`),
  KEY `beer_id` (`beer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bar_beer`
--

INSERT INTO `bar_beer` (`id`, `bar_id`, `beer_id`) VALUES
(6, 1, 2),
(7, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `beers`
--

DROP TABLE IF EXISTS `beers`;
CREATE TABLE IF NOT EXISTS `beers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `percent` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `beers`
--

INSERT INTO `beers` (`id`, `name`, `description`, `percent`) VALUES
(1, 'Duvel', 'Une biere', 8.5),
(2, 'TK', 'Bonne biere', 8.4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bar_beer`
--
ALTER TABLE `bar_beer`
  ADD CONSTRAINT `bar_beer.bar_id` FOREIGN KEY (`bar_id`) REFERENCES `bars` (`id`),
  ADD CONSTRAINT `bar_beer.beer_id` FOREIGN KEY (`beer_id`) REFERENCES `beers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
