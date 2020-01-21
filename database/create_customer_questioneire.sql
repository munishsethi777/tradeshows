-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 21, 2020 at 08:19 AM
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
-- Table structure for table `customerchristmasquestions`
--

CREATE TABLE `customerchristmasquestions` (
  `seq` bigint(20) NOT NULL,
  `customerseq` bigint(20) NOT NULL,
  `isinterested` tinyint(4) DEFAULT NULL,
  `iscataloglinksent` tinyint(4) DEFAULT NULL,
  `cataloglinksentnotes` varchar(1000) DEFAULT NULL,
  `ismainvendor` tinyint(4) DEFAULT NULL,
  `mainvendornotes` varchar(1000) DEFAULT NULL,
  `isxmassamplessent` tinyint(4) DEFAULT NULL,
  `isstrategicplanningmeetingappointment` tinyint(4) DEFAULT NULL,
  `strategicplanningmeetdate` date DEFAULT NULL,
  `isinvitedtoxmasshowroom` tinyint(4) DEFAULT NULL,
  `invitedtoxmasshowroomdate` date DEFAULT NULL,
  `invitedtoxmasshowroomreminderdate` date DEFAULT NULL,
  `isholidayshopcompleted` tinyint(4) DEFAULT NULL,
  `isholidayshopcomsummaryemailsent` tinyint(4) DEFAULT NULL,
  `christmas2020reviewingdate` date DEFAULT NULL,
  `customerselectxmasitemsfrom` varchar(200) DEFAULT NULL,
  `isxmasbuylastyear` tinyint(4) DEFAULT NULL,
  `xmasbuylastyearamount` double DEFAULT NULL,
  `isreceivingsellthru` tinyint(4) DEFAULT NULL,
  `isrobbyreviewedsellthrough` tinyint(4) DEFAULT NULL,
  `isvisitcustomerin4qtr` tinyint(4) DEFAULT NULL,
  `christmasquotebydate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customeroppurtunitybuys`
--

CREATE TABLE `customeroppurtunitybuys` (
  `seq` bigint(20) NOT NULL,
  `customerseq` bigint(20) NOT NULL,
  `tradeshowsgoingto` varchar(100) DEFAULT NULL,
  `dinnerappointmentdate` date DEFAULT NULL,
  `closeoutleftoversincedate` date DEFAULT NULL,
  `isxmascateloglinksent` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customerspringquestions`
--

CREATE TABLE `customerspringquestions` (
  `seq` bigint(20) NOT NULL,
  `customerseq` bigint(20) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `issentcataloglink` tinyint(4) DEFAULT NULL,
  `sentcataloglinknotes` varchar(1000) DEFAULT NULL,
  `ispitchmainvendor` tinyint(4) DEFAULT NULL,
  `pitchmainvendornotes` varchar(1000) DEFAULT NULL,
  `issentsample` tinyint(4) DEFAULT NULL,
  `categoriesshouldsellthem` varchar(1000) DEFAULT NULL,
  `isstrategicplanningmeeting` tinyint(4) DEFAULT NULL,
  `strategicplanningmeetingdate` date DEFAULT NULL,
  `isinvitedtospringshowroom` tinyint(4) DEFAULT NULL,
  `invitedtospringshowroomdate` date DEFAULT NULL,
  `invitedtospringshowroomreminderdate` date DEFAULT NULL,
  `issellthrough` tinyint(4) DEFAULT NULL,
  `isrobbyreviewedsellthrough` tinyint(4) DEFAULT NULL,
  `isvisitcustomer2qtr` tinyint(4) DEFAULT NULL,
  `iscomposhopcompleted` tinyint(4) DEFAULT NULL,
  `iscompshopsummaryemailsent` tinyint(4) DEFAULT NULL,
  `christmasquotebydate` date DEFAULT NULL,
  `springreviewingdate` date DEFAULT NULL,
  `customerselectingspringitemsfrom` varchar(200) DEFAULT NULL,
  `isvisitcustomerduring2ndqtr` tinyint(4) DEFAULT NULL,
  `quotespringbydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerchristmasquestions`
--
ALTER TABLE `customerchristmasquestions`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `customeroppurtunitybuys`
--
ALTER TABLE `customeroppurtunitybuys`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `customerspringquestions`
--
ALTER TABLE `customerspringquestions`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerchristmasquestions`
--
ALTER TABLE `customerchristmasquestions`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customeroppurtunitybuys`
--
ALTER TABLE `customeroppurtunitybuys`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerspringquestions`
--
ALTER TABLE `customerspringquestions`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
