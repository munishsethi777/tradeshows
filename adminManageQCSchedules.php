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
										<h4 class="p-h-sm font-normal">Manage QC Schedules</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     		<div class="form-group row">
			                       		<label class="col-lg-1 col-form-label">Search</label>
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
			                            		<optgroup label="Actual Dates">
				                            		<option value="acproductionstartdate">Actual Production Start</option>
				                            		<option value="acgraphicsreceivedate">Actual Graphics Receive</option>
				                            		<option value="acfirstinspectiondate">Actual First Inspection</option>
				                            		<option value="acmiddleinspectiondate">Actual Middle Inspection</option>
				                            		<option value="acfinalinspectiondate">Actual Final Inspection</option>
				                            		<option value="acreadydate">Ready</option>
			                            		</optgroup>
			                            	</select>
			                            </div>
			                            <div class="col-lg-2">
			                            	<select id="conditionDD" name="conditionDD" class="form-control">
			                            		<option value="past">In Past</option>
			                            		<option value="coming">For Coming</option>
			                            	</select>
			                            </div>
			                            <div class="col-lg-2">
			                            	<select id="valueDD" name="valueDD" class="form-control">
			                            		<option value="1">1 day</option>
			                            		<option value="3">3 days</option>
			                            		<option value="5">5 days</option>
			                            		<option value="10">10 days</option>
			                            		<option value="15">15 days</option>
			                            		<option value="30">30 days</option>
			                            		<option value="45">45 days</option>
			                            		<option value="60">60 days</option>
			                            		<option value="90">90 days</option>
			                            	</select>
			                            </div>
			                            <div class="col-lg-2">
			                            	<input class="i-checks" id="isCompleted" name="isCompleted" type="checkbox"> Task Completed
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
   <form id="form1" name="form1" method="GET" action="Actions/ItemSpecificationAction.php">
     	<input type="hidden" id="call" name="call" value="export" />
     	<input type="hidden" id="queryString" name="queryString"/>
   </form>
   <form id="form2" name="form2" method="post" action="adminCreateQCSchedule.php">
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
$(document).ready(function(){
   	loadGrid()
   	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
    var applyFilter = function () {
       var addedFilterFields = [];
       var existingFilter = $('#qcscheduleGrid').jqxGrid('getfilterinformation')
       var datafield = $("#fieldNameDD").val();
       $("#qcscheduleGrid").jqxGrid('clearfilters');
       if(datafield != ''){
	 	   $("#qcscheduleGrid").jqxGrid('clear');
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
		               
		               $("#qcscheduleGrid").jqxGrid('addfilter', fieldName, filtergroup);
		               // add the filters.
		           });
	        	  
	           }
	       });
	        // apply the filters.
	       $("#qcscheduleGrid").jqxGrid('applyfilters');
       }
    }
    
    // applies the filter.
    $("#fieldNameDD").change(function () {
 	   applyFilter()
    });
    $("#conditionDD").change(function () {
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
 });
 
	function getFilterQueryData(){
		var datafield = $("#fieldNameDD").val()
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
		var data = {from:fromDateStr,to:toDateStr}
		isScheduleFeild = datafield.startsWith("sc")
		if(isScheduleFeild){
			 data = {from:fromDateStr,to:toDateStr,isCompleted:isCompleted}
		}
		var dataArr = {};
		dataArr[datafield] = data;
		return dataArr
	}
	
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}

