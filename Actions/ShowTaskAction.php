<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTask.php");
$success = 1;
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$showTaskMgr = ShowTaskMgr::getInstance();
if($call == "getShowTasks"){
	$showSeq = $_GET["showSeq"];
	$taskJson = $showTaskMgr->getShowTaskDataByShowSeq($showSeq);
	echo json_encode($taskJson);
	return;
}