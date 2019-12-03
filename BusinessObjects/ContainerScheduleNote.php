<?php
class ContainerScheduleNote {
	
	public static $className = "ContainerScheduleNote";
	public static $tableName = "containerschedulenotes";
	private $seq;
	private $containerscheduleseq;
	private $notes;
	private $notestype;
	private $createdon;
	private $createdby;
	private $graphiclogseq;
	
	function setSeq($seq) {
		$this->seq = $seq;
	}
	function getSeq() {
		return $this->seq;
	}
	function setContainerscheduleseq($containerscheduleseq) {
		$this->containerscheduleseq = $containerscheduleseq;
	}
	function getContainerscheduleseq() {
		return $this->containerscheduleseq;
	}
	
	function setGraphicLogSeq($graphicLogSeq_){
	    $this->graphiclogseq = $graphicLogSeq_;
	}
	function getGraphicLogSeq(){
	    return $this->graphiclogseq;
	}
	
	function setNotes($notes) {
		$this->notes = $notes;
	}
	function getNotes() {
		return $this->notes;
	}
	function setNotesType($notestype) {
		$this->notestype = $notestype;
	}
	function getNotesType() {
		return $this->notestype;
	}
	function setCreatedon($createdon) {
		$this->createdon = $createdon;
	}
	function getCreatedon() {
		return $this->createdon;
	}
	function setCreatedby($createdby) {
		$this->createdby = $createdby;
	}
	function getCreatedby() {
		return $this->createdby;
	}
	public function createFromRequest($request) {
		if (is_array ( $request )) {
			$this->from_array ( $request );
		}
		return $this;
	}
	public function from_array($array) {
		foreach ( get_object_vars ( $this ) as $attrName => $attrValue ) {
			$flag = property_exists ( self::$className, $attrName );
			$isExists = array_key_exists ( $attrName, $array );
			if ($flag && $isExists) {
				$datePos = strpos ( strtolower ( $attrName ), 'date' );
				$dateTimePos = strpos ( strtolower ( $attrName ), 'datetime' );
				$isBoolean = substr($attrName, 0,2) == "is" ? true : false;
	
				$value = $array [$attrName];
				if ($datePos !== false && ! empty ( $array [$attrName] )) {
					$value = DateUtil::StringToDateByGivenFormat ( "m-d-Y", $array [$attrName] );
				}
				if ($dateTimePos !== false && ! empty ( $array [$attrName] )) {
					$value = DateUtil::StringToDateByGivenFormat ( "m-d-Y h:i A", $array [$attrName] );
				}
				if($isBoolean == true) {
					if(!empty ($array [$attrName])){
						$value = true;
					}else{
						$value = false;
					}
				}
				if (! empty ( $value )) {
					$this->{$attrName} = $value;
				}
			}
		}
	}
}