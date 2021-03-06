
<?
include ("SessionCheck.php");
require_once ('IConstants.inc');
require_once ($ConstantsArray ['dbServerUrl'] . "BusinessObjects/QCSchedule.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Managers/QcscheduleApprovalMgr.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Managers/QCScheduleMgr.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Utils/DropdownUtil.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Utils/SessionUtil.php");
$qcSchedule = new QCSchedule ();
$qcScheduleMgr = QCScheduleMgr::getInstance ();
$readOnlyPO = "";
$middleInspectionChk = "";
$firstInspectionChk = "";
$qcUser = 0;
$seqs = 0;
$seq = 0;
$graphicsReceiveChk = "";
$qcUserReadonly = "";
$sessionUtil = SessionUtil::getInstance ();
$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
$isSessionGeneralUser = $sessionUtil->isSessionGeneralUser ();
$isSessionSV = $sessionUtil->isSessionSupervisor ();
$isSessionAdmin = $sessionUtil->isSessionAdmin ();

if($_REQUEST['seqs'] == ""){
	$qcSchedules = array();
}else{
	$qcSchedules = $qcScheduleMgr->findAllBySeqsForBulkEdit($_REQUEST['seqs'] );
}
$isCompleted = "";


//$qcSchedules = $qcScheduleMgr->findAllBySeqsForBulkEdit($_REQUEST['seqs'] );
//$qc = array("qccode"=> "MUNISH");
//QCNotificationsUtil::sendQCBulkUpdateNotification($qcSchedules, $qc);



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Bulk Edit QC Schedule</title>
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
	padding:20px 20px;
}
.selectedPOTable{
	width:4000px !important;
	max-width:4000px !important;
}

