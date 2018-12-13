<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskFileMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTaskFile.php");
$success = 1;
$message="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
	
}
if($call == "getTasksFilesByTradeShow"){
	$showSeq = $_GET["showSeq"];
	$showTaskFileMgr = ShowTaskFileMgr::getInstance();
	$taskFiles = $showTaskFileMgr->getTasksFilesByShow($showSeq);
	$response["taskFiles"] = $taskFiles;
}

$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;