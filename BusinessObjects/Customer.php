<?php
class Customer{
    private $seq,$fullname,$customerid,$businesstype,$salespersonname,$salespersonid,$createdby,$createdon,$lastmodifiedon;
    public static $className = "Customer";
    public static $tableName = "customers";
    public function setSeq($seq_){
        $this->seq = $seq_;
    }
    public function getSeq(){
        return $this->seq;
    }
    
    public function setFullName($customerName_){
        $this->fullname = $customerName_;
    }
    public function getFullName(){
        return $this->fullname;
    }
    
    public function setCustomerId($customerId_){
        $this->customerid = $customerId_;
    }
    public function getCustomerId(){
        return $this->customerid;
    }
    
    public function setBusinessType($businessType_){
        $this->businesstype = $businessType_;
    }
    public function getBusinessType(){
        return $this->businesstype;
    }
    
    public function setSalesPersonName($salesPersonName_){
        $this->salespersonname = $salesPersonName_;
    }
    public function getSalesPersonName() {
        return $this->salespersonname;
    }
    
    public function setSalesPersonId($salesPersonId_){
        $this->salespersonid = $salesPersonId_;
    }
    public function getSalesPersonId(){
        return $this->salespersonid;
    }
    public function setCreatedBy($createdBy_){
        $this->createdby = $createdBy_;
    }
    public function getCreatedBy(){
        return $this->createdby;
    }
    
    public function setCreatedOn($createdOn_){
        $this->createdon = $createdOn_;
    }
    public function getCreatedOn(){
        return $this->createdon;
    }
    
    public function setLastModifiedOn($lastModifiedOn_){
        $this->lastmodifiedon = $lastModifiedOn_;
    }
    public function getLastModifiedOn(){
        return $this->lastmodifiedon;
    }
    
    public function from_array($array) {
        foreach ( get_object_vars ( $this ) as $attrName => $attrValue ) {
            $flag = property_exists ( self::$className, $attrName );
            $isExists = array_key_exists ( $attrName, $array );
            if ($flag && $isExists) {
                $datePos = strpos ( strtolower ( $attrName ), 'date' );
                $dateTimePos = strpos ( strtolower ( $attrName ), 'datetime' );
                $isBoolean = substr($attrName, 0,2) == "is" ? true : false;
                
                $value = $array [$attrName];
                if ($datePos !== false && ! empty ( $array [$attrName] )) {
                    $value = DateUtil::StringToDateByGivenFormat ( "m-d-Y", $array [$attrName] );
                }
                if ($dateTimePos !== false && ! empty ( $array [$attrName] )) {
                    $value = DateUtil::StringToDateByGivenFormat ( "m-d-Y h:i A", $array [$attrName] );
                }
                if($isBoolean == true) {
                    if(!empty ($array [$attrName])){
                        $value = true;
                    }else{
                        $value = false;
                    }
                }
                if (! empty ( $value )) {
                    $this->{$attrName} = $value;
                }
            }
        }
    }
}