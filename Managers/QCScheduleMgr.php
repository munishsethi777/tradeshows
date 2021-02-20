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
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PHPExcelUtils.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BeanReturnDataType.php");

class QCScheduleMgr{
	private static  $qcScheduleMgr;
	private static $dataStore;
	private $dataTypeErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 19;
	private static $ACTUAL_FIELDS_NAMES = array("qc","classcode","po#","potype","itemno","shipdate","readydate","finalinspectiondate","middleinspectiondate","firstinspectiondate","productionstartdate","graphicsreceivedate","readydate","finalinspectiondate","middleinspectiondate","firstinspectiondate","productionstartdate","graphicsreceivedate","notes","finalstatus");
	private static $FIELDS_NAMES = array("Qc","Class Code","PO#","PO Type","Item No","Ship Date","Ready Date","Final Inspection Date","Middle Inspection Date","First Inspection Date","Production Start Date","Graphics Receive Date","Ready Date","Final Inspection Date","Middle Inspection Date","First Inspection Date","Production Start Date","Graphics Receive Date","Notes","Final Status");
	private static $currentDate;
	private static $currentDateWith14daysInterval;
	private static $currentDateWith10daysInterval;
	private static $gridSelectSql = "select poinchargeusers.qccode poqccode,classcode,qcschedulesapproval.responsecomments , qcschedulesapproval.seq qcapprovalseq,responsetype, users.qccode , qcschedules.poinchargeuser ,qcschedules.* from qcschedules 
					left join users on qcschedules.qcuser = users.seq 
					left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq 
					left join classcodes on qcschedules.classcodeseq = classcodes.seq 
					left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq 
					and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) 
					from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)";
	private static $filterExportSelectSql = "select poinchargeusers.qccode poqccode , qcschedules.seq as scheduleseq,classcode,users.qccode ,responsetype, qcschedules.poinchargeuser,qcschedules.* from qcschedules 
					left join users on qcschedules.qcuser = users.seq 
					left join classcodes on qcschedules.classcodeseq = classcodes.seq 
					left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq
					left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)";
	private static $countSql = "select count(seq) from qcschedules";
	private static $finalMissingAppointmentWhereClause = " where scfinalinspectiondate >= '2021-01-16' and scfinalinspectiondate < '2021-01-30' and apfinalinspectiondate is NULL and acfinalinspectiondate is NULL and iscompleted = 0";
	public static function getInstance()
	{
		if (!self::$qcScheduleMgr)
		{
			self::$qcScheduleMgr = new QCScheduleMgr();
			self::$dataStore = new BeanDataStore(QCSchedule::$className, QCSchedule::$tableName);
			self::$currentDate = DateUtil::getDateInDBFormat();
			self::$currentDateWith14daysInterval = DateUtil::getDateInDBFormat(14);
			self::$currentDateWith10daysInterval = DateUtil::getDateInDBFormat(10);
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
	
    public function importQCSchedulesWithActualDates($file,$isUpdate,$updatingRowNumbers,$isCompeted){
        $qcScheduleImportUtil = QCScheduleImportUtil::getInstance();
        return $qcScheduleImportUtil->importQCSchedules($file,$isUpdate,$updatingRowNumbers,$isCompeted);
	}
	public function newUpdateQCSchedulesWithActualDates($file){
		$qcScheduleImportUtil = QCScheduleImportUtil::getInstance();
        return $qcScheduleImportUtil->newUpdateQCSchedules($file);
	}
	/**
	 * Method to send variables to QCScheduleImportUtil
	 * @param FILE $file the file contents need to update the database
	 * 
	 */
	public function updateQCSchedulesWithActualDates(
						$file,
						$isUpdateShipDateAndScheduleDates,
						$isUpdateLatestShipDate,
						$isCompletionStatus,
						$isUpdatePONumber = false,
						$isUpdatePoTypes = false,
						$isUpdateClassCode = false,
						$isUpdateQC = false,
						$isUpdateFirstInspectionDate = false,
						$isUpdatePoInchargeUser = false
					){
		/**  @var QCScheduleImportUtil */ 
		$qcScheduleImportUtil = QCScheduleImportUtil::getInstance();
		return $qcScheduleImportUtil->updateQCSchedules(
								$file,
								$isUpdateShipDateAndScheduleDates,
								$isUpdateLatestShipDate,
								$isCompletionStatus,
								$isUpdatePONumber,
								$isUpdatePoTypes,
								$isUpdateClassCode,
								$isUpdateQC,
								$isUpdateFirstInspectionDate,
								$isUpdatePoInchargeUser
							);
	}

    public function bulkDeleteByImport($filePath){
        $qcScheduleImportUtil = QCScheduleImportUtil::getInstance();
        return $qcScheduleImportUtil->deleteByImport($filePath);
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
	private function setValueIfExists($arr,$arrIndex,$value){
		if($value != null){
			$arr[$arrIndex] = $value;
		}
		return $arr;
	}
	public function bulkUpdateQCSchedules($qcschedule,$qcschedulesArr){
		$qcSchedule = new QCSchedule($qcschedule);
		$scheduleArrNewValues = array();
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"qc",$_REQUEST["qccode"]);
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"qcuser",$qcSchedule->getQCUser());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"poinchargeuser",$qcSchedule->getPOInchargeUser());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"classcodeseq",$qcSchedule->getClassCodeSeq());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"iscompleted",$qcSchedule->getIsCompleted());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apreadydate",$qcSchedule->getAPReadyDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apfinalinspectiondate",$qcSchedule->getAPFinalInspectionDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apmiddleinspectiondate",$qcSchedule->getAPMiddleInspectionDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apfirstinspectiondate",$qcSchedule->getAPFirstInspectionDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"approductionstartdate",$qcSchedule->getAPProductionStartDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apgraphicsreceivedate",$qcSchedule->getAPGraphicsReceiveDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acreadydate",$qcSchedule->getACReadyDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acfinalinspectiondate",$qcSchedule->getACFinalInspectionDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acmiddleinspectiondate",$qcSchedule->getACMiddleInspectionDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acfirstinspectiondate",$qcSchedule->getACFirstInspectionDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acproductionstartdate",$qcSchedule->getACProductionStartDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acgraphicsreceivedate",$qcSchedule->getACGraphicsReceiveDate());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acfirstinspectionnotes",$qcSchedule->getAcFirstInspectionNotes());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"acmiddleinspectionnotes",$qcSchedule->getAcMiddleInspectionNotes());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apfirstinspectiondatenareason",$qcSchedule->getApFirstInspectionDateNaReason());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apmiddleinspectiondatenareason",$qcSchedule->getApMiddleInspectionDateNaReason());
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"apgraphicsreceivedatenareason",$qcSchedule->getAPGraphicsReceiveDateNAReason());
		if(!empty($qcSchedule->getApFirstInspectionDateNaReason())){
			$scheduleArrNewValues["apfirstinspectiondate"] = null;
		}else{
			$scheduleArrNewValues["apfirstinspectiondatenareason"] = null;
		}
		if(!empty($qcSchedule->getApMiddleInspectionDateNaReason())){
			$scheduleArrNewValues["apmiddleinspectiondate"] = null;
		}else{
			$scheduleArrNewValues["apmiddleinspectiondatenareason"] = null;
		}
		if(!empty($qcSchedule->getAPGraphicsReceiveDateNAReason())){
			$scheduleArrNewValues["apgraphicsreceivedate"] = null;
		}else{
			$scheduleArrNewValues["apgraphicsreceivedatenareason"] = null;
		}
		$scheduleArrNewValues["lastmodifiedon"] = new DateTime();
		$qcSeqsStr = implode(",", $qcschedulesArr);
		$condition = array("seq" => $qcSeqsStr);
		
		//Query to get qcschedules pre updated values to send notification with original and new values
		$query = "select poinchargeusers.qccode poqccode , qcschedules.seq as scheduleseq,classcode,users.qccode , poinchargeuser,qcschedules.* from qcschedules
		left join users on qcschedules.qcuser = users.seq left join classcodes on qcschedules.classcodeseq = classcodes.seq
		left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq
		left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)
		where qcschedules.seq in ($qcSeqsStr)";
		$qcSchedulesOriginals = self::$dataStore->executeQuery($query,false,true);
		
		//Updating the schedules after fetching original values above
		self::$dataStore->updateByAttributesWithBindParams($scheduleArrNewValues,$condition,true);
		
		//Setting these strings after updating the qcschedules above to prevent making bad update sql
		
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"qccode",$_REQUEST["qccode"]);
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"poqccode",$_REQUEST["poqccode"]);
		$scheduleArrNewValues = $this->setValueIfExists($scheduleArrNewValues,"classcode",$_REQUEST["classcode"]);
		
		
		if(isset($_POST["isapproval"])){
			foreach($qcschedulesArr as $qcScheduleSeq){
				$qcSchedule->setSeq($qcScheduleSeq);
				$qcApprovalMgr = QcscheduleApprovalMgr::getInstance();
				$qcApprovalMgr->saveApprovalFromQCSchedule($qcSchedule);
			}
			$scheduleArrNewValues['responsetype'] = "Pending";
		}
		
		QCNotificationsUtil::sendQCBulkUpdateNotification($qcSchedulesOriginals, $scheduleArrNewValues);
	}
	
	public function exportQCSchedules($queryString,$qcscheduleSeqs){
		$output = array();
		parse_str($queryString, $output);
		$_GET = array_merge($_GET,$output);
		$sessionUtil = SessionUtil::getInstance();
		$qcSchedules = array();
		if($_GET['exportOption'] != "template"){
			$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
			$myTeamMembersArr  = $sessionUtil->getMyTeamMembers();
			$isSessionGeneralUser = $sessionUtil->isSessionGeneralUser();
			$query = self::$filterExportSelectSql;
			if($isSessionGeneralUser){
				if(count($myTeamMembersArr) == 0){
					$query .= " where users.seq = $loggedInUserSeq ";
				}else{
					$myTeamMembersCommaSeparated = implode(',', $myTeamMembersArr);
					$query .= " where users.seq in($myTeamMembersCommaSeparated)";
				}
				if(!empty($qcscheduleSeqs)){
				    $query .= " and qcschedules.seq in ($qcscheduleSeqs)";
				}
			}else{
			    if(!empty($qcscheduleSeqs)){
			        $query .= " where qcschedules.seq in ($qcscheduleSeqs)";
			    }
			}
			$qcSchedules = self::$dataStore->executeQuery($query,true,true,true);
		}
		$fileName = "QCSchedules";
		PHPExcelUtil::exportQCSchedules($qcSchedules,false,$fileName);
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
	
	public function markAsCompleted($po,$itemId,$shipDate){
	    if ($shipDate instanceof DateTime) {
	        $shipDate = $shipDate->format ( 'Y-m-d' );
	    }
	    $conditions = array("po"=>$po,"itemnumbers"=>$itemId);
	    $qcSchedules = self::$dataStore->executeConditionQuery($conditions);
	    if(empty($qcSchedules)){
	        return false;
	    }
	    if(count($qcSchedules) > 1){
	        return false;
	    }
	    $qcSchedule = $qcSchedules[0];
	    $colVal = array("iscompleted" => 1);
	    $conditions = array("seq"=>$qcSchedule->getSeq());
	    $flag = self::$dataStore->updateByAttributesWithBindParams($colVal,$conditions);
	    if($flag){
	        $this->saveApproval($qcSchedule);
	    }
	    return $flag;
	}
	
	
	
	public function saveApproval($qcSchedule){
	   $qcScheduleApprovalMgr = QcscheduleApprovalMgr::getInstance();
	  // $isExists = $qcScheduleApprovalMgr->isApprovalExistsForQCSchedule($qcSchedule->getSeq());
	  // if(!$isExists){
	       $qcScheduleApprovalMgr->saveApprovalFromQCSchedule($qcSchedule,QCScheduleApprovalType::approved);
	   //}
	}
	
	public function saveArr($qcScheudleArr,$isUpdate,$rowAndItemNo,$updatingRowNumbers){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$updateItemCount = 0;
		$updatingRowNos = array();
		$success = 1;
		foreach ($qcScheudleArr as $key=>$qc){
			$itemNo = $qc->getItemNumbers();
			$po =  $qc->getPo();
			$shipDate = $qc->getShipdate();
			try {
				if(!$isUpdate){
					$this->saveQCSchedule($conn, $qc);
					$savedItemCount++;
				}else{
					$rowNo = $this->getRowNumberByItemIdAndShipDate($rowAndItemNo,$itemNo,$po,$shipDate->format("m/d/y"));
				    if($this->in_array_r($rowNo, $updatingRowNumbers)){
						$condition["itemnumbers"] = $itemNo;
						$condition["po"] = $po;
						if ($shipDate instanceof DateTime) {
						    $shipDate = $shipDate->format ( 'Y-m-d' );
						}
						$condition["shipdate"] = $shipDate;
						$this->updateOject($conn, $qc, $condition);
						$updateItemCount++;
					}
				}
			 }
			catch ( Exception $e) {
				$trace = $e->getTrace();
				if($trace[0]["args"][0][1] == "1062"){
					$itemNoAlreadyExists++;
					$rowNo = $this->getRowNumberByItemIdAndShipDate($rowAndItemNo,$itemNo,$po,$shipDate->format("m/d/y"));
					$updatingRowNos[$rowNo] = $rowNo;
				}else{
					$messages .= $e->getMessage();
				}
				$_SESSION["qcScheduleRowsToBeUpdate"] = $updatingRowNos;
				$hasError = true;
				$success = 0;
			}
		}
		$conn->commit();
		if(!$hasError){
		    $messages = StringConstants::QC_SCHEDULES_IMPORTED_SUCCESSFULLY; 
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		$response["savedItemCount"] = $savedItemCount;
		if(!$isUpdate){
			$_SESSION['numberOfInsertedNewCases'] = $savedItemCount;
		}
		$response["updatedItemCount"] = $updateItemCount;
		$response["existingItemIds"] = "";
		return $response;
	}
	/**
	 * @param QCSchedule[] $qcScheudleArr
	 * 
	 */
	public function saveOrUpdateArr($qcScheudleArr, $rowAndItemNo, $labels){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$updateItemCount = 0;
		$updatingRowNos = array();
		$success = 1;
		$refqc = new ReflectionClass(new QCSchedule());
		$qc_properties = $refqc->getProperties(ReflectionProperty::IS_PRIVATE);
		$qc_methods = $refqc->getMethods();
		$temp = [];
		$rowNos = 3;
		foreach($qc_methods as $qc_method){
			if(substr($qc_method->getName(),0,3) === "get"){
				$temp[] = $qc_method;
			}
		}
		$qc_methods = $temp;
		foreach ($qcScheudleArr as $key=>$qc){
			//$itemNo = $qc->getItemNumbers();
			//$po =  $qc->getPo();
			//$shipDate = $qc->getShipdate();
			$seq = $qc->getSeq();
			try {
				if(isset($seq)){
					//update case
					$condition = [];
					$columnValuePair = [];
					foreach((array)$qc_properties as $index => $qcschedule){
						if($qcschedule->getName() == "seq"){
							$condition["seq"] = $seq;
						}elseif($qcschedule->getName() == "createdon" || $qcschedule->getName() == "lastmodifiedon"){
							continue;
						}else{
							$val = $qc_methods[$index]->invoke($qc);
							if ($val instanceof DateTime) {
                                $columnValuePair[$qcschedule->getName()] = $val;
							}else{
							    if(!empty(trim($val))){
                                    $columnValuePair[$qcschedule->getName()] = addslashes($val);
                                }
							}
						}
					}
					if(count($columnValuePair)){
    					$count = self::$dataStore->updateByAttributes($columnValuePair, $condition, true);
    					if($count){
    						$updateItemCount = $updateItemCount + 1;
    					}
					}
					$rowNos++;
				}else{
					// insert case
					$count = $this->save($qc);
					if($count){
						$savedItemCount = $savedItemCount + 1;
					}
					$rowNos++;
				}
			 }
			catch ( Exception $e) {
				$hasError = true;
				$success = 0;
				$messages .= "Error in Row No - $rowNos : " . $e->getMessage() . "<br>";
				$rowNos++;
			}
		}
		if(!$hasError){
			$messages = StringConstants::QC_SCHEDULES_IMPORTED_SUCCESSFULLY;
			$conn->commit(); 
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		$response["savedItemCount"] = $savedItemCount;
		$_SESSION['numberOfInsertedNewCases'] = $savedItemCount;
		$response["updatedItemCount"] = $updateItemCount;
		$response["existingItemIds"] = "";
		return $response;
	}
	/**
	 * Method to update QCSchedules According to the parameters
	 * @param QCSchedule[] $qcScheudleArr
	 * @param bool $isUpdateShipDateAndScheduleDates
	 * @param bool $isUpdateLatestShipDate
	 * @param bool $isUpdateLatestShipDate
	 * @param bool $isCompletionStatus
	 * @param bool $isUpdatePONumber
	 * @param bool $isUpdatePOTypes
	 * @param bool $isUpdateQC
	 * @param bool $isUpdateFirstInspectionDate
	 */
	public function updateQCScheduleDates(
						$qcScheudleArr,
						$isUpdateShipDateAndScheduleDates,
						$isUpdateLatestShipDate,
						$isCompletionStatus,
						$isUpdatePONumber            = false,
						$isUpdatePOTypes             = false,
						$isUpdateClassCode           = false,
						$isUpdateQC                  = false,
						$isUpdateFirstInspectionDate = false,
						$isPoInchargeUser            = false
					)
	{
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$updatedItemCount = 0;
		$success = 1;
		foreach ($qcScheudleArr as $key=>$qc){
			$seq = $qc->getSeq();
			try {
				$condition["seq"] = $seq;
				$colValuePair = array();
				if($isUpdateLatestShipDate){
					if(!($qc->getLatestShipDate() == null) or !($qc->getLatestShipdate() == ""))
						$colValuePair['latestshipdate'] = $qc->getLatestShipDate();
				}
				if($isUpdateShipDateAndScheduleDates){
					if(!($qc->getShipDate() == null) or !($qc->getShipdate() == "")){
						$colValuePair['shipdate']               = $qc->getShipDate();
						$colValuePair['screadydate']            = $qc->getScReadyDate();
						$colValuePair['scfinalinspectiondate']  = $qc->getScFinalInspectionDate();
						$colValuePair['scmiddleinspectiondate'] = $qc->getScMiddleInspectionDate();
						$colValuePair['scfirstinspectiondate']  = $qc->getScFirstInspectionDate();
						$colValuePair['scproductionstartdate']  = $qc->getScProductionStartDate();
						$colValuePair['scgraphicsreceivedate']  = $qc->getSCGraphicsReceiveDate();
					}
				}
				//$colValuePair['lastmodifiedon'] = $qc->getLastModifiedOn();
				if($isCompletionStatus){
					$colValuePair['iscompleted']           = $qc->getIsCompleted();
				}
				if($isUpdatePONumber){
					$colValuePair['po']                    = $qc->getPO();
				}
				if($isUpdatePOTypes){
					$colValuePair['potype']                = $qc->getPoType();
				}
				if($isUpdateClassCode){
					$colValuePair['classcodeseq']          = $qc->getClassCodeSeq();
				}
				if($isUpdateQC){
					$colValuePair['qc']                    = $qc->getQC();
					$colValuePair['qcuser']                = $qc->getQCUser();
				}
				if($isUpdateFirstInspectionDate){
					$colValuePair['scfirstinspectiondate'] = $qc->getSCFirstInspectionDate();
				}
				if($isPoInchargeUser){
					$colValuePair['poinchargeuser']        = $qc->getPoInchargeUser();
				}
				$resultCount = self::$dataStore->updateByAttributes($colValuePair, $condition,true);		
				$updatedItemCount+= $resultCount;
				
			 }
			catch ( Exception $e) {
				$messages = $e->getMessage();
				$success = 0;
			}
		}
		if($success == 1){
			$conn->commit();
			$messages = StringConstants::QC_SCHEDULES_IMPORTED_SUCCESSFULLY; 
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["updatedItemCount"] = $updatedItemCount;
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
	public function getRowNumberByItemIdAndShipDate($array,$itemNo,$po,$shipdate){
		$rowNumber = 0;
		foreach($array as $key => $value){
			$i = $itemNo.$po.$shipdate;
			if(in_array($i,$value)){
				$rowNumber = $key;
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
			
			$finalInspectionDate = $this->convertStrToDate($shipDateStr);
			$finalInspectionDate->modify('-10 day');
			$qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
			
			$middleInspectionDate = $this->convertStrToDate($shipDateStr);
			$middleInspectionDate->modify('-15 day');
			$qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
			
			$firstInspectionDate = $this->convertStrToDate($shipDateStr);
			$firstInspectionDate->modify('-35 day');
			$qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
			
			$productionStartDate = $this->convertStrToDate($shipDateStr);
			$productionStartDate->modify('-45 day');
			$qcSchedule->setSCProductionStartDate($productionStartDate);
				
			$graphicReceiveDate = $this->convertStrToDate($shipDateStr);
			$graphicReceiveDate->modify('-30 day');
			$qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
		}
		if(!empty($note)){
			$qcSchedule->setNotes($note);
		}
		if(!empty($finalStatus)){
		    $qcSchedule->setStatus($finalStatus);
		}
		$qcSchedule->setIsCompleted(0);
		$qcSchedule->setCreatedOn(DateUtil::getCurrentDate());
		$qcSchedule->setLastModifiedOn(DateUtil::getCurrentDate());
		$importedData["items"] = $itemNoArr;
		$importedData["data"] = $qcSchedule;
		return $importedData;
	}
	
	public function getQCScheudlesForGrid(){
// 		$query = "select  classcode,qcschedulesapproval.responsecomments , qcschedulesapproval.seq qcapprovalseq,responsetype, qccode , poinchargeuser,qcschedules.* from qcschedules 
// left join users on qcschedules.qcuser = users.seq
// left join classcodes on qcschedules.classcodeseq = classcodes.seq
// left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)";
		
		$query = self::$gridSelectSql;
		
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
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
			$qcSchedule["id"] = $qcSchedule["seq"];
			$qcSchedule["isSv"] = $isSessionSV;
			$qcSchedule["shipdate"] = DateUtil::convertDateToFormat($qcSchedule["shipdate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["latestshipdate"] = DateUtil::convertDateToFormat($qcSchedule["latestshipdate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["screadydate"] = DateUtil::convertDateToFormat($qcSchedule["screadydate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["scfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["scmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["scfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["scproductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["scproductionstartdate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["scgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["scgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["acreadydate"] = DateUtil::convertDateToFormat($qcSchedule["acreadydate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["acfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["acmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["acfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["acproductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["acproductionstartdate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["acgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["acgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["apreadydate"] = DateUtil::convertDateToFormat($qcSchedule["apreadydate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["apfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["apmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["apfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["approductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["approductionstartdate"],"Y-m-d","Y-m-d H:i:s");
			$qcSchedule["apgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["apgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
			$lastModifiedOn = $qcSchedule["lastmodifiedon"];
			$lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
			$qcSchedule["lastmodifiedon"] = $lastModifiedOn;
			$qcSchedule["users.qccode"] = $qcSchedule["qccode"];
			$qcSchedule["poinchargeusers.qccode"] = $qcSchedule["poqccode"];
			array_push($arr,$qcSchedule);
		}
		$mainArr["Rows"] = $arr;
		$mainArr["TotalRows"] = $this->getAllCount(true,$isGeneralUser,$qcLoggedInSeq,$isSessionSV);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter,$isGeneralUser,$qcLoggedInSeq,$isSessionSV){
// 		$query = "select count(*) from qcschedules left join users on qcschedules.qcuser = users.seq
// left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq ";
		$query = "select count(*) from qcschedules left join users on qcschedules.qcuser = users.seq left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq left join classcodes on qcschedules.classcodeseq = classcodes.seq
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
	
	public function findAllBySeqsForBulkEdit($seqs){
		$query = "select pousers.qccode poqccode,users.qccode qccode, classcodes.classcode, qcschedules.seq scheduleseq,responsetype, qcschedules.* from qcschedules
left join users on qcschedules.qcuser = users.seq
left join users pousers on qcschedules.poinchargeuser = pousers.seq
left join classcodes on qcschedules.classcodeseq = classcodes.seq
left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq
in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)
		where qcschedules.seq in ($seqs)";
		
// 		$query ="select  poinchargeusers.qccode poqccode,classcode,qcschedulesapproval.responsecomments , qcschedulesapproval.seq qcapprovalseq,responsetype, users.qccode , poinchargeuser,qcschedules.* from qcschedules
// left join users on qcschedules.qcuser = users.seq
// left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq
// left join classcodes on qcschedules.classcodeseq = classcodes.seq
// left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq
// in (select max(qcschedulesapproval.seq) from qcschedulesapproval GROUP by qcschedulesapproval.qcscheduleseq)";
		
		
		$qcSchedules = self::$dataStore->executeQuery($query,false,true,false);
		return $qcSchedules;
	}
	
	private $commonQcObj;
	public function findCommonQCAndFieldStates($seqs){
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
	
	private function campare($qcSchedule,$allSchedules,$fieldStateArr){
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
			//$qcSchedules = $this->getPendingShechededForMiddleInspectionDate();
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
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = "select * from qcschedules where apreadydate > '$currentDate' and apreadydate <= '$currentDateWithInterval' and acreadydate is NULL order by QC ASC, classcode ASC, apreadydate ASC";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForFinalInspectionDate($QCUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql . "where apfinalinspectiondate >='$currentDate' and apfinalinspectiondate < '$currentDateWithInterval' and acfinalinspectiondate is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForMiddleInspectionDate($QCUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql ."where apmiddleinspectiondate >= '$currentDate' and apmiddleinspectiondate < '$currentDateWithInterval' and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForFirstInspectionDate($QCUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
	    $query = $this->find_qc_sql . "where apfirstinspectiondate >= '$currentDate' and apfirstinspectiondate < '$currentDateWithInterval' and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,apfirstinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForProductionStartDate($QCCode = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = "select * from qcschedules where approductionstartdate > '$currentDate' and approductionstartdate <= '$currentDateWithInterval' and acproductionstartdate is NULL order by QC ASC, classcode ASC,approductionstartdate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where approductionstartdate > '$currentDate' and approductionstartdate <= '$currentDateWithInterval' and acproductionstartdate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,approductionstartdate asc";
		}
		$qcschedules = $this->groupByPO($query);
		return $qcschedules;
	}
	
	public function getPendingAppoitmentForGraphicReceiveDate($QCCode = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = "select * from qcschedules where apgraphicsreceivedate > '$currentDate' and apgraphicsreceivedate <= '$currentDateWithInterval' and acgraphicsreceivedate is NULL order by QC ASC, classcode ASC,apgraphicsreceivedate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where apgraphicsreceivedate > '$currentDate' and apgraphicsreceivedate <= '$currentDateWithInterval' and acgraphicsreceivedate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,apgraphicsreceivedate asc";
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
	    $currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
	    $currentDate = self::$currentDate;
	  	$query = $this->find_qc_sql . "where scfinalinspectiondate >= '$currentDate' and scfinalinspectiondate < '$currentDateWith14daysInterval' and  apfinalinspectiondate is NULL and acfinalinspectiondate is NULL and iscompleted = 0";
		if(!empty($QCUser)){
			$query .=  " and qcuser = $QCUser";
		}
		//$query .= " order by QC ASC, classcodes.classcode ASC,scfinalinspectiondate asc";
		$query .= " order by qccode asc , scfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingAppoitmentForMiddleInspectionDate($QCUser = null){
	    $currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
	    $currentDate = self::$currentDate;
		$query = $this->find_qc_sql . "where scmiddleinspectiondate >= '$currentDate' and scmiddleinspectiondate < '$currentDateWith14daysInterval' and apmiddleinspectiondate is NULL and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL  and iscompleted = 0";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		//$query .= " order by QC ASC, classcodes.classcode ASC,scmiddleinspectiondate asc";
		$query .= " order by qccode asc , scmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingAppoitmentForFirstInspectionDate($QCUser = null){
	    $currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
	    $currentDate = self::$currentDate;
		$query = $this->find_qc_sql . "where scfirstinspectiondate >= '$currentDate' and scfirstinspectiondate < '$currentDateWith14daysInterval' and apfirstinspectiondate is NULL and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL  and iscompleted = 0";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		//$query .= " order by QC ASC, classcodes.classcode ASC,scfirstinspectiondate asc";
		$query .= " order by qccode asc , scfirstinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	//not in use
	public function getMissingAppoitmentForProductionStartDate($QCCode = null){
		$query = "select * from qcschedules where approductionstartdate is NULL and acproductionstartdate is NULL order by QC ASC, classcode ASC,scproductionstartdate asc";
		if(!empty($QCCode)){
			$query = "select * from qcschedules where approductionstartdate is NULL and acproductionstartdate is NULL and qc = '$QCCode' order by QC ASC, classcode ASC,scproductionstartdate asc";
		}
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	//not in use
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
	    $currentDate = self::$currentDate;
	    $query = $this->find_qc_sql . "where scfinalinspectiondate <= '$currentDate' and (apfinalinspectiondate <= '$currentDate' or apfinalinspectiondate is NULL) and acfinalinspectiondate is NULL and iscompleted = 0 ";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by qccode ASC, apfinalinspectiondate ASC,scfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingActualMiddleInspectionDate($QCUser = null){
	    $currentDate = self::$currentDate;
		$query = $this->find_qc_sql . "where acfinalinspectiondate is NULL and scmiddleinspectiondate <= '$currentDate' and (apmiddleinspectiondate <= '$currentDate' or apmiddleinspectiondate is NULL) and  acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL and iscompleted = 0";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by qccode ASC, apmiddleinspectiondate ASC,scmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getMissingActualFirstInspectionDate($QCUser = null){
	    $currentDate = self::$currentDate;
		$query = $this->find_qc_sql . "where acfinalinspectiondate is NULL and scfirstinspectiondate  <= '$currentDate' and (apfirstinspectiondatenareason  <= '$currentDate' or apfirstinspectiondatenareason is NULL) and acfirstinspectiondate is NULL and iscompleted = 0";
		if(!empty($QCUser)){
			$query .= " and qcuser = $QCUser";
		}
		$query .= " order by qccode ASC, apfirstinspectiondatenareason ASC,scfirstinspectiondate asc"; 
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
	//---------------Handling poqccode----------------
	//private $find_qc_sql = "select poinchargeusers.qccode poqccode, users.qccode,classcodes.classcode,qcschedules.* from qcschedules left join classcodes on qcschedules.classcodeseq = classcodes.seq left join users on qcschedules.qcuser = users.seq  left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq ";
	private $find_qc_sql = "select qccode,classcodes.classcode,qcschedules.* from qcschedules left join classcodes on qcschedules.classcodeseq = classcodes.seq left join users on qcschedules.qcuser = users.seq ";
	//------------Pending Schedules-----------
	public function getPendingShechededForReadyDate(){//currently not in use
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql . "where screadydate > '$currentDate' and screadydate <= '$currentDateWithInterval' and acreadydate is NULL order by QC ASC, classcodes.classcode ASC, screadydate ASC";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForFinalInspectionDate($qcUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql . "where scfinalinspectiondate >= '$currentDate' and scfinalinspectiondate < '$currentDateWithInterval' and acfinalinspectiondate is NULL";
		if(!empty($qcUser)){
			$query .= " and qcuser = $qcUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scfinalinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingForMiddleInspectionDate($qcUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql . "where scmiddleinspectiondate >='$currentDate' and scmiddleinspectiondate < '$currentDateWithInterval' and COALESCE(apmiddleinspectiondate, scmiddleinspectiondate) >='$currentDate' and COALESCE(apmiddleinspectiondate, scmiddleinspectiondate) < '$currentDateWithInterval' and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL";
		if(!empty($qcUser)){
			$query .= " and qcuser = $qcUser";
		}
		$query .= " order by qccode ASC, apmiddleinspectiondate ASC,scmiddleinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingForFinalInspectionDate($qcUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
	    $query = $this->find_qc_sql . "where scfinalinspectiondate >= '$currentDate' and scfinalinspectiondate < '$currentDateWithInterval'  and COALESCE(apfinalinspectiondate, scfinalinspectiondate) >= '$currentDate' and COALESCE(apfinalinspectiondate, scfinalinspectiondate) < '$currentDateWithInterval' and acfinalinspectiondate is NULL";
	    if(!empty($qcUser)){
	        $query .= " and qcuser = $qcUser";
	    }
	    $query .= " order by qccode ASC, apfinalinspectiondate ASC,scfinalinspectiondate asc";
	    $qcschedules = self::$dataStore->executeObjectQuery($query);
	    $qcschedules = $this->groupByPO($qcschedules);
	    return $qcschedules;
	}
	
	public function getPendingForFirstInspectionDate($qcUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
	    $query = $this->find_qc_sql . "where scfirstinspectiondate >= '$currentDate' and scfirstinspectiondate < '$currentDateWithInterval' and COALESCE(apfirstinspectiondate, scfirstinspectiondate) >= '$currentDate' and COALESCE(apfirstinspectiondate, scfirstinspectiondate) < '$currentDateWithInterval' and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL";
	    if(!empty($qcUser)){
	        $query .= " and qcuser = $qcUser";
	    }
	    $query .= " order by qccode ASC, apfirstinspectiondate ASC,scfirstinspectiondate asc";
	    $qcschedules = self::$dataStore->executeObjectQuery($query);
	    $qcschedules = $this->groupByPO($qcschedules);
	    return $qcschedules;
	}
	
	
	public function getPendingShechededForFirstInspectionDate($qcUser = null){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql . "where scfirstinspectiondate >= '$currentDate' and scfirstinspectiondate < '$currentDateWithInterval' and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL";
		if(!empty($qcUser)){
			$query .= " and qcuser = $qcUser";
		}
		$query .= " order by QC ASC, classcodes.classcode ASC,scfirstinspectiondate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForProductionStartDate(){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql."where scproductionstartdate > '$currentDate' and scproductionstartdate <= '$currentDateWithInterval' and acproductionstartdate is NULL order by QC ASC, classcodes.classcode ASC,scproductionstartdate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	public function getPendingShechededForGraphicReceiveDate(){
	    $currentDate = self::$currentDate;
	    $currentDateWithInterval = self::$currentDateWith14daysInterval;
		$query = $this->find_qc_sql . "where scgraphicsreceivedate > '$currentDate' and scgraphicsreceivedate <= '$currentDateWithInterval' and acgraphicsreceivedate is NULL order by QC ASC, classcodes.classcode ASC,scgraphicsreceivedate asc";
		$qcschedules = self::$dataStore->executeObjectQuery($query);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	//--------------**********-------------
	
	
	public function getPendingQcForApprovals(){
		//$query = "select classcodes.classcode, qcschedulesapproval.responsetype,qcschedulesapproval.appliedon,qcschedules.* from qcschedules inner join qcschedulesapproval on qcschedules.seq  = qcschedulesapproval.qcscheduleseq left join classcodes on qcschedules.classcodeseq = classcodes.seq where qcschedulesapproval.responsetype = 'Pending' order by appliedon";
		//$query = "select qccode,classcodes.classcode, qcschedulesapproval.responsetype,qcschedulesapproval.appliedon,qcschedules.* from qcschedules inner join qcschedulesapproval on qcschedules.seq  = qcschedulesapproval.qcscheduleseq left join classcodes on qcschedules.classcodeseq = classcodes.seq left join users on qcschedules.qcuser = users.seq where qcschedulesapproval.responsetype = 'Pending' order by appliedon";
// 		$query = "select  poinchargeusers.qccode poqccode, users.qccode,classcodes.classcode, qcschedulesapproval.responsetype,qcschedulesapproval.appliedon,qcschedules.* from qcschedules 
// left join users on qcschedules.qcuser = users.seq
// left join users poinchargeusers on qcschedules.poinchargeuser = poinchargeusers.seq
// left join classcodes on qcschedules.classcodeseq = classcodes.seq
// left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval  GROUP by qcschedulesapproval.qcscheduleseq) where qcschedulesapproval.responsetype = 'Pending' order by appliedon";
		$query = "select  qccode,classcodes.classcode, qcschedulesapproval.responsetype,qcschedulesapproval.appliedon,qcschedules.* from qcschedules 
left join users on qcschedules.qcuser = users.seq
left join classcodes on qcschedules.classcodeseq = classcodes.seq
left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval  GROUP by qcschedulesapproval.qcscheduleseq) where qcschedulesapproval.responsetype = 'Pending' order by appliedon";
		$qcschedules = self::$dataStore->executeObjectQuery($query,false,true);
		$qcschedules = $this->groupByPO($qcschedules);
		return $qcschedules;
	}
	
	
	public function findByApprovalSeq($qcApprovalSeq){
	    $query = "select users.issendnotifications,qcschedules.*,users.email,qcschedulesapproval.responsetype from qcschedules 
inner join users on qcschedules.qcuser = users.seq
inner join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq
where qcschedulesapproval.seq = $qcApprovalSeq";
	    $qcschedule = self::$dataStore->executeQuery($query,false,true);
	    if(!empty($qcschedule)){
	        return $qcschedule[0];
	    }
	    return null;
	}
	
	public function updateLastModifiedOn($seq){
	    $colVal = array("lastmodifiedon"=>new DateTime());
	    $condition = array("seq" => $seq);
	    self::$dataStore->updateByAttributesWithBindParams($colVal,$condition);
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
where acfinalinspectiondate is NULL and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL and (iscompleted != 1 or iscompleted is null) group by plandate,classcodeseq
ORDER BY plandate  Desc";
	    $qcSchedulesFirstInspections =  self::$dataStore->executeQuery($query,false,true);
	    return $qcSchedulesFirstInspections;
	}
	
	private function getQcPendingAcMiddleInpection(){
	    $query = "select COALESCE(qcschedules.apmiddleinspectiondate, qcschedules.scmiddleinspectiondate) as plandate,qcschedules.scmiddleinspectiondate scdate , qcschedules.potype, qcschedules.apmiddleinspectiondate as apdate, qcschedules.classcodeseq, users.qccode from qcschedules inner join users on qcschedules.qcuser = users.seq
where acfinalinspectiondate is NULL and qcschedules.acmiddleinspectiondate is NULL and qcschedules.apmiddleinspectiondatenareason is NULL and (iscompleted != 1 or iscompleted is null)  group by plandate,classcodeseq  ORDER BY plandate  DESC";
	    $qcSchedulesMiddleInspections =  self::$dataStore->executeQuery($query,false,true);
	    return $qcSchedulesMiddleInspections;
	}
	
	
	private function getQcPendingAcFinalInpection(){
	    $query = "select COALESCE(qcschedules.apfinalinspectiondate, qcschedules.scfinalinspectiondate) as plandate,qcschedules.scfinalinspectiondate scdate, qcschedules.potype, qcschedules.apfinalinspectiondate as apdate, qcschedules.classcodeseq, users.qccode from qcschedules inner join users on qcschedules.qcuser = users.seq
where qcschedules.acfinalinspectiondate is NULL and (iscompleted != 1 or iscompleted is null)  group by plandate,classcodeseq  ORDER BY plandate  DESC";
	    $qcSchedulesFinalInspections =  self::$dataStore->executeQuery($query,false,true);
	    return $qcSchedulesFinalInspections;
	}
	private $commonDates = array();
	public function exportQCPlannerReport($isSendEmail = false,$users = null){
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
	    QCNotificationsUtil::sendQCPlannerNotification($mainDataArr, $isSendEmail,$users);
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
	
	public function getQCScheduleNotificationDateCount(){
		$final_missing_appointments_report   =  count($this->getMissingAppoitmentForFinalInspectionDate());
		$middle_missing_appointments_report  =  count($this->getMissingAppoitmentForMiddleInspectionDate());
		$first_missing_appointments_report   =  count($this->getMissingAppoitmentForFirstInspectionDate());
		$final_incompleted_schedules_report  =  count($this->getMissingActualFinalInspectionDate());
		$middle_incompleted_schedules_report =  count($this->getMissingActualMiddleInspectionDate());
		$first_incompleted_schedules_report  =  count($this->getMissingActualFirstInspectionDate());
		$pending_qc_approval_report          =  count($this->getPendingQcForApprovals());
		return [
			"final_missing_appointments_report"  => $final_missing_appointments_report,
			"middle_missing_appointments_report" => $middle_missing_appointments_report,
			"first_missing_appointments_report"  => $first_missing_appointments_report,
			"final_incompleted_schedules_report" => $final_incompleted_schedules_report,
			"middle_incompleted_schedules_report"=> $middle_incompleted_schedules_report,
			"first_incompleted_schedules_report" => $first_incompleted_schedules_report,
			"pending_qc_approval_report"         => $pending_qc_approval_report
		];
	}

	/**
	 * Method to update an array of classcode's qcuser to a particular seq
	 * @param Array<Number> $classCodeSeqsArr  classcodes seqs to update
	 * @param Number $userseq  the seq to update the qcuser column too.
	 * @param String $type the type of value need to be changed
	 * @return Number the result of how many rows have been updated
	 */
	public function correctQCOrPoIncharge($classCodeSeqsArr,$userseq,$type){
		switch($type){
			case "qc":{
				$columnValuePair = [
					"qcuser" => $userseq
				];
				$conditionValuePair = [
					"classcodeseq" => implode(",",$classCodeSeqsArr)
				];
				$result = self::$dataStore->updateByAttributesWithBindParams(
								$columnValuePair,
						 		$conditionValuePair,
								true,
								true);

				return $result;
			}
			case "poincharge":{
				$columnValuePair = [
					"poinchargeuser" => $userseq
				];
				$conditionValuePair = [
					"classcodeseq" => implode(",", $classCodeSeqsArr)
				];
				$result = self::$dataStore->updateByAttributesWithBindParams(
								$columnValuePair,
								$conditionValuePair,
								true,
								true
							);
				return $result;
			}	
		}
	}
	// public function getAllQcSchedules(){
		// $query = "SELECT * from qcschedules";
		// $qcSchedules = self::$dataStore->executeQuery($query);
    	// return $qcSchedules;
	// }
	// Multi purpose methods -----------------------------------------------------------------------------------------------------------------------
	public function getAllQcSchedules($beanReturnDataType){
		if($beanReturnDataType == BeanReturnDataType::grid){
			$query = self::$gridSelectSql;
			$sessionUtil = SessionUtil::getInstance();
			$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
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
				$qcSchedule["id"] = $qcSchedule["seq"];
				$qcSchedule["isSv"] = $isSessionSV;
				$qcSchedule["shipdate"] = DateUtil::convertDateToFormat($qcSchedule["shipdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["latestshipdate"] = DateUtil::convertDateToFormat($qcSchedule["latestshipdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["screadydate"] = DateUtil::convertDateToFormat($qcSchedule["screadydate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scproductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["scproductionstartdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["scgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acreadydate"] = DateUtil::convertDateToFormat($qcSchedule["acreadydate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acproductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["acproductionstartdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["acgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apreadydate"] = DateUtil::convertDateToFormat($qcSchedule["apreadydate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["approductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["approductionstartdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["apgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
				$lastModifiedOn = $qcSchedule["lastmodifiedon"];
				$lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
				$qcSchedule["lastmodifiedon"] = $lastModifiedOn;
				$qcSchedule["users.qccode"] = $qcSchedule["qccode"];
				$qcSchedule["poinchargeusers.qccode"] = $qcSchedule["poqccode"];
				array_push($arr,$qcSchedule);
			}
			$mainArr["Rows"] = $arr;
			$mainArr["TotalRows"] = $this->getAllCount(true,$isGeneralUser,$qcLoggedInSeq,$isSessionSV);
			return $mainArr;
		}elseif($beanReturnDataType == BeanReturnDataType::count){
			$query = self::$gridSelectSql . " group by po";
			$qcSchedules = self::$dataStore->executeQuery($query);
			return $qcSchedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$filterExportSelectSql . " group by po";
			$qcSchedules = self::$dataStore->executeQuery($query,true,true,true);
			return $qcSchedules;
		}
	}
	public function getAllMissingAppoitmentForFinalInspectionDate($beanReturnDataType,$QCUser= null){
	    if($beanReturnDataType == BeanReturnDataType::count){
			$currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
			$currentDate = self::$currentDate;
			$query = $this->find_qc_sql . "where scfinalinspectiondate >= '$currentDate' and scfinalinspectiondate < '$currentDateWith14daysInterval' and  apfinalinspectiondate is NULL and acfinalinspectiondate is NULL and iscompleted = 0";
			// $query = self::$countSql . self::$finalMissingAppointmentWhereClause . " group by po";
			if(!empty($QCUser)){
				$query .=  " and qcuser = $QCUser";
			}
			//$query .= " order by QC ASC, classcodes.classcode ASC,scfinalinspectiondate asc";
			$query .= " order by qccode asc , scfinalinspectiondate asc";
			$qcschedules = self::$dataStore->executeObjectQuery($query);
			$qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
			$currentDate = self::$currentDate;
			$query = self::$filterExportSelectSql . "where scfinalinspectiondate >= '$currentDate' and scfinalinspectiondate < '$currentDateWith14daysInterval' and  apfinalinspectiondate is NULL and acfinalinspectiondate is NULL and iscompleted = 0";
			if(!empty($QCUser)){
				$query .=  " and qcuser = $QCUser";
			}
			//$query .= " order by QC ASC, classcodes.classcode ASC,scfinalinspectiondate asc";
			$query .= " group by po order by qccode asc , scfinalinspectiondate asc";
			$qcschedules = self::$dataStore->executeQuery($query,false,true);
			// $qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::grid){
			$currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
			$currentDate = self::$currentDate;
			
			$query = self::$gridSelectSql . "where scfinalinspectiondate >= '$currentDate' and scfinalinspectiondate < '$currentDateWith14daysInterval' and  apfinalinspectiondate is NULL and acfinalinspectiondate is NULL and iscompleted = 0";
			$sessionUtil = SessionUtil::getInstance();
			$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
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
				$qcSchedule["id"] = $qcSchedule["seq"];
				$qcSchedule["isSv"] = $isSessionSV;
				$qcSchedule["shipdate"] = DateUtil::convertDateToFormat($qcSchedule["shipdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["latestshipdate"] = DateUtil::convertDateToFormat($qcSchedule["latestshipdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["screadydate"] = DateUtil::convertDateToFormat($qcSchedule["screadydate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["scfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scproductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["scproductionstartdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["scgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["scgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acreadydate"] = DateUtil::convertDateToFormat($qcSchedule["acreadydate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["acfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acproductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["acproductionstartdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["acgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["acgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apreadydate"] = DateUtil::convertDateToFormat($qcSchedule["apreadydate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apfinalinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apfinalinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apmiddleinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apmiddleinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apfirstinspectiondate"] = DateUtil::convertDateToFormat($qcSchedule["apfirstinspectiondate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["approductionstartdate"] = DateUtil::convertDateToFormat($qcSchedule["approductionstartdate"],"Y-m-d","Y-m-d H:i:s");
				$qcSchedule["apgraphicsreceivedate"] = DateUtil::convertDateToFormat($qcSchedule["apgraphicsreceivedate"],"Y-m-d","Y-m-d H:i:s");
				$lastModifiedOn = $qcSchedule["lastmodifiedon"];
				$lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
				$qcSchedule["lastmodifiedon"] = $lastModifiedOn;
				$qcSchedule["users.qccode"] = $qcSchedule["qccode"];
				$qcSchedule["poinchargeusers.qccode"] = $qcSchedule["poqccode"];
				array_push($arr,$qcSchedule);
			}
			$mainArr["Rows"] = $arr;
			$mainArr["TotalRows"] = count($this->getAllMissingAppoitmentForFinalInspectionDate(BeanReturnDataType::count));
			return $mainArr;
		}
	}
	public function getAllMissingAppoitmentForMiddleInspectionDate($beanReturnDataType,$QCUser = null){
		if($beanReturnDataType == BeanReturnDataType::count){
			$currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
			$currentDate = self::$currentDate;
			$query = $this->find_qc_sql . "where scmiddleinspectiondate >= '$currentDate' and scmiddleinspectiondate < '$currentDateWith14daysInterval' and apmiddleinspectiondate is NULL and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL  and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			//$query .= " order by QC ASC, classcodes.classcode ASC,scmiddleinspectiondate asc";
			$query .= " order by qccode asc , scmiddleinspectiondate asc";
			$qcschedules = self::$dataStore->executeObjectQuery($query);
			$qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
			$currentDate = self::$currentDate;
			$query = self::$filterExportSelectSql . "where scmiddleinspectiondate >= '$currentDate' and scmiddleinspectiondate < '$currentDateWith14daysInterval' and apmiddleinspectiondate is NULL and acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL  and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			//$query .= " order by QC ASC, classcodes.classcode ASC,scmiddleinspectiondate asc";
			$query .= " group by po order by qccode asc , scmiddleinspectiondate asc";
			$qcschedules = self::$dataStore->executeQuery($query,false,true);
			// $qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}
	    
	}
	public function getAllMissingAppoitmentForFirstInspectionDate($beanReturnDataType,$QCUser = null){
		if($beanReturnDataType == BeanReturnDataType::count){
			$currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
			$currentDate = self::$currentDate;
			$query = $this->find_qc_sql . "where scfirstinspectiondate >= '$currentDate' and scfirstinspectiondate < '$currentDateWith14daysInterval' and apfirstinspectiondate is NULL and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL  and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			//$query .= " order by QC ASC, classcodes.classcode ASC,scfirstinspectiondate asc";
			$query .= " order by qccode asc , scfirstinspectiondate asc";
			$qcschedules = self::$dataStore->executeObjectQuery($query);
			$qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$currentDateWith14daysInterval = self::$currentDateWith14daysInterval;
			$currentDate = self::$currentDate;
			$query = self::$filterExportSelectSql . "where scfirstinspectiondate >= '$currentDate' and scfirstinspectiondate < '$currentDateWith14daysInterval' and apfirstinspectiondate is NULL and acfirstinspectiondate is NULL and apfirstinspectiondatenareason is NULL  and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			//$query .= " order by QC ASC, classcodes.classcode ASC,scfirstinspectiondate asc";
			$query .= " group by po order by qccode asc , scfirstinspectiondate asc";
			$qcschedules = self::$dataStore->executeQuery($query,false,true);
			// $qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}
	    
	}
	public function getAllMissingActualFinalInspectionDate($beanReturnDataType,$QCUser = null){
	    if($beanReturnDataType == BeanReturnDataType::count){
			$currentDate = self::$currentDate;
			$query = $this->find_qc_sql . "where scfinalinspectiondate <= '$currentDate' and (apfinalinspectiondate <= '$currentDate' or apfinalinspectiondate is NULL) and acfinalinspectiondate is NULL and iscompleted = 0 ";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			$query .= " order by qccode ASC, apfinalinspectiondate ASC,scfinalinspectiondate asc";
			$qcschedules = self::$dataStore->executeObjectQuery($query);
			$qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$currentDate = self::$currentDate;
			$query = self::$filterExportSelectSql . "where scfinalinspectiondate <= '$currentDate' and (apfinalinspectiondate <= '$currentDate' or apfinalinspectiondate is NULL) and acfinalinspectiondate is NULL and iscompleted = 0 ";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			$query .= " group by po order by qccode ASC, apfinalinspectiondate ASC,scfinalinspectiondate asc";
			$qcschedules = self::$dataStore->executeQuery($query,false,true);
			// $qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}
	}
	public function getAllMissingActualMiddleInspectionDate($beanReturnDataType,$QCUser = null){
	    if($beanReturnDataType == BeanReturnDataType::count){
			$currentDate = self::$currentDate;
			$query = $this->find_qc_sql . "where acfinalinspectiondate is NULL and scmiddleinspectiondate <= '$currentDate' and (apmiddleinspectiondate <= '$currentDate' or apmiddleinspectiondate is NULL) and  acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			$query .= " order by qccode ASC, apmiddleinspectiondate ASC,scmiddleinspectiondate asc";
			$qcschedules = self::$dataStore->executeObjectQuery($query);
			$qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$currentDate = self::$currentDate;
			$query = self::$filterExportSelectSql . "where acfinalinspectiondate is NULL and scmiddleinspectiondate <= '$currentDate' and (apmiddleinspectiondate <= '$currentDate' or apmiddleinspectiondate is NULL) and  acmiddleinspectiondate is NULL and apmiddleinspectiondatenareason is NULL and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			$query .= " group by po order by qccode ASC, apmiddleinspectiondate ASC,scmiddleinspectiondate asc";
			$qcschedules = self::$dataStore->executeQuery($query,false,true);
			// $qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}
	}
	public function getAllMissingActualFirstInspectionDate($beanReturnDataType,$QCUser = null){
	    if($beanReturnDataType == BeanReturnDataType::count){
			$currentDate = self::$currentDate;
			$query = $this->find_qc_sql . "where acfinalinspectiondate is NULL and scfirstinspectiondate  <= '$currentDate' and (apfirstinspectiondatenareason  <= '$currentDate' or apfirstinspectiondatenareason is NULL) and acfirstinspectiondate is NULL and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			$query .= " order by qccode ASC, apfirstinspectiondatenareason ASC,scfirstinspectiondate asc"; 
			$qcschedules = self::$dataStore->executeObjectQuery($query);
			$qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$currentDate = self::$currentDate;
			$query = self::$filterExportSelectSql . "where acfinalinspectiondate is NULL and scfirstinspectiondate  <= '$currentDate' and (apfirstinspectiondatenareason  <= '$currentDate' or apfirstinspectiondatenareason is NULL) and acfirstinspectiondate is NULL and iscompleted = 0";
			if(!empty($QCUser)){
				$query .= " and qcuser = $QCUser";
			}
			$query .= " group by po order by qccode ASC, apfirstinspectiondatenareason ASC,scfirstinspectiondate asc"; 
			$qcschedules = self::$dataStore->executeQuery($query,false,true);
			// $qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}
	}
	public function getAllPendingQcForApprovals($beanReturnDataType){
		if($beanReturnDataType == BeanReturnDataType::count){
			$query = "select  qccode,classcodes.classcode, qcschedulesapproval.responsetype,qcschedulesapproval.appliedon,qcschedules.* from qcschedules 
			left join users on qcschedules.qcuser = users.seq
			left join classcodes on qcschedules.classcodeseq = classcodes.seq
			left join qcschedulesapproval on qcschedules.seq = qcschedulesapproval.qcscheduleseq and qcschedulesapproval.seq in (select max(qcschedulesapproval.seq) from qcschedulesapproval  GROUP by qcschedulesapproval.qcscheduleseq) where qcschedulesapproval.responsetype = 'Pending' order by appliedon";
			$qcschedules = self::$dataStore->executeObjectQuery($query,false,true);
			$qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}elseif($beanReturnDataType == BeanReturnDataType::export){
			$query = self::$filterExportSelectSql . "where qcschedulesapproval.responsetype = 'Pending' group by po order by appliedon";
			$qcschedules = self::$dataStore->executeQuery($query,false,true);
			// $qcschedules = $this->groupByPO($qcschedules);
			return $qcschedules;
		}
	}
	public function exportFilterData($filterId){
		$qcSchedules = null;
		$QCExportSchedulesAndFileName = array();
		$fileName = "QCSchedules";
		if($filterId == "qc_schedules_all_count_export_date"){
			$qcSchedules = $this->getAllQcSchedules(BeanReturnDataType::export);
		}elseif($filterId == "qc_schedules_final_missing_appointments_export_date"){
			$qcSchedules = $this->getAllMissingAppoitmentForFinalInspectionDate(BeanReturnDataType::export);
			$fileName = "QCScheduleAllMissingAppointmentForFinalInspectionDate";
		}elseif($filterId == "qc_schedules_middle_missing_appointments_export_date"){
			$qcSchedules = $this->getAllMissingAppoitmentForMiddleInspectionDate(BeanReturnDataType::export);
			$fileName = "QCScheduleAllMissingAppointmentForMiddleInspectionDate";
		}elseif($filterId == "qc_schedules_first_missing_appointments_export_date"){
			$qcSchedules = $this->getAllMissingAppoitmentForFirstInspectionDate(BeanReturnDataType::export);
			$fileName = "QCScheduleAllMissingAppointmentForFirstInspectionDate";
		}elseif($filterId == "qc_schedules_final_incompleted_schedules_export_date"){
			$qcSchedules = $this->getAllMissingActualFinalInspectionDate(BeanReturnDataType::export);
			$fileName = "QCScheduleAllFinalIncomplete";
		}elseif($filterId == "qc_schedules_middle_incompleted_schedules_export_date"){
			$qcSchedules = $this->getAllMissingActualMiddleInspectionDate(BeanReturnDataType::export);
			$fileName = "QCScheduleAllMiddleIncomplete";
		}elseif($filterId == "qc_schedules_first_incompleted_schedules_export_date"){
			$qcSchedules = $this->getAllMissingActualFirstInspectionDate(BeanReturnDataType::export);
			$fileName = "QCScheduleAllFirstIncomplete";
		}elseif($filterId == "qc_schedules_pending_qc_approvals_export_date"){
			$qcSchedules = $this->getAllPendingQcForApprovals(BeanReturnDataType::export);
			$fileName = "QCScheduleAllPendingApprovals";
		}
		$QCExportSchedulesAndFileName['qcSchedules'] = $qcSchedules;
		$QCExportSchedulesAndFileName['fileName'] = $fileName;
		return $QCExportSchedulesAndFileName;
	}
}