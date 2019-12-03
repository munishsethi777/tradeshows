<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ContainerScheduleNoteType extends BasicEnum{
	const eta = "ETA";
	const empty_return = "Empty Return";
	const notification_pickup = "Notification Pickup";
	const notes_to_china_office = "Notes To China Office";
}