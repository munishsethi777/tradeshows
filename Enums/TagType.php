<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class TagType extends BasicEnum{
	const No_Tags_Needed = "No Tags Needed";
	const Try_Me = "Try Me";
	const Wrap_Tag = "Wrap Tag";
	const custom = "Custom";
}