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
require_once($ConstantsArray['dbServerUrl'] ."Enums/BeanReturnDataType.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");


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
$userMgr = UserMgr::getInstance(); 
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
if($call == "getRequestTypesAndAssignedByAndAssignedToUsersForDDByDepartmentSeq"){
	try{
		$department = $_REQUEST['department'];
		$managers = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_manager));
		$employees = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_employee));
		$assignedByUsers = $requestMgr->getUsersByDepartmentForDD($managers,$department);
		$assignedToUsers = $requestMgr->getUsersByDepartmentForDD($employees,$department);
		$requestTypes = $requestTypeMgr->findByDepartmentForDropDown($department);
		$response['data']['requesttypes'] = $requestTypes;
		$response['data']['assignedbyusers'] = $assignedByUsers;
		$response['data']['assignedtousers'] = $assignedToUsers;
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
		$return = $requestMgr->save($_REQUEST,$loggedInUserSeq);
		$response['data']['seq'] = $return['seq'];
		$response['data']['code'] = $return['requestcode'];
		$response['data']['requesttypeseq'] = $return['requesttypeseq'];
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getAllRequestsForGrid"){
	try{
		$requests = $requestMgr->getAllRequests(BeanReturnDataType::grid);
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
		$requestTypes = $requestTypeMgr->findByDepartmentForDropDown($request->getDepartment());
		$specsFieldTypeArr = $requestSpecsFieldMgr->getSpecsFieldsTypeWithNameTitleByRequestTypeSeq($request->getRequestTypeSeq());
		$requestFormHtml = $requestMgr->createRequestFormHtml($request->getRequestTypeSeq(),$request,true,$request->getRequestSpecifications());
		$requestLogComments = $requestLogMgr->getRequestLogs(null,$seq,"comment");
		$requestLogCommentsHtml = $requestLogMgr->commentsHtml($requestLogComments);
		$requestLogHistory = $requestLogMgr->getRequestLogs(null,$seq,null,true);
		$historyLog = $requestLogMgr->historyLogHtml($requestLogHistory,$specsFieldTypeArr);
		$requestAttachments = $requestAttachmentMgr->findByRequestSeq($seq);
		$requestAttachmentsHtml = $requestAttachmentMgr->attachmentHtml($requestAttachments);
		$managers = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_manager));
		$employees = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_employee));
		$assignedByUsers = $requestMgr->getUsersByDepartmentForDD($managers,$request->getDepartment());
		$assignedToUsers = $requestMgr->getUsersByDepartmentForDD($employees,$request->getDepartment());
		$response['data']['requestAttachmentsHtml'] = $requestAttachmentsHtml;
		$response['data']['requestspecsformhtml'] = $requestFormHtml;
		$response['data']['requestspecificationjson'] = $request->getRequestSpecifications();
		$response['data']['requestLogCommentsHtml'] = $requestLogCommentsHtml;
		$response['data']['historyLog'] = $historyLog;
		$response['data']['requestTypeSeq'] = $request->getRequestTypeSeq();
		$requestFormOtherFields = array();
		$requestFormOtherFields['code'] = $request->getCode();
		$requestFormOtherFields['title'] = $request->getTitle();
		$requestFormOtherFields['department'] = $request->getDepartment();
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
		$requestFormOtherFields['isCompleted'] = $request->getIsCompleted();
		$requestFormOtherFields['assignedbyusers'] = $assignedByUsers;
		$requestFormOtherFields['assignedtousers'] = $assignedToUsers;
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
			$uploadDir = StringConstants::REQUEST_ATTACHMENTS_PATH;
			$fileExtension = strrchr($_FILES['file']['name'],".");
			$fileNameWithoutExtention = preg_replace("/\.[^.]+$/", "", $_FILES['file']['name']);
			$attachmentName = $fileNameWithoutExtention . $currentDate . $fileExtension;
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
				$requestAttachmentArr['createdon'] = date('Y-m-d H:i:s');
				$requestAttachmentSeq = $requestAttachmentMgr->save($requestAttachmentArr);
				$requestAttachmentArr['seq'] = $requestAttachmentSeq;
				$requestLogArr = array();
				$requestLogArr['requestseq'] = $_REQUEST['requestseq'];
				$requestLogArr['oldvalue'] = "";
				$requestLogArr['newvalue'] = $attachmentTitle;
				$requestLogArr['attribute'] = "attachment";
				$requestLogArr['createdby'] = $loggedInUserSeq;
				$requestLogArr['createdon'] = date('Y-m-d H:i:s');
				$requestLogArr['requesttypeseq'] = $_REQUEST['requesttypeseq'];
				$requestLogMgr = RequestLogMgr::getInstance();
				$requestLogSeq = $requestLogMgr->save($requestLogArr);
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
		$isAppendingHistory = $_REQUEST['lastUpdatedHistorySeq'] == '' ? false : true;// will tell if we are appending logs history on UI or this is a new thread

		// if($_REQUEST['requestSeq'] !='' && $_REQUEST['lastUpdatedHistorySeq'] != ''){
			$requestLogHistory = $requestLogMgr->getRequestLogs(null,$_REQUEST['requestSeq'],null,true,$_REQUEST['lastUpdatedHistorySeq']);
			// $requestTypes = $requestTypeMgr->findByDepartmentSeqForDropDown($request->getDepartmentSeq());
			$request = $requestMgr->findBySeq($_REQUEST['requestSeq']);
			$specsFieldTypeArr = $requestSpecsFieldMgr->getSpecsFieldsTypeWithNameTitleByRequestTypeSeq($request->getRequestTypeSeq());
			$historyLog = $requestLogMgr->historyLogHtml($requestLogHistory,$specsFieldTypeArr,$isAppendingHistory);
		// }else{
		// 	$requestLogHistory = $requestLogMgr->getRequestLogs(null,$_REQUEST['requestSeq'],null,true);
		// 	$request = $requestMgr->findBySeq($_REQUEST['requestSeq']);
		// 	$specsFieldTypeArr = $requestSpecsFieldMgr->getSpecsFieldsTypeWithNameTitleByRequestTypeSeq($request->getRequestTypeSeq());
		// 	$historyLog = $requestLogMgr->historyLogHtml($requestLogHistory,$specsFieldTypeArr,$isAppendingHistory);
		// }
		$response['data'] = $historyLog;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "exportFilterData"){
	try{
		$filterId = $_POST['filterId'];
		// $requetExportAndFileName = $requestMgr->exportFilterData($filterId);
		$requestMgr->exportRequests("",$filterId);
		PHPExcelUtil::exportRequests($requetExportAndFileName['requests'],$requetExportAndFileName['fileName']);
		return;
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
if($call == "export"){
	try{
		$queryString = $_GET["queryStringForRequests"];
		$requestSeqs = $_GET["requestSeqs"];
		$filterId = $_GET["filterId"];
		$requestMgr->exportRequests($queryString,$filterId,$requestSeqs);
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
if($call == "getRequestsDueToday"){
	try{
		$requests = $requestMgr->getAllRequestsDueToday(BeanReturnDataType::grid);
		echo json_encode($requests);
		return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getRequestsDueInNextWeek"){
	try{
		$requests = $requestMgr->getRequestsDueInNextWeek(BeanReturnDataType::grid);
		echo json_encode($requests);
		return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getRequestsDuePassed"){
	try{
		$requests = $requestMgr->getRequestDuePassed(BeanReturnDataType::grid);
		echo json_encode($requests);
		return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getAssigneeRequestsDueToday"){
	try{
		$requests = $requestMgr->getAssigneeRequestsDueToday(BeanReturnDataType::grid);
		echo json_encode($requests);
		return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getAssigneeRequestsDueInNextWeek"){
	try{
		$requests = $requestMgr->getAssigneeRequestsDueInNextWeek(BeanReturnDataType::grid);
		echo json_encode($requests);
		return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "getAssigneeRequestsDuePassed"){
	try{
		$requests = $requestMgr->getAssigneeRequestsDuePassed(BeanReturnDataType::grid);
		echo json_encode($requests);
		return;
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}
if($call == "deleteRequest"){
	$ids = $_GET["ids"];
	try{
		$requestMgr->deleteBySeqs($ids);
		$message = "Deleted Successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
	}
}
if($call == "deleteAttachment"){
	try{
		$attachmentSeq = $_REQUEST['attachmentseq'];
		$attachmentName = $_REQUEST['attachmentname'];
		$requestSeq = $_REQUEST['requestseq'];
		$attachmentTitle = $_REQUEST['attachmenttitle'];
		$response['data'] = $requestAttachmentMgr->deleteAttachment($attachmentSeq,$attachmentName);
		$requestLogArr['requestseq'] = $requestSeq;
		$requestLogArr['oldvalue'] = "";
		$requestLogArr['newvalue'] = $attachmentTitle;
		$requestLogArr['attribute'] = "deleteattachment";
		$requestLogArr['createdby'] = $loggedInUserSeq;
		$requestLogArr['createdon'] = date('Y-m-d h:i:s');
		$requestLogArr['requesttypeseq'] = '';
		$requestLogMgr = RequestLogMgr::getInstance();
		$requestLogSeq = $requestLogMgr->save($requestLogArr);
	}catch(Exception $e){
		$message = $e->getMessage();
		$success = 0;
	}
}

$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
?>