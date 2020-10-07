<?php
class Customer{
    private $seq,$fullname,$customerid,$customertype,$insideaccountmanager,$salesadminlead,$chainstoresalesadmin,$businesstype,$salespersonname,$salespersonid,$createdby,$createdon,$lastmodifiedon;
    private $priority,$isstore,$storeid,$storename,$businesscategory;
    private $salespersonid2,$salespersonname2,$salespersonid3,$salespersonname3,$salespersonid4,$salespersonname4;
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
    public function getCustomerType(){
        return $this->customertype;
    }
    public function setCustomerType($customertype){
        $this->customertype = $customertype;
    }
    public function getInsideAccountManager(){
        return $this->insideaccountmanager;
    }
    public function setInsideAccountManager($insideaccountmanager){
        $this->insideaccountmanager = $insideaccountmanager;
    }
    public function getSalesAdminLead(){
        return $this->salesadminlead;
    }
    public function setSalesAdminLead($salesadminlead){
        $this->salesadminlead = $salesadminlead;
    }
    public function getChainStoreSalesAdmin(){
        return $this->chainstoresalesadmin;
    }
    public function setChainStoreSalesAdmin($chainstoresalesadmin){
        $this->chainstoresalesadmin = $chainstoresalesadmin;
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
    /**
     * set the sales person name for second value
     * @param salesPersonName_2 the value to set for sales person name 2 
     */
    public function setSalesPersonName2($salesPersonName_2){
        $this->salespersonname2 = $salesPersonName_2;
    }
    /**
     * get the sales person name for second value
     */
    public function getSalesPersonName2() {
        return $this->salespersonname2;
    }
    /**
     * set sales person id for second value
     * @param salesPersonId_2 the value to set for sales person id 2
     */
    public function setSalesPersonId2($salesPersonId_2){
        $this->salespersonid2 = $salesPersonId_2;
    }
    /** 
     * get the sales person id for second value
     */
    public function getSalesPersonId2(){
        return $this->salespersonid2;
    }
    /**
     * set the sales person name for third value
     * @param salesPersonName_3 the value to set for sales person name 3
     */
    public function setSalesPersonName3($salesPersonName_3){
        $this->salespersonname3 = $salesPersonName_3;
    }
    /**
     * get the sales person name for third value
     */
    public function getSalesPersonName3() {
        return $this->salespersonname3;
    }
    /**
     * set sales person id for third value
     * @param salesPersonId_3 the value to set for sales person id 3
     */
    public function setSalesPersonId3($salesPersonId_3){
        $this->salespersonid3 = $salesPersonId_3;
    }
     /** 
     * get the sales person id for third value
     */
    public function getSalesPersonId3(){
        return $this->salespersonid3;
    }
    /**
     * set the sales person name for fourth value
     * @param salesPersonName_4 the value to set for sales person name 4 
     */
    public function setSalesPersonName4($salesPersonName_4){
        $this->salespersonname4 = $salesPersonName_4;
    }
    /**
     * get the sales person name for fourth value
     */
    public function getSalesPersonName4() {
        return $this->salespersonname4;
    }
    /**
     * set sales person id for fourth value
     * @param salesPersonId_4 the value to set for sales person id 4
     */
    public function setSalesPersonId4($salesPersonId_4){
        $this->salespersonid4 = $salesPersonId_4;
    }
     /** 
     * get the sales person id for fourth value
     */
    public function getSalesPersonId4(){
        return $this->salespersonid4;
    }

    public function setCreatedBy($createdBy_){
        $this->createdby = $createdBy_;
    }
    public function getCreatedBy(){
        return $this->createdby;
    }
    public function setPriority($val){
    	$this->priority = $val;
    }
    public function getPriority(){
    	return $this->priority;
    }
    public function setIsStore($val){
    	$this->isstore = $val;
    }
    public function getIsStore(){
    	return $this->isstore;
    }
    public function setStoreId($val){
    	$this->storeid = $val;
    }
    public function getStoreId(){
    	return $this->storeid;
    }
    public function setStoreName($val){
    	$this->storename = $val;
    }
    public function getStoreName(){
    	return $this->storename;
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
    public function setBusinessCategory($businessCategory_){
        $this->businesscategory = $businessCategory_;
    }
    public function getBusinessCategory(){
        return $this->businesscategory;
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