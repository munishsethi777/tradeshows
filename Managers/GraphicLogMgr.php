<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/GraphicStatusType.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
require_once $ConstantsArray['dbServerUrl'] . 'Managers/ClassCodeMgr.php';
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");

class GraphicLogMgr{
	private static $graphicLogMgr;
	private static $dataStore;
	private $dataTypeErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 27;
	private static $currentDateWith7daysInterval;
	private static $timeZone = "America/Los_Angeles";
	public static function getInstance()
	{
		if (!self::$graphicLogMgr)
		{
			self::$graphicLogMgr = new GraphicLogMgr();
			self::$dataStore = new BeanDataStore(GraphicsLog::$className, GraphicsLog::$tableName);
			self::$currentDateWith7daysInterval = DateUtil::getDateInDBFormat(7,null,self::$timeZone);
			
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
		$graphicLog->setRobbyReviewDate($this->getDateStr($graphicLog->getRobbyReviewDate()));
		$graphicLog->setGraphicStatusChangeDate($this->getDateTimeStr($graphicLog->getGraphicStatusChangeDate()));
		return $graphicLog;
	}
	
	public function deleteByIds($ids){
		return self::$dataStore->deleteInList($ids);
	}
	
	private $select = "select users.fullname, classcodes.classcode,graphicslogs.* from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq ";
	
	//Report APIs
	
	//Projects due for the week / If greater than 25, some kind of red flag (as that is more than 1 person could probably handle in a week)
	public function getForProjectDueForNextWeek(){
	    $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
	    $currentDateWithInterval = self::$currentDateWith7daysInterval;
	    $query = $this->select . "where finalgraphicsduedate >= '$currentDate' and finalgraphicsduedate < '$currentDateWithInterval'";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	public function getForProjectOverDue(){
	    $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
	    $query = $this->select . "where finalgraphicsduedate < '$currentDate'";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	public function getForProjectCompletedLastWeek(){
	    $currentDate =  DateUtil::getDateInDBFormat(0,null,self::$timeZone);
	    $dateIntervalWith7Days = DateUtil::getDateInDBFormatWithInterval(7,null,true,self::$timeZone);
	    $query = $this->select . " where graphiccompletiondate >= '$dateIntervalWith7Days' and graphiccompletiondate < '$currentDate'";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	
	public function getByGraphicStatus($status){
	    $status = GraphicStatusType::getName($status);
	    $query = $this->select . "where graphicstatus = '$status'";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	public function getByPastDueWithMissingInfoFromChina(){
	    $currentDate = DateUtil::getDateInDBFormat(0,null);
	    $missingFromChina = GraphicStatusType::getName(GraphicStatusType::MISSING_INFO_FROM_CHINA);
	    $query = $this->select . "where graphicstatus = '$missingFromChina' and finalgraphicsduedate < '$currentDate'";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	
	public function getForProjectDueForToday(){
	    $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
	    $query = $this->select . "where finalgraphicsduedate = '$currentDate'";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	
	
	public function getForProjectDueLessThan20FromEntry(){
	    $query = $this->select . "where datediff(finalgraphicsduedate,chinaofficeentrydate) < 20";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	public function getForProjectDueLessThan20FromToday(){
	    $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
	    $lastDate = DateUtil::getDateInDBFormatWithInterval(1,null,true,self::$timeZone);
	    $query = $this->select . "where DATE_FORMAT(graphicslogs.createdon,'%Y-%m-%d')  = '$lastDate' and   datediff(finalgraphicsduedate,'$currentDate') < 20";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	

	
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
	private function getDateTimeStr($date){
	    $sessionUtil = SessionUtil::getInstance();
	    $timeZone = $sessionUtil->getUserLoggedInTimeZone();
	    if(!empty($date)){
	        $date = DateUtil::convertDateToFormatWithTimeZone($date, "Y-m-d H:i:s", "m-d-Y h:i a",$timeZone);
	    }
	    return $date;
	}
	
	
	
	
	
	 
}