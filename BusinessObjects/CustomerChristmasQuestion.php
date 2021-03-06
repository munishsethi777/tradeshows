<?php
class CustomerChristmasQuestion{
    public static $className = "CustomerChristmasQuestion";
    public static $tableName = "customerchristmasquestions";
    private $seq,$customerseq,$isallcategoriesselected,$category,$isinterested,$iscataloglinksent,$cataloglinksentnotes,$ismainvendor,$mainvendornotes;
    private $isxmassamplessent,$isstrategicplanningmeetingappointment,$strategicplanningmeetdate,$isinvitedtoxmasshowroom,$invitedtoxmasshowroomdate,$invitedtoxmasshowroomreminderdate;
    private $compshopcompleteddate,$isholidayshopcomsummaryemailsent,$christmas2020reviewingdate,$customerselectxmasitemsfrom;
    private $isxmasbuylastyear,$xmasbuylastyearamount,$isreceivingsellthru,$isrobbyreviewedsellthrough,$isvisitcustomerin4qtr,$christmasquotebydate;
    private $cataloglinkdate,$tradeshowsaregoingto,$isdinnerappt,$dinnerapptdate,$ispitchmainvendor,$istheremorebuyers,$xmassamplesentdate,$categoriesshouldsellthem;
    private $isreviewedsellthru,$compshopsummaryemailsentdate,$isquotedforxmas,$itemselectionfinalized,$itemspurchasedlastyear,$finalizedtyvsly,$arepoexpecting,$expectingpodate,$isopportunitiessent,$opportunitiessentdate;
    private $year,$dinnerapptplace,$buyerhasmorecategorynotes,$wherecustomerselectholidayitems,$isquestionnairecompleted;
    
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
    
    public function getCompShopCompletedDate(){
        return $this->compshopcompleteddate;
    }
    
