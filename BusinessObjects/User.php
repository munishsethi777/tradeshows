<?php
class User{
	public static $tableName = "users";
	public static $className = "user";
	
	private $seq,$email,$password,$fullname,$mobile,$isenabled;
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setEmail($val){
		$this->email = $val;
	}
	public function getEmail(){
		return $this->email;
	}
	
	public function setPassword($val){
		$this->password = $val;
	}
	public function getPassword(){
		return $this->password;
	}
	
	public function setFullName($val){
		$this->fullname = $val;
	}
	public function getFullName(){
		return $this->fullname;
	}
	
	public function setMobile($val){
		$this->mobile = $val;
	}
	public function getMobile(){
		return $this->mobile;
	}
	
	public function setIsEnabled($val){
		$this->isenabled = $val;
	}
	public function getIsEnabled(){
		return $this->isenabled;
	}
	
}