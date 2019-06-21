<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class GraphicType extends BasicEnum{
	const box = "Box";
	const Tray = "Tray";
	const a4 = "A4";
	const custom = "Custom";
}
