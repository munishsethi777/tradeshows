<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class RequestPriorityTypes extends BasicEnum{
	const highest = "Highest";
	const high = "High";
	const medium = "Medium";
	const low = "Low";
	const lowest = "Lowest";
}