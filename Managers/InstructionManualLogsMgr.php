<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/InstructionManualLogs.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualLogStatus.php");
    class InstructionManualLogsMgr{
        private static $instructionManualLogsMgr;
        private static $dataStore;
        
        
        public static function getInstance(){
            if (!self::$instructionManualLogsMgr){
                self::$instructionManualLogsMgr = new InstructionManualLogsMgr();
                self::$dataStore = new BeanDataStore(InstructionManualLogs::$className,InstructionManualLogs::$tableName);
            }
            return self::$instructionManualLogsMgr;
        }
        public function save($instructionManualLog){
            return self::$dataStore->save($instructionManualLog);
        }
        public function getInstructionManualLogsForGrid(){
            $query = "select users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on instructionmanuallogs.createdby = users.seq";        
            $rows = self::$dataStore->executeQuery($query,true);
            $arr = array();
            foreach($rows as $row){
                $row["instructionmanuallogstatus"] = InstructionManualLogStatus::getValue($row["instructionmanuallogstatus"]);	
                $row["approvedmanualdueprintdate"] = DateUtil::convertDateToFormat($row["approvedmanualdueprintdate"], "Y-m-d", "Y-m-d H:i:s");
                $row["instructionmanuallogs.lastmodifiedon"] = $row["lastmodifiedon"];
                array_push($arr,$row);		    
            }
            $mainArr["Rows"] = $arr;
            $mainArr["TotalRows"] = $this->getAllCount(true);
            return $mainArr;
        }
        public function getAllCount($isApplyFilter){
            $query = "select count(*) from instructionmanuallogs left join classcodes on 
                    instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
                    instructionmanuallogs.createdby = users.seq";
           $count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
           return $count;
        }
        public function findBySeq($seq){
            $instructionManualLog = self::$dataStore->findBySeq($seq);
            $instructionManualLog->setEntryDate($this->getDateStr($instructionManualLog->getEntryDate()));
            $instructionManualLog->setPoShipDate($this->getDateStr($instructionManualLog->getPoShipDate()));
            $instructionManualLog->setApprovedManualDuePrintDate($this->getDateStr($instructionManualLog->getApprovedManualDuePrintDate()));
            $instructionManualLog->setGraphicDueDate($this->getDateStr($instructionManualLog->getGraphicDueDate()));
            $instructionManualLog->setDiagramSavedDate($this->getDateStr($instructionManualLog->getDiagramSavedDate()));
            $instructionManualLog->setStartedDate($this->getDateStr($instructionManualLog->getStartedDate()));
            $instructionManualLog->setSupervisorReturnDate($this->getDateStr($instructionManualLog->getSupervisorReturnDate()));
            $instructionManualLog->setManagerReturnDate($this->getDateStr($instructionManualLog->getManagerReturnDate()));
            $instructionManualLog->setBuyerReturnDate($this->getDateStr($instructionManualLog->getBuyerReturnDate()));
            $instructionManualLog->setSentToChinaDate($this->getDateStr($instructionManualLog->getSentToChinaDate()));
            return $instructionManualLog;
        }
        private function getDateStr($date){
            $format = 'Y-m-d';
            if(!empty($date)){
                $date = DateUtil::StringToDateByGivenFormat($format, $date);
                $date = $date->format("m-d-Y");
            }
            return $date;
        }
        private function getDateTimeStr($date){
            $sessionUtil = SessionUtil::getInstance();
            $timeZone = $sessionUtil->getUserLoggedInTimeZone();
            if(!empty($date)){
                $date = DateUtil::convertDateToFormatWithTimeZone($date, "Y-m-d H:i:s", "m-d-Y h:i a",$timeZone);
            }
            return $date;
        }
        public function getProjectsDueLessThan14DaysFromEntry(){
            $query = "select users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs 
                    left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
                    instructionmanuallogs.createdby = users.seq where DATEDIFF(approvedmanualdueprintdate,entrydate) IS NOT NULL 
                    AND (iscompleted IS NULL OR iscompleted = false) AND DATEDIFF(approvedmanualdueprintdate,entrydate) < 14 
                    AND DATEDIFF(approvedmanualdueprintdate,entrydate) >=0";
            $rows = self::$dataStore->executeQuery($query,true);
            $arr = array();
            foreach($rows as $row){
                $row["instructionmanuallogstatus"] = InstructionManualLogStatus::getValue($row["instructionmanuallogstatus"]);
                $row["approvedmanualdueprintdate"] = DateUtil::convertDateToFormat($row["approvedmanualdueprintdate"], "Y-m-d", "Y-m-d H:i:s");
                $row["instructionmanuallogs.lastmodifiedon"] = $row["lastmodifiedon"];
                array_push($arr,$row);
            }
            $mainArr["Rows"] = $arr;
            $mainArr["TotalRows"] = $this->getProjectsDueLessThan14DaysFromEntryCount(true);
            return $mainArr;
        }
        public function getProjectsDueLessThan14DaysFromEntryCount($isApplyFilter){
            $query = "select users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs 
                    left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
                    instructionmanuallogs.createdby = users.seq where DATEDIFF(approvedmanualdueprintdate,entrydate) IS NOT NULL 
                    AND (iscompleted IS NULL OR iscompleted = false) AND DATEDIFF(approvedmanualdueprintdate,entrydate) < 14 
                    AND DATEDIFF(approvedmanualdueprintdate,entrydate) >=0";
            $count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
            return $count;
        }
        public function findByItemNo($itemNo,$instructionManualLogSeq = ""){
            $query = "SELECT COUNT(seq) FROM `instructionmanuallogs` Where itemnumber like '".$itemNo."' AND iscompleted=FALSE";
            $query = $instructionManualLogSeq != "" ? $query . " AND seq!=".$instructionManualLogSeq : $query;
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;        
        }
        public function getProjectsOverdue(){
            $query = "SELECT users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs 
            left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
            instructionmanuallogs.createdby = users.seq WHERE '".date('Y-m-d')."' > approvedmanualdueprintdate AND (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate IS NOT NULL";
            $rows = self::$dataStore->executeQuery($query,true);
            $arr = array();
            foreach($rows as $row){
                $row["instructionmanuallogstatus"] = InstructionManualLogStatus::getValue($row["instructionmanuallogstatus"]);
                $row["approvedmanualdueprintdate"] = DateUtil::convertDateToFormat($row["approvedmanualdueprintdate"], "Y-m-d", "Y-m-d H:i:s");
                $row["instructionmanuallogs.lastmodifiedon"] = $row["lastmodifiedon"];
                array_push($arr,$row);
            }
            $mainArr["Rows"] = $arr;
            $mainArr["TotalRows"] = $this->getProjectsOverdueCount(true);
            return $mainArr;
        }
        public function getProjectsOverdueCount($isApplyFilter){
            $query = "SELECT users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs 
            left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
            instructionmanuallogs.createdby = users.seq WHERE '".date('Y-m-d')."' > approvedmanualdueprintdate AND (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate IS NOT NULL";
            $count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
            return $count;
        }
        //-----------------------------Cron Functions-------------------------------------------------
        public function getInstructionManualProjectsOpenCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where iscompleted IS NULL OR iscompleted = false";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsCompletedCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where iscompleted IS TRUE";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsOverdueCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where '".date('Y-m-d')."' > approvedmanualdueprintdate AND (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate IS NOT NULL";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsInSupervisorReviewCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_supervisor)."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsInManagerReviewCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_manager)."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsInBuyerReviewCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_buyer)."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsDueToday(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate like '".date('Y-m-d')."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsDueInNext14Days(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where approvedmanualdueprintdate > '".date('Y-m-d')."' AND approvedmanualdueprintdate <= '".date('Y-m-d',strtotime('14 days'))."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsDueLessThan14DaysFromEntry(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where DATEDIFF(approvedmanualdueprintdate,entrydate) IS NOT NULL AND (iscompleted IS NULL OR iscompleted = false) AND DATEDIFF(approvedmanualdueprintdate,entrydate) < 14 AND DATEDIFF(approvedmanualdueprintdate,entrydate) >=0";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsNotStarted(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::not_started)."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualAllCount(){
            $query = "SELECT COUNT(seq) from " . InstructionManualLogs::$tableName;
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;   
        }
        //-----------------------------/Cron Functions ends here-------------------------------------------------
        
    }
?>