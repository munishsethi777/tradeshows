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
    require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualLogStatus.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
    require_once($ConstantsArray['dbServerUrl'] . "Managers/ReportingDataMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/ReportingDataParameterType.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/BeanReturnDataType.php");
    
    $success=1;
    $message='';
    $call = "";
    $response = new ArrayObject();
    $instructionManualLogMgr = InstructionManualLogsMgr::getInstance();
    $instructionManualCustomersMgr = InstructionManualCustomersMgr::getInstance();
    $instructionManualRequestsMgr = InstructionManualRequestsMgr::getInstance();
    $reportingDataMgr = ReportingDataMgr::getInstance();
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
            $instructionManualLogSeq = $instructionManualLog->getSeq();
            $itemAlreadyExistsCount = $instructionManualLogMgr->findByItemNo($instructionManualLog->getItemNumber(),
                                        $instructionManualLogSeq);
            if($itemAlreadyExistsCount>0 && $instructionManualLog->getIsCompleted() != true){
                throw new Exception("Item number '".$instructionManualLog->getItemNumber()."' already exists");
            }
            $instructionManualLog->setCreatedDate(new DateTime());
            $instructionManualLog->setLastModifiedOn(new DateTime());
            if(isset($_REQUEST['iscompleted'])){
                $instructionManualLog->setIsCompleted(1);
            }else{
                $instructionManualLog->setIsCompleted(0);
            }
            if(isset($_REQUEST['isprivatelabel'])){
                $instructionManualLog->setIsPrivateLabel(1);
            }else{
                $instructionManualLog->setIsPrivateLabel(0);
            }
            $seq = 0;
            $existingInstructionManualLog = null;
            $isDiagramSavedDateUpdated = true;
            $isNotesToUsaUpdated = true;
            $isStatusChange = true;
            if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
                $seq = $_REQUEST['seq'];
                $message = StringConstants::INSTRUCTION_MANUAL_LOG_UPDATED_SUCCESSFULLY;
                $existingInstructionManualLog = $instructionManualLogMgr->findBySeq($instructionManualLog->getSeq());
                if(!empty($instructionManualLog->getDiagramSavedDate())){
                    $newDiagramSavedDate = $instructionManualLog->getDiagramSavedDate()->format("m-d-Y");
                    $isDiagramSavedDateUpdated = $newDiagramSavedDate != $existingInstructionManualLog->getDiagramSavedDate();    
                }else{
                    $isDiagramSavedDateUpdated = $newDiagramSavedDate != $existingInstructionManualLog->getDiagramSavedDate();
                }
                $isNotesToUsaUpdated = $instructionManualLog->getNotesToUsa() != $existingInstructionManualLog->getNotesToUsa();
                $isStatusChange = $instructionManualLog->getInstructionManualLogStatus() != $existingInstructionManualLog->getInstructionManualLogStatus();
            }else{// new case
               if($instructionManualLog->getInstructionManualLogStatus() == InstructionManualLogStatus::getName(InstructionManualLogStatus::in_progress)){
                    $instructionManualLog->setSentToChinaDate(null);
                }elseif($instructionManualLog->getInstructionManualLogStatus() == InstructionManualLogStatus::getName(InstructionManualLogStatus::sent_to_china)){
                    $instructionManualLog->setStartedDate(null);
                }else{
                    $instructionManualLog->setStartedDate(null);
                    $instructionManualLog->setSentToChinaDate(null);
                }
                if(empty($instructionManualLog->getDiagramSavedDate())){
                    $isDiagramSavedDateUpdated = false;
                }

            }

            $id = $instructionManualLogMgr->save($instructionManualLog);
            if($id>0){
                $instructionManualCustomersMgr->deleteByInstructionManualSeq($id);
                if($_REQUEST['usacustomers'] != ''){
                    foreach($_REQUEST['usacustomers'] as $usaCustomer){
                        $instructionManualCustomers->setInstructionManualSeq($id);
                        $instructionManualCustomers->setCustomerName($usaCustomer);
                        $instructionManualCustomersMgr->save($instructionManualCustomers);
                    }
                }
                $instructionManualRequestsMgr->deleteByInstructionManualSeq($id);
                if($_REQUEST['requestedchanges'] != ''){
                    foreach($_REQUEST['requestedchanges'] as $requestedChange){
                        $instructionManualRequests->setInstructionManualSeq($id);
                        $instructionManualRequests->setRequestType($requestedChange); 
                        $instructionManualRequestsMgr->save($instructionManualRequests);
                    }
                }
                if($isDiagramSavedDateUpdated){
                    InstructionManualLogReportUtil::sendInstructionManualDiagramSavedDateUpdatedNotification($instructionManualLog);
                }
                if($isNotesToUsaUpdated){
                    InstructionManualLogReportUtil::sendInstructionManualNotesToUsaUpdatedNotification($instructionManualLog,"USA");
                }
                if($isStatusChange){
                    $diagramSavedBySeq = $instructionManualLog->getDiagramSavedByUserSeq();
                    $createdBySeq = $instructionManualLog->getCreatedBy();
                    if($instructionManualLog->getInstructionManualLogStatus() == 
                        InstructionManualLogStatus::getName(InstructionManualLogStatus::awaiting_information_from_china)
                        && $diagramSavedBySeq != null){
                        InstructionManualLogReportUtil::sendInstructionManualLogStatusUpdatedNotification($instructionManualLog,$diagramSavedBySeq);
                    }
                    if($instructionManualLog->getInstructionManualLogStatus() == 
                        InstructionManualLogStatus::getName(InstructionManualLogStatus::awaiting_information_form_buyers)
                        && $createdBySeq != null){   
                        InstructionManualLogReportUtil::sendInstructionManualLogStatusUpdatedNotification($instructionManualLog,$createdBySeq);
                    } 
                }
            }
        }catch(Exception $e){
            $success = 0;
		    $message  = $e->getMessage();
        }
    }
    if($call == 'getAllInstructionManualLogs'){
        $instructionManualLogsJson = $instructionManualLogMgr->getAllLogs(BeanReturnDataType::grid);
        echo json_encode($instructionManualLogsJson);
        return;
    }
    if($call == 'getProjectsDueLessThan14DaysFromEntryForGrid'){
        $projectsDueLess14DaysThanFromEntry = $instructionManualLogMgr->getAllDueLessThan14DaysFromEntryLogs(BeanReturnDataType::grid);
        echo json_encode($projectsDueLess14DaysThanFromEntry);
        return;
    }
    if($call == 'getProjectsOverdueForGrid'){
        $projectsOverdue = $instructionManualLogMgr->getAllOverDueLogs(BeanReturnDataType::grid);
        echo json_encode($projectsOverdue);
        return;
    }
    if($call == 'find'){
    }
    if($call == "getloggedInUserTime"){
        $sessionUtil = SessionUtil::getInstance();
        $timeZone = $sessionUtil->getUserLoggedInTimeZone();
        $date = DateUtil::getCurrentDateStrWithTimeZone($timeZone);
        echo json_encode($date);
        return;
    }
    if($call == "export"){
        try{
            $queryString = $_GET["queryStringForInstructionManualLog"];
            $qcscheduleSeqs = $_GET["instructionmanuallogseq"];
            $filterId = $_GET["filterId"];
            $instructionManualLogMgr->exportInstructionManuals($queryString,$qcscheduleSeqs,$filterId);
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    if($call == "exportFilterData"){
        try{
            $filterId = $_POST['filterId'];
            $IMExportLogsAndFileName = $instructionManualLogMgr->exportFilterData($filterId);
            // if($IMExportLogsAndFileName['instructionManualLogs']){
                PHPExcelUtil::exportInstructionManuals($IMExportLogsAndFileName['instructionManualLogs'],$IMExportLogsAndFileName['fileName']);
            // }
            return;
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    if($call == "deleteInstructionManualLog"){
        $ids = $_GET["ids"];
        try{
            $flag = $instructionManualLogMgr->deleteBySeqs($ids);
            $message = "Deleted Successfully";
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    if($call == "showFilterGraph"){
        try{
            $graphIconId = $_GET['graphIconId'];
            $reportingParameter = str_replace("_show_graph","",$graphIconId);
            $filterGraphData = $reportingDataMgr->getReportingDataForJsCharts($reportingParameter);
            $graphTitle = ReportingDataParameterType::getValue($reportingParameter);
            $response['data'] = $filterGraphData;
            $response['data']['graphTitle'] = $graphTitle;
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);
?>
