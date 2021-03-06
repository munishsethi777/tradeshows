CREATE TABLE `requeststatuses` (
  `seq` bigint(20) NOT NULL,
  `requesttypeseq` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `requeststatuses`
  ADD PRIMARY KEY (`seq`),
  ADD KEY `requesttypeseq` (`requesttypeseq`);

ALTER TABLE `requeststatuses`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

ALTER TABLE `requeststatuses`
  ADD CONSTRAINT `requesttypeseq` FOREIGN KEY (`requestTypeSeq`) REFERENCES `requesttypes` (`seq`);
COMMIT;
