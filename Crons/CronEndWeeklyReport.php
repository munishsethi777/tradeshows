<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );
$logger = Logger::getLogger ( "logger" );
try{
    $userMgr = UserMgr::getInstance();
    $allUsers = $userMgr->getAllUsersWithRoles();
    ContainerScheduleReportUtil::sendEmptyReturnDatePastEmptyLFDReport($allUsers);
    echo "CronEndWeeklyReport completed Successfully";
    $logger->info("CronEndWeeklyReport completed Successfully");
}catch (Exception $e){
    $msg = "Error during CronEndWeeklyReport - " . $e->getMessage();
    echo $msg;
    $logger->error($msg,$e);
}