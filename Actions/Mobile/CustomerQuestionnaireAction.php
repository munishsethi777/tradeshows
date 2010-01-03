<?php
require_once('../../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/AlpineSpecialProgramMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerOppurtunityBuyMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerSpringQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerChristmasQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/SeasonShowNameType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
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
		$customerSeq = $_REQUEST["customerSeq"];
		$oppurtunityDetail = $oppBuysMgr->findArrByCustomerSeq($customerSeq);
		$response["oppurtunityBuysDetails"] =  $oppurtunityDetail;
	}catch (Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getSpringQuestionDetails"){
	try{
		$customerSeq = $_REQUEST["customerSeq"];
		$springQuestion = $springQuesMgr->findCategoryAndSeqByCustomerSeq($customerSeq);
		$response["springQues"] =  $springQuestion;
	}catch (Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "getChristmasQuestionDetails"){
	try{
		$customerSeq = $_REQUEST["customerSeq"];
		$christQuesDetail = $christmasQuesMgr->findArrByCustomerSeq($customerSeq);
		$response["christmasQuestionDetails"] =  $christQuesDetail;
	}catch (Exception $e){
		$success = 0;
		$message  = $e->getMessage();
	}
}
if($call == "saveAlpineProg"){
    try{
        $message = StringConstants::ALPINE_PROG_SAVED_SUCCESSFULLY;
        $seq =  $_REQUEST["seq"];
        $AlpineSpecialProg = new AlpineSpecialProgram();
        $splProg = $_REQUEST["specialProg"];
        $splProg = json_decode($splProg,true);
        $AlpineSpecialProg->from_array($splProg);
        if(!empty($AlpineSpecialProg->getStartDate()) && !empty($AlpineSpecialProg->getEndDate())){
            if($AlpineSpecialProg->getStartDate() > $AlpineSpecialProg->getEndDate()){
                throw new Exception("End date should be greater than start date!");
            }
        }
        if(empty($AlpineSpecialProg->getIsDefectiveAllowancesigned())){
            $AlpineSpecialProg->setDefectivePercent(null);
        }
        if($seq > 0){
            $message = StringConstants::ALPINE_PROG_UPDATED_SUCCESSFULLY;
        }
        $specialProgramMgr->saveAlpineSpecialProgram($AlpineSpecialProg);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "saveChristmasQuestionDetail"){
    try{
        $message = StringConstants::CHRISTMAS_QUESTION_SAVED_SUCCESSFULLY;
        $christmasQuesObj = new CustomerChristmasQuestion();
        $christmasQues = $_REQUEST["christmasQues"];
        $christmasQues = json_decode($christmasQues,true);
        $christmasQuesObj->from_array($christmasQues);
        $christmasQuesMgr->saveCustomerSpecialProgram($christmasQuesObj);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "saveSpringQuestionDetail"){
    try{
        $message = StringConstants::SAVED_SUCCESSFULLY;
        $springQuesObj = new CustomerSpringQuestion();
        $springQues = $_REQUEST["springQues"];
        $springQues = json_decode($springQues,true);
        $springQuesObj->from_array($springQues);
        $id = $springQuesMgr->saveSpringQuestion($springQuesObj);
        $response["seq"] = (int)$id;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "saveOppurtunityQuestionDetail"){
    try{
        $message = StringConstants::OPPURTUNITY_QUESTION_SAVED_SUCCESSFULLY;
        $customerOppurtunityBuyObj = new CustomerOppurtunityBuy();
        $customerOppurtunityQues = $_REQUEST["customerOppurtunityQues"];
        $customerOppurtunityQues = json_decode($customerOppurtunityQues,true);
        $customerOppurtunityBuyObj->from_array($customerOppurtunityQues);
        if(!empty($customerOppurtunityBuyObj->getTradeshowsGoingTo())){
            $tradeGoingToArr = explode(", ", $customerOppurtunityBuyObj->getTradeshowsGoingTo());
            $arr = array();
            foreach ($tradeGoingToArr as $tradeGoingTo){
                $name = SeasonShowNameType::getName($tradeGoingTo);
                array_push($arr,$name);
            }
            $customerOppurtunityBuyObj->setTradeshowsGoingTo(implode(",", $arr));
        }
        $oppBuysMgr->saveOppurtunityBuy($customerOppurtunityBuyObj);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "getSpringQuestionDetailBySeq"){
    try{
        $seq = $_REQUEST["seq"];
        $springQuestion = $springQuesMgr->findArrBySeq($seq);
        $response["springQues"] =  $springQuestion;
    }catch (Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == "deleteSpringQuestion"){
    try{
        if(isset($_REQUEST["seq"]) && !empty($_REQUEST["seq"])){
            $springQuesMgr->deleteBySeq($_REQUEST["seq"]);
            $message = StringConstants::DELETED_SUCCESSFULLY;
        }else{
            throw new Exception("seq param null!");
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