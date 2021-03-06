<?php
    class RequestSpecsField{
        private $seq, $requesttypeseq, $name, $title, $fieldtype, $isrequired, $isvisible, $details;

        public static $className = "RequestSpecsField";
        public static $tableName = "requestspecsfields";

        public function setSeq($seq){
            $this->seq = $seq;
        }
        public function getSeq(){
            return $this->seq;
        }
        public function setRequestTypeSeq($requestTypeSeq){
            $this->requesttypeseq = $requestTypeSeq;
        }
        public function getRequestTypeSeq(){
            return $this->requesttypeseq;
        }
        public function setName($name){
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }
        public function setTitle($title){
            $this->title = $title;
        }
        public function getTitle(){
            return $this->title;
        }
        public function setFieldType($fieldType){
            $this->fieldtype = $fieldType;
        }
        public function getFieldType(){
            return $this->fieldtype;
        }
        public function setIsRequired($isRequired){
            $this->isrequired = $isRequired;
        }
        public function getIsRequired(){
            return $this->isrequired;
        }
        public function setIsVisible($isVisible){
            $this->isvisible = $isVisible;
        }
        public function getIsVisible(){
            return $this->isvisible;
        }
        public function setDetails($details){
            $this->details = $details;
        }
        public function getDetails(){
            return $this->details;
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