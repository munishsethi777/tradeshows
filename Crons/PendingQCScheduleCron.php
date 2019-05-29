<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/NotificationType.php");

MailUtil::sendPendingSchedulesNotification(NotificationType::SC_READY_DATE);
MailUtil::sendPendingSchedulesNotification(NotificationType::SC_FINAL_INPECTION_DATE);
MailUtil::sendPendingSchedulesNotification(NotificationType::SC_FIRST_INSPECTION_DATE);
MailUtil::sendPendingSchedulesNotification(NotificationType::SC_MIDDLE_INSPECTION_DATE);
MailUtil::sendPendingSchedulesNotification(NotificationType::SC_PRODUCTION_START_DATE);
MailUtil::sendPendingSchedulesNotification(NotificationType::SC_GRAPHIC_RECEIVE_DATE);
