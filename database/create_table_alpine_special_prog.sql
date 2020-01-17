-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2020 at 10:48 AM
-- Server version: 5.7.28
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpine_prod_oct`
--

-- --------------------------------------------------------

--
-- Table structure for table `alpinespecialprograms`
--

CREATE TABLE `alpinespecialprograms` (
  `seq` bigint(20) NOT NULL,
  `customerseq` bigint(20) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `priceprogram` varchar(100) DEFAULT NULL,
  `regularterms` varchar(200) DEFAULT NULL,
  `inseasonterms` varchar(100) DEFAULT NULL,
  `freight` varchar(50) DEFAULT NULL,
  `isedicustomer` tinyint(4) DEFAULT NULL,
  `isdefectiveallowancesigned` tinyint(4) DEFAULT NULL,
  `defectivepercent` double DEFAULT NULL,
  `howdefectiveallowancededucted` varchar(100) DEFAULT NULL,
  `rebateprogramandpaymentmethod` varchar(500) DEFAULT NULL,
  `howpayingbackcustomer` varchar(200) DEFAULT NULL,
  `promotionalallowance` varchar(500) DEFAULT NULL,
  `otherallowance` varchar(500) DEFAULT NULL,
  `additionalremarks` varchar(500) NOT NULL,
  `isbackorderaccepted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alpinespecialprograms`
--
ALTER TABLE `alpinespecialprograms`
  ADD PRIMARY KEY (`seq`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
