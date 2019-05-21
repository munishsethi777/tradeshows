<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
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

$qcScheduleMgr = ItemSpecificationMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveQCSchedule"){
	try{
		$message = "QC Schedule saved successfully."; 
		$qcSchedule = new QCSchedule();
		$qcSchedule->createFromRequest($_REQUEST);
		
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "QC Schedule updated successfully.";
		}
		$qcSchedule->setSeq($seq);
		$qcSchedule->setUserSeq($sessionUtil->getAdminLoggedInSeq());
		$qcSchedule->setCreatedOn(new DateTime());
		$qcSchedule->setLastModifiedOn(new DateTime());
		$id = $qcScheduleMgr->saveQCSchedule($qcSchedule);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

if($call == "importItemSpecifications"){
	try{
		if(isset($_FILES["file"])){
			$response = $qcScheduleMgr->importItems($_FILES["file"]);
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getAllItemSpecifications"){
	$itemJson = $qcScheduleMgr->getItemsgetItemsForGrid();
	echo json_encode($itemJson);
	return;
}
if($call == "export"){
	try{
		$queryString = $_GET["queryString"];
		$response = $qcScheduleMgr->exportItemSpecifications($queryString);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getItemDetails"){
	try{
		$item = $qcScheduleMgr->findBySeq($_GET["seq"]);
		$response["item"] = $item;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "deleteItemSpecification"){
	$ids = $_GET["ids"];
	try{
		$flag = $qcScheduleMgr->deleteItemSpecificationWithVersions($ids);
		$message = "Item Specifications Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);