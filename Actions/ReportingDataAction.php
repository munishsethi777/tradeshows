<?php 
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] . "Managers/ReportingDataMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataParameterType.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/ReportingDataMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataMethodNames.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/InstructionManualLogsMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/GraphicLogMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/QCScheduleMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/ContainerScheduleMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Managers/RequestMgr.php");
    
    
    $success=1;
    $message='';
    $call = "";
    $response = new ArrayObject();
    $reportingDataMrg = ReportingDataMgr::getInstance();
    $arr = array();  
    $reportingDataParameterTypeClass = new ReflectionClass ("ReportingDataParameterType");
    $reportingDataParameterTypeConstants = $reportingDataParameterTypeClass->getConstants();
    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call == "getReportingData"){// Action works to get dashboard counts only
        try{
            foreach ($reportingDataParameterTypeConstants as $key => $value ){
                if(isset($_REQUEST['for'])){
                    if(strpos($key,$_REQUEST['for']) !== false){
                        // $earlierCounts = array();
                        // for($ec=0;$ec<10;$ec++){
                        //     array_push($earlierCounts, rand(40,70));
                        // }
                        $earlierCounts = $reportingDataMrg->getReportingData($key);
                        $current = "";
                        if(strpos($key,'qc_') !== false){
                            $object = QCScheduleMgr::getInstance();
                            $current = count(call_user_func(array($object,ReportingDataMethodNames::getValue($key)),BeanReturnDataType::count));
                        }
                        elseif(strpos($key,'container_') !== false){
                            $object = ContainerScheduleMgr::getInstance();
                            $current = call_user_func(array($object,ReportingDataMethodNames::getValue($key)),BeanReturnDataType::count);
                        }elseif(strpos($key,'graphiclog_') !== false){
                            $object = GraphicLogMgr::getInstance();
                            $current = call_user_func(array($object,ReportingDataMethodNames::getValue($key)),BeanReturnDataType::count);
                        }elseif(strpos($key,'instruction_manual_') !== false){
                            $object = InstructionManualLogsMgr::getInstance();
                            $current = call_user_func(array($object,ReportingDataMethodNames::getValue($key)),BeanReturnDataType::count);
                        }elseif(strpos($key,'request_management_') !== false){
                            $object = RequestMgr::getInstance();
                            $current = call_user_func(array($object,ReportingDataMethodNames::getValue($key)),BeanReturnDataType::count);
                        }
                        $arr[$key.'_current'] = $current;
                        $arr[$key.'_previous'] = sizeof($earlierCounts) >= 2 ? $earlierCounts[1]['count'] : "0";
                        $arr[$key.'_diff'] = sizeof($earlierCounts) >= 2 ? abs($earlierCounts[0]['count']-$earlierCounts[1]['count']) : "0";
                        $arr[$key.'_percent'] = "";
                        
                        if($object != RequestMgr::getInstance()){//Request/Project management does not has graphs supports
                            //Graph code starts
                            $i=0;
                            $earlierCountsNewArray = array();
                            if(count($earlierCounts) == 0){
                                $tmpArr = array('x'=> 0,'y'=>0);
                                array_push($earlierCountsNewArray,$tmpArr);
                            }else{
                                foreach ($earlierCounts as $count){
                                    $tmpArr = array('x'=> $i++,'y'=>(int)$count['count']);
                                    array_push($earlierCountsNewArray,$tmpArr);
                                }
                                array_push($earlierCountsNewArray,array('x'=> $i++,'y'=>(int)$current));
                            }
                            $arr[$key.'_thirty_days'] = $earlierCountsNewArray;
                            //Graph code ends
                        }
                        
                        
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
        }catch(Exception $e){
            $success = 0;
		    $message  = $e->getMessage();
        }
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);


?>
