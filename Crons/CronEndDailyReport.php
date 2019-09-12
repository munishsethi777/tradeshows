<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );
$logger = Logger::getLogger ( "logger" );
try{
    ContainerScheduleReportUtil::sendMissingConfirmDeliveryDateReport();
    ContainerScheduleReportUtil::sendMissingReceivedDatesInWMSReport();
    ContainerScheduleReportUtil::sendMissingReceivedDatesInOMSReport();
    echo "CronEndDailyReport completed Successfully";
    $logger->info("CronEndDailyReport completed Successfully");
}catch (Exception $e){
    echo "Error during CronEndDailyReport - " . $e->getMessage();
}