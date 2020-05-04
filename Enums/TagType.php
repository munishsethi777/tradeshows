<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class TagType extends BasicEnum{
	const no_tags_needed = "No Tags Needed";
	const try_me = "Try Me";
	const wrap_tag = "Wrap Tag";
	const custom = "Custom";
	const battery_tag = "Battery Tag";
	const booklet_wrap_tag = "Booklet Wrap Tag";
	const hangtag = "HangTag";
}