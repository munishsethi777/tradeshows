CREATE TABLE `qcschedulerevisions` (
  `seq` bigint(20) NOT NULL,
  `revisedbyuser` bigint(20) NOT NULL,
  `qcseq` bigint(20) NOT NULL,
  `qc` varchar(50) DEFAULT NULL,
  `po` varchar(50) DEFAULT NULL,
  `potype` varchar(50) DEFAULT NULL,
  `itemnumbers` varchar(200) NOT NULL,
  `shipdate` date DEFAULT NULL,
  `latestshipdate` date DEFAULT NULL,
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
  `apmiddleinspectiondatenareason` varchar(50) DEFAULT NULL,
  `apfirstinspectiondatenareason` varchar(50) DEFAULT NULL,
  `apgraphicsreceivedatenareason` varchar(50) DEFAULT NULL,
  `qcuser` bigint(20) DEFAULT NULL,
  `poinchargeuser` bigint(20) NOT NULL,
  `classcodeseq` bigint(20) DEFAULT NULL,
  `acmiddleinspectionnotes` varchar(2500) DEFAULT NULL,
  `acfirstinspectionnotes` varchar(2500) DEFAULT NULL,
  `iscompleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `qcschedulerevisions`
  ADD PRIMARY KEY (`seq`);


ALTER TABLE `qcschedulerevisions`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;
