-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2019 at 12:56 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `seq` bigint(20) NOT NULL,
  `customerid` bigint(20) NOT NULL,
  `customername` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `address1` varchar(250) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `attention` varchar(100) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `terms` varchar(500) DEFAULT NULL,
  `sales1` varchar(100) DEFAULT NULL,
  `sales2` varchar(100) DEFAULT NULL,
  `sales3` varchar(100) DEFAULT NULL,
  `sales4` varchar(100) DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `customerid` (`customerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
