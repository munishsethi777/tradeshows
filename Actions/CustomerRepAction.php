<?php
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerRepMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");  

    $success = 1;
    $message ="";
    $call = "";
    $response = new ArrayObject();
    $sessionUtil = SessionUtil::getInstance();
    $customerRepMgr = CustomerRepMgr::getInstance();

    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call == 'saveCustomerRep'){
        try{
            $customerRepMgr->save($_REQUEST);
            $message = StringConstants::CUSTOMER_REP_SAVED_SUCCESSFULLY;
            if(isset($_REQUEST['seq']) && $_REQUEST['seq'] != ""){
                $message = StringConstants::CUSTOMER_REP_UPDATE_SUCCESSFULLY;
            }
        }catch(Exception $e){
            $message = $e->getMessage();
            $success = 0;
        }
    }
    if($call == 'getAllCustomersRep'){
        try{
            $customerReps = $customerRepMgr->getAllCustomerReps();
            $response['data'] = $customerReps;
        }catch(Exception $e){
            $message = $e->getMessage();
            $success = 0;
        }
    }
    if($call == "deleteCustomerRep"){
        $ids = $_GET["ids"];
        try{
            $flag = $customerRepMgr->deleteBySeqs($ids);
            $message = "Deleted Successfully";
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    $response["success"] = $success;
    $response["message"] = $message;
    echo json_encode($response);
?>