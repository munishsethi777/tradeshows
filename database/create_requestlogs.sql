CREATE TABLE `requestlogs` (
  `seq` bigint(20) NOT NULL,
  `requestseq` bigint(20) NOT NULL,
  `oldvalue` varchar(200) DEFAULT NULL,
  `newvalue` varchar(2000) DEFAULT NULL,
  `attributename` varchar(50) DEFAULT NULL,
  `isspecfieldchange` tinyint(4) DEFAULT NULL,
  `createdby` bigint(20) NOT NULL,
  `createdon` datetime NOT NULL,
  `userseq` bigint(20) DEFAULT NULL,
  `requestattachmentseq` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `requestlogs`
  ADD PRIMARY KEY (`seq`),
  ADD KEY `requestseq` (`requestseq`);

ALTER TABLE `requestlogs`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

ALTER TABLE `requestlogs`
  ADD CONSTRAINT `requestseq` FOREIGN KEY (`requestseq`) REFERENCES `requests` (`seq`);
COMMIT;
