<?php
class RequestLogs{ 	
    private $seq, $requestseq, $requestlogtype, $details, $createdby, $createdon;
    
    public static $className = "RequestLogs";
    public static $tableName = "requestLogs";

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
    public function setRequestLogType($requestlogtype){
        $this->requestlogtype = $requestlogtype;
    }
    public function getRequestLogType(){
        return $this->requestlogtype;
    }
    public function setDetails($details){
        $this->details = $details;
    }
    public function getDetails(){
        return $this->details;
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