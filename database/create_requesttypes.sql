CREATE TABLE `requesttypes` (
  `seq` bigint(20) NOT NULL,
  `departmentseq` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `requesttypecode` varchar(10) NOT NULL,
  `createdby` bigint(20) NOT NULL,
  `createdon` datetime NOT NULL,
  `lastmodifiedon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `requesttypes`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `Request Type Code` (`requesttypecode`) USING BTREE,
  ADD KEY `deptseq` (`departmentseq`);

ALTER TABLE `requesttypes`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;