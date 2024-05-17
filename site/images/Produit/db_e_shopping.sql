-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 21 jan. 2021 à 22:52
-- Version du serveur :  10.4.10-MariaDB
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
-- Base de données :  `db_e_shopping`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `adresseID` int(11) NOT NULL AUTO_INCREMENT,
  `codePostal` int(11) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `numeroVoie` int(11) NOT NULL,
  `nomRue` varchar(255) NOT NULL,
  PRIMARY KEY (`adresseID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`adresseID`, `codePostal`, `ville`, `numeroVoie`, `nomRue`) VALUES
(1, 59000, 'Lille', 42, 'Bd Vauban'),
(2, 59000, 'Lille', 42, 'Bd Vauban'),
(3, 59120, 'Loos', 69, 'Rue de Londres'),
(4, 59120, 'Jadielle', 69, 'Rue de du centre'),
(5, 27080, 'Arendelle', 301, 'Place du marché');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorieID` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(255) NOT NULL,
  `descriptionCategorie` text NOT NULL,
  `surcategorieID` int(11) NOT NULL,
  PRIMARY KEY (`categorieID`),
  KEY `surcategorie` (`surcategorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `nomCategorie`, `descriptionCategorie`, `surcategorieID`) VALUES
(1, 'PC portable', '', 1),
(2, 'Ordinateur de Bureau', '', 1),
(3, 'Smartphone et téléphone', '', 2),
(4, 'Tablette', '', 2),
(5, 'telephone Fix et Fax', '', 2),
(6, 'Television', '', 3),
(7, 'Récepteurs Numérique', '', 3),
(8, 'Projection', '', 3),
(9, 'Home cinéma', '', 3),
(10, 'Accessoires Ordinateur', '', 4),
(11, 'composants & maintenance ordinateur', '', 4),
(12, 'Cable & Adaptetur', '', 4),
(13, 'Stockage', '', 4),
(14, 'Pc Gamer', '', 5),
(15, 'Ecran Gamer', '', 5),
(16, 'Accessoires Gamer', '', 5),
(17, 'Composants Gamer', '', 5),
(18, 'Console de jeux', '', 5),
(19, 'jeux videos', '', 5);

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `commentaires` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`questionID`),
  KEY `faq_ibfk_1` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`questionID`, `question`, `commentaires`, `userID`) VALUES
(1, 'Comment acheter sur notre site ?', 'Bonjour comment acheter sur votre site ?', 11),
(2, 'Peut-on devenir admin ?', 'Bonjour, j\'aime beaucoup votre site. Il est magnifique ! C\'est pourquoi, j\'aimerais beaucoup m\'impliquer davantage. Peut-on devenir admin ?', 13),
(3, 'Comment effectuer une recherche de produit ?', 'Bonjour, je ne comprends pas comment effectuer une recherche de produit. Pouvez-vous m\'aider ?', 4),
(4, 'Où se trouve la FAQ ?', 'Bonjour, je suis un peu perdu. Où se trouve la FAQ ? J\'ai besoin d\'aide ! HELP !!!', 5);

-- --------------------------------------------------------

--
-- Structure de la table `faqreponses`
--

DROP TABLE IF EXISTS `faqreponses`;
CREATE TABLE IF NOT EXISTS `faqreponses` (
  `reponseID` int(11) NOT NULL AUTO_INCREMENT,
  `reponse` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  PRIMARY KEY (`reponseID`),
  KEY `faqreponses_ibfk_1` (`userID`),
  KEY `faqreponses_ibfk_2` (`questionID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faqreponses`
--

INSERT INTO `faqreponses` (`reponseID`, `reponse`, `userID`, `questionID`) VALUES
(1, 'Bonjour, as-tu essayé d\'appuyer sur le bouton acheter qui est situé en haut à droite d\'une page produit ? Il ressemble à un caddie ;)', 2, 1),
(2, 'Pas pour le moment.', 1, 2),
(3, 'Un jour peut-être ;)', 2, 2),
(4, 'Bonjour, pour effectuer une recherche de produit, il faut aller sur la page recherche et renseigner le champ.', 1, 3),
(5, 'Bonjour, pour compléter ce qui a été dit, il est possible d\'entrer des mots clés pour obtenir une liste de produits correspondants.', 2, 3),
(6, 'Bonjour, la FAQ est la page où vous lisez actuellement ce texte ^^ Bienvenue sur la FAQ', 1, 4),
(7, 'Merciii ! Vous êtes un dieu !!', 5, 4),
(8, 'Monsieur Chu, la FAQ contient plusieurs pages de questions ayant reçue des réponses. Je vous conseille de les lire attentivement.', 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `lignepanier`
--

DROP TABLE IF EXISTS `lignepanier`;
CREATE TABLE IF NOT EXISTS `lignepanier` (
  `lignePanierID` int(11) NOT NULL AUTO_INCREMENT,
  `panierID` int(11) NOT NULL,
  `numeroLignePanier` int(11) NOT NULL,
  `produitID` int(11) NOT NULL,
  `quantité` int(11) NOT NULL,
  PRIMARY KEY (`lignePanierID`),
  KEY `panierID` (`panierID`),
  KEY `produitID` (`produitID`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lignepanier`
--

INSERT INTO `lignepanier` (`lignePanierID`, `panierID`, `numeroLignePanier`, `produitID`, `quantité`) VALUES
(1, 1, 1, 1, 4),
(2, 1, 1, 2, 1),
(3, 2, 1, 2, 2),
(4, 5, 1, 1, 1),
(5, 5, 2, 2, 2),
(6, 5, 3, 6, 1),
(7, 6, 1, 1, 5),
(8, 6, 2, 4, 2),
(9, 7, 1, 1, 1),
(10, 8, 1, 3, 4),
(11, 9, 1, 14, 7),
(12, 8, 2, 2, 1),
(13, 8, 3, 4, 2),
(15, 10, 2, 13, 1),
(16, 10, 3, 41, 1),
(17, 10, 4, 3, 1),
(18, 10, 5, 5, 1),
(19, 10, 6, 2, 3),
(20, 10, 7, 26, 1),
(21, 10, 8, 2, 1),
(22, 10, 9, 40, 1),
(23, 10, 10, 28, 1),
(34, 11, 2, 3, 2),
(35, 11, 3, 22, 1),
(36, 11, 4, 33, 2),
(37, 11, 5, 12, 1),
(38, 12, 1, 4, 1),
(40, 13, 1, 28, 1),
(41, 13, 2, 37, 1),
(72, 14, 1, 33, 1),
(73, 15, 1, 33, 1),
(74, 16, 1, 33, 1),
(75, 17, 1, 28, 1),
(76, 18, 1, 28, 1),
(77, 19, 1, 28, 1),
(78, 20, 1, 7, 1),
(79, 21, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `moyendepaiement`
--

DROP TABLE IF EXISTS `moyendepaiement`;
CREATE TABLE IF NOT EXISTS `moyendepaiement` (
  `moyenDePaiementID` int(11) NOT NULL AUTO_INCREMENT,
  `nomMoyenDePaiement` varchar(255) NOT NULL,
  `descriptionMoyenDePaiement` text NOT NULL,
  PRIMARY KEY (`moyenDePaiementID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `moyendepaiement`
--

INSERT INTO `moyendepaiement` (`moyenDePaiementID`, `nomMoyenDePaiement`, `descriptionMoyenDePaiement`) VALUES
(1, 'Effets de commerce', 'Les effets de commerce tels que la traite (ou lettre de change) et le billet à ordre, instruments tant de crédit que de paiement.'),
(2, 'Chèque ', 'Le chèque est un moyen de paiement scriptural utilisant le circuit bancaire. Il est généralement utilisé pour faire transiter de la monnaie d\'un compte bancaire à un autre. Tombé en désuétude dans la plupart des pays industrialisés, il reste encore souvent utilisé en France, au Royaume-Uni et aux États-Unis.'),
(3, 'Coupon de paiement', 'Le coupon de paiement, ticket d\'achat vendu notamment par les buralistes, permettant de recharger des cartes bancaires prépayées ; utilisé notamment pour des créditer une compte de jeux en ligne. Parce qu\'il est également objet de nombreuses fraudes du fait de son caractère anonyme, la directive sur le service des paiements vise a réduire le montant maximum journalier.'),
(4, 'Porte-monnaie électronique', 'Le porte-monnaie électronique est un dispositif qui peut stocker de la monnaie sans avoir besoin d\'un compte bancaire et d\'effectuer directement des paiements sur des terminaux de paiement.'),
(5, 'Crypto-monnaie', 'Une crypto-monnaie ou monnaie cryptographique est une monnaie électronique sur un réseau informatique pair à pair ou décentralisée basé sur les principes de la cryptographie pour valider les transactions et émettre la monnaie elle-même1,2. Aujourd\'hui, toutes les crypto-monnaies sont des monnaies alternatives, car elles n\'ont de cours légal dans aucun pays. Les crypto-monnaies utilisent un système de preuve de travail pour les protéger des contrefaçons électroniques. De nombreuses crypto-monnaies ont été développées mais la plupart sont similaires et dérivent de la première implémentation complète : le Bitcoin.'),
(6, 'Carte de paiement', 'Une carte de paiement est un moyen de paiement se présentant sous la forme d\'une carte plastique mesurant 85,60 × 53,98 mm, équipée d\'une bande magnétique et/ou puce électronique (c\'est alors une carte à puce), et qui permet :\r\n\r\nle paiement, auprès de commerces physiques possédant un terminal de paiement électronique ou auprès de commerces virtuels via Internet ;\r\nles retraits d\'espèces aux distributeurs de billets.\r\nLa carte de paiement est associée à un réseau de paiement, tel que VISA, MasterCard, American Express, JCB, le Groupe Carte Bleue. Une carte de paiement peut être à « débit immédiat », à débit différé ou une carte de crédit.\r\n\r\nLe réseau interbancaire français possède une particularité : toute carte disposant de la marque « CB - Carte bancaire » permet de payer par le biais du réseau interbancaire français, le Groupement des Cartes Bancaires CB.');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panierID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `etatPanier` int(11) NOT NULL,
  `adresseID` int(11) DEFAULT NULL,
  `moyenDePaiementID` int(11) DEFAULT NULL,
  `HeureAchat` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`panierID`),
  KEY `userID` (`userID`),
  KEY `adresseID` (`adresseID`),
  KEY `moyenDePaiementID` (`moyenDePaiementID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`panierID`, `userID`, `etatPanier`, `adresseID`, `moyenDePaiementID`, `HeureAchat`) VALUES
(1, 3, 1, 1, 3, '2016-11-18 13:28:18'),
(2, 5, 0, 3, 4, '2016-11-18 13:28:18'),
(4, 3, 1, 1, 3, '2016-05-03 12:28:18'),
(5, 4, 1, NULL, 2, NULL),
(6, 18, 1, NULL, 1, NULL),
(7, 18, 1, NULL, 1, NULL),
(8, 18, 1, NULL, 1, NULL),
(9, 1, 0, NULL, NULL, NULL),
(10, 18, 1, NULL, 1, NULL),
(11, 18, 1, NULL, 1, NULL),
(12, 18, 1, NULL, 1, NULL),
(13, 18, 1, NULL, 1, NULL),
(14, 18, 1, NULL, 1, NULL),
(15, 18, 1, NULL, 1, NULL),
(16, 18, 1, NULL, 1, NULL),
(17, 18, 1, NULL, 1, NULL),
(18, 18, 1, NULL, 1, NULL),
(19, 18, 1, NULL, 1, NULL),
(20, 18, 1, NULL, 1, NULL),
(21, 18, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `produitID` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduit` varchar(255) COLLATE utf8_bin NOT NULL,
  `prix` decimal(11,3) NOT NULL,
  `Solde` int(3) DEFAULT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `cheminimage` varchar(500) COLLATE utf8_bin NOT NULL,
  `sousCategorieID` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Stock` int(11) DEFAULT 1,
  PRIMARY KEY (`produitID`),
  KEY `sousCategorieID` (`sousCategorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`produitID`, `nomProduit`, `prix`, `Solde`, `description`, `cheminimage`, `sousCategorieID`, `Date`, `Stock`) VALUES
(1, 'PC PORTABLE ASUS N3350 DUAL CORE 4GO 128 GO SSD WIN10 GRIS', '729.000', 10, 'PC PORTABLE ASUS N3350 DUAL CORE 4GO 128 GO SSD WIN10 GRIS', 'images/Produit/1.jpg', 1, '2020-01-02', 0),
(2, 'PC PORTABLE ASUS E410MA DUAL CORE 4GO 128GO WIN 10 BLEU\r\n', '779.000', 10, 'PC PORTABLE ASUS E410MA DUAL CORE 4GO 128GO WIN 10 BLEU\r\n', 'Images/Produit/2.jpg', 1, '2021-01-02', 1),
(3, 'PC PORTABLE ASUS X543NA N3350 4GO 1TO WIN10 GRIS\r\n', '789.000', NULL, 'PC PORTABLE ASUS X543NA N3350 4GO 1TO WIN10 GRIS\r\n', 'Images/Produit/3.jpg', 1, '2021-01-02', 1),
(4, '\r\nPC PORTABLE LENOVO C340 -14API RYZEN_3 4GO 256 GO SSD WIN10', '1719.000', NULL, '\r\nPC PORTABLE LENOVO C340 -14API RYZEN_3 4GO 256 GO SSD WIN10', 'Images/Produit/4.jpg', 1, '2021-01-02', 1),
(5, 'MacBook', '3000.000', NULL, '\r\nMacBook', 'Images/Produit/5.jpg', 2, '2021-01-02', 1),
(6, 'MacBook', '3500.000', NULL, 'MacBook', 'Images/Produit/6.jpg', 2, '2021-01-02', 1),
(7, 'PC DE BUREAU LENOVO V530T G5420 4GO 1TO NOIR\r\n', '719.000', NULL, 'PC DE BUREAU LENOVO V530T G5420 4GO 1TO NOIR\r\nDans Bravely Default, la quête à travers Luxendarc pour réveiller les cristaux est un RPG unique et innovant, en exclusivité sur les consoles de la famille Nintendo 3DS. ', 'Images/Produit/7.jpg', 3, '2021-01-02', 0),
(8, 'PC DE BUREAU DELL VOSTRO 3671 I3 9È GÉN 8GO 1TO NOIR\r\n', '979.000', NULL, 'PC DE BUREAU DELL VOSTRO 3671 I3 9È GÉN 8GO 1TO NOIR\r\n', 'Images/Produit/8.jpg', 3, '2021-01-02', 1),
(9, 'PC DE BUREAU AIO LENOVO V130 J4005 4GO 1TO NOIR\r\n', '819.000', NULL, 'PC DE BUREAU AIO LENOVO V130 J4005 4GO 1TO NOIR\r\n', 'Images/Produit/9.jpg', 4, '2021-01-02', 1),
(10, 'PC DE BUREAU ALL IN ONE ASUS V222GAK DUAL CORE 4GO 1TO WIN 10 BLANC\r\n', '1079.000', NULL, 'PC DE BUREAU ALL IN ONE ASUS V222GAK DUAL CORE 4GO 1TO WIN 10 BLANC\r\n', 'Images/Produit/10.jpg', 4, '2021-01-02', 1),
(11, 'IMac', '5000.000', NULL, 'IMac', 'Images/Produit/11.jpg', 5, '2021-01-02', 1),
(12, 'IMac', '5500.000', NULL, 'IMac', 'Images/Produit/12.jpg', 5, '2021-01-02', 1),
(13, 'TÉLÉPHONE PORTABLE NOKIA 105 (2017) ROSE\r\n', '65.000', NULL, 'TÉLÉPHONE PORTABLE NOKIA 105 (2017) ROSE\r\n', 'Images/Produit/13.jpg', 6, '2021-01-02', 1),
(14, 'GSM NOKIA 216 BLEU\r\n', '99.000', NULL, 'GSM NOKIA 216 BLEU\r\n', 'Images/Produit/14.jpg', 6, '2021-01-02', 1),
(15, 'SAMSUNG GALAXY Z FLIP NOIR\r\n', '5199.000', NULL, 'SAMSUNG GALAXY Z FLIP NOIR\r\n', 'Images/Produit/15.jpg', 7, '2021-01-02', 1),
(16, 'SAMSUNG GALAXY S20 ULTRA NOIR\r\n', '4599.000', NULL, 'SAMSUNG GALAXY S20 ULTRA NOIR\r\n', 'Images/Produit/16.jpg', 7, '2021-01-02', 1),
(17, 'IPHONE 11 PRO MAX 64 GO GRIS\r\n', '4999.000', NULL, 'IPHONE 11 PRO MAX 64 GO GRIS\r\n', 'Images/Produit/17.jpg', 8, '2021-01-02', 1),
(18, 'IPHONE 11 PRO MAX 64 GO NOIR\r\n', '4999.000', NULL, 'IPHONE 11 PRO MAX 64 GO NOIR\r\n', 'Images/Produit/18.jpg', 8, '2021-01-02', 1),
(19, 'TABLETTE SAMSUNG GALAXY TAB A 8\" T295 4G SILVER\r\n', '549.000', NULL, 'TABLETTE SAMSUNG GALAXY TAB A 8\" T295 4G SILVER\r\n', 'Images/Produit/19.jpg', 9, '2021-01-02', 1),
(20, 'TABLETTE HUAWEI MEDIAPAD T3 7\"\r\n', '259.000', NULL, 'TABLETTE HUAWEI MEDIAPAD T3 7\"\r\n', 'Images/Produit/20.jpg', 9, '2021-01-02', 1),
(21, 'IPad', '2000.000', NULL, 'IPad', 'Images/Produit/21.jpg', 10, '2021-01-02', 1),
(22, 'ALCATEL T26\r\n', '49.000', NULL, 'ALCATEL T26\r\n', 'Images/Produit/22.jpg', 11, '2021-01-02', 1),
(23, 'TÉLÉPHONE FIXE SANS FIL LOGICOM AURA 150 BLEU\r\n', '79.000', NULL, 'TÉLÉPHONE FIXE SANS FIL LOGICOM AURA 150 BLEU\r\n', 'Images/Produit/23.jpg', 12, '2021-01-02', 1),
(24, 'FAX BROTRHER 2845\r\n', '836.025', NULL, 'FAX BROTRHER 2845\r\n', 'Images/Produit/24.jpg', 13, '2021-01-02', 1),
(25, 'FAX BROTRHER T104\r\n', '339.000', NULL, 'FAX BROTRHER T104\r\n', 'Images/Produit/25.jpg', 14, '2021-01-02', 1),
(26, 'TÉLÉVISEUR VEGA 32\" LED HD + RÉCEPTEUR INT NOIR\r\n', '399.000', NULL, 'TÉLÉVISEUR VEGA 32\" LED HD + RÉCEPTEUR INT NOIR\r\n', 'Images/Produit/26.jpg', 15, '2021-01-02', 1),
(27, 'TÉLÉVISEUR TELEFUNKEN 32\" D2 LED HD + RÉC INT\r\n', '499.000', NULL, 'TÉLÉVISEUR TELEFUNKEN 32\" D2 LED HD + RÉC INT\r\n', 'images/Produit/27.jpg', 15, '2021-01-04', 2),
(28, 'BOX TV ANDROID SAMSAT KI PLUS S2 4K + 1 AN IPTV + VOD\r\n', '199.000', NULL, 'BOX TV ANDROID SAMSAT KI PLUS S2 4K + 1 AN IPTV + VOD\r\n', 'images/Produit/28.jpg', 16, '2021-01-04', 1),
(29, 'VIDÉO PROJECTEUR EPSON EB-S05\r\n', '999.000', NULL, 'VIDÉO PROJECTEUR EPSON EB-S05\r\n', 'images/Produit/29.jpg', 17, '2021-01-04', 2),
(30, 'VIDÉO PROJECTEUR BENQ MX507', '1029.000', NULL, 'VIDÉO PROJECTEUR BENQ MX507', 'images/Produit/30.jpg', 17, '2021-01-04', 2),
(31, 'BARRE DE SON HAVIT SF5627 BT BLUETOOTH', '350.000', NULL, 'BARRE DE SON HAVIT SF5627 BT BLUETOOTH', 'images/Produit/31.jpg', 18, '2021-01-04', 2),
(32, 'BARRE DE SON JBL CINÉMA SB160', '1270.900', NULL, 'BARRE DE SON JBL CINÉMA SB160', 'images/Produit/32.jpg', 18, '2021-01-04', 2),
(33, 'SOURIS SPIDER 835 NOIR', '2.900', NULL, 'SOURIS SPIDER 835 NOIR', 'images/Produit/33.jpg', 19, '2021-01-04', 2),
(34, 'SOURIS OPTIQUE HAVIT MS753 USB FILAIRE NOIR', '5.900', NULL, 'SOURIS OPTIQUE HAVIT MS753 USB FILAIRE NOIR', 'images/Produit/34.jpg', 19, '2021-01-04', 2),
(35, 'DISQUE DUR INTERNE KINGSTON SA400S37 480GO SSD', '209.900', NULL, 'DISQUE DUR INTERNE KINGSTON SA400S37 480GO SSD', 'images/Produit/35.jpg', 20, '2021-01-04', 2),
(36, 'DISQUE DUR INTERNE 3.5\" TOSHIBA 2 TO', '235.000', NULL, 'DISQUE DUR INTERNE 3.5\" TOSHIBA 2 TO', 'images/Produit/36.jpg', 20, '2021-01-04', 2),
(37, 'CABLE USB (AM/BM) 1.5M TRANSPARENT 2.0 PRO', '3.900', NULL, 'CABLE USB (AM/BM) 1.5M TRANSPARENT 2.0 PRO', 'images/Produit/37.jpg', 21, '2021-01-04', 2),
(38, 'CLÉ USB PNY 8GO USB 2.0', '9.300', NULL, 'CLÉ USB PNY 8GO USB 2.0', 'images/Produit/38.jpg', 22, '2021-01-04', 2),
(39, 'PC PORTABLE GAMER LENOVO L340 I5 9É GÉN 8GO 2TO SSD 4GO NOIR', '2499.000', NULL, 'PC PORTABLE GAMER LENOVO L340 I5 9É GÉN 8GO 2TO SSD 4GO NOIR', 'images/Produit/39.jpg', 23, '2021-01-04', 2),
(40, 'ECRAN GAMING DELL 23.6\" FULL HD SE2417HG', '459.000', NULL, 'ECRAN GAMING DELL 23.6\" FULL HD SE2417HG', 'images/Produit/40.jpg', 24, '2021-01-04', 2),
(41, 'SOURIS GAMER T-DAGGER LANCE CORPORAL RGB NOIR', '25.000', NULL, 'SOURIS GAMER T-DAGGER LANCE CORPORAL RGB NOIR', 'images/Produit/41.jpg', 25, '2021-01-04', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE IF NOT EXISTS `rating` (
  `ratingID` int(11) NOT NULL AUTO_INCREMENT,
  `useID` int(11) NOT NULL,
  `produitID` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  PRIMARY KEY (`ratingID`),
  KEY `user` (`useID`),
  KEY `produit` (`produitID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `souscategorie`
--

DROP TABLE IF EXISTS `souscategorie`;
CREATE TABLE IF NOT EXISTS `souscategorie` (
  `sousCategorieID` int(11) NOT NULL AUTO_INCREMENT,
  `nomSousCategorie` varchar(255) NOT NULL,
  `descriptionSousCategorie` text NOT NULL,
  `categorieID` int(11) NOT NULL,
  PRIMARY KEY (`sousCategorieID`),
  KEY `categorieID` (`categorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `souscategorie`
--

INSERT INTO `souscategorie` (`sousCategorieID`, `nomSousCategorie`, `descriptionSousCategorie`, `categorieID`) VALUES
(1, 'Pc Portable', '', 1),
(2, 'Macbook', '', 1),
(3, 'Pc de bureau', '', 2),
(4, 'Pc all-in-one', '', 2),
(5, 'Imac', '', 2),
(6, 'Telephone', '', 3),
(7, 'Smartphone', '', 3),
(8, 'IPhone', '', 3),
(9, 'Tablette', '', 4),
(10, 'IPad', '', 4),
(11, 'Telephone fix', '', 5),
(12, 'Telephone sans fil', '', 5),
(13, 'Fax laser', '', 5),
(14, 'Fax Thermique', '', 5),
(15, 'TV led', '', 6),
(16, 'android TV Box', '', 7),
(17, 'Video projecteur', '', 8),
(18, 'Home cinema', '', 9),
(19, 'Souries & tapis', '', 10),
(20, 'Disque dur interne', '', 11),
(21, 'Cable USB', '', 12),
(22, 'Cle usb', '', 13),
(23, 'Pc portable gamer', '', 14),
(24, 'Ecran gamer', '', 15),
(25, 'Souris', '', 16),
(26, 'Boities', '', 17),
(27, 'PS5', '', 18),
(28, 'Jeux PS5', '', 19);

-- --------------------------------------------------------

--
-- Structure de la table `surcategorie`
--

DROP TABLE IF EXISTS `surcategorie`;
CREATE TABLE IF NOT EXISTS `surcategorie` (
  `surcategorieID` int(11) NOT NULL AUTO_INCREMENT,
  `nomSurcategorie` varchar(256) NOT NULL,
  PRIMARY KEY (`surcategorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `surcategorie`
--

INSERT INTO `surcategorie` (`surcategorieID`, `nomSurcategorie`) VALUES
(1, 'Ordinateurs & PC prtable'),
(2, 'Telephonie & Tablette'),
(3, 'Image et Son'),
(4, 'accesoires & Peripheriques'),
(5, 'Gaming');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `chemin` varchar(500) COLLATE utf8_bin NOT NULL,
  `niveau_accreditation` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`userID`, `nom`, `prenom`, `chemin`, `niveau_accreditation`, `mail`, `mot_de_passe`) VALUES
(1, 'Reynaert', 'Vincent', 'Images/Profil/profil_utilisateur.jpg', 1, 'vincent.reynaert@isen-lille.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(2, 'Sobczak', 'Nicolas', 'Images/Profil/2.jpg', 1, 'nicolas.sobczak@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(3, 'Pryfer', 'Sylvain', 'Images/Profil/profil_utilisateur.jpg', 2, 'feitte@gmail.com', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(4, 'Elsa', 'Queen of Arendelle', 'Images/Profil/4.jpg', 2, 'anna.elsa@gmail.com', 'a94f847604a278d4d80c20361ab8c5c0bb913e9e'),
(5, 'Pika', 'Chu', 'Images/Profil/5.png', 2, 'pikachu@nintendo.com', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(6, 'Landais', 'Baudouin', 'Images/Profil/profil_utilisateur.jpg', 2, 'baudouin.landais@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(7, 'Levert', 'Quentin', 'Images/Profil/profil_utilisateur.jpg', 2, 'quentin.levert@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(8, 'Noet', 'Kevin', 'Images/Profil/profil_utilisateur.jpg', 2, 'kevin.noet@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(9, 'Percq', 'Timothée', 'Images/Profil/profil_utilisateur.jpg', 2, 'timothee.percq@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(10, 'Polaert', 'Francis', 'Images/Profil/profil_utilisateur.jpg', 2, 'francis.polaert@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(11, 'Valencourt', 'Vivien', 'Images/Profil/profil_utilisateur.jpg', 2, 'vivien.valencourt@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(12, 'Vandierdonck', 'Guillaume', 'Images/Profil/profil_utilisateur.jpg', 2, 'guillaume.vandierdonck@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(13, 'Vanmarcke', 'Romain', 'Images/Profil/profil_utilisateur.jpg', 2, 'romain.vanmarcke@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(14, 'Vermeil', 'Julien', 'Images/Profil/profil_utilisateur.jpg', 2, 'julien.vermeil@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(15, 'You', 'Qi', 'Images/Profil/profil_utilisateur.jpg', 2, 'qi.you@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(16, 'Yue', 'Cuize', 'Images/Profil/profil_utilisateur.jpg', 2, 'cuize.yue@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(17, 'Trouche', 'Pierre', 'Images/Profil/profil_utilisateur.jpg', 2, 'trouchyLeMalade@isen.yncrea.fr', 'ad0557319768587a736ee716b5bc48945c39aaab'),
(18, 'wissem', 'regaieg', 'Images/Profil/18.png', 2, 'wissem.regaieg@gmail.com', 'a94f847604a278d4d80c20361ab8c5c0bb913e9e');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `surcategorie` FOREIGN KEY (`surcategorieID`) REFERENCES `surcategorie` (`surcategorieID`);

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Contraintes pour la table `faqreponses`
--
ALTER TABLE `faqreponses`
  ADD CONSTRAINT `faqreponses_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `faqreponses_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `faq` (`questionID`);

--
-- Contraintes pour la table `lignepanier`
--
ALTER TABLE `lignepanier`
  ADD CONSTRAINT `lignepanier_ibfk_1` FOREIGN KEY (`panierID`) REFERENCES `panier` (`panierID`),
  ADD CONSTRAINT `lignepanier_ibfk_2` FOREIGN KEY (`produitID`) REFERENCES `produit` (`produitID`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`adresseID`) REFERENCES `adresse` (`adresseID`),
  ADD CONSTRAINT `panier_ibfk_3` FOREIGN KEY (`moyenDePaiementID`) REFERENCES `moyendepaiement` (`moyenDePaiementID`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`sousCategorieID`) REFERENCES `souscategorie` (`sousCategorieID`);

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `produit` FOREIGN KEY (`produitID`) REFERENCES `produit` (`produitID`),
  ADD CONSTRAINT `user` FOREIGN KEY (`useID`) REFERENCES `user` (`userID`);

--
-- Contraintes pour la table `souscategorie`
--
ALTER TABLE `souscategorie`
  ADD CONSTRAINT `souscategorie_ibfk_1` FOREIGN KEY (`categorieID`) REFERENCES `categorie` (`categorieID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
