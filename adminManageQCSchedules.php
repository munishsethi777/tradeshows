<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/PermissionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/QcscheduleApproval.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QcscheduleApprovalMgr.php");
$sessionUtil = SessionUtil::getInstance();
$isSessionAdmin = $sessionUtil->isSessionAdmin();
$permissionUtil = PermissionUtil::getInstance();
$hasQcPlannerButtonPermission = $permissionUtil->hasQCPlannerButtonPermission() || $isSessionAdmin;
$hasWeeklyReportButtonPermission = $permissionUtil->hasWeeklyMailButtonPermission() || $isSessionAdmin;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage QC Schedules</title>
    <?include "ScriptsInclude.php"?>
    <style type="text/css">
    	.itemDetailsModalDiv .lblDesc{
    		font-weight:500 !important;
    	}
    	.form-group{
    		margin-bottom:5px;
    	}
    </style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
   <div id="wrapper">
   		<?php
   		include("adminmenuInclude.php");?>
   		 <div id="page-wrapper" class="gray-bg">
	        <div class="row border-bottom">
	        	<div class="row">
		            <div class="col-lg-12">
		            	<div class="ibox">
		                    <div class="ibox-title">
		                    	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
									<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
										href="#"><i class="fa fa-bars"></i> </a>
										<h4 class="p-h-sm font-normal">Manage QC Schedules</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     		<div class="form-group row">
			                       		<div class="col-lg-3">
			                            	<select id="fieldNameDD" name="fieldNameDD" class="form-control">
			                            		<option value=''>Select Field</option>
			                            		<option value="shipdate">Ship Date</option>
			                            		<optgroup label="Schedule Dates">
				                            		<option value="scproductionstartdate">Scheduled Production Start</option>
				                            		<option value="scgraphicsreceivedate">Scheduled Graphics Receive</option>
				                            		<option value="scfirstinspectiondate">Scheduled First Inspection</option>
				                            		<option value="scmiddleinspectiondate">Scheduled Middle Inspection</option>
				                            		<option value="scfinalinspectiondate">Scheduled Final Inspection</option>
				                            		<option value="screadydate">Scheduled Ready</option>
			                            		</optgroup>
			                            		<optgroup label="Appointment Dates">
				                            		<option value="approductionstartdate">Appointment Production Start</option>
				                            		<option value="apgraphicsreceivedate">Appointment Graphics Receive</option>
				                            		<option value="apfirstinspectiondate">Appointment First Inspection</option>
				                            		<option value="apmiddleinspectiondate">Appointment Middle Inspection</option>
				                            		<option value="apfinalinspectiondate">Appointment Final Inspection</option>
				                            		<option value="apreadydate">Appointment Ready</option>
			                            		</optgroup>
			                            		<optgroup label="Actual Dates">
				                            		<option value="acproductionstartdate">Actual Production Start</option>
				                            		<option value="acgraphicsreceivedate">Actual Graphics Receive</option>
				                            		<option value="acfirstinspectiondate">Actual First Inspection</option>
				                            		<option value="acmiddleinspectiondate">Actual Middle Inspection</option>
				                            		<option value="acfinalinspectiondate">Actual Final Inspection</option>
				                            		<option value="acreadydate">Actual Ready</option>
			                            		</optgroup>
			                            	</select>
			                            </div>
			                            <div class="col-lg-4">
				                            <div id="daterange" style="display:none;background: #fff; cursor: pointer; padding: 5px 5px; border: 1px solid #ccc; width: 100%">
											    <i class="fa fa-calendar"></i>&nbsp;
											    <span></span> <i class="fa fa-caret-down"></i>
											</div>
			                            </div>
			                            <div class="col-lg-2 pull-right">
			                            	<select id="iscompletedDD" name="iscompletedDD" class="form-control">
			                            		<option value="all">All</option>
			                            		<option value="1">Completed</option>
			                            		<option value="0">Incompleted</option>
			                            	</select>
			                            </div>
			                            <div class="col-lg-2" style="display:none">
			                            	<select id="approvalstatus" name="approvalstatus" class="form-control">
			                            		<option value="all">All</option>
			                            		<option value="approved">Approved</option>
			                            		<option value="pending">Pending</option>
			                            		<option value="open">Open</option>
			                            	</select>
			                            </div>
			                        </div>
		                     	
		                     	<div id="qcscheduleGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="GET" action="Actions/QCScheduleAction.php">
     	<input type="hidden" id="call" name="call" value="export" />
     	<input type="hidden" id="queryString" name="queryString"/>
   </form>
   <form id="form2" name="form2" method="post" action="adminCreateQCSchedule.php">
    	<input type="hidden" id="id" name="id"/>
    	<input type="hidden" id="itemnumbers" name="itemnumbers"/>
    	<input type="hidden" id="seqs" name="seqs"/>
   </form> 
   <form id="form3" name="form3" method="post" action="Actions/QCScheduleAction.php">
    	<input type="hidden" id="call" name="call" value="exportPlanner" />
    	<input type="hidden" id="isCompleted" name="isCompleted" value="1" />
   </form> 
    
	<div class="modal inmodal bs-example-modal-lg" id="updateQCScheduleApprovalModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content animated fadeInRight">
    	  <div class="modal-header">
          	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Approve/Reject QC Schedule</h4>
          </div>		
          <div class="modal-body updateQCScheduleApprovalModalDiv mainDiv">
            <div class="ibox">
             <div class="ibox-content">
             	 <form id="updateQCScheduleApprovalForm" method="post" action="Actions/QcscheduleApprovalAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="updateApprovalStatus"/>
                     	<input type="hidden" id ="approvalSeq" name="approvalSeq"/>
                     	<div class="form-group row">
                             <label class="col-lg-2 col-form-label bg-formLabel">QC:</label> 
                             <label class="col-lg-4 col-form-label" id="modalQcLabel"></label>
                           
                              <label class="col-lg-2 col-form-label bg-formLabel">Code:</label>
                              <label class="col-lg-4 col-form-label" id="modalCodeLabel"></label>                           
                        </div>
                        <div class="form-group row">                              
                              <label class="col-lg-2 col-form-label bg-formLabel">PO </label> 
                              <label class="col-lg-4 col-form-label" id="modalPoLabel"></label>                          
                              
                              <label class="col-lg-2 col-form-label bg-formLabel">ITEM NO </label> 
                              <label class="col-lg-4 col-form-label" id="modalItemnumberLabel"></label>                            
                        </div> 
                     	 <div class="form-group row">
                       		<label class="col-lg-2 col-form-label bg-formLabel">Status</label>
                        	<div class="col-lg-6">
                            	<select id="approvalStatusDD" name="approvalStatusDD" class="form-control">
                            		<option id="pending">Pending</option>	
                            		<option id="approved">Approved</option>	
                            		<option id="rejected">Rejected</option>	
                            	</select>	
                            </div>
                           </div>
                            <div class="form-group row">
	                            <label class="col-lg-2 col-form-label bg-formLabel">Comments</label>
	                        	<div class="col-lg-10">
	                            	<textarea class="form-control" name="comments" id="comment" ></textarea>
	                            </div>
                        </div>
                       		 <div class="modal-footer">
                                     <button class="btn btn-primary" data-style="expand-right" id="updateApprovalStatusBtn" type="button">
                                        <span class="ladda-label">Submit</span>
                                    </button>
                                     <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                             </div>
                 </form>
             </div>
           </div>
         </div>
        </div>
     </div>
