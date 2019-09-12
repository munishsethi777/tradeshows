<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );
$logger = Logger::getLogger ( "logger" );
try{
    ContainerScheduleReportUtil::sendEmptyReturnDatePastEmptyLFDReport();
    echo "CronEndWeeklyReport completed Successfully";
    $logger->info("CronEndWeeklyReport completed Successfully");
}catch (Exception $e){
    $msg = "Error during CronEndWeeklyReport - " . $e->getMessage();
    echo $msg;
    $logger->error($msg,$e);
}