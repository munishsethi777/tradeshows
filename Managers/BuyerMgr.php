<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Buyer.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
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
    public function saveBuyer($buyer){
        $id = self::$dataStore->save($buyer);
        return $id;
    }
    public function saveBuyerObject($buyer,$conn){
        $id = self::$dataStore->saveObject($buyer,$conn);
        return $id;
    }
    
    public function getBuyersByCustomerSeq($customerSeq){
          $query = "select * from buyers where customerseq = $customerSeq";
          $buyers = self::$dataStore->executeQuery($query,false,true);
          return $buyers;
    }
    
    public function getBuyersObjectByCustomerSeq($customerSeq){
        $query = "select * from buyers where customerseq = $customerSeq";
        $buyers = self::$dataStore->executeObjectQuery($query,false);
        return $buyers;
    }
    
    public function findArrByCustomerSeq($customerSeq){
        $buyers = $this->getBuyersByCustomerSeq($customerSeq);
        $array = array();
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        foreach ($buyers as $buyer){
            $category = $buyer["category"];
            $category = BuyerCategoryType::getValue($category);
            $buyer["category"] = $category;
            $lastModifiedOn = $buyer["lastmodifiedon"];
            $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "m-d-Y h:i a",$loggedInUserTimeZone);
            $buyer["lastmodifiedon"] = $lastModifiedOn;
            array_push($array,$buyer);
        }
        return $array;
    }
    
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from buyers where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    
    public function deleteByBuyerSeq($buyerSeqs){
        $flag =  self::$dataStore->deleteInList($buyerSeqs);
        return $flag;
    }
    
    public function findBySeq($seq){
        $buyer = self::$dataStore->findBySeq($seq);
        return $buyer;
    }
    public function findArrBySeq($seq){
        $buyer = self::$dataStore->findArrayBySeq($seq);
        return $buyer;
    }
    
    public function updateBuyerImage($buyerSeq,$imageExtension_){
        $attr = array("imageextension" => $imageExtension_);
        $condition = array("seq" => $buyerSeq);
        self::$dataStore->updateByAttributesWithBindParams($attr,$condition);
    }
    
    //Mobile API
    public function getBuyerDetailBySeq($seq){
        $buyer = $this->findBySeq($seq);
        $keyValArr = array();
        $mainArr = array();
    
        $keyValArr["name"] = "ID";
        $keyValArr["value"] = $buyer->getSeq();
        array_push($mainArr,$keyValArr);
        
        $cellPhone = $buyer->getCellPhone();
        $keyValArr["name"] = "Cell Phone";
        $keyValArr["value"] = $cellPhone;
        array_push($mainArr,$keyValArr);
        
        $keyValArr["name"] = "Email Id";
        $keyValArr["value"] = $buyer->getEmail();
        array_push($mainArr,$keyValArr);
        
        $keyValArr["name"] = "Category";
        $category = $buyer->getCategory();
        if(!empty($category)){
            $category = BuyerCategoryType::getValue($buyer->getCategory());
        }
        $keyValArr["value"] = $category;
        array_push($mainArr,$keyValArr);
        
        $keyValArr["name"] = "Notes";
        $keyValArr["value"] = $buyer->getNotes();
        array_push($mainArr,$keyValArr);
        $name = $buyer->getFirstName();
        if(!empty($buyer->getLastName())){
            $name .= " " . $buyer->getLastName();
        }
        $response["buyername"] = $name;
        $response["buyerfirstname"] = $buyer->getFirstName();
        $response["buyerlastname"] = $buyer->getLastName();
        $response["buyercellphone"] = $cellPhone;
        $response["buyeremail"] = $buyer->getEmail();
        $response["buyerimage"] = $buyer->getImageExtension();
        $response["buyer"] = $mainArr;
        return $response;
    }
}
