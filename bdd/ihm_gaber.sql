-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 jan. 2024 à 09:38
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ihm_gaber`
--

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

DROP TABLE IF EXISTS `circuit`;
CREATE TABLE IF NOT EXISTS `circuit` (
  `Id_Circ` int NOT NULL,
  `Descri` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Ville_Dep` varchar(50) DEFAULT NULL,
  `Pays_Dep` varchar(50) DEFAULT NULL,
  `Pays_Arr` varchar(50) DEFAULT NULL,
  `Ville_Arr` varchar(50) DEFAULT NULL,
  `Date_Dep` varchar(50) DEFAULT NULL,
  `Nb_PlaceDisp` int DEFAULT NULL,
  `Duree_Circ` int DEFAULT NULL,
  `Prix_Insc` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Circ`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`Id_Circ`, `Descri`, `Ville_Dep`, `Pays_Dep`, `Pays_Arr`, `Ville_Arr`, `Date_Dep`, `Nb_PlaceDisp`, `Duree_Circ`, `Prix_Insc`) VALUES
(1, 'Circuit au départ de Créteil en France jusqu\'à Lovran en Croatie', 'Créteil', 'France', 'Croatie', 'Lovran', '2/20/2023', 98, 106, '31.00'),
(2, 'Circuit au départ de Khuean en Thailand jusqu\'à Postira en Croatie', 'Khuean Ubonrat', 'Thailande', 'Croatie', 'Postira', '9/1/2023', 98, 94, '91.00'),
(3, 'Circuit au départ de Zhishan en China jusqu\'à Long Hồ au Vietnam', 'Zhishan', 'Chine', 'Vietnam', 'Long Hồ', '11/23/2023', 72, 208, '45.00'),
(4, 'Circuit au départ de Majayjay au Philippines jusqu\'à Bourges en France', 'Majayjay', 'Philippines', 'France', 'Bourges', '4/26/2023', 63, 202, '36.00'),
(5, 'Circuit au départ de Estarreja au Portugal jusqu\'à Yuza au Japon', 'Estarreja', 'Portugal', 'Japon', 'Yuza', '12/19/2023', 66, 87, '69.00'),
(6, 'Circuit au départ de Tamamura au Japon jusqu\'à Yueyahe en Chine', 'Tamamura', 'Japon', 'Chine', 'Yueyahe', '6/28/2023', 59, 92, '49.00');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `Id_Client` int NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Date_Naissance` varchar(50) NOT NULL,
  `IdUtilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Client`),
  UNIQUE KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id_Client`, `Nom`, `Prenom`, `Date_Naissance`, `IdUtilisateur`) VALUES
(0, 'dupond', 'jean', '01/01/2000', 0);

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `Id_Circ` int NOT NULL,
  `Ordre` int NOT NULL,
  `Date_Et` datetime DEFAULT NULL,
  `Duree_Et` datetime DEFAULT NULL,
  `NomLieu` varchar(50) NOT NULL,
  `Ville_Et` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Pays_Et` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Id_Circ`,`Ordre`),
  KEY `NomLieu` (`NomLieu`,`Ville_Et`,`Pays_Et`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`Id_Circ`, `Ordre`, `Date_Et`, `Duree_Et`, `NomLieu`, `Ville_Et`, `Pays_Et`) VALUES
(1, 1, '2024-03-05 09:08:45', '2024-03-07 09:08:45', 'Primulaceae', 'Woto', 'Indonésie'),
(1, 2, '2024-01-10 09:11:56', '2024-01-12 09:11:56', 'Roseaceae', 'Kisasa', 'Tanzanie'),
(2, 1, '2024-12-01 09:11:56', '2024-12-04 09:11:56', 'Pertubarea', 'Šentvid pri Stični', 'Slovénie'),
(2, 2, '2024-04-28 09:11:56', '2024-05-04 09:11:56', 'Fumariaceae', 'Dan Makham Tia', 'Thailande'),
(3, 1, '2024-12-20 09:11:56', '2024-12-30 09:11:56', 'Polygalaceae', 'San Carlos', 'Argentine'),
(3, 2, '2024-06-29 09:11:56', '2024-07-10 09:11:56', 'Ranunculaceae', 'Manhush', 'Ukraine');

-- --------------------------------------------------------

--
-- Structure de la table `lieux_a_visiter`
--

DROP TABLE IF EXISTS `lieux_a_visiter`;
CREATE TABLE IF NOT EXISTS `lieux_a_visiter` (
  `NomLieu` varchar(50) NOT NULL,
  `Ville_Et` varchar(50) NOT NULL,
  `Pays_Et` varchar(50) NOT NULL,
  `Descriptif` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prix_visite` decimal(15,2) NOT NULL,
  PRIMARY KEY (`NomLieu`,`Ville_Et`,`Pays_Et`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `lieux_a_visiter`
--

INSERT INTO `lieux_a_visiter` (`NomLieu`, `Ville_Et`, `Pays_Et`, `Descriptif`, `Prix_visite`) VALUES
('Primulaceae', 'Jijiazhuang', 'Chine', 'Visite de Primulaceae dans la ville de Jijiazhuang en Chine', '90.00'),
('Rosaceae', 'Smithers', 'Canada', 'Visite de Rosaceae dans la ville de Smithers au Canada', '91.00'),
('Pertusariaceae', 'Bandar-e Ganāveh', 'Iran', 'Visite de Pertusariaceae dans la ville de Bandar-e Ganāveh en Iran', '90.00'),
('Fumariaceae', 'Shah Alam', 'Malaisie', 'Visite de Fumariaceae dans la ville de Shah Alam en Malaisie', '95.00'),
('Polygalaceae', 'Shajing', 'Chine', 'Visite de Polygalaceae dans la ville de Shajing en Chine', '58.00'),
('Ranunculaceae', 'Sainte-Marthe-sur-le-Lac', 'Canada', 'Visite de Ranunculaceae dans la ville de Sainte-Marthe-sur-le-Lac', '59.00'),
('Ranunculaceae', 'Shchastya', 'Ukraine', 'Visite de Ranunculaceae dans la ville de Shchastya en Ukraine', '39.00'),
('Hypnaceae', 'Rokycany', 'République tcheque', 'Visite de Hypnaceae dans la ville de Rokycany en République tcheque', '11.00'),
('Fabaceae', 'Juancheng', 'Chine', 'Visite de Fabaceae dans la ville de Juancheng en Chine', '98.00'),
('Dicranaceae', 'Zhouxi', 'Chine', 'Visite de Dicranaceae dans la ville de Zhouxi en Chine', '43.00'),
('Convolvulaceae', 'Darłowo', 'Pologne', 'Visite de Convolvulaceae dans la ville de Darłowo en Plogne', '19.00'),
('Caryophyllaceae', 'As Samawah', 'Irak', 'Visite de Caryophyllaceae dans la ville de As Samawah', '16.00');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `Id_Circ` int NOT NULL,
  `Id_Client` int NOT NULL,
  `date_reserv` date NOT NULL,
  `Prix_tot` decimal(15,2) NOT NULL,
  `IdReserv` int NOT NULL,
  `Nb_places` int NOT NULL,
  PRIMARY KEY (`Id_Circ`,`Id_Client`),
  UNIQUE KEY `IdReserv` (`IdReserv`),
  KEY `Id_Client` (`Id_Client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `IdRole` int NOT NULL,
  `LibelleRole` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdRole`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`IdRole`, `LibelleRole`) VALUES
(1, 'Admin'),
(2, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IdUtilisateur` int NOT NULL,
  `mdp` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `IdRole` int NOT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  KEY `IdRole` (`IdRole`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `mdp`, `mail`, `IdRole`) VALUES
(0, 'test', 'test@test.fr', 1),
(1, 'test', 'test2@test.fr', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
