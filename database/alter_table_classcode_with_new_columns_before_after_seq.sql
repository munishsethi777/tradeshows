ALTER TABLE `classcodes` ADD `vendorid` VARCHAR(25) NOT NULL AFTER `seq`, ADD `vendorname` VARCHAR(100) NOT NULL AFTER `vendorid`;
