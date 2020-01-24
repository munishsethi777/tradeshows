<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerSpringQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
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
$CustomerSpringQuestionMgr = CustomerSpringQuestionMgr::getInstance();
if($call == "saveSpringQuestion"){
    try{
        $message = StringConstants::SAVED_SUCCESSFULLY;
        $seq =  $_REQUEST["seq"];
        $customerSpringQuestion = new CustomerSpringQuestion();
        $customerSpringQuestion->from_array($_REQUEST);
        if($seq > 0){
            $message = StringConstants::UPDATED_SUCCESSFULLY;
        }
        $id = $CustomerSpringQuestionMgr->saveSpringQuestion($customerSpringQuestion);
        $response["seq"] = $id;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}

if($call == "getByCustoimerSeq"){
    try{
        $customerSeq =  $_REQUEST["customerseq"];
        $customerSpringQuestion = $CustomerSpringQuestionMgr->findArrByCustomerSeq($customerSeq);
        $response["data"] = json_encode($customerSpringQuestion);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "deleteBySeq"){
    try{
        $seq =  $_REQUEST["seq"];
        $flag = $CustomerSpringQuestionMgr->deleteBySeq($seq);
        if($flag){
            $message = "Deleted Successfully";
        }else{
            $message = "Action not completed,Server Error!";
            $success = 0; 
        }
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);