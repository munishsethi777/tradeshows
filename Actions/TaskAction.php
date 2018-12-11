<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskFileMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
$sessionUtil = SessionUtil::getInstance();

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
if($call == "saveTask"){
	try{
		$message = "Task saved successfully.";
		$task = new Task();
		$task->createFromRequest($_REQUEST);
		$task->setIsCustom(1);
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "Task updated successfully.";
		}
		$task->setSeq($seq);
		$assignees = $_REQUEST["assignees"];
		$id = $taskMgr->saveTask($task,$assignees);
		
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
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
		$userSeq = null;
		if($sessionUtil->isSessionUser()){
			$userSeq = $sessionUtil->getUserLoggedInSeq();
		}
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
		$flag = $showTaskMgr->updateShowTaskCommentsStatus($showTask);
		if($flag){
			$showTaskFileMgr = ShowTaskFileMgr::getInstance();
			$showTaskFileMgr->saveFilesFromRequest($showTask->getSeq());
			if($sessionUtil->isSessionUser()){
				MailUtil::sendUpdateStatusNotification($showTask->getSeq());
			}
			$success = 1;
			$message = "Task updated Successfully";
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getAllTasksList"){
	$taskCatJson = $taskMgr->getTasksForGrid();
	echo json_encode($taskCatJson);
	return;
}
if($call == "deleteTasks"){
	$ids = $_GET["ids"];
	try{
		$flag = $taskMgr->deleteBySeqs($ids);
		$message = "Task Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
		//$message = ErrorUtil::checkReferenceError(LearningPlan::$className,$e);
	}
}

$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);