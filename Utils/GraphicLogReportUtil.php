<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
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
    
    //Weekly/Monday - Projects due this 
    public static function sendProjectsDueForWeekReport(){
        $subject = StringConstants::PROJECT_DUE_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueForNextWeek();
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $dateWithInterval = DateUtil::getDateWithInterval(6,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y) . "_to_" . $dateWithInterval->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For next week for dates $currentDateStr to $dateWithIntervalStr";
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
    public static function sendProjectsOverDueTillNow(){
        $subject = StringConstants::PROJECT_OVERDUE_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectOverDue();
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_OVERDUE_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
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
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_OVERDUE_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday - No. of projected completed previous week
    public static function sendProjectsCompletedLastWeek(){
        $subject = StringConstants::PROJECT_COMPLETED_PREVIOUS_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectCompletedLastWeek();
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_COMPLETED_PREVIOUS_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(1,null,true,self::$timeZone);
        $dateWithInterval = DateUtil::getDateWithInterval(7,null,true,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $dateWithIntervalStr = $dateWithInterval->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $dateWithInterval->format(self::$N_J_Y) . "_to_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " For last week for dates $dateWithIntervalStr to $currentDateStr";
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
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_COMPLETED_LAST_WEEK_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday - No. of projects in buyers review
    public static function sendProjectsInBuyerReview(){
        $subject = StringConstants::PROJECT_IN_BUYER_REVIEW_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::BUYERS_REVIEWING);
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_BUYER_REVIEW_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
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
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_IN_BUYER_REVIEW ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday - No. of projects in manager review
    public static function sendProjectsInManagerReview(){
        $subject = StringConstants::PROJECT_IN_MANAGER_REVIEW_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::MANAGER_REVIEWING);;
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_MANAGER_REVIEW_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
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
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_IN_MANAGER_REVIEW ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday - No. of projects in robby review
    public static function sendProjectsInRobbyReview(){
        $subject = StringConstants::PROJECT_IN_ROBBY_REVIEW_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::ROBBY_REVIEWING);;
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_ROBBY_REVIEW_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
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
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_IN_ROBBY_REVIEW ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }
    
    //Weekly/Monday & Daily
    //No. of projects with pending info. From buyers/China 
    public static function sendProjectsMissingInfoFromChina($isDaily = false){
        $subject = StringConstants::PROJECT_IN_MISSING_INFO_FROM_CHINA_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByGraphicStatus(GraphicStatusType::MISSING_INFO_FROM_CHINA);;
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_IN_MISSING_INFO_FROM_CHINA_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval();
        if(!$isDaily){
            $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        }
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        $roleName = Permissions::getName(Permissions::usa_team);
        if($isDaily){
            $roleName = Permissions::getName(Permissions::china_team);
        }
        $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
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
    public static function sendProjectsPastDueWithMissingInfoFromChina(){
        $subject = StringConstants::PROJECT_PAST_DUE_IN_MISSING_INFO_FROM_CHINA_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getByPastDueWithMissingInfoFromChina();
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_PAST_DUE_IN_MISSING_INFO_FROM_CHINA_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval();
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        $roleName = Permissions::getName(Permissions::china_team);
        $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
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
    public static function sendProjectsDueForToday(){
        $subject = StringConstants::PROJECT_DUE_TODAY_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueForToday();
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_TODAY_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " for date $currentDateStr";
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
                $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_PROJECT_DUE_FOR_TODAY_REPORT ,$user->getEmail(), null,$user->getSeq());
            }
        }
    }

    //Daily/Beginning of day - Due in Less than 20 Days from China Entry Date
    public static function sendProjectsDueLessThan20DaysFromEntryDate(){
        $subject = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_ENTRY_DATE_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueLessThan20FromEntry();
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_ENTRY_DATE_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " till date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        $users = $userMgr->getAllUsersForGraphicLogs();
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
    public static function sendProjectsDueLessThan20DaysFromToday(){
        $subject = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_TODAY_REPORT;
        $graphicLogMgr = GraphicLogMgr::getInstance();
        $graphiclogs = $graphicLogMgr->getForProjectDueLessThan20FromToday();
        $excelData = ExportUtil::exportGraphicLogs($graphiclogs,true);
        $reportName = StringConstants::PROJECT_DUE_LESS_THAN_20_FROM_TODAY_REPORT_NAME;
        $currentDate = DateUtil::getDateWithInterval(0,null,false,self::$timeZone);
        $currentDateStr = $currentDate->format(DateUtil::$US_FORMAT);
        $fileName = $reportName . "_" . $currentDate->format(self::$N_J_Y);
        $attachments = array($fileName=>$excelData);
        $userMgr = UserMgr::getInstance();
        $reportDetail = $reportName . " from date $currentDateStr";
        $body = self::getHtml($subject, $reportDetail);
        $users = $userMgr->getAllUsersForGraphicLogs();
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
        $loggedInUserName = SessionUtil::getInstance()->getUserLoggedInName();
        $phAnValues = array();
        $phAnValues["GRAPHIC_STATUS"] = $graphicLog->getGraphicStatus();
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["ITEM_ID"] = $graphicLog->getSKU();
        $phAnValues["PO_NUMBER"] = $graphicLog->getPO();
        $date = new DateTime();
        $dateStr = $date->format("m-d-Y h:i a");
        $phAnValues["CURRENT_DATE"] = $dateStr;
        $roleName = Permissions::china_team;
        $roleName = Permissions::getName($roleName);
        $content = file_get_contents("../GraphicLogsGraphicStatusChangedTemplate.php");
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getUsersForGraphicNotesUpdatedReport($roleName);
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
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getUserssByRoleAndDepartment($roleName, self::$GL_DEP_SEQ);
        $toEmails = array();
        $phAnValues = array();
        foreach ($users as $user){
            $phAnValues["FULL_NAME"] = $user->getFullName();
            $html = MailUtil::replacePlaceHolders($phAnValues, $html);
            array_push($toEmails,$user->getEmail());
        }
        if(!empty($toEmails)){
            $subject = $noteType . " Notes Updated For Graphic Logs on Alpinebi";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::GRAPHIC_LOG_NOTES_UPDATED ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
    }
    
    
    
    
    
    
}