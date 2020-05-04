<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class GraphicStatusType extends BasicEnum{
	const not_started = "Not Started";
	const no_update_needed = "No Update Needed";
	const missing_info_from_china = "Missing Info from China";
	const in_progress = "In Progress";
	const buyers_reviewing = "Buyer's Reviewing";
	const robby_reviewing = "Robby Reviewing";
	const manager_reviewing = "Manager Reviewing";
	const pending_customer_approval = "Pending Customer Approval";
	const pending_attorney_approval = "Pending Attorney Approval";
	const preparing_for_print = "Preparing for Print";
	const sent_to_print = "Sent to Print";
	const cancelled = "Cancelled";
}