<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/ReportingData.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/DepartmentType.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataParameterType.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/GraphicStatusType.php");
class ReportingDataMgr{
    private static $reportingDataMgr;
    private static $reportingDataDataStore;
    
    
    public static function getInstance(){
        if (!self::$reportingDataMgr){
            self::$reportingDataMgr = new ReportingDataMgr();
            self::$reportingDataDataStore = new BeanDataStore(ReportingData::$className,ReportingData::$tableName);
        }
        return self::$reportingDataMgr;
    }
    
    public function saveGraphicLogReportData(){
        $msg = array();
        try{
            $projetCompletedCount = $this->getProjectsCompletedCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projetCompletedCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_completed_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectsOverDueTillNowCount = $this->getProjectsOverDueTillNowCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectsOverDueTillNowCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_over_due_till_now_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectsInBuyerReviewCount = $this->getProjectsInBuyerReviewCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectsInBuyerReviewCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_in_buyer_review_count));
            self::$reportingDataDataStore->save($reportingData);
            
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectsInManagerReviewCount = $this->getProjectsInManagerReviewCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectsInManagerReviewCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_in_manager_review_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectsInRobbyReviewCount = $this->getProjectsInRobbyReviewCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectsInRobbyReviewCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_projects_in_robby_review_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectMissingInfoFromChinaCount = $this->getProjectMissingInfoFromChinaCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectMissingInfoFromChinaCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_missing_info_from_china_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectPassedDueWithMissingInfoFromChinaCount = $this->getProjectPassedDueWithMissingInfoFromChinaCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectPassedDueWithMissingInfoFromChinaCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_passed_due_with_missing_info_from_china_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectsDueForTodayCount = $this->getProjectsDueForTodayCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectsDueForTodayCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_due_for_today_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectDueLessThan20DaysFromEntryDateCount = $this->getProjectDueLessThan20DaysFromEntryDateCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectDueLessThan20DaysFromEntryDateCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_due_less_than_20_days_from_entry_date_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        try{
            $projectDueLessThan20DaysFromTodayCount = $this->getProjectDueLessThan20DaysFromTodayCount();
            $reportingData = new ReportingData();
            $reportingData->setCount($projectDueLessThan20DaysFromTodayCount);
            $reportingData->setDated(new DateTime());
            $reportingData->setDepartment(DepartmentType::getName(DepartmentType::Graphics_Logs));
            $reportingData->setParameter(ReportingDataParameterType::getName(ReportingDataParameterType::graphiclog_project_due_less_than_20_days_from_today_count));
            self::$reportingDataDataStore->save($reportingData);
        }
        catch(Exception $e){
            array_push($msg,$e->getMessage());
        }
        
        return $msg;
    }
    // 	Methods for dashboard
    
    public function getProjectsCompletedCount(){
        $query = "select COUNT(seq) from graphicslogs where graphiccompletiondate IS NOT NULL";
        $graphicsLogs = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $graphicsLogs;
    }
    
    public function getProjectsOverDueTillNowCount(){
        $query = "select COUNT(seq) from graphicslogs where finalgraphicsduedate < '". date('Y-m-d') ."' and graphiccompletiondate is null";
        $finalGraphicsDueDateCount = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return ($finalGraphicsDueDateCount);
    }
    
    public function getProjectsInBuyerReviewCount(){
        $query = "select COUNT(seq) from graphicslogs where graphicstatus like '".GraphicStatusType::getName(GraphicStatusType::buyers_reviewing)."'";
        $graphicsLogs = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $graphicsLogs;
    }
    
    public function getProjectsInManagerReviewCount(){
        $query = "select COUNT(seq) from graphicslogs where graphicstatus like '". GraphicStatusType::getName(GraphicStatusType::manager_reviewing)."'";
        $graphicsLogs = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $graphicsLogs;
    }
    public function getProjectsInRobbyReviewCount(){
        $query = "select COUNT(seq) from graphicslogs where graphicstatus like '". GraphicStatusType::getName(GraphicStatusType::robby_reviewing)."'";
        $graphicsLogs = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $graphicsLogs;
    }
    public function getProjectMissingInfoFromChinaCount(){
        $query = "select count(seq) from graphicslogs where graphicstatus like '". GraphicStatusType::getName(GraphicStatusType::missing_info_from_china)."'";
        $graphicsLogs = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $graphicsLogs;
    }
    public function getProjectPassedDueWithMissingInfoFromChinaCount(){
        $query = "select count(seq) from graphicslogs where graphicstatus like '". GraphicStatusType::getName(GraphicStatusType::missing_info_from_china) ."' and finalgraphicsduedate < '". date('Y-m-d') ."'";
        $graphicsLogs = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $graphicsLogs;
    }
    public function getProjectsDueForTodayCount(){
        $query = "select COUNT(seq) from graphicslogs where finalgraphicsduedate = '".date("Y-m-d") ."' and graphiccompletiondate is null";
        $graphicsLogs = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $graphicsLogs;
    }
    public function getProjectDueLessThan20DaysFromEntryDateCount(){
        $query = "SELECT count(seq) from graphicslogs where DATEDIFF(finalgraphicsduedate,chinaofficeentrydate) IS NOT NULL AND DATEDIFF(finalgraphicsduedate,chinaofficeentrydate)<20 AND graphiccompletiondate IS NULL";
        $projectDueLessThan20DaysFromEntryDateCount = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $projectDueLessThan20DaysFromEntryDateCount;
    }
    public function getProjectDueLessThan20DaysFromTodayCount(){
        $query = "SELECT count(seq) from graphicslogs where DATEDIFF(finalgraphicsduedate,'".date('Y-m-d')."') IS NOT NULL AND DATEDIFF(finalgraphicsduedate,'".date('Y-m-d')."')<20 AND graphiccompletiondate IS NULL";
        $projectDueLessThan20DaysFromTodayCount = self::$reportingDataDataStore->executeCountQueryWithSql($query);
        return $projectDueLessThan20DaysFromTodayCount;
    }
    
    
    //fetch data from reportingdata table
    public function getGraphicReportData($parameterType){
        $query = "SELECT count FROM `reportingdata` where parameter like '".$parameterType."' ORDER BY dated desc limit 30";
        $graphicReportData = self::$reportingDataDataStore->executeQuery($query,false,true);
        return $graphicReportData;
    }
   
}
?>