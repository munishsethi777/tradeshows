CREATE TABLE `customerrepcommissions` (
  `seq` bigint(20) NOT NULL,
  `customerseq` bigint(20) NOT NULL,
  `customerrepseq` bigint(20) NOT NULL,
  `commissioncategory` varchar(30) DEFAULT NULL,
  `commissiontype` varchar(30) DEFAULT NULL,
  `commissionvalue` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `customerrepcommissions`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `customerrepcommissions`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

