<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/GraphicType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/TagType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
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
$graphicLogMgr = GraphicLogMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveGraphicLog"){
	try{
	    $message = StringConstants::GRAPHIC_LOG_SAVED_SUCCESSFULLY;
		$graphicLog = new GraphicsLog();
		$graphicLog->createFromRequest($_REQUEST);
		if(empty($graphicLog->getUSAOfficeEntryDate())){
		    throw new Exception(StringConstants::USA_DATE_NOT_EMPTY);
		}
		if(empty($graphicLog->getSKU())){
		    throw new Exception(StringConstants::ITEM_ID_NOT_EMPTY);
		}
		if(!empty($graphicLog->getApproxGraphicsChinaSentDate()) 
				&& !empty($graphicLog->getGraphicArtistStartDate())){
			
			if($graphicLog->getApproxGraphicsChinaSentDate() < $graphicLog->getGraphicArtistStartDate()){
			    throw new Exception(StringConstants::START_DATE_LESS_APPX_DATE);
			}
		}
		$seq = 0;
		$existingGraphicLog = null;
		$isUsaNotesUpdated = false;
		$isChinaNotesUpdated = false;
		$isGraphicNotesUpddates = false;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = StringConstants::GRAPHIC_LOG_UPDATED_SUCCESSFULLY;
			$existingGraphicLog = $graphicLogMgr->findBySeq($graphicLog->getSeq());
			$isUsaNotesUpdated = $graphicLog->getUSANotes() != $existingGraphicLog->getUSANotes();
			$isChinaNotesUpdated = $graphicLog->getChinaNotes() != $existingGraphicLog->getChinaNotes();
			$isGraphicNotesUpddates = $graphicLog->getGraphicsToChinaNotes() != $existingGraphicLog->getGraphicsToChinaNotes();
		}
		$graphicLog->setSeq($seq);
		if(empty($graphicLog->getUserSeq())){
			$graphicLog->setUserSeq($sessionUtil->getUserLoggedInSeq());
		}
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
			$graphicLog->setLabelType(null);
			$graphicLog->setLabelLength(null);
			$graphicLog->setLabelWidth(null);
			$graphicLog->setLabelHeight(null);
		}
		$graphicType = $graphicLog->getGraphicType();
		$graphicCount = count($graphicLog);
		if($graphicCount == 1 && 
				$graphicType[0] == GraphicType::getName(GraphicType::a4_label)){
			$graphicLog->setGraphicLength(null);
			$graphicLog->setGraphicWidth(null);
			$graphicLog->setGraphicHeight(null);
		}
		if($graphicLog->getTagType() != "custom"){
			$graphicLog->setTagLength(null);
			$graphicLog->setTagWidth(null);
			$graphicLog->setTagHeight(null);
		}
		
		if(!empty($graphicType)){
			$graphicType = implode(",",$graphicType);
		}
		$graphicLog->setGraphicType($graphicType);
		if($graphicLog->getLabelType() != "custom"){
			$graphicLog->setLabelLength(null);
			$graphicLog->setLabelWidth(null);
			$graphicLog->setLabelHeight(null);
		}
		$id = $graphicLogMgr->save($graphicLog);
		if($id > 0){
			if($isUsaNotesUpdated){
				QCNotificationsUtil::sendGraphicLogNotesUpdatedNotification($graphicLog,"USA");
			}else if($isChinaNotesUpdated){
				QCNotificationsUtil::sendGraphicLogNotesUpdatedNotification($graphicLog,"CHINA");
			}else if($isGraphicNotesUpddates){
				QCNotificationsUtil::sendGraphicLogNotesUpdatedNotification($graphicLog,"GRAPHIC");
			}
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
		//if($e->getTrace()[0]['args'][0][0] ==  23000){
			//$message = "Duplicate values for the combination of shipdate, item number and customer is not allowed";
		//}
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
		$message = StringConstants::GRAPHIC_LOG_DELETE_SUCCESSFULLY;
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);