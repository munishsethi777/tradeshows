<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
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
$graphicLogMgr = GraphicLogMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveGraphicLog"){
	try{
		$message = "Graphic Log saved successfully!"; 
		$graphicLog = new GraphicsLog();
		$graphicLog->createFromRequest($_REQUEST);
		
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "Graphic Log updated successfully!";
		}
		$graphicLog->setSeq($seq);
		$graphicLog->setUserSeq($sessionUtil->getAdminLoggedInSeq());
		$graphicLog->setCreatedOn(new DateTime());
		$graphicLog->setLastModifiedOn(new DateTime());
		if(!empty($graphicLog->getIsCustomHangTagNeeded())){
			$graphicLog->setIsCustomHangTagNeeded(1);
		}else{
			$graphicLog->setIsCustomHangTagNeeded(0);
		}
		if(!empty($graphicLog->getIsCustomWrapTagNeeded())){
			$graphicLog->setIsCustomWrapTagNeeded(1);
		}else{
			$graphicLog->setIsCustomWrapTagNeeded(0);
		}
		if(!empty($graphicLog->getIsPrivateLabel())){
			$graphicLog->setIsPrivateLabel(1);
		}else{
			$graphicLog->setIsPrivateLabel(0);
		}
		$id = $graphicLogMgr->save($graphicLog);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
		if($e->getTrace()[0]['args'][0][0] ==  23000){
			$message = "Duplicate values for the combination of shipdate, item number and customer is not allowed";
		}
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
if($call == "getAllGraphicLogs"){
	
	$qcSchedulesJson = $graphicLogMgr->getGraphicLogsForGrid();
	echo json_encode($qcSchedulesJson);
	return;
}
if($call == "export"){
	try{
		$queryString = $_GET["queryString"];
		$response = $graphicLogMgr->exportGraphicLog($queryString);
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
if($call == "deleteGraphicLog"){
	$ids = $_GET["ids"];
	//$pos = $_GET["po"];
	try{
		$flag = $graphicLogMgr->deleteByIds($ids);
		$message = "Graphic Log Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);