-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 19 fév. 2020 à 08:31
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cloud`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(255) NOT NULL AUTO_INCREMENT,
  `nom_membre` varchar(255) NOT NULL,
  `prenom_membre` varchar(255) NOT NULL,
  `tel_membre` int(255) NOT NULL,
  `mail_membre` varchar(255) NOT NULL,
  `naissance_membre` date NOT NULL,
  `identifiant_membre` varchar(255) NOT NULL,
  `mdp_membre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `nom_membre`, `prenom_membre`, `tel_membre`, `mail_membre`, `naissance_membre`, `identifiant_membre`, `mdp_membre`) VALUES
(2, 'girard', 'benjamin', 631885174, 'benjamin@girard.acs', '1995-12-24', 'benaor', '9cf95dacd226dcf43da376cdb6cbba7035218921'),
(3, 'merucci', 'alain', 123456789, 'alain@merucci.acs', '1945-02-01', 'tartempion', '9cf95dacd226dcf43da376cdb6cbba7035218921'),
(4, 'Boidron', 'Romain', 1234567895, 'romain@boidron.acs', '1980-02-15', 'romanus', '36a32e96cbfd11fd98e8c98e38d9ad9b41f57f1a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
