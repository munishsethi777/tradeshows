<?php
class ItemSpecification{

	private $seq, $itemno, $oms, $item1description, $item1length, $item1width, $item1height, $item2description, $item2length, $item2width,
	$item2height, $item3description, $item3length, $item3width, $item3height, $mastercarton1length, $mastercarton1width, $mastercarton1height,
	$mastercarton2length, $mastercarton2width, $mastercarton2height, $msdescription, $port, $countryoforigin, $material1, $material1percent,
	$material2, $material2percent, $material3, $material3percent, $material4, $material4percent, $material5, $material5percent, 
	$materialtotalpercent, $haslight, $lighttype, $totallumens, $hasbattery, $batteryquantity, $batterytype, $haselectricity, $electricitytype,
	$cordlengthfeet, $hasassembly,$manualpath,$part1,$part2,$part3,$part4,$part5,$cordlengthmeter,$pumpwattage ,$pumpvolts ,$pumpcordlength,
	$transformerwattage,$transformervolts,$transformercordlength,$watercapacity,$feature1,$feature2,$feature3,$feature4,$feature5,$feature6,
	$feature7,$updatedby,$troy,$userseq, $createdon, $lastmodifiedon;
	
	public static $className = "ItemSpecification";
	public static $tableName = "itemspecifications";
	
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
	public function setOms($val){
		$this->oms = $val;
	}
	public function getOms(){
		return $this->oms;
	}
	public function setItem1Description($val){
		$this->item1description = $val;
	}
	public function getItem1Description(){
		return $this->item1description;
	}
	public function setItem1Length($val){
		$this->item1length = $val;
	}
	public function getItem1Length(){
		return $this->item1length;
	}
	public function setItem1Width($val){
		$this->item1width = $val;
	}
	public function getItem1Width(){
		return $this->item1width;
	}
	public function setItem1Height($val){
		$this->item1height = $val;
	}
	public function getItem1Height(){
		return $this->item1height;
	}
	
	public function setItem2Description($val){
		$this->item2description = $val;
	}
	public function getItem2Description(){
		return $this->item2description;
	}
	public function setItem2Length($val){
		$this->item2length = $val;
	}
	public function getItem2Length(){
		return $this->item2length;
	}
	public function setItem2Width($val){
		$this->item2width = $val;
	}
	public function getItem2Width(){
		return $this->item2width;
	}
	public function setItem2Height($val){
		$this->item2height = $val;
	}
	public function getItem2Height(){
		return $this->item2height;
	}
	
	public function setItem3Description($val){
		$this->item3description = $val;
	}
	public function getItem3Description(){
		return $this->item3description;
	}
	public function setItem3Length($val){
		$this->item3length = $val;
	}
	public function getItem3Length(){
		return $this->item3length;
	}
	public function setItem3Width($val){
		$this->item3width = $val;
	}
	public function getItem3Width(){
		return $this->item3width;
	}
	public function setItem3Height($val){
		$this->item3height = $val;
	}
	public function getItem3Height(){
		return $this->item3height;
	}
	
	public function setMasterCarton1Length($val){
		$this->mastercarton1length = $val;
	}
	public function getMasterCarton1Length(){
		return $this->mastercarton1length;
	}
	public function setMasterCarton1Width($val){
		$this->mastercarton1width = $val;
	}
	public function getMasterCarton1Width(){
		return $this->mastercarton1width;
	}
	public function setMasterCarton1Height($val){
		$this->mastercarton1height= $val;
	}
	public function getMasterCarton1Height(){
		return $this->mastercarton1height;
	}
	
	public function setMasterCarton2Length($val){
		$this->mastercarton2length = $val;
	}
	public function getMasterCarton2Length(){
		return $this->mastercarton2length;
	}
	public function setMasterCarton2Width($val){
		$this->mastercarton2width = $val;
	}
	public function getMasterCarton2Width(){
		return $this->mastercarton2width;
	}
	public function setMasterCarton2Height($val){
		$this->mastercarton2height= $val;
	}
	public function getMasterCarton2Height(){
		return $this->mastercarton2height;
	}
	
	public function setMSDescription($val){
		$this->msdescription= $val;
	}
	public function getMSDescription(){
		return $this->msdescription;
	}
	public function setPort($val){
		$this->port= $val;
	}
	public function getPort(){
		return $this->port;
	}
	public function setCountryOfOrigin($val){
		$this->countryoforigin= $val;
	}
	public function getCountryOfOrigin(){
		return $this->countryoforigin;
	}
	
	public function setMaterial1($val){
		$this->material1= $val;
	}
	public function getMaterial1(){
		return $this->material1;
	}
	public function setMaterial1Percent($val){
		$this->material1percent= $val;
	}
	public function getMaterial1Percent(){
		return $this->material1percent;
	}
	
	public function setMaterial2($val){
		$this->material2= $val;
	}
	public function getMaterial2(){
		return $this->material2;
	}
	public function setMaterial2Percent($val){
		$this->material2percent= $val;
	}
	public function getMaterial2Percent(){
		return $this->material2percent;
	}
	
	public function setMaterial3($val){
		$this->material3= $val;
	}
	public function getMaterial3(){
		return $this->material3;
	}
	public function setMaterial3Percent($val){
		$this->material3percent= $val;
	}
	public function getMaterial3Percent(){
		return $this->material3percent;
	}
	
	public function setMaterial4($val){
		$this->material4= $val;
	}
	public function getMaterial4(){
		return $this->material4;
	}
	public function setMaterial4Percent($val){
		$this->material4percent= $val;
	}
	public function getMaterial4Percent(){
		return $this->material4percent;
	}
	
