ALTER TABLE `requests` ADD CONSTRAINT `requesttypeseq` FOREIGN KEY (`requesttypeseq`) REFERENCES `requesttypes`(`seq`) ON DELETE RESTRICT ON UPDATE NO ACTION; 


ALTER TABLE `requestlogs` ADD CONSTRAINT `requestseq` FOREIGN KEY (`requestseq`) REFERENCES `requests`(`seq`) ON DELETE CASCADE ON UPDATE NO ACTION; 

ALTER TABLE `requestattachments` ADD INDEX(`requestseq`); 