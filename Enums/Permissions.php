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
}