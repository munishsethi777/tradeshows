-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2019 at 08:48 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpinetradeshows`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemspecifications`
--

CREATE TABLE `itemspecifications` (
  `seq` bigint(20) NOT NULL,
  `itemseq` bigint(20) NOT NULL,
  `oms` varchar(10) DEFAULT NULL,
  `item1description` varchar(2500) DEFAULT NULL,
  `item1length` double DEFAULT NULL,
  `item1width` double DEFAULT NULL,
  `item1height` double DEFAULT NULL,
  `item2description` varchar(2500) DEFAULT NULL,
  `item2length` double DEFAULT NULL,
  `item2width` double DEFAULT NULL,
  `item2height` double DEFAULT NULL,
  `item3description` double DEFAULT NULL,
  `item3length` double DEFAULT NULL,
  `item3width` double DEFAULT NULL,
  `item3height` double DEFAULT NULL,
  `mastercarton1length` double DEFAULT NULL,
  `mastercarton1width` double DEFAULT NULL,
  `mastercarton1height` double DEFAULT NULL,
  `mastercarton2length` double DEFAULT NULL,
  `mastercarton2width` double DEFAULT NULL,
  `mastercarton2height` double DEFAULT NULL,
  `msdescription` varchar(2500) DEFAULT NULL,
  `port` varchar(50) DEFAULT NULL,
  `countryoforigin` varchar(50) DEFAULT NULL,
  `material1` varchar(25) DEFAULT NULL,
  `material1percent` int(11) DEFAULT NULL,
  `material2` varchar(25) DEFAULT NULL,
  `material2percent` int(11) DEFAULT NULL,
  `material3` varchar(25) DEFAULT NULL,
  `material3percent` int(11) DEFAULT NULL,
  `material4` varchar(25) DEFAULT NULL,
  `material4percent` int(11) DEFAULT NULL,
  `material5` varchar(25) DEFAULT NULL,
  `material5percent` int(11) DEFAULT NULL,
  `materialtotalpercent` int(11) DEFAULT NULL,
  `haslight` tinyint(4) DEFAULT NULL,
  `lighttype` varchar(10) DEFAULT NULL,
  `totallumens` varchar(250) DEFAULT NULL,
  `hasbattery` tinyint(4) DEFAULT NULL,
  `batteryquantity` int(11) DEFAULT NULL,
  `batterytype` varchar(50) DEFAULT NULL,
  `haselectricity` tinyint(4) DEFAULT NULL,
  `electricitytype` varchar(50) DEFAULT NULL,
  `cordlengthfeet` varchar(20) DEFAULT NULL,
  `hasassembly` tinyint(4) DEFAULT NULL,
  `manualpath` varchar(500) DEFAULT NULL,
  `part1` varchar(1000) DEFAULT NULL,
  `part2` varchar(1000) DEFAULT NULL,
  `part3` varchar(1000) DEFAULT NULL,
  `part4` varchar(1000) DEFAULT NULL,
  `part5` varchar(1000) DEFAULT NULL,
  `cordlengthmeter` varchar(25) DEFAULT NULL,
  `pumpwattage` varchar(25) DEFAULT NULL,
  `pumpvolts` varchar(25) DEFAULT NULL,
  `pumpcordlength` varchar(25) DEFAULT NULL,
  `transformerwattage` varchar(25) DEFAULT NULL,
  `transformervolts` varchar(25) DEFAULT NULL,
  `transformercordlength` varchar(25) DEFAULT NULL,
  `watercapacity` varchar(25) DEFAULT NULL,
  `feature1` varchar(1000) DEFAULT NULL,
  `feature2` varchar(1000) DEFAULT NULL,
  `feature3` varchar(1000) DEFAULT NULL,
  `feature4` varchar(1000) DEFAULT NULL,
  `feature5` varchar(1000) DEFAULT NULL,
  `feature6` varchar(1000) DEFAULT NULL,
  `feature7` varchar(1000) DEFAULT NULL,
  `updatedby` varchar(100) DEFAULT NULL,
  `troy` varchar(10) DEFAULT NULL,
  `userseq` bigint(20) NOT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemspecifications`
--
ALTER TABLE `itemspecifications`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemspecifications`
--
ALTER TABLE `itemspecifications`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
