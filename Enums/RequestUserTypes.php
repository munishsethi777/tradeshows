<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class RequestUserTypes extends BasicEnum{
	const request_management_manager = "Manager";
	const request_management_employee = "Employee";
	const request_management_requester = "Requester";
}