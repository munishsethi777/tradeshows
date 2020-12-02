
CREATE TABLE `instructionmanualrequests` (
  `seq` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `instructionmanualseq` bigint(20) NOT NULL,
  `requesttype` varchar(200) DEFAULT NULL
);
