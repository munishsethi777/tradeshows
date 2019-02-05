<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Customer.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
include $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
class CustomerMgr{
	
	private static  $customerMgr;
	private static $dataStore;
	private $validationErrors;
	private $fieldNames;
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
    	self::$dataStore->saveObject($customer, $conn);
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
		foreach ($sheetData as $key=>$data){
			if($key == 0){
				continue;
			}
			$customer = $this->getCustomerObj($data);
			array_push($customerArr, $customer);
			if(!empty($this->validationErrors)){
				$messages .= "<b>Row $key+1 has following validation Errors </b><p>" . $this->validationErrors . "</p>";
				$success = 0;
			}
		}
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
		$success = 1;
		$exstingCustomerIds = array();
		foreach ($customerArr as $customer){
			$customerId = $customer->getCustomerId();
			try {
				if(!$isUpdate){
					$this->saveCustomer($conn, $customer);
				}else{
					if(in_array($customerId, $updateIds)){
						$condition["customerid"] = $customer->getCustomerId();
						$this->updateOject($conn, $customer, $condition);
					}else{
						$this->saveCustomer($conn, $customer);
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
		if(!$hasError){
			$messages = "Customers Imported Successfully!";
			$conn->commit();
		}else{
			$conn->rollback();
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["customerIdAlreadyExists"] = $customerIdAlreadyExists;
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
	
	private function getCustomerObj($data){
		$customer = new Customer();
		$customerId = $data[0];
		$name = $data[1];
		$phone = $data[2];
		$address = $data[3];
		$address1 = $data[4];
		$city = $data[5];
		$st = $data[6];
		$zip = $data[7];
		$email = $data[8];
		$attention = $data[9];
		$fax = $data[10];
		$terms = $data[11];
		$sales1 = $data[12];
		$sales2 = $data[13];
		$sales3 = $data[14];
		$sales4 = $data[15];
		$createdDate = $data[16];
		
		$message = "";
		if(!empty($customerId)){
			$message .= $this->validateNumeric($customerId, $this->fieldNames[0]);
			$customer->setCustomerId($customerId);
		}else{
			$message .= "- " . $this->fieldNames[0]." is required!";
		}
		if(!empty($name)){
			$customer->setCustomerName($name);
		}
		if(!empty($phone)){
			$customer->setPhone($phone);
		}
		if(!empty($address)){
			$customer->setAddress($address);
		}
		if(!empty($address1)){
			$customer->setAddress1($address1);
		}
		if(!empty($city)){
			$customer->setCity($city);
		}
		if(!empty($st)){
			$customer->setState($st);
		}
		if(!empty($zip)){
			$customer->setZip($zip);
		}
		if(!empty($email)){
			$customer->setEmail($email);
		}
		if(!empty($attention)){
			$customer->setAttention($attention);
		}
		if(!empty($fax)){
			$customer->setFax($fax);
		}
		if(!empty($terms)){
			$customer->setTerms($terms);
		}
		if(!empty($sales1)){
			$customer->setSales1($sales1);
		}
		if(!empty($sales2)){
			$customer->setSales2($sales2);
		}
		if(!empty($sales3)){
			$customer->setSales3($sales3);
		}
		if(!empty($sales4)){
			$customer->setSales4($sales4);
		}
		if(!empty($createdDate)){
			$createDateStr = PHPExcel_Shared_Date::ExcelToPHP($createdDate);
			$date = new DateTime();
			$date->setTimestamp($createDateStr);
			$customer->setCreateDate($date);
		}
		$customer->setCreatedOn(new DateTime());
		$customer->setLastModifiedOn(new DateTime());
		$this->validationErrors = $message;
		return $customer;
	}
	
	
	 
}
