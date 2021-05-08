<?php
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestTypeMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestStatusMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestSpecsFieldMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");  
    
    $success = 1;
    $call = "";
    $redirect = "";
    $message="";
    $requestTypeMgr = RequestTypeMgr::getInstance();
    $requestStatusMgr = RequestStatusMgr::getInstance();
    $requestSpecsFieldMgr = RequestSpecsFieldMgr::getInstance();
    $sessionUtil = SessionUtil::getInstance();
    $loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call == "saveRequestType"){
        try{
            $message = StringConstants::REQUEST_TYPE_SAVED_SUCCESSFULLY;
            $requestTypeSeq = $requestTypeMgr->save($_REQUEST,$loggedInUserSeq);
            if(isset($_REQUEST['seq']) && !empty($_REQUEST['seq'])){
                //$requestStatusMgr->deleteByRequestTypeSeq($_REQUEST['seq']);
                //$requestSpecsFieldMgr->deleteByRequestTypeSeq($_REQUEST['seq']);
                $message = StringConstants::REQUEST_TYPE_UPDATED_SUCCESSFULLY;
            }
            $requestStatusMgr->save($_REQUEST,$loggedInUserSeq,$requestTypeSeq);
            $requestSpecsFieldMgr->save($_REQUEST,$requestTypeSeq);
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    if($call == "getAllRequestTypesForGrid"){
        try{
            $allRequestTypesForGrid = $requestTypeMgr->getAllRequestTypes();
            echo json_encode($allRequestTypesForGrid);
            return;
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    if($call=="getRequestStatusAndRequestsFieldsByRequestTypeSeq"){
        try{
            $dataArr = array();
            $tempSpecsFieldArr = array();
            $requestTypeSeq = $_REQUEST['requestTypeSeq'];
            $isRequestTypeUsed = $requestTypeMgr->isRequestTypeUsed($requestTypeSeq);
            $requestStatusArrTemp = $requestStatusMgr->findByRequestTypeSeq($requestTypeSeq);
            $requestStatusArr = [];
            foreach($requestStatusArrTemp as $requestStatus){
                $requestStatus['isRequestTypeUsed'] = $isRequestTypeUsed;
                array_push($requestStatusArr,$requestStatus);
            }
            $requestSpecsFieldArrOfArr = $requestSpecsFieldMgr->findByRequestTypeSeq($requestTypeSeq);
            foreach($requestSpecsFieldArrOfArr as $key => $arr){
               if(isset($arr['details'])){
                    $arr['details'] = str_replace(",", "\n", $arr['details']);
               }
               $arr['isRequestTypeUsed'] = $isRequestTypeUsed;
               array_push($tempSpecsFieldArr,$arr);
            }
            $dataArr['requestStatus'] = $requestStatusArr;
            $dataArr['requestSpecsFields'] = $tempSpecsFieldArr;
            $response["data"] = $dataArr;
        }catch(Exception $e){
            $success = 0;
            $message = $e->getMessage();
        }
    }
    if($call == "getRequestTypesByDepartmentSeq"){
        $departmentSeq = $_REQUEST['departmentSeq'];
        $requestTypes = $requestTypeMgr->findByDepartmentSeqForDropDown($departmentSeq);
        $response['data'] = $requestTypes;
    }
    if($call == "deleteRequestType"){
        $ids = $_GET["ids"];
        try{
            $requestTypeMgr->deleteBySeqs($ids);
            $message = "Deleted Successfully";
        }catch(\Exception $e){
            $success = 0;
            $message = $e->getMessage();
            $constraintName = "deleterequesttype";
            if(strpos($message,$constraintName) !== false){
                $message = "Can not delete this project type as it is used in other project";
            }
        }
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);
?>