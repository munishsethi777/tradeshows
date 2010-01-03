<?php
class Buyer{
    private $seq,$firstname,$lastname,$email,$officephone,$cellphone,$notes,$customerseq,$createdby,$createdon,$lastmodifiedon,$category;
    private $imageextension;
    public static $className = "Buyer";
    public static $tableName = "buyers";
    
    public function setSeq($seq_){
        $this->seq = $seq_;
    }
    public function getSeq(){
        return $this->seq;
    }
    
    public function setFirstName($fName_){
        $this->firstname = $fName_;
    }
    public function getFirstName(){
        return $this->firstname;
    }
    
    public function setLastName($lName_){
        return $this->lastname = $lName_;
    }
    public function getLastName(){
        return $this->lastname;
    }
    
    public function setEmail($email_){
        $this->email = $email_;
    }
    public function getEmail(){
        return $this->email;
    }
    
    public function setOfficePhone($officePhone_) {
        $this->officephone = $officePhone_;
    }
    
    public function getOfficePhone(){
        return $this->officephone;
    }
    
    public function setCellPhone($cellPhone_){
        $this->cellphone = $cellPhone_;
    }
    public function getCellPhone(){
        return $this->cellphone;
    }
    
    public function setNotes($notes_){
        $this->notes = $notes_;
    }
    public function getNotes(){
        return $this->notes;
    }
    
    public function setCustomerSeq($customerSeq_){
        $this->customerseq = $customerSeq_;
    }
    public function getCustomerSeq(){
        return $this->customerseq;
    }
    
    public function setCreatedBy($createdBy_){
        $this->createdby = $createdBy_;
    }
    public function getCreatedBy(){
        return $this->createdby;
    }
    
    public function setCreatedOn($createdOn_){
        $this->createdon = $createdOn_;
    }
    public function getCreatedOn(){
        return $this->createdon;
    }
    
    public function setLastModifiedOn($lastModifiedOn_){
        $this->lastmodifiedon = $lastModifiedOn_;
    }
    public function getLastModifiedOn(){
        return $this->lastmodifiedon;
    }
    
    public function setCategory($category_){
        $this->category = $category_;
    }
    public function getCategory(){
        return $this->category;
    }
    
    public function getImageExtension(){
        return $this->imageextension;
    }
    public function setImageExtension($imageExtention_){
        $this->imageextension = $imageExtention_;
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
                        $value = true;
                    }else{
                        $value = false;
                    }
                }
                if (! empty ( $value )) {
                    $this->{$attrName} = $value;
                }
            }
        }
    }
    
}