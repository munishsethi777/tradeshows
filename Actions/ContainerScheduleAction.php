<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleDatesMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleNotesMgr.php");
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
$containerScheduleMgr = ContainerScheduleMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveContainerSchedule"){
	try{
		$message = "Container Schedule saved successfully!";
		$containerSchedule = new ContainerSchedule();
		$containerSchedule->createFromRequest($_REQUEST);
		if(empty($containerSchedule->getAWUReference())){
			throw new Exception("AWU Reference can not be empty");
		}
		
		$existingContainerSchedule = new ContainerSchedule();
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "Container Schedule updated successfully!";
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
		if(empty($containerSchedule->getIssamplesReceivedinOMS())){
			$containerSchedule->setSamplesReceivedinWMSDate(null);
		}
		$id = $containerScheduleMgr->save($containerSchedule);
		
		if($id > 0){
			$containerSchedule->setSeq($id);
			$containerScheduleDateMgr = ContainerScheduleDatesMgr::getInstance();
			$containerScheduleDateMgr->saveFromContainerSchedule($containerSchedule, $existingContainerSchedule);
			
			$containerScheduleNoteMgr = ContainerScheduleNotesMgr::getInstance();
			$containerScheduleNoteMgr->saveFromContainerSchedule($containerSchedule, $existingContainerSchedule);
		}
		$response["seq"] = $id;
// 		if(!empty($graphicLog->getIsCustomHangTagNeeded())){
// 			$graphicLog->setIsCustomHangTagNeeded(1);
// 		}else{
// 			$graphicLog->setIsCustomHangTagNeeded(0);
// 		}
// 		if(!empty($graphicLog->getIsCustomWrapTagNeeded())){
// 			$graphicLog->setIsCustomWrapTagNeeded(1);
// 		}else{
// 			$graphicLog->setIsCustomWrapTagNeeded(0);
// 		}
// 		if(!empty($graphicLog->getIsPrivateLabel())){
// 			$graphicLog->setIsPrivateLabel(1);
// 		}else{
// 			$graphicLog->setIsPrivateLabel(0);
// 			$graphicLog->setLabelType(null);
// 			$graphicLog->setLabelLength(null);
// 			$graphicLog->setLabelWidth(null);
// 			$graphicLog->setLabelHeight(null);
// 		}
// 		$graphicType = $graphicLog->getGraphicType();
// 		$graphicCount = count($graphicLog);
// 		if($graphicCount == 1 && 
// 				$graphicType[0] == GraphicType::getName(GraphicType::a4_label)){
// 			$graphicLog->setGraphicLength(null);
// 			$graphicLog->setGraphicWidth(null);
// 			$graphicLog->setGraphicHeight(null);
// 		}
// 		if($graphicLog->getTagType() != "custom"){
// 			$graphicLog->setTagLength(null);
// 			$graphicLog->setTagWidth(null);
// 			$graphicLog->setTagHeight(null);
// 		}
		
// 		if(!empty($graphicType)){
// 			$graphicType = implode(",",$graphicType);
// 		}
// 		$graphicLog->setGraphicType($graphicType);
// 		if($graphicLog->getLabelType() != "custom"){
// 			$graphicLog->setLabelLength(null);
// 			$graphicLog->setLabelWidth(null);
// 			$graphicLog->setLabelHeight(null);
// 		}
		
		//$id = $graphicLogMgr->save($graphicLog);
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
				throw new Exception("Incorrect Password!");
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
		$message = "Container Schedule(s) Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);