ALTER TABLE `customerreps` ADD `repnumber` VARCHAR(25) NULL AFTER `customerreptype`, ADD `omscustid` VARCHAR(25) NULL AFTER `repnumber`, ADD `territory` VARCHAR(100) NULL AFTER `omscustid`, ADD `companyname` VARCHAR(200) NULL AFTER `territory`, ADD `shiptoaddress` VARCHAR(500) NULL AFTER `companyname`, ADD `city` VARCHAR(50) NULL AFTER `shiptoaddress`, ADD `state` VARCHAR(50) NULL AFTER `city`, ADD `zip` VARCHAR(20) NULL AFTER `state`, ADD `commission` VARCHAR(100) NULL AFTER `zip`, ADD `isreceivesmonthlysalesreport` TINYINT NULL AFTER `commission`, ADD `pricingtier` VARCHAR(50) NULL AFTER `isreceivesmonthlysalesreport`, ADD `seniorrephandlingaccount` VARCHAR(100) NULL AFTER `pricingtier`, ADD `salesadminassigned` VARCHAR(100) NULL AFTER `seniorrephandlingaccount`; 