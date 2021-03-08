CREATE TABLE `requestattachments` (
  `seq` bigint(20) NOT NULL,
  `requestseq` bigint(20) NOT NULL,
  `attachmentfilename` varchar(250) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `attachmentbytes` int(11) DEFAULT NULL,
  `attachmenttype` varchar(15) DEFAULT NULL,
  `attachmenttitle` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `requestattachments`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `requestattachments`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;
