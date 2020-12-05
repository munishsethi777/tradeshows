<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/ReportingData.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/DepartmentType.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataParameterType.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/ReportingDataMethodNames.php");
require_once($ConstantsArray['dbServerUrl']. "Enums/GraphicStatusType.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/ContainerScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/ContainerScheduleDataStore.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/InstructionManualLogsMgr.php");
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
    public function saveReportingData(){
        $msg = array();
        $methodNames = ReportingDataMethodNames::getAll();
        $object = null;
        $departmentType = null;
        foreach ($methodNames as $key => $value){
            try{
                if(strpos($key,'qc_') !== false || strpos($key,'container_') !== false ||
                strpos($key,'graphiclog_') !== false || strpos($key,'instruction_manual') !== false
                ){
                    if(strpos($key,'qc_') !== false){
                        $object = QCScheduleMgr::getInstance();
                        $departmentType = DepartmentType::getName(DepartmentType::QC_Schedules);
                        $count = count(call_user_func(array($object,$value),""));
                    }elseif(strpos($key,'container_') !== false){
                        $object = ContainerScheduleDataStore::getInstance();
                        $departmentType = DepartmentType::getName(DepartmentType::Container_Schedules);
                        $count = count(call_user_func(array($object,$value),""));
                    }elseif(strpos($key,'graphiclog_') !== false){
                        $object = $this->getInstance();
                        $departmentType = DepartmentType::getName(DepartmentType::Graphics_Logs);
                        $count = call_user_func(array($object,$value),"");
                    }elseif(strpos($key,'instruction_manual_') !== false){
                        $object = InstructionManualLogsMgr::getInstance();
                        $departmentType = DepartmentType::getName(DepartmentType::Instruction_Manual);
                        $count = call_user_func(array($object,$value),"");
                    }
                    
                    $reportingData = new ReportingData();
                    $reportingData->setCount($count);
                    $reportingData->setDated(new DateTime());
                    $reportingData->setDepartment($departmentType);
                    $reportingData->setParameter($key);
                    self::$reportingDataDataStore->save($reportingData);
                }
            }catch(Exception $e){
                array_push($msg,$e->getMessage());
            }             
        }
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
    public function getReportingData($parameterType){
        $query = "SELECT count FROM `reportingdata` where parameter like '".$parameterType."' ORDER BY dated desc limit 30";
        $graphicReportData = self::$reportingDataDataStore->executeQuery($query,false,true);
        return $graphicReportData;
    }
   
}
?>