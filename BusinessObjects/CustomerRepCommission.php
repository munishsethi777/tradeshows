<?php
class CustomerRepCommission{
    private $seq, $customerseq, $customerrepseq, $commissioncategory, $commissiontype, $commissionvalue ;
    public static $className = "CustomerRepCommission";
    public static $tableName = "customerrepcommissions";
    
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
    public function setCommissionCategory($commissionCategory){
        $this->commissioncategory = $commissionCategory;
    }
    public function getCommissionCategory(){
        return $this->commissioncategory;
    }
    public function setCommissionType($commissionType){
        $this->commissiontype = $commissionType;
    }
    public function getCommissionType(){
        return $this->commissiontype;
    }
    public function setCommissionValue($commissionValue){
        $this->commissionvalue = $commissionValue;
    }
    public function getCommissionValue(){
        return $this->commissionvalue;
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