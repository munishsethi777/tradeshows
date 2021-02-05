<?php
require_once $ConstantsArray['dbServerUrl'] . 'Managers/QCScheduleMgr.php';
require_once $ConstantsArray['dbServerUrl'] . 'Enums/ReasonCodeType.php';
require_once $ConstantsArray['dbServerUrl'] . "log4php/Logger.php";
class QCScheduleImportUtil
{
    private $fieldNames;
    private static $qcImportUtil;
    private $BULK_DELETE_COUNT = "100";
    private static $qcUserCodeSeqArr = [];
    private static $poInchargeUserCodeSeqArr = [];
    private static $ACTUAL_FIELDS_NAMES = array(
        "qc",
    	"poperson",
        "classcodes",
        "po#",
        "potype",
        "itemno",
        "shipdate",
        "latestshipdate",
        "readydate",
        "finalinspectiondate",
        "middleinspectiondate",
        "firstinspectiondate",
        "productionstartdate",
        "graphicsreceivedate",
        "readydate",
        "finalinspectiondate",
        "middleinspectiondate",
        "firstinspectiondate",
        "productionstartdate",
        "graphicsreceivedate",
        "notes",
        "finalstatus"
    );

    private static $FIELDS_NAMES = array(
        "Qc",
    	"PO Person",
        "Class Codes",
        "PO#",
        "PO Type",
        "Item No",
        "Ship Date",
        "Latest Ship Date",
        "Ready Date",
        "Final Inspection Date",
        "Middle Inspection Date",
        "First Inspection Date",
        "Production Start Date",
        "Graphics Receive Date",
        "Ready Date",
        "Final Inspection Date",
        "Middle Inspection Date",
        "First Inspection Date",
        "Production Start Date",
        "Graphics Receive Date",
        "Notes",
        "Final Status"
    );
	
    
    public static function getInstance()
    {
        if (! self::$qcImportUtil) {
            self::$qcImportUtil = new QCScheduleImportUtil();
        }
        $userMgr = UserMgr::getInstance();
        self::$qcUserCodeSeqArr = array_flip($userMgr->getQCUsersArrForDD());
        self::$poInchargeUserCodeSeqArr = array_flip($userMgr->getPOInchargeUsersArrForDD());
        return self::$qcImportUtil;
    }

