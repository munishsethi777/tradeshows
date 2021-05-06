<?php
class RequestLog{ 	
    private $seq,$requestseq,$oldvalue,$newvalue,$attributename,$isspecfieldchange,$createdby,$createdon
            ,$requestspecfieldseq,$requesttypeseq;
    
    public static $className = "RequestLog";
    public static $tableName = "requestlogs";

    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function setRequestSeq($requestseq){
        $this->requestseq = $requestseq;
    }
    public function getRequestSeq(){
        return $this->requestseq;
    }
    public function setOldValue($oldValue){
        $this->oldvalue = $oldValue;
    }
    public function getOldValue(){
        return $this->oldvalue;
    }
    public function setNewValue($newValue){
        $this->newvalue = $newValue;
    }
    public function getNewValue(){
        return $this->newvalue;
    }
    public function setAttributeName($attributeName){
        $this->attributename = $attributeName;
    }
    public function getAttributeName(){
        return $this->attributename;
    }
    public function setIsSpecFieldChange($isSpecFieldChange){
        $this->isspecfieldchange = $isSpecFieldChange;
    }
    public function getIsSpecFieldChange(){
        return $this->isspecfieldchange;
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
    public function setRequestSpecFieldSeq($requestSpecFieldSeq){
        $this->requestspecfieldseq = $requestSpecFieldSeq;
    }
    public function getRequestSpecFieldSeq(){
        return $this->requestspecfieldseq;
    }
    public function setRequestTypeSeq($requestTypeSeq){
        $this->requesttypeseq = $requestTypeSeq;
    }
    public function getRequestTypeSeq(){
        return $this->requesttypeseq;
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