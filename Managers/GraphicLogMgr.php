<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
require_once $ConstantsArray['dbServerUrl'] . 'Managers/ClassCodeMgr.php';
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");

class GraphicLogMgr{
	private static $graphicLogMgr;
	private static $dataStore;
	private $dataTypeErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 27;
	public static function getInstance()
	{
		if (!self::$graphicLogMgr)
		{
			self::$graphicLogMgr = new GraphicLogMgr();
			self::$dataStore = new BeanDataStore(GraphicsLog::$className, GraphicsLog::$tableName);
		}
		return self::$graphicLogMgr;
	}
	
	public function saveGraphicLog($conn,$graphicLog){
    	self::$dataStore->saveObject($graphicLog,$conn);
    }
    
    public function save($graphicLog){
    	return self::$dataStore->save($graphicLog);
    }
    
    public function updateOject($conn,$item,$condition){
    	self::$dataStore->updateObject($item, $condition, $conn);
    }
	
	public function importGraphicLog($file,$isUpdate,$updateItemNos){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheet = $objPHPExcel->getActiveSheet();
		$maxCell = $sheet->getHighestRowAndColumn();
		$sheetData = $sheet->rangeToArray('A4:' . $maxCell['column'] . $maxCell['row']);
		return $this->validateAndSaveFile($sheetData,$isUpdate,$updateItemNos);
	}
	
	
	public function exportGraphicLog($queryString){
		$output = array();
		parse_str($queryString, $output);
		$_GET = array_merge($_GET,$output);
		$graphicLogs = self::$dataStore->findAll(true);
		ExportUtil::exportGraphicLogs($graphicLogs);
	}
	
	public function validateAndSaveFile($sheetData,$isUpdate,$updateItemNos){
		$message = "";
		$this->fieldNames = $sheetData[0];
		$itemNoAlreadyExists = 0;
		$success = 1;
		$messages = "";
		if(self::$FIELD_COUNT == count($this->fieldNames)){
			$mainJson = array();
			$json = array();
			$mainJson["success"] = 1;
			$mainJson["messages"] = "";
			$exstingsItemNos = array();
			$graphicLogsArr = array();
			$sessionUtil = SessionUtil::getInstance();
			$userSeq = $sessionUtil->getUserLoggedInSeq();
			foreach ($sheetData as $key=>$data){
				if($key == 0){
					continue;
				}
				if(!array_filter($data)) {
					continue;
				}
				$graphicLoc = $this->getImportedData($data);
				array_push($graphicLogsArr, $graphicLoc);
			}
		}else{
		    $messages .= StringConstants::IMPORT_CORRECT_FILE;
			$success = 0;
		}
		$response = array();
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		if(empty($messages)){
			$response = $this->saveArr($graphicLogsArr, $isUpdate,$updateItemNos);
		}
		return $response;
	}
	
