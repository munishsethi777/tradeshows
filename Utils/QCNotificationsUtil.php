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
require_once($ConstantsArray['dbServerUrl'] ."Enums/QCScheduleNotificationType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/EmailLogType.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PHPExcelUtils.php");


class QCNotificationsUtil{
    
	//not in use
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
			    $EmaillogMgr = EmailLogMgr::getInstance();
				if($bool){
				    foreach ($supervisors as $user){
				        $EmaillogMgr->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION_SCHEDULE,$user->getEmail(),null,$user->getSeq());
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
				if(!empty($toEmails)){
				   $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
				   $EmaillogMgr = EmailLogMgr::getInstance();
				   if($bool){
				           $EmaillogMgr->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION_SCHEDULE,$email,null,$user->getSeq());
				       
				   }
				}
				
			}
		}
		
	}
	
	private static function getQCUsersByNotificationType($users,$notificationType){
	    if(isset($users[QCScheduleNotificationType::getName($notificationType)])){
	        return $users[QCScheduleNotificationType::getName($notificationType)];
	    }else{
	        return null;
	    }
	}
	public static function sendUpcomingInspectionNotification($userType,$users){
	    $qcScheduleMgr = QCScheduleMgr::getInstance();
	    $subject = StringConstants::UPCOMING_INSPECTIONS;
	    $fromToDates = self::getWeeklyFromToDateArr();
	    $fromDate = $fromToDates["fromDate"];
	    $toDate = $fromToDates["toDate"];
	    $fileName = EmailLogType::QC_UPCOMING_INSPECTION ."_".$fromDate."_to_".$toDate;
	    $finalInspectionQcSchedules = array();
	    $middleInspectionQcSchedules = array();
	    $firstInspectionQcSchedules = array();
	    if($userType == UserType::SUPERVISOR){
	        $supervisors = self::getQCUsersByNotificationType($users, 
	            QCScheduleNotificationType::upcoming_inspections_report_weekly);
	        if(empty($supervisors)){
	            return;
	        }
	        $finalInspectionQcSchedules = $qcScheduleMgr->getPendingForFinalInspectionDate();
	        $middleInspectionQcSchedules = $qcScheduleMgr->getPendingForMiddleInspectionDate();
	        $firstInspectionQcSchedules = $qcScheduleMgr->getPendingForFirstInspectionDate();
	        $pendingSchedules[NotificationType::SC_FINAL_INPECTION_DATE] = $finalInspectionQcSchedules;
	        $pendingSchedules[NotificationType::SC_MIDDLE_INSPECTION_DATE] = $middleInspectionQcSchedules;
	        $pendingSchedules[NotificationType::SC_FIRST_INSPECTION_DATE] = $firstInspectionQcSchedules;
	        $html = self::getQCNotificationHtml($pendingSchedules,$subject);
	        $excelData = ExportUtil::exportQcWeeklyReport($pendingSchedules, $subject, true);
	        $attachments = array($fileName=>$excelData);
	        //$supervisors = $userMgr->getSupervisorsForQCReport();
	        $toEmails = array();
	        foreach ($supervisors as $user){
	            array_push($toEmails,$user->getEmail());
	        }
	        if(!empty($toEmails)){
	            $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
	            $EmaillogMgr = EmailLogMgr::getInstance();
	            if($bool){
	                foreach ($supervisors as $user){
	                    $EmaillogMgr->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION,$user->getEmail(),null,$user->getSeq());
	                }
	                
	            }
	            
	        }
	    }elseif($userType == UserType::QC){
	       // $qcUsers = $userMgr->getQCsForQCReport();
	        $qcUsers = self::getQCUsersByNotificationType($users,
	            QCScheduleNotificationType::upcoming_inspections_report_weekly);
	        if(empty($qcUsers)){
	            return;
	        }
	         foreach($qcUsers as $user){
	            $finalInspectionQcSchedules = $qcScheduleMgr->getPendingForFinalInspectionDate($user->getSeq());
	            $middleInspectionQcSchedules = $qcScheduleMgr->getPendingForMiddleInspectionDate($user->getSeq());
	            $firstInspectionQcSchedules = $qcScheduleMgr->getPendingForFirstInspectionDate($user->getSeq());
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
	            if(!empty($toEmails)){
	                $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
	                $EmaillogMgr = EmailLogMgr::getInstance();
	                if($bool){
	                    $EmaillogMgr->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION,$email,null,$user->getSeq());
	                    
	                }
	            }
	            
	        }
	    }
	    
	}
	
	private static function getWeeklyFromToDateArr(){
		$fromDate = new DateTime();
		$fromDate->modify("+1 days");
		$toDate = new DateTime();
		$toDate->modify("+14 days");
		$fromDateStr = $fromDate->format("n-j-y");
		$toDateStr = $toDate->format("n-j-y");
		return array("fromDate"=>$fromDateStr,"toDate"=>$toDateStr);
	}
	//not in use
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
			    $EmaillogMgr = EmailLogMgr::getInstance();
			    if($bool){
			        foreach ($supervisors as $user){
			            $EmaillogMgr->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION_APPOINTMENT ,$user->getEmail(),null,$user->getSeq());
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
				if(!empty($toEmails)){
				    $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
				    $EmaillogMgr = EmailLogMgr::getInstance();
				    if($bool){
				        $EmaillogMgr->saveEmailLog(EmailLogType::QC_UPCOMING_INSPECTION_APPOINTMENT,$email,null,$user->getSeq());
				        
				    }
				}
				
			}
		}
		
		
	}
	 
	public static function sendMissingAppoitmentNotification($userType,$users){
		$userMgr = UserMgr::getInstance();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$subject = StringConstants::MISSING_INSPECTION_APPOINTMENT;	
		$fileName = EmailLogType::QC_MISSING_APPOINTMENT_NOTIFICATION;
		if($userType == UserType::SUPERVISOR){    
		    $supervisors = self::getQCUsersByNotificationType($users,
		        QCScheduleNotificationType::missing_appointments_report_weekly);
		    if(empty($supervisors)){
		        return;
		    }
			$finalInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForFinalInspectionDate();
			$middleInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForMiddleInspectionDate();
			$firstInspectionMissingAppoitment = $qcScheduleMgr->getMissingAppoitmentForFirstInspectionDate();
			$missingAppointments[NotificationType::AP_FINAL_INPECTION_DATE] = $finalInspectionMissingAppoitment;
			$missingAppointments[NotificationType::AP_MIDDLE_INSPECTION_DATE] = $middleInspectionMissingAppoitment;
			$missingAppointments[NotificationType::AP_FIRST_INSPECTION_DATE] = $firstInspectionMissingAppoitment;
			$html = self::getQCNotificationHtml($missingAppointments,$subject);
			$excelData = ExportUtil::exportQcWeeklyReport($missingAppointments, $subject, true);
			$attachments = array($fileName=>$excelData);
			//$supervisors = $userMgr->getSupervisorsForQCReport();
			$toEmails = array();
			foreach ($supervisors as $user){
				array_push($toEmails,$user->getEmail());
			}
			if(!empty($toEmails)){
				$bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
				$EmaillogMgr = EmailLogMgr::getInstance();
				if($bool){
				    foreach ($supervisors as $user){
				        $EmaillogMgr->saveEmailLog(EmailLogType::QC_MISSING_APPOINTMENT_NOTIFICATION ,$user->getEmail(),null,$user->getSeq());
				    }
				}
			       
		  }
		}else if($userType == UserType::QC){
			//$qcUsers = $userMgr->getQCsForQCReport();
		    $qcUsers = self::getQCUsersByNotificationType($users,
		        QCScheduleNotificationType::missing_appointments_report_weekly);
		    if(empty($qcUsers)){
		        return;
		    }
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
				if(!empty($toEmails)){
				    $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
				    $EmaillogMgr = EmailLogMgr::getInstance();
				    if($bool){
				        $EmaillogMgr->saveEmailLog(EmailLogType::QC_MISSING_APPOINTMENT_NOTIFICATION,$email,null,$user->getSeq());
				        
				    }
				}
				
			}
		}
	}
	
	//Late Schedule
	public static function sendIncompletedSchedulesNotification($userType,$users){
		$userMgr = UserMgr::getInstance();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$subject = StringConstants::INCOMPLETED_SCHEDULES;
		$fileName = EmailLogType::QC_INCOMPLETED_SCHEDULES_NOTIFICATION;
		if($userType == UserType::SUPERVISOR){
		    $supervisors = self::getQCUsersByNotificationType($users,
		        QCScheduleNotificationType::incompleted_schedules_report_weekly);
		    if(empty($supervisors)){
		        return;
		    }
			$finalInspectionMissingDate = $qcScheduleMgr->getMissingActualFinalInspectionDate();
			$middleInspectionMissingDate = $qcScheduleMgr->getMissingActualMiddleInspectionDate();
			$firstInspectionMissingDate = $qcScheduleMgr->getMissingActualFirstInspectionDate();
			$missingActualDates[NotificationType::AC_FINAL_INPECTION_DATE] = $finalInspectionMissingDate;
			$missingActualDates[NotificationType::AC_MIDDLE_INSPECTION_DATE] = $middleInspectionMissingDate;
			$missingActualDates[NotificationType::AC_FIRST_INSPECTION_DATE] = $firstInspectionMissingDate;
			$html = self::getQCNotificationHtml($missingActualDates,$subject);
			$excelData = ExportUtil::exportQcWeeklyReport($missingActualDates, $subject, true);
			$attachments = array($fileName=>$excelData);
			//$supervisors = $userMgr->getSupervisorsForQCReport();
			$toEmails = array();
			foreach ($supervisors as $user){
				array_push($toEmails,$user->getEmail());
			}
			if(!empty($toEmails)){
				$bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			    $EmaillogMgr = EmailLogMgr::getInstance();
				if($bool){
				   foreach ($supervisors as $user){
				        $EmaillogMgr->saveEmailLog(EmailLogType::QC_INCOMPLETED_SCHEDULES_NOTIFICATION ,$user->getEmail(),null,$user->getSeq());
				        }
				    }
			}
		}elseif($userType == UserType::QC){
			//$qcUsers = $userMgr->getQCsForQCReport();
		    $qcUsers = self::getQCUsersByNotificationType($users,
		        QCScheduleNotificationType::incompleted_schedules_report_weekly);
		    if(empty($qcUsers)){
		        return;
		    }
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
				if(!empty($toEmails)){
				    $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
				    $EmaillogMgr = EmailLogMgr::getInstance();
				    if($bool){
				        $EmaillogMgr->saveEmailLog(EmailLogType::QC_INCOMPLETED_SCHEDULES_NOTIFICATION,$email,null,$user->getSeq());
				        
				    }
				}
				
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
		$toDate->modify("+14 days");
		$tableMailHtml = "";
		$phAnValues = array();
		$tableHtml = "";
		foreach ($pendingSchedules as $notificationType=>$qcSchedules){
			$phAnValues["NOTIFICATION_DATE_TITLE"] = $notificationType;
			$apNotificationTitle = str_replace("Scheduled", "Appointment", $notificationType);
			$notificationTypeTitle = $notificationType;
			if($notificationName != StringConstants::UPCOMING_INSPECTIONS ){
				$notificationTitle = str_replace("Appointment", "Scheduled", $notificationType);
				$phAnValues["NOTIFICATION_DATE_TITLE"] = $notificationTitle;
			}else{
			    $notificationTypeTitle = str_replace("Scheduled", "", $notificationTypeTitle);
			}
			if($notificationName == StringConstants::INCOMPLETED_SCHEDULES ){
				$phAnValues["NOTIFICATION_DATE_TITLE"] = "Scheduled " . $notificationTitle;
				$apNotificationTitle = "Appointment " . $notificationTitle;
			}
			$phAnValues["AP_NOTIFICATIONDATE_TITLE"] = $apNotificationTitle;
			$phAnValues["NOTIFICATION_NAME"] = $notificationTypeTitle;
			$phAnValues["FROM_DATE"] = $fromDate->format("n/j/y");
			$phAnValues["TO_DATE"] = $toDate->format("n/j/y");
			$tableHtml = "<h3>{NOTIFICATION_NAME} due in next 14 days ({FROM_DATE} to {TO_DATE})</h3>";
			if($notificationName == StringConstants::MISSING_INSPECTION_APPOINTMENT){
				$tableHtml = "<h3>Missing $notificationType</h3>";
			}else if($notificationName == StringConstants::INCOMPLETED_SCHEDULES){
				$tableHtml = "<h3>Late $notificationType PO Report</h3>";
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
					//$rowTokens["PO_INCHARGE"] =  $qcSchedule->poqccode;
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
		$html = MailUtil::appendToEmailTemplateContainer($tableMailHtml);
		return $html;
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
	
	
	//NOT IN USE
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
	
	public static function sendQCApprovedRejectNotification($approvalSeq,$comments,$superVisorName){
	    $userMgr = UserMgr::getInstance();
	    $users = $userMgr->getAllUsersWithRoles();
	    $users = self::getQCUsersByNotificationType($users, 
	        QCScheduleNotificationType::qc_approved_rejected_instant);
	    if(empty($users)){
	        return;
	    }
	    $qcScheduleMgr = QCScheduleMgr::getInstance();
	    $qcSchedule = $qcScheduleMgr->findByApprovalSeq($approvalSeq);
	    $itemNo = $qcSchedule["itemnumbers"];
	    $po = $qcSchedule["po"];
	    $qcEmail = $qcSchedule["email"];
	    $isSendNotification = $qcSchedule["issendnotifications"];
	    $phAnValues = array();
	    $phAnValues["ITEM_NUMBER"] = $itemNo;
	    $phAnValues["PO_NUMBER"] = $po;
	    $phAnValues["APPROVED_REJECT_STATUS"] = $qcSchedule["responsetype"];
	    $phAnValues["SUPERVISOR_NAME"] = $superVisorName;
	    $phAnValues["RESPONSE_COMMENTS"] = $comments;
	    $content = file_get_contents("../QCApprovedRjectEmailTemplate.php");
	    $content = self::replacePlaceHolders($phAnValues, $content);
	    $html = MailUtil::appendToEmailTemplateContainer($content);
	    //$rolName = Permissions::getName(Permissions::approved_reject_notification);
	    //$users = $userMgr->getUserssByRoleAndDepartment($rolName, 1);
	    $toEmails = array();
	    $phAnValues = array();
	    foreach ($users as $user){
	        array_push($toEmails,$user->getEmail());
	    }
	    if(!empty($isSendNotification)){
	        array_push($toEmails,$qcEmail);
	    }
	    if(!empty($toEmails)){
	        $subject = StringConstants::APPROVAL_RESPONSE_NOTIFICATION;
	        $flag = MailUtil::sendSmtpMail($subject, $html, $toEmails, true);
	        if($flag){
	            $emaillogMgr = EmailLogMgr::getInstance();
	            foreach ($users as $user){
	                $emaillogMgr->saveEmailLog(EmailLogType::QC_APPROVED_REJECT_NOTIFICATION ,$user->getEmail(), null,$user->getSeq());
	            }
	        }
	        
	    }
	    $qcScheduleMgr->updateLastModifiedOn($qcSchedule["seq"]);
	}
	
	
	
	public static function sendPendingQCApprovalNotification($supervisors){
		$supervisors = self::getQCUsersByNotificationType($supervisors,
		    QCScheduleNotificationType::pending_qc_approval_report_weekly);
		if(empty($supervisors)){
		    return;
		}
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$pendingQcSchedules = $qcScheduleMgr->getPendingQcForApprovals();
		$tableHtml = file_get_contents("../QCApprovalStatusEmailTemplate.php");
		$row = "";
		if(empty($pendingQcSchedules)){
			$row = "<tr><td colspan='8'>No Rows Found<td></tr>";
		}
		$srNo = 1;
		$tableMailHtml = "";
		foreach ($pendingQcSchedules as $qcSchedule){
			$tableRow = file_get_contents("../QCApprovalStatusTableRow.php");
			$rowTokens = array();
			$row .= $tableRow;
			$rowTokens["SR_NO"] =  $srNo;
			$rowTokens["QC_CODE"] =  $qcSchedule->qccode;
			//$rowTokens["PO_INCHARGE"] = $qcSchedule->poqccode;
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
			if(!empty($finalInspection)){
    			$finalInspectionDate = DateUtil::StringToDateByGivenFormat('Y-m-d', $finalInspection);
    			$finalInspection = $finalInspectionDate->format("n/j/y");
			}
			$rowTokens["FINAL_INSPECTION_DATE"] =  $finalInspection;
			$rowTokens["APPROVAL_STATUS"] = $qcSchedule->responsetype;
			$row = self::replacePlaceHolders($rowTokens, $row);
			$srNo++;
		}   
		$phAnValues = array();
		$phAnValues["TABLE_ROWS"] = $row;
		$content = self::replacePlaceHolders($phAnValues, $tableHtml);
		$tableMailHtml = MailUtil::appendToEmailTemplateContainer($content);
		
		$excelData = ExportUtil::exportQcPendingForApprovals($pendingQcSchedules, StringConstants::PENDING_QC_APPROVALS, true);
		$attachments = array("QCPendingApprovals"=>$excelData);
		
		$toEmails = array();
		$EmaillogMgr = EmailLogMgr::getInstance();
		$subject = StringConstants::PENDING_QC_APPROVALS;
		foreach ($supervisors as $user){
			array_push($toEmails,$user->getEmail());
		}
		if(!empty($toEmails)){			   
		   $bool =  MailUtil::sendSmtpMail($subject, $tableMailHtml, $toEmails,true, $attachments);		    	
    	   if($bool){
    		   foreach ($supervisors as $user){
    		     $EmaillogMgr->saveEmailLog(EmailLogType::PENDING_QC_APPROVAL , $user->getEmail(), null, $user->getSeq());
    		   }
    	   }
		}
	}
		
	public static function sendQCPlannerNotification($dataArr,$isSendEmail,$users){
	    $attachment = ExportUtil::exportQcPlannerReport($dataArr, $isSendEmail);
	    $attachments = array(StringConstants::QC_PLANNER=>$attachment);
	    if($isSendEmail){
    	    $userMgr = UserMgr::getInstance();
    	    //$users = $userMgr->getUsersForSendQcPlannerReport();
    	    $users = self::getQCUsersByNotificationType($users, 
    	        QCScheduleNotificationType::qc_planner_report_weekly);
    	    if(empty($users)){
    	        return ;
    	    }
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
    	    $html = MailUtil::appendToEmailTemplateContainer($html);
    	    $EmaillogMgr = EmailLogMgr::getInstance();    	   
    	    if(!empty($toEmails)){
    	     $subject = StringConstants::QC_PLANNER;
    	     $bool = MailUtil::sendSmtpMail($subject, $html, $toEmails,true, $attachments);
    	     if($bool){
    	        foreach ($users as $user){
    	            $EmaillogMgr->saveEmailLog(EmailLogType::QC_SCHEDULE_FOR_PLAN_REPORT ,$user->getEmail(), null,$user->getSeq());
    	        }   	         
    	     }
    	   }    	      	    
	    }
	}
	
	public static function sendQCBulkUpdateNotification($qcSchedules, $qcScheduleNewArr){
		$sessionUtil = SessionUtil::getInstance();
		$excelData = PHPExcelUtil::exportQCSchedulesBulkUpdate($qcSchedules, $qcScheduleNewArr,1);
		$attachments = array("BulkUpdateSchedules.xls"=>$excelData);
		$subject = "Bulk Update Schedules | ". $sessionUtil->getUserLoggedInName();
		$html = "Bulk Update Schedules";
		
		$userMgr = UserMgr::getInstance();
		$allUsers = $userMgr->getAllUsersWithRoles();
		$usersEmails = self::getQCUsersByNotificationType($allUsers,QCScheduleNotificationType::qc_bulk_update_log);
		$toEmails = array();
		foreach ($usersEmails as $user){
			array_push($toEmails,$user->getEmail());
		}
		if(!empty($toEmails)){
			$bool = MailUtil::sendSmtpMail($subject, $html, $toEmails, true,$attachments);
			$EmaillogMgr = EmailLogMgr::getInstance();
			if($bool){
				foreach ($usersEmails as $user){
					$EmaillogMgr->saveEmailLog(EmailLogType::QC_BULK_UPDATE_NOTIFICATION ,$user->getEmail(),null,$user->getSeq());
				}
			}
		}
	}
}
