<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/NotificationType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");


try{
	//Admin Notfications
	QCNotificationsUtil::sendUpcomingInspectionScheduleNotification(UserType::SUPERVISOR);
	//QCNotificationsUtil::sendUpcomingInspectionAppointmentNotification(UserType::SUPERVISOR);
	//QCNotificationsUtil::sendMissingAppoitmentNotification(UserType::SUPERVISOR);
	//QCNotificationsUtil::sendIncompletedSchedulesNotification(UserType::SUPERVISOR);
	
	//QC Notifications
	//QCNotificationsUtil::sendUpcomingInspectionScheduleNotification(UserType::QC);
	//QCNotificationsUtil::sendUpcomingInspectionAppointmentNotification(UserType::QC);
    //QCNotificationsUtil::sendMissingAppoitmentNotification(UserType::QC);
	//QCNotificationsUtil::sendIncompletedSchedulesNotification(UserType::QC);

}catch(Exception $e){
	echo $e->getMessage();
}

//MailUtil::sendPendingSchedulesNotification(NotificationType::SC_FINAL_INPECTION_DATE);
//MailUtil::sendPendingSchedulesNotification(NotificationType::SC_FIRST_INSPECTION_DATE);
//MailUtil::sendPendingSchedulesNotification(NotificationType::SC_MIDDLE_INSPECTION_DATE);
//MailUtil::sendPendingSchedulesNotification(NotificationType::SC_PRODUCTION_START_DATE);
//MailUtil::sendPendingSchedulesNotification(NotificationType::SC_GRAPHIC_RECEIVE_DATE);
