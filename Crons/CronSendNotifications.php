<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Crons/backups.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ContainerScheduleReportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/GraphicLogReportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/RequestReportUtil.php");
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
$userMgr = UserMgr::getInstance();
$allUsers = $userMgr->getAllUsersWithRoles();
$supervisors = $userMgr->getAllUsersWithRoles(UserType::SUPERVISOR);
$users = $userMgr->getAllUsersWithRoles(UserType::USER);
$isDeveloperModeOn = StringConstants::IS_DEVELOPER_MODE == "1";
try{
	if($hours == 17 || $hours == 23 || ($isDeveloperModeOn)){
		$lastExeDay = getLastExecutionDate(Configuration::$CRON_BACKUP_LAST_EXE);
		$lastExeHours = getLastExecutionHours(Configuration::$CRON_BACKUP_LAST_EXE);
		$flag = false;
		if($hours == 17 || ($isDeveloperModeOn)){
			if(($lastExeDay != $day && $lastExeHours != 17) || ($isDeveloperModeOn)){
				$flag= true;
			}
		}
		if($hours == 23 || ($isDeveloperModeOn)){
			if(($lastExeDay == $day && $lastExeHours != 23) || ($isDeveloperModeOn)){
				$flag= true;
			}
		}
		if($flag){
			
			if(!($isDeveloperModeOn)){
			    backups::backup_mysql_database();
				$configurationMgr->saveConfiguration(Configuration::$CRON_BACKUP_LAST_EXE,$currentDate);
			}
			$logger->info("Cron Backup completed Successfully");
		}
	}
    if($hours == 10 || ($isDeveloperModeOn)){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_PENDING_QC_APPROVAL_LAST_EXE);
        if($lastExeDay != $day){
            QCNotificationsUtil::sendPendingQCApprovalNotification($supervisors);
            if(!($isDeveloperModeOn)){
                $configurationMgr->saveConfiguration(Configuration::$CRON_PENDING_QC_APPROVAL_LAST_EXE,$currentDate);
            }
            $logger->info("sendPendingQCApprovalNotification sent Successfully");
        }
    }
    if($dayOfWeek == 5 && $hours == 10 || ($isDeveloperModeOn)){
        $lastExeDay = getLastExecutionDate(Configuration::$PENDING_QCSCHEDULE_CRON_LAST_EXE);
        if($lastExeDay != $day){
            //Admin Notfications
            QCNotificationsUtil::sendUpcomingInspectionNotification(UserType::SUPERVISOR,$supervisors);
            QCNotificationsUtil::sendMissingAppoitmentNotification(UserType::SUPERVISOR,$supervisors);
            QCNotificationsUtil::sendIncompletedSchedulesNotification(UserType::SUPERVISOR,$supervisors);
            //QC Notifications
            QCNotificationsUtil::sendUpcomingInspectionNotification(UserType::QC,$users);
            QCNotificationsUtil::sendMissingAppoitmentNotification(UserType::QC,$users);
            QCNotificationsUtil::sendIncompletedSchedulesNotification(UserType::QC,$users);
            if(!$isDeveloperModeOn){
                $configurationMgr->saveConfiguration(Configuration::$PENDING_QCSCHEDULE_CRON_LAST_EXE,$currentDate);
            }
            $logger->info("sendPendingQCScheduleNotifications sent Successfully");
        }
    }
    if($dayOfWeek == 5 && $hours == 10 || ($isDeveloperModeOn)){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_SEND_QC_PLANNER_REPORT_LAST_EXE);
        if($lastExeDay != $day){
            $qcScheduleMgr = QCScheduleMgr::getInstance();
            $qcScheduleMgr->exportQCPlannerReport(true,$allUsers);
            if(!$isDeveloperModeOn){
                $configurationMgr->saveConfiguration(Configuration::$CRON_SEND_QC_PLANNER_REPORT_LAST_EXE,$currentDate);
            }
            $logger->info("QCPlanner Notifications sent Successfully");
        }
    }
    
    if($dayOfWeek == 1 && $hours == 22 || ($isDeveloperModeOn)){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_BEGINNING_WEEKLY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendETAReport($allUsers);
            
            //graphic log reports
            GraphicLogReportUtil::sendProjectsCompletedLastWeek($allUsers);
            GraphicLogReportUtil::sendProjectsOverDueTillNow($allUsers);
            GraphicLogReportUtil::sendProjectsInBuyerReview($allUsers);
            GraphicLogReportUtil::sendProjectsInManagerReview($allUsers);
            GraphicLogReportUtil::sendProjectsInRobbyReview($allUsers);
            GraphicLogReportUtil::sendProjectsMissingInfoFromChina($allUsers);
            ContainerScheduleReportUtil::sendDueTransModalNotification($allUsers);
            if(!$isDeveloperModeOn){
                $configurationMgr->saveConfiguration(Configuration::$CRON_BEGINNING_WEEKLY_LAST_EXE,$currentDate);
            }
            $logger->info("Beginning weekly notifications sent successfully");
        }
    }
    if($dayOfWeek == 6 && $hours == 6 || ($isDeveloperModeOn)){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_END_WEEKLY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendEmptyReturnDatePastEmptyLFDReport($allUsers);
            if(!$isDeveloperModeOn){
                $configurationMgr->saveConfiguration(Configuration::$CRON_END_WEEKLY_LAST_EXE,$currentDate);
            }
            $logger->info("End weekly notifications sent successfully");
        }
    }
    if($hours == 21 || ($isDeveloperModeOn)){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_BEGINNING_DAILY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendPendingScheduleDeliveryDateForTodayReport($allUsers);
            ContainerScheduleReportUtil::sendEmptyAlpineNotificationPickupDateReport($allUsers);
            ContainerScheduleReportUtil::sendMissingIDReport($allUsers);
            ContainerScheduleReportUtil::sendMissingTerminalAppointmentDateReport($allUsers);
            ContainerScheduleReportUtil::sendMissingScheduleDeliveryDateReport($allUsers);
            //Graphic Log Reports
            GraphicLogReportUtil::sendProjectsPastDueWithMissingInfoFromChina($allUsers);
            GraphicLogReportUtil::sendProjectsDueForToday($allUsers);
            GraphicLogReportUtil::sendProjectsDueLessThan20DaysFromEntryDate($allUsers);
            GraphicLogReportUtil::sendProjectsDueLessThan20DaysFromToday($allUsers);
            GraphicLogReportUtil::sendProjectsMissingInfoFromChina($allUsers,true);
            if(!$isDeveloperModeOn){
                $configurationMgr->saveConfiguration(Configuration::$CRON_BEGINNING_DAILY_LAST_EXE,$currentDate);
            }
            $logger->info("Beginning Daily notifications sent successfully");
        }
    }
    if($hours == 5 || ($isDeveloperModeOn)){
        $lastExeDay = getLastExecutionDate(Configuration::$CRON_END_DAILY_LAST_EXE);
        if($lastExeDay != $day){
            ContainerScheduleReportUtil::sendMissingConfirmDeliveryDateReport($allUsers);
            ContainerScheduleReportUtil::sendMissingReceivedDatesInWMSReport($allUsers);
            ContainerScheduleReportUtil::sendMissingReceivedDatesInOMSReport($allUsers);
            if(!$isDeveloperModeOn){
                $configurationMgr->saveConfiguration(Configuration::$CRON_END_DAILY_LAST_EXE,$currentDate);
            }
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