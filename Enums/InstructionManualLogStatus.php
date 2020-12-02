<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class InstructionManualLogStatus extends BasicEnum{
	const not_started = "Not Started";
	const in_progress = "In Progress";
	const awaiting_information_from_china = "Awaiting Information From China";
	const awaiting_information_form_buyers = "Awaiting Information From Buyers";
    const in_review_supervisor = "In Review - Supervisor";
    const in_review_manager = "In Review - Manager";
    const in_review_buyer = "In Review - Buyer";
    const sent_to_china = "Sent to China";
    const cancelled = "Cancelled";
    const duplicate = "Duplicate";
}

