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
include $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';

class CustomerMgr{
	
	private static  $customerMgr;
	private static $dataStore;
	private $validationErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 17;
	public static function getInstance()
	{
		if (!self::$customerMgr)
		{
			self::$customerMgr = new CustomerMgr();
			self::$dataStore = new BeanDataStore(Customer::$className, Customer::$tableName);
		}
		return self::$customerMgr;
	}
	  
    public function saveCustomer($conn,$customer){
    	$id = self::$dataStore->saveObject($customer, $conn);
    	return $id;
    }
    
    public function saveCustomerObject($customer){
        $id = self::$dataStore->save($customer);
        if(!empty($id)){
            $buyer = BuyerMgr::getInstance();
            $buyer->saveFromCustomer($id);
        }
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
			try {
				if(!$isUpdate){
				    $id = $this->saveCustomer($conn, $customer);
					$savedCustomerCount++;
				}else{
					if(in_array($customerId, $updateIds)){
						$condition["customerid"] = $customer->getCustomerId();
						$this->updateOject($conn, $customer, $condition);
					}
				}
			}
			catch ( Exception $e) {
				$trace = $e->getTrace();
				if($trace[0]["args"][0][1] == "1062"){
					//$customerIdAlreadyExists++;
					array_push($exstingCustomerIds, $customerId);
					$id = $this->updateByCustomerByid($customer);
					$savedCustomerCount++;
				}else{
					$messages .= $e->getMessage() . " for customer id $customerId";
					$hasError = true;
					$success = 0;
				}
				
			}
			if(!empty($buyers)){
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
	
	public function exportCustomers(){
		$customers = self::$dataStore->findAll();
		ExportUtil::exportCustomers($customers);
	}
	
	private function getCustomerObj($data){
		$customer = new Customer();
		$name = $data[0];
		$customerId = $data[1];
		$salesPersonId = $data[2];
		$salesPersonName = $data[3];
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
		$customerAndBuyers = array();
		$customerAndBuyers["customer"] = $customer;
		
		$firstName = preg_replace('!\s+!', ' ', $data[4]);
		$emailId = $data[6];
		$officePhone = $data[7];
		$buyers = array();
		if(!empty($firstName) || !empty($emailId) || !empty($officePhone)){
    		$buyer1 = new Buyer();
    		$buyer1->setFirstName($firstName);
    		$buyer1->setEmail($emailId);
    		$buyer1->setOfficePhone($officePhone);
    		$buyer1->setCreatedBy($createBy);
    		$buyer1->setCreatedOn(new DateTime());
    		$buyer1->setLastModifiedOn(new DateTime());
    		array_push($buyers,$buyer1);
		}
		$firstName =  preg_replace('!\s+!', ' ', $data[8]);
		$emailId = $data[9];
		$officePhone = $data[10];
		if(!empty($firstName) || !empty($emailId) || !empty($officePhone)){
    		$buyer2 = new Buyer();
    		$buyer2->setFirstName($firstName);
    		$buyer2->setEmail($emailId);
    		$buyer2->setOfficePhone($officePhone);
    		$buyer2->setCreatedBy($createBy);
    		$buyer2->setCreatedOn(new DateTime());
    		$buyer2->setLastModifiedOn(new DateTime());
    		array_push($buyers,$buyer2);
		}
		
		$customerAndBuyers["buyers"] = $buyers;
		$this->validationErrors = $message;
		return $customerAndBuyers;
	}
	
	public function getCustomersForGrid(){
		$customers = $this->findAllArr(true);
		$mainArr["Rows"] = $customers;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$customerArr = self::$dataStore->findAllArr($isApplyFilter);
		$sessoinUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessoinUtil->getUserLoggedInTimeZone();
		$mainArr = array();
		foreach ($customerArr as $customer){
		    $businessType = CustomerBusinessType::getValue($customer["businesstype"]);
		    $customer["businesstype"] = $businessType;
		    $lastModifiedOn = $customer["lastmodifiedon"];
		    $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
		    $customer["lastmodifiedon"] = $lastModifiedOn;
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
		return $customer;
	}
	
	public function findByCustomerSeq($seq){
	    $customer = self::$dataStore->findBySeq($seq);
	    return $customer;
	}
	
	function getCustomerBuyers($customerSeq){
	    $buyerMgr = BuyerMgr::getInstance();
	    $buyers = $buyerMgr->getBuyersByCustomerSeq($customerSeq);
	    return $buyers;
	}
	
	function getCustomerBuyerCategories($selected){
	    $ddhtml = DropDownUtils::getBuyerCategories("category[]", "", $selected, false);
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
	    $condition = array("customerid" => $customer->getCustomerId());
	    $colVal = array("fullname" => $customer->getFullName(),
	        "salespersonname" => $customer->getSalesPersonName(), 
	        "salespersonid" => $customer->getSalesPersonID());
	    self::$dataStore->updateByAttributesWithBindParams($colVal,$condition);
	    $customerSeq = $this->findSeqByCustomerId($customer->getCustomerId());
	    return $customerSeq;
	}
	
}
