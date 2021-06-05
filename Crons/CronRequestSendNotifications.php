<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/RequestReportUtil.php");

Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );

$timeZone = "Asia/Kolkata";
$datetimeZone = new DateTimeZone($timeZone);
$currentDate = new DateTime(null,$datetimeZone);
$hours = $currentDate->format("H");
$day = $currentDate->format("d");
$dayOfWeek = $currentDate->format("w");
$logger = Logger::getLogger ( "logger" );

$isDeveloperModeOn = StringConstants::IS_DEVELOPER_MODE == "1";
try{
    if($dayOfWeek == 5 || ($isDeveloperModeOn)){
        if($hours == 19 || $isDeveloperModeOn ){
            RequestReportUtil::sendRequestsDueInNextWeekNotificationToManagers();
            RequestReportUtil::sendRequestsPassedDueInLastWeekNotificationToManagers();
            RequestReportUtil::sendRequestsAssigneeDueDateInNextWeekNotificationToManager();
            RequestReportUtil::sendRequestsAssigneeDueDatePassedInLastWeekNotificationToManager();
        }
        if($hours == 22 || $isDeveloperModeOn){
            RequestReportUtil::sendRequestsDueInNextWeekNotificationToEmployee();
            RequestReportUtil::sendRequestsPassedDueInLastWeekNotificationToEmployee();
            RequestReportUtil::sendRequestsAssigneeDueDateInNextWeekNotificationToEmployee();
            RequestReportUtil::sendRequestsAssigneeDueDatePassedInLastWeekNotificationToEmployee();
        }
    }
}catch(Exception $e){
    $msg = "Error during cron - " . $e->getMessage();
    echo $msg;
    $logger->error($msg,$e);
}
