<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QcscheduleApprovalMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
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
		if(isset($_POST["isapproval"])){
			$acFinalInspectionDate = $_REQUEST["acfinalinspectiondate"];
			if(!empty($acFinalInspectionDate)){
				$acFinalInspectionDate = DateUtil::StringToDateByGivenFormat("m-d-Y", $acFinalInspectionDate);
				$currentTime = new DateTime();
				$currentTime->setTime(0,0);
				$acFinalInspectionDate->setTime(0,0);
				if($acFinalInspectionDate > $currentTime){
					throw new Exception("Actual final inspection date should be in past for submit approval");
				}
			}else{
				throw new Exception("Actual final inspection date is required for submit approval");
			}
		}
		$message = "QC Schedule saved successfully!";
		$itemNumbers = $_REQUEST["itemnumbers"];
		$itemNumbers = explode(",",$itemNumbers);
		$seq = $_REQUEST["seq"];
		$seqs = $_REQUEST["seqs"];
		$seqs = explode(",",$seqs);
		foreach ($itemNumbers as $key=>$itemNumber){
			$seq = 0;
			$qcSchedule = new QCSchedule();
			if(isset($seqs[$key])){
				$seq  = $seqs[$key];
				$qcSchedule = $qcScheduleMgr->getBySeq($seq);
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
			if($seq > 0){
				$message = "QC Schedule updated successfully!";
			}
			//$qcSchedule->setSeq($seq);
			$qcSchedule->setUserSeq($sessionUtil->getUserLoggedInSeq());
			$qcSchedule->setCreatedOn(new DateTime());
			$qcSchedule->setLastModifiedOn(new DateTime());
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