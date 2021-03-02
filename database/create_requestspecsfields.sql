CREATE TABLE `requestspecsfields` (
  `seq` bigint(20) NOT NULL,
  `requesttypeseq` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fieldtype` enum('text','textarea','dropdown','yes_no','date','datetime','numeric') NOT NULL,
  `isrequired` tinyint(4) NOT NULL,
  `isvisible` tinyint(4) NOT NULL,
  `details` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `requestspecsfields`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `requestspecsfields`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
COMMIT;
