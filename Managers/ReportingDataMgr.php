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
require_once($ConstantsArray['dbServerUrl'] ."Enums/BeanReturnDataType.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/GraphicLogMgr.php");
require_once($ConstantsArray['dbServerUrl']. "Managers/ContainerScheduleMgr.php");

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
                        $count = count(call_user_func(array($object,$value),BeanReturnDataType::count));
                    }elseif(strpos($key,'container_') !== false){
                        $object = ContainerScheduleMgr::getInstance();
                        $departmentType = DepartmentType::getName(DepartmentType::Container_Schedules);
                        $count = count(call_user_func(array($object,$value),""));
                    }elseif(strpos($key,'graphiclog_') !== false){
                        $object = GraphicLogMgr::getInstance();
                        $departmentType = DepartmentType::getName(DepartmentType::Graphics_Logs);
                        $count = call_user_func(array($object,$value),BeanReturnDataType::count);
                    }elseif(strpos($key,'instruction_manual_') !== false){
                        $object = InstructionManualLogsMgr::getInstance();
                        $departmentType = DepartmentType::getName(DepartmentType::Instruction_Manual);
                        $count = call_user_func(array($object,$value),BeanReturnDataType::count);
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

    //fetch data from reportingdata table
    public function getReportingData($parameterType){
        $query = "SELECT count FROM `reportingdata` where parameter like '".$parameterType."' AND dated < '".date("Y-m-d")."' order by dated asc limit 30";
        $graphicReportData = self::$reportingDataDataStore->executeQuery($query,false,true);
        return $graphicReportData;
    }
    // API used to display reporting grid on dashboards
    public function getReportingDataForJsCharts($parameterType){
        $query = "SELECT dated,count FROM `reportingdata` where parameter like '".$parameterType."' AND dated < '".date("Y-m-d")."' order by dated asc limit 30";
        $graphicReportData = self::$reportingDataDataStore->executeQuery($query,false,true);
        $object = null;
        if(strpos($parameterType,"instruction_manual_") !== false){
            $object = InstructionManualLogsMgr::getInstance();
            $todayReportData = call_user_func(array($object,ReportingDataMethodNames::getValue($parameterType)),BeanReturnDataType::count);
        }elseif(strpos($parameterType,"container_") !== false){
            $object = ContainerScheduleMgr::getInstance();
            $todayReportData = call_user_func(array($object,ReportingDataMethodNames::getValue($parameterType)),BeanReturnDataType::count);
        }elseif(strpos($parameterType,"graphiclog_") !== false){
            $object = GraphicLogMgr::getInstance();
            $todayReportData = call_user_func(array($object,ReportingDataMethodNames::getValue($parameterType)),BeanReturnDataType::count);
        }elseif(strpos($parameterType,"qc_") !== false){
            $object = QCScheduleMgr::getInstance();
            $todayReportData = count(call_user_func(array($object,ReportingDataMethodNames::getValue($parameterType)),BeanReturnDataType::count));
        }
        
        $todayDate = date("Y-m-d");
        $labelsArr = array();
        $dataArr = array();
        foreach($graphicReportData as $data){
            array_push($labelsArr,$data['dated']);
            array_push($dataArr,$data['count']);
        }
        array_push($labelsArr,$todayDate);
        array_push($dataArr,$todayReportData);
        
        $mainArr = array('labels' => implode(",",$labelsArr),'data' => implode(",",$dataArr));
        return $mainArr;
    }
}
?>