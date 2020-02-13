<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerOppurtunityBuy.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
class CustomerOppurtunityBuyMgr
{
    private static  $CustomerOppurtunityBuyMgr;
    private static $dataStore;
    
    public static function getInstance()
    {
        if (!self::$CustomerOppurtunityBuyMgr)
        {
            self::$CustomerOppurtunityBuyMgr = new CustomerOppurtunityBuyMgr();
            self::$dataStore = new BeanDataStore(CustomerOppurtunityBuy::$className, CustomerOppurtunityBuy::$tableName);
        }
        return self::$CustomerOppurtunityBuyMgr;
    }
    
    public function saveOppurtunityBuy($CustomerOppurtunityBuyMgr){
        $this->deleteByCustomerSeq($CustomerOppurtunityBuyMgr->getCustomerSeq());
        $id = self::$dataStore->save($CustomerOppurtunityBuyMgr);
        return $id;
    }
    
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from customeroppurtunitybuys where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    
    public function findByCustomerSeq($customerSeq){
        $condition = array("customerseq"=>$customerSeq);
        $customerOppurtunityBuys = self::$dataStore->executeConditionQuery($condition);
        if(!empty($customerOppurtunityBuys)){
            $customerOppurtunityBuys = $this->convertDateFormat($customerOppurtunityBuys[0]);
            return $customerOppurtunityBuys;
        }
        return null;
    }
    public function findArrByCustomerSeq($customerSeq){
    	$condition = array("customerseq"=>$customerSeq);
    	$customerOppurtunityBuys = self::$dataStore->executeConditionQueryForArray($condition);
    	return $customerOppurtunityBuys;
    }
    
    private function convertDateFormat($customerOppurtunityBuys){
        $fromFormat = "Y-m-d";
        $toFormat = "m-d-Y";
       
        $dateStr = $customerOppurtunityBuys->getCloseOutleftOverSinceDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerOppurtunityBuys->setCloseOutleftOverSinceDate($dateStr);
       
        return $customerOppurtunityBuys;
    }
}

