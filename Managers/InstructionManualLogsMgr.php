<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/InstructionManualLogs.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualLogStatus.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
    class InstructionManualLogsMgr{
        private static $instructionManualLogsMgr;
        private static $dataStore;
        private static $filterExportSelectSql = "select instructionmanuallogs.seq,
                                                    GROUP_CONCAT(DISTINCT instructionmanualcustomers.customername) as customernames,
                                                    GROUP_CONCAT(DISTINCT instructionmanualrequests.requesttype) as requesttypes,
                                                    enteredby.fullname as enteredbyname,
                                                    diagramsavedby.fullname as diagramsavedbyname,assignedto.fullname as assignedtoname,classcodes.classcode,
                                                    instructionmanuallogs.* from instructionmanuallogs 
                                                    left join classcodes on classcodes.seq = instructionmanuallogs.classcodeseq
                                                    left join users as enteredby on enteredby.seq = instructionmanuallogs.createdby 
                                                    left join users as diagramsavedby on diagramsavedby.seq = instructionmanuallogs.diagramsavedbyuserseq
                                                    left join users as assignedto on  assignedto.seq = instructionmanuallogs.assignedtouser
                                                    left join instructionmanualcustomers on instructionmanualcustomers.instructionmanualseq = instructionmanuallogs.seq
                                                    left join instructionmanualrequests on instructionmanualrequests.instructionmanualseq = instructionmanuallogs.seq";
        private static $logsOpenWhereClause = " where iscompleted IS false";
        private static $logsCompletedWhereClause = " where iscompleted IS TRUE";
        private static $logsOverDueWhereClause = " where NOW() > approvedmanualdueprintdate AND iscompleted = false AND approvedmanualdueprintdate IS NOT NULL";
//         private static $logsInSupervisorReviewWhereClause = " where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_supervisor)."'";
        private static $logsOverDueTodayWhereClause = " where (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate like NOW()";
        private static $logsDueLessThan14DaysFromEntryWhereClause = " where DATEDIFF(approvedmanualdueprintdate,entrydate) IS NOT NULL AND (iscompleted IS NULL OR iscompleted = false) AND DATEDIFF(approvedmanualdueprintdate,entrydate) < 14 AND DATEDIFF(approvedmanualdueprintdate,entrydate) >=0";
        private static $groupByInstructionManualLogSeq = " GROUP by instructionmanuallogs.seq";
        
        
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
            $instructionManualLog->setConfirmedShipDate($this->getDateStr($instructionManualLog->getConfirmedShipDate()));
            $instructionManualLog->setFinalDueDate($this->getDateStr($instructionManualLog->getFinalDueDate()));
            
            return $instructionManualLog;
        }
        public function deleteBySeqs($ids) {
            $flag = self::$dataStore->deleteInList ( $ids );
            return $flag;
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
        
        // --------------------------------------Grid Functions------------------------------------------------------------>
        private function processRowsForGrid($rows){
            $sessionUtil = SessionUtil::getInstance();
            $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
            $arr = array();
            foreach($rows as $row){
                $row["entrydate"] = DateUtil::convertDateToFormat($row["entrydate"],"Y-m-d","Y-m-d H:i:s");
                $row["poshipdate"] = DateUtil::convertDateToFormat($row["poshipdate"],"Y-m-d","Y-m-d H:i:s");
                $row["approvedmanualdueprintdate"] = DateUtil::convertDateToFormat($row["approvedmanualdueprintdate"], "Y-m-d", "Y-m-d H:i:s");
                
                $row["instructionmanuallogstatus"] = InstructionManualLogStatus::getValue($row["instructionmanuallogstatus"]);
                $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($row["lastmodifiedon"], "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
                $row["instructionmanuallogs.lastmodifiedon"] = $lastModifiedOn;
                array_push($arr,$row);
            }
            return $arr;
        }
        public function getInstructionManualLogsForGrid(){
                $query = "select users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on instructionmanuallogs.createdby = users.seq";
            $rows = self::$dataStore->executeQuery($query,true);
            $mainArr["Rows"] = $this->processRowsForGrid($rows);
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
        public function getProjectsDueLessThan14DaysFromEntryForGrid(){
            $query = "select users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs 
                    left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
                    instructionmanuallogs.createdby = users.seq where DATEDIFF(approvedmanualdueprintdate,entrydate) IS NOT NULL 
                    AND (iscompleted IS NULL OR iscompleted = false) AND DATEDIFF(approvedmanualdueprintdate,entrydate) < 14 
                    AND DATEDIFF(approvedmanualdueprintdate,entrydate) >=0";
            $rows = self::$dataStore->executeQuery($query,true);
            $mainArr["Rows"] = $this->processRowsForGrid($rows);
            $mainArr["TotalRows"] = $this->getProjectsDueLessThan14DaysFromEntryCountForGrid(true);
            return $mainArr;
        }
        public function getProjectsDueLessThan14DaysFromEntryCountForGrid($isApplyFilter){
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
        
        public function getProjectsOverdueForGrid(){
            $query = "SELECT users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs 
            left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
            instructionmanuallogs.createdby = users.seq" . self::$logsOverDueWhereClause;
            $rows = self::$dataStore->executeQuery($query,true);
            $mainArr["Rows"] = $this->processRowsForGrid($rows);
            $mainArr["TotalRows"] = $this->getProjectsOverdueCountForGrid(true);
            return $mainArr;
        }
        public function getProjectsOverdueCountForGrid($isApplyFilter){
            $query = "SELECT users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs 
            left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on 
            instructionmanuallogs.createdby = users.seq" .  self::$logsOverDueWhereClause;
            $count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
            return $count;
        }
        public function exportInstructionManuals($queryString,$instructionManualSeqs,$filterId){
            $output = array();
            parse_str($queryString, $output);
            $_GET = array_merge($_GET,$output);
            $sessionUtil = SessionUtil::getInstance();
            $instructionManuals = array();
            if($_GET['exportOptionForInstructionManualLogs'] != "template"){
                $loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
                $myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
                $isSessionGeneralUser = $sessionUtil->isSessionGeneralUser();
                if($isSessionGeneralUser){
                    if(count($myTeamMembersArr) == 0){
                        self::$filterExportSelectSql .= " where users.seq = $loggedInUserSeq ";
                    }else{
                        $myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
                        self::$filterExportSelectSql .= " where users.seq in($myTeamMembersCommaSeparated)";
                    }
                    if(!empty($instructionManualSeqs)){
                        self::$filterExportSelectSql .= " and instructionmanuallogs.seq in ($instructionManualSeqs)";
                    }
                }else{
                    if(!empty($instructionManualSeqs)){
                        self::$filterExportSelectSql .= " where instructionmanuallogs.seq in ($instructionManualSeqs)";
                    }
                }
                $query = self::$filterExportSelectSql . self::$groupByInstructionManualLogSeq;
                if($filterId == "instruction_manual_total_projects_overdue"){
                    $query = self::$filterExportSelectSql . self::$logsCompletedWhereClause . self::$groupByInstructionManualLogSeq;
                }elseif($filterId == "instruction_manual_total_projects_due_less_than_14_days_from_entry"){
                    $query = self::$filterExportSelectSql . self::$logsDueLessThan14DaysFromEntryWhereClause . self::$groupByInstructionManualLogSeq;
                }
                
                $instructionManuals = self::$dataStore->executeQuery($query,true,true);
            }
            PHPExcelUtil::exportInstructionManuals($instructionManuals,false,"InstructionManuals");
        }
        // ---------------------------Grid Functions Ends Here---------------------------------------------------------------->
        
        // ----------------------------Filter Export Functions----------------------------------------------------------------->
        public function getAllOpenLogsFullData(){
            $query = self::$filterExportSelectSql . self::$logsOpenWhereClause . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllCompletedLogsFullData(){
            $query = self::$filterExportSelectSql . self::$logsCompletedWhereClause . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllOverDueLogsFullData(){
            $query = self::$filterExportSelectSql . self::$logsOverDueWhereClause . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllSupervisorReviewLogsFullData(){
            $query = self::$filterExportSelectSql . "  where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_supervisor)."'" . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllManagerReviewLogsFullData(){
            $query = self::$filterExportSelectSql . "  where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_manager)."'" . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllBuyerReviewLogsFullData(){
            $query = self::$filterExportSelectSql . "  where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_buyer)."'" . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllDueTodayLogsFullData(){
            $query = self::$filterExportSelectSql . " where (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate like '".date('Y-m-d')."'";
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllDueInNext14DaysLogsFullData(){
            $query = self::$filterExportSelectSql . " where approvedmanualdueprintdate > '".date('Y-m-d')."' AND approvedmanualdueprintdate <= '".date('Y-m-d',strtotime('14 days'))."'" . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllDueLessThan14DaysFromEntryLogsFullData(){
            $query = self::$filterExportSelectSql . self::$logsDueLessThan14DaysFromEntryWhereClause . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllNotStartedLogsFullData(){
            $query = self::$filterExportSelectSql . " where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::not_started)."'" . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        public function getAllFullData(){
            $query = self::$filterExportSelectSql . self::$groupByInstructionManualLogSeq;
            return self::$dataStore->executeQuery($query,false,true);
        }
        // ------------------------Filter Export Functions----------------------------------------------------------->
        //-----------------------------Cron Functions--------------------------------------------------------------->
        public function getInstructionManualProjectsOpenCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName.self::$logsOpenWhereClause;
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsCompletedCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName.self::$logsCompletedWhereClause;
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsOverdueCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName . self::$logsOverDueWhereClause;
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsInSupervisorReviewCount(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName. " where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_supervisor)."'";
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
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName. " where (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate like '".date('Y-m-d')."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsDueInNext14Days(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where approvedmanualdueprintdate > '".date('Y-m-d')."' AND approvedmanualdueprintdate <= '".date('Y-m-d',strtotime('14 days'))."'";
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;
        }
        public function getInstructionManualProjectsDueLessThan14DaysFromEntry(){
            $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName . self::$logsDueLessThan14DaysFromEntryWhereClause;
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