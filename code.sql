-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 avr. 2020 à 13:14
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `piscine`
--

-- --------------------------------------------------------

--
-- Structure de la table `code`
--

DROP TABLE IF EXISTS `code`;
CREATE TABLE IF NOT EXISTS `code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idC` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `ccv` int(11) NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `code`
--

INSERT INTO `code` (`id`, `idC`, `nom`, `numero`, `ccv`, `type`) VALUES
(1, 7, 'Dominik', '12345678909876', 4, 'American Express');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
