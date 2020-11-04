-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2020 at 08:34 AM
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
-- Table structure for table `customerspringquestions`
--
Alter TABLE `customerspringquestions` 
  Modify `seq` bigint(20) NOT NULL,
  Modify `customerseq` bigint(20) NOT NULL after seq,
  Modify `isallcategoriesselected` tinyint(4) DEFAULT NULL after `customerseq` ,
  Modify `year` int(11) DEFAULT NULL after `isallcategoriesselected` ,
  Modify `issentcataloglink` tinyint(4) DEFAULT NULL after `year` ,
  Modify `springcataloglinkdate` date DEFAULT NULL after `issentcataloglink` ,
  Modify `tradeshowsaregoingto` varchar(1000) DEFAULT NULL after `springcataloglinkdate` ,
  Modify `isdinnerappt` tinyint(4) DEFAULT NULL after `tradeshowsaregoingto` ,
  Modify `dinnerapptplace` text after `isdinnerappt` ,
  Modify `ispitchmainvendor` tinyint(4) DEFAULT NULL after `dinnerapptplace` ,
  Modify `isvisitcustomerduring2ndqtr` tinyint(4) DEFAULT NULL after `ispitchmainvendor` ,
  Modify `issentsample` tinyint(4) DEFAULT NULL after `isvisitcustomerduring2ndqtr` ,
  Modify `isstrategicplanningmeeting` tinyint(4) DEFAULT NULL after `issentsample` ,
  Modify `categoriesshouldsellthem` varchar(1000) DEFAULT NULL after `isstrategicplanningmeeting` ,
  Modify `isinvitedtospringshowroom` tinyint(4) DEFAULT NULL after `categoriesshouldsellthem` ,
  Modify `springreviewingdate` date DEFAULT NULL after `isinvitedtospringshowroom` ,
  Modify `issellthrough` tinyint(4) DEFAULT NULL after `springreviewingdate` ,
  Modify `isreviewedsellthru` tinyint(4) DEFAULT NULL after `issellthrough` ,
  Modify `isvisitcustomer2qtr` tinyint(4) DEFAULT NULL after `isreviewedsellthru` ,
  Modify `customerselectingspringitemsfrom` varchar(200) DEFAULT NULL after `isvisitcustomer2qtr` ,
  Modify `compshopcompletiondate` date DEFAULT NULL after `customerselectingspringitemsfrom` ,
  Modify `iscompshopsummaryemailsent` tinyint(4) DEFAULT NULL after `compshopcompletiondate` ,
  Modify `compshopsummeryemailsentdate` date DEFAULT NULL after `iscompshopsummaryemailsent` ,
  Modify `isquotedforspring` tinyint(4) DEFAULT NULL after `compshopsummeryemailsentdate` ,
  Modify `itemselectionfinalized` int(11) DEFAULT NULL after `isquotedforspring` ,
  Modify `itemspurchasedlastyear` int(11) DEFAULT NULL after `itemselectionfinalized` ,
  Modify `finalizedtyvsly` varchar(50) DEFAULT NULL after `itemspurchasedlastyear` ,
  Modify `arepoexpecting` varchar(50) DEFAULT NULL after `finalizedtyvsly` ,
  Modify `expectingpodate` date DEFAULT NULL after `arepoexpecting` ,
  Modify `isopportunitiessent` tinyint(4) DEFAULT NULL after `expectingpodate` ,
  Modify `opportunitiessentdate` date DEFAULT NULL after `isopportunitiessent` ,
  Modify `category` varchar(1000) NOT NULL after `opportunitiessentdate` ,
  Modify `sentcataloglinknotes` varchar(1000) DEFAULT NULL after `category` ,
  Modify `pitchmainvendornotes` varchar(1000) DEFAULT NULL after `sentcataloglinknotes` ,
  Modify `strategicplanningmeetingdate` date DEFAULT NULL after `pitchmainvendornotes` ,
  Modify `invitedtospringshowroomdate` date DEFAULT NULL after `strategicplanningmeetingdate` ,
  Modify `invitedtospringshowroomreminderdate` date DEFAULT NULL after `invitedtospringshowroomdate` ,
  Modify `isrobbyreviewedsellthrough` tinyint(4) DEFAULT NULL after `invitedtospringshowroomreminderdate` ,
  Modify `iscomposhopcompleted` tinyint(4) DEFAULT NULL after `isrobbyreviewedsellthrough` ,
  Modify `christmasquotebydate` date DEFAULT NULL after `iscomposhopcompleted` ,
  Modify `appointmentplace` varchar(500) NOT NULL after `quotespringbydate` ,
  Modify `springsampledate` date DEFAULT NULL after `appointmentplace` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerspringquestions`
--
ALTER TABLE `customerspringquestions`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerspringquestions`
--
ALTER TABLE `customerspringquestions`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