function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#qcscheduleGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            	html +="<a href='javascript:showItemDetails("+ data['seq'] + ")' ><i class='fa fa-search' title='ViewDetails'></i></a>";
            html += "</div>";
        return html;
    }
	var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'QC.', datafield: 'qc', width:"15%"},
      { text: 'Code', datafield: 'classcode',width:"8%"},
      { text: 'PO', datafield: 'po',width:"10%"},
      { text: 'PO Type', datafield: 'potype',width:"14%"},
      { text: 'Ship Date', datafield: 'shipdate',filtertype: 'date',cellsformat: 'M-dd-yyyy',width:"15%"},
      { text: 'scproductionstartdate', datafield: 'scproductionstartdate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'scgraphicsreceivedate', datafield: 'scgraphicsreceivedate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'scfirstinspectiondate', datafield: 'scfirstinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'scmiddleinspectiondate', datafield: 'scmiddleinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'scfinalinspectiondate', datafield: 'scfinalinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'screadydate', datafield: 'screadydate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'acproductionstartdate', datafield: 'acproductionstartdate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'acgraphicsreceivedate', datafield: 'acgraphicsreceivedate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'acfirstinspectiondate', datafield: 'acfirstinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'acmiddleinspectiondate', datafield: 'acmiddleinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'acfinalinspectiondate', datafield: 'acfinalinspectiondate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'acreadydate', datafield: 'acreadydate',filtertype: 'date',cellsformat: 'M-dd-yyyy',hidden:true},
      { text: 'Created On', datafield: 'createdon',filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',width:"15%"},
      { text: 'Modified On', datafield: 'lastmodifiedon',filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',width:"15%"}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                    { name: 'qc', type: 'string' }, 
                    { name: 'classcode', type: 'string' },
                    { name: 'po', type: 'string' },
                    { name: 'potype', type: 'string' } ,
                    { name: 'shipdate', type: 'date' },
                    { name: 'createdon', type: 'date' }, 
                    { name: 'scproductionstartdate', type: 'date' } ,
                    { name: 'scgraphicsreceivedate', type: 'date' } ,
                    { name: 'scfirstinspectiondate', type: 'date' } ,
                    { name: 'scmiddleinspectiondate', type: 'date' } ,
                    { name: 'scfinalinspectiondate', type: 'date' } ,
                    { name: 'screadydate', type: 'date' } ,
                    { name: 'acproductionstartdate', type: 'date' } ,
                    { name: 'acgraphicsreceivedate', type: 'date' } ,
                    { name: 'acfirstinspectiondate', type: 'date' } ,
                    { name: 'acmiddleinspectiondate', type: 'date' } ,
                    { name: 'acfinalinspectiondate', type: 'date' } ,
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
		height: '90%',
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
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var importButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
           // var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var downloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
            var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            
            container.append(addButton);
            container.append(editButton);
            container.append(importButton);
            //container.append(exportButton);
            container.append(reloadButton);
           // container.append(downloadButton);
            container.append(deleteButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
           	editButton.jqxButton({  width: 65, height: 18 });
            importButton.jqxButton({  width: 65, height: 18 });
            //exportButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            downloadButton.jqxButton({  width: 140, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            // create new row.
            addButton.click(function (event) {
                location.href = ("adminCreateQCSchedule.php");
            });
            editButton.click(function (event){
            	var selectedrowindex = $("#qcscheduleGrid").jqxGrid('selectedrowindexes');
                var value = -1;
                indexes = selectedrowindex.filter(function(item) { 
                    return item !== value
                })
                if(indexes.length != 1){
                    bootbox.alert("Please Select single row for edit.", function() {});
                    return;    
                }
                var row = $('#qcscheduleGrid').jqxGrid('getrowdata', indexes);
                $("#id").val(row.seq);                        
                $("#form2").submit();    
            });
            // delete row.
            deleteButton.click(function (event) {
                gridId = "qcscheduleGrid";
                deleteUrl = "Actions/QCScheduleAction.php?call=deleteQCSchedule";
                deleteRows(gridId,deleteUrl);
            });
            importButton.click(function (event) {
                location.href = ("adminImportQCSchedules.php");
            });
//             exportButton.click(function (event) {
//         	   filterQstr = getFilterString("qcscheduleGrid");
//         	   exportItemsConfirm(filterQstr);
//             });
             $("#qcscheduleGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#qcscheduleGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#qcscheduleGrid').jqxGrid('getrowboundindex', i);
                             $('#qcscheduleGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#qcscheduleGrid").jqxGrid({ source: dataAdapter });
            });
            downloadButton.click(function (event) {
            	location.href = ("files/itemSpecifications_template.xlsx");
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
</script>
