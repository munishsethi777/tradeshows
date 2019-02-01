<?php
class Item{

	private $seq,$itemno,$description,$class,$dept,$status,$unit,$pccs,$disc,$instockqty,$allocqty,$soqty,$avqty,
	$poqty,$owqty,$projqty,$ytdsoldqty,$lastyearsoldqty,$comdship,$showspecial,$distributor,$dealerprice,$crzydissp,
	$qtywt,$minstk,$itemcost,$createdon,$lastmodifiedon,$isenabled;
	
	
	public static $className = "Item";
	public static $tableName = "items";
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	public function setItemNo($val){
		$this->itemno = $val;
	}
	public function getItemNo(){
		return $this->itemno;
	}
	public function setDescription($val){
		$this->description = $val;
	}
	public function getDescription(){
		return $this->description;
	}
	public function setClass($val){
		$this->class = $val;
	}
	public function getClass(){
		return $this->class;
	}
	public function setDept($val){
		$this->dept = $val;
	}
	public function getDept(){
		return $this->dept;
	}
	public function setStatus($val){
		$this->status = $val;
	}
	public function getStatus(){
		return $this->status;
	}
	public function setUnit($val){
		$this->unit = $val;
	}
	public function getUnit(){
		return $this->unit;
	}
	public function setPccs($val){
		$this->pccs = $val;
	}
	public function getPccs(){
		return $this->pccs;
	}
	public function setDisc($val){
		$this->disc = $val;
	}
	public function getDisc(){
		return $this->disc;
	}
	public function setInStockQty($val){
		$this->instockqty = $val;
	}
	public function getInStockQty(){
		return $this->instockqty;
	}
	public function setAllocQty($val){
		$this->allocqty = $val;
	}
	public function getAllocQty(){
		return $this->allocqty;
	}
	public function setSoQty($val){
		$this->soqty = $val;
	}
	public function getSoQty(){
		return $this->soqty;
	}
	public function setAvQty($val){
		$this->avqty = $val;
	}
	public function getAvQty(){
		return $this->avqty;
	}
	public function setPoQty($val){
		$this->poqty = $val;
	}
	public function getPoQty(){
		return $this->poqty;
	}
	public function setOwQty($val){
		$this->owqty = $val;
	}
	public function getOwQty(){
		return $this->owqty;
	}
	public function setProjQty($val){
		$this->projqty = $val;
	}
	public function getProjQty(){
		return $this->projqty;
	}
	public function setYtdSoldQty($val){
		$this->ytdsoldqty = $val;
	}
	public function getYtdSoldQty(){
		return $this->ytdsoldqty;
	}
	public function setLastYearSoldQty($val){
		$this->lastyearsoldqty = $val;
	}
	public function getLastYearSoldQty(){
		return $this->lastyearsoldqty;
	}
	public function setComdShip($val){
		$this->comdship = $val;
	}
	public function getComdShip(){
		return $this->comdship;
	}
	public function setShowSpecial($val){
		$this->showspecial = $val;
	}
	public function getShowSpecial(){
		return $this->showspecial;
	}
	public function setDistributor($val){
		$this->distributor = $val;
	}
	public function getDistributor(){
		return $this->distributor;
	}
	public function setDealerPrice($val){
		$this->dealerprice = $val;
	}
	public function getDealerPrice(){
		return $this->dealerprice;
	}
	public function setCrzyDissp($val){
		$this->crzydissp = $val;
	}
	public function getCrzyDissp(){
		return $this->crzydissp;
	}
	public function setQtyWt($val){
		$this->qtywt = $val;
	}
	public function getQtyWt(){
		return $this->qtywt;
	}
	public function setMinStk($val){
		$this->minstk = $val;
	}
	public function getMinStk(){
		return $this->minstk;
	}
	public function setItemCost($val){
		$this->itemcost = $val;
	}
	public function getItemCost(){
		return $this->itemcost;
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
	public function setIsEnabled($val){
		$this->isenabled = $val;
	}
	public function getIsEnabled(){
		return $this->isenabled;
	}
}