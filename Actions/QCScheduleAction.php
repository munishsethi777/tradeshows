<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$qcScheduleMgr = QCScheduleMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveQCSchedule"){
	try{
		$message = "QC Schedule saved successfully!"; 
		$qcSchedule = new QCSchedule();
		$qcSchedule->createFromRequest($_REQUEST);
		if(!isset($_REQUEST["apMiddleInspectionChk"])){
			$qcSchedule->setApMiddleInspectionDateNaReason(null);
		}
		if(!isset($_REQUEST["apFirstInspectionChk"])){
			$qcSchedule->setApFirstInspectionDateNaReason(null);
		}
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "QC Schedule updated successfully!";
		}
		$qcSchedule->setSeq($seq);
		$qcSchedule->setUserSeq($sessionUtil->getAdminLoggedInSeq());
		$qcSchedule->setCreatedOn(new DateTime());
		$qcSchedule->setLastModifiedOn(new DateTime());
		$id = $qcScheduleMgr->save($qcSchedule);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

if($call == "importQCSchedules"){
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
				throw new Exception("Incorrect Password!");
			}
			$isUpdate = true;
			$updateIds = $_POST["updateIds"];
			$updateIds = explode(",",$updateIds);
		}
		if(isset($_FILES["file"])){
			$response = $qcScheduleMgr->importQCSchedules($_FILES["file"],$isUpdate,$updateIds);
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
	$response["incorrectPassword"] = $incorrectPassword;
}
if($call == "getAllQCSchedules"){
	$qcSchedulesJson = $qcScheduleMgr->getQCScheudlesForGrid();
	echo json_encode($qcSchedulesJson);
	return;
}
if($call == "export"){
	try{
		$queryString = $_GET["queryString"];
		$response = $qcScheduleMgr->exportQCSchedules($queryString);
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
		$message = "QC Schedules Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);