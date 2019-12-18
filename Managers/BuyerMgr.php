<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Buyer.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
class BuyerMgr{
    
    private static  $buyerMgr;
    private static $dataStore;
    public static function getInstance()
    {
        if (!self::$buyerMgr)
        {
            self::$buyerMgr = new BuyerMgr();
            self::$dataStore = new BeanDataStore(Buyer::$className, Buyer::$tableName);
        }
        return self::$buyerMgr;
    }
    
    public function saveFromCustomer($customerSeq){
        $this->deleteByCustomerSeq($customerSeq);
        $sessionUtil = SessionUtil::getInstance();
        $firstNames = $_REQUEST["firstname"];
        $lastNames = $_REQUEST["lastname"];
        $emails = $_REQUEST["emailid"];
        $officePhones = $_REQUEST["phone"];
        $cellPhones = $_REQUEST["cellphone"];
        $notes = $_REQUEST["notes"];
        $categories = $_REQUEST["category"];
        foreach ($firstNames as $key=>$firstName){
            $buyer = new Buyer();
            $buyer->setCustomerSeq($customerSeq);
            $buyer->setCreatedby($sessionUtil->getUserLoggedInSeq());
            $buyer->setCreatedon(new DateTime());
            $buyer->setCellPhone($cellPhones[$key]);
            $buyer->setEmail($emails[$key]);
            $buyer->setFirstName($firstName);
            $buyer->setLastName($lastNames[$key]);
            $buyer->setNotes($notes[$key]);
            $buyer->setLastModifiedOn(new DateTime());
            $buyer->setOfficePhone($officePhones[$key]);
            $buyer->setCategory($categories[$key]);
            $id = self::$dataStore->save($buyer);
        }
    }
    
    public function getBuyersByCustomerSeq($customerSeq){
          $query = "select * from buyers where customerseq = $customerSeq";
          $buyers = self::$dataStore->executeQuery($query,false,true);
          return $buyers;
    }
    
    public function findArrByCustomerSeq($customerSeq){
        $buyers = $this->getBuyersByCustomerSeq($customerSeq);
        $array = array();
        foreach ($buyers as $buyer){
            $category = $buyer["category"];
            $category = BuyerCategoryType::getValue($category);
            $buyer["category"] = $category;
            array_push($array,$buyer);
        }
        return $array;
    }
    
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from buyers where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
}
