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
               $current = $list[0]['count'];
               if($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_due_for_today_count)){
                   $current = $reportingDataMrg->getProjectsDueForTodayCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_due_less_than_20_days_from_entry_date_count)){
                   $current = $reportingDataMrg->getProjectDueLessThan20DaysFromEntryDateCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_due_less_than_20_days_from_today_count)){
                   $current = $reportingDataMrg->getProjectDueLessThan20DaysFromTodayCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_missing_info_from_china_count)){
                   $current = $reportingDataMrg->getProjectMissingInfoFromChinaCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_passed_due_with_missing_info_from_china_count)){
                   $current = $reportingDataMrg->getProjectPassedDueWithMissingInfoFromChinaCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_completed_count)){
                   $current = $reportingDataMrg->getProjectsCompletedCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_in_buyer_review_count)){
                   $current = $reportingDataMrg->getProjectsInBuyerReviewCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_in_manager_review_count)){
                   $current = $reportingDataMrg->getProjectsInManagerReviewCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_in_robby_review_count)){
                   $current = $reportingDataMrg->getProjectsInRobbyReviewCount();
               }elseif($key == ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_over_due_till_now_count)){
                   $current = $reportingDataMrg->getProjectsOverDueTillNowCount();
               }
               
               $arr[$value.'Current'] = $current;
               $arr[$value.'Previous'] = $list[1]['count'];
               $arr[$value.'Diff'] = $list[0]['count']-$list[1]['count'];
               $earlierCounts = array();
               foreach ($list as $count){
                   array_push($earlierCounts,$count['count']);
               }
               $earlierCounts = array_reverse($earlierCounts);
               $arr[$value.'Percent'] = "";
               $arr[$value.'ThirtyDays'] = implode(',',$earlierCounts);
               $arr[$value.'ChangeArrow'] = ($list[0]['count']>$list[1]['count'])?'fa-level-up':'fa-level-down';
               $arr[$value.'ChangeColor'] = ($list[0]['count']>$list[1]['count'])?'green':'red';
               if($list[0]['count']==$list[1]['count']){
                   $arr[$value.'ChangeArrow'] = "fa-arrows-h";
                   $arr[$value.'ChangeColor'] = "grey";
               }
           }          
           $response["data"] = $arr;
           
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);


?>
