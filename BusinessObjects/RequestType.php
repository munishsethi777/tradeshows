<?php 
    class RequestType{
        private $seq, $departmentseq, $title, $requesttypecode, $createdby, $createdon, $lastmodifiedon;

        public static $className = "RequestType";
        public static $tableName = "requesttypes";

        public function setSeq($seq ){
            $this->seq  = $seq ;
        } 
        public function getSeq(){
            return $this->seq;
        } 
        public function setDepartmentSeq($departmentseq ){
            $this->departmentseq  = $departmentseq ;
        } 
        public function getDepartmentSeq(){
            return $this->departmentseq;
        } 
        public function setTitle($title){
            $this->title = $title;
        }
        public function getTitle(){
            return $this->title;
        }
        public function setRequestTypeCode($requestTypeCode){
            $this->requesttypecode = $requestTypeCode;
        }
        public function getRequestTypeCode(){
            return $this->requesttypecode;
        }
        public function setCreatedBy($createdby){
            $this->createdby = $createdby;
        }
        public function getCreatedBy(){
            return $this->createdby;
        }
        public function setCreatedOn($createdon){
            $this->createdon = $createdon;
        }
        public function getCreatedOn(){
            return $this->createdon;
        }
        public function setLastModifiedOn($lastmodifiedon){
            $this->lastmodifiedon = $lastmodifiedon;
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