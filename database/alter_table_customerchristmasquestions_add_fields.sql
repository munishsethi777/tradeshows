ALTER TABLE `customerchristmasquestions` ADD `cataloglinkdate` DATE NULL AFTER `year`;
ALTER TABLE `customerchristmasquestions` ADD `tradeshowsaregoingto` VARCHAR(1000) NULL AFTER `cataloglinkdate`;
ALTER TABLE `customerchristmasquestions` ADD `isdinnerappt` TINYINT NULL AFTER `tradeshowsaregoingto`;
ALTER TABLE `customerchristmasquestions` ADD `dinnerapptdate` DATE NULL AFTER `isdinnerappt`;
ALTER TABLE `customerchristmasquestions` ADD `ispitchmainvendor` TINYINT NULL AFTER `dinnerapptdate`;
ALTER TABLE `customerchristmasquestions` ADD `xmassamplesentdate` DATE NULL AFTER `aretheremorebuyers`;
ALTER TABLE `customerchristmasquestions` ADD `categoriesshouldsellthem` VARCHAR(1000) NULL AFTER `xmassamplesentdate`;
ALTER TABLE `customerchristmasquestions` ADD `isreviewedsellthru` TINYINT NULL AFTER `categoriesshouldsellthem`;
ALTER TABLE `customerchristmasquestions` ADD `compshopsummaryemailsentdate` DATE NULL AFTER `isreviewedsellthru`;
ALTER TABLE `customerchristmasquestions` ADD `isquotedforxmas` TINYINT NULL AFTER `compshopsummaryemailsentdate`;
ALTER TABLE `customerchristmasquestions` ADD `itemselectionfinalized` TINYINT NULL AFTER `isquotedforxmas`;
ALTER TABLE `customerchristmasquestions` ADD `itemspurchasedlastyear` INT NULL AFTER `itemselectionfinalized`;
ALTER TABLE `customerchristmasquestions` ADD `finalizedtyvsly` INT NULL AFTER `itemspurchasedlastyear`;
ALTER TABLE `customerchristmasquestions` ADD `ispoexpecting` TINYINT NULL AFTER `finalizedtyvsly`;
ALTER TABLE `customerchristmasquestions` ADD `expectingpodate` DATE NULL AFTER `ispoexpecting`;
ALTER TABLE `customerchristmasquestions` ADD `expectingpodate` DATE NULL AFTER `ispoexpecting`;
ALTER TABLE `customerchristmasquestions` ADD `opportunitiessentdate` DATE NULL AFTER `isopportunitiessent`;
ALTER TABLE `customerchristmasquestions` ADD `istheremorebuyers` TINYINT NULL AFTER `ispitchmainvendor`;
ALTER TABLE `customerchristmasquestions` CHANGE `ispoexpecting` `arepoexpecting` VARCHAR(50) NULL DEFAULT NULL;
ALTER TABLE `customerchristmasquestions` ADD `dinnerapptplace` VARCHAR(500) NULL AFTER `opportunitiessentdate`;