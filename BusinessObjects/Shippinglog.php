<?php
class Shippinglog{
    public static $className = "Shippinglog";
    public static $tableName = "shippinglog";
    private $seq,$orderissuedate,$customername, $batchno, $enteredby, $business, $isedi, $createdon, $lastmodifiedon;

    public function getSeq(){
        return $this->seq;
    }
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getOrderIssueDate(){
        return $this->orderissuedate;
    }
    public function setOrderIssueDate($orderissuedate){
        $this->orderissuedate = $orderissuedate;
    }
    public function getCustomerName(){
        return $this->customername;
    }
    public function setCustomerName($customername){
        $this->customername = $customername;
    }
    public function getBatchNo(){
        return $this->batchno;
    }
    public function setBatchNo($batchno){
        $this->batchno = $batchno;
    }
    public function getEnteredBy(){
        return $this->enteredby;
    }
    public function setEnteredBy($enteredby){
        $this->enteredby = $enteredby;
    }
    public function getBusiness(){
        return $this->business;
    }
    public function setBusiness($business){
        $this->business = $business;
    }
    public function getIsEdi(){
        return $this->isedi;
    }
    public function setIsEdi($isedi){
        $this->isedi = $isedi;
    }
    public function getCreatedOn(){
        return $this->createdon;
    }
    public function setCreatedOn($createdon){
        $this->createdon = $createdon;
    }
    public function getLastModifiedOn(){
        return $this->lastmodifiedon;
    }
    public function setLastModifiedOn($lastmodifiedon){
        $this->lastmodifiedon = $lastmodifiedon;
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

    public function createFromRequest($request){
		if (is_array($request)){
			$this->from_array($request);
		}
		return $this;
	}
}