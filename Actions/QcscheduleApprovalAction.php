<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/QcscheduleApprovalMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
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
		$approvalStatus = $_POST["approvalstatus"];
		$flag = $qcScheduleApprovalMgr->updateApprovalStatus($approvalSeq, $approvalStatus);
		if($flag){
			$message =  "QC Schedule status update successfully!";
		}
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
?>