<?php
class QCSchedule{

	private $seq, $qc,$qcuser,$po, $potype, $itemnumbers, $shipdate, $latestshipdate,
	$screadydate, $scfinalinspectiondate, $scmiddleinspectiondate, $scfirstinspectiondate, $scproductionstartdate, $scgraphicsreceivedate, 
	$apreadydate, $apfinalinspectiondate, $apmiddleinspectiondate, $apfirstinspectiondate, $approductionstartdate, $apgraphicsreceivedate,
	$acreadydate, $acfinalinspectiondate, $acmiddleinspectiondate, $acfirstinspectiondate, $acproductionstartdate, $acgraphicsreceivedate, 
	$notes,$status, $userseq, $createdon, $lastmodifiedon,$classcodeseq,$apmiddleinspectiondatenareason, $apfirstinspectiondatenareason,
	$acmiddleinspectionnotes,$acfirstinspectionnotes,$iscompleted,$apgraphicsreceivedatenareason,$poinchargeuser,
	$poquantity,$samplequantity;
	
	public static $className = "QCSchedule";
	public static $tableName = "qcschedules";

	public function setSeq($val){
		$this->seq = $val;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setQC($val){
		$this->qc = $val;
	}
	public function getQC(){
		return $this->qc;
	}
	public function setQCUser($val){
		$this->qcuser = $val;
	}
	public function getQCUser(){
		return $this->qcuser;
	}
	public function setPO($val){
		$this->po = $val;
	}
	public function getPO(){
		return $this->po;
	}
	public function setPOType($val){
		$this->potype = $val;
	}
	public function getPOType(){
		return $this->potype;
	}
	public function setItemNumbers($val){
		$this->itemnumbers = $val;
	}
	public function getItemNumbers(){
		return $this->itemnumbers;
	}
	public function setShipDate($val){
		$this->shipdate = $val;
	}
	public function getShipDate(){
		return $this->shipdate;
	}
	public function setLatestShipDate($val){
		$this->latestshipdate = $val;
	}
	public function getLatestShipDate(){
		return $this->latestshipdate;
	}
	public function setSCReadyDate($val){
		$this->screadydate = $val;
	}
	public function getSCReadyDate(){
		return $this->screadydate;
	}
	public function setSCFinalInspectionDate($val){
		$this->scfinalinspectiondate = $val;
	}
	public function getSCFinalInspectionDate(){
		return $this->scfinalinspectiondate;
	}
	public function setSCMiddleInspectionDate($val){
		$this->scmiddleinspectiondate = $val;
	}
	public function getSCMiddleInspectionDate(){
		return $this->scmiddleinspectiondate;
	}
	public function setSCFirstInspectionDate($val){
		$this->scfirstinspectiondate = $val;
	}
	public function getSCFirstInspectionDate(){
		return $this->scfirstinspectiondate;
	}
	public function setSCProductionStartDate($val){
		$this->scproductionstartdate = $val;
	}
	public function getSCProductionStartDate(){
		return $this->scproductionstartdate;
	}
	public function setSCGraphicsReceiveDate($val){
		$this->scgraphicsreceivedate = $val;
	}
	public function getSCGraphicsReceiveDate(){
		return $this->scgraphicsreceivedate;
	}
	
	public function setAPReadyDate($val){
		$this->apreadydate = $val;
	}
	public function getAPReadyDate(){
		return $this->apreadydate;
	}
	public function setAPFinalInspectionDate($val){
		$this->apfinalinspectiondate = $val;
	}
	public function getAPFinalInspectionDate(){
		return $this->apfinalinspectiondate;
	}
	public function setAPMiddleInspectionDate($val){
		$this->apmiddleinspectiondate = $val;
	}
	public function getAPMiddleInspectionDate(){
		return $this->apmiddleinspectiondate;
	}
	public function setAPFirstInspectionDate($val){
		$this->apfirstinspectiondate = $val;
	}
	public function getAPFirstInspectionDate(){
		return $this->apfirstinspectiondate;
	}
	public function setAPProductionStartDate($val){
		$this->approductionstartdate = $val;
	}
	public function getAPProductionStartDate(){
		return $this->approductionstartdate;
	}
	public function setAPGraphicsReceiveDate($val){
		$this->apgraphicsreceivedate = $val;
	}
	public function getAPGraphicsReceiveDate(){
		return $this->apgraphicsreceivedate;
	}
	
	public function setACReadyDate($val){
		$this->acreadydate = $val;
	}
	public function getACReadyDate(){
		return $this->acreadydate;
	}
	public function setACFinalInspectionDate($val){
		$this->acfinalinspectiondate = $val;
	}
	public function getACFinalInspectionDate(){
		return $this->acfinalinspectiondate;
	}
	public function setACMiddleInspectionDate($val){
		$this->acmiddleinspectiondate = $val;
	}
	public function getACMiddleInspectionDate(){
		return $this->acmiddleinspectiondate;
	}
	public function setACFirstInspectionDate($val){
		$this->acfirstinspectiondate = $val;
	}
	public function getACFirstInspectionDate(){
		return $this->acfirstinspectiondate;
	}
	public function setACProductionStartDate($val){
		$this->acproductionstartdate = $val;
	}
	public function getACProductionStartDate(){
		return $this->acproductionstartdate;
	}
	public function setACGraphicsReceiveDate($val){
		$this->acgraphicsreceivedate = $val;
	}
	public function getACGraphicsReceiveDate(){
		return $this->acgraphicsreceivedate;
	}
	public function setNotes($val){
		$this->notes = $val;
	}
	public function getNotes(){
		return $this->notes;
	}
	public function setStatus($val){
		$this->status = $val;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setUserSeq($val){
		$this->userseq = $val;
	}
	public function getUserSeq(){
		return $this->userseq;
	}
	public function setCreatedOn($val){
		$this->createdon = $val;
	}
	public function getCreatedOn(){
		return $this->createdon;
	}
	public function setLastModifiedOn($val){
		$this->lastmodifiedon = $val;
	}
	public function getLastModifiedOn(){
		return $this->lastmodifiedon;
	}
	
	public function setClassCodeSeq($classCodeSeq_){
		$this->classcodeseq = $classCodeSeq_;
	}
	public function getClassCodeSeq(){
		return $this->classcodeseq;
	}
	
	public function setApMiddleInspectionDateNaReason($middleInspectionNaReason_){
		$this->apmiddleinspectiondatenareason = $middleInspectionNaReason_;
	}
	public function getApMiddleInspectionDateNaReason(){
		return $this->apmiddleinspectiondatenareason;
	}
	
	public function setApFirstInspectionDateNaReason($firstInspectionNaReason_){
		$this->apfirstinspectiondatenareason = $firstInspectionNaReason_;
	}
	public function getApFirstInspectionDateNaReason(){
		return $this->apfirstinspectiondatenareason;
	}
	
	public function setAcMiddleInspectionNotes($middleInspectionNotes_){
	    $this->acmiddleinspectionnotes = $middleInspectionNotes_;
	}
	
	public function getAcMiddleInspectionNotes(){
	    return $this->acmiddleinspectionnotes;
	}
	
	public function setAcFirstInspectionNotes($firstInspectionNotes_){
	    $this->acfirstinspectionnotes = $firstInspectionNotes_;
	}
	public function getAcFirstInspectionNotes(){
	    return $this->acfirstinspectionnotes;
	}
	
	public function setIsCompleted($val){
	    $this->iscompleted = $val;
	}
	public function getIsCompleted(){
	    return $this->iscompleted;
	}
	public function setAPGraphicsReceiveDateNAReason($val){
		$this->apgraphicsreceivedatenareason = $val;
	}
	public function getAPGraphicsReceiveDateNAReason(){
		return $this->apgraphicsreceivedatenareason;
	}
	public function getPoInchargeUser(){
	    return $this->poinchargeuser;
	}
	public function setPoInchargeUser($poinchargeuser){
	    $this->poinchargeuser = $poinchargeuser;
	}

	public function setPoQuantity($val){
		$this->poquantity = $val;
	}
	public function getPoQuantity(){
		return $this->poquantity;
	}

	public function setSampleQuantity($val){
		$this->samplequantity = $val;
	}
	public function getSampleQuantity(){
		return $this->samplequantity;
	}
	
	public function __construct($object = null) {
		if($object !== null){
			foreach($object as $property => $value) {
				$this->$property = $value;
			}
		}
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
	
	public function setNAForLockedField($array,$qcSchedule){
		foreach(get_object_vars($this) as $attrName => $attrValue){
			$flag = property_exists(self::$className, $attrName);
			$isExists = array_key_exists($attrName, $array);
			if($flag && $isExists){
				$value = $array[$attrName];
				if(!empty($value)){
					$this->{$attrName} = "NA";
				}else{
					$value = $qcSchedule[$attrName];
					$datePos = strpos(strtolower ($attrName),'date');
					if($datePos !== false && !empty($value)){
						$dateValue = DateUtil::StringToDateByGivenFormat("Y-m-d", $value);
						if($dateValue){
							$value = $dateValue->format("m-d-Y");
						}
					}
					$this->{$attrName} = $value;
				}
			}
		}
	}
}