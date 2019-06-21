<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class GraphicStatusType extends BasicEnum{
	const NOT_STARTED = "Not Started";
	const NO_UPDATE_NEEDED = "No Update Needed";
	const MISSING_INFO_FROM_CHINA = "Missing Info from China";
	const IN_PROGRESS = "In Progress";
	const BUYERS_REVIEWING = "Buyer's Reviewing";
	const ROBBY_REVIEWING = "Robby Reviewing";
	const PENDING_CUSTOMER_APPROVAL = "Pending Customer Approval";
	const PENDING_ATTORNEY_APPROVAL = "Pending Attorney Approval";
	const PREPARING_FOR_PRINT = "Preparing for Print";
	const SENT_TO_PRINT = "Sent to Print";
	const CANCELLED = "Cancelled";
}