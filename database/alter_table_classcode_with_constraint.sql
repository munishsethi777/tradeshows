ALTER TABLE `qcschedules` ADD CONSTRAINT `delete_classcode` FOREIGN KEY (`classcodeseq`) REFERENCES `classcodes`(`seq`) ON DELETE RESTRICT ON UPDATE NO ACTION;