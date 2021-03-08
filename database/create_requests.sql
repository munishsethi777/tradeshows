CREATE TABLE `requests` (
  `seq` bigint(20) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `priority` varchar(20) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `descriptiontext` varchar(1000) DEFAULT NULL,
  `departmentseq` bigint(20) NOT NULL,
  `requesttypeseq` bigint(20) NOT NULL,
  `requestspecifications` varchar(2500) NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `assignedby` bigint(20) DEFAULT NULL,
  `assignedto` bigint(20) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `assigneeduedate` date DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `estimatedhours` int(11) DEFAULT NULL,
  `requeststatusseq` bigint(20) DEFAULT NULL,
  `isrequiredapprovalfrommanager` tinyint(4) NOT NULL,
  `isrequiredapprovalfromrequester` tinyint(4) NOT NULL,
  `isrequiredapprovalfromrobby` tinyint(4) NOT NULL,
  `approvedbymanagerdate` datetime DEFAULT NULL,
  `approvedbyrequesterdate` datetime DEFAULT NULL,
  `approvedbyrobbydate` datetime DEFAULT NULL,
  `completeddate` datetime DEFAULT NULL,
  `actualhours` int(11) DEFAULT NULL,
  `iscompleted` tinyint(4) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `requests`
  ADD PRIMARY KEY (`seq`),
  ADD KEY `requeststatusseq` (`requeststatusseq`),
  ADD KEY `deptseq` (`departmentseq`),
  ADD KEY `reqtypes` (`requesttypeseq`),
  ADD KEY `requestspecifications` (`requestspecifications`(768));

ALTER TABLE `requests`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;
