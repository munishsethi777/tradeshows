<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );
$logger = Logger::getLogger ( "logger" );
try{
    ContainerScheduleReportUtil::sendETAReport();
    echo "CronBeginningWeeklyReport completed Successfully";
    $logger->info("CronBeginningWeeklyReport completed Successfully");
}catch (Exception $e){
    $msg = "Error during CronBeginningWeeklyReport - " . $e->getMessage();
    echo $msg;
    $logger->error($msg,$e);
}