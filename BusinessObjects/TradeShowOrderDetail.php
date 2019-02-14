<?php
class TradeShowOrderDetail{
	public static $tableName = "tradeshoworderdetails";
	public static $className = "TradeShowOrderDetail";
	private $seq,$itemseq,$warehouse,$quantity,$price,$soamount,$itemnote,$orderseq;
	
	public function setSeq($seq_){
		$this->seq = $seq;
	}
	public function getSeq(){
		return $this->seq;
	}
	
	public function setItemSeq($itemSeq_){
		$this->itemseq = $itemSeq_;
	}
	public function getItemSeq(){
		return $this->itemseq;
	}
	
	public function setWarehouse($wareHouse_){
		$this->warehouse = $wareHouse_;
	}
	public function getWarehouse(){
		return $this->warehouse;
	}
	
	public function setQuantity($quantity_){
		$this->quantity = $quantity_;
	}
	public function getQuantity(){
		return $this->quantity;
	}
	
	public function setPrice($price_){
		$this->price = $price_;
	}
	public function getPrice(){
		return $this->soamount;
	}
	
	public function setSoAmount($soAmount_){
		$this->soamount = $soAmount_;
	}
	public function getSoAmount(){
		return $this->soamount;
	}
	
	public function setItemNote($itemNote_){
		$this->itemnote = $itemNote_;
	}
	public function getItemNote(){
		return $this->itemnote;
	}
	
	public function setOrderSeq($orderSeq_){
		$this->orderseq =$orderSeq_;
	}
	public function getOrderSeq(){
		return $this->orderseq;
	}
	
	
}