<?php
class InstructionManualLogs{

    private $seq,$entrydate,$poshipdate,$approvedmanualdueprintdate,$itemnumber,$classcodeseq,$graphicduedate,
    $neworrevised,$instructionmanualtype,$diagramsavedbyuserseq,$diagramsaveddate,$notestousa,$notestochina,
    $assignedtouser,$instructionmanuallogstatus,$starteddate,$supervisorreturndate,$managerreturndate,$buyerreturndate,
    $senttochinadate,$iscompleted,$createdby,$createddate,$lastmodifiedon,$isprivatelabel;
	
	
	public static $className = "InstructionManualLogs";
	public static $tableName = "instructionmanuallogs";

    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    public function setEntryDate($entryDate){
        $this->entrydate = $entryDate;
    }
    public function getEntryDate(){
        return $this->entrydate;
    }
	public function setPoShipDate($poShipDate){
        $this->poshipdate = $poShipDate;
    }
    public function getPoShipDate(){
        return $this->poshipdate;
    }
    public function setApprovedManualDuePrintDate($approvedManualDuePrintDate){
        $this->approvedmanualdueprintdate = $approvedManualDuePrintDate;
    }
    public function getApprovedManualDuePrintDate(){
        return $this->approvedmanualdueprintdate;
    }
    public function setItemNumber($itemNumber){
        $this->itemnumber = $itemNumber;
    }   
    public function getItemNumber(){
        return $this->itemnumber;
    }
    public function setClassCodeSeq($classCodeSeq){
        $this->classcodeseq = $classCodeSeq;
    }
    public function getClassCodeSeq(){
        return $this->classcodeseq;
    }
    public function setGraphicDueDate($graphicDueDate){
        $this->graphicduedate = $graphicDueDate;
    }
    public function getGraphicDueDate(){
        return $this->graphicduedate;
    }
    public function setNewOrRevised($newOrRevised){
        $this->neworrevised = $newOrRevised;
    }
    public function getNewOrRevised(){
        return $this->neworrevised;
    }
    public function setInstructionManualType($instructionManualType){
        $this->instructionmanualtype = $instructionManualType;
    }
    public function getInstructionManualType(){
        return $this->instructionmanualtype;
    }
    public function setDiagramSavedByUserSeq($diagramSavedByUserSeq){
        $this->diagramsavedbyuserseq = $diagramSavedByUserSeq;
    }
    public function getDiagramSavedByUserSeq(){
        return $this->diagramsavedbyuserseq;
    }
    public function setDiagramSavedDate($diagramSavedDate){
        $this->diagramsaveddate = $diagramSavedDate;
    }
    public function getDiagramSavedDate(){
        return $this->diagramsaveddate;
    }
    public function setNotesToUsa($notesToUsa){
        $this->notestousa = $notesToUsa;
    }
    public function getNotesToUsa(){
        return $this->notestousa;
    }
    public function setNotesToChina($val){
        $this->notestochina = $val;
    }
    public function getNotesToChina(){
        return $this->notestochina;
    }
    public function setAssignedToUser($assignedToUser){
        $this->assignedtouser = $assignedToUser;
    }
    public function getAssignedToUser(){
        return $this->assignedtouser;
    }
    public function setInstructionManualLogStatus($instructionManualLogStatus){
        $this->instructionmanuallogstatus = $instructionManualLogStatus;
    }
    public function getInstructionManualLogStatus(){
        return $this->instructionmanuallogstatus;
    }
    public function setStartedDate($startedDate){
        $this->starteddate = $startedDate;
    }
    public function getStartedDate(){
        return $this->starteddate;
    }
    public function setSupervisorReturnDate($supervisorReturnDate){
        $this->supervisorreturndate = $supervisorReturnDate;
    }
    public function getSupervisorReturnDate(){
        return $this->supervisorreturndate;
    }
    public function setManagerReturnDate($managerReturnDate){
        $this->managerreturndate = $managerReturnDate;
    }
    public function getManagerReturnDate(){
        return $this->managerreturndate;
    }
    public function setBuyerReturnDate($buyerReturnDate){
        $this->buyerreturndate = $buyerReturnDate;
    }
    public function getBuyerReturnDate(){
        return $this->buyerreturndate;
    }
    public function setSentToChinaDate($sentToChinaDate){
        $this->senttochinadate = $sentToChinaDate;
    }
    public function getSentToChinaDate(){
        return $this->senttochinadate;
    }
    public function setIsCompleted($isCompleted){
        $this->iscompleted = $isCompleted;
    }
    public function getIsCompleted(){
        return $this->iscompleted;
    }
    public function setCreatedBy($createdBy){
        $this->createdby = $createdBy;
    }
    public function getCreatedBy(){
        return $this->createdby; 
    }
    public function setCreatedDate($createdDate){
        $this->createddate = $createdDate;
    }
    public function getCreatedDate(){
        return $this->createddate;
    }
    public function setLastModifiedOn($lastModifiedOn){
        $this->lastmodifiedon = $lastModifiedOn;
    }
    public function getLastModifiedOn(){
        return $this->lastmodifiedon;
    }
    public function setIsPrivateLabel($isPrivateLabel){
        $this->isprivatelabel = $isPrivateLabel;
    }
    public function getIsPrivateLabel(){
        return $this->isprivatelabel;
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