<?php
class CustomerChristmasQuestion{
    public static $className = "CustomerChristmasQuestion";
    public static $tableName = "customerchristmasquestions";
    private $seq,$customerseq,$isinterested,$iscataloglinksent,$cataloglinksentnotes,$ismainvendor,$mainvendornotes;
    private $isxmassamplessent,$isstrategicplanningmeetingappointment,$strategicplanningmeetdate,$isinvitedtoxmasshowroom,$invitedtoxmasshowroomdate,$invitedtoxmasshowroomreminderdate;
    private $isholidayshopcompleted,$isholidayshopcomsummaryemailsent,$christmas2020reviewingdate,$customerselectxmasitemsfrom;
    private $isxmasbuylastyear,$xmasbuylastyearamount,$isreceivingsellthru,$isrobbyreviewedsellthrough,$isvisitcustomerin4qtr,$christmasquotebydate;
    private $year;
    
    public function getSeq(){
        return $this->seq;
    }
    
    public function setSeq($seq){
        $this->seq = $seq;
    }
    
    public function getIsReceivingSellThru(){
        return $this->isreceivingsellthru;
    }
    
    public function setIsReceivingSellThru($isreceivingsellthru){
        $this->isreceivingsellthru = $isreceivingsellthru;
    }
    
    public function getIsRobbyReviewedSellThrough(){
        return $this->isrobbyreviewedsellthrough;
    }
    
    public function setIsRobbyReviewedSellThrough($isrobbyreviewedsellthrough){
        $this->isrobbyreviewedsellthrough = $isrobbyreviewedsellthrough;
    }
    
    public function getIsVisitCustomerIn4Qtr(){
        return $this->isvisitcustomerin4qtr;
    }
    
    public function setIsVisitCustomerIn4Qtr($isvisitcustomerin4qtr){
        $this->isvisitcustomerin4qtr = $isvisitcustomerin4qtr;
    }
    
    public function getChristMasquoteByDate(){
        return $this->christmasquotebydate;
    }
    
    public function setChristMasquoteByDate($christmasquotebydate){
        $this->christmasquotebydate = $christmasquotebydate;
    }
    
    public function getCustomerSeq(){
        return $this->customerseq;
    }
    
    public function setCustomerSeq($customerseq_){
        $this->customerseq = $customerseq_;
    }
    
    public function getIsInterested(){
        return $this->isinterested;
    }
    
    public function setIsInterested($isinterested){
        $this->isinterested = $isinterested;
    }
    
    public function getIsCatalogLinkSent(){
        return $this->iscataloglinksent;
    }
    
    public function setIsCatalogLinkSent($iscataloglinksent){
        $this->iscataloglinksent = $iscataloglinksent;
    }
    
    public function getCatalogLinkSentNotes(){
        return $this->cataloglinksentnotes;
    }
    
    public function setCatalogLinkSentNotes($cataloglinksentnotes){
        $this->cataloglinksentnotes = $cataloglinksentnotes;
    }
    
    public function getIsMainVendor(){
        return $this->ismainvendor;
    }
    
    public function setIsMainVendor($ismainvendor){
        $this->ismainvendor = $ismainvendor;
    }
    
    public function getMainVendorNotes(){
        return $this->mainvendornotes;
    }
    
    public function setMainVendorNotes($mainvendornotes){
        $this->mainvendornotes = $mainvendornotes;
    }
    
    public function getIsXmasSamplesSent(){
        return $this->isxmassamplessent;
    }
    
    public function setIsXmasSamplesSent($isxmassamplessent){
        $this->isxmassamplessent = $isxmassamplessent;
    }
    
    public function getIsStrategicPlanningMeetingAppointment(){
        return $this->isstrategicplanningmeetingappointment;
    }
    
    public function setIsStrategicPlanningMeetingAppointment($isstrategicplanningmeetingappointment){
        $this->isstrategicplanningmeetingappointment = $isstrategicplanningmeetingappointment;
    }
    
    public function getStrategicPlanningMeetDate(){
        return $this->strategicplanningmeetdate;
    }
    
    public function setStrategidPlanningMeetDate($strategidplanningmeetdate){
        $this->strategicplanningmeetdate = $strategidplanningmeetdate;
    }
    
    public function getIsInvitedToXmasShowroom(){
        return $this->isinvitedtoxmasshowroom;
    }
    
    public function setIsInvitedToXmasShowroom($isinvitedtoxmasshowroom){
        $this->isinvitedtoxmasshowroom = $isinvitedtoxmasshowroom;
    }
    
    public function getInvitedtoXmasShowRoomDate(){
        return $this->invitedtoxmasshowroomdate;
    }
    
    public function setInvitedtoXmasShowRoomDate($invitedtoxmasshowroomdate){
        $this->invitedtoxmasshowroomdate = $invitedtoxmasshowroomdate;
    }
    
    public function getInvitedToxMasShowroomReminderDate(){
        return $this->invitedtoxmasshowroomreminderdate;
    }
    
    public function setInvitedToxMasShowroomReminderDate($invitedtoxmasshowroomreminderdate){
        $this->invitedtoxmasshowroomreminderdate = $invitedtoxmasshowroomreminderdate;
    }
    
    public function getIsHolidayShopCompleted(){
        return $this->isholidayshopcompleted;
    }
    
    public function setIsHolidayShopCompleted($isholidayshopcompleted){
        $this->isholidayshopcompleted = $isholidayshopcompleted;
    }
    
    public function getIsHolidayShopComSummaryEmailSent(){
        return $this->isholidayshopcomsummaryemailsent;
    }
    
    public function setIsHolidayShopComSummaryEmailSent($isholidayshopcomsummaryemailsent){
        $this->isholidayshopcomsummaryemailsent = $isholidayshopcomsummaryemailsent;
    }
    
    public function getChristmas2020ReviewingDate(){
        return $this->christmas2020reviewingdate;
    }
    
    public function setChristmas2020ReviewingDate($christmas2020reviewingdate){
        $this->christmas2020reviewingdate = $christmas2020reviewingdate;
    }
    
    public function getCustomerSelectXmasItemsFrom(){
        return $this->customerselectxmasitemsfrom;
    }
    
    public function setCustomerSelectXmasItemsFrom($customerselectxmasitemsfrom){
        $this->customerselectxmasitemsfrom = $customerselectxmasitemsfrom;
    }
    
    public function getIsXmasBuyLastYear(){
        return $this->isxmasbuylastyear;
    }
    
    public function setIsXmasBuyLastYear($isxmasbuylastyear){
        $this->isxmasbuylastyear = $isxmasbuylastyear;
    }
    
    public function getXmasBuyLastYearAmount(){
        return $this->xmasbuylastyearamount;
    }
    
    public function setXmasBuyLastYearAmount($xmasbuylastyearamount){
        $this->xmasbuylastyearamount = $xmasbuylastyearamount;
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
                    if($array[$attrName] == "yes"){
                        $value = 1;
                    }
                    else{
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