<?php
class QCSchedule{

	private $seq, $qc, $classcode, $po, $potype, $itemnumbers, $shipdate, $screadydate, $scfinalinspectiondate, $scmiddleinspectiondate,
	$scfirstinspectiondate, $scproductionstartdate, $scgraphicsreceivedate, $acreadydate, $acfinalinspectiondate, $acmiddleinspectiondate, 
	$acfirstinspectiondate, $acproductionstartdate, $acgraphicsreceivedate, $notes, $userseq, $createdon, $lastmodifiedon;
	
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
	public function setClassCode($val){
		$this->classcode = $val;
	}
	public function getClassCode(){
		return $this->classcode;
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
				$this->{$attrName} = $array[$attrName];
			}
		}
	}
}