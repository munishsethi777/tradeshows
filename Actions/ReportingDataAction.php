<?php 
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] . "Managers/ReportingDataMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataParameterType.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/ReportingDataMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataMethodNames.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/InstructionManualLogsMgr.php");
    
    
    $success=1;
    $message='';
    $call = "";
    $response = new ArrayObject();
    $reportingDataMrg = ReportingDataMgr::getInstance();
    $arr = array();  
    $reportingDataParameterTypeClass = new ReflectionClass (ReportingDataParameterType);
    $reportingDataParameterTypeConstants = $reportingDataParameterTypeClass->getConstants();
    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call == "getReportingData"){
        foreach ($reportingDataParameterTypeConstants as $key => $value ){
                if(isset($_REQUEST['for'])){
                if(strpos($key,$_REQUEST['for']) !== false){
                    // $value = lcfirst(str_replace(" ","",$value));
                    $list = $reportingDataMrg->getReportingData($key);
                    $current = $list[0]['count'];
                    if(strpos($key,'qc_') !== false){
                        $object = QCScheduleMgr::getInstance();
                        $current = count(call_user_func(array($object,ReportingDataMethodNames::getValue($key)),""));
                    }elseif(strpos($key,'container_') !== false){
                        $object = ContainerScheduleDataStore::getInstance();
                        $current = count(call_user_func(array($object,ReportingDataMethodNames::getValue($key)),""));
                    }elseif(strpos($key,'graphiclog_') !== false){
                        $object = ReportingDataMgr::getInstance();
                        $current = call_user_func(array($object,ReportingDataMethodNames::getValue($key)),"");
                    }elseif(strpos($key,'instruction_manual_') !== false){
                        $object = InstructionManualLogsMgr::getInstance();
                        $current = call_user_func(array($object,ReportingDataMethodNames::getValue($key)),"");
                    }
                    $arr[$key.'_current'] = $current;
                    $arr[$key.'_previous'] = $list[1]['count'];
                    $arr[$key.'_diff'] = abs($list[0]['count']-$list[1]['count']);
                    $earlierCounts = array();
                    foreach ($list as $count){
                        array_push($earlierCounts,$count['count']);
                    }
                    $earlierCounts = array_reverse($earlierCounts);
                    $arr[$key.'_percent'] = "";
                    $arr[$key.'_thirty_days'] = implode(',',$earlierCounts);
                    // $arr[$key.'_change_arrow'] = ($list[0]['count']>$list[1]['count'])?'fa-level-up':'fa-level-down';
                    // $arr[$key.'_change_color'] = ($list[0]['count']>$list[1]['count'])?'green':'red';
                    // if(isset($list[1])){
                    //     if($list[0]['count']==$list[1]['count']){
                    //         $arr[$key.'_change_arrow'] = "fa-arrows-h";
                    //         $arr[$key.'_change_color'] = "grey";
                    //     }
                    // }
                    if(isset($list[1])){
                        if($list[0]['count']>$list[1]['count']){
                            $arr[$key.'_change_arrow'] = 'fa-level-up';
                            $arr[$key.'_change_color'] = 'green';
                        }elseif($list[0]['count']==$list[1]['count']){
                            $arr[$key.'_change_arrow'] = "fa-arrows-h";
                            $arr[$key.'_change_color'] = "grey";
                        }else{
                            $arr[$key.'_change_arrow'] = 'fa-level-down';
                            $arr[$key.'_change_color'] = 'red';
                        }
                    }else{
                        $arr[$key.'_change_arrow'] = "fa-arrows-h";
                            $arr[$key.'_change_color'] = "grey";
                    }
                    
                }
            }
        }
        $response["data"] = $arr;
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);


?>
