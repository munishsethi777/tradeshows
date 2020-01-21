<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerOppurtunityBuyMgr.php");
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
$customerOppurtunityBuyMgr = CustomerOppurtunityBuyMgr::getInstance();
if($call == "saveOppurtunityBuy"){
    try{
        $message = StringConstants::SAVED_SUCCESSFULLY;
        $seq =  $_REQUEST["seq"];
        $customerOppurtunityQuestion = new CustomerOppurtunityBuy();
        $customerOppurtunityQuestion->from_array($_REQUEST);
        if($seq > 0){
            $message = StringConstants::UPDATED_SUCCESSFULLY;
        }
        $customerOppurtunityBuyMgr->saveOppurtunityBuy($customerOppurtunityQuestion);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);