<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/QCScheduleApprovalType.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
require_once $ConstantsArray['dbServerUrl'] . 'Managers/ClassCodeMgr.php';
require_once $ConstantsArray['dbServerUrl'] . 'Utils/QCScheduleImportUtil.php';
class QCScheduleMgr{
	private static  $qcScheduleMgr;
	private static $dataStore;
	private $dataTypeErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 19;
	private static $ACTUAL_FIELDS_NAMES = array("qc","classcode","po#","potype","itemno","shipdate","readydate","finalinspectiondate","middleinspectiondate","firstinspectiondate","productionstartdate","graphicsreceivedate","readydate","finalinspectiondate","middleinspectiondate","firstinspectiondate","productionstartdate","graphicsreceivedate","notes","finalstatus");
	private static $FIELDS_NAMES = array("Qc","Class Code","PO#","PO Type","Item No","Ship Date","Ready Date","Final Inspection Date","Middle Inspection Date","First Inspection Date","Production Start Date","Graphics Receive Date","Ready Date","Final Inspection Date","Middle Inspection Date","First Inspection Date","Production Start Date","Graphics Receive Date","Notes","Final Status");
	
	public static function getInstance()
	{
		if (!self::$qcScheduleMgr)
		{
			self::$qcScheduleMgr = new QCScheduleMgr();
			self::$dataStore = new BeanDataStore(QCSchedule::$className, QCSchedule::$tableName);
		}
		return self::$qcScheduleMgr;
	}
	
	public function saveQCSchedule($conn,$qcschedule){
    	self::$dataStore->saveObject($qcschedule,$conn);
    }
    
    public function save($qcschedule){
    	return self::$dataStore->save($qcschedule);
    }
    
    public function updateOject($conn,$item,$condition){
    	self::$dataStore->updateObject($item, $condition, $conn);
    }
	
    public function importQCSchedulesWithActualDates($file,$isUpdate,$updateItemNos){
        $qcScheduleImportUtil = QCScheduleImportUtil::getInstance();
        return $qcScheduleImportUtil->importQCSchedules($file,$isUpdate,$updateItemNos);
    }
	
	public function importQCSchedules($file,$isUpdate,$updateItemNos){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheet = $objPHPExcel->getActiveSheet();
		$maxCell = $sheet->getHighestRowAndColumn();
		$sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row']);
		try{
		    return $this->validateAndSaveFile($sheetData,$isUpdate,$updateItemNos);
		}catch (Exception $e){
		    throw $e;
		}
	}
	
	
	public function exportQCSchedules($queryString){
		$output = array();
		parse_str($queryString, $output);
		$_GET = array_merge($_GET,$output);
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
		$isSessionGeneralUser = $sessionUtil->isSessionGeneralUser();
		//$query = "select classcode,qccode , qcschedules.* from qcschedules left join users on qcschedules.qcuser = users.seq left join classcodes on qcschedules.classcodeseq = classcodes.seq left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq ";
		$query = "select classcode,qccode , qcschedules.* from qcschedules left join users on qcschedules.qcuser = users.seq left join classcodes on qcschedules.classcodeseq = classcodes.seq ";
		
		if($isSessionGeneralUser){
			if(count($myTeamMembersArr) == 0){
				$query .= " where users.seq = $loggedInUserSeq ";
			}else{
				$myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
				$query .= " where users.seq in($myTeamMembersCommaSeparated)";
			}
		}
		
		$qcSchedules = array();
		$qcSchedules = self::$dataStore->executeQuery($query,true);
		ExportUtil::exportQCSchedules($qcSchedules);
	}
	
	private function groupByPO($qcSchedules){
		$poSchedules = $this->_group_by($qcSchedules, "po");
		$mainArr = array();
		foreach ($poSchedules as $qcSchedules){
			$itemNumbers = "";
			foreach ($qcSchedules as $qcSchedule){
				$itemNumbers .= $qcSchedule->getItemNumbers() . "\n";
			}
			//$itemNumbers = substr($itemNumbers, 0, -2);
			$qcSchedule->setItemNumbers(trim($itemNumbers));
			array_push($mainArr,$qcSchedule);
		}
		return $mainArr;
	}
	
	
	function _group_by($array, $key) {
		$return = array();
		foreach($array as $val) {
			$return[$val->getPO()][] = $val;
		}
		return $return;
	}
	function group_by($array, $key) {
		$return = array();
		foreach($array as $val) {
			$return[$val[$key]][] = $val;
		}
		return $return;
	}
	
