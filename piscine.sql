-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 avr. 2020 à 14:05
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `mail`, `mdp`, `nom`, `prenom`, `adresse1`, `adresse2`, `ville`, `pays`, `code`, `tel`, `photo`, `fond`) VALUES
(8, 'carbondominik@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 'Carbon', 'dominik', 'avenue chanzy', '25', 'villemomble', 'France', 93250, 646260681, '8.png', '8.jpg'),
(7, 'domcarbone19@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 'Carbon', 'dominik', 'avenue chanzy', '25', 'villemomble', 'France', 93250, 646260681, '', '');

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

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idV` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `achat` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `idV`, `nom`, `description`, `categorie`, `achat`, `prix`, `photo`) VALUES
(91, 667, 'rein', 'zebegtzk', 'Bon pour le musee', 'Meilleure offre', 3, '91.png'),
(90, 667, 'tableau', 'Etcyvgubhij', 'Bon pour le musee', 'Meilleure offre', 5, '90.jpg'),
(89, 667, 'Toto', 'bvub', 'Accessoire VIP', 'Achat immediat', 4, '89.jpg'),
(88, 10, 'autre chose ', 'bien', 'Accessoire VIP', 'Achat immediat', 3, '88.png'),
(80, 10, 'maillot', 'neuf et signe', 'Accessoire VIP', 'Achat immediat', 250, '80.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idC` int(11) NOT NULL,
  `idI` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `achat` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `idC`, `idI`, `categorie`, `nom`, `description`, `achat`, `prix`, `photo`) VALUES
(54, 8, 91, 'Bon pour le musee', 'rein', 'zebegtzk', 'Meilleure offre', 3, '91.png'),
(53, 8, 88, 'Accessoire VIP', 'autre chose ', 'bien', 'Achat immediat', 3, '88.png'),
(52, 8, 89, 'Accessoire VIP', 'Toto', 'bvub', 'Achat immediat', 4, '89.jpg'),
(51, 7, 88, 'Accessoire VIP', 'autre chose ', 'bien', 'Achat immediat', 3, '88.png'),
(50, 7, 90, 'Bon pour le musee', 'tableau', 'Etcyvgubhij', 'Meilleure offre', 5, '90.jpg'),
(49, 8, 90, 'Bon pour le musee', 'tableau', 'Etcyvgubhij', 'Meilleure offre', 5, '90.jpg'),
(48, 8, 80, 'Accessoire VIP', 'maillot', 'neuf et signe', 'Achat immediat', 250, '80.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `fond` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id`, `nom`, `prenom`, `mail`, `mdp`, `photo`, `fond`) VALUES
(16, 'rbvgkerq', 'nbnerzjbnker', 'mail@mail.com', '7658e847bfe3d5edb8bd0069e909a48053519e30', '', ''),
(19, 'Carbon', 'dominik', 'domcarbone19@gmail.com', 'be65d27ae088a0e03fd8e1331d90b01649464cb6', '', ''),
(18, 'bzeiuvbeari', 'dom', 'mail@mail.com', 'db2a106e755ab05bfedaccb181fbbf657203af86', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
