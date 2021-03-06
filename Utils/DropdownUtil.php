<?php


require_once($ConstantsArray['dbServerUrl'] . "Enums/ReasonCodeType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/GraphicType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/TagType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/LabelType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/GraphicStatusType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/WareHouseType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/TruckerType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/TerminalType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomExamStatusType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/FreightType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/DefectiveAllowanceDeductionsType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerBusinessType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/BuyerCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/PriorityType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/BusinessCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/XmasItemFromType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/SeasonShowNameType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerRegularTermsType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/GraphicsNAReasonType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerSalesPersonName.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerSalesPersonId.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/BooleanType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/FreightForwarder.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/SellerResponsibilityType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerQuestionaireArePoExpecting.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/InstructionManualType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/InstructionManualNewOrRevised.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerNameType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/InstructionManualRequestedChanges.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/InstructionManualLogStatus.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/ClassCodeMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/TimeZone.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/QCScheduleUpdateOptions.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/PermissionUtil.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/Permissions.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/DepartmentType.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/RequestsSpecsFieldTypes.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/DepartmentMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/RequestPriorityTypes.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/RequestTypeMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/RequestStatusMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerPositionTypes.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerRepTypes.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/CustomerRepMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/RequestDepartments.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerDomesticCommissionTypes.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/CustomerDirectImportCommissionTypes.php");

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
	
	public static function getYearDD($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = array(2020=>2020,2021=>2021);
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	
	public static function getSeasonShowsDD($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = SeasonShowNameType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	
	public static function getXmasItemFromDD($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = XmasItemFromType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	
	public static function getFreightTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = FreightType::getAll();
	    
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	public static function getCustomerRegularTermsDD($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = CustomerRegularTermsType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	public static function getDefectiveAllowanceDeductionsTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = DefectiveAllowanceDeductionsType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	
	public static function getBusinessTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = CustomerBusinessType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	
	public static function getBusinessCategoryTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = BusinessCategoryType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	
	public static function getReasonTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = ReasonCodeType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Reason");
	}
	
	public static function getGraphicTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$disabled) {
		$enums = GraphicType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Type",true,$disabled);
	}
	
	public static function getLabelTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = LabelType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Type");
	}
	
	public static function getGraphicStatusTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = GraphicStatusType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Type");
	}
	
	
	
	public static function getTagTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$disabled) {
		$enums = TagType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Type",false,$disabled);
	}
	
	public static function getQCUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getQCUsersArrForDD();
		return self::getDropDown1 ($users, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select QC");
	}
	
	public static function getPOUsers($selectName,$onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getPOInchargeUsersArrForDD();
		return self::getDropDown1 ($users, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select PO");
	}

	public static function getGraphicDesigersUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getGraphicDesignersArrForDD();
		return self::getDropDown1 ($users, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Designer");
	}
	
	public static function getClassCodes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$disabled,$isMultiSelect=false) {
		$classCodeMgr = ClassCodeMgr::getInstance();
		$classCodes = $classCodeMgr->findAllForDropDown();
		return self::getDropDown1 ($classCodes, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Code",$isMultiSelect,$disabled);
	}
	
	public static function getSupervisorsAndGraphicDesigners($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$enums = $userMgr->getSupervisorsAndGraphicDesignerForDD();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Type");
	}
	
	public static function getChinaTeamUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$enums = $userMgr->getChinaTeamUsersForDD();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select User");
	}
	
	public static function getTimezone($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) { 
	    $enums = TimeZone::$timezone;
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Type");
	}
	public static function getSupervisors($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $userMgr = UserMgr::getInstance();
	    $enums = $userMgr->getSupervisors();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Type");
	}
	public static function getWareHouseTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$userWareHouse=null) {
		$enums = WareHouseType::getAll();
	    if($userWareHouse != null){
	        $wareHouseValue = WareHouseType::getValue($userWareHouse);
	        $wareHouseKey = $userWareHouse;
	        $enums = [$wareHouseKey=>$wareHouseValue];
	    }
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,'Select Any');
	}
	
	public static function getCustomExampStatusTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = CustomExamStatusType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true);
	}
	
	public static function getTruckerTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = TruckerType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true);
	}
	public static function getBuyerCategories($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = BuyerCategoryType::getAll();
	    //sort($enums);
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	public static function getSellerResponsibilitiesType($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = SellerResponsibilityType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,$isAll);
	}
	
	public static function getTerminalTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
	    $enums = TerminalType::getAll();
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll,"Select Any");
	}
	
	public static function getPriorityTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = PriorityType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,$isAll);
	}
	
	public static function getGraphicsNAReasonTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$enums = GraphicsNAReasonType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Reason");
	}
	public static function getFreightForwarder($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$userFreightForwarder=null) {
	    $enums = FreightForwarder::getAll();
	    if($userFreightForwarder != null){
	        $ffVal = FreightForwarder::getValue($userFreightForwarder);
	        $ffKey = $userFreightForwarder;
	        $enums = [$ffKey=>$ffVal];
	    }
	    return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true,"Select Any");
	}
	public static function getAllQcScheduleOptions($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false){
		$enums = QCScheduleUpdateOptions::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll,"",false);
	}
	public static function getDropDown1($values, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$firstOption = "Select Any",$isMultiSelect = false,$disabled = "") {
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
		$str = "<select ".$required." class='form-control' name='" . $selectName . "' id='" . $id . "' onchange='" . $onChangeMethod . "' $multiple>";
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
				
				$str .= "<option $disabled value='" . $key . "' " . $select . ">" . $value . "</option>";
			}
		}
		$str .= "</select>";
		return $str;
	}

	public static function getCustomerSalesPersonName($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false)
	{
		$enums = CustomerSalesPersonName::getAll();
	return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll);
	}

	public static function getCustomerSalesPersonId($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false)
	{
		$enums = CustomerSalesPersonId::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll);
	}

	public static function getBooleanDropDown($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll=false,$defaultOption="")
	{
		$enums = BooleanType::getAll();
		if($selectedValue != null ){
			if ($selectedValue == 1) {
				$selectedValue = "yes";
			} else {
				$selectedValue = "no";
			}
		}else{
			$selectedValue = "";
		}
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll,$defaultOption);
	}
	public static function getIsPoExpecting($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll=false,$defalut=""){
	    $enums = CustomerQuestionaireArePoExpecting::getAll();
	    if($selectedValue != null){
	    } else {
	        $selectedValue = "";
	    }
	    return self::getDropDown1($enums, $selectName,$onChangeMethod, $selectedValue, $isRequired, $isAll,$defalut);
	}
	public static function getInstructionManualType($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$enums =  InstructionManualType::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, true);
	}
	public static function getInstructionManualNewOrRevised($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$enums =  InstructionManualNewOrRevised::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, true);
	}
	public static function getCustomerNameType($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$disabled,$isMultiSelect=false) {
		$enums =  CustomerNameType::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Customer",$isMultiSelect,$disabled);
	}
	public static function getInstructionManualRequestedChanges($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$disabled,$isMultiSelect=false){
		$enums =  InstructionManualRequestedChanges::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false,"Select Requested Changes",$isMultiSelect,$disabled);
	}
	public static function getInstructionManualTechnicalWriterUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$userMgr = UserMgr::getInstance();
		$enums = $userMgr->getUsersForDDByPermission(Permissions::instruction_manual_technical_team);
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false);
	}
	public static function getInstructionManualLogStatus($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$enums =  InstructionManualLogStatus::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, true);
	}
	public static function getInstructionManualChinaTeamUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$enums = $userMgr->getUsersForDDByPermission(Permissions::instruction_manual_china_team);
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false);
	}
	public static function getInstructionManualUSATeamUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false) {
		$userMgr = UserMgr::getInstance();
		$enums = $userMgr->getUsersForDDByPermission(Permissions::instruction_manual_usa_team);
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,false);
	}
	public static function getDepartmentType($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false){
		$departmentMgr =  DepartmentMgr::getInstance();
		$departments = $departmentMgr->findAllForDropDown();
		return self::getDropDown1($departments, $selectName, $onChangeMethod, $selectedValue, $isRequired, true,"Select Any");
	}
	public static function getRequestsSpecsFieldTypes($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false){
		$enums =  RequestsSpecsFieldTypes::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, false);
	}
	public static function getRequestPriority($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false){
		$enums =  RequestPriorityTypes::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, false);
	}
	public static function getRequestTypes($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false){
		$requestTypeMgr =  RequestTypeMgr::getInstance();
		$requestTypes = $requestTypeMgr->findAllForDropDown();
		return self::getDropDown1($requestTypes, $selectName, $onChangeMethod, $selectedValue, $isRequired, false);
	}
	public static function getRequestStatuses($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false){
		$requestStatusMgr =  RequestStatusMgr::getInstance();
		$requestStatuses = $requestStatusMgr->findAllForDropDown();
		return self::getDropDown1($requestStatuses, $selectName, $onChangeMethod, $selectedValue, $isRequired, false);
	}
	public static function getUsersForDDByPermission($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$permissionType){
		$userMgr = UserMgr::getInstance();
		$enums = $userMgr->getUsersForDDByPermission($permissionType);
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true);
	}
	public static function getCustomerPostions($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$enums =  CustomerPositionTypes::getAll();
		return self::getDropDown1 ($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,true);
	}
	public static function getCustomerInsideAccountManagerNameTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$colValuePair = array();
		$colValuePair['customerreptype'] = 'inside_account_manager';
		$customerRepMgr = CustomerRepMgr::getInstance();
		$customerReps =  $customerRepMgr->findByAttributes($colValuePair);
		$usersArray = array();
		if(!empty($customerReps)){
			foreach($customerReps as $customerRep => $val){
				$usersArray[$val->getSeq()] = $val->getFullName();
			}
		}
		return self::getDropDown1 ($usersArray, $selectName, $onChangeMethod,$selectedValue,$isRequired,true);
	}
	public static function getCustomerInternalSupportNameTypes($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false){
		$colValuePair = array();
		$colValuePair['customerreptype'] = 'internalsupport';
		$customerRepMgr = CustomerRepMgr::getInstance();
		$customerReps =  $customerRepMgr->findByAttributes($colValuePair);
		$usersArray = array();
		if(!empty($customerReps)){
			foreach($customerReps as $customerRep => $val){
				$usersArray[$val->getSeq()] = $val->getFullName();
			}
		}
		return self::getDropDown1 ($usersArray, $selectName, $onChangeMethod, $selectedValue,$isRequired,true);
	}
	public static function getUSATeamUsers($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll,$firstOption) {
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getUsersForDDByPermission(Permissions::instruction_manual_usa_team);
		return self::getDropDown1 ($users, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll,$firstOption);
	}
	public static function getCustomerRepTypesForDD($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$isMultiSelect=false){
		$enums =  CustomerRepTypes::getAll();
		unset($enums[CustomerRepTypes::getName(CustomerRepTypes::buyer)]);
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	public static function getRequestDepartments($selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll = false,$isMultipleSelect = false,$disabled=false,$getAllDepartments = false){
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userMgr = UserMgr::getInstance();
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$userDepartmentsArr = explode(",",$user->getRequestDepartments());
		$enums =  RequestDepartments::getAll();
		if(!$getAllDepartments){
			foreach($enums as $key => $val){
				if(!in_array($key,$userDepartmentsArr)){
					unset($enums[$key]);
				}
			}
		}
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue, $isRequired, $isAll,"Select Any",$isMultipleSelect,$disabled);
	}
	public static function getCustomerDomesticCommissionDD($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$isMultiSelect=false){
		$enums =  CustomerDomesticCommissionTypes::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	public static function getCustomerDirectImportCommissionDD($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$isMultiSelect=false){
		$enums =  CustomerDirectImportCommissionTypes::getAll();
		return self::getDropDown1($enums, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
	public static function getGraphicNeworUpdate($selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll = false,$isMultiSelect=false){
	    $enums =  CustomerDirectImportCommissionTypes::getAll();
	    $constants = ["new"=>"New","update"=> "Update"];
	    return self::getDropDown1($constants, $selectName, $onChangeMethod, $selectedValue,$isRequired,$isAll);
	}
}