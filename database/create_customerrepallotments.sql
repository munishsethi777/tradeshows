CREATE TABLE `customerrepallotments` (
  `seq` bigint(20) NOT NULL,
  `customerseq` bigint(20) NOT NULL,
  `customerrepseq` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `customerrepallotments`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `customerrepallotments`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

