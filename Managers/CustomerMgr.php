<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/BuyerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Customer.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomerBusinessType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BusinessCategoryType.php");
include $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerRepAllotment.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomerPositionTypes.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomerRepTypes.php");

class CustomerMgr{
	private static  $customerMgr;
	private static $dataStore;
	private static $customerRepAllotmentDataStore;
	private $validationErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 17;
	private static $selectSqlForGrid = "SELECT customers.*,cr2.fullname insideaccountmanagername,cr3.fullname as salesadminleadname,cr4.fullname as chainstoresalesadminname,
										(SELECT COUNT(*) FROM customerspringquestions csq WHERE csq.customerseq = customers.seq) as springtotalquestionnaire, 
										(SELECT COUNT(*) FROM customerchristmasquestions ccq where ccq.customerseq = customers.seq) as christmastotalquestionnaire,
										(SELECT COUNT(*) FROM customerspringquestions csq WHERE csq.customerseq = customers.seq and csq.isquestionnairecompleted = 1) as springcompletedquestionnaire, 
										(SELECT COUNT(*) FROM customerchristmasquestions ccq where ccq.customerseq = customers.seq and ccq.isquestionnairecompleted = 1) as christmascompletedquestionnaire
										FROM customers 
										LEFT JOIN customerrepallotments on customerrepallotments.customerseq = customers.seq
										LEFT JOIN customerreps cr1 on cr1.seq = customerrepallotments.customerrepseq
										LEFT JOIN customerreps cr2 on cr2.seq = customers.insideaccountmanager
										LEFT JOIN customerreps cr3 on cr3.seq = customers.salesadminlead
										LEFT JOIN customerreps cr4 on cr4.seq = customers.chainstoresalesadmin";								
	private static $exportQuery = "SELECT customers.seq as customerseq,customers.customerid as customerid,customers.fullname as customerfullname,customers.businesstype as businesstype,customers.salespersonid as salespersonid,customers.salespersonname as salespersonname,customers.salespersonid2 as salespersonid2,customers.salespersonname2 as salespersonname2,customers.salespersonid3 as salespersonid3,customers.salespersonname3 as salespersonname3,customers.salespersonid4 as salespersonid4,customers.salespersonname4 as salespersonname4,customers.isstore as isstore,customers.storeid as storeid,customers.storename as storename,customers.priority as priority,customers.businesscategory as businesscategory,customers.customertype as customertype,customers.chainstoresalesadmin as chainstoresalesadmin,cr1.*,cr2.fullname insideaccountmanager,cr3.fullname as salesadminlead,customerrepallotments.notes,cr4.fullname as chainstoresalesadminname from customers 
									LEFT JOIN customerrepallotments on customerrepallotments.customerseq = customers.seq
									LEFT JOIN customerreps cr1 on cr1.seq = customerrepallotments.customerrepseq
									LEFT JOIN customerreps cr2 on cr2.seq = customers.insideaccountmanager
									LEFT JOIN customerreps cr3 on cr3.seq = customers.salesadminlead
									LEFT JOIN customerreps cr4 on cr4.seq = customers.chainstoresalesadmin";
	public static function getInstance()
	{
		if (!self::$customerMgr)
		{
			self::$customerMgr = new CustomerMgr();
			self::$dataStore = new BeanDataStore(Customer::$className, Customer::$tableName);
			self::$customerRepAllotmentDataStore = new BeanDataStore(CustomerRepAllotment::$className, CustomerRepAllotment::$tableName);
		}
		return self::$customerMgr;
	}
	  
    public function saveCustomer($conn,$customer){
    	$id = self::$dataStore->saveObject($customer,$conn);
    	return $id;
    }
    
