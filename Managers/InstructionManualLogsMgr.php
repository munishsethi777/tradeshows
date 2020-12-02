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
            $sessionUtil = SessionUtil::getInstance();
            $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
            $loggedinUserSeq = $sessionUtil->getUserLoggedInSeq();
            $myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
            // $query = "select users.fullname,classcode,graphicslogs.* from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
            $query = "select classcode,instructionmanuallogs.* from instructionmanuallogs left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq";
            
            $rows = self::$dataStore->executeQuery($query,true);
            $arr = array();
            foreach($rows as $row){
                $row["instructionmanuallogstatus"] = InstructionManualLogStatus::getValue($row["instructionmanuallogstatus"]);	
                $row["graphicduedate"] = DateUtil::convertDateToFormat($row["graphicduedate"], "Y-m-d", "Y-m-d H:i:s");
                array_push($arr,$row);		    
            }
            $mainArr["Rows"] = $arr;
            $mainArr["TotalRows"] = $this->getAllCount(true);
            return $mainArr;
        }
        public function getAllCount($isApplyFilter){
            $sessionUtil = SessionUtil::getInstance();
            $loggedinUserSeq = $sessionUtil->getUserLoggedInSeq();
            $myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
            $query = "select count(*) from instructionmanuallogs left join classcodes on instructionmanuallogs.classcodeseq = classcodes.seq";
            //We
    // 	    if($isSessionQc){ 
    // 	        if(count($myTeamMembersArr) == 0){
    // 			    $query .= " where users.seq = $loggedinUserSeq"; 
    // 		    }else{
    // 		        $myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
    // 		        $query .=" where users.seq in($myTeamMembersCommaSeparated)";
    // 	       	}
    // 	    }
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
    }
?>