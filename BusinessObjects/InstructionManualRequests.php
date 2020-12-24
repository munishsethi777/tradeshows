<?php
class InstructionManualRequests{

    private $seq,$instructionmanualseq,$requesttype;
	public static $className = "InstructionManualRequests";
	public static $tableName = "instructionmanualrequests";
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function setInstructionManualSeq($instructionManualSeq){
        $this->instructionmanualseq = $instructionManualSeq;
    }
    public function getInstructionManualSeq(){
        return $this->instructionmanualseq;
    }
    public function setRequestType($requestType){
        $this->requesttype = $requestType;
    }
    public function getRequestType(){
        return $this->requesttype;
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