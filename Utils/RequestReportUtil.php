<?php
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestNotificationType.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestStatusMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestMgr.php");

class RequestReportUtil
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
    
    private static function getRequestUsersByNotificationType($users,$notificationType){
        if(isset($users[RequestNotificationType::getName($notificationType)])){
            return $users[RequestNotificationType::getName($notificationType)];
        }else{
            return null;
        }
    }
    private static function getRequestUsersByPermission($users,$notificationType){
        if(isset($users[Permissions::getName($notificationType)])){
            return $users[Permissions::getName($notificationType)];
        }else{
            return null;
        }
    }
    public static function sendNewRequestNotificationToManagerOfDepartment($request){ // Instant
        $userMgr = UserMgr::getInstance();
        $toEmails = [];
        $usersForLogs = [];
        $tempUserArr = [];
        if($request->getAssignedBy() != null){
            $user = $userMgr->findBySeq($request->getAssignedBy());
            array_push($toEmails,$user->getEmail());
            $tempUserArr['email'] = $user->getEmail();
            $tempUserArr['seq'] = $user->getSeq();
            array_push($usersForLogs,$tempUserArr);
        }else{
            $usersByPermission = $userMgr->getUsersForDDByPermission(Permissions::request_management_manager);
            $usersWithProjectDepartments = $userMgr->getAllUsersWithProjectDepartments();
            $users = $userMgr->getAllUsersWithRoles();
            $users = self::getRequestUsersByNotificationType($users,RequestNotificationType::new_request_creation);
            foreach($users as $key => $user){
                if($user->getRequestDepartments() != null){
                    if(in_array($request->getDepartment(),$usersWithProjectDepartments[$user->getSeq()]['requestdepartments']) &&
                         isset($usersByPermission[$user->getSeq()])){
                        array_push($toEmails,$user->getEmail());
                        $tempUserArr['email'] = $user->getEmail();
                        $tempUserArr['seq'] = $user->getSeq();
                        array_push($usersForLogs,$tempUserArr);
                    }
                }
            }   
        }
        if(empty($toEmails)){
            return;
        }
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserName = $sessionUtil->getUserLoggedInName();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $loggedInUserDateTime = DateUtil::getCurrentDateTimeStrWithTimeZone($loggedInUserTimeZone);
        $phAnValues = array();
        $phAnValues["REQUEST_TITLE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getTitle()."</a>";
        $phAnValues["REQUEST_CODE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getCode()."</a>"; 
        $phAnValues["REQUEST_DEPARTMENT"] = RequestDepartments::getValue($request->getDepartment()); 
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["CURR_DATE_TIME"] = $loggedInUserDateTime;
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/NewRequestCreatedTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        if(!empty($toEmails)){
            $subject = "Alpine BI | New Project Created";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($usersForLogs as $userForLog){
                    $emaillogMgr->saveEmailLog(EmailLogType::NEW_REQUEST_CREATED ,$userForLog['email'], null,$userForLog['seq']);
                }
            }
        }
    }
    public static function sendRequestAssignmentNotificationToEmployee($request){ // Instant
        $userMgr = UserMgr::getInstance();
        $toEmails = [];
        $userRoles = $userMgr->getUserRolesArr($request->getAssignedTo());
        $assignedToSeq = $request->getAssignedTo();
        if($assignedToSeq != null && self::isNotificationEnabledForThisUser($assignedToSeq,RequestNotificationType::request_assignee_assignment)){
            $user = $userMgr->findBySeq($assignedToSeq);
            array_push($toEmails,$user->getEmail());
        }
        if(empty($toEmails)){
            return;
        }
        $user = $userMgr->findBySeq($assignedToSeq);
        $userForLog = [];
        $userForLog['email'] = $user->getEmail();
        $userForLog['seq'] = $assignedToSeq;
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserName = $sessionUtil->getUserLoggedInName();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $loggedInUserDateTime = DateUtil::getCurrentDateTimeStrWithTimeZone($loggedInUserTimeZone);
        $phAnValues = array();
        $phAnValues["ASSIGNED_TO"] = $user->getFullName();
        $phAnValues["REQUEST_TITLE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getTitle()."</a>";
        $phAnValues["REQUEST_CODE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getCode()."</a>"; 
        $phAnValues["REQUEST_DEPARTMENT"] = RequestDepartments::getValue($request->getDepartment()); 
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["CURR_DATE_TIME"] = $loggedInUserDateTime;
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestAssignmentNotificationToAssigneeTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        if(!empty($toEmails)){
            $subject = "Alpine BI | Project Assigned To";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                $emaillogMgr->saveEmailLog(EmailLogType::REQUEST_ASSIGNED_TO_EMPLOYEE ,$userForLog['email'], null,$userForLog['seq']);
            }
        }
    }
    public static function sendRequestStatusChangeNotificationToRequester($request,$existingRequest){ // Instant
        $requestStatusMgr = RequestStatusMgr::getInstance();
        $userMgr = UserMgr::getInstance();
        $requesterSeq = $request->getCreatedBy();
        $managerSeq = $request->getAssignedBy();
        $toEmails = [];
        $usersForLogs = [];
        $usersArr = [];
        if($requesterSeq != null && self::isNotificationEnabledForThisUser($requesterSeq,RequestNotificationType::status_change)){
            $requester = $userMgr->findBySeq($requesterSeq);
            array_push($usersArr,$requester);
        }
        if($managerSeq != null && self::isNotificationEnabledForThisUser($requesterSeq,RequestNotificationType::status_change)){
            $manager = $userMgr->findBySeq($managerSeq);
            array_push($usersArr,$manager);
        }
        foreach($usersArr as $user){
            array_push($toEmails,$user->getEmail());
            array_push($usersForLogs,array("email"=>$user->getEmail(),"seq"=>$user->getSeq()));
        }
        if(empty($toEmails)){
             return;
        }
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserName = $sessionUtil->getUserLoggedInName();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $loggedInUserDateTime = DateUtil::getCurrentDateTimeStrWithTimeZone($loggedInUserTimeZone);
        $requestStatus = $request->getRequestStatusSeq() != null ? $requestStatusMgr->findBySeq($request->getRequestStatusSeq()) : "";
        $previousRequestStatus = $existingRequest->getRequestStatusSeq() != null ? $requestStatusMgr->findBySeq($existingRequest->getRequestStatusSeq()) : "";
        $phAnValues = array();
        $phAnValues["STATUS"] = $requestStatus != '' ? $requestStatus->getTitle() : "";
        $phAnValues["PREVIOUS_STATUS"] = $previousRequestStatus != "" ? $previousRequestStatus->getTitle() : "";
        $phAnValues["REQUEST_TITLE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getTitle()."</a>";
        $phAnValues["REQUEST_CODE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getCode()."</a>";
        $phAnValues["REQUEST_DEPARTMENT"] = RequestDepartments::getValue($request->getDepartment()); 
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["CURR_DATE_TIME"] = $loggedInUserDateTime;
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestStatusChangeNotificationToRequesterTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        if(!empty($toEmails)){
            $subject = "Alpine BI | Project Status Changed";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($usersForLogs as $userForLog){
                    $emaillogMgr->saveEmailLog(EmailLogType::REQUEST_STATUS_CHANGED ,$userForLog['email'], null,$userForLog['seq']);
                }
            }
        }
    }
    public static function sendCommentAddedOnRequestNotification($requestSeq,$comment){ // Instant
        $userMgr = UserMgr::getInstance();
        $requestMgr = RequestMgr::getInstance();
        $request = $requestMgr->findBySeq($requestSeq);
        $requesterSeq = $request->getCreatedBy();
        $employeeSeq = $request->getAssignedTo();
        $managerSeq = $request->getAssignedBy();
        $userSeqs = array($requesterSeq,$employeeSeq,$managerSeq);
        $toEmails = [];
        $usersForLogs = [];
        foreach($userSeqs as $seq){
            if(self::isNotificationEnabledForThisUser($seq,RequestNotificationType::comments_added)){
                $user = $userMgr->findBySeq($seq); 
                array_push($toEmails,$user->getEmail());
                array_push($usersForLogs,array("email"=>$user->getEmail(),"seq"=>$user->getSeq()));
            }
        }
        if(empty($toEmails)){
             return;
        }
        
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserName = $sessionUtil->getUserLoggedInName();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $loggedInUserDateTime = DateUtil::getCurrentDateTimeStrWithTimeZone($loggedInUserTimeZone);

        $phAnValues = array();
        $phAnValues["COMMENT"] = $comment;
        $phAnValues["REQUEST_TITLE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getTitle()."</a>";
        $phAnValues["REQUEST_CODE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getCode()."</a>"; 
        $phAnValues["REQUEST_DEPARTMENT"] = RequestDepartments::getValue($request->getDepartment()); 
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["CURR_DATE_TIME"] = $loggedInUserDateTime;
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestCommentAddedNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        if(!empty($toEmails)){
            $subject = "Alpine BI | Comment Added On Project";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($usersForLogs as $userForLog){
                    $emaillogMgr->saveEmailLog(EmailLogType::COMMENT_ADDED_ON_REQUEST ,$userForLog['email'], null,$userForLog['seq']);
                }
            }
        }
    }
    public static function sendFileAddedOnRequestNotification($requestSeq,$attachmentTitle){ // Instant
        $userMgr = UserMgr::getInstance();
        $requestMgr = RequestMgr::getInstance();
        $request = $requestMgr->findBySeq($requestSeq);
        $requesterSeq = $request->getCreatedBy();
        $employeeSeq = $request->getAssignedTo();
        $managerSeq = $request->getAssignedBy();
        $userSeqs = array($requesterSeq,$employeeSeq,$managerSeq);
        $toEmails = [];
        $usersForLogs = [];
        foreach($userSeqs as $seq){
            if(self::isNotificationEnabledForThisUser($seq,RequestNotificationType::files_uploaded)){
                $user = $userMgr->findBySeq($seq); 
                array_push($toEmails,$user->getEmail());
                array_push($usersForLogs,array("email"=>$user->getEmail(),"seq"=>$user->getSeq()));
            }
        }
        if(empty($toEmails)){
             return;
        }
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserName = $sessionUtil->getUserLoggedInName();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $loggedInUserDateTime = DateUtil::getCurrentDateTimeStrWithTimeZone($loggedInUserTimeZone);

        $phAnValues = array();
        $phAnValues["ATTACHMENT_TITLE"] = $attachmentTitle;
        $phAnValues["REQUEST_TITLE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getTitle()."</a>";
        $phAnValues["REQUEST_CODE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getCode()."</a>"; 
        $phAnValues["REQUEST_DEPARTMENT"] = RequestDepartments::getValue($request->getDepartment()); 
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["CURR_DATE_TIME"] = $loggedInUserDateTime;
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestFileAddedNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        if(!empty($toEmails)){
            $subject = "Alpine BI | File Added On Project";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($usersForLogs as $userForLog){
                    $emaillogMgr->saveEmailLog(EmailLogType::FILE_ADDED_ON_REQUEST ,$userForLog['email'], null,$userForLog['seq']);
                }
            }
        }
    }
    public static function sendRequestMarkedAsCompletedNotification($request){ // Instant
        $userMgr = UserMgr::getInstance();
        $requesterSeq = $request->getCreatedBy();
        $employeeSeq = $request->getAssignedTo();
        $managerSeq = $request->getAssignedBy();
        $userSeqs = array($requesterSeq,$employeeSeq,$managerSeq);
        $toEmails = [];
        $usersForLogs = [];
        foreach($userSeqs as $seq){
            if(self::isNotificationEnabledForThisUser($seq,RequestNotificationType::marked_completed)){
                $user = $userMgr->findBySeq($seq); 
                array_push($toEmails,$user->getEmail());
                array_push($usersForLogs,array("email"=>$user->getEmail(),"seq"=>$user->getSeq()));
            }
        }
        if(empty($toEmails)){
             return;
        }
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserName = $sessionUtil->getUserLoggedInName();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $loggedInUserDateTime = DateUtil::getCurrentDateTimeStrWithTimeZone($loggedInUserTimeZone);

        $phAnValues = array();
        $phAnValues["REQUEST_TITLE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getTitle()."</a>";
        $phAnValues["REQUEST_CODE"] = "<a href='" . StringConstants::WEB_PORTAL_LINK . "adminManageRequests.php?projectno=". $request->getCode() ."'>".$request->getCode()."</a>";
        $phAnValues["REQUEST_DEPARTMENT"] = RequestDepartments::getValue($request->getDepartment()); 
        $phAnValues["LOGGED_IN_USER_NAME"] = $loggedInUserName;
        $phAnValues["CURR_DATE_TIME"] = $loggedInUserDateTime;
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestMarkedAsCompletedNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        if(!empty($toEmails)){
            $subject = "Alpine BI | Project Marked As Completed";
            $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
            if($flag){
                $emaillogMgr = EmailLogMgr::getInstance();
                foreach ($usersForLogs as $userForLog){
                    $emaillogMgr->saveEmailLog(EmailLogType::REQUEST_MARKED_AS_COMPLETED ,$userForLog['email'], null,$userForLog['seq']);
                }
            }
        }
    }
    public static function isNotificationEnabledForThisUser($userSeq,$notificationType){
        $userMgr = UserMgr::getInstance();
		$userRoles = $userMgr->getUserRolesArr($userSeq);
		return in_array(RequestNotificationType::getName($notificationType),$userRoles);
	}

    //--------------------------------------------------------------------------------------------------------------------------------------
    public static function sendRequestsDueInNextWeekNotificationToManagers(){ // Weekly For Manager
        $requestMgr = RequestMgr::getInstance();
        $managerRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_manager),RequestNotificationType::getName(RequestNotificationType::request_due_in_next_week));

        $usersForLog = [];
        foreach($users as $user){
            $userDepartments = $user['requestdepartments'];
            $userDepartments = implode("','",explode(",",$userDepartments));
            $managerRequests[$user['email']] = $requestMgr->findByDepartmentsForRequestsDueInNextWeekForManager($userDepartments,$user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Due In Next Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsDueInNextWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($managerRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_DUE_IN_NEXT_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
    public static function sendRequestsDueInNextWeekNotificationToEmployee(){ // Weekly For Employee
        $requestMgr = RequestMgr::getInstance();
        $employeeRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_employee),RequestNotificationType::getName(RequestNotificationType::request_due_in_next_week));

        $usersForLog = [];
        foreach($users as $user){
            $employeeRequests[$user['email']] = $requestMgr->findRequestsDueInNextWeekForEmployee($user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Due In Next Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsDueInNextWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($employeeRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails) && !empty($requests)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_DUE_IN_NEXT_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
    public static function sendRequestsPassedDueInLastWeekNotificationToManagers(){ // Weekly For Manager
        $requestMgr = RequestMgr::getInstance();
        $managerRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_manager),RequestNotificationType::getName(RequestNotificationType::request_passed_due_in_last_week));

        $usersForLog = [];
        foreach($users as $user){
            $userDepartments = $user['requestdepartments'];
            $userDepartments = implode("','",explode(",",$userDepartments));
            $managerRequests[$user['email']] = $requestMgr->findByDepartmentsForRequestsPassedDueInLastWeekForManager($userDepartments,$user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Passed Due In Last Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsPassedDueInLastWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($managerRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_PASSED_DUE_IN_LAST_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
    public static function sendRequestsPassedDueInLastWeekNotificationToEmployee(){ // Weekly For Employee
        $requestMgr = RequestMgr::getInstance();
        $employeeRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_employee),RequestNotificationType::getName(RequestNotificationType::request_passed_due_in_last_week));

        $usersForLog = [];
        foreach($users as $user){
            $employeeRequests[$user['email']] = $requestMgr->findRequestsPassedDueInNextWeekForEmployee($user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Passed Due In Last Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsPassedDueInLastWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($employeeRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails) && !empty($requests)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_PASSED_DUE_IN_LAST_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
    public static function sendRequestsAssigneeDueDateInNextWeekNotificationToEmployee(){ // Weekly For Employee
        $requestMgr = RequestMgr::getInstance();
        $employeeRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_employee),RequestNotificationType::getName(RequestNotificationType::assignee_due_in_next_week));

        $usersForLog = [];
        foreach($users as $user){
            $employeeRequests[$user['email']] = $requestMgr->findRequestsAssigneeDueDateInNextWeekForEmployee($user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Assignee Due In Next Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsAssigneeDueDateInNextWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($employeeRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails) && !empty($requests)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_ASSIGNEE_DUE_DATE_IN_NEXT_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
    public static function sendRequestsAssigneeDueDateInNextWeekNotificationToManager(){ // Weekly For Manager
        $requestMgr = RequestMgr::getInstance();
        $managerRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_manager),RequestNotificationType::getName(RequestNotificationType::assignee_due_in_next_week));

        $usersForLog = [];
        foreach($users as $user){
            $userDepartments = $user['requestdepartments'];
            $userDepartments = implode("','",explode(",",$userDepartments));
            $managerRequests[$user['email']] = $requestMgr->findRequestsAssigneeDueDateInNextWeekForManager($userDepartments,$user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Assignee Due In Next Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsAssigneeDueDateInNextWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($managerRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails) && !empty($requests)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_ASSIGNEE_DUE_DATE_IN_NEXT_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
    public static function sendRequestsAssigneeDueDatePassedInLastWeekNotificationToEmployee(){ // Weekly For Employee
        $requestMgr = RequestMgr::getInstance();
        $employeeRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_employee),RequestNotificationType::getName(RequestNotificationType::assignee_passed_due_in_last_week));

        $usersForLog = [];
        foreach($users as $user){
            $employeeRequests[$user['email']] = $requestMgr->findRequestsAssigneeDueDatePassedInLastWeekForEmployee($user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Assignee Passed Due In Last Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsAssigneeDueDatePassedInLastWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($employeeRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails) && !empty($requests)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_ASSIGNEE_DUE_DATE_PASSED_IN_LAST_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
    public static function sendRequestsAssigneeDueDatePassedInLastWeekNotificationToManager(){ // Weekly For Manager
        $requestMgr = RequestMgr::getInstance();
        $managerRequests = [];
        $userMgr = UserMgr::getInstance();
        $toEmails = array();
        $users = $userMgr->getUsersByPermissionTypeAndNotificationType(Permissions::getName(Permissions::request_management_manager),RequestNotificationType::getName(RequestNotificationType::assignee_passed_due_in_last_week));
        
        $usersForLog = [];
        foreach($users as $user){
            $userDepartments = $user['requestdepartments'];
            $userDepartments = implode("','",explode(",",$userDepartments));
            $managerRequests[$user['email']] = $requestMgr->findRequestsAssigneeDueDatePassedInLastWeekForManager($userDepartments,$user['seq']);
            $usersForLog[$user['email']] = array("seq"=>$user['seq'],"email"=>$user['email']);
        }
        $subject = "Projects Assignee Passed Due In Last Week";
        $phAnValues = array();
        $emailTemplatePath = StringConstants::WEB_PORTAL_LINK . "/emailtemplates/RequestsAssigneeDueDatePassedInLastWeekNotificationTemplate.php";
        $content = file_get_contents($emailTemplatePath);
        $content = MailUtil::replacePlaceHolders($phAnValues, $content);
        $html = MailUtil::appendToEmailTemplateContainer($content);
        foreach($managerRequests as $key => $requests){
            $exportArray = $requestMgr->processRowsForExport($requests);
            // $exportRequests[$key] = PHPExcelUtil::exportRequests($exportArray,$subject,true);
            $attachments = array("Project_Department" => PHPExcelUtil::exportRequests($exportArray,"Project Management",true));
            array_push($toEmails,$key);
            if(!empty($toEmails) && !empty($requests)){
                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
                $EmaillogMgr = EmailLogMgr::getInstance();
                if($bool){
                    $EmaillogMgr->saveEmailLog(EmailLogType::REQUESTS_ASSIGNEE_DUE_DATE_PASSED_IN_LAST_WEEK,$usersForLog[$key]["email"],null,$usersForLog[$key]["seq"]);
                }
            }
        }
    }
}