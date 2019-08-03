<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/EmailLogMgr.php");
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
$emailLogMgr = EmailLogMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();

if($call == "getEmailLog"){
    $json = $emailLogMgr->getEmailLogsForGrid();
    echo json_encode($json);
    return;
}
if($call == "export"){
    try{
        $queryString = $_GET["queryString"];
        $response = $emailLogMgr->exportEmailLogs($queryString);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}




$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;
?>