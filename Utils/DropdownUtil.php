<?php
require_once ($ConstantsArray ['dbServerUrl'] . "Enums/ReasonCodeType.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Enums/GraphicType.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Enums/TagType.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Enums/LabelType.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Enums/GraphicStatusType.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Managers/UserMgr.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Managers/ClassCodeMgr.php");


class DropDownUtils {
	
   public static function getDropDown($values, $selectName, $onChangeMethod, $selectedValue,$isAll = false,$firstOption = "Select Any") {
   		$id = $selectName;
   		if(strpos($selectName, "[]") !== false){
   			$id = str_replace("[]", "", $id);
   		}
		$str = "<select required class='form-control m-b' name='" . $selectName . "' id='" . $id . "' onchange='" . $onChangeMethod . "'>";
		if($isAll){
			$str .= "<option value=''>".$firstOption."</option>";
		}
		foreach ( $values as $key => $value ) {
			if( strpos( $key, "group_" ) !== false ) {
				$str .= "<optgroup label='$value'>";
			}else{
				$select = $selectedValue == $key ? 'selected' : null;
				$str .= "<option value='" . $key . "' " . $select . ">" . $value . "</option>";
			}
		}
		$str .= "</select>";
		return $str;
	}
	
	public static function getReasonTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = ReasonCodeType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Reason");
	}
	
	public static function getGraphicTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = GraphicType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Type",true);
	}
	
	public static function getLabelTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = LabelType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Type");
	}
	
	public static function getGraphicStatusTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = GraphicStatusType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Type");
	}
	
	public static function getTagTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = TagType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Type");
	}
	
	public static function getQCUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getQCUsersArrForDD();
		return self::getDropDown1 ($users, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select QC");
	}
	
	public static function getGraphicDesigersUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getGraphicDesignersArrForDD();
		return self::getDropDown1 ($users, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Designer");
	}
	
	public static function getClassCodes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$classCodeMgr = ClassCodeMgr::getInstance();
		$classCodes = $classCodeMgr->findAllForDropDown();
		return self::getDropDown1 ($classCodes, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Code");
	}
	
	public static function getDropDown1($values, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$firstOption = "Select Any",$isMultiSelect = false) {
		$id = $selectName;
		if(strpos($selectName, "[]") !== false){
			$id = str_replace("[]", "", $id);
		}
		$required = "";
		if($isRequired){
			$required = "required";
		}
		$multiple = "";
		if($isMultiSelect){
			$multiple = "multiple";
			$selectedValue = explode(",",$selectedValue);
		}
		$str = "<select ".$required." class='form-control m-b' name='" . $selectName . "' id='" . $id . "' onchange='" . $onChangeMethod . "' $multiple>";
		if($isAll){
			$str .= "<option value=''>".$firstOption."</option>";
		}
		foreach ( $values as $key => $value ) {
			if( strpos( $key, "group_" ) !== false ) {
				$str .= "<optgroup label='$value'>";
			}else{
				if($isMultiSelect){
					$select = in_array($key,$selectedValue) ? 'selected' : null;
				}else{
					$select = $selectedValue == $key ? 'selected' : null;
				}
				
				$str .= "<option value='" . $key . "' " . $select . ">" . $value . "</option>";
			}
		}
		$str .= "</select>";
		return $str;
	}

}