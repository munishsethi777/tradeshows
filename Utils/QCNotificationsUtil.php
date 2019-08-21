<?php
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/EmailLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ClassCodeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/NotificationType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/EmailLogType.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");


class QCNotificationsUtil{
	
	public static function sendUpcomingInspectionScheduleNotification($userType){
		$userMgr = UserMgr::getInstance();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$subject = StringConstants::UPCOMING_INSPECTION_SCHEDULE;
		$fromToDates = self::getWeeklyFromToDateArr();
		$fromDate = $fromToDates["fromDate"];
		$toDate = $fromToDates["toDate"];
		$fileName = EmailLogType::QC_UPCOMING_INSPECTION_SCHEDULE ."_".$fromDate."_to_".$toDate;
		if($userType == UserType::SUPERVISOR){
			$finalInspectionQcSchedules = $qcScheduleMgr->getPendingShechededForFinalInspectionDate();
			$middleInspectionQcSchedules = $qcScheduleMgr->getPendingShechededForMiddleInspectionDate();
			$firstInspectionQcSchedules = $qcScheduleMgr->getPendingShechededForFirstInspectionDate();
			$pendingSchedules[NotificationType::SC_FINAL_INPECTION_DATE] = $finalInspectionQcSchedules;
			$pendingSchedules[NotificationType::SC_MIDDLE_INSPECTION_DATE] = $middleInspectionQcSchedules;
			$pendingSchedules[NotificationType::SC_FIRST_INSPECTION_DATE] = $firstInspectionQcSchedules;
			$html = self::getQCNotificationHtml($pendingSchedules,$subject);
			$excelData = ExportUtil::exportQcWeeklyReport($pendingSchedules, $subject, true);
			$attachments = array($fileName=>$excelData);
			$supervisors = $userMgr->getSupervisorsForQCReport();
			$toEmails = array();
			foreach ($supervisors as $user){
				array_push($toEmails,$user->getEmail());
			}
		if(!empty($toEmails)){
				$bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			    $Emaillog = EmailLogMgr::getInstance();
				if($bool){
				    foreach ($supervisors as $user){
				        $Emaillog->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION_SCHEDULE,$user->getEmail(),null,$user->getSeq());
				    }
				    
				}
				
			}	
		 }elseif($userType == UserType::QC){
			$qcUsers = $userMgr->getQCsForQCReport();
			foreach($qcUsers as $user){
				$finalInspectionQcSchedules = $qcScheduleMgr->getPendingShechededForFinalInspectionDate($user->getSeq());
				$middleInspectionQcSchedules = $qcScheduleMgr->getPendingShechededForMiddleInspectionDate($user->getSeq());
				$firstInspectionQcSchedules = $qcScheduleMgr->getPendingShechededForFirstInspectionDate($user->getSeq());
				$pendingSchedules[NotificationType::SC_FINAL_INPECTION_DATE] = $finalInspectionQcSchedules;
				$pendingSchedules[NotificationType::SC_MIDDLE_INSPECTION_DATE] = $middleInspectionQcSchedules;
				$pendingSchedules[NotificationType::SC_FIRST_INSPECTION_DATE] = $firstInspectionQcSchedules;
				$html = "Hello " . $user->getFullName() .", <br>";
				$html .= self::getQCNotificationHtml($pendingSchedules,$subject);
				$excelData = ExportUtil::exportQcWeeklyReport($pendingSchedules, $subject, true);
				$attachments = array($fileName=>$excelData);
				$email = $user->getEmail();
				$toEmails = explode(",", $email);
				if(empty($toEmails)){
					continue;
				}
				MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			}
		}
		
	}
	
	private static function getWeeklyFromToDateArr(){
		$fromDate = new DateTime();
		$fromDate->modify("+1 days");
		$toDate = new DateTime();
		$toDate->modify("+7 days");
		$fromDateStr = $fromDate->format("n-j-y");
		$toDateStr = $toDate->format("n-j-y");
		return array("fromDate"=>$fromDateStr,"toDate"=>$toDateStr);
	}
	
	public static function sendUpcomingInspectionAppointmentNotification($userType){
		$userMgr = UserMgr::getInstance();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$subject = StringConstants::UPCOMING_INSPECTION_APPOITMENT;
		$fromToDates = self::getWeeklyFromToDateArr();
		$fromDate = $fromToDates["fromDate"];
		$toDate = $fromToDates["toDate"];
		$fileName = EmailLogType::QC_UPCOMING_INSPECTION_APPOINTMENT ."_".$fromDate."_to_".$toDate;
		if($userType == UserType::SUPERVISOR){
			$finalInspectionQcAppoitment = $qcScheduleMgr->getPendingAppoitmentForFinalInspectionDate();
			$middleInspectionQcAppoitment = $qcScheduleMgr->getPendingAppoitmentForMiddleInspectionDate();
			$firstInspectionQcAppoitment = $qcScheduleMgr->getPendingAppoitmentForFirstInspectionDate();
			$pendingAppoitments[NotificationType::AP_FINAL_INPECTION_DATE] = $finalInspectionQcAppoitment;
			$pendingAppoitments[NotificationType::AP_MIDDLE_INSPECTION_DATE] = $middleInspectionQcAppoitment;
			$pendingAppoitments[NotificationType::AP_FIRST_INSPECTION_DATE] = $firstInspectionQcAppoitment;
			$html = self::getQCNotificationHtml($pendingAppoitments,$subject);
			$excelData = ExportUtil::exportQcWeeklyReport($pendingAppoitments, $subject, true);
			$attachments = array($fileName=>$excelData);
			$supervisors = $userMgr->getSupervisorsForQCReport();
			$toEmails = array();
			foreach ($supervisors as $user){
				array_push($toEmails,$user->getEmail());
			}
			if(!empty($toEmails)){
				$bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			    $Emaillog = EmailLogMgr::getInstance();
			    if($bool){
			        foreach ($supervisors as $user){
			            $Emaillog->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION_APPOINTMENT ,$user->getEmail(),null,$user->getSeq());
			        }
			    }
			  }
		}elseif($userType == UserType::QC){
			$qcUsers = $userMgr->getQCsForQCReport();
			foreach($qcUsers as $user){
				$finalInspectionQcAppoitment = $qcScheduleMgr->getPendingAppoitmentForFinalInspectionDate($user->getSeq());
				$middleInspectionQcAppoitment = $qcScheduleMgr->getPendingAppoitmentForMiddleInspectionDate($user->getSeq());
				$firstInspectionQcAppoitment = $qcScheduleMgr->getPendingAppoitmentForFirstInspectionDate($user->getSeq());
				$pendingAppoitments[NotificationType::AP_FINAL_INPECTION_DATE] = $finalInspectionQcAppoitment;
				$pendingAppoitments[NotificationType::AP_MIDDLE_INSPECTION_DATE] = $middleInspectionQcAppoitment;
				$pendingAppoitments[NotificationType::AP_FIRST_INSPECTION_DATE] = $firstInspectionQcAppoitment;
				$html = "Hello " . $user->getFullName() .", <br>";
				$html .= self::getQCNotificationHtml($pendingAppoitments,$subject);
				$excelData = ExportUtil::exportQcWeeklyReport($pendingAppoitments, $subject, true);
				$attachments = array($fileName=>$excelData);
				$email = $user->getEmail();
				$toEmails = explode(",", $email);
				if(empty($toEmails)){
					continue;
				}
				MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			}
		}
		
		
	}
	 
	public static function sendMissingAppoitmentNotification($userType){
		$userMgr = UserMgr::getInstance();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$subject = StringConstants::MISSING_INSPECTION_APPOINTMENT;	
		$fileName = EmailLogType::QC_MISSING_APPOINTMENT_NOTIFICATION;
		if($userType == UserType::SUPERVISOR){
			$finalInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForFinalInspectionDate();
			$middleInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForMiddleInspectionDate();
			$firstInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForFirstInspectionDate();
			$missingAppointments[NotificationType::AP_FINAL_INPECTION_DATE] = $finalInspectionMissingAppoitment;
			$missingAppointments[NotificationType::AP_MIDDLE_INSPECTION_DATE] = $middleInspectionMissingAppoitment;
			$missingAppointments[NotificationType::AP_FIRST_INSPECTION_DATE] = $firstInspectionMissingAppoitment;
			$html = self::getQCNotificationHtml($missingAppointments,$subject);
			$excelData = ExportUtil::exportQcWeeklyReport($missingAppointments, $subject, true);
			$attachments = array($fileName=>$excelData);
			$supervisors = $userMgr->getSupervisorsForQCReport();
			$toEmails = array();
			foreach ($supervisors as $user){
				array_push($toEmails,$user->getEmail());
			}
			if(!empty($toEmails)){
				$bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
				$Emaillog = EmailLogMgr::getInstance();
				if($bool){
				    foreach ($supervisors as $user){
				        $Emaillog->saveEmailLog(EmailLogType::QC_MISSING_APPOINTMENT_NOTIFICATION ,$user->getEmail(),null,$user->getSeq());
				    }
				}
			       
		  }
		}elseif($userType == UserType::QC){
			$qcUsers = $userMgr->getQCsForQCReport();
			foreach($qcUsers as $user){
				$finalInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForFinalInspectionDate($user->getSeq());
				$middleInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForMiddleInspectionDate($user->getSeq());
				$firstInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForFirstInspectionDate($user->getSeq());
				$missingAppointments[NotificationType::AP_FINAL_INPECTION_DATE] = $finalInspectionMissingAppoitment;
				$missingAppointments[NotificationType::AP_MIDDLE_INSPECTION_DATE] = $middleInspectionMissingAppoitment;
				$missingAppointments[NotificationType::AP_FIRST_INSPECTION_DATE] = $firstInspectionMissingAppoitment;
				$html = "Hello " . $user->getFullName() .", <br>";
				$html = self::getQCNotificationHtml($missingAppointments,$subject);
				$excelData = ExportUtil::exportQcWeeklyReport($missingAppointments, $subject, true);
				$attachments = array($fileName=>$excelData);
				$email = $user->getEmail();
				$toEmails = explode(",", $email);
				if(empty($toEmails)){
					continue;
				}
				MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			}
		}
	}
	
	public static function sendIncompletedSchedulesNotification($userType){
		$userMgr = UserMgr::getInstance();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$subject = StringConstants::INCOMPLETED_SCHEDULES;
		$fileName = EmailLogType::QC_INCOMPLETED_SCHEDULES_NOTIFICATION;
		if($userType == UserType::SUPERVISOR){
			$finalInspectionMissingDate = $qcScheduleMgr->getMissingActualFinalInspectionDate();
			$middleInspectionMissingDate = $qcScheduleMgr->getMissingActualMiddleInspectionDate();
			$firstInspectionMissingDate = $qcScheduleMgr->getMissingActualFirstInspectionDate();
			$missingActualDates[NotificationType::AC_FINAL_INPECTION_DATE] = $finalInspectionMissingDate;
			$missingActualDates[NotificationType::AC_MIDDLE_INSPECTION_DATE] = $middleInspectionMissingDate;
			$missingActualDates[NotificationType::AC_FIRST_INSPECTION_DATE] = $firstInspectionMissingDate;
			$html = self::getQCNotificationHtml($missingActualDates,$subject);
			$excelData = ExportUtil::exportQcWeeklyReport($missingActualDates, $subject, true);
			$attachments = array($fileName=>$excelData);
			$supervisors = $userMgr->getSupervisorsForQCReport();
			$toEmails = array();
			foreach ($supervisors as $user){
				array_push($toEmails,$user->getEmail());
			}
			if(!empty($toEmails)){
				$bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			    $Emaillog = EmailLogMgr::getInstance();
				if($bool){
				   foreach ($supervisors as $user){
				        $Emaillog->saveEmailLog(EmailLogType::QC_INCOMPLETED_SCHEDULES_NOTIFICATION ,$user->getEmail(),null,$user->getSeq());
				        }
				    }
			}
			
		}elseif($userType == UserType::QC){
			$qcUsers = $userMgr->getQCsForQCReport();
			foreach($qcUsers as $user){
				$finalInspectionMissingDate = $qcScheduleMgr->getMissingActualFinalInspectionDate($user->getSeq());
				$middleInspectionMissingDate = $qcScheduleMgr->getMissingActualMiddleInspectionDate($user->getSeq());
				$firstInspectionMissingDate = $qcScheduleMgr->getMissingActualFirstInspectionDate($user->getSeq());
				$missingActualDates[NotificationType::AC_FINAL_INPECTION_DATE] = $finalInspectionMissingDate;
				$missingActualDates[NotificationType::AC_MIDDLE_INSPECTION_DATE] = $middleInspectionMissingDate;
				$missingActualDates[NotificationType::AC_FIRST_INSPECTION_DATE] = $firstInspectionMissingDate;
				$html = "Hello " . $user->getFullName() .", <br>";
				$html = self::getQCNotificationHtml($missingActualDates,$subject);
				$excelData = ExportUtil::exportQcWeeklyReport($missingActualDates, $subject, true);
				$attachments = array($fileName=>$excelData);
				$email = $user->getEmail();
				$toEmails = explode(",", $email);
				if(empty($toEmails)){
					continue;
				}
				MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			}
		}
	}
	private function sendQCNotificatiosToAdmin($subject,$tableMailHtml){
		$admins = AdminMgr::getInstance()->getAllAdmins();
		foreach ($admins as $admin){
			$adminName = $admin->getName();
			$email = $admin->getEmail();
			$toEmails = explode(",", $email);
			$html = "Hello $adminName, <br>";
			$html .= $tableMailHtml;
			MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
		}
	}
	
	private static function getQCNotificationHtml($pendingSchedules,$notificationName){
		$fromDate = new DateTime();
		$fromDate->modify("+1 days");
		$toDate = new DateTime();
		$toDate->modify("+7 days");
		$tableMailHtml = "";
		$phAnValues = array();
		$tableHtml = "";
		$classCodeMgr = ClassCodeMgr::getInstance();
		foreach ($pendingSchedules as $notificationType=>$qcSchedules){
			$notificatioTitle = "";
			$phAnValues["NOTIFICATION_DATE_TITLE"] = $notificationType;
			$apNotificationTitle = str_replace("Scheduled", "Appointment", $notificationType);
			if($notificationName != StringConstants::UPCOMING_INSPECTION_SCHEDULE ){
				$notificationTitle = str_replace("Appointment", "Scheduled", $notificationType);
				$phAnValues["NOTIFICATION_DATE_TITLE"] = $notificationTitle;
			}
			if($notificationName == StringConstants::INCOMPLETED_SCHEDULES ){
				$phAnValues["NOTIFICATION_DATE_TITLE"] = "Scheduled " . $notificationTitle;
				$apNotificationTitle = "Appointment " . $notificationTitle;
			}
			$phAnValues["AP_NOTIFICATIONDATE_TITLE"] = $apNotificationTitle;
			$phAnValues["NOTIFICATION_NAME"] = $notificationType;
			$phAnValues["FROM_DATE"] = $fromDate->format("n/j/y");
			$phAnValues["TO_DATE"] = $toDate->format("n/j/y");
			$tableHtml = "<h3>{NOTIFICATION_NAME} due in next 7 days ({FROM_DATE} to {TO_DATE})</h3>";
			if($notificationName == StringConstants::MISSING_INSPECTION_APPOINTMENT){
				$tableHtml = "<h3>Missing $notificationType</h3>";
			}else if($notificationName == StringConstants::INCOMPLETED_SCHEDULES){
				$tableHtml = "<h3>Incompleted $notificationType</h3>";
			}
			$tableHtml .= file_get_contents("../emailTemplate.php");
			if(empty($qcSchedules)){
				$row = "<tr><td colspan='8'>No Rows Found<td></tr>";
			}else{
				$tableRow = file_get_contents("../tableRow.php");
				$rowTokens = array();
				$row = "";
				$srNo = 1;
				foreach ($qcSchedules as $qcSchedule){
					$row .= $tableRow;
					$rowTokens["SR_NO"] =  $srNo;
					$rowTokens["QC_CODE"] =  $qcSchedule->qccode;
					$rowTokens["CLASS_CODE"] =  $qcSchedule->classcode;
					$rowTokens["PO_NO"] =  $qcSchedule->getPO();
					$rowTokens["PO_TYPE"] =  $qcSchedule->getPOType();
					$itemNumbers = $qcSchedule->getItemNumbers();
					$itemNumbers = str_replace("\n", "<br>", $itemNumbers);
					$rowTokens["ITEM_NUMBERS"] =  $itemNumbers;
					$shippingDate = $qcSchedule->getShipDate();
					$shippingDate = DateUtil::StringToDateByGivenFormat('Y-m-d', $shippingDate);
					$rowTokens["SHIP_DATE"] =  $shippingDate->format("n/j/y");
					$notificationDates = self::getScheduleNotificationDate($qcSchedule, $notificationType);
					$rowTokens["NOTIFICATION_DATE"] = $notificationDates["scdate"];
					$rowTokens["AP_NOTIFICATIONDATE"] = $notificationDates["apdate"];
					$row = self::replacePlaceHolders($rowTokens, $row);
					$srNo++;
				}
			}
			$phAnValues["TABLE_ROWS"] = $row;
			$tableMailHtml .= self::replacePlaceHolders($phAnValues, $tableHtml);
			$tableMailHtml .= "<br>";
		}
		return $tableMailHtml;
	}
	
	public static function getScheduleNotificationDate($qcSchedule,$notificationType){
		$dates = array();
		$sc_date = "";
		$ap_date = "";
		if($notificationType == NotificationType::SC_READY_DATE || $notificationType == NotificationType::AP_READY_DATE){
			$sc_date = $qcSchedule->getSCReadyDate();
			$ap_date = $qcSchedule->getAPReadyDate();
		}else if($notificationType == NotificationType::SC_FINAL_INPECTION_DATE ||
				$notificationType == NotificationType::AP_FINAL_INPECTION_DATE ||
				$notificationType == NotificationType::AC_FINAL_INPECTION_DATE) {
					$sc_date = $qcSchedule->getSCFinalInspectionDate();
					$ap_date = $qcSchedule->getAPFinalInspectionDate();
						
				}else if($notificationType == NotificationType::SC_FIRST_INSPECTION_DATE ||
						$notificationType == NotificationType::AP_FIRST_INSPECTION_DATE ||
						$notificationType == NotificationType::AC_FIRST_INSPECTION_DATE){
							$sc_date = $qcSchedule->getSCFirstInspectionDate();
							$ap_date = $qcSchedule->getAPFirstInspectionDate();
								
				}else if($notificationType == NotificationType::SC_MIDDLE_INSPECTION_DATE ||
						$notificationType == NotificationType::AP_MIDDLE_INSPECTION_DATE ||
						$notificationType == NotificationType::AC_MIDDLE_INSPECTION_DATE){
							$sc_date = $qcSchedule->getSCMiddleInspectionDate();
							$ap_date = $qcSchedule->getAPMiddleInspectionDate();
								
				}else if($notificationType == NotificationType::SC_PRODUCTION_START_DATE ||
						$notificationType == NotificationType::AP_PRODUCTION_START_DATE ||
						$notificationType == NotificationType::AC_PRODUCTION_START_DATE){
							$sc_date = $qcSchedule->getSCProductionStartDate();
							$ap_date = $qcSchedule->getAPProductionStartDate();
								
				}else if($notificationType == NotificationType::SC_GRAPHIC_RECEIVE_DATE ||
						$notificationType == NotificationType::AP_GRAPHIC_RECEIVE_DATE||
						$notificationType == NotificationType::AP_GRAPHIC_RECEIVE_DATE){
							$sc_date = $qcSchedule->getSCGraphicsReceiveDate();
							$ap_date = $qcSchedule->getAPGraphicsReceiveDate();
				}
				if(!empty($sc_date)){
					$sc_date = DateUtil::StringToDateByGivenFormat('Y-m-d', $sc_date);
					$sc_date =  $sc_date->format("n/j/y");
				}else{
					$sc_date = "";
				}
				if(!empty($ap_date)){
					$ap_date = DateUtil::StringToDateByGivenFormat('Y-m-d', $ap_date);
					$ap_date =  $ap_date->format("n/j/y");
				}else{
					$ap_date = "";
				}
				$dates["scdate"] = $sc_date;
				$dates["apdate"] = $ap_date;
				return $dates;
	}
	
	private static function replacePlaceHolders($placeHolders,$body){
		foreach ($placeHolders as $key=>$value){
			$placeHolder = "{".$key."}";
			$body = str_replace($placeHolder, $value, $body);
		}
		return $body;
	}
	
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
		$html = self::replacePlaceHolders($phAnValues, $content);
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getUsersForGraphicNotesUpdatedReport($roleName);
		$toEmails = array();
		$phAnValues = array();
		foreach ($users as $user){
			$phAnValues["FULL_NAME"] = $user->getFullName();
			$html = self::replacePlaceHolders($phAnValues, $html);
			array_push($toEmails,$user->getEmail());
		}
		if(!empty($toEmails)){
			$subject = $noteType . " Notes Updated For Graphic Logs on Alpinebi";
			MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
		}	
	}
	
	public static function sendQCApprovalNotification($qcSchedule){
		$itemNo = $qcSchedule->getItemNumbers();
		$po = $qcSchedule->getPO();
		$date = new DateTime();
		$dateStr = $date->format("n/j/Y h:i a");
		$qcUser = $qcSchedule->getQCUser();
		$userMgr = UserMgr::getInstance();
		$qcuser = $userMgr->findBySeq($qcUser);
		$qcName = $qcuser->getFullName();
		$phAnValues = array();
		$phAnValues["QC_NAME"] = $qcName;
		$phAnValues["ITEM_ID"] = $itemNo;
		$phAnValues["PO_NUMBER"] = $po;
		$phAnValues["DATE_STR"] = $dateStr;
		$phAnValues["WEB_PORTAL_LINK"] = StringConstants::WEB_PORTAL_LINK;
		$content = file_get_contents("../QCApprovalEmailTemplate.php");
		$html = self::replacePlaceHolders($phAnValues, $content);
		$supervisors = $userMgr->getSupervisorsForQCReport();
		$toEmails = array();
		$phAnValues = array();
		foreach ($supervisors as $user){
			array_push($toEmails,$user->getEmail());
		}
		if(!empty($toEmails)){
			$subject = "Approval Request on Alpinebi";
			MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
		}	
	}
	
	
	
	public static function sendPendingQCApprovalNotification(){
		$userMgr = UserMgr::getInstance();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$pendingQcSchedules = $qcScheduleMgr->getPendingQcForApprovals();
		$tableHtml = file_get_contents("../QCApprovalStatusEmailTemplate.php");
		if(empty($pendingQcSchedules)){
			$row = "<tr><td colspan='8'>No Rows Found<td></tr>";
		}
		$srNo = 1;
		foreach ($pendingQcSchedules as $qcSchedule){
			$tableRow = file_get_contents("../QCApprovalStatusTableRow.php");
			$rowTokens = array();
			$row .= $tableRow;
			$rowTokens["SR_NO"] =  $srNo;
			$rowTokens["QC_CODE"] =  $qcSchedule->getQC();
			$rowTokens["CLASS_CODE"] =  $qcSchedule->classcode;
			$rowTokens["PO_NO"] =  $qcSchedule->getPO();
			$rowTokens["PO_TYPE"] =  $qcSchedule->getPOType();
			$itemNumbers = $qcSchedule->getItemNumbers();
			$itemNumbers = str_replace("\n", "<br>", $itemNumbers);
			$rowTokens["ITEM_NUMBERS"] =  $itemNumbers;
			$appliedOn = $qcSchedule->appliedon;
			$appliedOnDate = DateUtil::StringToDateByGivenFormat('Y-m-d H:i:s', $appliedOn);
			$rowTokens["APPLIED_ON"] =  $appliedOnDate->format("n/j/y");
			$finalInspection = $qcSchedule->getACFinalInspectionDate();
			$finalInspectionDate = DateUtil::StringToDateByGivenFormat('Y-m-d', $finalInspection);
			$rowTokens["FINAL_INSPECTION_DATE"] =  $finalInspectionDate->format("n/j/y");
			$rowTokens["APPROVAL_STATUS"] = $qcSchedule->responsetype;
			$row = self::replacePlaceHolders($rowTokens, $row);
			$srNo++;
		}   
		$phAnValues["TABLE_ROWS"] = $row;
		$tableMailHtml .= self::replacePlaceHolders($phAnValues, $tableHtml);
		$excelData = ExportUtil::exportQcPendingForApprovals($pendingQcSchedules, StringConstants::PENDING_QC_APPROVALS, true);
		$attachments = array("QCPendingApprovals"=>$excelData);
		$supervisors = $userMgr->getSupervisorsForQCReport();
		$toEmails = array();
		foreach ($supervisors as $user){
			array_push($toEmails,$user->getEmail());
		}
		if(!empty($toEmails)){
			$subject = StringConstants::PENDING_QC_APPROVALS;
			MailUtil::sendSmtpMail($subject, $tableMailHtml, $toEmails,true, $attachments);
		}
	}
	
	
	public static function sendQCPlannerNotification($dataArr,$isSendEmail){
	    $attachment = ExportUtil::exportQcPlannerReport($dataArr, $isSendEmail);
	    $attachments = array(StringConstants::QC_PLANNER=>$attachment);
	    if($isSendEmail){
    	    $userMgr = UserMgr::getInstance();
    	    $users = $userMgr->getUsersForSendQcPlannerReport();
    	    $admin = $userMgr->getAdminForSendReport();
    	    $toEmails = array();
    	    if(!empty($users)){
        	    foreach ($users as $user){
        	        array_push($toEmails,$user->getEmail());
        	    }
    	    }
    	    if(!empty($admin)){
    	        //array_push($toEmails,$admin->getEmail());
    	    }
    	    $html = "<p>Qc Plannner file attached with this mail.";
    	    if(!empty($toEmails)){
    	        $subject = StringConstants::QC_PLANNER;
    	        MailUtil::sendSmtpMail($subject, $html, $toEmails,true, $attachments);
    	    }
	    }
	}
	
}