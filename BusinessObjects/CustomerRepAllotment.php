<?php
    class CustomerRepAllotment{
        private $seq,$customerseq,$customerrepseq,$notes;

        public static $className = "CustomerRepAllotment";
        public static $tableName = "customerrepallotments";  

        public function setSeq($seq){
            $this->seq = $seq;
        }
        public function getSeq(){
            return $this->seq;
        }
        public function setCustomerSeq($customerSeq){
            $this->customerseq = $customerSeq;
        }
        public function getCustomerSeq(){
            return $this->customerseq;
        }
        public function setCustomerRepSeq($customerRepSeq){
            $this->customerrepseq = $customerRepSeq;
        }
        public function getCustomerRepSeq(){
            return $this->customerrepseq;
        }
        public function setNotes($notes){
            $this->notes = $notes;
        }
        public function getNotes(){
            return $this->notes;
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