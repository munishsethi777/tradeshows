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
    <title>Admin | Manage Graphic Logs</title>
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
										<h4 class="p-h-sm font-normal">Manage Graphic Logs</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     		<div class="form-group row">
			                       		<label class="col-lg-1 col-form-label">Search</label>
			                        	<div class="col-lg-3">
			                            	<select id="fieldNameDD" name="fieldNameDD" class="form-control">
			                            		<option value=''>Select Field</option>
			                            		<option value="approxgraphicschinasentdate">Approx Graphics China Sent Date</option>
			                            		<option value="graphicartiststartdate">Artist Start Date</option>
			                            		<option value="graphiccompletiondate">Artist Completion Date</option>
			                            		<option value="chinaofficeentrydate">China Entry Date</option>
			                            		<option value="estimatedshipdate">Estimated Ship Date</option>
			                            		<option value="estimatedgraphicsdate">Estimated Graphics Date</option>
			                            		<option value="finalgraphicsduedate">Final Graphics Due Date</option>
			                            		<option value="confirmedposhipdate">PO Ship Date</option>
			                            		<option value="usaofficeentrydate">US Entry Date</option>
			                            	</select>
			                            </div>
			                            <div class="col-lg-4">
				                            <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
											    <i class="fa fa-calendar"></i>&nbsp;
											    <span></span> <i class="fa fa-caret-down"></i>
											</div>
			                            </div>
			                        </div>
		                     	
		                     	<div id="graphiclogGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="GET" action="Actions/GraphicLogAction.php">
     	<input type="hidden" id="call" name="call" value="export" />
     	<input type="hidden" id="queryString" name="queryString"/>
   </form>
   <form id="form2" name="form2" method="post" action="adminCreateGraphicLog.php" target='_blank'>
    	<input type="hidden" id="id" name="id"/>
   </form> 

