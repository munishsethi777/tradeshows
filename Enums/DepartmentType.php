<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class DepartmentType extends BasicEnum{
	const QC_Schedules = "QC Schedules";
	const Graphics_Logs = "Graphics Logs";
	const Item_Specs = "Item Specs";
	const Container_Schedules = "Container Schedules";
	const Users = "Users";
	const Teams = "Teams";
	const Manage_Customers = "Manage Customers";
	const Email_Logs = "Email Logs";
	const Shipping_Logs = "Shipping Logs";
	const Instruction_Manual = "Instruction Manual";
}