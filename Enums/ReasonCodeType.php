<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ReasonCodeType extends BasicEnum{
	const for_distance = "Far Distance";
	const small_quantities = "Small Quantities";
	const produced_in_sub_assembly = "Produced in Sub Assembly";
	const previously_completed = "Previously Completed";
}