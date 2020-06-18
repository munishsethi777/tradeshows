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
	private static $FIELD_COUNT = 30;
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
		$sheetData = $sheet->rangeToArray('A3:' . $maxCell['column'] . $maxCell['row']);
		return $this->validateAndSaveFile($sheetData,$isUpdate,$updateItemNos);
	}
	
	
	public function exportGraphicLog($queryString,$graphicLogsSeqs){
		$output = array();
		parse_str($queryString, $output);
		$_GET = array_merge($_GET,$output);
		$graphicLogs = array();
		$sessionUtil = SessionUtil::getInstance();
		//if($_GET['exportOptionForGraphicsLogs'] != "template"){
			$query = "select users.fullname,classcode,graphicslogs.* from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
				if(!empty($graphicLogsSeqs)){
					$query .= " where graphicslogs.seq in ($graphicLogsSeqs)";
				}
			$graphicLogs = self::$dataStore->executeObjectQuery($query,true,true,true);
		//}
		
		
		ExportUtil::exportGraphicLogs($graphicLogs);
	}
	
	public function validateAndSaveFile($sheetData,$isUpdate,$updateItemNos){
		$message = "";
		$this->fieldNames = $sheetData[0];
		$itemNoAlreadyExists = 0;
		$success = 1;
		$messages = "";
		$row = 0;
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
				$row = $key+3;
				if(!array_filter($data)) {
					continue;
				}
				try{
				$graphicLog = $this->getImportedData($data);
				array_push($graphicLogsArr, $graphicLog);
				}catch (Exception $e){
					$messages .= "Error found on row " . $row ." - ". $e->getMessage() . "<br>";
                    $success = 0;
				}
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
			$rowId = $index + 3;
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
					$messages .= "Row id: " . $rowId ." Graphic Log already exists<br>";
				}else{
					$errMsg = $e->getMessage();
					$errMsg = str_replace( "at row 1", "", $errMsg);
					$messages .= "Row id: " . $rowId ." - ". $errMsg ."<br>";
				}
				
				$hasError = true;
				$success = 0;
			}
		}
		if(!$hasError){
			$conn->commit();
		    $messages = StringConstants::GRAPHIC_LOGS_IMPORTED_SUCCESSFULLY;
		}else{
			$conn->rollBack();
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
		$sessionUtil = SessionUtil::getInstance();
		$userSeq = $sessionUtil->getAdminLoggedInSeq();
		$exceptionMsgs = array();
		
		$usaofficeentrydate = $data[0];
		$po = $data[1];
		$estimatedshipdate = $data[2];
		$classcode = $data[3];
		$estimatedgraphicsdate = $data[4];
		$sku = $data[5];
		$graphictype = $data[6];
		$tagtype = $data[7];
		$customername = $data[8];
		$isprivatelabel = $data[9];
		$usanotestographics = $data[10];
		$chinaofficeentrydate = $data[11];
		$finalgraphicsduedate = $data[12];
		$confirmedposhipdate = $data[13];
		$enteredby = $data[14];
		$graphiclength = $data[15];
		$graphicwidth = $data[16];
		$graphicheight = $data[17];
		$chinanotestousa = $data[18];
		$assigneddesigner = $data[19];
		$graphicstartdate = $data[20];
		$graphicstatus = $data[21];
		$graphicsubmittochinadate = $data[22];
		$graphiccompletiondate = $data[23];
		$duration = $data[24];
		$draftdate = $data[25];
		$buyerreviewreturndate = $data[26];
		$managerreviewreturndate = $data[27];
		$robbyreviewreturndate = $data[28];
		$graphictochinanotes = $data[29];
		
		$this->dataTypeErrors = "";	
		$format = "m-d-y";
		$na = "N/A";
		
		$graphicLog = new GraphicsLog();
		if(!empty($usaofficeentrydate)){
			if($this->validateDate($usaofficeentrydate, $format)){
				$usaofficeentrydate = $this->convertStrToDate($usaofficeentrydate);
				$graphicLog->setUSAOfficeEntryDate($usaofficeentrydate);
			}else{
				$exceptionMsgs[] = "USA Office Entry Date has bad format";
			}
		}else{
			$exceptionMsgs[] = "USA Office Entry Date cannot be empty";
		}
		if(!empty($po)){
			$graphicLog->setPO($po);
		}else{
			$exceptionMsgs[] ="PO cannot be empty";
		}
		if(!empty($estimatedshipdate)){
			if($this->validateDate($estimatedshipdate, $format)){
				$estimatedshipdate = $this->convertStrToDate($estimatedshipdate);
				$graphicLog->setEstimatedShipDate($estimatedshipdate);
			}else{
				$exceptionMsgs[] = "Estimated Ship Date has bad format";
			}
		}
		if(!empty($classcode)){
			$classCodeObj = $classCodeMgr->findByClassCode($classcode);
			if(!empty($classCodeObj)){
				$classCodeSeq = $classCodeObj->getSeq();
				$graphicLog->setClassCodeSeq($classCodeSeq);
			}else{
				//$exceptionMsgs[] = $classcode." Class Code not found";
			}
		}
		if(!empty($estimatedgraphicsdate)){
			if($this->validateDate($estimatedgraphicsdate, $format)){
				$estimatedgraphicsdate = $this->convertStrToDate($estimatedgraphicsdate);
				$graphicLog->setEstimatedGraphicsDate($estimatedgraphicsdate);
			}else{
				$exceptionMsgs[] = "Estimated Graphics Due Date has bad format";
			}
		}
		if(!empty($sku)){
			$graphicLog->setSKU($sku);
		}else{
			$exceptionMsgs[] ="Item number cannot be empty";
		}
		if(!empty($graphictype)){
			$graphictype = str_replace(" ", "_", $graphictype);
			$graphicLog->setGraphicType(strtolower($graphictype));
		}
		if(!empty($tagtype)){
			$tagtype = str_replace(" ", "_", $tagtype);
			$graphicLog->setTagType(strtolower($tagtype));
		}
		if(!empty($customername)){
			$graphicLog->setCustomerName($customername);
		}else{
			$exceptionMsgs[] = "Customer name cannot be empty";
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
		
		if(!empty($usanotestographics)){
			$graphicLog->setUSANotes($usanotestographics);
		}
		if(!empty($chinaofficeentrydate)){
			if($this->validateDate($chinaofficeentrydate, $format)){
				$chinaofficeentrydate = $this->convertStrToDate($chinaofficeentrydate);
				$graphicLog->setChinaOfficeEntryDate($chinaofficeentrydate);
			}else{
				$exceptionMsgs[] = "China Office Entry Date has bad format";
			}
		}
		if(!empty($finalgraphicsduedate)){
			if($this->validateDate($finalgraphicsduedate, $format)){
				$finalgraphicsduedate = $this->convertStrToDate($finalgraphicsduedate);
				$graphicLog->setFinalGraphicsDueDate($finalgraphicsduedate);
			}else{
				$exceptionMsgs[] = "Graphics Final Due Date has bad format";
			}
		}
		if(!empty($confirmedposhipdate)){
			if($this->validateDate($confirmedposhipdate, $format)){
				$confirmedposhipdate = $this->convertStrToDate($confirmedposhipdate);
				$graphicLog->setConfirmedPOShipDate($confirmedposhipdate);
			}else{
				$exceptionMsgs[] = "Confirmed PO Ship Date has bad format";
			}
		}
		
		
		$graphicLog->setUserSeq($userSeq);
		
		if(!empty($graphiclength)){
			$graphicLog->setGraphicLength($graphiclength);
		}
		if(!empty($graphicheight)){
			$graphicLog->setGraphicHeight($graphicheight);
		}
		if(!empty($graphicwidth)){
			$graphicLog->setGraphicWidth($graphicwidth);
		}
		if(!empty($chinanotestousa)){
			$graphicLog->setChinaNotes($chinanotestousa);
		}
		
		$graphicLog->setGraphicArtist($assigneddesigner);
		
		if(!empty($graphicstartdate)){
			if($this->validateDate($graphicstartdate, $format)){
				$graphicstartdate = $this->convertStrToDate($graphicstartdate);
				$graphicLog->setGraphicArtistStartDate($graphicstartdate);
			}else{
				$exceptionMsgs[] = "Graphics Start Date has bad format";
			}
		}
		if(!empty($graphiccompletiondate)){
			if($this->validateDate($graphiccompletiondate, $format)){
				$graphiccompletiondate = $this->convertStrToDate($graphiccompletiondate);
				$graphicLog->setGraphicCompletionDate($graphiccompletiondate);
			}else{
				$exceptionMsgs[] = "Graphics Completion Date has bad format";
			}
		}
		if(!empty($graphicstatus)){
			$graphicstatus = str_replace(" ", "_", $graphicstatus);
			$graphicstatus = str_replace("'", "", $graphicstatus);	
			$graphicLog->setGraphicStatus(strtolower($graphicstatus));
		}
		if(!empty($graphicsubmittochinadate)){
			if($this->validateDate($graphicsubmittochinadate, $format)){
				$graphicsubmittochinadate = $this->convertStrToDate($graphicsubmittochinadate);
			$graphicLog->setApproxGraphicsChinaSentDate($graphicsubmittochinadate);
			}else{
				$exceptionMsgs[] = "Graphics Submitted to China Date has bad format";
			}
		}
		
		if(!empty($duration)){
			$graphicLog->setDuration($duration);
		}
		if(!empty($draftdate)){
			if($this->validateDate($draftdate, $format)){
				$draftdate = $this->convertStrToDate($draftdate);
				$graphicLog->setDraftDate($draftdate);
			}else{
				$exceptionMsgs[] = "Draft Date has bad format";
			}
		}
		if(!empty($buyerreviewreturndate)){
			if($this->validateDate($buyerreviewreturndate, $format)){
				$buyerreviewreturndate = $this->convertStrToDate($buyerreviewreturndate);
				$graphicLog->setBuyerReviewReturnDate($buyerreviewreturndate);
			}else{
				$exceptionMsgs[] = "Buyer Review Return Date has bad format";
			}
		}
		if(!empty($managerreviewreturndate)){
			if($this->validateDate($managerreviewreturndate, $format)){
				$managerreviewreturndate = $this->convertStrToDate($managerreviewreturndate);
			$graphicLog->setManagerReviewReturnDate($managerreviewreturndate);
			}else{
				$exceptionMsgs[] = "Manager Review Return Date has bad format";
			}
			
		}
		if(!empty($robbyreviewreturndate)){
			if($this->validateDate($robbyreviewreturndate, $format)){
				$robbyreviewreturndate = $this->convertStrToDate($robbyreviewreturndate);
				$graphicLog->setRobbyReviewDate($robbyreviewreturndate);
			}else{
				$exceptionMsgs[] = "Robbys Review Return Date has bad format";
			}
		}
		if(!empty($graphictochinanotes)){
			$graphicLog->setGraphicsToChinaNotes($graphictochinanotes);
		}
		$graphicLog->setCreatedOn(DateUtil::getCurrentDate());
		$graphicLog->setLastModifiedOn(DateUtil::getCurrentDate());
		$graphicLog->setUserSeq($userSeq);
		if(!empty($exceptionMsgs)){
			throw new Exception(implode(", ",$exceptionMsgs));
		}
		return $graphicLog;
	}
	
	public function getGraphicLogsForGrid(){
	    $sessionUtil = SessionUtil::getInstance();
	    $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
	    $loggedinUserSeq = $sessionUtil->getUserLoggedInSeq();
	    $myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
	    $query = "select users.fullname,classcode,graphicslogs.* from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
		//We dont need teams etc for QC roles
// 	    $isSessionQc= $sessionUtil->isSessionQC();
// 	    if($isSessionQc){
// 		    if(count($myTeamMembersArr) == 0){
// 		        $query .= " where users.seq = $loggedinUserSeq";
// 		    }else{
// 		        $myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
// 		        $query .= " where users.seq in($myTeamMembersCommaSeparated)";
// 		    }
// 	    }
		$rows = self::$dataStore->executeQuery($query,true);
		$arr = array();
		foreach($rows as $row){	
		    $row["usaofficeentrydate"] = DateUtil::convertDateToFormat($row["usaofficeentrydate"], "Y-m-d", "Y-m-d H:i:s");
		    $row["estimatedshipdate"] = DateUtil::convertDateToFormat($row["estimatedshipdate"], "Y-m-d", "Y-m-d H:i:s");
		    $row["estimatedgraphicsdate"] = DateUtil::convertDateToFormat($row["estimatedgraphicsdate"], "Y-m-d", "Y-m-d H:i:s");
		    $row["finalgraphicsduedate"] = DateUtil::convertDateToFormat($row["finalgraphicsduedate"], "Y-m-d", "Y-m-d H:i:s");
		    $lastModifiedOn = $row["lastmodifiedon"];
    	    $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
    	    $row["lastmodifiedon"] = $lastModifiedOn;
    	    $row["graphicstatus"] = GraphicStatusType::getValue($row["graphicstatus"]);
    	    $row["tagtype"] = TagType::getValue($row["tagtype"]);
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
	    $query = "select count(*) from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
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
	    $query = $this->select . "where finalgraphicsduedate < '$currentDate' and graphiccompletiondate IS NULL ";
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
	    $missingFromChina = GraphicStatusType::getName(GraphicStatusType::missing_info_from_china);
	    $query = $this->select . "where graphicstatus = '$missingFromChina' and finalgraphicsduedate < '$currentDate'";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	
	public function getForProjectDueForToday(){
	    $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
	    $query = $this->select . "where finalgraphicsduedate = '$currentDate' and graphiccompletiondate is null";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	
	
	public function getForProjectDueLessThan20FromEntry(){
	    $query = $this->select . "where datediff(finalgraphicsduedate,chinaofficeentrydate) < 20 and graphiccompletiondate is null";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	public function getForProjectDueLessThan20FromToday(){
	    $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
	    $lastDate = DateUtil::getDateInDBFormatWithInterval(1,null,true,self::$timeZone);
	    $query = $this->select . "where DATE_FORMAT(graphicslogs.createdon,'%Y-%m-%d')  = '$lastDate' and   datediff(finalgraphicsduedate,'$currentDate') < 20 and graphiccompletiondate is null";
	    $graphicLogs = self::$dataStore->executeObjectQuery($query);
	    return $graphicLogs;
	}
	
	

	
	private function convertStrToDate($date){
		$format = 'm-d-y';
		$date = DateUtil::StringToDateByGivenFormat($format, $date);
		return $date;
	}
	private function validateDate($date, $format){
		// if(is_string($date)){
		$d = DateTime::createFromFormat($format, $date);
		// if(intval($d->format("m")) < 10)
		// {
		//     $c = "0" . $date;
			//     if(intval($d->format("d")) < 10)
			//     {
			//         $c = substr($c,0,3) . "0" . substr($c,3);
			//     }
			//     return $d && $d->format($format) === $c;
			// }
			return $d && $d->format($format) === $date;
			// }else{
			//     try{
			//         $d = PHPExcel_Shared_Date::ExcelToPHPObject($date);
				//         return true;
				//     }catch(Exception $e){
				//         return false;
				//     }
				// }
	
	
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