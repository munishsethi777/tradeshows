<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Container Schedules</title>
    <?include "ScriptsInclude.php"?>
    <style type="text/css">
    	.itemDetailsModalDiv .lblDesc{
    		font-weight:500 !important;
    	}
    	.form-group{
    		margin-bottom:5px;
    	}
    	.lblTitle{
    		padding:2px 4px !important;
    		font-size:9pt;
    	}
    	
    	@media screen and (min-width: 992px) {
	        .modal-lg {
	          width: 1050px; /* New width for large modal */
	        }
	    }
    </style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
   <div id="wrapper">
   		<?php include("adminmenuInclude.php")?>
   		 <div id="page-wrapper" class="gray-bg">
	        <div class="row border-bottom">
	        	<div class="row">
		            <div class="col-lg-12">
		            	<div class="ibox">
		                    <div class="ibox-title">
		                    	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
									<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
										href="#"><i class="fa fa-bars"></i> </a>
										<h4 class="p-h-sm font-normal">Manage Container Schedules</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     		<div class="form-group row">
			                       		<label class="col-lg-1 col-form-label">Search</label>
			                        	<div class="col-lg-3">
			                            	<select id="fieldNameDD" name="fieldNameDD" class="form-control">
			                            		<option value=''>Select Field</option>
			                            		<option value="alpinenotificatinpickupdatetime">Alpine Notif. Pickup Date</option>
			                            		<option value="confirmeddeliverydatetime">Confirmed Delivery</option>
			                            		<option value="containerreceivedinomsdate">Container Received in OMS Date</option>
			                            		<option value="containerreceivedinwmsdate">Container Received in WMS Date</option>
			                            		<option value="etadatetime">ETA Date</option>
			                            		<option value="emptylfddate">Empty LFD</option>
			                            		<option value="emptyreturndate">Empty Return Date</option>
			                            		<option value="lfdpickupdate">LFD Pickup</option>
			                            		<option value="msrfcreateddate">MSRF Created</option>
			                            		<option value="scheduleddeliverydatetime">Scheduled Delivery</option>
			                            		<option value="samplesreceiveddate">Sample Received Date</option>
			                            		<option value="samplesreceivedinomsdate">Samples Received in OMS Date</option>
			                            		<option value="samplesreceivedinwmsdate">Samples Received In WMS Date</option>
			                            		<option value="terminalappointmentdatetime">Terminal Appointment</option>
			                            		</select>
			                            </div>
			                            <div class="col-lg-4">
				                            <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
											    <i class="fa fa-calendar"></i>&nbsp;
											    <span></span> <i class="fa fa-caret-down"></i>
											</div>
			                            </div>
			                            <div class="col-lg-2 pull-right">
			                            	<select id="emptyReturnStatusDD" name="emptyReturnStatusDD" class="form-control">
			                            		<option value="0">Not Returned</option>
			                            		<option value="1">Returned</option>
			                            	</select>
			                            </div>
			                        </div>
		                     	
		                     	<div id="containerScheduleGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="GET" action="Actions/ContainerScheduleAction.php">
     	<input type="hidden" id="call" name="call" value="export" />
     	<input type="hidden" id="queryString" name="queryString"/>
   </form>
   <form id="form2" name="form2" method="post" action="createContainerSchedule.php">
    	<input type="hidden" id="id" name="id"/>
   </form> 
	<div class="modal inmodal bs-example-modal-lg" id="containerDetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content animated fadeInRight">
          <div class="modal-body itemDetailsModalDiv mainDiv">
            <div class="ibox">
              <div class="ibox-content">
	             	<?php include 'progress.php';?>
		                <div class="row">
		                    <div class="col-sm-12">
		                    <h3>Container Details</h3>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Container#:</label>
		                           	<div class="col-sm-2"><label class="containerno lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Custom Brocker Ref#:</label>
		                           	<div class="col-sm-2"><label class="awureference lblDesc text-primary"></label></div>
		                           	<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Trucker:</label>
		                           	<div class="col-sm-2"><label class="truckername lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Freight Forwarder Ref#:</label>
		                           	<div class="col-sm-2"><label class="trans lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">ETA:</label>
		                           	<div class="col-sm-6"><label class="etadatetime lblDesc text-primary"></label></div>
		                        </div>
								<div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Terminal:</label>
		                           	<div class="col-sm-2"><label class="terminal lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Terminal Appt:</label>
		                           	<div class="col-sm-2"><label class="terminalappointmentdatetime lblDesc text-primary"></label></div>
		                           	<label class="col-sm-2 lblTitle bg-formLabelDarkSm">LFD Pickup:</label>
		                           	<div class="col-sm-2"><label class="lfdpickupdate lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Empty Schedule Pickup:</label>
		                           	<div class="col-sm-2"><label class="emptyscheduledpickupdate lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Empty LFD:</label>
		                           	<div class="col-sm-2"><label class="emptylfddate lblDesc text-primary"></label></div>
		                           	<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Custom Exam Terminal:</label>
		                           	<div class="col-sm-2"><label class="customexamterminal lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Custom Exam Status:</label>
		                           	<div class="col-sm-2"><label class="customexamstatus lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelDarkSm">Empty Return Date:</label>
		                           	<div class="col-sm-2"><label class="emptyreturndate lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                        	<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Requested Delivery Date:</label>
		                           	<div class="col-sm-10"><label class="requesteddeliverydatetime lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                        	<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Freight Forwarder:</label>
		                           	<div class="col-sm-10"><label class="freightforwarder lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                        	<label class="col-sm-2 lblTitle bg-formLabelDarkSm">ETA Notes:</label>
		                           	<div class="col-sm-10"><span class="etanotes lblDesc text-primary"></span></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                           	<label class="col-sm-2 lblTitle bg-formLabelDarkSm">Empty Return Notes:</label>
		                           	<div class="col-sm-10"><span class="emptynotes lblDesc text-primary"></span></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelMauveSm">Scheduled Delivery:</label>
		                           	<div class="col-sm-2"><label class="scheduleddeliverydatetime lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelMauveSm">Confirmed Delivery:</label>
		                           	<div class="col-sm-2"><label class="confirmeddeliverydatetime lblDesc text-primary"></label></div>
		                           	<label class="col-sm-2 lblTitle bg-formLabelMauveSm">Delivery Gate:</label>
		                           	<div class="col-sm-2"><label class="deliverygate lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelMauveSm">Warehouse:</label>
		                           	<div class="col-sm-2"><label class="warehouse lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelMauveSm">Hot Container:</label>
		                           	<div class="col-sm-2"><label class="ishotcontainer lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                        	<label class="col-sm-2 lblTitle bg-formLabelMauveSm">Alpine Notif Pickup Date:</label>
		                           	<div class="col-sm-6"><label class="alpinenotificatinpickupdatetime lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelMauveSm">Alpine Pickup Notes:</label>
		                           	<div class="col-sm-10"><span class="notificationnotes lblDesc text-primary"></span></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelBrownSm">Container Doc Path:</label>
		                           	<div class="col-sm-10"><label class="containerdocspath lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelBrownSm">Ids Complete:</label>
		                           	<div class="col-sm-4"><label class="isidscomplete lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelBrownSm">Samples:</label>
		                           	<div class="col-sm-4"><label class="issamplesreceived lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelBrownSm">MSRF Created:</label>
		                           	<div class="col-sm-4"><label class="msrfcreateddate lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelBrownSm">Received:</label>
		                           	<div class="col-sm-4"><label class="samplesreceiveddate lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-lg-4 col-lg-offset-1 bg-formLabelBrownSm text-center">CONTAINER</label>
		                            <label class="col-lg-4 col-lg-offset-2 bg-formLabelBrownSm text-center">SAMPLES</label>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelBrownSm">Received in OMS:</label>
		                           	<div class="col-sm-4"><label class="containerreceivedinomsdate lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelBrownSm">Received in OMS:</label>
		                           	<div class="col-sm-4"><label class="samplesreceivedinomsdate lblDesc text-primary"></label></div>
		                        </div>
		                        <div class="form-group row m-t-sm">
		                       		<label class="col-sm-2 lblTitle bg-formLabelBrownSm">Received in WMS:</label>
		                           	<div class="col-sm-4"><label class="containerreceivedinwmsdate lblDesc text-primary"></label></div>
		                            <label class="col-sm-2 lblTitle bg-formLabelBrownSm">Received in WMS:</label>
		                           	<div class="col-sm-4"><label class="samplesreceivedinwmsdate lblDesc text-primary"></label></div>
		                        </div>
		                    </div>
		                </div>
	                </div>
                </div>
           	</div>
            <div class="modal-footer">
              	<button type="button" onclick="previous()" id="prevBtn"  class="btn btn-white">Previous</button>
				<button type="button" onclick="next()" id="nextBtn" class="btn btn-white">Next</button>
				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
