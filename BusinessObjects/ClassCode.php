<?php
class ClassCode{
	public static $className = "ClassCode";
	public static $tableName = "classcodes";
	private $seq,$classcode;
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setClassCode($classCode_){
		$this->classcode = $classCode_;
	}
	public function getClassCode(){
		return $this->classcode;
	}
}