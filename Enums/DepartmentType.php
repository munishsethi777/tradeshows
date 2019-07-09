<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class DepartmentType extends BasicEnum{
	const QC_Schedules = "QC Schedules";
	const Graphics_Logs = "Graphics Logs";
	const Item_Specs = "Item Specs";
	const Container_Schedules = "Container Schedules";
}