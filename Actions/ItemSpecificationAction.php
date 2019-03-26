<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemSpecificationMgr.php");
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
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);