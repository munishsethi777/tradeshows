-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2020 at 09:03 AM
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
-- Table structure for table `customerchristmasquestions`
--

Alter TABLE `customerchristmasquestions`
  Modify  `seq` bigint(20) NOT NULL,
  Modify  `customerseq` bigint(20) NOT NULL after `seq` ,
  Modify  `isinterested` tinyint(4) DEFAULT NULL after `customerseq` ,
  Modify  `iscataloglinksent` tinyint(4) DEFAULT NULL after `isinterested` ,
  Modify  `cataloglinkdate` date DEFAULT NULL after `iscataloglinksent` ,
  Modify  `tradeshowsaregoingto` varchar(1000) DEFAULT NULL after `cataloglinkdate` ,
  Modify  `isdinnerappt` tinyint(4) DEFAULT NULL after `tradeshowsaregoingto` ,
  Modify  `dinnerapptplace` varchar(500) DEFAULT NULL after `isdinnerappt` ,
  Modify  `ispitchmainvendor` tinyint(4) DEFAULT NULL after `dinnerapptplace` ,
  Modify  `istheremorebuyers` tinyint(4) DEFAULT NULL after `ispitchmainvendor` ,
  Modify  `isxmassamplessent` tinyint(4) DEFAULT NULL after `istheremorebuyers` ,
  Modify  `xmassamplesentdate` date DEFAULT NULL after `isxmassamplessent` ,
  Modify  `isstrategicplanningmeetingappointment` tinyint(4) DEFAULT NULL after `xmassamplesentdate` ,
  Modify  `strategicplanningmeetdate` date DEFAULT NULL after `isstrategicplanningmeetingappointment` ,
  Modify  `categoriesshouldsellthem` varchar(1000) DEFAULT NULL after `strategicplanningmeetdate` ,
  Modify  `isinvitedtoxmasshowroom` tinyint(4) DEFAULT NULL after `categoriesshouldsellthem` ,
  Modify  `christmas2020reviewingdate` date DEFAULT NULL after `isinvitedtoxmasshowroom` ,
  Modify  `isreceivingsellthru` tinyint(4) DEFAULT NULL after `christmas2020reviewingdate` ,
  Modify  `isreviewedsellthru` tinyint(4) DEFAULT NULL after `isreceivingsellthru` ,
  Modify  `isvisitcustomerin4qtr` tinyint(4) DEFAULT NULL after `isreviewedsellthru` ,
  Modify  `customerselectxmasitemsfrom` varchar(200) DEFAULT NULL after `isvisitcustomerin4qtr` ,
  Modify  `isholidayshopcompleted` tinyint(4) DEFAULT NULL after `customerselectxmasitemsfrom` ,
  Modify  `isholidayshopcomsummaryemailsent` tinyint(4) DEFAULT NULL after `isholidayshopcompleted` ,
  Modify  `compshopsummaryemailsentdate` date DEFAULT NULL after `isholidayshopcomsummaryemailsent` ,
  Modify  `isquotedforxmas` tinyint(4) DEFAULT NULL after `compshopsummaryemailsentdate` ,
  Modify  `itemselectionfinalized` tinyint(4) DEFAULT NULL after `isquotedforxmas` ,
  Modify  `itemspurchasedlastyear` int(11) DEFAULT NULL after `itemselectionfinalized` ,
  Modify  `finalizedtyvsly` int(11) DEFAULT NULL after `itemspurchasedlastyear` ,
  Modify  `arepoexpecting` varchar(50) DEFAULT NULL after `finalizedtyvsly` ,
  Modify  `expectingpodate` date DEFAULT NULL after `arepoexpecting` ,
  Modify  `isopportunitiessent` tinyint(4) DEFAULT NULL after `expectingpodate` ,
  Modify  `opportunitiessentdate` date DEFAULT NULL after `isopportunitiessent` ,
  Modify  `cataloglinksentnotes` varchar(1000) DEFAULT NULL after `opportunitiessentdate` ,
  Modify  `ismainvendor` tinyint(4) DEFAULT NULL after `cataloglinksentnotes` ,
  Modify  `mainvendornotes` varchar(1000) DEFAULT NULL after `ismainvendor` ,
  Modify  `invitedtoxmasshowroomdate` date DEFAULT NULL after `mainvendornotes` ,
  Modify  `invitedtoxmasshowroomreminderdate` date DEFAULT NULL after `invitedtoxmasshowroomdate` ,
  Modify  `isxmasbuylastyear` tinyint(4) DEFAULT NULL after `invitedtoxmasshowroomreminderdate` ,
  Modify  `xmasbuylastyearamount` double DEFAULT NULL after `isxmasbuylastyear` ,
  Modify  `isrobbyreviewedsellthrough` tinyint(4) DEFAULT NULL after `xmasbuylastyearamount` ,
  Modify  `christmasquotebydate` date DEFAULT NULL after `isrobbyreviewedsellthrough` ,
  Modify  `year` int(11) DEFAULT NULL after `christmasquotebydate` ,
  Modify  `dinnerapptdate` date DEFAULT NULL after `year` 


--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerchristmasquestions`
--
ALTER TABLE `customerchristmasquestions`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerchristmasquestions`
--
ALTER TABLE `customerchristmasquestions`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
