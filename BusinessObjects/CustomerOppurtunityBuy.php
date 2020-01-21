<?php
class CustomerOppurtunityBuy
{
    private $seq;
    private $customerseq;
    private $tradeshowsgoingto;
    private $dinnerappointmentdate;
    private $closeoutleftoversincedate;
    private $isxmascateloglinksent;
    private $year;
    
    public static $className = "CustomerOppurtunityBuy";
    public static $tableName = "customeroppurtunitybuys";
    public function getSeq(){
        return $this->seq;
    }
    
    public function setSeq($seq){
        $this->seq = $seq;
    }
    
    public function getCustomerSeq(){
        return $this->customerseq;
    }
    
    public function setCustomerSeq($customerSeq){
        $this->customerseq = $customerSeq;
    }
    
    public function getTradeshowsGoingTo(){
        return $this->tradeshowsgoingto;
    }
    
    public function setTradeshowsGoingTo($tradeshowsGoingTo){
        $this->tradeshowsgoingto = $tradeshowsGoingTo;
    }
    
    public function getDinnerAppointmentDate(){
        return $this->dinnerappointmentdate;
    }
    
    public function setDinnerAppointmentDate($dinnerAppointmentDate){
        $this->dinnerappointmentdate = $dinnerAppointmentDate;
    }
    
    public function getCloseOutleftOverSinceDate(){
        return $this->closeoutleftoversincedate;
    }
    
    public function setCloseOutleftOverSinceDate($CloseOutleftOverSinceDate){
        $this->closeoutleftoversincedate = $CloseOutleftOverSinceDate;
    }
    
    public function setIsXmasCatelogLinkSent($sentLink_){
        $this->isxmascateloglinksent = $sentLink_;
    }
    
    public function getIsXmasCatelogLinkSent(){
        return $this->isxmascateloglinksent;
    }
    
    public function setYear($year_){
        $this->year = $year_;
    }
    public function getYear(){
        return $this->year;
    }
    
    
    public function from_array($array) {
        foreach ( get_object_vars ( $this ) as $attrName => $attrValue ) {
            $flag = property_exists ( self::$className, $attrName );
            $isExists = array_key_exists ( $attrName, $array );
            if ($flag && $isExists) {
                $datePos = strpos ( strtolower ( $attrName ), 'date' );
                $dateTimePos = strpos ( strtolower ( $attrName ), 'datetime' );
                $isBoolean = substr($attrName, 0,2) == "is" ? true : false;
                
                $value = $array [$attrName];
                if ($datePos !== false && ! empty ( $array [$attrName] )) {
                    $value = DateUtil::StringToDateByGivenFormat ( "m-d-Y", $array [$attrName] );
                }
                if ($dateTimePos !== false && ! empty ( $array [$attrName] )) {
                    $value = DateUtil::StringToDateByGivenFormat ( "m-d-Y h:i A", $array [$attrName] );
                }
                if($isBoolean == true) {
                    if(!empty ($array [$attrName])){
                        $value = 1;
                    }else{
                        $value = 0;
                    }
                }
                if (! empty ( $value )) {
                    $this->{$attrName} = $value;
                }
            }
        }
    }
}

