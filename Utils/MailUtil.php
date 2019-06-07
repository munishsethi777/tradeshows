<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/class.phpmailer.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/NotificationType.php");
class MailUtil{
	
	public static function sendTaskAssignedNotification($showSeq){
		$showTaskMgr = ShowTaskMgr::getInstance();
		$showData = $showTaskMgr->getShowTaskWithAssignee($showSeq);
		foreach ($showData as $key=>$showTasks){
			$i = 1;
			$userName = $showTasks[0]["fullname"];
			$userEmail = $showTasks[0]["email"];
			$html = "<html>";
			$html .= "<p>Hello $userName,<p><br><p>You have assigned following tasks :- <br>";
			$html .= "<table style='width:90%' cellpadding='0' cellspacing='0'>";
			$html .= "<tr><th width='10%' style='text-align:left'>Sr.No.</th><th style='text-align:left' width=\"50%\">Task</th><th style='text-align:left' width=\"20%\">StartsOn</th><th style='text-align:left' width=\"20%\">EndsOn</th></tr>";
			foreach ($showTasks as $task){
				$title = $task["title"];
				$startDate = $task["startDate"];
				$endDate = $task["endDate"];
				$html .= "<tr>";
				$html .= "<td width='10%'>$i</td>";
				$html .= "<td width='50%'>$title</td>";
				$html .= "<td width='20%'>$startDate</td>";
				$html .= "<td width='20%'>$endDate</td>";
				$html .= "</tr>";
				$i++;
			}
		$html .= "</table>";
		$html .="</html>";
		$toEmails = array(0=>$userEmail);
		MailUtil::sendSmtpMail("Tasks Assigned", $html, $toEmails, true);
		}
	}
	
	public static function sendUpdateStatusNotification($showTaskSeq){
		$sessionUtil = SessionUtil::getInstance();
		$userName = $sessionUtil->getUserLoggedInName();
		$admins = AdminMgr::getInstance()->getAllAdmins();
		$showTaskMgr = ShowTaskMgr::getInstance();
		$showTaskDetail = $showTaskMgr->getShowTaskDetails($showTaskSeq);
		if(!empty($showTaskDetail)){
			$showTaskDetail = $showTaskDetail[0];
			foreach ($admins as $admin){
				$adminName = $admin->getName();
				$email = $admin->getEmail();
				$toEmails = explode(",", $email);
				$html = "Hello $adminName, <br>";
				$html .= "<p>User $userName has updated status as " . $showTaskDetail["status"] . " for task - '". $showTaskDetail["title"] . "' for trade show  - '" . $showTaskDetail["showtitle"] ."'</p><br>";
				$html .= "<p>Comments - ".$showTaskDetail['comments']."</p>";
				MailUtil::sendSmtpMail("Updated Task Status", $html, $toEmails, true);
			}
		}
	}
	
