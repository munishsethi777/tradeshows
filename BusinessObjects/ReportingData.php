<?php
class ReportingData{
    private $seq,$dated,$parameter,$count,$department;
    public static $className = "ReportingData";
    public static $tableName = "reportingdata";
    
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq($seq){
        return $this->seq;
    }
    public function setDated($dated){
        $this->dated = $dated;
    }
    public function getDated($dated){
        return $this->dated;
    }
    public function setParameter($parameter){
        $this->parameter = $parameter;
    }
    public function getParameter($parameter){
        return $this->parameter;
    }
    public function setCount($count){
        $this->count = $count;
    }
    public function getCount($count){
        return $this->count;
    }
    public function setDepartment($department){
        $this->department = $department;
    }
    public function getDepartment($department){
        return $this->department;
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
                    $value = DateUtil::StringToDateByGivenFormat("m-d-Y", $value);
                }
                if(!empty($value)){
                    $this->{$attrName} = $value;
                }
            }
        }
    }
}

?>