	public function validateAndSaveFile($sheetData,$isUpdate,$updateItemNos){
		$this->fieldNames = $sheetData[0];
		$itemNoAlreadyExists = 0;
		$success = 1;
		$messages = "";
		$this->validateFields();
		$mainJson["success"] = 1;
		$mainJson["messages"] = "";
		$exstingsItemNos = array();
		$qcScheudleArr = array();
		$sessionUtil = SessionUtil::getInstance();
		$userSeq = $sessionUtil->getUserLoggedInSeq();
		//$poItemArr = array();
		foreach ($sheetData as $key=>$data){
		    if($key == 0){
				continue;
			}
			$row = $key + 2;
			if(!array_filter($data)) {
				continue;
			}
			if($isUpdate){
			    if(!isset($updateItemNos[$row])){
			        continue;
			    }
			}
			$imoptedData = array();
			try{
			    $imoptedData = $this->getImportedData($data);
			}catch(Exception $e){
			     $messages .= $e->getMessage() . "<br>"; 
			     $success = 0;
			}
			if(empty($imoptedData)){
			    continue;
			}
			$qcschedule = $imoptedData["data"];
			$itemIdsArr = $imoptedData["items"];
			$itemNoArr = array();
			foreach ($itemIdsArr as $itemId){
			    if(empty($itemId)){
			        continue;
			    }
			   $qc = clone $qcschedule;
				$qc->setItemNumbers($itemId);
				$qc->setUserSeq($userSeq);
				array_push($qcScheudleArr, $qc);
				array_push($itemNoArr,$itemId);
				//Check dulplicate po and item number in file
// 				$po = $qcschedule->getPo();
// 				$items = array();
// 				if(isset($poItemArr[$po])){
// 				    $items = $poItemArr[$po];
// 				    if(in_array($itemId, $items)){
// 				        $success = 0;
// 				        $messages .= "Duplicate PO - '$po' and Itemid '$itemId' in file <br>";
// 				    }else{
// 				        array_push($items,$itemId);
// 				        $poItemArr[$po]= $items;
// 				    }
// 				}else{
// 				    array_push($items,$itemId);
// 				    $poItemArr[$po]= $items;
// 				}
			}
			$rowAndItemNo[$row] = $itemNoArr;
		}
		$response = array();
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		if(empty($messages)){
		    $response = $this->saveArr($qcScheudleArr, $isUpdate,$rowAndItemNo,$updateItemNos);
		}
		return $response;
	}
	
	private function validateFields(){
	   ////if(self::$FIELD_COUNT == count($this->fieldNames)){
        $fieldArr = $this->fieldNames;
        foreach (self::$FIELDS_NAMES as $key=>$field){
            $actualFieldName = self::$ACTUAL_FIELDS_NAMES[$key];
            $fileField = trim($fieldArr[$key]);
            $actualfileField = strtolower(str_replace(array("\n", "\r"), ' ', $fileField));
            $actualfileField = str_replace(' ', '', $actualfileField);
            $colNo = $key + 1;
            if(!in_array($actualfileField, self::$ACTUAL_FIELDS_NAMES)){
                throw new Exception("Unknown filed Name '$fileField' in column no " . $colNo);
            }
            if(strtolower($actualFieldName) !=  $actualfileField){
                throw new Exception("'$field' Field does not exists in column no " . $colNo);
            }
            unset($fieldArr[$key]);
        }
        if(!empty($fieldArr)){
            $messages = "";
            foreach ($fieldArr as $key=>$field){
                $messages .= "Unknown filed Name '$field' in column no " . $key . "<br>";
            }
            throw new Exception($messages);
        }
	}
	
	
	private function in_array_r($needle, $haystack, $strict = false) {
	    foreach ($haystack as $item) {
	        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
	            return true;
	        }
	    }
	    
