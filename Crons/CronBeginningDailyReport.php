<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );
$logger = Logger::getLogger ( "logger" );
try{
    ContainerScheduleReportUtil::sendPendingScheduleDeliveryDateForTodayReport();
    ContainerScheduleReportUtil::sendEmptyAlpineNotificationPickupDateReport();
    ContainerScheduleReportUtil::sendMissingIDReport();
    ContainerScheduleReportUtil::sendMissingTerminalAppointmentDateReport();
    ContainerScheduleReportUtil::sendMissingScheduleDeliveryDateReport();
    echo "CronBeginningDailyReport completed Successfully";
    $logger->info("CronBeginningDailyReport completed Successfully");
}catch (Exception $e){
    $msg = "Error during CronBeginningDailyReport - " . $e->getMessage();
    echo $msg;
    $logger->error($msg,$e);
}