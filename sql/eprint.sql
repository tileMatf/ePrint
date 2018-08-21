-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2018 at 09:25 PM
-- Server version: 5.7.14-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eprint`
--
CREATE DATABASE IF NOT EXISTS `eprint` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `eprint`;

-- --------------------------------------------------------

--
-- Table structure for table `blokovi`
--

DROP TABLE IF EXISTS `blokovi`;
CREATE TABLE IF NOT EXISTS `blokovi` (
  `OrderID` int(11) NOT NULL,
  `FileName` varchar(1000) NOT NULL,
  `NumberOfSet` int(11) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Size` varchar(255) NOT NULL,
  `Packing` varchar(255) NOT NULL,
  `Comment` varchar(1000) DEFAULT NULL,
  `SendCopy` tinyint(1) NOT NULL DEFAULT '0',
  KEY `blokovi_orders_fk` (`OrderID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blokovi`
--

INSERT INTO `blokovi` (`OrderID`, `FileName`, `NumberOfSet`, `Color`, `Size`, `Packing`, `Comment`, `SendCopy`) VALUES
(149, 'KosticTijana.pdf', 5, 'Plavo-belo', 'A4', 'Heftanjem gore', 'Tijana', 0),
(167, 'KosticTijana.pdf', 5, 'Plavo-belo', 'A4', 'Heftanjem gore', 'Tijana', 0),
(171, 'KosticTijana.pdf', 1, 'Crno-belo', 'A4', 'U fasciklu', 'k', 0),
(173, 'KosticTijana.pdf', 51, 'Plavo-belo', 'A4', 'Heftanjem gore', 'Tijana', 0),
(174, 'KosticTijana.pdf', 5, 'Plavo-belo', 'A4', 'Heftanjem gore', 'Tijana', 0),
(194, 'KosticTijana.pdf', 1, 'Crno-belo', 'A4', 'U fasciklu', NULL, 0),
(195, 'KosticTijana.pdf', 1, 'Crno-belo', 'A4', 'U fasciklu', NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `blokoviorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `blokoviorder`;
CREATE TABLE IF NOT EXISTS `blokoviorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`FileName` varchar(1000)
,`NumberOfSet` int(11)
,`Color` varchar(255)
,`Size` varchar(255)
,`Packing` varchar(255)
,`Comment` varchar(1000)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `dostavnice`
--

DROP TABLE IF EXISTS `dostavnice`;
CREATE TABLE IF NOT EXISTS `dostavnice` (
  `OrderID` int(11) NOT NULL,
  `Recipient` varchar(255) NOT NULL,
  `Name` varchar(1000) DEFAULT NULL,
  `Address` varchar(512) DEFAULT NULL,
  `ZipCode` int(4) DEFAULT NULL,
  `Location` varchar(1000) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `SendCopy` tinyint(1) NOT NULL,
  KEY `dostavnica_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dostavnice`
--

INSERT INTO `dostavnice` (`OrderID`, `Recipient`, `Name`, `Address`, `ZipCode`, `Location`, `Quantity`, `SendCopy`) VALUES
(78, 'Javni beleznik', 'Tijana Kostic', NULL, NULL, 'Pancevo', 3000, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dostavniceorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `dostavniceorder`;
CREATE TABLE IF NOT EXISTS `dostavniceorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Recipient` varchar(255)
,`Name` varchar(1000)
,`Address` varchar(512)
,`ZipCode` int(4)
,`Location` varchar(1000)
,`Quantity` int(11)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `formulari-za-adresiranje`
--

DROP TABLE IF EXISTS `formulari-za-adresiranje`;
CREATE TABLE IF NOT EXISTS `formulari-za-adresiranje` (
  `OrderID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `SendCopy` tinyint(1) NOT NULL,
  KEY `formulari_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formulari-za-adresiranje`
--

INSERT INTO `formulari-za-adresiranje` (`OrderID`, `Quantity`, `Type`, `SendCopy`) VALUES
(182, 1230, 'S6', 0),
(183, 1000, 'S6', 0),
(192, 1000, 'S6', 1),
(193, 1000, 'S5', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `formulariorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `formulariorder`;
CREATE TABLE IF NOT EXISTS `formulariorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Type` varchar(10)
,`Quantity` int(11)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `koverte-sa-dostavnicom`
--

DROP TABLE IF EXISTS `koverte-sa-dostavnicom`;
CREATE TABLE IF NOT EXISTS `koverte-sa-dostavnicom` (
  `OrderID` int(11) NOT NULL,
  `Recipient` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Name` varchar(1000) DEFAULT NULL,
  `Address` varchar(1000) DEFAULT NULL,
  `ZipCode` int(11) DEFAULT NULL,
  `Location` varchar(1000) DEFAULT NULL,
  `PostagePaid` varchar(1000) DEFAULT NULL,
  `EnvelopeType` varchar(10) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SendCopy` tinyint(1) NOT NULL,
  KEY `kov-sa-dos_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `koverte-sa-dostavnicom`
--

INSERT INTO `koverte-sa-dostavnicom` (`OrderID`, `Recipient`, `Color`, `Name`, `Address`, `ZipCode`, `Location`, `PostagePaid`, `EnvelopeType`, `Quantity`, `SendCopy`) VALUES
(91, 'Javni beleznik', 'bela', 'Zorana', 'Adresa', 26000, 'Cara Dusana 16a', '...', 'S0', 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `koverte-sa-povratnicom`
--

DROP TABLE IF EXISTS `koverte-sa-povratnicom`;
CREATE TABLE IF NOT EXISTS `koverte-sa-povratnicom` (
  `OrderID` int(11) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SendCopy` tinyint(1) NOT NULL,
  KEY `kov-sa-pov_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `koverte-sa-povratnicom`
--

INSERT INTO `koverte-sa-povratnicom` (`OrderID`, `Color`, `Quantity`, `SendCopy`) VALUES
(75, 'bela', 1000, 0),
(76, 'bela', 5000, 0),
(212, 'plava', 1000, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kovertesadostavnicomorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `kovertesadostavnicomorder`;
CREATE TABLE IF NOT EXISTS `kovertesadostavnicomorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Recipient` varchar(255)
,`Color` varchar(255)
,`Name` varchar(1000)
,`Address` varchar(1000)
,`ZipCode` int(11)
,`Location` varchar(1000)
,`PostagePaid` varchar(1000)
,`EnvelopeType` varchar(10)
,`Quantity` int(11)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kovertesapovratnicomorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `kovertesapovratnicomorder`;
CREATE TABLE IF NOT EXISTS `kovertesapovratnicomorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Color` varchar(255)
,`Quantity` int(11)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `omot-spisa`
--

DROP TABLE IF EXISTS `omot-spisa`;
CREATE TABLE IF NOT EXISTS `omot-spisa` (
  `OrderID` int(11) NOT NULL,
  `Recipient` varchar(255) NOT NULL,
  `Name` varchar(1000) DEFAULT NULL,
  `Address` varchar(1000) DEFAULT NULL,
  `Location` varchar(1000) DEFAULT NULL,
  `PaperType` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Comment` varchar(100) DEFAULT NULL,
  `SendCopy` tinyint(1) NOT NULL DEFAULT '0',
  KEY `omot-spisa_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `omot-spisa`
--

INSERT INTO `omot-spisa` (`OrderID`, `Recipient`, `Name`, `Address`, `Location`, `PaperType`, `Quantity`, `Comment`, `SendCopy`) VALUES
(113, 'Javni beleznik', 'Tijana Kostić', 'Cara Dušana 16a', 'Pančevo', '100gr/m2', 1000, NULL, 0),
(114, 'Javni beleznik', 'Tijana Kostić', 'Cara Dušana 16a', 'Pančevo', '300gr/m2', 2000, NULL, 0),
(172, 'Javni beleznik', 'Tijana Kostić', 'Cara Dušana 16a', 'Pančevo', '300gr/m2', 2000, NULL, 0),
(208, 'Javni izvrsitelj', 'tijana', NULL, NULL, '100gr/m2', 1000, NULL, 0),
(209, 'Javni izvrsitelj', 'aa', NULL, NULL, '100gr/m2', 1000, NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `omotispisaorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `omotispisaorder`;
CREATE TABLE IF NOT EXISTS `omotispisaorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Recipient` varchar(255)
,`Name` varchar(1000)
,`Address` varchar(1000)
,`Location` varchar(1000)
,`PaperType` varchar(255)
,`Quantity` int(11)
,`Comment` varchar(100)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TypeID` tinyint(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `Seen` tinyint(1) NOT NULL DEFAULT '0',
  `SavedOrder` tinyint(1) NOT NULL,
  `DeliveryName` varchar(255) DEFAULT NULL,
  `DeliveryEmail` varchar(255) DEFAULT NULL,
  `DeliveryPhone` varchar(255) NOT NULL,
  `DeliveryAddress` varchar(255) NOT NULL,
  `DeliveryZipCode` varchar(255) NOT NULL,
  `DeliveryLocation` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `orders_user_fk` (`UserID`),
  KEY `orders_type_fk` (`TypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `TypeID`, `UserID`, `OrderDate`, `Seen`, `SavedOrder`, `DeliveryName`, `DeliveryEmail`, `DeliveryPhone`, `DeliveryAddress`, `DeliveryZipCode`, `DeliveryLocation`) VALUES
(74, 5, 3, '2018-04-18', 0, 1, '', '', '', 'Cara', '', ''),
(75, 6, 3, '2018-04-18', 0, 0, '', '', '', '', '', ''),
(76, 6, 3, '2018-04-18', 0, 1, '', '', '', '', '', ''),
(78, 7, 3, '2018-04-18', 0, 1, '', '', '', '', '', ''),
(91, 8, 3, '2018-04-20', 0, 1, '', '', '', 'deliveryAddress', 'deliveryZipCode', 'deliveryLocation'),
(92, 3, 3, '2018-04-20', 0, 1, '', '', '', 'Cara Dusana 16a', '2600', 'Pancevo'),
(104, 3, 26, '2018-04-22', 0, 0, '', '', '', 'Adresa isporuke', '26000', 'Mesto isporuke'),
(107, 5, 26, '2018-04-22', 0, 0, '', '', '', 'Adresa isporuke 2', '25000 2', 'Mesto isporuke 2'),
(113, 11, 26, '2018-04-24', 0, 0, '', '', '', 'Adresa', '24000', 'Pančevo'),
(114, 11, 3, '2018-04-24', 0, 1, 'deliverrrrrrry', '', '', 'Adresa', '24000', 'Pančevo'),
(144, 1, 26, '2018-04-25', 0, 0, '', '', '', 'adresa', 'adresa broj', 'mesto'),
(145, 1, 26, '2018-04-25', 0, 0, '', '', '', 'adresa', 'pos broj', 'mesto isp'),
(147, 1, 26, '2018-04-25', 0, 1, '', '', '', 'adresa', 'pos broj', 'mesto'),
(149, 2, 3, '2018-04-25', 0, 1, '', '', '', 'Cara Dusana 16a', '26000', 'Pancevo'),
(150, 1, 3, '2018-04-25', 0, 1, '', '', '', 'adresa', 'po', 'me'),
(151, 10, 3, '2018-04-25', 0, 1, '', '', '', 'adresa', 'm', 'm'),
(167, 2, 3, '2018-04-25', 0, 0, '', '', '', 'Cara Dusana 16a', '26000', 'Pancevo'),
(168, 4, 3, '2018-04-25', 0, 1, 'Tijanaaaana', 'tichko@yahoo.com', '5', 'Adresa ', '26000', 'Pančevo'),
(169, 1, 26, '2018-05-08', 0, 0, NULL, NULL, '', 'Adresa isporuke', '00329032', 'mesto isprotuke'),
(170, 1, 26, '2018-05-08', 0, 0, NULL, NULL, '', 'k', 'k', 'k'),
(171, 2, 3, '2018-05-08', 0, 1, NULL, NULL, '', 'k', 'k', 'k'),
(172, 11, 3, '2018-05-19', 0, 0, 'deliverrrrrrry update', NULL, '', 'Adresa', '24000', 'Pančevo'),
(173, 2, 3, '2018-05-20', 0, 0, 'ime', NULL, '', 'Cara Dusana 16a', '26000', 'Pancevo'),
(174, 2, 3, '2018-05-20', 0, 0, 'tijana', NULL, '', 'Cara Dusana 16a', '26000', 'Pancevo'),
(178, 10, 26, '2018-05-30', 0, 0, 'a', NULL, '', 'a', 'a', 'a'),
(182, 9, 3, '2018-05-30', 0, 0, 'dd', 'bb', '', 'aa', 'ee', 'cc'),
(183, 9, 26, '2018-05-30', 0, 0, 'tijana', NULL, '', 'adresa', 'pos', 'me'),
(192, 9, 26, '2018-06-02', 0, 0, 'Tijana', 'Email', '321432', 'Adresa isporuke1', 'POstanski broj isporuke1', 'Mesto isporuke1'),
(193, 9, 26, '2018-06-02', 0, 0, 'a', 'a', 'a', 'a', 'a', 'a'),
(194, 2, 26, '2018-06-02', 0, 0, 'a', 'aa', 'aa', 'a', 'a', 'a'),
(195, 2, 26, '2018-06-02', 0, 0, 'a', 'a', 'a', 'a', 'a', 'a'),
(198, 1, 26, '2018-06-03', 0, 0, 'a', 'a', 'a', 'a', 'a', 'a'),
(199, 1, 3, '2018-06-03', 0, 0, 'a', 'aa', 'a', 'a', 'a', 'a'),
(200, 1, 3, '2018-07-30', 0, 0, 'opopšpšpšććš', 'ćšćš', 'šććššć', 'pšpš', 'pšpš', 'pšpšpš'),
(207, 3, 26, '2018-07-30', 0, 0, 'a', 'a', 'a', 'a', 'a', 'a'),
(208, 11, 26, '2018-07-31', 0, 0, 'a', 'a', 'a', 'a', 'a', 'a'),
(209, 11, 26, '2018-07-31', 0, 0, 'a', 'aa', 'aa', 'a', 'a', 'a'),
(212, 6, 26, '2018-07-31', 0, 0, 'a', 'a', 'aa', 'a', 'a', 'a'),
(213, 10, 26, '2018-08-01', 0, 0, 'aa', 'a', 'a', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `ordertypes`
--

DROP TABLE IF EXISTS `ordertypes`;
CREATE TABLE IF NOT EXISTS `ordertypes` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordertypes`
--

INSERT INTO `ordertypes` (`ID`, `Name`) VALUES
(1, 'Stampanje'),
(2, 'Blok'),
(3, 'Nalog za uplatu'),
(4, 'Nalog za isplatu'),
(5, 'Nalog za prenos'),
(6, 'Koverta sa povratnicom'),
(7, 'Dostavnica'),
(8, 'Koverta sa dostavnicom'),
(9, 'Formular za adresiranje'),
(10, 'Standardna koverta'),
(11, 'Omot spisa');

-- --------------------------------------------------------

--
-- Table structure for table `prenos`
--

DROP TABLE IF EXISTS `prenos`;
CREATE TABLE IF NOT EXISTS `prenos` (
  `OrderID` int(11) NOT NULL,
  `Name` varchar(1000) DEFAULT NULL,
  `Address` varchar(1000) DEFAULT NULL,
  `Location` varchar(1000) DEFAULT NULL,
  `Country` varchar(1000) DEFAULT NULL,
  `PaymentPurpose` varchar(1000) DEFAULT NULL,
  `Recipient` varchar(1000) DEFAULT NULL,
  `PaymentCode` varchar(255) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `OrdererAccount` varchar(255) DEFAULT NULL,
  `ModelDebit` varchar(255) DEFAULT NULL,
  `ReferenceNumber` varchar(255) DEFAULT NULL,
  `RecipientAccount` varchar(255) DEFAULT NULL,
  `ModelApproval` varchar(255) DEFAULT NULL,
  `ReferenceNumberApprovals` varchar(255) DEFAULT NULL,
  `PaymentSlipNumber` varchar(20) DEFAULT NULL,
  `SetQuantity` varchar(20) DEFAULT NULL,
  `Comment` varchar(1000) DEFAULT NULL,
  `VariableData` tinyint(1) NOT NULL DEFAULT '0',
  `SendCopy` tinyint(1) NOT NULL DEFAULT '0',
  KEY `prenos_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prenos`
--

INSERT INTO `prenos` (`OrderID`, `Name`, `Address`, `Location`, `Country`, `PaymentPurpose`, `Recipient`, `PaymentCode`, `Currency`, `Amount`, `OrdererAccount`, `ModelDebit`, `ReferenceNumber`, `RecipientAccount`, `ModelApproval`, `ReferenceNumberApprovals`, `PaymentSlipNumber`, `SetQuantity`, `Comment`, `VariableData`, `SendCopy`) VALUES
(74, 'Tijana Kostic', 'Cara', 'Pancevo', 'Republika Srbija', 'Purpose', 'Tijana', '9898', 'RSD', 432, NULL, '998', NULL, NULL, NULL, NULL, '1+2', '1800', NULL, 1, 0),
(107, 'Tijana Kostić', 'Cara Dušana 16a', '26000 Pančevo', 'Republika Srbija', 'Svrha uplate', 'primalac1 ', '89', 'RSD', 3921, '48392-432892-321', '99', '99-44444-44', '3333-333333-3333', NULL, '99-000000-0000', '1+2', '8100', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `prenosorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `prenosorder`;
CREATE TABLE IF NOT EXISTS `prenosorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Name` varchar(1000)
,`Address` varchar(1000)
,`Location` varchar(1000)
,`Country` varchar(1000)
,`PaymentPurpose` varchar(1000)
,`Recipient` varchar(1000)
,`PaymentCode` varchar(255)
,`Currency` varchar(10)
,`Amount` int(11)
,`OrdererAccount` varchar(255)
,`ModelDebit` varchar(255)
,`ReferenceNumber` varchar(255)
,`RecipientAccount` varchar(255)
,`ModelApproval` varchar(255)
,`ReferenceNumberApprovals` varchar(255)
,`PaymentSlipNumber` varchar(20)
,`SetQuantity` varchar(20)
,`Comment` varchar(1000)
,`VariableData` tinyint(1)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `stampanje`
--

DROP TABLE IF EXISTS `stampanje`;
CREATE TABLE IF NOT EXISTS `stampanje` (
  `OrderID` int(11) NOT NULL,
  `FileName` varchar(1000) NOT NULL,
  `CopyNumber` tinyint(4) NOT NULL,
  `PageOrder` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `PagePrintType` varchar(255) NOT NULL,
  `PaperSize` varchar(255) NOT NULL,
  `PaperWidth` varchar(255) NOT NULL,
  `BindingType` varchar(255) NOT NULL,
  `BindingFile` varchar(255) DEFAULT NULL,
  `HeftingType` varchar(255) NOT NULL,
  `DrillingType` varchar(255) NOT NULL,
  `Comment` varchar(1000) DEFAULT NULL,
  `SendCopy` tinyint(1) DEFAULT '0',
  KEY `stampanje_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stampanje`
--

INSERT INTO `stampanje` (`OrderID`, `FileName`, `CopyNumber`, `PageOrder`, `Color`, `PagePrintType`, `PaperSize`, `PaperWidth`, `BindingType`, `BindingFile`, `HeftingType`, `DrillingType`, `Comment`, `SendCopy`) VALUES
(145, 'KosticTijana.pdf', 12, '1,2,3; 1,2,3; 1,2,3', 'Crno-belo', 'Jednostrano', 'A4', '80gr/m2', 'Tvrdo koricenje', 'KosticZoranaCV.pdf', 'Gore levo', 'Dve rupe za registrator levo', NULL, 0),
(147, 'KosticTijana.pdf', 1, '1,2,3; 1,2,3; 1,2,3', 'U boji', 'Jednostrano', 'A4', '80gr/m2', 'Plasticnom spiralom', '', 'Gore levo', 'Dve rupe za registrator levo', NULL, 0),
(150, 'KosticTijana.pdf', 5, '1,2,3; 1,2,3; 1,2,3', 'U boji', 'Jednostrano', 'A4', '100gr/m2', 'Plasticnom spiralom', '', 'Gore desno', 'Dve rupe za registrator desno', 'Tijana', 1),
(169, 'KosticTijana.pdf', 2, '1,1,1; 2,2,2; 3,3,3', 'Crno-belo', 'Jednostrano', 'A3', '80gr/m2', 'Plasticnom spiralom', '', 'Gore levo', 'Dve rupe za registrator levo', 'komentar korisnika', 0),
(170, 'KosticTijana.pdf', 1, '1,2,3; 1,2,3; 1,2,3', 'Crno-belo', 'Jednostrano', 'A4', '80gr/m2', 'Plasticnom spiralom', '', 'Gore levo', 'Dve rupe za registrator levo', 'k', 0),
(198, 'KosticTijana.pdf', 1, '1,2,3; 1,2,3; 1,2,3', 'Crno-belo', 'Jednostrano', 'A4', '80gr/m2', 'Plasticnom spiralom', 'KosticZoranaCV.pdf', 'Gore levo', 'Dve rupe za registrator levo', NULL, 0),
(199, 'KosticTijana.pdf', 1, '1,2,3; 1,2,3; 1,2,3', 'Crno-belo', 'Jednostrano', 'A4', '80gr/m2', 'Plasticnom spiralom', 'KosticZoranaCV.pdf', 'Gore levo', 'Dve rupe za registrator levo', NULL, 0),
(200, 'nalog-za-uplatunj.jpg', 1, '1,2,3; 1,2,3; 1,2,3', 'Crno-belo', 'Jednostrano', 'A4', '80gr/m2', 'Plasticnom spiralom', '', 'Gore levo', 'Dve rupe za registrator levo', NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stampanjeorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `stampanjeorder`;
CREATE TABLE IF NOT EXISTS `stampanjeorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`FileName` varchar(1000)
,`CopyNumber` tinyint(4)
,`PageOrder` varchar(255)
,`Color` varchar(255)
,`PagePrintType` varchar(255)
,`PaperSize` varchar(255)
,`PaperWidth` varchar(255)
,`BindingType` varchar(255)
,`BindingFile` varchar(255)
,`HeftingType` varchar(255)
,`DrillingType` varchar(255)
,`Comment` varchar(1000)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `standardne-koverte`
--

DROP TABLE IF EXISTS `standardne-koverte`;
CREATE TABLE IF NOT EXISTS `standardne-koverte` (
  `OrderID` int(11) NOT NULL,
  `Size` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `BackPrintRow1` varchar(255) DEFAULT NULL,
  `BackPrintRow2` varchar(255) DEFAULT NULL,
  `BackPrintRow3` varchar(255) DEFAULT NULL,
  `BackPrintRow4` varchar(255) DEFAULT NULL,
  `AddressPrintRow1` varchar(255) DEFAULT NULL,
  `AddressPrintRow2` varchar(255) DEFAULT NULL,
  `AddressPrintRow3` varchar(255) DEFAULT NULL,
  `AddressPrintRow4` varchar(255) DEFAULT NULL,
  `Comment` varchar(1000) DEFAULT NULL,
  `VariableData` tinyint(1) NOT NULL DEFAULT '0',
  `SendCopy` tinyint(1) DEFAULT NULL,
  KEY `st-koverte_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `standardne-koverte`
--

INSERT INTO `standardne-koverte` (`OrderID`, `Size`, `Quantity`, `BackPrintRow1`, `BackPrintRow2`, `BackPrintRow3`, `BackPrintRow4`, `AddressPrintRow1`, `AddressPrintRow2`, `AddressPrintRow3`, `AddressPrintRow4`, `Comment`, `VariableData`, `SendCopy`) VALUES
(151, 'C4', 2000, 'prvi', '', '', '', '', '', '', '', NULL, 1, 0),
(178, 'B6', 1000, '', '', '', '', '', '', '', '', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `standardnekoverteorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `standardnekoverteorder`;
CREATE TABLE IF NOT EXISTS `standardnekoverteorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Size` varchar(255)
,`Quantity` int(11)
,`BackPrintRow1` varchar(255)
,`BackPrintRow2` varchar(255)
,`BackPrintRow3` varchar(255)
,`BackPrintRow4` varchar(255)
,`AddressPrintRow1` varchar(255)
,`AddressPrintRow2` varchar(255)
,`AddressPrintRow3` varchar(255)
,`AddressPrintRow4` varchar(255)
,`Comment` varchar(1000)
,`VariableData` tinyint(1)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `uplate-isplate`
--

DROP TABLE IF EXISTS `uplate-isplate`;
CREATE TABLE IF NOT EXISTS `uplate-isplate` (
  `OrderID` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Name` varchar(1000) DEFAULT NULL,
  `Address` varchar(1000) DEFAULT NULL,
  `Location` varchar(1000) DEFAULT NULL,
  `Country` varchar(1000) DEFAULT NULL,
  `PaymentPurpose` varchar(1000) DEFAULT NULL,
  `Recipient` varchar(1000) DEFAULT NULL,
  `PaymentCode` varchar(255) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `RecipientAccount` varchar(255) DEFAULT NULL,
  `Model` varchar(255) DEFAULT NULL,
  `ReferenceNumber` varchar(255) DEFAULT NULL,
  `PaymentSlipNumber` varchar(20) DEFAULT NULL,
  `SetQuantity` varchar(20) DEFAULT NULL,
  `Comment` varchar(1000) DEFAULT NULL,
  `VariableData` tinyint(1) NOT NULL DEFAULT '0',
  `SendCopy` tinyint(1) NOT NULL DEFAULT '0',
  KEY `uplate_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uplate-isplate`
--

INSERT INTO `uplate-isplate` (`OrderID`, `Type`, `Name`, `Address`, `Location`, `Country`, `PaymentPurpose`, `Recipient`, `PaymentCode`, `Currency`, `Amount`, `RecipientAccount`, `Model`, `ReferenceNumber`, `PaymentSlipNumber`, `SetQuantity`, `Comment`, `VariableData`, `SendCopy`) VALUES
(92, 'Uplata', NULL, NULL, NULL, NULL, NULL, 'Tijjana', NULL, 'RSD', NULL, NULL, NULL, NULL, '1+2', '1800', 'komentar', 1, 0),
(104, 'Uplata', 'Tijana Kostić', 'Cara Dušana 16a', '26000 Pančevo', 'Srbija', 'Svrha uplate', 'Primalac', '839', 'RSD', 320, '650-43283-89', '89', '98-321-32131', '1+1', '900', NULL, 1, 0),
(168, 'Isplata', 'Tijana Kostić', 'Cara Dušana 16a', 'Pančevo', 'Republika Srbija', 'Svrha', 'primac', '98', 'RSD', 4343, '986d8767868', '98', '9867756', '1+2', '8100', NULL, 1, 1),
(207, 'Uplata', 'Tijana Kostić', 'Cara Dušana 16a', '26000 Pančevo', 'Republika Srbija', 'Svrha uplate je ta i ta', 'Narodna Banka Srbije', '989', 'RSD', 3335, '840-342342-932472938', '348', '43', '1+1', '900', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `uplateisplateorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `uplateisplateorder`;
CREATE TABLE IF NOT EXISTS `uplateisplateorder` (
`UserID` int(11)
,`OrderDate` date
,`Seen` tinyint(1)
,`SavedOrder` tinyint(1)
,`DeliveryName` varchar(255)
,`DeliveryEmail` varchar(255)
,`DeliveryPhone` varchar(255)
,`DeliveryAddress` varchar(255)
,`DeliveryZipCode` varchar(255)
,`DeliveryLocation` varchar(255)
,`OrderID` int(11)
,`Type` varchar(255)
,`Name` varchar(1000)
,`Address` varchar(1000)
,`Location` varchar(1000)
,`Country` varchar(1000)
,`PaymentPurpose` varchar(1000)
,`Recipient` varchar(1000)
,`PaymentCode` varchar(255)
,`Currency` varchar(10)
,`Amount` int(11)
,`RecipientAccount` varchar(255)
,`Model` varchar(255)
,`ReferenceNumber` varchar(255)
,`PaymentSlipNumber` varchar(20)
,`SetQuantity` varchar(20)
,`Comment` varchar(1000)
,`VariableData` tinyint(1)
,`SendCopy` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Role` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `Password`, `Role`) VALUES
(3, 'tijjana@hotmail.com', 'tijana123', 2),
(21, 'zorana@hotmail.com', 'chadmajkl', 2),
(22, 'tichko@yahoo.com', 'chadmajkl', 2),
(24, 'admin@hotmail.com', 'admin', 1),
(26, 'Neregistrovan korisnik', 'neregistrovan', 3);

-- --------------------------------------------------------

--
-- Structure for view `blokoviorder`
--
DROP TABLE IF EXISTS `blokoviorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `blokoviorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`FileName` AS `FileName`,`b`.`NumberOfSet` AS `NumberOfSet`,`b`.`Color` AS `Color`,`b`.`Size` AS `Size`,`b`.`Packing` AS `Packing`,`b`.`Comment` AS `Comment`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `blokovi` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `dostavniceorder`
--
DROP TABLE IF EXISTS `dostavniceorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dostavniceorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Recipient` AS `Recipient`,`b`.`Name` AS `Name`,`b`.`Address` AS `Address`,`b`.`ZipCode` AS `ZipCode`,`b`.`Location` AS `Location`,`b`.`Quantity` AS `Quantity`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `dostavnice` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `formulariorder`
--
DROP TABLE IF EXISTS `formulariorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `formulariorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Quantity` AS `Quantity`,`b`.`Type` AS `Type`, `b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `formulari-za-adresiranje` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `kovertesadostavnicomorder`
--
DROP TABLE IF EXISTS `kovertesadostavnicomorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kovertesadostavnicomorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Recipient` AS `Recipient`,`b`.`Color` AS `Color`,`b`.`Name` AS `Name`,`b`.`Address` AS `Address`,`b`.`ZipCode` AS `ZipCode`,`b`.`Location` AS `Location`,`b`.`PostagePaid` AS `PostagePaid`,`b`.`EnvelopeType` AS `EnvelopeType`,`b`.`Quantity` AS `Quantity`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `koverte-sa-dostavnicom` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `kovertesapovratnicomorder`
--
DROP TABLE IF EXISTS `kovertesapovratnicomorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kovertesapovratnicomorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Color` AS `Color`,`b`.`Quantity` AS `Quantity`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `koverte-sa-povratnicom` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `omotispisaorder`
--
DROP TABLE IF EXISTS `omotispisaorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omotispisaorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Recipient` AS `Recipient`,`b`.`Name` AS `Name`,`b`.`Address` AS `Address`,`b`.`Location` AS `Location`,`b`.`PaperType` AS `PaperType`,`b`.`Quantity` AS `Quantity`,`b`.`Comment` AS `Comment`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `omot-spisa` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `prenosorder`
--
DROP TABLE IF EXISTS `prenosorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prenosorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Name` AS `Name`,`b`.`Address` AS `Address`,`b`.`Location` AS `Location`,`b`.`Country` AS `Country`,`b`.`PaymentPurpose` AS `PaymentPurpose`,`b`.`Recipient` AS `Recipient`,`b`.`PaymentCode` AS `PaymentCode`,`b`.`Currency` AS `Currency`,`b`.`Amount` AS `Amount`,`b`.`OrdererAccount` AS `OrdererAccount`,`b`.`ModelDebit` AS `ModelDebit`,`b`.`ReferenceNumber` AS `ReferenceNumber`,`b`.`RecipientAccount` AS `RecipientAccount`,`b`.`ModelApproval` AS `ModelApproval`,`b`.`ReferenceNumberApprovals` AS `ReferenceNumberApprovals`,`b`.`PaymentSlipNumber` AS `PaymentSlipNumber`,`b`.`SetQuantity` AS `SetQuantity`,`b`.`Comment` AS `Comment`,`b`.`VariableData` AS `VariableData`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `prenos` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `stampanjeorder`
--
DROP TABLE IF EXISTS `stampanjeorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stampanjeorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`FileName` AS `FileName`,`b`.`CopyNumber` AS `CopyNumber`,`b`.`PageOrder` AS `PageOrder`,`b`.`Color` AS `Color`,`b`.`PagePrintType` AS `PagePrintType`,`b`.`PaperSize` AS `PaperSize`,`b`.`PaperWidth` AS `PaperWidth`,`b`.`BindingType` AS `BindingType`,`b`.`BindingFile` AS `BindingFile`,`b`.`HeftingType` AS `HeftingType`,`b`.`DrillingType` AS `DrillingType`,`b`.`Comment` AS `Comment`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `stampanje` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `standardnekoverteorder`
--
DROP TABLE IF EXISTS `standardnekoverteorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `standardnekoverteorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Size` AS `Size`,`b`.`Quantity` AS `Quantity`,`b`.`BackPrintRow1` AS `BackPrintRow1`,`b`.`BackPrintRow2` AS `BackPrintRow2`,`b`.`BackPrintRow3` AS `BackPrintRow3`,`b`.`BackPrintRow4` AS `BackPrintRow4`,`b`.`AddressPrintRow1` AS `AddressPrintRow1`,`b`.`AddressPrintRow2` AS `AddressPrintRow2`,`b`.`AddressPrintRow3` AS `AddressPrintRow3`,`b`.`AddressPrintRow4` AS `AddressPrintRow4`,`b`.`Comment` AS `Comment`,`b`.`VariableData` AS `VariableData`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `standardne-koverte` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `uplateisplateorder`
--
DROP TABLE IF EXISTS `uplateisplateorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `uplateisplateorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`o`.`Seen` AS `Seen`,`o`.`SavedOrder` AS `SavedOrder`,`o`.`DeliveryName` AS `DeliveryName`,`o`.`DeliveryEmail` AS `DeliveryEmail`,`o`.`DeliveryPhone` AS `DeliveryPhone`,`o`.`DeliveryAddress` AS `DeliveryAddress`,`o`.`DeliveryZipCode` AS `DeliveryZipCode`,`o`.`DeliveryLocation` AS `DeliveryLocation`,`b`.`OrderID` AS `OrderID`,`b`.`Type` AS `Type`,`b`.`Name` AS `Name`,`b`.`Address` AS `Address`,`b`.`Location` AS `Location`,`b`.`Country` AS `Country`,`b`.`PaymentPurpose` AS `PaymentPurpose`,`b`.`Recipient` AS `Recipient`,`b`.`PaymentCode` AS `PaymentCode`,`b`.`Currency` AS `Currency`,`b`.`Amount` AS `Amount`,`b`.`RecipientAccount` AS `RecipientAccount`,`b`.`Model` AS `Model`,`b`.`ReferenceNumber` AS `ReferenceNumber`,`b`.`PaymentSlipNumber` AS `PaymentSlipNumber`,`b`.`SetQuantity` AS `SetQuantity`,`b`.`Comment` AS `Comment`,`b`.`VariableData` AS `VariableData`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `uplate-isplate` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blokovi`
--
ALTER TABLE `blokovi`
  ADD CONSTRAINT `blokovi_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `dostavnice`
--
ALTER TABLE `dostavnice`
  ADD CONSTRAINT `dostavnica_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `formulari-za-adresiranje`
--
ALTER TABLE `formulari-za-adresiranje`
  ADD CONSTRAINT `formulari_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `koverte-sa-dostavnicom`
--
ALTER TABLE `koverte-sa-dostavnicom`
  ADD CONSTRAINT `kov-sa-dos_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `koverte-sa-povratnicom`
--
ALTER TABLE `koverte-sa-povratnicom`
  ADD CONSTRAINT `kov-sa-pov_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `omot-spisa`
--
ALTER TABLE `omot-spisa`
  ADD CONSTRAINT `omot-spisa_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_type_fk` FOREIGN KEY (`TypeID`) REFERENCES `ordertypes` (`ID`),
  ADD CONSTRAINT `orders_user_fk` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `prenos`
--
ALTER TABLE `prenos`
  ADD CONSTRAINT `prenos_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `stampanje`
--
ALTER TABLE `stampanje`
  ADD CONSTRAINT `stampanje_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `standardne-koverte`
--
ALTER TABLE `standardne-koverte`
  ADD CONSTRAINT `st-koverte_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);

--
-- Constraints for table `uplate-isplate`
--
ALTER TABLE `uplate-isplate`
  ADD CONSTRAINT `uplate_orders_fk` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`ID`);
--