<?php 
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ReportingDataMgr.php");
$reportingDataMgr = ReportingDataMgr::getInstance();
$messagesArr = $reportingDataMgr->saveReportingData();
if(isset($messagesArr)){
    foreach($messagesArr as $msg){
        echo $msg."<br>";
    }
}
?>