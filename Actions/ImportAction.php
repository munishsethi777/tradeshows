<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/InstructionManualLogsMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/InstructionManualLogs.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/InstructionManualCustomersMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/InstructionManualCustomers.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/InstructionManualRequestsMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/InstructionManualRequests.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/InstructionManualLogReportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualLogStatus.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
require_once($ConstantsArray['dbServerUrl'] ."Utils/PHPExcelUtils.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ClassCodeMgr.php");


$success=1;
$message='';
$call = "importimlogs";
$response = new ArrayObject();
$instructionManualLogMgr = InstructionManualLogsMgr::getInstance();
$instructionManualCustomersMgr = InstructionManualCustomersMgr::getInstance();
$instructionManualRequestsMgr = InstructionManualRequestsMgr::getInstance();
$userMgr = UserMgr::getInstance();
$classCodeMgr = ClassCodeMgr::getInstance();
$arr = array();

$userFullNameToSeqArr = array();
$users = $userMgr->getAllUsers();
foreach($users as $user){
    $userFullNameToSeqArr[$user->getFullName()] = $user->getSeq();
}

$classCodes = $classCodeMgr->findAll();
$classCodesToSeqArr = array();
foreach($classCodes as $classCode){
    $classCodesToSeqArr[$classCode->getClassCode()] = $classCode->getSeq();
}
if($call == "importimlogs"){
    try{
        $inputFileName = "/Applications/MAMP/htdocs/IM Upload as of 12242020.csv";
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($inputFileName);
        $sheet = $objPHPExcel->getActiveSheet();
        $maxCell = $sheet->getHighestRowAndColumn();
        $sheetData = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],null,true,false,false);
        
        //DataValidation
        $enteredByErrorMessages = array();
        $classCodeErrorMessages = array();
        try{
            for($i=1;$i<=$maxCell["row"];$i++){
                $data = $sheetData[$i];
                $enteredBy = trim($data[1]);
                $classCode = trim($data[5]);
                $assignee = trim($data[14]);
                if(!empty($enteredBy)){
                    if(empty($userFullNameToSeqArr[$enteredBy])){
                        $enteredByErrorMessages[$enteredBy] = $enteredBy;
                    }
                }
                if(!empty($classCode)){
                    if(empty($classCodesToSeqArr[$classCode])){
                        $classCodeErrorMessages[$classCode] = $classCode;
                    }
                }
                if(!empty($assignee)){
                    if(empty($userFullNameToSeqArr[$assignee])){
                        $enteredByErrorMessages[$assignee] = $assignee;
                    }
                }
                
            }
        }catch(Exception $e){
            
        }
        if(count($enteredByErrorMessages) > 0 
            || count($classCodeErrorMessages) > 0){
            var_dump($enteredByErrorMessages);
            var_dump($classCodeErrorMessages);
            die;
        }
        try {
            for($i=1;$i<=$maxCell["row"];$i++){
                $data = $sheetData[$i];
                $entryDate = $data[0];
                $enteredBy = trim($data[1]);
                $poShipDate  = $data[2];
                //$approvedManualDueDate = $data[3]; --- Calculated date following
                $itemNumber = $data[4];
                $classCode = trim($data[5]);
                //$dueDateDiagram = $data[6]; --- Calculated date following
                $newOrRevised = $data[7];
                $imType = $data[8];
                $customer = $data[9];
                $requestedChanges = $data[10];
                $diagramSavedBy = $data[11];
                $diagramSavedDate = $data[12];
                $assignee = trim($data[14]);
                
                $instructionManualLog = new InstructionManualLogs();
                $entryDateObj = DateUtil::StringToDateByGivenFormat("m/d/y", $entryDate);
                if($entryDateObj){
                    $instructionManualLog->setEntryDate($entryDateObj);
                    $diagramDueDateObj = clone $entryDateObj; 
                    $diagramDueDateObj = $diagramDueDateObj->add(new DateInterval('P14D'));
                    $instructionManualLog->setGraphicDueDate($diagramDueDateObj);
                }
                $enteredBySeq = $userFullNameToSeqArr[trim($enteredBy)];
                if(!empty($enteredBySeq)){
                    $instructionManualLog->setCreatedBy($enteredBySeq);
                }
                $poShipDateObj = DateUtil::StringToDateByGivenFormat("m/d/y", $poShipDate);
                if($poShipDateObj){
                    $instructionManualLog->setPoShipDate($poShipDateObj);
                    $approvedManuaDueDate = clone $poShipDateObj;
                    $approvedManuaDueDate = $approvedManuaDueDate->sub(new DateInterval('P21D'));
                    $instructionManualLog->setApprovedManualDuePrintDate($approvedManuaDueDate);
                }
                $instructionManualLog->setItemNumber($itemNumber);
                $classCodeSeq = $classCodesToSeqArr[$classCode];
                if(!empty($classCodeSeq)){
                    $instructionManualLog->setClassCodeSeq($classCodeSeq);
                }
                
                if(!empty($newOrRevised)){
                    $newOrRevisedVar = null;
                    if(strtoupper($newOrRevised) == "NEW"){
                        $newOrRevisedVar = "newInstructionManual";
                    }elseif(strtoupper($newOrRevised) == "REVISED"){
                        $newOrRevisedVar = "revisedInstructionManual";
                    }elseif(strtoupper($newOrRevised) == "REVISED -INTERNATIONAL"){
                        $newOrRevisedVar = "revisedInternationInstructionManual";
                    }elseif(strtoupper($newOrRevised) == "New -INTERNATIONAL"){
                        $newOrRevisedVar = "newInternationInstructionManual";
                    }
                    $instructionManualLog->setNewOrRevised($newOrRevisedVar);
                }
                
                if(!empty($imType)){
                    $imTypeVar = null;
                    if(strtoupper($imType)=="FOLD"){
                        $imTypeVar = "fold";
                    }elseif(strtoupper($imType)=="BOOKLET"){
                        $imTypeVar = "booklet";
                    }
                    $instructionManualLog->setInstructionManualType($imTypeVar);
                }
                
                $diagramSavedDateObj = DateUtil::StringToDateByGivenFormat("m/d/y", $diagramSavedDate);
                if($diagramSavedDateObj){
                    $instructionManualLog->setDiagramSavedDate($diagramSavedDateObj);
                }
                $instructionManualLog->setNotesToUsa($requestedChanges);
                $assignedToUser = $userFullNameToSeqArr[$assignee];
                $instructionManualLog->setAssignedToUser($assignedToUser);
                $instructionManualLog->setCreatedDate(new DateTime());
                $instructionManualLog->setLastModifiedOn(new DateTime());
                $instructionManualLog->setIsPrivateLabel(0);
                $instructionManualLog->setIsCompleted(0);
                $instructionManualLogMgr->save($instructionManualLog);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
    echo $message;
}