</body>
<script type="text/javascript">
function initDateRanges(){
	    var start = moment().subtract(29, 'days');
	    var end = moment();
	    function cb(start, end) {
	        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	    }
	    $('#daterange').daterangepicker({
	        startDate: start,
	        endDate: end,
	        alwaysShowCalendars: true,
	        ranges: {
	           'Today': [moment(), moment()],
	           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	           'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
	           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	           'Next 7 Days': [moment(),moment().add(6, 'days')],
	           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	           'Next 30 Days': [moment(),moment().add(29, 'days')],
	           'This Month': [moment().startOf('month'), moment().endOf('month')],
	           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	           'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
	        }
	    }, cb);

	    cb(start, end);
}
$(document).ready(function(){
	function updateApprovalStatus(){
		if($("#updateQCScheduleApprovalForm")[0].checkValidity()) {
			showHideProgress()
			$('#updateQCScheduleApprovalForm').ajaxSubmit(function( data ){
			   showHideProgress();
			   var flag = showResponseToastr(data,"updateQCScheduleApprovalModal","updateQCScheduleApprovalForm","ibox");
			   if(flag){
				   $('#itemDetailsModal').modal('hide');
				   window.setTimeout(function(){window.location.href = "adminManageQCSchedules.php"},100);
			   }
		    })	
		}else{
			 $("#createQCScheduleForm")[0].reportValidity();
		}
	}
	$("#updateApprovalStatusBtn").click(function(e){
		updateApprovalStatus()
	});
	loadGrid();
	initDateRanges();
   	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
    var applyFilter = function () {
       var addedFilterFields = [];
       var existingFilter = $('#qcscheduleGrid').jqxGrid('getfilterinformation')
       var datafield = $("#fieldNameDD").val();
       $("#qcscheduleGrid").jqxGrid('clearfilters');
       //if(datafield != ''){
    	   showFilterFieldColumn();
	 	   $("#qcscheduleGrid").jqxGrid('clear');
	 	   var filtertype = 'stringfilter';
	 	   var conditionDDVal = $("#conditionDD").val();
	 	   filtertype = 'datefilter';
	       var filterData = getFilterQueryData();
	       var isCompleted = 0;
	       $.each(filterData, function( key, value ) {
	           var fieldName = key;
	           var filtergroup = new $.jqx.filter();	 
	           if(value != null && value != "" && value != "all"){
	        	   $.each(value, function( k, v ) {
	        		   var filter_or_operator = 0;
		               var filtervalue = v;
		               var filtercondition = 'less_than_or_equal';
		               if(k == "completedStatus"){
			               if(value.completedStatus == "all"){
				               return;
			               }
		            	   filtergroup = new $.jqx.filter();	 
		            	   filtertype = 'stringfilter';
			               filtercondition = 'EQUAL';
			               filter_or_operator = 0;
			               fieldName = "iscompleted";
		               }else if(k == "from"){
		            	   	var filtercondition = 'greater_than_or_equal';    
		               }else if(k == "naReason"){
		            	    filtergroup = new $.jqx.filter();	 
		            	    filtertype = 'stringfilter';
		            	    fieldName = v;
		            	   	if(isCompleted > 0){
				            	filtercondition = 'not_null';
				             }else{
				                filtercondition = 'null';   
				            }
		            	   	filter_or_operator = 1;
		               }
		               var filter = filtergroup.createfilter(filtertype, filtervalue, filtercondition);
		               filtergroup.addfilter(filter_or_operator, filter);
		               
		               $("#qcscheduleGrid").jqxGrid('addfilter', fieldName, filtergroup);
		               // add the filters.
		           });
	        	  
	           }
	       });
	        // apply the filters.
	       $("#qcscheduleGrid").jqxGrid('applyfilters');
       //}
       //$("#approvalStatusDD").chosen({rtl: true}); 
    }
    
    // applies the filter.
    $("#fieldNameDD").change(function () {
		var datafield = $("#fieldNameDD").val();
		if(datafield == ""){
			$("#daterange").hide();
		}else{
			$("#daterange").show();
		}
		$('#isCompleted').removeAttr('checked');
    	$('#isCompleted').iCheck('uncheck')
    	if(datafield.substr(0,2) == "sc" || datafield.substr(0,2) == "ap"){
    		$(".taskCompleted").show();
    	}else{
    		//$(".taskCompleted").hide();
    		$(".taskCompleted").show();
    	}
 	   	applyFilter()
    });
    $("#conditionDD").change(function () {
 	   applyFilter()
    });
    $("#iscompletedDD").change(function () {
  	   applyFilter()
     });
    $("#valueDD").change(function () {
 	   applyFilter()
    });
    $("#isCompleted").change(function () {
 	   applyFilter()
    });
    $('.i-checks').on('ifChanged', function(event){
    	 applyFilter()
    });
    $('#daterange').on('apply.daterangepicker', function(ev, picker){
    	applyFilter();
    });
 });
	function getFilterQueryData(){
		var datafield = $("#fieldNameDD").val()
		
		//$('#qcscheduleGrid').jqxGrid('showcolumn', datafield);
		var textData = new Array();
		var cols = $("#qcscheduleGrid").jqxGrid("columns");
		for (var i = 0; i < cols.records.length; i++) {
		    textData[i] = cols.records[i].text;
		}
		
		
		var conditionDD = $("#conditionDD").val();
		var completedDD = $("#iscompletedDD").val();
		var dayValue = $("#valueDD").val();
		var isCompletedCheck =$("input[type='checkbox'][name='isCompleted']:checked").val()
		var isCompleted = 0;
		if(isCompletedCheck == "on"){
			isCompleted = 1
		}
		var fromDate = new Date();
		var toDate = new Date();
		if(conditionDD == "past"){
			fromDate = subtractDays(fromDate, dayValue);
		}else{
			toDate = addDays(toDate, dayValue);
		}
		var fromDateStr = dateToStr(fromDate);
		var toDateStr = dateToStr(toDate);

		//new code of daterange picker
		var drp = $('#daterange').data('daterangepicker');
		fromDateStr = drp.startDate.format('MM-DD-YYYY');
		toDateStr = drp.endDate.format('MM-DD-YYYY');

		var data = {from:fromDateStr,to:toDateStr};
		isScheduleFeild = datafield.startsWith("sc")
		isAPFeild = datafield.startsWith("ap")
		var dataArr = {};
		if(isScheduleFeild || isAPFeild){
			 var naReason = "";
			 if(datafield.indexOf("middle") != -1){	 
				 naReason = "apmiddleinspectiondatenareason";	 
			 }else if(datafield.indexOf("first") != -1){
				 naReason = "apfirstinspectiondatenareason";		 
			 }
			 data = {from:fromDateStr,to:toDateStr,completedStatus:completedDD}
			 //data = {from:fromDateStr,to:toDateStr,isCompleted:isCompleted,completedStatus:completedDD}
			 if(naReason != ""){
			 	//data = {from:fromDateStr,to:toDateStr,isCompleted:isCompleted,naReason:naReason,completedStatus:completedDD}
			 	data = {from:fromDateStr,to:toDateStr,naReason:naReason,completedStatus:completedDD}
			 }
		}
		if(completedDD != "all"){
			dataArr['completedStatus'] = {completedStatus:completedDD};
		}
		dataArr[datafield] = data;
		return dataArr
	}
