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
		$item = new Item();
		if(isset($_FILES["file"])){
			$message = $itemMgr->importItems($_FILES["file"]);
			if(!empty($message)){
				$success = 0;
			}else{
				$message = "Items import successfully";
			}
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);