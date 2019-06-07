<?php
class GraphicsLog{

	private $seq, $usaofficeentrydate, $po, $estimatedshipdate, $classcode, $sku, $graphictype, $iscustomhangtagneeded,
	$iscustomwraptagneeded, $customername, $isprivatelabel, $usanotes, $estimatedgraphicsdate, $chinaofficeentrydate, 
	$confirmedposhipdate, $jeopardydate, $graphiclength, $graphicwidth, $graphicheight, $chinanotes, $finalgraphicsduedate, 
	$graphicstochinanotes, $approxgraphicschinasentdate, $graphicstatus, $graphicartist, $graphicartiststartdate, $graphiccompletiondate,
	$duration,$userseq,$createdon,$lastmodifiedon;

	public static $className = "GraphicsLog";
	public static $tableName = "graphicslogs";

	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setUSAOfficeEntryDate($val){
		$this->usaofficeentrydate = $val;
	}
	public function getUSAOfficeEntryDate(){
		return $this->usaofficeentrydate;
	}
	public function setPO($val){
		$this->po = $val;
	}
	public function getPO(){
		return $this->po;
	}
	public function setEstimatedShipDate($val){
		$this->estimatedshipdate = $val;
	}
	public function getEstimatedShipDate(){
		return $this->estimatedshipdate;
	}
	public function setClassCode($val){
		$this->classcode = $val;
	}
	public function getClassCode(){
		return $this->classcode;
	}
	public function setSKU($val){
		$this->sku = $val;
	}
	public function getSKU(){
		return $this->sku;
	}
	public function setGraphicType($val){
		$this->graphictype = $val;
	}
	public function getGraphicType(){
		return $this->graphictype;
	}
	public function setIsCustomHangTagNeeded($val){
		$this->iscustomhangtagneeded = $val;
	}
	public function getIsCustomHangTagNeeded(){
		return $this->iscustomhangtagneeded;
	}
	public function setIsCustomWrapTagNeeded($val){
		$this->iscustomwraptagneeded = $val;
	}
	public function getIsCustomWrapTagNeeded(){
		return $this->iscustomwraptagneeded;
	}
	public function setCustomerName($val){
		$this->customername = $val;
	}
	public function getCustomerName(){
		return $this->customername;
	}
	public function setIsPrivateLabel($val){
		$this->isprivatelabel = $val;
	}
	public function getIsPrivateLabel(){
		return $this->isprivatelabel;
	}
	public function setUSANotes($val){
		$this->usanotes = $val;
	}
	public function getUSANotes(){
		return $this->usanotes;
	}
	public function setEstimatedGraphicsDate($val){
		$this->estimatedgraphicsdate = $val;
	}
	public function getEstimatedGraphicsDate(){
		return $this->estimatedgraphicsdate;
	}
	public function setChinaOfficeEntryDate($val){
		$this->chinaofficeentrydate = $val;
	}
	public function getChinaOfficeEntryDate(){
		return $this->chinaofficeentrydate;
	}
	public function setConfirmedPOShipDate($val){
		$this->confirmedposhipdate = $val;
	}
	public function getConfirmedPOShipDate(){
		return $this->confirmedposhipdate;
	}
	public function setJeopardyDate($val){
		$this->jeopardydate = $val;
	}
	public function getJeopardyDate(){
		return $this->jeopardydate;
	}
	public function setGraphicLength($val){
		$this->graphiclength = $val;
	}
	public function getGraphicLength(){
		return $this->graphiclength;
	}
	public function setGraphicWidth($val){
		$this->graphicwidth = $val;
	}
	public function getGraphicWidth(){
		return $this->graphicwidth;
	}
	public function setGraphicHeight($val){
		$this->graphicheight = $val;
	}
	public function getGraphicHeight(){
		return $this->graphicheight;
	}
	public function setChinaNotes($val){
		$this->chinanotes = $val;
	}
	public function getChinaNotes(){
		return $this->chinanotes;
	}
	public function setFinalGraphicsDueDate($val){
		$this->finalgraphicsduedate = $val;
	}
	public function getFinalGraphicsDueDate(){
		return $this->finalgraphicsduedate;
	}
	public function setGraphicsToChinaNotes($val){
		$this->graphicstochinanotes = $val;
	}
	public function getGraphicsToChinaNotes(){
		return $this->graphicstochinanotes;
	}
	public function setApproxGraphicsChinaSentDate($val){
		$this->approxgraphicschinasentdate = $val;
	}
	public function getApproxGraphicsChinaSentDate(){
		return $this->approxgraphicschinasentdate;
	}
	public function setGraphicStatus($val){
		$this->graphicstatus = $val;
	}
	public function getGraphicStatus(){
		return $this->graphicstatus;
	}
	public function setGraphicArtist($val){
		$this->graphicartist = $val;
	}
	public function getGraphicArtist(){
		return $this->graphicartist;
	}
	public function setGraphicArtistStartDate($val){
		$this->graphicartiststartdate = $val;
	}
	public function getGraphicArtistStartDate(){
		return $this->graphicartiststartdate;
	}
	public function setGraphicCompletionDate($val){
		$this->graphiccompletiondate = $val;
	}
	public function getGraphicCompletionDate(){
		return $this->graphiccompletiondate;
	}
	public function setDuration($val){
		$this->duration = $val;
	}
	public function getDuration(){
		return $this->duration;
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
				$datePos = strpos(strtolower ($attrName),'date');
				$value = $array[$attrName];
				if($datePos !== false && !empty($value)){
					$value = DateUtil::StringToDateByGivenFormat("m-d-Y", $value);
				}
				if(!empty($value)){
					$this->{$attrName} = $value;
				}
			}
		}
	}
}
