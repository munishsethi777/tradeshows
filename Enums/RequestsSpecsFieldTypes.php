<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class RequestsSpecsFieldTypes extends BasicEnum{
	const text = "Text";
	const yes_no = "Yes or No";
	const date = "Date";
	const datetime = "Date Time";
	const textarea = "Textarea";
	const numeric = "Numeric";
	const dropdown = "Dropdown";
}