    public function importQCSchedules($file, $isUpdate, $updatingRowNumbers,$isCompleted)
    {
        $inputFileName = $file['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getActiveSheet();
        $maxCell = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
        try {
            return $this->validateAndSaveFile($sheetData, $isUpdate, $updatingRowNumbers);
            //return $this->marksAsCompleted($sheetData);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function newUpdateQCSchedules($file){
        $inputFileName = $file['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getActiveSheet();
        $maxCell = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
        try {
            return $this->validateAndSaveFileNewOrUpdate($sheetData);
            //return $this->marksAsCompleted($sheetData);
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Method to convert the $file to a datatype where php could use to update QCSchedule
     * @param FILE $file the file need to be updated
     * @param bool $isUpdateShipDateAndScheduleDates
     * @param bool $isUpdateLatestShipDate
     * @param bool $isCompletionStatus
     * @param bool $isUpdatePONumber
     * @param bool $isPoTypes
     * @param bool $isUpdateClassCode
     * @param bool $isUpdateQC
     * @param bool $isUpdateFirstInspectionDate
     */
    public function updateQCSchedules($file,
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
        $inputFileName = $file['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getActiveSheet();
        $maxCell = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
        try{
            return $this->validateAndUpdateFile(
                $sheetData,
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
        }catch(Exception $e){
            throw $e;
        }
    }

    public function deleteByImport($filePath)
    {
        if(file_exists($filePath)){
            $inputFileName = $filePath;
            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $sheet = $objPHPExcel->getActiveSheet();
            $maxCell = $sheet->getHighestRowAndColumn();
            $sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
            try {
              $this->bulkDelete($sheetData);
            } catch (Exception $e) {
                throw $e;
            }
        }else{
            echo "File Not found";
        }
    }
    
    
    public function bulkDelete($sheetData){
        $qcScheduleMgr = QCScheduleMgr::getInstance();
        $totalCount = 0;
        $idArr = array();
        $count = 0;
        $lastKey = count($sheetData)-1;
        foreach ($sheetData as $key=>$data) {
            if ($key == 0) {
                continue;
            }
            $id = $data[0];
            array_push($idArr,$id);
            $count++;
            if($count == $this->BULK_DELETE_COUNT || $lastKey == $key){
                $ids = implode(",", $idArr);
                $qcScheduleMgr->deleteByIds($ids);
                echo $count . " QCSchedules deleted sucessfully. Seq - $ids <br>";
                $totalCount += $count;
                $count = 0;
                $idArr = array();
            }
        }
        $messages = "Total " . $totalCount . " QCSchedules deleted sucessfully";
        echo $messages;
    }
    
    public function marksAsCompleted($sheetData){
        $this->fieldNames = $sheetData[0];
        $this->validateFields();
        $qcScheduleMgr = QCScheduleMgr::getInstance();
        $updatedCount = 0;
        $itemNoAlreadyExists = 0;
        $success = 1;
        $messages = "QCSchedules mark as completed sucessfully";
        $totalCount = 0;
        foreach ($sheetData as $key=>$data) {
            if ($key == 0) {
                continue;
            }
            $status = $data[19];
            $status = trim($status);
            if(!empty($status && strtolower($status) == "completed")){
                $po = $data[2];
                $itemNo = $data[4];
                $itemNoArr = array();
                if (! empty($itemNo)) {
                    $itemNoArr = $this->getItemNoArr($itemNo);
                }
                $shipDateStr = $data[5];
                if (! empty($shipDateStr)) {
                    $shipDate = $this->convertStrToDate($shipDateStr);
                }
                foreach ($itemNoArr as $itemNo){
                    $flag = $qcScheduleMgr->markAsCompleted($po, $itemNo, $shipDate);
                    if($flag){
                        $updatedCount++;
                    }
                    $totalCount++;
                }
            }
        }
        $response = array();
        $response["message"] = $updatedCount . " " . $messages;
        $response["success"] = $success;
        $response["itemalreadyexists"] = $itemNoAlreadyExists;
        return $response;
    }
    
    
    public function validateAndSaveFile($sheetData, $isUpdate, $updatingRowNumbers)
    {
        $logger = Logger::getLogger("logger");
        $this->fieldNames = $sheetData[0];
        $itemNoAlreadyExists = 0;
        $success = 1;
        $messages = "";
        //$this->validateFields();
        $qcScheudleArr = array();
        $sessionUtil = SessionUtil::getInstance();
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $rowAndItemNo = array();
        foreach ($sheetData as $key => $data) {
            $row = $key+2;
            if (! array_filter($data)) {
                continue;
            }
            if ($isUpdate) {
                if (!isset($updatingRowNumbers[$row])) {
                    continue;
                }
            }
            if($key == 0){
                continue;
            }
            $importedData = array();
            try {
                    $importedData = $this->getImportedData($data);
            } catch (Exception $e) {
                $messages .= "Error on row no $row - " . $e->getMessage() . "<br>";
                $success = 0;
            }
            if (empty($importedData)) {
                continue;
            }
            $qcschedule = $importedData["importingQCObj"];
            $itemIdsArr = $importedData["items"];
            $itemNoArr = array();
            foreach ($itemIdsArr as $itemId) {
                if (empty($itemId)) {
                    continue;
                }
                $qc = clone $qcschedule;
                $qc->setItemNumbers($itemId);
                $qc->setUserSeq($userSeq);
                array_push($qcScheudleArr, $qc);
                array_push($itemNoArr, $itemId . $qc->getPO() . $qc->getShipDate()->format("m/d/y"));
            }
            $rowAndItemNo[$row] = $itemNoArr;
        }
        $response = array();
        $response["message"] = $messages;
        $response["success"] = $success;
        $response["itemalreadyexists"] = $itemNoAlreadyExists;
        if (empty($messages)) {
            $qcscheduleMgr = QCScheduleMgr::getInstance();
            $logger->info("\n\n\n\n\n QCSchedules are about to be Inserted by import process");
            $response = $qcscheduleMgr->saveArr($qcScheudleArr, $isUpdate, $rowAndItemNo, $updatingRowNumbers);
        }
        if($isUpdate){
            $response["savedItemCount"] = $_SESSION['numberOfInsertedNewCases'];
            unset($_SESSION['numberOfInsertedNewCases']);
        }
        return $response;
    }
    public function validateAndSaveFileNewOrUpdate($sheetData)
    {
        $logger = Logger::getLogger("logger");
        $this->fieldNames = $sheetData[0];
        $itemNoAlreadyExists = 0;
        $success = 1;
        $messages = "";
        //$this->validateFields();
        $qcScheudleArr = array();
        $sessionUtil = SessionUtil::getInstance();
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $rowAndItemNo = array();
        $labels = [];
        foreach ($sheetData as $key => $data) {
            $row = $key+2;
            if (! array_filter($data)) {
                continue;
            }
            if($key == 0){
                $i = 0;
                foreach($data as $index => $value){
                    $labels[$value] = 0;
                }
                continue;
            }
            $importedData = array();
            try {
                $importedData = $this->getImportedUpdatedData($data);
            } catch (Exception $e) {
                $messages .= "Error on row no $row - " . $e->getMessage() . "<br>";
                $success = 0;
            }
            if (empty($importedData)) {
                continue;
            }
            $qcschedule = $importedData["importingQCObj"];
            if(empty($qcschedule->getSeq())){//new case
                $itemIdsArr = $importedData["items"];
                $itemNoArr = array();
                foreach ($itemIdsArr as $itemId) {
                    if (empty($itemId)) {
                        continue;
                    }
                    $qc = clone $qcschedule;
                    $qc->setItemNumbers($itemId);
                    $qc->setUserSeq($userSeq);
                    array_push($qcScheudleArr, $qc);
                    // array_push($itemNoArr, $itemId . $qc->getPO() . $qc->getShipDate()->format("m/d/y"));
                }
                $rowAndItemNo[$row] = $itemNoArr;
            }else{//update case
                array_push($qcScheudleArr, $qcschedule);
            }
        }
        $response = array();
        $response["message"] = $messages;
        $response["success"] = $success;
        if (empty($messages)) {
            /**@var QCScheduleMgr */
            $qcscheduleMgr = QCScheduleMgr::getInstance();
            $logger->info("\n\n\n\n\n QCSchedules are about to be Inserted by import process");
            $response = $qcscheduleMgr->saveOrUpdateArr($qcScheudleArr ,$rowAndItemNo, $labels);
        }
        
        //$response["savedItemCount"] = $_SESSION['numberOfInsertedNewCases'];
        //unset($_SESSION['numberOfInsertedNewCases']);
        
        return $response;
    }
    /**
     * Method to Validate File And Convert it to a QCScedule BusinessObject.
     * @param string[][] $sheetData
     * @param bool $isUpdateShipDateAndScheduleDates
     * @param bool $isUpdateLatestShipDate
     * @param bool $isCompletionStatus
     * @param bool $isUpdatePONumber
     * @param bool $isUpdatePOTypes
     * @param bool $isUpdateClassCode
     * @param bool $isUpdateQC
     * @param bool $isUpdateFirstInspectionDate
     */
    public function validateAndUpdateFile(
                    $sheetData,
                    $isUpdateShipDateAndScheduleDates,
                    $isUpdateLatestShipDate,
                    $isCompletionStatus,
                    $isUpdatePONumber = false,
                    $isUpdatePOTypes = false,
                    $isUpdateClassCode = false,
                    $isUpdateQC = false,
                    $isUpdateFirstInspectionDate = false,
                    $isUpdatePoInchargeUser = false
                ){
        $logger = Logger::getLogger("logger");
        $this->fieldNames = $sheetData[0];
        $success = 1;
        $messages = "";
        $labels = array();
        $row = 0;
        $qcScheduleArr = array();
        try{
            foreach ($sheetData as $key => $data) {
                $row = $key+2;
                if (! array_filter($data)) {
                    continue;
                }
                if ($key == 0) {
                    $labels = $data;
                    if(!(in_array("ID",$labels) and in_array("PO#",$labels) and in_array("Item No",$labels) and in_array("Ship Date",$labels))){
                        throw new Exception("Incorrect field labels, fix your file");
                    }
                    
                }else{
                    try{
                        $qcSchedule = $this->getUpdatingData(
                                        $data,
                                        $labels,
                                        $isUpdateShipDateAndScheduleDates,
                                        $isUpdateLatestShipDate,
                                        $isCompletionStatus,
                                        $isUpdatePONumber,
                                        $isUpdatePOTypes,
                                        $isUpdateClassCode,
                                        $isUpdateQC,
                                        $isUpdateFirstInspectionDate,
                                        $isUpdatePoInchargeUser
                                    );
                        array_push($qcScheduleArr, $qcSchedule);
                    }catch (Exception $e){
                        $messages .= "Error found on row " . $row ." - ". $e->getMessage() . "<br>";
                        $success = 0;
                    }
                }
                
            }
        }catch(Exception $e){
            $messages = $e->getMessage();
            $success = 0;
            
        }
        $response = array();
        $response["message"] = $messages;
        $response["success"] = $success;
        if (empty($messages)) {
            /** @var QCScheduleMgr */
            $qcscheduleMgr = QCScheduleMgr::getInstance();
            $logger->info("\n\n\n\n\n QCSchedule is about to be updated by Import Process");
            $response = $qcscheduleMgr->updateQCScheduleDates(
                                    $qcScheduleArr,
                                    $isUpdateShipDateAndScheduleDates,
                                    $isUpdateLatestShipDate,
                                    $isCompletionStatus,
                                    $isUpdatePONumber,
                                    $isUpdatePOTypes,
                                    $isUpdateClassCode,
                                    $isUpdateQC,
                                    $isUpdateFirstInspectionDate,
                                    $isUpdatePoInchargeUser
                                );
        }
        return $response;
    }
    private function validateFields()
    {
        $fieldArr = $this->fieldNames;
        foreach (self::$FIELDS_NAMES as $key => $field) {
            $actualFieldName = self::$ACTUAL_FIELDS_NAMES[$key];
            $fileField = trim($fieldArr[$key]);
            $actualfileField = strtolower(str_replace(array(
                "\n",
                "\r"
            ), ' ', $fileField));
            $actualfileField = str_replace(' ', '', $actualfileField);
            $colNo = $key + 1;
            if (! in_array($actualfileField, self::$ACTUAL_FIELDS_NAMES)) {
                throw new Exception("Unknown filed Name '$fileField' in column no " . $colNo);
            }
            if (strtolower($actualFieldName) != $actualfileField) {
                throw new Exception("'$field' Field does not exists in column no " . $colNo);
            }
            unset($fieldArr[$key]);
        }
        if (! empty($fieldArr)) {
            $messages = "";
            foreach ($fieldArr as $key => $field) {
                $messages .= "Unknown filed Name '$field' in column no " . $key . "<br>";
            }
            throw new Exception($messages);
        }
    }
    
    private function getItemNoArr($itemNos){
        $itemNos = str_replace(" ", "", $itemNos);
        $explodeChar = "\n";
        if( strpos($itemNos, ",") !== false ) {
            $explodeChar = ",";
        }
        $itemNoArr = explode($explodeChar, $itemNos);
        return $itemNoArr;
    }
    
    private function getImportedData($data)
    {
        $userMgr = UserMgr::getInstance();
        $qcUsers = $userMgr->getQCUsersArrForDD();
        $qcUsers = array_flip($qcUsers);
        $poinchargeUsers = $userMgr->getPOInchargeUsersArrForDD();
        $poinchargeUsers = array_flip($poinchargeUsers);
        $classCodeMgr = ClassCodeMgr::getInstance();
        $messages = array();
        $startingIndex = 1;
        
        $qc = $data[$startingIndex++];
        $qc = strtoupper(trim($qc));
        $qcUserSeq = $qcUsers[$qc];
        $poincharge = $data[$startingIndex++];
        if($poincharge != null){
        $poinchargeUserSeq = $poinchargeUsers[strtoupper(trim($poincharge))];
        }
        $classCode = $data[$startingIndex++];
        $po = $data[$startingIndex++];
        $poType = $data[$startingIndex++];
        $itemNo = $data[$startingIndex++];
        $itemNoArr = array();
        if (! empty($itemNo)) {
            $itemNoArr = $this->getItemNoArr($itemNo);
        }
        $shipDateStr = $data[$startingIndex++];
        $latestShipDateStr = $data[$startingIndex++];
        $readyDate = $data[$startingIndex++];
        $finalInspectionDate = $data[$startingIndex++];
        $middleInspectionDate = $data[$startingIndex++];
        $firstInspectionDate = $data[$startingIndex++];
        $productionStartDate = $data[$startingIndex++];
        $graphicReceiveDate = $data[$startingIndex++];

        $startingIndex = $startingIndex + 9;//actual dates are in third block
        $ac_readyDate = $data[$startingIndex++];
        $ac_finalInspectionDate = $data[$startingIndex++];
        $ac_middleInspectionDate = $data[$startingIndex++];
        $ac_firstInpectionDate = $data[$startingIndex++];
        $ac_productionStartDate = $data[$startingIndex++];
        $ac_graphicDateReceive = $data[$startingIndex++];
        $note = $data[++$startingIndex + 1];
        $startingIndex = $startingIndex + 2;//actual dates are in third block
        $finalStatus = $data[$startingIndex++];
        $isCompleted = $data[++$startingIndex];
        $this->dataTypeErrors = "";
        $qcSchedule = new QCSchedule();

        if (! empty($qc) && ! empty($qcUserSeq)) {
            $qcSchedule->setQC($qc);
            $qcSchedule->setQCUser($qcUserSeq);
        }else{
        	//we are now letting empty QC also
        	//throw new Exception("'$qc' QC not found in database!");
        }
        if (! empty($poincharge)) {
        	if(!empty($poinchargeUserSeq)){
        		$qcSchedule->setPOInchargeUser($poinchargeUserSeq);
        	}else{
        		$messages[] = " '$poincharge' PO Incharge not found in database!";
        	}
        }
        if (! empty($classCode)) {
            $classCodeObj = $classCodeMgr->findByClassCode($classCode);
            $classCodeSeq = 0;
            if (! empty($classCodeObj)) {
                $classCodeSeq = $classCodeObj->getSeq();
            } else {
                $messages[] = " '$classCode' class code not found in database!";
            }
            $qcSchedule->setClassCodeSeq($classCodeSeq);
        }

        if (! empty($po)) {
            $qcSchedule->setPO($po);
        }
        if (! empty($poType)) {
            $qcSchedule->setPOType($poType);
        }
        if (! empty($itemNo)) {
            $qcSchedule->setItemNumbers($itemNo);
        }
  
        if (! empty($shipDateStr)) {
            $shipDate = $this->ConvertToDate($shipDateStr,"m/d/y");
            if(!$shipDate){
                $messages[] = " Invalid Ship date";
            }else{
                $qcSchedule->setShipDate($shipDate);
                if(!$shipDate){

                }
                $currentTime = new DateTime();
                $currentTime->setTime(0,0);
                $shipDate->setTime(0,0);
                if($shipDate < $currentTime){
                    //throw new Exception(StringConstants::SHIP_DATE_IS_IN_PAST);
                }
                $readyDate = clone $shipDate;
                $readyDate->modify('-14 day');
                $qcSchedule->setSCReadyDate($readyDate);
                
                $finalInspectionDate = clone $shipDate;
                $finalInspectionDate->modify('-10 day');
                $qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
                
                $middleInspectionDate = clone $shipDate;
                $middleInspectionDate->modify('-15 day');
                $qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
                
                $firstInspectionDate = clone $shipDate;
                $firstInspectionDate->modify('-35 day');
                $qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
                
                $productionStartDate = clone $shipDate;
                $productionStartDate->modify('-45 day');
                $qcSchedule->setSCProductionStartDate($productionStartDate);
                
                $graphicReceiveDate = clone $shipDate;
                $graphicReceiveDate->modify('-30 day');
                $qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
            }
        }   
        if (! empty($latestShipDateStr)) {
        	$latestShipDate = $this->ConvertToDate($latestShipDateStr,"m/d/y");
            if(!$latestShipDate){
                $messages[] = " Invalid Latest Ship Date";
            }else{
                $qcSchedule->setLatestShipDate($latestShipDate);
            }
        }
        
        if (! empty($ac_readyDate)) {
            $ac_readyDate = $this->convertStrToDate($ac_readyDate);
            $qcSchedule->setACReadyDate($ac_readyDate);
        }
        if (! empty($ac_finalInspectionDate)) {
            $ac_finalInspectionDate = $this->convertStrToDate($ac_finalInspectionDate);
            $qcSchedule->setACFinalInspectionDate($ac_finalInspectionDate);
        }
        if (! empty($ac_middleInspectionDate)){
            if(is_string($ac_middleInspectionDate)){
                $ac_middleInspectionDate = strtolower(str_replace(" ", "", $ac_middleInspectionDate));
            }
            if($ac_middleInspectionDate != "n/a"){
                $ac_middleInspectionDate = $this->convertStrToDate($ac_middleInspectionDate);
                $qcSchedule->setACMiddleInspectionDate($ac_middleInspectionDate);
            }else{
                $qcSchedule->setApMiddleInspectionDateNaReason(ReasonCodeType::getName(ReasonCodeType::small_quantities));
            }
        }
        if (! empty($ac_firstInpectionDate)) {
            if(is_string($ac_firstInpectionDate)){
                $ac_firstInpectionDate = strtolower(str_replace(" ", "", $ac_firstInpectionDate));
            }
            if($ac_firstInpectionDate != "n/a"){
                $ac_firstInpectionDate = $this->convertStrToDate($ac_firstInpectionDate);
                $qcSchedule->setACFirstInspectionDate($ac_firstInpectionDate);
            }else{
                $qcSchedule->setApFirstInspectionDateNaReason(ReasonCodeType::getName(ReasonCodeType::small_quantities));
            }
        }
        if (! empty($ac_productionStartDate)) {
            $ac_productionStartDate = $this->convertStrToDate($ac_productionStartDate);
            $qcSchedule->setACProductionStartDate($ac_productionStartDate);
        }
        if (! empty($ac_graphicDateReceive)) {
            $ac_graphicDateReceive = $this->convertStrToDate($ac_graphicDateReceive);
            $qcSchedule->setACGraphicsReceiveDate($ac_graphicDateReceive);
        }
        if (! empty($note)) {
            $qcSchedule->setNotes($note);
        }
        if (! empty($finalStatus)) {
            $qcSchedule->setStatus($finalStatus);
        }
        if(!empty($isCompleted) and strtolower($isCompleted) == "yes"){
            $qcSchedule->setIsCompleted("1");
        }else{
            $qcSchedule->setIsCompleted("0");
        }
        $qcSchedule->setCreatedOn(DateUtil::getCurrentDate());
        $qcSchedule->setLastModifiedOn(DateUtil::getCurrentDate());
        if(!empty($messages)){
            throw new Exception(implode(",",$messages));
        }
        $importedData = array();
        $importedData["items"] = $itemNoArr;
        $importedData["importingQCObj"] = $qcSchedule;
        return $importedData;
    }

    private function getImportedUpdatedData($data)
    {
        $qcSchedule = new QCSchedule();
        $userMgr = UserMgr::getInstance();
        $classCodeMgr = ClassCodeMgr::getInstance();
        $messages = array();
        $startingIndex = 0;
        $id = $data[$startingIndex++];
        $qc = $data[$startingIndex++];
        $qc = strtoupper(trim($qc));
        $qcUserSeq = self::$qcUserCodeSeqArr[$qc];
        $poincharge = $data[$startingIndex++];
        $poinchargeUserSeq = 0;
        if(!empty($poincharge)){
            $poinchargeUserSeq = self::$poInchargeUserCodeSeqArr[strtoupper($poincharge)];
        }
        if(!empty($id)){
            $qcSchedule->setSeq($id);
        }
        if(empty($id)){
            if(empty($qc)){
                //$messages[] = "QC - $qc can not be empty for insert case,\t";
            }else{
                if($qcUserSeq == null){
                    $messages[] = "QC - $qc does not exist,\t";
                }else{
                    $qcSchedule->setQC($qc);
                    $qcSchedule->setQCUser($qcUserSeq);
                }
            }
            if(!empty($poincharge)){
                if($poinchargeUserSeq == null){
                    $messages[] = "PoIncharge - $poincharge does not exist";
                }else{
                    $qcSchedule->setPOInchargeUser($poinchargeUserSeq);
                }
            }
        }else{
            if(!empty($qc)){
                if($qcUserSeq == null){
                    $messages[] = "QC - $qc does not exist,\t";
                }else{
                    $qcSchedule->setQC($qc);
                    $qcSchedule->setQCUser($qcUserSeq);
                }
            }
            if(!empty($poincharge)){
                if($poinchargeUserSeq == null){
                    $messages[] = "PoIncharge - $poincharge does not exist";
                }else{
                    $qcSchedule->setPOInchargeUser($poinchargeUserSeq);
                }
            }
        }
        $classCode = $data[$startingIndex++];
        $po = $data[$startingIndex++];
        $poType = $data[$startingIndex++];
        $itemNo = $data[$startingIndex++];
        $itemNoArr = array();
        if (! empty($itemNo)) {
            $itemNoArr = $this->getItemNoArr($itemNo);
        }
        $shipDateStr = $data[$startingIndex++];
        $latestShipDateStr = $data[$startingIndex++];
        $readyDate = $data[$startingIndex++];
        $finalInspectionDate = $data[$startingIndex++];
        $middleInspectionDate = $data[$startingIndex++];
        $firstInspectionDate = $data[$startingIndex++];
        $productionStartDate = $data[$startingIndex++];
        $graphicReceiveDate = $data[$startingIndex++];

        $ap_readyDate = $data[$startingIndex++];
        $ap_finalInspectionDate = $data[$startingIndex++];
        $ap_middleInspectionDate = $data[$startingIndex++];
        $ap_firstInpectionDate = $data[$startingIndex++];
        $ap_productionStartDate = $data[$startingIndex++];
        $ap_graphicDateReceive = $data[$startingIndex++];
        
        $ap_firstInspectionNaReason = $data[$startingIndex++];
        $ap_middleInspectionNaReason = $data[$startingIndex++];
        $ap_graphicDateNaReason = $data[$startingIndex++];
        
        $ac_readyDate = $data[$startingIndex++];
        $ac_finalInspectionDate = $data[$startingIndex++];
        $ac_middleInspectionDate = $data[$startingIndex++];
        $ac_firstInpectionDate = $data[$startingIndex++];
        $ac_productionStartDate = $data[$startingIndex++];
        $ac_graphicDateReceive = $data[$startingIndex++];
        
        $ac_firstInspectionNotes = $data[$startingIndex++];
        $ac_middleInspectionNotes = $data[$startingIndex++];
        $ac_finalInspectionNotes = $data[$startingIndex++];
        
        //$note = $data[++$startingIndex + 1];
        //$startingIndex = $startingIndex + 2;//actual dates are in third block
        $finalStatus = $data[$startingIndex++];
        $isCompleted = $data[++$startingIndex];
        $this->dataTypeErrors = "";
        
        
        if (! empty($classCode)) {
            $classCodeObj = $classCodeMgr->findByClassCode($classCode);
            $classCodeSeq = 0;
            if (! empty($classCodeObj)) {
                $classCodeSeq = $classCodeObj->getSeq();
            } else {
                $messages[] = " '$classCode' class code not found in database!";
            }
            $qcSchedule->setClassCodeSeq($classCodeSeq);
        }

        if (! empty($po)) {
            $qcSchedule->setPO($po);
        }
        if (! empty($poType)) {
            $qcSchedule->setPOType($poType);
        }
        if (! empty($itemNo)) {
            $qcSchedule->setItemNumbers($itemNo);
        }
  
        if (! empty($shipDateStr)) {
            $shipDate = $this->ConvertToDate($shipDateStr,"m/d/y");
            if(!$shipDate){
                $messages[] = " Invalid Ship date";
            }else{
                $qcSchedule->setShipDate($shipDate);
                if(!$shipDate){

                }
                $currentTime = new DateTime();
                $currentTime->setTime(0,0);
                $shipDate->setTime(0,0);
                if($shipDate < $currentTime){
                    //throw new Exception(StringConstants::SHIP_DATE_IS_IN_PAST);
                }
                $readyDate = clone $shipDate;
                $readyDate->modify('-14 day');
                $qcSchedule->setSCReadyDate($readyDate);
                
                $finalInspectionDate = clone $shipDate;
                $finalInspectionDate->modify('-10 day');
                $qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
                
                $middleInspectionDate = clone $shipDate;
                $middleInspectionDate->modify('-15 day');
                $qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
                
                $firstInspectionDate = clone $shipDate;
                $firstInspectionDate->modify('-35 day');
                $qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
                
                $productionStartDate = clone $shipDate;
                $productionStartDate->modify('-45 day');
                $qcSchedule->setSCProductionStartDate($productionStartDate);
                
                $graphicReceiveDate = clone $shipDate;
                $graphicReceiveDate->modify('-30 day');
                $qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
            }
        }else{
            //$messages[] = "Ship Date - $shipDateStr can not be empty";
        }   
        if (! empty($latestShipDateStr)) {
        	$latestShipDate = $this->ConvertToDate($latestShipDateStr,"m/d/y");
            if(!$latestShipDate){
                $messages[] = " Invalid Latest Ship Date";
            }else{
                $qcSchedule->setLatestShipDate($latestShipDate);
            }
        }
        
        if (! empty($ap_readyDate)) {
            $ap_readyDate = $this->convertStrToDate($ap_readyDate);
            $qcSchedule->setAPReadyDate($ap_readyDate);
        }
        if (! empty($ap_finalInspectionDate)) {
            $ap_finalInspectionDate = $this->convertStrToDate($ap_finalInspectionDate);
            $qcSchedule->setAPFinalInspectionDate($ap_finalInspectionDate);
        }
        if (! empty($ap_middleInspectionDate)){
           $ap_middleInspectionDate = $this->convertStrToDate($ap_middleInspectionDate);
           $qcSchedule->setAPMiddleInspectionDate($ap_middleInspectionDate);
        }
        if (! empty($ap_firstInpectionDate)) {
           $ap_firstInpectionDate = $this->convertStrToDate($ap_firstInpectionDate);
           $qcSchedule->setAPFirstInspectionDate($ap_firstInpectionDate);
        }
        if (! empty($ap_productionStartDate)) {
            $ap_productionStartDate = $this->convertStrToDate($ap_productionStartDate);
            $qcSchedule->setAPProductionStartDate($ap_productionStartDate);
        }
        if (! empty($ap_graphicDateReceive)) {
            $ap_graphicDateReceive = $this->convertStrToDate($ap_graphicDateReceive);
            $qcSchedule->setAPGraphicsReceiveDate($ap_graphicDateReceive);
        }
        if (! empty($ap_firstInspectionNaReason)) {
            $qcSchedule->setApFirstInspectionDateNaReason($ap_firstInspectionNaReason);
        }
        if (! empty($ap_middleInspectionNaReason)) {
            $qcSchedule->setApMiddleInspectionDateNaReason($ap_middleInspectionNaReason);
        }
        if (! empty($ap_graphicDateNaReason)) {
            $qcSchedule->setAPGraphicsReceiveDateNAReason($ap_graphicDateNaReason);
        }
        
        if (! empty($ac_readyDate)) {
            $ac_readyDate = $this->convertStrToDate($ac_readyDate);
            $qcSchedule->setACReadyDate($ac_readyDate);
        }
        if (! empty($ac_finalInspectionDate)) {
            $ac_finalInspectionDate = $this->convertStrToDate($ac_finalInspectionDate);
            $qcSchedule->setACFinalInspectionDate($ac_finalInspectionDate);
        }
        if (! empty($ac_middleInspectionDate)){
//             if(is_string($ac_middleInspectionDate)){
//                 $ac_middleInspectionDate = strtolower(str_replace(" ", "", $ac_middleInspectionDate));
//             }
//             if($ac_middleInspectionDate != "n/a"){
                $ac_middleInspectionDate = $this->convertStrToDate($ac_middleInspectionDate);
                $qcSchedule->setACMiddleInspectionDate($ac_middleInspectionDate);
            //}else{
                //$qcSchedule->setApMiddleInspectionDateNaReason(ReasonCodeType::getName(ReasonCodeType::small_quantities));
           // }
        }
        if (! empty($ac_firstInpectionDate)) {
//             if(is_string($ac_firstInpectionDate)){
//                 $ac_firstInpectionDate = strtolower(str_replace(" ", "", $ac_firstInpectionDate));
//             }
//             if($ac_firstInpectionDate != "n/a"){
                $ac_firstInpectionDate = $this->convertStrToDate($ac_firstInpectionDate);
                $qcSchedule->setACFirstInspectionDate($ac_firstInpectionDate);
            //}else{
                //$qcSchedule->setApFirstInspectionDateNaReason(ReasonCodeType::getName(ReasonCodeType::small_quantities));
            //}
        }
        if (! empty($ac_productionStartDate)) {
            $ac_productionStartDate = $this->convertStrToDate($ac_productionStartDate);
            $qcSchedule->setACProductionStartDate($ac_productionStartDate);
        }
        if (! empty($ac_graphicDateReceive)) {
            $ac_graphicDateReceive = $this->convertStrToDate($ac_graphicDateReceive);
            $qcSchedule->setACGraphicsReceiveDate($ac_graphicDateReceive);
        }

        if (! empty($ac_firstInspectionNotes)) {
            $qcSchedule->setAcFirstInspectionNotes($ac_firstInspectionNotes);
        }
        if (! empty($ac_middleInspectionNotes)) {
            $qcSchedule->setAcMiddleInspectionNotes($ac_middleInspectionNotes);
        }
        if (! empty($ac_finalInspectionNotes)) {
            $qcSchedule->setNotes($ac_finalInspectionNotes);
        }
        
        
        if (! empty($note)) {
            $qcSchedule->setNotes($note);
        }
        if (! empty($finalStatus)) {
            $qcSchedule->setStatus($finalStatus);
        }
        if(!empty($isCompleted) and strtolower($isCompleted) == "yes"){
            $qcSchedule->setIsCompleted("1");
        }else{
            $qcSchedule->setIsCompleted("0");
        }
        $qcSchedule->setCreatedOn(DateUtil::getCurrentDate());
        $qcSchedule->setLastModifiedOn(DateUtil::getCurrentDate());
        if(!empty($messages)){
            throw new Exception(implode(",",$messages));
        }
        $importedData = array();
        $importedData["items"] = $itemNoArr;
        $importedData["importingQCObj"] = $qcSchedule;
        return $importedData;
    }

    /**
     * Method to convert data into BusinessObjects for QcSchedule
     * @param string[] $data 
     * @param string[] $labels
     * @param array[] $qcUserCodeSeqArr 
     * @param bool $isUpdateShipDateAndScheduleDates
     * @param bool $isUpdateLatestShipDate
     * @param bool $isCompletionStatus
     * @param bool $isUpdatePONumber
     * @param bool $isUpdatePOTypes
     * @param bool $isUpdateClassCode
     * @param bool $isUpdateQC
     * @param bool $isUpdateFirstInspectionDate
     * @param bool $isUpdatePoInchargeUser
     */
    private function getUpdatingData(
                        $data,
                        $labels,
                        $isUpdateShipDateAndScheduleDates = false,
                        $isUpdateLatestShipDate           = false,
                        $isCompletionStatus               = false,
                        $isUpdatePONumber                 = false,
                        $isUpdatePOTypes                  = false,
                        $isUpdateClassCode                = false,
                        $isUpdateQC                       = false,
                        $isUpdateFirstInspectionDate      = false,
                        $isUpdatePoInchargeUser           = false
                    )
    {
        $messages = array();
        $seq = $data[array_search("ID",$labels)];
        $seq = trim($seq);
        $qcSchedule = new QCSchedule();

        if($isCompletionStatus){
            if(strtolower($data[array_search("Completed",$labels)]) == "yes"){
                $isCompleted = "1";
            }else{
                $isCompleted = "0";
            }
            $qcSchedule->setIsCompleted($isCompleted);
        }else if($isUpdateClassCode){
            try{
                $classCodeName        = $data[array_search('Class Code', $labels)];
                $classCodeMgr         = ClassCodeMgr::getInstance();
                $classCode            = $classCodeMgr->findByClassCode($classCodeName);
                if($classCode == null){
                    throw new Exception("$classCodeName Classcode does not exist");
                }
                $qcSchedule->setClassCodeSeq($classCode->getSeq());
            }catch(Exception $e){
                $messages[] = $e->getMessage();
            }
        }else if($isUpdateQC){
            try{
                $qc = $data[array_search('QC', $labels)];
                $qcuser =   self::$qcUserCodeSeqArr[$qc];
                if($qcuser == null){
                    throw new Exception("QC - $qc does not Exist");
                    
                }
                $qcSchedule->setQC($qc);
                $qcSchedule->setQCUser($qcuser);
            }catch(Exception $e){
                $messages[] = $e->getMessage();
            }
        }else if($isUpdatePOTypes){
            if(in_array("PO Type",$labels)){
                $poType = $data[array_search("PO Type",$labels)];
            }else{
                $poType = $data[array_search("PO TYPE",$labels)];
            }
            $qcSchedule->setPoType($poType);
        }else if($isUpdatePONumber){
            $poNumber = $data[array_search("PO#",$labels)];
            $qcSchedule->setPO($poNumber);
        }else if($isUpdateShipDateAndScheduleDates){
            $shipDateStr = $data[array_search('Ship Date', $labels)];
            if (! empty($shipDateStr)) {
                $shipDate = $this->ConvertToDate($shipDateStr,"m/d/y");
                if(!$shipDate){
                    $messages[] = "Invalid Ship date";
                }else{
                    $qcSchedule->setShipDate($shipDate);
                    $currentTime = new DateTime();
                    $currentTime->setTime(0,0);
                    $readyDate = clone $shipDate;
                    $readyDate->modify('-14 day');
                    $qcSchedule->setSCReadyDate($readyDate);
                    $finalInspectionDate = clone $shipDate;
                    $finalInspectionDate->modify('-10 day');
                    $qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
                    $middleInspectionDate = clone $shipDate;
                    $middleInspectionDate->modify('-15 day');
                    $qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
                    $firstInspectionDate = clone $shipDate;
                    $firstInspectionDate->modify('-35 day');
                    $qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
                    $productionStartDate = clone $shipDate;
                    $productionStartDate->modify('-45 day');
                    $qcSchedule->setSCProductionStartDate($productionStartDate);
                    $graphicReceiveDate = clone $shipDate;
                    $graphicReceiveDate->modify('-30 day');
                    $qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
                }
            }
        }else if($isUpdateLatestShipDate){
            $latestShipDateStr     = $data[array_search('Latest Ship Date',$labels)];
            if(!empty($latestShipDateStr)){
                $latestshipdate = $this->ConvertToDate($latestShipDateStr,"m/d/y");
                if($latestshipdate){
                    $qcSchedule->setLatestShipDate($latestshipdate);
                }else{
                    $messages[] = " Invalid Latest Ship Date";
                }
            }
        }else if($isUpdateFirstInspectionDate){
            try{
                $scFirstInspectionDateStr = $data[array_search("First \nInspection Date", $labels)];
                $scFirstInspectionDate = $this->ConvertToDate($scFirstInspectionDateStr,"m/d/y");
                if(!$scFirstInspectionDateStr){
                    throw new Exception("Sc First Inspection Date $scFirstInspectionDateStr is invalid");
                }
                $qcSchedule->setSCFirstInspectionDate($scFirstInspectionDate);
            }catch(Exception $e){
                $messages[] = $e->getMessage();
            }
        }else if($isUpdatePoInchargeUser){
            try{
                $poincharge = $data[array_search('PoIncharge', $labels)];
                $poinchargeuser =   self::$poInchargeUserCodeSeqArr[$poincharge];
                if($poinchargeuser == null){
                    throw new Exception("POInchage $poincharge does not Exist");
                }
                $qcSchedule->setPoInchargeUser($poinchargeuser);
            }catch(Exception $e){
                $messages[] = $e->getMessage();
            }
        }
        if(empty($seq)){
            $messages[] = "ID is invalid,";
        }
        $qcSchedule->setLastModifiedOn(DateUtil::getCurrentDate());
        $qcSchedule->setSeq($seq);
        if(!empty($messages)){
            throw new Exception(implode(",",$messages));
        }
        return $qcSchedule;
    }
    private function convertStrToDate($date)
    {   
        if(is_string($date)){
            return null;
        }
        $date = PHPExcel_Shared_Date::ExcelToPHPObject($date);
        return $date;
    }
    private function convertStrToDateTime($dateStr,$format){
        $date = DateTime::createFromFormat($format, $dateStr);
        return $date;
    }
    private function validateDate($date, $format){
        // if(is_string($date)){
        $d = DateTime::createFromFormat($format, $date);
        if($d == false){
            $d = PHPExcel_Shared_Date::ExcelToPHPObject($date);
            return true;
        }else{
        // if(intval($d->format("m")) < 10)
        // {
        //     $c = "0" . $date;
        //     if(intval($d->format("d")) < 10)
        //     {
        //         $c = substr($c,0,3) . "0" . substr($c,3);
        //     }
        //     return $d && $d->format($format) === $c;
        // }
        
        return $d->format("n/j/y") == $date;
        }// }else{
        //     try{
        //         $d = PHPExcel_Shared_Date::ExcelToPHPObject($date);
        //         return true;
        //     }catch(Exception $e){
        //         return false;
        //     }
        // }
    }
        private function ConvertToDate($date,$format){
            if(is_string($date)){
                $dateAfterConversion = DateTime::createFromFormat($format, $date);
                return $dateAfterConversion;
            }
            $dateAfterConversion = PHPExcel_Shared_Date::ExcelToPHPObject($date);
            return $dateAfterConversion;
        }
    
}
