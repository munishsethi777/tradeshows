<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$sessionUtil = SessionUtil::getInstance();
$userSeq = $sessionUtil->getUserLoggedInSeq();

$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$taskMgr = TaskMgr::getInstance();
$showTaskMgr = ShowTaskMgr::getInstance();

if($call == "getAllTasks"){
	try{
		$tasks = $taskMgr->getAll();
		echo json_encode($tasks);
		return;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getShowTasks"){
	try{
		$showSeq = $_GET["showSeq"];
		$tasks = $taskMgr->getShowTasksByUser($showSeq, $userSeq);
		echo json_encode($tasks);
		return;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getShowTaskDetails"){
	try{
		$showTaskSeq = $_GET["showTaskSeq"];
		$taskDetails = $showTaskMgr->getShowTaskDetails($showTaskSeq);
		$response["taskDetails"]  = $taskDetails;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "updateShowTaskDetails"){
	try{
		$showTask = new ShowTask();
		$showTask->createFromRequest($_REQUEST);
		$showTaskMgr->updateShowTaskCommentsStatus($showTask);
		$success = 1;
		$message = "Task updated Successfully";
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);