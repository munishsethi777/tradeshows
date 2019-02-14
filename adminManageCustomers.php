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
    <title>Admin | Manage Customers</title>
    <?include "ScriptsInclude.php"?>
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
										<h4 class="p-h-sm font-normal">Manage Customers</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     	<div id="customerGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="post" action="Actions/CustomerAction.php">
     	<input type="hidden" id="call" name="call" value="export" />
   </form> 
</body>
<script type="text/javascript">
$(document).ready(function(){
	//$.get("Actions/TaskCategoryAction.php?call=getAllTaskCategories", function(data){
    	loadGrid()
	//});
});

function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
function loadGrid(){
	var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Customer ID', datafield: 'customerid',width:"10%"},
      { text: 'Name', datafield: 'customername', width:"25%"},
      { text: 'Phone', datafield: 'phone',width:"15%"},
      { text: 'Email', datafield: 'email',width:"30%"},
      { text: 'State', datafield: 'state',width:'17%'}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'createdon',
        sortdirection: 'asc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                     { name: 'customerid', type: 'string' }, 
                    { name: 'customername', type: 'string' }, 
                    { name: 'phone', type: 'string' },
                    { name: 'email', type: 'string' } ,
                    { name: 'state', type: 'string' } 
                    ],                          
        url: 'Actions/CustomerAction.php?call=getAllCustomers',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#customerGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#customerGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#customerGrid").jqxGrid(
    {
    	width: '100%',
		height: '75%',
		source: dataAdapter,
		filterable: true,
		sortable: true,
		autoshowfiltericon: true,
		columns: columns,
		pageable: true,
		altrows: true,
		enabletooltips: true,
		columnsresize: true,
		columnsreorder: true,
		selectionmode: 'checkbox',
		showstatusbar: true,
		virtualmode: true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var templateButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-download'><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
            
            container.append(addButton);
            container.append(exportButton);
            container.append(reloadButton);
            container.append(templateButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
            exportButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            templateButton.jqxButton({  width: 150, height: 18 });
            // create new row.
            addButton.click(function (event) {
                location.href = ("adminImportCustomers.php");
            });
            exportButton.click(function (event) {
        	   exportCustomersConfirm();
           });
            templateButton.click(function (event) {
                location.href = ("files/customers_template.xlsx");
            });
             $("#customerGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#customerGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#customerGrid').jqxGrid('getrowboundindex', i);
                             $('#customerGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#customerGrid").jqxGrid({ source: dataAdapter });
            });
        }
    });
}
function exportCustomersConfirm(){
	bootbox.confirm({
	    message: "Do you want to export customers?",
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
		    	exportCustomers(); 
		    }
	    }
	});
}
function exportCustomers(){
	$("#form1").submit();
}
</script>
