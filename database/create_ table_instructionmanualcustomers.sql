
CREATE TABLE `instructionmanualcustomers` (
  `seq` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `instructionmanualseq` bigint(20) NOT NULL,
  `customername` varchar(200) DEFAULT NULL
);
