<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Crons/backups.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );
$timeZone = "Asia/Kolkata";
$datetimeZone = new DateTimeZone($timeZone);
$currentDate = new DateTime(null,$datetimeZone);
$hours = $currentDate->format("H");
$day = $currentDate->format("d");
$dayOfWeek = $currentDate->format("w");
$logger = Logger::getLogger ( "logger" );
$configurationMgr = ConfigurationMgr::getInstance();
$cronConfigs = $configurationMgr->getCronConfigs();
try{
    if($hours == 15){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_PENDING_QC_APPROVAL_LAST_EXE);
        if($lastExeDay != $day){
            //QCNotificationsUtil::sendPendingQCApprovalNotification();
            $configurationMgr->saveConfiguration(Configuration::$CRON_PENDING_QC_APPROVAL_LAST_EXE,$currentDate);
            $logger->info("sendPendingQCApprovalNotification sent Successfully");
        }
    }
    if($dayOfWeek == 5 && $hours == 10){
        $lastExeDay = getLastExecutionDate(Configuration::$PENDING_QCSCHEDULE_CRON_LAST_EXE);
        if($lastExeDay != $day){
            //Admin Notfications
            QCNotificationsUtil::sendUpcomingInspectionScheduleNotification(UserType::SUPERVISOR);
            QCNotificationsUtil::sendUpcomingInspectionAppointmentNotification(UserType::SUPERVISOR);
            QCNotificationsUtil::sendMissingAppoitmentNotification(UserType::SUPERVISOR);
            QCNotificationsUtil::sendIncompletedSchedulesNotification(UserType::SUPERVISOR);
            
            //QC Notifications
            QCNotificationsUtil::sendUpcomingInspectionScheduleNotification(UserType::QC);
            QCNotificationsUtil::sendUpcomingInspectionAppointmentNotification(UserType::QC);
            QCNotificationsUtil::sendMissingAppoitmentNotification(UserType::QC);
            QCNotificationsUtil::sendIncompletedSchedulesNotification(UserType::QC);
            $configurationMgr->saveConfiguration(Configuration::$PENDING_QCSCHEDULE_CRON_LAST_EXE,$currentDate);
            $logger->info("sendPendingQCScheduleNotifications sent Successfully");
        }
    }
   if($dayOfWeek == 5 && $hours == 10){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_SEND_QC_PLANNER_REPORT_LAST_EXE);
        if($lastExeDay != $day){
            $qcScheduleMgr = QCScheduleMgr::getInstance();
            $qcScheduleMgr->exportQCPlannerReport(true);
            $configurationMgr->saveConfiguration(Configuration::$CRON_SEND_QC_PLANNER_REPORT_LAST_EXE,$currentDate);
            $logger->info("QCPlanner Notifications sent Successfully");
        }
    }
    if($hours == 12 || $hours == 24){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_BACKUP_LAST_EXE);
        $lastExeHours = getLastExecutionHours(Configuration::$CRON_BACKUP_LAST_EXE);
        $flag = false;
        if($hours == 12){
            if($lastExeDay != $day && $lastExeHours != 12){
                $flag= true;
            }
        }
        if($hours == 24){
            if($lastExeDay == $day && $lastExeHours != 24){
                $flag= true;
            }
        }
        if($flag){
            backups::backup_mysql_database();
            $configurationMgr->saveConfiguration(Configuration::$CRON_BACKUP_LAST_EXE,$currentDate);
            $logger->info("Cron Backup completed Successfully");
        }
    }
    if($dayOfWeek == 1 && $hours == 22){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_BEGINNING_WEEKLY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendETAReport();
            $configurationMgr->saveConfiguration(Configuration::$CRON_BEGINNING_WEEKLY_LAST_EXE,$currentDate);
            $logger->info("Beginning weekly notifications sent successfully");
        }
    }
    if($dayOfWeek == 6 && $hours == 6){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_END_WEEKLY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendEmptyReturnDatePastEmptyLFDReport();
            $configurationMgr->saveConfiguration(Configuration::$CRON_END_WEEKLY_LAST_EXE,$currentDate);
            $logger->info("End weekly notifications sent successfully");
        }
    }
    if($hours == 21){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_BEGINNING_DAILY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendPendingScheduleDeliveryDateForTodayReport();
            ContainerScheduleReportUtil::sendEmptyAlpineNotificationPickupDateReport();
            ContainerScheduleReportUtil::sendMissingIDReport();
            ContainerScheduleReportUtil::sendMissingTerminalAppointmentDateReport();
            ContainerScheduleReportUtil::sendMissingScheduleDeliveryDateReport();
            $configurationMgr->saveConfiguration(Configuration::$CRON_BEGINNING_DAILY_LAST_EXE,$currentDate);
            $logger->info("Beginning Daily notifications sent successfully");
        }
    }
    if($hours == 5){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_END_DAILY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendMissingConfirmDeliveryDateReport();
            ContainerScheduleReportUtil::sendMissingReceivedDatesInWMSReport();
            ContainerScheduleReportUtil::sendMissingReceivedDatesInOMSReport();
            $configurationMgr->saveConfiguration(Configuration::$CRON_END_DAILY_LAST_EXE,$currentDate);
            $logger->info("End Daily notifications sent successfully");
        }
    }
    
}catch(Exception $e){
    $msg = "Error during cron - " . $e->getMessage();
    echo $msg;
    $logger->error($msg,$e);
}

function getLastExecutionDate($configKey){
    global $cronConfigs;
    $dateStr = $cronConfigs[$configKey];
    if(!empty($dateStr)){
        $date = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s",$dateStr);
        return $date->format("d");
    }
    return null;
}

function getLastExecutionHours($configKey){
    global $cronConfigs;
    $dateStr = $cronConfigs[$configKey];
    if(!empty($dateStr)){
        $date = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s",$dateStr);
        return $date->format("H");
    }
    return null;
}