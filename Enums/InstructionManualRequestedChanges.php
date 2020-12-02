<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class InstructionManualRequestedChanges extends BasicEnum{
	const photo_update = "Photo Update";
	const replacement_parts = "Replacement Parts";
	const specifications_update_or_add = "Specification Update Or Add";
	const add_or_modify_page_numbers = "Add or Modify Page Numbers";
	const diagram_update = "Diagram Update";
	const steps_update = "Steps Update";
	const description_update = "Description Update";
	const apline_logo_update = "Alpine Logo Update";
	const components_update = "Components Update";
	const warranty_update = "Warranty Update";
	const update_to_private_label_brand = "Update to Private Label Brand";
	const fold_to_booklet = "Fold to Booklet";
	const fold_format_update_add_version = "Fold Format Update : Add Version";
	const fold_format_update_add_pages = "Fold Format Update : Add Pages";
	const fold_format_update_update_alpine_logo = "Fold Format Update : Update Alpine Logo";
	const booklet_to_fold = "Booklet to Fold";
	const booklet_update_update_rating_box = "Booklet Update : Update Rating Box";
	const booklet_update_update_trading_hours_box = "Booklet Update : Update Trading Hourse Box";
	const other_in = "Other In";
}

