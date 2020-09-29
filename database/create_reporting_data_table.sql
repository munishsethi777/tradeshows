CREATE TABLE `reportingdata` (
  `seq` bigint(20) NOT NULL,
  `dated` date NOT NULL,
  `parameter` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `reportingdata`
  ADD PRIMARY KEY (`seq`),
  ADD UNIQUE KEY `dated` (`dated`,`parameter`);