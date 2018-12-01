<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ShowTaskStatus extends BasicEnum{
	const pending = "Pending";
	const inprocess = "In Process";
	const delay = "Delay";
	const completed = "Completed";
}