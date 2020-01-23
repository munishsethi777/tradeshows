<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleDatesMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleNotesMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$containerScheduleMgr = ContainerScheduleMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveContainerSchedule"){
	try{
	    $message = StringConstants::CONTAINER_SCHEDULE_SAVED_SUCCESSFULLY;
		$containerSchedule = new ContainerSchedule();
		$containerSchedule->createFromRequest($_REQUEST);
		if(empty($containerSchedule->getContainer())){
		    throw new Exception(StringConstants::AWU_REFERENCE_NOT_EMPTY);
		}
		$existingContainerSchedule = new ContainerSchedule();
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message =  StringConstants::CONTAINER_SCHEDULE_UPDATE_SUCCESSFULLY;
			$existingContainerSchedule = $containerScheduleMgr->findBySeq($seq);
		}
		$userSeq = $sessionUtil->getUserLoggedInSeq();
		$containerSchedule->setCreatedby($userSeq);
		$containerSchedule->setCreatedon(new DateTime());
		$containerSchedule->setLastModifiedon(new DateTime());
		
		if(empty($containerSchedule->getIsContainerReceivedinOMS())){
			$containerSchedule->setContainerReceivedinOMSDate(null);
		}
		if(empty($containerSchedule->getIsContainerReceivedinWMS())){
			$containerSchedule->setContainerReceivedinWMSDate(null);
		}
		if(empty($containerSchedule->getIssamplesReceivedinOMS())){
			$containerSchedule->setSamplesReceivedinOMSDate(null);
		}
		if(empty($containerSchedule->getIssamplesReceivedinWMS())){
			$containerSchedule->setSamplesReceivedinWMSDate(null);
		}
		$id = $containerScheduleMgr->save($containerSchedule);
		
		$isEtaNotesUpdated = false;
		$isEmptyReturnNotesUpdated = false;
		$isAlpineNotesUpdated = false;
		if($id > 0){
			$containerSchedule->setSeq($id);
			$containerScheduleDateMgr = ContainerScheduleDatesMgr::getInstance();
			$containerScheduleDateMgr->saveFromContainerSchedule($containerSchedule, $existingContainerSchedule);
			
			$containerScheduleNoteMgr = ContainerScheduleNotesMgr::getInstance();
			$containerScheduleNoteMgr->saveFromContainerSchedule($containerSchedule, $existingContainerSchedule);
			$loggedInUserName = $sessionUtil->getUserLoggedInName();
			ContainerScheduleReportUtil::sendAlpinePickUpDateChangedNotification($containerSchedule, $existingContainerSchedule,$loggedInUserName);
			ContainerScheduleReportUtil::sendTerminalAppointmentChangedNotification($containerSchedule, $existingContainerSchedule,$loggedInUserName);
			ContainerScheduleReportUtil::sendRequestedDeliveryDateChangedNotification($containerSchedule, $existingContainerSchedule,$loggedInUserName);
			
			$isEtaNotesUpdated = $containerSchedule->getETANotes() != $existingContainerSchedule->getETANotes();
			$isEmptyReturnNotesUpdated = $containerSchedule->getEmptyNotes() != $existingContainerSchedule->getEmptyNotes();
			$isAlpineNotesUpdated = $containerSchedule->getNotificationNotes() != $existingContainerSchedule->getNotificationNotes();
		}
		$response["seq"] = $id;
		if($id > 0){
		    if($isEtaNotesUpdated){
		        ContainerScheduleReportUtil::sendContainerScheduleNotesUpdatedNotification($containerSchedule,
		            ContainerScheduleNotificationType::eta_notes_updated_instant);
		    }
		    if($isEmptyReturnNotesUpdated){
		        ContainerScheduleReportUtil::sendContainerScheduleNotesUpdatedNotification($containerSchedule,
		            ContainerScheduleNotificationType::empty_return_notes_updated_instant);
		    }
		    if($isAlpineNotesUpdated){
		        ContainerScheduleReportUtil::sendContainerScheduleNotesUpdatedNotification($containerSchedule,
		            ContainerScheduleNotificationType::alpine_pickup_notes_updated_instant);
		    }
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

if($call == "importGraphicLogs"){
	try{
		$isUpdate = false;
		$incorrectPassword = 0;
		$updateIds = array();
		if(isset($_POST["isupdate"]) && !empty($_POST["isupdate"])){
			$password = $_POST["password"];
			$configurationMgr = ConfigurationMgr::getInstance();
			$qcpassword = $configurationMgr->getConfiguration(Configuration::$QC_IMPORT_UPDATE_PASSWORD);
			if($password != $qcpassword){
				$incorrectPassword = 1;
				throw new Exception(StringConstants::INCORRECT_PASSWORD);
			}
			$isUpdate = true;
			$updateIds = $_POST["updateIds"];
			$updateIds = explode(",",$updateIds);
		}
		if(isset($_FILES["file"])){
			$response = $graphicLogMgr->importGraphicLog($_FILES["file"],$isUpdate,$updateIds);
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
	$response["incorrectPassword"] = $incorrectPassword;
}
if($call == "getAllContainerSchedules"){
	$qcSchedulesJson = $containerScheduleMgr->getContainerSchedulesForGrid();
	echo json_encode($qcSchedulesJson);
	return;
}
if($call == "export"){
	try{
		$queryString = $_GET["queryString"];
		$response = $containerScheduleMgr->exportContainerSchedules($queryString);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getGraphicLog"){
	try{
		$qcSchedule = $qcScheduleMgr->findBySeq($_GET["seq"]);
		$response["item"] = $qcSchedule;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "deleteContainerSchedule"){
	$ids = $_GET["ids"];
	try{
		$flag = $containerScheduleMgr->deleteByIds($ids);
		$message = StringConstants::CONTAINER_SCHEDULE_DELETE_SUCCESSFULLY ; 
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
if($call == "getContainerScheduleDetails"){
    try{
        $containerSchedule = $containerScheduleMgr->findArrBySeqForView($_GET["seq"]);
        $response["containerSchedule"] = $containerSchedule;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);