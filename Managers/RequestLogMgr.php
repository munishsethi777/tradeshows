<?php
    require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/RequestLog.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestAttributeNameTypes.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestPriorityTypes.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/RequestReportUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestSpecsFieldMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestTypeMgr.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestDepartments.php");

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
            $id =  self::$dataStore->save($requestLog);
            RequestReportUtil::sendCommentAddedOnRequestNotification($requestSeq,$comment);
            return $id;
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
            $requestTypeSeq = $newSavingRequest->getRequestTypeSeq();
            $existingRequestTypeSeq = $existingSavedRequest->getRequestTypeSeq();
            $newRequestTypeSeq = $newSavingRequest->getRequestTypeSeq();
            foreach ($existingRequestProps as $prop) {
                $prop->setAccessible(true);
                $existingSavedRequestValue = $prop->getValue($existingSavedRequest);
                $newRequestProps = $newRequest->getProperty($prop->getName());
                $newRequestProps->setAccessible(true);
                $newSavingRequestValue = $newRequestProps->getValue($newSavingRequest);
                if ($existingSavedRequestValue != $newSavingRequestValue && $prop->getName() != 'lastmodifiedon' && $prop->getName() != 'code') {
                    if($prop->getName()=='requestspecifications'){
                        if($existingRequestTypeSeq == $newRequestTypeSeq){
                            $this->saveUpdatedSpecAttributes($existingSavedRequest->getSeq(),$existingSavedRequestValue,$newSavingRequestValue,$loggedInUserSeq,$requestTypeSeq);
                        }
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
                        $requestLog->setRequestTypeSeq($requestTypeSeq);
                        self::$dataStore->save($requestLog);
                    }
                }
            }
        }
        private function saveUpdatedSpecAttributes($requestSeq,$existingSpecJson,$currentSpecJson,$userSeq,$requestTypeSeq){
            $existingSpecsArr = json_decode($existingSpecJson,true);
            $currentSpecsArr = json_decode($currentSpecJson,true);
            foreach($existingSpecsArr as $key => $oldValue){
                if($currentSpecsArr[$key] != $oldValue){
                    $currentDate = new DateTime();
                    $requestLog = new RequestLog();
                    $requestLog->setRequestSeq($requestSeq);
                    // $requestLog->setAttributeName($key);
                    $requestLog->setCreatedBy($userSeq);
                    $requestLog->setOldValue($oldValue);    
                    $requestLog->setNewValue($currentSpecsArr[$key]);
                    $requestLog->setCreatedOn($currentDate);
                    $requestLog->setIsSpecFieldChange(true);
                    $requestLog->setAttributeName("");
                    $requestLog->setRequestSpecFieldSeq($key);
                    $requestLog->setRequestTypeSeq($requestTypeSeq);
                    self::$dataStore->save($requestLog);
                }
            }
        }
        public function getRequestLogs($requestLogSeq,$requestSeq,$attributeName,$excludeComments=false,$requestLogSeqGreaterThan=""){
            $query = "SELECT requestlogs.*,createdby.fullname as createdbyfullname,oldvalue.fullname as oldvaluefullname,
                    newvalue.fullname as newvaluefullname,requeststatusold.title as requeststatusold, requeststatusnew.title as requeststatusnew, 
                    requestattachments.attachmentfilename, requestspecsfields.name as requestspecfieldname FROM `requestlogs`
                    LEFT JOIN users as createdby on createdby.seq = requestlogs.createdby 
                    LEFT JOIN users as oldvalue on oldvalue.seq = requestlogs.oldvalue
                    LEFT JOIN users as newvalue on newvalue.seq = requestlogs.newvalue
                    LEFT JOIN requeststatuses as requeststatusold on requeststatusold.seq = requestlogs.oldvalue
                    LEFT JOIN requeststatuses as requeststatusnew on requeststatusnew.seq = requestlogs.newvalue 
                    LEFT JOIN requestattachments on requestattachments.seq = requestlogs.newvalue
                    LEFT JOIN requestspecsfields on requestspecsfields.seq = requestlogs.requestspecfieldseq";
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
            if($requestLogSeqGreaterThan != ''){
                if(strpos($query,"WHERE") == false){
                    $query .= " WHERE";
                }else{
                    $query .= " AND";
                }
                $query .= " requestlogs.seq > " . $requestLogSeqGreaterThan;
            }
            $requestLog = self::$dataStore->executeQuery($query,false,true);
            return $requestLog;
        }
        private static function getColor($num) {
            $hash = md5('color' . $num); // modify 'color' to get a different palette
            return array(
                hexdec(substr($hash, 0, 2)), // r
                hexdec(substr($hash, 2, 2)), // g
                hexdec(substr($hash, 4, 2))); //b
        }
        public function commentsHtml($requestLogComments){
            $commentHtml = "";
            if(!empty($requestLogComments)){
                foreach($requestLogComments as $requestLogCommentsRow){
                    $backgroundColor = self::getColor($requestLogCommentsRow['createdby']);
                    $backgroundColor = implode(",",$backgroundColor);
                    $commentHtml .= "<div class='feed-activity-list' id='commentRow". $requestLogCommentsRow['seq'] ."'>";
                    $commentHtml .= "<div class='feed-element' style='margin-top:15px'>";
                    $commentHtml .= "<div class='requestLogCommentsAvatar' style='background:RGB(". $backgroundColor . ")'>";
                    
					$commentHtml .=	"<p>" . self::getUserNameInitials($requestLogCommentsRow['createdbyfullname']) . "</p>";
					$commentHtml .= "</div>";
					$commentHtml .=	"<div class='media-body'>";
                    // $commentHtml .= "<small class='float-right'>5m ago</small>";
                    $commentHtml .= "<strong id='userName" . $requestLogCommentsRow['createdby'] . "'>" . $requestLogCommentsRow['createdbyfullname'] . "</strong> posted a comment. <br>";
                    $commentHtml .= "<small class='text-muted'>" . $requestLogCommentsRow['createdon'] . "</small>";
					$commentHtml .= "<p class='m-t-xs'>" . $requestLogCommentsRow['newvalue'] . ".</p>";
                    $commentHtml .= "</div>";
                    $commentHtml .= "</div>";
					$commentHtml .= "</div>";
                }
            } 
            return $commentHtml;
        }
        public function historyLogHtml($requestLogHistory,$specsFieldTypeArr,$isAppendingHistory = false){
            $requestSpecsFieldMgr = RequestSpecsFieldMgr::getInstance();
            $requestTypeMgr = RequestTypeMgr::getInstance();
            $historyLogHtml = "";
            $historyLog = array();
            $lastUpdatedHistorySeq = null;
            if(!empty($requestLogHistory)){
                $query = "SELECT requests.*,users.fullname FROM requests
                        LEFT JOIN users on users.seq = requests.createdby
                        where requests.seq = " . $requestLogHistory[0]['requestseq'];
                $request = self::$dataStore->executeQuery($query,false,true);
                $backgroundColor = self::getColor($request[0]['createdby']);
                $backgroundColor = implode(",",$backgroundColor);
                if(!$isAppendingHistory){
                    $historyLogHtml .= "<div class='feed-element'>";
                    $historyLogHtml .= "<div class='requestLogCommentsAvatar' style='background:RGB(" . $backgroundColor . "'>";
                    $historyLogHtml .= "<p>" . self::getUserNameInitials($request[0]['fullname']) . "</p>";
                    $historyLogHtml .= "</div>";
                    $historyLogHtml .= "<div class='media-body'>";
                    // $historyLogHtml .= "<small class='float-right'>5m ago</small>";
                    $historyLogHtml .= "<strong id='username'>" . $request[0]['fullname'] . "</strong> created the <b>Request</b> <br>";
                    $historyLogHtml .= "<small class='text-muted' id='createdOnDate'>" . $request[0]['createdon'] . "</small>";
                    $historyLogHtml .= "</div>";
                    $historyLogHtml .= "</div>";
                }
                foreach($requestLogHistory as $requestLogHistoryRow){
                    $backgroundColor = self::getColor($requestLogHistoryRow['createdby']);
                    $backgroundColor = implode(",",$backgroundColor);
                    // $historyLogHtml .= "<small class='float-right'>5m ago</small>";
                    if($requestLogHistoryRow['isspecfieldchange'] == true){// when specs fields are changed
                        $specsFieldTypeArr = $requestSpecsFieldMgr->getSpecsFieldsTypeWithNameTitleByRequestTypeSeq($requestLogHistoryRow['requesttypeseq']);
                        if($requestLogHistoryRow['requestspecfieldname'] != null){
                            $historyLogHtml .= "<div class='feed-element'>";
                            $historyLogHtml .= "<div class='requestLogCommentsAvatar' style='background:RGB(" . $backgroundColor . ")'>";
                            $historyLogHtml .= "<p>" . self::getUserNameInitials($requestLogHistoryRow['createdbyfullname']) . "</p>";
                            $historyLogHtml .= "</div>";
                            $historyLogHtml .= "<div class='media-body'>";
                            $historyLogHtml .= "<strong id='username'>" . $requestLogHistoryRow['createdbyfullname'] . "</strong> changed the <b>" . $specsFieldTypeArr[$requestLogHistoryRow['requestspecfieldname']]['title'] . "</b> <br>";
                            $historyLogHtml .= "<small class='text-muted' id='createdOnDate'>" . $requestLogHistoryRow['createdon'] . "</small>";
                            $oldValue = $requestLogHistoryRow['oldvalue'] != null && $requestLogHistoryRow['oldvalue'] != '' ? $requestLogHistoryRow['oldvalue'] : "NA";
                            $newValue = $requestLogHistoryRow['newvalue'] != null && $requestLogHistoryRow['newvalue'] != '' ? $requestLogHistoryRow['newvalue'] : "NA";
                            if($specsFieldTypeArr[$requestLogHistoryRow['requestspecfieldname']]['fieldtype'] == 'textarea' ){
                                $historyLogHtml .= "<div class='row'>";
                                $historyLogHtml .= "<p class='m-t-sm col-lg-11'>";
                                $historyLogHtml .= "<span class='label1' style='width:45%;display:table-cell' >" . $oldValue . "</span>";
                                $historyLogHtml .= "<i class='fa fa-arrow-right text-default' style='width:5%;display:table-cell;text-align:center;vertical-align:middle'></i>";
                                $historyLogHtml .= "<span class='label1' style='width:45%;display:table-cell'>" . $newValue . "</span>";
                                $historyLogHtml .= "</p>";
                                $historyLogHtml .= "</div>";
                            }elseif($specsFieldTypeArr[$requestLogHistoryRow['requestspecfieldname']]['fieldtype'] == 'yes_no' ){
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
                        }
                    }else{
                        $historyLogHtml .= "<div class='feed-element'>";
                        $historyLogHtml .= "<div class='requestLogCommentsAvatar' style='background:RGB(" . $backgroundColor . ")'>";
                        $historyLogHtml .= "<p>" . self::getUserNameInitials($requestLogHistoryRow['createdbyfullname']) . "</p>";
                        $historyLogHtml .= "</div>";
                        $historyLogHtml .= "<div class='media-body'>";
                        $action = " changed";
                        if($requestLogHistoryRow['attributename'] == 'attachment'){
                            $action = " added";
                        }elseif($requestLogHistoryRow['attributename'] == 'deleteattachment'){
                            $action = " deleted";
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
                            $newValueName = $requestLogHistoryRow['newvalue'];
                        }elseif($requestLogHistoryRow['attributename'] == 'iscompleted'){
                            $oldValueName = $requestLogHistoryRow['oldvalue'] == 1 ? 'On' : 'Off';
                            $newValueName = $requestLogHistoryRow['newvalue'] == 1 ? 'On' : 'Off';
                        }elseif($requestLogHistoryRow['attributename'] == 'requesttypeseq'){
                            $oldRequestType = $requestTypeMgr->findBySeq($requestLogHistoryRow['oldvalue']);
                            $newRequestType = $requestTypeMgr->findBySeq($requestLogHistoryRow['newvalue']);
                            $oldValueName = $oldRequestType->getTitle();
                            $newValueName = $newRequestType->getTitle();
                        }elseif($requestLogHistoryRow['attributename'] == 'department'){
                            $oldValueName = RequestDepartments::getValue($requestLogHistoryRow['oldvalue']);
                            $newValueName = RequestDepartments::getValue($requestLogHistoryRow['newvalue']);
                        }elseif($requestLogHistoryRow['attributename'] == 'deleteattachment'){
                            $oldValueName = "NA";
                            $newValueName = $requestLogHistoryRow['newvalue'];
                        }
                        $historyLogHtml .= "<span class='label label-default'>" . $oldValueName . "</span>";
                        $historyLogHtml .= "<i class='fa fa-arrow-right text-default'></i>";
                        $historyLogHtml .= "<span class='label label-primary'>" . $newValueName . "</span>";
                    }
                    $historyLogHtml .= "</p>";
                    $historyLogHtml .= "</div>";
                    $historyLogHtml .= "</div>";
                    $lastUpdatedHistorySeq = $requestLogHistoryRow['seq'];
                }
            }
            $historyLog['historyLogHtml'] = $historyLogHtml;
            $historyLog['lastUpdatedHistorySeq'] = $lastUpdatedHistorySeq;
            return $historyLog;
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
            $requestLog->setRequestTypeSeq($requestLogArr['requesttypeseq']);
            return self::$dataStore->save($requestLog);
        }
    }
?>