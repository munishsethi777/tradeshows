-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2019 at 02:23 PM
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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `seq` bigint(20) NOT NULL,
  `itemno` varchar(20) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `dept` varchar(15) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `pccs` int(11) DEFAULT NULL,
  `disc` double DEFAULT NULL,
  `instockqty` int(11) DEFAULT NULL,
  `allocqty` int(11) DEFAULT NULL,
  `soqty` int(11) DEFAULT NULL,
  `avqty` int(11) DEFAULT NULL,
  `poqty` int(11) DEFAULT NULL,
  `owqty` int(11) DEFAULT NULL,
  `projqty` int(11) DEFAULT NULL,
  `ytdsoldqty` int(11) DEFAULT NULL,
  `lastyearsoldqty` int(11) DEFAULT NULL,
  `comdship` double DEFAULT NULL,
  `showspecial` double DEFAULT NULL,
  `distributor` double DEFAULT NULL,
  `dealerprice` double DEFAULT NULL,
  `crzydissp` double DEFAULT NULL,
  `qtywt` double DEFAULT NULL,
  `minstk` int(11) DEFAULT NULL,
  `itemcost` double DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `isenabled` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
