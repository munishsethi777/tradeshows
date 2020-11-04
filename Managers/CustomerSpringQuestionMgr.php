<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/CustomerSpringQuestion.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/BuyerCategoryType.php");

class CustomerSpringQuestionMgr
{
    private static  $CustomerSpringQuestionMgr;
    private static $dataStore;
    
    public static function getInstance()
    {
        if (!self::$CustomerSpringQuestionMgr)
        {
            self::$CustomerSpringQuestionMgr = new CustomerSpringQuestionMgr();
            self::$dataStore = new BeanDataStore(CustomerSpringQuestion::$className, CustomerSpringQuestion::$tableName);
        }
        return self::$CustomerSpringQuestionMgr;
    }
    
    public function saveSpringQuestion($springQuestion){
        //$this->deleteByCustomerSeq($springQuestion->getCustomerSeq());
        if(!empty($springQuestion->getIsAllCategoriesSelected())){
            $allCategories = BuyerCategoryType::getAll();
            $allCategoriesNames = array_keys($allCategories);
            $allCategories = implode(",", $allCategoriesNames);
            $springQuestion->setCategory($allCategories);
        }
        $this->validateFormCategories($springQuestion);
        $id = self::$dataStore->save($springQuestion);
        return $id;
    }
    
    private function validateFormCategories($springQuestion){
       // $springQuestion = new CustomerSpringQuestion();
        $categories = $springQuestion->getCategory();
        $categoriesArr = array();
        if(!empty($categories)){
            $categoriesArr = explode(",", $categories);
        }
        $existingCategories = $this->getCatgoriesByCustomerSeq($springQuestion);
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
        $query = "delete from customerspringquestions where customerseq in ($customerSeq)";
        return self::$dataStore->executeQuery($query);
    }
    
    public function deleteBySeq($seq){
        $flag = self::$dataStore->deleteBySeq($seq);
        return $flag;
    }
    
    public function findByCustomerSeq($customerSeq){
        $condition = array("customerseq"=>$customerSeq);
        $customerSpringQuestions = self::$dataStore->executeConditionQuery($condition);
        if(!empty($customerSpringQuestions)){
            $customerSpringQuestions = $this->convertDateFormat($customerSpringQuestions[0]);
            return $customerSpringQuestions;
        }
        return null;
    }
    
    public function findArrByCustomerSeq($customerSeq){
        $query = "select * from customerspringquestions where customerseq = $customerSeq";
        $customerSpringQuestions = self::$dataStore->executeQuery($query,false,true);
        return $customerSpringQuestions;
    }
    
     public function findCategoryAndSeqByCustomerSeq($customerSeq){
        $query = "select seq,category from customerspringquestions where customerseq = $customerSeq";
        $customerSpringQuestions = self::$dataStore->executeQuery($query,false,true);
        $mainArr = array();
        foreach($customerSpringQuestions as $customerSpringQuestion){
            $arr = array();
            $seq = $customerSpringQuestion["seq"];
            $categoryNames = $customerSpringQuestion["category"];
            $categoryArr = explode(",", $categoryNames);
            $categoryValueArr = array();
            foreach ($categoryArr as $category){
                $categoryValue = BuyerCategoryType::getValue($category);
                array_push($categoryValueArr,$categoryValue);
            }
            $arr["id"] = $seq;
            $arr["category"] = implode(", ",$categoryValueArr);
            array_push($mainArr,$arr);
        }
        return $mainArr;
    }
    public function findArrBySeq($seq){
        $query = "select * from customerspringquestions where seq = $seq";
        $customerSpringQuestions = self::$dataStore->executeQuery($query,false,true);
        if(!empty($customerSpringQuestions)){
            return $customerSpringQuestions[0];
        }
        return $customerSpringQuestions;
    }
    public function findbySeq($seq){
        $customerSpringQuestion = self::$dataStore->findBySeq($seq);
        $customerSpringQuestion = $this->convertDateFormat($customerSpringQuestion);
        return $customerSpringQuestion;
    }
    
    private function convertDateFormat($customerSpringQuestion){
        $fromFormat = "Y-m-d";
        $toFormat = "m-d-Y";
        $dateStr = $customerSpringQuestion->getStrategicPlanningMeetingDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setStrategicPlanningMeetingDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getInvitedToSpringShowroomDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setInvitedToSpringShowroomDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getInvitedToSpringShowroomReminderDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setInvitedToSpringShowroomReminderDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getChristmasQuoteByDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setChristmasQuoteByDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getSpringReviewingDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setSpringReviewingDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getQuoteSpringByDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setQuoteSpringByDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getSpringCatalogLinkDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setSpringCatalogLinkDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getSpringSampleDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setSpringSampleDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getCompShopCompletionDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setCompShopCompletionDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getCompShopSummeryEmailSentDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setCompShopSummeryEmailSentDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getExpectingPoDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setExpectingPoDate($dateStr);
        
        $dateStr = $customerSpringQuestion->getOpportunitiesSentDate();
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion->setOpportunitiesSentDate($dateStr);
        
        return $customerSpringQuestion;
    }
    
    private function convertDateFormatForArr($customerSpringQuestion){
        $fromFormat = "Y-m-d";
        $toFormat = "m-d-Y";
        $dateStr = $customerSpringQuestion["strategicplanningmeetingmate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["strategicplanningmeetingmate"] = $dateStr;
        
        $dateStr = $customerSpringQuestion["invitedtospringshowroomdate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["invitedtospringshowroomdate"] = $dateStr;
        
        $dateStr =  $customerSpringQuestion["invitedtospringshowroomreminderdate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["invitedtospringshowroomreminderdate"] = $dateStr;
        
        $dateStr =  $customerSpringQuestion["christmasquotebydate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["christmasquotebydate"] = $dateStr;
        
        $dateStr = $customerSpringQuestion["springreviewingdate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["springreviewingdate"] = $dateStr;
        
        $dateStr = $customerSpringQuestion["quotespringbydate"];
        $dateStr = DateUtil::convertDateToFormat($dateStr, $fromFormat, $toFormat);
        $customerSpringQuestion["quotespringbydate"] = $dateStr;
        return $customerSpringQuestion;
    }
    
}
