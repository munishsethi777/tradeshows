<?php
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestTypeMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestStatusMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestSpecsFieldMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");

    $success = 1;
    $call = "";
    $redirect = "";
    $message="";
    $requestTypeMgr = RequestTypeMgr::getInstance();
    $requestStatusMgr = RequestStatusMgr::getInstance();
    $requestSpecsFieldMgr = RequestSpecsFieldMgr::getInstance();
    $sessionUtil = SessionUtil::getInstance();
    $loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call=="getRequestStatusByRequestTypeSeq"){
        $requestTypeSeq = $_REQUEST['requestTypeSeq'];
        $response['data'] = $requestStatusMgr->findByRequestTypeSeq($requestTypeSeq);
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);
?>