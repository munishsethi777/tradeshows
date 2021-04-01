<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class Permissions extends BasicEnum{
	const qc = "QC";
	const usa_team = "USA Team";
	const china_team = "China Team";
	const graphic_designer = "Graphic Designer";
	const container_information = "Container Information";
	const container_delivery_information = "Container Delivery Information";
	const container_office_information = "Container Office Information";
	const class_code = "Class Code";
	const weekly_mail_button = "Weekly Mail Button";
	const qc_planner_button = "Qc Planner Button";
	const approved_reject_notification = "Approved/Reject Notification";
	const manage_customers = "Manage Customers";
	const po_incharge = "PO Incharge";
	const qc_isreadonly = "Readonly";
	const instruction_manual_usa_team = "Instruction Manual USA Team";
	const instruction_manual_china_team = "Instruction Manual China Team";
	const instruction_manual_technical_team = "Instruction Manual Technical Team";
	const request_management_manager = "Manager";
	const request_management_employee = "Employee";
	const request_management_requester = "Requester";
}