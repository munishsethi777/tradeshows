<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemMgr.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$itemMgr = ItemMgr::getInstance();
if($call == "importItems"){
	try{
		$isUpdate = false;
		$updateIds = array();
		if(isset($_POST["isupdate"]) && !empty($_POST["isupdate"])){
			$isUpdate = true;
			$updateIds = $_POST["updateIds"];
			$updateIds = explode(",",$updateIds);
		}
		$item = new Item();
		if(isset($_FILES["file"])){
			$response = $itemMgr->importItems($_FILES["file"],$isUpdate,$updateIds);
			echo json_encode($response);
			return;
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getAllItems"){
	$itemJson = $itemMgr->getItemsForGrid();
	echo json_encode($itemJson);
	return;
}
if($call == "export"){
	try{
		$response = $itemMgr->exportItems();
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getItemDetails"){
	try{
		$item = $itemMgr->findBySeq($_GET["seq"]);
		$response["item"] = $item;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);