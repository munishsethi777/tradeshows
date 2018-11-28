<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/AdminMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/class.phpmailer.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
class MailUtil{
	
	public static function sendTaskAssignedNotification($showSeq){
		$showTaskMgr = ShowTaskMgr::getInstance();
		$showData = $showTaskMgr->getShowTaskWithAssignee($showSeq);
		foreach ($showData as $key=>$showTasks){
			$i = 1;
			$userName = $showTasks[0]["fullname"];
			$userEmail = $showTasks[0]["email"];
			$html = "<p>Hello $userName,<p><br><p>You have assigned following tasks :- <br>";
			$html .= "<table style='width:90%'>
                       			<tr>
                       				<th>Sr.No.</th>
                       				<th>Task</th>
                       				<th>StartsOn</th>
                       				<th>EndsOn</th>
                       			</tr>";
			foreach ($showTasks as $task){
				$title = $task["title"];
				$startDate = $task["startDate"];
				$endDate = $task["endDate"];
				$html .= "<tr>
                       		<td>$i</td>
                       		<td>$title</td>
                       		<td>$startDate</td>
                       		<td>$endDate</td>
                       	  </tr>";
				$i++;
			}
		$html .= "</table>";
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
				$html = "Hello $adminName, <br>";
				$html .= "<p>User $userName has updated status as " . $showTaskDetail["status"] . " for task - '". $showTaskDetail["title"] . "'</p>";
				$toEmails = array(0=>$email);
				MailUtil::sendSmtpMail("Updated Task Status", $html, $toEmails, true);
			}
		}
	}
	
	public static function sendSmtpMail($subject,$body,$toEmails,$isSmtp,$attachments = array()){
			$mail = new PHPMailer();
			if($isSmtp){
				$mail->IsSMTP(); // telling the class to use SMTP
				//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "mail.satyainfopages.in";      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "munish@satyainfopages.in";  // GMAIL username
				$mail->Password   = "munish314";          // GMAIL password
			}
			$mail->SetFrom('noreply@satyainfopages.in', 'Satya Info Pages');
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
