<?php
class Customer{

	private $seq,$customerid,$customername,$phone,$address,$address1,$city,$street,$zip,$email,$attention,
	$fax,$terms,$sales1,$sales2,$sales3,$sales4,$createdate,$createdon,$lastmodifiedon;

	public static $className = "Customer";
	public static $tableName = "customers";

	public function setSeq($val_){
		$this->seq = $val_;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setCustomerId($val_){
		$this->customerid = $val_;
	}
	public function getCustomerId(){
		return $this->customerid;
	}
	public function setCustomerName($val_){
		$this->customername = $val_;
	}
	public function getCustomerName(){
		return $this->customername;
	}
	public function setPhone($val_){
		$this->phone = $val_;
	}
	public function getPhone(){
		return $this->phone;
	}
	public function setAddress($val_){
		$this->address = $val_;
	}
	public function getAddress(){
		return $this->address;
	}
	public function setAddress1($val_){
		$this->address1 = $val_;
	}
	public function getAddress1(){
		return $this->address1;
	}
	public function setCity($val_){
		$this->city = $val_;
	}
	public function getCity(){
		return $this->city;
	}
	public function setStreet($val_){
		$this->street = $val_;
	}
	public function getStreet(){
		return $this->street;
	}
	public function setZip($val_){
		$this->zip = $val_;
	}
	public function getZip(){
		return $this->zip;
	}
	public function setEmail($val_){
		$this->email = $val_;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setAttention($val_){
		$this->attention = $val_;
	}
	public function getAttention(){
		return $this->attention;
	}
	public function setFax($val_){
		$this->fax = $val_;
	}
	public function getFax(){
		return $this->fax;
	}
	public function setTerms($val_){
		$this->terms = $val_;
	}
	public function getTerms(){
		return $this->terms;
	}
	public function setSales1($val_){
		$this->sales1 = $val_;
	}
	public function getSales1(){
		return $this->sales1;
	}
	public function setSales2($val_){
		$this->sales2 = $val_;
	}
	public function getSales2(){
		return $this->sales2;
	}
	public function setSales3($val_){
		$this->sales3 = $val_;
	}
	public function getSales3(){
		return $this->sales3;
	}
	public function setSales4($val_){
		$this->sales4 = $val_;
	}
	public function getSales4(){
		return $this->sales4;
	}
	public function setCreateDate($val_){
		$this->createdate = $val_;
	}
	public function getCreateDate(){
		return $this->createdate;
	}
	public function setCreatedOn($val_){
		$this->createdon = $val_;
	}
	public function getCreatedOn(){
		return $this->createdon;
	}
	public function setLastModifiedOn($val_){
		$this->lastmodifiedon = $val_;
	}
	public function getLastModifiedOn(){
		return $this->lastmodifiedon;
	}
}
