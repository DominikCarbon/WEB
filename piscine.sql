-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 15 avr. 2020 à 16:00
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
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mdp` text CHARACTER SET utf8 NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `adresse1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `adresse2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ville` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pays` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` int(11) NOT NULL,
  `tel` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `fond` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `mail`, `mdp`, `nom`, `prenom`, `adresse1`, `adresse2`, `ville`, `pays`, `code`, `tel`, `photo`, `fond`) VALUES
(5, 'carbondominik@gmail.com', '7b52009b64fd0a2a49e6d8a939753077792b0554', 'Carbon', 'dominik', 'avenue chanzy', '25', 'villemomble', 'France', 93250, 646260681, '5.png', '5.jpg'),
(6, 'domcarbone19@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'Carbon', 'dominik', 'avenue chanzy', '25', 'villemomble', 'France', 93250, 646260681, '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
