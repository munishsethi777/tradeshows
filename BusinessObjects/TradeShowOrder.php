<?php
class TradeShowOrder{
	public static $tableName = "tradeshoworders";
	public static $className = "TradeShowOrder";
	private $seq,$customerseq,$itemseq,$salerep,$salesordernumber,$sotype,$description,$warehouse,$qtyorder,$price,$soamt,$shipdt,$custpo,$itemnote,$orderdate;
	
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
	
	public function setItemSeq($itemSeq_){
		$this->itemseq =$itemSeq_;
	}
	public function getItemSeq(){
		return $this->itemseq;
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
	
	public function setDescription($description_){
		$this->description = $description_;
	}
	public function getDescription(){
		return $this->description;
	}
	
	public function setWareHouse($wareHouse_){
		$this->warehouse = $wareHouse_;
	}
	public function getWareHouse(){
		return $this->warehouse;
	}
	
	public function setQtyOrder($qtyORder){
		$this->qtyorder  = $qtyORder;
	}
	public function getQtyOrder(){
		return $this->qtyorder;
	}
	
	public function setPrice($price_){
		$this->price = $price_;
	}
	public function getPrice(){
		return $this->price;
	}
	
	public function setSoAmt($soAmount_){
		$this->soamt = $soAmount_;
	}
	public function getSoAmt(){
		return $this->soamt;
	}
	
	public function setShipDt($shipDt){
		$this->shipdt = $shipDt;
	}
	public function getShipDt(){
		return $this->shipdt;
	}
	
	public function setCustPo($custPo){
		$this->custpo = $custPo;
	}
	public function getCustPo(){
		return $this->custpo;
	}
	
	public function setItemNote($itemNote_){
		$this->itemnote = $itemNote_;
	}
	public function getItemNote(){
		return $this->itemnote;
	}
	
	public function setOrderDate($orderDate){
		$this->orderdate = $orderDate;
	}
	public function getOrderDate(){
		return $this->orderdate;
	}
}