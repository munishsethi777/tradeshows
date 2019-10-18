<?php
require_once $ConstantsArray['dbServerUrl'] . 'Managers/QCScheduleMgr.php';
require_once $ConstantsArray['dbServerUrl'] . 'Enums/ReasonCodeType.php';

class QCScheduleImportUtil
{
    private $fieldNames;
    private static $qcImportUtil;
    private $BULK_DELETE_COUNT = "100";
    private static $ACTUAL_FIELDS_NAMES = array(
        "qc",
        "classcode",
        "po#",
        "potype",
        "itemno",
        "shipdate",
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
        "Class Code",
        "PO#",
        "PO Type",
        "Item No",
        "Ship Date",
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
        return self::$qcImportUtil;
    }

    public function importQCSchedules($file, $isUpdate, $updateItemNos,$isCompleted)
    {
        $inputFileName = $file['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getActiveSheet();
        $maxCell = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
        try {
            if(empty($isCompleted)){
                return $this->validateAndSaveFile($sheetData, $isUpdate, $updateItemNos);
            }else{
                return $this->marksAsCompleted($sheetData);
            }
        } catch (Exception $e) {
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
    
    
    public function validateAndSaveFile($sheetData, $isUpdate, $updateItemNos)
    {
        $this->fieldNames = $sheetData[0];
        $itemNoAlreadyExists = 0;
        $success = 1;
        $messages = "";
        $this->validateFields();
        $qcScheudleArr = array();
        $sessionUtil = SessionUtil::getInstance();
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $rowAndItemNo = array();
        foreach ($sheetData as $key => $data) {
            if ($key == 0) {
                continue;
            }
            $row = $key+2;
            if (! array_filter($data)) {
                continue;
            }
            if ($isUpdate) {
                if (!isset($updateItemNos[$row])) {
                    continue;
                }
            }
            $imoptedData = array();
            try {
                $imoptedData = $this->getImportedData($data);
            } catch (Exception $e) {
                $messages .= "Error on row no $row - " . $e->getMessage() . "<br>";
                $success = 0;
            }
            if (empty($imoptedData)) {
                continue;
            }
            $qcschedule = $imoptedData["data"];
            $itemIdsArr = $imoptedData["items"];
            $itemNoArr = array();
            foreach ($itemIdsArr as $itemId) {
                if (empty($itemId)) {
                    continue;
                }
                $qc = clone $qcschedule;
                $qc->setItemNumbers($itemId);
                $qc->setUserSeq($userSeq);
                array_push($qcScheudleArr, $qc);
                array_push($itemNoArr, $itemId . $qc->getPO());
            }
            $rowAndItemNo[$row] = $itemNoArr;
        }
        $response = array();
        $response["message"] = $messages;
        $response["success"] = $success;
        $response["itemalreadyexists"] = $itemNoAlreadyExists;
        if (empty($messages)) {
            $qcscheduleMgr = QCScheduleMgr::getInstance();
            $response = $qcscheduleMgr->saveArr($qcScheudleArr, $isUpdate, $rowAndItemNo, $updateItemNos);
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
        $classCodeMgr = ClassCodeMgr::getInstance();
        $qc = $data[0];
        $qcUserSeq = $qcUsers[$qc];
        $classCode = $data[1];
        $po = $data[2];
        $poType = $data[3];
        $itemNo = $data[4];
        $itemNoArr = array();
        if (! empty($itemNo)) {
            $itemNoArr = $this->getItemNoArr($itemNo);
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
        $finalStatus = $data[19];

        $this->dataTypeErrors = "";

        $qcSchedule = new QCSchedule();

        if (! empty($qc)) {
            $qcSchedule->setQC($qc);
            $qcSchedule->setQCUser($qcUserSeq);
        }

        if (! empty($classCode)) {
            $classCodeObj = $classCodeMgr->findByClassCode($classCode);
            $classCodeSeq = 0;
            if (! empty($classCodeObj)) {
                $classCodeSeq = $classCodeObj->getSeq();
            } else {
                throw new Exception("'$classCode' class code not found in database!");
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
            $shipDate = $this->convertStrToDate($shipDateStr);
            $qcSchedule->setShipDate($shipDate);
            if(!$shipDate){
                throw new Exception("Invalid Ship date");
            }
            $currentTime = new DateTime();
            $currentTime->setTime(0,0);
            $shipDate->setTime(0,0);
            if($shipDate < $currentTime){
                throw new Exception(StringConstants::SHIP_DATE_IS_IN_PAST);
            }
            $readyDate = $this->convertStrToDate($shipDateStr);
            $readyDate->modify('-14 day');
            $qcSchedule->setSCReadyDate($readyDate);
            // $qcSchedule->setAPReadyDate($readyDate);

            $finalInspectionDate = $this->convertStrToDate($shipDateStr);
            $finalInspectionDate->modify('-10 day');
            $qcSchedule->setSCFinalInspectionDate($finalInspectionDate);
            // $qcSchedule->setAPFinalInspectionDate($finalInspectionDate);

            $middleInspectionDate = $this->convertStrToDate($shipDateStr);
            $middleInspectionDate->modify('-15 day');
            $qcSchedule->setSCMiddleInspectionDate($middleInspectionDate);
            // $qcSchedule->setAPMiddleInspectionDate($middleInspectionDate);

            $firstInspectionDate = $this->convertStrToDate($shipDateStr);
            $firstInspectionDate->modify('-35 day');
            $qcSchedule->setSCFirstInspectionDate($firstInspectionDate);
            // $qcSchedule->setAPFirstInspectionDate($firstInspectionDate);

            $productionStartDate = $this->convertStrToDate($shipDateStr);
            $productionStartDate->modify('-45 day');
            $qcSchedule->setSCProductionStartDate($productionStartDate);
            // $qcSchedule->setAPProductionStartDate($productionStartDate);

            $graphicReceiveDate = $this->convertStrToDate($shipDateStr);
            $graphicReceiveDate->modify('-30 day');
            $qcSchedule->setSCGraphicsReceiveDate($graphicReceiveDate);
            // $qcSchedule->setAPGraphicsReceiveDate($graphicReceiveDate);
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
        $qcSchedule->setCreatedOn(DateUtil::getCurrentDate());
        $qcSchedule->setLastModifiedOn(DateUtil::getCurrentDate());
        $importedData = array();
        $importedData["items"] = $itemNoArr;
        $importedData["data"] = $qcSchedule;
        return $importedData;
    }

    private function convertStrToDate($date)
    {   
        if(is_string($date)){
            return null;
        }
        $date = PHPExcel_Shared_Date::ExcelToPHPObject($date);
        return $date;
    }
}