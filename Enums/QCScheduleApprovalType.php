<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class QCScheduleApprovalType extends BasicEnum{
	const pending = "Pending";
	const approved = "Approved";
	const rejected = "Rejected";
}