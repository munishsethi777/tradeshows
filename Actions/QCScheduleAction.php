<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QcscheduleApprovalMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BeanReturnDataType.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/ReportingDataMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/QCScheduleRevision.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/QCScheduleRevisionMgr.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
/**
 * @var QCScheduleMgr $qcScheduleMgr
 */
$qcScheduleMgr = QCScheduleMgr::getInstance();
$qcScheduleRevisionMgr = QCScheduleRevisionMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
$reportingDataMgr = ReportingDataMgr::getInstance();
if($call == "saveQCSchedule"){
	try{
	    $seq = $_REQUEST["seq"];
	    $currentTime = new DateTime();
	    $currentTime->setTime(0,0);
		if(isset($_POST["isapproval"])){
			$acFinalInspectionDate = $_REQUEST["acfinalinspectiondate"];
			if(!empty($acFinalInspectionDate)){
				$acFinalInspectionDate = DateUtil::StringToDateByGivenFormat("m-d-Y", $acFinalInspectionDate);
				$acFinalInspectionDate->setTime(0,0);
				if($acFinalInspectionDate > $currentTime){
				    throw new Exception(StringConstants::ACTUAL_FINAL_INSPECTION_DATE_PAST_SUBMIT_APPROVAL);
				}
			}else{
			    throw new Exception(StringConstants::ACTUAL_FINAL_INSPECTION_DATE_REQUIRED_SUBMIT_APPROVAL);
			}
		}
		if(isset($_REQUEST["shipdate"]) && empty($seq)){
    		$shipDate = $_REQUEST["shipdate"];
    		$shipDate = DateUtil::StringToDateByGivenFormat("m-d-Y", $shipDate);
    		if($shipDate < $currentTime){
    		    throw new Exception(StringConstants::SHIP_DATE_IS_IN_PAST);
    		}
		}
		$message = StringConstants::QC_SCHEDULE_SAVED_SUCCESSFULLY;
		$itemNumbers = $_REQUEST["itemnumbers"];
		$itemNumbers = explode(",",$itemNumbers);
		$seq = $_REQUEST["seq"];
		$seqs = $_REQUEST["seqs"];
		$seqs = explode(",",$seqs);
		foreach (array_filter($itemNumbers) as $key=>$itemNumber){
			$seq = 0;
			$qcSchedule = new QCSchedule();
			if(isset($seqs[$key])){
				$seq  = $seqs[$key];
				if(!empty($seq)){
					$qcSchedule = $qcScheduleMgr->getBySeq($seq);
				}
			}
			$qcSchedule->createFromRequest($_REQUEST);
			$qcSchedule->setSeq($seq);
			$qcSchedule->setItemNumbers($itemNumber);
			if(!isset($_REQUEST["apMiddleInspectionChk"])){
				$qcSchedule->setApMiddleInspectionDateNaReason(null);
			}else{
				$qcSchedule->setAPMiddleInspectionDate(null);
			}
			if(!isset($_REQUEST["apFirstInspectionChk"])){
				$qcSchedule->setApFirstInspectionDateNaReason(null);
			}else{
				$qcSchedule->setAPFirstInspectionDate(null);
			}
			if(!isset($_REQUEST["apGraphicsReceiveChk"])){
				$qcSchedule->setAPGraphicsReceiveDateNAReason(null);
			}else{
				$qcSchedule->setAPGraphicsReceiveDate(null);
			}
			if(isset($_REQUEST["iscompleted"])){
			    $qcSchedule->setIsCompleted(1);    
			}else{
			    $qcSchedule->setIsCompleted(0);  
			}
			if($seq > 0){
			    $message = StringConstants::QC_SCHEDULE_UPDATE_SUCCESSFULLY;
			}
			//$qcSchedule->setSeq($seq);
			$qcSchedule->setUserSeq($sessionUtil->getUserLoggedInSeq());
			$qcSchedule->setCreatedOn(new DateTime());
			$qcSchedule->setLastModifiedOn(new DateTime());
			if($qcSchedule->getAcFirstInspectionNotes() == "<p><br></p>"){
			    $qcSchedule->setAcFirstInspectionNotes(NULL);
			}
			if($qcSchedule->getAcMiddleInspectionNotes() == "<p><br></p>"){
			    $qcSchedule->setAcMiddleInspectionNotes(NULL);
			}
			if($qcSchedule->getNotes() == "<p><br></p>"){
			    $qcSchedule->setNotes(NULL);
			}
			$id = $qcScheduleMgr->save($qcSchedule);
			if($id > 0){
				if(isset($_POST["isapproval"])){
					$qcSchedule->setSeq($id);
					$qcApprovalMgr = QcscheduleApprovalMgr::getInstance();
					$qcApprovalMgr->saveApprovalFromQCSchedule($qcSchedule);
				}
			}
		}
		
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "bulkUpdateQCSchedule"){
	try{
		$seq = $_REQUEST["seq"];
		$message = StringConstants::QC_SCHEDULE_SAVED_SUCCESSFULLY;
		
		if(count($_REQUEST["qcschedulescheck"]) == 0){
			throw new Exception("No QC Schedule selected to be updated.");
		}
		$qcSchedule = new QCSchedule();
		$qcSchedule->createFromRequest($_REQUEST);
		if(!isset($_REQUEST["apMiddleInspectionChk"])){
			$qcSchedule->setApMiddleInspectionDateNaReason(null);
		}else{
			$qcSchedule->setAPMiddleInspectionDate(null);
		}
		if(!isset($_REQUEST["apFirstInspectionChk"])){
			$qcSchedule->setApFirstInspectionDateNaReason(null);
		}else{
			$qcSchedule->setAPFirstInspectionDate(null);
		}
		if(!isset($_REQUEST["apGraphicsReceiveChk"])){
			$qcSchedule->setAPGraphicsReceiveDateNAReason(null);
		}else{
			$qcSchedule->setAPGraphicsReceiveDate(null);
		}
		if(isset($_REQUEST["iscompleted"])){
			$qcSchedule->setIsCompleted(1);
		}else{
			$qcSchedule->setIsCompleted(0);
		}
		
		if($qcSchedule->getAcFirstInspectionNotes() == "<p><br></p>"){
			$qcSchedule->setAcFirstInspectionNotes(NULL);
		}
		if($qcSchedule->getAcMiddleInspectionNotes() == "<p><br></p>"){
			$qcSchedule->setAcMiddleInspectionNotes(NULL);
		}
		if($qcSchedule->getNotes() == "<p><br></p>"){
			$qcSchedule->setNotes(NULL);
		}
		$qcSchedule->setLastModifiedOn(new DateTime());
		
		//$qcSeqs = implode(",", $_REQUEST["qcschedulescheck"]);
		$qcSeqs = $_REQUEST["qcschedulescheck"];
		
		$qcScheduleMgr->bulkUpdateQCSchedules($qcSchedule, $qcSeqs);
	
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "importQCSchedules"){
	try{
		$isUpdate = false;
		$incorrectPassword = 0;
		$updatingRowNumbers = array();
		if(isset($_POST["isupdate"]) && !empty($_POST["isupdate"])){
			$password = $_POST["password"];
			$configurationMgr = ConfigurationMgr::getInstance();
			$qcpassword = $configurationMgr->getConfiguration(Configuration::$QC_IMPORT_UPDATE_PASSWORD);
			if($password != $qcpassword){
				$incorrectPassword = 1;
				throw new Exception(StringConstants::INCORRECT_PASSWORD);
			}
			$isUpdate = true;
			$updatingRowNumbers = $_SESSION['qcScheduleRowsToBeUpdate'];
		}
		$isCompleted = $_POST["iscompleted"];
		if(isset($_FILES["file"])){
			$response = $qcScheduleMgr->importQCSchedulesWithActualDates($_FILES["file"],$isUpdate,$updatingRowNumbers,$isCompleted);
			echo json_encode($response);
			if($response["success"] == 1){
				unset($_SESSION['qcScheduleRowsToBeUpdate']);
			}
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
	$response["incorrectPassword"] = $incorrectPassword;
}
if($call == "newOrUpdateQcSchedule"){
	try{
		if(isset($_FILES["file"])){
			$response = $qcScheduleMgr->newUpdateQCSchedulesWithActualDates($_FILES["file"]);
			//echo json_encode($response);
			if($response["success"] == 1){
				unset($_SESSION['qcScheduleRowsToBeUpdate']);
				$message = $response["message"] . "\n No of Imported Entry: " . $response["savedItemCount"] . "\n No of Updated Entry: " . $response["updatedItemCount"];
			}else{
				throw new Exception($response["message"]);
			}
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "bulkDelete"){
    try{
        $filePath = "/Users/baljeetgaheer/Downloads/QCSchedules-RURALKING to delete_copy1.xlsx";
        $response = $qcScheduleMgr->bulkDeleteByImport($filePath);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
        echo "Error - $message";
    }
}

if($call == "getAllQCSchedules"){
	$qcSchedulesJson = $qcScheduleMgr->getAllQcSchedules(BeanReturnDataType::grid);
	echo json_encode(utf8ize($qcSchedulesJson));
	return;
}
if($call == "export"){
	try{
		$queryString = $_GET["queryString"];
		$qcscheduleSeqs = $_GET["qcscheduleseq"];
		$response = $qcScheduleMgr->exportQCSchedules($queryString,$qcscheduleSeqs);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "exportPlanner"){
    try{
        $response = $qcScheduleMgr->exportQCPlannerReport();
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getQCSchedule"){
	try{
		$qcSchedule = $qcScheduleMgr->findBySeq($_GET["seq"]);
		$response["item"] = $qcSchedule;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "deleteQCSchedule"){
	$ids = $_GET["ids"];
	$pos = $_GET["po"];
	try{
		$flag = $qcScheduleMgr->deleteByIdsAndPo($ids,$pos);
		$message = StringConstants::QC_SCHEDULE_DELETE_SUCCESSFULLY;
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
if($call == "updateQCSchedules"){
	try{
		if(isset($_FILES["file"])){
			$isUpdateShipDateAndScheduleDates = false;
			$isUpdateLatestShipDate           = false;
			$isCompletionStatus               = false;
			$isUpdatePONumber                 = false;
			$isUpdatePoTypes                  = false;
			$isUpdateClassCode                = false;
			$isUpdateQC                       = false;
			$isUpdateFirstInspectionDate      = false;
			$isUpdatePoInchargeUser           = false;
			switch($_REQUEST['selectedOption'][0]){
				case "updateShipDateAndScheduleDates":{
					$isUpdateShipDateAndScheduleDates = true;
					break;
				}
				case "updateLatestShipDate":{
					$isUpdateLatestShipDate = true;
					break;
				}
				case "updateCompetionStatus":{
					$isCompletionStatus = true;
					break;
				}
				case "updatePONumbers":{
					$isUpdatePONumber = true;
					break;
				}
				case "updatePOTypes":{
					$isUpdatePoTypes = true;
					break;
				}
				case "updateClassCode":{
					$isUpdateClassCode = true;
					break;
				}
				case "updateQC":{
					$isUpdateQC = true;
					break;
				}
				case "updateFirstInspectionDate":{
					$isUpdateFirstInspectionDate = true;
					break;
				}
				case "updatePOInchargeUser":{
					$isUpdatePoInchargeUser = true;
					break;
				}
			}
			if($_REQUEST["selectedOption"][0] == ""){
				throw new Exception("No Option selected. You need to select atleast one option");
			}
			$response = $qcScheduleMgr->updateQCSchedulesWithActualDates(
							$_FILES["file"],
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
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getQCSchedulesDashboardCount"){
	try{
		$response["data"] = $qcScheduleMgr->getQCScheduleNotificationDateCount();
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = "0";
		unset($response["data"]);
	}
}
if($call == "correctQCOrPoIncharge"){
	$seq = $_REQUEST["seq"];
	$type = $_REQUEST["type"];
	$classcodes = $_REQUEST["classcodes"];
	$changedQCSchedules =$qcScheduleMgr->correctQCOrPoIncharge($classcodes, $seq, $type);
	$message = "The Number of QCSchedules Updated are $changedQCSchedules";
	
}
if($call == "exportFilterData"){
	try{
		$filterId = $_POST['filterId'];
		$QCExportSchedulesAndFileName = $qcScheduleMgr->exportFilterData($filterId);
		// if($QCExportSchedulesAndFileName['qcSchedules']){
			PHPExcelUtil::exportQCSchedules($QCExportSchedulesAndFileName['qcSchedules'],false,$QCExportSchedulesAndFileName['fileName']);
		// }
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = "0";
	}
}
if($call == "getAllMissingAppoitmentForFinalInspectionDate"){
	try{
		$allMissingAppointmentForFinalInspectionDate = $qcScheduleMgr->getAllMissingAppoitmentForFinalInspectionDate(BeanReturnDataType::grid);
        echo json_encode($allMissingAppointmentForFinalInspectionDate);
        return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = "0";
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
if($call == "exportRevisions"){
	try{
		$qcSeq = $_REQUEST['qcSeq'];
		$qcScheduleRevisons = $qcScheduleRevisionMgr->getQCRevisionsByQcSeq($qcSeq);
		$response = PHPExcelUtil::exportQCSchedules($qcScheduleRevisons,false,"QCScheduleRevision",true);
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