    public function saveCustomerObject($customer,$isSaveBuyer = true){
        $id = self::$dataStore->save($customer);
        if(!empty($id) && $isSaveBuyer){
            //$buyer = BuyerMgr::getInstance();
            //$buyer->saveFromCustomer($id);
        }
        return $id;
    }
    public function saveCustomerRepAllotment($customerRepAllotment,$conn){
		$id = self::$customerRepAllotmentDataStore->saveObject($customerRepAllotment,$conn);
		return $id;
	}
	public function deleteCustomerRepAllotmentByAttribute($seq,$conn){
		$colValuePair = array();
        $colValuePair['customerseq'] = $seq;
		self::$customerRepAllotmentDataStore->deleteByAttributeWithConn($conn,$colValuePair);
	}
    public function updateOject($conn,$customer,$condition){
    	self::$dataStore->updateObject($customer, $condition, $conn);
    }
	
	public function importCustomers($file,$isUpdate,$updateIds){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheet = $objPHPExcel->getActiveSheet();
		$maxCell = $sheet->getHighestRowAndColumn();
		$sheetData = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
		return $this->validateAndSaveFile($sheetData,$isUpdate,$updateIds);
	}
	
	public function validateAndSaveFile($sheetData,$isUpdate,$updateIds){
		$message = "";
		$this->fieldNames = $sheetData[0];
		$mainJson = array();
		$json = array();
		$mainJson["success"] = 1;
		$mainJson["messages"] = "";
		$success = 10;
		$messages = "";
		$customerIdAlreadyExists = 0;
		$customerArr = array();
		//if(self::$FIELD_COUNT == count($this->fieldNames)){
			foreach ($sheetData as $key=>$data){
				if($key == 0){
					continue;
				}
				if(!array_filter($data)) {
					continue;	
				}
				$customer = $this->getCustomerObj($data);
				array_push($customerArr, $customer);
				
				if(!empty($this->validationErrors)){
					$messages .= "<b>Row $key has following validation Errors </b><p>" . $this->validationErrors . "</p>";
					$success = 0;
				}
			}
		//}else{
		    //$messages .= StringConstants::IMPORT_CORRECT_FILE;
			//$success = 0;
		//}
		$response = array();
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["customerIdAlreadyExists"] = $customerIdAlreadyExists;
		if(empty($messages)){
			$response = $this->saveArr($customerArr, $isUpdate,$updateIds);
		}
		return $response;
	}
	
