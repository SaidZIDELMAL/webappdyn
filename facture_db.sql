-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 22 Avril 2021 à 17:30
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `facture_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `tb_client`
--

CREATE TABLE IF NOT EXISTS `tb_client` (
  `contact_client` varchar(80) NOT NULL,
  `nom_client` varchar(120) NOT NULL,
  PRIMARY KEY (`contact_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tb_client`
--

INSERT INTO `tb_client` (`contact_client`, `nom_client`) VALUES
('63090922', 'THEODORE MAX'),
('66782210', 'RENE ALEX'),
('90347611', 'IDRIS SALEH'),
('90904545', 'LOIC ALFRED');

-- --------------------------------------------------------

--
-- Structure de la table `tb_service`
--

CREATE TABLE IF NOT EXISTS `tb_service` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `type_service` varchar(50) NOT NULL,
  `description_srv` text NOT NULL,
  `montant_srv` decimal(9,2) NOT NULL,
  `date_srv` datetime NOT NULL,
  `client_num` varchar(80) NOT NULL,
  PRIMARY KEY (`id_service`),
  KEY `fk` (`client_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `tb_service`
--

INSERT INTO `tb_service` (`id_service`, `type_service`, `description_srv`, `montant_srv`, `date_srv`, `client_num`) VALUES
(2, 'RESTAURANT', '2 PLATS DE CARPE BRAISEE.', '4000.00', '2021-04-22 15:21:40', '90904545'),
(4, 'RESTAURANT', '1 CAFE  1 SHANDWICH ET 2 GATEAUX', '2500.00', '2021-04-22 17:34:11', '63090922'),
(5, 'CHAMBRE', 'OCCUPATION DE  LA CHAMBRE NUMERO 10\n POUR  1 JOUR', '40000.00', '2021-04-22 17:38:05', '63090922'),
(6, 'PISCINE', '2 HEURES DE BAIN', '5000.00', '2021-04-22 17:50:43', '63090922'),
(7, 'GUIDE', 'VISITE AU CENTRE VILLE', '12500.00', '2021-04-22 17:54:33', '90904545');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tb_service`
--
ALTER TABLE `tb_service`
  ADD CONSTRAINT `fk` FOREIGN KEY (`client_num`) REFERENCES `tb_client` (`contact_client`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
