<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/QCNotificationsUtil.php");
try{
	QCNotificationsUtil::sendPendingQCApprovalNotification();
}catch(Exception $e){
	echo $e->getMessage();
}