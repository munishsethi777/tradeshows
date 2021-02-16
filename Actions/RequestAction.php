<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Request.php");
$success = 1;
$call = "";
$response = new ArrayObject();
$requestMgr = RequestMgr::getInstance();
$departmentMgr = DepartmentMgr::getInstance();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
	
}
if($call == "getAllRequests"){
	$json = $requestMgr->getRequestsforGrid();
	echo json_encode($json);
	return;
}
if($call == "getRequestsDetails"){
	try{
		$request = $requestMgr->findArrBySeq($_GET["seq"]);
		$response["request"] = $request;
	}
	catch(Exception $e){
		$success=0;
		$message = $e->getMessage();
	}	
}

if($call == "deleteRequest"){

}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;
?>