    public function setCompShopCompletedDate($compshopcompleteddate){
        $this->compshopcompleteddate = $compshopcompleteddate;
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
    public function getCataloglinkDate(){
        return $this->cataloglinkdate;
    }
    public function setCatalogLinkDate($catalogLinkDate){
        $this->cataloglinkdate = $catalogLinkDate;
    }
    public function getTradeshowsAreGoingTo(){
        return $this->tradeshowsaregoingto;
    }
    public function setTradeshowsAreGoingTo($tradeshowsAreGoingTo){
        $this->tradeshowsaregoingto = $tradeshowsAreGoingTo;
    }
    public function getIsDinnerAppt(){
        return $this->isdinnerappt;
    }
    public function setIsDinnerAppt($isDinnerAppt){
        $this->isdinnerappt = $isDinnerAppt;
    }
    public function getDinnerApptDate(){
        return $this->dinnerapptdate;
    }
    public function setDinnerApptDate($dinnerApptDate){
        $this->dinnerapptdate = $dinnerApptDate;
    }
    
    public function getIsPitchMainVendor(){
        return $this->ispitchmainvendor;
    }
    public function setIsPitchMainVendor($isPitchMainVendor){
        $this->ispitchmainvendor = $isPitchMainVendor;  
    }
    public function getIsThereMoreBuyers(){
        return $this->istheremorebuyers;
    }
    public function setIsThereMoreBuyers($isThereMoreBuyers){
        $this->istheremorebuyers = $isThereMoreBuyers;
    }
    public function getXmasSampleSentDate(){
        return $this->xmassamplesentdate;
    }
    public function setXmasSampleSentDate($xmasSampleSentDate){
        $this->xmassamplesentdate = $xmasSampleSentDate;
    }
    public function getCategoriesShouldSellThem(){
        return $this->categoriesshouldsellthem;
    }
    public function setCategoriesShouldSellThem($categoriesShouldSellThem){
        $this->categoriesshouldsellthem = $categoriesShouldSellThem;
    }
    public function getIsReviewedSellThru(){
        return $this->isreviewedsellthru;
    }
    public function setIsReviewedSellThru($isReviewedSellThru){
        $this->isreviewedsellthru = $isReviewedSellThru;
    }
    public function getCompShopSummaryEmailSentDate(){
        return $this->compshopsummaryemailsentdate;
    }
    public function setCompShopSummaryEmailSentDate($compShopSummaryEmailSentDate){
        $this->compshopsummaryemailsentdate = $compShopSummaryEmailSentDate;
    }
    public function getIsQuotedForXmas(){
        return $this->isquotedforxmas;
    }
    public function setIsQuotedForXmas($isQuotedForXmas){
        $this->isquotedforxmas = $isQuotedForXmas;
    }
    public function getItemSelectionFinalized(){
        return $this->itemselectionfinalized;
    }
    public function setItemSelectionFinalized($itemSelectionFinalized){
        $this->itemselectionfinalized = $itemSelectionFinalized;
    }
    public function getItemsPurchasedLastYear(){
        return $this->itemspurchasedlastyear;
    }
    public function setItemsPurchasedLastYear($itemsPurchasedLastYear){
        $this->itemspurchasedlastyear = $itemsPurchasedLastYear;
    }
    public function getFinalizedTyVsLy(){
        return $this->finalizedtyvsly;
    }
    public function setFinalizedTyVsLy($finalizedTyVsLy){
        $this->finalizedtyvsly = $finalizedTyVsLy;
    }
    public function getArePoExpecting(){
        return $this->arepoexpecting;
    }
    public function setArePoExpecting($arePoExpecting){
        $this->arepoexpecting = $arePoExpecting;
    }
    public function getExpectingPoDate(){
        return $this->expectingpodate;
    }
    public function setExpectingPoDate($expectingPoDate){
        $this->expectingpodate = $expectingPoDate;
    }
    public function getIsOpportunitiesSent(){
        return $this->isopportunitiessent;
    }
    public function setIsOpportunitiesSent($isOpportunitiesSent){
        $this->isopportunitiessent = $isOpportunitiesSent;
    }
    public function getOpportunitiesSentDate(){
        return $this->opportunitiessentdate;
    }
    public function setOpportunitiesSentDate($opportunitiesSentDate){
        $this->opportunitiessentdate = $opportunitiesSentDate;
    }
    public function getDinnerApptPlace(){
        return $this->dinnerapptplace;
    }
    public function setDinnerApptPlace($dinnerApptPlace){
        $this->dinnerapptplace = $dinnerApptPlace;
    }
    public function getIsAllCategoriesSelected(){
        return $this->isallcategoriesselected;
    }
    public function setIsAllCategoriesSelected($isAllCategoriesSelected){
        $this->isallcategoriesselected = $isAllCategoriesSelected;
    }
    public function getCategory(){
        return $this->category;
    }
    public function setCategory($category){
        $this->category = $category;
    }
    public function getBuyerHasMoreCategoryNotes(){
        return $this->buyerhasmorecategorynotes;
    }
    public function setBuyerHasMoreCategoryNotes($buyerHasMoreCategoryNotes){
        $this->buyerhasmorecategorynotes = $buyerHasMoreCategoryNotes;
    }
    public function getWhereCustomerSelectHolidayItems(){
        return $this->wherecustomerselectholidayitems;
    }
    public function setWhereCustomerSelectHolidayItems($whereCustomerSelectHolidayItems){
        $this->wherecustomerselectholidayitems = $whereCustomerSelectHolidayItems;
    }
    public function getIsQuestionnaireCompleted(){
        return $this->isquestionnairecompleted;
    }
    public function setIsQuestionnaireCompleted($isQuestionnaireCompleted){
        $this->isquestionnairecompleted = $isQuestionnaireCompleted;
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
                    $value = null;
                    if($array[$attrName] != null){
                        if($array[$attrName] == "yes"){
                            $value = 1;
                        }elseif($array[$attrName] =="no"){
                            $value = 0;
                        }else{
                            $value = null;
                        }
                    }
                }
                    
                
                if (! empty ( $value ) || $isBoolean ) {
                    $this->{$attrName} = $value;
                }
            }
        }
    }
}