.selectedPODiv{
	overflow-y:scroll;
}
#apmiddleinspectiondatenareason,
#apfirstinspectiondatenareason,
#apgraphicsreceivedatenareason{
	margin-bottom:0px !important;
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
							<h5 class="pageTitle">Bulk Edit QC Schedule</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createQCScheduleForm" method="post" action="Actions/QCScheduleAction.php" class="">
                     	<input type="hidden" id ="call" name="call"  value="bulkUpdateQCSchedule"/>
                     	<input type="hidden" id ="seqs" name="seqs"  value="<?php echo $seqs?>"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $seq?>"/>
                        
                        <input type="hidden" id ="poqccode" name="poqccode"/>
                        <input type="hidden" id ="qccode" name="qccode"/>
                        <input type="hidden" id ="classcode" name="classcode"/>
                        
                        
                      <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">QC</label>
	                        	<div class="col-lg-4">
	                        		<?php 
										$select = DropDownUtils::getQCUsers("qcuser", null,$qcUser,false,true);
		                        		echo $select;
		                        	?>
	                            	<input style="display: none" type="text" id="qc" maxLength="250" value="<?php echo $qcSchedule->getQC()?>" name="qc" class="form-control">
	                            </div>
	                            
	                            <label class="col-lg-2 col-form-label bg-formLabel">PO Incharge</label>
	                        	<div class="col-lg-4">
	                        		<?php 
										$select = DropDownUtils::getPOUsers("poinchargeuser", null,$qcSchedule->getPoInchargeUser(),false,true);
		                        		echo $select;
                             		?>
	                            	<input style="display: none" type="text" id="po" maxLength="250" value="" name="po" class="form-control">
	                            </div>
	                        </div>
							<div class="form-group row">
	                           <label class="col-lg-2 col-form-label bg-formLabel">Submit for Approval</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" id="isapproval" class="form-control i-checks" name="isapproval"/>
	                           </div>
	                           
	                        
	                            <label class="col-lg-2 col-form-label bg-formLabel">Class Code</label>
	                        	<div class="col-lg-4">
 	                            	<?php 
			                           	$select = DropDownUtils::getClassCodes("classcodeseq", "", $qcSchedule->getClassCodeSeq(),false,true,false);
			                            echo $select;
                             		?>
	                            </div>
	                        </div>
	                  </div>  
                        
	                  
	                  <div class="bg-white p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Appointment Information</h4><br>
	                         	<label class="col-lg-2 col-form-label bg-formLabel">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  id="apreadydate" maxLength="250" name="apreadydate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="apfinalinspectiondate" maxLength="250" name="apfinalinspectiondate" class="form-control dateControl">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Middle Inspection Date</label>

	                        	<div class="col-lg-2">
	                        		<div id="middleInspectionSelectDate">
	                            		<input type="text" placeholder="Select Date" id="apmiddleinspectiondate" maxLength="250" name="apmiddleinspectiondate" class="form-control dateControl">
	                            	</div>
	                            	<div style="display:none" id="middleNaDiv">
										<?php 
			                             	$select = DropDownUtils::getReasonTypes("apmiddleinspectiondatenareason", null, $qcSchedule->getApMiddleInspectionDateNaReason(),false,true);
			                                echo $select;
	                             		?>
	                        		</div>
	                            </div>
	                             <label class="col-lg-1 col-form-label">NA</label>
	                            <div class="col-lg-1 i-checks">
	                            	<input type="checkbox" <?php echo $middleInspectionChk?> id="apMiddleInspectionChk" name="apMiddleInspectionChk" class="form-control">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">First Inspection Date</label>
	                          	<div class="col-lg-2">
	                        		<div id="firstInspectionSelectDate">
	                            		<input type="text" placeholder="Select Date" id="apfirstinspectiondate" maxLength="250" name="apfirstinspectiondate" class="form-control dateControl">
	                            	</div>
	                            	<div style="display:none" id="firstNaDiv">
										<?php 
			                             	$select = DropDownUtils::getReasonTypes("apfirstinspectiondatenareason", null, $qcSchedule->getApFirstInspectionDateNaReason(),false,true);
			                                echo $select;
	                             		?>
	                        		</div>
	                            </div>
	                              <label class="col-lg-1 col-form-label">NA</label>
	                            <div class="col-lg-1 i-checks">
	                            	<input type="checkbox" <?php echo $firstInspectionChk?> id="apFirstInspectionChk" name="apFirstInspectionChk" class="form-control" >

	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Production Start Date</label>
	                        	<div class="col-lg-4">

	                            	<input type="text" placeholder="Select Date" id="approductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getAPProductionStartDate()?>" name="approductionstartdate" class="form-control dateControl" <?php echo isset($fieldStateArr["approductionstartdate"])?$fieldStateArr["approductionstartdate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Graphics Receive Date</label>
	                        	<div class="col-lg-2">
	                        		<div id="graphicsReceiveDateDiv">
	                            		<input type="text" placeholder="Select Date" id="apgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getAPGraphicsReceiveDate()?>" name="apgraphicsreceivedate" class="form-control dateControl" <?php echo isset($fieldStateArr["apgraphicsreceivedate"])?$fieldStateArr["apgraphicsreceivedate"]:""?>>
	                            	</div>
	                            	<div style="display:none" id="graphicsNaReasonDiv">
										<?php 
			                             	$select = DropDownUtils::getGraphicsNAReasonTypes("apgraphicsreceivedatenareason", null, $qcSchedule->getAPGraphicsReceiveDateNAReason(),false,true);
			                                echo $select;
	                             		?>
	                        		</div>
	                            </div>
	                             <label class="col-lg-1 col-form-label">NA</label>
	                            <div class="col-lg-1 i-checks">
	                            	<input type="checkbox" <?php echo $graphicsReceiveChk?> id="apGraphicsReceiveChk" name="apGraphicsReceiveChk" class="form-control" <?php echo isset($fieldStateArr["apMiddleInspectionChk"])?$fieldStateArr["apMiddleInspectionChk"]:""?>>
	                            </div>
	                            
	                            
	                       </div>
	                        
	                  </div>
	                  
	                  
	                  <div class="bg-muted p-xs outterDiv">
	                        <div class="form-group row">
                        		<h4 class="areaTitle">Actual Information</h4><br>
	                         	<label class="col-lg-2 col-form-label bg-formLabel">Ready Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  id="acreadydate" maxLength="250" name="acreadydate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Final Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date"  onchange="handleIsCompletedCheckbox()" id="acfinalinspectiondate" maxLength="250" name="acfinalinspectiondate" class="form-control dateControl">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Middle Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acmiddleinspectiondate" maxLength="250" name="acmiddleinspectiondate" class="form-control dateControl">
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">First Inspection Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acfirstinspectiondate" maxLength="250" name="acfirstinspectiondate" class="form-control dateControl">
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Middle Inspection Notes</label>
	                        	<div class="col-lg-4">
	                            	
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">First Inspection Notes</label>
	                        	<div class="col-lg-4">
	                        		
	                            </div>
	                       </div>
	                        <div class="form-group row">
	                          <div class="col-lg-6">
	                         		<textarea id="acmiddleinspectionnotes" maxLength="2500" name="acmiddleinspectionnotes" class="form-control editor"><?php echo $qcSchedule->getAcMiddleInspectionNotes()?></textarea>
	                            </div>
	                            <div class="col-lg-6">
	                                <textarea id="acfirstinspectionnotes" maxLength="2500" name="acfirstinspectionnotes" class="form-control editor"><?php echo $qcSchedule->getAcFirstInspectionNotes()?></textarea>
	                            </div>
	                       </div>
	                       <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Production Start Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acproductionstartdate" maxLength="250" value="<?php echo $qcSchedule->getACProductionStartDate()?>" name="acproductionstartdate" class="form-control dateControl" <?php echo isset($fieldStateArr["acproductionstartdate"])?$fieldStateArr["acproductionstartdate"]:""?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Graphics Receive Date</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" placeholder="Select Date" id="acgraphicsreceivedate" maxLength="250" value="<?php echo $qcSchedule->getACGraphicsReceiveDate()?>" name="acgraphicsreceivedate" class="form-control dateControl" <?php echo isset($fieldStateArr["acgraphicsreceivedate"])?$fieldStateArr["acgraphicsreceivedate"]:""?>>
	                            </div>
	                       </div>
	                       <div class="form-group row">
	                       		
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Completed</label>
	                        	<div class="col-lg-10 completed">
	                        		<input type="checkbox" <?php echo $isCompleted; ?>  id="iscompleted" class="form-control i-checks" name="iscompleted" />
	                           </div>
	                       		
	                       	</div>
	                       
	                  </div>
	                  
					<div class="selectedPODiv">
						<h4 class="p-h-sm areaTitle">Please select QC Schedules you would like to update.</h4>
						<table class="selectedPOTable table table-bordered" >
							<tr>
								<th class="col-form-label bg-formLabel" width="50px !important"></th>
								<th class="col-form-label bg-formLabel">QC</th>
								<th class="col-form-label bg-formLabel">PO Incharge</th>
								<th class="col-form-label bg-formLabel">Class Code</th>
								<th class="col-form-label bg-formLabel">PO #</th>
								<th class="col-form-label bg-formLabel">PO Type</th>
								<th class="col-form-label bg-formLabel">Item #</th>
								<th class="col-form-label bg-formLabel">Ship Date</th>
								<th class="col-form-label bg-formLabel">AP Ready Date</th>
								<th class="col-form-label bg-formLabel">AP Graphics Receive Date</th>
								<th class="col-form-label bg-formLabel">AP Production Start Date</th>
								<th class="col-form-label bg-formLabel">AP First Inspection Date</th>
								<th class="col-form-label bg-formLabel">AP Middle Inspection Date</th>
								<th class="col-form-label bg-formLabel">AP Final Inspection Date</th>
								
								<th class="col-form-label bg-formLabel">AC Ready Date</th>
								<th class="col-form-label bg-formLabel">AC Graphics Receive Date</th>
								<th class="col-form-label bg-formLabel">AC Production Start Date</th>
								<th class="col-form-label bg-formLabel">AC First Inspection Date</th>
								<th class="col-form-label bg-formLabel">AC Middle Inspection Date</th>
								<th class="col-form-label bg-formLabel">AC Final Inspection Date</th>
								
								<th class="col-form-label bg-formLabel">AC Final Inspection Notes</th>
								<th class="col-form-label bg-formLabel">AC Middle Inspection Notes</th>
								<th class="col-form-label bg-formLabel">Completed</th>
							</tr>
						<?php foreach ($qcSchedules as $qcSchedule){?>
							<tr class="tr<?php echo $qcSchedule["seq"] ?>">
								<td class="i-checks">
									<input class="selectionChk" value="<?php echo $qcSchedule["seq"] ?>" id="<?php echo $qcSchedule["seq"] ?>" type="checkbox" name="qcschedulescheck[]">
									</td>
								<td><?php echo $qcSchedule["qccode"];?></td>
								<td><?php echo $qcSchedule["poqccode"];?></td>
								<td><?php echo $qcSchedule["classcode"];?></td>
								<td><?php echo $qcSchedule["po"];?></td>
								<td><?php echo $qcSchedule["potype"];?></td>
								<td><?php echo $qcSchedule["itemnumbers"];?></td>
								<td><?php echo $qcSchedule["shipdate"];?></td>
								<td><?php echo $qcSchedule["apreadydate"];?></td>
								<td><?php echo $qcSchedule["apgraphicsreceivedate"];?></td>
								<td><?php echo $qcSchedule["approductionstartdate"];?></td>
								<td><?php echo $qcSchedule["apfirstinspectiondate"];?></td>
								<td><?php echo $qcSchedule["apmiddleinspectiondate"];?></td>
								<td><?php echo $qcSchedule["apfinalinspectiondate"];?></td>
								<td><?php echo $qcSchedule["acreadydate"];?></td>
								<td><?php echo $qcSchedule["acgraphicsreceivedate"];?></td>
								<td><?php echo $qcSchedule["acproductionstartdate"];?></td>
								<td><?php echo $qcSchedule["acfirstinspectiondate"];?></td>
								<td><?php echo $qcSchedule["acmiddleinspectiondate"];?></td>
								<td><?php echo $qcSchedule["acfinalinspectiondate"];?></td>
								<td><?php echo $qcSchedule["acfirstinspectionnotes"];?></td>
								<td><?php echo $qcSchedule["acmiddleinspectionnotes"];?></td>
								<td><?php echo $qcSchedule["iscompleted"];?></td>
							</tr>
						<?php }?>
							
						</table>
					</div>                        

                        <div class="bg-white p-xs">
	                        <div class="form-group row">
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
     </div>   	
    </div>
    </div>
</body>
</html>
<script type="text/javascript">
var qcReadonly = "<?php echo $qcUserReadonly?>";
$(document).ready(function(){

	$('.selectionChk').on('ifChanged', function(event){
		var flag  = $("#"+this.id).is(':checked');
		if(flag){
			$(".tr"+this.id).addClass("nav-header",100);
		}else{
			$(".tr"+this.id).removeClass("nav-header");
		}
  	});
  	
	if(qcReadonly != ""){
		$("#qcuser").attr("disabled","disabled");
	}else{
		$("#qcuser").removeAttr("disabled");
	}
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	   	
	});
	var middleInspectionNa = "<?php echo $middleInspectionChk?>";
	if(middleInspectionNa != ""){
		showHideMiddleNaDiv(true);
	}

	var firstInspectionNa = "<?php echo $firstInspectionChk?>";
	if(firstInspectionNa != ""){
		showHideFirstNaDiv(true);
	}

	var graphicsReceiveNa = "<?php echo $graphicsReceiveChk?>";
	if(graphicsReceiveNa != ""){
		showHideGraphicsNaDiv(true);
	}
	
	$('.dateControl').attr("autocomplete","off");
	$('.shipDateControl').attr("autocomplete","off");	
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false
	});
	$('.shipDateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
		minDate: 0
	});
	
	
	
	handleIsCompletedCheckbox();
	
	$('#apMiddleInspectionChk').on('ifChanged', function(event){
		var flag  = $("#apMiddleInspectionChk").is(':checked');
		showHideMiddleNaDiv(flag)
  	});
	$('#apFirstInspectionChk').on('ifChanged', function(event){
		var flag  = $("#apFirstInspectionChk").is(':checked');
		showHideFirstNaDiv(flag);
	});
	$('#apGraphicsReceiveChk').on('ifChanged', function(event){
		var flag  = $("#apGraphicsReceiveChk").is(':checked');
		showHideGraphicsNaDiv(flag);
	});
	requiredAcFinalInspection();
	$('#isapproval').on('ifChanged', function(event){
		requiredAcFinalInspection();
  	});
});

