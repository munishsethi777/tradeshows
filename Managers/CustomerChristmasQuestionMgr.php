<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerChristmasQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");
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

    public function findbySeq($seq){
        $customerChristmasQuestion = self::$dataStore->findBySeq($seq);
        $customerChristmasQuestion = $this->convertDateFormat($customerChristmasQuestion);
        return $customerChristmasQuestion;
    }
    public function saveCustomerSpecialProgram($customerChritmas){
        // $this->deleteByCustomerSeq($customerChritmas->getCustomerSeq());
        if(!empty($customerChritmas->getIsAllCategoriesSelected())){
            $allCategories = BuyerCategoryType::getAll();
            $allCategoriesNames = array_keys($allCategories);
            $allCategories = implode(",", $allCategoriesNames);
            $customerChritmas->setCategory($allCategories);
        }
        // $this->validateFormCategories($customerChritmas);
        $id = self::$dataStore->save($customerChritmas);
        return $id;
    }
    private function validateFormCategories($christmasQuestion){
        // $springQuestion = new CustomerSpringQuestion();
         $categories = $christmasQuestion->getCategory();
         $categoriesArr = array();
         if(!empty($categories)){
             $categoriesArr = explode(",", $categories);
         }
         $existingCategories = $this->getCatgoriesByCustomerSeq($christmasQuestion);
         $duplicateCategories = array();
         foreach ($categoriesArr as $category){
             foreach ($existingCategories as $existingCategory){
                 $existingCategory = explode(",", $existingCategory);
                 if(in_array($category, $existingCategory)){
                     $categoryValue = BuyerCategoryType::getValue($category);
                     array_push($duplicateCategories,$categoryValue);
                 }
             }
         }
         if(!empty($duplicateCategories)){
             $duplicateCategories = implode(",", $duplicateCategories);
             throw new Exception("Questionnarie already saved for categories :- " . $duplicateCategories);
         }
    }
    private function getCatgoriesByCustomerSeq($springQuestion){
        $seq = $springQuestion->getSeq();
        $customerSeq = $springQuestion->getCustomerSeq();
        $query = "select category from customerspringquestions where customerseq in ($customerSeq)";
        if(!empty($seq)){
            $query .= " and seq != $seq";
        }
        $springQuestions = self::$dataStore->executeQuery($query, false,true);
        if(!empty($springQuestions)){
            $category  = array_map(create_function('$o', 'return $o["category"];'), $springQuestions);
            return $category;
        }
        return array();
    }
    public function deleteByCustomerSeq($customerSeq){
        $query = "delete from customerchristmasquestions where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    public function deleteBySeq($seq){
        $flag = self::$dataStore->deleteBySeq($seq);
        return $flag;
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
    	return $customerChritmasQuestion = self::$dataStore->executeConditionQueryForArray($condition);
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
        
        $dateStr = $customerChritmasQuestion->getCompShopCompletedDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerChritmasQuestion->setCompShopCompletedDate($dateStr);
        
        return $customerChritmasQuestion;
    }
}