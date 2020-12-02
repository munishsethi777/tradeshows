-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2020 at 06:41 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpine`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructionmanuallogs`
--

CREATE TABLE `instructionmanuallogs` (
  `seq` bigint(20) NOT NULL,
  `poshipdate` date DEFAULT NULL,
  `approvedmanualdueprintdate` date DEFAULT NULL,
  `itemnumber` varchar(50) DEFAULT NULL,
  `classcodeseq` bigint(20) DEFAULT NULL,
  `graphicduedate` date DEFAULT NULL,
  `neworrevised` varchar(100) DEFAULT NULL,
  `instructionmanualtype` varchar(15) DEFAULT NULL,
  `diagramsavedbyuserseq` varchar(100) DEFAULT NULL,
  `diagramsaveddate` date DEFAULT NULL,
  `notestousa` varchar(5000) DEFAULT NULL,
  `assignedtouser` bigint(20) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `starteddate` date DEFAULT NULL,
  `supervisorreturndate` date DEFAULT NULL,
  `managerreturndate` date DEFAULT NULL,
  `buyerreturndate` date DEFAULT NULL,
  `senttochinadate` date DEFAULT NULL,
  `iscompleted` tinyint(4) DEFAULT NULL,
  `createdby` bigint(20) NOT NULL,
  `createddate` datetime NOT NULL,
  `lastmodifieddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructionmanuallogs`
--
ALTER TABLE `instructionmanuallogs`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructionmanuallogs`
--
ALTER TABLE `instructionmanuallogs`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE `instructionmanuallogs` ADD `entrydate` DATE NULL AFTER `seq`;
ALTER TABLE `instructionmanuallogs` CHANGE `status` `instructionmanuallogstatus` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