function requiredAcFinalInspection(){
	var flag  = $("#isapproval").is(':checked');
	if(flag){
		$("#acfinalinspectiondate").attr("required","required");
	}else{
		$("#acfinalinspectiondate").removeAttr("required");
	}
}
function showHideMiddleNaDiv(flag){
	if(flag){
		$("#middleInspectionSelectDate").hide();
		$("#middleNaDiv").show();
		$("#acmiddleinspectiondate").val("");
		$("#acmiddleinspectiondate").attr("disabled","disabled");
	}else{
		$("#acmiddleinspectiondate").removeAttr("disabled");
		$("#middleInspectionSelectDate").show();
		$("#middleNaDiv").hide();
	}
}

function showHideFirstNaDiv(flag){
	if(flag){
		$("#firstInspectionSelectDate").hide();
		$("#firstNaDiv").show();
		$("#acfirstinspectiondate").val("");
		$("#acfirstinspectiondate").attr("disabled","disabled");
	}else{
		$("#acfirstinspectiondate").removeAttr("disabled");
		$("#firstInspectionSelectDate").show();
		$("#firstNaDiv").hide();
	}
}

function showHideGraphicsNaDiv(flag){
	if(flag){
		$("#graphicsReceiveDateDiv").hide();
		$("#graphicsNaReasonDiv").show();
		$("#acgraphicsreceivedate").val("");
		$("#acgraphicsreceivedate").attr("disabled","disabled");
	}else{
		$("#acgraphicsreceivedate").removeAttr("disabled");
		$("#graphicsReceiveDateDiv").show();
		$("#graphicsNaReasonDiv").hide();
	}
}



	
$('.editor').summernote({
	height: 120,
	minHeight: null,             // set minimum height of editor
	maxHeight: null,
	toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline', 'clear']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['height', ['height']]
	  ]
});
var acFirstInspectionNotesDisable = '<?php echo isset($fieldStateArr["acfirstinspectionnotes"])?$fieldStateArr["acfirstinspectionnotes"]:""?>';
var acMiddleInspectionNotesDisable = '<?php echo isset($fieldStateArr["acmiddleinspectionnotes"])?$fieldStateArr["acmiddleinspectionnotes"]:""?>';
if(acFirstInspectionNotesDisable != ""){
	$('#acfirstinspectionnotes').summernote(acFirstInspectionNotesDisable.slice(0, -1));
}
if(acMiddleInspectionNotesDisable != ""){
	$('#acmiddleinspectionnotes').summernote(acMiddleInspectionNotesDisable.slice(0, -1));
}
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
	bootbox.confirm("Are you sure you want to update the selected row(s)?", function(result) {
        if(result){
			if($("#poinchargeuser").val() != ""){
            	$("#poqccode").val($("#poinchargeuser option:selected").text());
			}
			if($("#qcuser").val() != ""){
            	$("#qccode").val($("#qcuser option:selected").text());
			}
            if($("#classcodeseq").val() != ""){
				$("#classcode").val($("#classcodeseq option:selected").text());
            }
			
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
	});
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
function handleIsCompletedCheckbox(){
	finalinspectiondate = $("#acfinalinspectiondate").val();
    if(finalinspectiondate != null && finalinspectiondate != ''){   
	   //$("#iscompleted").removeAttr("disabled");   
    }else{
       //$("#iscompleted").attr("disabled", 'disabled');   
       //$('#iscompleted').iCheck('uncheck');
	   //$("#iscompleted").removeAttr('checked');
	}
   	
}

</script>