<?php
require_once('../../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/AlpineSpecialProgramMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerOppurtunityBuyMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerSpringQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerChristmasQuestionMgr.php");
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
$specialProgramMgr = AlpineSpecialProgramMgr::getInstance();
$oppBuysMgr = CustomerOppurtunityBuyMgr::getInstance();
$springQuesMgr = CustomerSpringQuestionMgr::getInstance();
$christmasQuesMgr = CustomerChristmasQuestionMgr::getInstance();
if($call == "getSpecialProgramDetails"){
    try{
        $customerSeq = $_REQUEST["customerSeq"];
        $splProg = $specialProgramMgr->findArrByCustomerSeq($customerSeq);
        $response["specialProg"] =  $splProg;
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getOppurtunityBuysDetails"){
	try{
		$customerSeq = $_REQUEST["customerseq"];
		$response = $oppBuysMgr->findArrByCustomerSeq($customerSeq);
	}catch (Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getSpringQuestionDetails"){
	try{
		$customerSeq = $_REQUEST["customerseq"];
		$response = $springQuesMgr->findArrByCustomerSeq($customerSeq);
	}catch (Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getChristmasQuestionDetails"){
	try{
		$customerSeq = $_REQUEST["customerseq"];
		$response = $christmasQuesMgr->findArrByCustomerSeq($customerSeq);
	}catch (Exception $e){
		$success = 0;
		$message  = $e->getMessage();
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