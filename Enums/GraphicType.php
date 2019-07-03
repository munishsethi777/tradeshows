<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class GraphicType extends BasicEnum{
	const color_box = "Color Box";
	const color_label = "Color Label";
	const floor_display = "Floor Display";
	const metal_display = "Metal Display";
	const tray_pack = "Tray Pack";
	const tray_label = "Tray Label";
	const window_box = "Window Box";
	const a4_label = "A4 Label";
	const custom = "Custom";
}
