<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';

class QCScheduleMgr{
	private static  $qcScheduleMgr;
	private static $dataStore;
	private $dataTypeErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 19;
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
    	self::$dataStore->save($qcschedule);
    }
    
    public function updateOject($conn,$item,$condition){
    	self::$dataStore->updateObject($item, $condition, $conn);
    }
	
	public function importQCSchedules($file,$isUpdate,$updateItemNos){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheet = $objPHPExcel->getActiveSheet();
		$maxCell = $sheet->getHighestRowAndColumn();
		$sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row']);
		return $this->validateAndSaveFile($sheetData,$isUpdate,$updateItemNos);
	}
	
	public function exportItems(){
		$qcSchedules = self::$dataStore->findAll();
		ExportUtil::exportItems($qcSchedules);
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
			$qcScheudleArr = array();
			$sessionUtil = SessionUtil::getInstance();
			$isAdminSession = $sessionUtil->isSessionAdmin();
			$userSeq = 0;
			if($isAdminSession){
				$userSeq = $sessionUtil->getAdminLoggedInSeq();
			}else{
				$userSeq = $sessionUtil->getUserLoggedInSeq();
			}
			foreach ($sheetData as $key=>$data){
				if($key == 0){
					continue;
				}
				if(!array_filter($data)) {
					continue;
				}
				$qcSchedule = $this->getQCScheduleObj($data);
				$qcSchedule->setUserSeq($userSeq);
				array_push($qcScheudleArr, $qcSchedule);
			}
		}else{
			$messages .= "Please import the correct file";
			$success = 0;
		}
		$response = array();
		$response["message"] = $messages;
		$response["success"] = $success;
		if(empty($messages)){
			$response = $this->saveArr($qcScheudleArr, $isUpdate,$updateItemNos);
		}
		return $response;
	}
	
	private function saveArr($qcScheudleArr,$isUpdate,$updateItemNos){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$existingItemIds = array();
		$success = 1;
		foreach ($qcScheudleArr as $qc){
			try {
				$this->saveQCSchedule($conn, $qc);
				$savedItemCount++;
			 }
			catch ( Exception $e) {
				$messages .= $e->getMessage();
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
		$response["savedItemCount"] = $savedItemCount;
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
	
	private function getQCScheduleObj($data){
		$qc = $data[0];
		$classCode = $data[1];
		$po = $data[2];
		$poType = $data[3];
		$itemNo = $data[4];
		$shipDate = $data[5];
		
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
		}
		if(!empty($classCode)){
			$qcSchedule->setClassCode($classCode);
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
		if(!empty($shipDate)){
			$shipDate = $this->validateDate($shipDate);
			$qcSchedule->setShipDate($shipDate);
		}
		if(!empty($readyDate)){
			$readyDate = $this->validateDate($readyDate);
			$qcSchedule->setSCReadyDate($readyDate);
		}
		if(!empty($finalInspectionDate)){
			$finalInspectionDate = $this->validateDate($finalInspectionDate);
			$qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
		}
		if(!empty($middleInspectionDate)){
			$middleInspectionDate = $this->validateDate($middleInspectionDate);
			$qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
		}
		if(!empty($firstInspectionDate)){
			$firstInspectionDate = $this->validateDate($firstInspectionDate);
			$qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
		}
		if(!empty($productionStartDate)){
			$productionStartDate = $this->validateDate($productionStartDate);
			$qcSchedule->setSCProductionStartDate($productionStartDate);
		}
		if(!empty($graphicReceiveDate)){
			$graphicReceiveDate = $this->validateDate($graphicReceiveDate);
			$qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
		}
		if(!empty($ac_readyDate)){
			$ac_readyDate = $this->validateDate($ac_readyDate);
			$qcSchedule->setACReadyDate($ac_readyDate);
		}
		if(!empty($ac_finalInspectionDate)){
			$ac_finalInspectionDate = $this->validateDate($ac_finalInspectionDate);
			$qcSchedule->setACFinalInspectionDate($ac_finalInspectionDate);
		}
		if(!empty($ac_middleInspectionDate)){
			$ac_middleInspectionDate = $this->validateDate($ac_middleInspectionDate);
			$qcSchedule->setACMiddleInspectionDate($ac_middleInspectionDate);
		}
		if(!empty($ac_firstInpectionDate)){
			$ac_firstInpectionDate =  $this->validateDate($ac_firstInpectionDate);
			$qcSchedule->setACFirstInspectionDate($ac_firstInpectionDate);
		}
		if(!empty($ac_productionStartDate)){
			$ac_productionStartDate = $this->validateDate($ac_productionStartDate);
			$qcSchedule->setACProductionStartDate($ac_productionStartDate);
		}
		if(!empty($ac_graphicDateReceive)){
			$ac_graphicDateReceive = $this->validateDate($ac_graphicDateReceive);
			$qcSchedule->setACGraphicsReceiveDate($ac_graphicDateReceive);
		}
		if(!empty($note)){
			$qcSchedule->setNotes($note);
		}
		$qcSchedule->setCreatedOn(DateUtil::getCurrentDate());
		$qcSchedule->setLastModifiedOn(DateUtil::getCurrentDate());
		return $qcSchedule;
	}
	
	public function getQCScheudlesForGrid(){
		$qcSchedules = $this->findAllArr(true);
		$mainArr["Rows"] = $qcSchedules;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$itemArr = self::$dataStore->findAllArr($isApplyFilter);
		return $itemArr;
	}
	
	
	public function findBySeq($seq){
		$qcSchedule = self::$dataStore->findBySeq($seq);
		$shipDate = $this->getDateStr($qcSchedule->getShipDate());
		$qcSchedule->setShipDate($shipDate);
		
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
	
	private function validateDate($date){
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