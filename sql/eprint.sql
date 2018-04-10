-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2018 at 05:59 AM
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

INSERT INTO `blokovi` (`OrderID`, `FileName`, `Color`, `Size`, `Packing`, `Comment`, `SendCopy`) VALUES
(2, 'ime fajla', 'Plavo belo', 'A5', 'Heftanjem levo', NULL, 0),
(2, 'ime fajla2', 'Plavo belo', 'A4', 'Heftanjem desno', NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `blokoviorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `blokoviorder`;
CREATE TABLE IF NOT EXISTS `blokoviorder` (
`UserID` int(11)
,`OrderDate` date
,`OrderID` int(11)
,`FileName` varchar(1000)
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
  `Name` varchar(1000) NOT NULL,
  `ZipCode` int(4) NOT NULL,
  `Location` varchar(1000) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SendCopy` tinyint(1) NOT NULL,
  KEY `dostavnica_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dostavnice`
--

INSERT INTO `dostavnice` (`OrderID`, `Recipient`, `Name`, `ZipCode`, `Location`, `Quantity`, `SendCopy`) VALUES
(2, 'Javni beleznik', 'Zorana Kostic', 26000, '26000', 1000, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dostavniceorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `dostavniceorder`;
CREATE TABLE IF NOT EXISTS `dostavniceorder` (
`UserID` int(11)
,`OrderDate` date
,`OrderID` int(11)
,`Recipient` varchar(255)
,`Name` varchar(1000)
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
  KEY `formulari_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formulari-za-adresiranje`
--

INSERT INTO `formulari-za-adresiranje` (`OrderID`, `Quantity`) VALUES
(2, 1000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `formulariorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `formulariorder`;
CREATE TABLE IF NOT EXISTS `formulariorder` (
`UserID` int(11)
,`OrderDate` date
,`OrderID` int(11)
,`Quantity` int(11)
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
  `Name` varchar(1000) NOT NULL,
  `Address` varchar(1000) NOT NULL,
  `ZipCode` int(11) NOT NULL,
  `Location` varchar(1000) NOT NULL,
  `PostagePaid` varchar(1000) NOT NULL,
  `EnvelopeType` varchar(10) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SendCopy` tinyint(1) NOT NULL,
  KEY `kov-sa-dos_orders_fk` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `koverte-sa-dostavnicom`
--

INSERT INTO `koverte-sa-dostavnicom` (`OrderID`, `Recipient`, `Color`, `Name`, `Address`, `ZipCode`, `Location`, `PostagePaid`, `EnvelopeType`, `Quantity`, `SendCopy`) VALUES
(2, 'Javni izvrsitelj', 'Plave', 'Zorana Kostic', 'Adresa', 26000, 'Cara Dusana 16a', 'Posta', 'S0', 1000, 1);

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
(2, 'Bela', 9000, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kovertesadostavnicomorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `kovertesadostavnicomorder`;
CREATE TABLE IF NOT EXISTS `kovertesadostavnicomorder` (
`UserID` int(11)
,`OrderDate` date
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
(2, 'Javni izvrsitelj', 'Zorana Kostic', 'Adresa', NULL, '100 gr/m2', 1000, 'Komentarkomentar...', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `omotispisaorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `omotispisaorder`;
CREATE TABLE IF NOT EXISTS `omotispisaorder` (
`UserID` int(11)
,`OrderDate` date
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
  PRIMARY KEY (`ID`),
  KEY `orders_user_fk` (`UserID`),
  KEY `orders_type_fk` (`TypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `TypeID`, `UserID`, `OrderDate`, `Seen`) VALUES
(1, 1, 3, '2018-04-05', 0),
(2, 2, 21, '2018-04-07', 0),
(3, 3, 22, '2018-04-07', 1);

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
(2, 'Tijana Kostic', NULL, NULL, NULL, NULL, 'Matematicki fakultet', NULL, NULL, 232, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `prenosorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `prenosorder`;
CREATE TABLE IF NOT EXISTS `prenosorder` (
`UserID` int(11)
,`OrderDate` date
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
  `PageOrder` tinyint(4) NOT NULL,
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
(1, 'imefajla', 4, 2, 'Bela', 'Jednostrano', 'A4', '80 gr/m2', 'Plastičnom spiralom', NULL, 'Gore desno', 'Dve rupe za registrator desno', NULL, 1),
(2, 'ime fajla1', 5, 2, 'Crno belo', 'Dvostrano', 'A4', '80 gr/m2', 'Tvrdo koricenje', NULL, 'Dole desno', 'Dve rupe za registrator desno', NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stampanjeorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `stampanjeorder`;
CREATE TABLE IF NOT EXISTS `stampanjeorder` (
`UserID` int(11)
,`OrderDate` date
,`OrderID` int(11)
,`FileName` varchar(1000)
,`CopyNumber` tinyint(4)
,`PageOrder` tinyint(4)
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
(2, 'B6', 2000, 'Prvi red', 'Drugi red', NULL, 'Cetvrti', 'hihihihi', NULL, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `standardnekoverteorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `standardnekoverteorder`;
CREATE TABLE IF NOT EXISTS `standardnekoverteorder` (
`UserID` int(11)
,`OrderDate` date
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
(2, 'Uplata', 'Tijana Kostic', NULL, NULL, NULL, NULL, 'Matematicki fakultet', NULL, NULL, 232, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `uplateisplateorder`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `uplateisplateorder`;
CREATE TABLE IF NOT EXISTS `uplateisplateorder` (
`UserID` int(11)
,`OrderDate` date
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `Password`, `Role`) VALUES
(3, 'tijjana@hotmail.com', 'chadmajkl', 2),
(21, 'zorana@hotmail.com', 'chadmajkl', 2),
(22, 'tichko@yahoo.com', 'chadmajkl', 2);

-- --------------------------------------------------------

--
-- Structure for view `blokoviorder`
--
DROP TABLE IF EXISTS `blokoviorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `blokoviorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`b`.`OrderID` AS `OrderID`,`b`.`FileName` AS `FileName`,`b`.`Color` AS `Color`,`b`.`Size` AS `Size`,`b`.`Packing` AS `Packing`,`b`.`Comment` AS `Comment`,`b`.`SendCopy` AS `SendCopy` from (`orders` `o` join `blokovi` `b` on((`o`.`ID` = `b`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `dostavniceorder`
--
DROP TABLE IF EXISTS `dostavniceorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dostavniceorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`d`.`OrderID` AS `OrderID`,`d`.`Recipient` AS `Recipient`,`d`.`Name` AS `Name`,`d`.`ZipCode` AS `ZipCode`,`d`.`Location` AS `Location`,`d`.`Quantity` AS `Quantity`,`d`.`SendCopy` AS `SendCopy` from (`orders` `o` join `dostavnice` `d` on((`o`.`ID` = `d`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `formulariorder`
--
DROP TABLE IF EXISTS `formulariorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `formulariorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`f`.`OrderID` AS `OrderID`,`f`.`Quantity` AS `Quantity` from (`orders` `o` join `formulari-za-adresiranje` `f` on((`o`.`ID` = `f`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `kovertesadostavnicomorder`
--
DROP TABLE IF EXISTS `kovertesadostavnicomorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kovertesadostavnicomorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`k`.`OrderID` AS `OrderID`,`k`.`Recipient` AS `Recipient`,`k`.`Color` AS `Color`,`k`.`Name` AS `Name`,`k`.`Address` AS `Address`,`k`.`ZipCode` AS `ZipCode`,`k`.`Location` AS `Location`,`k`.`PostagePaid` AS `PostagePaid`,`k`.`EnvelopeType` AS `EnvelopeType`,`k`.`Quantity` AS `Quantity`,`k`.`SendCopy` AS `SendCopy` from (`orders` `o` join `koverte-sa-dostavnicom` `k` on((`o`.`ID` = `k`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `kovertesapovratnicomorder`
--
DROP TABLE IF EXISTS `kovertesapovratnicomorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kovertesapovratnicomorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`k`.`OrderID` AS `OrderID`,`k`.`Color` AS `Color`,`k`.`Quantity` AS `Quantity`,`k`.`SendCopy` AS `SendCopy` from (`orders` `o` join `koverte-sa-povratnicom` `k` on((`o`.`ID` = `k`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `omotispisaorder`
--
DROP TABLE IF EXISTS `omotispisaorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `omotispisaorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`os`.`OrderID` AS `OrderID`,`os`.`Recipient` AS `Recipient`,`os`.`Name` AS `Name`,`os`.`Address` AS `Address`,`os`.`Location` AS `Location`,`os`.`PaperType` AS `PaperType`,`os`.`Quantity` AS `Quantity`,`os`.`Comment` AS `Comment`,`os`.`SendCopy` AS `SendCopy` from (`orders` `o` join `omot-spisa` `os` on((`o`.`ID` = `os`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `prenosorder`
--
DROP TABLE IF EXISTS `prenosorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prenosorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`p`.`OrderID` AS `OrderID`,`p`.`Name` AS `Name`,`p`.`Address` AS `Address`,`p`.`Location` AS `Location`,`p`.`Country` AS `Country`,`p`.`PaymentPurpose` AS `PaymentPurpose`,`p`.`Recipient` AS `Recipient`,`p`.`PaymentCode` AS `PaymentCode`,`p`.`Currency` AS `Currency`,`p`.`Amount` AS `Amount`,`p`.`OrdererAccount` AS `OrdererAccount`,`p`.`ModelDebit` AS `ModelDebit`,`p`.`ReferenceNumber` AS `ReferenceNumber`,`p`.`RecipientAccount` AS `RecipientAccount`,`p`.`ModelApproval` AS `ModelApproval`,`p`.`ReferenceNumberApprovals` AS `ReferenceNumberApprovals`,`p`.`PaymentSlipNumber` AS `PaymentSlipNumber`,`p`.`SetQuantity` AS `SetQuantity`,`p`.`Comment` AS `Comment`,`p`.`VariableData` AS `VariableData`,`p`.`SendCopy` AS `SendCopy` from (`orders` `o` join `prenos` `p` on((`o`.`ID` = `p`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `stampanjeorder`
--
DROP TABLE IF EXISTS `stampanjeorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stampanjeorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`s`.`OrderID` AS `OrderID`,`s`.`FileName` AS `FileName`,`s`.`CopyNumber` AS `CopyNumber`,`s`.`PageOrder` AS `PageOrder`,`s`.`Color` AS `Color`,`s`.`PagePrintType` AS `PagePrintType`,`s`.`PaperSize` AS `PaperSize`,`s`.`PaperWidth` AS `PaperWidth`,`s`.`BindingType` AS `BindingType`,`s`.`BindingFile` AS `BindingFile`,`s`.`HeftingType` AS `HeftingType`,`s`.`DrillingType` AS `DrillingType`,`s`.`Comment` AS `Comment`,`s`.`SendCopy` AS `SendCopy` from (`orders` `o` join `stampanje` `s` on((`o`.`ID` = `s`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `standardnekoverteorder`
--
DROP TABLE IF EXISTS `standardnekoverteorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `standardnekoverteorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`k`.`OrderID` AS `OrderID`,`k`.`Size` AS `Size`,`k`.`Quantity` AS `Quantity`,`k`.`BackPrintRow1` AS `BackPrintRow1`,`k`.`BackPrintRow2` AS `BackPrintRow2`,`k`.`BackPrintRow3` AS `BackPrintRow3`,`k`.`BackPrintRow4` AS `BackPrintRow4`,`k`.`AddressPrintRow1` AS `AddressPrintRow1`,`k`.`AddressPrintRow2` AS `AddressPrintRow2`,`k`.`AddressPrintRow3` AS `AddressPrintRow3`,`k`.`AddressPrintRow4` AS `AddressPrintRow4`,`k`.`Comment` AS `Comment`,`k`.`VariableData` AS `VariableData`,`k`.`SendCopy` AS `SendCopy` from (`orders` `o` join `standardne-koverte` `k` on((`o`.`ID` = `k`.`OrderID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `uplateisplateorder`
--
DROP TABLE IF EXISTS `uplateisplateorder`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `uplateisplateorder`  AS  select `o`.`UserID` AS `UserID`,`o`.`OrderDate` AS `OrderDate`,`ui`.`OrderID` AS `OrderID`,`ui`.`Type` AS `Type`,`ui`.`Name` AS `Name`,`ui`.`Address` AS `Address`,`ui`.`Location` AS `Location`,`ui`.`Country` AS `Country`,`ui`.`PaymentPurpose` AS `PaymentPurpose`,`ui`.`Recipient` AS `Recipient`,`ui`.`PaymentCode` AS `PaymentCode`,`ui`.`Currency` AS `Currency`,`ui`.`Amount` AS `Amount`,`ui`.`RecipientAccount` AS `RecipientAccount`,`ui`.`Model` AS `Model`,`ui`.`ReferenceNumber` AS `ReferenceNumber`,`ui`.`PaymentSlipNumber` AS `PaymentSlipNumber`,`ui`.`SetQuantity` AS `SetQuantity`,`ui`.`Comment` AS `Comment`,`ui`.`VariableData` AS `VariableData`,`ui`.`SendCopy` AS `SendCopy` from (`orders` `o` join `uplate-isplate` `ui` on((`o`.`ID` = `ui`.`OrderID`))) ;

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

