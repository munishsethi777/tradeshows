<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Request.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/RequestLog.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestPriorityTypes.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestTypeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestStatusMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestLogMgr.php");

class RequestMgr{
	private static $requestMgr;
	private static $dataStore;
	private static $selectSqlForGrid = "SELECT requests.*,departments.title departmenttitle,requesttypes.title requesttypetitle,requeststatuses.title requeststatustitle,createdby.fullname as createdbyfullname,assignedby.fullname as assignedbyfullname, assignedto.fullname as assignedtofullname FROM `requests` 
										LEFT JOIN departments on departments.seq = requests.departmentseq
										LEFT JOIN requesttypes on requesttypes.seq = requests.requesttypeseq
										LEFT JOIN requeststatuses on requeststatuses.seq = requests.requeststatusseq
										LEFT JOIN users as createdby on createdby.seq = requests.createdby
										LEFT JOIN users as assignedby on assignedby.seq = requests.assignedby
										LEFT JOIN users as assignedto on assignedto.seq = requests.assignedto";
	private static $selectCountSql = "SELECT COUNT(seq) from requests";
	private static $selectSql = "SELECT * FROM requests";
	public static function getInstance()
	{
		if (!self::$requestMgr){
			self::$requestMgr = new RequestMgr();
			self::$dataStore = new BeanDataStore(Request::$className,Request::$tableName);
		}
		return self::$requestMgr;
	}
	public function findBySeq($seq){
		$request = self::$dataStore->findBySeq($seq);
		return $request;
	}
	public function findArrBySeq($seq){
	    $request = self::$dataStore->findArrayBySeq($seq);
	    return $request;
	}
	public function createRequestFormHtml($requestTypeSeq,$request = false,$editCase = false){
		$requestStatusMgr = RequestStatusMgr::getInstance();
		$requestSpecsFieldMgr = RequestSpecsFieldMgr::getInstance();
		$requestStatuses = $requestStatusMgr->findByColValuePair("requesttypeseq",$requestTypeSeq);
		$requestSpecsFields = $requestSpecsFieldMgr->findByColValuePair("requesttypeseq",$requestTypeSeq);
		$htmlArray = array();
		$requestStatusHTML="";
		$requestSpecsFieldsHTML="";
		$requestStatusSeqForEdit = null;
		if($request){
			$requestStatusSeqForEdit = $request->getRequestStatusSeq();
		}
		foreach($requestStatuses as $requestStatus){
			$requestStatusSeq = $requestStatus->getSeq();
			$requestStatusSelected = $requestStatusSeqForEdit != null && $requestStatusSeqForEdit == $requestStatusSeq ? 'selected' : '' ;
			$requestStatusHTML .= "<option value='".$requestStatusSeq."' " . $requestStatusSelected . " >".$requestStatus->getTitle()."</option>";
		}
		$fieldsCount = 0;
		foreach($requestSpecsFields as $requestSpecsField){
			$isRequired = $requestSpecsField->getIsRequired() == "1" ? 'required' : '';
			$isVisible = $requestSpecsField->getIsVisible();
			$fieldType = $requestSpecsField->getFieldType();
			$name = $requestSpecsField->getName();
			$title = $requestSpecsField->getTitle();
			if($fieldsCount == 0){
				$requestSpecsFieldsHTML .= "<div class='form-group row'>";
			}
			if($isVisible){
				$id = str_replace(" ","_",$name);
				
				$requestSpecsFieldsHTML .= "<label class='col-lg-2 col-form-label bg-formLabel'>" . $title . "</label>";
				$requestSpecsFieldsHTML .= "<div class='col-lg-4'>";
				if($fieldType == "text"){
					$requestSpecsFieldsHTML .= "<input id='" . $name . "' type='text' maxLength='250' value='' name='" . $name . "' class='form-control' placeholder='' " . $isRequired . " >";
				}elseif($fieldType == "yes_no"){
					$requestSpecsFieldsHTML .= "<select id='" . $name . "' class='form-control' " . $isRequired . " name='" . $name . "' >";
					$requestSpecsFieldsHTML .= "<option value='1'>Yes</option><option value='0'>No</option>";
					$requestSpecsFieldsHTML .= "</select>";

				}elseif($fieldType == "date"){
					$requestSpecsFieldsHTML .= "<div class='input-group date' >";
					$requestSpecsFieldsHTML .= "<input type='text' id='" . $name . "' name='" . $name . "' value='' class='form-control dateControl datepicker' " . $isRequired . " readonly>";
					$requestSpecsFieldsHTML .= "<span class='input-group-addon'><i class='fa fa-calendar'></i></span>";
					$requestSpecsFieldsHTML .= "</div>";

				}elseif($fieldType == "datetime"){
					$requestSpecsFieldsHTML .= "<div class='input-group date' >";
					$requestSpecsFieldsHTML .= "<input type='text' id='" . $name . "' name='" . $name . "' value='' class='form-control dateControl datetimepicker' " . $isRequired . " readonly>";
					$requestSpecsFieldsHTML .= "<span class='input-group-addon'><i class='fa fa-calendar'></i></span>";
					$requestSpecsFieldsHTML .= "</div>";
				}elseif($fieldType == "textarea"){
					$requestSpecsFieldsHTML .= "<textarea id='" . $name . "' class='form-control' name='" . $name . "' " . $isRequired . " ></textarea>";
				}elseif($fieldType == "numeric"){
					$requestSpecsFieldsHTML .= "<input id='" . $name . "' type='number' maxLength='250' name='" . $name . "' value='' class='form-control' placeholder='' style='" . $isVisible . "' " . $isRequired . " >";
				}elseif($fieldType == "dropdown"){
					if(!empty($requestSpecsField->getDetails())){
						$optionsArr = array();
						$optionsArr = explode(",",$requestSpecsField->getDetails());
						$requestSpecsFieldsHTML .= "<select id='" . $name . "' class='form-control' " . $isRequired . " name='" . $name . "' >";
						foreach($optionsArr as $option){
							$requestSpecsFieldsHTML .= "<option value='" . $option . "'>" . $option . "</option>";
						}
						$requestSpecsFieldsHTML .= "</select>";	
					}
				}
				$requestSpecsFieldsHTML .= "</div>";
			}
			$fieldsCount++;
			if($fieldsCount == 2){
				$requestSpecsFieldsHTML .= "</div>";
				$fieldsCount = 0;
			}
		}
		$htmlArray['requestStatusHTML'] = $requestStatusHTML;
		$htmlArray['requestSpecsFieldsHTML'] = $requestSpecsFieldsHTML;
		return $htmlArray;
	}
	public function save($globalRequestVariable,$loggedInUserSeq){
		$currentDate = date("Y-m-d h:i:s");
		$requestSpecsFieldsFormJson = $globalRequestVariable['requestSpecsFieldsFormJson'];
		$departmentSeq = $globalRequestVariable['departmentSeq'];
		$requestTypeSeq = $globalRequestVariable['requestTypeSeq'];
		$priority = $globalRequestVariable['priority'];
		$requestStatusSeq = $globalRequestVariable['requestStatusSeq'];
		$assignedBy = $globalRequestVariable['assignedBySeq'] != '' ? $globalRequestVariable['assignedBySeq'] : null;
		$assignedTo = $globalRequestVariable['assignedToSeq'] != '' ? $globalRequestVariable['assignedToSeq'] : null;
		$dueDate = null;
		if($globalRequestVariable['dueDate'] != ''){
			$dueDate = DateUtil::convertDateToFormat($globalRequestVariable['dueDate'],"m-d-Y","Y-m-d");
		}
		$assigneeDueDate = null;
		if($globalRequestVariable['assigneeDueDate'] != '' ){
			$assigneeDueDate = DateUtil::convertDateToFormat($globalRequestVariable['assigneeDueDate'],"m-d-Y","Y-m-d");
		}
		$estimatedHours = $globalRequestVariable['estimatedHours'];
		$isrequiredapprovalfrommanager = $globalRequestVariable['isRequiredApprovalFromManager'] == 'yes' ? '1' : '0';
		$isrequiredapprovalfromrequester = $globalRequestVariable['isRequiredApprovalFromRequester'] == 'yes' ? '1' : '0';
		$isrequiredapprovalfromrobby = $globalRequestVariable['isRequiredApprovalFromRobby'] == 'yes' ? '1' : '0';
		$approvedByManagerDate = null;
		$approvedByRequesterDate = null;
		$approvedByRobbyDate = null;
		// $approvedByManagerDate = $globalRequestVariable['approvedByManagerDate'] == 'yes' ? $currentDate : '0';
		// $approvedByRequesterDate = $globalRequestVariable['approvedByRequesterDate'] == 'yes' ? $currentDate : '0';
		// $approvedByRobbyDate = $globalRequestVariable['approvedByRobbyDate'] == 'yes' ? $currentDate : '0';
		$request = new Request();
		$request->setDepartmentSeq($departmentSeq);
		$request->setRequestTypeSeq($requestTypeSeq);
		$request->setPriority($priority);
		$request->setRequestStatusSeq($requestStatusSeq);
		$request->setRequestSpecifications($requestSpecsFieldsFormJson);
		$request->setCode("na");
		$request->setTitle("na");
		$request->setDescriptionText("na");
		$request->setCreatedBy($loggedInUserSeq);
		$request->setAssignedBy($assignedBy);
		$request->setAssignedTo($assignedTo);
		$request->setDueDate($dueDate);
		$request->setAssigneeDueDate($assigneeDueDate);
		$request->setStartDate(null);
		$request->setEstimatedHours($estimatedHours);
		$request->setIsRequiredApprovalFromManager($isrequiredapprovalfrommanager);
		$request->setIsRequiredApprovalFromRequester($isrequiredapprovalfromrequester);
		$request->setIsRequireAapprovalFromRobby($isrequiredapprovalfromrobby);
		$request->setApprovedByManagerDate($approvedByManagerDate);
		$request->setApprovedByRequesterDate($approvedByRequesterDate);
		$request->setApprovedByRobbyDate($approvedByRobbyDate);
		$request->setCompletedDate(null);
		$request->setActualHours(null);
		$request->setIsCompleted(null);
        $request->setLastModifiedOn($currentDate);
		
		if(isset($globalRequestVariable['seq']) && $globalRequestVariable['seq'] != null){
			$seq = $globalRequestVariable['seq'];
			$request->setSeq($seq);
			$requestLogMgr = RequestLogMgr::getInstance();
			$existingRequest = $this->findBySeq($seq);
			$request->setCreatedOn($existingRequest->getCreatedOn());
			$request->setCreatedBy($existingRequest->getCreatedBy());
			$requestLogMgr->saveUpdatedAttributes($existingRequest,$request,$loggedInUserSeq);
		}else{
			$request->setCreatedOn($currentDate);
			$request->setCreatedBy($loggedInUserSeq);
			// $requestLog = new RequestLog();
			// $requestLog->setRequestSeq($requestSeq);
			// $requestLog->setAttributeName('requestby');
			// $requestLog->setCreatedBy($loggedInUserSeq);
			// $requestLog->setOldValue("");
			// $requestLog->setNewValue("");
			// $requestLog->setCreatedOn($currentDate);
			// $requestLog->setIsSpecFieldChange(false);
			// self::$dataStore->save($requestLog);
		}
		return self::$dataStore->save($request);
		// if(isset($_REQUEST['attachmentfilename']) && $_REQUEST['attachmentfilename'] != ''){
		// 	$requestAttachmentMgr = RequestAttachmentMgr::getInstance();
		// 	$requestAttachmentMgr->save($globalRequestVariable);
		// }
	}
	public function getAllRequests(){
		$rows = self::$dataStore->executeQuery(self::$selectSqlForGrid,true,true);
		$mainArr["Rows"] = $this->processRowsForGrid($rows);
		$count = self::$dataStore->executeCountQueryWithSql(self::$selectCountSql,true);
		$mainArr["TotalRows"] = $count;
		return $mainArr;
	}
	private function processRowsForGrid($rows){
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
		$arr = array();
		foreach($rows as $row){
			$row["createdon"] = DateUtil::convertDateToFormat($row["createdon"],"Y-m-d H:i:s","m-d-Y");
			$lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($row["lastmodifiedon"], "Y-m-d H:i:s", "d-m-Y",$loggedInUserTimeZone);
			$row["lastmodifiedon"] = $lastModifiedOn;
			$row["priority"] = RequestPriorityTypes::getValue($row['priority']);
			array_push($arr,$row);
		}
		return $arr;
	}
	public function saveComments(){

	}
}
?>