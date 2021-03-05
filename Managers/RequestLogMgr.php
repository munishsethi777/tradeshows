<?php
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/RequestLog.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestAttributeNameTypes.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestPriorityTypes.php");

    class RequestLogMgr{
        private static $requestLogMgr;
        private static $dataStore;
        private static $selectSql = "SELECT * FROM requestlogs";

        public static function getInstance(){
            if (!self::$requestLogMgr){
                self::$requestLogMgr = new RequestLogMgr();
                self::$dataStore = new BeanDataStore(RequestLog::$className,RequestLog::$tableName);
            }
            return self::$requestLogMgr;
        }
        public function saveComment($REQUEST){
            $requestLog = new RequestLog();
            $requestSeq = $REQUEST['requestSeq'];
            $loggedInUserSeq = $REQUEST['loggedInUserSeq'];
            $comment = $REQUEST['comment'];
            $currentDate = new DateTime();
            $requestLog->setRequestSeq($requestSeq);
            $requestLog->setNewValue($comment);
            $requestLog->setAttributeName("comment");
            $requestLog->setCreatedBy($loggedInUserSeq);
            $requestLog->setCreatedOn($currentDate);
            return self::$dataStore->save($requestLog);
        }
        public function findByRequestSeq($seq){
            $query = self::$selectSql . " WHERE requestseq = " . $seq;
            $requestSpecsFieldArray = self::$dataStore->executeQuery($query,false,true);
            return $requestSpecsFieldArray;
        }
        public function findByColValuePair($colValuePairArr){
            $requestStatus = self::$dataStore->executeConditionQuery($colValuePairArr);
            return $requestStatus;
        }
        public function saveUpdatedAttributes($existingSavedRequest,$newSavingRequest,$loggedInUserSeq){
            $existingRequest = new \ReflectionClass($existingSavedRequest);
            $newRequest = new \ReflectionClass($newSavingRequest);
            $existingRequestProps = $existingRequest->getProperties();
            $fieldsChangedArr = array();
            foreach ($existingRequestProps as $prop) {
                $prop->setAccessible(true);
                $existingSavedRequestValue = $prop->getValue($existingSavedRequest);
                $newRequestProps = $newRequest->getProperty($prop->getName());
                $newRequestProps->setAccessible(true);
                $newSavingRequestValue = $newRequestProps->getValue($newSavingRequest);
                if ($existingSavedRequestValue != $newSavingRequestValue && $prop->getName() != 'lastmodifiedon') {
                    if($prop->getName()=='requestspecifications'){
                        $this->saveUpdatedSpecAttributes($existingSavedRequest->getSeq(),$existingSavedRequestValue,$newSavingRequestValue,$loggedInUserSeq);
                    }else{
                        $currentDate = new DateTime();
                        $requestLog = new RequestLog();
                        $requestLog->setRequestSeq($existingSavedRequest->getSeq());
                        $requestLog->setAttributeName($newRequestProps->getName());
                        $requestLog->setCreatedBy($loggedInUserSeq);
                        $requestLog->setOldValue($existingSavedRequestValue);
                        $requestLog->setNewValue($newSavingRequestValue);
                        $requestLog->setCreatedOn($currentDate);
                        $requestLog->setIsSpecFieldChange(0);
                        self::$dataStore->save($requestLog);
                    }
                }
            }
        }
        private function saveUpdatedSpecAttributes($requestSeq,$existingSpecJson,$currentSpecJson,$userSeq){
            $existingSpecsArr = json_decode($existingSpecJson,true);
            $currentSpecsArr = json_decode($currentSpecJson,true);
            foreach($existingSpecsArr as $key => $oldValue){
                if($currentSpecsArr[$key] != $oldValue){
                    $currentDate = new DateTime();
                    $requestLog = new RequestLog();
                    $requestLog->setRequestSeq($requestSeq);
                    $requestLog->setAttributeName($key);
                    $requestLog->setCreatedBy($userSeq);
                    $requestLog->setOldValue($oldValue);    
                    $requestLog->setNewValue($currentSpecsArr[$key]);
                    $requestLog->setCreatedOn($currentDate);
                    $requestLog->setIsSpecFieldChange(true);
                    self::$dataStore->save($requestLog);
                }
            }
        }
        public function getRequestLogs($requestLogSeq,$requestSeq,$attributeName,$excludeComments=false){
            $query = "SELECT requestlogs.*,createdby.fullname as createdbyfullname,oldvalue.fullname as oldvaluefullname,newvalue.fullname as newvaluefullname,requeststatusold.title as requeststatusold, requeststatusnew.title as requeststatusnew, requestattachments.attachmentfilename FROM `requestlogs`
                    LEFT JOIN users as createdby on createdby.seq = requestlogs.createdby 
                    LEFT JOIN users as oldvalue on oldvalue.seq = requestlogs.oldvalue
                    LEFT JOIN users as newvalue on newvalue.seq = requestlogs.newvalue
                    LEFT JOIN requeststatuses as requeststatusold on requeststatusold.seq = requestlogs.oldvalue
                    LEFT JOIN requeststatuses as requeststatusnew on requeststatusnew.seq = requestlogs.newvalue 
                    LEFT JOIN requestattachments on requestattachments.seq = requestlogs.newvalue";
            if($requestLogSeq != ""){
                if(strpos($query,"WHERE") == false){
                    $query .= " WHERE";
                }else{
                    $query .= " AND";
                }
                $query .= " requestlogs.seq=" . $requestLogSeq;
            }
            if($requestSeq != ""){
                if(strpos($query,"WHERE") == false){
                   $query .= " WHERE";
                }else{
                    $query .= " AND";
                }
                $query .= " requestlogs.requestseq=" . $requestSeq;
            }
            if($attributeName != ""){
                if(strpos($query,"WHERE") == false){
                    $query .= " WHERE";
                }else{
                    $query .= " AND";
                }
                $query .= " requestlogs.attributename LIKE '%" . $attributeName . "%'";
            }
            if($excludeComments){
                if(strpos($query,"WHERE") == false){
                    $query .= " WHERE";
                }else{
                    $query .= " AND";
                }
                $query .= " requestlogs.attributename NOT LIKE '%comment%'";
            }
            $requestLog = self::$dataStore->executeQuery($query,false,true);
            return $requestLog;
        }
        public function commentsHtml($requestLogComments){
            $commentHtml = "";
            if(!empty($requestLogComments)){
                $colorArray = array("#FC766AFF","#5B84B1FF","#42EADDFF","#CDB599FF","#00A4CCFF","#F95700FF","#00203FFF","#ADEFD1FF","#606060FF","#2C5F2D","#00539CFF");
                $backgroundColorArr = array();
                foreach($requestLogComments as $requestLogCommentsRow){
                    $backgroundColorArr[$requestLogCommentsRow['createdby']] =  $colorArray[array_rand($colorArray)];
                }
                foreach($requestLogComments as $requestLogCommentsRow){
                    $commentHtml .= "<div class='feed-activity-list' id='commentRow". $requestLogCommentsRow['seq'] ."'>";
                    $commentHtml .= "<div class='feed-element' style='margin-top:15px'>";
                    $commentHtml .= "<div class='requestLogCommentsAvatar' style='background:" . $backgroundColorArr[$requestLogCommentsRow['createdby']] . "'>";
					$commentHtml .=	"<p>" . self::getUserNameInitials($requestLogCommentsRow['createdbyfullname']) . "</p>";
					$commentHtml .= "</div>";
					$commentHtml .=	"<div class='media-body'>";
                    // $commentHtml .= "<small class='float-right'>5m ago</small>";
                    $commentHtml .= "<strong id='userName" . $requestLogCommentsRow['createdBy'] . "'>" . $requestLogCommentsRow['createdbyfullname'] . "</strong> posted a comment. <br>";
                    $commentHtml .= "<small class='text-muted'>" . $requestLogCommentsRow['createdon'] . "</small>";
					$commentHtml .= "<p class='m-t-xs'>" . $requestLogCommentsRow['newvalue'] . ".</p>";
                    $commentHtml .= "</div>";
                    $commentHtml .= "</div>";
					$commentHtml .= "</div>";
                }
            } 
            return $commentHtml;
        }
        public function historyLogHtml($requestLogHistory,$specsFieldTypeArr){
            $historyLogHtml = "";
            
            if(!empty($requestLogHistory)){
                $query = "SELECT requests.*,users.fullname FROM requests
                        LEFT JOIN users on users.seq = requests.createdby
                        where requests.seq = " . $requestLogHistory[0]['requestseq'];
                $request = self::$dataStore->executeQuery($query,false,true);
                $colorArray = array("#FC766AFF","#5B84B1FF","#42EADDFF","#CDB599FF","#000000FF","#FFFFFFFF","#00A4CCFF","#F95700FF","#00203FFF","#ADEFD1FF","#606060FF","#2C5F2D","#00539CFF");
                $backgroundColorArr = array();
                foreach($requestLogHistory as $requestLogHistoryRow){
                    $backgroundColorArr[$requestLogHistoryRow['createdby']] =  $colorArray[array_rand($colorArray)];
                }
                $historyLogHtml .= "<div class='feed-element'>";
                $historyLogHtml .= "<div class='requestLogCommentsAvatar' style='background:" . $backgroundColorArr[$request[0]['createdby']] . "'>";
                $historyLogHtml .= "<p>" . self::getUserNameInitials($request[0]['fullname']) . "</p>";
                $historyLogHtml .= "</div>";
                $historyLogHtml .= "<div class='media-body'>";
                // $historyLogHtml .= "<small class='float-right'>5m ago</small>";
                $historyLogHtml .= "<strong id='username'>" . $request[0]['fullname'] . "</strong> created the <b>Request</b> <br>";
                $historyLogHtml .= "<small class='text-muted' id='createdOnDate'>" . $request[0]['createon'] . "</small>";
                $historyLogHtml .= "</div>";
                $historyLogHtml .= "</div>";
                foreach($requestLogHistory as $requestLogHistoryRow){
                    $historyLogHtml .= "<div class='feed-element'>";
                    $historyLogHtml .= "<div class='requestLogCommentsAvatar' style='background:" . $backgroundColorArr[$requestLogHistoryRow['createdby']] . "'>";
                    $historyLogHtml .= "<p>" . self::getUserNameInitials($requestLogHistoryRow['createdbyfullname']) . "</p>";
                    $historyLogHtml .= "</div>";
                    $historyLogHtml .= "<div class='media-body'>";
                    // $historyLogHtml .= "<small class='float-right'>5m ago</small>";
                    if($requestLogHistoryRow['isspecfieldchange'] == true){// when specs fields are changed
                        $historyLogHtml .= "<strong id='username'>" . $requestLogHistoryRow['createdbyfullname'] . "</strong> changed the <b>" . $specsFieldTypeArr[$requestLogHistoryRow['attributename']]['title'] . "</b> <br>";
                        $historyLogHtml .= "<small class='text-muted' id='createdOnDate'>" . $requestLogHistoryRow['createdon'] . "</small>";
                        
                        $oldValue = $requestLogHistoryRow['oldvalue'] != null && $requestLogHistoryRow['oldvalue'] != '' ? $requestLogHistoryRow['oldvalue'] : "NA";
                        $newValue = $requestLogHistoryRow['newvalue'] != null && $requestLogHistoryRow['newvalue'] != '' ? $requestLogHistoryRow['newvalue'] : "NA";
                        
                        if($specsFieldTypeArr[$requestLogHistoryRow['attributename']]['fieldtype'] == 'textarea' ){
                            $historyLogHtml .= "<div class='row'>";
                            $historyLogHtml .= "<p class='m-t-sm col-lg-11'>";
                            $historyLogHtml .= "<span class='label1' style='width:45%;display:table-cell' >" . $oldValue . "</span>";
                            $historyLogHtml .= "<i class='fa fa-arrow-right text-default' style='width:5%;display:table-cell;text-align:center;vertical-align:middle'></i>";
                            $historyLogHtml .= "<span class='label1' style='width:45%;display:table-cell'>" . $newValue . "</span>";
                            $historyLogHtml .= "</p>";
                            $historyLogHtml .= "</div>";
                        }elseif($specsFieldTypeArr[$requestLogHistoryRow['attributename']]['fieldtype'] == 'yes_no' ){
                            $oldValue = $requestLogHistoryRow['oldvalue'] == '1' ? 'Yes' : 'No';
                            $newValue = $requestLogHistoryRow['newvalue'] == '1' ? 'Yes' : 'No';
                            $historyLogHtml .= "<p class='m-t-sm'>";
                            $historyLogHtml .= "<span class='label label-default'>" . $oldValue . "</span>";
                            $historyLogHtml .= "<i class='fa fa-arrow-right text-default'></i>";
                            $historyLogHtml .= "<span class='label label-primary'>" . $newValue . "</span>";
                        }else{
                            $historyLogHtml .= "<p class='m-t-sm'>";
                            $historyLogHtml .= "<span class='label label-default'>" . $oldValue . "</span>";
                            $historyLogHtml .= "<i class='fa fa-arrow-right text-default'></i>";
                            $historyLogHtml .= "<span class='label label-primary'>" . $newValue . "</span>";
                        }
                    }else{
                        $action = " changed";
                        if($requestLogHistoryRow['attributename'] == 'attachment'){
                            $action = " added";
                        }
                        $historyLogHtml .= "<strong id='username'>" . $requestLogHistoryRow['createdbyfullname'] . "</strong> " . $action . " the <b>" . RequestAttributeNameTypes::getValue($requestLogHistoryRow['attributename']) . "</b> <br>";
                        $historyLogHtml .= "<small class='text-muted' id='createdOnDate'>" . $requestLogHistoryRow['createdon'] . "</small>";
                        $historyLogHtml .= "<p class='m-t-sm'>";
                        $oldValueName = $requestLogHistoryRow['oldvalue'] != null && $requestLogHistoryRow['oldvalue'] != '' ? $requestLogHistoryRow['oldvalue'] : "NA";
                        $newValueName = $requestLogHistoryRow['newvalue'] != null && $requestLogHistoryRow['newvalue'] != '' ? $requestLogHistoryRow['newvalue'] : "NA";
                        if($requestLogHistoryRow['attributename'] == 'assignedby' || $requestLogHistoryRow['attributename'] == 'assignedto'){
                            if(isset($requestLogHistoryRow['oldvaluefullname']) && $requestLogHistoryRow['oldvaluefullname'] != ''){
                                $oldValueName = $requestLogHistoryRow['oldvaluefullname'];
                            }
                            if(isset($requestLogHistoryRow['newvaluefullname']) && $requestLogHistoryRow['newvaluefullname'] != ''){
                                $newValueName = $requestLogHistoryRow['newvaluefullname'];
                            }
                        }elseif($requestLogHistoryRow['attributename'] == 'requeststatusseq'){
                            if(isset($requestLogHistoryRow['requeststatusold']) && $requestLogHistoryRow['requeststatusold'] != ''){
                                $oldValueName = $requestLogHistoryRow['requeststatusold'];
                            }
                            if(isset($requestLogHistoryRow['requeststatusnew']) && $requestLogHistoryRow['requeststatusnew'] != ''){
                                $newValueName = $requestLogHistoryRow['requeststatusnew'];
                            }
                        }elseif($requestLogHistoryRow['attributename'] == 'isrequiredapprovalfrommanager' 
                            || $requestLogHistoryRow['attributename'] == 'isrequiredapprovalfromrequester'
                            || $requestLogHistoryRow['attributename'] == 'isrequiredapprovalfromrobby'){
                            $oldValueName = $requestLogHistoryRow['oldvalue'] == 1 ? 'Yes' : 'No';
                            $newValueName = $requestLogHistoryRow['newvalue'] == 1 ? 'Yes' : 'No';
                        }elseif($requestLogHistoryRow['attributename'] == 'priority'){
                            $oldValueName = RequestPriorityTypes::getValue($requestLogHistoryRow['oldvalue']);
                            $newValueName = RequestPriorityTypes::getValue($requestLogHistoryRow['newvalue']);
                        }elseif($requestLogHistoryRow['attributename'] == 'attachment'){
                            $oldValueName = "NA";
                            $newValueName = $requestLogHistoryRow['attachmentfilename'];
                        }
                        $historyLogHtml .= "<span class='label label-default'>" . $oldValueName . "</span>";
                        $historyLogHtml .= "<i class='fa fa-arrow-right text-default'></i>";
                        $historyLogHtml .= "<span class='label label-primary'>" . $newValueName . "</span>";
                    }
                    $historyLogHtml .= "</p>";
                    $historyLogHtml .= "</div>";
                    $historyLogHtml .= "</div>";
                }
            }
            return $historyLogHtml;
        }
        public static function getUserNameInitials($userName){
            $userNameArr = explode(" ",$userName);
            $initial = '';
            $i=1;
            foreach($userNameArr as $name){
                if($i > 2){
                    break;
                }
                $initial .= substr($name,0,1);
                $i++;
            }
            return $initial;
        }
        public static function save($requestLogArr){
            $requestLog = new RequestLog();
            $requestLog->setRequestSeq($requestLogArr['requestseq']);
            $requestLog->setOldValue($requestLogArr['oldvalue']);
            $requestLog->setNewValue($requestLogArr['newvalue']);
            $requestLog->setAttributeName($requestLogArr['attribute']);
            $requestLog->setCreatedBy($requestLogArr['createdby']);
            $requestLog->setCreatedOn($requestLogArr['createdon']);
            return self::$dataStore->save($requestLog);
        }
    }
?>