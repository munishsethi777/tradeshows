<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/ContainerScheduleDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ContainerScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/ContainerScheduleNotificationType.php");

class ContainerScheduleReportUtil
{   
    private static $CS_DEP_SEQ = 4;
    private static $timeZone = "America/Los_Angeles";
    private static function getHtml($subject,$detail){
        $content = file_get_contents("../CSReportEmailTemplate.php");
        $phAnValues = array();
        $phAnValues["DETAIL"] = $detail;
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        return $html;
    }
    
    private static function getCSUsersByNotificationType($users,$notificationType){
        if(isset($users[ContainerScheduleNotificationType::getName($notificationType)])){
            return $users[ContainerScheduleNotificationType::getName($notificationType)];
        }else{
            return null;
        }
    }
    
    //Weekly
    private static $N_J_Y = "n_j_y";
    public static function sendETAReport($users){
        $users = self::getCSUsersByNotificationType($users,
            ContainerScheduleNotificationType::send_eta_report_weekly);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::ETA_REPORT;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getETADatesPendingInNextSevenDays();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::ETA_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $dateWithInterval = DateUtil::getDateWithInterval(6,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y) . "_to_" . $dateWithInterval->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
//         $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For this week for dates $currentDateStr to $dateWithIntervalStr";
        $body = self::getHtml($subject, $reportDetail);
//         $roleName = Permissions::getName(Permissions::container_information); //WareHouse (Blue)
//         $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$CS_DEP_SEQ);
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
    public static function sendEmptyReturnDatePastEmptyLFDReport($users){
        $users = self::getCSUsersByNotificationType($users,
            ContainerScheduleNotificationType::empty_return_date_past_empty_lFD_report_weekly);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::EMPTY_RETURN;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getEmptyReturnDatePastEmptyLFD();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::EMPTY_RETURN_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(1,null,true,self::$timeZone);
        $dateWithInterval = DateUtil::getDateWithInterval(7,null,true,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $dateWithInterval->format(self::$N_J_Y) . "_to_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        // $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For past week for dates $dateWithIntervalStr to $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        // $roleName = Permissions::getName(Permissions::container_delivery_information); //WareHouse (Blue)
        // $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$CS_DEP_SEQ);
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
    public static function sendPendingScheduleDeliveryDateForTodayReport($users){
        $subject = StringConstants::DAILY_SCHEDULE_REPORT;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getPendingScheduleDeliveryDateForToday();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::DAILY_SCHEDULE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_PENDING_SCHEDULE_DELIVERY_DATE;
        $notificationType = ContainerScheduleNotificationType::pending_schedule_delivery_date_for_today_report_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
    }
    
    //Daily
    public static function sendEmptyAlpineNotificationPickupDateReport($users){
        $subject = StringConstants::MISSING_ALPINE_NOTIFICATION_PICKUP_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingAlpineNotificationDate();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_ALPINE_NOTIFICATION_PICKUP_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_PENDING_EMPTY_ALPINE_NOTIFICATION_PICKUP_DATE;
        $notificationType = ContainerScheduleNotificationType::empty_alpine_notication_pickup_date_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
    }
    
    //Daily
    public static function sendMissingIDReport($users){
        $subject = StringConstants::MISSING_IDS;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingIDReport();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_IDS_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_IDS;
        $notificationType = ContainerScheduleNotificationType::missing_id_report_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
    }
    
    
    //Daily
    public static function sendMissingTerminalAppointmentDateReport($users){
        $subject = StringConstants::MISSING_TERMINAL_APPT_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingTerminalAppointmentDate();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_TERMINAL_APPT_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_TERMINAL_APPT_DATE;
        $notificationType = ContainerScheduleNotificationType::missing_terminal_appointment_date_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
    }
    
    //Daily
    public static function sendMissingScheduleDeliveryDateReport($users){
        $subject = StringConstants::MISSING_SCHEDULE_DELIVERY_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingScheduleDeliveryDate();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_SCHEDULE_DELIVERY_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_SCHEDULE_DELIVERY_DATE;
        $notificationType = ContainerScheduleNotificationType::missing_schedule_delivery_date_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
    }
    //Daily
    public static function sendMissingConfirmDeliveryDateReport($users){
        $subject = StringConstants::MISSING_CONFIRM_DELIVERY_DATE;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingConfirmDeliveryDate();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::MISSING_CONFIRM_DELIVERY_DATE_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_CONFIRM_DELIVERY_DATE;
        $notificationType = ContainerScheduleNotificationType::missing_confirm_delivery_date_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
    }
    
    //Daily
    public static function sendMissingReceivedDatesInWMSReport($users){
        $subject = StringConstants::EMPTY_WMS_DATES;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingReceivedDatesInWMS();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::EMPTY_WMS_DATES_REPORT_NAME;
        $roleName = Permissions::container_delivery_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_WMS;
        $notificationType = ContainerScheduleNotificationType::missing_received_dates_in_wms_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
    }
    
    //Daily
    public static function sendMissingReceivedDatesInOMSReport($users){
        $subject = StringConstants::EMPTY_OMS_DATES;
        $ds = ContainerScheduleDataStore::getInstance();
        $containerSchedules = $ds->getMissingReceivedDatesInOMS();
        if(empty($containerSchedules)){
            return;
        }
        $containerSchedulMgr = ContainerScheduleMgr::getInstance();
        $containerSchedulesArr = $containerSchedulMgr->setNotesAndDates($containerSchedules);
        $excelData = ExportUtil::exportContainerSchedules($containerSchedulesArr,true);
        $reportName = StringConstants::EMPTY_OMS_DATES_REPORT_NAME;
        $roleName = Permissions::container_office_information;
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_OMS;
        $notificationType = ContainerScheduleNotificationType::missing_received_dates_in_oms_daily;
        return self::sendDailyMail($subject,$reportName,$roleName,$excelData,$emailLogType,$notificationType,$users);
        
    }
    
    private static function sendDailyMail($subject,$reportName,$receiverPermission,$excelData,$emailLogType,$notificationType,$users){
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
       // $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);//WareHouse (Blue)
       // $users = $userMgr->getUserssByRoleAndDepartment(Permissions::getName($receiverPermission), self::$CS_DEP_SEQ);
        $users = self::getCSUsersByNotificationType($users,$notificationType);
        if(empty($users)){
            return;
        }
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
        $existingContainerSchedule,$userName){
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getAllUsersWithRoles();
        $users = self::getCSUsersByNotificationType($users,
            ContainerScheduleNotificationType::send_alpine_picking_date_change_instant);
        if(empty($users)){
            return;
        }
        $scheduleDeliveryDate = $containerSchedule->getScheduledDeliveryDateTime();
        $scheduleAlpinePickupDate = $containerSchedule->getAlpineNotificatinPickupDateTime();
        
        $existingScheduleDeliveryDate = $existingContainerSchedule->getScheduledDeliveryDateTime();
        $existingScheduleAlpinePickupDate = $existingContainerSchedule->getAlpineNotificatinPickupDateTime();
        $awuRef = $containerSchedule->getAWUReference();
        $containerNumber = $containerSchedule->getContainer();
        $html = "User $userName has updated a container schedule with Container#$containerNumber and AWU#$awuRef with following dates:<br>";
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
            $content = MailUtil::replacePlaceHolders($phAnValues, $content);
            $body = MailUtil::appendToEmailTemplateContainer($content);
            $toEmails = array("baljeetgaheer@gmail.com");
            $subject = StringConstants::CONTAINER_SCHEDULE_DATES_CHANGE_NOTIFICATION;
            //$roleName = Permissions::getName(Permissions::container_information); //outside vendor (Black)
            
            //$users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$CS_DEP_SEQ);
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
    
    public static function sendTerminalAppointmentChangedNotification($containerSchedule,
        $existingContainerSchedule,$userName)
    {
        $terminalAppointmentDateTime = $containerSchedule->getTerminalAppointmentDatetime();
        
        $existingTerminalAppointmentDateTime = $existingContainerSchedule->getTerminalAppointmentDatetime();
        
        $awuRef = $containerSchedule->getAWUReference();
        $containerNum = $containerSchedule->getContainer();
        $html = "user <b>$userName</b> has updated a terminal appointment date for <b>Container#$containerNum</b> and <b>AWU#$awuRef</b> with following date:<br>";
        $hasChangedDate = false;
        if(!empty($existingTerminalAppointmentDateTime)){
            $existingTerminalAppointmentDateTime = DateUtil::StringToDateByGivenFormat(DateUtil::$DB_FORMAT_WITH_TIME,$existingTerminalAppointmentDateTime);
        }
        if ($terminalAppointmentDateTime != $existingTerminalAppointmentDateTime){
            if(!empty($existingTerminalAppointmentDateTime)){
                $existingTerminalAppointmentDateTime = $existingTerminalAppointmentDateTime->format(DateUtil::$APP_FORMAT_WITH_TIME);
            }else{
                $existingTerminalAppointmentDateTime = "Empty";
            }
            if(!empty($terminalAppointmentDateTime)){
                $terminalAppointmentDateTime = $terminalAppointmentDateTime->format(DateUtil::$APP_FORMAT_WITH_TIME);
            }else{
                $terminalAppointmentDateTime = "Empty";
            }
            $html .= "Terminal Appointment Date from <b>$existingTerminalAppointmentDateTime</b> to <b>$terminalAppointmentDateTime</b><br>";
            $hasChangedDate = true;
        }
        if($hasChangedDate){
            $phAnValues = array();
            $phAnValues["DETAIL"] = $html;
            $content = file_get_contents("../CSChangedAlpinePickupDateEmailTemplate.php");
            $content = MailUtil::replacePlaceHolders($phAnValues, $content);
            $body = MailUtil::appendToEmailTemplateContainer($content);
            $toEmails = array("baljeetgaheer@gmail.com");
            $subject = StringConstants::CONTAINER_SCHEDULE_CHANGE_TERMINAL_APPOINTMENT_DATE;
//             $roleName = Permissions::getName(Permissions::container_delivery_information); //WareHouse (Blue)
            $userMgr = UserMgr::getInstance();
            $users = $userMgr->getAllUsersWithRoles();
            $users = self::getCSUsersByNotificationType($users,
                ContainerScheduleNotificationType::terminal_appointment_date_change_instant);
            if(empty($users)){
                return;
            }
            $toEmails = array();
            foreach ($users as $user){
                array_push($toEmails,$user->getEmail());
            }
            $bool = MailUtil::sendSmtpMail($subject, $body, $toEmails, true);
            if($bool){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::CONTAINER_SCHEDULE_CHANGE_TERMINAL_APPOINTMENT_DATE ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
        
        
        
    }
    
    
    public static function sendDueTransModalNotification($users){
        $subject = StringConstants::DUE_TRANS_MODAL;
        $ds = ContainerScheduleDataStore::getInstance();
        
        $dueLast7Days = $ds->getDueTransModalLast7Days() * 30 ;
        $dueCurrentMonth = $ds->getDueTransModalForCurrentMonth()  * 30;
        $dueCurrentYear = $ds->getDueTransModalForCurrentYear() * 30;
        
        
        $due7WeekForTerminal = $ds->getDueTransModalTerminalAppDateLast7Days() * 30 ;
        $dueCurrentMonthForTerminal = $ds->getDueTransModalTerminalAppDateForCurrentMonth()  * 30;
        $dueCurrentYearForTerminal = $ds->getDueTransModalTerminalAppDateForCurrentYear() * 30;
        
        $phAnValues = array();
        $phAnValues["last_7_days_charge_for_pickup_date"] = $dueLast7Days;
        $phAnValues["current_Month_charge_for_pickup_date"] = $dueCurrentMonth;
        $phAnValues["year_Month_charge_for_pickup_date"] = $dueCurrentYear;
        
            
        $phAnValues["last_7_days_charge_for_terminal_date"] = $due7WeekForTerminal;
        $phAnValues["current_Month_charge_for_terminal_date"] = $dueCurrentMonthForTerminal;
        $phAnValues["year_charge_for_terminal_date"] = $dueCurrentYearForTerminal;
       
        $detail = file_get_contents("../emailTemplateChargeBackNotice.php");
        $detail = MailUtil::replacePlaceHolders($phAnValues, $detail);
        $body = MailUtil::appendToEmailTemplateContainer($detail);
        $toEmails = array("baljeetgaheer@gmail.com");
        $users = self::getCSUsersByNotificationType($users,
            ContainerScheduleNotificationType::charge_back_weekly);
        if(empty($users)){
            return;
        }
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $bool = MailUtil::sendSmtpMail($subject, $body, $toEmails, true);
        if($bool){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::CONTAINER_SCHEDULE_CHARGE_BACK_ ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Instant when notes updated from graphic log
    public static function sendContainerScheduleNotesUpdatedNotification($containerSchedule,$notificationType){
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getAllUsersWithRoles();
        $users = self::getCSUsersByNotificationType($users,$notificationType);
        if(empty($users)){
            return;
        }
        //$containerSchedule = new ContainerSchedule();
        $loggedInUserName = SessionUtil::getInstance()->getUserLoggedInName();
        $phAnValues = array();
        $noteType = "ETA";
        $emailLogType = EmailLogType::CONTAINER_SCHEDULE_ETA_NOTES_UPDATED;
        $noteDetail = $containerSchedule->getETANotes();
        if($notificationType == ContainerScheduleNotificationType::empty_return_notes_updated_instant){
            $noteType = "Empty Return";
            $noteDetail = $containerSchedule->getEmptyNotes();
            $emailLogType = EmailLogType::CONTAINER_SCHEDULE_EMPTY_RETURN_NOTES_UPDATED;
        }else if($notificationType == ContainerScheduleNotificationType::alpine_pickup_notes_updated_instant){
            $noteType = "Alpine Pickup";
            $noteDetail = $containerSchedule->getNotificationNotes();
            $emailLogType = EmailLogType::CONTAINER_SCHEDULE_ALPINE_NOTES_UPDATED;
        }
        if(empty($noteDetail)){
            return;
        }
        $phAnValues["NOTES_NAME"] = $noteType ;
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["CONTAINER_NO"] = $containerSchedule->getContainer();
        $phAnValues["NOTES_DETAIL"] = $noteDetail;
        $content = file_get_contents("../ContainerScheduleNotesUpdatedTemplate.php");
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        $toEmails = array();
        $phAnValues = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        if(!empty($toEmails)){
            $subject = $noteType . " Notes Updated For Container Schedule on Alpinebi";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog($emailLogType ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
    }
}