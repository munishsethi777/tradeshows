<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskCategoryMgr.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$taskCategoryMgr = TaskCategoryMgr::getInstance();
if($call == "saveTaskCategory"){
	try{
		$message = "Task Category saved successfully.";
		$taskCategory = new TaskCategory();
		$taskCategory->createFromRequest($_REQUEST);
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "Task Category updated successfully.";
		}
		$taskCategory->setSeq($seq);
		$id = $taskCategoryMgr->saveTaskCategory($taskCategory);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getAllTaskCategories"){
	$taskCatJson = $taskCategoryMgr->getTaskCategoriesForGrid();
	echo json_encode($taskCatJson);
	return;
}
if($call == "deleteTaskCategory"){
	$ids = $_GET["ids"];
	try{
		$flag = $taskCategoryMgr->deleteBySeqs($ids);
		$message = "Task Categories Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
		//$message = ErrorUtil::checkReferenceError(LearningPlan::$className,$e);
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);