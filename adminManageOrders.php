<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");
$showMgr = ShowMgr::getInstance();
$shows = $showMgr->getAllShowsWithOrder();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage TradeShow Orders</title>
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
										<h4 class="p-h-sm font-normal">Manage TradeShow Orders</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     	<div class="form-group row">
		                       		<label class="col-lg-2 col-form-label">Select Tradeshow</label>
		                        	<div class="col-lg-4">
		                            	<select name="tradeshowseq" id="showSeq" onchange='loadGrid(this.value)' class="showSelect form-control">
		                                    	<?php 
		                                    		foreach($shows as $show){
		                                    			$html = "<option value='". $show->getSeq()  ."'>".$show->getTitle()."</option>";
		                                    			echo($html);
		                                    		}
		                                    	?>
		                                </select>
		                            </div>
		                        </div>
		                     	<div id="orderGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="post" action="Actions/TradeShowOrderAction.php">
     	<input type="hidden" id="call" name="call" value="export" />
   </form> 
</body>
<script type="text/javascript">
$(document).ready(function(){
	//$.get("Actions/TaskCategoryAction.php?call=getAllTaskCategories", function(data){
		var tradeShowSeq = $("#showSeq").val();
    	loadGrid(tradeShowSeq);
	//});
});

function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
function loadGrid(showSeq){
	var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Order Id', datafield: 'salesordernumber',width:"11%"},
      { text: 'Customer Name', datafield: 'customername', width:"30%"},
      { text: 'Sale Rep', datafield: 'salerep',width:"12%"},
      { text: 'So Type', datafield: 'sotype',width:"12%"},
      { text: 'Cust PO', datafield: 'custpo',width:"15%"},
      { text: 'Order Date', datafield: 'orderdate',width:"10%",cellsformat: 'MM-dd-yyyy'},
      { text: 'Ship Date', datafield: 'shipdt',width:"10%",cellsformat: 'MM-dd-yyyy'}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'orderdate',
        sortdirection: 'asc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                    { name: 'salesordernumber', type: 'string' }, 
                    { name: 'customername', type: 'string' }, 
                    { name: 'salerep', type: 'string' },
                    { name: 'sotype', type: 'string' },
                    { name: 'custpo', type: 'string' },
                    { name: 'orderdate', type: 'date' },
                    { name: 'shipdt', type: 'date' }
                    ],                          
        url: 'Actions/TradeShowOrderAction.php?call=getAllTradeShowOrders&showSeq='+showSeq,
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#orderGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#orderGrid").jqxGrid('updatebounddata', 'sort');
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
	var parentHolder = {};
	var initrowdetails = function (index, parentElement, gridElement, record) {
        var id = record.uid.toString();
        if (!parentElement) {
            parentElement = parentHolder[index];
        }
        else {
            parentHolder[index] = parentElement;
        }
        var grid = $($(parentElement).children()[0]);
        var orderSeq =  record.seq;
        var detailSource =
        {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            sortcolumn: 'orderdate',
            sortdirection: 'asc',
            datafields: [{ name: 'seq', type: 'integer' }, 
                        { name: 'warehouse', type: 'string' }, 
                        { name: 'itemno', type: 'string' }, 
                        { name: 'quantity', type: 'integer' }, 
                        { name: 'price', type: 'string' },
                        { name: 'soamount', type: 'string' },
                        { name: 'itemnote', type: 'string' }
                       ],                          
            url: 'Actions/TradeShowOrderDetailAction.php?call=getDetailByOrderSeq&orderseq='+orderSeq,
            root: 'Rows',
            cache: false,
            beforeprocessing: function(detailData)
            {        
            	detailSource.totalrecords = detailData.TotalRows;
            },
            filter: function()
            {
                // update the grid and send a request to the server.
                grid.jqxGrid('updatebounddata', 'filter');
            },
            sort: function()
            {
                // update the grid and send a request to the server.
                grid.jqxGrid('updatebounddata', 'sort');
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
        var nestedGridAdapter = new $.jqx.dataAdapter(detailSource);
        if (grid != null) {
            grid.jqxGrid({
                source: nestedGridAdapter, width: '95%', height: 200,pageable: true,virtualmode: true,
                columns: [
                  { text: 'id', datafield: 'seq' , hidden:true},
                  { text: 'Item Id', datafield: 'itemno', width: 150 },
                  { text: 'Qty', datafield: 'quantity', width: 100 },
                  { text: 'Warehouse', datafield: 'warehouse', width: 200 },
                  { text: 'Price', datafield: 'price', width: 150 },
                  { text: 'So Amount', datafield: 'soamount', width: 100 },
                  { text: 'Item Note', datafield: 'itemnote', width: 265 },
               ],
               rendergridrows: function (toolbar) {
                   return nestedGridAdapter.records;     
            		 },
            });
        }
    }
    var dataAdapter = new $.jqx.dataAdapter(source);
    // initialize jqxGrid
    $("#orderGrid").jqxGrid(
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
		showstatusbar: true,
		virtualmode: true,
		rowdetails: true,
		initrowdetails: initrowdetails,
        rowdetailstemplate: { rowdetails: "<div id='grid' style='margin: 10px;'></div>", rowdetailsheight: 220, rowdetailshidden: true },
        
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            container.append(addButton);
            container.append(exportButton);
            container.append(reloadButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
            exportButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            // create new row.
            addButton.click(function (event) {
                location.href = ("adminImportOrders.php");
            });
            exportButton.click(function (event) {
        	  	exportCustomersConfirm();
          	});
             $("#orderGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#orderGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#orderGrid').jqxGrid('getrowboundindex', i);
                             $('#orderGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            $('#orderGrid').on('rowexpand', function (event) {
            	 var index = $('#orderGrid').jqxGrid('getrowboundindex', event.args.rowindex);
            	 var rowdata = $('#orderGrid').jqxGrid('getrowdata', index);
            	 var parentElement = parentHolder[index];
            	 if(parentElement != undefined){
            	 	initrowdetails(index, false, $('#orderGrid'), rowdata);
            	 }
             });
            reloadButton.click(function (event) {
                $("#orderGrid").jqxGrid({ source: dataAdapter });
            });
        }
    });
}
function exportCustomersConfirm(){
	bootbox.confirm({
	    message: "Do you want to export Orders?",
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
		    	exportOrders(); 
		    }
	    }
	});
}
function exportOrders(){
	$("#form1").submit();
}
</script>