</body>
<script type="text/javascript">
function showItemDetails(seq){
	$.getJSON("Actions/ItemAction.php?call=getItemDetails&seq="+seq, function(data){
		item = data.item;
		$('#itemDetailsModal').modal('show');
		$.each(item,function(key,val){
			$(".item"+key).text(val);
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
$(document).ready(function(){
   	loadGrid();
   	initDateRanges();
   	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
    var applyFilter = function () {
       var addedFilterFields = [];
       var existingFilter = $('#graphiclogGrid').jqxGrid('getfilterinformation')
       var datafield = $("#fieldNameDD").val();
       $("#graphiclogGrid").jqxGrid('clearfilters');
       if(datafield != ''){
    	   //showFilterFieldColumn();
	 	   $("#graphiclogGrid").jqxGrid('clear');
	 	   var filtertype = 'stringfilter';
	 	   var conditionDDVal = $("#conditionDD").val();
	 	   filtertype = 'datefilter';
	       var filterData = getFilterQueryData();
	       $.each(filterData, function( key, value ) {
	           var fieldName = key;
	           var filtergroup = new $.jqx.filter();	 
	           if(value != null && value != "" && value != "all"){
	        	   $.each(value, function( k, v ) {
	        		   var filter_or_operator = 0;
		               var filtervalue = v;
		               var filtercondition = 'less_than_or_equal';
		               if(k == "isCompleted"){
		            	   filtergroup = new $.jqx.filter();	 
		            	   filtertype = 'stringfilter';
			               if(v > 0){
			            	   filtercondition = 'not_null';   
			               }else{
			            	   filtercondition = 'null';   
			               }
			               fieldName = fieldName.substring(2);
			               fieldName = "ac" + fieldName;	 		
		               }else{
		               		if(k == "from"){
		            	   		var filtercondition = 'greater_than_or_equal';    
		               		}
		               }
		               var filter = filtergroup.createfilter(filtertype, filtervalue, filtercondition);
		               filtergroup.addfilter(filter_or_operator, filter);
		               
		               $("#graphiclogGrid").jqxGrid('addfilter', fieldName, filtergroup);
		               // add the filters.
		           });
	        	  
	           }
	       });
	        // apply the filters.
	       $("#graphiclogGrid").jqxGrid('applyfilters');
       }
    }
    
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
    $("#conditionDD").change(function () {
 	   applyFilter()
    });
   
    $("#valueDD").change(function () {
 	   applyFilter()
    });
    //$("#isCompleted").change(function () {
 	  // applyFilter()
   // });
    $('.i-checks').on('ifChanged', function(event){
    	 applyFilter()
    });
    $('#daterange').on('apply.daterangepicker', function(ev, picker){
    	applyFilter();
    });
 });

	function getFilterQueryData(){
		var datafield = $("#fieldNameDD").val()
		
		//$('#graphiclogGrid').jqxGrid('showcolumn', datafield);
		var textData = new Array();
		var cols = $("#graphiclogGrid").jqxGrid("columns");
		for (var i = 0; i < cols.records.length; i++) {
		    textData[i] = cols.records[i].text;
		}
		
		
		var conditionDD = $("#conditionDD").val();
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
		

		
		var data = {from:fromDateStr,to:toDateStr}
		isScheduleFeild = datafield.startsWith("sc")
		if(isScheduleFeild){
			 data = {from:fromDateStr,to:toDateStr,isCompleted:isCompleted}
		}
		var dataArr = {};
		dataArr[datafield] = data;
		return dataArr
	}
function showFilterFieldColumn(){
	var cols = $("#graphiclogGrid").jqxGrid("columns");
	for (var i = 0; i < cols.records.length; i++) {
		if(cols.records[i].datafield.substr(0,2) == "sc" 
				|| cols.records[i].datafield.substr(0,2) == "ac"
					|| cols.records[i].datafield.substr(0,2) == "ap"){
	    //if(cols.records[i].hidden == true){
	    	$('#graphiclogGrid').jqxGrid('hidecolumn', cols.records[i].datafield);
	    }
	}
	var datafield = $("#fieldNameDD").val()
	$('#graphiclogGrid').jqxGrid('showcolumn',datafield);

}
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
isSelectAll = false;

function AddStatusDefaultFilter(){
    var filtergroup = new $.jqx.filter();
    var filter_or_operator = 1;
    
    var filterNullShow = filtergroup.createfilter('stringfilter', '', 'NULL');
    filtergroup.addfilter(filter_or_operator, filterNullShow);

    var filterHideSentToPrint = filtergroup.createfilter('stringfilter', 'Sent to Print', 'not_equal');
    filtergroup.addfilter(filter_or_operator, filterHideSentToPrint);

    $("#graphiclogGrid").jqxGrid('addfilter', 'graphicstatus', filtergroup);
    $("#graphiclogGrid").jqxGrid('applyfilters');
};
function editButtonClick(seq){
	$("#id").val(seq);                        
	$("#form2").submit(); 
}
function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#graphiclogGrid').jqxGrid('getrowdata', row);
		var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            	html +="<a href='javascript:editButtonClick("+ data['seq'] + ")' ><i class='fa fa-edit' title='Edit Graphic Log'></i></a>";
            html += "</div>";
        return html;
    }
	var statusTypes = ["","Sent to Print","No Update Needed","Not Started","Missing Info from China","In Progress","Buyer's Reviewing","Robby Reviewing","Manager Reviewing","Pending Customer Approval",
	"Pending Attorney Approval","Preparing for Print"];
	var columns = [
		{ text: 'Actions', datafield: 'Actions', cellsrenderer:actions,width:'5%',filterable: false},
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'US Entry', datafield: 'usaofficeentrydate', filtertype: 'date', width:"10%",cellsformat: 'M-dd-yyyy'},
      { text: 'Est Ship', datafield: 'estimatedshipdate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy'},
      { text: 'Est Graphic Due', datafield: 'estimatedgraphicsdate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:false},
      { text: 'chinaofficeentrydate', datafield: 'chinaofficeentrydate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'finalgraphicsduedate', datafield: 'finalgraphicsduedate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'confirmedposhipdate', datafield: 'confirmedposhipdate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'graphicartiststartdate', datafield: 'graphicartiststartdate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'graphiccompletiondate', datafield: 'graphiccompletiondate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'approxgraphicschinasentdate', datafield: 'approxgraphicschinasentdate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'draftdate', datafield: 'draftdate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'managerreviewreturndate', datafield: 'managerreviewreturndate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'buyerreviewreturndate', datafield: 'buyerreviewreturndate', filtertype: 'date',width:"10%",cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'Status', datafield: 'graphicstatus', width:"10%",hidden:false, filtertype: 'checkedlist',filteritems: statusTypes},
      { text: 'Class', datafield: 'classcode', width:"5%",filtercondition: 'STARTS_WITH'},
      { text: 'PO', datafield: 'po',width:"7%",filtercondition: 'STARTS_WITH'},
      { text: 'SKU', datafield: 'sku',width:"13%",filtercondition: 'STARTS_WITH'},
      { text: 'Customer', datafield: 'customername',width:"8%"},
      { text: 'Created By', datafield: 'fullname',width:"10%"},
      { text: 'Modified On', datafield: 'lastmodifiedon',filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',width:"14%"}
	]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                    { name: 'usaofficeentrydate', type: 'date' }, 
                    { name: 'estimatedshipdate', type: 'date' }, 
                    { name: 'estimatedgraphicsdate', type: 'date' },
                    { name: 'chinaofficeentrydate', type: 'date' },
                    { name: 'finalgraphicsduedate', type: 'date' },
                    { name: 'confirmedposhipdate', type: 'date' },
                    { name: 'graphicartiststartdate', type: 'date' },
                    { name: 'graphiccompletiondate', type: 'date' },
                    { name: 'approxgraphicschinasentdate', type: 'date' },
                    { name: 'draftdate', type: 'date' },
                    { name: 'managerreviewreturndate', type: 'date' },
                    { name: 'buyerreviewreturndate', type: 'date' },
                    { name: 'classcode', type: 'string' },
                    { name: 'po', type: 'string' },
                    { name: 'sku', type: 'string' } ,
                    { name: 'customername', type: 'string' },
                    { name: 'fullname', type: 'fullname' },
                    { name: 'graphicstatus', type: 'string' },  
                    { name: 'lastmodifiedon', type: 'date' } 
                    ],                          
        url: 'Actions/GraphicLogAction.php?call=getAllGraphicLogs',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#graphiclogGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#graphiclogGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#graphiclogGrid").jqxGrid(
    {
    	width: '100%',
		height: '600',
		source: dataAdapter,
		filterable: true,
		sortable: true,
		showfilterrow: true,
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
   		ready: function () {
   	        AddStatusDefaultFilter();
   	    },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div title='Add' alt='Add' style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            //var editButton = $("<div title='Edit' alt='Edit' style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var importButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div title='Reload' alt='Reload' style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            //var downloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
            var deleteButton = $("<div title='Delete' alt='Delete' style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            
            container.append(addButton);
            //container.append(editButton);
            container.append(importButton);
            container.append(exportButton);
            container.append(reloadButton);
            //container.append(downloadButton);
            container.append(deleteButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
           	//editButton.jqxButton({  width: 65, height: 18 });
            importButton.jqxButton({  width: 65, height: 18 });
            exportButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            //downloadButton.jqxButton({  width: 140, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            addButton.click(function (event) {
                location.href = ("adminCreateGraphicLog.php");
            });
            // editButton.click(function (event){
            // 	var selectedrowindex = $("#graphiclogGrid").jqxGrid('selectedrowindexes');
			// 	var value = -1;
			// 	indexes = selectedrowindex.filter(function(item) { 
			// 		return item !== value
			// 	})
			// 	if(indexes.length != 1){
			// 		bootbox.alert("Please Select single row for edit.", function() {});
			// 		return;    
			// 	}
			// 	var row = $('#graphiclogGrid').jqxGrid('getrowdata', indexes);
			// 	editButtonClick(row.seq);
            // });
            deleteButton.click(function (event) {
                gridId = "graphiclogGrid";
                deleteUrl = "Actions/GraphicLogAction.php?call=deleteGraphicLog";
                deleteGraphicLog(gridId,deleteUrl);
            });
            importButton.click(function (event) {
                location.href = ("adminImportGraphicLogs.php");
            });
            exportButton.click(function (event) {
         	   filterQstr = getFilterString("graphiclogGrid");
         	   exportItemsConfirm(filterQstr);
            });
            reloadButton.click(function (event) {
            	$("#graphiclogGrid").jqxGrid("clearfilters");
            	$('#fieldNameDD').prop('selectedIndex',0);
            	initDateRanges();
            	//$("#graphiclogGrid").jqxGrid({ source: dataAdapter });
            });
            $("#graphiclogGrid").bind('rowselect', function (event) {
                var selectedRowIndex = event.args.rowindex;
                 var pageSize = event.args.owner.rows.records.length - 1;                       
                if($.isArray(selectedRowIndex)){           
                    if(isSelectAll){
                        isSelectAll = false;    
                    } else{
                        isSelectAll = true;
                    }                                                                     
                    $('#graphiclogGrid').jqxGrid('clearselection');
                    if(isSelectAll){
                        for (i = 0; i <= pageSize; i++) {
                            var index = $('#graphiclogGrid').jqxGrid('getrowboundindex', i);
                            $('#graphiclogGrid').jqxGrid('selectrow', index);
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