	public static function sendPendingSchedulesNotification($notificationType){
		$admins = AdminMgr::getInstance()->getAllAdmins();
		$qcScheduleMgr = QCScheduleMgr::getInstance();
		$qcSchedules = $qcScheduleMgr->getPendindSchedules($notificationType);
		$fromDate = new DateTime();
		$fromDate->modify("+1 days");
		$toDate = new DateTime();
		$toDate->modify("+7 days");
		if(!empty($qcSchedules)){
			$tableHtml = file_get_contents("../emailTemplate.php"); 
			$tableRow = file_get_contents("../tableRow.php"); 
			$notificatioTitle = "";
			$phAnValues["NOTIFICATION_DATE_TITLE"] = $notificationType;
			$apNotificationTitle = str_replace("Scheduled", "Appointment", $notificationType);
			$phAnValues["AP_NOTIFICATIONDATE_TITLE"] = $apNotificationTitle;
			$phAnValues["NOTIFICATION_NAME"] = $notificationType;
			$phAnValues["FROM_DATE"] = $fromDate->format("n/j/y");
			$phAnValues["TO_DATE"] = $toDate->format("n/j/y");
			$rowTokens = array();
			$row = "";
			$srNo = 1;
			foreach ($qcSchedules as $qcSchedule){
				$row .= $tableRow;
				$rowTokens["SR_NO"] =  $srNo;
				$rowTokens["QC_CODE"] =  $qcSchedule->getQC();
				$rowTokens["CLASS_CODE"] =  $qcSchedule->getClassCode();
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
			$phAnValues["TABLE_ROWS"] = $row;
			$tableHtml = self::replacePlaceHolders($phAnValues, $tableHtml);
			foreach ($admins as $admin){
				$adminName = $admin->getName();
				$email = $admin->getEmail();
				$toEmails = explode(",", $email);
			    $html = "Hello $adminName, <br>";
				$html .= $tableHtml;
				MailUtil::sendSmtpMail($notificationType . " Due in next 7 days", $html, $toEmails, true);
			}
		}
	}
	
	private static function getScheduleNotificationDate($qcSchedule,$notificationType){
		$dates = array();
		if($notificationType == NotificationType::SC_READY_DATE){
			$sc_date = $qcSchedule->getSCReadyDate();
			$ap_date = $qcSchedule->getAPReadyDate();
			
		}else if($notificationType == NotificationType::SC_FINAL_INPECTION_DATE){
			$sc_date = $qcSchedule->getSCFinalInspectionDate();
			$ap_date = $qcSchedule->getAPFinalInspectionDate();
			
		}else if($notificationType == NotificationType::SC_FIRST_INSPECTION_DATE){
			$sc_date = $qcSchedule->getSCFirstInspectionDate();
			$ap_date = $qcSchedule->getAPFirstInspectionDate();
			
		}else if($notificationType == NotificationType::SC_MIDDLE_INSPECTION_DATE){
			$sc_date = $qcSchedule->getSCMiddleInspectionDate();
			$ap_date = $qcSchedule->getAPMiddleInspectionDate();
			
		}else if($notificationType == NotificationType::SC_PRODUCTION_START_DATE){
			$sc_date = $qcSchedule->getSCProductionStartDate();
			$ap_date = $qcSchedule->getAPProductionStartDate();
			
		}else if($notificationType == NotificationType::SC_GRAPHIC_RECEIVE_DATE){
			$sc_date = $qcSchedule->getSCGraphicsReceiveDate();
			$ap_date = $qcSchedule->getAPGraphicsReceiveDate();
		}
		if(!empty($sc_date)){
			$sc_date = DateUtil::StringToDateByGivenFormat('Y-m-d', $sc_date);
			$sc_date =  $sc_date->format("n/j/y");
		}else{
			$sc_date = "n.a";
		}
		if(!empty($ap_date)){
			$ap_date = DateUtil::StringToDateByGivenFormat('Y-m-d', $ap_date);
			$ap_date =  $ap_date->format("n/j/y");
		}else{
			$ap_date = "n.a";
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
	public static function sendSmtpMail($subject,$body,$toEmails,$isSmtp,$attachments = array()){
			$mail = new PHPMailer();
			if($isSmtp){
				$configurationMgr = ConfigurationMgr::getInstance();
				$smtpUsername = $configurationMgr->getConfiguration(Configuration::$SMTP_USERNAME);
				$smtpPassword = $configurationMgr->getConfiguration(Configuration::$SMTP_PASSWORD);
				$smtpHost = $configurationMgr->getConfiguration(Configuration::$SMTP_HOST);
				$mail->IsSMTP(); // telling the class to use SMTP
				//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = $smtpHost;      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = $smtpUsername;  // GMAIL username
				$mail->Password   = $smtpPassword;          // GMAIL password
			}
			$mail->IsHTML(true);
			$mail->SetFrom('noreply@satyainfopages.in', 'Alpine');
			$mail->Subject = $subject;
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->MsgHTML($body);
			foreach ($toEmails as $toEmail){
				$mail->AddAddress($toEmail);
			}
			$mail->AddBCC("baljeetgaheer@gmail.com");
			foreach($attachments as $name=>$attachment){
				$name .= ".pdf";
				$mail->addStringAttachment($attachment, $name);
			}
			if(!$mail->Send()) {
				return false;
			} else {
				return true;
			}
		}	
	}
	
	