	private function saveArr($customerArr,$isUpdate,$updateIds){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$customerIdAlreadyExists = 0;
		$savedCustomerCount = 0;
		$success = 1;
		$exstingCustomerIds = array();
		
		foreach ($customerArr as $customerAndBuyers){
		    $customer = $customerAndBuyers["customer"];
		    $buyers = $customerAndBuyers["buyers"];
		    $id = $customer->getSeq();
			$customerId = $customer->getCustomerId();
			$flag = false;
			try {
				if(!$isUpdate){
				    $id = $this->saveCustomer($conn, $customer);
					$savedCustomerCount++;
					$flag = true;
				}else{
					if(in_array($customerId, $updateIds)){
						$condition["customerid"] = $customer->getCustomerId();
						$condition["storeid"] = $customer->getStoreId();
						$this->updateOject($conn, $customer, $condition);
						$id = $this->findSeqByCustomerId($customer->getCustomerId());
						$flag = true;
					}
				}
				if(!empty($buyers) && $flag){
				   $buyerMgr = BuyerMgr::getInstance();
				    try{
				        $buyerMgr->deleteByCustomerSeq($id);
				        foreach ($buyers as $buyer){
				            $buyer->setCustomerSeq($id);
				            $buyerMgr->saveBuyerObject($buyer,$conn);
				        }
				    }catch (Exception $e){
				        $messages .= $e->getMessage() . " for customer id $customerId";
				    }
				}
			}
			catch ( Exception $e) {
			    $trace = $e->getTrace();
			    if($trace[0]["args"][0][1] == "1062"){
			        $customerIdAlreadyExists++;
			        array_push($exstingCustomerIds, $customerId);
			    }else{
			        $messages .= $e->getMessage();
			    }
			    $hasError = true;
			    $success = 0;
			}
		}
		$conn->commit();
		if(!$hasError){
		    $messages = StringConstants::CUSTOMER_IMPORTED_SUCCESSFULLY;
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["customerIdAlreadyExists"] = $customerIdAlreadyExists;
		$response["savedCustomersCount"] = $savedCustomerCount;
		$response["existingCustomerIds"] = $exstingCustomerIds;
		return $response;
	}
	
	private function validateNumeric($val,$fieldName){
		$message = "";
		$val = str_replace(",", "", $val);
		if(!is_numeric($val)){
			$message = "  - '$fieldName' should be numeric a value!<br>";
		}
		return $message;
	}
	
	public function exportCustomers($queryString){
	    $output = array();
	    parse_str($queryString, $output);
	    $_GET = array_merge($_GET,$output);
	    $query = self::$exportQuery;
	    $customers = self::$dataStore->executeQuery($query,true,true);
	    $customers = $this->group_by($customers);
	    ExportUtil::exportCustomers($customers);
	}
	
	function group_by($array) {
		$customers = [];
	    foreach($array as $val) {
			if(!isset($customers[$val["customerseq"]])){
				$customers[$val["customerseq"]]["customerseq"] = $val['customerseq'];
				$customers[$val["customerseq"]]['customerid'] = $val['customerid']; 
				$customers[$val["customerseq"]]['storeid'] = $val['storeid'];
				$customers[$val["customerseq"]]['insideaccountmanager'] = $val['insideaccountmanager'];
				$customers[$val["customerseq"]]['salesadminlead'] = $val['salesadminlead'];
				$customers[$val["customerseq"]]['customerfullname'] = $val['customerfullname'];  
				$customers[$val["customerseq"]]['businesstype'] = $val['businesstype'];
				$customers[$val["customerseq"]]['salespersonid'] = $val['salespersonid'];
				$customers[$val["customerseq"]]['salespersonname'] = $val['salespersonname'];
				$customers[$val["customerseq"]]['salespersonid2'] = $val['salespersonid2'];
				$customers[$val["customerseq"]]['salespersonname2'] = $val['salespersonname2'];
				$customers[$val["customerseq"]]['salespersonid3'] = $val['salespersonid3'];
				$customers[$val["customerseq"]]['salespersonname3'] = $val['salespersonname3'];
				$customers[$val["customerseq"]]['salespersonid4'] = $val['salespersonid4'];
				$customers[$val["customerseq"]]['salespersonname4'] = $val['salespersonname4'];
				$customers[$val["customerseq"]]['isstore'] = $val['isstore'];
				$customers[$val["customerseq"]]['storename'] = $val['storename'];
				$customers[$val["customerseq"]]['priority'] = $val['priority'];
				$customers[$val["customerseq"]]['customertype'] = $val['customertype'];
				$customers[$val["customerseq"]]['chainstoresalesadminname'] = $val['chainstoresalesadminname'];
			}
			
			$customerrep = array();
			if(!isset($customers[$val['customerseq']]['customerreps'])){
				$customers[$val['customerseq']]['customerreps'] = array();
			}
			if(isset($val['fullname'])){
				$customerrep['fullname'] = $val['fullname'];
				$customerrep['email'] = $val['email'];
				$customerrep['ext'] = $val['ext'];
				$customerrep['cellphone'] = $val['cellphone'];
				$customerrep['position'] = $val['position'];
				$customerrep['category'] = BuyerCategoryType::getValue($val['category']);
				$customerrep['notes'] = $val['notes'];
				array_push($customers[$val['customerseq']]['customerreps'],$customerrep);
			}
	    }
	    return $customers;
	}
	
	private function getCustomerObj($data){
		$customer = new Customer();
		$customerId = $data[0];
		if(strlen($customerId) < 6){
	        throw new Exception("Customer id should not be less than 6 digits!");
		}
		$storeId = $data[1];
		$name = $data[2];
		$storeName = $data[3];
		$priority = $data[4];
		
		$salesPersonId = $data[5];
		$salesPersonName = $data[6];
		$businessType = $data[7];
		$businessCategoryType = $data[8];
		if(count($data) > 10){
    		$buyerData = $data;
    		$buyerData = array_slice($buyerData, 10); 
    		$buyerFieldCount = count($buyerData);
    		if ($buyerFieldCount % 7 == 0) {
    		    $sessionUtil = SessionUtil::getInstance();
    		    $createBy = $sessionUtil->getUserLoggedInSeq();
    		    $index = 0;
    		    $buyers = array();
    		    $buyerCount = $buyerFieldCount / 7;
    		    for($i=0;$i<$buyerCount;$i++){
    		        $buyer = new Buyer();
    		        $firstName = $buyerData[$index++];
    		        if(empty($firstName)){
    		            continue;
    		        }
    		        $buyer->setFirstName($firstName);
    		        $buyer->setLastName($buyerData[$index++]);
    		        $buyer->setEmail($buyerData[$index++]);
    		        $buyer->setOfficePhone($buyerData[$index++]);
    		        $buyer->setCellPhone($buyerData[$index++]);
    		        $category = $buyerData[$index++];
    		        $category = BuyerCategoryType::getName($category);
    		        $buyer->setCategory($category);
    		        $buyer->setNotes($buyerData[$index++]);
    		        $buyer->setCreatedBy($createBy);
            		$buyer->setCreatedOn(new DateTime());
            		$buyer->setLastModifiedOn(new DateTime());
            		array_push($buyers,$buyer);
    		    }
    		}else{
    		    throw new Exception("Missing Buyer's Fields.Pls chek the sample file.");
    		}
		}
		$message = "";
		if(!empty($customerId)){
			//$message .= $this->validateNumeric($customerId, $this->fieldNames[0]);
			$customer->setCustomerId($customerId);
		}else{
			$message .= "- " . $this->fieldNames[0]." is required!";
		}
		if(!empty($name)){
			$customer->setFullName($name);
		}
		if(!empty($salesPersonId)){
		    $customer->setSalesPersonId($salesPersonId);
		}
		if(!empty($salesPersonName)){
		    $customer->setSalesPersonName($salesPersonName);
		}
		$customer->setCreatedOn(new DateTime());
		$customer->setLastModifiedOn(new DateTime());
		$sessionUtil = SessionUtil::getInstance();
		$createBy = $sessionUtil->getUserLoggedInSeq();
		$customer->setCreatedBy($createBy);
		if(!empty($storeId)){
		    $customer->setStoreName($storeName);
		    $customer->setIsStore(1);
		}else{
		    $storeId = "";
		}
		$customer->setStoreId($storeId);
		if(empty($priority)){
		    $priority = "B";
		}
		$customer->setPriority($priority);
		if(!empty($businessType)){
		    $businessType = CustomerBusinessType::getName($businessType);
		}
		if(!empty($businessCategoryType)){
		    $businessCategoryType = BusinessCategoryType::getName($businessCategoryType);
		}
		$customer->setBusinessType($businessType);
		$customer->setBusinessCategory($businessCategoryType);
		$customerAndBuyers = array();
		$customerAndBuyers["customer"] = $customer;
 		$customerAndBuyers["buyers"] = $buyers;
		$this->validationErrors = $message;
		return $customerAndBuyers;
	}
	
	public function getCustomersForGrid(){
		$query = self::$selectSqlForGrid . " group by customers.seq";
		$customers = self::$dataStore->executeQuery($query,true,true);
		$row = array();
		foreach($customers as $customer){	
			$customer['questionnaireprogress'] = ($customer['springcompletedquestionnaire'] + $customer['christmascompletedquestionnaire']). "/" .($customer['springtotalquestionnaire'] + $customer['christmastotalquestionnaire']);
			array_push($row,$customer);
		}
		$mainArr["Rows"] = $row;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	public function getCompletedQuestionnaireFormCounts($customerSeqsString){
		$query = "SELECT COUNT(seq) from customerspringquestions WHERE customerseq in ($customerSeqsString) AND";
		return self::$dataStore->executeQuery();
	}
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$query = self::$selectSqlForGrid;
		$customerArr = self::$dataStore->executeQuery($query,$isApplyFilter,true);
		$sessoinUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessoinUtil->getUserLoggedInTimeZone();
		$mainArr = array();
		foreach ($customerArr as $customer){
			$businessType = CustomerBusinessType::getValue($customer["businesstype"]);
			$customerType = BusinessCategoryType::getValue($customer["customertype"]);
			$customer["customertype"] = $customerType;
		    $customer["businesstype"] = $businessType;
		    $lastModifiedOn = $customer["lastmodifiedon"];
		    $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
		    $customer["lastmodifiedon"] = $lastModifiedOn;
		    $businessCategory = BusinessCategoryType::getValue($customer["businesscategory"]);
		    $customer["businesscategory"] = $businessCategory;
		    array_push($mainArr,$customer);
		}
		return $mainArr;
	}
	
	public function findSeqByCustomerId($customerId){
		$condition["customerid"] = $customerId;
		$attr[0] = "seq";
		$customer = self::$dataStore->executeAttributeQuery($attr, $condition);
		if(!empty($customer)){
			return $customer[0]["seq"];
		}
		return 0;
	}
	
	public function findBySeq($seq){
		$customer = self::$dataStore->findArrayBySeq($seq);
		$sessoinUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessoinUtil->getUserLoggedInTimeZone();
		$createdon = $customer["createdon"];
		$createdon = DateUtil::convertDateToFormatWithTimeZone($createdon, "Y-m-d H:i:s", "m-d-Y h:i a",$loggedInUserTimeZone);
		$customer["createdon"] = $createdon;
		$businessType = CustomerBusinessType::getValue($customer["businesstype"]);
		$customer["businesstype"] = $businessType;
		$businessCategory = BusinessCategoryType::getValue($customer["businesscategory"]);
		$customer["businesscategory"] = $businessCategory;
		$customerType = BusinessCategoryType::getValue($customer["customertype"]);
		$customer["customertype"] = $customerType;
		return $customer;
	}
	
	public function findArrBySeq($customerSeq){
	    $customers = self::$dataStore->findArrayBySeq($customerSeq);
	    return $customers;
	}
	
	public function findByCustomerSeq($seq){
	    $customer = self::$dataStore->findBySeq($seq);
	    return $customer;
	}
	function getCustomerBuyerObjects($customerSeq){
	    $buyerMgr = BuyerMgr::getInstance();
	    $buyers = $buyerMgr->getBuyersObjectByCustomerSeq($customerSeq);
	    return $buyers;
	}
	
	function getCustomerBuyerCategories($selected){
	    $ddhtml = DropDownUtils::getBuyerCategories("category[]", "", $selected, false,true);
	    return $ddhtml;
	}
	function getCustomerSellerResponsibilitiesType($selected){
	    $ddhtml = DropDownUtils::getSellerResponsibilitiesType("responsibility[]","", $selected, false);
	    return $ddhtml;
	}
	
	public function searchCustomers($searchString){
		$sql = "select customername from graphicslogs";
		if($searchString != null){
			$sql .= " where customername like '". $searchString ."%' group by customername";
		}
		$users =   self::$dataStore->executeQuery($sql);
		return $users;
	}
	
	public function getCustomerIdBySeq($seq){
	    $sql = "select customerid from customers where seq = $seq";
	    $users =   self::$dataStore->executeQuery($sql);
	    if(!empty($users)){
	        return $users[0][0];
	    }
	    return null;
	}
	
	public function searchCustomer($searchString){
	    $sql = "select customers.* from customers";
	    if($searchString != null){
	        $sql .= " where fullname like '". $searchString ."%' ";
	    }
	    $customers =   self::$dataStore->executeQuery($sql);
	    return $customers;
	}
	
	public function deleteByCustomerSeq($customerSeqs){
	   $flag =  self::$dataStore->deleteInList($customerSeqs);
	   if($flag){
	       $buyerMgr = BuyerMgr::getInstance();
	       $buyerMgr->deleteByCustomerSeq($customerSeqs);
	   }
	}
	public function updateByCustomerByid($customer){
	    $condition = array("customerid" => $customer->getCustomerId(),"storeid" => $customer->getStoreId());
	    $colVal = array("fullname" => $customer->getFullName(),
	        "salespersonname" => $customer->getSalesPersonName(), 
	        "salespersonid" => $customer->getSalesPersonID(),
	        "storename" => $customer->getStoreName(),
	        "priority" => $customer->getPriority(),
	        "businesstype" => $customer->getBusinessType()
	    );
	    self::$dataStore->updateByAttributesWithBindParams($colVal,$condition);
	    $customerSeq = $this->findSeqByCustomerId($customer->getCustomerId());
	    return $customerSeq;
	}
	
	public function getAllCustomerNames(){
	    $customers = self::$dataStore->findAll();
	    $customerArr = array();
	    if(!empty($customers)){
    	    foreach ($customers as $customer){
    	        $arr = array();
    	        $arr["seq"] = $customer->getSeq();
    	        $customerName = $customer->getFullName();
    	        $storeName = $customer->getStoreName();
    	        if(!empty($storeName)){
    	            $customerName .= " - " . $storeName;
    	        }
    	        $arr["fullname"] = $customerName;
    	        array_push($customerArr,$arr);
    	    }
	    }
	    return $customerArr;
	}
	
// 	public function getCustomerDetailBySeq($customerSeq){
// 	    $customer = $this->findByCustomerSeq($customerSeq);
// 	    $customerArr = array();
// 	    $customerArr["ID"] = $customer->getSeq();
// 	    $businessType = $customer->getBusinessType();
// 	    if(!empty($businessType)){
// 	        $businessType = CustomerBusinessType::getValue($businessType);
// 	    }
// 	    $customerArr["BusinessType"] = $businessType;
// 	    $customerArr["Sales Person"] = $customer->getSalesPersonName();
// 	    $customerArr["Sales Person ID"] = $customer->getSalesPersonId();
// 	    $lastModifiedOn = $customer->getLastModifiedOn();
// 	    if(!empty($lastModifiedOn)){
// 	        $lastModifiedOn = DateUtil::convertDateToFormat($lastModifiedOn, DateUtil::$DB_FORMAT_WITH_TIME, "jS F Y");
// 	    }
// 	    $customerArr["Last Modified On"] = $lastModifiedOn;
// 	    return $customerArr;
// 	}
	
	public function getCustomerDetailBySeq($customerSeq){
	    $customer = $this->findByCustomerSeq($customerSeq);
	    $keyValArr = array();
	    $mainArr = array();
	    $keyValArr["name"] = "ID";
	    $keyValArr["value"] = $customer->getCustomerId();
	    array_push($mainArr,$keyValArr);
	    
	    $businessType = $customer->getBusinessType();
	    if(!empty($businessType)){
	        $businessType = CustomerBusinessType::getValue($businessType);
	    }
	    $keyValArr["name"] = "BusinessType";
	    $keyValArr["value"] = $businessType;
	    array_push($mainArr,$keyValArr);
	    
	    $keyValArr["name"] = "Sales Person";
	    $keyValArr["value"] = $customer->getSalesPersonName();
	    array_push($mainArr,$keyValArr);
	   
	    $lastModifiedOn = $customer->getLastModifiedOn();
	    if(!empty($lastModifiedOn)){
	        $lastModifiedOn = DateUtil::convertDateToFormat($lastModifiedOn, DateUtil::$DB_FORMAT_WITH_TIME, "jS F Y");
	    }
	    $keyValArr["name"] = "Sales Person ID";
	    $keyValArr["value"] = $customer->getSalesPersonId();
	    array_push($mainArr,$keyValArr);
	    
	    $keyValArr["name"] = "Last Modified On";
	    $keyValArr["value"] = $lastModifiedOn;
	    array_push($mainArr,$keyValArr);
	    $response = array();
	    $response["customername"] = $customer->getFullName();
	    $response["storename"] = $customer->getStoreName();
	    $response["customerDetail"] = $mainArr;
	    $response["buyers"] = $this->getBuyersJson($customerSeq);
	    return $response;
	}
	public function getCustomerDetailsWithBuyers($customerSeq){
	    $response = array();
	    $response["customer"] = $this->findArrBySeq($customerSeq);
	    $response["buyers"] = $this->getBuyersJson($customerSeq);
	    return $response;
	}
	private function getBuyersJson($customerSeq){
	    $buyers = $this->getCustomerBuyerObjects($customerSeq);
	    $keyValArr = array();
	    $mainArr = array();
	    foreach ($buyers as $buyer){
	        $keyValArr["id"] = $buyer->getSeq();
	        $name = $buyer->getFirstName();
	        if(!empty($buyer->getLastName())){
	            $name .= " " . $buyer->getLastName();
	        }
	        $keyValArr["value"] = $name;
	        array_push($mainArr,$keyValArr);
	    }
	    return $mainArr;
	}
	public function getCustomerArrayBySeq($seq){
		$query = self::$selectSqlForGrid . " WHERE customers.seq=".$seq;
		$customer = self::$dataStore->executeQuery($query,false,true);
		return $customer[0];
	}
	public function searchCustomerRep($searchString,$customerRepType){
		$sql = "SELECT customerreps.*,seniorrephandlingaccount.fullname as seniorrephandlingaccountname,salesadminassigned.fullname as salesadminassignedname from customerreps 
				LEFT JOIN customerreps seniorrephandlingaccount on seniorrephandlingaccount.seq = customerreps.seniorrephandlingaccount
				LEFT JOIN customerreps salesadminassigned on salesadminassigned.seq = customerreps.salesadminassigned";
		if($searchString != null){
			$sql .= " WHERE customerreps.fullname like '%". $searchString ."%'";
		}
		if($customerRepType != null){
			if(strpos($sql,"WHERE") == false){
				$sql .= " WHERE";
			}else{
				$sql .= " AND";
			}
			$sql .= " customerreps.customerreptype='" . $customerRepType ."'";
		}
		$users =   self::$dataStore->executeQuery($sql,false,true);
		return $users;
	}
	public function getCustomerRepAllotmentByCustomerSeq($seq){
		$query = "SELECT customerrepallotments.notes,customerrepallotments.customerrepseq,customerrepallotments.seq as customerrepallotmentseq,customerreps.*,seniorrephandlingaccount.fullname as seniorrephandlingaccountname,salesadminassigned.fullname as salesadminassignedname from customerrepallotments
				LEFT JOIN customerreps on customerreps.seq = customerrepallotments.customerrepseq
				LEFT JOIN customerreps seniorrephandlingaccount on seniorrephandlingaccount.seq = customerreps.seniorrephandlingaccount
				LEFT JOIN customerreps salesadminassigned on salesadminassigned.seq = customerreps.salesadminassigned
				WHERE customerseq = " . $seq;
		$tempCustomerReps = self::$customerRepAllotmentDataStore->executeQuery($query,false,true);
		$customerReps = array();
		if(!empty($tempCustomerReps)){
			foreach($tempCustomerReps as $customerRep){
				$customerRep['category_key'] = $customerRep['category'];
				$customerRep['position_key'] = $customerRep['position'];
				$customerRep['position'] = CustomerPositionTypes::getValue($customerRep['position']);
				$customerRep['category'] = BuyerCategoryType::getValue($customerRep['category']);
				$customerRep['reptype'] = CustomerRepTypes::getValue($customerRep['customerreptype']);
				$customerRep['isreceivesmonthlysalesreport'] = $customerRep['isreceivesmonthlysalesreport'] == '1' ? 'Yes' : "No";
				array_push($customerReps,$customerRep);
			}
		}
		return $customerReps;
	}
}
