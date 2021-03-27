<?php
    class CustomerRep{
        private $seq,$fullname,$email,$ext,$cellphone,$position,$category,$skypeid,$customerreptype,$repnumber,$omscustid,$territory,
        $companyname,$shiptoaddress,$city,$state,$zip,$commission,$isreceivesmonthlysalesreport,$pricingtier,$seniorrephandlingaccount,
        $salesadminassigned,$createdon,$lastmodifiedon;

        public static $className = "CustomerRep";
        public static $tableName = "customerreps";  

        public function setSeq($seq){
            $this->seq = $seq;
        }
        public function getSeq(){
            return $this->seq;
        }
        public function setFullName($fullName){
            $this->fullname = $fullName;
        }
        public function getFullName(){
            return $this->fullname;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function getEmail(){
            return $this->email;
        }
        public function setExt($ext){
            $this->ext = $ext;
        }
        public function getExt(){
            return $this->ext;
        }
        public function setCellPhone($cellPhone){
            $this->cellphone = $cellPhone;
        }
        public function getCellPhone(){
            return $this->cellphone;
        }
        public function setPosition($position){
            $this->position = $position;
        }
        public function getPosition(){
            return $this->position;
        }
        public function setCategory($category){
            $this->category = $category;
        }
        public function getCategory(){
            return $this->category;
        }
        public function setSkypeId($skypeId){
            $this->skypeid = $skypeId;
        }
        public function getSkypeId(){
            return $this->skypeid;
        }
        public function setCustomerRepType($customerRepType){
            $this->customerreptype = $customerRepType;
        }
        public function getCustomerRepType(){
            return $this->customerreptype;
        }
        public function setRepNumber($repNumber){
            $this->repnumber = $repNumber;
        }
        public function getRepNumber(){
            return $this->repnumber;
        }
        public function setOmsCustId($omsCustId){
            $this->omscustid = $omsCustId;
        }
        public function getOmsCustId(){
            return $this->omscustid;
        }
        public function setTerritory($territory){
            $this->territory = $territory;
        }
        public function getTerritory(){
            return $this->territory;
        }
        public function setCompanyName($companyName){
            $this->companyname = $companyName;
        }
        public function getCompanyName(){
            return $this->companyname;
        }
        public function setShipToAddress($shipToAddress){
            $this->shiptoaddress = $shipToAddress;
        }
        public function getShipToAddress(){
            return $this->shiptoaddress;
        }
        public function setCity($city){
            $this->city = $city;
        }
        public function getCity(){
            return $this->city;
        }
        public function setState($state){
            $this->state = $state;
        }
        public function getState(){
            return $this->state;
        }
        public function setZip($zip){
            $this->zip = $zip;
        }
        public function getZip(){
            return $this->zip;
        }
        public function setCommission($commission){
            $this->commission = $commission;
        }
        public function getCommission(){
            return $this->commission;
        }
        public function setIsReceivesMonthlySalesReport($isReceivesMonthlySalesReport){
            $this->isreceivesmonthlysalesreport = $isReceivesMonthlySalesReport;
        }
        public function getIsReceivesMonthlySalesReport(){
            return $this->isreceivesmonthlysalesreport;
        }
        public function setPricingTier($pricingTier){
            $this->pricingtier = $pricingTier;
        }
        public function getPricingTier(){
            return $this->pricingtier;
        }
        public function setSeniorRepHandlingAccount($seniorRepHandlingAccount){
            $this->seniorrephandlingaccount = $seniorRepHandlingAccount;
        }
        public function getSeniorRepHandlingAccount(){
            return $this->seniorrephandlingaccount;
        }
        public function setSalesAdminAssigned($salesAdminAssigned){
            $this->salesadminassigned = $salesAdminAssigned;
        }
        public function getSalesAdminAssigned(){
            return $this->salesadminassigned;
        }
        public function setCreatedOn($createdOn){
            $this->createdon = $createdOn;
        }
        public function getCreatedOn(){
            return $this->createdon;
        }
        public function setLastModifiedOn($lastModifiedOn){
            $this->lastmodifiedon = $lastModifiedOn;
        }
        public function getLastModifiedOn(){
            return $this->lastmodifiedon;
        }
        public function createFromRequest($request){
            if (is_array($request)){
                $this->from_array($request);
            }
            return $this;
        }
        public function from_array($array){
            foreach(get_object_vars($this) as $attrName => $attrValue){
                $flag = property_exists(self::$className, $attrName);
                $isExists = array_key_exists($attrName, $array);
                if($flag && $isExists){
                    $datePos = strpos(strtolower ($attrName),'date');
                    $value = $array[$attrName];
                    if($datePos !== false && !empty($value)){
                        $dateValue = DateUtil::StringToDateByGivenFormat("m-d-Y", $value);
                        if($dateValue){
                            $value = $dateValue;
                        }
                    }
                    if(!empty($value)){
                        $this->{$attrName} = $value;
                    }else{
                        $this->{$attrName} = null;
                    }
                }
            }
        }  
    }

?>