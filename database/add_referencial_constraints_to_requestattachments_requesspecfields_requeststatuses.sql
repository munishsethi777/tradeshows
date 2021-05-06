ALTER TABLE `requestattachments` ADD CONSTRAINT `deleteattachments` FOREIGN KEY (`requestseq`) REFERENCES `requests`(`seq`) ON DELETE CASCADE ON UPDATE NO ACTION; 

ALTER TABLE `requestspecsfields` ADD INDEX(`requesttypeseq`); 
ALTER TABLE `requestspecsfields` ADD CONSTRAINT `deletespecfields` FOREIGN KEY (`requesttypeseq`) REFERENCES `requesttypes`(`seq`) ON DELETE CASCADE ON UPDATE NO ACTION; 

ALTER TABLE `requeststatuses` ADD INDEX(`requesttypeseq`); 
ALTER TABLE `requeststatuses` ADD CONSTRAINT `deletestatuses` FOREIGN KEY (`requesttypeseq`) REFERENCES `requesttypes`(`seq`) ON DELETE CASCADE ON UPDATE NO ACTION; 

ALTER TABLE `requests` DROP FOREIGN KEY `requesttypeseq`; ALTER TABLE `requests` ADD CONSTRAINT `deleterequesttype` FOREIGN KEY (`requesttypeseq`) REFERENCES `requesttypes`(`seq`) ON DELETE RESTRICT ON UPDATE NO ACTION; 