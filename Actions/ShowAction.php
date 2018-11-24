<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");
$success = 1;
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$showManager = ShowMgr::getInstance();
if($call == "saveShow"){
	try{
		$show = new Show();
		$show->createFromRequest($_REQUEST);
		$showTask = new ShowTask();
		$showTask->createFromRequest($_REQUEST);
		$showManager->saveShow($showObject, $showTaskObject);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);