var hasNext = true;
var currentRowId =  0;
function previous(){
	currentRowId = currentRowId-1;
	if(ids[currentRowId] == undefined){
		currentRowId = 0;
		//return; 
	}
	prevSeq = ids[currentRowId];
	hasNext = true;
	showItemDetails(prevSeq,currentRowId);
}
function next(){
	if(hasNext){
    	currentRowId = currentRowId+1;
    	if(ids[currentRowId] == undefined){
    		hasNext = false; 
    		currentRowId = currentRowId-1;
    		return;
    	}
    	nextSeq = ids[currentRowId];
    	showItemDetails(nextSeq,currentRowId);
	}
}

function showItemDetails(seq,rowId){
	currentRowId = rowId;
	showHideProgress();
	$.getJSON("Actions/ContainerScheduleAction.php?call=getContainerScheduleDetails&seq="+seq, function(data){
		showHideProgress();
		var item = data.containerSchedule;
		$('#containerDetailModal').modal('show');
		$.each(item,function(key,val){
			if(key == "etanotes" || key == "emptynotes" || key == "notificationnotes"){
				$("."+key).html(val);
			}else{
				$("."+key).text(val);
			}
		});
	});
}

function initDateRanges(){//building date search module
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
var applyFilter = "";
$(document).ready(function(){
   	
   	initDateRanges();
   	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
    applyFilter = function () {
       var addedFilterFields = [];
       var existingFilter = $('#containerScheduleGrid').jqxGrid('getfilterinformation')
       var datafield = $("#fieldNameDD").val();
       $("#containerScheduleGrid").jqxGrid('clearfilters');
      //if(datafield != ''){
    	   //showFilterFieldColumn();
	 	   $("#containerScheduleGrid").jqxGrid('clear');
	 	   var filtertype = 'stringfilter';
	 	   var conditionDDVal = $("#conditionDD").val();
	 	   filtertype = 'datefilter';
	       var filterData = getFilterQueryData();
	       $.each(filterData, function( key, value ) {
	           var fieldName = key;
	           if(fieldName == ""){
		           return;
	           }
	           var filtergroup = new $.jqx.filter();	 
	           if(value != null && value != "" && value != "all"){
	        	   $.each(value, function( k, v ) {
	        		   var filter_or_operator = 0;
		               var filtervalue = v;
		               var filtercondition = 'less_than_or_equal';
		               if(k == "emptyreturndate"){
		            	   filtergroup = new $.jqx.filter();	 
		            	   filtertype = 'stringfilter';
			               if(v > 0){
			            	   filtercondition = 'not_null';   
			               }else{
			            	   filtercondition = 'null';   
			               }
			           }else{
		               		if(k == "from"){
		            	   		var filtercondition = 'greater_than_or_equal';    
		               		}
		               }
		               var filter = filtergroup.createfilter(filtertype, filtervalue, filtercondition);
		               filtergroup.addfilter(filter_or_operator, filter);
		               
		               $("#containerScheduleGrid").jqxGrid('addfilter', fieldName, filtergroup);
		               // add the filters.
		           });
	        	  
	           }
	       });
	        // apply the filters.
	       $("#containerScheduleGrid").jqxGrid('applyfilters');
      // }
    }
    loadGrid();
    // applies the filter.
    $("#fieldNameDD").change(function () {
		var datafield = $("#fieldNameDD").val();
    	//if(datafield.substr(0,2) == "sc" || datafield.substr(0,2) == "ap"){
        	//$(".taskCompleted").show();
    	//}else{
    		//$(".taskCompleted").hide();
    	//}
 	   	applyFilter()
    });
    $("#emptyReturnStatusDD").change(function () {
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
		
		//$('#containerScheduleGrid').jqxGrid('showcolumn', datafield);
		var textData = new Array();
		var cols = $("#containerScheduleGrid").jqxGrid("columns");
		for (var i = 0; i < cols.records.length; i++) {
		    textData[i] = cols.records[i].text;
		}
		
		
		var conditionDD = $("#emptyReturnStatusDD").val();
		var fromDate = new Date();
		var toDate = new Date();
		
		var fromDateStr = dateToStr(fromDate);
		var toDateStr = dateToStr(toDate);

		//new code of daterange picker
		var drp = $('#daterange').data('daterangepicker');
		fromDateStr = drp.startDate.format('MM-DD-YYYY');
		fromDateStr += " 00:00:00";
		toDateStr = drp.endDate.format('MM-DD-YYYY');
		toDateStr += " 23:59:00";
		
		
		var data = {from:fromDateStr,to:toDateStr}
		var dataArr = {};
		dataArr[datafield] = data;
		dataArr['emptyreturndate'] = {emptyreturndate:conditionDD};
		return dataArr
	}
function showFilterFieldColumn(){
	var cols = $("#containerScheduleGrid").jqxGrid("columns");
	for (var i = 0; i < cols.records.length; i++) {
		if(cols.records[i].datafield.substr(0,2) == "sc" 
				|| cols.records[i].datafield.substr(0,2) == "ac"
					|| cols.records[i].datafield.substr(0,2) == "ap"){
	    //if(cols.records[i].hidden == true){
	    	$('#containerScheduleGrid').jqxGrid('hidecolumn', cols.records[i].datafield);
	    }
	}
	var datafield = $("#fieldNameDD").val()
	$('#containerScheduleGrid').jqxGrid('showcolumn',datafield);

}
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
function showCustomerDetails(seq,rowId){
	currentRowId = rowId;
	showHideProgress();
	$.getJSON("Actions/CustomerAction.php?call=getCustomerDetails&seq="+seq, function(data){
		showHideProgress();
		var item = data.customer;
		var buyer = data.buyers
		$('#customerDetailsModal').modal('show');
		$.each(item,function(key,val){
			$("."+key).text(val);
		});
	});
}
function editButtonClick(seq){
	$("#id").val(seq);                        
	$("#form2").submit(); 
}
isSelectAll = false;
var ids = [];
function loadGrid(){
	var defaultFilter = function(){
        var jqxFilter = new $.jqx.filter();
        var filter = jqxFilter.createfilter('stringfilter', '1', 'null');
        jqxFilter.addfilter(0, filter);
        return jqxFilter;
    }();
 function actions(row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#containerScheduleGrid').jqxGrid('getrowdata', row);
		ids[row] = data["seq"];
        var html = "<div style='text-align: center; margin-top:6px;'>";
        return [html,data];
	}
	var showitemdetail = function(row,columnfield, value, defaulthtml, columnproperties){
		arr = actions(row,columnfield,value,defaulthtml,columnproperties);
		html = arr[0];
		data = arr[1];
		html +="<a title='View Detail' href='javascript:showItemDetails("+ data['seq'] + "," + row +")' >"+data['container']+"</a>";
		html += "</div>";
		return html;
	}
	var editdetail = function(row, columnfield, value, defaulthtml, columnproperties){
		arr = actions(row,columnfield,value,defaulthtml,columnproperties);
		html = arr[0];
		data = arr[1];
		html +="&ensp;<a href='javascript:editButtonClick("+ data['seq'] + ")' ><i class='fa fa-edit' style='font-size:18px' title='Edit Container Schedule'></i></a>";
		html += "</div>";
		return html;
	}
	var columns = [
	  { text: 'Actions', datafield: 'Actions', cellsrenderer:editdetail,width:'5%',filterable: false},
	  { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'terminalappointmentdatetime', datafield: 'terminalappointmentdatetime' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy'},
      { text: 'lfdpickupdate', datafield: 'lfdpickupdate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy'},
      { text: 'emptylfddate', datafield: 'emptylfddate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy' } ,
      { text: 'emptyreturndate', datafield: 'emptyreturndate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy',filtertype: 'input',filter: defaultFilter } ,

      { text: 'samplesreceivedinomsdate', datafield: 'samplesreceivedinomsdate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy' } ,
      { text: 'containerreceivedinomsdate', datafield: 'containerreceivedinomsdate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy' } ,	
      { text: 'msrfcreateddate', datafield: 'msrfcreateddate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy' } ,	
      { text: 'samplesreceiveddate', datafield: 'samplesreceiveddate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy' } ,	
      { text: 'containerreceivedinwmsdate', datafield: 'containerreceivedinwmsdate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy' } ,	
      { text: 'samplesreceivedinwmsdate', datafield: 'samplesreceivedinwmsdate' , hidden:true,filtertype: 'date',cellsformat: 'M-dd-yyyy' } ,	

      { text: 'Container', datafield: 'container',width:"10%",cellsrenderer:showitemdetail},
      { text: 'AWU Ref', datafield: 'awureference', width:"10%"},
      { text: 'Trucker', datafield: 'truckername', width:"5%"},
      { text: 'Trans', datafield: 'trans', width:"7%"},
      { text: 'Warehouse', datafield: 'warehouse',hidden:true,width:"8%"},
	  { text: 'Hot', datafield: 'ishotcontainer',columntype:"checkbox",width: "4%"},
	  { text: 'ETA', datafield: 'etadatetime',width:"14%",cellsformat: 'M-dd-yyyy hh:mm tt'},
      { text: 'Terminal', datafield: 'terminal',hidden:true,width:"15%"},
      { text: 'Requested dlvry', datafield: 'requesteddeliverydatetime' ,filtertype: 'date',cellsformat: 'MM-dd-yyyy',width:"12%" },
      { text: 'Scheduled dlvry', datafield: 'scheduleddeliverydatetime' ,filtertype: 'date',cellsformat: 'MM-dd-yyyy',width:"12%" },
      { text: 'Confirmed dlvry', datafield: 'confirmeddeliverydatetime' , filtertype: 'date',cellsformat: 'MM-dd-yyyy',width:"12%" } ,	
      { text: 'Notification pickup', datafield: 'alpinenotificatinpickupdatetime' , filtertype: 'date',cellsformat: 'MM-dd-yyyy',width:"13%" },
	  {text: 'Modified On', datafield: 'lastmodifiedon',filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',hidden:false,width:"13%"},

	]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                    { name: 'awureference', type: 'string' }, 
                    { name: 'truckername', type: 'string' }, 
                    { name: 'trans', type: 'string' },
                    { name: 'warehouse', type: 'string' },
                    { name: 'etadatetime', type: 'date' } ,
                    { name: 'terminalappointmentdatetime', type: 'date' } ,
                    { name: 'lfdpickupdate', type: 'date' } ,
                    { name: 'scheduleddeliverydatetime', type: 'date' } ,
                    { name: 'emptylfddate', type: 'date' },
                    { name: 'emptyreturndate', type: 'date' },
                    { name: 'confirmeddeliverydatetime', type: 'date' },
                    { name: 'requesteddeliverydatetime', type: 'date' },
                    { name: 'alpinenotificatinpickupdatetime', type: 'date' },
                    { name: 'samplesreceivedinomsdate', type: 'date' },
                    { name: 'containerreceivedinomsdate', type: 'date' },
                    { name: 'msrfcreateddate', type: 'date' },
                    { name: 'samplesreceiveddate', type: 'date' },
                    { name: 'containerreceivedinwmsdate', type: 'date' },
                    { name: 'samplesreceivedinwmsdate', type: 'date' },
                    { name: 'container', type: 'string' },
                    { name: 'terminal', type: 'fullname' },
					{ name: 'lastmodifiedon', type: 'date' },
					{ name: 'ishotcontainer', type: 'bool'}, 
                    ],                          
        url: 'Actions/ContainerScheduleAction.php?call=getAllContainerSchedules',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#containerScheduleGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#containerScheduleGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#containerScheduleGrid").jqxGrid(
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
		ready: function () {
			//applyFilter();
	    },
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div title='Add' alt='Add' style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var editButton = $("<div title='Edit' alt='Edit' style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var importButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div title='Reload' alt='Reload' style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var downloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
            var deleteButton = $("<div title='Delete' alt='Delete' style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            
            container.append(addButton);
            container.append(editButton);
            //container.append(importButton);
            container.append(exportButton);
            container.append(reloadButton);
            //container.append(downloadButton);
            container.append(deleteButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
           	editButton.jqxButton({  width: 65, height: 18 });
           // importButton.jqxButton({  width: 65, height: 18 });
            exportButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            //downloadButton.jqxButton({  width: 140, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            addButton.click(function (event) {
                location.href = ("createContainerSchedule.php");
            });
            editButton.click(function (event){
            	var selectedrowindex = $("#containerScheduleGrid").jqxGrid('selectedrowindexes');
                var value = -1;
                indexes = selectedrowindex.filter(function(item) { 
                    return item !== value
                })
                if(indexes.length != 1){
                    bootbox.alert("Please Select single row for edit.", function() {});
                    return;    
                }
                var row = $('#containerScheduleGrid').jqxGrid('getrowdata', indexes);
                editButtonClick(row.seq);  
            });
            deleteButton.click(function (event) {
                gridId = "containerScheduleGrid";
                deleteUrl = "Actions/ContainerScheduleAction.php?call=deleteContainerSchedule";
                deleteGraphicLog(gridId,deleteUrl);
            });
            importButton.click(function (event) {
                location.href = ("adminImportGraphicLogs.php");
            });
            exportButton.click(function (event) {
         	   filterQstr = getFilterString("containerScheduleGrid");
         	   exportItemsConfirm(filterQstr);
            });
            reloadButton.click(function (event) {
            	$("#containerScheduleGrid").jqxGrid("clearfilters");
            	$('#fieldNameDD').prop('selectedIndex',0);
            	initDateRanges();
               // $("#containerScheduleGrid").jqxGrid({ source: dataAdapter });
            });
            $("#containerScheduleGrid").bind('rowselect', function (event) {
                var selectedRowIndex = event.args.rowindex;
                 var pageSize = event.args.owner.rows.records.length - 1;                       
                if($.isArray(selectedRowIndex)){           
                    if(isSelectAll){
                        isSelectAll = false;    
                    } else{
                        isSelectAll = true;
                    }                                                                     
                    $('#containerScheduleGrid').jqxGrid('clearselection');
                    if(isSelectAll){
                        for (i = 0; i <= pageSize; i++) {
                            var index = $('#containerScheduleGrid').jqxGrid('getrowboundindex', i);
                            $('#containerScheduleGrid').jqxGrid('selectrow', index);
                        }    
                    }
                }                        
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
function deleteGraphicLog(gridId,deleteURL){
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

}
</script>
