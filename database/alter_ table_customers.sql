ALTER TABLE `customers` CHANGE `customertype` `customertype` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `customers` CHANGE `businesstype` `businesstype` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `customerspringquestions` ADD `notes` VARCHAR(1000) NULL DEFAULT NULL AFTER `isvisitcustomerduring2ndqtr`;
ALTER TABLE `customerchristmasquestions` ADD `isallcategoriesselected` TINYINT NULL DEFAULT NULL AFTER `customerseq`;
ALTER TABLE `customerchristmasquestions` ADD `category` VARCHAR(1000) NULL DEFAULT NULL AFTER `isallcategoriesselected`;
ALTER TABLE `customerchristmasquestions` ADD `notes` VARCHAR(1000) NULL DEFAULT NULL AFTER `istheremorebuyers`;
ALTER TABLE `customerchristmasquestions` CHANGE `isholidayshopcompleted` `compshopcompleteddate` DATE NULL DEFAULT NULL;
ALTER TABLE `buyers` CHANGE `firstname` `firstname` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
