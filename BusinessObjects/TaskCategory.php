<?php
class TaskCategory{
	public static $tableName = "taskcategories";
	public static $className = "taskcategory";
	
	private $seq,$title,$description,$type;
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setTitle($val){
		$this->title = $val;
	}
	public function getTitle(){
		return $this->title;
	}
	
	public function setDescription($val){
		$this->description = $val;
	}
	public function getDescription(){
		return $this->description;
	}
	
	public function setType($val){
		$this->type = $val;
	}
	public function getType(){
		return $this->type;
	}
	
}