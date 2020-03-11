<?php
require_once('../../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/BuyerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomerRegularTermsType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/DefectiveAllowanceDeductionsType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/FreightType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/XmasItemFromType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/SeasonShowNameType.php");
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
if($call == "getBusinessTypes"){
    try{
        $businessTypes = CustomerBusinessType::getAll();
        $businessTypes[""] = StringConstants::SELECT_ANY;
        $response["businessTypes"] = $businessTypes;
        $priority = PriorityType::getAll();
        $priority[""] = StringConstants::SELECT_ANY;
        $response["priorityTypes"] = $priority;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getCategoryTypes"){
    try{
        $categoryTypes = BuyerCategoryType::getAll();
        $categoryTypes[""] = StringConstants::SELECT_ANY;
        $response["categoryTypes"] = $categoryTypes;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getTimeZones"){
    try{
        $timeZones = TimeZone::$timezone;
        $timeZones[""] = StringConstants::SELECT_ANY;
        $response["timezones"] = $timeZones;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getEnumsForSpecialProg"){
    try{
        $regularTerms = CustomerRegularTermsType::getAll();
        $response["regularterms"] = $regularTerms;
        
        $items = FreightType::getAll();
        $response["freighttypes"] = $items;
        
        $items = DefectiveAllowanceDeductionsType::getAll();
        $response["allowancedeductionstype"] = $items;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getQuestionnaireEnums"){
    try{
        $year = array("2020"=>"2020","2021"=>"2021");
        $response["year"] = $year;
        $items = XmasItemFromType::getAll();
        $response["customerselectxmasitemsfrom"] = $items;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getOppurtunityQuestionEnums"){
    try{
        $year = array("2020"=>"2020","2021"=>"2021");
        $response["year"] = $year;
        $items = SeasonShowNameType::getAll();
        $response["seasonShowNameTypes"] = $items;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getSpringQuestionEnums"){
    try{
        $categoryTypes = BuyerCategoryType::getAll();
        $response["categoryTypes"] = $categoryTypes;
        $year = array("2020"=>"2020","2021"=>"2021");
        $response["year"] = $year;
        
    }catch(Exception $e){
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