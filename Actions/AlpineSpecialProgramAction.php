<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/AlpineSpecialProgramMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
$sessionUtil = SessionUtil::getInstance();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$AlpineSpecialProgMgr = AlpineSpecialProgramMgr::getInstance();
if($call == "saveAlpineProg"){
    try{
        $message = StringConstants::ALPINE_PROG_SAVED_SUCCESSFULLY;
        $seq =  $_REQUEST["seq"];
        $AlpineSpecialProg = new AlpineSpecialProgram();
        $AlpineSpecialProg->from_array($_REQUEST);
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
        $AlpineSpecialProgMgr->saveAlpineSpecialProgram($AlpineSpecialProg);
    }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);