	private function saveArr($graphicLogArr,$isUpdate,$updateItemNos){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$existingItemIds = array();
		$notSaved = array();
		$success = 1;
		
		foreach ($graphicLogArr as $index => $graphicLog){
			$rowId = 0;
			$rowId = $index + 5;
			try {
				if(!$isUpdate){
					$this->saveGraphicLog($conn, $graphicLog);
					$savedItemCount++;
				}else{
					if(in_array($itemNo, $updateItemNos)){
						$condition["itemnumbers"] = $itemNo;
						$condition["po"] = $po;
						$this->updateOject($conn, $qc, $condition);
					}
				}
			 }
			catch ( Exception $e) {
				$trace = $e->getTrace();
				if($trace[0]["args"][0][1] == "1062"){
					$messages .= "Row id: " . $rowId ." has duplicate values<br>";
				}else{
					$errMsg = $e->getMessage();
					$errMsg = str_replace( "at row 1", "", $errMsg);
					$messages .= "Row id: " . $rowId ." - ". $errMsg ."<br>";
				}
				
				$hasError = true;
				$success = 0;
			}
		}
		//if(empty($messages)){
			$conn->commit();
		//}else{
			//$conn->rollBack();
		//}
		if(!$hasError){
		    $messages = StringConstants::GRAPHIC_LOGS_IMPORTED_SUCCESSFULLY;
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		$response["savedItemCount"] = $savedItemCount;
		$response["existingItemIds"] = $existingItemIds;
		return $response;
	}
	
	private function validateNumeric($val,$fieldName){
		$message = "";
		$val = str_replace(",", "", $val);
		if(!is_numeric($val)){
			$message = "  - '$fieldName' should be numeric a value!<br>";
		}
		return $message;
	}
	
	private function getImportedData($data){
		$classCodeMgr = ClassCodeMgr::getInstance();
		$usaofficeentrydate = $data[0];
		$po = $data[1];
		$estimatedshipdate = $data[2];
		$classcode = $data[3];
		$sku = $data[4];
		$graphictype = $data[5];
		$iscustomhangtagneeded = $data[6];
		$iscustomwraptagneeded = $data[7];
		$customername = $data[8];
		$isprivatelabel = $data[9];
		$usanotes = $data[10];
		$estimatedgraphicsdate = $data[11];
		$chinaofficeentrydate = $data[12];
		$confirmedposhipdate = $data[13];
		$jeopardydate = $data[14];
		$graphiclength = $data[15];
		$graphicwidth = $data[16];
		$graphicheight = $data[17];
		$chinanotes = $data[18];
		$finalgraphicsduedate = $data[19];
		$graphicstochinanotes = $data[20];
		$approxgraphicschinasentdate = $data[21];
		$graphicstatus = $data[22];
		$graphicartist = $data[23];
		$graphicartiststartdate = $data[24];
		$graphiccompletiondate = $data[25];
		$duration = $data[26];
		
		$this->dataTypeErrors = "";	
		$format = "m-d-y";
		$na = "N/A";
		
		$graphicLog = new GraphicsLog();
		if(!empty($usaofficeentrydate)){
			$usaofficeentrydate = $this->convertStrToDate($usaofficeentrydate);
			$graphicLog->setUSAOfficeEntryDate($usaofficeentrydate);
		}
		if(!empty($po)){
			$graphicLog->setPO($po);
		}
		if(!empty($estimatedshipdate)){
			$estimatedshipdate = $this->convertStrToDate($estimatedshipdate);
			$graphicLog->setEstimatedShipDate($estimatedshipdate);
		}
		if(!empty($classcode)){
			$classCodeObj = $classCodeMgr->findByClassCode($classcode);
			$classCodeSeq = 0;
			if(!empty($classCodeObj)){
				$classCodeSeq = $classCodeObj->getSeq();
			}
			$graphicLog->setClassCodeSeq($classCodeSeq);
		}
		if(!empty($sku)){
			$graphicLog->setSKU($sku);
		}
		if(!empty($graphictype)){
			$graphicLog->setGraphicType($graphictype);
		}
		
		if(!empty($iscustomhangtagneeded)){
			if(strtolower($iscustomhangtagneeded) == "yes"){
				$graphicLog->setIsCustomHangTagNeeded(1);
			}else{
				$graphicLog->setIsCustomHangTagNeeded(0);
			}
		}else{
			$graphicLog->setIsCustomHangTagNeeded(0);
		}
		
		if(!empty($iscustomwraptagneeded)){
			if(strtolower($iscustomwraptagneeded) == "yes"){
				$graphicLog->setIsCustomWrapTagNeeded(1);
			}else{
				$graphicLog->setIsCustomWrapTagNeeded(0);
			}
		}else{
			$graphicLog->setIsCustomWrapTagNeeded(0);
		}
		
		if(!empty($customername)){
			$graphicLog->setCustomerName($customername);
		}
		
		if(!empty($isprivatelabel)){
			if(strtolower($isprivatelabel) == "yes"){
				$graphicLog->setIsPrivateLabel(1);
			}else{
				$graphicLog->setIsPrivateLabel(0);
			}
		}else{
			$graphicLog->setIsPrivateLabel(0);
		}
		
		if(!empty($usanotes)){
			$graphicLog->setUSANotes($usanotes);
		}
		if(!empty($estimatedgraphicsdate)){
			$estimatedgraphicsdate = $this->convertStrToDate($estimatedgraphicsdate);
			$graphicLog->setEstimatedGraphicsDate($estimatedgraphicsdate);
		}
		if(!empty($chinaofficeentrydate)){
			$chinaofficeentrydate = $this->convertStrToDate($chinaofficeentrydate);
			$graphicLog->setChinaOfficeEntryDate($chinaofficeentrydate);
		}
		if(!empty($confirmedposhipdate)){
			$confirmedposhipdate = $this->convertStrToDate($confirmedposhipdate);
			$graphicLog->setConfirmedPOShipDate($confirmedposhipdate);
		}
		if(!empty($jeopardydate)){
			$jeopardydate = $this->convertStrToDate($jeopardydate);
			$graphicLog->setJeopardyDate($jeopardydate);
		}
		if(!empty($graphiclength)){
			$graphicLog->setGraphicLength($graphiclength);
		}
		if(!empty($graphicheight)){
			$graphicLog->setGraphicHeight($graphicheight);
		}
		if(!empty($graphicwidth)){
			$graphicLog->setGraphicWidth($graphicwidth);
		}
		if(!empty($chinanotes)){
			$graphicLog->setChinaNotes($chinanotes);
		}
		if(!empty($finalgraphicsduedate)){
			$finalgraphicsduedate = $this->convertStrToDate($finalgraphicsduedate);
			$graphicLog->setFinalGraphicsDueDate($finalgraphicsduedate);
		}
		if(!empty($graphicstochinanotes)){
			$graphicLog->setGraphicsToChinaNotes($graphicstochinanotes);
		}
		if(!empty($approxgraphicschinasentdate)){
			$approxgraphicschinasentdate = $this->convertStrToDate($approxgraphicschinasentdate);
			$graphicLog->setApproxGraphicsChinaSentDate($approxgraphicschinasentdate);
		}
		if(!empty($graphicstatus)){
			$graphicLog->setGraphicStatus($graphicstatus);
		}
		if(!empty($graphicartist)){
			$graphicLog->setGraphicArtist($graphicartist);
		}
		if(!empty($graphicartiststartdate)){
			$graphicartiststartdate = $this->convertStrToDate($graphicartiststartdate);
			$graphicLog->setGraphicArtistStartDate($graphicartiststartdate);
		}
		if(!empty($graphiccompletiondate)){
			$graphiccompletiondate = $this->convertStrToDate($graphiccompletiondate);
			$graphicLog->setGraphicCompletionDate($graphiccompletiondate);
		}
		if(!empty($duration)){
			$graphicLog->setDuration($duration);
		}
		
		$graphicLog->setCreatedOn(DateUtil::getCurrentDate());
		$graphicLog->setLastModifiedOn(DateUtil::getCurrentDate());
		$graphicLog->setUserSeq(1);
		//$importedData["items"] = $itemNoArr;
		return $graphicLog;
	}
	
	public function getGraphicLogsForGrid(){
	    $sessionUtil = SessionUtil::getInstance();
	    $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
	    $loggedinUserSeq = $sessionUtil->getUserLoggedInSeq();
	    $isSessionQc= $sessionUtil->isSessionQC();
	    $myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
	    $query = "select users.fullname,classcode,graphicslogs.* from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
	    if($isSessionQc){
		    if(count($myTeamMembersArr) == 0){
		        $query .= " where users.seq = $loggedinUserSeq";
		    }else{
		        $myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
		        $query .= " where users.seq in($myTeamMembersCommaSeparated)";
		    }
	    }
		$rows = self::$dataStore->executeQuery($query,true);
		$arr = array();
		foreach($rows as $row){		    
    	    $lastModifiedOn = $row["lastmodifiedon"];
    	    $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
    	    $row["lastmodifiedon"] = $lastModifiedOn;
    	    array_push($arr,$row);		    
		}
		$mainArr["Rows"] = $arr;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
	    $sessionUtil = SessionUtil::getInstance();
	    $loggedinUserSeq = $sessionUtil->getUserLoggedInSeq();
	    $isSessionQc= $sessionUtil->isSessionQC();
	    $myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
	    $query = "select count(*) from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
	    if($isSessionQc){ 
	        if(count($myTeamMembersArr) == 0){
			    $query .= " where users.seq = $loggedinUserSeq"; 
		    }else{
		        $myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
		        $query .=" where users.seq in($myTeamMembersCommaSeparated)";
	       	}
	    }
       $count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
       return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$itemArr = self::$dataStore->findAllArr($isApplyFilter);
		return $itemArr;
	}
	
	
	public function findBySeq($seq){
		$graphicLog = self::$dataStore->findBySeq($seq);
		$graphicLog->setUSAOfficeEntryDate($this->getDateStr($graphicLog->getUSAOfficeEntryDate()));
		$graphicLog->setEstimatedShipDate($this->getDateStr($graphicLog->getEstimatedShipDate()));
		$graphicLog->setEstimatedGraphicsDate($this->getDateStr($graphicLog->getEstimatedGraphicsDate()));
		$graphicLog->setChinaOfficeEntryDate($this->getDateStr($graphicLog->getChinaOfficeEntryDate()));
		$graphicLog->setConfirmedPOShipDate($this->getDateStr($graphicLog->getConfirmedPOShipDate()));
		$graphicLog->setJeopardyDate($this->getDateStr($graphicLog->getJeopardyDate()));
		$graphicLog->setFinalGraphicsDueDate($this->getDateStr($graphicLog->getFinalGraphicsDueDate()));
		$graphicLog->setApproxGraphicsChinaSentDate($this->getDateStr($graphicLog->getApproxGraphicsChinaSentDate()));
		$graphicLog->setGraphicArtistStartDate($this->getDateStr($graphicLog->getGraphicArtistStartDate()));
		$graphicLog->setGraphicCompletionDate($this->getDateStr($graphicLog->getGraphicCompletionDate()));
		$graphicLog->setDraftDate($this->getDateStr($graphicLog->getDraftDate()));
		$graphicLog->setBuyerReviewReturnDate($this->getDateStr($graphicLog->getBuyerReviewReturnDate()));
		$graphicLog->setManagerReviewReturnDate($this->getDateStr($graphicLog->getManagerReviewReturnDate()));
		return $graphicLog;
	}
	
	public function deleteByIds($ids){
		return self::$dataStore->deleteInList($ids);
	}
	
// 	public function getPendindSchedules($notificationType){
// 		$qcSchedules = array();
// 		if($notificationType == NotificationType::SC_READY_DATE){
// 			$qcSchedules = $this->getPendingShechededForReadyDate();
// 		}else if($notificationType == NotificationType::SC_FINAL_INPECTION_DATE){
// 			$qcSchedules = $this->getPendingShechededForFinalInspectionDate();
// 		}else if($notificationType == NotificationType::SC_FIRST_INSPECTION_DATE){
// 			$qcSchedules = $this->getPendingShechededForFirstInspectionDate();
// 		}else if($notificationType == NotificationType::SC_MIDDLE_INSPECTION_DATE){
// 			$qcSchedules = $this->getPendingShechededForMiddleInspectionDate();
// 		}else if($notificationType == NotificationType::SC_PRODUCTION_START_DATE){
// 			$qcSchedules = $this->getPendingShechededForProductionStartDate();
// 		}else if($notificationType == NotificationType::SC_GRAPHIC_RECEIVE_DATE){
// 			$qcSchedules = $this->getPendingShechededForGraphicReceiveDate();
// 		}
// 		$poSchedules = $this->groupByPO($qcSchedules);
// 		return $poSchedules;
// 	}
	
// 	public function getPendingShechededForReadyDate(){
// 		$query = "select * from qcschedules where apreadydate > CURDATE() and apreadydate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acreadydate is NULL order by QC ASC, classcodes ASC, apreadydate ASC";
// 		$qcschedules = self::$dataStore->executeObjectQuery($query);
// 		return $qcschedules;
// 	}
	
// 	public function getPendingShechededForFinalInspectionDate(){
// 		$query = "select * from qcschedules where apfinalinspectiondate > CURDATE() and apfinalinspectiondate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acfinalinspectiondate is NULL order by QC ASC, classcode ASC,apfinalinspectiondate asc";
// 		$qcschedules = self::$dataStore->executeObjectQuery($query);
// 		return $qcschedules;
// 	}
	
// 	public function getPendingShechededForMiddleInspectionDate(){
// 		$query = "select * from qcschedules where apmiddleinspectiondate > CURDATE() and apmiddleinspectiondate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acmiddleinspectiondate is NULL order by QC ASC, classcode ASC,apmiddleinspectiondate asc";
// 		$qcschedules = self::$dataStore->executeObjectQuery($query);
// 		return $qcschedules;
// 	}
	
// 	public function getPendingShechededForFirstInspectionDate(){
// 		$query = "select * from qcschedules where apfirstinspectiondate > CURDATE() and apfirstinspectiondate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acfirstinspectiondate is NULL order by QC ASC, classcode ASC,apfirstinspectiondate asc";
// 		$qcschedules = self::$dataStore->executeObjectQuery($query);
// 		return $qcschedules;
// 	}
	
// 	public function getPendingShechededForProductionStartDate(){
// 		$query = "select * from qcschedules where approductionstartdate > CURDATE() and approductionstartdate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acproductionstartdate is NULL order by QC ASC, classcode ASC,approductionstartdate asc";
// 		$qcschedules = self::$dataStore->executeObjectQuery($query);
// 		return $qcschedules;
// 	}
	
// 	public function getPendingShechededForGraphicReceiveDate(){
// 		$query = "select * from qcschedules where apgraphicsreceivedate > CURDATE() and apgraphicsreceivedate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acgraphicsreceivedate is NULL order by QC ASC, classcode ASC,apgraphicsreceivedate asc";
// 		$qcschedules = self::$dataStore->executeObjectQuery($query);
// 		return $qcschedules;
// 	}
	
	private function convertStrToDate($date){
		$format = 'm-d-y';
		$date = DateUtil::StringToDateByGivenFormat($format, $date);
		if(!$date){
			$date = DateUtil::getCurrentDate();
		}
		return $date;
	}
	
	private function getDateStr($date){
		$format = 'Y-m-d';
		if(!empty($date)){
			$date = DateUtil::StringToDateByGivenFormat($format, $date);
			$date = $date->format("m-d-Y");
		}
		return $date;
	}
	
	
	
	
	
	 
}