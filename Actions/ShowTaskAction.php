<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskAssigneeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTask.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/ShowTaskStatus.php");
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
if($call == "getAllShowTaskStatus"){
	$status = ShowTaskStatus::getAll();
	$arr = array();
	foreach ($status as $st){
		array_push($arr, $st);
	}
	echo json_encode($arr);
	return;
}
if($call == "getAllAssigneesByShow"){
	$showSeq = $_GET["showSeq"];
	$showTaskAssigneeMgr = ShowTaskAssigneeMgr::getInstance();
	$assignees = $showTaskAssigneeMgr->getAllUserNamesByShowSeq($showSeq);
	$json = json_encode($assignees);
	echo $json;
	return;
}