<?php
class ShowTaskFile{
	public static $tableName = "showtaskfiles";
	public static $className = "ShowTaskFile";
	
	private $seq,$userseq,$showtaskseq,$fileextension,$ispublic,$title,$createdon;
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setUserSeq($val){
		$this->userseq = $val;
	}
	public function getUserSeq(){
		return $this->userseq;
	}
	
public function setShowTaskSeq($val){
		$this->showtaskseq = $val;
	}
	public function getShowTaskSeq(){
		return $this->showtaskseq;
	}
	
	public function setFileExtension($val){
		$this->fileextension = $val;
	}
	public function getFileExtension(){
		return $this->fileextension;
	}
	
	public function setIsPublic($val){
		$this->ispublic = $val;
	}
	public function getIsPublic(){
		return $this->ispublic;
	}
	
	public function setTitle($title_){
		$this->title = $title_;
	}
	public function getTitle(){
		return $this->title;
	}
	
	public function setCreatedOn($val){
		$this->createdon = $val;
	}
	public function getCreatedOn(){
		return $this->createdon;
	}
	
	
}