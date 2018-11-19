-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2018 at 04:18 PM
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
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `seq` bigint(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `showtasks`
--

CREATE TABLE `showtasks` (
  `seq` bigint(20) NOT NULL,
  `showseq` bigint(20) NOT NULL,
  `taskseq` bigint(20) NOT NULL,
  `daysrequired` int(11) NOT NULL,
  `assignee` varchar(500) NOT NULL,
  `startdatereferencedays` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `comments` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taskcategory`
--

CREATE TABLE `taskcategory` (
  `seq` bigint(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskcategory`
--

INSERT INTO `taskcategory` (`seq`, `title`, `description`, `type`) VALUES
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
  `assignee` varchar(250) NOT NULL,
  `startdatereferencedays` int(11) NOT NULL,
  `parenttaskseq` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`seq`, `taskcategoryseq`, `title`, `description`, `daysrequired`, `assignee`, `startdatereferencedays`, `parenttaskseq`) VALUES
(1, 1, 'Event Name', '', 3, 'munishsethi777@gmail.com,baljeetgaheer@gmail.com', 180, 0),
(2, 1, 'Show Venue & Address', '', 3, 'munishsethi777@gmail.com', 180, 1),
(3, 1, 'Reach out to customer for (to negotiate Early) Set Up Dates', '', 3, 'munishsethi777@gmail.com', 180, 2),
(4, 1, 'Reach out to customer to confirm Show Dates and Times', '', 3, 'munishsethi777@gmail.com', 180, 2),
(5, 1, 'Tear Down Dates', '', 3, 'munishsethi777@gmail.com', 180, 2),
(6, 1, 'Update Master Schedule in Both Master & Month tabs', '', 3, 'munishsethi777@gmail.com', 180, 2),
(7, 1, 'Update Wall Calendar', '', 3, 'munishsethi777@gmail.com', 180, 2),
(8, 1, '2ND WAVE OF INFO. NEED TO LABEL WHAT THIS IS.', '', 3, 'munishsethi777@gmail.com', 180, 2),
(9, 1, 'Retrieve Vendor Packet Online', '', 3, 'munishsethi777@gmail.com', 180, 2),
(10, 1, 'Retrieve Exhibitor Manual', '', 3, 'munishsethi777@gmail.com', 180, 2),
(11, 1, 'Show Decorator (Ie Freeman, Brede Etc.)', '', 3, 'munishsethi777@gmail.com', 180, 0),
(12, 1, 'Shipping Label - Advance Warehouse', '', 3, 'munishsethi777@gmail.com', 180, 0),
(13, 1, 'Shipping Label - Direct Show Site', '', 3, 'munishsethi777@gmail.com', 180, 0),
(14, 1, 'Shipping Label - Show Program/Pallet Alley', '', 3, 'munishsethi777@gmail.com', 180, 0),
(15, 1, 'Move-Out Information Sheet', '', 3, 'munishsethi777@gmail.com', 180, 0),
(16, 1, 'Booth Number', '', 3, 'munishsethi777@gmail.com', 180, 0),
(17, 1, 'Floor Plan & Booth Location', '', 3, 'munishsethi777@gmail.com', 180, 4),
(18, 1, 'Booth Dimensions', '', 3, 'munishsethi777@gmail.com', 180, 4),
(19, 2, 'PY Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4),
(20, 2, 'PY Profitability Report', '', 3, 'munishsethi777@gmail.com', 180, 4),
(21, 2, 'Negotiate Cost, Booth Size, Payment Date and Method', '', 3, 'munishsethi777@gmail.com', 180, 4),
(22, 2, 'Set Meeting to Deliberate Attendance', '', 3, 'munishsethi777@gmail.com', 180, 4),
(23, 2, 'Number of Booths', '', 3, 'munishsethi777@gmail.com', 180, 4),
(24, 2, 'Complete Registration Form & Payment Request for RS Approval', '', 3, 'munishsethi777@gmail.com', 180, 4),
(25, 2, 'Send to Account Manager for Approval (due upon receipt)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(26, 2, 'Submit REGISTRATION FORM (& CREDIT MEMO APPROVAL if applicable)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(27, 2, 'Submit Names for Badges', '', 3, 'munishsethi777@gmail.com', 180, 4),
(28, 2, 'Send Submitted Registration Form & Approved Payment Request to Accounting', '', 3, 'munishsethi777@gmail.com', 180, 4),
(29, 3, 'PY Show Schedule', '', 3, 'munishsethi777@gmail.com', 180, 4),
(30, 3, 'Draft recommendation for staffing', '', 3, 'munishsethi777@gmail.com', 180, 4),
(31, 3, 'Robby to approve draft', '', 3, 'munishsethi777@gmail.com', 180, 4),
(32, 3, 'Determine block rooms/ Reservation website (to send to Caroline)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(33, 3, 'Send approved schedule to Caroline', '', 3, 'munishsethi777@gmail.com', 180, 4),
(34, 3, 'Update TS Master Travel Schedule', '', 3, 'munishsethi777@gmail.com', 180, 4),
(35, 3, 'Temp Labor', '', 3, 'munishsethi777@gmail.com', 180, 4),
(36, 3, 'Obtain quotes to determine labor agency', '', 3, 'munishsethi777@gmail.com', 180, 4),
(37, 3, 'Send request to labor agency of choice', '', 3, 'munishsethi777@gmail.com', 180, 4),
(38, 3, 'Receive confirmation that order is received and will be fulfilled', '', 3, 'munishsethi777@gmail.com', 180, 4),
(39, 3, 'Receive names and numbers of workers', '', 3, 'munishsethi777@gmail.com', 180, 4),
(40, 3, 'Relay the information received to Show Lead', '', 3, 'munishsethi777@gmail.com', 180, 4),
(41, 4, 'All Promotions including Pallet Alleys, Doorbusters -outside of the booth Due Date for Submission', '', 3, 'munishsethi777@gmail.com', 180, 4),
(42, 4, 'Pricing/Entire Program Due Date for Submission (Distributors)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(43, 4, 'ADVANCE ORDER DEADLINE - Utilities and Furnishings', '', 3, 'munishsethi777@gmail.com', 180, 4),
(44, 4, 'ADVANCE WAREHOUSE DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4),
(45, 4, 'SHOW SITE DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4),
(46, 4, 'HOTEL RESERVATION DEADLINE and Preferred Hotels for Best Rates\r\n-Sales People to sign with Mart one year in advance for hotels', '', 3, 'munishsethi777@gmail.com', 180, 4),
(47, 4, 'Confirm what our out of booth items are so we can begin product selection example Pallet Buys/Power Hours/ etc', '', 3, 'munishsethi777@gmail.com', 180, 4),
(48, 4, 'Confirm Product Listing for RSC, Container Hybrid Buys, Container Orders', '', 3, 'munishsethi777@gmail.com', 180, 4),
(49, 5, 'Complete Product Selection Spreadsheet DEADLINE -if we don\'t have pallet alleys, etc finalized we can have listed what we submitted', '', 3, 'munishsethi777@gmail.com', 180, 4),
(50, 5, 'Initial Product Selection DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4),
(51, 5, 'Robby Product Selection DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4),
(52, 5, 'Determine Sample Returns DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4),
(53, 5, 'The deadline that a sales order request needs to be given to customer service', '', 3, 'munishsethi777@gmail.com', 180, 4),
(54, 5, 'Warehouse Needs Allocate and Provide Backorder Report Next Day', '', 3, 'munishsethi777@gmail.com', 180, 4),
(55, 5, 'Ship Product Out DEADLINE', '', 3, 'munishsethi777@gmail.com', 180, 4),
(56, 6, 'Pre-Show Planning with anyone attending the trade show', '', 3, 'munishsethi777@gmail.com', 180, 4),
(57, 6, 'Pre-Show Meeting', '', 3, 'munishsethi777@gmail.com', 180, 4),
(58, 6, 'Pre-Show Meeting1', '', 3, 'munishsethi777@gmail.com', 180, 4),
(59, 7, 'Type of Show - BOTH/SPRING/HOLIDAY SHOW', '', 3, 'munishsethi777@gmail.com', 180, 4),
(60, 7, 'PRICING -PRICELIST', '', 3, 'munishsethi777@gmail.com', 180, 4),
(61, 7, 'FREIGHT PROGRAM', '', 3, 'munishsethi777@gmail.com', 180, 4),
(62, 7, 'PALLET PROMOTIONS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(63, 7, 'OTHER PROMOTIONS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(64, 8, 'BOOTH PRODUCT SELECTION', '', 3, 'munishsethi777@gmail.com', 180, 4),
(65, 8, 'Show PROGRAM -IE PALLET ALLEY OR OTHER SHOW PROMOTIONS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(66, 8, 'RSC/CONTAINER ORDERS ETC.', '', 3, 'munishsethi777@gmail.com', 180, 4),
(67, 8, 'SAMPLE RETURNS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(68, 8, 'SO Request', '', 3, 'munishsethi777@gmail.com', 180, 4),
(69, 8, 'PRODUCT PHOTOS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(70, 8, 'SUMMARY OF SHIPMENTS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(71, 9, 'PY Summary of Utilties, Furnishings, and Drayage', '', 3, 'munishsethi777@gmail.com', 180, 4),
(72, 9, 'Determine what to order with Show Lead/Designer', '', 3, 'munishsethi777@gmail.com', 180, 4),
(73, 9, 'Decorator: Place Order', '', 3, 'munishsethi777@gmail.com', 180, 4),
(74, 9, 'Decorator: Receive confirmation', '', 3, 'munishsethi777@gmail.com', 180, 4),
(75, 9, 'Venue: Place Order', '', 3, 'munishsethi777@gmail.com', 180, 4),
(76, 9, 'Venue: Receive confirmation', '', 3, 'munishsethi777@gmail.com', 180, 4),
(77, 10, 'DESIGNERS\' ACCESSORY LIST', '', 3, 'munishsethi777@gmail.com', 180, 4),
(78, 10, 'OFFICE SUPPLIES LIST -w/ Printer&Ink', '', 3, 'munishsethi777@gmail.com', 180, 4),
(79, 11, 'Crate Show Invite Artwork', '', 3, 'munishsethi777@gmail.com', 180, 4),
(80, 11, 'Ensure PY Sales Report is available', '', 3, 'munishsethi777@gmail.com', 180, 4),
(81, 11, 'Ensure PY Day by Day Sales Report is avalable', '', 3, 'munishsethi777@gmail.com', 180, 4),
(82, 11, 'Create Customer Contact List', '', 3, 'munishsethi777@gmail.com', 180, 4),
(83, 11, 'Sales to Contact Customers', '', 3, 'munishsethi777@gmail.com', 180, 4),
(84, 11, 'Create Customer Email Blast List', '', 3, 'munishsethi777@gmail.com', 180, 4),
(85, 11, 'Email Blast 1', '', 3, 'munishsethi777@gmail.com', 180, 4),
(86, 11, 'Email Blast 2', '', 3, 'munishsethi777@gmail.com', 180, 4),
(87, 11, 'Create Thank You & We Missed You Artwork', '', 3, 'munishsethi777@gmail.com', 180, 4),
(88, 11, 'Create Thank You Email Blast List', '', 3, 'munishsethi777@gmail.com', 180, 4),
(89, 11, 'Thank You Email Blast', '', 3, 'munishsethi777@gmail.com', 180, 4),
(90, 12, 'Show Pallet Promotions File & Easel', '', 3, 'munishsethi777@gmail.com', 180, 4),
(91, 12, 'Show Promotions File & Easel ', '', 3, 'munishsethi777@gmail.com', 180, 4),
(92, 12, 'Show Program File & Easel', '', 3, 'munishsethi777@gmail.com', 180, 4),
(93, 12, 'Show Brochure Pdf File/to printer', '', 3, 'munishsethi777@gmail.com', 180, 4),
(94, 12, 'Show Brochure to Commerce/Show', '', 3, 'munishsethi777@gmail.com', 180, 4),
(95, 12, 'SHOW BINDER & MARKETING SUPPLIES', '', 3, 'munishsethi777@gmail.com', 180, 4),
(96, 12, 'SHOW BINDER', '', 3, 'munishsethi777@gmail.com', 180, 4),
(97, 12, 'SHOW TAGS - Show Special, Hot Buys, Must Buys', '', 3, 'munishsethi777@gmail.com', 180, 4),
(98, 12, 'SHOW EASELS - Pallet Promotions', '', 3, 'munishsethi777@gmail.com', 180, 4),
(99, 12, 'SHOW BROCHURES', '', 3, 'munishsethi777@gmail.com', 180, 4),
(100, 12, 'PRICELISTS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(101, 12, 'SPIFF BINDER', '', 3, 'munishsethi777@gmail.com', 180, 4),
(102, 13, 'SET DEADLINE: Computer System Ship Out Deadline', '', 3, 'munishsethi777@gmail.com', 180, 4),
(103, 13, 'Send laptop checklist to Joe N for preparation -Includes: laptop, router, ipads, scanners, laptop credit card reader', '', 3, 'munishsethi777@gmail.com', 180, 4),
(104, 13, 'Ship Computer System', '', 3, 'munishsethi777@gmail.com', 180, 4),
(105, 13, 'SET DEADLINE: Test Computer System onsite', '', 3, 'munishsethi777@gmail.com', 180, 4),
(106, 13, 'Test Computer System onsite', '', 3, 'munishsethi777@gmail.com', 180, 4),
(107, 13, 'SET DEADLINE: Computer System Ship Back Deadline', '', 3, 'munishsethi777@gmail.com', 180, 4),
(108, 13, 'Computer System Shipped Back - Tracking Information', '', 3, 'munishsethi777@gmail.com', 180, 4),
(109, 13, 'Receive Computer System, Complete ____ log, Send to CS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(110, 13, 'CS to apply return in OMS & send report of items not returned - Show Lead & Controller', '', 3, 'munishsethi777@gmail.com', 180, 4),
(111, 14, 'B/O\'S - Back orders', '', 3, 'munishsethi777@gmail.com', 180, 4),
(112, 14, 'BOL - Bill of Lading', '', 3, 'munishsethi777@gmail.com', 180, 4),
(113, 14, 'PACKING LIST', '', 3, 'munishsethi777@gmail.com', 180, 4),
(114, 14, 'INVOICES', '', 3, 'munishsethi777@gmail.com', 180, 4),
(115, 14, 'POD\'S - Proof of Deliveries', '', 3, 'munishsethi777@gmail.com', 180, 4),
(116, 14, 'Show/Decorator confirm receipt', '', 3, 'munishsethi777@gmail.com', 180, 4),
(117, 15, 'Pre-Show Brainstorming', '', 3, 'munishsethi777@gmail.com', 180, 4),
(118, 15, 'Pre-Show Meeting', '', 3, 'munishsethi777@gmail.com', 180, 4),
(119, 16, 'SET UP - Utilities', '', 3, 'munishsethi777@gmail.com', 180, 4),
(120, 16, 'SET UP - Labor -Show Lead to send copy of completed work tickets to HR/ cc HR in email', '', 3, 'munishsethi777@gmail.com', 180, 4),
(121, 16, 'TEAR DOWN - Utilities', '', 3, 'munishsethi777@gmail.com', 180, 4),
(122, 16, 'TEAR DOWN - Labor -Show Lead to send copy of completed work tickets to HR/ cc HR in email', '', 3, 'munishsethi777@gmail.com', 180, 4),
(123, 17, 'Pallet Return', '', 3, 'munishsethi777@gmail.com', 180, 4),
(124, 17, 'TS Coordinator to send out Move-Out Information -to Lead and Logistics', '', 3, 'munishsethi777@gmail.com', 180, 4),
(125, 17, 'Logistics Coordinator to send BOL to Show Lead cc TS Coordinator', '', 3, 'munishsethi777@gmail.com', 180, 4),
(126, 17, 'Show Lead to reply with copy of completed MHA', '', 3, 'munishsethi777@gmail.com', 180, 4),
(127, 17, 'Logistics Coordinator to confirm pick up', '', 3, 'munishsethi777@gmail.com', 180, 4),
(128, 17, 'Logistics Coordinator to track shipment and provide ETA', '', 3, 'munishsethi777@gmail.com', 180, 4),
(129, 17, 'Logistics Coordinator to confirm receipt of pallets in Commerce', '', 3, 'munishsethi777@gmail.com', 180, 4),
(130, 17, 'Warehouse to complete __________form & send to Customer Service -CS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(131, 17, 'CS to apply return in OMS & send report of items not returned (Show Lead & Controller)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(132, 17, 'Controller to advise Mktg Mgr & CS Mgr whether to replenish accessories', '', 3, 'munishsethi777@gmail.com', 180, 4),
(133, 17, 'Computer System Return', '', 3, 'munishsethi777@gmail.com', 180, 4),
(134, 18, 'Booth Sale', '', 3, 'munishsethi777@gmail.com', 180, 4),
(135, 18, 'Show Lead to send a copy of the completed Booth Sale Form to Accounting', '', 3, 'munishsethi777@gmail.com', 180, 4),
(136, 18, 'Accounting to receive and apply payment, \"wash\" Invoices not paid', '', 3, 'munishsethi777@gmail.com', 180, 4),
(137, 18, 'Invoicing Coordinator to update Ship To Address on Invoices based on Booth Sale', '', 3, 'munishsethi777@gmail.com', 180, 4),
(138, 18, 'Show Expenses', '', 3, 'munishsethi777@gmail.com', 180, 4),
(139, 18, 'Booth Fee', '', 3, 'munishsethi777@gmail.com', 180, 4),
(140, 18, 'Pallet Display Fee', '', 3, 'munishsethi777@gmail.com', 180, 4),
(141, 18, 'Booth Designer', '', 3, 'munishsethi777@gmail.com', 180, 4),
(142, 18, 'Promotions (Gift Card, iPad, Google Home)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(143, 18, 'Utilities (Water and Power)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(144, 18, 'Furnishings (Carpet, Table, Chairs, Wastebasket, Structure)', '', 3, 'munishsethi777@gmail.com', 180, 4),
(145, 18, 'Drayage', '', 3, 'munishsethi777@gmail.com', 180, 4),
(146, 18, 'Supplies', '', 3, 'munishsethi777@gmail.com', 180, 4),
(147, 18, 'Marketing Collateral', '', 3, 'munishsethi777@gmail.com', 180, 4),
(148, 18, 'Labor', '', 3, 'munishsethi777@gmail.com', 180, 4),
(149, 18, 'Travel', '', 3, 'munishsethi777@gmail.com', 180, 4),
(150, 18, 'Hotel', '', 3, 'munishsethi777@gmail.com', 180, 4),
(151, 18, 'Reimbursements', '', 3, 'munishsethi777@gmail.com', 180, 4),
(152, 18, 'Cost of Inventory', '', 3, 'munishsethi777@gmail.com', 180, 4),
(153, 18, 'Sale of Booth', '', 3, 'munishsethi777@gmail.com', 180, 4),
(154, 18, 'Freight', '', 3, 'munishsethi777@gmail.com', 180, 4),
(155, 18, 'Show Orders', '', 3, 'munishsethi777@gmail.com', 180, 4),
(156, 18, 'Receive Forecast orders in Excel format from Buyer to CS', '', 3, 'munishsethi777@gmail.com', 180, 4),
(157, 18, 'Date orders are expected to be received by', '', 3, 'munishsethi777@gmail.com', 180, 4),
(158, 18, 'Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4),
(159, 18, 'Gift & Co-Op: Day By Day Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4),
(160, 18, 'Sales Report', '', 3, 'munishsethi777@gmail.com', 180, 4),
(161, 18, 'Profitability Report -P/L Statement', '', 3, 'munishsethi777@gmail.com', 180, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `showtasks`
--
ALTER TABLE `showtasks`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `taskcategory`
--
ALTER TABLE `taskcategory`
  ADD PRIMARY KEY (`seq`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`seq`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `showtasks`
--
ALTER TABLE `showtasks`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taskcategory`
--
ALTER TABLE `taskcategory`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
