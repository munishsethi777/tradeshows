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
        private static $gridSelectSql = "select users.fullname,classcodes.classcode,instructionmanuallogs.* from instructionmanuallogs left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq left join users on instructionmanuallogs.createdby = users.seq";
        
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
        public function findByItemNo($itemNo,$instructionManualLogSeq = ""){
            $query = "SELECT COUNT(seq) FROM `instructionmanuallogs` Where itemnumber like '".$itemNo."' AND iscompleted=FALSE";
            $query = $instructionManualLogSeq != "" ? $query . " AND seq!=".$instructionManualLogSeq : $query;
            $count = self::$dataStore->executeCountQueryWithSql($query);
            return $count;        
        }
        //// Grid status bar export button
        public function exportInstructionManuals($queryString,$instructionManualSeqs,$filterId){
            $output = array();
            parse_str($queryString, $output);
            $_GET = array_merge($_GET,$output);
            if(!empty($instructionManualSeqs)){// selected row export clause
                self::$filterExportSelectSql .= " where instructionmanuallogs.seq in ($instructionManualSeqs)";
            }
            $query = self::$filterExportSelectSql . self::$groupByInstructionManualLogSeq;
            if($filterId == "instruction_manual_total_projects_overdue"){
                $query = self::$filterExportSelectSql . self::$logsCompletedWhereClause . self::$groupByInstructionManualLogSeq;
            }elseif($filterId == "instruction_manual_total_projects_due_less_than_14_days_from_entry"){
                $query = self::$filterExportSelectSql . self::$logsDueLessThan14DaysFromEntryWhereClause . self::$groupByInstructionManualLogSeq;
            }
            $instructionManuals = self::$dataStore->executeQuery($query,true,true);
            PHPExcelUtil::exportInstructionManuals($instructionManuals,false,"InstructionManuals");
        }
        // ---------------------------Grid Functions Ends Here---------------------------------------------------------------->
        //-----------------------------/Cron Functions ends here-------------------------------------------------
        
        public function getAllOpenLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . self::$logsOpenWhereClause . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName.self::$logsOpenWhereClause;
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllCompleteLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . self::$logsCompletedWhereClause . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName.self::$logsCompletedWhereClause;
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllOverDueLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . self::$logsOverDueWhereClause . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName.self::$logsOverDueWhereClause;
                $count = self::$dataStore->executeCountQueryWithSql($query,true);
                return $count;
            }elseif($beanReturnDataType == BeanReturnDataType::grid){
                $count = $this->getAllOverDueLogs(BeanReturnDataType::count);
                $query = self::$gridSelectSql . self::$logsOverDueWhereClause;
                $rows = self::$dataStore->executeQuery($query,true);
                $mainArr["Rows"] = $this->processRowsForGrid($rows);
                $mainArr["TotalRows"] = $count;
                return $mainArr;
            }
        }
        public function getAllSupervisorReviewLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . "  where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_supervisor)."'" . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName. " where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_supervisor)."'";
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllManagerReviewLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . "  where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_manager)."'" . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_manager)."'";
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllBuyerReviewLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . "  where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_buyer)."'" . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::in_review_buyer)."'";
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllDueTodayLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . " where (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate like '".date('Y-m-d')."'";
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName. " where (iscompleted IS NULL OR iscompleted = false) AND approvedmanualdueprintdate like '".date('Y-m-d')."'";
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllDueInNext14DaysLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . " where approvedmanualdueprintdate > '".date('Y-m-d')."' AND approvedmanualdueprintdate <= '".date('Y-m-d',strtotime('14 days'))."'" . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where approvedmanualdueprintdate > '".date('Y-m-d')."' AND approvedmanualdueprintdate <= '".date('Y-m-d',strtotime('14 days'))."'";
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllDueLessThan14DaysFromEntryLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . self::$logsDueLessThan14DaysFromEntryWhereClause . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName . self::$logsDueLessThan14DaysFromEntryWhereClause;
                $count = self::$dataStore->executeCountQueryWithSql($query,true);
                return $count;
            }elseif($beanReturnDataType == BeanReturnDataType::grid){
                $count = $this->getAllDueLessThan14DaysFromEntryLogs(BeanReturnDataType::count);
                $query = self::$gridSelectSql . self::$logsDueLessThan14DaysFromEntryWhereClause;
                $rows = self::$dataStore->executeQuery($query,true);
                $mainArr["Rows"] = $this->processRowsForGrid($rows);
                $mainArr["TotalRows"] = $count;
                return $mainArr;
            }
        }
        public function getAllNotStartedLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . " where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::not_started)."'" . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true);
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "select COUNT(seq) from ".InstructionManualLogs::$tableName." where instructionmanuallogstatus LIKE '".InstructionManualLogStatus::getName(InstructionManualLogStatus::not_started)."'";
                $count = self::$dataStore->executeCountQueryWithSql($query);
                return $count;
            }
        }
        public function getAllLogs($beanReturnDataType){
            if($beanReturnDataType == BeanReturnDataType::export){
                $query = self::$filterExportSelectSql . self::$groupByInstructionManualLogSeq;
                return self::$dataStore->executeQuery($query,false,true); 
            }elseif($beanReturnDataType == BeanReturnDataType::count){
                $query = "SELECT COUNT(seq) from " . InstructionManualLogs::$tableName;
                $count = self::$dataStore->executeCountQueryWithSql($query,true);
                return $count; 
            }elseif($beanReturnDataType == BeanReturnDataType::grid){
                $count = $this->getAllLogs(BeanReturnDataType::count);
                $query = self::$gridSelectSql;
                $rows = self::$dataStore->executeQuery($query,true);
                $mainArr["Rows"] = $this->processRowsForGrid($rows);
                $mainArr["TotalRows"] = $count;
                return $mainArr;
            }
        }

        // export functions calling, when user click on analytic filter export icon---------------------------------------
        public function exportFilterData($filterId){
            $containerSchedules = null;
            $ContainerExportSchedulesAndFileName = array();
            $fileName = "ContainerSchedule";
            if($filterId == "container_schedules_all_count_export_date"){
                $containerSchedules = $this->getAllOpenLogs(BeanReturnDataType::getValue("export"));
            }elseif($filterId == "container_schedules_eta_report_count_export_date"){
                $containerSchedules = $this->getAllCompleteLogs(BeanReturnDataType::getValue("export"));
                $fileName = "ContainerScheduleETAReports";
            }elseif($filterId == "container_schedules_empty_return_date_past_empty_lfd_count_export_date"){
                $containerSchedules = $this->getAllOverDueLogs(BeanReturnDataType::getValue("export"));
                $fileName = "ConstainerSchedule";
            }elseif($filterId == "container_schedules_pending_schedule_delivery_date_count_export_date"){
                $containerSchedules = $this->getAllSupervisorReviewLogs(BeanReturnDataType::getValue("export"));
                $fileName = "InstructionManualTotalProjectsInSupervisorsReview";
            }elseif($filterId == "container_schedules_missing_terminal_appointment_date_count_export_date"){
                $containerSchedules = $this->getAllManagerReviewLogs(BeanReturnDataType::getValue("export"));
                $fileName = "InstructionManualTotalProjectsInManagersReview";
            }elseif($filterId == "container_schedules_empty_alpine_notification_pickup_date_count_export_date"){
                $containerSchedules = $this->getAllBuyerReviewLogs(BeanReturnDataType::getValue("export"));
                $fileName = "InstructionManualTotalProjectsInBuyersReview";
            }elseif($filterId == "container_schedules_missing_confirmed_delivery_date_count_export_date"){
                $containerSchedules = $this->getAllDueTodayLogs(BeanReturnDataType::getValue("export"));
                $fileName = "InstructionManualTotalProjectsDueToday";
            }elseif($filterId == "container_schedules_missing_id_count_export_date"){
                $containerSchedules = $this->getAllDueInNext14DaysLogs(BeanReturnDataType::getValue("export"));
                $fileName = "InstructionManualTotalProjectsDueInNext14Days";
            }elseif($filterId == "container_schedules_missing_received_dates_in_oms_count_export_date"){
                $containerSchedules = $this->getAllDueLessThan14DaysFromEntryLogs(BeanReturnDataType::getValue("export"));
                $fileName = "InstructionManualTotalProjectDueLessThan14DaysFromEntry";
            }elseif($filterId == "container_schedules_missing_received_dates_in_wms_count_export_date"){
                $containerSchedules = $this->getAllNotStartedLogs(BeanReturnDataType::getValue("export"));
                $fileName = "InstructionManualTotalProjectsNotStarted";
            }elseif($filterId == "container_schedules_missing_schedule_delivery_date_count_export_date"){
                $containerSchedules = $this->getAllLogs(BeanReturnDataType::getValue("export"));
            }
            $ContainerExportSchedulesAndFileName['containerSchedules'] = $containerSchedules;
            $ContainerExportSchedulesAndFileName['fileName'] = $fileName;
            return $ContainerExportSchedulesAndFileName;
        }    
    }
?>