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
require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestDepartments.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/RequestReportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BeanReturnDataType.php");	
require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestNotificationType.php");

class RequestMgr{
	private static $requestMgr;
	private static $dataStore;
	private static $selectSqlForGrid = "SELECT requests.*,requesttypes.title requesttypetitle,requeststatuses.title requeststatustitle,createdby.fullname as createdbyfullname,assignedby.fullname as assignedbyfullname, assignedby.email as assignedbyemail, assignedto.fullname as assignedtofullname FROM `requests` 
										LEFT JOIN requesttypes on requesttypes.seq = requests.requesttypeseq
										LEFT JOIN requeststatuses on requeststatuses.seq = requests.requeststatusseq
										LEFT JOIN users as createdby on createdby.seq = requests.createdby
										LEFT JOIN users as assignedby on assignedby.seq = requests.assignedby
										LEFT JOIN users as assignedto on assignedto.seq = requests.assignedto";
	private static $selectCountSql = "SELECT COUNT(requests.seq) from requests LEFT JOIN requesttypes on requesttypes.seq = requests.requesttypeseq
										LEFT JOIN requeststatuses on requeststatuses.seq = requests.requeststatusseq
										LEFT JOIN users as createdby on createdby.seq = requests.createdby
										LEFT JOIN users as assignedby on assignedby.seq = requests.assignedby
										LEFT JOIN users as assignedto on assignedto.seq = requests.assignedto";
	private static $selectSql = "SELECT * FROM requests";
	private static $filterExportSelectSql = "";
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
	public function createRequestFormHtml($requestTypeSeq,$request = false,$editCase = false,$requestSpecifications=""){
		$requestStatusMgr = RequestStatusMgr::getInstance();
		$requestSpecsFieldMgr = RequestSpecsFieldMgr::getInstance();
		$requestStatuses = $requestStatusMgr->findByColValuePair("requesttypeseq",$requestTypeSeq);
		$requestSpecsFields = $requestSpecsFieldMgr->findByColValuePair("requesttypeseq",$requestTypeSeq);
		$htmlArray = array();
		$requestStatusHTML="";
		$requestSpecsFieldsHTML="";
		$requestStatusSeqForEdit = null;
		$requestSpecifications = json_decode($requestSpecifications);
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
			$seq = $requestSpecsField->getSeq();
			$value = "";
			if($editCase){
				$value = isset($requestSpecifications->$seq) ? $requestSpecifications->$seq : '';
			}
			$title = $requestSpecsField->getTitle();
			if($fieldsCount == 0){
				$requestSpecsFieldsHTML .= "<div class='form-group row'>";
			}
			if($isVisible){
				$id = str_replace(" ","_",$name);
				
				$requestSpecsFieldsHTML .= "<label class='col-lg-2 col-form-label bg-formLabelMauve'>" . $title . "</label>";
				$requestSpecsFieldsHTML .= "<div class='col-lg-4'>";
				if($fieldType == "text"){
					$requestSpecsFieldsHTML .= "<input id='" . $seq . "' type='text' maxLength='250' value='" . $value . "' name='" . $seq . "' class='form-control' placeholder='' " . $isRequired . " >";
				}elseif($fieldType == "yes_no"){
					$selectYes = $value == 1 ? 'selected' : '';
					$selectNo = $value == 0 ? 'selected' : '';
					$requestSpecsFieldsHTML .= "<select id='" . $seq . "' class='form-control' " . $isRequired . " name='" . $seq . "' >";
					$requestSpecsFieldsHTML .= "<option value='1' " . $selectYes . " >Yes</option><option " . $selectNo . " value='0'>No</option>";
					$requestSpecsFieldsHTML .= "</select>";

				}elseif($fieldType == "date"){
					$requestSpecsFieldsHTML .= "<div class='input-group date' >";
					$requestSpecsFieldsHTML .= "<input type='text' id='" . $seq . "' name='" . $seq . "' value='" . $value . "' class='form-control dateControl datepicker' " . $isRequired . ">";
					$requestSpecsFieldsHTML .= "<span class='input-group-addon'><i class='fa fa-calendar'></i></span>";
					$requestSpecsFieldsHTML .= "</div>";

				}elseif($fieldType == "datetime"){
					$requestSpecsFieldsHTML .= "<div class='input-group date' >";
					$requestSpecsFieldsHTML .= "<input type='text' id='" . $seq . "' name='" . $seq . "' value='" . $value . "' class='form-control dateControl datetimepicker' " . $isRequired . ">";
					$requestSpecsFieldsHTML .= "<span class='input-group-addon'><i class='fa fa-calendar'></i></span>";
					$requestSpecsFieldsHTML .= "</div>";
				}elseif($fieldType == "textarea"){
					$requestSpecsFieldsHTML .= "<textarea id='" . $seq . "' class='form-control' name='" . $seq . "' " . $isRequired . " >" . $value . "</textarea>";
				}elseif($fieldType == "numeric"){
					$requestSpecsFieldsHTML .= "<input id='" . $seq . "' type='number' maxLength='250' name='" . $seq . "' value='" . $value . "' class='form-control' placeholder='' style='" . $isVisible . "' " . $isRequired . " >";
				}elseif($fieldType == "dropdown"){
					if(!empty($requestSpecsField->getDetails())){
						$optionsArr = array();
						$optionsArr = explode(",",$requestSpecsField->getDetails());
						$requestSpecsFieldsHTML .= "<select id='" . $seq . "' class='form-control' " . $isRequired . " name='" . $seq . "' >";
						foreach($optionsArr as $option){
							$selectedOption = '';
							if($value == $option){
								$selectedOption =  'selected';
							}
							$requestSpecsFieldsHTML .= "<option value='" . $option . "' " . $selectedOption . " >" . $option . "</option>";
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
		$userMgr = UserMgr::getInstance();
		$currentDateTime = new DateTime();
		$requestSpecsFieldsFormJson = $globalRequestVariable['requestSpecsFieldsFormJson'];
		$department = $globalRequestVariable['department'] == '' ? null : $globalRequestVariable['department'];
		$requestTypeSeq = $globalRequestVariable['requestTypeSeq'] == '' ? null : $globalRequestVariable['requestTypeSeq'];
		$priority = $globalRequestVariable['priority'] == '' ? null : $globalRequestVariable['priority'];;
		$requestStatusSeq = $globalRequestVariable['requestStatusSeq'] == '' ? null : $globalRequestVariable['requestStatusSeq'];
		$assignedBy = $globalRequestVariable['assignedBySeq'] == '' ?  null : $globalRequestVariable['assignedBySeq'];
		$assignedTo = $globalRequestVariable['assignedToSeq'] == '' ?  null : $globalRequestVariable['assignedToSeq'];
		$dueDate = null;
		if($globalRequestVariable['dueDate'] != ''){
			$dueDate = DateUtil::convertDateToFormat($globalRequestVariable['dueDate'],"m-d-Y","Y-m-d");
		}
		$assigneeDueDate = null;
		if($globalRequestVariable['assigneeDueDate'] != '' ){
			$assigneeDueDate = DateUtil::convertDateToFormat($globalRequestVariable['assigneeDueDate'],"m-d-Y","Y-m-d");
		}
		$estimatedHours = $globalRequestVariable['estimatedHours'] == '' ? null : $globalRequestVariable['estimatedHours'];
		$isrequiredapprovalfrommanager = $globalRequestVariable['isRequiredApprovalFromManager'] == 'yes' ? '1' : '0';
		$isrequiredapprovalfromrequester = $globalRequestVariable['isRequiredApprovalFromRequester'] == 'yes' ? '1' : '0';
		$isrequiredapprovalfromrobby = $globalRequestVariable['isRequiredApprovalFromRobby'] == 'yes' ? '1' : '0';
		$approvedByManagerDate = null;
		$approvedByRequesterDate = null;
		$approvedByRobbyDate = null;
		$requestTypeMgr = RequestTypeMgr::getInstance();
		$requestTypeCode = $requestTypeMgr->getAttributeBySeq("requesttypecode",$requestTypeSeq);
		$requestCode = "";
		$markedCompletedNotification = false;
		$request = new Request();
		$request->setDepartment($department);
		$request->setRequestTypeSeq($requestTypeSeq);
		$request->setPriority($priority);
		$request->setRequestStatusSeq($requestStatusSeq);
		$request->setRequestSpecifications($requestSpecsFieldsFormJson);
		$request->setCode(null);
		$request->setTitle(null);
		$request->setDescriptionText(null);
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
		$request->setIsCompleted(0);
        $request->setLastModifiedOn($currentDateTime);
        if($globalRequestVariable["isCompleted"]){
            $request->setIsCompleted($globalRequestVariable["isCompleted"]);
			$markedCompletedNotification = true;
        }
        
		if(isset($globalRequestVariable['seq']) && $globalRequestVariable['seq'] != null){
			$seq = $globalRequestVariable['seq'];
			$requestCode = $seq . "-" . $requestTypeCode;
			$request->setSeq($seq);
			$request->setCode($requestCode);
			$requestLogMgr = RequestLogMgr::getInstance();
			$existingRequest = $this->findBySeq($seq);
			$request->setCreatedOn($existingRequest->getCreatedOn());
			$request->setCreatedBy($existingRequest->getCreatedBy());
			$requestLogMgr->saveUpdatedAttributes($existingRequest,$request,$loggedInUserSeq);
			if($existingRequest->getAssignedTo() != $request->getAssignedTo()){
				RequestReportUtil::sendRequestAssignmentNotificationToEmployee($request);
			}
			if($existingRequest->getRequestStatusSeq() != $request->getRequestStatusSeq()){
				RequestReportUtil::sendRequestStatusChangeNotificationToRequester($request,$existingRequest);
			}
			if($existingRequest->getIsCompleted()){
				$markedCompletedNotification = false;
			}
		}else{
			$request->setCreatedOn($currentDateTime);
			$request->setCreatedBy($loggedInUserSeq);
			if( $request->getAssignedTo() != null){
				RequestReportUtil::sendRequestAssignmentNotificationToEmployee($request);
			}
		}
		$seq = self::$dataStore->save($request);
		if($requestCode == "" ){// It means new case
			$requestCode = $seq . "-" . $requestTypeCode;
			$attr = array("code" => $requestCode);
			$condition = array("seq" => $seq);
			self::$dataStore->updateByAttributes($attr,$condition);
			$request->setCode($requestCode);
			RequestReportUtil::sendNewRequestNotificationToManagerOfDepartment($request);
		}
		if($markedCompletedNotification){
			RequestReportUtil::sendRequestMarkedAsCompletedNotification($request);
		}
		$return = array('seq' => $seq,'requestcode'=>$requestCode,'requesttypeseq'=>$requestTypeSeq);
		return $return;
	}
	private function processRowsForGrid($rows){
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
		$arr = array();
		foreach($rows as $row){
			$row["requests.department"] = RequestDepartments::getValue($row['department']);
			$row["requests.createdon"] = DateUtil::convertDateToFormatWithTimeZone($row["createdon"], "Y-m-d H:i:s", "m-d-Y H:i:s",$loggedInUserTimeZone);
			$lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($row["lastmodifiedon"], "Y-m-d H:i:s", "m-d-Y H:i:s",$loggedInUserTimeZone);
			$row["requests.lastmodifiedon"] = $lastModifiedOn;
			$row["requests.priority"] = RequestPriorityTypes::getValue($row['priority']);
			$row["requests.iscompleted"] = $row['iscompleted'] == 1 ? 1 : 0 ;
			$row["assignedto.fullname"] = $row['assignedtofullname'];
			$row["assignedby.fullname"] = $row['assignedbyfullname'];
			$row["createdby.fullname"] = $row['createdbyfullname'];
			$row["requesttypes.title"] = $row['requesttypetitle'];
			$row['requeststatuses.title'] = $row['requeststatustitle'];
			// $row['requests.seq'] = $row['seq'];
			$row['requests.code'] = $row['code'];
			$row['requests.lastmodifiedon'] = $row['lastmodifiedon'];
			array_push($arr,$row);
		}
		return $arr;
	}
	public function getAllRequests($beanReturnDataType,$isEmailNotification = false){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		if($isEmailNotification){
			$sql = self::$selectSqlForGrid;
			$rows = self::$dataStore->executeQuery($sql,false,true);
			return $rows;
		}else{
			$countSql = self::$selectCountSql;
			$requestDepartments = $user->getRequestDepartments();
			if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
				//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
				//to be coded as per manager's departmentsprojectEmployeeDepartments
				$managerDepartments = implode("','",explode(',',$requestDepartments));
				$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ")";
				$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ")";
			}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
				$sql .= " WHERE requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq;
				$countSql .= " where requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq;
			}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
				$sql .= " where requests.createdby = ". $loggedInUserSeq ;
				$countSql .= " where requests.createdby = ". $loggedInUserSeq ;
			}else{
				return;
			}
			if($beanReturnDataType == BeanReturnDataType::export){
				return $sql;
			}else if($beanReturnDataType == BeanReturnDataType::count){
				return self::$dataStore->executeCountQueryWithSql($countSql,true);
			}else if($beanReturnDataType == BeanReturnDataType::grid){
				$rows = self::$dataStore->executeQuery($sql,true,true);
				$mainArr["Rows"] = $this->processRowsForGrid($rows);
				$count = $this->getAllRequests(BeanReturnDataType::count);
				$mainArr["TotalRows"] = $count;
				return $mainArr;
			}
		}
	}
	public function getAllCompletedRequests($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.iscompleted=1 ";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .  ") AND requests.iscompleted=1";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.iscompleted=1";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.iscompleted=1";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.iscompleted=1";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.iscompleted=1";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getAllCompletedRequests(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getAllIncompletedRequests($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ."  AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getAllIncompletedRequests(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getAllRequestsDueToday($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.duedate = '".date('Y-m-d')."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.duedate = '".date('Y-m-d')."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.duedate = '".date('Y-m-d')."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.duedate = '".date('Y-m-d')."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.duedate = '".date('Y-m-d')."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.duedate = '".date('Y-m-d')."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getAllRequestsDueToday(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getRequestsDueInNextWeek($beanReturnDataType,$isEmailNotification = false){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.duedate > '" . date('Y-m-d') . "' AND requests.duedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.duedate > '" . date('Y-m-d') . "' AND requests.duedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.duedate > '" . date('Y-m-d') . "' AND requests.duedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.duedate > '" . date('Y-m-d') . "' AND requests.duedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.duedate > '" . date('Y-m-d') . "' AND requests.duedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.duedate > '" . date('Y-m-d') . "' AND requests.duedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getRequestsDueInNextWeek(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getRequestDuePassed($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND  requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getRequestDuePassed(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getAssigneeRequestsDueToday($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assigneeduedate = '" . date('Y-m-d') . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assigneeduedate = '" . date('Y-m-d') . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.assigneeduedate = '" . date('Y-m-d') . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.assigneeduedate = '" . date('Y-m-d') . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assigneeduedate = '" . date('Y-m-d') . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assigneeduedate = '" . date('Y-m-d') . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getAssigneeRequestsDueToday(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getAssigneeRequestsDueInNextWeek($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getAssigneeRequestsDueInNextWeek(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getAssigneeRequestsDuePassed($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assigneeduedate <  '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assigneeduedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			$sql .= " WHERE (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.assigneeduedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where (requests.assignedto = ". $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq .") AND requests.assigneeduedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assigneeduedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assigneeduedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getAssigneeRequestsDuePassed(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	public function getAllUnassignedRequests($beanReturnDataType){
		$userMgr = UserMgr::getInstance();
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $sessionUtil->getUserLoggedInSeq();
		$userRoles = $userMgr->getUserRolesArr($loggedInUserSeq);
		$user = $userMgr->findBySeq($loggedInUserSeq);
		$sql = self::$selectSqlForGrid;
		$countSql = self::$selectCountSql;
		$requestDepartments = $user->getRequestDepartments();
		if(in_array(Permissions::getName(Permissions::request_management_manager), $userRoles)){
			//$sql .= " where requests.assignedto = ". $loggedInUserSeq;
			//to be coded as per manager's departmentsprojectEmployeeDepartments
			$managerDepartments = implode("','",explode(',',$requestDepartments));
			$sql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assignedto IS NULL";
			$countSql .= " where ((requests.department IN('". $managerDepartments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $loggedInUserSeq . " OR requests.createdby = " . $loggedInUserSeq . ") AND requests.assignedto IS NULL ";
		}else if (in_array(Permissions::getName(Permissions::request_management_employee), $userRoles)){
			return;
		}else if(in_array(Permissions::getName(Permissions::request_management_requester), $userRoles)){
			$sql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assignedto IS NULL";
			$countSql .= " where requests.createdby = ". $loggedInUserSeq ." AND requests.assignedto IS NULL";
		}else{
			return;
		}
		if($beanReturnDataType == BeanReturnDataType::export){
			return $sql;
		}else if($beanReturnDataType == BeanReturnDataType::count){
			return self::$dataStore->executeCountQueryWithSql($countSql,true);
		}else if($beanReturnDataType == BeanReturnDataType::grid){
			$rows = self::$dataStore->executeQuery($sql,true,true);
			$mainArr["Rows"] = $this->processRowsForGrid($rows);
			$count = $this->getAllUnassignedRequests(BeanReturnDataType::count);
			$mainArr["TotalRows"] = $count;
			return $mainArr;
		}
	}
	
	
	// export functions calling, when user click on analytic filter export icon---------------------------------------
	private function exportFilterData($filterId){
		$sql = "";
		$requestExportSqlAndFileName = array();
		$fileName = "RequestManagement";
		if($filterId == "request_management_all_request_export_date"){
			$sql = $this->getAllRequests(BeanReturnDataType::getValue("export"));
			$fileName = "AllProjects";
		}elseif($filterId == "request_management_completed_request_export_date"){
			$sql = $this->getAllCompletedRequests(BeanReturnDataType::getValue("export"));
			$fileName = "All_Completed_Requests";
		}elseif($filterId == "request_management_incompleted_request_export_date"){
			$sql = $this->getAllIncompletedRequests(BeanReturnDataType::getValue("export"));
			$fileName = "All_Incompleted_Requests";
		}elseif($filterId == "request_management_requests_due_today_export_date"){
			$sql = $this->getAllRequestsDueToday(BeanReturnDataType::getValue("export"));
			$fileName = "Requests_Due_Today";
		}elseif($filterId == "request_management_requests_due_in_next_week_export_date"){
			$sql = $this->getRequestsDueInNextWeek(BeanReturnDataType::getValue("export"));
			$fileName = "Requests_Due_In_Next_Week";
		}elseif($filterId == "request_management_requests_due_passed_export_date"){
			$sql = $this->getRequestDuePassed(BeanReturnDataType::getValue("export"));
			$fileName = "Request_Due_Passed";
		}elseif($filterId == "request_management_assignee_requests_due_today_export_date"){
			$sql = $this->getAssigneeRequestsDueToday(BeanReturnDataType::getValue("export"));
			$fileName = "Request_Assignee_Due_Today";
		}elseif($filterId == "request_management_assignee_requests_due_in_next_week_export_date"){
			$sql = $this->getAssigneeRequestsDueInNextWeek(BeanReturnDataType::getValue("export"));
			$fileName = "Request_Assignee_Due_In_Next_Week";
		}elseif($filterId == "request_management_assignee_requests_due_passed_export_date"){
			$sql = $this->getAssigneeRequestsDuePassed(BeanReturnDataType::getValue("export"));
			$fileName = "Request_Assignee_Due_passed";
		}elseif($filterId == "request_management_unassigned_export_date"){
			$sql = $this->getAllUnassignedRequests(BeanReturnDataType::getValue("export"));
			$fileName = "Unassigned_Requests";
		}
		$requestExportSqlAndFileName['sql'] = $sql;
		$requestExportSqlAndFileName['fileName'] = $fileName;
		return $requestExportSqlAndFileName;
	}
	public function exportRequests($queryString="",$filterId,$requestSeqs = ""){
		if($queryString != ""){
			$output = array();
			parse_str($queryString, $output);
			$_GET = array_merge($_GET,$output);
		}
		$requestExportSqlAndFileName = $this->exportFilterData($filterId);
		$sql = $requestExportSqlAndFileName['sql'];
		$fileName = $requestExportSqlAndFileName['fileName'];
		if(!empty($requestSeqs)){// selected row export clause
			$sql .= " AND requests.seq in ($requestSeqs)";
		}
		$requests = self::$dataStore->executeQuery($sql,true,true);
		$dataForExport = $this->processRowsForExport($requests);
		PHPExcelUtil::exportRequests($dataForExport,$fileName);
	}
	public function processRowsForExport($requests){
		$sql = "SELECT * from requestspecsfields";
		$requestSpecsfields = self::$dataStore->executeQuery($sql,false,true);

		$allRequestSpecsArr = [];
		foreach($requestSpecsfields as $requestSpec){
			$allRequestSpecsArr[$requestSpec['seq']] = $requestSpec;
		}
		$dataForExport = [];
		foreach($requests as $request){
			$fullSheetName = $request['requesttypetitle'] . " - " . RequestDepartments::getValue($request['department']);
			$sheetName = substr($fullSheetName,0,30);
			$specJsonArr = json_decode($request['requestspecifications'],true);
			$headers = '';
			$records = [];
			$specArr = [];
			$requestTemp = [];
			// $requestTemp['seq'] = $request['seq'];
			$requestTemp['CODE'] = $request['code'];
			$requestTemp['DEPARTMENT'] = RequestDepartments::getValue($request['department']);
			$requestTemp['PRIORITY'] = RequestPriorityTypes::getValue($request['priority']);
			$requestTemp['PROJECT_TYPE'] = $request['requesttypetitle'];
			$requestTemp['CREATED_BY'] = $request['createdbyfullname'];
			$requestTemp['ASSIGNED_BY'] = $request['assignedbyfullname'];
			$requestTemp['ASSIGNED_TO'] = $request['assignedtofullname'];
			$requestTemp['STATUS'] = $request['requeststatustitle'];
			$requestTemp['ASSIGNEE_DUE_DATE'] = $request['assigneeduedate'];
			$requestTemp['DUE_DATE'] = $request['duedate'];
			$requestTemp['ESTIMATED_HOURS'] = $request['estimatedhours'];
			$requestTemp['IS_APPROVAL_REQUIRED_FROM_MANAGER'] = $request['isrequiredapprovalfrommanager'] == 1 ? "Yes" : "No";
			$requestTemp['IS_APPROVAL_REQUIRED_FROM_REQUESTER'] = $request['isrequiredapprovalfromrequester'] == 1 ? "Yes" : "No";
			$requestTemp['IS_APPROVAL_REQUIRED_FROM_ROBBAPPROVAL_REQUIREDY'] = $request['isrequiredapprovalfromrobby'] == 1 ? "Yes" : "No";
			$requestTemp['IS_COMPLETED'] = $request['iscompleted'] == 1 ? "Yes" : "No";
			$requestTemp['COMPLETED_DATE'] = $request['completeddate'];
			$requestTemp['CREATED_ON_DATE'] = $request['createdon'];
			foreach($allRequestSpecsArr as $key => $value){
				if($value['requesttypeseq'] == $request['requesttypeseq']){
					$requestSpecValue = "";
					if(isset($specJsonArr[$key])){
						if($value['fieldtype'] == 'yes_no'){
							$requestSpecValue = $specJsonArr[$key] == 1 ? "Yes" : "No";
						}else{
							$requestSpecValue = $specJsonArr[$key];
						}
					}
					 $specArr[preg_replace('/\s+/', '_',strtoupper($value['title']))] = $requestSpecValue;
				}
			}
			$keys = array_keys( $requestTemp );
			$index = array_search( 'PROJECT_TYPE', $keys );	
			$pos = false === $index ? count( $requestTemp ) : $index + 1;	
			$requestTemp = array_merge( array_slice( $requestTemp, 0, $pos ), $specArr, array_slice( $requestTemp, $pos ));

			if(!isset($dataForExport[$sheetName])){
				$dataForExport[$sheetName] = [];
			}
			$headers = implode(',',array_keys($requestTemp));
			$records = implode(',',array_values($requestTemp));
			if(count($dataForExport[$sheetName]) == 0){
				array_push($dataForExport[$sheetName],$fullSheetName);
			}
			if(count($dataForExport[$sheetName]) == 1){
				array_push($dataForExport[$sheetName],$headers);
			}
			array_push($dataForExport[$sheetName],$records);
		}
		return $dataForExport;
	}
	public function findByDepartmentsForRequestsDueInNextWeekForManager($departments,$userSeq){ // CronRequestDueDateInNextWeekOnFriday for manager
		$sql = self::$selectSqlForGrid . " WHERE (requests.department IN('". $departments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $userSeq . " AND requests.duedate > '" . date('Y-m-d') . "'";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function findByDepartmentsForRequestsPassedDueInLastWeekForManager($departments,$userSeq){ // CronRequestPassedDueDateInNextWeekOnFriday for manager
		$sql = self::$selectSqlForGrid . " WHERE (requests.department IN('". $departments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $userSeq . " AND requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function findRequestsDueInNextWeekForEmployee($userSeq){ // CronRequestDueDateInNextWeekOnFriday for Employee
		$sql = self::$selectSqlForGrid . " WHERE requests.assignedto = " . $userSeq . "  AND requests.duedate > '" . date('Y-m-d') . "' AND requests.duedate <= '".date('Y-m-d',strtotime('7 days'))."'";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function findRequestsPassedDueInNextWeekForEmployee($userSeq){ // CronRequestPassedDueDateInNextWeekOnFriday for Employee
		$sql = self::$selectSqlForGrid . " WHERE requests.assignedto = " . $userSeq . "  AND requests.duedate < '" . date("Y-m-d") . "' AND (requests.iscompleted = 0 OR requests.iscompleted IS NULL)";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function findRequestsAssigneeDueDateInNextWeekForEmployee($userSeq){ // CronRequestAssigneeDueDateInNextWeekOnFriday for Employee
		$sql = self::$selectSqlForGrid . " WHERE requests.assignedto = " . $userSeq . " AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."'";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function findRequestsAssigneeDueDateInNextWeekForManager($departments,$userSeq){ //CronRequestAssigneeDueDateInNextWeekOnFriday for Manager
		$sql = self::$selectSqlForGrid . " WHERE (requests.department IN('". $departments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $userSeq . " AND requests.assigneeduedate > '" . date("Y-m-d") . "' AND requests.assigneeduedate <= '".date('Y-m-d',strtotime('7 days'))."'";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function findRequestsAssigneeDueDatePassedInLastWeekForEmployee($userSeq){ // CronRequestAssigneeDueDateInLastWeekOnFriday for Employee
		$sql = self::$selectSqlForGrid . " WHERE requests.assignedto = " . $userSeq . " AND  requests.assigneeduedate < '" . date("Y-m-d") . "'";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function findRequestsAssigneeDueDatePassedInLastWeekForManager($departments,$userSeq){ // CronRequestAssigneeDueDateInLastWeekOnFriday for Manager
		$sql = self::$selectSqlForGrid . " WHERE (requests.department IN('". $departments ."') AND requests.assignedby IS NULL) OR requests.assignedby = " . $userSeq . " AND requests.assigneeduedate < '" . date("Y-m-d") . "'";
		$requests = self::$dataStore->executeQuery($sql,false,true);
		return $requests;
	}
	public function deleteBySeqs($ids) {
		$requestAttachmentMgr = RequestAttachmentMgr::getInstance();	
		$attachmentFileNames = $requestAttachmentMgr->getAttachmentFileNamesByRequestSeqs($ids);
		$flag = self::$dataStore->deleteInList ( $ids );
		if($flag){
			foreach($attachmentFileNames as $attachmentFileName ){
				unlink(StringConstants::REQUEST_ATTACHMENTS_PATH . $attachmentFileName['attachmentfilename']);
			}
		}
		return $flag;
	}
	public function getUsersByDepartmentForDD($users,$department){
		$arr = array();
		foreach($users as $user){
			$userDepartments = explode(',',$user['requestdepartments']);
			if(in_array($department,$userDepartments)){
				$arr[$user['seq']] = $user['fullname'];
			}
		}
		return $arr;
	}
}
?>