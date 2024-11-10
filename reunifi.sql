-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2024 at 09:15 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reunifi`
--
CREATE DATABASE IF NOT EXISTS `reunifi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `reunifi`;

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE IF NOT EXISTS `auth` (
  `AID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `seeker` int UNSIGNED NOT NULL,
  `usrnm` text COLLATE utf8mb4_general_ci NOT NULL,
  `pswd` text COLLATE utf8mb4_general_ci NOT NULL,
  `iscaseworker` tinyint(1) NOT NULL,
  PRIMARY KEY (`AID`),
  UNIQUE KEY `AID` (`AID`),
  KEY `seeker` (`seeker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

DROP TABLE IF EXISTS `cases`;
CREATE TABLE IF NOT EXISTS `cases` (
  `CID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`CID`),
  UNIQUE KEY `FID` (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases.emails`
--

DROP TABLE IF EXISTS `cases.emails`;
CREATE TABLE IF NOT EXISTS `cases.emails` (
  `EID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `caseId` int UNSIGNED NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`EID`),
  KEY `caseId` (`caseId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases.found`
--

DROP TABLE IF EXISTS `cases.found`;
CREATE TABLE IF NOT EXISTS `cases.found` (
  `FID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `caseId` int UNSIGNED NOT NULL,
  `location` text COLLATE utf8mb4_general_ci NOT NULL,
  `timefound` datetime NOT NULL,
  `foundby` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`FID`),
  KEY `caseId` (`caseId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases.lka`
--

DROP TABLE IF EXISTS `cases.lka`;
CREATE TABLE IF NOT EXISTS `cases.lka` (
  `KID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `caseId` int UNSIGNED NOT NULL,
  `street1` text COLLATE utf8mb4_general_ci NOT NULL,
  `street2` text COLLATE utf8mb4_general_ci NOT NULL,
  `city` text COLLATE utf8mb4_general_ci NOT NULL,
  `state` text COLLATE utf8mb4_general_ci NOT NULL,
  `zip` text COLLATE utf8mb4_general_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`KID`),
  KEY `caseId` (`caseId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases.names`
--

DROP TABLE IF EXISTS `cases.names`;
CREATE TABLE IF NOT EXISTS `cases.names` (
  `NID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `caseId` int UNSIGNED NOT NULL,
  `fname` text COLLATE utf8mb4_general_ci,
  `mname` text COLLATE utf8mb4_general_ci,
  `lname` text COLLATE utf8mb4_general_ci,
  `suffix` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`NID`),
  KEY `caseId` (`caseId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases.phones`
--

DROP TABLE IF EXISTS `cases.phones`;
CREATE TABLE IF NOT EXISTS `cases.phones` (
  `PID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `caseId` int UNSIGNED NOT NULL,
  `country` text COLLATE utf8mb4_general_ci,
  `area` text COLLATE utf8mb4_general_ci,
  `prefix` text COLLATE utf8mb4_general_ci,
  `line` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`PID`),
  KEY `caseId` (`caseId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `found.dob`
--

DROP TABLE IF EXISTS `found.dob`;
CREATE TABLE IF NOT EXISTS `found.dob` (
  `DID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `caseId` int UNSIGNED NOT NULL,
  `month` int DEFAULT NULL,
  `day` int DEFAULT NULL,
  `year` int DEFAULT NULL,
  PRIMARY KEY (`DID`),
  KEY `caseId` (`caseId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mycases`
--

DROP TABLE IF EXISTS `mycases`;
CREATE TABLE IF NOT EXISTS `mycases` (
  `MID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `seekerId` int UNSIGNED NOT NULL,
  `caseId` int UNSIGNED NOT NULL,
  PRIMARY KEY (`MID`),
  UNIQUE KEY `MID` (`MID`),
  KEY `seekerId` (`seekerId`,`caseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seekers`
--

DROP TABLE IF EXISTS `seekers`;
CREATE TABLE IF NOT EXISTS `seekers` (
  `SID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `seeker` text COLLATE utf8mb4_general_ci NOT NULL,
  `phone` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`SID`),
  UNIQUE KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
