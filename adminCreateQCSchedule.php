<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QCSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
 $qcSchedule = new QCSchedule();
 $qcScheduleMgr = QCScheduleMgr::getInstance();
 $readOnlyPO = "";
 if(isset($_POST["id"])){
 	$seq = $_POST["id"];
 	$qcSchedule = $qcScheduleMgr->findBySeq($seq);
 	$readOnlyPO = "readonly";
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
                 	 <form id="createQCScheduleForm" method="post" action="Actions/QCScheduleAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveQCSchedule"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $qcSchedule->getSeq()?>"/>
                        <input type="hidden" id="materialtotalpercent" name="materialtotalpercent"/>
                        <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label">QC</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  id="qc" maxLength="250" value="<?php echo $qcSchedule->getQC()?>" name="qc" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label">Class Code</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required id="classcode" maxLength="250" value="<?php echo $qcSchedule->getClassCode()?>" name="classcode" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label">PO Number</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  id="po" maxLength="250" value="<?php echo $qcSchedule->getPO()?>" name="po" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label">PO Type</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  required id="potype" maxLength="250" value="<?php echo $qcSchedule->getPOType()?>" name="potype" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label">Item Numbers</label>
	                        	<div class="col-lg-4">
	                            	<textarea <?php echo $readOnlyPO?> id="itemnumbers" required maxLength="250" name="itemnumbers" class="form-control"><?php echo $qcSchedule->getItemNumbers()?></textarea>
	                            </div>
	                            <label class="col-lg-2 col-form-label">Ship Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required placeholder="Select Date" id="itemno" onchange="setDates(this.value)" maxLength="250" value="<?php echo $qcSchedule->getShipDate()?>" name="shipdate" class="form-control dateControl" <?php echo $readOnlyPO?>>
	                            </div>
	                        </div>
	                        
	                    </div>
                        <div class="bg-muted p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Scheduled Information</h4><br>
	                         	<label class="col-lg-2 col-form-label">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="screadydate" maxLength="250" value="<?php echo $qcSchedule->getSCReadyDate()?>" name="screadydate" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getSCFinalInspectionDate()?>" name="scfinalinspectiondate" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scmiddleinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getSCMiddleInspectionDate()?>" name="scmiddleinspectiondate" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scfirstinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getSCFirstInspectionDate()?>" name="scfirstinspectiondate" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly id="scproductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getSCProductionStartDate()?>" name="scproductionstartdate" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" readonly  id="scgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getSCGraphicsReceiveDate()?>" name="scgraphicsreceivedate" class="form-control">
	                            </div>
	                       </div>
	                  </div>
	                  
	                  <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Appointment Information</h4><br>
	                         	<label class="col-lg-2 col-form-label">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  id="apreadydate" maxLength="250" value="<?php echo $qcSchedule->getAPReadyDate()?>" name="apreadydate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="apfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFinalInspectionDate()?>" name="apfinalinspectiondate" class="form-control dateControl">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="apmiddleinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPMiddleInspectionDate()?>" name="apmiddleinspectiondate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="apfirstinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getAPFirstInspectionDate()?>" name="apfirstinspectiondate" class="form-control dateControl">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="approductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getAPProductionStartDate()?>" name="approductionstartdate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="apgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getAPGraphicsReceiveDate()?>" name="apgraphicsreceivedate" class="form-control dateControl">
	                            </div>
	                       </div>
	                  </div>
	                  
	                  
	                  <div class="bg-muted p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Actual Information</h4><br>
	                         	<label class="col-lg-2 col-form-label">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  id="acreadydate" maxLength="250" value="<?php echo $qcSchedule->getACReadyDate()?>" name="acreadydate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acfinalinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getACFinalInspectionDate()?>" name="acfinalinspectiondate" class="form-control dateControl">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acmiddleinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getACMiddleInspectionDate()?>" name="acmiddleinspectiondate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acfirstinspectiondate" maxLength="250" value="<?php echo $qcSchedule->getACFirstInspectionDate()?>" name="acfirstinspectiondate" class="form-control dateControl">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acproductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getACProductionStartDate()?>" name="acproductionstartdate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getACGraphicsReceiveDate()?>" name="acgraphicsreceivedate" class="form-control dateControl">
	                            </div>
	                       </div>
	                  </div>
                       <div class="bg-white p-xs outterDiv">
                       		<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label">Status</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" id="status" maxLength="250" value="<?php echo $qcSchedule->getStatus()?>" name="status" class="form-control">
	                            </div>
	                        	<label class="col-lg-2 col-form-label">Notes</label>
	                        	<div class="col-lg-4">
	                        		<textarea id="notes" maxLength="250" name="notes" class="form-control"><?php echo $qcSchedule->getNotes()?></textarea>
	                        	 </div>
	                        </div>
	                   </div> 
	                    
                        <div class="bg-white p-xs">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label"></label>
	                        	<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveQCSchedule()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
		                        <div class="col-lg-2">
		                          	<a class="btn btn-default" href="adminManageQCSchedules.php" type="button" style="width:85%">
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
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
	})
});
function setDates(shipDateStr){
	if(shipDateStr == ""){
		$("#screadydate").val("");
		$("#scfinalinspectiondate").val("");
		$("#scmiddleinspectiondate").val("");
		$("#scfirstinspectiondate").val("");
		$("#scproductionstartdate").val("");
		$("#scgraphicsreceivedate").val("");
		return;
	}
	var shipDate = getDate(shipDateStr);
	readyDateDays = 14;
	var scReadyDate = subtractDays(shipDate,readyDateDays);
	scReadyDateStr = dateToStr(scReadyDate);
	$("#screadydate").val(scReadyDateStr);

	shipDate = getDate(shipDateStr);
	finalInspectionDateDays = 10;
	var finalInspectionDate = subtractDays(shipDate,finalInspectionDateDays);
	finalInspectionDateStr = dateToStr(finalInspectionDate);
	$("#scfinalinspectiondate").val(finalInspectionDateStr);

	shipDate = getDate(shipDateStr);
	middleInspectionDateDays = 15;
	var middleInspectionDate = subtractDays(shipDate,middleInspectionDateDays);
	middleInspectionDateStr = dateToStr(middleInspectionDate);
	$("#scmiddleinspectiondate").val(middleInspectionDateStr);

	shipDate = getDate(shipDateStr);	
	firstInspectionDateDays = 35;
	var firstInspectionDate = subtractDays(shipDate,firstInspectionDateDays);
	firstInspectionDateStr = dateToStr(firstInspectionDate);
	$("#scfirstinspectiondate").val(firstInspectionDateStr);

	shipDate = getDate(shipDateStr);
	productionDateDays = 45;
	var productionDate = subtractDays(shipDate,productionDateDays);
	productionDateStr = dateToStr(productionDate);
	$("#scproductionstartdate").val(productionDateStr);

	shipDate = getDate(shipDateStr);
	graphicsDateDays = 30;
	var graphicsDate = subtractDays(shipDate,graphicsDateDays);
	graphicsDateStr = dateToStr(graphicsDate);
	$("#scgraphicsreceivedate").val(graphicsDateStr);
}
function saveQCSchedule(){
	if($("#createQCScheduleForm")[0].checkValidity()) {
		showHideProgress()
		$('#createQCScheduleForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageQCSchedules.php"},100);
		   }
	    })	
	}else{
		$("#createQCScheduleForm")[0].reportValidity();
	}
}
function getDate(dateString) {
    var parts = dateString.split('-');
    var month = parts[0] - 1;
    var day = parts[1];
    var year = parts[2]
    var dateObj = new Date(year,month,day);
    return dateObj;
}
function dateToStr(date){
	var dd = date.getDate();
	var mm = date.getMonth() + 1; //January is 0!

	var yyyy = date.getFullYear();
	if (dd < 10) {
	  dd = '0' + dd;
	} 
	if (mm < 10) {
	  mm = '0' + mm;
	} 
	var dateStr = mm + '-' +  dd + '-' + yyyy;
	return dateStr;
}
function addDays(date, days) {
   date.setDate(date.getDate() + days);
   return date;
}
function subtractDays(date, days) {
	 var sDate = date;
	 sDate.setDate(sDate.getDate() - days);
	 return sDate;
}
</script>