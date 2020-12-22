CREATE TABLE `userconfigurations` (
  `seq` bigint(20) NOT NULL,
  `userseq` bigint(20) NOT NULL,
  `configkey` varchar(100) NOT NULL,
  `configvalue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `userconfigurations`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `configkey` (`configkey`),
  ADD UNIQUE KEY `userseq` (`userseq`);
ALTER TABLE `userconfigurations`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;
