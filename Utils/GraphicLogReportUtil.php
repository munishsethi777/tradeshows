<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/GraphicStatusType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/GraphicType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/GraphicLogsNotificationType.php");

class GraphicLogReportUtil
{ 
    private static $timeZone = "America/Los_Angeles";
    private static $GL_DEP_SEQ = 2;
    private static function getHtml($subject,$detail){              
        $content = file_get_contents("../CSReportEmailTemplate.php");
        $phAnValues = array();
        $phAnValues["DETAIL"] = $detail;
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        return $html;
    }
    
    private static $N_J_Y = "n_j_y";
    
    //not in use
    //Weekly/Monday - Projects due this 
    public static function sendProjectsDueForWeekReport(){
        $subject = StringConstants::PROJECT_DUE_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueForNextWeek();
        if(empty($graphiclogs)){
            return;
        }
        if(count($graphiclogs) > 25){
            $subject .= " 25+";
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $dateWithInterval = DateUtil::getDateWithInterval(6,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y) . "_to_" . $dateWithInterval->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " for dates $currentDateStr to $dateWithIntervalStr";
        $body = self::getHtml($subject, $reportDetail);
        $roleName = Permissions::getName(Permissions::usa_team);
        $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_DUE_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
   
    //Weekly/Monday - No. projects overdue  
    public static function sendProjectsOverDueTillNow($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_over_due_till_now_weekly);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_OVERDUE_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectOverDue();
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_OVERDUE_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        //$userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        //$roleName = Permissions::getName(Permissions::usa_team);
        // $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_OVERDUE_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    private static function getGLUsersByNotificationType($users,$notificationType){
        if(isset($users[GraphicLogsNotificationType::getName($notificationType)])){
            return $users[GraphicLogsNotificationType::getName($notificationType)];
        }else{
            return null;
        }
    }
    
    //Weekly/Monday - No. of projected completed previous week
    public static function sendProjectsCompletedLastWeek($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_completed_last_week_weekly);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_COMPLETED_PREVIOUS_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectCompletedLastWeek();
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_COMPLETED_PREVIOUS_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(1,null,true,self::$timeZone);
        $dateWithInterval = DateUtil::getDateWithInterval(7,null,true,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $dateWithInterval->format(self::$N_J_Y) . "_to_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
       // $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For last week for dates $dateWithIntervalStr to $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
       // $roleName = Permissions::getName(Permissions::usa_team);
        //$users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_COMPLETED_LAST_WEEK_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday - No. of projects in buyers review
    public static function sendProjectsInBuyerReview($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_in_buyer_review_weekly);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_IN_BUYER_REVIEW_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::buyers_reviewing);
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_BUYER_REVIEW_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        //$userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        //$roleName = Permissions::getName(Permissions::usa_team);
        // $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_IN_BUYER_REVIEW ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday - No. of projects in manager review
    public static function sendProjectsInManagerReview($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_in_manager_review_weekly);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_IN_MANAGER_REVIEW_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::manager_reviewing);
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_MANAGER_REVIEW_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
//         $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
//         $roleName = Permissions::getName(Permissions::usa_team);
//         $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_IN_MANAGER_REVIEW ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday - No. of projects in robby review
    public static function sendProjectsInRobbyReview($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_in_robby_review_weekly);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_IN_ROBBY_REVIEW_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::robby_reviewing);
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_ROBBY_REVIEW_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
//         $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
//         $roleName = Permissions::getName(Permissions::usa_team);
//         $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_IN_ROBBY_REVIEW ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday & Daily No. of projects with pending info. From buyers/China 
    public static function sendProjectsMissingInfoFromChina($users,$isDaily = false){
        $notificationType = GraphicLogsNotificationType::projects_missing_info_from_china_daily;
        if(!$isDaily){
            $notificationType = GraphicLogsNotificationType::projects_missing_info_from_china_weekly;
        }
        $users = self::getGLUsersByNotificationType($users,$notificationType);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_IN_MISSING_INFO_FROM_CHINA_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::missing_info_from_china);
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_MISSING_INFO_FROM_CHINA_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval();
        if(!$isDaily){
            $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        }
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
//         $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
//         $roleName = Permissions::getName(Permissions::usa_team);
//         if($isDaily){
//             $roleName = Permissions::getName(Permissions::china_team);
//         }
//         $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_MISSING_INFO_FROM_CHINA ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Daily/Beginning of day - Projects past due because we don’t have information to complete
    public static function sendProjectsPastDueWithMissingInfoFromChina($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::project_passed_due_with_missing_info_from_china_daily);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_PAST_DUE_IN_MISSING_INFO_FROM_CHINA_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByPastDueWithMissingInfoFromChina();
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_PAST_DUE_IN_MISSING_INFO_FROM_CHINA_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval();
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
//         $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
//         $roleName = Permissions::getName(Permissions::china_team);
//         $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_PAST_DUE_WITH_MISSING_INFO_FROM_CHINA ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Daily/Beginning of day - List of Items Due for the Day
    public static function sendProjectsDueForToday($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_due_for_today_daily);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_DUE_TODAY_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueForToday();
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_TODAY_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
//         $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " for date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
//         $roleName = Permissions::getName(Permissions::usa_team);
//         $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_DUE_FOR_TODAY_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }

    //Daily/Beginning of day - Due in Less than 20 Days from China Entry Date
    public static function sendProjectsDueLessThan20DaysFromEntryDate($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_due_less_than_20_days_from_entry_date_daily);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_ENTRY_DATE_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueLessThan20FromEntry();
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_ENTRY_DATE_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
       // $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
       // $users = $userMgr->getAllUsersForGraphicLogs();
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_DUE_FOR_LESS_THAN_20_DAYS_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Daily/Beginning of day - Projects entered that day that is due in less than 20 days
    public static function sendProjectsDueLessThan20DaysFromToday($users){
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::projects_due_less_than_20_days_from_today_daily);
        if(empty($users)){
            return;
        }
        $subject = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_TODAY_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueLessThan20FromToday();
        if(empty($graphiclogs)){
            return;
        }
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_TODAY_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        //$userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " from date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
       // $users = $userMgr->getAllUsersForGraphicLogs();
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        $flag = MailUtil::sendSmtpMail($subject, $body, $toEmails, true,$attachments);
        if($flag){
            $emaillogMgr = EmailLogMgr::getInstance();
            foreach ($users as $user){
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_DUE_FOR_LESS_THAN_20_DAYS_FROM_TODAY ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Instant when graphic status changed from graphic log - Missing Info from China
    public static function sendGraphicLogGraphicStatusChangedNotification($graphicLog){
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getAllUsersWithRoles();
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::graphic_logs_status_change_instant);
        if(empty($users)){
            return;
        }
        $loggedInUserName = SessionUtil::getInstance()->getUserLoggedInName();
        $phAnValues = array();
        $graphicStatus = $graphicLog->getGraphicStatus();
        if(!empty($graphicStatus)){
            $graphicStatus = GraphicStatusType::getValue($graphicStatus);
        }
        $phAnValues["GRAPHIC_STATUS"] = $graphicStatus;
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["ITEM_ID"] = $graphicLog->getSKU();
        $phAnValues["PO_NUMBER"] = $graphicLog->getPO();
        $date = new DateTime();
        $dateStr = $date->format("m-d-Y h:i a");
        $phAnValues["CURRENT_DATE"] = $dateStr;
      //  $roleName = Permissions::china_team;
        //$roleName = Permissions::getName($roleName);
        $content = file_get_contents("../GraphicLogsGraphicStatusChangedTemplate.php");
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        //$users = $userMgr->getUsersForGraphicNotesUpdatedReport($roleName);
        $toEmails = array();
        $phAnValues = array();
        foreach ($users as $user){
           // $phAnValues["FULL_NAME"] = $user->getFullName();
           // $html = MailUtil::replacePlaceHolders($phAnValues, $html);
            array_push($toEmails,$user->getEmail());
        }
        if(!empty($toEmails)){
            $subject = StringConstants::PROJECT_MISSING_INFO_FROM_CHINA_DAILY;
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_MISSING_INFO_FROM_CHINA_DAILY ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
    }
    
    //Instant when notes updated from graphic log
    public static function sendGraphicLogNotesUpdatedNotification($graphicLog,$noteType){
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getAllUsersWithRoles();
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::graphic_logs_notes_update_instant);
        if(empty($users)){
            return;
        }
        $loggedInUserName = SessionUtil::getInstance()->getUserLoggedInName();
        $phAnValues = array();
        $phAnValues["NOTES_NAME"] = $noteType;
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["ITEM_ID"] = $graphicLog->getSKU();
        $phAnValues["PO_NUMBER"] = $graphicLog->getPO();
        $noteDetail = "";
        $roleName = "";
        if($noteType == "USA"){
            $noteDetail = $graphicLog->getUSANotes();
            $roleName  = Permissions::usa_team;
        }else if($noteType == "CHINA"){
            $roleName  = Permissions::china_team;
            $noteDetail = $graphicLog->getChinaNotes();
        }else if($noteType == "GRAPHIC"){
            $noteDetail = $graphicLog->getGraphicsToChinaNotes();
            $roleName  = Permissions::graphic_designer;
        }
        $roleName = Permissions::getName($roleName);
        $phAnValues["NOTES_DETAIL"] = $noteDetail;
        $content = file_get_contents("../GraphicLogsNotesUpdatedTemplate.php");
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        $toEmails = array();
        //$phAnValues = array();
        foreach ($users as $user){
            //$phAnValues["FULL_NAME"] = $user->getFullName();
            //$html = MailUtil::replacePlaceHolders($phAnValues, $html);
            array_push($toEmails,$user->getEmail());
        }
        if(!empty($toEmails)){
            $subject = "Alpine BI Graphics | ". $noteType . " Notes Updated For Graphic Logs on Alpinebi";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_NOTES_UPDATED ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
    }
    
    //Instant when notes updated from graphic log
    public static function sendFinalGraphicDueDateChangedNotification($graphicLog){
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getAllUsersWithRoles();
        $users = self::getGLUsersByNotificationType($users,
            GraphicLogsNotificationType::final_graphics_due_date_changed_instant);
        if(empty($users)){
            return;
        }
        $loggedInUserName = SessionUtil::getInstance()->getUserLoggedInName();
        $phAnValues = array();
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["ITEM_ID"] = $graphicLog->getSKU();
        $phAnValues["PO_NUMBER"] = $graphicLog->getPO();
        $phAnValues["DATE_STR"] = date_format(new DateTime(), "m-d-Y");
        
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/GraphicFinalGraphicDueDateChangedTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        if(!empty($toEmails)){
            $subject = "Alpine BI Graphics | Final Graphic Due Date Changed on Alpinebi";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_FINAL_GRAPHIC_DUE_DATE_CHANGED ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
    }
    
    
    
    
    
}