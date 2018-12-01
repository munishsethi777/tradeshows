<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTask.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
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
		$message = "Show saved successfully.";
		$show = new Show();
		$show->createFromRequest($_REQUEST);
		$seq = 0;
		if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
			$seq = $_REQUEST["seq"];
			$message = "Show updated successfully.";
		}
		$show->setSeq($seq);
		$startDate = $_REQUEST["startdate"];
		$endDate = $_REQUEST["enddate"];
		$startDate = DateUtil::StringToDateByGivenFormat('m-d-Y', $startDate);
		$endDate = DateUtil::StringToDateByGivenFormat('m-d-Y', $endDate);
		$show->setStartDate($startDate);
		$show->setEndDate($endDate);
		$id = $showManager->saveShow($show);
		MailUtil::sendTaskAssignedNotification($id);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getShows"){
	try{
		$shows = $showManager->getShowsForGrid(true);
		echo json_encode($shows);
		return;
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}

$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);