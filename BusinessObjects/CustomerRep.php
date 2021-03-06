<?php
    class CustomerRep{
        private $seq,$fullname,$email,$ext,$cellphone,$position,$category,$skypeid,$customerreptype;

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