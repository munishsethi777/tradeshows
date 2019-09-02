<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/QcscheduleApprovalMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$qcScheduleApprovalMgr = QcscheduleApprovalMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "updateApprovalStatus"){
	try{
		$approvalSeq = $_POST["approvalSeq"];
		$approvalStatusDD = $_POST["approvalStatusDD"];
		$comments = $_POST["comments"];
		$flag = $qcScheduleApprovalMgr->updateApprovalStatus($approvalSeq,$approvalStatusDD,$comments);
		if($flag){
			$message = StringConstants::QC_SCHEDULE_STATUS_UPDATE;
			$loggedInUserName = $sessionUtil->getUserLoggedInName();
			QCNotificationsUtil::sendQCApprovedRejectNotification($approvalSeq,$comments,$loggedInUserName);
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call = "getQCSchedulesApproval"){
    $qcscheduleSeqs = $_GET['qcscheduleseq'];
    $qcSchedulesJson = $qcScheduleApprovalMgr->getQcScheduleApproval($qcscheduleSeqs);
    echo json_encode($qcSchedulesJson);
    return;     
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
?>