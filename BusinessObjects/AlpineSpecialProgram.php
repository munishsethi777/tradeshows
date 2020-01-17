<?php
class AlpineSpecialProgram {
    private $seq,$customerseq,$startdate,$enddate,$priceprogram,$regularterms,$inseasonterms,$freight;
    private $isedicustomer,$isdefectiveallowancesigned,$defectivepercent,$howdefectiveallowancededucted,$rebateprogramandpaymentmethod,$howpayingbackcustomer,$promotionalallowance,$otherallowance;
    private $additionalremarks,$isbackorderaccepted;
    
    public static $className = "AlpineSpecialProgram";
    public static $tableName = "alpinespecialprograms";
    
    public function setSeq($seq_) {
        $this->seq = $this->seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    
    public function setCustomerSeq($customerSeq_){
        $this->customerseq = $customerSeq_;
    }
    public function getCustomerSeq(){
        return $this->customerseq;
    }
    
    public function setStartDate($startDate_){
        $this->startdate = $startDate_;
    }
    public function getStartDate(){
        return $this->startdate;
    }
    
    public function setEndDate($endDate_){
        $this->enddate = $endDate_;
    }
    public function getEndDate(){
        return $this->enddate;
    }
    
    public function setPriceProgram($priceProgram_){
        $this->priceprogram = $priceProgram_;
    }
    public function getPriceProgram(){
        return $this->priceprogram;
    }
    
    public function setRegularTerms($regularTerms_){
        $this->regularterms = $regularTerms_;
    }
    public function getRegularTerms(){
        return $this->regularterms;
    }
    
    public function setInseasonTerms($inseasonTerms_){
        $this->inseasonterms = $inseasonTerms_;
    }
    public function getInseasonTerms(){
        return $this->inseasonterms;
    }
    
    public function setFreight($freight_){
        $this->freight = $freight_;
    }
    public function getFreight(){
        return $this->freight;
    }
    
    public function setIsEDICustomer($isedicustomer_){
        $this->isedicustomer = $isedicustomer_;
    }
    public function getIsEDICustomer(){
        return $this->isedicustomer;
    }
    
    public function setIsDefectiveAllowancesigned($isdefectiveallowancesigned_){
        $this->isdefectiveallowancesigned = $isdefectiveallowancesigned_;
    }
    public function getIsDefectiveAllowancesigned(){
        return $this->isdefectiveallowancesigned;
    }
    
    public function setDefectivePercent($defectivepercent_){
        $this->defectivepercent = $defectivepercent_;
    }
    public function getDefectivePercent(){
        return $this->defectivepercent;
    }
    
    public function setHowDefectiveAllowanceDeducted($howdefectiveallowancededucted_){
        $this->howdefectiveallowancededucted = $$howdefectiveallowancededucted_;
    }
    public function getHowDefectiveAllowanceDeducted(){
        return $this->howdefectiveallowancededucted;
    }
    
    public function setRebateProgramAndPaymentMethod($rebateprogramandpaymentmethod_){
        $this->rebateprogramandpaymentmethod = $rebateprogramandpaymentmethod_;
    }
    public function getRebateProgramAndPaymentMethod(){
        return $this->rebateprogramandpaymentmethod;
    }
    
    public function setHowPayingBackCustomer($howpayingbackcustomer_){
        $this->howpayingbackcustomer = $howpayingbackcustomer_;
    }
    public function getHowPayingBackCustomer(){
        return $this->howpayingbackcustomer;
    }
    
    public function setPromotionalAllowance($promotionalallowance_){
        $this->promotionalallowance = $promotionalallowance_;
    }
    public function getPromotionalAllowance(){
        return $this->promotionalallowance;
    }
    
    public function setOtherAllowance($otherallowance_){
        $this->otherallowance = $otherallowance_;
    }
    public function getOtherAllowance(){
        return $this->otherallowance;
    }
    
    public function setAdditionalRemarks($additionalremarks_){
        $this->additionalremarks = $additionalremarks_;
    }
    public function getAdditionalRemarks(){
        return $this->additionalremarks;
    }
    
    public function setIsBackOrderAccepted($isbackorderaccepted_){
        $this->isbackorderaccepted = $isbackorderaccepted_;
    }
    public function getIsBackOrderAccepted(){
        return $this->isbackorderaccepted;
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