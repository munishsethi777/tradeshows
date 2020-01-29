<?php
require_once('../../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$sessionUtil = SessionUtil::getInstance();
$userMgr = UserMgr::getInstance();
$call = "";
if(isset($_REQUEST["call"])){
    $call = $_REQUEST["call"];
}
$success = 1;
$message = "";
$response = new ArrayObject();
$sessionUtil->createMobileUserSession($_REQUEST);
$userSeq = $sessionUtil->getUserLoggedInSeq();
$message = $userMgr->isValidForMobile($userSeq);
if(!empty($message)){
    $success = 0;
    $call = "";
}
$customerMgr = CustomerMgr::getInstance();
if($call == "getAllCustomerNames"){
    try{
        $userSeq = $sessionUtil->getUserLoggedInSeq();
        $response["customers"] = $customerMgr->getAllCustomerNames();
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getCustomerDetails"){
    try{
        if(isset($_REQUEST["customerseq"]) && !empty($_REQUEST["customerseq"])){
            $customerSeq = $_REQUEST["customerseq"];
            $response["customerDetail"] = $customerMgr->findArrBySeq($customerSeq);
        }else{
            throw new Exception("customerseq param null!");
        }
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "addCustomer"){
    try{
        $customer = new Customer();
        $customer = $customer->from_array($_REQUEST);
        $customerMgr->saveCustomerObject($customer);
        if(empty($customer->getSeq())){
            $message = StringConstants::CUSTOMER_SAVED_SUCCESSFULLY;
        }else{
            $message = StringConstants::CUSTOMER_UPDATE_SUCCESSFULLY;
        }
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "deleteCustomers"){
    $ids = $_GET["customerseqs"];
    try{
        if(isset($_REQUEST["customerseqs"]) && !empty($_REQUEST["customerseqs"])){
            $customerMgr->deleteByCustomerSeq($ids);
            $message = StringConstants::CUSTOMERS_DELETE_SUCCESSFULLY;
        }else{
            throw new Exception("customerseq param null!");
        }
    }catch(Exception $e){
        $success = 0;
        $message = $e->getMessage();
    }
}
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header("Content-type: application/json");
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;