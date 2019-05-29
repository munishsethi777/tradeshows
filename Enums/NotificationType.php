<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class NotificationType extends BasicEnum{
	const SC_READY_DATE = "Scheduled Ready Date";
	const SC_FINAL_INPECTION_DATE = "Scheduled Final Inspection Date";
	const SC_MIDDLE_INSPECTION_DATE = "Scheduled Middle Inspection Date";
	const SC_FIRST_INSPECTION_DATE = "Scheduled First Inspection Date";
	const SC_PRODUCTION_START_DATE = "Scheduled Production Start Date";
	const SC_GRAPHIC_RECEIVE_DATE = "Scheduled Graphics Receive Date";
}