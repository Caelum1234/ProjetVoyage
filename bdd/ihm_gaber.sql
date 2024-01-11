-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 jan. 2024 à 22:07
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
  `Id_Circ` int NOT NULL AUTO_INCREMENT,
  `Descri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Ville_Dep` varchar(50) DEFAULT NULL,
  `Pays_Dep` varchar(50) DEFAULT NULL,
  `Pays_Arr` varchar(50) DEFAULT NULL,
  `Ville_Arr` varchar(50) DEFAULT NULL,
  `Date_Dep` varchar(50) DEFAULT NULL,
  `Nb_PlaceDisp` int DEFAULT NULL,
  `Duree_Circ` int DEFAULT NULL,
  `Prix_Insc` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`Id_Circ`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`Id_Circ`, `Descri`, `Ville_Dep`, `Pays_Dep`, `Pays_Arr`, `Ville_Arr`, `Date_Dep`, `Nb_PlaceDisp`, `Duree_Circ`, `Prix_Insc`) VALUES
(1, 'Long term (current) use of inhaled steroids', 'Créteil', 'France', 'Croatia', 'Lovran', '2/20/2023', 98, 106, '31.00'),
(2, 'Crushing injury of lower leg', 'Khuean Ubonrat', 'Thailand', 'Croatia', 'Postira', '9/1/2023', 98, 94, '91.00'),
(3, 'Passenger of amblnc/fire eng injured in traf, subs', 'Zhishan', 'China', 'Vietnam', 'Long Hồ', '11/23/2023', 72, 208, '45.00'),
(4, 'Neoplasm of uncertain behavior of prostate', 'Majayjay', 'Philippines', 'France', 'Bourges', '4/26/2023', 63, 202, '36.00'),
(5, 'Nondisp fx of olecran pro w intartic extn r ulna, ', 'Estarreja', 'Portugal', 'Japan', 'Yuza', '12/19/2023', 66, 87, '69.00'),
(6, 'Dome fracture of acetabulum', 'Tamamura', 'Japan', 'China', 'Yueyahe', '6/28/2023', 59, 92, '49.00'),
(7, 'test2', 'Paris', 'Fra', 'France', 'Lille', '2024-01-16', 12, 7, '54.00');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `Id_Client` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Date_Naissance` varchar(50) NOT NULL,
  `IdUtilisateur` int NOT NULL,
  PRIMARY KEY (`Id_Client`),
  UNIQUE KEY `IdUtilisateur` (`IdUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id_Client`, `Nom`, `Prenom`, `Date_Naissance`, `IdUtilisateur`) VALUES
(3, 'sineux', 'mathis', '2003-01-20', 4);

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
(1, 1, '2024-03-05 09:08:45', '2024-03-07 09:08:45', 'Primulaceae', 'Woto', 'Indonesia'),
(2, 2, '2024-01-10 09:11:56', '2024-01-12 09:11:56', 'Roseaceae', 'Kisasa', 'Tanzania'),
(3, 3, '2024-12-01 09:11:56', '2024-12-04 09:11:56', 'Pertubarea', 'Šentvid pri Stični', 'Slovenia'),
(4, 4, '2024-04-28 09:11:56', '2024-05-04 09:11:56', 'Fumariaceae', 'Dan Makham Tia', 'Thailand'),
(5, 5, '2024-12-20 09:11:56', '2024-12-30 09:11:56', 'Polygalaceae', 'San Carlos', 'Argentina'),
(6, 6, '2024-06-29 09:11:56', '2024-07-10 09:11:56', 'Ranunculaceae', 'Manhush', 'Ukraine');

-- --------------------------------------------------------

--
-- Structure de la table `lieux_a_visiter`
--

DROP TABLE IF EXISTS `lieux_a_visiter`;
CREATE TABLE IF NOT EXISTS `lieux_a_visiter` (
  `NomLieu` varchar(50) NOT NULL,
  `Ville_Et` varchar(50) NOT NULL,
  `Pays_Et` varchar(50) NOT NULL,
  `Descriptif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Prix_visite` decimal(15,2) NOT NULL,
  PRIMARY KEY (`NomLieu`,`Ville_Et`,`Pays_Et`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `lieux_a_visiter`
--

INSERT INTO `lieux_a_visiter` (`NomLieu`, `Ville_Et`, `Pays_Et`, `Descriptif`, `Prix_visite`) VALUES
('Primulaceae', 'Jijiazhuang', 'China', 'Infections of cervix in pregnancy, second trimeste', '90.00'),
('Rosaceae', 'Smithers', 'Canada', 'Sprain of other part of wrist and hand', '91.00'),
('Pertusariaceae', 'Bandar-e Ganāveh', 'Iran', 'Ped w convey injured in clsn w 2/3-whl mv, unsp, s', '90.00'),
('Fumariaceae', 'Shah Alam', 'Malaysia', 'Disp fx of left tibial spine, subs for clos fx w m', '95.00'),
('Polygalaceae', 'Shajing', 'China', 'Nondisp fx of r ulna styloid pro, 7thE', '58.00'),
('Ranunculaceae', 'Sainte-Marthe-sur-le-Lac', 'Canada', 'Unspecified dislocation of left foot, initial enco', '59.00'),
('Ranunculaceae', 'Shchastya', 'Ukraine', 'Laceration w fb of r little finger w/o damage to n', '39.00'),
('Hypnaceae', 'Rokycany', 'Czech Republic', 'Poisoning by macrolides, intentional self-harm', '11.00'),
('Fabaceae', 'Juancheng', 'China', 'Oth fx upr & low end l fibula, 7thQ', '98.00'),
('Dicranaceae', 'Zhouxi', 'China', 'Superficial foreign body, left hip, sequela', '43.00'),
('Convolvulaceae', 'Darłowo', 'Poland', 'Sprain of other ligament of unspecified ankle, ini', '19.00'),
('Caryophyllaceae', 'As Samawah', 'Iraq', 'Nondisp spiral fx shaft of r femr, 7thD', '16.00');

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
(0, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IdUtilisateur` int NOT NULL AUTO_INCREMENT,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IdRole` int NOT NULL,
  PRIMARY KEY (`IdUtilisateur`),
  KEY `IdRole` (`IdRole`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `mdp`, `mail`, `IdRole`) VALUES
(4, '$2y$10$TLB8dozUlGF0VqHnkuGak.mL0fHoVrsjpnUekDDYDORnZGN62QAdq', 'test@test.fr', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
