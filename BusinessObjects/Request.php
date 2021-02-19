<?php
class Requests{
    private $seq, $code, $priority, $title, $descriptiontext, $departmentseq, $requesttypeseq, $requestspecifications, $createdby, $assignedby, $assignedto, $duedate,
        $startdate, $estimatedhours, $requeststatusseq, $isrequiredapprovalfrommanager, $isrequiredapprovalfromrequester, $isrequiredapprovalfromrobby, $approvedbymanagerdate,
        $approvedbyrequesterdate, $approvedbyrobbydate, $completeddate, $actualhours, $iscompleted, $createdon, $lastmodifiedon;

        public static $className = "Requests";
        public static $tableName = "requests";
    
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function setCode($code){
        $this->code = $code;
    }
    public function getCode(){
        return $this->code;
    }
    public function setPriority($priority){
        $this->priority = $priority;
    }
    public function getPriority(){
        return $this->priority;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setDescriptionText($descriptiontext){
        $this->descriptiontext = $descriptiontext;
    }
    public function getDescriptionText(){
        return $this->descriptiontext;
    }
    public function setDepartmentSeq($departmentseq){
        $this->departmentseq = $departmentseq;
    }
    public function getDepartmentSeq(){
        return $this->departmentseq;
    }
    public function setRequestTypeSeq($requesttypeseq){
        $this->requesttypeseq = $requesttypeseq;
    }
    public function getRequestTypeSeq(){
        return $this->requesttypeseq;
    }
    public function setRequestSpecifications($requestspecifications){
        $this->requestspecifications = $requestspecifications;
    }
    public function getRequestSpecifications(){
        return $this->requestspecifications;
    }
    public function setCreatedBy($createdby){
        $this->createdby = $createdby;
    }
    public function getCreatedBy(){
        return $this->createdby;
    }
    public function setAssignedBy($assignedby){
        $this->assignedby = $assignedby;
    }
    public function getAssignedBy(){
        return $this->assignedby;
    }
    public function setAssignedTo($assignedto){
        $this->assignedto = $assignedto;
    }
    public function getAssignedTo(){
        return $this->assignedto;
    }
    public function setDueDate($duedate){
        $this->duedate = $duedate;
    }
    public function getDueDate(){
        return $this->duedate;
    }
    public function setStartDate($startdate){
        $this->startdate = $startdate;
    }
    public function getStartDate(){
        return $this->startdate;
    }
    public function setEstimatedHours($estimatedhours){
        $this->estimatedhours = $estimatedhours;
    }
    public function getEstimatedHours(){
        return $this->estimatedhours;
    }
    public function setRequestStatusSeq($requeststatusseq){
        $this->requeststatusseq = $requeststatusseq;
    }
    public function getRequestStatusSeq(){
        return $this->requeststatusseq;
    }
    public function setisRequiredApprovalFromManager($isrequiredapprovalfrommanager){
        $this->isrequiredapprovalfrommanager = $isrequiredapprovalfrommanager;
    }
    public function getisRequiredApprovalFromManager(){
        return $this->isrequiredapprovalfrommanager;
    }
    public function setisRequiredApprovalFromRequester($isrequiredapprovalfromrequester){
        $this->isrequiredapprovalfromrequester = $isrequiredapprovalfromrequester;
    }
    public function getisRequiredApprovalFromRequester(){
        return $this->isrequiredapprovalfromrequester;
    }    
    public function setisRequireAapprovalFromRobby($isrequiredapprovalfromrobby){
        $this->isrequiredapprovalfromrobby = $isrequiredapprovalfromrobby;
    }
    public function getisRequiredApprovalFromRobby(){
        return $this->isrequiredapprovalfromrobby;
    }
    public function setApprovedbyManagerDate($approvedbymanagerdate){
        $this->approvedbymanagerdate = $approvedbymanagerdate;
    }
    public function getApprovedbyManagerDate(){
        return $this->approvedbymanagerdate;
    }
    public function setApprovedbyRequesterDate($approvedbyrequesterdate){
        $this->approvedbyrequesterdate = $approvedbyrequesterdate;
    }
    public function getApprovedbyRequesterDate(){
        return $this->approvedbyrequesterdate;
    }
    public function setApprovedbyRobbyDate($approvedbyrobbydate){
        $this->approvedbyrobbydate = $approvedbyrobbydate;
    }
    public function getApprovedbyRobbyDate(){
        return $this->approvedbyrobbydate;
    }
    public function setCompletedDate($completeddate){
        $this->completeddate = $completeddate;
    }
    public function getCompletedDate(){
        return $this->completeddate;
    }
    public function setActualHours($actualhours){
        $this->actualhours = $actualhours;
    }
    public function getActualHours(){
        return $this->actualhours;
    }
    public function setIsCompleted($iscompleted){
        $this->iscompleted = $iscompleted;
    }
    public function getIsCompleted(){
        return $this->iscompleted;
    }
    public function setCreatedOn($createdon){
        $this->createdon = $createdon;
    }
    public function getCreatedOn(){
        return $this->createdon;
    }
    public function setLastModifiedOn($lastmodifiedon){
        $this->lastmodifiedon = $lastmodifiedon;
    }
    public function getLastModifiedOn(){
        return $this->lastmodifiedon;
    }
    public function createFromRequest($request){
		if (is_array($request)){
			$this->from_array($request);
		}
		return $this;
	}
	public function from_array($array){
		foreach(get_object_vars($this) as $attrName => $attrValue){
			$flag = property_exists(self::$className, $attrName);
			$isExists = array_key_exists($attrName, $array);
			if($flag && $isExists){
				$datePos = strpos(strtolower ($attrName),'date');
				$value = $array[$attrName];
				if($datePos !== false && !empty($value)){
					$dateValue = DateUtil::StringToDateByGivenFormat("m-d-Y", $value);
					if($dateValue){
						$value = $dateValue;
					}
				}
				if(!empty($value)){
					$this->{$attrName} = $value;
				}else{
					$this->{$attrName} = null;
				}
			}
		}
    }  

}
?>