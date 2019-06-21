<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class UserType extends BasicEnum{
	const ADMIN = "ADMIN";
	const QC = "QC";
	const SUPERVISOR = "SUPERVISOR";
	const GRAPHIC_DESIGNER = "GRAPHIC DESIGNER";
}