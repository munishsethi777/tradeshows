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
    
    public function updateQCSchedules($file){
        $inputFileName = $file['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getActiveSheet();
        $maxCell = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
        try{
            return $this->validateAndUpdateFile($sheetData);
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
    
    
    public function validateAndSaveFile($sheetData, $isUpdate, $updateItemNos)
    {
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
    public function validateAndUpdateFile($sheetData){
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
                        $qcSchedule = $this->getUpdatingData($data,$labels);
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
            $qcscheduleMgr = QCScheduleMgr::getInstance();
            $response = $qcscheduleMgr->updateQCScheduleDates($qcScheduleArr);
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
        
        $startingIndex = 1;
        
        $qc = $data[$startingIndex++];
        $qc = strtoupper(trim($qc));
        $qcUserSeq = $qcUsers[$qc];
        $poincharge = $data[$startingIndex++];
        $poinchargeUserSeq = $poinchargeUsers[strtoupper(trim($poincharge))];
        
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
        $note = $data[$startingIndex++];
        $startingIndex = $startingIndex + 5;//actual dates are in third block
        $finalStatus = $data[$startingIndex++];

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
        		throw new Exception("'$poincharge' PO Incharge not found in database!");
        	}
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
                //throw new Exception(StringConstants::SHIP_DATE_IS_IN_PAST);
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
        if (! empty($latestShipDateStr)) {
        	$latestShipDate = $this->convertStrToDate($latestShipDateStr);
        	$qcSchedule->setLatestShipDate($latestShipDate);
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

    private function getUpdatingData($data,$labels)
    {
        $messages = array();
        $seq = $data[array_search("ID",$labels)];
        $seq = trim($seq);
        if(empty($seq)){
            $messages[] = "ID is invalid,";
        }
        $latestShipDateStr = $data[array_search('Latest Ship Date',$labels)];
        $shipDateStr = $data[array_search('Ship Date', $labels)];
        $qcSchedule = new QCSchedule();
        if(!empty($latestShipDateStr)){
        	$isValidDate = $this->convertStrToDate($latestShipDateStr);
            //$isValidDate = $this->validateDate($latestShipDateStr,"m/d/y");
            if(!$isValidDate){
                $messages[] = "Invalid Latest Ship date";
            }else{
                $latestshipdate = $this->convertStrToDate($latestShipDateStr);
                if($latestshipdate == null){
                    $latestshipdate = $this->convertStrToDateTime($latestShipDateStr,"m/d/y");
                }
                $qcSchedule->setLatestShipDate($latestshipdate);
                
            }
        }
        if (! empty($shipDateStr)) {
			$isValidDate = $this->validateDate($shipDateStr,"m/d/y");
            if(!$isValidDate){
                $messages[] = "Invalid Ship date";
            }else{
                $shipDate = $this->convertStrToDate($shipDateStr);
                if($shipDate == null){
                    $shipDate = $this->convertStrToDateTime($shipDateStr,"m/d/y");
                }
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
        }else{
            $messages[] = "Empty Ship Date Found";
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
        // }else{
        //     try{
        //         $d = PHPExcel_Shared_Date::ExcelToPHPObject($date);
        //         return true;
        //     }catch(Exception $e){
        //         return false;
        //     }
        // }
        
        
    }
}