function showFilterFieldColumn(){
	var cols = $("#qcscheduleGrid").jqxGrid("columns");
	for (var i = 0; i < cols.records.length; i++) {
		if(cols.records[i].datafield.substr(0,2) == "sc" 
				|| cols.records[i].datafield.substr(0,2) == "ac"
					|| cols.records[i].datafield.substr(0,2) == "ap"){
	    //if(cols.records[i].hidden == true){
	    	$('#qcscheduleGrid').jqxGrid('hidecolumn', cols.records[i].datafield);
	    }
	}
	var datafield = $("#fieldNameDD").val()
	$('#qcscheduleGrid').jqxGrid('showcolumn',datafield);

}
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
function showApprovalModel(approvalSeq,isDisabled,responsecomment,responsetype,qc,code,po,itemno){
	$('#comment').val(responsecomment);
	$('#approvalStatusDD').val(responsetype);
    $("#modalQcLabel").text(qc);
    $("#modalCodeLabel").text(code);
    $("#modalPoLabel").text(po);
    $("#modalItemnumberLabel").text(itemno);
	$("#approvalSeq").val(approvalSeq);
	$("#updateQCScheduleApprovalModal").modal('show');
	if(isDisabled == 1){	
    	$('#comment').attr("disabled",true);
    	$('#approvalStatusDD').attr("disabled",true);
    	$('#updateApprovalStatusBtn').attr("disabled",true);	
	}	
}
function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#qcscheduleGrid').jqxGrid('getrowdata', row);
        var responseType = data["responsetype"];
        var responseComments = data["responsecomments"];
        var qc = data["qccode"];
        var code = data["classcode"];
        var po = data["po"];
        var itemno = data["itemnumbers"];
        if(responseComments == null){
        	responseComments = "";
        }
        var isSV = data["isSv"];
        var html = "<div style='text-align: center; margin-top:1px;font-size:12px'>"
            	if(isSV && responseType != null){
            		html +="<a title='"+responseComments+"' href='javascript:showApprovalModel("+ data['qcapprovalseq'] + ",0, \"" +responseComments+ "\" , \"" +responseType+ "\" , \"" +qc+ "\"  , \"" +code+ "\"  , \"" +po+ "\"  , \"" +itemno+ "\" )'>"+responseType+"</a>";
            	}else{
                	if(responseType != null){
                		html +="<a title='"+responseComments+"' href='javascript:showApprovalModel("+ data['qcapprovalseq'] + ",1, \"" +responseComments+ "\" , \"" +responseType+ "\" , \"" +qc+ "\"  , \"" +code+ "\"  , \"" +po+ "\"  , \"" +itemno+ "\" )'>"+responseType+"</a>";                	}
            	}
            html += "</div>";
        return html;
    }
	var renderCompletedColumn = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#qcscheduleGrid').jqxGrid('getrowdata', row);
        var isCompleted = data["iscompleted"];
        if(isCompleted){
        	return '<div title="Completed" alt="Completed" style="text-align:left;color:#19aa8d;padding-bottom: 2px; margin-right: 2px; margin-left: 4px; margin-top: 7px;"><i style="font-size:16px" class="fa fa-thumbs-o-up"></i></div>';
        }else{
        	return '<div title="Incompleted" alt="Incompleted" style="text-align:left;color:grey;padding-bottom: 2px; margin-right: 2px; margin-left: 4px; margin-top: 7px;"><i style="font-size:16px" class="fa fa-thumbs-o-up"></i></div>';
        }	
        
    }
	var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: '<i style="font-size:16px" class="fa fa-thumbs-o-up"></i>', datafield: 'iscompleted', width:"3%", cellsrenderer:renderCompletedColumn},
      { text: 'QC.', datafield: 'qccode', width:"10%"},
      { text: 'Code', datafield: 'classcode',width:"10%"},
      { text: 'PO', datafield: 'po',width:"12%"},
      { text: 'Item No.', datafield: 'itemnumbers',width:"12%"},
      { text: 'PO Type', datafield: 'potype',width:"12%"},
      { text: 'Ship Date', datafield: 'shipdate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%"},
      { text: 'Sc Prod Str', datafield: 'scproductionstartdate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Sc Grph Rcv', datafield: 'scgraphicsreceivedate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Sc Frst Insp', datafield: 'scfirstinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Sc Midl Insp', datafield: 'scmiddleinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Sc Finl Insp', datafield: 'scfinalinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Sc Rdy', datafield: 'screadydate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Prod Str', datafield: 'approductionstartdate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Grph Rcv', datafield: 'apgraphicsreceivedate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Frst Insp', datafield: 'apfirstinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Midl Insp', datafield: 'apmiddleinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Finl Insp', datafield: 'apfinalinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Finl Insp', datafield: 'apmiddleinspectiondatenareason',filtertype: 'string',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Finl Insp', datafield: 'apfirstinspectiondatenareason',filtertype: 'string',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Apt Rdy', datafield: 'apreadydate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Ac Prod Satrt', datafield: 'acproductionstartdate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Ac Grph Recvd', datafield: 'acgraphicsreceivedate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Ac Frst Insp', datafield: 'acfirstinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Ac Midl Insp', datafield: 'acmiddleinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Ac Finl Insp', datafield: 'acfinalinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'isSv', datafield: 'isSv',width:"12%",hidden:true},
      { text: 'responsecomments', datafield: 'responsecomments',width:"12%",hidden:true},
      { text: 'qcapprovalseq', datafield: 'qcapprovalseq',width:"12%",hidden:true},
      { text: 'Ac Ready', datafield: 'acreadydate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"12%",hidden:true},
      { text: 'Modified On', datafield: 'lastmodifiedon',filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',width:"18%"},
      { text: 'Approval', datafield: 'responsetype',width:"7%",cellsrenderer:actions}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'seq',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [{name: 'seq', type: 'integer' },
                    { name: 'iscompleted', type: 'boolean' }, 
                    { name: 'qccode', type: 'string' }, 
                    { name: 'classcode', type: 'string' },
                    { name: 'po', type: 'string' },
                    { name: 'potype', type: 'string' } ,
                    { name: 'shipdate', type: 'date' },
                    { name: 'createdon', type: 'date' }, 
                    { name: 'isSv', type: 'bool' } ,
                    { name: 'responsetype', type: 'string' } ,
                    { name: 'qcapprovalseq', type: 'integer' } ,
                    { name: 'scproductionstartdate', type: 'date' } ,
                    { name: 'scgraphicsreceivedate', type: 'date' } ,
                    { name: 'scfirstinspectiondate', type: 'date' } ,
                    { name: 'scmiddleinspectiondate', type: 'date' } ,
                    { name: 'scfinalinspectiondate', type: 'date' } ,
                    { name: 'screadydate', type: 'date' } ,
                    { name: 'approductionstartdate', type: 'date' } ,
                    { name: 'apgraphicsreceivedate', type: 'date' } ,
                    { name: 'apfirstinspectiondate', type: 'date' } ,
                    { name: 'apmiddleinspectiondate', type: 'date' } ,
                    { name: 'apfinalinspectiondate', type: 'date' } ,
                    { name: 'apmiddleinspectiondatenareason', type: 'string' } ,
                    { name: 'apfirstinspectiondatenareason', type: 'string' } ,
                    { name: 'apreadydate', type: 'date' } ,
                    { name: 'acproductionstartdate', type: 'date' } ,
                    { name: 'acgraphicsreceivedate', type: 'date' } ,
                    { name: 'acfirstinspectiondate', type: 'date' } ,
                    { name: 'acmiddleinspectiondate', type: 'date' } ,
                    { name: 'acfinalinspectiondate', type: 'date' } ,
                    { name: 'itemnumbers', type: 'string' } ,
                    { name: 'responsecomments', type: 'string' } ,
                    { name: 'acreadydate', type: 'date' } ,
                    { name: 'lastmodifiedon', type: 'date' } 
                    ],                          
        url: 'Actions/QCScheduleAction.php?call=getAllQCSchedules',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#qcscheduleGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#qcscheduleGrid").jqxGrid('updatebounddata', 'sort');
        },
        addrow: function (rowid, rowdata, position, commit) {
            commit(true);
        },
        deleterow: function (rowid, commit) {
            commit(true);
        },
        updaterow: function (rowid, newdata, commit) {
            commit(true);
        }
    };
    
    var dataAdapter = new $.jqx.dataAdapter(source);
    // initialize jqxGrid
    $("#qcscheduleGrid").jqxGrid(
    {
    	width: '100%',
		height: '600',
		source: dataAdapter,
		filterable: true,
		sortable: true,
		showfilterrow: false,
		autoshowfiltericon: true,
		columns: columns,
		pageable: true,
		altrows: true,
		enabletooltips: true,
		columnsresize: true,
		columnsreorder: true,
		showstatusbar: true,
		virtualmode: true,
		selectionmode: 'checkbox',
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div title='Add' alt='Add' style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var editButton = $("<div title='Edit' alt='Download Template' style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var importButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            var importCompletedButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'>Import Completed</span></div>");
            var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div title='Reload Data' alt='Reload Data' style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var downloadButton = $("<div title='Download Template' alt='Download Template' style='float: left; margin-left: 5px;'><i class='fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
          // var deleteButton = $("<div title='Delete' alt='Delete'  style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            var weeklyReportButton = $("<div title='Mail Weekly Report' alt='Mail Weekly Report' style='float: left; margin-left: 5px;'><i class='fa fa-send'></i><span style='margin-left: 4px; position: relative;'>Mail Weekly Report</span></div>");
            var exportPlannerButton = $("<div title='Mail Weekly Report' alt='Mail Weekly Report' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export Planner</span></div>");
            
            container.append(addButton);
            container.append(editButton);
           // container.append(deleteButton);
            container.append(exportButton);
            container.append(reloadButton);
            container.append(downloadButton);
            <?php if($sessionUtil->isSessionAdmin()){?>
	            container.append(importButton);
	            container.append(importCompletedButton);
            <?php }?>
            <?php if($hasWeeklyReportButtonPermission){?>
            	container.append(weeklyReportButton);
            <?php }?>
            <?php if($hasQcPlannerButtonPermission){?>
	            container.append(exportPlannerButton);
            <?php }?>
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
           	editButton.jqxButton({  width: 65, height: 18 });
           	<?php if($sessionUtil->isSessionAdmin()){?>
	            importButton.jqxButton({  width: 65, height: 18 });
	            importCompletedButton.jqxButton({  width: 130, height: 18 });
			<?php }?>
            exportButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            downloadButton.jqxButton({  width: 140, height: 18 });
          	//deleteButton.jqxButton({  width: 65, height: 18 });
             <?php if($hasWeeklyReportButtonPermission){?>
	            weeklyReportButton.jqxButton({  width: 150, height: 18 });
	          <?php }?>
	          <?php if($hasQcPlannerButtonPermission){?> 
	            exportPlannerButton.jqxButton({  width: 120, height: 18 });
	          <?php }?>
            // create new row.
            addButton.click(function (event) {
                location.href = ("adminCreateQCSchedule.php");
            });
            weeklyReportButton.click(function (event) {
            	window.open('http://alpinebi.com/Crons/PendingQCScheduleCron.php');
            });
            editButton.click(function (event){
            	var selectedrowindex = $("#qcscheduleGrid").jqxGrid('selectedrowindexes');
                var value = -1;
                indexes = selectedrowindex.filter(function(item) { 
                    return item !== value
                })
                var lastPo = 0;
                var isValid = true;
                var itemIds = [];
                var seqs = [];
                $.each(indexes, function(index , value){
                	 var row = $('#qcscheduleGrid').jqxGrid('getrowdata', value);
                	 var po = row.po;
                	 if(lastPo != 0){
                    	 if(po != lastPo){
                    		 bootbox.alert("Please Select single row for edit.", function() {});
                    		 isValid = false;
                             return;  
                    	 }
                	 }
                	 seqs.push(row.seq);
                	 lastPo = po
                	 itemIds.push(row.itemnumbers);
                	     
                });
                if(!isValid){
                    return;
                }
//                 if(indexes.length != 1){
//                     bootbox.alert("Please Select single row for edit.", function() {});
//                     return;    
//                 }
                var row = $('#qcscheduleGrid').jqxGrid('getrowdata', indexes);
                $("#id").val(seqs[0]);  
                $("#seqs").val(seqs);   
                $("#itemnumbers").val(itemIds);                        
                $("#form2").submit();    
            });
            // delete row.
          /*  deleteButton.click(function (event) {
                gridId = "qcscheduleGrid";
                deleteUrl = "Actions/QCScheduleAction.php?call=deleteQCSchedule";
                deleteQCSchedule(gridId,deleteUrl);
            }); */
            importButton.click(function (event) {
                location.href = ("adminImportQCSchedules.php");
            });
            importCompletedButton.click(function (event) {
            	importCompeleted();
            });
             exportButton.click(function (event) {
         	   filterQstr = getFilterString("qcscheduleGrid");
         	   exportItemsConfirm(filterQstr);
             });
             exportPlannerButton.click(function (event) {
            	 exportPlanner();
             });
//              $("#qcscheduleGrid").bind('rowselect', function (event) {
//                  var selectedRowIndex = event.args.rowindex;
//                   var pageSize = event.args.owner.rows.records.length - 1;                       
//                  if($.isArray(selectedRowIndex)){           
//                      if(isSelectAll){
//                          isSelectAll = false;    
//                      } else{
//                          isSelectAll = true;
//                      }                                                                     
//                      $('#qcscheduleGrid').jqxGrid('clearselection');
//                      if(isSelectAll){
//                          for (i = 0; i <= pageSize; i++) {
//                              var index = $('#qcscheduleGrid').jqxGrid('getrowboundindex', i);
//                              $('#qcscheduleGrid').jqxGrid('selectrow', index);
//                          }    
//                      }
//                  }                        
//             });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#qcscheduleGrid").jqxGrid("clearfilters");
            	$('#fieldNameDD').prop('selectedIndex',0);
            	initDateRanges();
            	$('#isCompleted').removeAttr('checked');
            	$(".taskCompleted").hide()
            });
            downloadButton.click(function (event) {
            	location.href = ("files/QCSchedules_template.xlsx");
            });
        }
    });
}
function exportItemsConfirm(filterString){
	bootbox.confirm({
	    message: "Do you want to export items?",
	    buttons: {
	        confirm: {
	            label: 'Yes',
	            className: 'btn-success'
	        },
	        cancel: {
	            label: 'No',
	            className: 'btn-danger'
	        }
	    },
	    callback: function (result) {
		    if(result){
				exportItems(filterString); 
		    }
	    }
	});
}

