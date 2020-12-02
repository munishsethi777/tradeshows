<?php 
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] . "Managers/InstructionManualLogsMgr.php");
    require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/InstructionManualLogs.php");
    require_once($ConstantsArray['dbServerUrl'] . "Managers/InstructionManualCustomersMgr.php");
    require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/InstructionManualCustomers.php");
    require_once($ConstantsArray['dbServerUrl'] . "Managers/InstructionManualRequestsMgr.php");
    require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/InstructionManualRequests.php");
    require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");    
    require_once($ConstantsArray['dbServerUrl'] ."Utils/InstructionManualLogReportUtil.php");
    
    $success=1;
    $message='';
    $call = "";
    $response = new ArrayObject();
    $instructionManualLogMgr = InstructionManualLogsMgr::getInstance();
    $instructionManualCustomersMgr = InstructionManualCustomersMgr::getInstance();
    $instructionManualRequestsMgr = InstructionManualRequestsMgr::getInstance();

    $arr = array();  
    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call == 'saveInstructionManualLog'){
        try{
            $message = StringConstants :: INSTRUCTION_MANUAL_LOG_SAVED_SUCCESSFULLY;
            $instructionManualLog = new InstructionManualLogs();
            $instructionManualCustomers = new InstructionManualCustomers();
            $instructionManualRequests = new InstructionManualRequests();
            $instructionManualLog->createFromRequest($_REQUEST);
            $instructionManualLog->setCreatedDate(new DateTime());
            $instructionManualLog->setLastModifiedDate(new DateTime());
            if(isset($_REQUEST['iscompleted'])){
                $instructionManualLog->setIsCompleted(1);
            }else{
                $instructionManualLog->setIsCompleted(0);
            }
            $seq = 0;
            $existingInstructionManualLog = null;
            $isDiagramSavedDateUpdated = false;
            $isNotesToUsaUpdated = false;
            if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
                $seq = $_REQUEST['seq'];
                $message = StringConstants::INSTRUCTION_MANUAL_LOG_UPDATED_SUCCESSFULLY;
                $existingInstructionManualLog = $instructionManualLogMgr->findBySeq($instructionManualLog->getSeq());
                if(!empty($instructionManualLog->getDiagramSavedDate())){
                    $newDiagramSavedDate = $instructionManualLog->getDiagramSavedDate()->format("m-d-Y");
                    $isDiagramSavedDateUpdated = $newDiagramSavedDate != $existingInstructionManualLog->getDiagramSavedDate();    
                }
                $isNotesToUsaUpdated = $instructionManualLog->getNotesToUsa() != $existingInstructionManualLog->getNotesToUsa();
            }

            $id = $instructionManualLogMgr->save($instructionManualLog);
            if($id>0){
                $instructionManualCustomersMgr->deleteByInstructionManualSeq($id);
                foreach($_REQUEST['usacustomers'] as $usaCustomer){
                    $instructionManualCustomers->setInstructionManualSeq($id);
                    $instructionManualCustomers->setCustomerName($usaCustomer);
                    $instructionManualCustomersMgr->save($instructionManualCustomers);
                }
                $instructionManualRequestsMgr->deleteByInstructionManualSeq($id);
                foreach($_REQUEST['requestedchanges'] as $requestedChange){
                    $instructionManualRequests->setInstructionManualSeq($id);
                    $instructionManualRequests->setRequestType($requestedChange); 
                    $instructionManualRequestsMgr->save($instructionManualRequests);
                }
                if($isDiagramSavedDateUpdated){
                    InstructionManualLogReportUtil::sendInstructionManualDiagramSavedDateUpdatedNotification($instructionManualLog);
                }
                if($isNotesToUsaUpdated){
                    InstructionManualLogReportUtil::sendInstructionManualNotesToUsaUpdatedNotification($instructionManualLog,"USA");
                }
            }
        }catch(Exception $e){
            $success = 0;
		    $message  = $e->getMessage();
        }
    }
    if($call == 'getAllInstructionManualLogs'){
            $instructionManualLogsJson = $instructionManualLogMgr->getInstructionManualLogsForGrid();
        echo json_encode($instructionManualLogsJson);
        return;
    }
    if($call == 'export'){
    }
    if($call == 'find'){
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);
?>
