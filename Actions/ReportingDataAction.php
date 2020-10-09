<?php 
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] . "Managers/ReportingDataMgr.php");
    require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataParameterType.php");
    
    $success=1;
    $message='';
    $call = "";
    $response = new ArrayObject();
    $reportingDataMrg = ReportingDataMgr::getInstance();
    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call == "getReportingData"){
           $arr = array();
           
           $reportingDataParameterTypeClass = new ReflectionClass (ReportingDataParameterType);
           $reportingDataParameterTypeConstants = $reportingDataParameterTypeClass->getConstants();
                     
           foreach ($reportingDataParameterTypeConstants as $key => $value ){
               $value = lcfirst(str_replace(" ","",$value));
               $list = $reportingDataMrg->getGraphicReportData($key);
               $arr[$value.'Current'] = $list[0]['count'];
               $arr[$value.'Previous'] = $list[1]['count'];
               $arr[$value.'Diff'] = $list[0]['count']-$list[1]['count'];
               $earlierCounts = array();
               foreach ($list as $count){
                   array_push($earlierCounts,$count['count']);
               }
               $earlierCounts = array_reverse($earlierCounts);
               $arr[$value.'Percent'] = "50"."%";
               $arr[$value.'ThirtyDays'] = implode(',',$earlierCounts);
               $arr[$value.'ChangeArrow'] = ($list[0]['count']>$list[1]['count'])?'fa-level-up':'fa-level-down';
               $arr[$value.'ChangeColor'] = ($list[0]['count']>$list[1]['count'])?'skyblue':'red';
           }          
           $response["data"] = $arr;
           
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);


?>
