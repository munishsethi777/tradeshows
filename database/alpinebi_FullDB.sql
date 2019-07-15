-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2019 at 10:08 AM
-- Server version: 10.2.24-MariaDB-log-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpinebi_tradeshows`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `seq` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isenable` tinyint(4) NOT NULL,
  `createdon` datetime NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`seq`, `username`, `name`, `password`, `isenable`, `createdon`, `email`) VALUES
(1, 'admin', 'Administrator', '123', 1, '2018-10-08 00:00:00', 'baljeetgaheer@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `classcodes`
--

CREATE TABLE `classcodes` (
  `seq` bigint(20) NOT NULL,
  `classcode` varchar(20) NOT NULL,
  `lastmodifiedon` datetime DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `userseq` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classcodes`
--

INSERT INTO `classcodes` (`seq`, `classcode`, `lastmodifiedon`, `createdon`, `isenabled`, `userseq`) VALUES
(1, 'ZAB', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(2, 'BVK', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(3, 'EUT', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(4, 'QLP', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(5, 'TLR', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(6, 'LAN', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(7, 'WIN ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(8, 'NCY', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(9, 'QWR', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(10, 'LJJ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(11, 'MLT', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(12, 'LCE', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(13, 'QFC', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(14, 'QTT', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(15, 'LUC', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(16, 'ZEN', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(17, 'TEC ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(18, 'YEN', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(19, 'PH', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(20, 'PLM', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(21, 'RGG', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(22, 'CRD', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(23, 'COR', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(24, 'MSY', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(25, 'ORS', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(26, 'GXT', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(27, 'MCC', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(28, 'LAZ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(29, 'KIY', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(30, 'GIL', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(31, 'JUM', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(32, 'KGD', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(34, 'BEH', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(35, 'BQR', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(36, 'ZTY', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(37, 'SLL', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(38, 'CIM', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(39, 'WQA', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(40, 'WHS', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(41, 'WXY', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(42, 'WTJ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(43, 'YHL', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(44, 'QVA', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(45, 'STR', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(46, 'USA', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(47, 'WCC', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(48, 'MAZ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(49, 'ACM', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(50, 'CHT', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(51, 'ZNB', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(52, 'BST', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(53, 'BCM', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(54, 'WDS', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(55, 'LKP', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(56, 'MAW', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(57, 'AUH', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(58, 'BKY', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(59, 'DUZ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(60, 'HEH', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(61, 'WAZ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(62, 'CPS', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(63, 'NA', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(64, 'WGG', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(65, 'SOT', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(66, 'TZL', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(67, 'LWQ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(68, 'WCT', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(69, 'DIG', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(70, 'HGY', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(71, 'TIZ', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(72, 'BVF', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(73, 'ACC', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(74, 'TOM', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(243, 'CLASSTEST', '2019-06-29 10:16:13', '2019-06-29 10:16:13', 1, 18),
(246, 'KPP', '2019-07-09 00:49:56', '2019-07-09 00:49:56', 1, 23),
(247, 'HIM', '2019-07-09 00:51:33', '2019-07-09 00:51:33', 1, 23),
(248, 'PUR', '2019-07-13 04:07:06', '2019-07-13 04:07:06', 1, 23);

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `seq` int(11) NOT NULL,
  `configkey` varchar(100) NOT NULL,
  `configvalue` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`seq`, `configkey`, `configvalue`) VALUES
(1, 'smtppassword', 'tomzo1-wosmus-hUhvep'),
(2, 'smtphost', 'mail.satyainfopages.in'),
(3, 'smtpusername', 'noreply@satyainfopages.in'),
(4, 'qcimportpassword', 'AllowDup6000');

-- --------------------------------------------------------

--
-- Table structure for table `containerscheduledates`
--

CREATE TABLE `containerscheduledates` (
  `seq` bigint(20) NOT NULL,
  `containerscheduleseq` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL,
  `datetimetype` varchar(25) NOT NULL,
  `createdon` datetime NOT NULL,
  `createdby` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `containerscheduledates`
--

INSERT INTO `containerscheduledates` (`seq`, `containerscheduleseq`, `datetime`, `datetimetype`, `createdon`, `createdby`) VALUES
(1, 1, '2019-07-10 13:14:00', 'ETA', '2019-07-09 07:46:42', 18),
(2, 1, '2019-07-01 13:14:00', 'Confirmed Delivery', '2019-07-09 07:46:42', 18),
(3, 1, '2019-07-10 13:14:00', 'Notification Pickup', '2019-07-09 07:46:42', 18),
(4, 1, '2019-07-11 13:14:00', 'ETA', '2019-07-09 07:49:27', 18),
(5, 1, '2019-07-02 13:14:00', 'Confirmed Delivery', '2019-07-09 07:49:36', 18),
(6, 1, '2019-07-15 13:14:00', 'Notification Pickup', '2019-07-09 07:49:43', 18),
(7, 5, '2019-07-12 12:47:00', 'ETA', '2019-07-12 07:18:45', 24),
(8, 5, '2019-07-03 12:48:00', 'Confirmed Delivery', '2019-07-12 07:18:45', 24),
(9, 5, '2019-07-11 12:48:00', 'Notification Pickup', '2019-07-12 07:18:45', 24),
(10, 6, '2019-07-12 12:49:00', 'ETA', '2019-07-12 07:19:48', 24),
(11, 6, '2019-07-11 12:49:00', 'Confirmed Delivery', '2019-07-12 07:19:48', 24),
(12, 6, '2019-07-11 12:49:00', 'Notification Pickup', '2019-07-12 07:19:48', 24),
(13, 7, '2019-07-10 13:06:00', 'ETA', '2019-07-12 07:37:11', 24),
(14, 7, '2019-07-11 13:06:00', 'Confirmed Delivery', '2019-07-12 07:37:11', 24),
(15, 7, '2019-07-09 13:06:00', 'Notification Pickup', '2019-07-12 07:37:11', 24),
(16, 8, '2019-07-11 13:14:00', 'ETA', '2019-07-12 07:44:16', 24),
(17, 8, '2019-07-13 13:14:00', 'ETA', '2019-07-12 07:45:10', 24);

-- --------------------------------------------------------

--
-- Table structure for table `containerschedulenotes`
--

CREATE TABLE `containerschedulenotes` (
  `seq` bigint(20) NOT NULL,
  `containerscheduleseq` bigint(20) NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `notestype` varchar(25) NOT NULL,
  `createdon` datetime NOT NULL,
  `createdby` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `containerschedulenotes`
--

INSERT INTO `containerschedulenotes` (`seq`, `containerscheduleseq`, `notes`, `notestype`, `createdon`, `createdby`) VALUES
(1, 1, 'test eta notes', 'ETA', '2019-07-09 07:46:42', 18),
(2, 1, 'return notes', 'Empty Return', '2019-07-09 07:46:42', 18),
(3, 1, 'pickup notes', 'Notification Pickup', '2019-07-09 07:46:42', 18),
(4, 1, 'test return notes', 'Empty Return', '2019-07-09 07:50:12', 18),
(5, 1, 'test pickup notes', 'Notification Pickup', '2019-07-09 07:50:12', 18),
(6, 1, 'test noe', 'Empty Return', '2019-07-09 08:07:04', 24),
(7, 5, 'test retturn notes', 'Empty Return', '2019-07-12 07:18:45', 24),
(8, 5, 'test retturn notes', 'Notification Pickup', '2019-07-12 07:18:45', 24),
(9, 6, 'tes', 'Empty Return', '2019-07-12 07:19:48', 24),
(10, 6, 'ss', 'Notification Pickup', '2019-07-12 07:19:48', 24),
(11, 7, 'df', 'ETA', '2019-07-12 07:37:11', 24),
(12, 7, 'te', 'Empty Return', '2019-07-12 07:37:11', 24),
(13, 7, 'err', 'Notification Pickup', '2019-07-12 07:37:11', 24),
(14, 8, 'tesdfd', 'Empty Return', '2019-07-12 07:44:24', 24),
(15, 8, 'dfdfd', 'Notification Pickup', '2019-07-12 07:44:24', 24),
(16, 8, 'testee', 'Empty Return', '2019-07-12 07:45:02', 24),
(17, 8, 'erere', 'Notification Pickup', '2019-07-12 07:45:02', 24);

-- --------------------------------------------------------

--
-- Table structure for table `containerschedules`
--

CREATE TABLE `containerschedules` (
  `seq` bigint(20) NOT NULL,
  `awureference` varchar(25) NOT NULL,
  `truckername` varchar(25) DEFAULT NULL,
  `trans` varchar(25) DEFAULT NULL,
  `warehouse` varchar(25) DEFAULT NULL,
  `container` varchar(25) DEFAULT NULL,
  `etadatetime` datetime DEFAULT NULL,
  `terminal` varchar(25) DEFAULT NULL,
  `terminalappointmentdatetime` datetime DEFAULT NULL,
  `etanotes` varchar(1000) DEFAULT NULL,
  `etanotesdatetime` datetime DEFAULT NULL,
  `lfdpickupdate` date DEFAULT NULL,
  `scheduleddeliverydatetime` datetime DEFAULT NULL,
  `confirmeddeliverydatetime` datetime DEFAULT NULL,
  `emptylfddate` date DEFAULT NULL,
  `deliverygate` varchar(25) DEFAULT NULL,
  `emptyreturndate` date DEFAULT NULL,
  `alpinenotificatinpickupdatetime` datetime DEFAULT NULL,
  `emptynotes` varchar(1000) DEFAULT NULL,
  `emptynotesdatetime` datetime DEFAULT NULL,
  `notificationnotes` varchar(1000) DEFAULT NULL,
  `notificationnotesdatetime` datetime DEFAULT NULL,
  `containerdocspath` varchar(500) DEFAULT NULL,
  `isidscomplete` tinyint(4) DEFAULT NULL,
  `issamplesreceived` tinyint(4) DEFAULT NULL,
  `msrfcreateddate` date DEFAULT NULL,
  `samplesreceiveddate` date DEFAULT NULL,
  `iscontainerreceivedinoms` tinyint(4) DEFAULT NULL,
  `containerreceivedinomsdate` date DEFAULT NULL,
  `issamplesreceivedinoms` tinyint(4) DEFAULT NULL,
  `samplesreceivedinomsdate` date DEFAULT NULL,
  `iscontainerreceivedinwms` tinyint(4) DEFAULT NULL,
  `containerreceivedinwmsdate` date DEFAULT NULL,
  `issamplesreceivedinwms` tinyint(4) DEFAULT NULL,
  `samplesreceivedinwmsdate` date DEFAULT NULL,
  `createdby` bigint(20) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `lastmodifiedon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `containerschedules`
--

INSERT INTO `containerschedules` (`seq`, `awureference`, `truckername`, `trans`, `warehouse`, `container`, `etadatetime`, `terminal`, `terminalappointmentdatetime`, `etanotes`, `etanotesdatetime`, `lfdpickupdate`, `scheduleddeliverydatetime`, `confirmeddeliverydatetime`, `emptylfddate`, `deliverygate`, `emptyreturndate`, `alpinenotificatinpickupdatetime`, `emptynotes`, `emptynotesdatetime`, `notificationnotes`, `notificationnotesdatetime`, `containerdocspath`, `isidscomplete`, `issamplesreceived`, `msrfcreateddate`, `samplesreceiveddate`, `iscontainerreceivedinoms`, `containerreceivedinomsdate`, `issamplesreceivedinoms`, `samplesreceivedinomsdate`, `iscontainerreceivedinwms`, `containerreceivedinwmsdate`, `issamplesreceivedinwms`, `samplesreceivedinwmsdate`, `createdby`, `createdon`, `lastmodifiedon`) VALUES
(5, 'testawu', 'vv', 's', 'sd', 'ddf', '2019-07-12 12:47:00', 'test', '2019-07-12 12:48:00', NULL, NULL, '2019-07-12', '2019-07-05 12:48:00', '2019-07-03 12:48:00', '2019-07-08', 'te', '2019-07-18', '2019-07-11 12:48:00', 'test retturn notes', NULL, 'test retturn notes', NULL, 'e', 1, 1, '2019-07-12', '2019-07-12', 1, '2019-07-03', 1, '2019-07-25', 1, '2019-07-27', 1, '2019-07-17', 24, '2019-07-12 07:18:45', '2019-07-12 07:18:45'),
(6, 'testawu', 'tedss', 'testt', 'qq', 'ac', '2019-07-12 12:49:00', 'gad', '2019-07-12 12:49:00', NULL, NULL, '2019-07-12', '2019-07-11 12:49:00', '2019-07-11 12:49:00', '2019-07-11', 'eee', '2019-07-17', '2019-07-11 12:49:00', NULL, NULL, NULL, NULL, 's', 1, 1, '2019-07-02', '2019-07-10', 1, '2019-07-11', 1, '2019-07-05', 1, '2019-07-13', 1, '2019-07-25', 24, '2019-07-12 07:19:48', '2019-07-12 07:36:33'),
(7, 'erer', 'er', 'er', 'erad', 'dfd', '2019-07-10 13:06:00', 'df', '2019-07-24 13:06:00', NULL, NULL, '2019-07-05', '2019-07-11 13:06:00', '2019-07-11 13:06:00', '2019-07-03', 'df', '2019-07-25', '2019-07-09 13:06:00', NULL, NULL, NULL, NULL, 'er', 1, NULL, '2019-07-09', '2019-07-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, '2019-07-12 07:37:11', '2019-07-12 07:44:05'),
(8, 'te', 's', 'd', 'd', 'd', '2019-07-13 13:14:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, '2019-07-12 07:44:16', '2019-07-12 07:45:10');

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
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`seq`, `customerid`, `customername`, `phone`, `address`, `address1`, `city`, `state`, `zip`, `email`, `attention`, `fax`, `terms`, `sales1`, `sales2`, `sales3`, `sales4`, `createdate`, `createdon`, `lastmodifiedon`) VALUES
(14, 1, 'Cust1', '(562) 529-8955', '6000 Rickebacker Rd', 'Richard Circle', 'Los Angeles', 'CA', '90040', 'email@email.com', 'MOEIN', 'fax number', 'terms and conditions', 'Robert', 'Marc', 'Jacobs', 'Steve', '2019-02-15', '2019-02-15 17:08:34', '2019-02-15 17:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `seq` bigint(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `lastmodifiedon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`seq`, `title`, `isenabled`, `createdon`, `lastmodifiedon`) VALUES
(1, 'QC Schedules', 1, '2019-06-11 00:00:00', '2019-06-11 00:00:00'),
(2, 'Graphics Logs', 1, '2019-06-11 00:00:00', '2019-06-11 00:00:00'),
(3, 'Item Specs', 1, '2019-06-11 00:00:00', '2019-06-11 00:00:00'),
(4, 'Container Schedules', 1, '2019-06-05 00:00:00', '2019-06-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `graphicslogs`
--

CREATE TABLE `graphicslogs` (
  `seq` bigint(20) NOT NULL,
  `usaofficeentrydate` date NOT NULL,
  `po` varchar(25) DEFAULT NULL,
  `estimatedshipdate` date DEFAULT NULL,
  `sku` varchar(25) NOT NULL,
  `graphictype` varchar(50) DEFAULT NULL,
  `iscustomhangtagneeded` tinyint(4) DEFAULT NULL,
  `iscustomwraptagneeded` tinyint(4) DEFAULT NULL,
  `customername` varchar(50) NOT NULL,
  `isprivatelabel` tinyint(4) DEFAULT NULL,
  `usanotes` varchar(1000) DEFAULT NULL,
  `estimatedgraphicsdate` date DEFAULT NULL,
  `chinaofficeentrydate` date DEFAULT NULL,
  `confirmedposhipdate` date DEFAULT NULL,
  `jeopardydate` date DEFAULT NULL,
  `graphiclength` double DEFAULT NULL,
  `graphicwidth` double DEFAULT NULL,
  `graphicheight` double DEFAULT NULL,
  `chinanotes` varchar(1000) DEFAULT NULL,
  `finalgraphicsduedate` date DEFAULT NULL,
  `graphicstochinanotes` varchar(1000) DEFAULT NULL,
  `approxgraphicschinasentdate` date DEFAULT NULL,
  `graphicstatus` varchar(50) DEFAULT NULL,
  `graphicartist` varchar(50) DEFAULT NULL,
  `graphicartiststartdate` date DEFAULT NULL,
  `graphiccompletiondate` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `userseq` bigint(20) NOT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `tagtype` varchar(50) DEFAULT NULL,
  `taglength` double DEFAULT NULL,
  `tagwidth` double DEFAULT NULL,
  `tagheight` double DEFAULT NULL,
  `labellength` double DEFAULT NULL,
  `labelwidth` double DEFAULT NULL,
  `labelheight` double DEFAULT NULL,
  `labeltype` varchar(50) DEFAULT NULL,
  `draftdate` date DEFAULT NULL,
  `buyerreviewreturndate` date DEFAULT NULL,
  `managerreviewreturndate` date DEFAULT NULL,
  `classcodeseq` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graphicslogs`
--

INSERT INTO `graphicslogs` (`seq`, `usaofficeentrydate`, `po`, `estimatedshipdate`, `sku`, `graphictype`, `iscustomhangtagneeded`, `iscustomwraptagneeded`, `customername`, `isprivatelabel`, `usanotes`, `estimatedgraphicsdate`, `chinaofficeentrydate`, `confirmedposhipdate`, `jeopardydate`, `graphiclength`, `graphicwidth`, `graphicheight`, `chinanotes`, `finalgraphicsduedate`, `graphicstochinanotes`, `approxgraphicschinasentdate`, `graphicstatus`, `graphicartist`, `graphicartiststartdate`, `graphiccompletiondate`, `duration`, `userseq`, `createdon`, `lastmodifiedon`, `tagtype`, `taglength`, `tagwidth`, `tagheight`, `labellength`, `labelwidth`, `labelheight`, `labeltype`, `draftdate`, `buyerreviewreturndate`, `managerreviewreturndate`, `classcodeseq`) VALUES
(4048, '2019-02-12', '27071', '2019-07-02', 'ACM126HH', NULL, 1, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49),
(4049, '2019-02-12', '27071', '2019-07-02', 'ACM132HH', NULL, 1, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49),
(4050, '2019-02-12', '27071', '2019-07-02', 'ACM186HH', NULL, 1, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49),
(4051, '2019-02-12', '27073', '2019-07-02', 'MOD104', 'Color Label', 0, 0, 'ALPINE', 0, 'Update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(4052, '2019-02-12', '27075', '2019-07-02', 'JUM208', 'Color Label', 0, 0, 'ALPINE', 0, 'Update item dimension to : 16\"L x 20\"W x 28\"H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31),
(4053, '2019-02-12', '27075', '2019-07-02', 'JUM238', NULL, 0, 0, 'ALPINE', 0, 'Update (custom wrap sticker)  item dimension to : 20\"L x 20\"W x 36\"H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31),
(4054, '2019-02-12', '27076', '2019-07-02', 'WGG116ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'Update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 64),
(4055, '2019-02-12', '27078', '2019-07-02', 'MAZ186', 'Color Label', 0, 0, 'ALPINE', 0, 'Update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48),
(4056, '2019-03-20', '26566', '2019-07-02', 'NCY328S', 'Color Label', 1, 0, 'ALPINE', 0, NULL, NULL, '2019-07-02', '2019-07-02', '2019-07-02', 15.5, NULL, 15.5, 'Change to color label and urgent !!', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8),
(4057, '2019-03-14', '27109', '2019-07-02', 'YHL256S', NULL, 1, 0, 'ALPINE', 0, 'New item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-10', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43),
(4058, '2019-03-14', '25658', '2019-07-02', 'QW871SLR', NULL, 1, 0, 'ALPINE', 0, 'Need update item dimensions', NULL, '2019-07-02', NULL, NULL, 8.5, 10.5, 14.25, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-10', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4059, '2019-03-14', '26678', '2019-07-02', 'PL1008T', 'Color Box', 0, 0, 'ALPINE', 0, 'Update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4060, '2019-03-08', '27262', '2019-07-02', 'CIM224HH', NULL, 1, 0, 'ALPINE', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-09', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4061, '2019-02-12', '27082', '2019-07-02', 'NCY106', 'Color Label', 0, 0, 'ALPINE', 0, 'Update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8),
(4062, '2019-02-13', '27090', '2019-07-02', 'KAB180', 'Color Label', 0, 0, 'ALPINE', 0, 'Update', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65),
(4063, '2019-02-13', '27071', '2019-07-02', 'ACM186HH', NULL, 1, 0, 'ALPINE', 0, 'Update item barcode to : 821559705624', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No Need Update', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49),
(4064, '2019-02-13', '27093', '2019-07-02', 'TZL101', 'Color Label', 0, 0, 'ALPINE', 0, 'Update item dimension to : 18\"L x 21\"W x 34\"H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4065, '2019-02-13', '27094', '2019-07-02', 'USA1368', 'Color Label', 0, 0, 'ALPINE', 0, 'Update item dimension to : 19\"L x 17\"W x 35\"H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46),
(4066, '2019-02-14', '27116-2', '2019-07-02', 'COR152', 'Color Label', 1, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, 11.81, NULL, 17.91, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4067, '2019-02-14', '27100', '2019-07-02', 'ZEN538', 'A4 Label', 0, 0, 'ALPINE', 0, 'Update item dimension to : 18\"L x 21\"W x 40\"H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', NULL, NULL, '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4068, '2019-02-14', '27116-2', '2019-07-02', 'COR162MC', 'Color Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, 12.4, NULL, 12.4, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4069, '2019-02-14', '27083', '2019-07-02', 'CAD110WT', 'Color Box', 0, 0, 'ALPINE', 0, 'Update Alpine logo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', NULL, NULL, '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4070, '2019-03-08', '27262', '2019-07-02', 'CIM220HH', NULL, 1, 0, 'ALPINE', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', NULL, NULL, '2019-04-09', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4071, '2019-03-08', '27262', '2019-07-02', 'CIM226HH', NULL, 1, 0, 'ALPINE', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', NULL, NULL, '2019-04-09', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4072, '2019-02-25', '27014', '2019-07-02', 'RGG222ABB-TM', 'Window Box', 0, 0, 'ALPINE', 0, 'Update color box/tray pack both', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Update color box/tray pack both', NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(4073, '2019-02-25', '27014', '2019-07-02', 'RGG224ABB-TM', 'Window Box', 0, 0, 'ALPINE', 0, 'Update color box/tray pack both', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Update color box/tray pack both', NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-02-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(4074, '2019-02-28', '26564', '2019-07-02', 'KIY184', 'Color Label', 0, 0, 'ALPINE', 0, 'Update item dimension to : 28\"L x 26.25\"W x 92\"H', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'updated', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29),
(4075, '2019-02-26', '25501-3', '2019-07-02', 'PAL10300', 'Color Box', 0, 0, 'ALPINE', 0, 'OLD ITEM', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Pls help to send newest one to us.', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-27', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4076, '2019-03-05', '26769-3', '2019-07-02', ' PLF2000U', 'Color Box', 0, 0, 'ALPINE', 0, 'OLD ITEM', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'UPDATE', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-06', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4077, '2019-02-26', '27007', '2019-07-02', 'P180', 'Color Box', 0, 0, 'ALPINE', 0, 'OLD ITEM', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'UPDATE', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-28', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4078, '2019-03-04', '26892-B', '2019-07-02', 'TEC140', 'Color Label', 0, 0, 'HAYNEEDLE', 0, 'OLD ITEM', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'updated ', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-04', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17),
(4079, '2019-02-25', '26992-2', '2019-07-02', 'WQA373ABB', 'Color Label', 0, 0, 'ALPINE', 0, NULL, NULL, '2019-07-02', '2019-07-02', NULL, 16.5, NULL, 3.5, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-02-28', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4080, '2019-03-06', '27239-BP', '2019-07-02', 'WCT202 ', 'Color Box', 0, 0, 'ALPINE', 0, 'Requested die-cut, case pack qty updated from 4 to 1. Colored box needs to be updated', NULL, '2019-07-02', '2019-07-02', NULL, 9.6, 9.6, 11.55, 'Updated Diecut was save into T drive', NULL, 'waiting on info/size 3/7/19 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4081, '2019-03-19', '27054-B6,27057-B6', '2019-07-02', 'SOT353BB-CC-TM', 'Tray Pack', 1, 0, 'ACE', 0, 'Need update item dimenstions', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Need update', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65),
(4082, '2019-03-01', '27079', '2019-07-02', 'MCC524', 'A4 Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'A4 color label,need no size', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4083, '2019-03-01', '27079', '2019-07-02', 'MCC526', 'A4 Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'A4 color label,need no size', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4084, '2019-03-01', '27079', '2019-07-02', 'MCC528', 'A4 Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'A4 color label,need no size', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4085, '2019-03-01', '27079', '2019-07-02', 'MCC536', 'A4 Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'A4 color label,need no size', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4086, '2019-03-01', '27079', '2019-07-02', 'MCC538', 'A4 Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'A4 color label,need no size', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4087, '2019-03-01', '27102', '2019-07-02', 'SLL2162A', 'Metal Display', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, 20.2, 12.72, 3.94, NULL, NULL, 'waiting on info/size 3/4/19 - MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37),
(4088, '2019-03-01', '27102', '2019-07-02', 'SLL2160A', 'Metal Display', 0, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, 14.29, 11.54, 3.94, NULL, NULL, 'waiting on info/size 3/4/19 - MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37),
(4089, '2019-03-04', '27125', '2019-07-02', 'JUM324', NULL, 0, 1, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-18', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31),
(4090, '2019-03-04', '27125', '2019-07-02', 'JUM326', NULL, 0, 1, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-18', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31),
(4091, '2019-03-04', '27125', '2019-07-02', 'JUM330HH-RS', NULL, 1, 0, 'ALPINE', 0, 'New Item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-18', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31),
(4092, '2019-03-06', '27108', '2019-07-02', 'YEN202A-201', NULL, 0, 1, 'ALPINE', 0, 'Item dimension needs to be updated: Tree: 10\"L x .39\"W x 36\"H Snowflakes:  9\"L x .39\"W x 36\"H', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'update hang tap only', NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-03-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18),
(4093, '2019-02-12', '27079', '2019-07-02', 'MCC524', 'Color Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4094, '2019-02-12', '27079', '2019-07-02', 'MCC526', 'Color Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4095, '2019-02-12', '27079', '2019-07-02', 'MCC528', 'Color Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4096, '2019-02-12', '27079', '2019-07-02', 'MCC536', NULL, 0, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02', '2019-03-07', NULL, 15, '2019-07-02 10:19:35', '2019-07-08 06:09:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4097, '2019-02-12', '27079', '2019-07-02', 'MCC538', 'Color Label', 0, 0, 'ALPINE', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27),
(4098, '2019-03-05', '27252-B2', '2019-07-02', 'GIL110', NULL, 0, 0, 'HAYNEEDLE', 0, 'Update item dimension', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30),
(4099, '2019-03-07', '27280-B', '2019-07-02', 'CIM228HH-L', NULL, 1, 0, 'RURAL KING', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'waiting on info/size 3/8/19 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-09', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4100, '2019-03-08', '27280-B', '2019-07-02', 'CIM224HH-L', NULL, 1, 0, 'RURAL KING', 0, 'New Item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-09', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4101, '2019-03-06', '27273-B3', '2019-07-02', 'SLC131', 'Floor Display', 0, 1, 'DO IT BEST', 1, 'update Alpine Logo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'waiting on info/size 3/8/19 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4102, '2019-03-11', '27279-B/27281-B2', '2019-07-02', 'CHT894', 'Color Label', 1, 0, 'RURAL KING', 0, 'NEW ITEM', NULL, '2019-07-02', NULL, NULL, 16.9, NULL, 19.2, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50),
(4103, '2019-03-11', '27112/27114', '2019-07-02', 'AUH164', NULL, 0, 0, 'ALPINE', 0, 'Update per Michelle', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-03-25', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57),
(4104, '2019-03-26', '27130', '2019-07-02', 'LAN151ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'Needs an update, missing string length', NULL, '2019-07-02', '2019-07-02', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6),
(4105, '2019-03-26', '27130', '2019-07-02', 'CRW116-20', 'Floor Display', 0, 0, 'ALPINE', 0, 'Needs an update, missing string length', NULL, '2019-07-02', '2019-07-02', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6),
(4106, '2019-03-27', '27420', '2019-07-02', 'GXP158CC', 'Floor Display', 1, 0, 'ALPINE', 0, 'HANGTAG NEW LAYOUT', NULL, '2019-07-02', '2019-07-02', NULL, 17.72, 22.44, 20.3, 'Diecut was save into T drive', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18),
(4107, '2019-03-14', '27286-B5', '2019-07-02', 'CRD110S-GN', 'Color Box', 0, 1, 'BOMGAARS', 0, NULL, NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Cancelled', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4108, '2019-03-14', '27286-B5', '2019-07-02', 'CRD110S-RD', 'Color Box', 0, 1, 'BOMGAARS', 0, NULL, NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Cancelled', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4109, '2019-03-14', '27286-B5', '2019-07-02', 'CRD110S-SL', 'Color Box', 0, 1, 'BOMGAARS', 0, NULL, NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Cancelled', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4110, '2019-03-14', '27083', '2019-07-02', 'LPA108L-RD', NULL, 0, 0, 'ALPINE', 0, 'Needs Update - hang tag and graphics', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cancelled', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4111, '2019-03-26', '26941', '2019-07-02', 'PLUV10800', 'Color Box', 0, 0, 'ALPINE', 0, 'Update', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Update', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4112, '2019-03-14', '27301', '2019-07-02', 'ZTY104CC', 'A4 Label', 1, 0, 'ALPINE', 0, 'New item', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36),
(4113, '2019-03-14', '27134', '2019-07-02', 'LUC138MC', 'Color Label', 0, 0, 'ALPINE', 0, 'Graphics needs update', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Pls double check it is old item, and lable size did not change', NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-04-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15),
(4114, '2019-03-04', '27130', '2019-07-02', 'LAN252L', 'Color Box', 1, 0, 'ALPINE', 0, 'New Item / also for Bomgaars', NULL, '2019-07-02', '2019-07-02', NULL, 5.9, 2.95, 30.3, 'DIECUT was saved into T drive', NULL, 'waiting on info/size 3/5/19, 3/18 - MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6),
(4115, '2019-04-01', '27263', '2019-07-02', 'QWR916', NULL, 1, 0, 'ALPINE', 0, 'New Item / include how it works & battery details', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Shanti note: 1.Type of battery Box â€“ is it clip style 2.Functionality â€“ it is on/off switch. Switch left for ON1(LED only), center to turn off, right to switch ON2(LED&MUSIC)   Automatic timing:6hours ON,18 hours OFF.', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4116, '2019-03-14', '27083', '2019-07-02', 'CAD110WT', 'Color Box', 0, 0, 'ALPINE', 0, 'Needs update - graphics', NULL, '2019-07-02', '2019-07-02', NULL, 22.83, 2.36, 22.83, 'old item, need update', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4117, '2019-02-14', '27083', '2019-07-02', 'COR164', 'Color Label', 1, 0, 'ALPINE', 0, 'New Item', '2019-05-02', '2019-07-02', '2019-07-02', '2019-07-02', 7.48, NULL, 12.4, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4118, '2019-03-08', '27278-B', '2019-07-02', 'KIY318A', 'Color Box', 1, 0, 'RURAL KING', 0, 'New Item ', '2019-04-29', '2019-07-02', '2019-07-02', NULL, 8.5, 8.5, 16.3, 'DIECUT was saved into T drive', NULL, 'waiting on info & size 3/12, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-15', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29),
(4119, '2019-03-14', '27083', '2019-07-02', 'COR114T-3', 'Color Box', 1, 0, 'ALPINE', 0, NULL, '2019-05-02', '2019-07-02', '2019-07-02', NULL, 7.48, 2.76, 28.35, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4120, '2019-02-14', '27083', '2019-07-02', 'COR124L-SL', 'Color Label', 1, 0, 'ALPINE', 0, 'New Item', '2019-05-05', '2019-07-02', '2019-07-02', NULL, 11.81, NULL, 11.81, NULL, NULL, 'waiting on size 2/27 3/18 - MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4121, '2019-05-08', '27270', '2019-07-02', 'JUM208', 'Color Box', 0, 0, 'ALPINE', 0, 'Needs update : update dimensions', '2019-05-28', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Needs update : update dimensions21\"L x 21\"W x 28\"H ', NULL, 'kim confiming size. Log since one thing, OMS says different along with master 5/16', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-17', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31),
(4122, '2019-03-28', '27085', '2019-07-02', 'SLY180A', 'Floor Display', 1, 0, 'ALPINE', 0, 'Old item New hang tag, booklet style. Floor display size is wrong per fty,pls update base on saved diecut.', '2019-05-30', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Need use update diecut saved in N drive,.Not sure why info missing but add on 5/10', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4123, '2019-03-01', '27302', '2019-07-02', 'USA1526ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'New Item', '2019-05-28', '2019-07-02', '2019-07-02', NULL, 12.72, 9.4, 2, 'DIECUT was save into T drive', NULL, 'waiting on info/size 3/4/19, 3/18 - MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4124, '2019-03-06', '27263', '2019-07-02', 'QWR954', 'Color Label', 1, 0, 'ALPINE', 0, 'New Item / Bomgaars', '2019-04-18', '2019-07-02', '2019-07-02', NULL, 18.696, NULL, 25.05, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-17', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4125, '2019-02-26', '27141', '2019-07-02', 'QWR952', 'Color Label', 1, 0, 'ALPINE', 0, 'New Item / Bomgaars', '2019-04-18', '2019-07-02', '2019-07-02', NULL, 16.45, NULL, 25.05, NULL, NULL, 'waiting on size 2/27/19, 3/18 - MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-17', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4126, '2019-04-02', '27679-BP', '2019-07-02', 'WCT688', 'Color Label', 0, 0, 'ALPINE', 0, 'The label needs to be updated to remove the Prop 65 logo from it.', NULL, '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4127, '2019-02-26', '27141', '2019-07-02', 'QWR956', 'Color Label', 1, 0, 'ALPINE', 0, 'New Item / instructions on how battery box works.', '2019-04-18', '2019-07-02', '2019-07-02', NULL, 17.2, NULL, 25.05, 'Shanti:1.Type of battery Box â€“ it is screw box  2.Functionality â€“ it is push button,push once to turn on,twice for off Automatic timing:6hours ON,18 hours OFF.\n', NULL, 'waiting on size 2/27/19, 3/18 - MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-17', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4128, '2019-03-04', '27125', '2019-07-02', 'JFH1245A', 'Color Label', 1, 0, 'ALPINE', 0, 'New Item', '2019-03-31', '2019-07-02', '2019-07-02', NULL, 0, NULL, 7.9, 'DIECUT was saved into T drive', NULL, 'waiting on info/size 3/5/19, 3/18, 3/21 - MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31),
(4129, '2019-03-06', '27119', '2019-07-02', 'CRD111S-GD', 'Color Box', 1, 0, 'ALPINE', 0, 'New Item', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 7.09, 2.95, 42.52, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4130, '2019-03-06', '27119', '2019-07-02', 'CRD111S-GN', 'Color Box', 1, 0, 'ALPINE', 0, 'New Item', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 7.09, 2.95, 42.52, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-17', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4131, '2019-03-06', '27119', '2019-07-02', 'CRD111S-RD', 'Color Box', 1, 0, 'ALPINE', 0, 'New Item', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 7.09, 2.95, 42.52, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-17', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4132, '2019-03-06', '27119', '2019-07-02', 'CRD111S-SL', 'Color Box', 1, 0, 'ALPINE', 0, 'New Item', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 7.09, 2.95, 42.52, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4133, '2019-03-14', '27282-B4', '2019-07-02', 'BQR108S', 'Color Label', 1, 0, 'RURAL KING', 0, NULL, '2019-04-09', '2019-07-02', '2019-07-02', NULL, 7.26, NULL, 44.27, NULL, NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35),
(4134, '2019-03-19', '27335', '2019-07-02', 'KGD240ABB', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-04-09', '2019-07-02', '2019-07-02', NULL, 11.42, NULL, 1.18, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4135, '2019-03-06', '27264', '2019-07-02', 'QWR938', NULL, 1, 0, 'ALPINE', 0, 'new item', '2019-04-21', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'it is packed by brown master carton, donot need update graphic log', NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-19', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4136, '2019-03-27', '27074', '2019-07-02', 'GXT252', 'Color Label', 0, 0, 'ALPINE', 0, 'Old item New graphic needed as the item photo on the label is NOT showing the led lights as they werenâ€™t turned on', '2019-05-20', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26),
(4137, '2019-03-06', '27119', '2019-07-02', 'CRD128GN', 'Color Box', 1, 0, 'ALPINE', 0, 'New item / NEW ALPINE\'S CHRISTMAS GENERIC FOR CRD128 SERIES HANG TAG', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 3.15, 2.36, 36.22, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4138, '2019-03-06', '27119', '2019-07-02', 'CRD128MC', 'Color Box', 1, 0, 'ALPINE', 0, 'New item / NEW ALPINE\'S CHRISTMAS GENERIC FOR CRD128 SERIES HANG TAG', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 3.15, 2.36, 36.22, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4139, '2019-03-06', '27119', '2019-07-02', 'CRD128RD', 'Color Box', 1, 0, 'ALPINE', 0, 'New item / NEW ALPINE\'S CHRISTMAS GENERIC FOR CRD128 SERIES HANG TAG', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 3.15, 2.36, 36.22, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4140, '2019-03-06', '27273-B2', '2019-07-02', 'RGG358A', 'Metal Display', 1, 0, 'DO IT BEST', 1, 'New Item', '2019-04-14', '2019-07-02', '2019-07-02', NULL, 28.1, 12.3, 5.6, 'DIECUT was save into T drive', NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(4141, '2019-03-20', '27290-B', '2019-07-02', 'ZEN696AGG', NULL, 0, 0, 'RURAL KING', 0, 'need new graphics for the back card', '2019-04-18', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Need update', NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4142, '2019-03-20', '27290-B ', '2019-07-02', 'ZEN702AGG', NULL, 0, 0, 'RURAL KING', 0, 'need new graphics for the back card', '2019-04-18', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Need update', NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4143, '2019-03-20', '27290-B2', '2019-07-02', 'KGD242ABB', 'Color Label', 0, 0, 'RURAL KING', 0, 'NEW ITEM', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 10.24, NULL, 1.18, 'Packing is white box with one side full color lable.', NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4144, '2019-03-27', '27290-B6 ', '2019-07-02', 'WQA1302', 'Color Label', 0, 0, 'RURAL KING', 0, 'new item', '2019-04-16', '2019-07-02', '2019-07-02', NULL, 29, NULL, 4.72, NULL, NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4145, '2019-03-06', '27119', '2019-07-02', 'CRD128WW', 'Color Box', 1, 0, 'ALPINE', 0, 'New item / NEW ALPINE\'S CHRISTMAS GENERIC FOR CRD128 SERIES HANG TAG', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 3.15, 2.36, 36.22, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4146, '2019-03-08', '27283-B', '2019-07-02', 'LWQ128-3', 'Color Label', 1, 0, 'RURAL KING', 0, 'New Item', '2019-04-23', '2019-07-02', '2019-07-02', NULL, 6.89, NULL, 23.62, 'Shanti note: Type of battery Box â€“ clip style\nFunctionality â€“it is on/off switch .  Switch left to swith on, center to timer, right to turn off\nWorks with 3 battery (s) of type 1.5V            LR6/AA not supplied.\nElectrical products should not be disposed of with household waste. Please recycle them at the collection points provided for this purpose. Contact your local authority or your dealer for recycling advice.\nNon-replaceable lamps.\nWhen installing the batteries, check the polarity.For indoor use only.\nThis product is intended for decorative purposes only. It is not suitable for lighting a room in a household.\n', NULL, 'waiting on info & size 3/12, 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67),
(4147, '2019-03-28', '27100', '2019-07-02', 'ZEN244', 'Color Label', 0, 0, 'ALPINE', 0, 'needs a new graphic for the â€œWelcomeâ€ to have â€œâ€™ like the other 2 models to keep it consistent. (ZEN236,ZEN242)', '2019-04-24', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-20', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4148, '2019-03-15', '27290-B7', '2019-07-02', 'WHS110MC-TM', 'Color Box', 1, 0, 'RURAL KING', 0, 'NEW ITEM', '2019-05-02', '2019-07-02', '2019-07-02', NULL, 7.48, 4.92, 1.77, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40),
(4149, '2019-03-06', '27119', '2019-07-02', 'CRD100L-GN', 'Color Box', 1, 0, 'ALPINE', 0, 'New item / NEW ALPINE\'S CHRISTMAS GENERIC FOR CRD128 SERIES HANG TAG', '2019-04-22', '2019-07-02', '2019-07-02', NULL, 2.76, 2.76, 11.81, NULL, NULL, 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22),
(4150, '2019-03-15', '27107', '2019-07-02', 'WXY122BB-S', 'Color Label', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-05-06', '2019-07-02', '2019-07-02', NULL, 14, NULL, 1.5, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4151, '2019-03-15', '27107', '2019-07-02', 'WXY142', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-05-06', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'it\'s brown box not color box, pls move if no need custom hangtag ', NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4152, '2019-03-15', '27290-B3', '2019-07-02', 'WCC114ABB-TM', 'Tray Pack', 0, 0, 'RURAL KING', 0, 'new item/make a custom sticker for the item barcode that will have our brand on it', '2019-05-15', '2019-07-02', '2019-07-02', NULL, 16.34, 8.86, 1.97, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47),
(4153, '2019-03-20', '27107', '2019-07-02', 'WXY144ABB ', 'Color Label', 1, 0, 'RURAL KING', 0, 'include â€œhow it worksâ€ and battery details on the hangtag', '2019-05-06', '2019-07-02', '2019-07-02', NULL, 19.28, NULL, 1.57, NULL, NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4154, '2019-03-20', '27107', '2019-07-02', 'WXY168BB', 'Tray Pack', 0, 0, 'RURAL KING', 0, 'New Item', '2019-05-06', '2019-07-02', '2019-07-02', NULL, 14.6, NULL, 1.5, NULL, NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4155, '2019-03-20', '27107', '2019-07-02', 'WXY166BB', 'Tray Pack', 0, 0, 'RURAL KING', 0, 'New Item', '2019-05-06', '2019-07-02', '2019-07-02', NULL, 12.85, NULL, 1.5, NULL, NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4156, '2019-03-26', '27569', '2019-07-02', 'WXY148ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, 'NEW ITEM: with instructions on hangtag', '2019-05-06', '2019-07-02', '2019-07-02', NULL, 15.55, NULL, 1.5, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4157, '2019-03-26', '27569', '2019-07-02', 'WXY152ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, 'NEW ITEM: with instructions on hangtag', '2019-05-06', '2019-07-02', '2019-07-02', NULL, 14.4, NULL, 1.5, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4158, '2019-03-26', '27569', '2019-07-02', 'WXY154ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, 'NEW ITEM: with instructions on hangtag', '2019-05-06', '2019-07-02', '2019-07-02', NULL, 13, NULL, 1.5, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41),
(4159, '2019-04-20', '27138', '2019-07-02', 'QLP1103BB', 'Tray Pack', 1, 0, 'ALPINE', 0, NULL, '2019-05-10', '2019-04-20', '2019-07-02', NULL, 15, 12.75, 4.72, NULL, NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4160, '2019-03-14', '27127', '2019-07-02', 'LAZ156A', 'Color Box', 0, 0, 'ALPINE', 0, NULL, '2019-04-30', '2019-07-02', '2019-07-02', NULL, 11.61, 2.17, 9.65, 'die cut saved in T drive', NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28),
(4161, '2019-03-14', '27137', '2019-07-02', 'ORS728', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-06-04', '2019-07-02', '2019-07-02', NULL, 16.5, NULL, 17.3, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25),
(4162, '2019-03-14', '27138', '2019-07-02', 'QLP1196A', 'Metal Display', 1, 0, 'ALPINE', 0, NULL, '2019-05-30', '2019-07-02', '2019-07-02', NULL, 20.47, 8.27, 3.94, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4163, '2019-03-14', '27619', '2019-07-02', 'QLP1174ABB-S-TM', 'Tray Pack', 1, 0, 'ALPINE', 0, 'w/ try me', '2019-05-10', '2019-04-20', '2019-07-02', NULL, 21.5, 14.75, 3.25, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4164, '2019-05-09', '27293-B3', '2019-07-02', 'QLP930BB', 'Tray Pack', 1, 0, 'RURAL KING', 0, 'Need update per GRAPHIC TEAM', '2019-05-29', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4165, '2019-03-14', '27137', '2019-07-02', 'ORS730', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-06-04', '2019-07-02', '2019-07-02', NULL, 25.8, NULL, 12, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'MICHELLE', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25),
(4166, '2019-03-14', '27286-B4', '2019-07-02', 'COR108MC', 'Color Box', 1, 0, 'BOMGAARS', 0, 'old item', '2019-05-02', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4167, '2019-03-20', '27106', '2019-07-02', 'WTJ217', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM/ need to add candle details', '2019-04-30', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42),
(4168, '2019-03-15', '27045-B / 27046-B', '2019-07-02', 'SLZ136BB-48', 'Tray Pack', 1, 0, 'ACE', 0, 'OLD ITEM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Update needed and urgent !!', NULL, 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45);
INSERT INTO `graphicslogs` (`seq`, `usaofficeentrydate`, `po`, `estimatedshipdate`, `sku`, `graphictype`, `iscustomhangtagneeded`, `iscustomwraptagneeded`, `customername`, `isprivatelabel`, `usanotes`, `estimatedgraphicsdate`, `chinaofficeentrydate`, `confirmedposhipdate`, `jeopardydate`, `graphiclength`, `graphicwidth`, `graphicheight`, `chinanotes`, `finalgraphicsduedate`, `graphicstochinanotes`, `approxgraphicschinasentdate`, `graphicstatus`, `graphicartist`, `graphicartiststartdate`, `graphiccompletiondate`, `duration`, `userseq`, `createdon`, `lastmodifiedon`, `tagtype`, `taglength`, `tagwidth`, `tagheight`, `labellength`, `labelwidth`, `labelheight`, `labeltype`, `draftdate`, `buyerreviewreturndate`, `managerreviewreturndate`, `classcodeseq`) VALUES
(4169, '2019-03-20', '27106', '2019-07-02', 'WTJ226', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM/ need to add candle details', '2019-04-30', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42),
(4170, '2019-03-20', '27106', '2019-07-02', 'WTJ220', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM/ need to add  battery details and how it works', '2019-04-30', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42),
(4171, '2019-03-20', '27106', '2019-07-02', 'WTJ222', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM/ need to add  battery details and how it works', '2019-04-30', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42),
(4172, '2019-05-09', '27319', '2019-07-02', 'SJK146SLR', 'Color Box', 0, 0, 'ALPINE', 0, 'Updated PDQ and COLOR BOX BOX', '2019-05-29', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Update PDQ AND COLOR BOX both.', NULL, NULL, NULL, 'No Need Update', 'Michelle', '2019-07-02', '2019-05-22', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45),
(4173, '2019-03-20', '27115', '2019-07-02', 'BEH200HH', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM: there has to be instructions for this item on the hangtag and battery details.', '2019-06-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34),
(4174, '2019-03-20', '27115', '2019-07-02', 'BEH204HH', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM: there has to be instructions for this item on the hangtag and battery details.', '2019-06-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34),
(4175, '2019-03-20', '27115', '2019-07-02', 'BEH206HH', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM: there has to be instructions for this item on the hangtag and battery details.', '2019-06-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 34),
(4176, '2019-03-14', '25658', '2019-07-02', 'QWR868SLR', NULL, 1, 0, 'ALPINE', 0, 'Need update item dimensions', '2019-02-08', '2019-07-02', NULL, NULL, 10.5, 8.5, 14.25, NULL, '2019-04-03', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-04', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4177, '2019-03-13', '27294', '2019-07-02', 'MAW102BB-TM', 'Color Box', 0, 0, 'ALPINE', 0, 'Needs update/ display box with try me and color box', '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Color box need to be updated too.', '2019-04-03', 'Update', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56),
(4178, '2019-03-27', '27082', '2019-07-02', 'NCY324', 'Color Label', 1, 0, 'ALPINE', 0, 'New packaging; white box with one-side full color label. Talk to Jenn as she requested to get the tag updated.', '2019-04-05', '2019-07-02', '2019-07-02', NULL, 16.1, NULL, 16.1, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8),
(4179, '2019-03-14', '27287B10', '2019-07-02', 'ZNB106M-HH-CC', NULL, 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51),
(4180, '2019-03-14', '27286-B7', '2019-07-02', 'WDS102', 'A4 Label', 0, 1, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-07-02', '2019-07-02', NULL, 0, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-05-28', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54),
(4181, '2019-03-22', '27287-B7', '2019-07-02', 'SLL1933A', 'Tray Pack', 1, 0, 'BOMGAARS', 0, 'new item', '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Pls double check this is old item no new item', '2019-07-02', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-05-28', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37),
(4182, '2019-03-10', '27291-B/27282-B3', '2019-07-02', 'COR174A-TM', 'Color Box', 1, 0, 'RURAL KING', 0, 'PVC label, this packaging should come with Try Me on front and the UPC label should be on the bottom or back ; with Digital Flashing effect (function)', '2019-05-03', '2019-07-02', '2019-07-02', NULL, 8.46, 2.17, 2.36, NULL, '2019-07-02', 'waiting on info & size 3/12, 3/21 - MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-28', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4183, '2019-03-14', '27200', '2019-07-02', 'SLC131BB-9', NULL, 1, 0, 'ALPINE', 0, 'Old item', '2019-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-04-05', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4184, '2019-03-14', '27252-B2', '2019-07-02', 'GIL110', NULL, 0, 0, 'HAYNEEDLE', 0, 'Old item Graphics Needs an update', '2019-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-04-05', 'sent on 3/12/19', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30),
(4185, '2019-03-29', '27093', '2019-07-02', 'TZL200 ', 'Color Label', 0, 0, 'ALPINE', 0, 'Old item New graphics required', '2019-04-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-04-12', 'sent 8/14/18', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4186, '2019-03-22', '27287-b7', '2019-07-02', 'SLL1941', NULL, 1, 0, 'BOMGAARS', 0, 'new item', '2019-05-17', '2019-07-02', NULL, NULL, NULL, NULL, NULL, 'Pls double check this is old item no new item,Also I donâ€™t see PO 27287-B7 have this item.', '2019-04-15', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37),
(4187, '2019-04-24', '27788', '2019-07-02', 'WCT1002', 'Color Label', 0, 0, 'ALPINE', 0, 'update item dimensions / needs update', '2019-04-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68),
(4188, '2019-03-25', '27614', '2019-07-02', 'LAN153ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'Update, add string length per Jennifer', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 0, NULL, NULL, NULL, '2019-04-23', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6),
(4189, '2019-03-06', '27131', '2019-07-02', 'LJJ1084', 'Color Label', 0, 1, 'ALPINE', 0, 'New Item / Bomgaars', '2019-04-19', '2019-07-02', '2019-07-02', NULL, 0, NULL, 5.51, NULL, '2019-07-02', 'waiting on info/size 3/7/19, 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10),
(4190, '2019-03-14', '27320', '2019-07-02', 'PAD550', 'Color Box', 0, 0, 'ALPINE', 0, 'Old item just update the Alpine logo', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-04-26', 'LOGO UPDATED_NO NEED UPDATE SENT ON 3/19', NULL, 'No Update Needed', 'MICHELLE', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4191, '2019-03-14', '27105', '2019-07-02', 'WQA276A', 'Color Box', 0, 0, 'ALPINE', 0, 'update item dimensions', '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'item dimension : Head 5\"L x 2\"W x 10\"H  Wings 3\"L x 1\"W x 5\"H  Tail 4\"L x 1\"W x 12\"H, pls revise it on color box ', '2019-04-28', 'waiting on info & size 3/18 -MR   Head 5\"L x 2\"W x 10\"H  Wings 3\"L x 1\"W x 5\"H  Tail 4\"L x 1\"W x 12\"H', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4192, '2019-03-27', '27583B26', '2019-07-02', 'WAZ122 / WAZ124', NULL, 1, 0, 'RUNNING\'S', 0, 'put how to use battery box instructions since this is packed in brown box now. The hangtag needs to have the try me diecut', '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-04-28', NULL, NULL, 'Sent to Print', 'MCIEHELLE', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61),
(4193, '2019-03-14', '27286-B3', '2019-07-02', 'BST104A', 'Color Box', 0, 1, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-07-02', '2019-07-02', NULL, 10.24, 3.94, 10.24, NULL, '2019-04-29', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-03', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52),
(4194, '2019-03-27', '27583B14', '2019-07-02', 'SOT268ABB', 'Tray Pack', 1, 0, 'RUNNING\'S', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 0, NULL, 5.7, 'RGG asked the custom wraptag changed to custom hang tag', '2019-05-01', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(4195, '2019-04-02', '27286-B4', '2019-07-02', 'COR190A', 'Color Label', 0, 1, 'BOMGAARS', 0, 'Update current packaging per Jennifer', '2019-05-17', '2019-04-12', '2019-06-16', NULL, 12.01, NULL, 6.1, NULL, '2019-05-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4196, '2019-05-07', '27983', '2019-07-02', 'GIL1642', 'Color Label', 0, 0, 'ALPINE', 0, 'Needs update : update dimensions', '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30),
(4197, '2019-04-02', '27286-B4', '2019-07-02', 'COR192A', 'Color Label', 0, 1, 'BOMGAARS', 0, 'Update current packaging per Jennifer', '2019-05-17', '2019-04-12', '2019-06-16', NULL, 12.01, NULL, 6.1, NULL, '2019-05-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4198, '2019-03-14', '26943', '2019-07-02', 'PLF1000U', 'Color Box', 0, 0, 'ALPINE', 0, 'Old item just update the Alpine logo', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-03', 'LOGO UPDATED_NO NEED UPDATE SENT ON 3/19', NULL, 'NO Update Needed', 'MIchelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4199, '2019-03-14', '27321', '2019-07-02', 'PLUV2000', 'Color Box', 0, 0, 'ALPINE', 0, 'Old item just update the Alpine logo', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-03', 'LOGO UPDATED_NO NEED UPDATE SENT ON 3/19', NULL, 'NO Update Needed', 'MIchelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4200, '2019-05-07', '27116-2', '2019-07-02', 'COR162MC', NULL, 1, 0, 'ALPINE', 0, 'New Item', '2019-05-03', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4201, '2019-05-07', '27116-2', '2019-07-02', 'COR152', NULL, 1, 0, 'ALPINE', 0, 'New Item', '2019-05-03', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-16', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4202, '2019-03-27', '27071', '2019-07-02', 'ACM132HH', NULL, 1, 0, 'ALPINE', 0, 'Tag needs to be revised as they have â€˜ in the middle of the text which is a typo. This part \"as â€˜Solitary Bees\"  Update item dimension: 6\"L x 4\"W x 10\"H; WITH ROPE: 17\"H  ', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-14', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49),
(4203, '2019-03-14', '27287-B4', '2019-07-02', 'QLP1103BB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, 'New Item', '2019-05-17', '2019-04-20', '2019-07-02', NULL, 15, 12.75, 4.72, NULL, '2019-05-10', 'duplicated line', NULL, 'No Update Needed', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4204, '2019-03-14', '27200', '2019-07-02', 'QLP1208A', 'Metal Display', 1, 0, 'ALPINE', 0, 'New Item', '2019-07-02', '2019-07-02', '2019-07-02', NULL, 17.8, 7.5, 4, 'Jennifer urgent need this item to ship right away and pls working out graphic asap.', '2019-07-02', 'waiting on info & size 3/18 -MR', NULL, 'sent to print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4205, '2019-04-20', '27286B10', '2019-07-02', 'QLP1013ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-04-20', '2019-07-02', NULL, 15.35, 12.99, 5.51, NULL, '2019-05-10', 'duplicated line', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4206, '2019-04-20', '27286B10', '2019-07-02', 'QLP1200ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-04-20', '2019-07-02', NULL, 14.96, 12.6, 4.72, NULL, '2019-05-10', 'duplicated line', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4207, '2019-04-20', '27286B10', '2019-07-02', 'QLP1204ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-04-20', '2019-07-02', NULL, 14.17, 14.96, 4.72, NULL, '2019-05-10', 'duplicated line', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4208, '2019-04-20', '27286B10', '2019-07-02', 'QLP816ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-04-20', '2019-07-02', NULL, 13.39, 17.32, 5.51, NULL, '2019-05-10', 'duplicated line', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4209, '2019-04-20', '27286B10', '2019-07-02', 'QLP1174ABB-S-TM', 'Metal Display', 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-04-20', '2019-07-02', NULL, 21.5, 14.75, 3.25, NULL, '2019-05-10', 'duplicated line', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4210, '2019-03-14', '27286B10', '2019-07-02', 'QLP1013ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, 'New Item', '2019-05-17', '2019-04-20', '2019-07-02', NULL, 15.35, 12.99, 5.51, NULL, '2019-05-10', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-31', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4211, '2019-03-14', '27286B10', '2019-07-02', 'QLP1200ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, 'New Item', '2019-05-17', '2019-04-20', '2019-07-02', NULL, 14.96, 12.6, 4.72, NULL, '2019-05-10', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4212, '2019-03-14', '27286B10', '2019-07-02', 'QLP1204ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, 'New Item', '2019-05-17', '2019-04-20', '2019-07-02', NULL, 14.17, 14.96, 4.72, NULL, '2019-05-10', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4213, '2019-03-14', '27286B10', '2019-07-02', 'QLP816ABB', 'Tray Pack', 1, 0, 'BOMGAARS', 0, 'New Item', '2019-05-17', '2019-04-20', '2019-07-02', NULL, 13.39, 17.32, 5.51, NULL, '2019-05-10', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4214, '2019-04-03', '27698-A4 / 27703-A4 / 277', '2019-07-02', 'KGD242ABB', 'Color Label', 0, 0, 'MENARDS', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 10.24, NULL, 1.18, 'Packing is white box with one side full color lable.', '2019-07-02', 'Menards', NULL, 'Sent to Print', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4215, '2019-04-30', '27319', '2019-07-02', 'SJK146SLR', 'Color Box', 0, 0, 'ALPINE', 0, 'old item color box + color display', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-10', NULL, NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45),
(4216, '2019-04-20', '27703-A4', '2019-07-02', 'KGD242ABB', 'Tray Pack', 0, 0, 'MENARDS', 0, NULL, '2019-06-07', '2019-04-20', '2019-07-07', NULL, 11.22, 7.99, 1.38, NULL, '2019-05-10', NULL, NULL, 'No Update Needed', 'michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4217, '2019-04-15', '27384-B2', '2019-07-02', 'QWR916', NULL, 1, 0, 'JAVIC', 0, 'new custom hangtag with instructions on battery details/timer', '2019-07-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Shanti note: 1.Type of battery Box â€“ it is clip style \n2.Functionality â€“ it is on/off switch. Switch left for ON1(LED only), center to turn off, right to switch ON2(LED&MUSIC)? Automatic timing:6hours ON,18 hours OFF.', '2019-05-10', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4218, '2019-04-15', '27384-B2', '2019-07-02', 'QWR938', NULL, 1, 0, 'JAVIC', 0, 'Update : Include battery info on the hang tag', '2019-07-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Shanti note: 1.Type of battery Box â€“ it is screw box  \n2.Functionality â€“ it is push button,push once to turn on,twice for off Automatic timing:6hours ON,18 hours OFF', '2019-05-10', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4219, '2019-05-24', '28052', '2019-07-02', 'WIN1136', 'Color Box', 0, 0, 'ALPINE', 0, NULL, '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(4220, '2019-05-22', '27290-B5 / 27292-B5', '2019-07-02', 'LJJ910', 'Tray Pack', 1, 0, 'RURAL KING', 0, 'Needs update', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-05-23', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10),
(4221, '2019-03-14', '27287-B8', '2019-07-02', 'WTJ236ABB', 'Tray Pack', 0, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-07-02', '2019-07-02', NULL, 15.74, 10.63, 1.18, NULL, '2019-05-24', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42),
(4222, '2019-05-29', '27126', '2019-07-02', 'KGD192ABB-CC-TM', 'Color Label', 1, 0, 'ALPINE', 0, 'Needs update to have the correct back info', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4223, '2019-05-29', '27126', '2019-07-02', 'KGD194ABB-CC-TM', 'Color Label', 1, 0, 'ALPINE', 0, 'Needs update to have the correct back info', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4224, '2019-05-29', '27126', '2019-07-02', 'KGD196ABB-CC-TM', 'Color Label', 1, 0, 'ALPINE', 0, 'Needs update to have the correct back info', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4225, '2019-04-24', '27945', '2019-07-02', 'TOM252 ', NULL, 0, 0, 'ALPINE', 0, 'Old item', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24', 'This item is shipped in a brown box', NULL, 'No Update Needed', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74),
(4226, '2019-05-08', '27798', '2019-07-02', 'SOT101ABB', 'Tray Pack', 1, 0, 'MID-STATES', 0, 'old item', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-03', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65),
(4227, '2019-04-18', '27802', '2019-07-02', 'WQA1028ABB', NULL, 1, 0, 'MID-STATES', 0, 'new custom hangtag with instructions on battery details/timer', '2019-05-24', '2019-05-06', '2019-06-23', NULL, NULL, NULL, NULL, NULL, '2019-05-26', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4228, '2019-04-18', '27802', '2019-07-02', 'WQA1238ABB', NULL, 1, 0, 'MID-STATES', 0, 'new custom hangtag with instructions on battery details/timer', '2019-05-24', '2019-05-06', '2019-06-23', NULL, NULL, NULL, NULL, NULL, '2019-05-26', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4229, '2019-03-14', '27139', '2019-07-02', 'QLP1017ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, NULL, '2019-05-24', '2019-07-02', '2019-07-02', NULL, 16.14, 16.14, 4.72, NULL, '2019-05-30', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4230, '2019-03-14', '27139', '2019-07-02', 'QLP1186ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, NULL, '2019-05-24', '2019-07-02', '2019-07-02', NULL, 14.96, 16.93, 3.94, NULL, '2019-05-30', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4231, '2019-03-14', '27139', '2019-07-02', 'QLP1174A-L-TM', 'Metal Display', 1, 0, 'ALPINE', 0, 'Hang tag with try me (try me can take off)', '2019-05-24', '2019-07-02', '2019-07-02', NULL, 31, 13.8, 8, NULL, '2019-05-30', 'waiting on info & size 3/18 -MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4232, '2019-03-26', '27581', '2019-07-02', 'QLP1316SLR-2', NULL, 1, 0, 'ALPINE', 0, 'New Item', '2019-07-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4233, '2019-03-09', '27286-B2', '2019-07-02', 'BCM104HH', NULL, 1, 0, 'BOMGAARS', 0, 'New Item', '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-04', 'This use a generic tag', NULL, 'No Update Needed', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53),
(4234, '2019-03-14', '27286-B9', '2019-07-02', 'CIM304HH-L', NULL, 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-05', 'These use a generic tag', NULL, 'No Update Needed', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4235, '2019-03-14', '27286-B9', '2019-07-02', 'CIM304HH-S', NULL, 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-05', 'These use a generic tag', NULL, 'No Update Needed', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4236, '2019-03-14', '27286-B9', '2019-07-02', 'CIM306HH', NULL, 1, 0, 'BOMGAARS', 0, NULL, '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-05', 'These use a generic tag', NULL, 'No Update Needed', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4237, '2019-05-01', '28041-B3', '2019-07-02', 'ACM100HH', NULL, 1, 0, 'ACE', 0, ' old item Needs update', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-31', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49),
(4238, '2019-04-02', '27583B12', '2019-07-02', 'CIM252HH-TM', NULL, 1, 0, 'RUNNING\'S', 0, 'HANGTAG WITH TRY ME', '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-05', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38),
(4239, '2019-03-26', '27583B27', '2019-07-02', 'WHS106ABB-MC-TM', 'Color Label', 1, 0, 'RUNNING\'S', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 16.73228346456693, NULL, 1.377952755905512, NULL, '2019-06-05', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40),
(4240, '2019-03-26', '27583B27', '2019-07-02', 'WHS112MC-TM', 'Color Label', 1, 0, 'RUNNING\'S', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 7.086614173228346, NULL, 1.377952755905512, NULL, '2019-06-05', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40),
(4241, '2019-03-26', '27583B27', '2019-07-02', 'WHS134MC', 'Color Label', 1, 0, 'RUNNING\'S', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 9.05511811023622, NULL, 11.22047244094488, NULL, '2019-06-05', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40),
(4242, '2019-04-23', '27071', '2019-07-02', 'ACM126HH', NULL, 1, 0, 'ALPINE', 0, 'Update item dimension: 7\"L x 4\"W x 10\"H; WITH ROPE: 19\" H ', '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-10', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49),
(4243, '2019-03-14', '27118', '2019-07-02', 'LPA108L-GN', NULL, 0, 0, 'ALPINE', 0, 'Needs Update - hang tag and graphics', '2019-07-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-05', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4244, '2019-03-14', '27118', '2019-07-02', 'LPA108L-SL', NULL, 0, 0, 'ALPINE', 0, 'Needs Update - hang tag and graphics', '2019-07-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-05', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23),
(4245, '2019-05-07', '27984', '2019-12-01', 'GIL1644', 'Color Label', 0, 0, 'ALPINE', 0, 'Needs update : update dimensions', '2019-11-01', '2019-07-02', '2019-12-01', NULL, NULL, NULL, NULL, NULL, '2019-06-05', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30),
(4246, '2019-03-15', '27279-B3', '2019-07-02', 'EUT200MC-4-TM', 'Window Box', 1, 0, 'RURAL KING', 0, 'NEW ITEM', '2019-05-03', '2019-07-02', '2019-07-02', NULL, 11.22, 2.95, 9.055, NULL, '2019-06-07', 'Cable Length Confirmed 06-03-2019', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(4247, '2019-03-09', '27286-B', '2019-07-02', 'ORS780BB', 'Color Label', 0, 0, 'BOMGAARS', 0, 'New Item / generic color label', '2019-05-17', '2019-07-02', '2019-07-02', NULL, 13.72, NULL, 4.72, NULL, '2019-06-07', 'These use a generic tag', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25),
(4248, '2019-03-09', '27286-B', '2019-07-02', 'ORS782BB', 'Color Label', 0, 0, 'BOMGAARS', 0, 'New Item / generic color label', '2019-05-17', '2019-07-02', '2019-07-02', NULL, 13.72, NULL, 4.72, NULL, '2019-06-07', 'These use a generic tag', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25),
(4249, '2019-03-09', '27286-B', '2019-07-02', 'ORS784BB', 'Color Label', 0, 0, 'BOMGAARS', 0, 'New Item / generic color label', '2019-05-17', '2019-07-02', '2019-07-02', NULL, 13.72, NULL, 4.72, NULL, '2019-06-07', 'These use a generic tag', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-01', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25),
(4250, '2019-05-17', '27985', '2019-07-02', 'HEH208', NULL, 1, 0, 'ALPINE', 0, 'New hangtag required - old layout', '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-07', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60),
(4251, '2019-05-17', '27985', '2019-07-02', 'HEH210', NULL, 1, 0, 'ALPINE', 0, 'New hangtag required - old layout', '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60),
(4252, '2019-05-01', '28041-B', '2019-07-02', 'YEN160HH-BL', NULL, 1, 0, 'ACE', 0, 'Update Item Dimension', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-04', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18),
(4253, '2019-06-19', '27793', '2019-07-02', 'QWR442', 'Color Label', 0, 0, 'ALPINE', 0, NULL, '2019-06-03', '2019-07-02', '2019-07-02', NULL, 17.52, 14.57, NULL, NULL, '2019-07-09', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
(4254, '2019-05-20', '28176 / 28181', '2019-07-02', 'DIG278', 'Color Label', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 15.16, NULL, 10.63, 'Update color label size', '2019-07-08', '*Label Size to be confirmed', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4255, '2019-05-20', '28176 / 28181', '2019-07-02', 'DIG282', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 8.27, NULL, 11.69, NULL, '2019-07-01', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4256, '2019-05-20', '28176 / 28181', '2019-07-02', 'DIG286', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-01', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-18', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4257, '2019-05-20', '28176 / 28181', '2019-07-02', 'DIG284', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 7.48, NULL, 12.99, NULL, '2019-07-01', 'Will Need a Tag if Removed from Box', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4258, '2019-06-15', '27892-b', '2019-07-07', 'SLC131CC-TM', 'Floor Display', 1, 0, 'SBAR\'S', 0, NULL, '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Per graphic team need update', '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4259, '2019-05-23', '28198', '2019-07-02', 'TZL154', 'Color Box', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 11.02, 9.45, 15.75, 'URGENT', '2019-07-09', 'waiting on dieline 6/11,18 MR', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4261, '2019-06-19', '28198', '2019-07-02', 'TZL226', 'A4 Label', 0, 0, 'ALPINE', 0, NULL, '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-09', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4262, '2019-06-12', '27296-B2', '2019-07-02', 'JFH1052A', NULL, 1, 0, 'FRED MEYER', 1, NULL, '2019-06-21', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4263, '2019-04-18', '27786', '2019-07-02', 'BVF140', 'Color Label', 1, 0, 'MID-STATES', 0, 'New Item', '2019-06-28', '2019-07-02', '2019-07-02', NULL, 15.35, NULL, 5.51, NULL, '2019-06-30', '*Box Label Size to be confirmed + Photo', NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72),
(4264, '2019-06-15', '27384-B', '2019-07-02', 'QLP232', 'Floor Display', 1, 0, 'JAVIC', 0, NULL, '2019-07-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Per graphic team need update', '2019-07-05', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4265, '2019-05-21', '28050', '2019-07-02', 'TIZ122', 'Color Label', 0, 0, 'ALPINE', 0, 'NEED AN UPDATE (ITEM DIMENSION)', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-06', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 71),
(4266, '2019-06-24', '27303-2', '2019-07-02', 'WTJ100L', NULL, 1, 0, 'ALPINE', 0, 'NEW', '2019-06-06', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-14', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4267, '2019-06-14', '28191', '2019-07-02', 'ZEN276S', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 16.5, NULL, 20, NULL, '2019-07-04', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4268, '2019-06-14', '28191', '2019-07-02', 'ZEN354', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 13.5, NULL, 9.5, NULL, '2019-07-04', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4269, '2019-06-14', '28191', '2019-07-02', 'ZEN356', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 14.5, NULL, 8.5, NULL, '2019-07-04', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4270, '2019-05-23', '28189', '2019-07-02', 'YHL124', 'Color Label', 0, 0, 'ALPINE', 0, 'new item', '2019-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-06', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43),
(4271, '2019-06-14', '28191', '2019-07-02', 'ZEN692', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 13.5, NULL, 8.5, NULL, '2019-07-04', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4272, '2019-06-14', '28191', '2019-07-02', 'ZEN694', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 13.5, NULL, 8.5, NULL, '2019-07-04', NULL, NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4273, '2019-05-20', '28176 / 28181', '2019-07-02', 'DIG276', 'Color Label', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 8.27, NULL, 11, 'Update color label size', '2019-07-09', '*Label Size to be confirmed', NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4274, '2019-05-21', '28175', '2019-07-02', 'KGD250ABB-S', 'Tray Pack', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 14.76, 13.19, 1.77, 'DIE CUT SAVED ', '2019-07-07', 'Need Traypack Diecut', NULL, 'Preparing for Print', 'michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4275, '2019-05-21', '28175', '2019-07-02', 'KGD328ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 14.57, 14.57, 2.17, 'DIE CUT SAVED ', '2019-07-07', 'Need Traypack Diecut', NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-24', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4276, '2019-06-18', '28061-BP', '2019-07-02', 'GXT518', 'Color Box', 0, 0, 'ALPINE', 0, 'NEW', '2019-07-05', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'missing dieline 6/20 ', '2019-07-08', 'missing dieline 6/20', NULL, 'Missing Info from China', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4277, '2019-06-14', '28191', '2019-07-02', 'ZEN882', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-04', 'missing size, maria to check 6/19', NULL, 'Missing Info from China', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4278, '2019-06-21', '28175', '2019-07-02', 'KGD285ABB', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 11.73, 1.97, NULL, NULL, '2019-07-11', NULL, NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4279, '2019-06-21', '28175', '2019-07-02', 'KGD287ABB', 'Color Box', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 11.73, 1.97, NULL, NULL, NULL, NULL, NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4280, '2019-05-20', '28185', '2019-07-02', 'HGY416ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', NULL, '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-12', 'Need Traypack Diecut', NULL, 'Missing Info from China', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4281, '2019-05-20', '28185', '2019-07-02', 'HGY440ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', NULL, '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-12', 'Need Traypack Diecut', NULL, 'Missing Info from China', NULL, '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4282, '2019-05-20', '28185', '2019-07-02', 'HGY426', 'Window Box', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', NULL, '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-12', 'Use Generic Globe Box', NULL, 'In Progress', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4283, '2019-05-21', '28175', '2019-07-02', 'KGD247ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 15.94, 14.37, 1.97, 'DIE CUT SAVED ', '2019-07-17', 'Need Traypack Diecut', NULL, 'Buyer\'s Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4284, '2019-06-12', '28052', '2019-07-02', 'WIN1136', 'Color Box', 0, 0, 'ALPINE', 0, NULL, '2019-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12', 'per maria', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(4285, '2019-05-20', '28182 / 28184', '2019-07-02', 'EUT165ABB-TM', 'Tray Pack', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12', 'Will use EUT166BB-WW-TM  as a template + Photos', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(4286, '2019-05-20', '28185', '2019-07-02', 'HGY382BL-L', 'Window Box', 0, 0, 'ALPINE', 0, 'NEW ITEM + TRY ME', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 8.46, 8.46, 8.19, NULL, '2019-07-14', 'Diecut Received - Generic Box for all 4 Colors', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4287, '2019-05-23', '28198', '2019-07-02', 'TZL140', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', 'No Order, Do Not Send to Print per Maria 6/14', NULL, 'Cancelled', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4288, '2019-05-23', '28198', '2019-07-02', 'TZL250', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-14', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4289, '2019-05-23', '28198', '2019-07-02', 'TZL268', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-14', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66);
INSERT INTO `graphicslogs` (`seq`, `usaofficeentrydate`, `po`, `estimatedshipdate`, `sku`, `graphictype`, `iscustomhangtagneeded`, `iscustomwraptagneeded`, `customername`, `isprivatelabel`, `usanotes`, `estimatedgraphicsdate`, `chinaofficeentrydate`, `confirmedposhipdate`, `jeopardydate`, `graphiclength`, `graphicwidth`, `graphicheight`, `chinanotes`, `finalgraphicsduedate`, `graphicstochinanotes`, `approxgraphicschinasentdate`, `graphicstatus`, `graphicartist`, `graphicartiststartdate`, `graphiccompletiondate`, `duration`, `userseq`, `createdon`, `lastmodifiedon`, `tagtype`, `taglength`, `tagwidth`, `tagheight`, `labellength`, `labelwidth`, `labelheight`, `labeltype`, `draftdate`, `buyerreviewreturndate`, `managerreviewreturndate`, `classcodeseq`) VALUES
(4290, '2019-05-23', '28198', '2019-07-02', 'TZL272', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-14', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4291, '2019-05-23', '28198', '2019-07-02', 'TZL284', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-14', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4292, '2019-05-20', '28185', '2019-07-02', 'HGY382CL-L', 'Window Box', 0, 0, 'ALPINE', 0, 'NEW ITEM + TRY ME', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 8.46, 8.46, 8.19, NULL, '2019-07-14', 'Diecut Received - Generic Box for all 4 Colors', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4293, '2019-05-17', '27986', '2019-07-02', 'GRS688', 'Window Box', 0, 0, 'ALPINE', 0, 'Update item dimension to : 10\"L x 10\"W x 12\"H', '2019-08-16', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-04', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4294, '2019-04-18', '27779', '2019-07-02', 'LJJ1086', NULL, 1, 0, 'MID-STATES', 0, 'new custom hangtag with instructions on battery details/timer', '2019-06-07', '2019-05-20', '2019-07-07', NULL, NULL, NULL, NULL, 'Shanti Note: 27779 already cancled open window box to brown carton.\nType of battery Box â€“it is clip box\nFunctionality â€“ it is on/off switch,Switch left for ON,switch right for OFF.  Automatic timing:6 hours ON,18 hours OFF.', '2019-06-09', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-07-02', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10),
(4295, '2019-05-23', '28198', '2019-07-02', 'TZL288', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', 'No Order, Do Not Send to Print per Maria 6/14', NULL, 'Cancelled', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4296, '2019-05-01', '28041-B2', '2019-07-02', 'LJJ472A', NULL, 1, 0, 'ACE', 0, 'Update Item Dimension', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-14', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-06', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10),
(4297, '2019-05-24', '27385', '2019-07-02', 'QTT294ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'Update to Tray Pack and Back Card', '2019-05-17', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-06-19', 'Update to Tray Pack and Back Card', NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-06', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14),
(4298, '2019-05-23', '28198', '2019-07-02', 'TZL292', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4299, '2019-05-23', '28198', '2019-07-02', 'TZL296', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', 'No Order, Do Not Send to Print per Maria 6/14', NULL, 'Cancelled', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4300, '2019-04-26', '27892-B2', '2019-07-02', 'SOT102TM', 'Floor Display', 1, 0, 'SBAR\'S', 0, 'Update.Item number should come with AC Moore item number,Aslo the UPC number need to come with AC number', '2019-06-07', '2019-07-02', '2019-07-02', NULL, 16.54, 16.15, 31, 'The Diecut was save into T drive. It\'s new item for RGG factory.', '2019-06-13', 'USES CUSTOM SKU # / New Diecut Received', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-13', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(4301, '2019-05-20', '28107/28108', '2019-07-02', 'QLP1344SLR-HH-S-TM', NULL, 1, 0, 'ALPINE', 0, 'New - custom with light &  try me', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Custom try me hangtag and no need info from china ofifce', '2019-06-19', 'Home & Garden TRY ME Tag + Battery Info', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4302, '2019-05-20', '28107/28108', '2019-07-02', 'QLP1344SLR-HH-L-TM', NULL, 1, 0, 'ALPINE', 0, 'New - custom with light &  try me', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Custom try me hangtag and no need info from china ofifce', '2019-06-19', 'Home & Garden TRY ME Tag + Battery Info', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4303, '2019-05-20', '28107/28108', '2019-07-02', 'QLP1350SLR-HH-TM', NULL, 1, 0, 'ALPINE', 0, 'New - custom with light &  try me', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Custom try me hangtag and no need info from china ofifce', '2019-06-19', 'Home & Garden TRY ME Tag + Battery Info', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4304, '2019-05-20', '28107/28108', '2019-07-02', 'QLP1352SLR-HH-TM', NULL, 1, 0, 'ALPINE', 0, 'New - custom with light &  try me', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Custom try me hangtag and no need info from china ofifce', '2019-06-19', 'Home & Garden TRY ME Tag + Battery Info', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4305, '2019-04-25', '27829-BP', '2019-07-02', 'GEM178', 'Color Label', 0, 0, 'ALPINE', 0, 'The label needs to be updated to remove the Prop 65 logo from it.', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4306, '2019-05-20', '28107/28108', '2019-07-02', 'QLP1354SLR-HH-TM', NULL, 1, 0, 'ALPINE', 0, 'New - custom with light &  try me', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Custom try me hangtag and no need info from china ofifce', '2019-06-19', 'Home & Garden TRY ME Tag + Battery Info', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4307, '2019-05-20', '28107/28108', '2019-07-02', 'QLP1356SLR-HH-TM', NULL, 1, 0, 'ALPINE', 0, 'New - custom with light &  try me', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Custom try me hangtag and no need info from china ofifce', '2019-06-19', 'Home & Garden TRY ME Tag + Battery Info', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4308, '2019-05-20', '28107/28108', '2019-07-02', 'QLP1358SLR-HH-TM', NULL, 1, 0, 'ALPINE', 0, 'New - custom with light &  try me', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'Custom try me hangtag and no need info from china ofifce', '2019-06-19', 'Home & Garden TRY ME Tag + Battery Info', NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4309, '2019-05-20', '28185', '2019-07-02', 'HGY382GN-L', 'Window Box', 0, 0, 'ALPINE', 0, 'NEW ITEM + TRY ME', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 8.46, 8.46, 8.19, NULL, '2019-07-14', 'Diecut Received - Generic Box for all 4 Colors', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4310, '2019-05-20', '28185', '2019-07-02', 'HGY382YL-L', 'Window Box', 0, 0, 'ALPINE', 0, 'NEW ITEM + TRY ME', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 8.46, 8.46, 8.19, NULL, '2019-07-14', 'Diecut Received - Generic Box for all 4 Colors', NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-06-26', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70),
(4313, '2019-05-20', '28181', '2019-07-02', 'DIG288BB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-09-06', '2019-07-02', NULL, NULL, NULL, NULL, NULL, 'item cancelled due to can\'t reach our target price.', '2019-06-26', 'Need Traypack Diecut', NULL, 'Cancelled', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4316, '2019-06-14', '28059', '2019-07-02', 'GXT268', 'Color Label', 0, 0, 'ALPINE', 0, 'Needs Update', '2019-07-12', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-04', NULL, NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4317, '2019-07-02', '28180', '2019-07-02', 'KGD252SLR', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM + CUSTOM WITH LIGHTS', '2019-10-11', '2019-07-02', '2019-07-02', NULL, 8.78, 7.6, NULL, NULL, '2019-07-11', '*Label Size to be confirmed', NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4318, '2019-07-02', '27384-B6', '2019-07-02', 'WTJ104L', NULL, 1, 0, 'ALPINE', 0, 'Tag Update to newer style back', '2019-07-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-05', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4319, '2019-05-21', '28180', '2019-07-02', 'KGD254SLR', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM + CUSTOM WITH LIGHTS', '2019-10-11', '2019-07-02', '2019-07-02', NULL, 23.5, 8.86, NULL, NULL, '2019-07-11', '*Label Size to be confirmed', NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4320, '2019-05-21', '28180', '2019-07-02', 'KGD256SLR', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM + CUSTOM WITH LIGHTS', '2019-10-11', '2019-07-02', '2019-07-02', NULL, 9.17, 9.76, NULL, NULL, '2019-07-11', '*Label Size to be confirmed', NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4321, '2019-06-14', '28194', '2019-07-02', 'ZEN870', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 5, NULL, 12, NULL, '2019-07-04', NULL, NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4322, '2019-06-14', '28194', '2019-07-02', 'ZEN872', 'Color Label', 0, 0, 'ALPINE', 0, 'New', '2019-07-12', '2019-07-02', '2019-07-02', NULL, 5, NULL, 12, NULL, '2019-07-04', NULL, NULL, 'Robby Reviewing', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4323, '2019-05-29', '27922', '2019-07-02', 'DIG100XS-BR', 'Color Label', 0, 0, 'ALPINE', 0, 'Needs update to make all 4 uniform', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-29', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4324, '2019-05-29', '27922', '2019-07-02', 'DIG100XS-GN', 'Color Label', 0, 0, 'ALPINE', 0, 'Needs update to make all 4 uniform', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-29', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4325, '2019-05-29', '27922', '2019-07-02', 'DIG100XS-RD', 'Color Label', 0, 0, 'ALPINE', 0, 'Needs update to make all 4 uniform', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-29', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4326, '2019-05-29', '28248', '2019-07-02', 'DIG100XS', 'Color Label', 0, 0, 'ALPINE', 0, 'Needs update to make all 4 uniform', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Alex', '2019-07-02', '2019-05-29', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4327, '2019-05-23', '28199', '2019-07-02', 'TZL206', 'A4 Label', 0, 0, 'ALPINE', 0, 'New item', '2019-10-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-11', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-14', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4328, '2019-05-24', '28050', '2019-07-02', 'TIZ122', 'Color Label', 0, 0, 'ALPINE', 0, NULL, '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', '*Label Size to be confirmed', NULL, 'Sent to Print', 'michelle', '2019-07-02', '2019-06-18', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 71),
(4329, '2019-06-12', '28198', '2019-07-02', 'TZL226', NULL, 0, 0, 'ALPINE', 0, 'New', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-07', 'DUPLicated line', NULL, 'No Update Needed', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66),
(4330, '2019-06-13', '27892-B', '2019-07-02', 'SLC131CC-TM', 'Floor Display', 1, 0, 'SBAR\'S', 0, 'Needs update', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, '06-07-19', NULL, 'duplicated line', NULL, 'No Update Needed', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4331, '2019-06-13', '28384', '2019-07-02', 'DIG100XS', 'Color Label', 0, 0, 'ALPINE', 0, 'Update Call Out', '2019-08-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-20', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4332, '2019-06-12', '27583B26', '2019-07-02', 'WAZ122 / WAZ124', NULL, 1, 0, 'RUNNING\'S', 0, NULL, '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-02', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-12', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61),
(4333, '2019-06-13', '28384', '2019-07-02', 'DIG100XS-RD', 'Color Label', 0, 0, 'ALPINE', 0, 'Update Call Out', '2019-08-02', NULL, NULL, NULL, NULL, NULL, NULL, '08-02-19', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-20', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4334, '2019-06-13', '28384', '2019-07-02', 'DIG100XS-GN', 'Color Label', 0, 0, 'ALPINE', 0, 'Update Call Out', '2019-08-02', NULL, NULL, NULL, NULL, NULL, NULL, '08-02-19', NULL, NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-20', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69),
(4335, '2019-05-23', '28191', '2019-07-02', 'ZEN882', 'Color Label', 0, 0, 'ALPINE', 0, 'new item', '2019-07-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-12', '*Label Size to be confirmed', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4336, '2019-05-23', '28225', '2019-07-02', 'WQA1106ABB', 'Tray Pack', 1, 0, 'ALPINE', 0, 'NEW ITEM + CUSTOM WITH LIGHTS', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', 'Need Traypack Diecut', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4337, '2019-05-23', '28225', '2019-07-02', 'WQA1218ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'new item', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', 'Need Traypack Diecut', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4338, '2019-05-23', '28225', '2019-07-02', 'WQA1370ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'new item', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', 'Need Traypack Diecut', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4339, '2019-05-23', '28225', '2019-07-02', 'WQA1372SLR-HH', NULL, 1, 0, 'ALPINE', 0, 'NEW ITEM + CUSTOM WITH LIGHTS', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', NULL, NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4340, '2019-05-21', '28175', '2019-07-02', 'KGD272SLR', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM + CUSTOM WITH LIGHTS', '2019-07-12', NULL, NULL, NULL, NULL, NULL, NULL, 'T:\\China Office Sample Photos      already have photos, pls check', '2019-07-12', '*Box Label Size to be confirmed + Photo', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4341, '2019-05-21', '28175', '2019-07-02', 'KGD274SLR', 'Color Label', 1, 0, 'ALPINE', 0, 'NEW ITEM + CUSTOM WITH LIGHTS', '2019-07-12', NULL, NULL, NULL, NULL, NULL, NULL, 'T:\\China Office Sample Photos    already have photos, pls check', '2019-07-12', '*Box Label Size to be confirmed + Photo', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32),
(4342, '2019-06-12', '28026', '2019-07-02', 'UL105CL', NULL, 0, 0, 'ALPINE', 0, 'New', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', 'missing type of packaging ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20),
(4343, '2019-04-25', '27947-BP', '2019-07-02', 'QLP542SLR-BR', NULL, 1, 0, 'ALPINE', 0, ' NEW TAG REQUIRED + NEW WARNING HANGTAG ON SPEAKER', '2019-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-06', NULL, NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4344, '2019-04-25', '27948-BP', '2019-07-02', 'QLP542SLR-GR', NULL, 1, 0, 'ALPINE', 0, ' NEW TAG REQUIRED + NEW WARNING HANGTAG ON SPEAKER', '2019-09-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-06', NULL, NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4),
(4345, '2019-05-23', '28226', '2019-07-02', 'WQA1310ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'new item', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', 'Need Traypack Diecut', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4346, '2019-05-23', '28226', '2019-07-02', 'WQA1312ABB', 'Tray Pack', 0, 0, 'ALPINE', 0, 'new item', '2019-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-21', 'Need Traypack Diecut', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39),
(4347, '2019-05-20', '28187', '2019-07-02', 'WIN1008', 'Color Label', 0, 0, 'ALPINE', 0, 'NEW ITEM', '2019-10-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-18', '*Label Size to be confirmed - Fountain', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
(4348, '2019-05-23', '28194', '2019-07-02', 'ZEN870', 'Color Label', 0, 0, 'ALPINE', 0, 'new item', '2019-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-01', '*Label Size to be confirmed', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4349, '2019-05-23', '28194', '2019-07-02', 'ZEN872', 'Color Label', 0, 0, 'ALPINE', 0, 'new item', '2019-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-01', '*Label Size to be confirmed', NULL, 'Not Started', NULL, NULL, NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4350, '2019-06-19', 'NO OPEN PO', NULL, 'SOT162BB', 'Tray Pack', 1, 0, 'ALPINE', 0, 'Update item size to 4*1*34\"', NULL, '2019-07-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'size on graphics already relfects this ', NULL, 'No Update Needed', 'Michelle', '2019-07-02', NULL, NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21),
(4351, '2019-06-19', '27579', '2019-07-02', 'WTJ104L', NULL, 1, 0, 'ALPINE', 0, 'New', '2019-06-02', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, NULL, '2019-07-09', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16),
(4352, '2019-06-21', '27583B19', '2019-07-02', 'USA930ABB', 'Color Label', 1, 0, 'RUNNING\'S', 0, NULL, '2019-06-07', '2019-07-02', '2019-07-02', NULL, NULL, NULL, NULL, 'update the hangtag and color label  ', '2019-07-11', NULL, NULL, 'Sent to Print', 'Michelle', '2019-07-02', '2019-06-21', NULL, 1, '2019-07-02 10:19:35', '2019-07-02 10:19:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46);

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
-- Dumping data for table `items`
--

INSERT INTO `items` (`seq`, `itemno`, `description`, `class`, `dept`, `status`, `unit`, `pccs`, `disc`, `instockqty`, `allocqty`, `soqty`, `avqty`, `poqty`, `owqty`, `projqty`, `ytdsoldqty`, `lastyearsoldqty`, `comdship`, `showspecial`, `distributor`, `dealerprice`, `crzydissp`, `qtywt`, `minstk`, `itemcost`, `createdon`, `lastmodifiedon`, `isenabled`) VALUES
(9959, 'GRS632AHH', '10\" Gazing Globe w/Flower/Butterfly Pattern and Metal Stand', 'GRS', 'GLOBES', '2018.COM', NULL, 2, NULL, 14, NULL, NULL, 14, NULL, NULL, 14, 2, 1, 42.11, NULL, NULL, 40, NULL, 3.75, NULL, NULL, '2019-02-15 17:09:57', '2019-02-15 17:09:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itemspecifications`
--

CREATE TABLE `itemspecifications` (
  `seq` bigint(20) NOT NULL,
  `itemno` varchar(50) NOT NULL,
  `oms` varchar(10) DEFAULT NULL,
  `item1description` varchar(2500) DEFAULT NULL,
  `item1length` double DEFAULT NULL,
  `item1width` double DEFAULT NULL,
  `item1height` double DEFAULT NULL,
  `item2description` varchar(2500) DEFAULT NULL,
  `item2length` double DEFAULT NULL,
  `item2width` double DEFAULT NULL,
  `item2height` double DEFAULT NULL,
  `item3description` varchar(2500) DEFAULT NULL,
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
  `material1percent` varchar(10) DEFAULT NULL,
  `material2` varchar(25) DEFAULT NULL,
  `material2percent` varchar(11) DEFAULT NULL,
  `material3` varchar(25) DEFAULT NULL,
  `material3percent` varchar(11) DEFAULT NULL,
  `material4` varchar(25) DEFAULT NULL,
  `material4percent` varchar(11) DEFAULT NULL,
  `material5` varchar(25) DEFAULT NULL,
  `material5percent` varchar(11) DEFAULT NULL,
  `materialtotalpercent` varchar(11) DEFAULT NULL,
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
-- Dumping data for table `itemspecifications`
--

INSERT INTO `itemspecifications` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(1, 'QLP268ABB-DSP', 'QLP', 'Insect/Flower MOTION LED LIGHT Garden Stake with Wall Plug - Hummingbird', 5, 4, 31, 'Insect/Flower MOTION LED LIGHT Garden Stake with Wall Plug - Dragonfly - test', 6, 3, 31, 'Insect/Flower MOTION LED LIGHT Garden Stake with Wall Plug - Butterfly - test', 6, 3, 31, 9.75, 9.75, 17.5, NULL, NULL, NULL, 'Solar motion stake w/hummingbird,dragonfly,butterfly,sunflower:18pcs LED                                                                                         LED:sunflower-yello 1.5lm/bird-white 3.5lm/butterfly-red 1.5lm/dragonfly-green 1.7lm                                                                   Topper KD,stake KD                        \nchanged to be plug working ', 'Xiamen', 'China', 'Plastic', '95%', 'Solar', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'sunflower-yellow 1.5lm/bird-white 3.5lm/butterfly-red 1.5lm/dragonfly-green 1.7lm    ', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(2, 'QLP228ABB-DSP', 'QLP', 'Starburst MOTION LED LIGHT Garden Stake with Wall Plug', 4, 4, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.5, 10.25, 19.5, NULL, NULL, NULL, 'Solar lighted moving stake w/ star; \n LED: 18*LED3 COLOR ASST-WHITE 3.5lm /RED 1.5lm /BLUE 0.4lm;\nTopper KD  stake KD\n changed to be plug working     ', 'Xiamen', 'China', 'Plastic', '95%', 'Flowing', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'WHITE 3.5lm /RED 1.5lm /BLUE 0.4lm', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(3, 'SLY180A-DSP', 'QLP', 'Mosaic LED Garden Stake with Wall Plug - test', 5, 4, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 11.81, 17.91, NULL, NULL, NULL, '1.Description: solar stake light -plug in                          no battery                                                   3.Item KD or Not  :yes                              4.LED Color : White ,3.5LM                        5.Solar Panel Information: useless Amorphous Silicon  4*4CM                                                                                                          6. On/Off Switch ', 'Xiamen', 'China', 'Glass', '85%', 'Stainless Steel', '10%', 'Plastic', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3.5 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(4, 'SLC528BB-DSP', 'QLP', 'Mosaic American Flag Globe Stake with Wall Plug', 4, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.75, 14.75, 16.5, NULL, NULL, NULL, '1. Mosaic with Flag design Globe Stakes change to be plug in\n2. Item KD\n3. LED Info: 1 COOL white LED 3.5lm\n4. Solar Panel Information:Crystalline solar panel, useless panel\n5. Battery Typeï¼šno\n6. Working Timeï¼š \n7. On/Off Switch  ', 'Xiamen', 'China', 'Glass', '70%', 'Stainless', '15%', 'Plastic', '15%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3.5 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(5, 'SLC108A-DSP', 'YEN', 'Mosaic Globe Stakes White LED with Wall Plug', 4, 4, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 5.5, 19.5, NULL, NULL, NULL, '1.Description: solar stake light with High voltage DC plug                                                    2. Battery:without battery                                   3.Item KD or Not  :yes                              4.LED Color :1* White,4lm                      5.Solar Panel Information : polycrystalline silicon  40*40mm      35MA/2V                                          ', 'Xiamen', 'China', 'Glass', '70%', 'Stainless Steel', '20%', 'Plastic', '5%', 'Others', '5%', NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(6, 'SOT434A-DSP', 'SOT', 'Solar Metal Flower Garden Stakes with Wall Plug - Set of 3', 7, 4, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27.75, 13.5, 20.5, NULL, NULL, NULL, 'stake with plug white color 3.0LM', 'Xiamen', 'China', 'Iron', '66%', 'Glass', '28%', 'Plastic', '6%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(7, 'RGG119A-DSP', 'RGG', 'Bee LED Garden Stake with Wall Plug', 8, 1, 38, 'Butterfly LED Garden Stake with Wall Plug - test', 9, 1, 38, 'Dragonfly LED Garden Stake with Wall Plug - test 123', 9, 1, 38, 10.5, 7.25, 20.4, NULL, NULL, NULL, 'Metal stake with DSP changing w 33\" wire ,LED info:dragonfly has 20 pcs led ,bee has 14 pcs led,butterfly has 18 pcs led.LED warm white  LED 3Lumen ,tooper KD ,DC plug,33inch long for the wire.On/off Switch.No battery.', 'Xiamen', 'China', 'Plastic', '10%', 'Iron', '82%', 'Other', '8%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', '2.75 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(8, 'HPP312ABB-DSP', 'SOT', 'Round Mesh Garden Stake with Wall Plug- Asst. Display of 4', 3, 3, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7.5, 7.5, 17.25, NULL, NULL, NULL, '\"garden stake with plug  LED:Red/Blue/White/Green single color  1PC                                                                        the product supply by Alpine                              ITEM K/D  ,topper  K/D                                                              NO battery            \nTransformer: INPUT:120-250V 50/60Hz .OUTPUT:1DC4.2V +-0.5V  DC500mA  Light line 95cm  4pcs white LED                                                               \"\n', 'Xiamen', 'China', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '120-250 V', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(9, 'SOT102-DSP', 'SOT', 'Angel Garden Stake with Wall Plug', 3, 3, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.75, 15, 17.75, NULL, NULL, NULL, 'stake with plug,no battery, blue color 0.6LM', 'Xiamen', 'China', 'Stainless Steel', '25%', 'Plastic', '15%', 'Acrylic', '60%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '0.6 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(10, 'SOT866-DSP', 'SOT', 'Solar Star Trio LED Garden Stake with Wall Plug', 6, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.25, 11, 17.5, NULL, NULL, NULL, 'solar 3 topper stake with plug                solar panel no work  ITEM K/D                   NO battery\nTransformer: INPUT:100-250V 50/60Hz .OUTPUT:1DC4.2V +-0.5V  DC500mA  Light line 95cm    1pc blue LED/1pc red LED/1pc white LED', 'Xiamen', 'China', 'Metal', '50%', 'Glass', '20%', 'Electron', '30%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '100-250V', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(11, 'SOT162-DSP', 'SOT', 'Cross Garden Stake with Wall Plug - test 33', 4, 1, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.25, 10, 17.75, NULL, NULL, NULL, 'stake with plug,no battery,  white 3.0LM', 'Xiamen', 'China', 'Stainless Steel', '25%', 'Plastic', '15%', 'Acrylic', '60%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(12, 'SLC192-DSP', 'RGG', 'USA Flag Stake with White LED Lights and Wall Plug', 5, 1, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 11, 16.75, NULL, NULL, NULL, '1.Americana Flag Solar  Light  with plug \n2. Topper  KD \n3.LED:White Color 1PCS 3lm \n4. Solar Panel:no work 1pc  \n5,without battery                                     Topper Size:4.33*1.38*4.13                             \n', 'Xiamen', 'China', 'Stainless Steel', '36%', 'Plastic', '64%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(13, 'QLP476BB-DSP', 'QLP', 'Solar Acrylic Hummingbird and Flower LED Light', 6, 5, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 6.25, 17.5, NULL, NULL, NULL, '1.acrylic humming bird and flower solar light w plug in changing.                                                      2.White LED on top-3.5lm, Right middle blue LED-0.4lm , Left middle red LED-1.5lm, Bottom green LED -1.7lm\n3.topper KD, staker 2 KD                       4.Solar Panel Informationï¼šAmorphous si 45*45mm  ,no work.                                                5.NO Battery \n 6.On/Off Switch', 'Xiamen', 'China', 'Plastic', '65%', 'Stainless ', '25%', 'Others', '10%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'White 3.5lm, Blue 0.4lm, Red 1.5lm, Green 1.7lm', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(14, 'SOT530A-DSP', 'SOT', 'Flower Trio LED Garden Stake with Wall Plug', 6, 4, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.25, 9.63, 17.38, NULL, NULL, NULL, 'stake with plug', 'Xiamen', 'China', 'Plastic', '58%', 'Stainless Steel', '42%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(15, 'SOT244A-DSP', 'SOT', '2 Hummingbirds & Flower LED Garden Stake with Wall Plug', 6, 5, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.25, 9.5, 17, NULL, NULL, NULL, '2 Hummingbirds & Flower LED Garden Stake with Wall Plug', 'Xiamen', 'China', 'Plastic', '58%', 'Stainless Steel', '42%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(16, 'SOT858-DSP', 'SOT', 'Flower and Insect Trio Garden Stake with Wall Plug', 6, 6, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 11.25, 17.75, NULL, NULL, NULL, 'solar 3 topper stake with plug                solar panel no work  ITEM K/D                   NO battery', 'Xiamen', 'China', 'Plastic', '20%', 'Stainless Steel', '20%', 'Acrylic', '50%', 'Other', '10%', NULL, NULL, '100%', 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(17, 'KAW122AHH-BK ', NULL, 'Black Aluminum Windchimes with Agate Stones-Master Pack of 4', 6, 6, 30, 'Chain', NULL, NULL, 39, NULL, NULL, NULL, NULL, 17.13, 8.66, 7.09, NULL, NULL, NULL, '39\"METAL WINDCHIME(not KD)\n\nThe pendant is natural ,it can not be same as each piece each shipment Jodie confirmed this is Ok to accept but we will have special notation on packaging about this ', 'Ningbo', 'China', 'Aluminum', '70%', 'MDF', '10%', 'Agate', '10%', 'Iron', '10%', NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(18, 'KAW122AHH-BR ', NULL, 'Brown Aluminum Windchimes with Agate Stones-Master Pack of 4', 6, 6, 30, 'Chain', NULL, NULL, 39, NULL, NULL, NULL, NULL, 17.13, 8.66, 7.09, NULL, NULL, NULL, '39\"METAL WINDCHIME(not KD)\n\nThe pendant is natural ,it can not be same as each piece each shipment Jodie confirmed this is Ok to accept but we will have special notation on packaging about this ', 'Ningbo', 'China', 'Aluminum', '70%', 'MDF', '10%', 'Agate', '10%', 'Iron', '10%', NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(19, 'QLP596-2', 'QLP', 'Alpine\'s Li-ion Rechargeable Battery 2 Pack', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.5, 8.25, 5.5, NULL, NULL, NULL, '1.Description: BATTERY               \n2. 1*PC 18650  2000mAh   3.7V                                                                                                                                         3.Working Time : 12  hours if full charge            ', 'Xiamen', 'China', 'Battery', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 1, NULL, 'PC 18650  2000mAh', 1, 'Battery', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(20, 'TS-CANOPY-BK4', 'CJW', '5x5 Pop Up Canopy with Alpine Logo and Three Sides', 60, 60, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 58, 8, 8, NULL, NULL, NULL, 'Custom print pop up tent 5ftx5ft\n\nwith ALPINE logo in the item, same as our catalogue.', 'Xiamen', 'China', '420D Polyester(matt)', '68%', 'Aluminum Frame', '30%', 'Velcro Lock', '2%', NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(21, 'TS-CANOPY-BK3', 'CJW', '10x10 Pop Up Canopy with Alpine Logo and Three Sides', 120, 120, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 8, 60, NULL, NULL, NULL, 'Custom print pop up tent 10ftx10ft\n\nwith ALPINE logo in the item, same as our catalogue.', 'Xiamen', 'China', '420D Polyester(matt)', '68%', 'Aluminum Frame', '30%', 'Velcro Lock', '2%', NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(23, 'QAP104BB-DSP', 'SOT', 'Lantern Pathway Stake with Wall Plug', 7, 6, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 8.85, 18.31, NULL, NULL, NULL, ' ITEM K/D                                                                              NO battery                                                                        plastic solar stake light supply by Alpine           ', 'Xiamen', 'China', 'Plastic', '85%', 'Amorphous Solar Panel', '15%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '32 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/28', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(24, 'QAP100BB-DSP', 'SOT', 'Lantern Pathway Stakes with Wall Plug', 7, 6, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 8.85, 18.31, NULL, NULL, NULL, ' ITEM K/D                                                                              NO battery                                                                        plastic solar stake light supply by Alpine         ', 'Xiamen', 'China', 'Plastic', '85%', 'Amorphous Solar Panel', '15%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '32 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/28', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(25, 'SOT714ABB-6-DSP', 'SOT', 'Metal Flower Garden Stake with Wall Plug', 9, 4, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, 19.5, 19, NULL, NULL, NULL, '1. iron flower solar stake with plug\n2. Item KD\n3. LED 1pc\n4. Solar Panel  not working, no battery\n5. adapter 1 pc       \n6. On/Off Switch  ', 'Xiamen', 'China', 'Iron', '85%', 'Plastic', '5%', 'Glass', '10%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(26, 'USA754L', 'USA', '29\" Boy and Bronze Angel Fountain and LED Lights', 17, 16, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.2, 21, 22.8, NULL, NULL, NULL, '1.29\'\' Angel and boy  Fountain;KD                                                  2.with two SINGLE WHITE LED lights                                                                                     3. Low voltage Pump: WP-350, GPH:350L;HMAX:0.7m                                             4.Transfomer:JBA48U-12-830N ;Input: 120V AC 60HZ 11W, Ouput: 12V AC  830MA                                                                                                                    5.Cord Length for Pump:2M       Cord length for transformer 1.83m                                                                                                                       Water Capacity:  8 L                                                    Light is replaceable,Alpine sku # is RLS100                                                          Pump is replaceable,Alpine sku # is P120                                                                                     Transformer is replaceable, Alpine sku # is PL022T       ', 'Xiamen', 'China', 'Polyresin', '30%', 'Stone Powder', '20%', 'Cement', '30%', 'Sand', '20%', NULL, NULL, '100%', 1, 'LED', 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\USA\\PDF', 'P120', 'RLS100', 'PL022T', 'N/A', 'N/A', 'N/A', 'N/A', 'WP-350, GPH:350L;HMAX:0.7', '6.56 Ft', '11 W', '12V', '6Ft', '8L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(27, 'ZEN746', 'ZEN', 'Hanging Bear Birdhouse Knot', 5, 6, 10, 'Chain', NULL, NULL, 13, NULL, NULL, NULL, NULL, 14.3, 14, 11.15, NULL, NULL, NULL, 'Polyresin bear birdhouse\ndoor clean out from back                                                                     opening hole dia.:1.00 inch', 'Xiamen', 'China', 'Polyresin', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(28, 'IPS300HH', 'IPS', 'Rust Metal Outdoor Pig Decor', 12, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.35, 11.75, 16.9, NULL, NULL, NULL, 'Metal Pig ', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(29, 'IPS302HH', 'IPS', 'Rust Metal Outdoor Cow Decor', 13, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.5, 9.5, 18.5, NULL, NULL, NULL, 'Metal Cow ', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(30, 'NCY342A', 'NCY', 'Metal Farm Animal Weathervane Stakes - Cock', 15, 13, 48, 'Metal Farm Animal Weathervane Stakes - Cow - teee', 15, 13, 48, 'Metal Farm Animal Weathervane Stakes - Pig', 15, 13, 48, 40.19, 13.79, 6.3, NULL, NULL, NULL, 'Metal cock,cow,pig weather vane stake  \nTopper KD,Stake non-KD', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(31, 'ORS566BB', 'ORS', 'Cowboy Wall DÃ©cor- Tray Pack of 6', 24, 1, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.5, 12.5, 13.35, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Wood', '80%', 'Metal', '20%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(32, 'ORS574BB', 'ORS', 'Cow Wall DÃ©cor- Tray Pack of 6', 1, 12, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 11, 13.25, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Wood', '70%', 'Metal', '25%', 'Linen', '5%', NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(33, 'ORS576HH', 'ORS', 'Welcome Cowboy Boot Wall DÃ©cor', 15, 2, 18, 'String', NULL, NULL, 25, NULL, NULL, NULL, NULL, 19.5, 11, 15.8, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Wood', '50%', 'Metal', '45%', 'Rope', '5%', NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(34, 'ORS678', 'ORS', 'Metal Rooster, Pig & Bull Wall DÃ©cor testddd 34', 22, 1, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.5, 7.5, 24.2, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(35, 'ORS700', 'ORS', 'Metal Pig Planter', 17, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.1, 11.8, 23.5, NULL, NULL, NULL, 'metal pig planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(36, 'ORS702', 'ORS', 'Metal Sheep Planter', 17, 6, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.5, 11.2, 24.25, NULL, NULL, NULL, 'metal sheep planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(37, 'ORS704', 'ORS', 'Metal Cow Planter', 16, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.7, 11.4, 17, NULL, NULL, NULL, 'metal cow planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(38, 'ORS706', 'ORS', 'Metal Rooster Planter', 14, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.25, 15, 15, NULL, NULL, NULL, 'metal Rooster planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(39, 'QWR648SLR', 'QWR', '15\" Solar Turtle on Rock Statuary', 11, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.75, 12.75, 16.75, NULL, NULL, NULL, 'Magnesia turtle standing on ball with solar                                          2 pcs white LED       3lm-4lm                                                                       Batteries :1* AA NI-MH 1.2V  300mA                              Solar panels :polycrystalline silicon 2V 40mA', 'Xiamen', 'China', 'Magnesia', '87%', 'LED', '6%', 'Plastic', '4%', 'Solar Panel', '3%', NULL, NULL, '100%', 1, 'LED', '3lm-4lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(40, 'QWR650SLR', 'QWR', 'Magnesia Frog Standing on Ball with Solar', 10, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 12.75, 20.25, NULL, NULL, NULL, 'Magnesia frog standing on ball with solar                                          2 pcs white LED       3lm-4lm                                                                       Batteries :1* AA NI-MH 1.2V  300mA                              Solar panels :polycrystalline silicon 2V 40mA', 'Xiamen', 'China', 'Magnesia', '87%', 'LED', '6%', 'Plastic', '4%', 'Solar Panel', '3%', NULL, NULL, '100%', 1, 'LED', '3lm-4lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(41, 'QWR932SLR', 'QWR', 'Solar LED Turtle test ddfd', 9, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.5, 9.5, 16.75, NULL, NULL, NULL, '1. Turtle with solar\n2. 2pc warm white LED light, 2LM\n3. Solar Panel Information: polycrystalline silicon 70X40mm 2V 40MAH\n4.Battery Type:1* AA NI-MH 2V  300mAH, rechargeabel, replaceable    \n5. Working Timeï¼šMin. 6-8H if fully charged\n6. On/Off Switch', 'Xiamen', 'China', 'Magnesia', '90%', 'LED', '4%', 'Plastic', '6%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(42, 'QWR934SLR', 'QWR', 'Solar LED Snail tees', 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.5, 9.5, 16, NULL, NULL, NULL, '1. snail with solar\n2. 2pc warm white LED light, 2LM\n3. Solar Panel Information: polycrystalline silicon 70X40mm 2V 40MAH\n4.Battery Type:1* AA NI-MH 2V  300mAH, rechargeabel, replaceable   \n5. Working Timeï¼šMin. 6-8H if fully charged\n6. On/Off Switch', 'Xiamen', 'China', 'Magnesia', '90%', 'LED', '4%', 'Plastic', '6%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(43, 'QWR936SLR', 'QWR', 'Solar LED Frog', 9, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.5, 9.5, 16.5, NULL, NULL, NULL, '1. frog with solar\n2. 2pc warm white LED light, 2LM\n3. Solar Panel Information: polycrystalline silicon 70X40mm 2V 40MAH\n4.Battery Type:1* AA NI-MH 2V  300mAH, rechargeabel, replaceable   \n5. Working Timeï¼šMin. 6-8H if fully charged\n6. On/Off Switch', 'Xiamen', 'China', 'Magnesia', '90%', 'LED', '4%', 'Plastic', '6%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(44, 'ZEN666ABB', 'ZEN', 'Mini Dogs and Cats Pot Stickers - Tray Pack of 24', 2, 1, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 7.48, 5.51, NULL, NULL, NULL, 'Mimi dogs and cats statues stake \n4 dogs +2 cats ', 'Xiamen', 'China', 'Polyresin', '90%', 'Others', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(45, 'ZEN736ABB', 'ZEN', 'Baby Bear Cubs Statue -  Up', 4, 4, 6, 'Baby Bear Cubs Statue -  Middle', 5, 4, 6, 'Baby Bear Cubs Statue -  Down', 5, 4, 5, 16.25, 13.8, 8, NULL, NULL, NULL, '6\"H polyresin bear statue S/3', 'Xiamen', 'China', 'Polyresin', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(46, 'ZEN778SLR-S', 'ZEN', 'Solar Frog with Umbrella Garden Statue', 6, 5, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 10.8, 14, NULL, NULL, NULL, '1. 12\" frog statue with solar light\n2.  warm white string light with 8pcs LED , 3LM\n3. Solar Panel Information: polycrystalline  solar panel 40*40mm 2V 30MA\n4ã€Battery Type:1*1.2v AA Rechargeable Ni-CD 300 mAh battery\n5. Working Timeï¼šMin. 8H if fully charged\n6. on/Off Switch ', 'Xiamen', 'China', 'Polyresin', '60%', 'Iron', '35%', 'Solar/LED', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, '1.2v AA Rechargeable Ni-CD 300 mAh battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(47, 'YEN204A', 'YEN', 'Solar Flower Light Stake', 9, 2, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.28, 10.83, 7.09, NULL, NULL, NULL, '1.Flower solar light stake,KD                                      2.Solar panel: 2V 40MA amorphous silicon,40*40mm                                                   \n3,LED: 20pcs white color string light  led, 2lm                                                                 4,Battery: 1*AA 1.2V/ 400mAh rechargeable Ni-Cd\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      6,Switch: ON/OFF switch                                   7.Topper Size:  8.66x1.85x 11.42 inch    topper no kd ,item kd 2 parts.', 'Xiamen', 'China', 'Metal', '85%', 'Solar', '10%', 'Other', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V/ 400mAh rechargeable Ni-Cd', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(48, 'YEN358', 'YEN', 'Solar Hydrangea Trio LED Stake - Display of 6', 11, 5, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.7, 11.81, 14.17, NULL, NULL, NULL, '1.Flower solar light stake                                                                              \n2.Solar panel: 2V 60MA amorphous silicon 4x4cm,foldable solar panel\n3,LED: 18pcs white led for each flower,total 54pcs white led,2 lumen                                                              \n4,Battery: 1*AA 1.2V/ 600mAh rechargeable NI-CD and battery can be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch       \n7.Topper size:10.63x4.72x14.96 inch                  \nflower size:4.72x4.33x2.76 inch each\ntopper no kd,item kd into 2 parts      ', 'Xiamen', 'China', 'Iron', '90%', 'Solar', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V/ 600mAh rechargeable NI-CD ', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(49, 'YEN362', 'YEN', 'Pineapple Solar Light with Hook', 7, 7, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.25, 14.57, 7.6, NULL, NULL, NULL, '1.Pineapple solar light,with hook                                                                             \n2.Solar panel: 2V 40MA amorphous silicon 4x4cm\n3,LED: 40pcs warm white led ,2 lumen                                                              \n4,Battery: 1*AAA 1.2V/ 400mAh rechargeable NI-CD and battery can be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch       \n7.Pineapple size:6.69x6.69x9.45/13.39 inch                   \nhook kd into 2 parts   ', 'Xiamen', 'China', 'Iron', '90%', 'Solar', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AAA 1.2V/ 400mAh rechargeable NI-CD', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(50, 'MZP254BR', 'MZP', '71\" Brown Wind Spinner Garden Stake', 23, 6, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, 4.25, 23.5, NULL, NULL, NULL, 'Garden Stick,KD', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\MZP\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(51, 'MZP356', 'MZP', 'Metal Rooster', 17, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 7.25, 19, NULL, NULL, NULL, 'METAL ROOSTER, NO KD', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(52, 'QEL548ABB', 'QEL', 'Metal Retro Flower - Assorted Tray Pack of 24', 4, 1, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.75, 9, 6, NULL, NULL, NULL, 'Metal Flower w/Bead Pick                                                         yellow,orange,blue,red                                                                                                                                      Not KD\n\nRelated sku# QEL604HH/QEL606HH/QEL608HH/QEL610HH     ', 'Xiamen', 'China', 'Iron', '98%', 'Glass', '2%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(53, 'QLP1049A-CC', 'QLP', 'Solar Hummungbird Garden Stakes - Assorted of 8', 12, 12, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.75, 17, 8.75, NULL, NULL, NULL, '1. Solar  20 icons  stake  lighted    -green/clear  hummingbird \ntopper no kd ,stake   kd \nmono/polycrystal si, 2V 80MA,45*45MM\nLED:20pcs LED(green  hummingbird : white LED3.5LM  ,clear humming bird - color changing LED )\nNi-CD 300mAh AA 1.2V *1pc \non/off Switch\nWorking Time : 6-8Hours with full charged\nTopper size: 3.5*4.32*1.95cm ', 'Xiamen', 'China', 'Plastic', '90%', 'Others', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '5 LM', 1, NULL, 'Ni-CD 300mAh AA 1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(54, 'QLP1122SLR', 'QLP', 'Solar Gerber Daisy Hanging Bouquet', 8, 8, 8, 'Chain', NULL, NULL, 19, NULL, NULL, NULL, NULL, 18.25, 18, 9.5, NULL, NULL, NULL, '1.solar hanging metal  flower\n2.mono/polycrystal si,2V,100ma,45*45mm\n3.27pcs white LED-  3.5 lm ,    \n4.Ni-CD 600mAh 1.2V  AA*1pc rechargable and replaceable battery\n5.ITEM no KD,                 \n6. on /Off Switch                                        \n 7. Working Time : 6-8Hours after full charge ', 'Xiamen', 'China', 'Iron', '90%', 'Solar', '5%', 'Plastic', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3.5 LM', 1, NULL, 'Ni-CD 600mAh 1.2V  AA', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(55, 'BEH152HH', 'BEH', 'Moss Rooster Statue', 13, 4, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.25, 12.5, 15.25, NULL, NULL, NULL, 'MGO rooster figure', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(56, 'BEH154HH', 'BEH', 'Moss Pig Statue', 14, 6, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.2, 14.1, 16.9, NULL, NULL, NULL, 'MGO pig figure', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(57, 'BEH166HH', 'BEH', 'Tortoise Moss Planter', 15, 11, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.25, 13.25, 18.25, NULL, NULL, NULL, 'MGO tortoise  pot', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(58, 'BEH168HH', 'BEH', 'Shoe Moss Planter', 15, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.9, 10.9, 18.4, NULL, NULL, NULL, 'MGO shoes pot', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(59, 'LRD128SLR', 'LRD', 'Solar Candle', 4, 4, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.8, 10.8, 14, NULL, NULL, NULL, '1. solar candle\n2. 93pc orange LED with candle light\n3. Solar Panel Information: polycrystalline silicone solar panel 72*72mm 1.5V\n4ã€Battery Type:li-ion 18650 Rechargeable 1500mAh ,but non-replaceable\n5. Working Time:Min. 8-12H if fully charged\n6. AUTO/Off  \n7ã€Top KD ', 'Shenzhen', 'China', 'ABS', '60%', 'PCB, Cable, Battery and L', '30%', 'Other', '10%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '5-10 LM', 1, NULL, 'li-ion 18650 Rechargeable 1500mAh', 1, 'Battery Operated and Solar', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\LRD\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/28', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(60, 'QTT474A', 'QTT', 'Solar Hanging LED Bulb with Metal Stand - Assorted of 15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.Solar bulb hanger\nSolar bottle hanger -QTT426SLR-SL/BZ\nwith 24pcs warm white string light LED 2 Lumen   \nSolar hanger -QTT430SLR-TM with 24pcs warm white string light LED 2lumen\nQTT391SLR-TM with 24pcs warm white string light LED 2lumen \nQTT389SLR-TM with 21pcs warm white string light LED 2lumen     \n2.With try me on each item                        \n3. 2V 30MA polycrystalline  silicon  solar panne  \n4. 1x AA 1.2V 300MAH NI-CD rechargable battery,                                \n5.On/off Switch          \n\nMetal display:22.50*22.50*77.00\'\'  \n\nBVF make metal display then send to QTT to pack together            ', 'Xiamen', 'China', 'Glass', '50%', 'Plastic', '20%', 'Solar', '20%', 'Metal', '10%', NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V 300MAH NI-CD', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(61, 'SOT948A-9', 'SOT', 'Solar Spinning LED Insect Stake- Assorted Display of 9', 14, 5, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.75, 17.75, 14.4, NULL, NULL, NULL, '1.metal solar stake light  with rotate               \n2. Topper K/D ,stake  KD 2parts,glass ball K/D\n3. LED  white color  1 pc  3.0LM\n4.Solar panel is amorphous  silicon,2V 35MAH  1pc \n5.NI-CD AAA 1.2V 400MAH battery 1pc\n6. ON/OFF Switch                                             7.Work time:upto 8h if fully charged    8.Glass ball is 2.36\"D      ', 'Xiamen', 'China', 'Metal', '85%', 'Glass', '10%', 'Plastic', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'NI-CD AAA 1.2V 400MAH', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(62, 'MZP292HH', 'MZP', 'Rustic Dragonfly Wall Art', 25, 2, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28.5, 10.5, 18.75, NULL, NULL, NULL, 'Metal Dragonflyywall art', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(63, 'RGG155A', 'RGG', 'Hummingbird Rain Gauge ', 7, 3, 43, 'Butterfly, DragonFly, Bee Rain Gauge dodgy', 8, 3, 43, NULL, 8, 3, NULL, 25, 16.75, 13, NULL, NULL, NULL, 'Solar metal stake light\nLED info:17pcs  white LED 3Lumen \nKD on middle\nSolar Panel information:ampous solar Panel 2V35MA,40*40mm\n1*AA 1.2V 300Mah,Ni-cd  Battery\nWorking Time: About 6-8 hours when full charge\nOn/off Switch.', 'Xiamen', 'China', 'Plastic', '10%', 'Iron', '72%', 'Glass', '10%', 'Other', '8%', NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'AA 1.2V 300Mah,Ni-cd', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(64, 'QEL404A', 'QEL', 'Metal Colorful Fun Bird Garden Stakes - Green, Orange', 3, 7, 35, 'Metal Colorful Fun Bird Garden Stakes - Purple gadded', 3, 5, 35, 'Metal Colorful Fun Bird Garden Stakes - Blue', 3, 5, 35, 37.15, 12, 5.5, NULL, NULL, NULL, 'Metal Funny Bird Pick                                                         green,purple,orange,blue                                                                                                                                      Not KD                                                                                                                                                   4x3', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(65, 'QYY108ABB', 'QYY', 'Solar Plastic Rotating Ball Garden Stake gdgd', 3, 3, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.75, 15.5, 19.12, NULL, NULL, NULL, '1.  Plastic rotational ball with solar stake light\nRed ball-butterfly ,green/white/blue ball-dragonfly\n2. 1*cold whiteLED light .Lumen:1.2lm\n3. Solar Panel Information: polycrystallin    2pcs of  (50mm*20mm ) Solar panel  2V      80MA;             \n4ã€Battery Type:1*NI-MH AA1.2V Rechargeable 400mA battery\n5. Working Timeï¼šMin. 6H if fully charged\n6. AUTO/Off Switch \n7ã€Topper non- KD ,item KD 2 parts   8.Topper size:3.12*3.12*5.07 in', 'Xiamen', 'China', 'PS', '50%', 'ABS', '30%', 'Stainless Steel', '15%', 'LED & Battery', '5%', NULL, NULL, '100%', 1, 'LED', '1.2 LM', 1, NULL, 'NI-MH AA1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51');
INSERT INTO `itemspecifications` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(66, 'ATB114HH-GN', 'ATB', 'Green Garden Gazebo Birdfeeder', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', '95%', 'Rope', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(67, 'ATB114HH-YL', 'ATB', 'Garden Gazebo Bird Feeder - Yellow', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', '95%', 'Rope', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(68, 'ATB114HH-BL', 'ATB', 'Blue Garden Gazebo Birdfeeder', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', '95%', 'Rope', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(69, 'ATB114HH-RD', 'ATB', 'Red Garden Gazebo Birdfeeder', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', '95%', 'Rope', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(70, 'BEH150HH', 'BEH', 'Moss \"Garden\" Sheep Statue', 13, 4, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 12, 15.8, NULL, NULL, NULL, 'MGO sheep figure', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(71, 'NZW236HH', 'NZW', 'Garden Pebble Pig Statue- Master Pack of 4', 13, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.25, 10.25, 30.25, NULL, NULL, NULL, 'PIG', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(72, 'NZW240HH', 'NZW', 'Garden Pebble Cow Statue- Master Pack of 4', 14, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, 12.5, 32, NULL, NULL, NULL, 'COW', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(73, 'NZW244HH', 'NZW', 'Garden Pebble Rooster Statue- Master Pack of 4', 13, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.25, 12, 30.75, NULL, NULL, NULL, 'ROOSTER', 'Xiamen', 'China', 'MGO', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(74, 'HEH270S-WT', 'HEH', 'Garden White and Black Metal Rooster Decor', 8, 14, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.96, 8.07, 20.08, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(75, 'HEH268L-GN', 'HEH', 'Garden Green Standing Metal Rooster', 9, 15, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.76, 8.19, 16.73, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(76, 'HEH270L-GN', 'HEH', 'Garden Green Metal Rooster Decor', 10, 19, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.29, 8.86, 26.57, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(77, 'GDS124', 'GDS', 'Hunting Garden Gnome Statue', 5, 5, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.15, 14, 14.25, NULL, NULL, NULL, 'Polyresin garden gnome decoration\nitem non-KD', 'Xiamen', 'China', 'Polyresin', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(78, 'GDS126', 'GDS', 'Hunting Garden Gnome Statue', 5, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.15, 14, 14.25, NULL, NULL, NULL, 'Polyresin garden gnome decoration\nitem non-KD', 'Xiamen', 'China', 'Polyresin', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(79, 'GDS128', 'GDS', 'Hunting Red Garden Gnome Statue', 5, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.15, 14, 14.25, NULL, NULL, NULL, 'Polyresin garden gnome decoration\nitem non-KD', 'Xiamen', 'China', 'Polyresin', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(80, 'HEH268S-WT', 'HEH', 'Garden White and Black Standing Metal Rooster', 7, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.63, 6.5, 13.58, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(81, 'LJJ1004ABB', 'LJJ', 'Metal Garden Flower Stake  - Tray Pack of 24', 5, 2, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.62, 15.75, 5.51, NULL, NULL, NULL, 'S/ 4 METAL YELLOW/BLUE/RED FLOWER STAKE\nItem not KD\nOriginal sku# LJJ920ABB/LJJ921ABB', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(82, 'MAZ542', 'MAZ', 'Iron Faucet Planter', 11, 9, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 6, 10.5, NULL, NULL, NULL, '1.Planter Holder\n2.Item  KD', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(83, 'BVK616', 'BVK', 'Rusty Green Garden Bench', 45, 22, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42.52, 5.71, 21.85, NULL, NULL, NULL, 'BENCH\nItem KD \nweight capacity:500-700LBS', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\BVK\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(84, 'WQA1096ABB', 'WQA', 'Woodcut Owl Garden Stone Decor - Assorted Tray Pack of 6', 7, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.13, 9.45, 10.24, NULL, NULL, NULL, 'Cement Stepping Stone 3 Asst', 'Xiamen', 'China', 'Cement', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(85, 'MAZ341A', 'MAZ', 'Brown Rustic Finish Fork Garden Stakes - NB', 7, 1, 40, 'Brown Rustic Finish Fork Garden Stakes - OB', 7, 1, 40, 'Brown Rustic Finish Fork Garden Stakes - TB', 7, 1, 40, 43.13, 13, 9.25, NULL, NULL, NULL, 'STAKE , NON KD ', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(86, 'SOT866BB-12', 'SOT', 'Solar Garden Stakes with 3 Stars - Tray of 12', 6, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.75, 13.6, 19.3, NULL, NULL, NULL, '1. Solar garden stakes with 3 stars\n2. Item KD,topper KD\n3.LED Info:Top 1* red 0.5lumen ,middle 1* white 2.8lumen ,bottom 1* blue 0.5 lumen led \n4. Solar Panel Information: polycrystalline solar panel 2v 50ma\n5. Battery Typeï¼š1*AA Rechargeable Ni-CD 400 mAh 1.2v battery\n6. Working Timeï¼šMin. 8H if fully charged\n7. On/Off Switch  ', 'Xiamen', 'China', 'Plastic', '28%', 'Stainless Steel', '22%', 'Acrylic', '40%', 'Other', '10%', NULL, NULL, '100%', 1, 'LED', 'Top red 0.5lm ,middle white 2.8lm ,bottom blue 0.5 lm', 1, NULL, 'AA Rechargeable Ni-CD 400 mAh 1.2v', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(87, 'TEC246M-CR', 'TEC', '12\" Cream Planter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(88, 'TEC350S-YL', 'TEC', '10\" Woven Plastic Yellow Planter', 14, 14, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.5, 14.5, 15, NULL, NULL, NULL, 'PLASTIC  PLANTER', 'Ningbo', 'China', 'Plastic', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(89, 'TEC350L-DGN', 'TEC', '11\" Woven Plastic Dark Green Planter', 16, 16, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.5, 16.5, 17, NULL, NULL, NULL, 'PLASTIC  PLANTER', 'Ningbo', 'China', 'Plastic', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(90, 'TEC246L-GN', 'TEC', '15\" Bowl Planter - Large - Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(91, 'TEC250S-RD', 'TEC', '12\" Rippled Planter - Small - Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(92, 'HUJ156S', 'NCY', '59\" Brown Ringed Windmill Stake', 18, 7, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.98, 3.54, 19.29, NULL, NULL, NULL, '1.  Windmill  Decoration                                        2. Item KD ', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\HUJ\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(93, 'QTT490SLR-DSP', 'QTT', 'Mesh Torch Stake with Wall Plug', 7, 7, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.5, 15.25, 14.25, NULL, NULL, NULL, '1.solar torch stake  \nTopper Non KD stake KD                    \n2. INPUT:100-240VAC  50/60HZ      OUTPUT:5.7V-800MA      line leaderï¼š130CM\n3. NO BATTERY                       \n4.On/off Switch                                                  5.96pcs yellow flicking LED 5 Lumen                                             \ntopper size 18*18*22cm      ', 'Xiamen', 'China', 'Plastic', '30%', 'Solar', '20%', 'Iron', '50%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '5 LM', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'Z:\\Assembly & Instruction Manuals\\QTT\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(94, 'SLL803A-18-DSP', 'SOT', 'Hedgehog, Turtle, & Frog Garden Stake w Wall Plug - Set of 3', 2, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.6, 12, 30.7, NULL, NULL, NULL, ' ITEM K/D                                                                   NO battery                                                                 Solar panel no work                                     LED: white                                                           the polyresin produce and stakes  supply by Alpine       ', 'Xiamen', 'China', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(95, 'SLL683A-12-2-DSP', 'SOT', 'Solar Bird House Garden Stake with Wall Plug - Set of 4', 7, 3, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.75, 11.4, 30.15, NULL, NULL, NULL, ' ITEM K/D                                                                                  NO battery                                                                 Solar panel no work                                     LED: white                                                           the iron produce  supply by Alpine         ', 'Xiamen', 'China', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(96, 'SLL636ABB-DSP', 'SOT', 'Solar Religious Glass Stakes with Wall Plug - Assorted Set 4', 3, 3, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.5, 17.35, 12.6, NULL, NULL, NULL, 'stake with plug, no battery, Topper from other factory', 'Xiamen', 'China', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(97, 'QLP267ABB-DSP', 'QLP', 'Solar 3D Flower LIGHTED LED Stake w Wall Plug - Set of 3', 6, 6, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.07, 18.07, 2.47, NULL, NULL, NULL, 'Flower w/fiber solar fiber stake light non-moving\n2pcs LED-white 3.5lm, blue 0.4lm, green1.7lm\nTopper KD,stake KD                        \nchanged to be plug working ', 'Xiamen', 'China', 'Plastic', '95%', 'Fiber', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'white 3.5lm, blue 0.4lm, green1.7lm', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(98, 'YCC161ABB-DSP', 'YCC', 'Tulip Stake with LED Lights with Wall Plug', 3, 3, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9.84, 9.06, 19, NULL, NULL, NULL, 'Solar stainless steel sticker wtih crackle tulip and plastic candle  with plug\nStake KD, topper NO KD\n*1 warm white led 4lm,                                             *Amorphose solar panel, 2V 30MA   , no battery\n* ON/OFF switch\n* Wire length 95 cm', 'Xiamen', 'China', 'Metal', '50%', 'Plastic', '30%', 'Stainless steel', '20%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '3.12 Ft', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(99, 'GXP158CC-DSP', 'GXP', 'Solar Crackle Ball w/ Color Changing LED Stake with Wall Plug', 4, 4, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.25, 11.25, 21.75, NULL, NULL, NULL, '1.LED:1PC color changing LED               2.solar panel:2V 60ma, ,crystalline silicon,40*40mm with plug in, no battery\n3. lead wire length: 1M\n4.topper dia:10cm\nMODEL:JB-0920    INPUT:AC 100-240V-50/60HZ    OUTPUT:9V==2A\nTopper not KD , stake KD 2 parts', 'Xiamen', 'China', 'Stainless Steel', '45%', 'Glass', '35%', 'Plastic', '20%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', '3.28 Ft', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(100, 'SLC294ABB-DSP', 'SOT', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(101, 'RGG108ABB-DSP', 'RGG', 'Abstract Garden Stakes  with Wall Plug', 4, 4, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.5, 19.6, 17.25, NULL, NULL, NULL, 'Ball stake with DSP changing w 33\"wire              LED info:1pcs.LED , white  LED 3Lumen ,topper KD,DC plug,33inch long for the wire.On/off Switch.                                         No battery.', 'Xiamen', 'China', 'Plastic', '55%', 'Stainless Steel', '40%', 'Other', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '2.75 Ft', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(102, 'ORS500S', 'ORS', '49\" Metal Sunflower Stake', 18, 3, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.75, 13.3, 16.75, NULL, NULL, NULL, ' METAL STAKE WITH H STAKE ,D14.87inch, KD -Small', 'Fuzhou', 'China', 'Metal', '90%', 'Plastic', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\ORS', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(103, 'ORS500M', 'ORS', '60\" Metal Sunflower Stake', 18, 3, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 14.97, 20.87, NULL, NULL, NULL, ' METAL STAKE WITH H STAKE ,D18.00 KD -Medium', 'Fuzhou', 'China', 'Metal', '90%', 'Plastic', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\ORS', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(104, 'QEL372A', 'KLC', 'Set of 2 Iron Duck Garden Stake', 11, 1, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33.07, 13.39, 5.91, NULL, NULL, NULL, 'Metal Duck Pick,                                                                                                                      Not KD                                                                      4*4, Metal Rack', 'Xiamen', 'China', 'Iron', '10%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(105, 'WIN999', 'WIN', '4-Tiered Rock Fountain with LED Lights', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(106, 'LJJ414ABB', 'LJJ', 'Solar Watering Can Decor - Asst. Tray Pack of 6', 11, 6, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.25, 15, 9, NULL, NULL, NULL, '1.Metal/Glass watering can solar                     2.Battery:1pc AAA1.2V600mA Ni-CD      3.LED :10pcs with white Led,2lumens   4.Solar panel:Amorphous Silicon.  4.40*4.0cm2V25-30mA                                       5.Switch:   ON/OFF switch                                                                      6.Working time:6-8Hours after full charge       ', 'Xiamen', 'China', 'Iron', '40%', 'Glass', '58%', 'Solar', '2%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AAA1.2V600mA Ni-CD', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(107, 'SLV344ABB', 'SLV', 'Welcome Puppies in Barrel Decor - Asst. Tray Pack of 6', 4, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.28, 9.76, 8.62, NULL, NULL, NULL, 'Dog in pot', 'Xiamen', 'China', 'Polyresin', '97%', 'Stone Poweder', '3%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(108, 'YEN366A', 'YEN', 'Solar Colorful Twine Sphere Stake - Assorted Display of 8', 8, 8, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36.5, 18.75, 9.75, NULL, NULL, NULL, '1.sepa takraw solar light stake                                                                              \n2.Solar panel: 2V 40MA amorphous silicon 4x4cm,foldable solar panel\n3,LED: 1pc warm white led ,2 lumen                                                              \n4,Battery: 1*AA 1.2V/ 300mAh rechargeable NI-CD and battery can be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch       \n7.Topper size:7.87x7.87x7.48 inch                   \ntopper no kd,item kd into 2 parts   ', 'Xiamen', 'China', 'Stainless Steel', '40%', 'Plastic', '50%', 'Solar', '10%', NULL, NULL, NULL, NULL, '100%', 1, 'Led', '2 LM', 1, NULL, 'AA 1.2V/ 300mAh ', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(109, 'LJJ1084', 'LJJ', 'Metal Candy Cane Flower Stake with Cool White Solar LED', 10, 5, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26.77, 18.7, 11.22, NULL, NULL, NULL, '1.Solar Metal Xmas candy cane wreath stake w H style stake ,half KD, Top size:10.25x4.5\"x10.25\"\n2.1 *AA NI-CD battery,1.2V 300MAH\nSolar panel.:amorphous silicon  2V 25MAH, size:4*4CM\n3.LED:1 pc cool white  Led.2LM\n4.Switch: ON/OFF switch \n5.Working Hours:6-8 Hours after full charged \n6.Battery is rechargeable and replaceable ', 'Xiamen', 'China', 'Iron', '70%', 'Glass', '20%', 'Solar', '10%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA NI-CD battery,1.2V 300MAH', 1, 'Battery Operated', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(110, 'QLP1174ABB-S-TM', 'QLP', 'Peppermint Hydrangea Stake with LED Lights - Tree', 6, 6, 20, 'Peppermint Hydrangea Stake with LED Lights - Red Candy', 6, 6, 20, 'Peppermint Hydrangea Stake with LED Lights - Green', 6, 6, 20, 22, 15.5, 13.1, 0, 0, 0, 'Peppermint Hydrangea solar light with try me  on each itemtopper no KD ,stake KDpolycrystal si, 2V 40MA,45*45MM17pcs warm white led 3.5lmNi-CD 300mAh AA 1.2V *1pc rechargable and replaceable batteryon/off SwitchWorking Time : 6-8Hours with full chargedTopper size: 5.50*5.50*3.00\'\'', 'Xiamen', 'China', 'Iron', '90%', 'Solar', '5%', 'Plastic', '5%', '', '', '', '', '100', 1, 'LED', '1800', 1, 6, 'test bb', 1, 'Battery Operated and Solar', 'N/A', NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '', '', NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'test', '', '', '', '', '', '', '', 'test troy', 1, '2019-03-26 16:52:46', '2019-03-26 17:13:37'),
(111, 'QLP1174A-L-TM', 'QLP', 'Peppermint Hydrangea Stake with LED Lights - Tree', 9, 7, 43, 'Peppermint Hydrangea Stake with LED Lights - Red Candy', 9, 7, 43, 'Peppermint Hydrangea Stake with LED Lights - Green', 9, 7, 43, 31.75, 14.5, 12, NULL, NULL, NULL, 'Peppermint Hydrangea solar light with try me  on each item                    \nStake KD, topper no KD\n2. polycrystal si 2V 100MA 45*45MM\n1pc AA 1.2V 300MAH NI-CD rechargable and replaceable battery\n3.on/off Switch\n4. 34pcs warm white LED, 3.5lm \n5.Working Time :6-8Hours after full charge\ntopper size :9.25*6.5*8\'\'', 'Xiamen', 'China', 'Iron', '90%', 'Solar', '5%', 'Plastic', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3.5 LM', 1, NULL, ' AA 1.2V 300MAH NI-CD ', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(112, 'SLL2160A', 'SLL', 'Christmas Tree Solar Light Stake - Display of 9', 5, 2, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.79, 13.31, 9.84, NULL, NULL, NULL, '1.Christmas tree solar light stake  \n2.Solar panel: 2V 30MA amorphous silicon,40*40mm                                                   \n3,LED:8pcs warm white led,2 lumen                                                          \n4,Battery: 1*AA 1.2V/ 300mAh rechargeable Ni-Cd,and battery can  be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch                      \n7.Topper Size: 5.30*1.57*9.25\'\' inch,topper no kd,stake KD 2,item kd into 2 parts      ', 'Xiamen', 'China', 'Iron', '75%', 'Cloth', '20%', 'Solar', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V/ 300mAh', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(113, 'SLL2162A', 'SLL', 'Solar Christmas Jar Lighting Stake - Reindeer', 3, 4, 36, 'Solar Christmas Jar Lighting Stake - Snowman', 3, 4, 36, 'Solar Christmas Jar Lighting Stake - Tree', 3, 4, 36, 15.5, 12.5, 12.35, NULL, NULL, NULL, '1.Snowman ,reiendeer, treeMason jar solar light stake\n2.Solar panel: 2V 40MA amorphous silicon,40*40mm                                                   \n3,LED:10pcs warm white string light led,2 lumen                                                          \n4,Battery: 1*AA 1.2V/ 300mAh rechargeable Ni-Cd,and battery can  be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch                      \n7.Topper Size:3.15x3.54x5.30 inch,topper no kd,stake KD 3 parts,item kd into 3 parts    ', 'Xiamen', 'China', 'Glass', '50%', 'Iron', '30%', 'Cloth', '10%', 'Solar', '10%', NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, '*AA 1.2V/ 300mAh', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(114, 'QLP1208A', 'QLP', 'Solar Christmas Wreath Stake with LED Lights - Display of 6', 7, 5, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.5, 8.75, 8.5, NULL, NULL, NULL, '1.Solar Christmas stake                                                     2. 1*AAA  NI-CD 300mah rechargable and replaceable battery                                        3.Item KD : topper  NO KD                               4.LED Color :19pcs string with flicking LED :cool white led 3.5LM\n5.Solar Panel Information :Amorphous 2v 40*40mm 30MA                                             6.Working Time : 6-8Hours                                                                       7. On/Off Switch                                              8.topper size:  7.09x1.50x7.09in          ', 'Xiamen', 'China', 'Iron', '70%', 'Glass', '25%', 'Solar', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3.5 LM', 1, NULL, 'AAA  NI-CD 300mah', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(115, 'QLP1186ABB', 'QLP', 'Solar Barrelled Christmas Stake with LEDs - Reindeer', 7, 4, 33, 'Solar Barrelled Christmas Stake with LEDs - Snowman', 4, 3, 34, 'Solar Barrelled Christmas Stake with LEDs - Tree', 4, 3, 37, 18.5, 16.14, 24.8, NULL, NULL, NULL, '1.Solar Country Christmas Lighted with SS stake\nStake KD, topper KD                                                   \n2.Solar Panel: amorphousi si, 2V 30MA,40*40MM                                           \n3.Battery:1.2V AA 300mAh NI-CD 1pc        Working time:6-8 hours after full charged                   \n4.LED:reindeer 1pc warm white 1.5lm/ snowman 1pc warm white 1.5lm/tree 1pcs warm white 1.5lm\n5. ON/OFF switch.                                              6. Topper size:                                   reindeer:6.69x3.94x8.66in            snowman:3.54x3.54x7.22in             tree:3.75x3.75x7.87in', 'Xiamen', 'China', 'Solar', '5%', 'Stainless Steel', '25%', 'Iron', '70%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '1.5 LM', 1, NULL, '1.2V AA 300mAh NI-CD', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(116, 'RGG340A', 'RGG', 'Solar Holiday Infinity LED Garden Stakes - Asst. Display of 8', 6, 2, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.91, 13.58, 22.64, NULL, NULL, NULL, '1. Solar metal stake light\n2. Snowman with yellow scarf with 21 pcs Cool white LED 3Lumen\n3. Solar Panel information: polycrystalline silicon solar Panel 2V25MA,40*40mm\n4. Battery Type: 1*1.2V AA Ni-CD 600Mah Battery  Rechargeable and replaceable \n5. Working Time: About 6-8 hours if full charged\n6. On/off  Switch\n7. Topper Non KD, Stake KD\nTopper size:snowman with red scarf:6.30*1.77*10.04\'\nOriginal metal display sku# RGG340A', 'Xiamen', 'China', 'Iron', '72%', 'Plastic', '15%', 'Glass', '5%', 'Other', '8%', NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, '1.2V AA Ni-CD 600Mah', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(117, 'LJJ1080A', 'LJJ', 'Snowman Metal/Glass Christmas Solar Stake', 9, 1, 33, 'Santa Metal/Glass Christmas Solar Stake', 9, 1, 33, 'Penguin Metal/Glass Christmas Solar Stake', 9, 1, 33, 22.05, 9.65, 8.07, NULL, NULL, NULL, '1.3 Asst. Metal/Glass Xmas Solar stake\nHalf KD, Topper size snowman  8.50*1*9.50 ï¼Œsanta8.50*1*10ï¼Œpenguin8*1*9\n2.1 *AA NI-CD BATTERY,1.2V 300MAH\n3.SOLAR PANEL.:amorphous silicon  2V 25MAH, SIZE:4*4CM\n4.LIGHT:1 pc cool white Led.2LM\n5.Working Hours:6-8 Hours after full charged \n6.switch on/off, \n7.Battery is replaceable and rechargeable', 'Xiamen', 'China', 'Iron', '50%', 'Glass', '40%', 'Solar', '10%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA NI-CD BATTERY,1.2V 300MAH', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(118, 'QLP1196A', 'QLP', 'Solar Stars with Snowman Garden Stake ', 6, 1, 33, 'Solar Stars with Santa Garden Stake ', 6, 1, 33, NULL, 6, 1, NULL, 21.5, 9.5, 8.5, NULL, NULL, NULL, '1.Solar star pattern Christmas stake                                                     2. 1*AAA  NI-CD 300mah rechargable and replaceable battery                                        3.Item  KD : topper  NO KD                               4.LED Color :snowman with 10pcs cool white string with flicking LED 3.5lm ,santa with 11pcs red string light with flicking LED 1.5lm\n5.Solar Panel Information :Amorphous 2v 40*40mm 30MA                                             7.Working Time : 6-8Hours after full charge                                                                              7. On/Off Switch                                           8.topper size:  6.25*0.75*8.25in   ', 'Xiamen', 'China', 'Iron', '70%', 'Glass', '25%', 'Solar', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'Snowman 3.5, Santa 1.5', 1, NULL, 'AAA  NI-CD 300mah', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(119, 'RGG358A', 'RGG', 'Solar Santa/Snowman Snowflake Stake - Assorted Display of 8', 7, 3, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.7, 13.58, 21.46, NULL, NULL, NULL, '1. Christmas Solar metal stake light\n2. Santa with 1pcs Cool white LED, 3Lumen\n3. Solar Panel information: Ampous solar Panel 2V25MA,40*40mm\n4. Battery Type: 1*1.2V AA Ni-CD 300Mah Battery  Rechargeable and replaceable \n5. Working Time: About 6-8 hours if full charged\n6. On/off  Switch\n7. Topper Non KD, Stake KD,Snowflower KD\nOriginal metal display sku# is RGG358A', 'Xiamen', 'China', 'Plastic', '15%', 'Iron', '80%', 'Other', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, '1.2V AA Ni-CD 300Ma', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(120, 'SLL2056A', 'SLL', 'Solar Christmas Silver Multi Color Ornament  - Garden Stake', 5, 5, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.5, 16.5, 23, NULL, NULL, NULL, 'Glass solar stake                                                                                           SOLAR PANEL.:4*4cm amorphous crystalline silicon 2V 25MAH\n1*AA NI-CD 1.2V 300MAH battery\n10 warm white string light  2lm,\n top no KD,stake KD \ntop size:12.5*12.5*27.5cm\n on/off switch \n6-8hs after full charged', 'Xiamen', 'China', 'Glass', '40%', 'Iron', '30%', 'Solar', '30%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA NI-CD 1.2V 300MAH', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(121, 'QLP1017ABB', 'QLP', 'Solar Glass Star with Fiber Optic LED Stake - Tray Pack of 16', 5, 2, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.93, 16.93, 18, NULL, NULL, NULL, 'solar  glass star  w/  fiber stake  light \ntopper   KD ,stake    KD\namorphousi si, 2V 30MA,40*40MM\nwhite star -2pcs white LED 3.5LM ,golden  star-2pcs  white led 3.5LM; red  star -2pcs red LED 1.5LM ,green  star -2pcs rgreen LED 1.7LM ,\nNi-CD 300mAh AA 1.2V *1pc included   \non/off Switch\nWorking Time : 6-8Hours with full charged \nTopper size :4.65*1.57*5.31in ', 'Xiamen', 'China', 'Glass', '70%', 'SS', '10%', 'Fiber', '10%', 'Other', '10%', NULL, NULL, '100%', 1, 'LED', 'White 3.5LM; s red  1.5LM ,green 1.7LM', 1, NULL, 'Ni-CD 300mAh AA 1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(122, 'QLP1126ABB', 'QLP', 'Solar Christmas Tree with Fiber Color Stake- Tray Pack 16', 2, 2, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.75, 13.39, 18.11, NULL, NULL, NULL, '1. solar christmas trees w color fiber stake light  \n2. LED Color: 2pcs Green 1.7lm / 2pcs Red 1.5lm / 2pcs White  3.5LM\n3. Solar Panel Information: amorphous 40*40MM, 2V 30MA\n4. Battery Type: 1*1.2V AA Rechargeable Ni-CD 300mAh battery, 1pc included \n5. Working Time: 6-8Hours with full charge\n6. On/off Switch\n7. Topper KD, Stake KD\nTopper size:6*6*13cm\nMenards battery info: AA NI-MH 300MAH , need add $0.06 more                                                Fiber color same as topper', 'Xiamen', 'China', 'Plastic', '70%', 'Fiber', '10%', 'Other', '10%', 'Stainless Steel', '10%', NULL, NULL, '100%', 1, 'LED', ' Green 1.7lm, Red 1.5lm, White  3.5LM', 1, NULL, '1.2V AA Ni-CD 300mAh battery', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(123, 'QLP1103BB', 'QLP', 'Solar Snowman on a Fiber Stake - Tray Pack of 16', 3, 2, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 13.75, 17.65, NULL, NULL, NULL, '1. solar  snowman  w/  fiber stake  light\ntopper KD ,stake KD\n2. amorphousi si, 2V 30MA,40*40MM\n2pc white led 3.5lm\n3. Ni-CD 300mAh AA 1.2V *1pc ,battery can replaceable and rechargeable\n4. on/off Switch\n5. Working Time : 6-8Hours with full charge\n6. topper size:9*6*12.5cm \nMenards battery info: AA NI-MH 300MAH ,need add $0.06 more', 'Xiamen', 'China', 'Plastic', '70%', 'Fiber', '10%', 'Other', '10%', 'Stainless Steel', '10%', NULL, NULL, '100%', 1, 'LED', '3.5 LM', 1, NULL, 'Ni-CD 300mAh AA 1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(124, 'SOT882', 'SOT', 'Solar Snowman & Snowflake Stake with LED Lights', 6, 3, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.35, 17, 31.8, NULL, NULL, NULL, '1. Solar garden stakes with snowman and snowflake\n2. Item no KD,topper KD\n3.LED Info:Top 1* white2.8lumen ,middle 1* white 2.8lumen ,bottom 1* blue 0.5 lumen led \n4. Solar Panel Information: polycrystalline solar panel 2v 50ma\n5. Battery Typeï¼š1*AA Rechargeable Ni-CD 400 mAh battery\n6. Working Timeï¼šMin. 8H if fully charged\n7. On/Off Switch                                     8.snowman: 3.15\"x3.15\"x7.00\"     snowflake: 3.15\"', 'Xiamen', 'China', 'Plastic', '20%', 'Stainless Steel', '20%', 'Acrylic', '55%', 'Other', '5%', NULL, NULL, '100%', 1, 'LED', 'Top white2.8lumen ,middle white 2.8lumen ,bottom  blue 0.5 lumen led ', 1, NULL, 'AA Rechargeable Ni-CD 400 mAh', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(125, 'COR114T-3', 'COR', 'Candy Cane Pathway Lights - Set of 3', 7, 1, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 8.3, 29.13, NULL, NULL, NULL, '1.Indoor and Outdoor Use 60 cm Garden Candy,\n2.60L LED inclued 30L Cool White LED + 30L Red LED, 4 Lumen            \n3. IP44 transformer: Input: 120V-60Hz Output: 4.5V 0.60A\n4. 3m lead wire\n5. Space: 100cm\n6. Candy diameter18cm,Tube diameter1.7cm,Length30cm,Spike15cm\n7. 8 function: comb / in waves  / sequential / slo-glo / chasing/Flash / slow fade / twinkle/flash /  steady on\nLED not replaceable\nTransformer not replaceable', 'Ningbo', 'China', 'Plastic', '20%', 'LED', '40%', 'Wire', '40%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '6 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(126, 'COR116T-4', 'COR', 'Seasonal Christmas Star Santa Garden Stake with LED Lights', 7, 2, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.2, 13.4, 23.6, NULL, NULL, NULL, '1. Indoor and Outdoor Use  57cm Santa Lawn light ,\n2.124L Red LED included 96L Red LED + 28L White LED, 4 Lumen\n3. IP44 UL Adaptor Input: 120V-60Hz  Output: 4.5V 0.80A\n4. 3m lead wire .\n5. Space: 50cm\n6. Tube diameter1.7cm,Length30cm, Spike15cm\nLED not replaceable\nTransformer not replaceable', 'Ningbo', 'China', 'Plastic', '20%', 'LED', '40%', 'Wire', '40%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(127, 'QWR961ABB', 'QWR', 'Christmas Sweets Pot Stickers - Snowman', 1, 0.4, 3, 'Christmas Sweets Pot Stickers - Cane', 2, 0.3, 3, 'Christmas Sweets Pot Stickers - Gingerbread', 2, 0.3, 2, 14.96, 5.71, 5.12, NULL, NULL, NULL, 'Christmas sweets pot picks s/9', 'Xiamen', 'China', 'Polyresin', '95%', 'Iron', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(128, 'LAN252L', 'LAN', 'Frosty Christmas Snowflake Tree with Cool White LED Lights', 28, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 5.51, 36.22, NULL, NULL, NULL, '1. CHRISTMAS SNOWFLAKE TREE                          2. 120pcs cool white LED,  200 Lumen                              3. IP44 UL adaptor: input120V-60Hzï¼Œoutput 12v 0.30A\n4. 3M lead wire\n\nLED not replaceable                                         Transformer not replaceable ', 'Ningbo', 'China', 'Iron', '45%', 'Plastic', '20%', 'LED', '8%', 'Accessory', '27%', NULL, NULL, '100%', 1, 'LED', '200 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(129, 'CRD128GN', 'CRD', 'Silver Taped Bush Lighting Decor with Green LED Lights', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height Green Tape  Burst stake Lights\n2.140pcs Green LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', '15%', 'LED', '30%', 'Tape', '12%', 'Wire', '25%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51');
INSERT INTO `itemspecifications` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(130, 'CRD128MC', 'CRD', 'Silver Taped Bush Lighting Decor with Multi-Colored LEDs', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height SiLver Tape  Burst stake Lights\n2.140pcs Multi Color LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', '15%', 'LED', '30%', 'Tape', '12%', 'Wire', '25%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(131, 'CRD128RD', 'CRD', 'Silver Taped Bush Lighting Decor with Red LED Lights', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height Red Tape Burst stake Lights\n2.140pcs Red LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', '15%', 'LED', '30%', 'Tape', '12%', 'Wire', '25%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(132, 'CRD128WW', 'CRD', 'Silver Taped Bush Lighting Decor with Warm White LED Lights', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height SiLver Tape  Burst stake Lights\n2.140pcs Warm White LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', '15%', 'LED', '30%', 'Tape', '12%', 'Wire', '25%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(133, 'CRD111S-GD', 'CRD', 'Festive Golden Christmas Tree with Warm White LED Lights', 25, 25, 53, 'Stand', NULL, NULL, 61, NULL, NULL, NULL, NULL, 40.94, 16.54, 6.7, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) +with Twinkling\n1. 1.35M Height Gold Branch tree LED Lights\n2. 240pcs Warm white LED include 40pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.20A\n4.3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable\nOriginal SKU# is CRD111S-GD', 'Ningbo', 'China', 'Wire', '25%', 'LED', '30%', 'Iron', '15%', 'Tape', '12%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(134, 'CRD111S-GN', 'CRD', 'Festive Green Christmas Tree with Warm White LED Lights', 25, 25, 53, 'Stand', NULL, NULL, 61, NULL, NULL, NULL, NULL, 43.3, 8.26, 14.17, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) + with Twinkling\n1. 1.35M Height Green Branch tree LED Lights\n2.240pcs Warm white LED include 40pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.20A\n4. 3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable\nOriginal SKU# is CRD111S-GN', 'Ningbo', 'China', 'Wire', '25%', 'LED', '30%', 'Iron', '15%', 'Tape', '12%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(135, 'CRD111S-RD', 'CRD', 'Festive Red Christmas Tree with Warm White LED Lights', 25, 25, 53, 'Stand', NULL, NULL, 61, NULL, NULL, NULL, NULL, 43.3, 8.26, 14.17, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) + with Twinkling\n1. 1.35M Height Red Branch tree LED Lights\n2. 380pcs Warm white LED include 38pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.28A\n4. 3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Wire', '25%', 'LED', '30%', 'Iron', '15%', 'Tape', '12%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(136, 'CRD111S-SL', 'CRD', 'Festive Silver Christmas Tree with Warm White LED Lights', 25, 25, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40.94, 16.54, 6.7, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) + with Twinkling\n1. 1.35M Height Silver Branch tree LED Lights\n2. 240pcs Warm white LED include 40pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.20A\n4. 3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable\nOriginal SKU# is CRD111S-SL\n', 'Ningbo', 'China', 'Wire', '25%', 'LED', '30%', 'Iron', '15%', 'Tape', '12%', 'Transformer', '18%', '100%', 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(137, 'COR108MC', 'COR', 'Hanging Orb Decor with Multi-Colored Flashing LED Lights', 8, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.5, 17.5, 9.25, NULL, NULL, NULL, '1. Dia 20cm Sphere Ornament with Multi-Color LED Lights with Flashing Version\n2. 200pcs Red Green and Red Blue LED with flashing, 4 Lumen \n3. UL IP44 transformer: Input: 120V~60Hz, 0.20A, Output: 30V-0.12A\n4. 3m lead wire\n                                                           LED not replaceable\nTransformer not replaceable    ', 'Ningbo', 'China', 'GPPS', '30%', 'LED', '40%', 'Plastic', '30%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(138, 'COR162MC', 'COR', 'Hanging Cherry Ball with Flashing Multi-Colored LED Lights', 13, 13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26.8, 13.8, 26.8, NULL, NULL, NULL, '1. Dia 30cm Cherry Flower Ball\n2. 500pcs Multi color ( Green + Red + Blue LED ) with falshing, 4 Lumen\n3. UL IP44 transformer: 30V, Input: 120V-60Hz, Output: 30V-0.2A\n4. Lead wire: 5M\n5. Item not KD\n\nLED not replaceable\nTransformer is not replaceable', 'Ningbo', 'China', 'Plastic', '40%', 'LED', '40%', 'Wire', '20%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '16.40 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '16.40 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(139, 'COR152', 'COR', '3-Tier Hanging Ornaments with Chasing LED Lights - Small', 3, 3, 4, '3-Tier Hanging Ornaments with Chasing LED Lights - Medium', 6, 6, 7, '3-Tier Hanging Ornaments with Chasing LED Lights - Large', 6, 6, 13, 25.2, 19.3, 25.2, NULL, NULL, NULL, '1. Indoor Use Red Dia 30cm + Green Dia 15cm + Silver Dia 8cm ball\n2. Red Ball: 240pcs Warm White LED, 4 Lumen\n    Green Ball: 76pcs Cool White  LED, 4Lumen\n    Silver Ball: 44pcs Red LED, 4 Lumen\n3. UL IP44 transformer: Input: 120V-60Hz, Output: 5V-1.00A\n4. Spacing 20cm, Lead wire: 5M\n5. Item not KD\nLED not replaceable\nTransformer is not replaceable', 'Ningbo', 'China', 'ABS', '40%', 'LED', '40%', 'Wire', '20%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '16.40 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, '120V', '16.40 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(140, 'COR164', 'COR', '3-Tier Hanging Christmas Ornaments with LED Lights - Small', 4, 4, 4, '3-Tier Hanging Christmas Ornaments with LED Lights - Medium', 6, 6, 6, '3-Tier Hanging Christmas Ornaments with LED Lights - Large', 6, 6, 8, 17, 8.87, 26.8, NULL, NULL, NULL, '1. Dia 20cm + Dia15cm + Dia11cm Cherry Flower Ball\n2. Dia 20cm: 200pcs White+Blue LED, 4Lumen\n  Dia 15cm: 100pcs White+Blue LED, 4 Lumen\n  Dia 11cm: 50pcs White+Blue LED, 4 Lumen\n3. UL IP44 transformer: Input: 120V-60Hz,0.20A Output: 30V-0.2A\n4. Lead wire: 5M\n5. Space: 20CM\n5. Item not KD \n\nLED not replaceable\nTransformer is not replaceable', 'Ningbo', 'China', 'Plastic', '40%', 'LED', '40%', 'Wire', '20%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '16.40 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '16.40 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(141, 'LJJ824A', 'LJJ', 'Christmas Bird Feeding Metal DÃ©cor with Stand - Sock', 6, 3, 10, 'Christmas Bird Feeding Metal DÃ©cor with Stand - Tree', 7, 2, 11, 'Christmas Bird Feeding Metal DÃ©cor with Stand - Bird', 7, 2, 6, 19, 15.75, 11.61, NULL, NULL, NULL, '1. S/3 Metal/glass bird  feeding                                       2.With metal stand IPS109L,KD version                                   metal size:14.96*11.00*33.26 \"\n2 pcs of each color \n\n\nLJJ will make the stand by themselves', 'Xiamen', 'China', 'Iron', '95%', 'Glass', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\LJJ\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(142, 'JUM328A', 'JUM', 'Christmas Tree Cut-out Garden Stake - Display of 12', 7, 2, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.13, 14.56, 8.66, NULL, NULL, NULL, 'Metal tree stake (stake KD in 2 parts)', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(143, 'JUM330HH-RS', 'JUM', 'Brown Christmas Tree Cut-out with Silver Snowman and Star', 11, 2, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.07, 12.2, 13.38, NULL, NULL, NULL, 'Metal deco.', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(144, 'JFH1245A', 'JUM', 'Frosty Santa Stake Decor ', 16, 1, 38, 'Snowman Stake Decor ', 20, 1, 44, NULL, 20, 1, NULL, 41.34, 18.9, 8.27, NULL, NULL, NULL, 'Dural feature Santa and Snowman  stake dÃ©cor with easal\nStake KD, foldable easal', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(145, 'JUM324', 'JUM', 'Metal Deer Decoration', 14, 6, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.38, 5.12, 17.32, NULL, NULL, NULL, 'Metal deer deco.(neck kd)', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(146, 'JUM326', 'JUM', 'Metal Deer Decoration', 21, 4, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.38, 5.12, 17.32, NULL, NULL, NULL, 'Metal deer deco.(neck KD)', 'Xiamen', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(147, 'ORS728', 'ORS', 'Metallic Barrelled Reindeer DÃ©cor with Warm White LED Lights', 18, 11, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.25, 13.5, 21.75, NULL, NULL, NULL, '1.metal deer ,feet  KD\n2.string lights with 6 pcs warm white LED ,2 lm\n3.Non-waterproof battery box with timer 6 hours on ,18 hours off \n4.2*AA battery (not include)\n5.Switch :on-off ', 'Fuzhou', 'China', 'Iron', '90%', 'Light', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, '4.2*AA battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(148, 'ORS730', 'ORS', 'Metallic Barrelled Snowman DÃ©cor with Warm White LED Lights', 13, 16, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.12, 15, 31.87, NULL, NULL, NULL, '1.metal snownman, \n2.string lights with 6 pcs warm white LED ,2 lm\n3.Non-waterproof battery box with timer 6 hours on ,18 hours off \n4.2*AA battery (not include)\n5.Switch :on-off ', 'Fuzhou', 'China', 'Iron', '90%', 'Light', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, '4.2*AA battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(149, 'YHL256S', 'YHL', 'Cream White Metal Christmas Sleigh', 23, 12, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.62, 12.6, 13.19, NULL, NULL, NULL, 'SLEIGH\nITEM KD', 'Fuzhou', 'China', 'Iron', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(150, 'LJJ808HH', 'LJJ', 'Christmas Angel \"Joy\" DÃ©cor', 13, 8, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.5, 13.8, 26.5, NULL, NULL, NULL, ' Metal/wood Angel dec', 'Xiamen', 'China', 'Iron', '40%', 'Wood', '60%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(151, 'LJJ812HH', 'LJJ', 'Christmas Snowman DÃ©cor', 17, 8, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.75, 7.5, 26.5, NULL, NULL, NULL, ' Metal/wood Snowman dec', 'Xiamen', 'China', 'Iron', '40%', 'Wood', '60%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(152, 'MZP366', 'MZP', 'Rustic Metal Angellic Candle Tower with LED Lights', 14, 11, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 11.42, 14.96, NULL, NULL, NULL, '1.METAL ANGLE WITH 3PCS ELECTRONIC CANDLE, NO KD\n2.3pcs warm white LED, 3.0lm\n3. 3pcs of 2*AA nonwaterproof battery case for candle, with timer, 6 H on, 18H off, batteries are not included \n4. ON/OFF switch', 'Xiamen', 'China', 'Metal', '95%', 'Other', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'AA', 1, 'Battery Operated', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(153, 'MZP368', 'MZP', 'Rustic Metal Snowman Candle Tower with LED Lights', 14, 13, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33.86, 14.17, 14.96, NULL, NULL, NULL, '1.METAL SNOWMAN WITH 3PCS ELECTRONIC CANDLE, NO KD\n2.3pcs warm white LED, 3.0lm\n3. 3pcs of 2*AA nonwaterproof battery case for candle, with timer, 6 H on, 18H off, batteries are not included \n4. ON/OFF switch', 'Xiamen', 'China', 'Metal', '95%', 'Other', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'AA', 1, 'Battery Operated', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(154, 'WXY144ABB', 'WXY', 'Wooden Stars with Holiday Silhouette Scene - Tray Pack of 12', 10, 2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.26, 17.04, 10.63, NULL, NULL, NULL, 'Indoor Wooden star with led\n1. 8pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is not waterproof, price is not including the battery, timer 6 hours ON, 18 Hours OFF \n3. On/Off Switch ', 'Ningbo', 'China', 'Plywood', '90%', 'Plastic', '5%', 'LED and Battery', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(155, 'WXY148ABB', 'WXY', 'Indoor Wooden Christmas Tree Decor with LED - Tray Pack of 12', 7, 2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.35, 11.02, 9.45, NULL, NULL, NULL, 'Indoor Wooden tree with led\n1. 5pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is  not waterproof , price is not including the battery, timer 6 hours ON, 18 Hours OFF \n3. On/Off Switch ', 'Ningbo', 'China', 'Plywood', '90%', 'Plastic', '5%', 'LED and Battery', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(156, 'WXY152ABB', 'WXY', 'Wooden Santa & Snowman Decor - Tray Pack of 12', 6, 1, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.35, 7.88, 13.39, NULL, NULL, NULL, 'Indoor Wooden decoration with led\n1. 5pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is not waterproof , price is not including the battery, timer 6 hours ON, 18 Hours OFF\n3. On/Off Switch', 'Ningbo', 'China', 'Plywood', '90%', 'Plastic', '5%', 'LED and Battery', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(157, 'WXY154ABB', 'WXY', 'Indoor Wooden Santa Claus Decor with LEDs - Santa', 6, 1, 11, 'Indoor Wooden Santa Claus Decor with LEDs - Snowman', 6, 1, 12, NULL, 6, 1, NULL, 12.99, 8.55, 9.45, NULL, NULL, NULL, 'Indoor Wooden decoration with led\n1. 5pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is waterproof  price is not including the battery, timer 6 hours ON, 18 Hours OFF \n3. On/Off Switch ', 'Ningbo', 'China', 'Plywood', '90%', 'Plastic', '5%', 'LED and Battery', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(158, 'WXY104HH', 'WXY', 'Christmas Rocking Horse w/Santa Tabletop Decor', 10, 2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.5, 11.5, 11, NULL, NULL, NULL, 'SANTA & HORSE CHRISTMAS DECORATION\nITEM NOT KD', 'Ningbo', 'China', 'MDF', '98%', 'Metal Bell', '2%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(159, 'WXY122BB-S', 'WXY', 'Christmas Santa and Reindeer Sitting Down', 6, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.2, 8.26, 6.69, NULL, NULL, NULL, 'SANTA & DEER CHRISTMAS DECORATION\nITEM NOT KD', 'Ningbo', 'China', 'MDF', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(160, 'WXY142', 'WXY', 'Indoor Wooden Carved Sleigh DÃ©cor', 9, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.63, 10.2, 7.68, NULL, NULL, NULL, 'Indoor Wooden sleigh', 'Ningbo', 'China', 'Plywood', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(161, 'WXY166BB', 'WXY', ' Wooden Deer Family w/ bell & Pink Tree-Tray Pack of 12', 6, 2, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.6, 11.55, 8.27, NULL, NULL, NULL, 'Indoor Wooden decoration', 'Ningbo', 'China', 'Plywood', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(162, 'WXY168BB', 'WXY', 'Wooden Moose Decor with Bell & Pink Tree - Tray Pack of 12', 6, 2, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.55, 14.55, 12.99, NULL, NULL, NULL, 'Indoor Wooden decoration', 'Ningbo', 'China', 'Plywood', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(163, 'WHS102WW', 'WHS', 'Christmas Village Turning Train, Skaters and Music', 13, 13, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.14, 16.14, 22.44, NULL, NULL, NULL, 'LED Village w Turning Train, Tree and Skaters & Music                                      1.Copper lamp (71pcs warm white); LED (4pcs warm white) ,2 LM                                     \n2. UL DC 4.5V,0.9 W Adaptor,adaptor box is not waterproof,price is including the adaptor, battery operated as well  indoor use only\n3. ON 1/OFF/ON 2 Switch, \nON1 (moving+light+music)  \nON2 (moving+light)  \nSong list:\n1 Jingle Bell\n2 We wish you a Merry Christmas\n3 Silent Night\n4 Deck the Halls\n5 Joy to the world\n6 The first Noel        \n7 Hark! The Heard Angel sing                \n8 Oh, Christmas Tree', 'Xiamen', 'China', 'Polyresin', '75%', 'Plastic', '5%', 'LED and Batter', '5%', 'Paint', '13%', 'Metal', '2%', '100%', 1, 'LED', '2 LM', 1, NULL, NULL, 1, 'Battery and Cord Connected', NULL, 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(164, 'WCC142MC', 'WCC', 'Jolly  Christmas Town with fountain scene and LED Lights', 11, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.49, 12.99, 20.08, NULL, NULL, NULL, 'Led Lighted Xmas Houses with fountain Scene\n1.17pcs LED light, 3 Lumen\n2. color changing: 1pc, RD:3pcs\nBL:2pcs, YL:9pcs, GN:2pc, \n3.3*AA Battery,battery box is not waterproof,price is not including the battery.\n4.6 hours ON,18 hours OFF Timer.\n5.On/Off Switch.\n6. pump non-replaceable, pump no UL approval as it is battery operated ,reminder Jodie already ', 'Xiamen', 'China', 'Polyresin', '95%', 'Plastic', '3%', 'LED', '2%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(165, 'WHS114MC', 'WHS', 'Christmas Tree Shop with LED Lights and Rotating Tree', 9, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.18, 14.76, 22.17, NULL, NULL, NULL, 'Christmas LED shop w Turning tree \n1.LED: 7red 7blue 9 Yellow 7green 8 warm white                                  \n2. 3*AA Battery ,battery box is not waterproof,price is not including the battery, 6 hours ON,18 hours OFF        \n3. ON/OFF Switch        ', 'Xiamen', 'China', 'Plastic', '50%', 'Polyresin', '40%', 'LED', '3%', 'Paint', '5%', 'Iron', '2%', '100%', 1, 'LED', '2 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(166, 'WCC114ABB-TM', 'WCC', 'Miniature Christmas House with LED lights- White house', 3, 2, 3, 'Miniature Christmas House with LED lights- Snowman', 3, 2, 5, 'Miniature Christmas House with LED lights-Santa', 3, 2, 5, 17.32, 9.84, 12.99, NULL, NULL, NULL, 'Resin Xmas House/Scene with Led light.\n\n1.3pcs LED light, 3 Lumen\n\n2.left 1st, 2nd, 3rd: 1pc of RD/GN/BL\n, right: 2pcs BL, 1pc WT\n3.2*AAA Battery,battery box is not waterproof,price is not including the battery.\n\n4.6 hours ON,18 hours OFF Timer.\n\n5.On/Off Switch.\n\n6.With Try me', 'Xiamen', 'China', 'Polyresin', '95%', 'Plastic', '3%', 'Electronic', '2%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'AAA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(167, 'WHS110MC-TM', 'WHS', 'Christmas LED Village with Turning Skaters', 7, 4, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.91, 9.65, 17.05, NULL, NULL, NULL, 'Christmas LED Village w Turning Skaters 1.1red 1blue 1green 4warm white LED lamp, 3 LM                                   \n2. 3*AA Battery ,battery box is not waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n3. ON/OFF Switch                             4.With TRY ME', 'Xiamen', 'China', 'Polyresin', '87%', 'Plastic', '3%', 'LED, Fiber Optic and Batt', '3%', 'Paint', '5%', 'Metal', '2%', '100%', 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(168, 'WQA760L-WT', 'WQA', '18\" White Ceramic Church Decor - (Plug In)', 10, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.25, 10.5, 19.75, NULL, NULL, NULL, 'white glazed ceramic churches plug        1. C7 TUNGSTEN BULB, YELLOW COLOR\n3. CUL PLUG,120V, 15W\n4. ITEM NOT KD\n5. ON/OFF SWITCH   ', 'Xiamen', 'China', 'Ceramic', '95%', 'Light', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '20 LM', 0, NULL, NULL, 1, 'Cord Connected', '4.43 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(169, 'BEH200HH', 'BEH', '27\" Snowman Statue with Warm White LED Lights', 7, 6, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.2, 8.9, 30.2, NULL, NULL, NULL, 'MGO.snowman with LED \n1. 4pcs LED light, 4 Lumen   \n2. Color: warm white\n2*AA Battery ,battery box is waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch  ', 'Xiamen', 'China', 'MGO', '97%', 'LED', '3%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(170, 'BEH204HH', 'BEH', '27\" Moose Statue with Warm White LED Lights', 7, 6, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.9, 10.1, 30.6, NULL, NULL, NULL, 'MGO.deer with LED \n1. 4pcs LED light, 4 Lumen     \n2. Color: warm white\n2*AA Battery ,battery box is waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch  ', 'Xiamen', 'China', 'MGO', '97%', 'LED', '3%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(171, 'BEH206HH', 'BEH', '23\" Angel Statue with Warm White LED Lights', 7, 5, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.4, 9.7, 26.3, NULL, NULL, NULL, 'MGO.angel with LED \n1. 4pcs LED light, 4 Lumen                                        \n2. Color: warm white\n2*AA Battery ,battery box is waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch  ', 'Xiamen', 'China', 'MGO', '97%', 'LED', '3%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '4 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(172, 'WTJ217', 'WTJ', 'Festive Christmas Snowman Candle Holder', 7, 6, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.34, 9.65, 18.5, NULL, NULL, NULL, 'Snowman Statuary for T-Light\ncan fit 3.8*3.8*1CM candle\nprice not including candle', 'Xiamen', 'China', 'Magnesia', '90%', 'Fabric', '10%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(173, 'WTJ220', 'WTJ', 'Christmas Country Snowman with LED Lights', 7, 6, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 9.25, 21.26, NULL, NULL, NULL, 'Snowman with LED                                     1. 4pcs LED light,6 Lumen                                    2. color warm white\n3. 2*AAA Battery with timer 6 hours ON,18 hours OFF, waterproof battery box, price is not including battery\n4.On/Off Switch           ', 'Xiamen', 'China', 'Magnesia', '85%', 'Fabric', '5%', 'LED', '5%', 'Plastic', '5%', NULL, NULL, '100%', 1, 'LED', '6 LM', 1, NULL, 'AAA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(174, 'WTJ222', 'WTJ', 'Christmas Country Santa with LED Lights', 7, 6, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 9.25, 16.54, NULL, NULL, NULL, 'Santa with LED                                       1. 6pcs LED light ,6 Lumen                                   2. color warm white\n3. 3*AAA Battery with timer 6 hours ON,18 hours OFF, waterproof battery box price is not including battery\n4.On/Off Switch           ', 'Xiamen', 'China', 'Magnesia', '90%', 'Fabric', '5%', 'LED', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '6 LM', 1, NULL, 'AAA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(175, 'WTJ226', 'WTJ', 'Christmas Country Santa with Tea Light Candle Holder', 7, 6, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.91, 10.04, 26.38, NULL, NULL, NULL, 'Santa With Lantern', 'Xiamen', 'China', 'Magnesia', '90%', 'Metal', '5%', 'Fabric', '5%', NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(176, 'QWR898', 'QWR', 'Winter Bird with \"Merry Christmas\" Statue', 11, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 11, 18.3, NULL, NULL, NULL, 'bird on ball statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(177, 'QWR900', 'QWR', 'Winter Owl Family Statue', 11, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 9.8, 16.1, NULL, NULL, NULL, 'owls statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(178, 'QWR902', 'QWR', 'Winter Penguin Family Statue', 13, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.4, 10.2, 16.1, NULL, NULL, NULL, 'penguins statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(179, 'QWR904', 'QWR', 'Winter Hedgehogs Family Statue', 14, 11, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.1, 13, 17.3, NULL, NULL, NULL, 'Hedgehogs statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(180, 'QWR908', 'QWR', 'Winter Snowman Family Statue', 13, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.4, 9.4, 16.9, NULL, NULL, NULL, 'snowmen statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(181, 'QWR910', 'QWR', 'Snowman and Penguin Statuary', 11, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.8, 10.8, 19.3, NULL, NULL, NULL, 'snowman and penguin statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(182, 'QWR778', 'QWR', 'Christmas Dove Statue With Hat', 15, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.75, 11, 17.25, NULL, NULL, NULL, 'bird statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(183, 'QWR780', 'QWR', 'Christmas Dove Statue with hat and Book', 13, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.75, 11, 13.3, NULL, NULL, NULL, 'bird statuary', 'Xiamen', 'China', 'Magnesia', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(184, 'QWR916', 'QWR', 'Retro Red Car with Christmas Tree and LED Lights', 22, 11, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.4, 13.4, 19.3, NULL, NULL, NULL, 'Vehicle with LED and sound\n1. 7pc LED,  warm white light                                \n2.  3*AA Batteries,battery box is not waterproof,price is not including the battery\n3.6 hours ON,18 hours OFF\n4. On/Off Switch  \nSong list: \nJingle Bells\nWe Wish You A Merry Christmas\nSilent Night\nDeck the Halls\nJoy to the World\nThe First Noel\nHark the Herald Angels Sing\nOh Christmas Tree', 'Xiamen', 'China', 'Magnesia', '89%', 'LED', '5%', 'Plastic', '6%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2-3 LM', 1, NULL, 'AA Batteries', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(185, 'USA1526ABB', 'USA', 'Pinecone Snowmen Decor - Tray Pack of 4', 6, 4, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.99, 9.84, 11.02, NULL, NULL, NULL, '1. Snowman\n2. NOT KD', 'Xiamen', 'China', 'Polyresin', '56%', 'Stone Powder', '44%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(186, 'WQA727A', 'WQA', 'Tree-Dressed Snowmen with LED Lights - Joel', 7, 4, 12, 'Tree-Dressed Snowmen with LED Lights - Joy', 6, 4, 12, NULL, 6, 4, NULL, 16.77, 12.44, 14.06, NULL, NULL, NULL, 'Snowmen table top w/led light 2 asst\n1. 8pcs LED string light, 3LM                                         \n2. color: warm white\n3. 3*LR44 BATTERY,battery box is not waterproof,price is including the battery, no timer\n4. On/Off Switch   ', 'Xiamen', 'China', 'Resin', '95%', 'LED Light', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'LR44 BATTERY', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(187, 'QWR952', 'QWR', 'Blissful Tree Grabbing Snowman with Warm White LED Lights', 15, 11, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.96, 11.42, 26.57, NULL, NULL, NULL, 'SNOWMAN\n1. 4pcs LED, 3 LM\n2.warm white light                                                           3.3*AA Battery with timer 6 hours ON,18 hours OFF,battery box is waterproof,price is not including the battery\n4.On/Off Switch ', 'Xiamen', 'China', 'Magnesia', '83%', 'LED', '6%', 'Plastic', '8%', 'Solar Panel', '3%', NULL, NULL, '100%', 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(188, 'QWR956', 'QWR', 'Christmas Wreath Reindeer DÃ©cor with Warm White LED Lights', 16, 10, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.83, 10.63, 26.77, NULL, NULL, NULL, 'DEER\n1. 5pcs LED, 3 LM\n2. warm white light                                                           3.3*AA Battery with timer 6 hours ON,18 hours OFF,battery box is waterproof,price is not including the battery \n4.On/Off Switch ', 'Xiamen', 'China', 'Magnesia', '84%', 'LED', '6%', 'Plastic', '6%', 'Solar Panel', '3%', 'Felt', '1%', '100%', 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(189, 'ZTY104CC', 'ZTY', 'Red Christmas Ball Ornament with Color Changing LED Lights', 21, 16, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.65, 18.7, 36.42, NULL, NULL, NULL, '1. X\'mas ball  with LED  light\n2.8PCS color change LED light\n3.Battery box waterproof with 2*AA battery with timer (6hours on, 18 hours off ) ,\n4.the price is not including battery .\n5,on and off button switch', 'Xiamen', 'China', 'MGO', '94%', 'Iron', '1%', 'LED', '5%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 1, NULL, 'AA battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(190, 'KGD240ABB', 'KGD', 'Heavenly Christmas Angel Bell Ornaments - Tray Pack of 16', 3, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.3, 9.14, 6.5, NULL, NULL, NULL, '4 Asst Little Bless Angel                                  with hanging string and a bell inside ', 'Xiamen', 'China', 'Polyresin', '97%', 'Iron', '2%', 'String', '1%', NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(191, 'LAZ156A', 'LAZ', 'Seasonal Harvest Scarecrow Pumpkin DÃ©cor Kit - Hat/Hair', 10, 0.2, 8, 'Seasonal Harvest Scarecrow Pumpkin DÃ©cor Kit - Eyes', 1, 0.2, 1, 'Seasonal Harvest Scarecrow Pumpkin DÃ©cor Kit - Nose', 1, 0.2, 2, 11.42, 8.86, 9.05, NULL, NULL, NULL, 'SCARECROW PUMPKIN DECOR KIT', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(192, 'QWR938', 'QWR', 'Halloween Scarecrow Pumpkin Holder w/ Warm White LED Lights', 13, 9, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.99, 9.84, 22.05, NULL, NULL, NULL, 'PUMPKING HALLOWEEN CHARACTER HOLDERS WITH LIGHTS                         1.3pcs LED light                                            2.warm white light                                                           3.3*AA Battery with timer 6 hours ON,18 hours OFF,battery box is waterproof,price is not including the battery \n4.On/Off Switch \n5.Outdoor use', 'Xiamen', 'China', 'Magnesia', '90%', 'LED', '6%', 'Plastic', '4%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '2-3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(193, 'WQA1274CC', 'WQA', 'Skull and Pumpkin Halloween Decor with LED Light', 9, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.65, 11.61, 22.42, NULL, NULL, NULL, 'Skull w/pumpkin with led light                     1.1pc LED light                                     \n2. color changing led light\n3. 2* LR44 Battery ,battery box is not waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch        ', 'Xiamen', 'China', 'Polyresin', '95%', 'LED', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 1, NULL, 'LR44 Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(194, 'WQA1278ABB-CC-TM', 'WQA', 'Halloween Skull Head with LED Light - Pirate Skull', 6, 7, 6, 'Halloween Skull Head with LED Light -  Skull', 6, 7, 6, NULL, 6, 7, NULL, 17.32, 14.8, 8.46, NULL, NULL, NULL, 'Halloween skull head w/led light \n1.1pc LED light(left one), 2pcs LED light(right one)                           \n2. color changing led light\n3. 2*LR44 Battery ,battery box is not waterproof,price is including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch, 1traypack with 1pc try me     ', 'Xiamen', 'China', 'Polyresin', '95%', 'LED', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'N/A', 1, NULL, 'LR44 Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(195, 'YEN392', 'YEN', 'Solar Wooden Die Cut Reindeer Statue with LED Lights', 20, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.62, 6.3, 19.49, NULL, NULL, NULL, '1.Wood diecut reindeer solar light \n2.Waterproof battery box , which fit 2*AA ,price without battery                                                 \n3,LED:20pcs warm  white led,2 lumen                                                          \n4,Timer:6 hours on and 18 hours off                                                                   \n6,Switch: ON/OFF switch                      \n7.antler kd,feet kd    ', 'Xiamen', 'China', 'Fir Wood', '75%', 'Iron', '15%', 'Plastic', '5%', 'Cloth', '5%', NULL, NULL, '100%', 1, 'LED', '2 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51');
INSERT INTO `itemspecifications` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(196, 'HEH176ABB', 'HEH', 'Boy with Snowball Statues ', 4, 3, 7, 'Girl with Snowball Statues ', 4, 3, 7, NULL, 4, 3, NULL, 11.1, 10.85, 20, NULL, NULL, NULL, 'standing boy&girl holding snowball 2 asst.\nNot KD\n2*3 ', 'Xiamen', 'China', 'Pottery', '80%', 'Wooden', '20%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(197, 'LJJ246A', 'LJJ', '36\" Metal Turkey Garden Stakes - Fall ', 10, 1, 36, '36\" Metal Turkey Garden Stakes - Harvest', 11, 1, 36, NULL, 11, 1, NULL, 32.28, 10.83, 4.65, NULL, NULL, NULL, '1/.S/2 Metal/Glass Turkey Garden Stake,\n2.Topper KD,stake not KD,4x2', 'Xiamen', 'China', 'Iron', '80%', 'Glass', '20%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(198, 'WQS100A', 'WQS', 'Snowman LED Stakes- Battery Operated', 11, 1, 42, ' Santa Stop Sign LED Stakes- Battery Operated', 10, 1, 42, '', 10, 1, 0, 21.85, 14.37, 42.91, 0, 0, 0, '12pcs led light(snowman with happy holiday)/12pcs led light(sexangle) \nwith 24\'\'snow measurement\n1,12pcs LED warm white 3LM\n2,2*AA battery with timer 6hours on,18hours off,battery box is waterproof,price is not including the battery\n3,on/off switch', 'Ningbo', 'China', 'Plywood', '20%', 'MDF', '60%', 'LED', '10%', 'Plastic', '5%', 'PVC', '5%', '100', 1, 'LED', '2 LM', 1, 0, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-27 16:42:43'),
(199, 'SLL1248ABB', 'SLL', 'Christmas Joy Decor with LED Light  ', 8, 4, 7, 'Christmas Snow Decor with LED Light  ', 12, 3, 6, NULL, 12, 3, NULL, 22.44, 14.37, 8.74, NULL, NULL, NULL, 'JOY Led decoration/the batter box can fix 1*AA battery/one red led   with timer 6hs on 18hs off /price and shippment whithout battery. snow led decoration/the batter box can fix 1*AA battery/one blue led     with timer 6hs on 18hs off /price and shippment whithout battery.', 'Xiamen', 'China', 'Polyresin', '40%', 'Glass', '30%', 'Electron', '30%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', '1LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(200, 'IFF198MC', 'IFF', 'Multi-Color Garden Metal Stake Windmill Spinner - last row', 23, 6, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 3, 25, NULL, NULL, NULL, 'Blue-Red-Yellow-white with peel off finish Disk Spinner (KD)       - 16pcs spinners as this item is coming with 4 colors , 1color 4 spinners\nTopper non-KD ,Stake KD into 4 parts     ', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\IFF\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 17:07:51'),
(201, '123456', 'TRPKL', 'test item des 1', 23.5, 2, 3, 'test item des 2', 1, 3.2, 10, 'test item des 3', 1, 3.2, 30, 70, 20, 22, 23, 24, 23, 'test ms dees', NULL, NULL, 'mm 1', '23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'LED', '1800', 1, NULL, 'test bb', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feature 1 test', NULL, NULL, NULL, NULL, NULL, NULL, 'baljeet', 'test troy', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(602, 'KPP500', 'KPP', 'Wind Spinner Display Stand ', 31, 20, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32.68, 12.8, 20.87, NULL, NULL, NULL, 'Wind Spinner Display Stand', 'Xiamen', 'China', 'Metal', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:51'),
(603, 'LJJ218', 'LJJ', 'Rain Gauge Replacement - test', 2, 2, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.25, 12.25, 14.25, NULL, NULL, NULL, '1.Big Size Glass Rain Gauge in Blister;\n2.Not K/D', 'Xiamen', 'China', 'Glass', '100%', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:51'),
(604, 'QLP487ABB-DSP', 'QLP', '3D Flower FIBER OPTIC LED LIGHT Garden Stake with Wall Plug - test', 6, 6, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.88, 6.88, 16.33, NULL, NULL, NULL, 'Flower w/fiber solar fiber stake light non-moving\npolycrystal si, 2V  40ma;no work.\n2pcs LED- red1.5lm,green 1.7lm,blue 0.4lm.\nNo Battery\nTopper  KD,Pole KD                             \n', 'Xiamen', 'China', 'Plastic', '95%', 'Solar', '5%', NULL, NULL, NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'red 1.5, green 1.7, blue 0.4', 0, NULL, NULL, 0, ' Cord Connected ', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:51'),
(605, 'QLP210-DSP', 'QLP', 'Hummingbird FIBER OPTIC LED LIGHT Garden Stake Wall Plug - test', 5, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.25, 17.75, 20, NULL, NULL, NULL, 'SOLAR FIBER  Non-Motion STAKE W/HUMMINGBIRD; LED:2PCS, 4COLOR ASST-4 WHITE 3.5lm/4 GREEN1.7lm/4 RED1.5lm/4 BLUE0.4lm; changed to be plug working            ', 'Xiamen', 'China', 'Plastic', '85%', 'Fiber', '5%', 'Stainless steel', '10%', NULL, NULL, NULL, NULL, '100%', 1, 'LED', 'WHITE 3.5lm/4 GREEN1.7lm/4 RED1.5lm/4 BLUE0.4lm', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `itemspecificationverions`
--

CREATE TABLE `itemspecificationverions` (
  `seq` bigint(20) NOT NULL,
  `itemno` varchar(50) NOT NULL,
  `oms` varchar(10) DEFAULT NULL,
  `item1description` varchar(2500) DEFAULT NULL,
  `item1length` double DEFAULT NULL,
  `item1width` double DEFAULT NULL,
  `item1height` double DEFAULT NULL,
  `item2description` varchar(2500) DEFAULT NULL,
  `item2length` double DEFAULT NULL,
  `item2width` double DEFAULT NULL,
  `item2height` double DEFAULT NULL,
  `item3description` varchar(2500) DEFAULT NULL,
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
-- Dumping data for table `itemspecificationverions`
--

INSERT INTO `itemspecificationverions` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(1, 'QLP268ABB-DSP', 'QLP', 'Insect/Flower MOTION LED LIGHT Garden Stake with Wall Plug - Hummingbird', 5, 4, 31, 'Insect/Flower MOTION LED LIGHT Garden Stake with Wall Plug - Dragonfly - test', 6, 3, 31, 'Insect/Flower MOTION LED LIGHT Garden Stake with Wall Plug - Butterfly - test', 6, 3, 31, 9.75, 9.75, 17.5, NULL, NULL, NULL, 'Solar motion stake w/hummingbird,dragonfly,butterfly,sunflower:18pcs LED                                                                                         LED:sunflower-yello 1.5lm/bird-white 3.5lm/butterfly-red 1.5lm/dragonfly-green 1.7lm                                                                   Topper KD,stake KD                        \nchanged to be plug working ', 'Xiamen', 'China', 'Plastic', 95, 'Solar', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'sunflower-yellow 1.5lm/bird-white 3.5lm/butterfly-red 1.5lm/dragonfly-green 1.7lm    ', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(2, 'QLP228ABB-DSP', 'QLP', 'Starburst MOTION LED LIGHT Garden Stake with Wall Plug', 4, 4, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.5, 10.25, 19.5, NULL, NULL, NULL, 'Solar lighted moving stake w/ star; \n LED: 18*LED3 COLOR ASST-WHITE 3.5lm /RED 1.5lm /BLUE 0.4lm;\nTopper KD  stake KD\n changed to be plug working     ', 'Xiamen', 'China', 'Plastic', 95, 'Flowing', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'WHITE 3.5lm /RED 1.5lm /BLUE 0.4lm', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(3, 'SLY180A-DSP', 'QLP', 'Mosaic LED Garden Stake with Wall Plug - test', 5, 4, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 11.81, 17.91, NULL, NULL, NULL, '1.Description: solar stake light -plug in                          no battery                                                   3.Item KD or Not  :yes                              4.LED Color : White ,3.5LM                        5.Solar Panel Information: useless Amorphous Silicon  4*4CM                                                                                                          6. On/Off Switch ', 'Xiamen', 'China', 'Glass', 85, 'Stainless Steel', 10, 'Plastic', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3.5 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(4, 'SLC528BB-DSP', 'QLP', 'Mosaic American Flag Globe Stake with Wall Plug', 4, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.75, 14.75, 16.5, NULL, NULL, NULL, '1. Mosaic with Flag design Globe Stakes change to be plug in\n2. Item KD\n3. LED Info: 1 COOL white LED 3.5lm\n4. Solar Panel Information:Crystalline solar panel, useless panel\n5. Battery Typeï¼šno\n6. Working Timeï¼š \n7. On/Off Switch  ', 'Xiamen', 'China', 'Glass', 70, 'Stainless', 15, 'Plastic', 15, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3.5 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(5, 'SLC108A-DSP', 'YEN', 'Mosaic Globe Stakes White LED with Wall Plug', 4, 4, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 5.5, 19.5, NULL, NULL, NULL, '1.Description: solar stake light with High voltage DC plug                                                    2. Battery:without battery                                   3.Item KD or Not  :yes                              4.LED Color :1* White,4lm                      5.Solar Panel Information : polycrystalline silicon  40*40mm      35MA/2V                                          ', 'Xiamen', 'China', 'Glass', 70, 'Stainless Steel', 20, 'Plastic', 5, 'Others', 5, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(6, 'SOT434A-DSP', 'SOT', 'Solar Metal Flower Garden Stakes with Wall Plug - Set of 3', 7, 4, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27.75, 13.5, 20.5, NULL, NULL, NULL, 'stake with plug white color 3.0LM', 'Xiamen', 'China', 'Iron', 66, 'Glass', 28, 'Plastic', 6, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(7, 'RGG119A-DSP', 'RGG', 'Bee LED Garden Stake with Wall Plug', 8, 1, 38, 'Butterfly LED Garden Stake with Wall Plug - test', 9, 1, 38, 'Dragonfly LED Garden Stake with Wall Plug - test 123', 9, 1, 38, 10.5, 7.25, 20.4, NULL, NULL, NULL, 'Metal stake with DSP changing w 33\" wire ,LED info:dragonfly has 20 pcs led ,bee has 14 pcs led,butterfly has 18 pcs led.LED warm white  LED 3Lumen ,tooper KD ,DC plug,33inch long for the wire.On/off Switch.No battery.', 'Xiamen', 'China', 'Plastic', 10, 'Iron', 82, 'Other', 8, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', '2.75 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(8, 'HPP312ABB-DSP', 'SOT', 'Round Mesh Garden Stake with Wall Plug- Asst. Display of 4', 3, 3, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7.5, 7.5, 17.25, NULL, NULL, NULL, '\"garden stake with plug  LED:Red/Blue/White/Green single color  1PC                                                                        the product supply by Alpine                              ITEM K/D  ,topper  K/D                                                              NO battery            \nTransformer: INPUT:120-250V 50/60Hz .OUTPUT:1DC4.2V +-0.5V  DC500mA  Light line 95cm  4pcs white LED                                                               \"\n', 'Xiamen', 'China', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '120-250 V', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(9, 'SOT102-DSP', 'SOT', 'Angel Garden Stake with Wall Plug', 3, 3, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.75, 15, 17.75, NULL, NULL, NULL, 'stake with plug,no battery, blue color 0.6LM', 'Xiamen', 'China', 'Stainless Steel', 25, 'Plastic', 15, 'Acrylic', 60, NULL, NULL, NULL, NULL, 100, 1, 'LED', '0.6 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(10, 'SOT866-DSP', 'SOT', 'Solar Star Trio LED Garden Stake with Wall Plug', 6, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.25, 11, 17.5, NULL, NULL, NULL, 'solar 3 topper stake with plug                solar panel no work  ITEM K/D                   NO battery\nTransformer: INPUT:100-250V 50/60Hz .OUTPUT:1DC4.2V +-0.5V  DC500mA  Light line 95cm    1pc blue LED/1pc red LED/1pc white LED', 'Xiamen', 'China', 'Metal', 50, 'Glass', 20, 'Electron', 30, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '100-250V', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(11, 'SOT162-DSP', 'SOT', 'Cross Garden Stake with Wall Plug - test 33', 4, 1, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.25, 10, 17.75, NULL, NULL, NULL, 'stake with plug,no battery,  white 3.0LM', 'Xiamen', 'China', 'Stainless Steel', 25, 'Plastic', 15, 'Acrylic', 60, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(12, 'SLC192-DSP', 'RGG', 'USA Flag Stake with White LED Lights and Wall Plug', 5, 1, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 11, 16.75, NULL, NULL, NULL, '1.Americana Flag Solar  Light  with plug \n2. Topper  KD \n3.LED:White Color 1PCS 3lm \n4. Solar Panel:no work 1pc  \n5,without battery                                     Topper Size:4.33*1.38*4.13                             \n', 'Xiamen', 'China', 'Stainless Steel', 36, 'Plastic', 64, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(13, 'QLP476BB-DSP', 'QLP', 'Solar Acrylic Hummingbird and Flower LED Light', 6, 5, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 6.25, 17.5, NULL, NULL, NULL, '1.acrylic humming bird and flower solar light w plug in changing.                                                      2.White LED on top-3.5lm, Right middle blue LED-0.4lm , Left middle red LED-1.5lm, Bottom green LED -1.7lm\n3.topper KD, staker 2 KD                       4.Solar Panel Informationï¼šAmorphous si 45*45mm  ,no work.                                                5.NO Battery \n 6.On/Off Switch', 'Xiamen', 'China', 'Plastic', 65, 'Stainless ', 25, 'Others', 10, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'White 3.5lm, Blue 0.4lm, Red 1.5lm, Green 1.7lm', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(14, 'SOT530A-DSP', 'SOT', 'Flower Trio LED Garden Stake with Wall Plug', 6, 4, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.25, 9.63, 17.38, NULL, NULL, NULL, 'stake with plug', 'Xiamen', 'China', 'Plastic', 58, 'Stainless Steel', 42, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(15, 'SOT244A-DSP', 'SOT', '2 Hummingbirds & Flower LED Garden Stake with Wall Plug', 6, 5, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.25, 9.5, 17, NULL, NULL, NULL, '2 Hummingbirds & Flower LED Garden Stake with Wall Plug', 'Xiamen', 'China', 'Plastic', 58, 'Stainless Steel', 42, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(16, 'SOT858-DSP', 'SOT', 'Flower and Insect Trio Garden Stake with Wall Plug', 6, 6, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 11.25, 17.75, NULL, NULL, NULL, 'solar 3 topper stake with plug                solar panel no work  ITEM K/D                   NO battery', 'Xiamen', 'China', 'Plastic', 20, 'Stainless Steel', 20, 'Acrylic', 50, 'Other', 10, NULL, NULL, 100, 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(17, 'KAW122AHH-BK ', NULL, 'Black Aluminum Windchimes with Agate Stones-Master Pack of 4', 6, 6, 30, 'Chain', NULL, NULL, 39, NULL, NULL, NULL, NULL, 17.13, 8.66, 7.09, NULL, NULL, NULL, '39\"METAL WINDCHIME(not KD)\n\nThe pendant is natural ,it can not be same as each piece each shipment Jodie confirmed this is Ok to accept but we will have special notation on packaging about this ', 'Ningbo', 'China', 'Aluminum', 70, 'MDF', 10, 'Agate', 10, 'Iron', 10, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(18, 'KAW122AHH-BR ', NULL, 'Brown Aluminum Windchimes with Agate Stones-Master Pack of 4', 6, 6, 30, 'Chain', NULL, NULL, 39, NULL, NULL, NULL, NULL, 17.13, 8.66, 7.09, NULL, NULL, NULL, '39\"METAL WINDCHIME(not KD)\n\nThe pendant is natural ,it can not be same as each piece each shipment Jodie confirmed this is Ok to accept but we will have special notation on packaging about this ', 'Ningbo', 'China', 'Aluminum', 70, 'MDF', 10, 'Agate', 10, 'Iron', 10, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(19, 'QLP596-2', 'QLP', 'Alpine\'s Li-ion Rechargeable Battery 2 Pack', 1, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.5, 8.25, 5.5, NULL, NULL, NULL, '1.Description: BATTERY               \n2. 1*PC 18650  2000mAh   3.7V                                                                                                                                         3.Working Time : 12  hours if full charge            ', 'Xiamen', 'China', 'Battery', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 1, NULL, 'PC 18650  2000mAh', 1, 'Battery', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(20, 'TS-CANOPY-BK4', 'CJW', '5x5 Pop Up Canopy with Alpine Logo and Three Sides', 60, 60, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 58, 8, 8, NULL, NULL, NULL, 'Custom print pop up tent 5ftx5ft\n\nwith ALPINE logo in the item, same as our catalogue.', 'Xiamen', 'China', '420D Polyester(matt)', 68, 'Aluminum Frame', 30, 'Velcro Lock', 2, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(21, 'TS-CANOPY-BK3', 'CJW', '10x10 Pop Up Canopy with Alpine Logo and Three Sides', 120, 120, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, 8, 60, NULL, NULL, NULL, 'Custom print pop up tent 10ftx10ft\n\nwith ALPINE logo in the item, same as our catalogue.', 'Xiamen', 'China', '420D Polyester(matt)', 68, 'Aluminum Frame', 30, 'Velcro Lock', 2, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(23, 'QAP104BB-DSP', 'SOT', 'Lantern Pathway Stake with Wall Plug', 7, 6, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 8.85, 18.31, NULL, NULL, NULL, ' ITEM K/D                                                                              NO battery                                                                        plastic solar stake light supply by Alpine           ', 'Xiamen', 'China', 'Plastic', 85, 'Amorphous Solar Panel', 15, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '32 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/28', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(24, 'QAP100BB-DSP', 'SOT', 'Lantern Pathway Stakes with Wall Plug', 7, 6, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 8.85, 18.31, NULL, NULL, NULL, ' ITEM K/D                                                                              NO battery                                                                        plastic solar stake light supply by Alpine         ', 'Xiamen', 'China', 'Plastic', 85, 'Amorphous Solar Panel', 15, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '32 LM', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/28', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(25, 'SOT714ABB-6-DSP', 'SOT', 'Metal Flower Garden Stake with Wall Plug', 9, 4, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, 19.5, 19, NULL, NULL, NULL, '1. iron flower solar stake with plug\n2. Item KD\n3. LED 1pc\n4. Solar Panel  not working, no battery\n5. adapter 1 pc       \n6. On/Off Switch  ', 'Xiamen', 'China', 'Iron', 85, 'Plastic', 5, 'Glass', 10, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(26, 'USA754L', 'USA', '29\" Boy and Bronze Angel Fountain and LED Lights', 17, 16, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.2, 21, 22.8, NULL, NULL, NULL, '1.29\'\' Angel and boy  Fountain;KD                                                  2.with two SINGLE WHITE LED lights                                                                                     3. Low voltage Pump: WP-350, GPH:350L;HMAX:0.7m                                             4.Transfomer:JBA48U-12-830N ;Input: 120V AC 60HZ 11W, Ouput: 12V AC  830MA                                                                                                                    5.Cord Length for Pump:2M       Cord length for transformer 1.83m                                                                                                                       Water Capacity:  8 L                                                    Light is replaceable,Alpine sku # is RLS100                                                          Pump is replaceable,Alpine sku # is P120                                                                                     Transformer is replaceable, Alpine sku # is PL022T       ', 'Xiamen', 'China', 'Polyresin', 30, 'Stone Powder', 20, 'Cement', 30, 'Sand', 20, NULL, NULL, 100, 1, 'LED', 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\USA\\PDF', 'P120', 'RLS100', 'PL022T', 'N/A', 'N/A', 'N/A', 'N/A', 'WP-350, GPH:350L;HMAX:0.7', '6.56 Ft', '11 W', '12V', '6Ft', '8L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(27, 'ZEN746', 'ZEN', 'Hanging Bear Birdhouse Knot', 5, 6, 10, 'Chain', NULL, NULL, 13, NULL, NULL, NULL, NULL, 14.3, 14, 11.15, NULL, NULL, NULL, 'Polyresin bear birdhouse\ndoor clean out from back                                                                     opening hole dia.:1.00 inch', 'Xiamen', 'China', 'Polyresin', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(28, 'IPS300HH', 'IPS', 'Rust Metal Outdoor Pig Decor', 12, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.35, 11.75, 16.9, NULL, NULL, NULL, 'Metal Pig ', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(29, 'IPS302HH', 'IPS', 'Rust Metal Outdoor Cow Decor', 13, 5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.5, 9.5, 18.5, NULL, NULL, NULL, 'Metal Cow ', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(30, 'NCY342A', 'NCY', 'Metal Farm Animal Weathervane Stakes - Cock', 15, 13, 48, 'Metal Farm Animal Weathervane Stakes - Cow - teee', 15, 13, 48, 'Metal Farm Animal Weathervane Stakes - Pig', 15, 13, 48, 40.19, 13.79, 6.3, NULL, NULL, NULL, 'Metal cock,cow,pig weather vane stake  \nTopper KD,Stake non-KD', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(31, 'ORS566BB', 'ORS', 'Cowboy Wall DÃ©cor- Tray Pack of 6', 24, 1, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.5, 12.5, 13.35, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Wood', 80, 'Metal', 20, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(32, 'ORS574BB', 'ORS', 'Cow Wall DÃ©cor- Tray Pack of 6', 1, 12, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 11, 13.25, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Wood', 70, 'Metal', 25, 'Linen', 5, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(33, 'ORS576HH', 'ORS', 'Welcome Cowboy Boot Wall DÃ©cor', 15, 2, 18, 'String', NULL, NULL, 25, NULL, NULL, NULL, NULL, 19.5, 11, 15.8, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Wood', 50, 'Metal', 45, 'Rope', 5, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(34, 'ORS678', 'ORS', 'Metal Rooster, Pig & Bull Wall DÃ©cor testddd 34', 22, 1, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.5, 7.5, 24.2, NULL, NULL, NULL, 'WOODEN AND METAL WALL DEOCR', 'Fuzhou', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(35, 'ORS700', 'ORS', 'Metal Pig Planter', 17, 6, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.1, 11.8, 23.5, NULL, NULL, NULL, 'metal pig planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(36, 'ORS702', 'ORS', 'Metal Sheep Planter', 17, 6, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.5, 11.2, 24.25, NULL, NULL, NULL, 'metal sheep planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(37, 'ORS704', 'ORS', 'Metal Cow Planter', 16, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.7, 11.4, 17, NULL, NULL, NULL, 'metal cow planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(38, 'ORS706', 'ORS', 'Metal Rooster Planter', 14, 7, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.25, 15, 15, NULL, NULL, NULL, 'metal Rooster planter ,the bucket is KD ', 'Fuzhou', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(39, 'QWR648SLR', 'QWR', '15\" Solar Turtle on Rock Statuary', 11, 10, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.75, 12.75, 16.75, NULL, NULL, NULL, 'Magnesia turtle standing on ball with solar                                          2 pcs white LED       3lm-4lm                                                                       Batteries :1* AA NI-MH 1.2V  300mA                              Solar panels :polycrystalline silicon 2V 40mA', 'Xiamen', 'China', 'Magnesia', 87, 'LED', 6, 'Plastic', 4, 'Solar Panel', 3, NULL, NULL, 100, 1, 'LED', '3lm-4lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(40, 'QWR650SLR', 'QWR', 'Magnesia Frog Standing on Ball with Solar', 10, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 12.75, 20.25, NULL, NULL, NULL, 'Magnesia frog standing on ball with solar                                          2 pcs white LED       3lm-4lm                                                                       Batteries :1* AA NI-MH 1.2V  300mA                              Solar panels :polycrystalline silicon 2V 40mA', 'Xiamen', 'China', 'Magnesia', 87, 'LED', 6, 'Plastic', 4, 'Solar Panel', 3, NULL, NULL, 100, 1, 'LED', '3lm-4lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(41, 'QWR932SLR', 'QWR', 'Solar LED Turtle test ddfd', 9, 7, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.5, 9.5, 16.75, NULL, NULL, NULL, '1. Turtle with solar\n2. 2pc warm white LED light, 2LM\n3. Solar Panel Information: polycrystalline silicon 70X40mm 2V 40MAH\n4.Battery Type:1* AA NI-MH 2V  300mAH, rechargeabel, replaceable    \n5. Working Timeï¼šMin. 6-8H if fully charged\n6. On/Off Switch', 'Xiamen', 'China', 'Magnesia', 90, 'LED', 4, 'Plastic', 6, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(42, 'QWR934SLR', 'QWR', 'Solar LED Snail tees', 10, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.5, 9.5, 16, NULL, NULL, NULL, '1. snail with solar\n2. 2pc warm white LED light, 2LM\n3. Solar Panel Information: polycrystalline silicon 70X40mm 2V 40MAH\n4.Battery Type:1* AA NI-MH 2V  300mAH, rechargeabel, replaceable   \n5. Working Timeï¼šMin. 6-8H if fully charged\n6. On/Off Switch', 'Xiamen', 'China', 'Magnesia', 90, 'LED', 4, 'Plastic', 6, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(43, 'QWR936SLR', 'QWR', 'Solar LED Frog', 9, 8, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.5, 9.5, 16.5, NULL, NULL, NULL, '1. frog with solar\n2. 2pc warm white LED light, 2LM\n3. Solar Panel Information: polycrystalline silicon 70X40mm 2V 40MAH\n4.Battery Type:1* AA NI-MH 2V  300mAH, rechargeabel, replaceable   \n5. Working Timeï¼šMin. 6-8H if fully charged\n6. On/Off Switch', 'Xiamen', 'China', 'Magnesia', 90, 'LED', 4, 'Plastic', 6, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2lm', 1, NULL, 'AA Ni-Mh', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(44, 'ZEN666ABB', 'ZEN', 'Mini Dogs and Cats Pot Stickers - Tray Pack of 24', 2, 1, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 7.48, 5.51, NULL, NULL, NULL, 'Mimi dogs and cats statues stake \n4 dogs +2 cats ', 'Xiamen', 'China', 'Polyresin', 90, 'Others', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(45, 'ZEN736ABB', 'ZEN', 'Baby Bear Cubs Statue -  Up', 4, 4, 6, 'Baby Bear Cubs Statue -  Middle', 5, 4, 6, 'Baby Bear Cubs Statue -  Down', 5, 4, 5, 16.25, 13.8, 8, NULL, NULL, NULL, '6\"H polyresin bear statue S/3', 'Xiamen', 'China', 'Polyresin', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(46, 'ZEN778SLR-S', 'ZEN', 'Solar Frog with Umbrella Garden Statue', 6, 5, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 10.8, 14, NULL, NULL, NULL, '1. 12\" frog statue with solar light\n2.  warm white string light with 8pcs LED , 3LM\n3. Solar Panel Information: polycrystalline  solar panel 40*40mm 2V 30MA\n4ã€Battery Type:1*1.2v AA Rechargeable Ni-CD 300 mAh battery\n5. Working Timeï¼šMin. 8H if fully charged\n6. on/Off Switch ', 'Xiamen', 'China', 'Polyresin', 60, 'Iron', 35, 'Solar/LED', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, '1.2v AA Rechargeable Ni-CD 300 mAh battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(47, 'YEN204A', 'YEN', 'Solar Flower Light Stake', 9, 2, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.28, 10.83, 7.09, NULL, NULL, NULL, '1.Flower solar light stake,KD                                      2.Solar panel: 2V 40MA amorphous silicon,40*40mm                                                   \n3,LED: 20pcs white color string light  led, 2lm                                                                 4,Battery: 1*AA 1.2V/ 400mAh rechargeable Ni-Cd\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      6,Switch: ON/OFF switch                                   7.Topper Size:  8.66x1.85x 11.42 inch    topper no kd ,item kd 2 parts.', 'Xiamen', 'China', 'Metal', 85, 'Solar', 10, 'Other', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V/ 400mAh rechargeable Ni-Cd', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(48, 'YEN358', 'YEN', 'Solar Hydrangea Trio LED Stake - Display of 6', 11, 5, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.7, 11.81, 14.17, NULL, NULL, NULL, '1.Flower solar light stake                                                                              \n2.Solar panel: 2V 60MA amorphous silicon 4x4cm,foldable solar panel\n3,LED: 18pcs white led for each flower,total 54pcs white led,2 lumen                                                              \n4,Battery: 1*AA 1.2V/ 600mAh rechargeable NI-CD and battery can be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch       \n7.Topper size:10.63x4.72x14.96 inch                  \nflower size:4.72x4.33x2.76 inch each\ntopper no kd,item kd into 2 parts      ', 'Xiamen', 'China', 'Iron', 90, 'Solar', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V/ 600mAh rechargeable NI-CD ', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(49, 'YEN362', 'YEN', 'Pineapple Solar Light with Hook', 7, 7, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.25, 14.57, 7.6, NULL, NULL, NULL, '1.Pineapple solar light,with hook                                                                             \n2.Solar panel: 2V 40MA amorphous silicon 4x4cm\n3,LED: 40pcs warm white led ,2 lumen                                                              \n4,Battery: 1*AAA 1.2V/ 400mAh rechargeable NI-CD and battery can be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch       \n7.Pineapple size:6.69x6.69x9.45/13.39 inch                   \nhook kd into 2 parts   ', 'Xiamen', 'China', 'Iron', 90, 'Solar', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AAA 1.2V/ 400mAh rechargeable NI-CD', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(50, 'MZP254BR', 'MZP', '71\" Brown Wind Spinner Garden Stake', 23, 6, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, 4.25, 23.5, NULL, NULL, NULL, 'Garden Stick,KD', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\MZP\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(51, 'MZP356', 'MZP', 'Metal Rooster', 17, 8, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 7.25, 19, NULL, NULL, NULL, 'METAL ROOSTER, NO KD', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(52, 'QEL548ABB', 'QEL', 'Metal Retro Flower - Assorted Tray Pack of 24', 4, 1, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.75, 9, 6, NULL, NULL, NULL, 'Metal Flower w/Bead Pick                                                         yellow,orange,blue,red                                                                                                                                      Not KD\n\nRelated sku# QEL604HH/QEL606HH/QEL608HH/QEL610HH     ', 'Xiamen', 'China', 'Iron', 98, 'Glass', 2, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(53, 'QLP1049A-CC', 'QLP', 'Solar Hummungbird Garden Stakes - Assorted of 8', 12, 12, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30.75, 17, 8.75, NULL, NULL, NULL, '1. Solar  20 icons  stake  lighted    -green/clear  hummingbird \ntopper no kd ,stake   kd \nmono/polycrystal si, 2V 80MA,45*45MM\nLED:20pcs LED(green  hummingbird : white LED3.5LM  ,clear humming bird - color changing LED )\nNi-CD 300mAh AA 1.2V *1pc \non/off Switch\nWorking Time : 6-8Hours with full charged\nTopper size: 3.5*4.32*1.95cm ', 'Xiamen', 'China', 'Plastic', 90, 'Others', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '5 LM', 1, NULL, 'Ni-CD 300mAh AA 1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(54, 'QLP1122SLR', 'QLP', 'Solar Gerber Daisy Hanging Bouquet', 8, 8, 8, 'Chain', NULL, NULL, 19, NULL, NULL, NULL, NULL, 18.25, 18, 9.5, NULL, NULL, NULL, '1.solar hanging metal  flower\n2.mono/polycrystal si,2V,100ma,45*45mm\n3.27pcs white LED-  3.5 lm ,    \n4.Ni-CD 600mAh 1.2V  AA*1pc rechargable and replaceable battery\n5.ITEM no KD,                 \n6. on /Off Switch                                        \n 7. Working Time : 6-8Hours after full charge ', 'Xiamen', 'China', 'Iron', 90, 'Solar', 5, 'Plastic', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3.5 LM', 1, NULL, 'Ni-CD 600mAh 1.2V  AA', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(55, 'BEH152HH', 'BEH', 'Moss Rooster Statue', 13, 4, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.25, 12.5, 15.25, NULL, NULL, NULL, 'MGO rooster figure', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(56, 'BEH154HH', 'BEH', 'Moss Pig Statue', 14, 6, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.2, 14.1, 16.9, NULL, NULL, NULL, 'MGO pig figure', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(57, 'BEH166HH', 'BEH', 'Tortoise Moss Planter', 15, 11, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.25, 13.25, 18.25, NULL, NULL, NULL, 'MGO tortoise  pot', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(58, 'BEH168HH', 'BEH', 'Shoe Moss Planter', 15, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.9, 10.9, 18.4, NULL, NULL, NULL, 'MGO shoes pot', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(59, 'LRD128SLR', 'LRD', 'Solar Candle', 4, 4, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.8, 10.8, 14, NULL, NULL, NULL, '1. solar candle\n2. 93pc orange LED with candle light\n3. Solar Panel Information: polycrystalline silicone solar panel 72*72mm 1.5V\n4ã€Battery Type:li-ion 18650 Rechargeable 1500mAh ,but non-replaceable\n5. Working Time:Min. 8-12H if fully charged\n6. AUTO/Off  \n7ã€Top KD ', 'Shenzhen', 'China', 'ABS', 60, 'PCB, Cable, Battery and L', 30, 'Other', 10, NULL, NULL, NULL, NULL, 100, 1, 'LED', '5-10 LM', 1, NULL, 'li-ion 18650 Rechargeable 1500mAh', 1, 'Battery Operated and Solar', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\LRD\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/28', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(60, 'QTT474A', 'QTT', 'Solar Hanging LED Bulb with Metal Stand - Assorted of 15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.Solar bulb hanger\nSolar bottle hanger -QTT426SLR-SL/BZ\nwith 24pcs warm white string light LED 2 Lumen   \nSolar hanger -QTT430SLR-TM with 24pcs warm white string light LED 2lumen\nQTT391SLR-TM with 24pcs warm white string light LED 2lumen \nQTT389SLR-TM with 21pcs warm white string light LED 2lumen     \n2.With try me on each item                        \n3. 2V 30MA polycrystalline  silicon  solar panne  \n4. 1x AA 1.2V 300MAH NI-CD rechargable battery,                                \n5.On/off Switch          \n\nMetal display:22.50*22.50*77.00\'\'  \n\nBVF make metal display then send to QTT to pack together            ', 'Xiamen', 'China', 'Glass', 50, 'Plastic', 20, 'Solar', 20, 'Metal', 10, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V 300MAH NI-CD', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(61, 'SOT948A-9', 'SOT', 'Solar Spinning LED Insect Stake- Assorted Display of 9', 14, 5, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.75, 17.75, 14.4, NULL, NULL, NULL, '1.metal solar stake light  with rotate               \n2. Topper K/D ,stake  KD 2parts,glass ball K/D\n3. LED  white color  1 pc  3.0LM\n4.Solar panel is amorphous  silicon,2V 35MAH  1pc \n5.NI-CD AAA 1.2V 400MAH battery 1pc\n6. ON/OFF Switch                                             7.Work time:upto 8h if fully charged    8.Glass ball is 2.36\"D      ', 'Xiamen', 'China', 'Metal', 85, 'Glass', 10, 'Plastic', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'NI-CD AAA 1.2V 400MAH', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(62, 'MZP292HH', 'MZP', 'Rustic Dragonfly Wall Art', 25, 2, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28.5, 10.5, 18.75, NULL, NULL, NULL, 'Metal Dragonflyywall art', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(63, 'RGG155A', 'RGG', 'Hummingbird Rain Gauge ', 7, 3, 43, 'Butterfly, DragonFly, Bee Rain Gauge dodgy', 8, 3, 43, NULL, 8, 3, NULL, 25, 16.75, 13, NULL, NULL, NULL, 'Solar metal stake light\nLED info:17pcs  white LED 3Lumen \nKD on middle\nSolar Panel information:ampous solar Panel 2V35MA,40*40mm\n1*AA 1.2V 300Mah,Ni-cd  Battery\nWorking Time: About 6-8 hours when full charge\nOn/off Switch.', 'Xiamen', 'China', 'Plastic', 10, 'Iron', 72, 'Glass', 10, 'Other', 8, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'AA 1.2V 300Mah,Ni-cd', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(64, 'QEL404A', 'QEL', 'Metal Colorful Fun Bird Garden Stakes - Green, Orange', 3, 7, 35, 'Metal Colorful Fun Bird Garden Stakes - Purple gadded', 3, 5, 35, 'Metal Colorful Fun Bird Garden Stakes - Blue', 3, 5, 35, 37.15, 12, 5.5, NULL, NULL, NULL, 'Metal Funny Bird Pick                                                         green,purple,orange,blue                                                                                                                                      Not KD                                                                                                                                                   4x3', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(65, 'QYY108ABB', 'QYY', 'Solar Plastic Rotating Ball Garden Stake gdgd', 3, 3, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.75, 15.5, 19.12, NULL, NULL, NULL, '1.  Plastic rotational ball with solar stake light\nRed ball-butterfly ,green/white/blue ball-dragonfly\n2. 1*cold whiteLED light .Lumen:1.2lm\n3. Solar Panel Information: polycrystallin    2pcs of  (50mm*20mm ) Solar panel  2V      80MA;             \n4ã€Battery Type:1*NI-MH AA1.2V Rechargeable 400mA battery\n5. Working Timeï¼šMin. 6H if fully charged\n6. AUTO/Off Switch \n7ã€Topper non- KD ,item KD 2 parts   8.Topper size:3.12*3.12*5.07 in', 'Xiamen', 'China', 'PS', 50, 'ABS', 30, 'Stainless Steel', 15, 'LED & Battery', 5, NULL, NULL, 100, 1, 'LED', '1.2 LM', 1, NULL, 'NI-MH AA1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(66, 'ATB114HH-GN', 'ATB', 'Green Garden Gazebo Birdfeeder', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', 95, 'Rope', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46');
INSERT INTO `itemspecificationverions` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(67, 'ATB114HH-YL', 'ATB', 'Garden Gazebo Bird Feeder - Yellow', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', 95, 'Rope', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(68, 'ATB114HH-BL', 'ATB', 'Blue Garden Gazebo Birdfeeder', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', 95, 'Rope', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/14', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(69, 'ATB114HH-RD', 'ATB', 'Red Garden Gazebo Birdfeeder', 7, 6, 9, 'Rope', NULL, NULL, 13, NULL, NULL, NULL, NULL, 15.75, 9.75, 14.25, NULL, NULL, NULL, 'Bird Feeder', 'Qingdao', 'China', 'Paulonia Wood', 95, 'Rope', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(70, 'BEH150HH', 'BEH', 'Moss \"Garden\" Sheep Statue', 13, 4, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 12, 15.8, NULL, NULL, NULL, 'MGO sheep figure', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(71, 'NZW236HH', 'NZW', 'Garden Pebble Pig Statue- Master Pack of 4', 13, 8, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.25, 10.25, 30.25, NULL, NULL, NULL, 'PIG', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(72, 'NZW240HH', 'NZW', 'Garden Pebble Cow Statue- Master Pack of 4', 14, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, 12.5, 32, NULL, NULL, NULL, 'COW', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(73, 'NZW244HH', 'NZW', 'Garden Pebble Rooster Statue- Master Pack of 4', 13, 7, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.25, 12, 30.75, NULL, NULL, NULL, 'ROOSTER', 'Xiamen', 'China', 'MGO', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(74, 'HEH270S-WT', 'HEH', 'Garden White and Black Metal Rooster Decor', 8, 14, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.96, 8.07, 20.08, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(75, 'HEH268L-GN', 'HEH', 'Garden Green Standing Metal Rooster', 9, 15, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.76, 8.19, 16.73, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(76, 'HEH270L-GN', 'HEH', 'Garden Green Metal Rooster Decor', 10, 19, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.29, 8.86, 26.57, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(77, 'GDS124', 'GDS', 'Hunting Garden Gnome Statue', 5, 5, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.15, 14, 14.25, NULL, NULL, NULL, 'Polyresin garden gnome decoration\nitem non-KD', 'Xiamen', 'China', 'Polyresin', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(78, 'GDS126', 'GDS', 'Hunting Garden Gnome Statue', 5, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.15, 14, 14.25, NULL, NULL, NULL, 'Polyresin garden gnome decoration\nitem non-KD', 'Xiamen', 'China', 'Polyresin', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(79, 'GDS128', 'GDS', 'Hunting Red Garden Gnome Statue', 5, 5, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.15, 14, 14.25, NULL, NULL, NULL, 'Polyresin garden gnome decoration\nitem non-KD', 'Xiamen', 'China', 'Polyresin', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(80, 'HEH268S-WT', 'HEH', 'Garden White and Black Standing Metal Rooster', 7, 10, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.63, 6.5, 13.58, NULL, NULL, NULL, 'metal cock ', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(81, 'LJJ1004ABB', 'LJJ', 'Metal Garden Flower Stake  - Tray Pack of 24', 5, 2, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.62, 15.75, 5.51, NULL, NULL, NULL, 'S/ 4 METAL YELLOW/BLUE/RED FLOWER STAKE\nItem not KD\nOriginal sku# LJJ920ABB/LJJ921ABB', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(82, 'MAZ542', 'MAZ', 'Iron Faucet Planter', 11, 9, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 6, 10.5, NULL, NULL, NULL, '1.Planter Holder\n2.Item  KD', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(83, 'BVK616', 'BVK', 'Rusty Green Garden Bench', 45, 22, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42.52, 5.71, 21.85, NULL, NULL, NULL, 'BENCH\nItem KD \nweight capacity:500-700LBS', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\BVK\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(84, 'WQA1096ABB', 'WQA', 'Woodcut Owl Garden Stone Decor - Assorted Tray Pack of 6', 7, 8, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.13, 9.45, 10.24, NULL, NULL, NULL, 'Cement Stepping Stone 3 Asst', 'Xiamen', 'China', 'Cement', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(85, 'MAZ341A', 'MAZ', 'Brown Rustic Finish Fork Garden Stakes - NB', 7, 1, 40, 'Brown Rustic Finish Fork Garden Stakes - OB', 7, 1, 40, 'Brown Rustic Finish Fork Garden Stakes - TB', 7, 1, 40, 43.13, 13, 9.25, NULL, NULL, NULL, 'STAKE , NON KD ', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(86, 'SOT866BB-12', 'SOT', 'Solar Garden Stakes with 3 Stars - Tray of 12', 6, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.75, 13.6, 19.3, NULL, NULL, NULL, '1. Solar garden stakes with 3 stars\n2. Item KD,topper KD\n3.LED Info:Top 1* red 0.5lumen ,middle 1* white 2.8lumen ,bottom 1* blue 0.5 lumen led \n4. Solar Panel Information: polycrystalline solar panel 2v 50ma\n5. Battery Typeï¼š1*AA Rechargeable Ni-CD 400 mAh 1.2v battery\n6. Working Timeï¼šMin. 8H if fully charged\n7. On/Off Switch  ', 'Xiamen', 'China', 'Plastic', 28, 'Stainless Steel', 22, 'Acrylic', 40, 'Other', 10, NULL, NULL, 100, 1, 'LED', 'Top red 0.5lm ,middle white 2.8lm ,bottom blue 0.5 lm', 1, NULL, 'AA Rechargeable Ni-CD 400 mAh 1.2v', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(87, 'TEC246M-CR', 'TEC', '12\" Cream Planter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(88, 'TEC350S-YL', 'TEC', '10\" Woven Plastic Yellow Planter', 14, 14, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.5, 14.5, 15, NULL, NULL, NULL, 'PLASTIC  PLANTER', 'Ningbo', 'China', 'Plastic', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(89, 'TEC350L-DGN', 'TEC', '11\" Woven Plastic Dark Green Planter', 16, 16, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.5, 16.5, 17, NULL, NULL, NULL, 'PLASTIC  PLANTER', 'Ningbo', 'China', 'Plastic', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(90, 'TEC246L-GN', 'TEC', '15\" Bowl Planter - Large - Green', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(91, 'TEC250S-RD', 'TEC', '12\" Rippled Planter - Small - Red', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(92, 'HUJ156S', 'NCY', '59\" Brown Ringed Windmill Stake', 18, 7, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.98, 3.54, 19.29, NULL, NULL, NULL, '1.  Windmill  Decoration                                        2. Item KD ', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\HUJ\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(93, 'QTT490SLR-DSP', 'QTT', 'Mesh Torch Stake with Wall Plug', 7, 7, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.5, 15.25, 14.25, NULL, NULL, NULL, '1.solar torch stake  \nTopper Non KD stake KD                    \n2. INPUT:100-240VAC  50/60HZ      OUTPUT:5.7V-800MA      line leaderï¼š130CM\n3. NO BATTERY                       \n4.On/off Switch                                                  5.96pcs yellow flicking LED 5 Lumen                                             \ntopper size 18*18*22cm      ', 'Xiamen', 'China', 'Plastic', 30, 'Solar', 20, 'Iron', 50, NULL, NULL, NULL, NULL, 100, 1, 'LED', '5 LM', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'Z:\\Assembly & Instruction Manuals\\QTT\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(94, 'SLL803A-18-DSP', 'SOT', 'Hedgehog, Turtle, & Frog Garden Stake w Wall Plug - Set of 3', 2, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.6, 12, 30.7, NULL, NULL, NULL, ' ITEM K/D                                                                   NO battery                                                                 Solar panel no work                                     LED: white                                                           the polyresin produce and stakes  supply by Alpine       ', 'Xiamen', 'China', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(95, 'SLL683A-12-2-DSP', 'SOT', 'Solar Bird House Garden Stake with Wall Plug - Set of 4', 7, 3, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.75, 11.4, 30.15, NULL, NULL, NULL, ' ITEM K/D                                                                                  NO battery                                                                 Solar panel no work                                     LED: white                                                           the iron produce  supply by Alpine         ', 'Xiamen', 'China', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(96, 'SLL636ABB-DSP', 'SOT', 'Solar Religious Glass Stakes with Wall Plug - Assorted Set 4', 3, 3, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.5, 17.35, 12.6, NULL, NULL, NULL, 'stake with plug, no battery, Topper from other factory', 'Xiamen', 'China', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(97, 'QLP267ABB-DSP', 'QLP', 'Solar 3D Flower LIGHTED LED Stake w Wall Plug - Set of 3', 6, 6, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.07, 18.07, 2.47, NULL, NULL, NULL, 'Flower w/fiber solar fiber stake light non-moving\n2pcs LED-white 3.5lm, blue 0.4lm, green1.7lm\nTopper KD,stake KD                        \nchanged to be plug working ', 'Xiamen', 'China', 'Plastic', 95, 'Fiber', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'white 3.5lm, blue 0.4lm, green1.7lm', 0, NULL, NULL, 1, 'Cord Connected', NULL, 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(98, 'YCC161ABB-DSP', 'YCC', 'Tulip Stake with LED Lights with Wall Plug', 3, 3, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9.84, 9.06, 19, NULL, NULL, NULL, 'Solar stainless steel sticker wtih crackle tulip and plastic candle  with plug\nStake KD, topper NO KD\n*1 warm white led 4lm,                                             *Amorphose solar panel, 2V 30MA   , no battery\n* ON/OFF switch\n* Wire length 95 cm', 'Xiamen', 'China', 'Metal', 50, 'Plastic', 30, 'Stainless steel', 20, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '3.12 Ft', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(99, 'GXP158CC-DSP', 'GXP', 'Solar Crackle Ball w/ Color Changing LED Stake with Wall Plug', 4, 4, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.25, 11.25, 21.75, NULL, NULL, NULL, '1.LED:1PC color changing LED               2.solar panel:2V 60ma, ,crystalline silicon,40*40mm with plug in, no battery\n3. lead wire length: 1M\n4.topper dia:10cm\nMODEL:JB-0920    INPUT:AC 100-240V-50/60HZ    OUTPUT:9V==2A\nTopper not KD , stake KD 2 parts', 'Xiamen', 'China', 'Stainless Steel', 45, 'Glass', 35, 'Plastic', 20, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 0, NULL, NULL, 1, 'Cord Connected', '3.28 Ft', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(100, 'SLC294ABB-DSP', 'SOT', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(101, 'RGG108ABB-DSP', 'RGG', 'Abstract Garden Stakes  with Wall Plug', 4, 4, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.5, 19.6, 17.25, NULL, NULL, NULL, 'Ball stake with DSP changing w 33\"wire              LED info:1pcs.LED , white  LED 3Lumen ,topper KD,DC plug,33inch long for the wire.On/off Switch.                                         No battery.', 'Xiamen', 'China', 'Plastic', 55, 'Stainless Steel', 40, 'Other', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '2.75 Ft', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(102, 'ORS500S', 'ORS', '49\" Metal Sunflower Stake', 18, 3, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.75, 13.3, 16.75, NULL, NULL, NULL, ' METAL STAKE WITH H STAKE ,D14.87inch, KD -Small', 'Fuzhou', 'China', 'Metal', 90, 'Plastic', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\ORS', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(103, 'ORS500M', 'ORS', '60\" Metal Sunflower Stake', 18, 3, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 35, 14.97, 20.87, NULL, NULL, NULL, ' METAL STAKE WITH H STAKE ,D18.00 KD -Medium', 'Fuzhou', 'China', 'Metal', 90, 'Plastic', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\ORS', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(104, 'QEL372A', 'KLC', 'Set of 2 Iron Duck Garden Stake', 11, 1, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33.07, 13.39, 5.91, NULL, NULL, NULL, 'Metal Duck Pick,                                                                                                                      Not KD                                                                      4*4, Metal Rack', 'Xiamen', 'China', 'Iron', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(105, 'WIN999', 'WIN', '4-Tiered Rock Fountain with LED Lights', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 'N/A', 'N/A', 1, NULL, 'N/A', 1, 'N/A', 'N/A', 1, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(106, 'LJJ414ABB', 'LJJ', 'Solar Watering Can Decor - Asst. Tray Pack of 6', 11, 6, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.25, 15, 9, NULL, NULL, NULL, '1.Metal/Glass watering can solar                     2.Battery:1pc AAA1.2V600mA Ni-CD      3.LED :10pcs with white Led,2lumens   4.Solar panel:Amorphous Silicon.  4.40*4.0cm2V25-30mA                                       5.Switch:   ON/OFF switch                                                                      6.Working time:6-8Hours after full charge       ', 'Xiamen', 'China', 'Iron', 40, 'Glass', 58, 'Solar', 2, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AAA1.2V600mA Ni-CD', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(107, 'SLV344ABB', 'SLV', 'Welcome Puppies in Barrel Decor - Asst. Tray Pack of 6', 4, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.28, 9.76, 8.62, NULL, NULL, NULL, 'Dog in pot', 'Xiamen', 'China', 'Polyresin', 97, 'Stone Poweder', 3, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(108, 'YEN366A', 'YEN', 'Solar Colorful Twine Sphere Stake - Assorted Display of 8', 8, 8, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36.5, 18.75, 9.75, NULL, NULL, NULL, '1.sepa takraw solar light stake                                                                              \n2.Solar panel: 2V 40MA amorphous silicon 4x4cm,foldable solar panel\n3,LED: 1pc warm white led ,2 lumen                                                              \n4,Battery: 1*AA 1.2V/ 300mAh rechargeable NI-CD and battery can be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch       \n7.Topper size:7.87x7.87x7.48 inch                   \ntopper no kd,item kd into 2 parts   ', 'Xiamen', 'China', 'Stainless Steel', 40, 'Plastic', 50, 'Solar', 10, NULL, NULL, NULL, NULL, 100, 1, 'Led', '2 LM', 1, NULL, 'AA 1.2V/ 300mAh ', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(109, 'LJJ1084', 'LJJ', 'Metal Candy Cane Flower Stake with Cool White Solar LED', 10, 5, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26.77, 18.7, 11.22, NULL, NULL, NULL, '1.Solar Metal Xmas candy cane wreath stake w H style stake ,half KD, Top size:10.25x4.5\"x10.25\"\n2.1 *AA NI-CD battery,1.2V 300MAH\nSolar panel.:amorphous silicon  2V 25MAH, size:4*4CM\n3.LED:1 pc cool white  Led.2LM\n4.Switch: ON/OFF switch \n5.Working Hours:6-8 Hours after full charged \n6.Battery is rechargeable and replaceable ', 'Xiamen', 'China', 'Iron', 70, 'Glass', 20, 'Solar', 10, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA NI-CD battery,1.2V 300MAH', 1, 'Battery Operated', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(110, 'QLP1174ABB-S-TM', 'QLP', 'Peppermint Hydrangea Stake with LED Lights - Tree', 6, 6, 20, 'Peppermint Hydrangea Stake with LED Lights - Red Candy', 6, 6, 20, 'Peppermint Hydrangea Stake with LED Lights - Green', 6, 6, 20, 22, 15.5, 13.1, NULL, NULL, NULL, 'Peppermint Hydrangea solar light with try me  on each item\ntopper no KD ,stake KD\npolycrystal si, 2V 40MA,45*45MM\n17pcs warm white led 3.5lm\nNi-CD 300mAh AA 1.2V *1pc rechargable and replaceable battery\non/off Switch\nWorking Time : 6-8Hours with full charged\nTopper size: 5.50*5.50*3.00\'\'', 'Xiamen', 'China', 'Iron', 90, 'Solar', 5, 'Plastic', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3.5 LM', 1, NULL, 'Ni-CD 300mAh AA', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(111, 'QLP1174A-L-TM', 'QLP', 'Peppermint Hydrangea Stake with LED Lights - Tree', 9, 7, 43, 'Peppermint Hydrangea Stake with LED Lights - Red Candy', 9, 7, 43, 'Peppermint Hydrangea Stake with LED Lights - Green', 9, 7, 43, 31.75, 14.5, 12, NULL, NULL, NULL, 'Peppermint Hydrangea solar light with try me  on each item                    \nStake KD, topper no KD\n2. polycrystal si 2V 100MA 45*45MM\n1pc AA 1.2V 300MAH NI-CD rechargable and replaceable battery\n3.on/off Switch\n4. 34pcs warm white LED, 3.5lm \n5.Working Time :6-8Hours after full charge\ntopper size :9.25*6.5*8\'\'', 'Xiamen', 'China', 'Iron', 90, 'Solar', 5, 'Plastic', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3.5 LM', 1, NULL, ' AA 1.2V 300MAH NI-CD ', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(112, 'SLL2160A', 'SLL', 'Christmas Tree Solar Light Stake - Display of 9', 5, 2, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.79, 13.31, 9.84, NULL, NULL, NULL, '1.Christmas tree solar light stake  \n2.Solar panel: 2V 30MA amorphous silicon,40*40mm                                                   \n3,LED:8pcs warm white led,2 lumen                                                          \n4,Battery: 1*AA 1.2V/ 300mAh rechargeable Ni-Cd,and battery can  be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch                      \n7.Topper Size: 5.30*1.57*9.25\'\' inch,topper no kd,stake KD 2,item kd into 2 parts      ', 'Xiamen', 'China', 'Iron', 75, 'Cloth', 20, 'Solar', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA 1.2V/ 300mAh', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(113, 'SLL2162A', 'SLL', 'Solar Christmas Jar Lighting Stake - Reindeer', 3, 4, 36, 'Solar Christmas Jar Lighting Stake - Snowman', 3, 4, 36, 'Solar Christmas Jar Lighting Stake - Tree', 3, 4, 36, 15.5, 12.5, 12.35, NULL, NULL, NULL, '1.Snowman ,reiendeer, treeMason jar solar light stake\n2.Solar panel: 2V 40MA amorphous silicon,40*40mm                                                   \n3,LED:10pcs warm white string light led,2 lumen                                                          \n4,Battery: 1*AA 1.2V/ 300mAh rechargeable Ni-Cd,and battery can  be replaced\n5,Lighting time: Up to 6 - 8hours after full charged                                                                      \n6,Switch: ON/OFF switch                      \n7.Topper Size:3.15x3.54x5.30 inch,topper no kd,stake KD 3 parts,item kd into 3 parts    ', 'Xiamen', 'China', 'Glass', 50, 'Iron', 30, 'Cloth', 10, 'Solar', 10, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, '*AA 1.2V/ 300mAh', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(114, 'QLP1208A', 'QLP', 'Solar Christmas Wreath Stake with LED Lights - Display of 6', 7, 5, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.5, 8.75, 8.5, NULL, NULL, NULL, '1.Solar Christmas stake                                                     2. 1*AAA  NI-CD 300mah rechargable and replaceable battery                                        3.Item KD : topper  NO KD                               4.LED Color :19pcs string with flicking LED :cool white led 3.5LM\n5.Solar Panel Information :Amorphous 2v 40*40mm 30MA                                             6.Working Time : 6-8Hours                                                                       7. On/Off Switch                                              8.topper size:  7.09x1.50x7.09in          ', 'Xiamen', 'China', 'Iron', 70, 'Glass', 25, 'Solar', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3.5 LM', 1, NULL, 'AAA  NI-CD 300mah', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(115, 'QLP1186ABB', 'QLP', 'Solar Barrelled Christmas Stake with LEDs - Reindeer', 7, 4, 33, 'Solar Barrelled Christmas Stake with LEDs - Snowman', 4, 3, 34, 'Solar Barrelled Christmas Stake with LEDs - Tree', 4, 3, 37, 18.5, 16.14, 24.8, NULL, NULL, NULL, '1.Solar Country Christmas Lighted with SS stake\nStake KD, topper KD                                                   \n2.Solar Panel: amorphousi si, 2V 30MA,40*40MM                                           \n3.Battery:1.2V AA 300mAh NI-CD 1pc        Working time:6-8 hours after full charged                   \n4.LED:reindeer 1pc warm white 1.5lm/ snowman 1pc warm white 1.5lm/tree 1pcs warm white 1.5lm\n5. ON/OFF switch.                                              6. Topper size:                                   reindeer:6.69x3.94x8.66in            snowman:3.54x3.54x7.22in             tree:3.75x3.75x7.87in', 'Xiamen', 'China', 'Solar', 5, 'Stainless Steel', 25, 'Iron', 70, NULL, NULL, NULL, NULL, 100, 1, 'LED', '1.5 LM', 1, NULL, '1.2V AA 300mAh NI-CD', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(116, 'RGG340A', 'RGG', 'Solar Holiday Infinity LED Garden Stakes - Asst. Display of 8', 6, 2, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.91, 13.58, 22.64, NULL, NULL, NULL, '1. Solar metal stake light\n2. Snowman with yellow scarf with 21 pcs Cool white LED 3Lumen\n3. Solar Panel information: polycrystalline silicon solar Panel 2V25MA,40*40mm\n4. Battery Type: 1*1.2V AA Ni-CD 600Mah Battery  Rechargeable and replaceable \n5. Working Time: About 6-8 hours if full charged\n6. On/off  Switch\n7. Topper Non KD, Stake KD\nTopper size:snowman with red scarf:6.30*1.77*10.04\'\nOriginal metal display sku# RGG340A', 'Xiamen', 'China', 'Iron', 72, 'Plastic', 15, 'Glass', 5, 'Other', 8, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, '1.2V AA Ni-CD 600Mah', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(117, 'LJJ1080A', 'LJJ', 'Snowman Metal/Glass Christmas Solar Stake', 9, 1, 33, 'Santa Metal/Glass Christmas Solar Stake', 9, 1, 33, 'Penguin Metal/Glass Christmas Solar Stake', 9, 1, 33, 22.05, 9.65, 8.07, NULL, NULL, NULL, '1.3 Asst. Metal/Glass Xmas Solar stake\nHalf KD, Topper size snowman  8.50*1*9.50 ï¼Œsanta8.50*1*10ï¼Œpenguin8*1*9\n2.1 *AA NI-CD BATTERY,1.2V 300MAH\n3.SOLAR PANEL.:amorphous silicon  2V 25MAH, SIZE:4*4CM\n4.LIGHT:1 pc cool white Led.2LM\n5.Working Hours:6-8 Hours after full charged \n6.switch on/off, \n7.Battery is replaceable and rechargeable', 'Xiamen', 'China', 'Iron', 50, 'Glass', 40, 'Solar', 10, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA NI-CD BATTERY,1.2V 300MAH', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(118, 'QLP1196A', 'QLP', 'Solar Stars with Snowman Garden Stake ', 6, 1, 33, 'Solar Stars with Santa Garden Stake ', 6, 1, 33, NULL, 6, 1, NULL, 21.5, 9.5, 8.5, NULL, NULL, NULL, '1.Solar star pattern Christmas stake                                                     2. 1*AAA  NI-CD 300mah rechargable and replaceable battery                                        3.Item  KD : topper  NO KD                               4.LED Color :snowman with 10pcs cool white string with flicking LED 3.5lm ,santa with 11pcs red string light with flicking LED 1.5lm\n5.Solar Panel Information :Amorphous 2v 40*40mm 30MA                                             7.Working Time : 6-8Hours after full charge                                                                              7. On/Off Switch                                           8.topper size:  6.25*0.75*8.25in   ', 'Xiamen', 'China', 'Iron', 70, 'Glass', 25, 'Solar', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'Snowman 3.5, Santa 1.5', 1, NULL, 'AAA  NI-CD 300mah', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(119, 'RGG358A', 'RGG', 'Solar Santa/Snowman Snowflake Stake - Assorted Display of 8', 7, 3, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.7, 13.58, 21.46, NULL, NULL, NULL, '1. Christmas Solar metal stake light\n2. Santa with 1pcs Cool white LED, 3Lumen\n3. Solar Panel information: Ampous solar Panel 2V25MA,40*40mm\n4. Battery Type: 1*1.2V AA Ni-CD 300Mah Battery  Rechargeable and replaceable \n5. Working Time: About 6-8 hours if full charged\n6. On/off  Switch\n7. Topper Non KD, Stake KD,Snowflower KD\nOriginal metal display sku# is RGG358A', 'Xiamen', 'China', 'Plastic', 15, 'Iron', 80, 'Other', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, '1.2V AA Ni-CD 300Ma', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(120, 'SLL2056A', 'SLL', 'Solar Christmas Silver Multi Color Ornament  - Garden Stake', 5, 5, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.5, 16.5, 23, NULL, NULL, NULL, 'Glass solar stake                                                                                           SOLAR PANEL.:4*4cm amorphous crystalline silicon 2V 25MAH\n1*AA NI-CD 1.2V 300MAH battery\n10 warm white string light  2lm,\n top no KD,stake KD \ntop size:12.5*12.5*27.5cm\n on/off switch \n6-8hs after full charged', 'Xiamen', 'China', 'Glass', 40, 'Iron', 30, 'Solar', 30, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA NI-CD 1.2V 300MAH', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(121, 'QLP1017ABB', 'QLP', 'Solar Glass Star with Fiber Optic LED Stake - Tray Pack of 16', 5, 2, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.93, 16.93, 18, NULL, NULL, NULL, 'solar  glass star  w/  fiber stake  light \ntopper   KD ,stake    KD\namorphousi si, 2V 30MA,40*40MM\nwhite star -2pcs white LED 3.5LM ,golden  star-2pcs  white led 3.5LM; red  star -2pcs red LED 1.5LM ,green  star -2pcs rgreen LED 1.7LM ,\nNi-CD 300mAh AA 1.2V *1pc included   \non/off Switch\nWorking Time : 6-8Hours with full charged \nTopper size :4.65*1.57*5.31in ', 'Xiamen', 'China', 'Glass', 70, 'SS', 10, 'Fiber', 10, 'Other', 10, NULL, NULL, 100, 1, 'LED', 'White 3.5LM; s red  1.5LM ,green 1.7LM', 1, NULL, 'Ni-CD 300mAh AA 1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(122, 'QLP1126ABB', 'QLP', 'Solar Christmas Tree with Fiber Color Stake- Tray Pack 16', 2, 2, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.75, 13.39, 18.11, NULL, NULL, NULL, '1. solar christmas trees w color fiber stake light  \n2. LED Color: 2pcs Green 1.7lm / 2pcs Red 1.5lm / 2pcs White  3.5LM\n3. Solar Panel Information: amorphous 40*40MM, 2V 30MA\n4. Battery Type: 1*1.2V AA Rechargeable Ni-CD 300mAh battery, 1pc included \n5. Working Time: 6-8Hours with full charge\n6. On/off Switch\n7. Topper KD, Stake KD\nTopper size:6*6*13cm\nMenards battery info: AA NI-MH 300MAH , need add $0.06 more                                                Fiber color same as topper', 'Xiamen', 'China', 'Plastic', 70, 'Fiber', 10, 'Other', 10, 'Stainless Steel', 10, NULL, NULL, 100, 1, 'LED', ' Green 1.7lm, Red 1.5lm, White  3.5LM', 1, NULL, '1.2V AA Ni-CD 300mAh battery', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(123, 'QLP1103BB', 'QLP', 'Solar Snowman on a Fiber Stake - Tray Pack of 16', 3, 2, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 13.75, 17.65, NULL, NULL, NULL, '1. solar  snowman  w/  fiber stake  light\ntopper KD ,stake KD\n2. amorphousi si, 2V 30MA,40*40MM\n2pc white led 3.5lm\n3. Ni-CD 300mAh AA 1.2V *1pc ,battery can replaceable and rechargeable\n4. on/off Switch\n5. Working Time : 6-8Hours with full charge\n6. topper size:9*6*12.5cm \nMenards battery info: AA NI-MH 300MAH ,need add $0.06 more', 'Xiamen', 'China', 'Plastic', 70, 'Fiber', 10, 'Other', 10, 'Stainless Steel', 10, NULL, NULL, 100, 1, 'LED', '3.5 LM', 1, NULL, 'Ni-CD 300mAh AA 1.2V', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(124, 'SOT882', 'SOT', 'Solar Snowman & Snowflake Stake with LED Lights', 6, 3, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.35, 17, 31.8, NULL, NULL, NULL, '1. Solar garden stakes with snowman and snowflake\n2. Item no KD,topper KD\n3.LED Info:Top 1* white2.8lumen ,middle 1* white 2.8lumen ,bottom 1* blue 0.5 lumen led \n4. Solar Panel Information: polycrystalline solar panel 2v 50ma\n5. Battery Typeï¼š1*AA Rechargeable Ni-CD 400 mAh battery\n6. Working Timeï¼šMin. 8H if fully charged\n7. On/Off Switch                                     8.snowman: 3.15\"x3.15\"x7.00\"     snowflake: 3.15\"', 'Xiamen', 'China', 'Plastic', 20, 'Stainless Steel', 20, 'Acrylic', 55, 'Other', 5, NULL, NULL, 100, 1, 'LED', 'Top white2.8lumen ,middle white 2.8lumen ,bottom  blue 0.5 lumen led ', 1, NULL, 'AA Rechargeable Ni-CD 400 mAh', 1, 'Battery Operated and Solar', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(125, 'COR114T-3', 'COR', 'Candy Cane Pathway Lights - Set of 3', 7, 1, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 8.3, 29.13, NULL, NULL, NULL, '1.Indoor and Outdoor Use 60 cm Garden Candy,\n2.60L LED inclued 30L Cool White LED + 30L Red LED, 4 Lumen            \n3. IP44 transformer: Input: 120V-60Hz Output: 4.5V 0.60A\n4. 3m lead wire\n5. Space: 100cm\n6. Candy diameter18cm,Tube diameter1.7cm,Length30cm,Spike15cm\n7. 8 function: comb / in waves  / sequential / slo-glo / chasing/Flash / slow fade / twinkle/flash /  steady on\nLED not replaceable\nTransformer not replaceable', 'Ningbo', 'China', 'Plastic', 20, 'LED', 40, 'Wire', 40, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '6 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(126, 'COR116T-4', 'COR', 'Seasonal Christmas Star Santa Garden Stake with LED Lights', 7, 2, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.2, 13.4, 23.6, NULL, NULL, NULL, '1. Indoor and Outdoor Use  57cm Santa Lawn light ,\n2.124L Red LED included 96L Red LED + 28L White LED, 4 Lumen\n3. IP44 UL Adaptor Input: 120V-60Hz  Output: 4.5V 0.80A\n4. 3m lead wire .\n5. Space: 50cm\n6. Tube diameter1.7cm,Length30cm, Spike15cm\nLED not replaceable\nTransformer not replaceable', 'Ningbo', 'China', 'Plastic', 20, 'LED', 40, 'Wire', 40, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(127, 'QWR961ABB', 'QWR', 'Christmas Sweets Pot Stickers - Snowman', 1, 0.4, 3, 'Christmas Sweets Pot Stickers - Cane', 2, 0.3, 3, 'Christmas Sweets Pot Stickers - Gingerbread', 2, 0.3, 2, 14.96, 5.71, 5.12, NULL, NULL, NULL, 'Christmas sweets pot picks s/9', 'Xiamen', 'China', 'Polyresin', 95, 'Iron', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(128, 'LAN252L', 'LAN', 'Frosty Christmas Snowflake Tree with Cool White LED Lights', 28, 28, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.81, 5.51, 36.22, NULL, NULL, NULL, '1. CHRISTMAS SNOWFLAKE TREE                          2. 120pcs cool white LED,  200 Lumen                              3. IP44 UL adaptor: input120V-60Hzï¼Œoutput 12v 0.30A\n4. 3M lead wire\n\nLED not replaceable                                         Transformer not replaceable ', 'Ningbo', 'China', 'Iron', 45, 'Plastic', 20, 'LED', 8, 'Accessory', 27, NULL, NULL, 100, 1, 'LED', '200 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(129, 'CRD128GN', 'CRD', 'Silver Taped Bush Lighting Decor with Green LED Lights', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height Green Tape  Burst stake Lights\n2.140pcs Green LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', 15, 'LED', 30, 'Tape', 12, 'Wire', 25, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(130, 'CRD128MC', 'CRD', 'Silver Taped Bush Lighting Decor with Multi-Colored LEDs', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height SiLver Tape  Burst stake Lights\n2.140pcs Multi Color LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', 15, 'LED', 30, 'Tape', 12, 'Wire', 25, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(131, 'CRD128RD', 'CRD', 'Silver Taped Bush Lighting Decor with Red LED Lights', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height Red Tape Burst stake Lights\n2.140pcs Red LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', 15, 'LED', 30, 'Tape', 12, 'Wire', 25, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46');
INSERT INTO `itemspecificationverions` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(132, 'CRD128WW', 'CRD', 'Silver Taped Bush Lighting Decor with Warm White LED Lights', 24, 24, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 5.51, 8.07, NULL, NULL, NULL, '1. 0.9m height SiLver Tape  Burst stake Lights\n2.140pcs Warm White LED ,3 Lumen \n3.UL Transformer IP44 Input: 120V 60HZ, 0.20A, Output: 24V DC,0.15A\n4. 3M lead cord                             \n5. Item  KD\n\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Iron', 15, 'LED', 30, 'Tape', 12, 'Wire', 25, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(133, 'CRD111S-GD', 'CRD', 'Festive Golden Christmas Tree with Warm White LED Lights', 25, 25, 53, 'Stand', NULL, NULL, 61, NULL, NULL, NULL, NULL, 40.94, 16.54, 6.7, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) +with Twinkling\n1. 1.35M Height Gold Branch tree LED Lights\n2. 240pcs Warm white LED include 40pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.20A\n4.3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable\nOriginal SKU# is CRD111S-GD', 'Ningbo', 'China', 'Wire', 25, 'LED', 30, 'Iron', 15, 'Tape', 12, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(134, 'CRD111S-GN', 'CRD', 'Festive Green Christmas Tree with Warm White LED Lights', 25, 25, 53, 'Stand', NULL, NULL, 61, NULL, NULL, NULL, NULL, 43.3, 8.26, 14.17, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) + with Twinkling\n1. 1.35M Height Green Branch tree LED Lights\n2.240pcs Warm white LED include 40pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.20A\n4. 3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable\nOriginal SKU# is CRD111S-GN', 'Ningbo', 'China', 'Wire', 25, 'LED', 30, 'Iron', 15, 'Tape', 12, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(135, 'CRD111S-RD', 'CRD', 'Festive Red Christmas Tree with Warm White LED Lights', 25, 25, 53, 'Stand', NULL, NULL, 61, NULL, NULL, NULL, NULL, 43.3, 8.26, 14.17, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) + with Twinkling\n1. 1.35M Height Red Branch tree LED Lights\n2. 380pcs Warm white LED include 38pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.28A\n4. 3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable', 'Ningbo', 'China', 'Wire', 25, 'LED', 30, 'Iron', 15, 'Tape', 12, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(136, 'CRD111S-SL', 'CRD', 'Festive Silver Christmas Tree with Warm White LED Lights', 25, 25, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40.94, 16.54, 6.7, NULL, NULL, NULL, 'Dural Version ( SQUARE BASE +GROUND STAKE) + with Twinkling\n1. 1.35M Height Silver Branch tree LED Lights\n2. 240pcs Warm white LED include 40pcs flash bulbs, 3 Lumen \n3. UL Transformer IP44 Input: 120V 60HZ 0.30A, Output: 30V 0.20A\n4. 3M lead cord                             \n5. Item KD\nLED not replaceable\nTransformer replaceable\nOriginal SKU# is CRD111S-SL\n', 'Ningbo', 'China', 'Wire', 25, 'LED', 30, 'Iron', 15, 'Tape', 12, 'Transformer', 18, 100, 1, 'LED', '3 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '36 W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(137, 'COR108MC', 'COR', 'Hanging Orb Decor with Multi-Colored Flashing LED Lights', 8, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.5, 17.5, 9.25, NULL, NULL, NULL, '1. Dia 20cm Sphere Ornament with Multi-Color LED Lights with Flashing Version\n2. 200pcs Red Green and Red Blue LED with flashing, 4 Lumen \n3. UL IP44 transformer: Input: 120V~60Hz, 0.20A, Output: 30V-0.12A\n4. 3m lead wire\n                                                           LED not replaceable\nTransformer not replaceable    ', 'Ningbo', 'China', 'GPPS', 30, 'LED', 40, 'Plastic', 30, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '9.84 Ft', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '9.84 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(138, 'COR162MC', 'COR', 'Hanging Cherry Ball with Flashing Multi-Colored LED Lights', 13, 13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26.8, 13.8, 26.8, NULL, NULL, NULL, '1. Dia 30cm Cherry Flower Ball\n2. 500pcs Multi color ( Green + Red + Blue LED ) with falshing, 4 Lumen\n3. UL IP44 transformer: 30V, Input: 120V-60Hz, Output: 30V-0.2A\n4. Lead wire: 5M\n5. Item not KD\n\nLED not replaceable\nTransformer is not replaceable', 'Ningbo', 'China', 'Plastic', 40, 'LED', 40, 'Wire', 20, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '16.40 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '16.40 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(139, 'COR152', 'COR', '3-Tier Hanging Ornaments with Chasing LED Lights - Small', 3, 3, 4, '3-Tier Hanging Ornaments with Chasing LED Lights - Medium', 6, 6, 7, '3-Tier Hanging Ornaments with Chasing LED Lights - Large', 6, 6, 13, 25.2, 19.3, 25.2, NULL, NULL, NULL, '1. Indoor Use Red Dia 30cm + Green Dia 15cm + Silver Dia 8cm ball\n2. Red Ball: 240pcs Warm White LED, 4 Lumen\n    Green Ball: 76pcs Cool White  LED, 4Lumen\n    Silver Ball: 44pcs Red LED, 4 Lumen\n3. UL IP44 transformer: Input: 120V-60Hz, Output: 5V-1.00A\n4. Spacing 20cm, Lead wire: 5M\n5. Item not KD\nLED not replaceable\nTransformer is not replaceable', 'Ningbo', 'China', 'ABS', 40, 'LED', 40, 'Wire', 20, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '16.40 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, '120V', '16.40 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(140, 'COR164', 'COR', '3-Tier Hanging Christmas Ornaments with LED Lights - Small', 4, 4, 4, '3-Tier Hanging Christmas Ornaments with LED Lights - Medium', 6, 6, 6, '3-Tier Hanging Christmas Ornaments with LED Lights - Large', 6, 6, 8, 17, 8.87, 26.8, NULL, NULL, NULL, '1. Dia 20cm + Dia15cm + Dia11cm Cherry Flower Ball\n2. Dia 20cm: 200pcs White+Blue LED, 4Lumen\n  Dia 15cm: 100pcs White+Blue LED, 4 Lumen\n  Dia 11cm: 50pcs White+Blue LED, 4 Lumen\n3. UL IP44 transformer: Input: 120V-60Hz,0.20A Output: 30V-0.2A\n4. Lead wire: 5M\n5. Space: 20CM\n5. Item not KD \n\nLED not replaceable\nTransformer is not replaceable', 'Ningbo', 'China', 'Plastic', 40, 'LED', 40, 'Wire', 20, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 0, NULL, NULL, 1, 'Cord Connected', '16.40 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '24W', '120V', '16.40 Ft', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(141, 'LJJ824A', 'LJJ', 'Christmas Bird Feeding Metal DÃ©cor with Stand - Sock', 6, 3, 10, 'Christmas Bird Feeding Metal DÃ©cor with Stand - Tree', 7, 2, 11, 'Christmas Bird Feeding Metal DÃ©cor with Stand - Bird', 7, 2, 6, 19, 15.75, 11.61, NULL, NULL, NULL, '1. S/3 Metal/glass bird  feeding                                       2.With metal stand IPS109L,KD version                                   metal size:14.96*11.00*33.26 \"\n2 pcs of each color \n\n\nLJJ will make the stand by themselves', 'Xiamen', 'China', 'Iron', 95, 'Glass', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\LJJ\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(142, 'JUM328A', 'JUM', 'Christmas Tree Cut-out Garden Stake - Display of 12', 7, 2, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29.13, 14.56, 8.66, NULL, NULL, NULL, 'Metal tree stake (stake KD in 2 parts)', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(143, 'JUM330HH-RS', 'JUM', 'Brown Christmas Tree Cut-out with Silver Snowman and Star', 11, 2, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.07, 12.2, 13.38, NULL, NULL, NULL, 'Metal deco.', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(144, 'JFH1245A', 'JUM', 'Frosty Santa Stake Decor ', 16, 1, 38, 'Snowman Stake Decor ', 20, 1, 44, NULL, 20, 1, NULL, 41.34, 18.9, 8.27, NULL, NULL, NULL, 'Dural feature Santa and Snowman  stake dÃ©cor with easal\nStake KD, foldable easal', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(145, 'JUM324', 'JUM', 'Metal Deer Decoration', 14, 6, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.38, 5.12, 17.32, NULL, NULL, NULL, 'Metal deer deco.(neck kd)', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(146, 'JUM326', 'JUM', 'Metal Deer Decoration', 21, 4, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.38, 5.12, 17.32, NULL, NULL, NULL, 'Metal deer deco.(neck KD)', 'Xiamen', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(147, 'ORS728', 'ORS', 'Metallic Barrelled Reindeer DÃ©cor with Warm White LED Lights', 18, 11, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20.25, 13.5, 21.75, NULL, NULL, NULL, '1.metal deer ,feet  KD\n2.string lights with 6 pcs warm white LED ,2 lm\n3.Non-waterproof battery box with timer 6 hours on ,18 hours off \n4.2*AA battery (not include)\n5.Switch :on-off ', 'Fuzhou', 'China', 'Iron', 90, 'Light', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, '4.2*AA battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(148, 'ORS730', 'ORS', 'Metallic Barrelled Snowman DÃ©cor with Warm White LED Lights', 13, 16, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.12, 15, 31.87, NULL, NULL, NULL, '1.metal snownman, \n2.string lights with 6 pcs warm white LED ,2 lm\n3.Non-waterproof battery box with timer 6 hours on ,18 hours off \n4.2*AA battery (not include)\n5.Switch :on-off ', 'Fuzhou', 'China', 'Iron', 90, 'Light', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, '4.2*AA battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(149, 'YHL256S', 'YHL', 'Cream White Metal Christmas Sleigh', 23, 12, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.62, 12.6, 13.19, NULL, NULL, NULL, 'SLEIGH\nITEM KD', 'Fuzhou', 'China', 'Iron', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(150, 'LJJ808HH', 'LJJ', 'Christmas Angel \"Joy\" DÃ©cor', 13, 8, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.5, 13.8, 26.5, NULL, NULL, NULL, ' Metal/wood Angel dec', 'Xiamen', 'China', 'Iron', 40, 'Wood', 60, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(151, 'LJJ812HH', 'LJJ', 'Christmas Snowman DÃ©cor', 17, 8, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.75, 7.5, 26.5, NULL, NULL, NULL, ' Metal/wood Snowman dec', 'Xiamen', 'China', 'Iron', 40, 'Wood', 60, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(152, 'MZP366', 'MZP', 'Rustic Metal Angellic Candle Tower with LED Lights', 14, 11, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37.01, 11.42, 14.96, NULL, NULL, NULL, '1.METAL ANGLE WITH 3PCS ELECTRONIC CANDLE, NO KD\n2.3pcs warm white LED, 3.0lm\n3. 3pcs of 2*AA nonwaterproof battery case for candle, with timer, 6 H on, 18H off, batteries are not included \n4. ON/OFF switch', 'Xiamen', 'China', 'Metal', 95, 'Other', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'AA', 1, 'Battery Operated', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(153, 'MZP368', 'MZP', 'Rustic Metal Snowman Candle Tower with LED Lights', 14, 13, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33.86, 14.17, 14.96, NULL, NULL, NULL, '1.METAL SNOWMAN WITH 3PCS ELECTRONIC CANDLE, NO KD\n2.3pcs warm white LED, 3.0lm\n3. 3pcs of 2*AA nonwaterproof battery case for candle, with timer, 6 H on, 18H off, batteries are not included \n4. ON/OFF switch', 'Xiamen', 'China', 'Metal', 95, 'Other', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'AA', 1, 'Battery Operated', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/15', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(154, 'WXY144ABB', 'WXY', 'Wooden Stars with Holiday Silhouette Scene - Tray Pack of 12', 10, 2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.26, 17.04, 10.63, NULL, NULL, NULL, 'Indoor Wooden star with led\n1. 8pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is not waterproof, price is not including the battery, timer 6 hours ON, 18 Hours OFF \n3. On/Off Switch ', 'Ningbo', 'China', 'Plywood', 90, 'Plastic', 5, 'LED and Battery', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(155, 'WXY148ABB', 'WXY', 'Indoor Wooden Christmas Tree Decor with LED - Tray Pack of 12', 7, 2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.35, 11.02, 9.45, NULL, NULL, NULL, 'Indoor Wooden tree with led\n1. 5pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is  not waterproof , price is not including the battery, timer 6 hours ON, 18 Hours OFF \n3. On/Off Switch ', 'Ningbo', 'China', 'Plywood', 90, 'Plastic', 5, 'LED and Battery', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(156, 'WXY152ABB', 'WXY', 'Wooden Santa & Snowman Decor - Tray Pack of 12', 6, 1, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.35, 7.88, 13.39, NULL, NULL, NULL, 'Indoor Wooden decoration with led\n1. 5pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is not waterproof , price is not including the battery, timer 6 hours ON, 18 Hours OFF\n3. On/Off Switch', 'Ningbo', 'China', 'Plywood', 90, 'Plastic', 5, 'LED and Battery', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(157, 'WXY154ABB', 'WXY', 'Indoor Wooden Santa Claus Decor with LEDs - Santa', 6, 1, 11, 'Indoor Wooden Santa Claus Decor with LEDs - Snowman', 6, 1, 12, NULL, 6, 1, NULL, 12.99, 8.55, 9.45, NULL, NULL, NULL, 'Indoor Wooden decoration with led\n1. 5pcs Warm White LED, 2 Lumen\n2. 2*AAA Battery, battery box is waterproof  price is not including the battery, timer 6 hours ON, 18 Hours OFF \n3. On/Off Switch ', 'Ningbo', 'China', 'Plywood', 90, 'Plastic', 5, 'LED and Battery', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AAA', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(158, 'WXY104HH', 'WXY', 'Christmas Rocking Horse w/Santa Tabletop Decor', 10, 2, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.5, 11.5, 11, NULL, NULL, NULL, 'SANTA & HORSE CHRISTMAS DECORATION\nITEM NOT KD', 'Ningbo', 'China', 'MDF', 98, 'Metal Bell', 2, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(159, 'WXY122BB-S', 'WXY', 'Christmas Santa and Reindeer Sitting Down', 6, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.2, 8.26, 6.69, NULL, NULL, NULL, 'SANTA & DEER CHRISTMAS DECORATION\nITEM NOT KD', 'Ningbo', 'China', 'MDF', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(160, 'WXY142', 'WXY', 'Indoor Wooden Carved Sleigh DÃ©cor', 9, 4, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.63, 10.2, 7.68, NULL, NULL, NULL, 'Indoor Wooden sleigh', 'Ningbo', 'China', 'Plywood', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(161, 'WXY166BB', 'WXY', ' Wooden Deer Family w/ bell & Pink Tree-Tray Pack of 12', 6, 2, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.6, 11.55, 8.27, NULL, NULL, NULL, 'Indoor Wooden decoration', 'Ningbo', 'China', 'Plywood', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(162, 'WXY168BB', 'WXY', 'Wooden Moose Decor with Bell & Pink Tree - Tray Pack of 12', 6, 2, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.55, 14.55, 12.99, NULL, NULL, NULL, 'Indoor Wooden decoration', 'Ningbo', 'China', 'Plywood', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(163, 'WHS102WW', 'WHS', 'Christmas Village Turning Train, Skaters and Music', 13, 13, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.14, 16.14, 22.44, NULL, NULL, NULL, 'LED Village w Turning Train, Tree and Skaters & Music                                      1.Copper lamp (71pcs warm white); LED (4pcs warm white) ,2 LM                                     \n2. UL DC 4.5V,0.9 W Adaptor,adaptor box is not waterproof,price is including the adaptor, battery operated as well  indoor use only\n3. ON 1/OFF/ON 2 Switch, \nON1 (moving+light+music)  \nON2 (moving+light)  \nSong list:\n1 Jingle Bell\n2 We wish you a Merry Christmas\n3 Silent Night\n4 Deck the Halls\n5 Joy to the world\n6 The first Noel        \n7 Hark! The Heard Angel sing                \n8 Oh, Christmas Tree', 'Xiamen', 'China', 'Polyresin', 75, 'Plastic', 5, 'LED and Batter', 5, 'Paint', 13, 'Metal', 2, 100, 1, 'LED', '2 LM', 1, NULL, NULL, 1, 'Battery and Cord Connected', NULL, 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(164, 'WCC142MC', 'WCC', 'Jolly  Christmas Town with fountain scene and LED Lights', 11, 8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.49, 12.99, 20.08, NULL, NULL, NULL, 'Led Lighted Xmas Houses with fountain Scene\n1.17pcs LED light, 3 Lumen\n2. color changing: 1pc, RD:3pcs\nBL:2pcs, YL:9pcs, GN:2pc, \n3.3*AA Battery,battery box is not waterproof,price is not including the battery.\n4.6 hours ON,18 hours OFF Timer.\n5.On/Off Switch.\n6. pump non-replaceable, pump no UL approval as it is battery operated ,reminder Jodie already ', 'Xiamen', 'China', 'Polyresin', 95, 'Plastic', 3, 'LED', 2, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(165, 'WHS114MC', 'WHS', 'Christmas Tree Shop with LED Lights and Rotating Tree', 9, 9, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.18, 14.76, 22.17, NULL, NULL, NULL, 'Christmas LED shop w Turning tree \n1.LED: 7red 7blue 9 Yellow 7green 8 warm white                                  \n2. 3*AA Battery ,battery box is not waterproof,price is not including the battery, 6 hours ON,18 hours OFF        \n3. ON/OFF Switch        ', 'Xiamen', 'China', 'Plastic', 50, 'Polyresin', 40, 'LED', 3, 'Paint', 5, 'Iron', 2, 100, 1, 'LED', '2 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(166, 'WCC114ABB-TM', 'WCC', 'Miniature Christmas House with LED lights- White house', 3, 2, 3, 'Miniature Christmas House with LED lights- Snowman', 3, 2, 5, 'Miniature Christmas House with LED lights-Santa', 3, 2, 5, 17.32, 9.84, 12.99, NULL, NULL, NULL, 'Resin Xmas House/Scene with Led light.\n\n1.3pcs LED light, 3 Lumen\n\n2.left 1st, 2nd, 3rd: 1pc of RD/GN/BL\n, right: 2pcs BL, 1pc WT\n3.2*AAA Battery,battery box is not waterproof,price is not including the battery.\n\n4.6 hours ON,18 hours OFF Timer.\n\n5.On/Off Switch.\n\n6.With Try me', 'Xiamen', 'China', 'Polyresin', 95, 'Plastic', 3, 'Electronic', 2, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'AAA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 3/06', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(167, 'WHS110MC-TM', 'WHS', 'Christmas LED Village with Turning Skaters', 7, 4, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.91, 9.65, 17.05, NULL, NULL, NULL, 'Christmas LED Village w Turning Skaters 1.1red 1blue 1green 4warm white LED lamp, 3 LM                                   \n2. 3*AA Battery ,battery box is not waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n3. ON/OFF Switch                             4.With TRY ME', 'Xiamen', 'China', 'Polyresin', 87, 'Plastic', 3, 'LED, Fiber Optic and Batt', 3, 'Paint', 5, 'Metal', 2, 100, 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(168, 'WQA760L-WT', 'WQA', '18\" White Ceramic Church Decor - (Plug In)', 10, 9, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11.25, 10.5, 19.75, NULL, NULL, NULL, 'white glazed ceramic churches plug        1. C7 TUNGSTEN BULB, YELLOW COLOR\n3. CUL PLUG,120V, 15W\n4. ITEM NOT KD\n5. ON/OFF SWITCH   ', 'Xiamen', 'China', 'Ceramic', 95, 'Light', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '20 LM', 0, NULL, NULL, 1, 'Cord Connected', '4.43 Ft', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(169, 'BEH200HH', 'BEH', '27\" Snowman Statue with Warm White LED Lights', 7, 6, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.2, 8.9, 30.2, NULL, NULL, NULL, 'MGO.snowman with LED \n1. 4pcs LED light, 4 Lumen   \n2. Color: warm white\n2*AA Battery ,battery box is waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch  ', 'Xiamen', 'China', 'MGO', 97, 'LED', 3, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(170, 'BEH204HH', 'BEH', '27\" Moose Statue with Warm White LED Lights', 7, 6, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.9, 10.1, 30.6, NULL, NULL, NULL, 'MGO.deer with LED \n1. 4pcs LED light, 4 Lumen     \n2. Color: warm white\n2*AA Battery ,battery box is waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch  ', 'Xiamen', 'China', 'MGO', 97, 'LED', 3, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(171, 'BEH206HH', 'BEH', '23\" Angel Statue with Warm White LED Lights', 7, 5, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.4, 9.7, 26.3, NULL, NULL, NULL, 'MGO.angel with LED \n1. 4pcs LED light, 4 Lumen                                        \n2. Color: warm white\n2*AA Battery ,battery box is waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch  ', 'Xiamen', 'China', 'MGO', 97, 'LED', 3, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '4 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(172, 'WTJ217', 'WTJ', 'Festive Christmas Snowman Candle Holder', 7, 6, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.34, 9.65, 18.5, NULL, NULL, NULL, 'Snowman Statuary for T-Light\ncan fit 3.8*3.8*1CM candle\nprice not including candle', 'Xiamen', 'China', 'Magnesia', 90, 'Fabric', 10, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/18', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(173, 'WTJ220', 'WTJ', 'Christmas Country Snowman with LED Lights', 7, 6, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 9.25, 21.26, NULL, NULL, NULL, 'Snowman with LED                                     1. 4pcs LED light,6 Lumen                                    2. color warm white\n3. 2*AAA Battery with timer 6 hours ON,18 hours OFF, waterproof battery box, price is not including battery\n4.On/Off Switch           ', 'Xiamen', 'China', 'Magnesia', 85, 'Fabric', 5, 'LED', 5, 'Plastic', 5, NULL, NULL, 100, 1, 'LED', '6 LM', 1, NULL, 'AAA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(174, 'WTJ222', 'WTJ', 'Christmas Country Santa with LED Lights', 7, 6, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.55, 9.25, 16.54, NULL, NULL, NULL, 'Santa with LED                                       1. 6pcs LED light ,6 Lumen                                   2. color warm white\n3. 3*AAA Battery with timer 6 hours ON,18 hours OFF, waterproof battery box price is not including battery\n4.On/Off Switch           ', 'Xiamen', 'China', 'Magnesia', 90, 'Fabric', 5, 'LED', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', '6 LM', 1, NULL, 'AAA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(175, 'WTJ226', 'WTJ', 'Christmas Country Santa with Tea Light Candle Holder', 7, 6, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.91, 10.04, 26.38, NULL, NULL, NULL, 'Santa With Lantern', 'Xiamen', 'China', 'Magnesia', 90, 'Metal', 5, 'Fabric', 5, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(176, 'QWR898', 'QWR', 'Winter Bird with \"Merry Christmas\" Statue', 11, 9, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 11, 18.3, NULL, NULL, NULL, 'bird on ball statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(177, 'QWR900', 'QWR', 'Winter Owl Family Statue', 11, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 9.8, 16.1, NULL, NULL, NULL, 'owls statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(178, 'QWR902', 'QWR', 'Winter Penguin Family Statue', 13, 8, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.4, 10.2, 16.1, NULL, NULL, NULL, 'penguins statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(179, 'QWR904', 'QWR', 'Winter Hedgehogs Family Statue', 14, 11, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16.1, 13, 17.3, NULL, NULL, NULL, 'Hedgehogs statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(180, 'QWR908', 'QWR', 'Winter Snowman Family Statue', 13, 7, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15.4, 9.4, 16.9, NULL, NULL, NULL, 'snowmen statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(181, 'QWR910', 'QWR', 'Snowman and Penguin Statuary', 11, 10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.8, 10.8, 19.3, NULL, NULL, NULL, 'snowman and penguin statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(182, 'QWR778', 'QWR', 'Christmas Dove Statue With Hat', 15, 9, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17.75, 11, 17.25, NULL, NULL, NULL, 'bird statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(183, 'QWR780', 'QWR', 'Christmas Dove Statue with hat and Book', 13, 7, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.75, 11, 13.3, NULL, NULL, NULL, 'bird statuary', 'Xiamen', 'China', 'Magnesia', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(184, 'QWR916', 'QWR', 'Retro Red Car with Christmas Tree and LED Lights', 22, 11, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24.4, 13.4, 19.3, NULL, NULL, NULL, 'Vehicle with LED and sound\n1. 7pc LED,  warm white light                                \n2.  3*AA Batteries,battery box is not waterproof,price is not including the battery\n3.6 hours ON,18 hours OFF\n4. On/Off Switch  \nSong list: \nJingle Bells\nWe Wish You A Merry Christmas\nSilent Night\nDeck the Halls\nJoy to the World\nThe First Noel\nHark the Herald Angels Sing\nOh Christmas Tree', 'Xiamen', 'China', 'Magnesia', 89, 'LED', 5, 'Plastic', 6, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2-3 LM', 1, NULL, 'AA Batteries', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(185, 'USA1526ABB', 'USA', 'Pinecone Snowmen Decor - Tray Pack of 4', 6, 4, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.99, 9.84, 11.02, NULL, NULL, NULL, '1. Snowman\n2. NOT KD', 'Xiamen', 'China', 'Polyresin', 56, 'Stone Powder', 44, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(186, 'WQA727A', 'WQA', 'Tree-Dressed Snowmen with LED Lights - Joel', 7, 4, 12, 'Tree-Dressed Snowmen with LED Lights - Joy', 6, 4, 12, NULL, 6, 4, NULL, 16.77, 12.44, 14.06, NULL, NULL, NULL, 'Snowmen table top w/led light 2 asst\n1. 8pcs LED string light, 3LM                                         \n2. color: warm white\n3. 3*LR44 BATTERY,battery box is not waterproof,price is including the battery, no timer\n4. On/Off Switch   ', 'Xiamen', 'China', 'Resin', 95, 'LED Light', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'LR44 BATTERY', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(187, 'QWR952', 'QWR', 'Blissful Tree Grabbing Snowman with Warm White LED Lights', 15, 11, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14.96, 11.42, 26.57, NULL, NULL, NULL, 'SNOWMAN\n1. 4pcs LED, 3 LM\n2.warm white light                                                           3.3*AA Battery with timer 6 hours ON,18 hours OFF,battery box is waterproof,price is not including the battery\n4.On/Off Switch ', 'Xiamen', 'China', 'Magnesia', 83, 'LED', 6, 'Plastic', 8, 'Solar Panel', 3, NULL, NULL, 100, 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(188, 'QWR956', 'QWR', 'Christmas Wreath Reindeer DÃ©cor with Warm White LED Lights', 16, 10, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22.83, 10.63, 26.77, NULL, NULL, NULL, 'DEER\n1. 5pcs LED, 3 LM\n2. warm white light                                                           3.3*AA Battery with timer 6 hours ON,18 hours OFF,battery box is waterproof,price is not including the battery \n4.On/Off Switch ', 'Xiamen', 'China', 'Magnesia', 84, 'LED', 6, 'Plastic', 6, 'Solar Panel', 3, 'Felt', 1, 100, 1, 'LED', '3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(189, 'ZTY104CC', 'ZTY', 'Red Christmas Ball Ornament with Color Changing LED Lights', 21, 16, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.65, 18.7, 36.42, NULL, NULL, NULL, '1. X\'mas ball  with LED  light\n2.8PCS color change LED light\n3.Battery box waterproof with 2*AA battery with timer (6hours on, 18 hours off ) ,\n4.the price is not including battery .\n5,on and off button switch', 'Xiamen', 'China', 'MGO', 94, 'Iron', 1, 'LED', 5, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 1, NULL, 'AA battery', 1, 'Battery Operated and Solar', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(190, 'KGD240ABB', 'KGD', 'Heavenly Christmas Angel Bell Ornaments - Tray Pack of 16', 3, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.3, 9.14, 6.5, NULL, NULL, NULL, '4 Asst Little Bless Angel                                  with hanging string and a bell inside ', 'Xiamen', 'China', 'Polyresin', 97, 'Iron', 2, 'String', 1, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(191, 'LAZ156A', 'LAZ', 'Seasonal Harvest Scarecrow Pumpkin DÃ©cor Kit - Hat/Hair', 10, 0.2, 8, 'Seasonal Harvest Scarecrow Pumpkin DÃ©cor Kit - Eyes', 1, 0.2, 1, 'Seasonal Harvest Scarecrow Pumpkin DÃ©cor Kit - Nose', 1, 0.2, 2, 11.42, 8.86, 9.05, NULL, NULL, NULL, 'SCARECROW PUMPKIN DECOR KIT', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(192, 'QWR938', 'QWR', 'Halloween Scarecrow Pumpkin Holder w/ Warm White LED Lights', 13, 9, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12.99, 9.84, 22.05, NULL, NULL, NULL, 'PUMPKING HALLOWEEN CHARACTER HOLDERS WITH LIGHTS                         1.3pcs LED light                                            2.warm white light                                                           3.3*AA Battery with timer 6 hours ON,18 hours OFF,battery box is waterproof,price is not including the battery \n4.On/Off Switch \n5.Outdoor use', 'Xiamen', 'China', 'Magnesia', 90, 'LED', 6, 'Plastic', 4, NULL, NULL, NULL, NULL, 100, 1, 'LED', '2-3 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(193, 'WQA1274CC', 'WQA', 'Skull and Pumpkin Halloween Decor with LED Light', 9, 7, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21.65, 11.61, 22.42, NULL, NULL, NULL, 'Skull w/pumpkin with led light                     1.1pc LED light                                     \n2. color changing led light\n3. 2* LR44 Battery ,battery box is not waterproof,price is not including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch        ', 'Xiamen', 'China', 'Polyresin', 95, 'LED', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 1, NULL, 'LR44 Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(194, 'WQA1278ABB-CC-TM', 'WQA', 'Halloween Skull Head with LED Light - Pirate Skull', 6, 7, 6, 'Halloween Skull Head with LED Light -  Skull', 6, 7, 6, NULL, 6, 7, NULL, 17.32, 14.8, 8.46, NULL, NULL, NULL, 'Halloween skull head w/led light \n1.1pc LED light(left one), 2pcs LED light(right one)                           \n2. color changing led light\n3. 2*LR44 Battery ,battery box is not waterproof,price is including the battery, 6 hours ON,18 hours OFF\n4. On/Off Switch, 1traypack with 1pc try me     ', 'Xiamen', 'China', 'Polyresin', 95, 'LED', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'N/A', 1, NULL, 'LR44 Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(195, 'YEN392', 'YEN', 'Solar Wooden Die Cut Reindeer Statue with LED Lights', 20, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.62, 6.3, 19.49, NULL, NULL, NULL, '1.Wood diecut reindeer solar light \n2.Waterproof battery box , which fit 2*AA ,price without battery                                                 \n3,LED:20pcs warm  white led,2 lumen                                                          \n4,Timer:6 hours on and 18 hours off                                                                   \n6,Switch: ON/OFF switch                      \n7.antler kd,feet kd    ', 'Xiamen', 'China', 'Fir Wood', 75, 'Iron', 15, 'Plastic', 5, 'Cloth', 5, NULL, NULL, 100, 1, 'LED', '2 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(196, 'HEH176ABB', 'HEH', 'Boy with Snowball Statues ', 4, 3, 7, 'Girl with Snowball Statues ', 4, 3, 7, NULL, 4, 3, NULL, 11.1, 10.85, 20, NULL, NULL, NULL, 'standing boy&girl holding snowball 2 asst.\nNot KD\n2*3 ', 'Xiamen', 'China', 'Pottery', 80, 'Wooden', 20, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(197, 'LJJ246A', 'LJJ', '36\" Metal Turkey Garden Stakes - Fall ', 10, 1, 36, '36\" Metal Turkey Garden Stakes - Harvest', 11, 1, 36, NULL, 11, 1, NULL, 32.28, 10.83, 4.65, NULL, NULL, NULL, '1/.S/2 Metal/Glass Turkey Garden Stake,\n2.Topper KD,stake not KD,4x2', 'Xiamen', 'China', 'Iron', 80, 'Glass', 20, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(198, 'WQS100A', 'WQS', 'Snowman LED Stakes- Battery Operated', 11, 1, 42, ' Santa Stop Sign LED Stakes- Battery Operated', 10, 1, 42, NULL, 10, 1, NULL, 21.85, 14.37, 42.91, NULL, NULL, NULL, '12pcs led light(snowman with happy holiday)/12pcs led light(sexangle) \nwith 24\'\'snow measurement\n1,12pcs LED warm white 3LM\n2,2*AA battery with timer 6hours on,18hours off,battery box is waterproof,price is not including the battery\n3,on/off switch', 'Ningbo', 'China', 'Plywood', 20, 'MDF', 60, 'LED', 10, 'Plastic', 5, 'PVC', 5, 100, 1, 'LED', '2 LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46');
INSERT INTO `itemspecificationverions` (`seq`, `itemno`, `oms`, `item1description`, `item1length`, `item1width`, `item1height`, `item2description`, `item2length`, `item2width`, `item2height`, `item3description`, `item3length`, `item3width`, `item3height`, `mastercarton1length`, `mastercarton1width`, `mastercarton1height`, `mastercarton2length`, `mastercarton2width`, `mastercarton2height`, `msdescription`, `port`, `countryoforigin`, `material1`, `material1percent`, `material2`, `material2percent`, `material3`, `material3percent`, `material4`, `material4percent`, `material5`, `material5percent`, `materialtotalpercent`, `haslight`, `lighttype`, `totallumens`, `hasbattery`, `batteryquantity`, `batterytype`, `haselectricity`, `electricitytype`, `cordlengthfeet`, `hasassembly`, `manualpath`, `part1`, `part2`, `part3`, `part4`, `part5`, `cordlengthmeter`, `pumpwattage`, `pumpvolts`, `pumpcordlength`, `transformerwattage`, `transformervolts`, `transformercordlength`, `watercapacity`, `feature1`, `feature2`, `feature3`, `feature4`, `feature5`, `feature6`, `feature7`, `updatedby`, `troy`, `userseq`, `createdon`, `lastmodifiedon`) VALUES
(199, 'SLL1248ABB', 'SLL', 'Christmas Joy Decor with LED Light  ', 8, 4, 7, 'Christmas Snow Decor with LED Light  ', 12, 3, 6, NULL, 12, 3, NULL, 22.44, 14.37, 8.74, NULL, NULL, NULL, 'JOY Led decoration/the batter box can fix 1*AA battery/one red led   with timer 6hs on 18hs off /price and shippment whithout battery. snow led decoration/the batter box can fix 1*AA battery/one blue led     with timer 6hs on 18hs off /price and shippment whithout battery.', 'Xiamen', 'China', 'Polyresin', 40, 'Glass', 30, 'Electron', 30, NULL, NULL, NULL, NULL, 100, 1, 'LED', '1LM', 1, NULL, 'AA Battery', 1, 'Battery Operated', 'N/A', 1, NULL, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(200, 'IFF198MC', 'IFF', 'Multi-Color Garden Metal Stake Windmill Spinner - last row', 23, 6, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 3, 25, NULL, NULL, NULL, 'Blue-Red-Yellow-white with peel off finish Disk Spinner (KD)       - 16pcs spinners as this item is coming with 4 colors , 1color 4 spinners\nTopper non-KD ,Stake KD into 4 parts     ', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 1, 'Z:\\Assembly & Instruction Manuals\\IFF\\PDF', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/20', 1, '2019-03-26 16:52:46', '2019-03-26 16:52:46'),
(201, '123456', 'TRPKL', 'test item des 1', 23.5, 2, 3, 'test item des 2', 1, 3.2, 10, 'test item des 3', 1, 3.2, 30, 70, 20, 22, 23, 24, 23, 'test ms dees', NULL, NULL, 'mm 1', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'LED', '1800', 1, NULL, 'test bb', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'feature 1 test', NULL, NULL, NULL, NULL, NULL, NULL, 'baljeet', 'test troy', 1, '2019-03-26 16:52:47', '2019-03-26 16:52:47'),
(202, 'KPP500', 'KPP', 'Wind Spinner Display Stand test', 31, 20, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32.68, 12.8, 20.87, NULL, NULL, NULL, 'Wind Spinner Display Stand', 'Xiamen', 'China', 'Metal', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:21'),
(203, 'LJJ218', 'LJJ', 'Rain Gauge Replacement', 2, 2, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18.25, 12.25, 14.25, NULL, NULL, NULL, '1.Big Size Glass Rain Gauge in Blister;\n2.Not K/D', 'Xiamen', 'China', 'Glass', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, NULL, 'N/A', 0, NULL, NULL, 0, 'N/A', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/13', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:21'),
(204, 'QLP487ABB-DSP', 'QLP', '3D Flower FIBER OPTIC LED LIGHT Garden Stake with Wall Plug - test', 6, 6, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19.88, 6.88, 16.33, NULL, NULL, NULL, 'Flower w/fiber solar fiber stake light non-moving\npolycrystal si, 2V  40ma;no work.\n2pcs LED- red1.5lm,green 1.7lm,blue 0.4lm.\nNo Battery\nTopper  KD,Pole KD                             \n', 'Xiamen', 'China', 'Plastic', 95, 'Solar', 5, NULL, NULL, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'red 1.5, green 1.7, blue 0.4', 0, NULL, NULL, 0, ' Cord Connected ', 'N/A', 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:21'),
(205, 'QLP210-DSP', 'QLP', 'Hummingbird FIBER OPTIC LED LIGHT Garden Stake Wall Plug - test', 5, 4, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23.25, 17.75, 20, NULL, NULL, NULL, 'SOLAR FIBER  Non-Motion STAKE W/HUMMINGBIRD; LED:2PCS, 4COLOR ASST-4 WHITE 3.5lm/4 GREEN1.7lm/4 RED1.5lm/4 BLUE0.4lm; changed to be plug working            ', 'Xiamen', 'China', 'Plastic', 85, 'Fiber', 5, 'Stainless steel', 10, NULL, NULL, NULL, NULL, 100, 1, 'LED', 'WHITE 3.5lm/4 GREEN1.7lm/4 RED1.5lm/4 BLUE0.4lm', 0, NULL, NULL, 1, ' Cord Connected ', NULL, 0, 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Troy 2/27', 1, '2019-03-26 17:07:21', '2019-03-26 17:07:21'),
(206, 'KPP500', NULL, 'Wind Spinner Display Stand ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-03-26 17:07:51', '2019-03-26 17:07:51'),
(207, 'LJJ218', NULL, 'Rain Gauge Replacement - test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-03-26 17:07:51', '2019-03-26 17:07:51'),
(208, 'QLP1174ABB-S-TM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Peppermint Hydrangea solar light with try me  on each itemtopper no KD ,stake KDpolycrystal si, 2V 40MA,45*45MM17pcs warm white led 3.5lmNi-CD 300mAh AA 1.2V *1pc rechargable and replaceable batteryon/off SwitchWorking Time : 6-8Hours with full chargedTopper size: 5.50*5.50*3.00\'\'', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1800', NULL, 6, 'test bb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test troy', 1, '2019-03-26 17:08:11', '2019-03-26 17:08:11'),
(209, 'QLP1174ABB-S-TM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-03-26 17:13:37', '2019-03-26 17:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `qcschedules`
--

CREATE TABLE `qcschedules` (
  `seq` bigint(20) NOT NULL,
  `qc` varchar(50) DEFAULT NULL,
  `po` varchar(50) DEFAULT NULL,
  `potype` varchar(50) DEFAULT NULL,
  `itemnumbers` varchar(200) NOT NULL,
  `shipdate` date DEFAULT NULL,
  `screadydate` date DEFAULT NULL,
  `scfinalinspectiondate` date DEFAULT NULL,
  `scmiddleinspectiondate` date DEFAULT NULL,
  `scfirstinspectiondate` date DEFAULT NULL,
  `scproductionstartdate` date DEFAULT NULL,
  `scgraphicsreceivedate` date DEFAULT NULL,
  `acreadydate` date DEFAULT NULL,
  `acfinalinspectiondate` date DEFAULT NULL,
  `acmiddleinspectiondate` date DEFAULT NULL,
  `acfirstinspectiondate` date DEFAULT NULL,
  `acproductionstartdate` date DEFAULT NULL,
  `acgraphicsreceivedate` date DEFAULT NULL,
  `apreadydate` date DEFAULT NULL,
  `apfinalinspectiondate` date DEFAULT NULL,
  `apmiddleinspectiondate` date DEFAULT NULL,
  `apfirstinspectiondate` date DEFAULT NULL,
  `approductionstartdate` date DEFAULT NULL,
  `apgraphicsreceivedate` date DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `userseq` bigint(20) DEFAULT NULL,
  `createdon` date DEFAULT NULL,
  `lastmodifiedon` datetime DEFAULT NULL,
  `apmiddleinspectiondatenareason` varchar(20) DEFAULT NULL,
  `apfirstinspectiondatenareason` varchar(20) DEFAULT NULL,
  `qcuser` bigint(20) DEFAULT NULL,
  `classcodeseq` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qcschedules`
--

INSERT INTO `qcschedules` (`seq`, `qc`, `po`, `potype`, `itemnumbers`, `shipdate`, `screadydate`, `scfinalinspectiondate`, `scmiddleinspectiondate`, `scfirstinspectiondate`, `scproductionstartdate`, `scgraphicsreceivedate`, `acreadydate`, `acfinalinspectiondate`, `acmiddleinspectiondate`, `acfirstinspectiondate`, `acproductionstartdate`, `acgraphicsreceivedate`, `apreadydate`, `apfinalinspectiondate`, `apmiddleinspectiondate`, `apfirstinspectiondate`, `approductionstartdate`, `apgraphicsreceivedate`, `notes`, `status`, `userseq`, `createdon`, `lastmodifiedon`, `apmiddleinspectiondatenareason`, `apfirstinspectiondatenareason`, `qcuser`, `classcodeseq`) VALUES
(5140, 'RICHARD', '27054-B7', 'Open PO', 'SOT784L', '2019-06-01', '2019-05-18', '2019-05-22', '2019-05-17', '2019-04-27', '2019-04-17', '2019-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 1),
(5141, 'RICHARD', '27054-B7', 'Open PO', 'SOT786L', '2019-06-01', '2019-05-18', '2019-05-22', '2019-05-17', '2019-04-27', '2019-04-17', '2019-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 1),
(5142, 'RICHARD', '27057-B7', 'Open PO', 'SOT784L', '2019-06-03', '2019-05-20', '2019-05-24', '2019-05-19', '2019-04-29', '2019-04-19', '2019-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 1),
(5143, 'RICHARD', '27057-B7', 'Open PO', 'SOT786L', '2019-06-03', '2019-05-20', '2019-05-24', '2019-05-19', '2019-04-29', '2019-04-19', '2019-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 1),
(5144, 'JOY', '27073', 'Open PO', 'BVK110', '2019-05-19', '2019-05-05', '2019-05-09', '2019-05-04', '2019-04-14', '2019-04-04', '2019-04-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:44:21', NULL, NULL, 22, 2),
(5145, 'JOY', '27073', 'Open PO', 'MOD104', '2019-05-19', '2019-05-05', '2019-05-09', '2019-05-04', '2019-04-14', '2019-04-04', '2019-04-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:44:21', NULL, NULL, 22, 2),
(5146, 'JOY', '27073', 'Open PO', 'MOD106', '2019-05-19', '2019-05-05', '2019-05-09', '2019-05-04', '2019-04-14', '2019-04-04', '2019-04-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:44:01', NULL, NULL, 22, 2),
(5147, 'RICHARD', '27297', 'Open PO', 'EUT166BB-WW-TM', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 3),
(5148, 'TERRY', '27200', 'Open PO', 'QLP1208A', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5149, 'TERRY', '27200', 'Open PO', 'SLC131BB-9', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5150, 'TERRY', '27138', 'Open PO', 'QLP1103BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-06-15', '2019-06-15', NULL, NULL, '2019-04-18', '2019-05-22', '2019-06-09', '2019-06-13', NULL, NULL, '2019-05-09', '2019-05-24', NULL, 'ACCEPTED', 23, '2019-06-15', '2019-06-24 03:53:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5151, 'TERRY', '27138', 'Open PO', 'QLP1196A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5152, 'RICHARD', '27038-B', 'Open PO', 'TLR102TUR', '2019-05-24', '2019-05-10', '2019-05-14', '2019-05-09', '2019-04-19', '2019-04-09', '2019-04-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 5),
(5153, 'NIKO', '27130', 'Open PO', 'LAN252L', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:45:23', NULL, NULL, 20, 6),
(5154, 'NIKO', '27130', 'Open PO', 'LAN151ABB', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:45:23', NULL, NULL, 20, 6),
(5155, 'JONES', '27310', 'Open PO', 'WIN258', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 23, '2019-06-15', '2019-07-03 08:08:49', NULL, NULL, 21, 7),
(5156, 'JOY', '27054-B2', 'Open PO', 'NCY213', '2019-06-01', '2019-05-18', '2019-05-22', '2019-05-17', '2019-04-27', '2019-04-17', '2019-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:40:59', NULL, NULL, 22, 8),
(5157, 'JOY', '27057-B2', 'Open PO', 'NCY213', '2019-06-03', '2019-05-20', '2019-05-24', '2019-05-19', '2019-04-29', '2019-04-19', '2019-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:41:20', NULL, NULL, 22, 8),
(5158, 'NIKO', '27263', 'Open PO', 'QWR898', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5159, 'NIKO', '27263', 'Open PO', 'QWR900', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5160, 'NIKO', '27263', 'Open PO', 'QWR902', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5161, 'NIKO', '27263', 'Open PO', 'QWR904', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2016-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5162, 'NIKO', '27263', 'Open PO', 'QWR908', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5163, 'NIKO', '27263', 'Open PO', 'QWR910', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5164, 'NIKO', '27263', 'Open PO', 'QWR916', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5165, 'NIKO', '27263', 'Open PO', 'QWR952', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5166, 'NIKO', '27263', 'Open PO', 'QWR954', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5167, 'NIKO', '27263', 'Open PO', 'QWR956', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-03', '2019-07-06', '2019-06-26', NULL, '2019-05-31', '2019-06-18', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:44:40', NULL, NULL, 20, 9),
(5168, 'TERRY', '27057-B', 'Open PO', 'LJJ883A', '2019-06-03', '2019-05-20', '2019-05-24', '2019-05-19', '2019-04-29', '2019-04-19', '2019-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5169, 'TERRY', '27057-B', 'Open PO', 'LJJ884A', '2019-06-03', '2019-05-20', '2019-05-24', '2019-05-19', '2019-04-29', '2019-04-19', '2019-05-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5170, 'TERRY', '27054-B', 'Open PO', 'LJJ883A', '2019-06-01', '2019-05-18', '2019-05-22', '2019-05-17', '2019-04-27', '2019-04-17', '2019-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5171, 'TERRY', '27054-B', 'Open PO', 'LJJ884A', '2019-06-01', '2019-05-18', '2019-05-22', '2019-05-17', '2019-04-27', '2019-04-17', '2019-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5172, 'OWEN', '27186', 'Open PO', 'MLT102', '2019-05-30', '2019-05-16', '2019-05-20', '2019-05-15', '2019-04-25', '2019-04-15', '2019-04-30', NULL, '2019-05-29', NULL, '2019-05-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PUMP NOT READY', ' INSPECTION PASS', 19, '2019-06-15', '2019-06-21 06:46:29', 'for_distance', NULL, 19, 11),
(5173, 'JONES', '27269', 'Open PO', 'LCE205A', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:46:41', NULL, NULL, 21, 12),
(5174, 'JONES', '27128', 'Open PO', 'LCE205A', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:47:12', NULL, NULL, 21, 12),
(5175, 'JOY', '27084', 'Open PO', 'QFC156BL', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:35:58', NULL, NULL, 22, 13),
(5176, 'JOY', '27084', 'Open PO', 'QFC156RD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:35:58', NULL, NULL, 22, 13),
(5177, 'NIKO', '27086', 'Open PO', 'QTT366SLR', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:34:13', NULL, NULL, 21, 14),
(5178, 'NIKO', '27134', 'Open PO', 'LUC138MC', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:47:47', NULL, NULL, 20, 15),
(5179, 'JOY', '26967-2', 'Open PO', 'GXT518', '2019-05-22', '2019-05-08', '2019-05-12', '2019-05-07', '2019-04-17', '2019-04-07', '2019-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 07:10:44', NULL, NULL, 22, 16),
(5180, 'NIKO', '27307', 'Open PO', 'TEC106', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', '2019-05-21', '2019-05-21', NULL, NULL, '2019-04-08', NULL, '2019-05-21', '2019-05-21', NULL, NULL, '2019-04-11', NULL, '2019-5-21: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-15 02:36:54', 'for_distance', 'for_distance', 20, 17),
(5181, 'JOY', '27302', 'Open PO', 'JFH1042', '2019-05-25', '2019-05-11', '2019-05-15', '2019-05-10', '2019-04-20', '2019-04-10', '2019-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:44:46', NULL, NULL, 22, 16),
(5182, 'JOY', '27302', 'Open PO', 'USA1526ABB', '2019-05-25', '2019-05-11', '2019-05-15', '2019-05-10', '2019-04-20', '2019-04-10', '2019-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 07:02:01', NULL, NULL, 22, 16),
(5183, 'JOY', '27315', 'Open PO', 'GEM122', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 07:09:13', NULL, NULL, 22, 16),
(5184, 'JOY', '27314', 'Open PO', 'GEM122', '2019-05-25', '2019-05-11', '2019-05-15', '2019-05-10', '2019-04-20', '2019-04-10', '2019-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GEM170 OK,PUMP NOT READY FOR GEM122', NULL, 23, '2019-06-15', '2019-07-03 06:57:09', NULL, NULL, 22, 16),
(5185, 'JOY', '27314', 'Open PO', 'GEM170', '2019-05-25', '2019-05-11', '2019-05-15', '2019-05-10', '2019-04-20', '2019-04-10', '2019-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GEM170 OK,PUMP NOT READY FOR GEM122', NULL, 23, '2019-06-15', '2019-07-03 06:57:09', NULL, NULL, 22, 16),
(5186, 'JACKY', '27420', 'Open PO', 'GXP158CC', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GXP158CC need to be updated as today YEN found the GXP158CC graphics was incorrect,this is casued by USA office.', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 18),
(5187, 'JACKY', '27420', 'Open PO', 'GXP158BB-CC', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GXP158CC need to be updated as today YEN found the GXP158CC graphics was incorrect,this is casued by USA office.', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 18),
(5188, 'RICHARD', '26581-2', 'Open PO', 'V0127P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5189, 'RICHARD', '26581-2', 'Open PO', 'V0017P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5190, 'RICHARD', '26581-2', 'Open PO', 'V0017PBK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5191, 'RICHARD', '26581-2', 'Open PO', 'V01147BK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5192, 'RICHARD', '26581-2', 'Open PO', 'V0347P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-20', NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-21 01:55:16', NULL, NULL, 3, 19),
(5193, 'RICHARD', '26581-2', 'Open PO', 'V0347PBK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-20', NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-21 01:55:16', NULL, NULL, 3, 19),
(5194, 'RICHARD', '26581-2', 'Open PO', 'V0387P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5195, 'RICHARD', '26581-2', 'Open PO', 'V0583PBK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5196, 'RICHARD', '26581-2', 'Open PO', 'VR012', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5197, 'RICHARD', '26581-2', 'Open PO', 'VR001', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, '2019-06-20', NULL, NULL, NULL, NULL, '2019-06-20', NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 3, '2019-06-15', '2019-06-21 05:31:30', NULL, NULL, 3, 19),
(5198, 'RICHARD', '27964', 'Open PO', 'V0383P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5199, 'RICHARD', '27964', 'Open PO', 'V0387P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5200, 'RICHARD', '27964', 'Open PO', 'V0123P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5201, 'RICHARD', '27964', 'Open PO', 'V0127P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5202, 'RICHARD', '27964', 'Open PO', 'V0583P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5203, 'RICHARD', '27964', 'Open PO', 'V0587P', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5204, 'RICHARD', '27964', 'Open PO', 'FDH112', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5205, 'RICHARD', '27964', 'Open PO', 'FDH200', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5206, 'RICHARD', '27964', 'Open PO', 'FDH300', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5207, 'RICHARD', '27964', 'Open PO', 'VR014', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5208, 'RICHARD', '27964', 'Open PO', 'VR012', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5209, 'RICHARD', '27964', 'Open PO', 'VR034', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5210, 'RICHARD', '27964', 'Open PO', 'VR001', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5211, 'RICHARD', '27964', 'Open PO', 'V0123PBK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5212, 'RICHARD', '27964', 'Open PO', 'V0127PBK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5213, 'RICHARD', '27964', 'Open PO', 'V0347PBK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5214, 'RICHARD', '27964', 'Open PO', 'V0017PBK', '2019-06-04', '2019-05-21', '2019-05-25', '2019-05-20', '2019-04-30', '2019-04-20', '2019-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 19),
(5215, 'RICHARD', '27320', 'Open PO', 'PAL3100', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5216, 'RICHARD', '27320', 'Open PO', 'PAL2100', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5217, 'RICHARD', '27320', 'Open PO', 'PAL4000', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5218, 'RICHARD', '27320', 'Open PO', 'PAL8000', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5219, 'RICHARD', '27320', 'Open PO', 'PAL6550', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5220, 'RICHARD', '27320', 'Open PO', 'P180', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5221, 'RICHARD', '27320', 'Open PO', 'PAL5200', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5222, 'RICHARD', '27320', 'Open PO', 'PAD550', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5223, 'RICHARD', '27321', 'Open PO', 'PAL3100', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5224, 'RICHARD', '27321', 'Open PO', 'PAL2100', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5225, 'RICHARD', '27321', 'Open PO', 'PAL4000', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5226, 'RICHARD', '27321', 'Open PO', 'PAL8000', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5227, 'RICHARD', '27321', 'Open PO', 'PAL6550', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5228, 'RICHARD', '27321', 'Open PO', 'P180', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5229, 'RICHARD', '27321', 'Open PO', 'PLUV2000', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5230, 'RICHARD', '27321', 'Open PO', 'PLF1000U', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5231, 'TERRY', '27089', 'Open PO', 'RGG212BB', '2019-05-22', '2019-05-08', '2019-05-12', '2019-05-07', '2019-04-17', '2019-04-07', '2019-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5232, 'TERRY', '27089', 'Open PO', 'RGG220ABB-TM', '2019-05-22', '2019-05-08', '2019-05-12', '2019-05-07', '2019-04-17', '2019-04-07', '2019-04-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5233, 'TERRY', '27131', 'Open PO', 'LJJ1084', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5234, 'NIKO', '27119', 'Open PO', 'CRD100L-GN', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5235, 'NIKO', '27119', 'Open PO', 'CRD100L-MC', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5236, 'NIKO', '27119', 'Open PO', 'CRD100L-RD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:13', NULL, NULL, 20, 22),
(5237, 'NIKO', '27119', 'Open PO', 'CRD100L-WT', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:22:11', NULL, NULL, 20, 22),
(5238, 'NIKO', '27119', 'Open PO', 'CRD111S-GD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5239, 'NIKO', '27119', 'Open PO', 'CRD111S-GN', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5240, 'NIKO', '27119', 'Open PO', 'CRD111S-RD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5241, 'NIKO', '27119', 'Open PO', 'CRD111S-SL', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:22:11', NULL, NULL, 20, 22),
(5242, 'NIKO', '27119', 'Open PO', 'CRD100S-MC', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5243, 'NIKO', '27119', 'Open PO', 'CRD100S-RD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5244, 'NIKO', '27119', 'Open PO', 'CRD100S-WT', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5245, 'NIKO', '27119', 'Open PO', 'CRD128GN', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:22:11', NULL, NULL, 20, 22),
(5246, 'NIKO', '27119', 'Open PO', 'CRD128MC', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:22:11', NULL, NULL, 20, 22),
(5247, 'NIKO', '27119', 'Open PO', 'CRD128RD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5248, 'NIKO', '27119', 'Open PO', 'CRD128WW', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:20:47', NULL, NULL, 20, 22),
(5249, 'NIKO', '27116-2', 'Open PO', 'COR108MC', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:51:15', NULL, NULL, 20, 23),
(5250, 'NIKO', '27116-2', 'Open PO', 'COR152', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:51:15', NULL, NULL, 20, 23),
(5251, 'NIKO', '27116-2', 'Open PO', 'COR162MC', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:51:15', NULL, NULL, 20, 23),
(5252, 'NIKO', '27929', 'Open PO', 'MSY100A-BL', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:30:53', NULL, NULL, 20, 24),
(5253, 'JACKY', '27137', 'Open PO', 'ORS728', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'COLOR LABEL,IM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 25),
(5254, 'JACKY', '27137', 'Open PO', 'ORS730', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'COLOR LABEL,IM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 25),
(5255, 'JACKY', '27306', 'Open PO', 'ORS112RD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 25),
(5256, 'JONES', '27305', 'Open PO', 'GIL1292', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-24', '2019-06-26', '2019-06-15', NULL, '2019-05-09', '2019-05-22', '2019-06-12', '2019-06-13', '2019-06-07', NULL, '2019-05-10', '2019-05-24', '2019-6-26: INSPECTED BY OWEN,\nIM NOT COMPLETE.', 'REJECTED', 23, '2019-06-15', '2019-07-03 06:17:12', NULL, NULL, 21, 26),
(5257, 'JONES', '27074', 'Open PO', 'GXT252', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-24', '2019-06-26', '2019-06-15', NULL, '2019-05-09', '2019-05-22', '2019-06-13', '2019-06-14', '2019-06-07', NULL, '2019-05-09', '2019-05-24', '2019-6-26: INSPECTED BY OWEN,\nIM NOT COMPLETE.', 'REJECTED', 23, '2019-06-15', '2019-07-03 06:16:48', NULL, NULL, 21, 26),
(5258, 'JOY', '27681', 'Open PO', 'MCC390L-SL', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:25:42', NULL, NULL, 22, 27),
(5259, 'TERRY', '27085', 'Open PO', 'SLY180A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5260, 'OWEN', '27127', 'Open PO', 'LAZ156A', '2019-05-26', '2019-05-12', '2019-05-16', '2019-05-11', '2019-04-21', '2019-04-11', '2019-04-26', NULL, '2019-06-10', NULL, '2019-06-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', 'INSPECTION PASS', 19, '2019-06-15', '2019-07-01 02:14:37', NULL, NULL, 19, 28),
(5261, 'JOY', '27950', 'Open PO', 'GEM170', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 07:02:57', NULL, NULL, 22, 16),
(5262, 'OWEN', '27247', 'Open PO', 'MLT100', '2019-05-30', '2019-05-16', '2019-05-20', '2019-05-15', '2019-04-25', '2019-04-15', '2019-04-30', NULL, '2019-05-29', NULL, '2019-05-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PUMP NOT READY', 'INSPECTION PASS', 19, '2019-06-15', '2019-06-21 06:50:51', 'for_distance', NULL, 19, 11),
(5263, 'OWEN', '27247', 'Open PO', 'MLT102', '2019-05-30', '2019-05-16', '2019-05-20', '2019-05-15', '2019-04-25', '2019-04-15', '2019-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PUMP NOT READY', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 11),
(5264, 'JOY', '27313', 'Open PO', 'GEM122', '2019-05-25', '2019-05-11', '2019-05-15', '2019-05-10', '2019-04-20', '2019-04-10', '2019-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 07:09:45', NULL, NULL, 22, 16),
(5265, 'NIKO', '27264', 'Open PO', 'QWR778', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-05-18', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,\nN.W/G.W ISSUES\n2019-7-13: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-15 01:23:38', 'small_quantities', 'small_quantities', 20, 9),
(5266, 'NIKO', '27264', 'Open PO', 'QWR780', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-05-18', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,\nN.W/G.W ISSUES\n2019-7-13: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-15 01:23:38', 'small_quantities', 'small_quantities', 20, 9),
(5267, 'NIKO', '27264', 'Open PO', 'QWR898', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-07', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:51:06', 'small_quantities', 'small_quantities', 20, 9),
(5268, 'NIKO', '27264', 'Open PO', 'QWR900', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-07', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:51:06', 'small_quantities', 'small_quantities', 20, 9),
(5269, 'NIKO', '27264', 'Open PO', 'QWR902', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-07', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:51:06', 'small_quantities', 'small_quantities', 20, 9),
(5270, 'NIKO', '27264', 'Open PO', 'QWR904', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-07', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:51:06', 'small_quantities', 'small_quantities', 20, 9),
(5271, 'NIKO', '27264', 'Open PO', 'QWR908', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-07', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:51:06', 'small_quantities', 'small_quantities', 20, 9),
(5272, 'NIKO', '27264', 'Open PO', 'QWR910', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-07', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:51:06', 'small_quantities', 'small_quantities', 20, 9),
(5273, 'NIKO', '27264', 'Open PO', 'QWR916', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-07', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:51:06', 'small_quantities', 'small_quantities', 20, 9),
(5274, 'NIKO', '27264', 'Open PO', 'QWR938', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', NULL, NULL, 23, '2019-06-15', '2019-07-08 07:57:19', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5275, 'NIKO', '27264', 'Open PO', 'QWR952', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-09', '2019-07-10', NULL, NULL, '2019-06-03', '2019-05-18', '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-10: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 09:23:29', 'small_quantities', 'small_quantities', 20, 9),
(5276, 'NIKO', '27264', 'Open PO', 'QWR956', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-05-18', '2019-07-10', '2019-07-15', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-11: INSPECTED BY JONES,', NULL, 23, '2019-06-15', '2019-07-11 05:43:54', 'small_quantities', 'small_quantities', 20, 9),
(5277, 'JOY', '27278-B2', 'Open PO', 'KIY318A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:13:11', NULL, NULL, 22, 29),
(5278, 'JOY', '27284-B2', 'Open PO', 'KIY318A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:12:47', NULL, NULL, 22, 29),
(5279, 'JONES', '27711', 'Open PO', 'GIL1482', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'STICKER NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:41:47', NULL, NULL, 21, 30),
(5280, 'JOY', '27125', 'Open PO', 'JFH1245A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-03', '2019-05-20', '2019-06-11', '2019-07-12', NULL, NULL, '2019-05-09', '2019-05-20', '2019-7-11: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:31:46', 'small_quantities', 'small_quantities', 22, 31),
(5281, 'JOY', '27125', 'Open PO', 'JUM324', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-06-24', '2019-06-24', '2019-05-29', NULL, '2019-05-09', '2019-05-20', '2019-06-11', '2019-06-12', '2019-05-28', NULL, '2019-05-09', '2019-05-24', '2019-6-24: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 03:08:31', NULL, 'small_quantities', 22, 31),
(5282, 'JOY', '27125', 'Open PO', 'JUM326', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-06-15', '2019-06-17', '2019-05-29', NULL, '2019-05-09', '2019-05-20', '2019-06-11', '2019-06-12', '2019-06-01', NULL, '2019-05-10', '2019-06-06', '2019-6-17: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 03:06:55', NULL, 'produced_in_sub_asse', 22, 31),
(5283, 'JOY', '27125', 'Open PO', 'JUM330HH-RS', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-03', '2019-05-20', '2019-06-11', '2019-07-12', NULL, NULL, '2019-05-09', '2019-05-20', '2019-7-11: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:31:46', 'small_quantities', 'small_quantities', 22, 31),
(5284, 'TERRY', '27612-S', 'Open PO', 'KGD242ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-22', '2019-05-21', '2019-06-09', '2019-06-10', NULL, NULL, '2019-05-10', '2019-05-21', '2019-7-9: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:50:38', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 32),
(5285, 'TERRY', '27611', 'Open PO', 'KGD242ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-22', '2019-05-21', '2019-06-09', '2019-06-10', NULL, NULL, '2019-05-10', '2019-05-20', '2019-7-9: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:52:02', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 32),
(5286, 'TERRY', '27290-B2', 'Open PO', 'KGD242ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-13', '2019-07-15', NULL, NULL, '2019-05-16', '2019-05-21', '2019-06-09', '2019-06-10', NULL, NULL, '2019-05-10', '2019-05-21', '2019-6-21: INSPECTED BY TERRY,\nPAINTING UNDERWAY,PACKAGING MATERIALS NOT READY.', 'PENDING', 23, '2019-06-15', '2019-07-13 04:13:47', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 32),
(5287, 'TERRY', '27292-B2', 'Open PO', 'KGD242ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-13', '2019-07-15', NULL, NULL, '2019-06-10', '2019-05-21', '2019-06-09', '2019-06-10', NULL, NULL, '2019-05-10', '2019-05-21', '2019-6-21: INSPECTED BY TERRY,\nPAINTING UNDERWAY,PACAKAGING MATERIALS NOT READY.', 'PENDING', 23, '2019-06-15', '2019-07-13 04:14:50', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 32),
(5288, 'TERRY', '27335', 'Open PO', 'KGD240ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-21', '2019-05-20', '2019-06-09', '2019-06-10', NULL, NULL, '2019-05-10', '2019-05-20', '2019-7-9: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:53:15', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 32);
INSERT INTO `qcschedules` (`seq`, `qc`, `po`, `potype`, `itemnumbers`, `shipdate`, `screadydate`, `scfinalinspectiondate`, `scmiddleinspectiondate`, `scfirstinspectiondate`, `scproductionstartdate`, `scgraphicsreceivedate`, `acreadydate`, `acfinalinspectiondate`, `acmiddleinspectiondate`, `acfirstinspectiondate`, `acproductionstartdate`, `acgraphicsreceivedate`, `apreadydate`, `apfinalinspectiondate`, `apmiddleinspectiondate`, `apfirstinspectiondate`, `approductionstartdate`, `apgraphicsreceivedate`, `notes`, `status`, `userseq`, `createdon`, `lastmodifiedon`, `apmiddleinspectiondatenareason`, `apfirstinspectiondatenareason`, `qcuser`, `classcodeseq`) VALUES
(5289, 'TERRY', '27290-B5', 'Open PO', 'LJJ912HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LJJ912HH GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5290, 'TERRY', '27290-B5', 'Open PO', 'LJJ910', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LJJ912HH GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5291, 'TERRY', '27290-B5', 'Open PO', 'LJJ1084', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LJJ912HH GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5292, 'TERRY', '27292-B5', 'Open PO', 'LJJ912HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LJJ912HH GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5293, 'TERRY', '27292-B5', 'Open PO', 'LJJ910', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LJJ912HH GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5294, 'TERRY', '27292-B5', 'Open PO', 'LJJ1084', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LJJ912HH GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5295, 'TERRY', '27133', 'Open PO', 'LJJ884A', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5296, 'NIKO', '27282-B', 'Open PO', 'LWQ128-3', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-20', '2019-05-22', '2019-06-22', '2019-06-24', NULL, NULL, '2019-05-22', '2019-06-06', '2019-6-25: INSPECTED BY NIKO', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:38:04', 'for_distance', 'for_distance', 20, 67),
(5297, 'NIKO', '27283-B', 'Open PO', 'LWQ128-3', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-20', '2019-05-22', '2019-06-22', '2019-06-24', NULL, NULL, '2019-05-22', '2019-06-06', '2019-6-25: INSPECTED BY NIKO', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:38:42', 'for_distance', 'for_distance', 20, 67),
(5298, 'JACKY', '27115', 'Open PO', 'BEH200HH', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BODY MOLD UNDER PRODUCTION, GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 34),
(5299, 'JACKY', '27115', 'Open PO', 'BEH204HH', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BODY MOLD UNDER PRODUCTION, GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 34),
(5300, 'JACKY', '27115', 'Open PO', 'BEH206HH', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BODY MOLD UNDER PRODUCTION, GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 34),
(5301, 'JACKY', '27282-B4', 'Open PO', 'BQR108S', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 35),
(5302, 'TERRY', '27142', 'Open PO', 'RGG358A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5303, 'TERRY', '27273-B2', 'Open PO', 'SOT162BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5304, 'TERRY', '27273-B2', 'Open PO', 'SOT102BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5305, 'TERRY', '27273-B2', 'Open PO', 'RGG358A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5306, 'TERRY', '27284-B3', 'Open PO', 'SOT102BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5307, 'TERRY', '27284-B3', 'Open PO', 'RGG412ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5308, 'TERRY', '27293-B', 'Open PO', 'SOT102BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5309, 'TERRY', '27293-B', 'Open PO', 'RGG412ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5310, 'JOY', '27303', 'Open PO', 'WTJ100L', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:11:09', NULL, NULL, 22, 16),
(5311, 'JOY', '27303', 'Open PO', 'USA1526ABB', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:46:23', NULL, NULL, 22, 16),
(5312, 'JOY', '27100', 'Open PO', 'ZEN236', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-07-05', '2019-07-06', NULL, NULL, '2019-06-02', '2019-05-21', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-13', '2019-05-21', '2019-7-6: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:30:13', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5313, 'JOY', '27100', 'Open PO', 'ZEN242', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-07-05', '2019-07-06', NULL, NULL, '2019-06-02', '2019-05-21', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-13', '2019-05-21', '2019-7-6: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:30:13', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5314, 'JOY', '27100', 'Open PO', 'ZEN244', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-07-05', '2019-07-06', NULL, NULL, '2019-06-02', '2019-05-21', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-13', '2019-05-21', '2019-7-6: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:30:13', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5315, 'JOY', '27100', 'Open PO', 'ZEN538', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-07-07', '2019-07-07', NULL, NULL, '2019-06-02', '2019-05-21', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-13', '2019-06-21', '2019-7-7: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 09:04:36', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5316, 'joy', '27111', 'Open PO', 'ZTY104CC', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:32:05', NULL, NULL, 22, 36),
(5317, 'JOY', '27099', 'Open PO', 'ZEN127ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-28', '2019-06-29', '2019-06-04', NULL, '2019-04-18', '2019-06-07', '2019-06-26', '2019-06-27', '2019-06-22', NULL, '2019-05-23', '2019-06-07', '2019-6-29: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:09:12', NULL, NULL, 22, 16),
(5318, 'JOY', '27292-B', 'Open PO', 'ZEN696AGG', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-07-10', '2019-06-20', '2019-05-20', '2019-05-21', '2019-07-17', '2019-07-18', '2019-07-08', '2019-06-22', '2019-05-23', '2019-06-07', '2019-7-10: INSPECTED BY JOY,\nASSEMBLY IN PROGRESS.', NULL, 23, '2019-06-15', '2019-07-10 09:12:43', NULL, NULL, 22, 16),
(5319, 'JOY', '27292-B', 'Open PO', 'ZEN702AGG', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-07-10', '2019-06-20', '2019-05-20', '2019-05-21', '2019-07-17', '2019-07-18', '2019-07-08', '2019-06-22', '2019-05-23', '2019-06-07', '2019-7-10: INSPECTED BY JOY,\nASSEMBLY IN PROGRESS.', NULL, 23, '2019-06-15', '2019-07-10 09:12:43', NULL, NULL, 22, 16),
(5320, 'JOY', '27290-B', 'Open PO', 'ZEN696AGG', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-07-10', '2019-06-20', '2019-05-20', '2019-05-21', '2019-07-17', '2019-07-18', '2019-07-08', '2019-06-22', '2019-05-23', '2019-06-07', '2019-7-10: INSPECTED BY JOY,\nASSEMBLY IN PROGRESS.', NULL, 23, '2019-06-15', '2019-07-10 09:10:36', NULL, NULL, 22, 16),
(5321, 'JOY', '27290-B', 'Open PO', 'ZEN702AGG', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-07-10', '2019-06-20', '2019-05-20', '2019-05-21', '2019-07-17', '2019-07-18', '2019-07-08', '2019-06-22', '2019-05-23', '2019-06-07', '2019-7-10: INSPECTED BY JOY,\nASSEMBLY IN PROGRESS.', NULL, 23, '2019-06-15', '2019-07-10 09:10:36', NULL, NULL, 22, 16),
(5322, 'JONES', '27102', 'Open PO', 'SLL2162A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:27:57', NULL, NULL, 21, 37),
(5323, 'JONES', '27102', 'Open PO', 'SLL2160A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:27:57', NULL, NULL, 21, 37),
(5324, 'JONES', '27811', 'Open PO', 'SLL836', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:29:12', NULL, NULL, 21, 37),
(5325, 'JONES', '27293-B2', 'Open PO', 'SLL2162A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IM NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:27:36', NULL, NULL, 21, 37),
(5326, 'JONES', '27292-B8', 'Open PO', 'SLL2162A', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IM NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:28:32', NULL, NULL, 21, 37),
(5327, 'TERRY', '27273-B3', 'Open PO', 'SLC131', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TO BE PACKAGED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5328, 'TERRY', '27284-B4', 'Open PO', 'QLP212BB', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QLP212BB cfm but still wait QLP930BB graphic', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5329, 'TERRY', '27284-B4', 'Open PO', 'QLP930BB', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QLP212BB cfm but still wait QLP930BB graphic', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5330, 'TERRY', '27293-B3', 'Open PO', 'QLP212BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QLP212BB cfm but still wait QLP930BB graphic', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5331, 'TERRY', '27293-B3', 'Open PO', 'QLP930BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QLP212BB cfm but still wait QLP930BB graphic', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5332, 'TERRY', '27619', 'Open PO', 'QLP1174ABB-S-TM', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-03', '2019-05-22', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-02', '2019-05-22', '2019-7-9: INSPECTED BY OWEN,\nPAINTING DEFECTIVES.', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:41:50', 'small_quantities', 'small_quantities', 10, 4),
(5333, 'TERRY', '27139', 'Open PO', 'SLC131BB-9', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-06', NULL, 'NEW ITEM, NO GRAPHICS', NULL, 23, '2019-06-15', '2019-07-08 07:21:00', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5334, 'TERRY', '27139', 'Open PO', 'QLP1017ABB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-06', '2019-05-31', '2019-06-17', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-6-25: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-26 01:00:36', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5335, 'TERRY', '27139', 'Open PO', 'QLP1103BB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-06', NULL, 'NEW ITEM, NO GRAPHICS', NULL, 23, '2019-06-15', '2019-07-08 07:21:00', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5336, 'TERRY', '27139', 'Open PO', 'QLP1186ABB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-06', '2019-05-31', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-6-25: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-26 00:58:21', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5337, 'TERRY', '27139', 'Open PO', 'QLP1196A', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-06', '2019-05-31', '2019-06-17', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-7-9: INSPECTED BY OWEN,', NULL, 23, '2019-06-15', '2019-07-09 03:55:12', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5338, 'TERRY', '27139', 'Open PO', 'QLP212BB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-22', '2019-06-24', NULL, NULL, '2019-05-06', '2019-05-31', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-30', 'NEW ITEM, NO GRAPHICS\n2019-6-24: INSPECTED BY TERRY,PENDING.\n2019-6-25:  INSPECTED BY TERRY,ACCEPTED.', 'ACCEPTED', 23, '2019-06-15', '2019-06-26 01:02:45', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5339, 'TERRY', '27139', 'Open PO', 'QLP932BB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-22', '2019-06-24', NULL, NULL, '2019-05-06', '2019-05-31', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-6-24: INSPECTED BY TERRY,', NULL, 23, '2019-06-15', '2019-07-08 07:19:48', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5340, 'TERRY', '27139', 'Open PO', 'SLC131', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-22', '2019-06-24', NULL, NULL, '2019-05-06', '2019-05-31', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-6-24: INSPECTED BY TERRY,', NULL, 23, '2019-06-15', '2019-07-08 07:19:48', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5341, 'TERRY', '27139', 'Open PO', 'QLP1174A-L-TM', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-06', '2019-05-31', '2019-06-17', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:36:46', NULL, NULL, 10, 4),
(5342, 'RICHARD', '27279-B2', 'Open PO', 'CIM224HH-L', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5343, 'RICHARD', '27280-B', 'Open PO', 'CIM224HH-L', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5344, 'RICHARD', '27280-B', 'Open PO', 'CIM228HH-L', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5345, 'RICHARD', '27281-B', 'Open PO', 'CIM224HH-L', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5346, 'RICHARD', '27281-B', 'Open PO', 'CIM228HH-L', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5347, 'JACKY', '27529-B', 'Open PO', 'ORS728', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UNDER PRODUCTION', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 25),
(5348, 'JACKY', '27529-B', 'Open PO', 'ORS730', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UNDER PRODUCTION', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 25),
(5349, 'NIKO', '27602', 'Open PO', 'COR174A-TM', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-23', '2019-05-31', '2019-06-19', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-28: INSPECTED BY NIKO,', NULL, 23, '2019-06-15', '2019-07-03 06:13:39', 'for_distance', 'for_distance', 20, 23),
(5350, 'NIKO', '27083', 'Open PO', 'CAD110WT', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:48:48', NULL, NULL, 20, 23),
(5351, 'NIKO', '27083', 'Open PO', 'COR108MC', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:48:48', NULL, NULL, 20, 23),
(5352, 'NIKO', '27083', 'Open PO', 'COR124L-SL', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:48:48', NULL, NULL, 20, 23),
(5353, 'NIKO', '27083', 'Open PO', 'COR114T-3', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:48:48', NULL, NULL, 20, 23),
(5354, 'NIKO', '27083', 'Open PO', 'COR152', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:48:48', NULL, NULL, 20, 23),
(5355, 'NIKO', '27083', 'Open PO', 'COR164', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:48:48', NULL, NULL, 20, 23),
(5356, 'NIKO', '27083', 'Open PO', 'LPA108L-RD', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 06:48:48', NULL, NULL, 20, 23),
(5357, 'NIKO', '27291-B', 'Open PO', 'COR174A-TM', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-16', '2019-05-31', '2019-06-19', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-28: INSPECTED BY NIKO,', NULL, 23, '2019-06-15', '2019-07-03 06:13:16', 'for_distance', 'for_distance', 20, 23),
(5358, 'NIKO', '27291-B', 'Open PO', 'COR114T-3', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:53:16', NULL, NULL, 20, 23),
(5359, 'NIKO', '27282-B3', 'Open PO', 'COR174A-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-23', '2019-06-07', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-28: INSPECTED BY NIKO,', NULL, 23, '2019-06-15', '2019-07-03 06:12:19', 'for_distance', 'for_distance', 20, 23),
(5360, 'NIKO', '27282-B3', 'Open PO', 'COR114T-3', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:50:32', NULL, NULL, 20, 23),
(5361, 'NIKO', '27604-S', 'Open PO', 'COR174A-TM', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-16', '2019-05-13', '2019-06-19', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-28: INSPECTED BY NIKO,', NULL, 23, '2019-06-15', '2019-07-03 06:11:50', 'for_distance', 'for_distance', 20, 23),
(5362, 'NIKO', '27145', 'Open PO', 'COR134WW-10', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-16', '2019-05-31', '2019-06-19', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-28: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:09:54', 'for_distance', 'for_distance', 20, 23),
(5363, 'NIKO', '27145', 'Open PO', 'COR194A', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-27', '2019-06-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-6-28: INSPECTED BY NIKO', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:09:54', 'for_distance', 'for_distance', 20, 23),
(5364, 'TERRY', '27290-B6', 'Open PO', 'WQA1302', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 39),
(5365, 'TERRY', '27292-B6', 'Open PO', 'WQA1302', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 39),
(5366, 'JACKY', '27290-B7', 'Open PO', 'WHS110MC-TM', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 40),
(5367, 'JACKY', '27292-B7', 'Open PO', 'WHS110MC-TM', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 40),
(5368, 'NIKO', '27282-B6', 'Open PO', 'WXY144ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-18', '2019-05-22', '2019-06-18', '2019-06-19', NULL, NULL, '2019-04-30', '2019-05-24', '2019-6-26: INSPECTED BY NIKO,', NULL, 23, '2019-06-15', '2019-07-03 06:37:07', 'for_distance', 'for_distance', 20, 41),
(5369, 'NIKO', '27291-B3', 'Open PO', 'WXY144ABB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-18', '2019-05-22', '2019-06-18', '2019-06-19', NULL, NULL, '2019-05-01', '2019-05-24', '2019-6-26: INSPECTED BY NIKO,', NULL, 23, '2019-06-15', '2019-07-03 06:36:05', 'for_distance', 'for_distance', 20, 41),
(5370, 'NIKO', '27107', 'Open PO', 'WXY104HH', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:11:25', 'for_distance', 'for_distance', 20, 41),
(5371, 'NIKO', '27107', 'Open PO', 'WXY122BB-S', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:11:25', 'for_distance', 'for_distance', 20, 41),
(5372, 'NIKO', '27107', 'Open PO', 'WXY142', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:11:25', 'for_distance', 'for_distance', 20, 41),
(5373, 'NIKO', '27107', 'Open PO', 'WXY144ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:11:25', 'for_distance', 'for_distance', 20, 41),
(5374, 'NIKO', '27107', 'Open PO', 'WXY166BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:11:25', 'for_distance', 'for_distance', 20, 41),
(5375, 'NIKO', '27107', 'Open PO', 'WXY168BB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:11:25', 'for_distance', 'for_distance', 20, 41),
(5376, 'NIKO', '27569', 'Open PO', 'WXY122BB-S', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:12:32', 'for_distance', 'for_distance', 20, 41),
(5377, 'NIKO', '27569', 'Open PO', 'WXY148ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:12:32', 'for_distance', 'for_distance', 20, 41),
(5378, 'NIKO', '27569', 'Open PO', 'WXY152ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:12:32', 'for_distance', 'for_distance', 20, 41),
(5379, 'NIKO', '27569', 'Open PO', 'WXY154ABB', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-04-30', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:12:32', 'for_distance', 'for_distance', 20, 41),
(5380, 'OWEN', '27106', 'Open PO', 'WTJ217', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-25', '2019-06-25', NULL, NULL, '2019-05-07', '2019-05-23', '2019-06-16', '2019-06-17', NULL, NULL, '2019-05-20', '2019-05-25', '2019-6-25: INSPECTED BY OWEN,', 'REJECTED', 23, '2019-06-15', '2019-06-25 10:10:14', 'small_quantities', 'small_quantities', 19, 42),
(5381, 'OWEN', '27106', 'Open PO', 'WTJ220', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-25', '2019-06-25', NULL, NULL, '2019-05-07', '2019-05-23', '2019-05-16', '2019-05-17', NULL, NULL, '2019-05-20', '2019-05-25', '2019-6-25: INSPECTED BY OWEN,', 'REJECTED', 23, '2019-06-15', '2019-06-25 10:09:48', 'small_quantities', 'small_quantities', 19, 42),
(5382, 'OWEN', '27106', 'Open PO', 'WTJ222', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-25', '2019-06-25', NULL, NULL, '2019-05-07', '2019-05-23', '2019-06-16', '2019-06-17', NULL, NULL, '2019-05-20', '2019-05-25', '2019-6-25: INSPECTED BY OWEN,', 'REJECTED', 23, '2019-06-15', '2019-06-25 10:10:37', 'small_quantities', 'small_quantities', 19, 42),
(5383, 'OWEN', '27106', 'Open PO', 'WTJ226', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-25', '2019-06-25', NULL, NULL, '2019-05-07', '2019-05-23', '2019-05-16', '2019-05-17', NULL, NULL, '2019-05-20', '2019-05-25', '2019-6-25: INSPECTED BY OWEN,', 'REJECTED', 23, '2019-06-15', '2019-06-25 10:09:10', 'small_quantities', 'small_quantities', 19, 42),
(5384, 'OWEN', '27106', 'Open PO', 'WTJ236ABB', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-07', '2019-05-23', '2019-05-16', '2019-05-17', NULL, NULL, '2019-05-20', '2019-05-25', '2019-7-3: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:13:35', 'small_quantities', 'small_quantities', 19, 42),
(5385, 'JACKY', '27109', 'Open PO', 'YHL256S', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IN PRODUCTION', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 43),
(5386, 'JACKY', '27282-B2', 'Open PO', 'YHL248HH', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 43),
(5387, 'JACKY', '27283-B2', 'Open PO', 'YHL248HH', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 43),
(5388, 'JACKY', '27660-S', 'Open PO', 'YHL248HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, '2019-06-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IN PRODUCTION', NULL, 17, '2019-06-15', '2019-06-20 11:39:40', NULL, NULL, 17, 43),
(5389, 'JACKY', '27662', 'Open PO', 'YHL248HH', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UNDER PRODUCTION', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 43),
(5390, 'JONES', '27583-B7', 'Open PO', 'QVA122', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:12:24', NULL, NULL, 20, 44),
(5391, 'JONES', '27583-B7', 'Open PO', 'QVA124', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:12:24', NULL, NULL, 20, 44),
(5392, 'JONES', '27583-B7', 'Open PO', 'QVA126BZ', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:12:24', NULL, NULL, 20, 44),
(5393, 'JONES', '27583-B7', 'Open PO', 'QVA126SL', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:12:24', NULL, NULL, 20, 44),
(5394, 'JONES', '27282-B8', 'Open PO', 'QVA124', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED, PPS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:12:45', NULL, NULL, 20, 44),
(5395, 'JONES', '27282-B8', 'Open PO', 'QVA126SL', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED, PPS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:12:45', NULL, NULL, 20, 44),
(5396, 'JONES', '27283-B4', 'Open PO', 'QVA124', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED, PPS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:13:00', NULL, NULL, 20, 44),
(5397, 'JONES', '27283-B4', 'Open PO', 'QVA126SL', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG,SHIPPING MARKS NOT CONFIRMED, PPS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:13:00', NULL, NULL, 20, 44),
(5398, 'NIKO', '27273-B', 'Open PO', 'QWE106', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:42:15', NULL, NULL, 20, 45),
(5399, 'NIKO', '27282-B5', 'Open PO', 'QWE106', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:42:56', NULL, NULL, 20, 45),
(5400, 'NIKO', '27291-B2', 'Open PO', 'QWE106', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SHIPPING MARKS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:43:18', NULL, NULL, 20, 45),
(5401, 'OWEN', '27783', 'Open PO', 'USA1164', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 46),
(5402, 'JACKY', '27108', 'Open PO', 'YEN202A-201', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 18),
(5403, 'JACKY', '27290-B3', 'Open PO', 'WCC114ABB-TM', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-26', '2019-06-26', '2019-06-19', NULL, '2019-04-22', '2019-05-22', 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-08 01:51:14', NULL, 'for_distance', 17, 47),
(5404, 'JACKY', '27292-B3', 'Open PO', 'WCC114ABB-TM', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-26', '2019-06-26', '2019-06-19', NULL, '2019-04-22', '2019-05-22', 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-08 01:50:53', NULL, 'for_distance', 17, 47),
(5405, 'JOY', '27807', 'Open PO', 'MAZ254', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:48:18', NULL, NULL, 22, 48),
(5406, 'JOY', '27832', 'Open PO', 'WAC206', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, '2019-07-10', NULL, '2019-06-10', NULL, '2019-07-11', '2019-07-12', '2019-07-01', NULL, '2019-04-25', NULL, 'No graphics\n2019-7-10: INSPECTED BY JOY,\nPAINTING DONE,NOT PACKED.', NULL, 23, '2019-06-15', '2019-07-10 09:19:28', NULL, 'produced_in_sub_asse', 22, 16),
(5407, 'RICHARD', '27799-2', 'Open PO', 'PAD550', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', '2019-07-15', NULL, NULL, NULL, '2019-06-06', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, 'No graphics', NULL, 23, '2019-06-15', '2019-07-13 03:51:37', 'for_distance', 'for_distance', 3, 20),
(5408, 'JACKY', '27283-B3', 'Open PO', 'BQR108S', '2019-06-02', '2019-05-19', '2019-05-23', '2019-05-18', '2019-04-28', '2019-04-18', '2019-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 35),
(5409, 'RICHARD', '27071', 'Open PO', 'ACM126HH', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, '2019-06-01', NULL, '2019-06-11', '2019-06-12', NULL, NULL, '2019-05-18', NULL, NULL, NULL, 23, '2019-06-15', '2019-07-08 02:16:29', 'for_distance', 'for_distance', 3, 49),
(5410, 'RICHARD', '27071', 'Open PO', 'ACM132HH', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-11', '2019-06-12', NULL, NULL, '2019-05-18', NULL, '2019-06-11', '2019-06-12', NULL, NULL, '2019-05-10', '2019-05-24', '2019-6-12: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 02:28:24', 'for_distance', 'for_distance', 3, 49),
(5411, 'RICHARD', '27071', 'Open PO', 'ACM186HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-18', '2019-05-24', '2019-06-11', '2019-06-12', NULL, NULL, '2019-05-06', '2019-06-24', '2019-6-21: INSPECTED BY JACKY,\nBARCODE ISSUE ON CARTON.', 'PENDING', 23, '2019-06-15', '2019-06-22 01:09:36', 'produced_in_sub_asse', 'produced_in_sub_asse', 3, 49),
(5412, 'RICHARD', '27279-B', 'Open PO', 'CHT894', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-07-09', '2019-07-10', NULL, NULL, '2019-05-31', '2019-03-23', '2019-07-05', '2019-07-12', NULL, NULL, '2019-05-02', '2019-03-23', '2019-7-10: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 10:05:33', 'for_distance', 'for_distance', 3, 50),
(5413, 'RICHARD', '27281-B2', 'Open PO', 'CHT894', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-07-09', '2019-07-10', NULL, NULL, '2019-05-31', '2019-03-23', '2019-07-05', '2019-07-12', NULL, NULL, '2019-05-02', '2019-03-23', '2019-7-10: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 10:06:08', 'for_distance', 'for_distance', 3, 50),
(5414, 'NIKO', '27087', 'Open PO', 'QWR480', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 07:36:23', NULL, NULL, 20, 9),
(5415, 'NIKO', '27319', 'Open PO', 'SJK146SLR', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', '2019-06-24', '2019-06-24', NULL, NULL, '2019-04-25', '2019-06-07', '2019-06-23', '2019-06-24', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-24: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:41:32', 'for_distance', 'for_distance', 20, 45),
(5416, 'JOY', '27679', 'Open PO', 'WCT688', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 07:07:58', NULL, NULL, 22, 16),
(5417, 'JOY', '27579', 'Open PO', 'WTJ104L', '2019-06-15', '2019-06-01', '2019-06-05', '2019-05-31', '2019-05-11', '2019-05-01', '2019-05-16', '2019-07-01', '2019-07-01', NULL, NULL, '2019-04-15', '2019-05-31', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-1: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:07:23', NULL, NULL, 22, 16),
(5418, 'TERRY', '27287-B6', 'Open PO', 'RGG275', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 21),
(5419, 'NIKO', '27284-B', 'Open PO', 'QWR704', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-12', '2019-06-26', NULL, '2019-06-07', '2019-06-07', '2019-07-09', '2019-07-12', '2019-06-22', NULL, '2019-06-03', '2019-06-07', '2019-7-12: INSPECTED BY JACKY,\nN.W/G.W ISSUE,PENDING.', NULL, 23, '2019-06-15', '2019-07-13 01:25:22', NULL, 'produced_in_sub_asse', 20, 9),
(5420, 'NIKO', '27284-B', 'Open PO', 'QWR886', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', '2019-06-26', NULL, '2019-06-07', '2019-06-07', '2019-07-09', '2019-07-12', '2019-06-22', NULL, '2019-06-03', '2019-06-07', '2019-7-15: INSPECTED BY OWEN,\n', NULL, 23, '2019-06-15', '2019-07-15 02:56:59', NULL, NULL, 20, 9),
(5421, 'NIKO', '27284-B', 'Open PO', 'QWR890', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', '2019-06-26', NULL, '2019-06-07', '2019-06-07', '2019-07-09', '2019-07-12', '2019-06-22', NULL, '2019-06-03', '2019-06-07', '2019-7-15: INSPECTED BY OWEN,\n', NULL, 23, '2019-06-15', '2019-07-15 02:56:59', NULL, NULL, 20, 9),
(5422, 'NIKO', '27278-B', 'Open PO', 'QWR704', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-12', '2019-07-12', '2019-06-26', NULL, '2019-06-03', NULL, '2019-07-02', '2019-07-03', '2019-06-24', NULL, '2019-05-10', NULL, '2019-7-12: INSPECTED BY JACKY,\nN.W/G.W ISSUE,PENDING.', NULL, 23, '2019-06-15', '2019-07-13 01:26:33', NULL, 'produced_in_sub_asse', 20, 9),
(5423, 'NIKO', '27278-B', 'Open PO', 'QWR886', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-15', '2019-07-15', '2019-06-26', NULL, '2019-05-10', '2019-06-07', '2019-07-01', '2019-07-02', '2019-06-22', NULL, '2019-05-23', '2019-06-07', '2019-7-15: INSPECTED BY OWEN,', NULL, 23, '2019-06-15', '2019-07-15 02:59:03', NULL, 'small_quantities', 20, 9),
(5424, 'NIKO', '27278-B', 'Open PO', 'QWR890', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', '2019-06-26', NULL, '2019-05-10', '2019-06-07', '2019-07-01', '2019-07-02', '2019-06-22', NULL, '2019-05-23', '2019-06-07', '2019-7-15: INSPECTED BY OWEN,', NULL, 23, '2019-06-15', '2019-07-15 02:58:27', NULL, 'small_quantities', 20, 9),
(5425, 'NIKO', '27287-B5', 'Open PO', 'QWR952', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-10', '2019-05-18', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY RICHARD,\nQC ISSUES, TO BE CONFIRMED BY US.', 'PENDING', 23, '2019-06-15', '2019-07-03 09:54:50', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5426, 'NIKO', '27287-B5', 'Open PO', 'QWR954', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-10', '2019-05-18', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY RICHARD,\nQC ISSUES, TO BE CONFIRMED BY US.', 'PENDING', 23, '2019-06-15', '2019-07-03 09:54:50', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9);
INSERT INTO `qcschedules` (`seq`, `qc`, `po`, `potype`, `itemnumbers`, `shipdate`, `screadydate`, `scfinalinspectiondate`, `scmiddleinspectiondate`, `scfirstinspectiondate`, `scproductionstartdate`, `scgraphicsreceivedate`, `acreadydate`, `acfinalinspectiondate`, `acmiddleinspectiondate`, `acfirstinspectiondate`, `acproductionstartdate`, `acgraphicsreceivedate`, `apreadydate`, `apfinalinspectiondate`, `apmiddleinspectiondate`, `apfirstinspectiondate`, `approductionstartdate`, `apgraphicsreceivedate`, `notes`, `status`, `userseq`, `createdon`, `lastmodifiedon`, `apmiddleinspectiondatenareason`, `apfirstinspectiondatenareason`, `qcuser`, `classcodeseq`) VALUES
(5427, 'TERRY', '27287-B3', 'Open PO', 'LJJ1084', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5428, 'NIKO', '27286-B6', 'Open PO', 'LAN252L', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM,IM NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:46:14', NULL, NULL, 20, 6),
(5429, 'OWEN', '27287-B', 'Open PO', 'LAZ238HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5430, 'JONES', '27385', 'Open PO', 'QTT294ABB', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-12', '2019-07-12', NULL, NULL, '2019-06-01', '2019-06-11', '2019-06-25', '2019-07-10', NULL, NULL, '2019-05-15', '2019-06-07', '2019-7-12: INSPECTED BY JACKY,\nQC ISSUES,PENDING.', NULL, 23, '2019-06-15', '2019-07-13 02:05:50', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 14),
(5431, 'NIKO', '27088', 'Open PO', 'QWR470SLR', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-13: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-15 01:28:21', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5432, 'NIKO', '27088', 'Open PO', 'QWR860SLR', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', NULL, NULL, 23, '2019-06-15', '2019-07-08 08:01:38', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5433, 'NIKO', '27088', 'Open PO', 'QWR804', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', NULL, NULL, 23, '2019-06-15', '2019-07-08 08:01:38', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5434, 'NIKO', '27088', 'Open PO', 'QWR862SLR', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', NULL, NULL, 23, '2019-06-15', '2019-07-08 08:01:38', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5435, 'NIKO', '27088', 'Open PO', 'QWR482', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-13: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-15 01:28:21', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5436, 'NIKO', '27088', 'Open PO', 'QWR476SLR', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-09', '2019-07-13', NULL, NULL, '2019-06-03', '2019-06-07', '2019-7-13: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-15 01:28:21', 'produced_in_sub_asse', 'produced_in_sub_asse', 20, 9),
(5437, 'JOY', '27287-B9', 'Open PO', 'JFH1042', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-01', '2019-07-01', NULL, NULL, '2019-04-15', '2019-06-28', '2019-06-27', '2019-06-28', NULL, NULL, '2019-05-16', '2019-05-31', NULL, 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:07:47', NULL, NULL, 22, 16),
(5438, 'RICHARD', '27287B10', 'Open PO', 'ZNB106M-HH-CC', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HANGTAG NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 51),
(5439, 'JOY', '27082', 'Open PO', 'NCY106', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-25', '2019-06-26', '2019-06-21', '2019-06-12', '2019-05-01', '2019-06-06', '2019-06-27', '2019-06-28', '2019-06-22', '2019-06-14', '2019-05-09', '2019-05-24', '2019-6-26: INSPECTED BY JOY,', 'REJECTED', 23, '2019-06-15', '2019-07-03 06:29:47', NULL, NULL, 22, 8),
(5440, 'JOY', '27082', 'Open PO', 'NCY298', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-11', '2019-06-12', '2019-06-06', NULL, '2019-05-01', '2019-06-06', '2019-06-04', '2019-06-05', '2019-05-31', NULL, '2019-05-02', '2019-05-23', '2019-6-12: INSPECTED BY JOY', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:33:32', NULL, NULL, 22, 8),
(5441, 'JOY', '27082', 'Open PO', 'NCY324', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-11', '2019-06-12', '2019-06-06', NULL, '2019-05-01', '2019-06-06', '2019-06-04', '2019-06-05', '2019-05-31', NULL, '2019-05-01', '2019-05-16', '2019-6-12: INSPECTED BY JOY', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:33:32', NULL, NULL, 22, 8),
(5442, 'JOY', '27082', 'Open PO', 'NCY246', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-25', '2019-06-26', '2019-06-21', '2019-06-12', '2019-05-01', '2019-06-06', '2019-06-27', '2019-06-28', '2019-06-22', '2019-06-14', '2019-05-09', '2019-05-24', '2019-6-26: INSPECTED BY JOY,', 'REJECTED', 23, '2019-06-15', '2019-07-03 06:26:59', NULL, NULL, 22, 8),
(5443, 'JOY', '27072', 'Open PO', 'BAZ156', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-25', '2019-06-26', '2019-06-21', '2019-06-12', '2019-05-01', '2019-06-06', '2019-06-27', '2019-06-28', '2019-06-22', '2019-06-14', '2019-05-16', '2019-05-31', '2019-6-26: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:30:18', NULL, NULL, 22, 8),
(5444, 'JONES', '27287-B7', 'Open PO', 'SLL1933A', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 23, '2019-06-15', '2019-07-03 08:28:50', NULL, NULL, 21, 37),
(5445, 'TERRY', '27287-B4', 'Open PO', 'QLP1103BB', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QLP1208A RECEIVED BUT WAIT QLP1103BB', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5446, 'TERRY', '27287-B4', 'Open PO', 'QLP1208A', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-20', '2019-06-24', NULL, NULL, '2019-05-02', '2019-05-22', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-24: INSPECTED BY TERRY', 'ACCEPTED', 23, '2019-06-15', '2019-06-24 10:05:50', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5447, 'TERRY', '27286B10', 'Open PO', 'QLP1013ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, '2019-05-02', '2019-05-31', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-6-27: INSPECTED BY TERRY,', NULL, 23, '2019-06-15', '2019-07-08 07:24:30', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5448, 'TERRY', '27286B10', 'Open PO', 'QLP1200ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-06', '2019-05-31', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:17:35', 'small_quantities', 'small_quantities', 10, 4),
(5449, 'TERRY', '27286B10', 'Open PO', 'QLP1204ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-06', '2019-05-31', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:17:35', 'small_quantities', 'small_quantities', 10, 4),
(5450, 'TERRY', '27286B10', 'Open PO', 'QLP816ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-02', '2019-05-31', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-6-27: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-27 10:13:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5451, 'TERRY', '27286B10', 'Open PO', 'QLP931ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-02', '2019-05-31', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-6-27: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-27 10:13:55', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5452, 'TERRY', '27286B10', 'Open PO', 'QLP1174ABB-S-TM', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-06', '2019-05-31', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-16', '2019-05-31', 'NEW ITEM, NO GRAPHICS\n2019-7-9: INSPECTED BY OWEN,\nPAINTING DEFECTIVES.', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:39:59', 'small_quantities', 'small_quantities', 10, 4),
(5453, 'RICHARD', '27286-B9', 'Open PO', 'CIM304HH-L', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5454, 'RICHARD', '27286-B9', 'Open PO', 'CIM304HH-S', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5455, 'RICHARD', '27286-B9', 'Open PO', 'CIM306HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5456, 'RICHARD', '27589-S', 'Open PO', 'CIM220HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5457, 'RICHARD', '27589-S', 'Open PO', 'CIM224HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5458, 'RICHARD', '27589-S', 'Open PO', 'CIM226HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5459, 'RICHARD', '27589-S', 'Open PO', 'CIM302HH-S', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5460, 'RICHARD', '27589-S', 'Open PO', 'CIM304HH-L', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5461, 'RICHARD', '27589-S', 'Open PO', 'CIM306HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5462, 'NIKO', '27286-B3', 'Open PO', 'BST104A', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-06', '2019-07-06', NULL, NULL, '2019-06-03', '2019-05-22', '2019-07-05', '2019-07-06', NULL, NULL, '2019-05-31', '2019-07-05', '2019-7-6: INSPECTED BY JONES, ', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:14:59', 'for_distance', 'for_distance', 20, 52),
(5463, 'RICHARD', '27286-B8', 'Open PO', 'CHT894', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 50),
(5464, 'RICHARD', '27588-S', 'Open PO', 'CHT894', '2019-08-04', '2019-07-21', '2019-07-25', '2019-07-20', '2019-06-30', '2019-06-20', '2019-07-05', '2019-07-04', '2019-07-05', NULL, NULL, '2019-06-01', '2019-03-23', '2019-07-05', '2019-07-12', NULL, NULL, '2019-05-02', '2019-03-23', '2019-7-5: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 05:56:01', 'for_distance', 'for_distance', 3, 50),
(5465, 'JACKY', '27295', 'Open PO', 'ORS728', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 25),
(5466, 'JACKY', '27295', 'Open PO', 'ORS730', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 17, 25),
(5467, 'JACKY', '27286-B', 'Open PO', 'ORS780BB', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-09', '2019-06-06', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 07:31:51', 'small_quantities', 'small_quantities', 17, 25),
(5468, 'JACKY', '27286-B', 'Open PO', 'ORS782BB', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-09', '2019-06-06', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 07:45:52', 'small_quantities', 'small_quantities', 17, 25),
(5469, 'JACKY', '27286-B', 'Open PO', 'ORS784BB', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-09', '2019-06-06', '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 07:48:02', 'small_quantities', 'small_quantities', 17, 25),
(5470, 'NIKO', '27606', 'Open PO', 'LPA108L-GN', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:49:25', NULL, NULL, 20, 23),
(5471, 'NIKO', '27606', 'Open PO', 'LPA108L-RD', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:49:25', NULL, NULL, 20, 23),
(5472, 'NIKO', '27606', 'Open PO', 'LPA108L-SL', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:49:25', NULL, NULL, 20, 23),
(5473, 'NIKO', '27286-B4', 'Open PO', 'COR108MC', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:18:42', 'for_distance', 'for_distance', 20, 23),
(5474, 'NIKO', '27286-B4', 'Open PO', 'COR190A', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:18:22', 'for_distance', 'for_distance', 20, 23),
(5475, 'NIKO', '27286-B4', 'Open PO', 'COR192A', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-23', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:18:07', 'for_distance', 'for_distance', 20, 23),
(5476, 'NIKO', '27605-S', 'Open PO', 'COR190A', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-09', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:19:30', 'for_distance', 'for_distance', 20, 23),
(5477, 'NIKO', '27605-S', 'Open PO', 'COR192A', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-09', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:19:44', 'for_distance', 'for_distance', 20, 23),
(5478, 'NIKO', '27286-B5', 'Open PO', 'CRD111S-GN', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:24:29', NULL, NULL, 20, 22),
(5479, 'NIKO', '27286-B5', 'Open PO', 'CRD111S-RD', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:21:24', NULL, NULL, 20, 22),
(5480, 'NIKO', '27286-B5', 'Open PO', 'CRD111S-SL', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:21:24', NULL, NULL, 20, 22),
(5481, 'NIKO', '27286-B2', 'Open PO', 'BCM104HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-25', '2019-06-04', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-27: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:14:17', 'for_distance', 'for_distance', 20, 53),
(5482, 'RICHARD', '27279-B3', 'Open PO', 'EUT200MC-4-TM', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-06', NULL, '2019-07-06', '2019-07-10', NULL, NULL, '2019-05-08', '2019-05-26', NULL, NULL, 23, '2019-06-15', '2019-07-13 03:49:26', 'for_distance', 'for_distance', 3, 3),
(5483, 'RICHARD', '27281-B3', 'Open PO', 'EUT200MC-4-TM', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-06', NULL, '2019-07-06', '2019-07-10', NULL, NULL, '2019-05-08', '2019-05-26', NULL, NULL, 23, '2019-06-15', '2019-07-13 03:50:04', 'for_distance', 'for_distance', 3, 3),
(5484, 'NIKO', '27585-S', 'Open PO', 'BCM104HH', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-24', '2019-06-04', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-27: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:14:44', 'for_distance', 'for_distance', 20, 53),
(5485, 'JONES', '26908', 'Open PO', 'WIN316', '2019-06-09', '2019-05-26', '2019-05-30', '2019-05-25', '2019-05-05', '2019-04-25', '2019-05-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 23, '2019-06-15', '2019-07-03 08:10:03', NULL, NULL, 21, 7),
(5486, 'JONES', '26911', 'Open PO', 'WIN582', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 08:10:29', NULL, NULL, 21, 7),
(5487, 'JONES', '27957', 'Open PO', 'WIN316', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-16', NULL, '2019-06-16', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-2: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:03:07', NULL, NULL, 21, 7),
(5488, 'JONES', '27957', 'Open PO', 'WIN558', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-16', NULL, '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-2: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:03:07', NULL, NULL, 21, 7),
(5489, 'JONES', '27957', 'Open PO', 'WIN634', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-31', NULL, '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-16', NULL, '2019-7-8: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 09:34:58', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 7),
(5490, 'NIKO', '27286-B7', 'Open PO', 'WDS102', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:49:11', NULL, NULL, 20, 54),
(5491, 'OWEN', '27287-B8', 'Open PO', 'WTJ236ABB', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-09', '2019-05-23', '2019-06-17', '2019-06-18', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-3: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:14:01', 'small_quantities', 'small_quantities', 19, 42),
(5492, 'OWEN', '27094', 'Open PO', 'USA1368', '2019-06-16', '2019-06-02', '2019-06-06', '2019-06-01', '2019-05-12', '2019-05-02', '2019-05-17', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-02', '2019-05-31', '2019-06-16', '2019-06-24', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-2: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 10:02:20', 'small_quantities', 'small_quantities', 19, 46),
(5493, 'JOY', '27075', 'Open PO', 'JUM208', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JUM208,JUM232 NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:54:25', NULL, NULL, 22, 31),
(5494, 'JOY', '27075', 'Open PO', 'JUM232', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JUM208,JUM232 NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:54:25', NULL, NULL, 22, 31),
(5495, 'JOY', '27075', 'Open PO', 'JUM238', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JUM208,JUM232 NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:54:25', NULL, NULL, 22, 31),
(5496, 'JACKY', '27785', 'Open PO', 'BEH206HH', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-01', '2019-07-01', NULL, NULL, '2019-05-16', '2019-05-24', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-1: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 08:36:54', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 34),
(5497, 'JACKY', '27785', 'Open PO', 'BEH200HH', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-01', '2019-07-01', NULL, NULL, '2019-05-02', '2019-05-24', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-16', '2019-05-17', '2019-7-1: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 08:34:47', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 34),
(5498, 'TERRY', '27802', 'Open PO', 'WQA1024ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-09', NULL, '2019-7-9: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 01:55:41', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5499, 'TERRY', '27802', 'Open PO', 'WQA1028ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-09', NULL, '2019-7-9: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 01:55:41', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5500, 'TERRY', '27802', 'Open PO', 'WQA1238ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-05', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-09', '2019-06-14', '2019-7-9: INSPECTED BY JACKY,', NULL, 23, '2019-06-15', '2019-07-09 06:51:39', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5501, 'TERRY', '27802', 'Open PO', 'WQA1302', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-06', '2019-07-06', NULL, NULL, '2019-05-16', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-09', '2019-06-14', '2019-7-6: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:51:22', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5502, 'JACKY', '27804', 'Open PO', 'YHL248HH', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-13', '2019-05-31', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-02', '2019-05-31', '2019-6-26: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-26 10:13:00', 'small_quantities', 'small_quantities', 17, 43),
(5503, 'NIKO', '27796', 'Open PO', 'SLZ136BB-48', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:41:53', NULL, NULL, 20, 45),
(5504, 'NIKO', '27932', 'Open PO', 'LAN106', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PPS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:53:19', NULL, NULL, 20, 6),
(5505, 'TERRY', '27792', 'Open PO', 'QLP1200ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-03', '2019-05-31', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:30:35', 'small_quantities', 'small_quantities', 10, 4),
(5506, 'TERRY', '27792', 'Open PO', 'QLP1204ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-03', '2019-05-31', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:30:35', 'small_quantities', 'small_quantities', 10, 4),
(5507, 'TERRY', '27792', 'Open PO', 'QLP1174ABB-S-TM', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-03', '2019-05-31', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-9: INSPECTED BY OWEN,\nPAINTING DEFECTIVES.', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:42:12', 'small_quantities', 'small_quantities', 10, 4),
(5508, 'TERRY', '27792', 'Open PO', 'QLP1013ABB', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-09', '2019-05-31', '2019-06-20', '2019-06-21', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-27: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-27 10:12:32', 'small_quantities', 'small_quantities', 10, 4),
(5509, 'JOY', '27809', 'Open PO', 'QFC106', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:36:35', NULL, NULL, 22, 13),
(5510, 'RICHARD', '27787', 'Open PO', 'CIM304HH-S', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5511, 'RICHARD', '27787', 'Open PO', 'CIM226HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5512, 'RICHARD', '27787', 'Open PO', 'CIM228HH-L', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5513, 'RICHARD', '27787', 'Open PO', 'CIM302HH-S', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5514, 'RICHARD', '27787', 'Open PO', 'CIM220HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5515, 'RICHARD', '27787', 'Open PO', 'CIM224HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5516, 'RICHARD', '27787', 'Open PO', 'CIM306HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 38),
(5517, 'JACKY', '27790', 'Open PO', 'ORS782BB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-16', '2019-06-06', '2019-06-21', '2019-06-21', NULL, NULL, '2019-06-06', '2019-06-21', 'INSPECTED BY NIKO', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 06:27:15', 'small_quantities', 'small_quantities', 17, 25),
(5518, 'JACKY', '27790', 'Open PO', 'ORS780BB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-16', '2019-06-06', '2019-06-21', '2019-06-21', NULL, NULL, '2019-06-06', '2019-06-06', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 06:29:45', 'small_quantities', 'small_quantities', 17, 25),
(5519, 'JACKY', '27790', 'Open PO', 'ORS784BB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-16', '2019-06-06', '2019-06-21', '2019-06-21', NULL, NULL, '2019-06-06', '2019-06-21', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 06:36:02', 'small_quantities', 'small_quantities', 17, 25),
(5520, 'NIKO', '27282-B7', 'Open PO', 'CRD111S-SL', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:23:59', NULL, NULL, 20, 22),
(5521, 'NIKO', '27282-B7', 'Open PO', 'CRD111S-GD', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:23:59', NULL, NULL, 20, 22),
(5522, 'NIKO', '27291-B4', 'Open PO', 'CRD111S-SL', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:23:32', NULL, NULL, 20, 22),
(5523, 'NIKO', '27291-B4', 'Open PO', 'CRD111S-GD', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:23:32', NULL, NULL, 20, 22),
(5524, 'NIKO', '27784', 'Open PO', 'BCM104HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-17', '2019-06-04', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-27: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:15:08', 'for_distance', 'for_distance', 20, 53),
(5525, 'OWEN', '27292-B4', 'Open PO', 'LAZ238HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5526, 'OWEN', '27292-B4', 'Open PO', 'LAZ228HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5527, 'OWEN', '27292-B4', 'Open PO', 'LAZ240HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5528, 'OWEN', '27292-B4', 'Open PO', 'LAZ242HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5529, 'OWEN', '27290-B4', 'Open PO', 'LAZ238HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5530, 'OWEN', '27278-B3', 'Open PO', 'LAZ228HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5531, 'OWEN', '27278-B3', 'Open PO', 'LAZ240HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5532, 'OWEN', '27278-B3', 'Open PO', 'LAZ242HH', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 19, 28),
(5533, 'OWEN', '27782', 'Open PO', 'LKP321ABB', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-07-09', '2019-07-09', NULL, NULL, '2019-05-31', NULL, '2019-07-01', '2019-07-04', NULL, NULL, '2019-05-15', NULL, 'OLD ITEM,NO UPDATE\n2019-7-9: INSPECTED BY TERRY,\nDROP TEST FAILED.', 'PENDING', 23, '2019-06-15', '2019-07-10 02:07:01', 'small_quantities', 'small_quantities', 21, 55),
(5534, 'JOY', '26969-2', 'Open PO', 'WAC408', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:59:51', NULL, NULL, 22, 16),
(5535, 'JOY', '27831', 'Open PO', 'GXT266', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-11', '2019-07-12', NULL, NULL, '2019-05-19', NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-08 03:32:46', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5536, 'JOY', '27967', 'Open PO', 'WAC208', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, '2019-07-10', NULL, '2019-06-10', NULL, '2019-07-11', '2019-07-12', '2019-07-01', NULL, '2019-05-22', NULL, '2019-7-10: INSPECTED BY JOY,\nPAINTING DONE,NO PACKED.', NULL, 23, '2019-06-15', '2019-07-10 09:18:45', NULL, 'produced_in_sub_asse', 22, 16),
(5537, 'TERRY', '27760-B', 'Open PO', 'SLC131', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5538, 'TERRY', '27755-B', 'Open PO', 'SLC131', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5539, 'TERRY', '27758-B', 'Open PO', 'SLC131', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5540, 'TERRY', '27710-B', 'Open PO', 'QLP1103BB', '2019-08-25', '2019-08-11', '2019-08-15', '2019-08-10', '2019-07-21', '2019-07-11', '2019-07-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5541, 'TERRY', '27710-B', 'Open PO', 'QLP1196A', '2019-08-25', '2019-08-11', '2019-08-15', '2019-08-10', '2019-07-21', '2019-07-11', '2019-07-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5542, 'TERRY', '27710-B', 'Open PO', 'QLP816ABB', '2019-08-25', '2019-08-11', '2019-08-15', '2019-08-10', '2019-07-21', '2019-07-11', '2019-07-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5543, 'TERRY', '27710-B', 'Open PO', 'SLC104A', '2019-08-25', '2019-08-11', '2019-08-15', '2019-08-10', '2019-07-21', '2019-07-11', '2019-07-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5544, 'RICHARD', '27294', 'Open PO', 'MAW102BB-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-13', NULL, '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-16', '2019-06-14', '2019-7-15: INSPECTED BY RICHARD,', NULL, 23, '2019-06-15', '2019-07-15 02:31:40', 'for_distance', 'for_distance', 3, 56),
(5545, 'TERRY', '27583B13', 'Open PO', 'QLP1013ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-04', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-07-03', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-7-4: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-12 02:15:55', 'small_quantities', 'small_quantities', 10, 4),
(5546, 'TERRY', '27583B13', 'Open PO', 'QLP1103BB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-04', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-07-03', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-7-4: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 07:32:41', NULL, NULL, 10, 4),
(5547, 'TERRY', '27583B13', 'Open PO', 'QLP1200ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-12', NULL, NULL, '2019-06-01', NULL, '2019-07-03', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-7-12: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-13 01:12:31', 'small_quantities', 'small_quantities', 10, 4),
(5548, 'TERRY', '27583B13', 'Open PO', 'QLP1203ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-12', NULL, NULL, '2019-06-01', NULL, '2019-07-03', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-7-12: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-13 01:12:47', 'small_quantities', 'small_quantities', 10, 4),
(5549, 'TERRY', '27583B13', 'Open PO', 'QLP816ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-04', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-07-03', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-7-4: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 07:32:41', NULL, NULL, 10, 4),
(5550, 'TERRY', '27583B13', 'Open PO', 'SLC104A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-12', NULL, NULL, '2019-05-31', NULL, '2019-07-03', '2019-07-04', NULL, NULL, '2019-05-16', '2019-06-07', '2019-7-12: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-13 01:11:53', 'small_quantities', 'small_quantities', 10, 4),
(5551, 'TERRY', '27578', 'Open PO', 'SLC131BB-9', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-03', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-09', NULL, '2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:27:12', NULL, NULL, 10, 4),
(5552, 'TERRY', '27140', 'Open PO', 'QLP1103BB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, '2019-06-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-06-21 05:28:13', NULL, NULL, 10, 4),
(5553, 'TERRY', '27140', 'Open PO', 'SLC131BB-9', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-03', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', NULL, '2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:25:42', NULL, NULL, 10, 4),
(5554, 'TERRY', '27140', 'Open PO', 'QLP1208A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-03', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', NULL, '2019-7-9: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:25:42', NULL, NULL, 10, 4),
(5555, 'NIKO', '27583-B8', 'Open PO', 'SLZ136BB-48', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:42:32', NULL, NULL, 20, 45),
(5556, 'RICHARD', '27112', 'Open PO', 'AUH164', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-10', NULL, '2019-07-18', '2019-07-19', NULL, NULL, '2019-05-09', '2019-04-15', NULL, NULL, 23, '2019-06-15', '2019-07-13 03:53:16', 'for_distance', 'for_distance', 3, 57),
(5557, 'RICHARD', '27112', 'Open PO', 'AUH166', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-10', NULL, '2019-07-18', '2019-07-19', NULL, NULL, '2019-05-09', '2019-04-15', NULL, NULL, 23, '2019-06-15', '2019-07-13 03:53:16', 'for_distance', 'for_distance', 3, 57),
(5558, 'JACKY', '27583B18', 'Open PO', 'BEH200HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-01', NULL, NULL, '2019-05-16', '2019-05-31', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-1: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 08:38:48', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 34),
(5559, 'JACKY', '27583B18', 'Open PO', 'BEH206HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-01', NULL, NULL, '2019-05-16', '2019-05-31', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-1: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 08:40:18', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 34),
(5560, 'JACKY', '27583-B', 'Open PO', 'BKY140AHH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-16', '2019-06-07', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-20', '2019-06-07', '2019-6-25: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-28 01:18:12', 'small_quantities', 'small_quantities', 17, 58),
(5561, 'JACKY', '27586-S', 'Open PO', 'BKY140AHH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-16', '2019-06-07', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-20', '2019-06-07', '2019-6-25: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-28 01:17:30', 'small_quantities', 'small_quantities', 17, 58),
(5562, 'NIKO', '27583-B4', 'Open PO', 'BST104A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-06', '2019-07-06', NULL, NULL, '2019-06-03', '2019-05-22', '2019-07-05', '2019-07-06', NULL, NULL, '2019-05-31', '2019-07-05', '2019-7-6: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:17:46', 'for_distance', 'for_distance', 20, 52);
INSERT INTO `qcschedules` (`seq`, `qc`, `po`, `potype`, `itemnumbers`, `shipdate`, `screadydate`, `scfinalinspectiondate`, `scmiddleinspectiondate`, `scfirstinspectiondate`, `scproductionstartdate`, `scgraphicsreceivedate`, `acreadydate`, `acfinalinspectiondate`, `acmiddleinspectiondate`, `acfirstinspectiondate`, `acproductionstartdate`, `acgraphicsreceivedate`, `apreadydate`, `apfinalinspectiondate`, `apmiddleinspectiondate`, `apfirstinspectiondate`, `approductionstartdate`, `apgraphicsreceivedate`, `notes`, `status`, `userseq`, `createdon`, `lastmodifiedon`, `apmiddleinspectiondatenareason`, `apfirstinspectiondatenareason`, `qcuser`, `classcodeseq`) VALUES
(5563, 'NIKO', '27587-S', 'Open PO', 'BST104A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-06', '2019-07-06', NULL, NULL, '2019-06-03', '2019-05-22', '2019-07-05', '2019-07-06', NULL, NULL, '2019-05-31', '2019-06-07', '2019-7-6: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:23:44', 'for_distance', 'for_distance', 20, 52),
(5564, 'RICHARD', '27583B11', 'Open PO', 'CHT894', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-09', '2019-07-10', NULL, NULL, '2019-05-31', '2019-03-23', '2019-07-05', '2019-07-12', NULL, NULL, '2019-05-02', '2019-03-23', '2019-7-10: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 10:06:36', 'for_distance', 'for_distance', 3, 50),
(5565, 'RICHARD', '27583B12', 'Open PO', 'CIM220HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5566, 'RICHARD', '27583B12', 'Open PO', 'CIM224HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5567, 'RICHARD', '27583B12', 'Open PO', 'CIM226HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5568, 'RICHARD', '27583B12', 'Open PO', 'CIM252HH-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5569, 'RICHARD', '27583B12', 'Open PO', 'CIM254TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5570, 'RICHARD', '27583B12', 'Open PO', 'CIM302HH-S', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5571, 'RICHARD', '27583B12', 'Open PO', 'CIM304HH-L', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5572, 'RICHARD', '27583B12', 'Open PO', 'CIM306HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-10', '2019-07-11', NULL, NULL, '2019-06-01', '2019-04-10', '2019-07-04', '2019-07-11', NULL, NULL, '2019-05-16', '2019-04-10', '2019-7-11: INSPECTED BY RICHARD,', 'PENDING', 23, '2019-06-15', '2019-07-11 11:00:30', 'for_distance', 'for_distance', 3, 38),
(5573, 'NIKO', '27117', 'Open PO', 'COR152', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:51:57', NULL, NULL, 20, 23),
(5574, 'NIKO', '27117', 'Open PO', 'COR162MC', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:51:57', NULL, NULL, 20, 23),
(5575, 'NIKO', '27573', 'Open PO', 'COR152', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 06:52:42', NULL, NULL, 20, 23),
(5576, 'NIKO', '27583-B5', 'Open PO', 'COR174A-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-16', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:21:11', 'for_distance', 'for_distance', 20, 23),
(5577, 'NIKO', '27583-B5', 'Open PO', 'COR190A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-16', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:20:51', 'for_distance', 'for_distance', 20, 23),
(5578, 'NIKO', '27583-B5', 'Open PO', 'COR192A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-28', '2019-07-03', NULL, NULL, '2019-05-16', '2019-06-11', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:20:39', 'for_distance', 'for_distance', 20, 23),
(5579, 'NIKO', '27583-B6', 'Open PO', 'CRD111S-GD', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:22:48', NULL, NULL, 20, 22),
(5580, 'NIKO', '27583-B6', 'Open PO', 'CRD111S-SL', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:22:48', NULL, NULL, 20, 22),
(5581, 'NIKO', '27583-B6', 'Open PO', 'CRD128MC', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:22:48', NULL, NULL, 20, 22),
(5582, 'NIKO', '27583-B6', 'Open PO', 'CRD128WW', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:22:48', NULL, NULL, 20, 22),
(5583, 'JACKY', '27583B23', 'Open PO', 'DUZ140ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', '2019-07-02', NULL, '2019-06-03', NULL, '2019-07-01', '2019-07-02', '2019-06-25', NULL, '2019-06-01', '2019-06-09', '2019-7-9: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 01:35:45', NULL, 'produced_in_sub_asse', 17, 59),
(5584, 'OWEN', '27583B24', 'Open PO', 'HEH316ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-16', NULL, NULL, NULL, 23, '2019-06-15', '2019-07-13 04:02:13', 'small_quantities', 'small_quantities', 19, 60),
(5585, 'OWEN', '27583B24', 'Open PO', 'HEH330ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-16', NULL, NULL, NULL, 23, '2019-06-15', '2019-07-13 04:02:13', 'small_quantities', 'small_quantities', 19, 60),
(5586, 'JACKY', '27583-B2', 'Open PO', 'ORS780BB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-16', '2019-06-06', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 08:03:50', 'small_quantities', 'small_quantities', 17, 25),
(5587, 'JACKY', '27583-B2', 'Open PO', 'ORS782BB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-16', '2019-06-06', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 08:05:38', 'small_quantities', 'small_quantities', 17, 25),
(5588, 'JACKY', '27583-B2', 'Open PO', 'ORS784BB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-16', '2019-06-06', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-06-15', '2019-07-02 08:07:30', 'small_quantities', 'small_quantities', 17, 25),
(5589, 'OWEN', '27583B19', 'Open PO', 'USA930ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-03', NULL, '2019-07-03', '2019-07-08', NULL, NULL, '2019-05-09', '2019-06-07', '2019-7-8: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-06-15', '2019-07-09 00:38:32', 'produced_in_sub_asse', 'produced_in_sub_asse', 19, 46),
(5590, 'JONES', '27583B26', 'Open PO', 'WAZ122', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-18', NULL, NULL, '2019-05-16', NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-13 03:58:32', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 61),
(5591, 'JONES', '27583B26', 'Open PO', 'WAZ124', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-18', NULL, NULL, '2019-05-16', NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-13 03:58:32', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 61),
(5592, 'NIKO', '27583-B9', 'Open PO', 'WDS102', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:50:21', NULL, NULL, 20, 54),
(5593, 'JACKY', '27583B27', 'Open PO', 'WHS106ABB-MC-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-01', '2019-06-02', '2019-07-15', '2019-07-16', NULL, NULL, '2019-05-09', '2019-06-12', NULL, NULL, 23, '2019-06-15', '2019-07-13 03:16:40', 'for_distance', 'for_distance', 17, 40),
(5594, 'JACKY', '27583B27', 'Open PO', 'WHS112MC-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-01', '2019-06-02', '2019-07-15', '2019-07-16', NULL, NULL, '2019-05-09', '2019-06-12', NULL, NULL, 23, '2019-06-15', '2019-07-13 03:16:40', 'for_distance', 'for_distance', 17, 40),
(5595, 'JACKY', '27583B27', 'Open PO', 'WHS134MC', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-01', '2019-06-02', '2019-07-15', '2019-07-16', NULL, NULL, '2019-05-09', '2019-06-12', NULL, NULL, 23, '2019-06-15', '2019-07-13 03:16:40', 'for_distance', 'for_distance', 17, 40),
(5596, 'JONES', '26912', 'Open PO', 'WIN582', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:09:13', NULL, NULL, 21, 7),
(5597, 'JONES', '27312', 'Open PO', 'WIN258', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-16', NULL, '2019-06-29', '2019-07-01', NULL, NULL, '2019-06-06', '2019-06-21', '2019-7-2: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:04:00', NULL, NULL, 21, 7),
(5598, 'TERRY', '27105', 'Open PO', 'WQA276A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-09', '2019-06-07', '2019-06-23', '2019-06-24', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-25: INSPECTED BY TERRY,\nSHIPPING MARKS DEFECTIVE,PENDING.', 'PENDING', 23, '2019-06-15', '2019-06-26 00:48:44', NULL, NULL, 10, 39),
(5599, 'TERRY', '27583B28', 'Open PO', 'WQA1024ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-06-21', '2019-7-9: INSPECTED BY TERRY,\nN.W/G.W DEFECTIVES.', 'PENDING', 23, '2019-06-15', '2019-07-10 01:51:12', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5600, 'TERRY', '27583B28', 'Open PO', 'WQA1028ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-06-21', '2019-7-9: INSPECTED BY TERRY,\nN.W/G.W DEFECTIVES.', 'PENDING', 23, '2019-06-15', '2019-07-10 01:51:12', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5601, 'TERRY', '27583B28', 'Open PO', 'WQA1238ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-05', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', NULL, '2019-7-9: INSPECTED BY JACKY,\nIM DEFECTIVES,', 'PENDING', 23, '2019-06-15', '2019-07-10 01:44:35', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5602, 'TERRY', '27583B28', 'Open PO', 'WQA1242ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-05', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', NULL, '2019-7-9: INSPECTED BY JACKY,\nIM DEFECTIVES,', 'PENDING', 23, '2019-06-15', '2019-07-10 01:44:35', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5603, 'TERRY', '27583B28', 'Open PO', 'WQA1302', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-05', '2019-07-06', NULL, NULL, '2019-05-16', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-06-21', '2019-7-6: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 08:52:45', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5604, 'TERRY', '27583B28', 'Open PO', 'WQA748', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-06-21', '2019-7-9: INSPECTED BY TERRY,\nN.W/G.W DEFECTIVES.', 'PENDING', 23, '2019-06-15', '2019-07-10 01:51:12', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39),
(5605, 'NIKO', '27583B10', 'Open PO', 'WXY142', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-30', '2019-05-22', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-16', '2019-05-22', '2019-7-9: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 02:13:00', 'for_distance', 'for_distance', 20, 41),
(5606, 'JACKY', '27583-B3', 'Open PO', 'YHL248HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-24', '2019-06-26', NULL, NULL, '2019-05-09', '2019-06-07', '2019-06-22', '2019-06-24', NULL, NULL, '2019-05-23', '2019-06-07', '2019-6-26: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-26 10:13:50', 'small_quantities', 'small_quantities', 17, 43),
(5607, 'TERRY', '27126', 'Open PO', 'KGD192ABB-CC-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-06-27', NULL, '2019-05-16', '2019-06-13', '2019-06-26', '2019-06-27', '2019-06-22', NULL, '2019-05-23', '2019-06-07', '2019-6-27: INSPECTED BY TERRY,', NULL, 23, '2019-06-15', '2019-06-27 07:29:32', NULL, 'produced_in_sub_asse', 10, 32),
(5608, 'TERRY', '27126', 'Open PO', 'KGD194ABB-CC-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-06-27', NULL, '2019-05-16', '2019-06-13', '2019-06-26', '2019-06-27', '2019-06-22', NULL, '2019-05-23', '2019-06-07', '2019-6-27ï¼š INSPECTED BY TERRY,', NULL, 23, '2019-06-15', '2019-06-27 07:32:28', NULL, 'produced_in_sub_asse', 10, 32),
(5609, 'TERRY', '27126', 'Open PO', 'KGD196ABB-CC-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-06-27', NULL, '2019-05-16', '2019-06-13', '2019-06-26', '2019-06-27', '2019-06-22', NULL, '2019-05-23', '2019-06-07', '2019-6-27: INSPECTED BY TERRY,', NULL, 23, '2019-06-15', '2019-06-27 07:33:45', NULL, 'produced_in_sub_asse', 10, 32),
(5610, 'JOY', '27583B20', 'Open PO', 'KIY318A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SM NOT SENT BY KIY', NULL, 23, '2019-06-15', '2019-07-03 08:13:26', NULL, NULL, 22, 29),
(5611, 'NIKO', '27614', 'Open PO', 'LAN153ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-05', '2019-07-10', NULL, NULL, '2019-06-01', '2019-06-21', NULL, NULL, 23, '2019-06-15', '2019-07-08 07:54:11', 'for_distance', 'for_distance', 20, 6),
(5612, 'TERRY', '27583B16', 'Open PO', 'LJJ1084', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5613, 'OWEN', '27583B22', 'Open PO', 'LKP321ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-09', '2019-07-09', NULL, NULL, '2019-05-31', NULL, '2019-07-01', '2019-07-04', NULL, NULL, '2019-05-15', '2019-06-07', 'OLD ITEM,NO UPDATE\n2019-7-9: INSPECTED BY TERRY,\nDROP TEST FAILED.', 'PENDING', 23, '2019-06-15', '2019-07-10 02:06:44', 'small_quantities', 'small_quantities', 21, 55),
(5614, 'JONES', '27700', 'Open PO', 'QTT366SLR', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT RECEIVED', NULL, 23, '2019-06-15', '2019-07-03 08:33:47', NULL, NULL, 21, 14),
(5615, 'JONES', '27298', 'Open PO', 'QTT303A', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-12', NULL, NULL, '2019-06-01', '2019-06-11', '2019-06-25', '2019-07-10', NULL, NULL, '2019-05-23', '2019-06-07', '2019-7-12: INSPECTED BY JACKY,\nQC ISSUES,PENDING.', NULL, 23, '2019-06-15', '2019-07-13 02:05:29', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 14),
(5616, 'NIKO', '27583B25', 'Open PO', 'QWR908', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-18', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-05', '2019-05-18', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:54:43', 'small_quantities', 'small_quantities', 20, 9),
(5617, 'NIKO', '27583B25', 'Open PO', 'QWR916', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-11', '2019-07-11', NULL, NULL, '2019-06-03', '2019-06-18', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-05', '2019-05-18', '2019-7-11: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-06-15', '2019-07-11 10:54:43', 'small_quantities', 'small_quantities', 20, 9),
(5618, 'NIKO', '27583B25', 'Open PO', 'QWR956', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-16', '2019-07-16', NULL, NULL, '2019-06-05', '2019-05-18', '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-05', '2019-05-18', '2019-7-16: INSPECTED BY OWEN,', NULL, 23, '2019-06-15', '2019-07-15 03:14:26', 'small_quantities', 'small_quantities', 20, 9),
(5619, 'JOY', '27110', 'Open PO', 'WTJ100L', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:05:42', NULL, NULL, 22, 16),
(5620, 'JOY', '27110', 'Open PO', 'WTJ102L', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:11:44', NULL, NULL, 22, 16),
(5621, 'JOY', '27679-2', 'Open PO', 'GEM122', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 06:55:13', NULL, NULL, 22, 16),
(5622, 'JOY', '27679-2', 'Open PO', 'GEM170', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 23, '2019-06-15', '2019-07-03 07:02:20', NULL, NULL, 22, 16),
(5623, 'TERRY', '27892-B', 'Open PO', 'SLC131CC-TM', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-12', NULL, NULL, '2019-06-03', NULL, '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-10', NULL, '2019-7-12: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-13 01:17:47', 'small_quantities', 'small_quantities', 10, 4),
(5624, 'RICHARD', '27862', 'Open PO', 'PAL3100', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5625, 'RICHARD', '27862', 'Open PO', 'PAL10300', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5626, 'RICHARD', '27862', 'Open PO', 'PAL2100', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5627, 'RICHARD', '27862', 'Open PO', 'PAL4000', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5628, 'RICHARD', '27862', 'Open PO', 'PAL5200', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5629, 'RICHARD', '27862', 'Open PO', 'PAL8000', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OLD ITEM,NO UPDATE', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 3, 20),
(5630, 'JACKY', '27775', 'Open PO', 'BKY140AHH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-16', '2019-06-07', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-20', '2019-06-07', '2019-6-25: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-06-15', '2019-06-28 01:16:58', 'small_quantities', 'small_quantities', 17, 58),
(5631, 'JACKY', '27789', 'Open PO', 'DUZ140ABB', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', '2019-07-08', '2019-07-09', '2019-07-02', NULL, '2019-06-03', NULL, '2019-07-01', '2019-07-02', '2019-06-25', NULL, '2019-06-01', NULL, '2019-7-9: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-06-15', '2019-07-10 01:35:04', NULL, 'produced_in_sub_asse', 17, 59),
(5632, 'RICHARD', '27780', 'Open PO', 'TLR102TUR', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-06', '2019-07-08', NULL, NULL, '2019-06-02', NULL, 'OLD ITEM,NO UPDATE', NULL, 23, '2019-06-15', '2019-07-08 06:04:51', 'for_distance', 'for_distance', 3, 5),
(5633, 'JONES', '27814', 'Open PO', 'WIN256', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-30', NULL, '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-16', NULL, '2019-7-8: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 09:39:29', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 7),
(5634, 'JONES', '27814', 'Open PO', 'WIN316', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-16', NULL, '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-16', '2019-05-31', '2019-7-2: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 06:02:22', NULL, NULL, 21, 7),
(5635, 'JONES', '27814', 'Open PO', 'WIN730', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-30', NULL, '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-16', NULL, '2019-7-8: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 09:39:29', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 7),
(5636, 'JONES', '27814', 'Open PO', 'WIN738', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-30', NULL, '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-16', NULL, '2019-7-8: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 09:39:29', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 7),
(5637, 'TERRY', '27779', 'Open PO', 'LJJ1086', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LJJ1086 GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5638, 'JOY', '27806', 'Open PO', 'ZEN428SLR-L-TM', '2019-07-12', '2019-06-28', '2019-07-02', '2019-06-27', '2019-06-07', '2019-05-28', '2019-06-12', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-7-15: INSPECTED BY JOY,', NULL, 23, '2019-06-15', '2019-07-15 02:49:14', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5639, 'TERRY', '27384-B', 'Open PO', 'QLP1017ABB', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5640, 'TERRY', '27384-B', 'Open PO', 'QLP1103BB', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5641, 'TERRY', '27384-B', 'Open PO', 'QLP232', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5642, 'TERRY', '27384-B', 'Open PO', 'SLC131BB-9', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5643, NULL, '27384-B3', 'Open PO', 'SLL1933A', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2019-06-15', '2019-07-03 08:29:29', NULL, NULL, 21, 37),
(5644, 'TERRY', '27581', 'Open PO', 'QLP1316SLR-2', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5645, 'TERRY', '27620', 'Open PO', 'QLP816ABB', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 4),
(5646, 'OWEN', '28152', 'Open PO', 'CPS182', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-31', '2019-06-29', '2019-06-30', '2019-07-04', NULL, NULL, '2019-05-30', '2019-06-14', '2019-7-3: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-03 09:11:26', 'small_quantities', 'small_quantities', 19, 62),
(5647, 'JONES', '27955', 'Open PO', 'WIN558', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', '2019-07-02', '2019-07-02', NULL, NULL, '2019-06-30', NULL, '2019-07-09', '2019-07-09', NULL, NULL, '2019-05-25', NULL, '2019-7-2: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-06-15', '2019-07-08 09:41:04', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 7),
(5648, 'TERRY', '28041-B2', 'Open PO', 'LJJ472A', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GRAPHICS NOT CONFIRMED', NULL, 18, '2019-06-15', '2019-06-15 06:30:00', NULL, NULL, 10, 10),
(5651, NULL, '28052', 'OPEN PO', 'WIN1068\nWIN1216\nWIN1136', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-23', '2019-06-24', NULL, NULL, '2019-05-15', '2019-05-31', '2019-06-26', '2019-06-26', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-24: INSPECTED BY OWEN,', NULL, 23, '2019-06-24', '2019-07-03 08:11:34', NULL, NULL, 21, 7),
(5652, NULL, '27805', 'OPEN PO', 'KIY102MC', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-24', '2019-06-25', NULL, NULL, '2019-05-12', '2019-04-16', '2019-06-19', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-25: INSPECTED BY JOY', 'ACCEPTED', 23, '2019-06-25', '2019-07-03 08:13:59', NULL, NULL, 22, 29),
(5653, NULL, '28150', 'OPEN PO', 'SLL2160A', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-06-25', '2019-06-26', NULL, NULL, '2019-05-18', '2019-05-31', '2019-06-19', '2019-06-20', NULL, NULL, '2019-05-16', '2019-05-31', '2019-6-26: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-06-26', '2019-07-03 08:30:04', NULL, NULL, 21, 37),
(5673, NULL, '27617-S', 'OPEN PO', 'ORS780BB\nORS782BB\nORS784BB', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-16', '2019-06-06', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-06', '2019-06-21', '2019-6-29: INSPECTED BY NIKO,', 'ACCEPTED', 23, '2019-07-02', '2019-07-03 06:06:59', 'small_quantities', 'small_quantities', 17, 25),
(5674, NULL, '27808', 'OPEN PO', 'ORS112RD', '2019-07-08', '2019-06-24', '2019-06-28', '2019-06-23', '2019-06-03', '2019-05-24', '2019-06-08', '2019-06-30', '2019-07-01', NULL, NULL, '2019-05-16', '2019-06-06', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-24', '2019-06-08', '2019-7-1: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-07-02', '2019-07-03 06:05:46', NULL, NULL, 17, 25),
(5675, NULL, '27943', 'OPEN PO', 'TIZ194BZ', '2019-07-12', '2019-06-28', '2019-07-02', '2019-06-27', '2019-06-07', '2019-05-28', '2019-06-12', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-29', NULL, '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-28', '2019-06-12', '2019-7-2: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-07-02', '2019-07-03 06:05:24', 'for_distance', 'for_distance', 20, 71),
(5676, NULL, '28050', 'OPEN PO', 'TIZ122', '2019-07-12', '2019-06-28', '2019-07-02', '2019-06-27', '2019-06-07', '2019-05-28', '2019-06-12', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-29', NULL, '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-28', '2019-06-12', '2019-7-2: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-07-02', '2019-07-03 06:05:04', 'for_distance', 'for_distance', 20, 71),
(5677, NULL, '28278', 'OPEN PO', 'TIZ112', '2019-07-12', '2019-06-28', '2019-07-02', '2019-06-27', '2019-06-07', '2019-05-28', '2019-06-12', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-29', NULL, '2019-06-28', '2019-06-29', NULL, NULL, '2019-05-28', '2019-05-29', '2019-7-2: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-07-02', '2019-07-03 06:04:43', 'for_distance', 'for_distance', 20, 71),
(5684, NULL, '28198', 'OPEN PO', 'TZL226', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-02', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-07-07', '2019-7-2: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 05:51:47', NULL, NULL, 22, 66),
(5685, NULL, '28198', 'OPEN PO', 'TZL240', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-02', '2019-07-03', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:02:45', NULL, 'produced_in_sub_asse', 22, 66),
(5686, NULL, '28198', 'OPEN PO', 'TZL268', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-02', '2019-07-03', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:03:52', NULL, 'produced_in_sub_asse', 22, 66),
(5687, NULL, '28198', 'OPEN PO', 'TZL292', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-02', '2019-07-03', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:04:19', NULL, 'produced_in_sub_asse', 22, 66),
(5688, NULL, '28198', 'OPEN PO', 'TZL154', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-02', '2019-07-03', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:04:41', NULL, 'produced_in_sub_asse', 22, 66),
(5689, NULL, '27583-B14', 'OPEN PO', 'SOT268ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-02', '2019-07-03', NULL, NULL, '2019-05-23', '2019-05-07', '2019-06-29', '2019-07-01', NULL, NULL, '2019-05-23', '2019-06-07', '2019-7-3: INSPECTED BY RICHARD,\nQC ISSUES, TO BE CONFIRMED BY US.', 'PENDING', 23, '2019-07-03', '2019-07-03 09:50:17', 'small_quantities', 'small_quantities', 10, 21),
(5690, NULL, '27698-A2,27703-A2', 'OPEN PO', 'DUZ108ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-05', '2019-06-28', '2019-06-20', '2019-05-30', '2019-05-14', '2019-07-01', '2019-07-02', '2019-06-12', '2019-06-03', '2019-05-31', '2019-06-21', '2019-7-5: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-10 01:38:05', NULL, NULL, 17, 59),
(5693, NULL, '27705-A', 'OPEN PO', 'DUZ108ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-03', '2019-07-05', '2019-06-28', '2019-06-20', '2019-05-30', '2019-05-14', '2019-07-01', '2019-07-02', '2019-06-25', '2019-06-17', '2019-05-17', '2019-05-11', '2019-7-5: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-10 01:37:36', NULL, NULL, 17, 59),
(5694, NULL, '27706-A', 'OPEN PO', 'DUZ108ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-03', '2019-07-05', '2019-06-28', '2019-06-20', '2019-05-30', '2019-05-14', '2019-07-01', '2019-07-02', '2019-06-25', '2019-06-17', '2019-05-27', '2019-05-11', '2019-7-5: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-10 01:36:53', NULL, NULL, 17, 59),
(5698, NULL, '28198', 'OPEN PO', 'TZL242', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-02', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-07-07', '2019-7-2: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:09:02', NULL, 'produced_in_sub_asse', 22, 66),
(5699, NULL, '28198', 'OPEN PO', 'TZL250', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-02', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-07-07', '2019-7-2: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:09:02', NULL, 'produced_in_sub_asse', 22, 66),
(5700, NULL, '28198', 'OPEN PO', 'TZL272', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-02', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-07-07', '2019-7-2: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:09:03', NULL, 'produced_in_sub_asse', 22, 66),
(5701, NULL, '28198', 'OPEN PO', 'TZL284', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-01', '2019-07-02', '2019-06-19', NULL, '2019-06-01', NULL, '2019-06-26', '2019-06-27', '2019-06-17', NULL, '2019-05-23', '2019-07-07', '2019-7-2: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-03', '2019-07-03 09:09:03', NULL, 'produced_in_sub_asse', 22, 66),
(5707, NULL, '28041-B', 'OPEN PO', 'YEN160HH-BL', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', '2019-07-09', '2019-07-10', NULL, NULL, '2019-06-03', NULL, '2019-07-07', '2019-07-09', NULL, NULL, '2019-06-01', NULL, 'GRAPHICS: OLD ITEM,NO UPDATE\n2019-7-10: INSPECTED BY JACKY,', NULL, 23, '2019-07-08', '2019-07-10 03:53:01', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 18),
(5708, NULL, '28041-B', 'OPEN PO', 'YEN162HH-RD', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', '2019-07-09', '2019-07-10', NULL, NULL, '2019-06-03', NULL, '2019-07-07', '2019-07-09', NULL, NULL, '2019-06-01', NULL, 'GRAPHICS: OLD ITEM,NO UPDATE\n2019-7-10: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-07-08', '2019-07-11 01:29:47', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 18),
(5709, NULL, '27930', 'OPEN PO', 'NCY298', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-11', '2019-07-12', '2019-06-21', '2019-06-12', '2019-06-03', NULL, '2019-07-08', '2019-07-08', '2019-06-21', '2019-07-12', '2019-05-01', NULL, '2019-7-8: INSPECTED BY JOY,\nQC ISSUES FOUND,PENDING.\n2019-7-12: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-08', '2019-07-12 09:54:57', NULL, NULL, 22, 8),
(5710, NULL, '27303-2', 'OPEN PO', 'WTJ100L', '2019-06-30', '2019-06-16', '2019-06-20', '2019-06-15', '2019-05-26', '2019-05-16', '2019-05-31', '2019-07-07', '2019-07-07', NULL, NULL, '2019-06-03', NULL, '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-13', NULL, '2019-7-7: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-08', '2019-07-08 09:01:51', NULL, NULL, 22, 16),
(5711, NULL, '27703-A3', 'OPEN PO', 'WTJ104L-201', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-07-16', '2019-07-19', '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-7-11: INSPECTED BY JOY,\nCOLOR PAINTING IN PROGRESS,LABEL/CARTON/POLYFOAM IN PLACE.', NULL, 23, '2019-07-08', '2019-07-11 10:24:33', NULL, NULL, 22, 16),
(5712, NULL, '27705-A2', 'OPEN PO', 'WTJ104L-201', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-07-16', '2019-07-19', '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-7-11: INSPECTED BY JOY,\nCOLOR PAINTING IN PROGRESS,LABEL/CARTON/POLYFOAM IN PLACE.', NULL, 23, '2019-07-08', '2019-07-11 10:24:57', NULL, NULL, 22, 16),
(5713, NULL, '27706-A2', 'OPEN PO', 'WTJ104L-201', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-07-16', '2019-07-19', '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-7-11: INSPECTED BY JOY,\nCOLOR PAINTING IN PROGRESS,LABEL/CARTON/POLYFOAM IN PLACE.', NULL, 23, '2019-07-08', '2019-07-11 10:25:23', NULL, NULL, 22, 16),
(5714, NULL, '27698-A3', 'OPEN PO', 'WTJ104L-201', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-07-16', '2019-07-19', '2019-06-04', '2019-05-15', '2019-04-11', '2019-05-14', '2019-7-11: INSPECTED BY JOY,\nCOLOR PAINTING IN PROGRESS,LABEL/CARTON/POLYFOAM IN PLACE.', NULL, 23, '2019-07-08', '2019-07-11 10:25:52', NULL, NULL, 22, 16),
(5715, NULL, '26915', 'OPEN PO', 'TLR102LBR', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-03', NULL, '2019-07-06', '2019-07-08', NULL, NULL, '2019-04-30', NULL, '2019-7-12: INSPECTED BY RICHARD,\nPACKAGING NOT READY,PENDING.', NULL, 23, '2019-07-08', '2019-07-13 01:21:36', 'for_distance', 'for_distance', 3, 5),
(5716, NULL, '26915', 'OPEN PO', 'TLR102TUR', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-03', NULL, '2019-07-06', '2019-07-08', NULL, NULL, '2019-04-30', NULL, '2019-7-12: INSPECTED BY RICHARD,\nPACKAGING NOT READY,PENDING.', NULL, 23, '2019-07-08', '2019-07-13 01:21:36', 'for_distance', 'for_distance', 3, 5),
(5717, NULL, '27615-S', 'OPEN PO', 'LKP321ABB', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-09', '2019-07-09', NULL, NULL, '2019-05-31', NULL, '2019-07-01', '2019-07-04', NULL, NULL, '2019-05-15', '2019-06-21', 'OLD ITEM,NO UPDATE\n2019-7-9: INSPECTED BY TERRY,\nDROP TEST FAILED.', 'PENDING', 23, '2019-07-08', '2019-07-10 02:06:27', 'small_quantities', 'small_quantities', 21, 55),
(5718, NULL, '27788', 'OPEN PO', 'WCT1002', '2019-07-19', '2019-07-05', '2019-07-09', '2019-07-04', '2019-06-14', '2019-06-04', '2019-06-19', '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-03', '2019-06-19', '2019-07-10', '2019-07-11', NULL, NULL, '2019-05-16', '2019-06-19', '2019-7-8: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-07-08', '2019-07-08 09:31:23', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 68),
(5719, NULL, '27944', 'OPEN PO', 'WCT1002', '2019-07-19', '2019-07-05', '2019-07-09', '2019-07-04', '2019-06-14', '2019-06-04', '2019-06-19', '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-03', '2019-06-19', '2019-07-10', '2019-07-11', NULL, NULL, '2019-05-16', '2019-06-19', '2019-7-8: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-07-08', '2019-07-08 09:30:26', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 68),
(5720, NULL, '27698-A4', 'OPEN PO', 'KGD242ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-15', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', '2019-07-10', '2019-07-11', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', NULL, NULL, 23, '2019-07-08', '2019-07-13 04:12:14', NULL, NULL, 10, 32),
(5721, NULL, '27703-A4', 'OPEN PO', 'KGD242ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-15', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', '2019-07-10', '2019-07-11', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', NULL, NULL, 23, '2019-07-08', '2019-07-13 04:11:42', NULL, NULL, 10, 32),
(5722, NULL, '27705-A3', 'OPEN PO', 'KGD242ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-15', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', '2019-07-10', '2019-07-11', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', NULL, NULL, 23, '2019-07-08', '2019-07-13 04:11:12', NULL, NULL, 10, 32),
(5723, NULL, '27706-A3', 'OPEN PO', 'KGD242ABB', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-12', '2019-07-15', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', '2019-07-10', '2019-07-11', '2019-06-21', '2019-05-22', '2019-05-04', '2019-05-22', NULL, NULL, 23, '2019-07-08', '2019-07-13 04:10:38', NULL, NULL, 10, 32),
(5724, NULL, '27891-B', 'OPEN PO', 'SLC131CC-TM', '2019-08-18', '2019-08-04', '2019-08-08', '2019-08-03', '2019-07-14', '2019-07-04', '2019-07-19', '2019-07-12', '2019-07-12', NULL, NULL, '2019-05-31', NULL, '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-10', NULL, '2019-7-12: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-07-08', '2019-07-13 01:17:12', 'small_quantities', 'small_quantities', 10, 4),
(5725, NULL, '27891-B2', 'OPEN PO', '27891-B2', '2019-08-18', '2019-08-04', '2019-08-08', '2019-08-03', '2019-07-14', '2019-07-04', '2019-07-19', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-01', NULL, '2019-7-9: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-08', '2019-07-09 09:34:55', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 21),
(5726, NULL, '27892-B2', 'OPEN PO', 'SOT102TM', '2019-08-18', '2019-08-04', '2019-08-08', '2019-08-03', '2019-07-14', '2019-07-04', '2019-07-19', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-01', NULL, '2019-7-9: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-08', '2019-07-09 09:35:50', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 21),
(5727, NULL, '28328-RP', 'OPEN PO', 'RLA196', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-05-16', '2019-06-14', NULL, NULL, 23, '2019-07-08', '2019-07-08 07:49:01', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 39);
INSERT INTO `qcschedules` (`seq`, `qc`, `po`, `potype`, `itemnumbers`, `shipdate`, `screadydate`, `scfinalinspectiondate`, `scmiddleinspectiondate`, `scfirstinspectiondate`, `scproductionstartdate`, `scgraphicsreceivedate`, `acreadydate`, `acfinalinspectiondate`, `acmiddleinspectiondate`, `acfirstinspectiondate`, `acproductionstartdate`, `acgraphicsreceivedate`, `apreadydate`, `apfinalinspectiondate`, `apmiddleinspectiondate`, `apfirstinspectiondate`, `approductionstartdate`, `apgraphicsreceivedate`, `notes`, `status`, `userseq`, `createdon`, `lastmodifiedon`, `apmiddleinspectiondatenareason`, `apfirstinspectiondatenareason`, `qcuser`, `classcodeseq`) VALUES
(5728, NULL, '27308', 'OPEN PO', 'TEC106', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-03', NULL, '2019-07-09', '2019-07-12', NULL, NULL, '2019-06-03', NULL, '2019-7-15: INSPECTED BY JONES,', NULL, 23, '2019-07-08', '2019-07-15 02:34:20', 'for_distance', 'for_distance', 20, 17),
(5729, NULL, '27925', 'OPEN PO', 'GIL838', '2019-06-23', '2019-06-09', '2019-06-13', '2019-06-08', '2019-05-19', '2019-05-09', '2019-05-24', '2019-07-06', '2019-07-08', NULL, NULL, '2019-06-27', '2019-05-23', '2019-07-06', '2019-07-06', '2019-06-27', NULL, '2019-05-01', '2019-05-23', '2019-7-8: INSPECTED BY JACKY,', 'ACCEPTED', 23, '2019-07-08', '2019-07-09 00:51:48', NULL, NULL, 17, 247),
(5730, NULL, '28492-RP', 'OPEN PO', 'GIL-LIGHT-4', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-06', NULL, '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-06', NULL, '2019-7-8: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-07-08', '2019-07-08 09:52:25', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 30),
(5731, NULL, '27928', 'OPEN PO', 'KPP160', '2019-07-13', '2019-06-29', '2019-07-03', '2019-06-28', '2019-06-08', '2019-05-29', '2019-06-13', '2019-07-08', '2019-07-08', NULL, NULL, '2019-06-03', '2019-06-11', '2019-07-08', '2019-07-09', NULL, NULL, '2019-06-01', '2019-06-13', '2019-7-8: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-07-09', '2019-07-09 00:51:07', NULL, NULL, 3, 246),
(5732, NULL, '27793', 'OPEN PO', 'QWR442', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', '2019-07-09', '2019-07-09', NULL, NULL, '2019-06-01', '2019-06-25', '2019-07-08', '2019-07-09', NULL, NULL, '2019-05-10', '2019-06-14', '2019-7-9: INSPECTED BY JOY,\nN.W/G.W DEFECTIVES ON MASTER CARTON.', 'PENDING', 23, '2019-07-09', '2019-07-09 09:39:45', 'small_quantities', 'small_quantities', 20, 9),
(5733, NULL, '27762', 'OPEN PO', 'CHT894', '2019-07-25', '2019-07-11', '2019-07-15', '2019-07-10', '2019-06-20', '2019-06-10', '2019-06-25', '2019-07-09', '2019-07-10', NULL, NULL, '2019-05-31', '2019-03-23', '2019-07-05', '2019-07-12', NULL, NULL, '2019-05-02', '2019-03-23', '2019-7-10: INSPECTED BY RICHARD,', 'ACCEPTED', 23, '2019-07-10', '2019-07-10 10:05:01', 'for_distance', 'for_distance', 3, 50),
(5734, NULL, '28149', 'OPEN ', 'JUM324', '2019-07-20', '2019-07-06', '2019-07-10', '2019-07-05', '2019-06-15', '2019-06-05', '2019-06-20', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', '2019-05-20', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-09', '2019-05-20', '2019-7-11: INSPECTED BY OWEN,\nCARGO NOT READY.\n2019-7-13: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-11', '2019-07-15 01:16:27', 'small_quantities', 'small_quantities', 22, 31),
(5735, NULL, '28149', 'OPEN ', 'JUM326', '2019-07-20', '2019-07-06', '2019-07-10', '2019-07-05', '2019-06-15', '2019-06-05', '2019-06-20', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', '2019-05-20', '2019-07-01', '2019-07-02', NULL, NULL, '2019-05-09', '2019-05-20', '2019-7-11: INSPECTED BY OWEN,\nCARGO NOT READY.\n2019-7-13: INSPECTED BY JOY,', 'ACCEPTED', 23, '2019-07-11', '2019-07-15 01:16:27', 'small_quantities', 'small_quantities', 22, 31),
(5736, NULL, '28248', 'OPEN PO', 'DIG100XS', '2019-07-20', '2019-07-06', '2019-07-10', '2019-07-05', '2019-06-15', '2019-06-05', '2019-06-20', '2019-07-15', '2019-07-15', '2019-07-11', NULL, '2019-06-01', '2019-05-31', '2019-07-14', '2019-07-15', '2019-07-01', NULL, '2019-05-29', '2019-05-30', '2019-7-15: INSPECTED BY JACKY,', NULL, 23, '2019-07-11', '2019-07-15 02:52:25', NULL, 'produced_in_sub_asse', 17, 69),
(5737, NULL, '28280', 'OPEN PO', 'GXT264', '2019-07-20', '2019-07-06', '2019-07-10', '2019-07-05', '2019-06-15', '2019-06-05', '2019-06-20', '2019-07-11', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-07-11', '2019-07-12', NULL, NULL, '2019-06-01', '2019-05-22', NULL, NULL, 23, '2019-07-11', '2019-07-11 02:25:15', 'small_quantities', 'small_quantities', 21, 26),
(5738, NULL, '28119-B', 'OPEN PO', 'SOT353BB-CC-TM', '2019-07-14', '2019-06-30', '2019-07-04', '2019-06-29', '2019-06-09', '2019-05-30', '2019-06-14', '2019-07-12', '2019-07-12', NULL, NULL, '2019-05-31', '2019-04-16', '2019-06-26', '2019-06-27', NULL, NULL, '2019-05-27', '2019-06-18', '2019-7-12: INSPECTED BY OWEN,', 'ACCEPTED', 23, '2019-07-12', '2019-07-13 01:18:53', 'small_quantities', 'small_quantities', 19, 65),
(5739, NULL, '27694-A', 'OPEN PO', 'CRD111S-GD', '2019-07-29', '2019-07-15', '2019-07-19', '2019-07-14', '2019-06-24', '2019-06-14', '2019-06-29', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:26:16', NULL, NULL, 20, 22),
(5740, NULL, '27694-A', 'OPEN PO', 'CRD111S-RD', '2019-07-29', '2019-07-15', '2019-07-19', '2019-07-14', '2019-06-24', '2019-06-14', '2019-06-29', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:26:16', NULL, NULL, 20, 22),
(5741, NULL, '27694-A', 'OPEN PO', 'CRD111S-SL', '2019-07-29', '2019-07-15', '2019-07-19', '2019-07-14', '2019-06-24', '2019-06-14', '2019-06-29', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:26:16', NULL, NULL, 20, 22),
(5742, NULL, '27695-A', 'OPEN PO', 'CRD111S-GD', '2019-08-02', '2019-07-19', '2019-07-23', '2019-07-18', '2019-06-28', '2019-06-18', '2019-07-03', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:29:13', NULL, NULL, 20, 22),
(5743, NULL, '27695-A', 'OPEN PO', 'CRD111S-RD', '2019-08-02', '2019-07-19', '2019-07-23', '2019-07-18', '2019-06-28', '2019-06-18', '2019-07-03', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:29:13', NULL, NULL, 20, 22),
(5744, NULL, '27695-A', 'OPEN PO', 'CRD111S-SL', '2019-08-02', '2019-07-19', '2019-07-23', '2019-07-18', '2019-06-28', '2019-06-18', '2019-07-03', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:29:13', NULL, NULL, 20, 22),
(5745, NULL, '27696-A', 'OPEN PO', 'CRD111S-GD', '2019-07-26', '2019-07-12', '2019-07-16', '2019-07-11', '2019-06-21', '2019-06-11', '2019-06-26', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:33:47', NULL, NULL, 20, 22),
(5746, NULL, '27696-A', 'OPEN PO', 'CRD111S-RD', '2019-07-26', '2019-07-12', '2019-07-16', '2019-07-11', '2019-06-21', '2019-06-11', '2019-06-26', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:33:47', NULL, NULL, 20, 22),
(5747, NULL, '27696-A', 'OPEN PO', 'CRD111S-SL', '2019-07-26', '2019-07-12', '2019-07-16', '2019-07-11', '2019-06-21', '2019-06-11', '2019-06-26', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:33:47', NULL, NULL, 20, 22),
(5748, NULL, '27697-A', 'OPEN PO', 'CRD111S-GD', '2019-07-28', '2019-07-14', '2019-07-18', '2019-07-13', '2019-06-23', '2019-06-13', '2019-06-28', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:35:58', NULL, NULL, 20, 22),
(5749, NULL, '27697-A', 'OPEN PO', 'CRD111S-RD', '2019-07-28', '2019-07-14', '2019-07-18', '2019-07-13', '2019-06-23', '2019-06-13', '2019-06-28', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:35:58', NULL, NULL, 20, 22),
(5750, NULL, '27697-A', 'OPEN PO', 'CRD111S-SL', '2019-07-28', '2019-07-14', '2019-07-18', '2019-07-13', '2019-06-23', '2019-06-13', '2019-06-28', NULL, NULL, '2019-06-15', '2019-05-21', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-20', '2019-06-15', '2019-05-21', '2019-05-01', '2019-05-22', '2019-7-13: INSPECTED BY JONES,\n40% PACKAGING READY.', NULL, 23, '2019-07-13', '2019-07-13 02:35:58', NULL, NULL, 20, 22),
(5751, NULL, '27986', 'OPEN PO', 'GRS688', '2019-07-22', '2019-07-08', '2019-07-12', '2019-07-07', '2019-06-17', '2019-06-07', '2019-06-22', '2019-07-12', '2019-07-13', NULL, NULL, '2019-05-31', '2019-05-23', '2019-07-12', '2019-07-13', NULL, NULL, '2019-05-26', '2019-05-30', '2019-7-13: INSPECTED BY JONES,', 'ACCEPTED', 23, '2019-07-13', '2019-07-15 01:19:12', 'for_distance', 'for_distance', 21, 70),
(5752, NULL, '28176', 'OPEN PO', 'DIG276', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-07-14', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-7-15: INSPECTED BY JACKY,', NULL, 23, '2019-07-13', '2019-07-15 02:51:26', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 69),
(5753, NULL, '28176', 'OPEN PO', 'DIG278', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-07-14', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-7-15: INSPECTED BY JACKY,', NULL, 23, '2019-07-13', '2019-07-15 02:51:26', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 69),
(5754, NULL, '28176', 'OPEN PO', 'DIG282', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-07-14', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-7-15: INSPECTED BY JACKY,', NULL, 23, '2019-07-13', '2019-07-15 02:51:26', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 69),
(5755, NULL, '28176', 'OPEN PO', 'DIG284', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-07-14', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-7-15: INSPECTED BY JACKY,', NULL, 23, '2019-07-13', '2019-07-15 02:51:26', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 69),
(5756, NULL, '28176', 'OPEN PO', 'DIG286', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-07-14', '2019-07-15', NULL, NULL, '2019-06-01', NULL, '2019-7-15: INSPECTED BY JACKY,', NULL, 23, '2019-07-13', '2019-07-15 02:51:26', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 69),
(5757, NULL, '28178', 'OPEN PO', 'BKY126HH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-17', NULL, NULL, '2019-06-02', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:31:33', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 58),
(5758, NULL, '28178', 'OPEN PO', 'BKY128HH-L', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-17', NULL, NULL, '2019-06-02', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:31:33', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 58),
(5759, NULL, '28178', 'OPEN PO', 'BKY130AHH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-17', NULL, NULL, '2019-06-02', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:31:33', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 58),
(5760, NULL, '28178', 'OPEN PO', 'BKY134AHH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-17', NULL, NULL, '2019-06-02', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:31:33', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 58),
(5761, NULL, '28178', 'OPEN PO', 'BKY136AHH', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-17', NULL, NULL, '2019-06-02', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:31:33', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 58),
(5762, NULL, '28178', 'OPEN PO', 'BKY148', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-17', NULL, NULL, '2019-06-02', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:31:33', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 58),
(5763, NULL, '28178', 'OPEN PO', 'BKY156HH-S', '2019-07-07', '2019-06-23', '2019-06-27', '2019-06-22', '2019-06-02', '2019-05-23', '2019-06-07', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-17', '2019-07-17', NULL, NULL, '2019-06-02', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:31:33', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 58),
(5764, NULL, '28441-S', 'OPEN PO', 'YHL208HH', '2019-07-20', '2019-07-06', '2019-07-10', '2019-07-05', '2019-06-15', '2019-06-05', '2019-06-20', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:33:46', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 43),
(5765, NULL, '28441-S', 'OPEN PO', 'YHL280AHH', '2019-07-20', '2019-07-06', '2019-07-10', '2019-07-05', '2019-06-15', '2019-06-05', '2019-06-20', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-01', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:33:46', 'produced_in_sub_asse', 'produced_in_sub_asse', 17, 43),
(5766, NULL, '27583B17', 'OPEN PO', 'ZEN698AGG', '2019-07-19', '2019-07-05', '2019-07-09', '2019-07-04', '2019-06-14', '2019-06-04', '2019-06-19', '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-30', '2019-05-21', '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-20', '2019-05-21', '2019-7-15: INSPECTED BY JOY,', NULL, 23, '2019-07-13', '2019-07-15 02:41:13', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5768, NULL, '27624', 'OPEN PO', 'ZEN698AGG', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-30', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-20', NULL, '2019-7-15: INSPECTED BY JOY,', NULL, 23, '2019-07-13', '2019-07-15 02:48:26', NULL, NULL, 22, 16),
(5769, NULL, '28028', 'OPEN PO', 'QFC104', '2019-07-27', '2019-07-13', '2019-07-17', '2019-07-12', '2019-06-22', '2019-06-12', '2019-06-27', NULL, NULL, NULL, NULL, '2019-06-15', NULL, '2019-07-15', '2019-07-16', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 03:45:53', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 13),
(5770, NULL, '27968', 'OPEN PO', 'PUR5400C', '2019-08-11', '2019-07-28', '2019-08-01', '2019-07-27', '2019-07-07', '2019-06-27', '2019-07-12', NULL, NULL, NULL, NULL, '2019-06-13', NULL, '2019-07-15', '2019-07-17', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:07:28', 'for_distance', NULL, 3, 248),
(5771, NULL, '27968', 'OPEN PO', 'PXX1500', '2019-08-11', '2019-07-28', '2019-08-01', '2019-07-27', '2019-07-07', '2019-06-27', '2019-07-12', NULL, NULL, NULL, NULL, '2019-06-13', NULL, '2019-07-15', '2019-07-17', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:07:28', 'for_distance', NULL, 3, 248),
(5772, NULL, '27968', 'OPEN PO', 'PXX3000', '2019-08-11', '2019-07-28', '2019-08-01', '2019-07-27', '2019-07-07', '2019-06-27', '2019-07-12', NULL, NULL, NULL, NULL, '2019-06-13', NULL, '2019-07-15', '2019-07-17', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:07:28', 'for_distance', NULL, 3, 248),
(5773, NULL, '27968', 'OPEN PO', 'PXX4000', '2019-08-11', '2019-07-28', '2019-08-01', '2019-07-27', '2019-07-07', '2019-06-27', '2019-07-12', NULL, NULL, NULL, NULL, '2019-06-13', NULL, '2019-07-15', '2019-07-17', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:07:28', 'for_distance', NULL, 3, 248),
(5774, NULL, '27968', 'OPEN PO', 'PXX5300', '2019-08-11', '2019-07-28', '2019-08-01', '2019-07-27', '2019-07-07', '2019-06-27', '2019-07-12', NULL, NULL, NULL, NULL, '2019-06-13', NULL, '2019-07-15', '2019-07-17', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:07:28', 'for_distance', NULL, 3, 248),
(5775, NULL, '27968', 'OPEN PO', 'PXX5300C', '2019-08-11', '2019-07-28', '2019-08-01', '2019-07-27', '2019-07-07', '2019-06-27', '2019-07-12', NULL, NULL, NULL, NULL, '2019-06-13', NULL, '2019-07-15', '2019-07-17', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:07:28', 'for_distance', NULL, 3, 248),
(5776, NULL, '27819', 'OPEN PO', 'WIN270', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', NULL, NULL, NULL, NULL, '2019-07-15', NULL, '2019-07-19', '2019-07-19', NULL, NULL, '2019-06-13', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:00:18', 'produced_in_sub_asse', 'produced_in_sub_asse', 21, 7),
(5777, NULL, '28432-S', 'OPEN PO', 'HEH378', '2019-08-04', '2019-07-21', '2019-07-25', '2019-07-20', '2019-06-30', '2019-06-20', '2019-07-05', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-16', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:03:41', 'small_quantities', 'small_quantities', 19, 60),
(5778, NULL, '28432-S', 'OPEN PO', 'HEH376', '2019-08-04', '2019-07-21', '2019-07-25', '2019-07-20', '2019-06-30', '2019-06-20', '2019-07-05', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-16', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:03:41', 'small_quantities', 'small_quantities', 19, 60),
(5779, NULL, '27986', 'OPEN PO', 'HEH208', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-16', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:06:45', 'produced_in_sub_asse', 'produced_in_sub_asse', 19, 60),
(5780, NULL, '27986', 'OPEN PO', 'HEH210', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', NULL, NULL, NULL, NULL, '2019-06-03', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-16', NULL, NULL, NULL, 23, '2019-07-13', '2019-07-13 04:06:45', 'produced_in_sub_asse', 'produced_in_sub_asse', 19, 60),
(5781, NULL, '27296-B', 'OPEN PO', 'SLC131', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-07-03', NULL, '2019-07-13', '2019-07-15', NULL, NULL, '2019-06-06', NULL, '2019-7-13: INSPECTED BY TERRY,', 'ACCEPTED', 23, '2019-07-15', '2019-07-15 01:33:47', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5790, NULL, '28107', 'OPEN PO', 'QLP1344SLR-HH-S-TM', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-7-13: INSPECTED BY TERRY,\nLIGHT DEFECTIVES, NEED TO BE FIXED,PENDING.', NULL, 23, '2019-07-15', '2019-07-15 01:52:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5791, NULL, '28107', 'OPEN PO', 'QLP1344SLR-HH-L-TM', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-7-13: INSPECTED BY TERRY,\nLIGHT DEFECTIVES, NEED TO BE FIXED,PENDING.', NULL, 23, '2019-07-15', '2019-07-15 01:52:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5792, NULL, '28107', 'OPEN PO', 'QLP1350SLR-HH-TM', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-7-13: INSPECTED BY TERRY,\nLIGHT DEFECTIVES, NEED TO BE FIXED,PENDING.', NULL, 23, '2019-07-15', '2019-07-15 01:52:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5793, NULL, '28107', 'OPEN PO', 'QLP1352SLR-HH-TM', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-7-13: INSPECTED BY TERRY,\nLIGHT DEFECTIVES, NEED TO BE FIXED,PENDING.', NULL, 23, '2019-07-15', '2019-07-15 01:52:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5794, NULL, '28107', 'OPEN PO', 'QLP1354SLR-HH-TM', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-7-13: INSPECTED BY TERRY,\nLIGHT DEFECTIVES, NEED TO BE FIXED,PENDING.', NULL, 23, '2019-07-15', '2019-07-15 01:52:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5795, NULL, '28107', 'OPEN PO', 'QLP1356SLR-HH-TM', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-7-13: INSPECTED BY TERRY,\nLIGHT DEFECTIVES, NEED TO BE FIXED,PENDING.', NULL, 23, '2019-07-15', '2019-07-15 01:52:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5796, NULL, '28107', 'OPEN PO', 'QLP1358SLR-HH-TM', '2019-07-21', '2019-07-07', '2019-07-11', '2019-07-06', '2019-06-16', '2019-06-06', '2019-06-21', '2019-07-13', '2019-07-13', NULL, NULL, '2019-06-01', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-06-05', NULL, '2019-7-13: INSPECTED BY TERRY,\nLIGHT DEFECTIVES, NEED TO BE FIXED,PENDING.', NULL, 23, '2019-07-15', '2019-07-15 01:52:24', 'produced_in_sub_asse', 'produced_in_sub_asse', 10, 4),
(5797, NULL, '27696-A2,27697-A2,27698-A,27703-A', 'OPEN PO', 'BST104A', '2019-07-26', '2019-07-12', '2019-07-16', '2019-07-11', '2019-06-21', '2019-06-11', '2019-06-26', '2019-07-14', '2019-07-17', '2019-07-04', '2019-05-22', '2019-06-01', '2019-05-22', '2019-07-15', '2019-07-15', '2019-07-04', '2019-05-22', '2019-05-01', '2019-05-22', '2019-7-14: INSPECTED BY JONES,\n100% MASS PRODUCTION AND PACKAAGING READY, NO QC ISSUES FOUND.', NULL, 23, '2019-07-15', '2019-07-15 02:29:18', NULL, NULL, 20, 52),
(5799, NULL, '27583B17', 'OPEN PO', 'USA1526ABB', '2019-07-19', '2019-07-05', '2019-07-09', '2019-07-04', '2019-06-14', '2019-06-04', '2019-06-19', '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-30', NULL, '2019-07-15', '2019-07-15', NULL, NULL, '2019-05-20', NULL, '2019-7-15: INSPECTED BY JOY,', NULL, 23, '2019-07-15', '2019-07-15 02:44:40', 'produced_in_sub_asse', 'produced_in_sub_asse', 22, 16),
(5800, NULL, '27947-BP', 'OPEN PO', 'QLP542SLR-BR', '2019-07-25', '2019-07-11', '2019-07-15', '2019-07-10', '2019-06-20', '2019-06-10', '2019-06-25', '2019-07-19', '2019-07-20', '2019-06-30', '2019-06-15', '2019-06-15', NULL, '2019-07-19', '2019-07-20', '2019-06-30', '2019-06-15', '2019-06-15', NULL, '2019-7-20: INSPECTED BY TERRY,', NULL, 23, '2019-07-15', '2019-07-15 03:05:52', NULL, NULL, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `qcschedulesapproval`
--

CREATE TABLE `qcschedulesapproval` (
  `seq` bigint(20) NOT NULL,
  `qcscheduleseq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL,
  `appliedon` datetime NOT NULL,
  `respondedon` datetime DEFAULT NULL,
  `respondedbyuserseq` bigint(20) DEFAULT NULL,
  `responsetype` varchar(50) DEFAULT NULL,
  `responsecomments` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qcschedulesapproval`
--

INSERT INTO `qcschedulesapproval` (`seq`, `qcscheduleseq`, `userseq`, `appliedon`, `respondedon`, `respondedbyuserseq`, `responsetype`, `responsecomments`) VALUES
(3, 5388, 17, '2019-06-20 11:36:46', '2019-06-20 11:39:18', 24, 'Rejected', 'Sorry bad images are uploaded by you. You need to upload high resolution images for all the shots.'),
(4, 5388, 17, '2019-06-20 11:39:40', '2019-06-20 11:39:57', 24, 'Approved', 'Yea thats nice now.'),
(5, 5197, 18, '2019-06-21 01:55:33', '2019-06-21 05:30:49', 23, 'Rejected', 'Sorry, you need to put up better images of the product. There must be atleast 20 of them.'),
(6, 5552, 23, '2019-06-21 05:28:13', NULL, NULL, 'Pending', NULL),
(7, 5197, 3, '2019-06-21 05:31:30', '2019-06-21 05:31:49', 23, 'Approved', 'Ok great job.'),
(8, 5411, 23, '2019-06-22 01:09:36', NULL, NULL, 'Pending', NULL),
(9, 5150, 23, '2019-06-24 03:53:24', NULL, NULL, 'Pending', NULL),
(10, 5415, 23, '2019-06-24 09:31:18', NULL, NULL, 'Pending', NULL),
(11, 5415, 23, '2019-06-24 09:31:35', NULL, NULL, 'Pending', NULL),
(12, 5446, 23, '2019-06-24 10:05:50', NULL, NULL, 'Pending', NULL),
(13, 5652, 23, '2019-06-25 07:56:51', NULL, NULL, 'Pending', NULL),
(14, 5560, 23, '2019-06-25 09:22:08', NULL, NULL, 'Pending', NULL),
(15, 5561, 23, '2019-06-25 09:22:42', NULL, NULL, 'Pending', NULL),
(16, 5630, 23, '2019-06-25 09:23:28', NULL, NULL, 'Pending', NULL),
(17, 5491, 23, '2019-06-25 10:08:03', NULL, NULL, 'Pending', NULL),
(18, 5384, 23, '2019-06-25 10:08:38', NULL, NULL, 'Pending', NULL),
(19, 5383, 23, '2019-06-25 10:09:10', NULL, NULL, 'Pending', NULL),
(20, 5381, 23, '2019-06-25 10:09:48', NULL, NULL, 'Pending', NULL),
(21, 5380, 23, '2019-06-25 10:10:14', NULL, NULL, 'Pending', NULL),
(22, 5382, 23, '2019-06-25 10:10:37', NULL, NULL, 'Pending', NULL),
(23, 5296, 23, '2019-06-25 10:14:36', NULL, NULL, 'Pending', NULL),
(24, 5296, 23, '2019-06-25 10:14:47', NULL, NULL, 'Pending', NULL),
(25, 5296, 23, '2019-06-25 10:15:15', NULL, NULL, 'Pending', NULL),
(26, 5297, 23, '2019-06-25 10:17:05', NULL, NULL, 'Pending', NULL),
(27, 5598, 23, '2019-06-26 00:48:44', NULL, NULL, 'Pending', NULL),
(28, 5336, 23, '2019-06-26 00:58:21', NULL, NULL, 'Pending', NULL),
(29, 5337, 23, '2019-06-26 00:59:07', NULL, NULL, 'Pending', NULL),
(30, 5341, 23, '2019-06-26 00:59:51', NULL, NULL, 'Pending', NULL),
(31, 5334, 23, '2019-06-26 01:00:36', NULL, NULL, 'Pending', NULL),
(32, 5338, 23, '2019-06-26 01:02:45', NULL, NULL, 'Pending', NULL),
(33, 5440, 23, '2019-06-26 01:37:21', NULL, NULL, 'Pending', NULL),
(34, 5440, 23, '2019-06-26 01:37:49', NULL, NULL, 'Pending', NULL),
(35, 5441, 23, '2019-06-26 01:40:37', NULL, NULL, 'Pending', NULL),
(36, 5502, 23, '2019-06-26 10:13:00', NULL, NULL, 'Pending', NULL),
(37, 5606, 23, '2019-06-26 10:13:50', NULL, NULL, 'Pending', NULL),
(38, 5653, 23, '2019-06-26 10:29:08', NULL, NULL, 'Pending', NULL),
(39, 5443, 23, '2019-06-26 10:32:27', NULL, NULL, 'Pending', NULL),
(40, 5443, 23, '2019-06-26 10:32:42', NULL, NULL, 'Pending', NULL),
(41, 5443, 23, '2019-06-26 10:32:44', NULL, NULL, 'Pending', NULL),
(42, 5443, 23, '2019-06-26 10:32:44', NULL, NULL, 'Pending', NULL),
(43, 5443, 23, '2019-06-26 10:32:45', NULL, NULL, 'Pending', NULL),
(44, 5439, 23, '2019-06-26 10:34:56', NULL, NULL, 'Pending', NULL),
(45, 5439, 23, '2019-06-26 10:34:58', NULL, NULL, 'Pending', NULL),
(46, 5439, 23, '2019-06-26 10:34:59', NULL, NULL, 'Pending', NULL),
(47, 5442, 23, '2019-06-26 10:35:34', NULL, NULL, 'Pending', NULL),
(48, 5256, 23, '2019-06-26 10:38:31', NULL, NULL, 'Pending', NULL),
(49, 5257, 23, '2019-06-26 10:39:12', NULL, NULL, 'Pending', NULL),
(50, 5492, 23, '2019-06-26 10:41:29', NULL, NULL, 'Pending', NULL),
(51, 5524, 23, '2019-06-27 09:23:36', NULL, NULL, 'Pending', NULL),
(52, 5524, 23, '2019-06-27 09:23:40', NULL, NULL, 'Pending', NULL),
(53, 5484, 23, '2019-06-27 09:24:15', NULL, NULL, 'Pending', NULL),
(54, 5481, 23, '2019-06-27 09:24:45', NULL, NULL, 'Pending', NULL),
(55, 5508, 23, '2019-06-27 10:12:32', NULL, NULL, 'Pending', NULL),
(56, 5450, 23, '2019-06-27 10:13:24', NULL, NULL, 'Pending', NULL),
(57, 5451, 23, '2019-06-27 10:13:55', NULL, NULL, 'Pending', NULL),
(58, 5362, 23, '2019-06-28 11:02:13', NULL, NULL, 'Pending', NULL),
(59, 5363, 23, '2019-06-28 11:03:33', NULL, NULL, 'Pending', NULL),
(60, 5317, 23, '2019-07-02 06:19:49', NULL, NULL, 'Pending', NULL),
(61, 5517, 23, '2019-07-02 06:27:15', NULL, NULL, 'Pending', NULL),
(62, 5518, 23, '2019-07-02 06:29:45', NULL, NULL, 'Pending', NULL),
(63, 5519, 23, '2019-07-02 06:36:02', NULL, NULL, 'Pending', NULL),
(64, 5467, 23, '2019-07-02 07:31:51', NULL, NULL, 'Pending', NULL),
(65, 5468, 23, '2019-07-02 07:45:52', NULL, NULL, 'Pending', NULL),
(66, 5469, 23, '2019-07-02 07:48:02', NULL, NULL, 'Pending', NULL),
(67, 5586, 23, '2019-07-02 08:03:50', NULL, NULL, 'Pending', NULL),
(68, 5587, 23, '2019-07-02 08:05:38', NULL, NULL, 'Pending', NULL),
(69, 5588, 23, '2019-07-02 08:07:30', NULL, NULL, 'Pending', NULL),
(70, 5671, 23, '2019-07-02 08:11:57', NULL, NULL, 'Pending', NULL),
(71, 5672, 23, '2019-07-02 08:16:23', NULL, NULL, 'Pending', NULL),
(72, 5673, 23, '2019-07-02 08:20:11', NULL, NULL, 'Pending', NULL),
(73, 5437, 23, '2019-07-02 08:27:39', NULL, NULL, 'Pending', NULL),
(74, 5417, 23, '2019-07-02 08:30:39', NULL, NULL, 'Pending', NULL),
(75, 5497, 23, '2019-07-02 08:34:47', NULL, NULL, 'Pending', NULL),
(76, 5496, 23, '2019-07-02 08:36:54', NULL, NULL, 'Pending', NULL),
(77, 5558, 23, '2019-07-02 08:38:48', NULL, NULL, 'Pending', NULL),
(78, 5559, 23, '2019-07-02 08:40:18', NULL, NULL, 'Pending', NULL),
(79, 5674, 23, '2019-07-02 08:48:25', NULL, NULL, 'Pending', NULL),
(80, 5675, 23, '2019-07-02 09:17:34', NULL, NULL, 'Pending', NULL),
(81, 5676, 23, '2019-07-02 09:20:32', NULL, NULL, 'Pending', NULL),
(82, 5677, 23, '2019-07-02 09:22:32', NULL, NULL, 'Pending', NULL),
(83, 5678, 23, '2019-07-02 09:34:00', NULL, NULL, 'Pending', NULL),
(85, 5597, 23, '2019-07-02 09:51:16', NULL, NULL, 'Pending', NULL),
(86, 5487, 23, '2019-07-02 09:55:09', NULL, NULL, 'Pending', NULL),
(87, 5488, 23, '2019-07-02 09:57:39', NULL, NULL, 'Pending', NULL),
(88, 5634, 23, '2019-07-02 09:59:39', NULL, NULL, 'Pending', NULL),
(89, 5679, 23, '2019-07-02 10:17:26', NULL, NULL, 'Pending', NULL),
(90, 5684, 23, '2019-07-03 01:13:57', NULL, NULL, 'Pending', NULL),
(91, 5685, 23, '2019-07-03 09:02:45', NULL, NULL, 'Pending', NULL),
(92, 5686, 23, '2019-07-03 09:03:52', NULL, NULL, 'Pending', NULL),
(93, 5687, 23, '2019-07-03 09:04:19', NULL, NULL, 'Pending', NULL),
(94, 5688, 23, '2019-07-03 09:04:41', NULL, NULL, 'Pending', NULL),
(95, 5698, 23, '2019-07-03 09:09:02', NULL, NULL, 'Pending', NULL),
(96, 5699, 23, '2019-07-03 09:09:02', NULL, NULL, 'Pending', NULL),
(97, 5700, 23, '2019-07-03 09:09:03', NULL, NULL, 'Pending', NULL),
(98, 5701, 23, '2019-07-03 09:09:03', NULL, NULL, 'Pending', NULL),
(99, 5646, 23, '2019-07-03 09:11:26', NULL, NULL, 'Pending', NULL),
(100, 5475, 23, '2019-07-03 09:18:07', NULL, NULL, 'Pending', NULL),
(101, 5474, 23, '2019-07-03 09:18:22', NULL, NULL, 'Pending', NULL),
(102, 5473, 23, '2019-07-03 09:18:42', NULL, NULL, 'Pending', NULL),
(103, 5476, 23, '2019-07-03 09:19:30', NULL, NULL, 'Pending', NULL),
(104, 5477, 23, '2019-07-03 09:19:44', NULL, NULL, 'Pending', NULL),
(105, 5578, 23, '2019-07-03 09:20:39', NULL, NULL, 'Pending', NULL),
(106, 5577, 23, '2019-07-03 09:20:51', NULL, NULL, 'Pending', NULL),
(107, 5576, 23, '2019-07-03 09:21:11', NULL, NULL, 'Pending', NULL),
(108, 5410, 23, '2019-07-08 02:28:24', NULL, NULL, 'Pending', NULL),
(109, 5282, 23, '2019-07-08 03:06:55', NULL, NULL, 'Pending', NULL),
(110, 5281, 23, '2019-07-08 03:08:31', NULL, NULL, 'Pending', NULL),
(111, 5549, 23, '2019-07-08 07:32:41', NULL, NULL, 'Pending', NULL),
(112, 5545, 23, '2019-07-08 07:32:41', NULL, NULL, 'Pending', NULL),
(113, 5546, 23, '2019-07-08 07:32:41', NULL, NULL, 'Pending', NULL),
(114, 5462, 23, '2019-07-08 08:14:59', NULL, NULL, 'Pending', NULL),
(115, 5562, 23, '2019-07-08 08:17:46', NULL, NULL, 'Pending', NULL),
(116, 5563, 23, '2019-07-08 08:23:44', NULL, NULL, 'Pending', NULL),
(117, 5312, 23, '2019-07-08 08:30:13', NULL, NULL, 'Pending', NULL),
(118, 5313, 23, '2019-07-08 08:30:13', NULL, NULL, 'Pending', NULL),
(119, 5314, 23, '2019-07-08 08:30:13', NULL, NULL, 'Pending', NULL),
(120, 5166, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(121, 5158, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(122, 5162, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(123, 5163, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(124, 5167, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(125, 5159, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(126, 5164, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(127, 5160, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(128, 5165, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(129, 5161, 23, '2019-07-08 08:44:40', NULL, NULL, 'Pending', NULL),
(130, 5501, 23, '2019-07-08 08:51:22', NULL, NULL, 'Pending', NULL),
(131, 5603, 23, '2019-07-08 08:52:45', NULL, NULL, 'Pending', NULL),
(132, 5500, 23, '2019-07-08 08:58:13', NULL, NULL, 'Pending', NULL),
(133, 5602, 23, '2019-07-08 08:59:12', NULL, NULL, 'Pending', NULL),
(134, 5601, 23, '2019-07-08 08:59:12', NULL, NULL, 'Pending', NULL),
(135, 5710, 23, '2019-07-08 09:01:51', NULL, NULL, 'Pending', NULL),
(136, 5315, 23, '2019-07-08 09:04:36', NULL, NULL, 'Pending', NULL),
(137, 5709, 23, '2019-07-08 09:12:37', NULL, NULL, 'Pending', NULL),
(138, 5729, 23, '2019-07-08 09:25:59', NULL, NULL, 'Pending', NULL),
(139, 5719, 23, '2019-07-08 09:30:26', NULL, NULL, 'Pending', NULL),
(140, 5718, 23, '2019-07-08 09:31:23', NULL, NULL, 'Pending', NULL),
(141, 5489, 23, '2019-07-08 09:34:58', NULL, NULL, 'Pending', NULL),
(142, 5633, 23, '2019-07-08 09:39:29', NULL, NULL, 'Pending', NULL),
(143, 5635, 23, '2019-07-08 09:39:29', NULL, NULL, 'Pending', NULL),
(144, 5636, 23, '2019-07-08 09:39:29', NULL, NULL, 'Pending', NULL),
(145, 5647, 23, '2019-07-08 09:41:04', NULL, NULL, 'Pending', NULL),
(146, 5730, 23, '2019-07-08 09:52:25', NULL, NULL, 'Pending', NULL),
(147, 5589, 23, '2019-07-09 00:38:32', NULL, NULL, 'Pending', NULL),
(148, 5731, 23, '2019-07-09 00:46:42', NULL, NULL, 'Pending', NULL),
(149, 5725, 23, '2019-07-09 09:34:55', NULL, NULL, 'Pending', NULL),
(150, 5726, 23, '2019-07-09 09:35:50', NULL, NULL, 'Pending', NULL),
(151, 5732, 23, '2019-07-09 09:39:45', NULL, NULL, 'Pending', NULL),
(152, 5631, 23, '2019-07-10 01:35:04', NULL, NULL, 'Pending', NULL),
(153, 5583, 23, '2019-07-10 01:35:45', NULL, NULL, 'Pending', NULL),
(154, 5694, 23, '2019-07-10 01:36:53', NULL, NULL, 'Pending', NULL),
(155, 5693, 23, '2019-07-10 01:37:36', NULL, NULL, 'Pending', NULL),
(156, 5690, 23, '2019-07-10 01:38:05', NULL, NULL, 'Pending', NULL),
(157, 5600, 23, '2019-07-10 01:51:12', NULL, NULL, 'Pending', NULL),
(158, 5604, 23, '2019-07-10 01:51:12', NULL, NULL, 'Pending', NULL),
(159, 5599, 23, '2019-07-10 01:51:12', NULL, NULL, 'Pending', NULL),
(160, 5498, 23, '2019-07-10 01:55:41', NULL, NULL, 'Pending', NULL),
(161, 5499, 23, '2019-07-10 01:55:41', NULL, NULL, 'Pending', NULL),
(162, 5533, 23, '2019-07-10 02:00:53', NULL, NULL, 'Pending', NULL),
(163, 5613, 23, '2019-07-10 02:01:25', NULL, NULL, 'Pending', NULL),
(164, 5717, 23, '2019-07-10 02:02:13', NULL, NULL, 'Pending', NULL),
(165, 5370, 23, '2019-07-10 02:11:25', NULL, NULL, 'Pending', NULL),
(166, 5374, 23, '2019-07-10 02:11:25', NULL, NULL, 'Pending', NULL),
(167, 5371, 23, '2019-07-10 02:11:25', NULL, NULL, 'Pending', NULL),
(168, 5375, 23, '2019-07-10 02:11:25', NULL, NULL, 'Pending', NULL),
(169, 5372, 23, '2019-07-10 02:11:25', NULL, NULL, 'Pending', NULL),
(170, 5373, 23, '2019-07-10 02:11:25', NULL, NULL, 'Pending', NULL),
(171, 5376, 23, '2019-07-10 02:12:32', NULL, NULL, 'Pending', NULL),
(172, 5377, 23, '2019-07-10 02:12:32', NULL, NULL, 'Pending', NULL),
(173, 5378, 23, '2019-07-10 02:12:32', NULL, NULL, 'Pending', NULL),
(174, 5379, 23, '2019-07-10 02:12:32', NULL, NULL, 'Pending', NULL),
(175, 5605, 23, '2019-07-10 02:13:00', NULL, NULL, 'Pending', NULL),
(176, 5449, 23, '2019-07-10 02:17:35', NULL, NULL, 'Pending', NULL),
(177, 5448, 23, '2019-07-10 02:17:35', NULL, NULL, 'Pending', NULL),
(178, 5452, 23, '2019-07-10 02:24:18', NULL, NULL, 'Pending', NULL),
(179, 5553, 23, '2019-07-10 02:25:42', NULL, NULL, 'Pending', NULL),
(180, 5554, 23, '2019-07-10 02:25:42', NULL, NULL, 'Pending', NULL),
(181, 5551, 23, '2019-07-10 02:27:12', NULL, NULL, 'Pending', NULL),
(182, 5505, 23, '2019-07-10 02:30:35', NULL, NULL, 'Pending', NULL),
(183, 5506, 23, '2019-07-10 02:30:35', NULL, NULL, 'Pending', NULL),
(184, 5507, 23, '2019-07-10 02:31:29', NULL, NULL, 'Pending', NULL),
(185, 5332, 23, '2019-07-10 02:32:53', NULL, NULL, 'Pending', NULL),
(186, 5284, 23, '2019-07-10 02:50:38', NULL, NULL, 'Pending', NULL),
(187, 5285, 23, '2019-07-10 02:52:02', NULL, NULL, 'Pending', NULL),
(188, 5288, 23, '2019-07-10 02:53:15', NULL, NULL, 'Pending', NULL),
(189, 5464, 23, '2019-07-10 05:56:01', NULL, NULL, 'Pending', NULL),
(190, 5275, 23, '2019-07-10 09:23:29', NULL, NULL, 'Pending', NULL),
(191, 5733, 23, '2019-07-10 10:05:01', NULL, NULL, 'Pending', NULL),
(192, 5412, 23, '2019-07-10 10:05:33', NULL, NULL, 'Pending', NULL),
(193, 5413, 23, '2019-07-10 10:06:08', NULL, NULL, 'Pending', NULL),
(194, 5564, 23, '2019-07-10 10:06:36', NULL, NULL, 'Pending', NULL),
(195, 5708, 23, '2019-07-11 01:29:47', NULL, NULL, 'Pending', NULL),
(196, 5280, 23, '2019-07-11 10:31:46', NULL, NULL, 'Pending', NULL),
(197, 5283, 23, '2019-07-11 10:31:46', NULL, NULL, 'Pending', NULL),
(198, 5266, 23, '2019-07-11 10:48:49', NULL, NULL, 'Pending', NULL),
(199, 5265, 23, '2019-07-11 10:48:49', NULL, NULL, 'Pending', NULL),
(200, 5267, 23, '2019-07-11 10:51:06', NULL, NULL, 'Pending', NULL),
(201, 5268, 23, '2019-07-11 10:51:06', NULL, NULL, 'Pending', NULL),
(202, 5269, 23, '2019-07-11 10:51:06', NULL, NULL, 'Pending', NULL),
(203, 5270, 23, '2019-07-11 10:51:06', NULL, NULL, 'Pending', NULL),
(204, 5271, 23, '2019-07-11 10:51:06', NULL, NULL, 'Pending', NULL),
(205, 5272, 23, '2019-07-11 10:51:06', NULL, NULL, 'Pending', NULL),
(206, 5273, 23, '2019-07-11 10:51:06', NULL, NULL, 'Pending', NULL),
(207, 5616, 23, '2019-07-11 10:54:43', NULL, NULL, 'Pending', NULL),
(208, 5617, 23, '2019-07-11 10:54:43', NULL, NULL, 'Pending', NULL),
(209, 5565, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(210, 5569, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(211, 5566, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(212, 5570, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(213, 5567, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(214, 5571, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(215, 5568, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(216, 5572, 23, '2019-07-11 11:00:30', NULL, NULL, 'Pending', NULL),
(217, 5550, 23, '2019-07-13 01:11:53', NULL, NULL, 'Pending', NULL),
(218, 5547, 23, '2019-07-13 01:12:31', NULL, NULL, 'Pending', NULL),
(219, 5548, 23, '2019-07-13 01:12:47', NULL, NULL, 'Pending', NULL),
(220, 5724, 23, '2019-07-13 01:17:12', NULL, NULL, 'Pending', NULL),
(221, 5623, 23, '2019-07-13 01:17:47', NULL, NULL, 'Pending', NULL),
(222, 5738, 23, '2019-07-13 01:18:53', NULL, NULL, 'Pending', NULL),
(223, 5735, 23, '2019-07-15 01:16:27', NULL, NULL, 'Pending', NULL),
(224, 5734, 23, '2019-07-15 01:16:27', NULL, NULL, 'Pending', NULL),
(225, 5751, 23, '2019-07-15 01:19:12', NULL, NULL, 'Pending', NULL),
(226, 5431, 23, '2019-07-15 01:28:21', NULL, NULL, 'Pending', NULL),
(227, 5435, 23, '2019-07-15 01:28:21', NULL, NULL, 'Pending', NULL),
(228, 5436, 23, '2019-07-15 01:28:21', NULL, NULL, 'Pending', NULL),
(229, 5781, 23, '2019-07-15 01:33:47', NULL, NULL, 'Pending', NULL),
(230, 5180, 23, '2019-07-15 02:36:54', NULL, NULL, 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `seq` bigint(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`seq`, `title`, `description`, `startdate`, `enddate`) VALUES
(8, 'TradeShow June 2019', 'no desc', '2019-06-02 13:29:38', '2019-06-03 13:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `showtaskassignees`
--

CREATE TABLE `showtaskassignees` (
  `seq` bigint(20) NOT NULL,
  `showtaskseq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showtaskassignees`
--

INSERT INTO `showtaskassignees` (`seq`, `showtaskseq`, `userseq`) VALUES
(3102, 1549, 1),
(3103, 1549, 2),
(3104, 1550, 1),
(3105, 1550, 2),
(3106, 1551, 1),
(3107, 1551, 2),
(3108, 1552, 1),
(3109, 1552, 2),
(3110, 1553, 1),
(3111, 1553, 2),
(3112, 1554, 1),
(3113, 1554, 2),
(3114, 1555, 1),
(3115, 1555, 2),
(3116, 1556, 1),
(3117, 1556, 2),
(3118, 1557, 1),
(3119, 1557, 2),
(3120, 1558, 1),
(3121, 1558, 2),
(3122, 1559, 1),
(3123, 1559, 2),
(3124, 1560, 1),
(3125, 1560, 2),
(3126, 1561, 1),
(3127, 1561, 2),
(3128, 1562, 1),
(3129, 1562, 2),
(3130, 1563, 1),
(3131, 1563, 2),
(3132, 1564, 1),
(3133, 1564, 2),
(3134, 1565, 1),
(3135, 1565, 2),
(3136, 1566, 1),
(3137, 1566, 2),
(3138, 1567, 1),
(3139, 1567, 2),
(3140, 1568, 1),
(3141, 1568, 2),
(3142, 1569, 1),
(3143, 1569, 2),
(3144, 1570, 1),
(3145, 1570, 2),
(3146, 1571, 1),
(3147, 1571, 2),
(3148, 1572, 1),
(3149, 1572, 2),
(3150, 1573, 1),
(3151, 1573, 2),
(3152, 1574, 1),
(3153, 1574, 2),
(3154, 1575, 1),
(3155, 1575, 2),
(3156, 1576, 1),
(3157, 1576, 2),
(3158, 1577, 1),
(3159, 1577, 2),
(3160, 1578, 1),
(3161, 1578, 2),
(3162, 1579, 1),
(3163, 1579, 2),
(3164, 1580, 1),
(3165, 1580, 2),
(3166, 1581, 1),
(3167, 1581, 2),
(3168, 1582, 1),
(3169, 1582, 2),
(3170, 1583, 1),
(3171, 1583, 2),
(3172, 1584, 1),
(3173, 1584, 2),
(3174, 1585, 1),
(3175, 1585, 2),
(3176, 1586, 1),
(3177, 1586, 2),
(3178, 1587, 1),
(3179, 1587, 2),
(3180, 1588, 1),
(3181, 1588, 2),
(3182, 1589, 1),
(3183, 1589, 2),
(3184, 1590, 1),
(3185, 1590, 2),
(3186, 1591, 1),
(3187, 1591, 2),
(3188, 1592, 1),
(3189, 1592, 2),
(3190, 1593, 1),
(3191, 1593, 2),
(3192, 1594, 1),
(3193, 1594, 2),
(3194, 1595, 1),
(3195, 1595, 2),
(3196, 1596, 1),
(3197, 1596, 2),
(3198, 1597, 1),
(3199, 1597, 2),
(3200, 1598, 1),
(3201, 1598, 2),
(3202, 1599, 1),
(3203, 1599, 2),
(3204, 1600, 1),
(3205, 1600, 2),
(3206, 1601, 1),
(3207, 1601, 2),
(3208, 1602, 1),
(3209, 1602, 2),
(3210, 1603, 1),
(3211, 1603, 2),
(3212, 1604, 1),
(3213, 1604, 2),
(3214, 1605, 1),
(3215, 1605, 2),
(3216, 1606, 1),
(3217, 1606, 2),
(3218, 1607, 1),
(3219, 1607, 2),
(3220, 1608, 1),
(3221, 1608, 2),
(3222, 1609, 1),
(3223, 1609, 2),
(3224, 1610, 1),
(3225, 1610, 2),
(3226, 1611, 1),
(3227, 1611, 2),
(3228, 1612, 1),
(3229, 1612, 2),
(3230, 1613, 1),
(3231, 1613, 2),
(3232, 1614, 1),
(3233, 1614, 2),
(3234, 1615, 1),
(3235, 1615, 2),
(3236, 1616, 1),
(3237, 1616, 2),
(3238, 1617, 1),
(3239, 1617, 2),
(3240, 1618, 1),
(3241, 1618, 2),
(3242, 1619, 1),
(3243, 1619, 2),
(3244, 1620, 1),
(3245, 1620, 2),
(3246, 1621, 1),
(3247, 1621, 2),
(3248, 1622, 1),
(3249, 1622, 2),
(3250, 1623, 1),
(3251, 1623, 2),
(3252, 1624, 1),
(3253, 1624, 2),
(3254, 1625, 1),
(3255, 1625, 2),
(3256, 1626, 1),
(3257, 1626, 2),
(3258, 1627, 1),
(3259, 1627, 2),
(3260, 1628, 1),
(3261, 1628, 2),
(3262, 1629, 1),
(3263, 1629, 2),
(3264, 1630, 1),
(3265, 1630, 2),
(3266, 1631, 1),
(3267, 1631, 2),
(3268, 1632, 1),
(3269, 1632, 2),
(3270, 1633, 1),
(3271, 1633, 2),
(3272, 1634, 1),
(3273, 1634, 2),
(3274, 1635, 1),
(3275, 1635, 2),
(3276, 1636, 1),
(3277, 1636, 2),
(3278, 1637, 1),
(3279, 1637, 2),
(3280, 1638, 1),
(3281, 1638, 2),
(3282, 1639, 1),
(3283, 1639, 2),
(3284, 1640, 1),
(3285, 1640, 2),
(3286, 1641, 1),
(3287, 1641, 2),
(3288, 1642, 1),
(3289, 1642, 2),
(3290, 1643, 1),
(3291, 1643, 2),
(3292, 1644, 1),
(3293, 1644, 2),
(3294, 1645, 1),
(3295, 1645, 2),
(3296, 1646, 1),
(3297, 1646, 2),
(3298, 1647, 1),
(3299, 1647, 2),
(3300, 1648, 1),
(3301, 1648, 2),
(3302, 1649, 1),
(3303, 1649, 2),
(3304, 1650, 1),
(3305, 1650, 2),
(3306, 1651, 1),
(3307, 1651, 2),
(3308, 1652, 1),
(3309, 1652, 2),
(3310, 1653, 1),
(3311, 1653, 2),
(3312, 1654, 1),
(3313, 1654, 2),
(3314, 1655, 1),
(3315, 1655, 2),
(3316, 1656, 1),
(3317, 1656, 2),
(3318, 1657, 1),
(3319, 1657, 2),
(3320, 1658, 1),
(3321, 1658, 2),
(3322, 1659, 1),
(3323, 1659, 2),
(3324, 1660, 1),
(3325, 1660, 2),
(3326, 1661, 1),
(3327, 1661, 2),
(3328, 1662, 1),
(3329, 1662, 2),
(3330, 1663, 1),
(3331, 1663, 2),
(3332, 1664, 1),
(3333, 1664, 2),
(3334, 1665, 1),
(3335, 1665, 2),
(3336, 1666, 1),
(3337, 1666, 2),
(3338, 1667, 1),
(3339, 1667, 2),
(3340, 1668, 1),
(3341, 1668, 2),
(3342, 1669, 1),
(3343, 1669, 2),
(3344, 1670, 1),
(3345, 1670, 2),
(3346, 1671, 1),
(3347, 1671, 2),
(3348, 1672, 1),
(3349, 1672, 2),
(3350, 1673, 1),
(3351, 1673, 2),
(3352, 1674, 1),
(3353, 1674, 2),
(3354, 1675, 1),
(3355, 1675, 2),
(3356, 1676, 1),
(3357, 1676, 2),
(3358, 1677, 1),
(3359, 1677, 2),
(3360, 1678, 1),
(3361, 1678, 2),
(3362, 1679, 1),
(3363, 1679, 2),
(3364, 1680, 1),
(3365, 1680, 2),
(3366, 1681, 1),
(3367, 1681, 2),
(3368, 1682, 1),
(3369, 1682, 2),
(3370, 1683, 1),
(3371, 1683, 2),
(3372, 1684, 1),
(3373, 1684, 2),
(3374, 1685, 1),
(3375, 1685, 2),
(3376, 1686, 1),
(3377, 1686, 2),
(3378, 1687, 1),
(3379, 1687, 2),
(3380, 1688, 1),
(3381, 1688, 2),
(3382, 1689, 1),
(3383, 1689, 2),
(3384, 1690, 1),
(3385, 1690, 2),
(3386, 1691, 1),
(3387, 1691, 2),
(3388, 1692, 1),
(3389, 1692, 2),
(3390, 1693, 1),
(3391, 1693, 2),
(3392, 1694, 1),
(3393, 1694, 2),
(3394, 1695, 1),
(3395, 1695, 2),
(3396, 1696, 1),
(3397, 1696, 2),
(3398, 1697, 1),
(3399, 1697, 2),
(3400, 1698, 1),
(3401, 1698, 2),
(3402, 1699, 1),
(3403, 1699, 2),
(3404, 1700, 1),
(3405, 1700, 2),
(3406, 1701, 1),
(3407, 1701, 2),
(3408, 1702, 1),
(3409, 1702, 2),
(3410, 1703, 1),
(3411, 1703, 2),
(3412, 1704, 1),
(3413, 1704, 2),
(3414, 1705, 1),
(3415, 1705, 2),
(3416, 1706, 1),
(3417, 1706, 2),
(3418, 1707, 1),
(3419, 1707, 2),
(3420, 1708, 1),
(3421, 1708, 2),
(3422, 1709, 1),
(3423, 1709, 2);

-- --------------------------------------------------------

--
-- Table structure for table `showtaskfiles`
--

CREATE TABLE `showtaskfiles` (
  `seq` bigint(20) NOT NULL,
  `showtaskseq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL,
  `fileextension` varchar(10) NOT NULL,
  `ispublic` tinyint(4) NOT NULL,
  `createdon` datetime NOT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showtaskfiles`
--

INSERT INTO `showtaskfiles` (`seq`, `showtaskseq`, `userseq`, `fileextension`, `ispublic`, `createdon`, `title`) VALUES
(8, 1564, 1, 'png', 1, '2018-12-14 11:44:47', '96.png'),
(10, 1562, 0, 'png', 1, '2018-12-14 16:58:07', '240 2.png'),
(11, 1561, 1, 'png', 1, '2018-12-14 17:13:46', '240 2.png'),
(12, 1560, 0, 'png', 1, '2018-12-15 09:25:15', '80.png'),
(13, 1560, 0, 'png', 1, '2018-12-15 09:25:15', '96.png'),
(14, 1560, 0, 'png', 1, '2018-12-15 09:25:15', '120.png'),
(15, 1553, 0, 'png', 1, '2018-12-15 09:28:00', '48.png'),
(16, 1553, 0, 'png', 0, '2018-12-15 09:28:00', '72.png'),
(17, 1553, 0, 'png', 0, '2018-12-15 09:28:00', '80.png'),
(19, 1549, 0, 'jpg', 1, '2019-01-09 10:43:18', '80.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `showtasks`
--

CREATE TABLE `showtasks` (
  `seq` bigint(20) NOT NULL,
  `showseq` bigint(20) NOT NULL,
  `taskseq` bigint(20) NOT NULL,
  `assignee` varchar(500) DEFAULT NULL,
  `starteddatereferencedays` int(11) DEFAULT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `showtasks`
--

INSERT INTO `showtasks` (`seq`, `showseq`, `taskseq`, `assignee`, `starteddatereferencedays`, `startdate`, `enddate`, `comments`, `status`) VALUES
(1549, 8, 1, NULL, NULL, '2018-12-04', '2018-12-07', 'icon uploaded', 'pending'),
(1550, 8, 2, NULL, NULL, '2018-12-29', '2019-01-03', NULL, 'pending'),
(1551, 8, 3, NULL, NULL, '2018-12-10', '2018-12-13', NULL, 'pending'),
(1552, 8, 4, NULL, NULL, '2018-12-10', '2018-12-13', NULL, 'pending'),
(1553, 8, 5, NULL, NULL, '2018-12-10', '2018-12-13', '', 'pending'),
(1554, 8, 6, NULL, NULL, '2018-12-10', '2018-12-13', NULL, 'pending'),
(1555, 8, 7, NULL, NULL, '2018-12-10', '2018-12-13', NULL, 'pending'),
(1556, 8, 8, NULL, NULL, '2018-12-10', '2018-12-13', NULL, 'pending'),
(1557, 8, 9, NULL, NULL, '2018-12-10', '2018-12-13', NULL, 'pending'),
(1558, 8, 10, NULL, NULL, '2018-12-10', '2018-12-13', NULL, 'pending'),
(1559, 8, 11, NULL, NULL, '2018-12-04', '2018-12-07', NULL, 'pending'),
(1560, 8, 12, NULL, NULL, '2018-12-04', '2018-12-07', '', 'pending'),
(1561, 8, 13, NULL, NULL, '2018-12-04', '2018-12-07', '', 'pending'),
(1562, 8, 14, NULL, NULL, '2018-12-04', '2018-12-07', '', 'pending'),
(1563, 8, 15, NULL, NULL, '2018-12-04', '2018-12-07', NULL, 'pending'),
(1564, 8, 16, NULL, NULL, '2018-12-04', '2018-12-07', '', 'pending'),
(1565, 8, 17, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1566, 8, 18, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1567, 8, 19, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1568, 8, 20, NULL, NULL, '2018-12-13', '2018-12-16', '', 'completed'),
(1569, 8, 21, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1570, 8, 22, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1571, 8, 23, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1572, 8, 24, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1573, 8, 25, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1574, 8, 26, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1575, 8, 27, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1576, 8, 28, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1577, 8, 29, NULL, NULL, '2018-12-13', '2018-12-16', '', 'completed'),
(1578, 8, 30, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1579, 8, 31, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1580, 8, 32, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1581, 8, 33, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1582, 8, 34, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1583, 8, 35, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1584, 8, 36, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1585, 8, 37, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1586, 8, 38, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1587, 8, 39, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1588, 8, 40, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1589, 8, 41, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1590, 8, 42, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1591, 8, 43, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1592, 8, 44, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1593, 8, 45, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1594, 8, 46, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1595, 8, 47, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1596, 8, 48, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1597, 8, 49, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1598, 8, 50, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1599, 8, 51, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1600, 8, 52, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1601, 8, 53, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1602, 8, 54, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1603, 8, 55, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1604, 8, 56, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1605, 8, 57, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1606, 8, 58, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1607, 8, 59, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1608, 8, 60, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1609, 8, 61, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1610, 8, 62, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1611, 8, 63, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1612, 8, 64, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1613, 8, 65, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1614, 8, 66, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1615, 8, 67, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1616, 8, 68, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1617, 8, 69, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1618, 8, 70, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1619, 8, 71, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1620, 8, 72, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1621, 8, 73, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1622, 8, 74, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1623, 8, 75, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1624, 8, 76, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1625, 8, 77, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1626, 8, 78, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1627, 8, 79, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1628, 8, 80, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1629, 8, 81, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1630, 8, 82, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1631, 8, 83, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1632, 8, 84, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1633, 8, 85, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1634, 8, 86, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1635, 8, 87, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1636, 8, 88, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1637, 8, 89, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1638, 8, 90, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1639, 8, 91, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1640, 8, 92, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1641, 8, 93, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1642, 8, 94, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1643, 8, 95, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1644, 8, 96, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1645, 8, 97, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1646, 8, 98, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1647, 8, 99, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1648, 8, 100, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1649, 8, 101, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1650, 8, 102, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1651, 8, 103, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1652, 8, 104, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1653, 8, 105, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1654, 8, 106, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1655, 8, 107, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1656, 8, 108, NULL, NULL, '2018-12-13', '2018-12-16', 'done', 'completed'),
(1657, 8, 109, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1658, 8, 110, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1659, 8, 111, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1660, 8, 112, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1661, 8, 113, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1662, 8, 114, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1663, 8, 115, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1664, 8, 116, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1665, 8, 117, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1666, 8, 118, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1667, 8, 119, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1668, 8, 120, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1669, 8, 121, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1670, 8, 122, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1671, 8, 123, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1672, 8, 124, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1673, 8, 125, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1674, 8, 126, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1675, 8, 127, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1676, 8, 128, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1677, 8, 129, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1678, 8, 130, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1679, 8, 131, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1680, 8, 132, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1681, 8, 133, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1682, 8, 134, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1683, 8, 135, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1684, 8, 136, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1685, 8, 137, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1686, 8, 138, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1687, 8, 139, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1688, 8, 140, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1689, 8, 141, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1690, 8, 142, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1691, 8, 143, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1692, 8, 144, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1693, 8, 145, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1694, 8, 146, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1695, 8, 147, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1696, 8, 148, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1697, 8, 149, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1698, 8, 150, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1699, 8, 151, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1700, 8, 152, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1701, 8, 153, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1702, 8, 154, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1703, 8, 155, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1704, 8, 156, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1705, 8, 157, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1706, 8, 158, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1707, 8, 159, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1708, 8, 160, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending'),
(1709, 8, 161, NULL, NULL, '2018-12-13', '2018-12-16', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `taskassignees`
--

CREATE TABLE `taskassignees` (
  `seq` bigint(20) NOT NULL,
  `taskseq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskassignees`
--

INSERT INTO `taskassignees` (`seq`, `taskseq`, `userseq`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 3, 2),
(7, 4, 1),
(8, 4, 2),
(9, 5, 1),
(10, 5, 2),
(11, 6, 1),
(12, 6, 2),
(13, 7, 1),
(14, 7, 2),
(15, 8, 1),
(16, 8, 2),
(17, 9, 1),
(18, 9, 2),
(19, 10, 1),
(20, 10, 2),
(21, 11, 1),
(22, 11, 2),
(23, 12, 1),
(24, 12, 2),
(25, 13, 1),
(26, 13, 2),
(27, 14, 1),
(28, 14, 2),
(29, 15, 1),
(30, 15, 2),
(31, 16, 1),
(32, 16, 2),
(33, 17, 1),
(34, 17, 2),
(35, 18, 1),
(36, 18, 2),
(37, 19, 1),
(38, 19, 2),
(39, 20, 1),
(40, 20, 2),
(41, 21, 1),
(42, 21, 2),
(43, 22, 1),
(44, 22, 2),
(45, 23, 1),
(46, 23, 2),
(47, 24, 1),
(48, 24, 2),
(49, 25, 1),
(50, 25, 2),
(51, 26, 1),
(52, 26, 2),
(53, 27, 1),
(54, 27, 2),
(55, 28, 1),
(56, 28, 2),
(57, 29, 1),
(58, 29, 2),
(59, 30, 1),
(60, 30, 2),
(61, 31, 1),
(62, 31, 2),
(63, 32, 1),
(64, 32, 2),
(65, 33, 1),
(66, 33, 2),
(67, 34, 1),
(68, 34, 2),
(69, 35, 1),
(70, 35, 2),
(71, 36, 1),
(72, 36, 2),
(73, 37, 1),
(74, 37, 2),
(75, 38, 1),
(76, 38, 2),
(77, 39, 1),
(78, 39, 2),
(79, 40, 1),
(80, 40, 2),
(81, 41, 1),
(82, 41, 2),
(83, 42, 1),
(84, 42, 2),
(85, 43, 1),
(86, 43, 2),
(87, 44, 1),
(88, 44, 2),
(89, 45, 1),
(90, 45, 2),
(91, 46, 1),
(92, 46, 2),
(93, 47, 1),
(94, 47, 2),
(95, 48, 1),
(96, 48, 2),
(97, 49, 1),
(98, 49, 2),
(99, 50, 1),
(100, 50, 2),
(101, 51, 1),
(102, 51, 2),
(103, 52, 1),
(104, 52, 2),
(105, 53, 1),
(106, 53, 2),
(107, 54, 1),
(108, 54, 2),
(109, 55, 1),
(110, 55, 2),
(111, 56, 1),
(112, 56, 2),
(113, 57, 1),
(114, 57, 2),
(115, 58, 1),
(116, 58, 2),
(117, 59, 1),
(118, 59, 2),
(119, 60, 1),
(120, 60, 2),
(121, 61, 1),
(122, 61, 2),
(123, 62, 1),
(124, 62, 2),
(125, 63, 1),
(126, 63, 2),
(127, 64, 1),
(128, 64, 2),
(129, 65, 1),
(130, 65, 2),
(131, 66, 1),
(132, 66, 2),
(133, 67, 1),
(134, 67, 2),
(135, 68, 1),
(136, 68, 2),
(137, 69, 1),
(138, 69, 2),
(139, 70, 1),
(140, 70, 2),
(141, 71, 1),
(142, 71, 2),
(143, 72, 1),
(144, 72, 2),
(145, 73, 1),
(146, 73, 2),
(147, 74, 1),
(148, 74, 2),
(149, 75, 1),
(150, 75, 2),
(151, 76, 1),
(152, 76, 2),
(153, 77, 1),
(154, 77, 2),
(155, 78, 1),
(156, 78, 2),
(157, 79, 1),
(158, 79, 2),
(159, 80, 1),
(160, 80, 2),
(161, 81, 1),
(162, 81, 2),
(163, 82, 1),
(164, 82, 2),
(165, 83, 1),
(166, 83, 2),
(167, 84, 1),
(168, 84, 2),
(169, 85, 1),
(170, 85, 2),
(171, 86, 1),
(172, 86, 2),
(173, 87, 1),
(174, 87, 2),
(175, 88, 1),
(176, 88, 2),
(177, 89, 1),
(178, 89, 2),
(179, 90, 1),
(180, 90, 2),
(181, 91, 1),
(182, 91, 2),
(183, 92, 1),
(184, 92, 2),
(185, 93, 1),
(186, 93, 2),
(187, 94, 1),
(188, 94, 2),
(189, 95, 1),
(190, 95, 2),
(191, 96, 1),
(192, 96, 2),
(193, 97, 1),
(194, 97, 2),
(195, 98, 1),
(196, 98, 2),
(197, 99, 1),
(198, 99, 2),
(199, 100, 1),
(200, 100, 2),
(201, 101, 1),
(202, 101, 2),
(203, 102, 1),
(204, 102, 2),
(205, 103, 1),
(206, 103, 2),
(207, 104, 1),
(208, 104, 2),
(209, 105, 1),
(210, 105, 2),
(211, 106, 1),
(212, 106, 2),
(213, 107, 1),
(214, 107, 2),
(215, 108, 1),
(216, 108, 2),
(217, 109, 1),
(218, 109, 2),
(219, 110, 1),
(220, 110, 2),
(221, 111, 1),
(222, 111, 2),
(223, 112, 1),
(224, 112, 2),
(225, 113, 1),
(226, 113, 2),
(227, 114, 1),
(228, 114, 2),
(229, 115, 1),
(230, 115, 2),
(231, 116, 1),
(232, 116, 2),
(233, 117, 1),
(234, 117, 2),
(235, 118, 1),
(236, 118, 2),
(237, 119, 1),
(238, 119, 2),
(239, 120, 1),
(240, 120, 2),
(241, 121, 1),
(242, 121, 2),
(243, 122, 1),
(244, 122, 2),
(245, 123, 1),
(246, 123, 2),
(247, 124, 1),
(248, 124, 2),
(249, 125, 1),
(250, 125, 2),
(251, 126, 1),
(252, 126, 2),
(253, 127, 1),
(254, 127, 2),
(255, 128, 1),
(256, 128, 2),
(257, 129, 1),
(258, 129, 2),
(259, 130, 1),
(260, 130, 2),
(261, 131, 1),
(262, 131, 2),
(263, 132, 1),
(264, 132, 2),
(265, 133, 1),
(266, 133, 2),
(267, 134, 1),
(268, 134, 2),
(269, 135, 1),
(270, 135, 2),
(271, 136, 1),
(272, 136, 2),
(273, 137, 1),
(274, 137, 2),
(275, 138, 1),
(276, 138, 2),
(277, 139, 1),
(278, 139, 2),
(279, 140, 1),
(280, 140, 2),
(281, 141, 1),
(282, 141, 2),
(283, 142, 1),
(284, 142, 2),
(285, 143, 1),
(286, 143, 2),
(287, 144, 1),
(288, 144, 2),
(289, 145, 1),
(290, 145, 2),
(291, 146, 1),
(292, 146, 2),
(293, 147, 1),
(294, 147, 2),
(295, 148, 1),
(296, 148, 2),
(297, 149, 1),
(298, 149, 2),
(299, 150, 1),
(300, 150, 2),
(301, 151, 1),
(302, 151, 2),
(303, 152, 1),
(304, 152, 2),
(305, 153, 1),
(306, 153, 2),
(307, 154, 1),
(308, 154, 2),
(309, 155, 1),
(310, 155, 2),
(311, 156, 1),
(312, 156, 2),
(313, 157, 1),
(314, 157, 2),
(315, 158, 1),
(316, 158, 2),
(317, 159, 1),
(318, 159, 2),
(319, 160, 1),
(320, 160, 2),
(321, 161, 1),
(322, 161, 2);

-- --------------------------------------------------------

--
-- Table structure for table `taskcategories`
--

CREATE TABLE `taskcategories` (
  `seq` bigint(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskcategories`
--

INSERT INTO `taskcategories` (`seq`, `title`, `description`, `type`) VALUES
(1, 'Show Information', '', 'PRE'),
(2, 'Registration', '', 'PRE'),
(3, 'Staffing', '', 'PRE'),
(4, 'Receive Deadlines', '', 'PRE'),
(5, 'Set Deadlines', '', 'PRE'),
(6, 'Set Show Meetings', '', 'PRE'),
(7, 'Show Program', '', 'PRE'),
(8, 'Booth Products', '', 'PRE'),
(9, 'Utilities, Furnishing and Drayage', '', 'PRE'),
(10, 'Accessores and Supplies', '', 'PRE'),
(11, 'Graphics, Telemarketing and Email Marketing', '', 'PRE'),
(12, 'Marketing Collateral', '', 'PRE'),
(13, 'Computer System', '', 'PRE'),
(14, 'Shipping', '', 'PRE'),
(15, 'Pre-Show', '', 'PRE'),
(16, 'Show Time', '', 'PRE'),
(17, 'Post-Show', '', 'POST'),
(18, 'Show Sales Expenses Summary', '', 'POST');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `seq` bigint(20) NOT NULL,
  `taskcategoryseq` bigint(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `daysrequired` int(11) NOT NULL,
  `assignee` varchar(250) DEFAULT NULL,
  `startdatereferencedays` int(11) NOT NULL,
  `parenttaskseq` bigint(20) NOT NULL,
  `iscustom` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`seq`, `taskcategoryseq`, `title`, `description`, `daysrequired`, `assignee`, `startdatereferencedays`, `parenttaskseq`, `iscustom`) VALUES
(1, 1, 'Event Name', '', 3, 'munishsethi777@gmail.com,baljeetgaheer@gmail.com', 180, 0, NULL),
(2, 1, 'Show Venue & Address', '', 3, 'munishsethi777@gmail.com', 180, 1, NULL),
(3, 1, 'Reach out to customer for (to negotiate Early) Set Up Dates', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(4, 1, 'Reach out to customer to confirm Show Dates and Times', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(5, 1, 'Tear Down Dates', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(6, 1, 'Update Master Schedule in Both Master & Month tabs', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(7, 1, 'Update Wall Calendar', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(8, 1, '2ND WAVE OF INFO. NEED TO LABEL WHAT THIS IS.', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(9, 1, 'Retrieve Vendor Packet Online', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(10, 1, 'Retrieve Exhibitor Manual', '', 3, 'munishsethi777@gmail.com', 180, 2, NULL),
(11, 1, 'Show Decorator (Ie Freeman, Brede Etc.)', '', 3, 'munishsethi777@gmail.com', 180, 0, NULL),
(12, 1, 'Shipping Label - Advance Warehouse', '', 3, 'munishsethi777@gmail.com', 180, 0, NULL),
(13, 1, 'Shipping Label - Direct Show Site', '', 3, 'munishsethi777@gmail.com', 180, 0, NULL),
(14, 1, 'Shipping Label - Show Program/Pallet Alley', '', 3, 'munishsethi777@gmail.com', 180, 0, NULL),
(15, 1, 'Move-Out Information Sheet', '', 3, 'munishsethi777@gmail.com', 180, 0, NULL),
(16, 1, 'Booth Number', '', 3, 'munishsethi777@gmail.com', 180, 0, NULL),
(17, 1, 'Floor Plan & Booth Location', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(18, 1, 'Booth Dimensions', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(19, 2, 'PY Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(20, 2, 'PY Profitability Report', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(21, 2, 'Negotiate Cost, Booth Size, Payment Date and Method', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(22, 2, 'Set Meeting to Deliberate Attendance', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(23, 2, 'Number of Booths', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(24, 2, 'Complete Registration Form & Payment Request for RS Approval', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(25, 2, 'Send to Account Manager for Approval (due upon receipt)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(26, 2, 'Submit REGISTRATION FORM (& CREDIT MEMO APPROVAL if applicable)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(27, 2, 'Submit Names for Badges', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(28, 2, 'Send Submitted Registration Form & Approved Payment Request to Accounting', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(29, 3, 'PY Show Schedule', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(30, 3, 'Draft recommendation for staffing', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(31, 3, 'Robby to approve draft', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(32, 3, 'Determine block rooms/ Reservation website (to send to Caroline)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(33, 3, 'Send approved schedule to Caroline', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(34, 3, 'Update TS Master Travel Schedule', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(35, 3, 'Temp Labor', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(36, 3, 'Obtain quotes to determine labor agency', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(37, 3, 'Send request to labor agency of choice', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(38, 3, 'Receive confirmation that order is received and will be fulfilled', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(39, 3, 'Receive names and numbers of workers', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(40, 3, 'Relay the information received to Show Lead', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(41, 4, 'All Promotions including Pallet Alleys, Doorbusters -outside of the booth Due Date for Submission', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(42, 4, 'Pricing/Entire Program Due Date for Submission (Distributors)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(43, 4, 'ADVANCE ORDER DEADLINE - Utilities and Furnishings', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(44, 4, 'ADVANCE WAREHOUSE DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(45, 4, 'SHOW SITE DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(46, 4, 'HOTEL RESERVATION DEADLINE and Preferred Hotels for Best Rates\r\n-Sales People to sign with Mart one year in advance for hotels', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(47, 4, 'Confirm what our out of booth items are so we can begin product selection example Pallet Buys/Power Hours/ etc', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(48, 4, 'Confirm Product Listing for RSC, Container Hybrid Buys, Container Orders', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(49, 5, 'Complete Product Selection Spreadsheet DEADLINE -if we don\'t have pallet alleys, etc finalized we can have listed what we submitted', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(50, 5, 'Initial Product Selection DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(51, 5, 'Robby Product Selection DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(52, 5, 'Determine Sample Returns DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(53, 5, 'The deadline that a sales order request needs to be given to customer service', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(54, 5, 'Warehouse Needs Allocate and Provide Backorder Report Next Day', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(55, 5, 'Ship Product Out DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(56, 6, 'Pre-Show Planning with anyone attending the trade show', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(57, 6, 'Pre-Show Meeting', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(58, 6, 'Pre-Show Meeting1', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(59, 7, 'Type of Show - BOTH/SPRING/HOLIDAY SHOW', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(60, 7, 'PRICING -PRICELIST', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(61, 7, 'FREIGHT PROGRAM', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(62, 7, 'PALLET PROMOTIONS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(63, 7, 'OTHER PROMOTIONS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(64, 8, 'BOOTH PRODUCT SELECTION', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(65, 8, 'Show PROGRAM -IE PALLET ALLEY OR OTHER SHOW PROMOTIONS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(66, 8, 'RSC/CONTAINER ORDERS ETC.', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(67, 8, 'SAMPLE RETURNS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(68, 8, 'SO Request', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(69, 8, 'PRODUCT PHOTOS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(70, 8, 'SUMMARY OF SHIPMENTS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(71, 9, 'PY Summary of Utilties, Furnishings, and Drayage', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(72, 9, 'Determine what to order with Show Lead/Designer', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(73, 9, 'Decorator: Place Order', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(74, 9, 'Decorator: Receive confirmation', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(75, 9, 'Venue: Place Order', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(76, 9, 'Venue: Receive confirmation', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(77, 10, 'DESIGNERS\' ACCESSORY LIST', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(78, 10, 'OFFICE SUPPLIES LIST -w/ Printer&Ink', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(79, 11, 'Crate Show Invite Artwork', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(80, 11, 'Ensure PY Sales Report is available', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(81, 11, 'Ensure PY Day by Day Sales Report is avalable', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(82, 11, 'Create Customer Contact List', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(83, 11, 'Sales to Contact Customers', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(84, 11, 'Create Customer Email Blast List', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(85, 11, 'Email Blast 1', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(86, 11, 'Email Blast 2', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(87, 11, 'Create Thank You & We Missed You Artwork', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(88, 11, 'Create Thank You Email Blast List', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(89, 11, 'Thank You Email Blast', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(90, 12, 'Show Pallet Promotions File & Easel', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(91, 12, 'Show Promotions File & Easel ', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(92, 12, 'Show Program File & Easel', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(93, 12, 'Show Brochure Pdf File/to printer', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(94, 12, 'Show Brochure to Commerce/Show', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(95, 12, 'SHOW BINDER & MARKETING SUPPLIES', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(96, 12, 'SHOW BINDER', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(97, 12, 'SHOW TAGS - Show Special, Hot Buys, Must Buys', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(98, 12, 'SHOW EASELS - Pallet Promotions', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(99, 12, 'SHOW BROCHURES', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(100, 12, 'PRICELISTS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(101, 12, 'SPIFF BINDER', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(102, 13, 'SET DEADLINE: Computer System Ship Out Deadline', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(103, 13, 'Send laptop checklist to Joe N for preparation -Includes: laptop, router, ipads, scanners, laptop credit card reader', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(104, 13, 'Ship Computer System', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(105, 13, 'SET DEADLINE: Test Computer System onsite', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(106, 13, 'Test Computer System onsite', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(107, 13, 'SET DEADLINE: Computer System Ship Back Deadline', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(108, 13, 'Computer System Shipped Back - Tracking Information', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(109, 13, 'Receive Computer System, Complete ____ log, Send to CS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(110, 13, 'CS to apply return in OMS & send report of items not returned - Show Lead & Controller', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(111, 14, 'B/O\'S - Back orders', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(112, 14, 'BOL - Bill of Lading', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(113, 14, 'PACKING LIST', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(114, 14, 'INVOICES', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(115, 14, 'POD\'S - Proof of Deliveries', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(116, 14, 'Show/Decorator confirm receipt', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(117, 15, 'Pre-Show Brainstorming', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(118, 15, 'Pre-Show Meeting', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(119, 16, 'SET UP - Utilities', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(120, 16, 'SET UP - Labor -Show Lead to send copy of completed work tickets to HR/ cc HR in email', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(121, 16, 'TEAR DOWN - Utilities', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(122, 16, 'TEAR DOWN - Labor -Show Lead to send copy of completed work tickets to HR/ cc HR in email', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(123, 17, 'Pallet Return', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(124, 17, 'TS Coordinator to send out Move-Out Information -to Lead and Logistics', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(125, 17, 'Logistics Coordinator to send BOL to Show Lead cc TS Coordinator', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(126, 17, 'Show Lead to reply with copy of completed MHA', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(127, 17, 'Logistics Coordinator to confirm pick up', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(128, 17, 'Logistics Coordinator to track shipment and provide ETA', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(129, 17, 'Logistics Coordinator to confirm receipt of pallets in Commerce', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(130, 17, 'Warehouse to complete __________form & send to Customer Service -CS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(131, 17, 'CS to apply return in OMS & send report of items not returned (Show Lead & Controller)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(132, 17, 'Controller to advise Mktg Mgr & CS Mgr whether to replenish accessories', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(133, 17, 'Computer System Return', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(134, 18, 'Booth Sale', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(135, 18, 'Show Lead to send a copy of the completed Booth Sale Form to Accounting', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(136, 18, 'Accounting to receive and apply payment, \"wash\" Invoices not paid', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(137, 18, 'Invoicing Coordinator to update Ship To Address on Invoices based on Booth Sale', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(138, 18, 'Show Expenses', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(139, 18, 'Booth Fee', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(140, 18, 'Pallet Display Fee', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(141, 18, 'Booth Designer', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(142, 18, 'Promotions (Gift Card, iPad, Google Home)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(143, 18, 'Utilities (Water and Power)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(144, 18, 'Furnishings (Carpet, Table, Chairs, Wastebasket, Structure)', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(145, 18, 'Drayage', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(146, 18, 'Supplies', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(147, 18, 'Marketing Collateral', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(148, 18, 'Labor', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(149, 18, 'Travel', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(150, 18, 'Hotel', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(151, 18, 'Reimbursements', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(152, 18, 'Cost of Inventory', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(153, 18, 'Sale of Booth', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(154, 18, 'Freight', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(155, 18, 'Show Orders', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(156, 18, 'Receive Forecast orders in Excel format from Buyer to CS', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(157, 18, 'Date orders are expected to be received by', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(158, 18, 'Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(159, 18, 'Gift & Co-Op: Day By Day Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(160, 18, 'Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(161, 18, 'Profitability Report -P/L Statement', '', 3, 'munishsethi777@gmail.com', 180, 4, NULL),
(162, 1, 'New Task custom', 'New Task custom', 0, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tradeshoworderdetails`
--

CREATE TABLE `tradeshoworderdetails` (
  `seq` int(11) NOT NULL,
  `itemseq` int(11) NOT NULL,
  `warehouse` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `soamount` double DEFAULT NULL,
  `itemnote` varchar(500) DEFAULT NULL,
  `orderseq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tradeshoworderdetails`
--

INSERT INTO `tradeshoworderdetails` (`seq`, `itemseq`, `warehouse`, `quantity`, `price`, `soamount`, `itemnote`, `orderseq`) VALUES
(137, 9959, 1, 1, 374.2, 374.2, '10% FREIGHT CAP', 11),
(138, 9959, 1, 12, 180, 180, NULL, 12),
(139, 9959, 1, 1, 374.2, 374.2, '10% FREIGHT CAP', 13),
(140, 9959, 1, 12, 180, 180, NULL, 14),
(141, 9959, 1, 1, 374.2, 374.2, '10% FREIGHT CAP', 15),
(142, 9959, 1, 12, 180, 180, NULL, 16),
(143, 9959, 1, 1, 374.2, 374.2, '10% FREIGHT CAP', 17),
(144, 9959, 1, 12, 180, 180, NULL, 18),
(145, 9959, 1, 1, 374.2, 374.2, '10% FREIGHT CAP', 17),
(146, 9959, 1, 12, 180, 180, NULL, 18),
(147, 9959, 1, 1, 374.2, 374.2, '10% FREIGHT CAP', 17),
(148, 9959, 1, 12, 180, 180, NULL, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tradeshoworders`
--

CREATE TABLE `tradeshoworders` (
  `seq` bigint(20) NOT NULL,
  `customerseq` int(11) NOT NULL,
  `salerep` int(11) DEFAULT NULL,
  `salesordernumber` varchar(50) DEFAULT NULL,
  `sotype` varchar(10) DEFAULT NULL,
  `shipdt` date DEFAULT NULL,
  `custpo` varchar(20) DEFAULT NULL,
  `orderdate` date NOT NULL,
  `tradeshowseq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tradeshoworders`
--

INSERT INTO `tradeshoworders` (`seq`, `customerseq`, `salerep`, `salesordernumber`, `sotype`, `shipdt`, `custpo`, `orderdate`, `tradeshowseq`) VALUES
(11, 14, 999, '260817', '11', '2019-01-09', '1901H0017', '2019-01-08', 8),
(12, 14, 110, '260818', '11', '2019-01-15', '1901H0022', '2019-01-08', 8),
(13, 14, 999, '260817', '11', '2019-01-09', '1901H0017', '2019-01-08', 8),
(14, 14, 110, '260818', '11', '2019-01-15', '1901H0022', '2019-01-08', 8),
(15, 14, 999, '260817', '11', '2019-01-08', '1901H0017', '2019-01-08', 8),
(16, 14, 110, '260818', '11', '2019-01-08', '1901H0022', '2019-01-08', 8),
(17, 14, 999, '260817', '11', '2019-01-08', '1901H0017', '2019-01-08', 8),
(18, 14, 110, '260818', '11', '2019-01-08', '1901H0022', '2019-01-08', 8);

-- --------------------------------------------------------

--
-- Table structure for table `userdepartments`
--

CREATE TABLE `userdepartments` (
  `seq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL,
  `departmentseq` bigint(20) NOT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdepartments`
--

INSERT INTO `userdepartments` (`seq`, `userseq`, `departmentseq`, `createdon`, `lastmodifiedon`) VALUES
(27, 12, 1, '2019-06-12 06:24:56', '2019-06-12 06:24:56'),
(28, 12, 2, '2019-06-12 06:24:56', '2019-06-12 06:24:56'),
(41, 2, 1, '2019-06-12 11:25:05', '2019-06-12 11:25:05'),
(42, 2, 2, '2019-06-12 11:25:05', '2019-06-12 11:25:05'),
(45, 13, 1, '2019-06-12 11:39:45', '2019-06-12 11:39:45'),
(46, 13, 2, '2019-06-12 11:39:45', '2019-06-12 11:39:45'),
(51, 14, 1, '2019-06-12 11:41:20', '2019-06-12 11:41:20'),
(52, 14, 2, '2019-06-12 11:41:20', '2019-06-12 11:41:20'),
(63, 9, 1, '2019-06-14 06:19:11', '2019-06-14 06:19:11'),
(128, 25, 2, '2019-07-06 04:39:43', '2019-07-06 04:39:43'),
(137, 17, 1, '2019-07-06 04:40:59', '2019-07-06 04:40:59'),
(138, 10, 1, '2019-07-06 04:41:04', '2019-07-06 04:41:04'),
(139, 22, 1, '2019-07-06 04:41:11', '2019-07-06 04:41:11'),
(140, 20, 1, '2019-07-06 04:41:16', '2019-07-06 04:41:16'),
(141, 21, 1, '2019-07-06 04:41:22', '2019-07-06 04:41:22'),
(142, 19, 1, '2019-07-06 04:41:26', '2019-07-06 04:41:26'),
(143, 3, 1, '2019-07-06 04:41:31', '2019-07-06 04:41:31'),
(162, 15, 1, '2019-07-08 05:38:19', '2019-07-08 05:38:19'),
(163, 15, 2, '2019-07-08 05:38:19', '2019-07-08 05:38:19'),
(164, 16, 1, '2019-07-08 05:38:26', '2019-07-08 05:38:26'),
(165, 16, 2, '2019-07-08 05:38:26', '2019-07-08 05:38:26'),
(209, 23, 1, '2019-07-10 08:08:28', '2019-07-10 08:08:28'),
(210, 23, 2, '2019-07-10 08:08:28', '2019-07-10 08:08:28'),
(211, 23, 4, '2019-07-10 08:08:28', '2019-07-10 08:08:28'),
(224, 24, 1, '2019-07-12 07:17:14', '2019-07-12 07:17:14'),
(225, 24, 2, '2019-07-12 07:17:14', '2019-07-12 07:17:14'),
(226, 24, 4, '2019-07-12 07:17:14', '2019-07-12 07:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `seq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `createdon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`seq`, `userseq`, `role`, `createdon`) VALUES
(54, 18, 'ADMIN', '2019-06-20 00:00:00'),
(81, 25, 'graphic_designer', '2019-07-06 04:39:43'),
(88, 17, 'qc', '2019-07-06 04:40:59'),
(89, 10, 'qc', '2019-07-06 04:41:04'),
(90, 22, 'qc', '2019-07-06 04:41:11'),
(91, 20, 'qc', '2019-07-06 04:41:16'),
(92, 21, 'qc', '2019-07-06 04:41:22'),
(93, 19, 'qc', '2019-07-06 04:41:26'),
(94, 3, 'qc', '2019-07-06 04:41:31'),
(117, 15, 'usa_team', '2019-07-08 05:38:19'),
(118, 15, 'china_team', '2019-07-08 05:38:19'),
(119, 15, 'graphic_designer', '2019-07-08 05:38:19'),
(196, 23, 'class_code', '2019-07-10 08:08:28'),
(197, 23, 'graphic_designer', '2019-07-10 08:08:28'),
(198, 23, 'container_delivery_information', '2019-07-10 08:08:28'),
(199, 23, 'container_office_information', '2019-07-10 08:08:28'),
(221, 24, 'class_code', '2019-07-12 07:17:14'),
(222, 24, 'usa_team', '2019-07-12 07:17:14'),
(223, 24, 'china_team', '2019-07-12 07:17:14'),
(224, 24, 'graphic_designer', '2019-07-12 07:17:14'),
(225, 24, 'container_information', '2019-07-12 07:17:14'),
(226, 24, 'container_delivery_information', '2019-07-12 07:17:14'),
(227, 24, 'container_office_information', '2019-07-12 07:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `seq` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `isenabled` tinyint(4) NOT NULL,
  `qccode` varchar(50) DEFAULT NULL,
  `isqc` tinyint(4) DEFAULT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `issendnotifications` tinyint(4) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `lastmodifiedon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`seq`, `email`, `password`, `fullname`, `mobile`, `isenabled`, `qccode`, `isqc`, `usertype`, `issendnotifications`, `createdon`, `lastmodifiedon`) VALUES
(3, 'richard@alpinecn.com', 'Rich!234', 'Richard Stems', '5622531231', 1, 'RICHARD', 1, 'USER', 1, NULL, '2019-07-06 04:41:31'),
(10, 'Terry@alpinecn.com', 'Terr!234', 'Terry', '5622531231', 1, 'TERRY', NULL, 'USER', 1, NULL, '2019-07-06 04:41:04'),
(15, 'JVyas@Alpine4u.com', 'Pass!234', 'Jignesh Vyas', '5622531231', 1, NULL, NULL, 'SUPERVISOR', 1, NULL, '2019-07-08 05:38:19'),
(16, 'THan@Alpine4u.com', 't@llCoal14', 'Toby Han', '', 1, NULL, NULL, 'SUPERVISOR', 1, NULL, '2019-07-08 05:38:26'),
(17, 'Jacky@alpinecn.com', 'Jack!234', 'Jacky', '5622531231', 1, 'JACKY', NULL, 'USER', 1, NULL, '2019-07-06 04:40:59'),
(18, 'admin@Alpine4u.com', 'Pass!234', 'admin', '', 1, NULL, NULL, 'ADMIN', 1, '2019-06-15 20:34:25', '2019-06-15 20:34:25'),
(19, 'Owen@alpinecn.com', 'Owen!234', 'Owen', '5622531231', 1, 'OWEN', NULL, 'USER', 1, NULL, '2019-07-06 04:41:26'),
(20, 'Niko@alpinecn.com', 'Niko!234', 'Niko', '5622531231', 1, 'NIKO', NULL, 'USER', 1, NULL, '2019-07-06 04:41:16'),
(21, 'Jones@alpinecn.com', 'Jone!234', 'Jones', '5622531231', 1, 'JONES', NULL, 'USER', 1, NULL, '2019-07-06 04:41:22'),
(22, 'Joy@alpinecn.com', 'Joy!234', 'Joy', '5622531231', 1, 'JOY', NULL, 'USER', 1, NULL, '2019-07-06 04:41:11'),
(23, 'Tyson@AlpineCN.Com', 'Tyso!234', 'Tyson', '5622531231', 1, NULL, NULL, 'SUPERVISOR', 1, NULL, '2019-07-10 08:08:28'),
(24, 'baljeetgaheer@gmail.com', '123', 'Munish Sethi', '9814600356', 1, NULL, NULL, 'SUPERVISOR', 1, NULL, '2019-07-12 07:17:14'),
(25, 'Graphics7@Alpine4u.com', 'Pass!234', 'Joe', '', 1, NULL, NULL, 'USER', 1, NULL, '2019-07-06 04:39:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `classcodes`
--
ALTER TABLE `classcodes`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `classcode` (`classcode`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `containerscheduledates`
--
ALTER TABLE `containerscheduledates`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `containerschedulenotes`
--
ALTER TABLE `containerschedulenotes`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `containerschedules`
--
ALTER TABLE `containerschedules`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `customerid` (`customerid`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `graphicslogs`
--
ALTER TABLE `graphicslogs`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `usaofficeentrydate` (`usaofficeentrydate`,`sku`,`customername`),
  ADD KEY `delete_code_1` (`classcodeseq`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `itemno` (`itemno`);

--
-- Indexes for table `itemspecifications`
--
ALTER TABLE `itemspecifications`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `itemno` (`itemno`);

--
-- Indexes for table `itemspecificationverions`
--
ALTER TABLE `itemspecificationverions`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `qcschedules`
--
ALTER TABLE `qcschedules`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `po` (`po`,`itemnumbers`),
  ADD KEY `delete_code` (`classcodeseq`);

--
-- Indexes for table `qcschedulesapproval`
--
ALTER TABLE `qcschedulesapproval`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `showtaskassignees`
--
ALTER TABLE `showtaskassignees`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `showtaskfiles`
--
ALTER TABLE `showtaskfiles`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `showtasks`
--
ALTER TABLE `showtasks`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `taskassignees`
--
ALTER TABLE `taskassignees`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `taskcategories`
--
ALTER TABLE `taskcategories`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `tradeshoworderdetails`
--
ALTER TABLE `tradeshoworderdetails`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `tradeshoworders`
--
ALTER TABLE `tradeshoworders`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `userdepartments`
--
ALTER TABLE `userdepartments`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `UniqueUserDepartment` (`userseq`,`departmentseq`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`seq`),
  ADD KEY `DeleteUserRoles` (`userseq`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classcodes`
--
ALTER TABLE `classcodes`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `containerscheduledates`
--
ALTER TABLE `containerscheduledates`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `containerschedulenotes`
--
ALTER TABLE `containerschedulenotes`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `containerschedules`
--
ALTER TABLE `containerschedules`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `graphicslogs`
--
ALTER TABLE `graphicslogs`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4353;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9960;

--
-- AUTO_INCREMENT for table `itemspecifications`
--
ALTER TABLE `itemspecifications`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010;

--
-- AUTO_INCREMENT for table `itemspecificationverions`
--
ALTER TABLE `itemspecificationverions`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `qcschedules`
--
ALTER TABLE `qcschedules`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5801;

--
-- AUTO_INCREMENT for table `qcschedulesapproval`
--
ALTER TABLE `qcschedulesapproval`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `showtaskassignees`
--
ALTER TABLE `showtaskassignees`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3424;

--
-- AUTO_INCREMENT for table `showtaskfiles`
--
ALTER TABLE `showtaskfiles`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `showtasks`
--
ALTER TABLE `showtasks`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1710;

--
-- AUTO_INCREMENT for table `taskassignees`
--
ALTER TABLE `taskassignees`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `taskcategories`
--
ALTER TABLE `taskcategories`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `tradeshoworderdetails`
--
ALTER TABLE `tradeshoworderdetails`
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tradeshoworders`
--
ALTER TABLE `tradeshoworders`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userdepartments`
--
ALTER TABLE `userdepartments`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `graphicslogs`
--
ALTER TABLE `graphicslogs`
  ADD CONSTRAINT `delete_code_1` FOREIGN KEY (`classcodeseq`) REFERENCES `classcodes` (`seq`) ON UPDATE NO ACTION;

--
-- Constraints for table `qcschedules`
--
ALTER TABLE `qcschedules`
  ADD CONSTRAINT `delete_code` FOREIGN KEY (`classcodeseq`) REFERENCES `classcodes` (`seq`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
