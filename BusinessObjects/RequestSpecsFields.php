<?php
    class RequestSpecsFields{
        private $seq, $requestTypeSeq, $name, $title, $fieldtype, $isrequired, $invisible;

        public static $className = "RequestSpecsFields";
        public static $tableName = "requestspecsfields";

        public function setSeq($seq){
            $this->seq = $seq;
        }
        public function getSeq(){
            return $this->seq;
        }
        public function setRequestTypeSeq($requestTypeSeq){
            $this->requestTypeSeq = $requestTypeSeq;
        }
        public function getRequestTypeSeq(){
            return $this->requestTypeSeq;
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
        public function setFieldType($fieldtype){
            $this->fieldtype = $fieldtype;
        }
        public function getFieldType(){
            return $this->fieldtype;
        }
        public function setisRequired($isrequired){
            $this->isrequired = $isrequired;
        }
        public function getisRequired(){
            return $this->isrequired;
        }
        public function setInvisible($invisible){
            $this->invisible = $invisible;
        }
        public function getInvisible(){
            return $this->invisible;
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