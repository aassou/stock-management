-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 12 Août 2016 à 13:45
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `rachid_metal`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_categorie`
--

CREATE TABLE IF NOT EXISTS `t_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomAR` varchar(50) DEFAULT NULL,
  `nomFR` varchar(50) DEFAULT NULL,
  `longueur` decimal(12,2) DEFAULT NULL,
  `largeur` decimal(12,2) DEFAULT NULL,
  `hauteur` decimal(12,2) DEFAULT NULL,
  `diametre` decimal(12,2) DEFAULT NULL,
  `forme` varchar(50) DEFAULT NULL,
  `couleur` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdBy` varchar(50) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updatedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Contenu de la table `t_categorie`
--

INSERT INTO `t_categorie` (`id`, `nomAR`, `nomFR`, `longueur`, `largeur`, `hauteur`, `diametre`, `forme`, `couleur`, `created`, `createdBy`, `updated`, `updatedBy`) VALUES
(38, 'طول', 'TOOL', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:52:44', NULL, '2014-01-02 15:52:44', NULL),
(39, 'توبو زواق ', 'T.DEC', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:51:16', NULL, '2014-01-02 15:51:16', NULL),
(40, 'توبو', 'T.REC', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:49:02', NULL, '2014-01-02 15:49:02', NULL),
(41, 'rolma', 'rolma', '0.00', '0.00', '0.00', '0.00', '0', '0', '2015-04-17 16:17:42', NULL, '2015-04-17 16:17:42', NULL),
(42, 'حديد', 'F.ROND', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:47:18', NULL, '2014-01-02 15:47:18', NULL),
(43, 'أو', 'U', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:40:50', NULL, '2014-01-02 15:40:50', NULL),
(44, 'سبيكة', 'H', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:46:33', NULL, '2014-01-02 15:46:33', NULL),
(45, 'تي', 'T', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:40:30', NULL, '2014-01-02 15:40:30', NULL),
(46, 'كاري', 'KARRE', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:40:02', NULL, '2014-01-02 15:40:02', NULL),
(47, 'بلا', 'PLAT', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:39:44', NULL, '2014-01-02 15:39:44', NULL),
(48, 'كورنير', 'COR', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:39:24', NULL, '2014-01-02 15:39:24', NULL),
(49, 'طول ڭرياج', 'T.ESTRIE', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-02 15:56:19', NULL, '2014-01-02 15:56:19', NULL),
(50, 'توبو ', 'T.ROND', '1.00', '1.00', '1.00', '1.00', '1', '1', '2013-11-29 16:50:49', NULL, '2013-11-29 16:50:49', NULL),
(51, 'بلي كادر', 'F.K', '1.00', '1.00', '1.00', '1.00', '1', '1', '2013-11-30 10:50:22', NULL, '2013-11-30 10:50:22', NULL),
(52, 'cat AR', 'lama', '1.00', '0.00', '0.00', '1.00', '1', '0', '2016-04-24 02:15:32', NULL, '2016-04-24 02:15:32', NULL),
(53, 'cat AR', 'OMEGA', '1.00', '0.00', '0.00', '1.00', '1', '0', '2015-06-03 21:12:40', NULL, '2015-06-03 21:12:40', NULL),
(54, 'hem', 'hem', '1.00', '1.00', '1.00', '1.00', '1', '1', '2014-01-04 14:51:28', NULL, '2014-01-04 14:51:28', NULL),
(55, 'se', 'se', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-02-24 14:28:07', NULL, '2014-02-24 14:28:07', NULL),
(56, '', 'bagit', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-02-15 10:25:37', NULL, '2014-02-15 10:25:37', NULL),
(57, 'cat AR', 'roulo sof', '0.00', '0.00', '0.00', '0.00', '0', '0', '2014-02-08 09:21:44', NULL, '2014-02-08 09:21:44', NULL),
(58, 'cat AR', 'code ', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-06-14 09:34:51', NULL, '2014-06-14 09:34:51', NULL),
(59, 'tube karre ', 'tube karre ', '1.00', '1.00', '1.00', '1.00', '1', '1', '2015-04-06 07:56:36', NULL, '2015-04-06 07:56:36', NULL),
(60, 'cat AR', 'R', '1.00', '0.00', '0.00', '1.00', '1', '0', '2015-08-01 05:10:05', NULL, '2015-08-01 05:10:05', NULL),
(61, 'B', 'B', '1.00', '0.00', '0.00', '1.00', '1', '0', '2015-04-28 18:44:17', NULL, '2015-04-28 18:44:17', NULL),
(62, 'cat AR', 'disque', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-02-25 15:27:20', NULL, '2014-02-25 15:27:20', NULL),
(63, 'cat AR', 'pintur', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-02-25 15:27:37', NULL, '2014-02-25 15:27:37', NULL),
(64, 'لفو', 'LAFO', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-03-01 14:40:18', NULL, '2014-03-01 14:40:18', NULL),
(65, 'cat AR', 'berclus ', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-03-18 15:06:34', NULL, '2014-03-18 15:06:34', NULL),
(66, 'cat AR', 'deleun', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-04-16 10:49:12', NULL, '2014-04-16 10:49:12', NULL),
(67, 'cat AR', 'grillage', '1.00', '0.00', '0.00', '1.00', '1', '0', '2014-05-12 11:57:58', NULL, '2014-05-12 11:57:58', NULL),
(68, ' 1', 'TRANSPORT ', '1.00', '0.00', '0.00', '0.00', '0', '0', '2014-11-27 11:47:28', NULL, '2014-11-27 11:47:28', NULL),
(69, 'rolma', 'rolma', '1.00', '0.00', '0.00', '1.00', '0', '0', '2015-04-17 16:18:30', NULL, '2015-04-17 16:18:30', NULL),
(70, 'cat AR', 'decor', '1.00', '0.00', '0.00', '1.00', '1', '0', '2015-08-08 10:43:22', NULL, '2015-08-08 10:43:22', NULL),
(71, 'cat AR', 'sarout', '1.00', '0.00', '0.00', '1.00', '1', '0', '2015-08-08 10:46:54', NULL, '2015-08-08 10:46:54', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_client`
--

CREATE TABLE IF NOT EXISTS `t_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdBy` varchar(50) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updatedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `t_client`
--

INSERT INTO `t_client` (`id`, `code`, `matricule`, `nom`, `cin`, `ville`, `telephone`, `created`, `createdBy`, `updated`, `updatedBy`) VALUES
(1, NULL, 'clien qui paye ', 'clien qui paye ', NULL, '', '', NULL, NULL, NULL, NULL),
(2, NULL, 'hassan t', 'hassan t', NULL, '', '', NULL, NULL, NULL, NULL),
(3, NULL, 'idrisse B', 'idrisse b', NULL, '', '', NULL, NULL, NULL, NULL),
(4, NULL, 'jaouad g ', 'jaouad g', NULL, '', '', NULL, NULL, NULL, NULL),
(5, NULL, 'mimoun alidrissi ', 'mimoun alidrissi', NULL, '', '', NULL, NULL, NULL, NULL),
(6, NULL, 'mohamed alhanafi ', 'mohamed alhanafi ', NULL, '', '', NULL, NULL, NULL, NULL),
(7, NULL, 'mohamed driwache ', 'mohamed driwache ', NULL, 'driwach', '', NULL, NULL, NULL, NULL),
(8, NULL, 'mustafa', 'mustafa', NULL, '', '0655391086', NULL, NULL, NULL, NULL),
(9, NULL, 'SAMIR', 'samir benaissati', NULL, 'oujda', '0655391086', NULL, NULL, NULL, NULL),
(10, NULL, 'STE BETRAJAN', 'STE BETRAJAN', NULL, '', '', NULL, NULL, NULL, NULL),
(11, NULL, 'STE FANIAB ', 'STE FANIAB ', NULL, '', '', NULL, NULL, NULL, NULL),
(12, NULL, 'tayeb nassiri ', 'tayeb nassiri ', NULL, '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_produit`
--

CREATE TABLE IF NOT EXISTS `t_produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dimension` decimal(12,2) DEFAULT NULL,
  `diametre` decimal(12,2) DEFAULT NULL,
  `forme` varchar(50) DEFAULT NULL,
  `prixAchat` decimal(12,2) DEFAULT NULL,
  `prixVente` decimal(12,2) DEFAULT NULL,
  `prixVenteMin` decimal(12,2) DEFAULT NULL,
  `quantite` decimal(12,2) DEFAULT NULL,
  `poids` decimal(12,2) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdBy` varchar(50) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `updatedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=168 ;

--
-- Contenu de la table `t_produit`
--

INSERT INTO `t_produit` (`id`, `dimension`, `diametre`, `forme`, `prixAchat`, `prixVente`, `prixVenteMin`, `quantite`, `poids`, `code`, `idCategorie`, `created`, `createdBy`, `updated`, `updatedBy`) VALUES
(6, NULL, NULL, NULL, '2.50', '4.00', '0.00', '231.00', NULL, 'B80', 61, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, '3.40', '5.00', '0.00', '2803.00', NULL, 'B100', 61, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, '5.00', '7.50', '0.00', '0.00', NULL, 'B120', 61, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, '7.00', '10.00', '0.00', '132.00', NULL, 'B140', 61, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, '130.00', '140.00', '135.00', '60.00', NULL, 'bagit 3.5', 56, NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, '87.00', '95.00', '90.00', '14.00', NULL, 'bagit2.5', 56, NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, '140.00', '150.00', '0.00', '0.00', NULL, 'bagit4', 56, NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, '11.50', '0.00', '13.50', '1.00', NULL, 'berclus BR', 65, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, '10.00', '0.00', '0.00', '19.00', NULL, 'code 60', 58, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, '10.00', '0.00', '0.00', '60.00', NULL, 'code 40', 58, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, '10.00', '0.00', '0.00', '0.00', NULL, 'code 50', 58, NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, '10.00', '0.00', '0.00', '129.00', NULL, 'code 25', 58, NULL, NULL, NULL, NULL),
(18, NULL, NULL, NULL, '10.00', '0.00', '0.00', '8.00', NULL, 'code 100', 58, NULL, NULL, NULL, NULL),
(19, NULL, NULL, NULL, '10.00', '0.00', '0.00', '52.00', NULL, 'code 20', 58, NULL, NULL, NULL, NULL),
(20, NULL, NULL, NULL, '52.00', '70.00', '67.00', '344.00', NULL, 'COR 30 X 3', 48, NULL, NULL, NULL, NULL),
(21, NULL, NULL, NULL, '36.00', '60.00', '0.00', '284.00', NULL, 'COR 35 X 2.5', 48, NULL, NULL, NULL, NULL),
(22, NULL, NULL, NULL, '50.00', '75.00', '0.00', '198.00', NULL, 'COR 35 X 2.8', 48, NULL, NULL, NULL, NULL),
(23, NULL, NULL, NULL, '61.00', '80.00', '76.00', '488.00', NULL, 'COR 35 X 3', 48, NULL, NULL, NULL, NULL),
(24, NULL, NULL, NULL, '0.00', '75.00', '0.00', '40.00', NULL, 'COR 40 X 2.5', 48, NULL, NULL, NULL, NULL),
(25, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, 'COR 40 X 2.8', 48, NULL, NULL, NULL, NULL),
(26, NULL, NULL, NULL, '71.50', '95.00', '85.00', '588.00', NULL, 'COR 40 X 3', 48, NULL, NULL, NULL, NULL),
(27, NULL, NULL, NULL, '0.00', '120.00', '0.00', '0.00', NULL, 'COR 45 X 3', 48, NULL, NULL, NULL, NULL),
(28, NULL, NULL, NULL, '104.00', '135.00', '0.00', '84.00', NULL, 'COR 45 X 4', 48, NULL, NULL, NULL, NULL),
(29, NULL, NULL, NULL, '194.00', '0.00', '0.00', '0.00', NULL, 'COR 60 X 5', 48, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, '0.00', '320.00', '0.00', '4.00', NULL, 'COR 60 X 6', 48, NULL, NULL, NULL, NULL),
(31, NULL, NULL, NULL, '0.00', '0.00', '0.00', '69.00', NULL, 'COR GAL 25', 48, NULL, NULL, NULL, NULL),
(32, NULL, NULL, NULL, '72.00', '120.00', '0.00', '56.00', NULL, 'COR GAL 30', 48, NULL, NULL, NULL, NULL),
(33, NULL, NULL, NULL, '95.00', '135.00', '0.00', '1.00', NULL, 'COR GAL 35', 48, NULL, NULL, NULL, NULL),
(34, NULL, NULL, NULL, '130.00', '0.00', '165.00', '1.00', NULL, 'COR GAL 40', 48, NULL, NULL, NULL, NULL),
(35, NULL, NULL, NULL, '400.00', '0.00', '0.00', '1.00', NULL, 'COR GAL 60', 48, NULL, NULL, NULL, NULL),
(36, NULL, NULL, NULL, '292.00', '0.00', '0.00', '1.00', NULL, 'COR 80 8', 48, NULL, NULL, NULL, NULL),
(37, NULL, NULL, NULL, '92.00', '115.00', '0.00', '134.00', NULL, 'COR 40 X 4', 48, NULL, NULL, NULL, NULL),
(38, NULL, NULL, NULL, '25.00', '40.00', '33.00', '574.00', NULL, 'COR 25 X 2', 48, NULL, NULL, NULL, NULL),
(39, NULL, NULL, NULL, '20.00', '35.00', '0.00', '369.00', NULL, 'COR 20', 48, NULL, NULL, NULL, NULL),
(40, NULL, NULL, NULL, '88.00', '0.00', '0.00', '6.00', NULL, 'COR 45 II', 48, NULL, NULL, NULL, NULL),
(41, NULL, NULL, NULL, '43.00', '60.00', '58.00', '58.00', NULL, 'COR 25 X 3', 48, NULL, NULL, NULL, NULL),
(42, NULL, NULL, NULL, '154.00', '0.00', '0.00', '18.00', NULL, 'COR 50 X 5', 48, NULL, NULL, NULL, NULL),
(43, NULL, NULL, NULL, '706.50', '0.00', '0.00', '0.00', NULL, 'COR 100', 48, NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, '30.00', '50.00', '42.00', '365.00', NULL, 'COR 30 X 2.5', 48, NULL, NULL, NULL, NULL),
(45, NULL, NULL, NULL, '360.00', '0.00', '0.00', '0.00', NULL, 'COR 70 X 7', 48, NULL, NULL, NULL, NULL),
(46, NULL, NULL, NULL, '130.00', '0.00', '0.00', '45.00', NULL, 'COR 45 X 3 cal', 48, NULL, NULL, NULL, NULL),
(47, NULL, NULL, NULL, '42.00', '0.00', '0.00', '334.00', NULL, 'COR 30 II', 48, NULL, NULL, NULL, NULL),
(48, NULL, NULL, NULL, '6.00', '0.00', '0.00', '0.00', NULL, 'decor 92', 70, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, '3.70', '0.00', '0.00', '85.00', NULL, 'decor 8013', 70, NULL, NULL, NULL, NULL),
(50, NULL, NULL, NULL, '2.30', '0.00', '0.00', '69.00', NULL, 'decor 8014', 70, NULL, NULL, NULL, NULL),
(51, NULL, NULL, NULL, '1.50', '0.00', '0.00', '272.00', NULL, 'decor 8010', 70, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, '2.50', '0.00', '0.00', '791.00', NULL, 'decor 8', 70, NULL, NULL, NULL, NULL),
(53, NULL, NULL, NULL, '20.00', '0.00', '0.00', '11.00', NULL, 'decor 839', 70, NULL, NULL, NULL, NULL),
(54, NULL, NULL, NULL, '12.00', '0.00', '0.00', '13.00', NULL, 'decor 858', 70, NULL, NULL, NULL, NULL),
(55, NULL, NULL, NULL, '23.00', '0.00', '0.00', '9.00', NULL, 'decor 830', 70, NULL, NULL, NULL, NULL),
(56, NULL, NULL, NULL, '11.00', '0.00', '0.00', '10.00', NULL, 'decor 831', 70, NULL, NULL, NULL, NULL),
(57, NULL, NULL, NULL, '6.00', '0.00', '0.00', '9.00', NULL, 'decor 832', 70, NULL, NULL, NULL, NULL),
(58, NULL, NULL, NULL, '17.00', '0.00', '0.00', '43.00', NULL, 'decor 827', 70, NULL, NULL, NULL, NULL),
(59, NULL, NULL, NULL, '4.00', '0.00', '0.00', '244.00', NULL, 'decor 821', 70, NULL, NULL, NULL, NULL),
(60, NULL, NULL, NULL, '14.00', '0.00', '0.00', '62.00', NULL, 'decor 890', 70, NULL, NULL, NULL, NULL),
(61, NULL, NULL, NULL, '6.50', '0.00', '0.00', '25.00', NULL, 'decor 803', 70, NULL, NULL, NULL, NULL),
(62, NULL, NULL, NULL, '32.00', '0.00', '0.00', '66.00', NULL, 'decor 850', 70, NULL, NULL, NULL, NULL),
(63, NULL, NULL, NULL, '19.00', '0.00', '0.00', '69.00', NULL, 'decor 834', 70, NULL, NULL, NULL, NULL),
(64, NULL, NULL, NULL, '60.00', '0.00', '0.00', '19.00', NULL, 'decor 880', 70, NULL, NULL, NULL, NULL),
(65, NULL, NULL, NULL, '4.00', '0.00', '0.00', '180.00', NULL, 'decor 866', 70, NULL, NULL, NULL, NULL),
(66, NULL, NULL, NULL, '22.00', '0.00', '0.00', '79.00', NULL, 'decor 842', 70, NULL, NULL, NULL, NULL),
(67, NULL, NULL, NULL, '10.00', '0.00', '0.00', '86.00', NULL, 'decor 894', 70, NULL, NULL, NULL, NULL),
(68, NULL, NULL, NULL, '12.00', '0.00', '0.00', '188.00', NULL, 'decor 859', 70, NULL, NULL, NULL, NULL),
(69, NULL, NULL, NULL, '11.50', '0.00', '0.00', '81.00', NULL, 'decor 886', 70, NULL, NULL, NULL, NULL),
(70, NULL, NULL, NULL, '23.00', '0.00', '0.00', '184.00', NULL, 'decor E 12', 70, NULL, NULL, NULL, NULL),
(71, NULL, NULL, NULL, '16.00', '0.00', '0.00', '200.00', NULL, 'decor E 10', 70, NULL, NULL, NULL, NULL),
(72, NULL, NULL, NULL, '28.00', '0.00', '0.00', '100.00', NULL, 'decor P 25 A1', 70, NULL, NULL, NULL, NULL),
(73, NULL, NULL, NULL, '3.00', '0.00', '0.00', '73.00', NULL, 'decor B 026', 70, NULL, NULL, NULL, NULL),
(74, NULL, NULL, NULL, '1.80', '0.00', '0.00', '431.00', NULL, 'decor FR 1', 70, NULL, NULL, NULL, NULL),
(75, NULL, NULL, NULL, '2.00', '0.00', '0.00', '300.00', NULL, 'decor FR6', 70, NULL, NULL, NULL, NULL),
(76, NULL, NULL, NULL, '12.00', '0.00', '0.00', '70.00', NULL, 'decor N', 70, NULL, NULL, NULL, NULL),
(77, NULL, NULL, NULL, '3.00', '0.00', '0.00', '94.00', NULL, 'decor B 025', 70, NULL, NULL, NULL, NULL),
(78, NULL, NULL, NULL, '3.00', '0.00', '0.00', '256.00', NULL, 'decor B 028', 70, NULL, NULL, NULL, NULL),
(79, NULL, NULL, NULL, '1.00', '0.00', '0.00', '455.00', NULL, 'decor FR7', 70, NULL, NULL, NULL, NULL),
(80, NULL, NULL, NULL, '2.50', '0.00', '0.00', '29.00', NULL, 'decor B 017', 70, NULL, NULL, NULL, NULL),
(81, NULL, NULL, NULL, '4.80', '0.00', '0.00', '5.00', NULL, 'decor B 016', 70, NULL, NULL, NULL, NULL),
(82, NULL, NULL, NULL, '8.00', '0.00', '0.00', '28.00', NULL, 'decor B 015', 70, NULL, NULL, NULL, NULL),
(83, NULL, NULL, NULL, '6.50', '0.00', '0.00', '32.00', NULL, 'decor B 042', 70, NULL, NULL, NULL, NULL),
(84, NULL, NULL, NULL, '200.00', '0.00', '0.00', '7.00', NULL, 'decor 839', 70, NULL, NULL, NULL, NULL),
(85, NULL, NULL, NULL, '10.00', '0.00', '0.00', '114.00', NULL, 'decor 4', 70, NULL, NULL, NULL, NULL),
(86, NULL, NULL, NULL, '18.00', '0.00', '0.00', '82.00', NULL, 'decor p17', 70, NULL, NULL, NULL, NULL),
(87, NULL, NULL, NULL, '60.00', '0.00', '0.00', '26.00', NULL, 'deleun 5', 66, NULL, NULL, NULL, NULL),
(88, NULL, NULL, NULL, '10.00', '0.00', '0.00', '77.00', NULL, 'deleun 1 L', 66, NULL, NULL, NULL, NULL),
(89, NULL, NULL, NULL, '13.70', '0.00', '0.00', '47.00', NULL, 'disque 20 h', 62, NULL, NULL, NULL, NULL),
(90, NULL, NULL, NULL, '22.50', '0.00', '0.00', '231.00', NULL, 'disque 30 h', 62, NULL, NULL, NULL, NULL),
(91, NULL, NULL, NULL, '12.60', '0.00', '0.00', '1.00', NULL, 'disque 2.5', 62, NULL, NULL, NULL, NULL),
(92, NULL, NULL, NULL, '22.50', '0.00', '0.00', '158.00', NULL, 'disque trans', 62, NULL, NULL, NULL, NULL),
(93, NULL, NULL, NULL, '14.00', '0.00', '0.00', '168.00', NULL, 'disque inox', 62, NULL, NULL, NULL, NULL),
(94, NULL, NULL, NULL, '6.00', '0.00', '0.00', '122.00', NULL, 'disque petit', 62, NULL, NULL, NULL, NULL),
(95, NULL, NULL, NULL, '38.00', '0.00', '0.00', '93.00', NULL, 'F.K 40 X 1.25', 51, NULL, NULL, NULL, NULL),
(96, NULL, NULL, NULL, '10.00', '0.00', '0.00', '0.00', NULL, 'F.K 40 X 1.5', 51, NULL, NULL, NULL, NULL),
(97, NULL, NULL, NULL, '42.00', '55.00', '50.00', '341.00', NULL, 'F.K 60 X 0.8', 51, NULL, NULL, NULL, NULL),
(98, NULL, NULL, NULL, '48.00', '0.00', '0.00', '357.00', NULL, 'F.K 60 X 1.25', 51, NULL, NULL, NULL, NULL),
(99, NULL, NULL, NULL, '54.00', '0.00', '58.00', '5.00', NULL, 'F.K 60 X 1.5', 51, NULL, NULL, NULL, NULL),
(100, NULL, NULL, NULL, '10.00', '0.00', '0.00', '170.00', NULL, 'F.K 60 X 1', 51, NULL, NULL, NULL, NULL),
(101, NULL, NULL, NULL, '31.00', '0.00', '0.00', '130.00', NULL, 'F.K 40 X 0.8', 51, NULL, NULL, NULL, NULL),
(102, NULL, NULL, NULL, '20.50', '40.00', '27.00', '1.00', NULL, 'F.ROND 10', 42, NULL, NULL, NULL, NULL),
(103, NULL, NULL, NULL, '27.50', '4.00', '35.00', '430.00', NULL, 'F.ROND 11', 42, NULL, NULL, NULL, NULL),
(104, NULL, NULL, NULL, '56.00', '63.00', '53.00', '98.00', NULL, 'F.ROND 15', 42, NULL, NULL, NULL, NULL),
(105, NULL, NULL, NULL, '75.00', '140.00', '120.00', '0.00', NULL, 'F.ROND 18', 42, NULL, NULL, NULL, NULL),
(106, NULL, NULL, NULL, '102.00', '0.00', '0.00', '42.00', NULL, 'F.ROND 20', 42, NULL, NULL, NULL, NULL),
(107, NULL, NULL, NULL, '120.00', '200.00', '160.00', '47.00', NULL, 'F.ROND 22', 42, NULL, NULL, NULL, NULL),
(108, NULL, NULL, NULL, '160.00', '210.00', '180.00', '17.00', NULL, 'F.ROND 25', 42, NULL, NULL, NULL, NULL),
(109, NULL, NULL, NULL, '80.00', '0.00', '95.00', '36.00', NULL, 'F.ROND GAL 16', 42, NULL, NULL, NULL, NULL),
(110, NULL, NULL, NULL, '63.00', '70.00', '64.00', '38.00', NULL, 'F.ROND I 16', 42, NULL, NULL, NULL, NULL),
(111, NULL, NULL, NULL, '462.00', '800.00', '570.00', '5.00', NULL, 'F.ROND 40', 42, NULL, NULL, NULL, NULL),
(112, NULL, NULL, NULL, '40.00', '55.00', '42.00', '261.00', NULL, 'F.ROND 13', 42, NULL, NULL, NULL, NULL),
(113, NULL, NULL, NULL, '50.00', '0.00', '0.00', '67.00', NULL, 'F.ROND 14 I', 42, NULL, NULL, NULL, NULL),
(114, NULL, NULL, NULL, '239.00', '25.00', '20.00', '17.00', NULL, 'F.ROND 30', 42, NULL, NULL, NULL, NULL),
(115, NULL, NULL, NULL, '235.00', '0.00', '0.00', '4.00', NULL, 'F.ROND 28', 42, NULL, NULL, NULL, NULL),
(116, NULL, NULL, NULL, '25.00', '35.00', '0.00', '49.00', NULL, 'grillage 120 II', 67, NULL, NULL, NULL, NULL),
(117, NULL, NULL, NULL, '45.00', '60.00', '0.00', '50.00', NULL, 'grillage 100 I', 67, NULL, NULL, NULL, NULL),
(118, NULL, NULL, NULL, '17.00', '30.00', '0.00', '6.00', NULL, 'grillage 100 II', 67, NULL, NULL, NULL, NULL),
(119, NULL, NULL, NULL, '50.00', '75.00', '0.00', '189.00', NULL, 'grillage 120 I', 67, NULL, NULL, NULL, NULL),
(120, NULL, NULL, NULL, '13.50', '35.00', '0.00', '90.00', NULL, 'grillage III', 67, NULL, NULL, NULL, NULL),
(121, NULL, NULL, NULL, '35.00', '0.00', '0.00', '90.00', NULL, 'grillage 20 cal', 67, NULL, NULL, NULL, NULL),
(122, NULL, NULL, NULL, '40.00', '0.00', '0.00', '0.00', NULL, 'grillage 30 cal', 67, NULL, NULL, NULL, NULL),
(123, NULL, NULL, NULL, '60.00', '0.00', '0.00', '15.00', NULL, 'grillage 10 X 10 cal', 67, NULL, NULL, NULL, NULL),
(124, NULL, NULL, NULL, '46.00', '75.00', '0.00', '0.00', NULL, 'grillage 15 X 15 cal', 67, NULL, NULL, NULL, NULL),
(125, NULL, NULL, NULL, '33.00', '0.00', '0.00', '0.00', NULL, 'grillage 15 X 1 noir', 67, NULL, NULL, NULL, NULL),
(126, NULL, NULL, NULL, '45.60', '0.00', '0.00', '0.00', NULL, 'grillage 15 X 1.2', 67, NULL, NULL, NULL, NULL),
(127, NULL, NULL, NULL, '64.00', '0.00', '0.00', '70.00', NULL, 'grillage 10 X 1.2 cal', 67, NULL, NULL, NULL, NULL),
(128, NULL, NULL, NULL, '35.00', '0.00', '0.00', '18.00', NULL, 'grillage 10 X 10 carre', 67, NULL, NULL, NULL, NULL),
(129, NULL, NULL, NULL, '42.00', '0.00', '0.00', '60.00', NULL, 'grillage 120 X 10', 67, NULL, NULL, NULL, NULL),
(130, NULL, NULL, NULL, '50.00', '0.00', '0.00', '76.00', NULL, 'grillage 10 X 10 cal', 67, NULL, NULL, NULL, NULL),
(131, NULL, NULL, NULL, '38.00', '0.00', '0.00', '183.00', NULL, 'grillage 100 I 20 m', 67, NULL, NULL, NULL, NULL),
(132, NULL, NULL, NULL, '30.00', '0.00', '0.00', '22.00', NULL, 'grillage 4/10', 67, NULL, NULL, NULL, NULL),
(133, NULL, NULL, NULL, '40.00', '0.00', '0.00', '1.00', NULL, 'grillage 120', 67, NULL, NULL, NULL, NULL),
(134, NULL, NULL, NULL, '175.00', '0.00', '0.00', '1.00', NULL, 'H 80', 44, NULL, NULL, NULL, NULL),
(135, NULL, NULL, NULL, '236.00', '370.00', '0.00', '19.00', NULL, 'H 100', 44, NULL, NULL, NULL, NULL),
(136, NULL, NULL, NULL, '1575.00', '0.00', '0.00', '0.00', NULL, 'H 180 X 12', 44, NULL, NULL, NULL, NULL),
(137, NULL, NULL, NULL, '1155.00', '0.00', '0.00', '0.00', NULL, 'H 160 12m', 44, NULL, NULL, NULL, NULL),
(138, NULL, NULL, NULL, '412.00', '0.00', '0.00', '0.00', NULL, 'H 120', 44, NULL, NULL, NULL, NULL),
(139, NULL, NULL, NULL, '653.00', '0.00', '0.00', '4.00', NULL, 'H 160', 44, NULL, NULL, NULL, NULL),
(140, NULL, NULL, NULL, '2496.00', '0.00', '0.00', '0.00', NULL, 'H 240', 44, NULL, NULL, NULL, NULL),
(141, NULL, NULL, NULL, '465.00', '0.00', '0.00', '1.00', NULL, 'H 140', 44, NULL, NULL, NULL, NULL),
(142, NULL, NULL, NULL, '2900.00', '0.00', '0.00', '0.00', NULL, 'H 270', 44, NULL, NULL, NULL, NULL),
(143, NULL, NULL, NULL, '1960.00', '0.00', '0.00', '0.00', NULL, 'H 220', 44, NULL, NULL, NULL, NULL),
(144, NULL, NULL, NULL, '775.00', '0.00', '0.00', '0.00', NULL, 'H 180', 44, NULL, NULL, NULL, NULL),
(145, NULL, NULL, NULL, '952.00', '0.00', '0.00', '0.00', NULL, 'H 200', 44, NULL, NULL, NULL, NULL),
(146, NULL, NULL, NULL, '220.00', '0.00', '0.00', '0.00', NULL, 'H 80 I', 44, NULL, NULL, NULL, NULL),
(147, NULL, NULL, NULL, '327.00', '0.00', '0.00', '0.00', NULL, 'H 100 I', 44, NULL, NULL, NULL, NULL),
(148, NULL, NULL, NULL, '1675.00', '0.00', '0.00', '0.00', NULL, 'H 200 12 m', 44, NULL, NULL, NULL, NULL),
(149, NULL, NULL, NULL, '460.00', '0.00', '0.00', '26.00', NULL, 'H 100 X 12 m', 44, NULL, NULL, NULL, NULL),
(150, NULL, NULL, NULL, '233.00', '0.00', '0.00', '1.00', NULL, 'H 80 12 m', 44, NULL, NULL, NULL, NULL),
(151, NULL, NULL, NULL, '800.00', '950.00', '0.00', '4.00', NULL, 'hem 8 10 10', 54, NULL, NULL, NULL, NULL),
(152, NULL, NULL, NULL, '13.00', '0.00', '0.00', '270.00', NULL, 'KARRE 8', 46, NULL, NULL, NULL, NULL),
(153, NULL, NULL, NULL, '22.50', '0.00', '0.00', '215.00', NULL, 'KARRE 10', 46, NULL, NULL, NULL, NULL),
(154, NULL, NULL, NULL, '34.00', '48.00', '41.00', '513.00', NULL, 'KARRE 11', 46, NULL, NULL, NULL, NULL),
(155, NULL, NULL, NULL, '41.00', '0.00', '0.00', '0.00', NULL, 'KARRE 11.5', 46, NULL, NULL, NULL, NULL),
(156, NULL, NULL, NULL, '47.00', '7.00', '0.00', '10.00', NULL, 'KARRE 13', 46, NULL, NULL, NULL, NULL),
(157, NULL, NULL, NULL, '10.00', '0.00', '0.00', '0.00', NULL, 'KARRE 16', 46, NULL, NULL, NULL, NULL),
(158, NULL, NULL, NULL, '55.00', '0.00', '0.00', '43.00', NULL, 'KARRE Z 14', 46, NULL, NULL, NULL, NULL),
(159, NULL, NULL, NULL, '50.50', '0.00', '0.00', '158.00', NULL, 'KARRE 14 I', 46, NULL, NULL, NULL, NULL),
(160, NULL, NULL, NULL, '46.00', '65.00', '55.00', '18.00', NULL, 'KARRE 12 ZWAK', 46, NULL, NULL, NULL, NULL),
(161, NULL, NULL, NULL, '44.00', '6.00', '0.00', '381.00', NULL, 'KARRE 12 I', 46, NULL, NULL, NULL, NULL),
(162, NULL, NULL, NULL, '56.00', '0.00', '0.00', '25.00', NULL, 'KARRE 15', 46, NULL, NULL, NULL, NULL),
(163, NULL, NULL, NULL, '120.00', '0.00', '0.00', '48.00', NULL, 'KARRE 20', 46, NULL, NULL, NULL, NULL),
(164, NULL, NULL, NULL, '345.00', '0.00', '0.00', '14.00', NULL, 'KARRE 30', 46, NULL, NULL, NULL, NULL),
(165, NULL, NULL, NULL, '98.00', '0.00', '0.00', '0.00', NULL, 'KARRE 17', 46, NULL, NULL, NULL, NULL),
(166, NULL, NULL, NULL, '650.00', '0.00', '0.00', '1.00', NULL, 'KARRE 40', 46, NULL, NULL, NULL, NULL),
(167, NULL, NULL, NULL, '912.00', '0.00', '0.00', '0.00', NULL, 'KARRE 50', 46, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `profil` varchar(30) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `t_user`
--

INSERT INTO `t_user` (`id`, `login`, `password`, `created`, `profil`, `status`) VALUES
(1, 'admin', 'admin', '2015-10-18', 'admin', 1),
(2, 'mouaad', '1234', '2015-10-18', 'admin', 1),
(3, 'Secretaire', 'secretaire', '2015-10-20', 'user', 1),
(4, 'abdou', 'abdou', '2015-10-26', 'manager', 1),
(5, 'mido', 'mido', '2015-12-31', 'consultant', 1),
(6, 'user', 'user', '2016-01-07', 'admin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
