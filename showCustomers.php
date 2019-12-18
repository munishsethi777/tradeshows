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
   <form id="form1" name="form1" method="post" action="createCustomer.php">
   		<input type="hidden" id="id" name="id"/>
   </form> 
     <!-- Modal Box for update comments and status -->  
<div class="modal inmodal bs-example-modal-lg" id="customerDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content animated fadeInRight">
          <div class="modal-body itemDetailsModalDiv mainDiv">
            <div class="ibox">
             <div class="ibox-content">
             	<?php include 'progress.php';?>
                <div class="row">
                    <div class="col-sm-12">
                    <h3>Customer Details</h3>
                    <small>Complete details of the selected Customer</small>
                        
                        <div class="form-group row m-t-sm">
                       		<label class="col-sm-2 lblTitle">ID #</label>
                           	<div class="col-sm-4"><label class="customerid lblDesc text-primary"></label></div>
                            <label class="col-sm-2">Name</label>
                           	<div class="col-sm-4"><label class="customerid lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">Sales Person</label>
                           	<div class="col-lg-4"><label class="salespersonname lblDesc"></label></div>
                            <label class="col-lg-2">Sales Person Id</label>
                           	<div class="col-lg-4"><label class="salespersonid lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		<label class="col-lg-2">Created On</label>
                           	<div class="col-lg-4"><label class="createdon lblDesc"></label></div>
                        </div><br>
                        <div class="buyers"></div>
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
$(document).ready(function(){
	//$.get("Actions/CustomerAction.php?call=getAllCustomers", function(data){
    	loadGrid()
	//});
});
function showCustomerDetails(seq){
	$.getJSON("Actions/CustomerAction.php?call=getCustomerDetails&seq="+seq, function(data){
		var item = data.customer;
		var buyer = data.buyers
		$('#customerDetailsModal').modal('show');
		$.each(item,function(key,val){
			$("."+key).text(val);
		});
		var html ='<h3>Buyers</h3><table class="table table-striped"><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Cell Phone</th><th>Category</th><th>Notes</th></tr>';
	    var tablerows = "";
	    $.each(buyer,function(key,buyer){
		    tablerows += "<tr class='tabRows'><td>"+ buyer.firstname + "</td><td>"+  buyer.lastname  +"</td><td>"+  buyer.email  + "</td><td>"+  buyer.officephone  + "</td><td>" + buyer.cellphone  +"</td><td>" + buyer.category  +"</td><td>"+ buyer.notes +"</td></tr>";
		});
		html += tablerows;
		$(".buyers").html(html);
	});
}
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#customerGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            	html +="<a href='javascript:showCustomerDetails("+ data['seq'] + ")' ><i class='fa fa-search' title='ViewDetails'></i></a>";
            html += "</div>";
        return html;
    }
	var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Customer ID', datafield: 'customerid',width:"13%"},
      { text: 'Name', datafield: 'fullname', width:"22%"},
      { text: 'BusinessType', datafield: 'businesstype',width:"15%"},
      { text: 'Sales Person', datafield: 'salespersonname',width:"18%"},
      { text: 'Last Modified', datafield: 'lastmodifiedon',width:"22%",filtertype: 'date',cellsformat: 'M-dd-yyyy H:mm'},
      { text: 'Action', datafield: 'action',cellsrenderer:actions,width:'7%'}
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
                    { name: 'fullname', type: 'string' }, 
                    { name: 'fullname', type: 'string' }, 
                    { name: 'businesstype', type: 'string' },
                    { name: 'salespersonname', type: 'string' },
                    { name: 'lastmodifiedon', type: 'date' }
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
		showstatusbar: true,
		selectionmode: 'checkbox',
		virtualmode: true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		},
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            //var exportButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            //var templateButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-download'><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
            var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
        
            container.append(addButton);
            container.append(editButton);
            container.append(deleteButton);
            container.append(reloadButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            editButton.jqxButton({  width: 70, height: 18 });
            deleteButton.jqxButton({  width: 70, height: 18 });
            // create new row.
            addButton.click(function (event) {
                location.href = ("createCustomer.php");
            });
//             exportButton.click(function (event) {
//         	   exportCustomersConfirm();
//             });
            deleteButton.click(function (event) {
            	deleteRows("customerGrid","Actions/CustomerAction.php?call=deleteCustomers");
           	});
            editButton.click(function (event){
            	var selectedrowindex = $("#customerGrid").jqxGrid('selectedrowindexes');
                var value = -1;
                indexes = selectedrowindex.filter(function(item) { 
                    return item !== value
                })
                if(indexes.length != 1){
                    bootbox.alert("Please Select single row for edit.", function() {});
                    return;    
                }
                var row = $('#customerGrid').jqxGrid('getrowdata', indexes);
                $("#id").val(row.seq);                        
                $("#form1").submit();    
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
