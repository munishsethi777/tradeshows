<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class NotificationType extends BasicEnum{
	const SC_READY_DATE = "Schedueld Ready Date";
	const SC_FINAL_INPECTION_DATE = "Schedueld Final Inspection Date";
	const SC_MIDDLE_INSPECTION_DATE = "Schedueld Middle Inspection Date";
	const SC_FIRST_INSPECTION_DATE = "Schedueld First Inspection Date";
	const SC_PRODUCTION_START_DATE = "Schedueld Production Start Date";
	const SC_GRAPHIC_RECEIVE_DATE = "Schedueld Graphics Receive Date";
}