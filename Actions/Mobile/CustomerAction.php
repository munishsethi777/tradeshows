<?php
require_once('../../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/BuyerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ImageUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/FileUtil.php");
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
$buyerMgr = BuyerMgr::getInstance();
if($call == "getCustomerBySeq"){
    try{
        if(isset($_REQUEST["customerseq"]) && !empty($_REQUEST["customerseq"])){
            $userSeq = $sessionUtil->getUserLoggedInSeq();
            $response["customer"] = $customerMgr->findArrBySeq($_REQUEST["customerseq"]);
        }else{
            throw new Exception("customerseq param null!");
        }
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getBuyerBySeq"){
    try{
        if(isset($_REQUEST["buyerseq"]) && !empty($_REQUEST["buyerseq"])){
            $userSeq = $sessionUtil->getUserLoggedInSeq();
            $response["buyer"] = $buyerMgr->findArrBySeq($_REQUEST["buyerseq"]);
        }else{
            throw new Exception("buyerseq param null!");
        }
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
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
            //$response = $customerMgr->getCustomerDetailBySeq($customerSeq);
            //$response["customer"] = $customerMgr->findArrBySeq($customerSeq);
            $response = $customerMgr->getCustomerDetailsWithBuyers($customerSeq);
        }else{
            throw new Exception("customerseq param null!");
        }
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}

if($call == "getBuyerDetail"){
    try{
        if(isset($_REQUEST["buyerseq"]) && !empty($_REQUEST["buyerseq"])){
            $buyerSeq = $_REQUEST["buyerseq"];
            $response = $buyerMgr->getBuyerDetailBySeq($buyerSeq);
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
        $customerData = $_REQUEST["customer"];
        $customerData = json_decode($customerData,true);
        $customer->from_array($customerData);
        $customer->setCreatedon(new DateTime());
        $customer->setLastmodifiedon(new DateTime());
        $id = $customerMgr->saveCustomerObject($customer,false);
        if($id > 0){
            $response["customerseq"] = (int)$id;;
        }
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
if($call == "addBuyer"){
    try{
        $buyer = new Buyer();
        $buyerData = $_REQUEST["buyer"];
        $buyerData = json_decode($buyerData,true);
        $buyer->from_array($buyerData);
        $buyer->setCreatedon(new DateTime());
        $buyer->setLastmodifiedon(new DateTime());
        $id = $buyerMgr->saveBuyer($buyer);
        if($id > 0){
            $response["buyerseq"] =  (int)$id;
        }
        if(empty($buyer->getSeq())){
            $message = StringConstants::BUYER_SAVED_SUCCESSFULLY;
        }else{
            $message = StringConstants::BUYER_UPDATE_SUCCESSFULLY;
        }
        $imageName = "";
        if($_FILES["imagefile"]){
            $file = $_FILES["imagefile"];
            $uploaddir = $ConstantsArray["imagefolderpath"]."/buyerimages/";
            $imageName = ImageUtil::uploadUserImage($file,$id,$uploaddir);
        }
        $buyerMgr->updateBuyerImage($id, $imageName);
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "deleteCustomers"){
    $ids = $_GET["customerseq"];
    try{
        if(isset($_REQUEST["customerseq"]) && !empty($_REQUEST["customerseq"])){
            $customerMgr->deleteByCustomerSeq($ids);
            $message = StringConstants::CUSTOMERS_DELETE_SUCCESSFULLY;
        }else{
            throw new Exception("customerseqs param null!");
        }
    }catch(Exception $e){
        $success = 0;
        $message = $e->getMessage();
    }
}
if($call == "deleteBuyer"){
    $ids = $_GET["buyerseq"];
    try{
        if(isset($_REQUEST["buyerseq"]) && !empty($_REQUEST["buyerseq"])){
            $buyerMgr->deleteByBuyerSeq($ids);
            $message = StringConstants::BUYER_DELETE_SUCCESSFULLY;
        }else{
            throw new Exception("buyerseq param null!");
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