<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/ContainerScheduleDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleMgr.php");
class ContainerScheduleReportUtil
{   
    private static $CS_DEP_SEQ = 4;
    private static function getHtml($subject,$detail){
        $content = file_get_contents("../CSReportEmailTemplate.php");
        $phAnValues = array();
        $phAnValues["DETAIL"] = $detail;
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        return $html;
    }
    
    
    //Weekly
    private static $N_J_Y = "n_j_y";
    public static function sendETAReport(){
        $subject = StringConstants::ETA_REPORT;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getETADatesPendingInNextSevenDays();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::ETA_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval();
        $dateWithInterval = DateUtil::getDateWithInterval(6);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y) . "_to_" . $dateWithInterval->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For this week for dates $currentDateStr to $dateWithIntervalStr";
        $body = self::getHtml($subject, $reportDetail);
        $roleName = Permissions::getName(Permissions::container_delivery_information); //WareHouse (Blue)
        $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$CS_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag =  MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::CONTAINER_SCHEDULE_ETA_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly
    public static function sendEmptyReturnDatePastEmptyLFDReport(){
        $subject = StringConstants::EMPTY_RETURN;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getEmptyReturnDatePastEmptyLFD();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::EMPTY_RETURN_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval();
        $dateWithInterval = DateUtil::getDateWithInterval(6,null,true);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $dateWithInterval->format(self::$N_J_Y) . "_to_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For past week for dates $dateWithIntervalStr to $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        $roleName = Permissions::getName(Permissions::container_delivery_information); //WareHouse (Blue)
        $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$CS_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
       $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
       if($flag){
           $emaillogMgr = EmailLogMgr::getInstance();
           foreach ($users as $user){
               $emaillogMgr->saveEmailLog(EmailLogType::CONTAINER_SCHEDULE_EMPTY_RETURN_DATE ,$user->getEmail(), null,$user->getSeq());
           }
       }
    }
    
    //Daily
    public static function sendPendingScheduleDeliveryDateForTodayReport(){
        $subject = StringConstants::DAILY_SCHEDULE_REPORT;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getPendingScheduleDeliveryDateForToday();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::DAILY_SCHEDULE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_PENDING_SCHEDULE_DELIVERY_DATE;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
    }
    
    //Daily
    public static function sendEmptyAlpineNotificationPickupDateReport(){
        $subject = StringConstants::MISSING_ALPINE_NOTIFICATION_PICKUP_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingAlpineNotificationDate();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_ALPINE_NOTIFICATION_PICKUP_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_PENDING_EMPTY_ALPINE_NOTIFICATION_PICKUP_DATE;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
    }
    
    //Daily
    public static function sendMissingIDReport(){
        $subject = StringConstants::MISSING_IDS;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingIDReport();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_IDS_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_IDS;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
    }
    
    
    //Daily
    public static function sendMissingTerminalAppointmentDateReport(){
        $subject = StringConstants::MISSING_TERMINAL_APPT_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingTerminalAppointmentDate();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_TERMINAL_APPT_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_TERMINAL_APPT_DATE;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
    }
    
    //Daily
    public static function sendMissingScheduleDeliveryDateReport(){
        $subject = StringConstants::MISSING_SCHEDULE_DELIVERY_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingScheduleDeliveryDate();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_SCHEDULE_DELIVERY_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_SCHEDULE_DELIVERY_DATE;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
    }
    //Daily
    public static function sendMissingConfirmDeliveryDateReport(){
        $subject = StringConstants::MISSING_CONFIRM_DELIVERY_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingConfirmDeliveryDate();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_CONFIRM_DELIVERY_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_CONFIRM_DELIVERY_DATE;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
    }
    
    //Daily
    public static function sendMissingReceivedDatesInWMSReport(){
        $subject = StringConstants::EMPTY_WMS_DATES;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingReceivedDatesInWMS();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::EMPTY_WMS_DATES_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_WMS;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
    }
    
