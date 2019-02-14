<?php
class TradeShowOrder{
	public static $tableName = "tradeshoworders";
	public static $className = "TradeShowOrder";
	private $seq,$customerseq,$salerep,$salesordernumber,$sotype,$custpo,$orderdate,$tradeshowseq,$shipdt;
	
	public function setSeq($seq_){
		$this->seq = $seq_;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setCustomerSeq($customerSeq_){
		$this->customerseq = $customerSeq_;
	}
	public function getCustomerSeq(){
		return $this->customerseq;
	}
	
	public function setSaleRep($saleRep_){
		$this->salerep = $saleRep_;
	}
	public function getSaleRep(){
		return $this->salerep;
	}
	
	public function setSalesOrderNumber($saleOrderNumber_){
		$this->salesordernumber = $saleOrderNumber_;
	}
	public function getSalesOrderNumber(){
		return $this->salesordernumber;
	}
	
	public function setSoType($soType_){
		$this->sotype = $soType_;
	}
	
	public function getSoType(){
		return $this->sotype;
	}
	
	public function setCustPo($custPo){
		$this->custpo = $custPo;
	}
	public function getCustPo(){
		return $this->custpo;
	}
	
	public function setOrderDate($orderDate){
		$this->orderdate = $orderDate;
	}
	public function getOrderDate(){
		return $this->orderdate;
	}
	
	public function setTradeShowSeq($tradeShowSeq_){
		$this->tradeshowseq = $tradeShowSeq_;
	}
	public function getTradeShowSeq(){
		return $this->tradeshowseq;
	}
	
	public function setShipDt($shipDate_){
		$this->shipdt = $shipDate_;
	}
	public function getShipDt(){
		return $this->shipdt;
	}
	
	
}