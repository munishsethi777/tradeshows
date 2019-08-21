<?php
class Team{
    public static $tableName = "teams";
    public static $className = "Team"; 
    private $seq,$title,$description,$supervisoruserseq,$createdby,$isenable,$createdon,$lastmodifiedon;
    
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    
    public function setTitle($title){
        $this->title = $title;
    }
    public function getTitle(){
        return $this->title;
    }
    
    public function setDescription($description){
        $this->description = $description;
    }
    public function getDescription(){
        return $this->description ;
    }
    
    public function setSupervisoruserseq($supervisoruserseq){
        $this->supervisoruserseq = $supervisoruserseq;
    }
    public function getSupervisoruserseq(){
        return $this->supervisoruserseq;
    }
    
    public function setCreatedby($val){
        $this->createdby = $val;
    }
    public function getCreatedby(){
        return $this->createdby ;
    }
    
    public function setIsEnable($val){
        $this->isenable = $val;
    }
    public function getIsEnable(){
        return $this->isenable;
    }
    
    public function setCreatedon($val){
        $this->createdon = $val;
    }
    public function getCreatedon(){
        return $this->createdon ;
    }
    
    public function setLastmodifiedon($val){
        $this->lastmodifiedon = $val;
    }
    public function getLastmodifiedon(){
        return $this->lastmodifiedon ;
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