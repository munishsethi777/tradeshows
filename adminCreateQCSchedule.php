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
<title>Admin | QC Schedule</title>
<?include "ScriptsInclude.php"?>
<style type="text/css">
.col-form-label{
	font-weight:400 !important;
}
.areaTitle{
	margin:0px 0px 0px 15px !important;
	color:#1ab394;
	font-size:15px;
}
.bg-white{
	background-color:rgb(252,252,252);
}
.bg-muted{
}
.outterDiv{
	border-bottom:1px silver dashed;
	padding:20px 10px;
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
							<h5 class="pageTitle">Create/Edit QC Schedule</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="itemSpecForm" method="post" action="Actions/ItemSpecificationAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveItemSpecification"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $itemSpecification->getSeq()?>"/>
                        <input type="hidden" id="materialtotalpercent" name="materialtotalpercent"/>
                        <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label">QC</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="itemno" maxLength="250" value="<?php echo $itemSpecification->getItemNo()?>" name="itemno" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Class Code</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="itemno" maxLength="250" value="<?php echo $itemSpecification->getItemNo()?>" name="itemno" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label">PO Number</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="itemno" maxLength="250" value="<?php echo $itemSpecification->getItemNo()?>" name="itemno" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">PO Type</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="itemno" maxLength="250" value="<?php echo $itemSpecification->getItemNo()?>" name="itemno" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label">Item Numbers</label>
	                        	<div class="col-lg-4">
	                            	<textarea id="itemno" maxLength="250" value="<?php echo $itemSpecification->getItemNo()?>" name="itemno" class="form-control"></textarea>
	                            </div>
	                            <label class="col-lg-2 col-form-label">Ship Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="itemno" maxLength="250" value="<?php echo $itemSpecification->getItemNo()?>" name="itemno" class="form-control">
	                            </div>
	                        </div>
	                        
	                    </div>
                        <div class="bg-muted p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Scheduled Information</h4><br>
	                         	<label class="col-lg-2 col-form-label">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" disabled id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" disabled id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" disabled id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" disabled id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" disabled id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" disabled  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                       </div>
	                  </div>
	                  
	                  <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Actual Information</h4><br>
	                         	<label class="col-lg-2 col-form-label">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="item1description" maxLength="250" value="<?php echo $itemSpecification->getItem1Description()?>" name="item1description" class="form-control">
	                            </div>
	                       </div>
	                  </div>
                        
	                    
                        <div class="bg-white p-xs">
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