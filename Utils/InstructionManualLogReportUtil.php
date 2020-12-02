<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/InstructionManualCustomersMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualNotificationType.php");

class InstructionManualLogReportUtil
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
    
    //Instant when graphic status changed from graphic log - Missing Info from China
    
    public static function sendInstructionManualDiagramSavedDateUpdatedNotification($instructionManual){
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getAllUsersWithRoles();
        $users = self::getInstructionManualUsersByNotificationType($users,
            InstructionManualNotificationType::date_diagram_saved_instant);
        if(empty($users)){
            return;
        }
        $loggedInUserName = SessionUtil::getInstance()->getUserLoggedInName();
        $phAnValues = array();
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        // $phAnValues["ITEM_ID"] = $graphicLog->getSKU();
        // $phAnValues["PO_NUMBER"] = $graphicLog->getPO();
        $phAnValues["DATE_STR"] = date_format(new DateTime(), "m-d-Y");
        $phAnValues['DIAGRAM_SAVED_DATE'] = date_format($instructionManual->getDiagramSavedDate(), "m-d-Y") ;
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/InstructionManualDiagramSavedDateChangedTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        $toEmails = array();
        foreach ($users as $user){
            array_push($toEmails,$user->getEmail());
        }
        if(!empty($toEmails)){
            $subject = "Alpine BI Instruction Manual | Diagram Saved Date Changed on Alpinebi";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::INSTRUCTION_MANUAL_DIAGRAM_SAVED_DATE_CHANGED ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
    }
    private static function getInstructionManualUsersByNotificationType($users,$notificationType){
        if(isset($users[InstructionManualNotificationType::getName($notificationType)])){
            return $users[InstructionManualNotificationType::getName($notificationType)];
        }else{
            return null;
        }
    }
    public static function sendInstructionManualNotesToUsaUpdatedNotification($instructionManualLog,$noteType){
        $userMgr = UserMgr::getInstance();
        $users = $userMgr->getAllUsersWithRoles();
        $users = self::getInstructionManualUsersByNotificationType($users,
        InstructionManualNotificationType::notes_to_usa_office_saved_instant);
        if(empty($users)){
            return;
        }
        $loggedInUserName = SessionUtil::getInstance()->getUserLoggedInName();
        $phAnValues = array();
        $phAnValues["NOTES_NAME"] = $noteType;
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        // $phAnValues["ITEM_ID"] = $instructionManualLog->getSKU();
        // $phAnValues["PO_NUMBER"] = $instructionManualLog->getPO();
        $noteDetail = "";
        $roleName = "";
        if($noteType == "USA"){
            $noteDetail = $instructionManualLog->getNotesToUsa();
            $roleName  = Permissions::instruction_manual_usa_team;
        }else if($noteType == "CHINA"){
            $roleName  = Permissions::instruction_manual_china_team;
            $noteDetail = $instructionManualLog->getChinaNotes();
        }else if($noteType == "TECHNICAL"){
            $noteDetail = $instructionManualLog->getGraphicsToChinaNotes();
            $roleName  = Permissions::instruction_manual_technical_team;
        }
        $roleName = Permissions::getName($roleName);
        $phAnValues["NOTES_DETAIL"] = $noteDetail;
        $content = file_get_contents("../InstructionManualNotesToUsaUpdatedTemplate.php");
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
            $subject = "Alpine BI Instruction Manual | ". $noteType . " Notes To USA Updated For Instruction Manual Logs on Alpinebi";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($users as $user){
                    $emaillogMgr->saveEmailLog(EmailLogType::INSTRUCTION_MANUAL_NOTES_TO_USA_CHANGED ,$user->getEmail(), null,$user->getSeq());
                }
            }
        }
    }
}