function exportItems(filterString){
	$("#queryString").val(filterString);
	$("#form1").submit();
}
function exportPlanner(){
	$("#form3").attr("action", "Actions/QCScheduleAction.php");
	$("#form3 #call").val("exportPlanner");
	$("#form3").submit();
}
function importCompeleted(){
	$("#form3").attr("action", "adminImportQCSchedules.php");
	$("#form3 #call").val("");
	$("#form3").submit();	
}

function dateToStr(date){
	var dd = date.getDate();
	var mm = date.getMonth() + 1;
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
function addDays(date, days){
   days = parseInt(days);
   date.setDate(date.getDate() + days);
   return date;
}
function subtractDays(date, days) {
	var sDate = date;
	sDate.setDate(sDate.getDate() - days);
	return sDate;
}
/*function deleteQCSchedule(gridId,deleteURL){
    var selectedRowIndexes = $("#" + gridId).jqxGrid('selectedrowindexes');
    if(selectedRowIndexes.length > 0){
        bootbox.confirm("Are you sure you want to delete selected row(s)?", function(result) {
            if(result){
                var ids = [];
                var po = [];
                $.each(selectedRowIndexes, function(index , value){
                    if(value != -1){
                        var dataRow = $("#" + gridId).jqxGrid('getrowdata', value);
                        if(dataRow != undefined){
                            if(dataRow.id != undefined){
                            	ids.push(dataRow.id);
                             }else{
                            	ids.push(dataRow.seq); 
                            }
                            po.push(dataRow.po);
                        }
                    }

                });
                $.get( deleteURL + "&ids=" + ids + "&po=" + po,function( data ){
                    if(data != ""){
                        var obj = $.parseJSON(data);
                        var message = obj.message;
                        if(obj.success == 1){

                            toastr.success(message,'Success');
                           //$.each(selectedRowIndexes, function(index , value){
                              //  var id = $("#"  + gridId).jqxGrid('getrowid', value);
                                var commit = $("#"  + gridId).jqxGrid('deleterow', ids);
                                //$("#"+gridId).jqxGrid('clearselection');
                                $("#"+gridId).jqxGrid('updatebounddata');
                                $("#"+gridId).jqxGrid('clearselection');
                            //});
                        }else{
                            toastr.error(message,'Failed');
                        }
                    }

                });

            }
        });
    }else{
         bootbox.alert("No row selected.Please select row to delete!", function() {});
    }

    

}*/

</script>
