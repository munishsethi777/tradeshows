<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerRepCommission.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");

class CustomerRepCommissionMgr{
	private static  $customerRepCommissionMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$customerRepCommissionMgr)
		{
			self::$customerRepCommissionMgr = new CustomerRepCommissionMgr();
			self::$dataStore = new BeanDataStore(CustomerRepCommission::$className, CustomerRepCommission::$tableName);
		}
		return self::$customerRepCommissionMgr;
	}
	  
    public function saveCustomerRepCommission($conn,$customerRepCommission){
    	$id = self::$dataStore->saveObject($customerRepCommission,$conn);
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
	public function getCommissionsByCustomerSeqAndCustomerRepSeq($customerSeq,$customRepSeqs){
		$sql = "SELECT * FROM customerrepcommissions WHERE customerseq = $customerSeq AND customerrepseq in ($customRepSeqs)";
		$customerRepCommissions = self::$dataStore->executeQuery($sql,false,true);
		return $customerRepCommissions;
	}
	public function saveFromCommissionsArray($conn,$customerSeq,$customerRepSeq,$commissionCategoryType,$commissionKeyValueArr){
		foreach($commissionKeyValueArr as $key => $value){
			$customerRepCommission = new CustomerRepCommission();
			$customerRepCommission->setCustomerSeq($customerSeq);
			$customerRepCommission->setCustomerRepSeq($customerRepSeq);
			$customerRepCommission->setCommissionCategory(CommissionCategoryTypes::getName($commissionCategoryType));
			$customerRepCommission->setCommissionType($key);
			$customerRepCommission->setCommissionValue($value);
			self::$dataStore->saveObject($customerRepCommission,$conn);
		}
	}
	public function deleteRepCummissionsByCustomerSeqWithConn($seq,$conn){
		$colValuePair = array();
        $colValuePair['customerseq'] = $seq;
		self::$dataStore->deleteByAttributeWithConn($conn,$colValuePair);
	}
}
