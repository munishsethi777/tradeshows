<?php 
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ReportingDataMgr.php");
$timeZone = "Asia/Kolkata";
$datetimeZone = new DateTimeZone($timeZone);
$currentDate = new DateTime(null,$datetimeZone);
$hours = $currentDate->format("H");
$day = $currentDate->format("d");
$dayOfWeek = $currentDate->format("w");
// $isDeveloperModeOn = StringConstants::IS_DEVELOPER_MODE == "1";
$reportingDataMgr = ReportingDataMgr::getInstance();
// $messagesArr = $reportingDataMgr->saveGraphicLogReportData();
// $messagesArr = $reportingDataMgr->saveContainerSchedulesReportingData();
// $messagesArr = $reportingDataMgr->saveQCSchedulesReportingData();
$messagesArr = $reportingDataMgr->saveReportingData();

foreach($messagesArr as $msg){
    echo $msg."<br>";
}

?>