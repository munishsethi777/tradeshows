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
    <title>Admin | Manage Item Specifications</title>
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
										<h4 class="p-h-sm font-normal">Manage Item Specifications</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     	<div id="itemGrid"></div>
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
   <form id="form2" name="form2" method="post" action="adminCreateItemSpecifications.php">
    	<input type="hidden" id="id" name="id"/>
   </form> 
   
   <!-- Modal Box for update comments and status -->  
<div class="modal inmodal bs-example-modal-lg" id="itemDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content animated fadeInRight">
          <div class="modal-body itemDetailsModalDiv mainDiv">
            <div class="ibox">
             <div class="ibox-content">
             	<?php include 'progress.php';?>
                <div class="row">
                    <div class="col-sm-12">
                    <h3>Item Details</h3>
                    <small>Complete details of the selected item</small>
                        
                        <div class="form-group row m-t-sm">
                       		<label class="col-sm-2 lblTitle">Item #</label>
                           	<div class="col-sm-4"><label class="itemitemno lblDesc text-primary"></label></div>
                            <label class="col-sm-2">Department</label>
                           	<div class="col-sm-4"><label class="itemdept lblDesc"></label></div>
                        </div>
                        
                        <div class="form-group row">
                       		<label class="col-lg-2">Desc.</label>
                           	<div class="col-lg-10"><label class="itemdescription lblDesc"></label></div>
                        </div>
                        
                        <div class="form-group row">
                       		<label class="col-lg-2">Class</label>
                           	<div class="col-lg-4"><label class="itemclass lblDesc"></label></div>
                            <label class="col-lg-2">Status</label>
                           	<div class="col-lg-4"><label class="itemstatus lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">Unit</label>
                           	<div class="col-lg-4"><label class="itemunit lblDesc"></label></div>
                            <label class="col-lg-2">Pccs</label>
                           	<div class="col-lg-4"><label class="itempccs lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">Disc</label>
                           	<div class="col-lg-4"><label class="itemdisc lblDesc"></label></div>
                            <label class="col-lg-2">InstockQty</label>
                           	<div class="col-lg-4"><label class="iteminstockqty lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">AllocQty</label>
                           	<div class="col-lg-4"><label class="itemallocqty lblDesc"></label></div>
                            <label class="col-lg-2">SoQty</label>
                           	<div class="col-lg-4"><label class="itemsoqty lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">AVQty</label>
                           	<div class="col-lg-4"><label class="itemavqty lblDesc"></label></div>
                            <label class="col-lg-2">POQty</label>
                           	<div class="col-lg-4"><label class="itempoqty lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">OQQty</label>
                           	<div class="col-lg-4"><label class="itemowqty lblDesc"></label></div>
                            <label class="col-lg-2">ProjQty</label>
                           	<div class="col-lg-4"><label class="itemprojqty lblDesc"></label></div>
                        </div>
                     	<div class="form-group row">
                       		<label class="col-lg-2">YTDSoldQty</label>
                           	<div class="col-lg-4"><label class="itemytdsoldqty lblDesc"></label></div>
                            <label class="col-lg-2">LastYr Sold Qty</label>
                           	<div class="col-lg-4"><label class="itemlastyearsoldqty lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">Comdship</label>
                           	<div class="col-lg-4"><label class="itemcomdship lblDesc"></label></div>
                            <label class="col-lg-2">Show Spcl.</label>
                           	<div class="col-lg-4"><label class="itemshowspecial lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">Distributor</label>
                           	<div class="col-lg-4"><label class="itemdistributor lblDesc"></label></div>
                            <label class="col-lg-2">DealerPrice</label>
                           	<div class="col-lg-4"><label class="itemdealerprice lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">CrzyDissp</label>
                           	<div class="col-lg-4"><label class="itemcrzydissp lblDesc"></label></div>
                            <label class="col-lg-2">QtyWt</label>
                           	<div class="col-lg-4"><label class="itemqtywt lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">MinStock</label>
                           	<div class="col-lg-4"><label class="itemminstk lblDesc"></label></div>
                            <label class="col-lg-2">ItemCost</label>
                           	<div class="col-lg-4"><label class="itemitemcost lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">CreatedOn</label>
                           	<div class="col-lg-4"><label class="itemcreatedon lblDesc"></label></div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
           	</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Closes -->
   
   
   
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
});

function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#itemGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            	html +="<a href='javascript:showItemDetails("+ data['seq'] + ")' ><i class='fa fa-search' title='ViewDetails'></i></a>";
            html += "</div>";
        return html;
    }
	var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Item No.', datafield: 'itemspecifications.itemno', width:"12%"},
      { text: 'OMS', datafield: 'itemspecifications.oms',width:"6%"},
      { text: 'Description', datafield: 'itemspecifications.item1description',width:"27%"},
      { text: 'Country Of Origin', datafield: 'itemspecifications.countryoforigin',width:"14%"},
      { text: 'Versions', datafield: 'versions',width:"8%",filterable:false},
      { text: 'Created On', datafield: 'itemspecifications.createdon',filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',width:"15%"},
      { text: 'Modified On', datafield: 'itemspecifications.lastmodifiedon',filtertype: 'date',cellsformat: 'M-d-yyyy hh:mm tt',width:"15%"}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'createdon',
        sortdirection: 'asc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                    { name: 'itemspecifications.itemno', type: 'string' }, 
                    { name: 'itemspecifications.item1description', type: 'string' },
                    { name: 'versions', type: 'integer' },
                    { name: 'itemspecifications.countryoforigin', type: 'string' } ,
                    { name: 'itemspecifications.oms', type: 'string' },
                    { name: 'itemspecifications.createdon', type: 'date' }, 
                    { name: 'itemspecifications.lastmodifiedon', type: 'date' } 
                    ],                          
        url: 'Actions/ItemSpecificationAction.php?call=getAllItemSpecifications',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#itemGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#itemGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#itemGrid").jqxGrid(
    {
    	width: '100%',
		height: '90%',
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
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var importButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var downloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
            var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            
            container.append(addButton);
            container.append(editButton);
            container.append(importButton);
            container.append(exportButton);
            container.append(reloadButton);
            container.append(downloadButton);
            container.append(deleteButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
           	editButton.jqxButton({  width: 65, height: 18 });
            importButton.jqxButton({  width: 65, height: 18 });
            exportButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            downloadButton.jqxButton({  width: 140, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            // create new row.
            addButton.click(function (event) {
                location.href = ("adminCreateItemSpecifications.php");
            });
            editButton.click(function (event){
            	var selectedrowindex = $("#itemGrid").jqxGrid('selectedrowindexes');
                var value = -1;
                indexes = selectedrowindex.filter(function(item) { 
                    return item !== value
                })
                if(indexes.length != 1){
                    bootbox.alert("Please Select single row for edit.", function() {});
                    return;    
                }
                var row = $('#itemGrid').jqxGrid('getrowdata', indexes);
                $("#id").val(row.seq);                        
                $("#form2").submit();    
            });
            // delete row.
            deleteButton.click(function (event) {
                gridId = "itemGrid";
                deleteUrl = "Actions/ProductCategoryAction.php?call=deleteProductCategories";
                deleteItems(gridId,deleteUrl);
            });
            importButton.click(function (event) {
                location.href = ("adminImportItemSpecifications.php");
            });
            exportButton.click(function (event) {
        	   filterQstr = getFilterString("itemGrid");
        	   exportItemsConfirm(filterQstr);
            });
             $("#itemGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#itemGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#itemGrid').jqxGrid('getrowboundindex', i);
                             $('#itemGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#itemGrid").jqxGrid({ source: dataAdapter });
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

</script>
