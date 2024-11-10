-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 10, 2024 at 02:24 AM
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
CREATE DATABASE IF NOT EXISTS `reunifi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `reunifi`;

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE IF NOT EXISTS `auth` (
  `AID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `seeker` int UNSIGNED NOT NULL,
  `usrnm` text NOT NULL,
  `pswd` text NOT NULL,
  `iscaseworker` tinyint(1) NOT NULL,
  PRIMARY KEY (`AID`),
  UNIQUE KEY `AID` (`AID`),
  KEY `seeker` (`seeker`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caselink`
--

DROP TABLE IF EXISTS `caselink`;
CREATE TABLE IF NOT EXISTS `caselink` (
  `LID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `a` int UNSIGNED NOT NULL,
  `b` int UNSIGNED NOT NULL,
  `linkedby` text NOT NULL,
  PRIMARY KEY (`LID`),
  UNIQUE KEY `LID` (`LID`),
  KEY `a` (`a`,`b`),
  KEY `b` (`b`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

DROP TABLE IF EXISTS `cases`;
CREATE TABLE IF NOT EXISTS `cases` (
  `CID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` text NOT NULL,
  `mname` text NOT NULL,
  `lname` text NOT NULL,
  `dob` date NOT NULL,
  `lka` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `isfound` tinyint(1) NOT NULL,
  `loc` text NOT NULL,
  `timefound` datetime NOT NULL,
  `finder` text NOT NULL,
  PRIMARY KEY (`CID`),
  UNIQUE KEY `FID` (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seekers`
--

DROP TABLE IF EXISTS `seekers`;
CREATE TABLE IF NOT EXISTS `seekers` (
  `SID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `seeker` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`SID`),
  UNIQUE KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `caselink`
--
ALTER TABLE `caselink`
  ADD CONSTRAINT `caselink_ibfk_1` FOREIGN KEY (`a`) REFERENCES `cases` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caselink_ibfk_2` FOREIGN KEY (`b`) REFERENCES `cases` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
