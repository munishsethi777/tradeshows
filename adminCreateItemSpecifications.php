<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ItemSpecification.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemSpecificationMgr.php");
 $itemSpecification = new ItemSpecification();
 $itemSpecificationMgr = ItemSpecificationMgr::getInstance();
 $hasLight = "";
 $hasElec = "";
 $hasBattery = "";
 $hasAssemb = "";
 if(isset($_POST["id"])){
 	$seq = $_POST["id"];
 	$itemSpecification = $itemSpecificationMgr->getBySeq($seq);
 	if(!empty($itemSpecification->getHasLight())){
 		$hasLight = "checked";
 	}
 	if(!empty($itemSpecification->getHasElectricity())){
 		$hasElec = "checked";
 	}
 	if(!empty($itemSpecification->getHasBattery())){
 		$hasBattery = "checked";
 	}
 	if(!empty($itemSpecification->getHasAssembly())){
 		$hasAssemb = "checked";
 	}
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Item Specifications</title>
<?include "ScriptsInclude.php"?>
<style type="text/css">
.col-form-label{
	font-weight:400 !important;
}
</style>
</head>
<body>
    <div id="wrapper">
    <?php include("adminmenuInclude.php")?>  
    <div id="page-wrapper" class="gray-bg">
	    <div class="row border-bottom">
	    	<div class="col-lg-12">
	         <div class="ibox">
	         	<div class="ibox-title">
                   	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
							href="#"><i class="fa fa-bars"></i> </a>
							<h5 class="pageTitle">Create/Edit Item Specifications</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="itemSpecForm" method="post" action="Actions/ItemSpecificationAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveItemSpecification"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $itemSpecification->getSeq()?>"/>
                        <input type="hidden" id="materialtotalpercent" name="materialtotalpercent"/>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">Item No</label>
                        	<div class="col-lg-4">
                            	<input type="text"  id="itemno" maxLength="250" value="<?php echo $itemSpecification->getOms()?>" name="itemno" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label">OMS</label>
                        	<div class="col-lg-4">
                            	<input type="text" id="oms" maxLength="250" value="<?php echo $itemSpecification->getOms()?>" name="oms" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Item1 Desc</label>
                        	<div class="col-lg-10">
                            	<input type="text"  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
                            </div>
                            <hr>
                        	<label class="col-lg-2 col-form-label">Item1 Length</label>
                        	<div class="col-lg-2">
                            	<input type="text" id="item1length" maxLength="250" value="<?php echo $itemSpecification->getItem1Length()?>" name="item1length" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Item1 Width</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item1width" maxLength="250" value="<?php echo $itemSpecification->getItem1Width()?>" name="item1width" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Item1 Height</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item1height" maxLength="250" value="<?php echo $itemSpecification->getItem1Height()?>" name="item1height" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Item2 Desc</label>
                        	<div class="col-lg-10">
                            	<input type="text"  id="item2description" maxLength="250" value="<?php echo $itemSpecification->getItem2Description()?>" name="item2description" class="form-control">
                            </div>
                            <hr>
                        	<label class="col-lg-2 col-form-label">Item2 Length</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item2length" maxLength="250" value="<?php echo $itemSpecification->getItem2Length()?>" name="item2length" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Item2 Width</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item2width" maxLength="250" value="<?php echo $itemSpecification->getItem2Width()?>" name="item2width" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Item2 Height</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item2height" maxLength="250" value="<?php echo $itemSpecification->getItem2Height()?>" name="item2height" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Item3 Desc</label>
                        	<div class="col-lg-10">
                            	<input type="text"  id="item3description" maxLength="250" value="<?php echo $itemSpecification->getItem3Description()?>" name="item3description" class="form-control">
                            </div>
                            <hr>
                        	<label class="col-lg-2 col-form-label">Item3 Length</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item3length" maxLength="250" value="<?php echo $itemSpecification->getItem3Length()?>" name="item3length" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Item3 Width</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item3width" maxLength="250" value="<?php echo $itemSpecification->getItem3Width()?>" name="item3width" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Item3 Height</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="item3height" maxLength="250" value="<?php echo $itemSpecification->getItem3Height()?>" name="item3height" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Master Carton1 Length</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="mastercarton1length" maxLength="250" value="<?php echo $itemSpecification->getMasterCarton1Length()?>" name="mastercarton1length" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Master Carton1 Width</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="mastercarton1width" maxLength="250" value="<?php echo $itemSpecification->getMasterCarton1Width()?>" name="mastercarton1width" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Master Carton1 Height</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="mastercarton1height" maxLength="250" value="<?php echo $itemSpecification->getMasterCarton1Height()?>" name="mastercarton1height" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Master Carton2 Length</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="mastercarton2length" maxLength="250" value="<?php echo $itemSpecification->getMasterCarton2Length()?>" name="mastercarton2length" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Master Carton2 Width</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="mastercarton2width" maxLength="250" value="<?php echo $itemSpecification->getMasterCarton2Width()?>" name="mastercarton2width" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Master Carton2 Height</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="mastercarton2height" maxLength="250" value="<?php echo $itemSpecification->getMasterCarton2Height()?>" name="mastercarton2height" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">MS Description</label>
                        	<div class="col-lg-2">
                            	<input type="text"  id="msdescription" maxLength="250" value="<?php echo $itemSpecification->getMSDescription()?>" name="msdescription" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Port</label>
                        	<div class="col-lg-2">
                            	<input type="text" id="port" maxLength="250" value="<?php echo $itemSpecification->getPort()?>" name="port" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Country of Origin</label>
                        	<div class="col-lg-2">
                            	<input type="text" id="countryoforigin" maxLength="250" value="<?php echo $itemSpecification->getCountryOfOrigin()?>" name="countryoforigin" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Material1</label>
                        	<div class="col-lg-1">
                            	<input type="text"  maxLength="250" value="<?php echo $itemSpecification->getMaterial1()?>" name="material1" class="form-control">
                            </div>
                            <label class="col-lg-2  col-form-label">Material1 Percent</label>
                        	<div class="col-lg-1">
                            	<input type="text"  maxLength="250" value="<?php echo $itemSpecification->getMaterial1Percent()?>" name="material1percent" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Material2</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial2()?>" name="material2" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Material2 Percent</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial2Percent()?>" name="material2percent" class="form-control">
                            </div>
                            <span class="col-lg-12 m-b-sm"></span>
                            
                            <label class="col-lg-2 col-form-label">Material3</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial3()?>" name="material3" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Material3 Percent</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial3Percent()?>" name="material3percent" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Material4</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial4()?>" name="material4" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Material4 Percent</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial4Percent()?>" name="material4percent" class="form-control">
                            </div>
                            <span class="col-lg-12 m-b-sm"></span>
                            
                            
                            <label class="col-lg-2 col-form-label">Material5</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial5()?>" name="material5" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Material5 Percent</label>
                        	<div class="col-lg-1">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getMaterial5Percent()?>" name="material5percent" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row i-checks">
                         	<label class="col-lg-2 col-form-label">Has Light</label>
                        	<div class="col-lg-2">
                        		<input type="checkbox" <?php echo $hasLight?> value="1" name="haslight"/>
                            </div>
                            <label class="col-lg-2 col-form-label">Light Type</label>
                        	<div class="col-lg-2">
                            	<input type="text" value="LED" id="lighttype" maxLength="250" value="<?php echo $itemSpecification->getLightType()?>" name="lighttype" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Total Lumens</label>
                        	<div class="col-lg-2">
                            	<input type="text" value="1800" id="totallumens" maxLength="250" value="<?php echo $itemSpecification->getTotalLumens()?>" name="totallumens" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                         <div class="form-group row i-checks">
                         	<label class="col-lg-2 col-form-label">Has Battery</label>
                        	<div class="col-lg-2">
                        		<input type="checkbox" <?php echo $hasBattery?> value="1" name="hasbattery"/>
                            </div>
                            <label class="col-lg-2 col-form-label">Battery Quantity</label>
                        	<div class="col-lg-2">
                            	<input type="text" value="6" id="batteryquantity" maxLength="250" value="<?php echo $itemSpecification->getBatteryQuantity()?>" name="batteryquantity" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Battery Type</label>
                        	<div class="col-lg-2">
                            	<input type="text" value="test bb" id="batterytype" maxLength="250" value="<?php echo $itemSpecification->getBatteryType()?>" name="batterytype" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row i-checks">
                         	<label class="col-lg-2 col-form-label">Has Electricity</label>
                        	<div class="col-lg-2">
                        		<input type="checkbox" <?php echo $hasElec?> value="1" name="haselectricity"/>
                            </div>
                            <label class="col-lg-2 col-form-label">Electricity Type</label>
                        	<div class="col-lg-2">
                            	<input type="text" id="electricitytype" maxLength="250" value="<?php echo $itemSpecification->getElectricityType()?>" name="electricitytype" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Cord length (feet)</label>
                        	<div class="col-lg-2">
                            	<input type="text" id="cordlengthfeet" maxLength="250" value="<?php echo $itemSpecification->getCordLengthFeet()?>" name="cordlengthfeet" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group row i-checks">
                         	<label class="col-lg-2 col-form-label ">Assembly Required</label>
                        	<div class="col-lg-2">
                        		<input type="checkbox" value="1" <?php echo $hasAssemb?> name="hasassembly"/>
                            </div>
                            <label class="col-lg-2 col-form-label">Manual Path</label>
                        	<div class="col-lg-6">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getManualPath()?>" name="manualpath" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Part1</label>
                        	<div class="col-lg-2">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPart1()?>" name="part1" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Part2</label>
                        	<div class="col-lg-2">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPart2()?>" name="part2" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Part3</label>
                        	<div class="col-lg-2">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPart3()?>" name="part3" class="form-control">
                            </div>
                            <span class="col-lg-12 m-b-sm"></span>
                            <label class="col-lg-2 col-form-label">Part4</label>
                        	<div class="col-lg-2">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPart4()?>" name="part4" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Part5</label>
                        	<div class="col-lg-2">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPart5()?>" name="part5" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Light Cord Length(M.)</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getCordLengthMeter()?>" name="cordlengthmeter" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Pump Wattage</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPumpWattage()?>" name="pumpwattage" class="form-control">
                            </div>
                            <span class="col-lg-12 m-b-sm"></span>
                        	
                        	<label class="col-lg-2 col-form-label">Pump Volts</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPumpVolts()?>" name="cordlengthmeter" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Pump Cord Length(F.)</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getPumpCordLength()?>" name="pumpwattage" class="form-control">
                            </div>
                        	<span class="col-lg-12 m-b-sm"></span>
                        	
                        	<label class="col-lg-2 col-form-label">Transformer Wattage</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getTransformerWattage()?>" name="transformerwattage" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Transformer Volts</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getTransformerVolts()?>" name="transformervolts" class="form-control">
                            </div>
                        	<span class="col-lg-12 m-b-sm"></span>
                        	
                        	<label class="col-lg-2 col-form-label">Transformer Cord Length</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getTransformerCordLength()?>" name="transformercordlength" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Water Capacity</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getWaterCapacity()?>" name="watercapacity" class="form-control">
                            </div>
                        </div>
                        
                        
                       <div class="hr-line-dashed"></div> 
                        <div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Feature 1</label>
                        	<div class="col-lg-4">
                            	<input type="text"  maxLength="250" value="<?php echo $itemSpecification->getFeature1()?>" name="feature1" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Feature 2</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getFeature2()?>" name="feature2" class="form-control">
                            </div>
                            <span class="col-lg-12 m-b-sm"></span>
                            
                            <label class="col-lg-2 col-form-label">Feature 3</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getFeature3()?>" name="feature3" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Feature 4</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getFeature4()?>" name="feature4" class="form-control">
                            </div>
                            <span class="col-lg-12 m-b-sm"></span>
                            
                           	<label class="col-lg-2 col-form-label">Feature 5</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getFeature5()?>" name="feature5" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Feature 6</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getFeature6()?>" name="feature6" class="form-control">
                            </div>
                            <span class="col-lg-12 m-b-sm"></span>
                            
                            <label class="col-lg-2 col-form-label">Feature 7</label>
                        	<div class="col-lg-4">
                            	<input type="text" maxLength="250" value="<?php echo $itemSpecification->getFeature7()?>" name="feature7" class="form-control">
                            </div>
                       </div>
                       <div class="hr-line-dashed"></div>
						<div class="form-group row">
                         	<label class="col-lg-2 col-form-label">Reviewed By</label>
                        	<div class="col-lg-4">
                            	<input type="text"  maxLength="250" value="<?php echo $itemSpecification->getUpdatedBy()?>" name="updatedby" class="form-control">
                            </div>
                            <label class="col-lg-2 col-form-label">Troy</label>
                        	<div class="col-lg-4">
                            	<input type="text" value="test troy" maxLength="250" value="<?php echo $itemSpecification->getTroy()?>" name="troy" class="form-control">
                            </div>
						</div>
                        
                        
                        <div class="form-group row">
                       		<label class="col-lg-2 col-form-label"></label>
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="saveTaskCategory()" type="button" style="width:85%">
                                	Save
	                          	</button>
	                        </div>
	                        <div class="col-lg-2">
	                          	<a class="btn btn-default" href="adminManageItemSpecifications.php" type="button" style="width:85%">
                                	Cancel
	                          	</a>
	                        </div>
	                    </div>
	                   </form>
                	 </div>           
	         	</div>
	    	</div>
       	<div class="row">
       	 	
        </div>
     </div>   	
    </div>
    </div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
});
function saveTaskCategory(){
	if($("#itemSpecForm")[0].checkValidity()) {
		showHideProgress()
		$('#itemSpecForm').ajaxSubmit(function( data ){
			alert(data);
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageItemSpecifications.php"},100);
		   }
	    })	
	}else{
		$("#itemSpecForm")[0].reportValidity();
	}
}
</script>