    //Daily
    public static function sendMissingReceivedDatesInOMSReport(){
        $subject = StringConstants::EMPTY_OMS_DATES;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingReceivedDatesInOMS();
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::EMPTY_OMS_DATES_REPORT_NAME;
        $roleName = Permissions::container_office_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_OMS;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType);
        
    }
    
    private static function sendDailyMail($subject,$reportName,$receiverPermission,$excelData,$emailLogType){
        $currentDate = DateUtil::getDateWithInterval();
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);//WareHouse (Blue)
        $users = $userMgr->getUserssByRoleAndDepartment(Permissions::getName($receiverPermission), self::$CS_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag =  MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog($emailLogType,$user->getEmail(), null,$user->getSeq());
            }
        }
        
    }
    
    public static function sendAlpinePickUpDateChangedNotification($containerSchedule, 
        $existingContainerSchedule,$userName)
    {
        $scheduleDeliveryDate = $containerSchedule->getScheduledDeliveryDateTime();
        $scheduleAlpinePickupDate = $containerSchedule->getAlpineNotificatinPickupDateTime();

        $existingScheduleDeliveryDate = $existingContainerSchedule->getScheduledDeliveryDateTime();
        $existingScheduleAlpinePickupDate = $existingContainerSchedule->getAlpineNotificatinPickupDateTime();
        $html = "<p>User $userName has changed Dates :- <br>";
        $hasChangedDate = false;
        if(!empty($existingScheduleDeliveryDate)){
            $existingScheduleDeliveryDate = DateUtil::StringToDateByGivenFormat(DateUtil::$DB_FORMAT_WITH_TIME,$existingScheduleDeliveryDate);
        }
        if ($scheduleDeliveryDate != $existingScheduleDeliveryDate){
            if(!empty($existingScheduleDeliveryDate)){
                $existingScheduleDeliveryDate = $existingScheduleDeliveryDate->format(DateUtil::$APP_FORMAT_WITH_TIME);
            }else{
                $existingScheduleDeliveryDate = "Empty";
            }
            if(!empty($scheduleDeliveryDate)){
                $scheduleDeliveryDate = $scheduleDeliveryDate->format(DateUtil::$APP_FORMAT_WITH_TIME);
            }else{
                $scheduleDeliveryDate = "Empty";
            }
            $html .= "Schedule Delivery Date from '$existingScheduleDeliveryDate' to '$scheduleDeliveryDate'<br>";
            $hasChangedDate = true;
        }
        if(!empty($existingScheduleAlpinePickupDate)){
            $existingScheduleAlpinePickupDate = DateUtil::StringToDateByGivenFormat(DateUtil::$DB_FORMAT_WITH_TIME,$existingScheduleAlpinePickupDate);
        }
        if ($scheduleAlpinePickupDate != $existingScheduleAlpinePickupDate){
            if(!empty($existingScheduleAlpinePickupDate)){
                $existingScheduleAlpinePickupDate = $existingScheduleAlpinePickupDate->format(DateUtil::$APP_FORMAT_WITH_TIME);
            }else{
                $existingScheduleAlpinePickupDate = "Empty";
            }
            if(!empty($scheduleAlpinePickupDate)){
                $scheduleAlpinePickupDate = $scheduleAlpinePickupDate->format(DateUtil::$APP_FORMAT_WITH_TIME);
            }else{
                $scheduleAlpinePickupDate = "Empty";
            }
            $html .= "Alpine Notif. Pickup Date from '$existingScheduleAlpinePickupDate' to '$scheduleAlpinePickupDate'";
            $hasChangedDate = true;
        }
        if($hasChangedDate){
            $phAnValues = array();
            $phAnValues["DETAIL"] = $html;
            $content = file_get_contents("../CSChangedAlpinePickupDateEmailTemplate.php");
            $body = MailUtil::replacePlaceHolders($phAnValues, $content);
            $toEmails = array("baljeetgaheer@gmail.com");
            $subject = StringConstants::CONTAINER_SCHEDULE_DATES_CHANGE_NOTIFICATION;
            $roleName = Permissions::getName(Permissions::container_information); //WareHouse (Blue)
            $userMgr = UserMgr::getInstance();
            $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$CS_DEP_SEQ);
            $toEmails = array();
            foreach ($users as $user){
                array_push($toEmails,$user->getEmail());
            }
            $bool = MailUtil::sendSmtpMail($subject, $body, $toEmails, true);
            if($bool){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::CONTAINER_SCHEDULE_DATE_CHANGE_NOTIFICATION ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
        
    }
}