	    return false;
	}
	public function saveArr($qcScheudleArr,$isUpdate,$rowAndItemNo,$updateItemNos){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$existingItemIds = array();
		$success = 1;
		foreach ($qcScheudleArr as $key=>$qc){
			$itemNo = $qc->getItemNumbers();
			if(strtolower($qc->getStatus()) != "pending"){
			    continue;
			}
			$po =  $qc->getPo();
			$shipDate = $qc->getShipdate();
			$qc->setStatus(null);
			try {
				if(!$isUpdate){
					$this->saveQCSchedule($conn, $qc);
					$savedItemCount++;
				}else{
				    if($this->in_array_r($itemNo, $updateItemNos)){
						$condition["itemnumbers"] = $itemNo;
						$condition["po"] = $po;
						if ($shipDate instanceof DateTime) {
						    $shipDate = $shipDate->format ( 'Y-m-d' );
						}
						$condition["shipdate"] = $shipDate;
						$this->updateOject($conn, $qc, $condition);
					}
				}
			 }
			catch ( Exception $e) {
				$trace = $e->getTrace();
				if($trace[0]["args"][0][1] == "1062"){
					$itemNoAlreadyExists++;
					$rowNo = $this->getRowNumberByItemId($rowAndItemNo,$itemNo,$po);
					if(!array_key_exists($rowNo, $existingItemIds)){
					    $existingItemIds[$rowNo] = array();
					}
					array_push($existingItemIds[$rowNo],$itemNo);
				}else{
					$messages .= $e->getMessage();
				}
				$hasError = true;
				$success = 0;
			}
		}
		$conn->commit();
		if(!$hasError){
			$messages = "Qc Schedules Imported Successfully!";
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		$response["savedItemCount"] = $savedItemCount;
		$response["existingItemIds"] = $existingItemIds;
		return $response;
	}
	
	private function getRowNumberByItemId($array,$itemNo,$po){
	    $rowNumber = 0;
	    foreach($array as $key => $value) {
	        $i = $itemNo.$po;
	        if(in_array($i, $value)) {
	            $rowNumber =  $key;
	        }
	    }
	    return $rowNumber;
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
	    $finalStatus = $data[19];
	 	$userMgr = UserMgr::getInstance();
		$qcUsers = $userMgr->getQCUsersArrForDD();
		$qcUsers = array_flip($qcUsers);
		$classCodeMgr = ClassCodeMgr::getInstance();
		$qc = $data[0];
		$qcUserSeq = $qcUsers[$qc];
		$classCode = $data[1];
		$po = $data[2];
		$poType = $data[3];
		$itemNo = $data[4];
		$itemNoArr = array();
		if(!empty($itemNo)){
			$itemNoArr = explode("\n", $itemNo);
		}
		$shipDateStr = $data[5];
		
		$readyDate = $data[6];
		
		$finalInspectionDate = $data[7];
		$middleInspectionDate = $data[8];
		$firstInspectionDate = $data[9];
		
		$productionStartDate = $data[10];
		$graphicReceiveDate = $data[11];
		$ac_readyDate = $data[12];
		$ac_finalInspectionDate = $data[13];
		
		$ac_middleInspectionDate = $data[14];
		$ac_firstInpectionDate = $data[15];
		
		$ac_productionStartDate = $data[16];
		$ac_graphicDateReceive = $data[17];
		$note = $data[18];
		
		$this->dataTypeErrors = "";	
		
		$qcSchedule = new QCSchedule();
		
		if(!empty($qc)){
			$qcSchedule->setQC($qc);
			$qcSchedule->setQCUser($qcUserSeq);
		}
		
		if(!empty($classCode)){
			$classCodeObj = $classCodeMgr->findByClassCode($classCode);
			$classCodeSeq = 0;
			if(!empty($classCodeObj)){
				$classCodeSeq = $classCodeObj->getSeq();
			}else{
			    throw new Exception("'$classCode' class code not found in database!");
			}
			$qcSchedule->setClassCodeSeq($classCodeSeq);
		}
		
		if(!empty($po)){
			$qcSchedule->setPO($po);
		}
		if(!empty($poType)){
			$qcSchedule->setPOType($poType);
		}
		if(!empty($itemNo)){
			$qcSchedule->setItemNumbers($itemNo);
		}
		$format = "m-d-y";
		$na = "N/A";
	if(!empty($shipDateStr)){
			$shipDate = $this->convertStrToDate($shipDateStr);
			$qcSchedule->setShipDate($shipDate);
			
			$readyDate = $this->convertStrToDate($shipDateStr);
			$readyDate->modify('-14 day');
			$qcSchedule->setSCReadyDate($readyDate);
			//$qcSchedule->setAPReadyDate($readyDate);
			
			$finalInspectionDate = $this->convertStrToDate($shipDateStr);
			$finalInspectionDate->modify('-10 day');
			$qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
			//$qcSchedule->setAPFinalInspectionDate($finalInspectionDate);
			
			$middleInspectionDate = $this->convertStrToDate($shipDateStr);
			$middleInspectionDate->modify('-15 day');
			$qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
			//$qcSchedule->setAPMiddleInspectionDate($middleInspectionDate);
			
			$firstInspectionDate = $this->convertStrToDate($shipDateStr);
			$firstInspectionDate->modify('-35 day');
			$qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
			//$qcSchedule->setAPFirstInspectionDate($firstInspectionDate);
			
			$productionStartDate = $this->convertStrToDate($shipDateStr);
			$productionStartDate->modify('-45 day');
			$qcSchedule->setSCProductionStartDate($productionStartDate);
			//$qcSchedule->setAPProductionStartDate($productionStartDate);
				
			$graphicReceiveDate = $this->convertStrToDate($shipDateStr);
			$graphicReceiveDate->modify('-30 day');
			$qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
			//$qcSchedule->setAPGraphicsReceiveDate($graphicReceiveDate);
		}
// 		if(!empty($readyDate)){
// 			$readyDate = $this->validateDate($readyDate);
// 			$qcSchedule->setSCReadyDate($readyDate);
// 		}
// 		if(!empty($finalInspectionDate)){
// 			$finalInspectionDate = $this->validateDate($finalInspectionDate);
// 			$qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
// 		}
// 		if(!empty($middleInspectionDate)){
// 			$middleInspectionDate = $this->validateDate($middleInspectionDate);
// 			$qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
// 		}
// 		if(!empty($firstInspectionDate)){
// 			$firstInspectionDate = $this->validateDate($firstInspectionDate);
// 			$qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
// 		}
// 		if(!empty($productionStartDate)){
// 			$productionStartDate = $this->validateDate($productionStartDate);
// 			$qcSchedule->setSCProductionStartDate($productionStartDate);
// 		}
// 		if(!empty($graphicReceiveDate)){
// 			$graphicReceiveDate = $this->validateDate($graphicReceiveDate);
// 			$qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
// 		}
// 		if(!empty($ac_readyDate)){
// 			$ac_readyDate = $this->validateDate($ac_readyDate);
// 			$qcSchedule->setACReadyDate($ac_readyDate);
// 		}
// 		if(!empty($ac_finalInspectionDate)){
// 			$ac_finalInspectionDate = $this->validateDate($ac_finalInspectionDate);
// 			$qcSchedule->setACFinalInspectionDate($ac_finalInspectionDate);
// 		}
// 		if(!empty($ac_middleInspectionDate)){
// 			$ac_middleInspectionDate = $this->validateDate($ac_middleInspectionDate);
// 			$qcSchedule->setACMiddleInspectionDate($ac_middleInspectionDate);
// 		}
// 		if(!empty($ac_firstInpectionDate)){
// 			$ac_firstInpectionDate =  $this->validateDate($ac_firstInpectionDate);
// 			$qcSchedule->setACFirstInspectionDate($ac_firstInpectionDate);
// 		}
// 		if(!empty($ac_productionStartDate)){
// 			$ac_productionStartDate = $this->validateDate($ac_productionStartDate);
// 			$qcSchedule->setACProductionStartDate($ac_productionStartDate);
// 		}
// 		if(!empty($ac_graphicDateReceive)){
// 			$ac_graphicDateReceive = $this->validateDate($ac_graphicDateReceive);
// 			$qcSchedule->setACGraphicsReceiveDate($ac_graphicDateReceive);
// 		}
		if(!empty($note)){
			$qcSchedule->setNotes($note);
		}
		if(!empty($finalStatus)){
		    $qcSchedule->setStatus($finalStatus);
		}
		$qcSchedule->setCreatedOn(DateUtil::getCurrentDate());
		$qcSchedule->setLastModifiedOn(DateUtil::getCurrentDate());
		$importedData["items"] = $itemNoArr;
		$importedData["data"] = $qcSchedule;
		return $importedData;
	}
	
	public function getQCScheudlesForGrid(){
//  		$query = "select qcschedulesapproval.responsecomments ,qcschedulesapproval.seq as qcapprovalseq,responsetype, qccode , qcschedules.* from qcschedules left join users on qcschedules.qcuser = users.seq
//  left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq ";
		$query = "select  classcode,qcschedulesapproval.responsecomments ,qcschedulesapproval.seq as qcapprovalseq,responsetype, qccode , qcschedules.* from qcschedules 
left join users on qcschedules.qcuser = users.seq
left join classcodes on qcschedules.classcodeseq = classcodes.seq
left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)";
		$sessionUtil = SessionUtil::getInstance();
		$isSessionSV = $sessionUtil->isSessionSupervisor();
		$qcLoggedInSeq = $sessionUtil->getUserLoggedInSeq();
		$myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
		$isGeneralUser = $sessionUtil->isSessionGeneralUser();
        if($isGeneralUser && !($isSessionSV)){
            if(count($myTeamMembersArr) == 0){
                $query .= " where qcschedules.qcuser = $qcLoggedInSeq ";
            }else{
                $myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
                $query .= " where qcschedules.qcuser in($myTeamMembersCommaSeparated)";
            }
        }	
		$qcSchedules = self::$dataStore->executeQuery($query,true,true,true);
		$arr = array();
		foreach ($qcSchedules as $qcSchedule){
			$approval = $qcSchedule["responsetype"];
			if(!empty($approval)){
				$approval = QCScheduleApprovalType::getValue($approval);
			}
			$qcSchedule["responsetype"] = $approval;
			$qcSchedule["isSv"] = $isSessionSV;
			array_push($arr,$qcSchedule);
		}
		$mainArr["Rows"] = $arr;
		$mainArr["TotalRows"] = $this->getAllCount(true,$isGeneralUser,$qcLoggedInSeq,$isSessionSV);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter,$isGeneralUser,$qcLoggedInSeq,$isSessionSV){
// 		$query = "select count(*) from qcschedules left join users on qcschedules.qcuser = users.seq
// left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq ";
		$query = "select count(*) from qcschedules left join users on qcschedules.qcuser = users.seq left join classcodes on qcschedules.classcodeseq = classcodes.seq
left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq) ";
		$sessionUtil = SessionUtil::getInstance();
		$myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
		if($isGeneralUser && !($isSessionSV)){
			if(count($myTeamMembersArr) == 0){
				$query .= " where qcschedules.qcuser = $qcLoggedInSeq ";
			}else{
				$myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
				$query .= " where qcschedules.qcuser in($myTeamMembersCommaSeparated)";
			}
		}
		$count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter,true);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$itemArr = self::$dataStore->findAllArr($isApplyFilter);
		return $itemArr;
	}
	private $commonQcObj;
	public function findBySeqs($seqs){
		$query = "select * from qcschedules where seq in ($seqs)";
		$qcSchedules = self::$dataStore->executeQuery($query,false,true);
		$fieldStateArr = array();
		foreach ($qcSchedules as $key=>$qcSchedule){
			$schedules = $qcSchedules;
			unset($schedules[$key]);
			$fieldStateArr = $this->campare($qcSchedule, $schedules, $fieldStateArr);
			$commonQcObj = $qcSchedule;
		}
		$mainArr["fieldState"]  = $fieldStateArr;
		$commonQc = new QCSchedule();
		$commonQc->setNAForLockedField($fieldStateArr,$commonQcObj);
		$commonQc->setQCUser($qcSchedule["qcuser"]);
		$commonQc->setPO($qcSchedule["po"]);
		$commonQc->setClassCodeSeq($qcSchedule["classcodeseq"]);
		$mainArr["qcschedule"] = $commonQc;
		return $mainArr;
	}
	
	private function campare($qcSchedule,$allSchedules,$fieldStateArr,$qcArr){
		foreach ($allSchedules as $schedule){
			$properties = array_keys($schedule);
			foreach ($properties as $property){
				//if($this->startsWith($property, "ac") || $this->startsWith($property, "ap")){
					$val1 = $schedule[$property];
					$val2 = $qcSchedule[$property];
					if((empty($val1) && empty($val2)) || ($val1 == $val2)){
						if(!isset($fieldStateArr[$property])){
							$fieldStateArr[$property] = "";
						}
					}else{
						$fieldStateArr[$property] = "disabled";
					}
				//}
			}
		}
		return $fieldStateArr;
	}
	
	public function getBySeq($seq){
		$qcSchedule = self::$dataStore->findBySeq($seq);
		return $qcSchedule;
	}
	public function findBySeq($seq){
		$qcSchedule = self::$dataStore->findBySeq($seq);
		$shipDate = $this->getDateStr($qcSchedule->getShipDate());
		$qcSchedule->setShipDate($shipDate);
		
		$latestShipDate = $this->getDateStr($qcSchedule->getLatestShipDate());
		$qcSchedule->setLatestShipDate($latestShipDate);
		
		
		$scReadyDate = $this->getDateStr($qcSchedule->getSCReadyDate());
		$qcSchedule->setSCReadyDate($scReadyDate);
		
		$scfinalInsDate = $this->getDateStr($qcSchedule->getSCFinalInspectionDate());
		$qcSchedule->setSCFinalInspectionDate($scfinalInsDate);
		
		$scMiddleInsDate = $this->getDateStr($qcSchedule->getSCMiddleInspectionDate());
		$qcSchedule->setSCMiddleInspectionDate($scMiddleInsDate);
		
		$scFirstInsDate = $this->getDateStr($qcSchedule->getSCFirstInspectionDate());
		$qcSchedule->setSCFirstInspectionDate($scFirstInsDate);
		
		$scProductionStartDate = $this->getDateStr($qcSchedule->getSCProductionStartDate());
		$qcSchedule->setSCProductionStartDate($scProductionStartDate);
		
		$scGraphicReceiveDate = $this->getDateStr($qcSchedule->getSCGraphicsReceiveDate());
		$qcSchedule->setSCGraphicsReceiveDate($scGraphicReceiveDate);
		
		
		$apReadyDate = $this->getDateStr($qcSchedule->getAPReadyDate());
		$qcSchedule->setAPReadyDate($apReadyDate);
		
		$apFinalInspectionDate = $this->getDateStr($qcSchedule->getAPFinalInspectionDate());
		$qcSchedule->setAPFinalInspectionDate($apFinalInspectionDate);
		
		$apMiddleInspectionDate = $this->getDateStr($qcSchedule->getAPMiddleInspectionDate());
		$qcSchedule->setAPMiddleInspectionDate($apMiddleInspectionDate);
		
		$apFirstInspectionDate = $this->getDateStr($qcSchedule->getAPFirstInspectionDate());
		$qcSchedule->setAPFirstInspectionDate($apFirstInspectionDate);
		
		$apProductionStartDate = $this->getDateStr($qcSchedule->getAPProductionStartDate());
		$qcSchedule->setAPProductionStartDate($apProductionStartDate);
		
		$apGraphicsReceiveDate = $this->getDateStr($qcSchedule->getAPGraphicsReceiveDate());
		$qcSchedule->setAPGraphicsReceiveDate($apGraphicsReceiveDate);
		
		
		$acReadyDate = $this->getDateStr($qcSchedule->getACReadyDate());
		$qcSchedule->setACReadyDate($acReadyDate);
		
		$acFinalInspectionDate = $this->getDateStr($qcSchedule->getACFinalInspectionDate());
		$qcSchedule->setACFinalInspectionDate($acFinalInspectionDate);
		
		$acMiddleInspectionDate = $this->getDateStr($qcSchedule->getACMiddleInspectionDate());
		$qcSchedule->setACMiddleInspectionDate($acMiddleInspectionDate);
		
		$acFirstInspectionDate = $this->getDateStr($qcSchedule->getACFirstInspectionDate());
		$qcSchedule->setACFirstInspectionDate($acFirstInspectionDate);
		
		$acProductionStartDate = $this->getDateStr($qcSchedule->getACProductionStartDate());
		$qcSchedule->setACProductionStartDate($acProductionStartDate);
		
		$acGraphicsReceiveDate = $this->getDateStr($qcSchedule->getACGraphicsReceiveDate());
		$qcSchedule->setACGraphicsReceiveDate($acGraphicsReceiveDate);
		return $qcSchedule;
	}
	
	public function deleteByIds($ids){
		return self::$dataStore->deleteInList($ids);
	}
	
	public function deleteByIdsAndPo($ids,$po){
		$po = explode(",",$po);
		$po = "'".implode("', '", $po) . "'";
		$query = "delete from qcschedules where po in ($po)";
		return self::$dataStore->executeQuery($query);
	}
	
	public function getPendindSchedules($notificationType){
		$qcSchedules = array();
		if($notificationType == NotificationType::SC_READY_DATE){
			$qcSchedules = $this->getPendingShechededForReadyDate();
		}else if($notificationType == NotificationType::SC_FINAL_INPECTION_DATE){
			$qcSchedules = $this->getPendingShechededForFinalInspectionDate();
		}else if($notificationType == NotificationType::SC_FIRST_INSPECTION_DATE){
			$qcSchedules = $this->getPendingShechededForFirstInspectionDate();
		}else if($notificationType == NotificationType::SC_MIDDLE_INSPECTION_DATE){
			$qcSchedules = $this->getPendingShechededForMiddleInspectionDate();
		}else if($notificationType == NotificationType::SC_PRODUCTION_START_DATE){
			$qcSchedules = $this->getPendingShechededForProductionStartDate();
		}else if($notificationType == NotificationType::SC_GRAPHIC_RECEIVE_DATE){
			$qcSchedules = $this->getPendingShechededForGraphicReceiveDate();
		}
		$poSchedules = $this->groupByPO($qcSchedules);
		return $poSchedules;
	}
	
	
	//------------Pending Appointments-----------
	public function getPendingAppoitmentForReadyDate(){
		$query = "select * from qcschedules where apreadydate > CURDATE() and apreadydate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acreadydate is NULL order by QC ASC, classcode ASC, apreadydate ASC";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForFinalInspectionDate($QCUser = null){
		$query = $this->find_qc_sql . "where apfinalinspectiondate >= CURDATE() and apfinalinspectiondate < DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acfinalinspectiondate is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForMiddleInspectionDate($QCUser = null){
		$query = $this->find_qc_sql ."where apmiddleinspectiondate >= CURDATE() and apmiddleinspectiondate < DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForFirstInspectionDate($QCUser = null){
		$query = $this->find_qc_sql . "where apfirstinspectiondate >= CURDATE() and apfirstinspectiondate < DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apfirstinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForProductionStartDate($QCCode = null){
		$query = "select * from qcschedules where approductionstartdate > CURDATE() and approductionstartdate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acproductionstartdate is NULL order by QC ASC, classcode ASC,approductionstartdate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where approductionstartdate > CURDATE() and approductionstartdate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acproductionstartdate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,approductionstartdate asc";
		}
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForGraphicReceiveDate($QCCode = null){
		$query = "select * from qcschedules where apgraphicsreceivedate > CURDATE() and apgraphicsreceivedate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acgraphicsreceivedate is NULL order by QC ASC, classcode ASC,apgraphicsreceivedate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where apgraphicsreceivedate > CURDATE() and apgraphicsreceivedate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acgraphicsreceivedate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,apgraphicsreceivedate asc";
		}
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	//--------------**********-------------
	
	
	//------------Missing Appointments-----------
	public function getMissingAppoitmentForReadyDate(){
		$query = "select * from qcschedules where apreadydate is NULL and acreadydate is NULL order by QC ASC, classcode ASC, apreadydate ASC";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingAppoitmentForFinalInspectionDate($QCUser= null){
		$query = $this->find_qc_sql . "where scfinalinspectiondate <= DATE_ADD(CURDATE(), INTERVAL 10 DAY) and  apfinalinspectiondate is NULL and acfinalinspectiondate is NULL";
		if(!empty($QCUser)){
			$query .=  " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingAppoitmentForMiddleInspectionDate($QCUser = null){
		$query = $this->find_qc_sql . "where scmiddleinspectiondate <= DATE_ADD(CURDATE(), INTERVAL 10 DAY) and apmiddleinspectiondate is NULL and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingAppoitmentForFirstInspectionDate($QCUser = null){
		$query = $this->find_qc_sql . "where scfirstinspectiondate <= DATE_ADD(CURDATE(), INTERVAL 10 DAY) and apfirstinspectiondate is NULL and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scfirstinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingAppoitmentForProductionStartDate($QCCode = null){
		$query = "select * from qcschedules where approductionstartdate is NULL and acproductionstartdate is NULL order by QC ASC, classcode ASC,scproductionstartdate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where approductionstartdate is NULL and acproductionstartdate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,scproductionstartdate asc";
		}
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingAppoitmentForGraphicReceiveDate($QCCode = null){
		$query = "select * from qcschedules where apgraphicsreceivedate is NULL and acgraphicsreceivedate is NULL order by QC ASC, classcode ASC,scgraphicsreceivedate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where apgraphicsreceivedate is NULL and acgraphicsreceivedate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,scgraphicsreceivedate asc";
		}
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	//--------------**********-------------
	
	
	//------------Missing Actual Dates-----------
	public function getMissingActualReadyDate(){
		$query = "select * from qcschedules where apreadydate is not NULL and acreadydate is NULL order by QC ASC, classcode ASC, apreadydate ASC";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingActualFinalInspectionDate($QCUser = null){
		$query = $this->find_qc_sql . "where scfinalinspectiondate <= CURDATE() and acfinalinspectiondate is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingActualMiddleInspectionDate($QCUser = null){
		$query = $this->find_qc_sql . "where acfinalinspectiondate is NULL and scmiddleinspectiondate <= CURDATE() and  acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingActualFirstInspectionDate($QCUser = null){
		$query = $this->find_qc_sql . "where acfinalinspectiondate is NULL and scfirstinspectiondate  <= CURDATE() and apfirstinspectiondatenareason is NULL and acfirstinspectiondate is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apfirstinspectiondate asc"; 
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingActualProductionStartDate($QCCode = null){
		$query = "select * from qcschedules where acproductionstartdate is NULL order by QC ASC, classcode ASC,approductionstartdate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where acproductionstartdate is NULL and qc = '$QCCode'  order by QC ASC, classcode ASC,approductionstartdate asc";
		}
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingActualGraphicReceiveDate($QCCode = null){
		$query = "select * from qcschedules where acgraphicsreceivedate is NULL order by QC ASC, classcode ASC,apgraphicsreceivedate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where acgraphicsreceivedate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,apgraphicsreceivedate asc";
		}
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	//--------------**********-------------
	
	private $find_qc_sql = "select qccode,classcodes.classcode,qcschedules.* from qcschedules left join classcodes on qcschedules.classcodeseq = classcodes.seq left join users on qcschedules.qcuser = users.seq ";
	//------------Pending Schedules-----------
	public function getPendingShechededForReadyDate(){//currently not in use
		$query = $this->find_qc_sql . "where screadydate > CURDATE() and screadydate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acreadydate is NULL order by QC ASC, classcodes.classcode ASC, screadydate ASC";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForFinalInspectionDate($qcUser = null){
		$query = $this->find_qc_sql . "where scfinalinspectiondate >= CURDATE() and scfinalinspectiondate < DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acfinalinspectiondate is NULL";
		if(!empty($qcUser)){
			$query .= " and qcuser = $qcUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForMiddleInspectionDate($qcUser = null){
		$query = $this->find_qc_sql . "where scmiddleinspectiondate >= CURDATE() and scmiddleinspectiondate < DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL";
		if(!empty($qcUser)){
			$query .= " and qcuser = $qcUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForFirstInspectionDate($qcUser = null){
		$query = $this->find_qc_sql . "where scfirstinspectiondate >= CURDATE() and scfirstinspectiondate < DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL";
		if(!empty($qcUser)){
			$query .= " and qcuser = $qcUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scfirstinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForProductionStartDate(){
		$query = $this->find_qc_sql."where scproductionstartdate > CURDATE() and scproductionstartdate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acproductionstartdate is NULL order by QC ASC, classcodes.classcode ASC,scproductionstartdate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForGraphicReceiveDate(){
		$query = $this->find_qc_sql . "where scgraphicsreceivedate > CURDATE() and scgraphicsreceivedate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY) and acgraphicsreceivedate is NULL order by QC ASC, classcodes.classcode ASC,scgraphicsreceivedate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	//--------------**********-------------
	
	
	public function getPendingQcForApprovals(){
		//$query = "select classcodes.classcode, qcschedulesapproval.responsetype,qcschedulesapproval.appliedon,qcschedules.* from qcschedules inner join qcschedulesapproval on qcschedules.seq  = qcschedulesapproval.qcscheduleseq left join classcodes on qcschedules.classcodeseq = classcodes.seq where qcschedulesapproval.responsetype = 'Pending' order by appliedon";
		$query = "select qccode,classcodes.classcode, qcschedulesapproval.responsetype,qcschedulesapproval.appliedon,qcschedules.* from qcschedules inner join qcschedulesapproval on qcschedules.seq  = qcschedulesapproval.qcscheduleseq left join classcodes on qcschedules.classcodeseq = classcodes.seq left join users on qcschedules.qcuser = users.seq where qcschedulesapproval.responsetype = 'Pending' order by appliedon";
		$qcschedules = self::$dataStore->executeObjectQuery($query,false,true);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	
	
	private function convertStrToDate($date){
		$format = 'm-d-y';
		$date = DateUtil::StringToDateByGivenFormat($format, $date);
		if(!$date){
			$date = DateUtil::getCurrentDate();
		}
		return $date;
	}
	function startsWith ($string, $startString)
	{
		$len = strlen($startString);
		return (substr($string, 0, $len) === $startString);
	}
	private function getDateStr($date){
		$format = 'Y-m-d';
		if(!empty($date)){
			$date = DateUtil::StringToDateByGivenFormat($format, $date);
			$date = $date->format("m-d-Y");
		}
		return $date;
	}
	
	private function getQcPendingAcFirstInpection(){
	    $query = "select COALESCE(qcschedules.apfirstinspectiondate, qcschedules.scfirstinspectiondate) as plandate,qcschedules.scfirstinspectiondate as scdate, qcschedules.potype, qcschedules.apfirstinspectiondate as apdate, qcschedules.classcodeseq, users.qccode from qcschedules inner join users on qcschedules.qcuser = users.seq
where acfinalinspectiondate is NULL and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL group by plandate,classcodeseq
ORDER BY plandate  Desc";
	    $qcSchedulesFirstInspections =  self::$dataStore->executeQuery($query,false,true);
	    return $qcSchedulesFirstInspections;
	}
	
	private function getQcPendingAcMiddleInpection(){
	    $query = "select COALESCE(qcschedules.apmiddleinspectiondate, qcschedules.scmiddleinspectiondate) as plandate,qcschedules.scmiddleinspectiondate scdate , qcschedules.potype, qcschedules.apmiddleinspectiondate as apdate, qcschedules.classcodeseq, users.qccode from qcschedules inner join users on qcschedules.qcuser = users.seq
where acfinalinspectiondate is NULL and qcschedules.acmiddleinspectiondate is NULL and qcschedules.apmiddleinspectiondatenareason is NULL group by plandate,classcodeseq  ORDER BY plandate  DESC";
	    $qcSchedulesMiddleInspections =  self::$dataStore->executeQuery($query,false,true);
	    return $qcSchedulesMiddleInspections;
	}
	
	
	private function getQcPendingAcFinalInpection(){
	    $query = "select COALESCE(qcschedules.apfinalinspectiondate, qcschedules.scfinalinspectiondate) as plandate,qcschedules.scfinalinspectiondate scdate, qcschedules.potype, qcschedules.apfinalinspectiondate as apdate, qcschedules.classcodeseq, users.qccode from qcschedules inner join users on qcschedules.qcuser = users.seq
where qcschedules.acfinalinspectiondate is NULL group by plandate,classcodeseq  ORDER BY plandate  DESC";
	    $qcSchedulesFinalInspections =  self::$dataStore->executeQuery($query,false,true);
	    return $qcSchedulesFinalInspections;
	}
	private $commonDates = array();
	public function exportQCPlannerReport($isSendEmail = false){
	    $qcSchedulesFirstInspections =  $this->getQcPendingAcFirstInpection();
	    $qcSchedulesMiddleInspections =  $this->getQcPendingAcMiddleInpection();
	    $qcSchedulesFinalInspections =  $this->getQcPendingAcFinalInpection();
	    $qcSchedulesForPlanReport = array_merge($qcSchedulesFirstInspections,$qcSchedulesMiddleInspections,$qcSchedulesFinalInspections);
	    $qcSchedulesForPlanReport = $this->group_by($qcSchedulesForPlanReport, "qccode");
	    $dataArr = array();
	    foreach ($qcSchedulesForPlanReport as $key=>$qcScheduleArr){
	        $arr = $this->group_by_qc_plan($qcScheduleArr, "plandate");
	        $dataArr[$key] = $arr;
	    }
	    sort($this->commonDates,1);
	    $mainDataArr = array();
	    $mainDataArr["data"] = $dataArr;
	    $mainDataArr["dates"] = $this->commonDates;
	    QCNotificationsUtil::sendQCPlannerNotification($mainDataArr, $isSendEmail);
	    return $dataArr;
	}
	
	function date_sort($a, $b) {
	    return strtotime($a) - strtotime($b);
	}
	
	
	function group_by_qc_plan($array, $key) {
	    $return = array();
	    foreach($array as $val){
	        $count = 1;
	        $timeStamp = strtotime($val[$key]);
	        if(array_key_exists($timeStamp, $return)){
	            $count += $return[$timeStamp];
	        }
	        $return[$timeStamp] = $count;
	        if(!in_array($timeStamp,$this->commonDates)){
	            array_push($this->commonDates,$timeStamp);
	        }
	    }
	    return $return;
	}
	
}