<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerChristmasQuestionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
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
$customerChristmassQuesMgr = CustomerChristmasQuestionMgr::getInstance();
if($call == "saveChristmasQuestion"){
    try{
        $message = StringConstants::SAVED_SUCCESSFULLY;
        $seq =  $_REQUEST["seq"];
        $christmasQuestion = new CustomerChristmasQuestion();
        $christmasQuestion->from_array($_REQUEST);
        if(isset($_REQUEST['isallcategoriesselected'])){
            $christmasQuestion->setIsAllCategoriesSelected(1);
        }else{
            $christmasQuestion->setIsAllCategoriesSelected(0);
        }
        $category = "";
        if(isset($_REQUEST['category'])){
            $category = implode(",",$_REQUEST['category']);
        }
        // $tradeShowsAreGoingTo = implode(",",$_REQUEST['tradeshowsaregoingto']);
        $christmasQuestion->setCategory($category);
        $christmasQuestion->setTradeShowsAreGoingTo($_REQUEST['tradeshowsaregoingto']);
        $christmasQuestion->setCategoriesShouldSellThem($_REQUEST['categoriesshouldsellthem']);
        // $christmasQuestion->setXmasSampleSentDate(DateUtil::convertDateToFormat($_REQUEST['xmassamplesentdate'],'m-d-Y','Y-m-d'));
        $christmasQuestion->setIsQuestionnaireCompleted(isset($_REQUEST['isquestionnairecompleted']) && $_REQUEST['isquestionnairecompleted'] == 'on' ? 1 : 0);
        if($seq > 0){
           $message = StringConstants::UPDATED_SUCCESSFULLY;
        }
    //   var_dump($_REQUEST);
        $id = $customerChristmassQuesMgr->saveCustomerSpecialProgram($christmasQuestion);
        $response["seq"] = $id;
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
if($call == 'getByCustomerSeq'){
    try{
        $customerSeq =  $_REQUEST["customerseq"];
        $customerChristmasQuestion = $customerChristmassQuesMgr->findArrByCustomerSeq($customerSeq);
        $response["data"] = $customerChristmasQuestion;
    }catch(Exception $e){
        $message = $e->getMessage();
        $success = 0;
    }
}
if($call == "deleteBySeq"){
    try{
        $seq =  $_REQUEST["seq"];
        $flag = $customerChristmassQuesMgr->deleteBySeq($seq);
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