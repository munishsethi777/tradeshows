CREATE TABLE `customerreps` (
  `seq` bigint(20) NOT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `ext` varchar(50) DEFAULT NULL,
  `cellphone` varchar(50) DEFAULT NULL,
  `position` varchar(200) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `skypeid` varchar(200) DEFAULT NULL,
  `customerreptype` enum('salesrep','internalsupport') DEFAULT NULL,
  `repnumber` varchar(25) DEFAULT NULL,
  `omscustid` varchar(25) DEFAULT NULL,
  `territory` varchar(100) DEFAULT NULL,
  `companyname` varchar(200) DEFAULT NULL,
  `shiptoaddress` varchar(500) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `commission` varchar(100) DEFAULT NULL,
  `isreceivesmonthlysalesreport` tinyint(4) DEFAULT NULL,
  `pricingtier` varchar(50) DEFAULT NULL,
  `seniorrephandlingaccount` varchar(100) DEFAULT NULL,
  `salesadminassigned` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `customerreps`
  ADD PRIMARY KEY (`seq`);


ALTER TABLE `customerreps`
  MODIFY `seq` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;
