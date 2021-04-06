<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/RequestSpecsField.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

    class RequestSpecsFieldMgr{
        private static $requestSpecsFieldMgr;
        private static $dataStore;
        private static $selectSql = "SELECT * FROM requestspecsfields";

        public static function getInstance(){
            if (!self::$requestSpecsFieldMgr){
                self::$requestSpecsFieldMgr = new RequestSpecsFieldMgr();
                self::$dataStore = new BeanDataStore(RequestSpecsField::$className,RequestSpecsField::$tableName);
            }
            return self::$requestSpecsFieldMgr;
        }
        public function save($request,$requestTypeSeq){
            $earlierRequestFields = self::findByRequestTypeSeq($requestTypeSeq);
            if(count($earlierRequestFields)){
                foreach($earlierRequestFields as $earlierRequestField){
                    $requestFieldSeq = $earlierRequestField['seq'];
                    if(!empty($request['requestfieldtitle'.$requestFieldSeq])){
                         $isRequired = 0;
                        if(isset($request['required'.$requestFieldSeq]) && $request['required'.$requestFieldSeq] == 'yes' ){
                            $isRequired = true;
                        }
                        $isVisible = 0;
                        if(isset($request['isvisible'.$requestFieldSeq]) && $request['isvisible'.$requestFieldSeq] == 'yes' ){
                            $isVisible = true;
                        }
                        $colValuePair = array();
                        $colValuePair['title'] = $request['requestfieldtitle'.$requestFieldSeq];
                        $colValuePair['fieldtype'] = $request['requestfieldtype'.$requestFieldSeq];
                        $colValuePair['isrequired'] = $isRequired;
                        $colValuePair['isvisible'] = $isVisible;
                        
                        
                        $conditionPair = array();
                        $conditionPair['seq'] = $requestFieldSeq;
                        self::$dataStore->updateByAttributes($colValuePair,$conditionPair);

                    }else{
                        self::$dataStore->deleteBySeq($requestFieldSeq);
                    }
                }
            }
            if(isset($request['requestfieldtitle'])){
                for($i=0; $i < count($request['requestfieldtitle']); $i++){
                    if(!empty($request['requestfieldtitle'][$i])){
                        $requestSpecsField = new RequestSpecsField();
                        $requestSpecsField->setRequestTypeSeq($requestTypeSeq);
                        $requestSpecsField->setTitle($request['requestfieldtitle'][$i]);
                        $requestSpecsField->setName(strtolower(str_replace(' ','_',$request['requestfieldtitle'][$i])));
                        $requestSpecsField->setFieldType($request['requestfieldtype'][$i]);
                        $isRequired = 0;
                        if(isset($request['required'][$i]) && $request['required'][$i] == 'yes' ){
                            $isRequired = true;
                        }
                        $requestSpecsField->setIsRequired($isRequired);
                        $isVisible = 0;
                        if(isset($request['isvisible'][$i]) && $request['isvisible'][$i] == 'yes' ){
                            $isVisible = true;
                        }
                        $requestSpecsField->setIsVisible($isVisible);
                        if($request['requestfieldtype'][$i] == 'dropdown'){
                            $details = str_replace("\n", ",", $request['details'][$i]);
                            $requestSpecsField->setDetails($details);
                        }
                        self::$dataStore->save($requestSpecsField);
                    }
                }
            } 
        }
        public function findByRequestTypeSeq($seq){
            $query = self::$selectSql . " WHERE requesttypeseq = " . $seq;
            $requestSpecsFieldArray = self::$dataStore->executeQuery($query,false,true);
            return $requestSpecsFieldArray;
        }
        public function deleteByRequestTypeSeq($seq){
            $colValuePair['requestTypeSeq'] = $seq;
            self::$dataStore->deleteByAttribute($colValuePair);
        }
        public function findByColValuePair($col,$val){
            $colValuePair = array();
            $colValuePair[$col] = $val;
            $requestStatus = self::$dataStore->executeConditionQuery($colValuePair);
            return $requestStatus;
        }
        public function getSpecsFieldsTypeWithNameTitleByRequestTypeSeq($requestTypeSeq){
            $query = "SELECT name,title,fieldtype FROM `requestspecsfields` where requesttypeseq=" . $requestTypeSeq;
            $requestSpecsFieldArray = self::$dataStore->executeQuery($query,false,true);
            $tempArr = array();
            $specsFieldTypeArr = array();
            foreach($requestSpecsFieldArray as $arr){
                $tempArr['name'] = $arr['fieldtype'];
                $tempArr['title'] = $arr['fieldtype'];
                $tempArr['fieldtype'] = $arr['fieldtype'];
                $specsFieldTypeArr[$arr['name']] =  $arr;
            }
            return $specsFieldTypeArr;
        }
    }
?>