<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Request.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/DepartmentMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestTypeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestStatusMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestSpecsFieldMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php"); 
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestAttachmentMgr.php");

$success = 1;
$message = '';
$call = "";
$response = new ArrayObject();
$requestMgr = RequestMgr::getInstance();
$departmentMgr = DepartmentMgr::getInstance();
$requestTypeMgr = RequestTypeMgr::getInstance();
$requestStatusMgr = RequestStatusMgr::getInstance();
$requestSpecsFieldMgr = RequestSpecsFieldMgr::getInstance();
$requestLogMgr = RequestLogMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
$requestAttachmentMgr = RequestAttachmentMgr::getInstance();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
if($call == "getRequestTypesByDepartmentSeq"){
	try{
		$departmentSeq = $_REQUEST['departmentSeq'];
		$requestTypes = $requestTypeMgr->findByDepartmentSeqForDropDown($departmentSeq);
		$response['data'] = $requestTypes;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getRequestTypesBySeq"){
	try{
		$requestTypeSeq = $_REQUEST['seq'];
		$requestFormHtml = $requestMgr->createRequestFormHtml($requestTypeSeq);
		$response['data'] = $requestFormHtml;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "saveRequest"){
	try{
		$message = StringConstants::REQUEST_SAVED_SUCCESSFULLY;
		if(isset($_REQUEST['seq']) && !empty($_REQUEST['seq'])){
			$message = StringConstants::REQUEST_UPDATED_SUCCESSFULLY;
		}
		$response['data'] = $requestMgr->save($_REQUEST,$loggedInUserSeq);
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getAllRequestsForGrid"){
	try{
		$requests = $requestMgr->getAllRequests();
		echo json_encode($requests);
		return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getRequestDataBySeqForEdit"){
	try{
		$seq = $_REQUEST['requestSeq'];
		$request = $requestMgr->findBySeq($seq);
		$requestTypes = $requestTypeMgr->findByDepartmentSeqForDropDown($request->getDepartmentSeq());
		$specsFieldTypeArr = $requestSpecsFieldMgr->getSpecsFieldsTypeWithNameTitleByRequestTypeSeq($request->getRequestTypeSeq());
		$requestFormHtml = $requestMgr->createRequestFormHtml($request->getRequestTypeSeq(),$request);
		$requestLogComments = $requestLogMgr->getRequestLogs(null,$seq,"comment");
		$requestLogCommentsHtml = $requestLogMgr->commentsHtml($requestLogComments);
		$requestLogHistory = $requestLogMgr->getRequestLogs(null,$seq,null,true);
		$requestLogHistoryHtml = $requestLogMgr->historyLogHtml($requestLogHistory,$specsFieldTypeArr);
		$requestAttachments = $requestAttachmentMgr->findByRequestSeq($seq);
		$requestAttachmentsHtml = $requestAttachmentMgr->attachmentHtml($requestAttachments);
		$requestFormOtherFields = array();
		$response['data']['requestAttachmentsHtml'] = $requestAttachmentsHtml;
		$response['data']['requestspecsformhtml'] = $requestFormHtml;
		$response['data']['requestspecificationjson'] = $request->getRequestSpecifications();
		$response['data']['requestLogCommentsHtml'] = $requestLogCommentsHtml;
		$response['data']['requestLogHistoryHtml'] = $requestLogHistoryHtml;
		$requestFormOtherFields['departmentseq'] = $request->getDepartmentSeq();
		$requestFormOtherFields['requesttypeseq'] = $request->getRequestTypeSeq();
		$requestFormOtherFields['priority'] = $request->getPriority();
		$requestFormOtherFields['requeststatusseq'] = $request->getRequestStatusSeq();
		$requestFormOtherFields['requesttypes'] = $requestTypes;
		$requestFormOtherFields['duedate'] = DateUtil::convertDateToFormat($request->getDueDate(),'Y-m-d','m-d-Y');
		$requestFormOtherFields['assigneeduedate'] = DateUtil::convertDateToFormat($request->getAssigneeDueDate(),'Y-m-d','m-d-Y');
		$requestFormOtherFields['estimatedhours'] = $request->getEstimatedHours();
		$requestFormOtherFields['isrequiredapprovalfrommanager'] = $request->getIsRequiredApprovalFromManager() == '1' ? 'yes' : 'no';
		$requestFormOtherFields['isrequiredapprovalfromrequester'] = $request->getIsRequiredApprovalFromRequester() == '1' ? 'yes' : 'no';
		$requestFormOtherFields['isrequiredapprovalfromrobby'] = $request->getIsRequiredApprovalFromRobby() == '1' ? 'yes' : 'no';
		$requestFormOtherFields['assignedbyseq'] = $request->getAssignedBy();
		$requestFormOtherFields['assignedtoseq'] = $request->getAssignedTo();
		$requestFormOtherFields['approvedbymanagerdate'] = $request->getApprovedByManagerDate();
		$requestFormOtherFields['approvedbyrequesterdate'] = $request->getApprovedByRequesterDate();
		$requestFormOtherFields['approvedbyrobbydate'] = $request->getApprovedByRobbyDate();
		$response['data']['requestformotherfields'] = $requestFormOtherFields;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "saveComment"){
	try{
		$requestSeq = $_REQUEST['requestSeq'];
		$loggedInUserSeq = $_REQUEST['loggedInUserSeq'];
		$comment = $_REQUEST['comment'];
		$seq = $requestLogMgr->saveComment($_REQUEST);
		$requestLogComments = $requestLogMgr->getRequestLogs($seq,false,"comment");
		$requestLogCommentsHtml = $requestLogMgr->commentsHtml($requestLogComments);
		$response['data']['requestLogCommentsHtml'] = $requestLogCommentsHtml;
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
if($call == "saveRequestAttachment"){
	try{
		if(!empty($_FILES)){
			$date = new DateTime();
			$currentDate = $date->getTimestamp();
			$requestAttachmentMgr = RequestAttachmentMgr::getInstance();
			$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/tradeshows/images/requestattachments/';
			$temp = explode(".",$_FILES['file']['name']);
			$attachmentName = $temp[0] . $currentDate . "." . $temp[1];
			$attachmentTitle = $_FILES['file']['name'];
			$uploadFilePath = $uploadDir . $attachmentName;
			$attachmentBytes = $_FILES['file']['size'];
			$attachmentType = $_FILES['file']['type'];
			if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadFilePath)){
				$requestAttachmentArr = array();
				$requestAttachmentArr['requestseq'] = $_REQUEST['requestseq'];
				$requestAttachmentArr['attachmenttitle'] = $attachmentTitle;
				$requestAttachmentArr['attachmentfilename'] = $attachmentName;
				$requestAttachmentArr['attachmentbytes'] = $attachmentBytes;
				$requestAttachmentArr['attachmenttype'] = $attachmentType;
				$requestAttachmentArr['loggedinuserseq'] = $loggedInUserSeq;
				$requestAttachmentArr['loggedinuserseq'] = $loggedInUserSeq;
				$requestAttachmentArr['createdon'] = date('Y-m-d h:i:s');
				$requestAttachmentSeq = $requestAttachmentMgr->save($requestAttachmentArr);
				$requestLogArr = array();
				$requestLogArr['requestseq'] = $_REQUEST['requestseq'];
				$requestLogArr['oldvalue'] = "";
				$requestLogArr['newvalue'] = $requestAttachmentSeq;
				$requestLogArr['attribute'] = "attachment";
				$requestLogArr['createdby'] = $loggedInUserSeq;
				$requestLogArr['createdon'] = date('Y-m-d h:i:s');
				$requestLogMgr = RequestLogMgr::getInstance();
				$requestAttachmentSeq = $requestLogMgr->save($requestLogArr);
				$requestAttachmentTempArr = array();
				array_push($requestAttachmentTempArr,$requestAttachmentArr);
				$attachmentHtml = $requestAttachmentMgr->attachmentHtml($requestAttachmentTempArr);
				$response['data'] = $attachmentHtml;
			}
		}
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
if($call == "loadHistory"){
	try{
		if(isset($_REQUEST['requestSeq']) && isset($_REQUEST['lastUpdatedHistorySeq'])){
			$requestLogHistory = $requestLogMgr->getRequestLogs(null,$_REQUEST['requestSeq'],null,true,$_REQUEST['lastUpdatedHistorySeq']);
			// $requestTypes = $requestTypeMgr->findByDepartmentSeqForDropDown($request->getDepartmentSeq());
		}else{
			$requestLogHistory = $requestLogMgr->getRequestLogs(null,$_REQUEST['requestSeq'],null,true);
		}
		$request = $requestMgr->findBySeq($_REQUEST['requestSeq']);
		$specsFieldTypeArr = $requestSpecsFieldMgr->getSpecsFieldsTypeWithNameTitleByRequestTypeSeq($request->getRequestTypeSeq());
		$requestLogHistoryHtml = $requestLogMgr->historyLogHtml($requestLogHistory,$specsFieldTypeArr,false);
		$response['data'] = $requestLogHistoryHtml;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
?>