	public function setMaterial5($val){
		$this->material5= $val;
	}
	public function getMaterial5(){
		return $this->material5;
	}
	public function setMaterial5Percent($val){
		$this->material5percent= $val;
	}
	public function getMaterial5Percent(){
		return $this->material5percent;
	}
	
	public function setMaterialTotalPercent($val){
		$this->materialtotalpercent= $val;
	}
	public function getMaterialTotalPercent(){
		return $this->materialtotalpercent;
	}
	
	public function setHasLight($val){
		$this->haslight= $val;
	}
	public function getHasLight(){
		return $this->haslight;
	}
	public function setLightType($val){
		$this->lighttype= $val;
	}
	public function getLightType(){
		return $this->lighttype;
	}
	public function setTotalLumens($val){
		$this->totallumens= $val;
	}
	public function getTotalLumens(){
		return $this->totallumens;
	}
	public function setHasBattery($val){
		$this->hasbattery= $val;
	}
	public function getHasBattery(){
		return $this->hasbattery;
	}
	public function setBatteryQuantity($val){
		$this->batteryquantity= $val;
	}
	public function getBatteryQuantity(){
		return $this->batteryquantity;
	}
	public function setBatteryType($val){
		$this->batterytype= $val;
	}
	public function getBatteryType(){
		return $this->batterytype;
	}
	public function setHasElectricity($val){
		$this->haselectricity= $val;
	}
	public function getHasElectricity(){
		return $this->haselectricity;
	}
	public function setElectricityType($val){
		$this->electricitytype= $val;
	}
	public function getElectricityType(){
		return $this->electricitytype;
	}
	public function setCordLengthFeet($val){
		$this->cordlengthfeet= $val;
	}
	public function getCordLengthFeet(){
		return $this->cordlengthfeet;
	}
	public function setHasAssembly($val){
		$this->hasassembly= $val;
	}
	public function getHasAssembly(){
		return $this->hasassembly;
	}
	public function setManualPath($val){
		$this->manualpath= $val;
	}
	public function getManualPath(){
		return $this->manualpath;
	}
	public function setPart1($val){
		$this->part1= $val;
	}
	public function getPart1(){
		return $this->part1;
	}
	public function setPart2($val){
		$this->part2= $val;
	}
	public function getPart2(){
		return $this->part2;
	}
	public function setPart3($val){
		$this->part3= $val;
	}
	public function getPart3(){
		return $this->part3;
	}
	public function setPart4($val){
		$this->part4= $val;
	}
	public function getPart4(){
		return $this->part4;
	}
	public function setPart5($val){
		$this->part5= $val;
	}
	public function getPart5(){
		return $this->part5;
	}
	public function setCordLengthMeter($val){
		$this->cordlengthmeter= $val;
	}
	public function getCordLengthMeter(){
		return $this->cordlengthmeter;
	}
	public function setPumpWattage($val){
		$this->pumpwattage= $val;
	}
	public function getPumpWattage(){
		return $this->pumpwattage;
	}
	public function setPumpVolts($val){
		$this->pumpvolts= $val;
	}
	public function getPumpVolts(){
		return $this->pumpvolts;
	}
	public function setPumpCordLength($val){
		$this->pumpcordlength= $val;
	}
	public function getPumpCordLength(){
		return $this->pumpcordlength;
	}
	public function setTransformerWattage($val){
		$this->transformerwattage= $val;
	}
	public function getTransformerWattage(){
		return $this->transformerwattage;
	}
	public function setTransformerVolts($val){
		$this->transformervolts= $val;
	}
	public function getTransformerVolts(){
		return $this->transformervolts;
	}
	public function setTransformerCordLength($val){
		$this->transformercordlength= $val;
	}
	public function getTransformerCordLength(){
		return $this->transformercordlength;
	}
	public function setWaterCapacity($val){
		$this->watercapacity= $val;
	}
	public function getWaterCapacity(){
		return $this->watercapacity;
	}
	public function setFeature1($val){
		$this->feature1 = $val;
	}
	public function getFeature1(){
		return $this->feature1;
	}
	public function setFeature2($val){
		$this->feature2 = $val;
	}
	public function getFeature2(){
		return $this->feature2;
	}
	public function setFeature3($val){
		$this->feature3 = $val;
	}
	public function getFeature3(){
		return $this->feature3;
	}
	public function setFeature4($val){
		$this->feature4 = $val;
	}
	public function getFeature4(){
		return $this->feature4;
	}
	public function setFeature5($val){
		$this->feature5 = $val;
	}
	public function getFeature5(){
		return $this->feature5;
	}
	public function setFeature6($val){
		$this->feature6 = $val;
	}
	public function getFeature6(){
		return $this->feature6;
	}
	public function setFeature7($val){
		$this->feature7 = $val;
	}
	public function getFeature7(){
		return $this->feature7;
	}
	public function setUpdatedBy($val){
		$this->updatedby = $val;
	}
	public function getUpdatedBy(){
		return $this->updatedby;
	}
	public function setTroy($val){
		$this->troy = $val;
	}
	public function getTroy(){
		return $this->troy;
	}
	public function setUserSeq($val){
		$this->userseq = $val;
	}
	public function getUserSeq(){
		return $this->userseq;
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
	
	public function createFromRequest($request){
		if (is_array($request)){
			$this->from_array($request);
		}
		return $this;
	}
	
	public function from_array($array){
		foreach(get_object_vars($this) as $attrName => $attrValue){
			$flag = property_exists(self::$className, $attrName);
			$isExists = array_key_exists($attrName, $array);
			if($flag && $isExists){
				$this->{$attrName} = $array[$attrName];
			}
		}
	}

}