<?php

class CustomerSpringQuestion
{
    private $seq;
    private $customerseq;
    private $category;
    private $issentcataloglink;
    private $sentcataloglinknotes;
    private $ispitchmainvendor;
    private $pitchmainvendornotes;
    private $issentsample;
    private $categoriesshouldsellthem;
    private $isstrategicplanningmeeting;
    private $strategicplanningmeetingdate;
    private $isinvitedtospringshowroom;
    private $invitedtospringshowroomdate;
    private $invitedtospringshowroomreminderdate;
    private $issellthrough;
    private $isrobbyreviewedsellthrough;
    private $isvisitcustomer2qtr;
    private $iscomposhopcompleted;
    private $iscompshopsummaryemailsent;
    private $christmasquotebydate;
    private $springreviewingdate;
    private $customerselectingspringitemsfrom;
    private $isvisitcustomerduring2ndqtr;
    private $quotespringbydate;
    private $year;
    
    public static $className = "CustomerSpringQuestion";
    public static $tableName = "customerspringquestions";
    
    public function getSeq(){
        return $this->seq;
    }
    
    public function setSeq($seq){
        $this->seq = $seq;
    }
    
    public function getCustomerseq(){
        return $this->customerseq;
    }
    
    public function setCustomerseq($customerseq){
        $this->customerseq = $customerseq;
    }
    
    public function getCategory(){
        return $this->category;
    }
    
    public function setCategory($category){
        $this->category = $category;
    }
    
    public function getIsSentCatalogLink(){
        return $this->issentcataloglink;
    }
    
    public function setIsSentCatalogLink($issentcataloglink){
        $this->issentcataloglink = $issentcataloglink;
    }
    
    public function getSentCatalogLinkNotes(){
        return $this->sentcataloglinknotes;
    }
    
    public function setSentCatalogLinkNotes($sentcataloglinknotes){
        $this->sentcataloglinknotes = $sentcataloglinknotes;
    }
    
    public function getIsPitchMainVendor(){
        return $this->ispitchmainvendor;
    }
    
    public function setIsPitchMainVendor($ispitchmainvendor){
        $this->ispitchmainvendor = $ispitchmainvendor;
    }
    
    public function getPitchMainVendorNotes(){
        return $this->pitchmainvendornotes;
    }
    
    public function setPitchMainVendorNotes($pitchmainvendornotes){
        $this->pitchmainvendornotes = $pitchmainvendornotes;
    }
    
    public function getIsSentSample(){
        return $this->issentsample;
    }
    
    public function setIsSentSample($issentsample){
        $this->issentsample = $issentsample;
    }
    
    public function getCategoriesShouldSellThem(){
        return $this->categoriesshouldsellthem;
    }
    
    public function setCategoriesShouldSellThem($categoriesshouldsellthem){
        $this->categoriesshouldsellthem = $categoriesshouldsellthem;
    }
    
    public function getIsStrategicPlanningMeeting(){
        return $this->isstrategicplanningmeeting;
    }
    
    public function setIsStrategicPlanningMeeting($isstrategicplanningmeeting){
        $this->isstrategicplanningmeeting = $isstrategicplanningmeeting;
    }
    
    public function getStrategicPlanningMeetingDate(){
        return $this->strategicplanningmeetingdate;
    }
    
    public function setStrategicPlanningMeetingDate($strategicplanningmeetingdate){
        $this->strategicplanningmeetingdate = $strategicplanningmeetingdate;
    }
    
    public function getIsInvitedtoSpringShowRoom(){
        return $this->isinvitedtospringshowroom;
    }
    
    public function setIsInvitedtoSpringShowRoom($isinvitedtospringshowroom){
        $this->isinvitedtospringshowroom = $isinvitedtospringshowroom;
    }
    
    public function getInvitedToSpringShowroomDate(){
        return $this->invitedtospringshowroomdate;
    }
    
    public function setInvitedToSpringShowroomDate($invitedtospringshowroomdate){
        $this->invitedtospringshowroomdate = $invitedtospringshowroomdate;
    }
    
    public function getInvitedToSpringShowroomReminderDate(){
        return $this->invitedtospringshowroomreminderdate;
    }
    
    public function setInvitedToSpringShowroomReminderDate($invitedtospringshowroomreminderdate){
        $this->invitedtospringshowroomreminderdate = $invitedtospringshowroomreminderdate;
    }
    
    public function getIssellthrough(){
        return $this->issellthrough;
    }
    
    public function setIssellthrough($issellthrough){
        $this->issellthrough = $issellthrough;
    }
    
    public function getIsRobbyReviewedSellThrough(){
        return $this->isrobbyreviewedsellthrough;
    }
    
    public function setIsRobbyReviewedSellThrough($isrobbyreviewedsellthrough){
        $this->isrobbyreviewedsellthrough = $isrobbyreviewedsellthrough;
    }
    
    public function getIsVisitCustomer2Qtr(){
        return $this->isvisitcustomer2qtr;
    }
    
    public function setIsvisitcustomer2qtr($isvisitcustomer2qtr){
        $this->isvisitcustomer2qtr = $isvisitcustomer2qtr;
    }
    
    public function getIsCompoShopCompleted(){
        return $this->iscomposhopcompleted;
    }
    
    public function setIsCompoShopCompleted($iscomposhopcompleted){
        $this->iscomposhopcompleted = $iscomposhopcompleted;
    }
    
    public function getIsCompShopSummaryEmailSent(){
        return $this->iscompshopsummaryemailsent;
    }
    
    public function setIsCompShopSummaryEmailSent($iscompshopsummaryemailsent){
        $this->iscompshopsummaryemailsent = $iscompshopsummaryemailsent;
    }
    
    public function getChristmasQuoteByDate(){
        return $this->christmasquotebydate;
    }
    
    public function setChristmasQuoteByDate($christmasquotebydate){
        $this->christmasquotebydate = $christmasquotebydate;
    }
    
    public function getSpringReviewingDate(){
        return $this->springreviewingdate;
    }
    
    public function setSpringReviewingDate($springreviewingdate){
        $this->springreviewingdate = $springreviewingdate;
    }
    
    public function getCustomerselectingspringitemsfrom(){
        return $this->customerselectingspringitemsfrom;
    }
    
    public function setCustomerselectingspringitemsfrom($customerselectingspringitemsfrom){
        $this->customerselectingspringitemsfrom = $customerselectingspringitemsfrom;
    }
    
    public function getIsVisitCustomerDuring2ndQtr(){
        return $this->isvisitcustomerduring2ndqtr;
    }
    
    public function setIsVisitCustomerDuring2ndQtr($isvisitcustomerduring2ndqtr){
        $this->isvisitcustomerduring2ndqtr = $isvisitcustomerduring2ndqtr;
    }
    
    public function getQuoteSpringByDate(){
        return $this->quotespringbydate;
    }
    
    public function setQuoteSpringByDate($quotespringbydate){
        $this->quotespringbydate = $quotespringbydate;
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

