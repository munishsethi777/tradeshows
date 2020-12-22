<?php
class UserConfiguration{

    private $seq,$userseq,$configkey,$configvalue;
	public static $className = "UserConfiguration";
	public static $tableName = "userconfigurations";

    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function setUserSeq($userSeq){
        $this->userseq = $userSeq;
    }
    public function getUserSeq(){
        return $this->userseq;
    }
    public function setConfigKey($configKey){
        $this->configkey = $configKey;
    }
    public function getConfigKey(){
        return $this->configkey;
    }
    public function setConfigValue($configValue){
        $this->configvalue = $configValue;
    }
    public function getConfigValue(){
        return $this->configvalue;
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