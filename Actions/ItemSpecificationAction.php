<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemSpecificationMgr.php");
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
$itemSpecificationMgr = ItemSpecificationMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveItemSpecification"){
	try{
		$message = "Item Specifications saved successfully."; 
		$itemSpecification = new ItemSpecification();
		$itemSpecification->createFromRequest($_REQUEST);
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "Item Specifications updated successfully.";
		}
		$itemSpecification->setSeq($seq);
		$itemSpecification->setUserSeq($sessionUtil->getUserLoggedInSeq());
		$itemSpecification->setCreatedOn(new DateTime());
		$itemSpecification->setLastModifiedOn(new DateTime());
		$id = $itemSpecificationMgr->saveFromForm($itemSpecification);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

if($call == "importItemSpecifications"){
	try{
		if(isset($_FILES["file"])){
			$response = $itemSpecificationMgr->importItems($_FILES["file"]);
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getAllItemSpecifications"){
	$itemJson = $itemSpecificationMgr->getItemsgetItemsForGrid();
	echo json_encode($itemJson);
	return;
}
if($call == "export"){
	try{
		$queryString = $_GET["queryString"];
		$response = $itemSpecificationMgr->exportItemSpecifications($queryString);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getItemDetails"){
	try{
		$item = $itemSpecificationMgr->findBySeq($_GET["seq"]);
		$response["item"] = $item;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "deleteItemSpecification"){
	$ids = $_GET["ids"];
	try{
		$flag = $itemSpecificationMgr->deleteItemSpecificationWithVersions($ids);
		$message = "Item Specifications Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);