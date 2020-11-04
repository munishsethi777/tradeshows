<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerChristmasQuestion.php");
class CustomerChristmasQuestionMgr{
    
    
    private static  $customerChritmasQuestionMgr;
    private static $dataStore;
    public static function getInstance()
    {
        if (!self::$customerChritmasQuestionMgr)
        {
            self::$customerChritmasQuestionMgr = new CustomerChristmasQuestionMgr();
            self::$dataStore = new BeanDataStore(CustomerChristmasQuestion::$className, CustomerChristmasQuestion::$tableName);
        }
        return self::$customerChritmasQuestionMgr;
    }
    
    public function saveCustomerSpecialProgram($customerChritmasQuestionMgr){
        $this->deleteByCustomerSeq($customerChritmasQuestionMgr->getCustomerSeq());
        $id = self::$dataStore->save($customerChritmasQuestionMgr);
        return $id;
    }
    
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from customerchristmasquestions where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    
    
    //for edit mode
    public function findByCustomerSeq($customerSeq){
        $condition = array("customerseq"=>$customerSeq);
        $customerChritmasQuestion = self::$dataStore->executeConditionQuery($condition);
        if(!empty($customerChritmasQuestion)){
            $customerChritmasQuestion = $this->convertDateFormat($customerChritmasQuestion[0]);
            return $customerChritmasQuestion;
        }
        return null;
    }
    public function findArrByCustomerSeq($customerSeq){
    	$condition = array("customerseq"=>$customerSeq);
    	$customerChritmasQuestion = self::$dataStore->executeConditionQueryForArray($condition);
    	if(!empty($customerChritmasQuestion)){
    	    $customerChritmasQuestion = $customerChritmasQuestion[0];
    	    $customerChritmasQuestion["isinterested"] = $this->getYesNo($customerChritmasQuestion["isinterested"]);
    	    $customerChritmasQuestion["iscataloglinksent"] = $this->getYesNo($customerChritmasQuestion["iscataloglinksent"]);
    	    $customerChritmasQuestion["isxmassamplessent"] = $this->getYesNo($customerChritmasQuestion["isinterested"]);
    	    $customerChritmasQuestion["isstrategicplanningmeetingappointment"] = $this->getYesNo($customerChritmasQuestion["isstrategicplanningmeetingappointment"]);
    	    $customerChritmasQuestion["isinvitedtoxmasshowroom"] = $this->getYesNo($customerChritmasQuestion["isinvitedtoxmasshowroom"]);
    	    $customerChritmasQuestion["isholidayshopcompleted"] = $this->getYesNo($customerChritmasQuestion["isholidayshopcompleted"]);
    	    $customerChritmasQuestion["isholidayshopcomsummaryemailsent"] = $this->getYesNo($customerChritmasQuestion["isholidayshopcomsummaryemailsent"]);
    	    $customerChritmasQuestion["ismainvendor"] = $this->getYesNo($customerChritmasQuestion["ismainvendor"]);
    	    $customerChritmasQuestion["isxmasbuylastyear"] = $this->getYesNo($customerChritmasQuestion["isxmasbuylastyear"]);
    	    $customerChritmasQuestion["isreceivingsellthru"] = $this->getYesNo($customerChritmasQuestion["isreceivingsellthru"]);
    	    $customerChritmasQuestion["isrobbyreviewedsellthrough"] = $this->getYesNo($customerChritmasQuestion["isrobbyreviewedsellthrough"]);
    	    $customerChritmasQuestion["isvisitcustomerin4qtr"] = $this->getYesNo($customerChritmasQuestion["isvisitcustomerin4qtr"]);
    	    return $customerChritmasQuestion;
    	}
    	return null;
    }
    private function getYesNo($bool){
        if(!empty($bool)){
            return "Yes";
        }
        return "No";
    }
    private function convertDateFormat($customerChritmasQuestion){
        $fromFormat = "Y-m-d";
        $toFormat = "m-d-Y";
        
        $dateStr = $customerChritmasQuestion->getStrategicPlanningMeetDate();  
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setStrategidPlanningMeetDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getInvitedtoXmasShowRoomDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setInvitedtoXmasShowRoomDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getInvitedToxMasShowroomReminderDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setInvitedToxMasShowroomReminderDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getChristmas2020ReviewingDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setChristmas2020ReviewingDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getChristMasquoteByDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setChristMasquoteByDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getCataloglinkDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setCataloglinkDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getDinnerApptDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setDinnerApptDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getXmasSampleSentDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setXmasSampleSentDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getCompShopSummaryEmailSentDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setCompShopSummaryEmailSentDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getExpectingPoDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setExpectingPoDate($dateStr);
        
        $dateStr = $customerChritmasQuestion->getOpportunitiesSentDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setOpportunitiesSentDate($dateStr);
        
        
        
        return $customerChritmasQuestion;
    }
}