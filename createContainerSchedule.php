<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");

require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerSchedule.php");
$containerSchedule = new ContainerSchedule();
$sessionUtil = SessionUtil::getInstance();
$graphicLog = new GraphicsLog(); 
$containerScheduleMgr = GraphicLogMgr::getInstance();
$readOnlyPO = "";
$hasWrapTag = "";
$hasHangTag = "";
$hasPrivate = "";
$enteredBySeq = $sessionUtil->getUserLoggedInSeq();
if(isset($_POST["id"])){
	$seq = $_POST["id"];
 	$containerSchedule = $containerScheduleMgr->findBySeq($seq);
 	//$readOnlyPO = "readonly";
 	if($containerSchedule->getIsCustomWrapTagNeeded() == 1){
 		$hasWrapTag = "checked";
 	}
 	if($containerSchedule->getIsCustomHangTagNeeded() == 1){
 		$hasHangTag = "checked";
 	}
 	if($containerSchedule->getIsPrivateLabel() == 1){
 		$hasPrivate = "checked";
 	}
 	$enteredBySeq = $containerSchedule->getUserSeq();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Container Schedule</title>
<?include "ScriptsInclude.php"?>
<style type="text/css">
.col-form-label{
	font-weight:400 !important;
	line-height: 1.2 !important;
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
							<h5 class="pageTitle">Create/Edit Container Schedule</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createGraphicLogForm" method="post" action="Actions/ContainerScheduleAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveContainerSchedule"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $containerSchedule->getSeq()?>"/>
                        
                        <div class="bg-white1 p-xs outterDiv">
                        	<div class="overlay"></div>
                        	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">AWU Ref:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" required  id="awureference" 
                                			maxLength="250" value="<?php echo $containerSchedule->getAWUReference()?>" 
                                			name="awureference" class="form-control">
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabelDark">Trucker Name:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" id="truckername" 
                                			maxLength="250" value="<?php echo $containerSchedule->getTruckerName()?>" 
                                			name="truckername" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Trans:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" id="trans" 
                                			maxLength="250" value="<?php echo $containerSchedule->getTrans()?>" 
                                			name="trans" class="form-control">
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabelDark">Warehouse:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" id="warehouse" 
                                			maxLength="250" value="<?php echo $containerSchedule->getWarehouse()?>" 
                                			name="warehouse" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Container:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" id="container" 
                                			maxLength="250" value="<?php echo $containerSchedule->getContainer()?>" 
                                			name="container" class="form-control">
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabelDark">ETA:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getEtaDateTime()?>" name="etadatetime" id="etadatetime" class="form-control  dateTimeControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                        </div>
	                         <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Terminal:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" id="terminal" 
                                			maxLength="250" value="<?php echo $containerSchedule->getTerminal()?>" 
                                			name="terminal" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Terminal Appointment:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getTerminalAppointmentDateTime()?>" name="terminalappointmentdatetime" id="terminalappointmentdatetime" class="form-control dateTimeControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabelDark">ETA Notes:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" id="etanotes" 
                                			maxLength="250" value="<?php echo $containerSchedule->getETANotes()?>" 
                                			name="etanotes" class="form-control">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">LFD Pickup:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getLFDPickupDate()?>" name="lfdpickupdate" id="lfdpickupdate" class="form-control  dateControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                        </div>
					</div>
	                <div class="bg-white1 p-xs outterDiv">
	                     <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Scheduled Delivery:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getScheduledDeliveryDateTime()?>" name="scheduleddeliverydatetime" id="scheduleddeliverydatetime" class="form-control  dateTimeControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabelMauve">Confirmed Delivery:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getConfirmedDeliveryDateTime()?>" name="confirmedDeliverydatetime" id="confirmeddeliverydatetime" class="form-control  dateTimeControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                     </div>
	                     <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Empty LFD:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getEmptyLfdDate()?>" name="emptylfddate" id="emptylfddate" class="form-control  dateControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabelMauve">Delivery Gate:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" value="<?php echo $containerSchedule->getDeliveryGate()?>" name="deliverygate" id="deliverygate" class="form-control">
	                            	
	                            </div>
	                     </div>     
					</div>
					<div class="bg-white1 p-xs outterDiv">
	                     <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Empty Return Date:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getEmptyReturnDate()?>" name="emptyreturndate" id="emptyreturndate" class="form-control  dateControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabelMauve">Alpine Notification Pickup Date:</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" value="<?php echo $containerSchedule->getAlpineNotificatinPickupDateTime()?>" name="alpinenotificatinpickupdatetime" id="alpinenotificatinpickupdatetime" class="form-control  dateTimeControl">
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                     </div>
	                     <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabelDark">Notes:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" value="<?php echo $containerSchedule->getEmptyNotes()?>" name="emptynotes" id="emptynotes" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabelMauve">Notes:</label>
	                        	<div class="col-lg-4">
	                        		<input type="text" id="notificationnotes" 
                                			maxLength="250" value="<?php echo $containerSchedule->getNotificationNotes()?>" 
                                			name="notificationnotes" class="form-control">
	                            </div>
	                     </div>     
					</div>	
					<div class="bg-white1 p-xs outterDiv">
						<div class="form-group row">
	                    		<label class="col-lg-12 col-form-label bg-formLabelBrown text-center">- :  FOR OFFICE USE ONLY : -</label>
	                    </div>
						<div class="form-group row">
	                    	<label class="col-lg-2 col-form-label bg-formLabelBrown">Container Docs Path:</label>
	                        <div class="col-lg-10">
								<input type="text" value="<?php echo $containerSchedule->getContainerdocsPath()?>" name="containerdocspath" id="containerdocspath" class="form-control  dateControl">
	                       	</div>
                     	</div>
                     	<div class="form-group row i-checks">
	                    	<label class="col-lg-2 col-form-label bg-formLabelBrown">IDs Complete:</label>
	                        <div class="col-lg-4">
								<input type="checkbox" <?php //echo $hasHangTag?> name="isidscomplete"/>	
							</div>
	                       	
	                       	<label class="col-lg-2 col-form-label bg-formLabelBrown">Samples:</label>
	                        <div class="col-lg-4">
								<input type="checkbox" <?php //echo $hasHangTag?> name="issamplesreceived"/>	
							</div>
                     	</div>
                        <div class="form-group row">
	                    	<label class="col-lg-2 col-form-label bg-formLabelBrown">MSRF Created:</label>
	                        <div class="col-lg-4">
								<div class="input-group date">
                                	<input type="text" value="<?php echo $containerSchedule->getMsrfCreatedDate()?>" name="msrfcreateddate" id="msrfcreateddate" class="form-control  dateControl">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	</div>
	                       	</div>
	                       	<label class="col-lg-2 col-form-label bg-formLabelBrown">Received:</label>
	                        <div class="col-lg-4">
								<div class="input-group date">
                                	<input type="text" value="<?php echo $containerSchedule->getSamplesReceivedDate()?>" name="samplesreceiveddate" id="samplesreceiveddate" class="form-control  dateControl">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	</div>
	                       	</div>
                     	</div>
                     	<div class="form-group row">
	                    	<label class="col-lg-4 col-lg-offset-1 bg-formLabelBrown text-center">CONTAINER</label>
	                        <label class="col-lg-4 col-lg-offset-2 bg-formLabelBrown text-center">SAMPLES</label>
	                    </div>
                     	<div class="form-group row i-checks">
	                    	<label class="col-lg-2 col-form-label bg-formLabelBrown">Received in OMS:</label>
	                        <div class="col-sm-1 m-t-xs">
	                        	<input type="checkbox" <?php //echo $hasHangTag?> name="iscontainerreceivedinoms"/>
							</div>
							<div class="col-lg-3">
								<div class="input-group date">
                                	<input type="text" value="<?php echo $containerSchedule->getContainerReceivedinOMSDate()?>" name="containerreceivedinomsdate" id="containerreceivedinomsdate" class="form-control  dateControl">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	</div>
							</div>
	                       	
	                       	<label class="col-lg-2 col-form-label bg-formLabelBrown">Received in OMS:</label>
	                        <div class="col-sm-1 m-t-xs">
	                        	<input type="checkbox" <?php //echo $hasHangTag?> name="issamplesreceivedinoms"/>
							</div>
							<div class="col-lg-3">
								<div class="input-group date">
                                	<input type="text" value="<?php echo $containerSchedule->getSamplesReceivedinOMSDate()?>" name="samplesreceivedinomsdate" id="samplesreceivedinomsdate" class="form-control  dateControl">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	</div>
							</div>
                     	</div>
                     	<div class="form-group row i-checks">
	                    	<label class="col-lg-2 col-form-label bg-formLabelBrown">Received in WMS:</label>
	                        <div class="col-sm-1 m-t-xs">
	                        	<input type="checkbox" <?php //echo $hasHangTag?> name="iscontainerreceivedinwms"/>
							</div>
							<div class="col-lg-3">
								<div class="input-group date">
                                	<input type="text" value="<?php echo $containerSchedule->getContainerReceivedinWMSDate()?>" name="containerreceivedinwmsdate" id="containerreceivedinwmsdate" class="form-control  dateControl">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	</div>
							</div>
	                       	
	                       	<label class="col-lg-2 col-form-label bg-formLabelBrown">Received in WMS:</label>
	                        <div class="col-sm-1 m-t-xs">
	                        	<input type="checkbox" <?php //echo $hasHangTag?> name="$issamplesreceivedinwms"/>
							</div>
							<div class="col-lg-3">
								<div class="input-group date">
                                	<input type="text" value="<?php echo $containerSchedule->getSamplesReceivedinWMSDate()?>" name="samplesreceivedinwmsdate" id="samplesreceivedinwmsdate" class="form-control  dateControl">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            	</div>
							</div>
                     	</div>
					</div>
					
					
	                       
                    <div class="bg-white p-xs">
                        <div class="form-group row">
                        	<div class="col-lg-2">
	                        	<button class="btn btn-primary" onclick="saveQCSchedule()" type="button" style="width:85%">
                                	Save
	                          	</button>
	                        </div>
	                        <div class="col-lg-2">
	                          	<a class="btn btn-default" href="adminManageGraphicLogs.php" type="button" style="width:85%">
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
		checkboxClass: 'icheckbox_square-brown',
	   	radioClass: 'iradio_square-brown',
	});
	$("#graphictype").chosen({width:"100%"});
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
		onSelectDate:function(ct,$i){
			//setDuration();
		}
	})
	$('.dateTimeControl').datetimepicker({
	    timepicker:true,
	    format:'m-d-Y h:i a',
	    scrollMonth : false,
		scrollInput : false,
		onSelectDate:function(ct,$i){
			//setDuration();
		}
	})
	//showTagFields();
	//showGraphicFields();
	//showLabelFields();
	//loadCustomer();
	//showHideLabelType();
	//$('#isprivatelabel').on('ifChanged', function(event){
		//showHideLabelType();
	//});
	$(".positive-integer").numeric({ decimalPlaces: 2, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
});
function setDuration(){
	var startDateStr = $("#graphicartiststartdate").val();
	var endDateStr = $("#approxgraphicschinasentdate").val();
	if(startDateStr == "" || endDateStr == ""){
		return;
	}
	var startDate = parseDate(startDateStr);
	var endDate = parseDate(endDateStr);
	if(startDate > endDate){
		alert("Start Date should be less than Appx Completion Date");
		$("#duration").val(0);	
		return false;
	}else{
		var daysDiff = datediff(startDate,endDate);
		$("#duration").val(daysDiff);	
	}
	

	
}
function parseDate(str) {
    var mdy = str.split('-');
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function datediff(first, second) {
    // Take the difference between the dates and divide by milliseconds per day.
    // Round to nearest whole number to deal with DST.
    return Math.round((second-first)/(1000*60*60*24));
}

function showHideLabelType(){
	var flag  = $("#isprivatelabel").is(':checked');	
	if(flag){
		$("#labelTypeDiv").show();
	}else{
		$("#labelTypeDiv").hide();
	}
	showLabelFields();
}
function loadCustomer(){		
    $(".customers").select2({
    	tags: true,
        ajax: {
        url: "Actions/CustomerAction.php?call=searchCustomers",
        dataType: 'json',            
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
      
        processResults: function (data, page) {
          return data;
        },
        cache: true
      },
      width: '100%',
      minimumInputLength: 1
    });
}
function showLabelFields(){
	value = $("#labeltype").val();
	var isPrivate  = $("#isprivatelabel").is(':checked');
	if(value == "custom" && isPrivate){
		$("#labelFields").show();
		$("#labellength").attr("required","required");
		$("#labelwidth").attr("required","required");
		$("#labelheight").attr("required","required");
	}else{
		$("#labelFields").hide();
		$("#labellength").removeAttr("required");
		$("#labelwidth").removeAttr("required");
		$("#labelheight").removeAttr("required");
	}
}

function showTagFields(){
	value = $("#tagtype").val();
	if(value == "custom"){
		$("#tagFields").show();
		$("#taglength").attr("required","required");
		$("#tagwidth").attr("required","required");
		$("#tagheight").attr("required","required");
	}else{
		$("#tagFields").hide();
		$("#taglength").removeAttr("required");
		$("#tagwidth").removeAttr("required");
		$("#tagheight").removeAttr("required");
	}
}
function showGraphicFields(){
	value = $("#graphictype").val();
	if(value != "a4_label" && value != ""){
		$("#graphicFields").show();
		//$("#graphiclength").attr("required","required");
		//$("#graphicwidth").attr("required","required");
		//$("#graphicheight").attr("required","required");
	}else{
		$("#graphicFields").hide();
		//$("#graphiclength").removeAttr("required");
		//$("#graphicwidth").removeAttr("required");
		//$("#graphicheight").removeAttr("required");
	}
}
function setDates(estimatedshipdateStr){
	if(estimatedshipdateStr == ""){
		$("#estimatedgraphicsdate").val("");
		$("#finalgraphicsduedate").val("");
		return;
	}
	var estimatedshipdate = getDate(estimatedshipdateStr);
	estimatedGraphicsDays = 30;
	var estimatedgraphicsdate = subtractDays(estimatedshipdate,estimatedGraphicsDays);
	estimatedgraphicsdateStr = dateToStr(estimatedgraphicsdate);
	$("#estimatedgraphicsdate").val(estimatedgraphicsdateStr);
	$("#finalgraphicsduedate").val(estimatedgraphicsdateStr);

	if($("#chinaofficeentrydate").val() != ""){
		callChinaEntryDate($("#chinaofficeentrydate").val());
	}
}
function callChinaEntryDate(chinaEntryDate){
	if(chinaEntryDate == ""){
		if($("#estimatedshipdate").val() != ""){
			setDates($("#estimatedshipdate").val());
			return;
		}
	}
	
	var chinaEntryDate = getDate(chinaEntryDate);
	finalgraphicsduedateDays = 20;
	var finalgraphicsduedate = addDays(chinaEntryDate,finalgraphicsduedateDays);
	finalgraphicsduedateStr = dateToStr(finalgraphicsduedate);
	$("#finalgraphicsduedate").val(finalgraphicsduedateStr);
}
function saveQCSchedule(){
	$("#classcode").val(($( "#classcodeseq option:selected" ).text()));
	if($("#createGraphicLogForm")[0].checkValidity()) {
		showHideProgress()
		$('#createGraphicLogForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageGraphicLogs.php"},100);
		   }
	    })	
	}else{
		$("#createGraphicLogForm")[0].reportValidity();
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