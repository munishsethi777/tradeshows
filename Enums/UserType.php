<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class UserType extends BasicEnum{
	const QC = "QC";
	const SUPERVISOR = "SUPERVISOR";
}