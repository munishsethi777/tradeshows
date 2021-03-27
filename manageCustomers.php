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
        .rounded-circle{
            border-radius: 50%;
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
   <form id="form3" name="form3" target="_blank" method="post" action="createCustomerSpecialProgramForm.php">
   		<input type="hidden" id="customerSeq" name="customerSeq"/>
   </form> 
   <form id="form2" name="form2" method="post" action="Actions/CustomerAction.php">
   		<input type="hidden" id ="call" name="call"  value="export"/>
   		<input type="hidden" id="queryString" name="queryString"/>
   </form> 
     <!-- Modal Box for update comments and status -->  
<div class="modal inmodal bs-example-modal-lg" id="customerDetailsModal" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-lg" style="width:1100px">
    	<div class="modal-content animated fadeInRight">
          <div class="modal-body itemDetailsModalDiv mainDiv" style="overflow:auto">
            <div class="ibox">
             <div class="ibox-content">
             	<?php include 'progress.php';?>
                <div class="row">
                    <div class="col-sm-12">
                    <h3>Customer Details</h3>
                    <small>Complete details of the selected Customer</small>
                        
                        <div class="form-group row m-t-sm">
                       		<label class="col-sm-2 lblTitle">Customer Id #</label>
                           	<div class="col-sm-4"><label class="customerid lblDesc text-primary"></label></div>
                           	<label class="col-lg-3">Customer Type</label>
                            <div class="col-lg-3"><label class="customertype lblDesc"></label></div>
<!--                             <label class="col-sm-2 lblTitle">Priority</label> -->
<!--                            	<div class="col-sm-4"><label class="priority lblDesc text-primary"></label></div> -->
                        </div>
                        <div class="form-group row m-t-sm">
                        	<label class="col-sm-2">Customer Name</label>
                           	<div class="col-sm-4"><label class="fullname lblDesc"></label></div>
                           	<label class="col-lg-3">Inside Account Manager</label>
                          	<div class="col-lg-3"><label class="insideaccountmanagername lblDesc"></label></div>
                        	
                        </div>
<!--                         <div class="form-group row"> -->
<!--                        		<label class="col-lg-2">Sales Person</label> -->
<!--                            	<div class="col-lg-4"><label class="salespersonname lblDesc"></label></div> -->
<!--                             <label class="col-lg-3">Sales Person Id</label> -->
<!--                            	<div class="col-lg-3"><label class="salespersonid lblDesc"></label></div> -->
<!--                         </div> -->
<!--                         <div class="form-group row"> -->
<!--                        		<label class="col-lg-2">Sales Person 2</label> -->
<!--                            	<div class="col-lg-4"><label class="salespersonname2 lblDesc"></label></div> -->
<!--                             <label class="col-lg-3">Sales Person Id 2</label> -->
<!--                            	<div class="col-lg-3"><label class="salespersonid2 lblDesc"></label></div> -->
<!--                         </div> -->
<!--                         <div class="form-group row"> -->
<!--                        		<label class="col-lg-2">Sales Person 3</label> -->
<!--                            	<div class="col-lg-4"><label class="salespersonname3 lblDesc"></label></div> -->
<!--                             <label class="col-lg-3">Sales Person Id 3</label> -->
<!--                            	<div class="col-lg-3"><label class="salespersonid3 lblDesc"></label></div> -->
<!--                         </div> -->
<!--                         <div class="form-group row"> -->
<!--                        		<label class="col-lg-2">Sales Person 4</label> -->
<!--                            	<div class="col-lg-4"><label class="salespersonname4 lblDesc"></label></div> -->
<!--                             <label class="col-lg-3">Sales Person Id 4</label> -->
<!--                            	<div class="col-lg-3"><label class="salespersonid4 lblDesc"></label></div> -->
<!--                         </div> -->
                        <div class="form-group row">
                     		<label class="col-lg-2">Sales Admin Lead</label>
                            	<div class="col-lg-4"><label class="salesadminleadname lblDesc"></label></div>
                            <label class="col-lg-3">Chain Store Sales Admin</label>
                          	<div class="col-lg-3"><label class="chainstoresalesadmin lblDesc"></label></div>
                        </div>
                        <div class="form-group row">
                       		 <label class="col-lg-2">Business Type</label>
                           	<div class="col-lg-4"><label class="businesstype lblDesc"></label></div>
                       		<label class="col-lg-3">Created On</label>
                           	<div class="col-lg-3"><label class="createdon lblDesc"></label></div>
                        </div>
                        <!-- <div class="form-group row">
                       		 <label class="col-lg-2">Business Category</label>
                           	<div class="col-lg-4"><label class="businesscategory lblDesc"></label></div>
                           	<label class="col-lg-3">Store Id</label>
                           	<div class="col-lg-3"><label class="storeid lblDesc"></label></div>
                        </div> -->
                        <div class="form-group row">
                       		<label class="col-lg-2">Store Name</label>
                           	<div class="col-lg-3"><label class="storename lblDesc"></label></div>
                        </div><br>
                        <div class="salesRep"></div>
                        <div class="internalSupport"></div>
                        <div class="buyers"></div>
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
<!-- Modal Closes -->
</body>
<script type="text/javascript">
$(document).ready(function(){
	//$.get("Actions/CustomerAction.php?call=getAllCustomers", function(data){
    	loadGrid()
	//});
});
var hasNext = true;
function previous(){
	currentRowId = currentRowId-1;
	if(ids[currentRowId] == undefined){
		currentRowId = 0;
		//return; 
	}
	prevSeq = ids[currentRowId];
	hasNext = true;
	showCustomerDetails(prevSeq,currentRowId);
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
    	showCustomerDetails(nextSeq,currentRowId);
	}
}
var currentRowId =  0;
function showCustomerDetails(seq,rowId){
	currentRowId = rowId;
	showHideProgress();
	$.getJSON("Actions/CustomerAction.php?call=getCustomerDetails&seq="+seq, function(data){
		showHideProgress();
        var item = data.customer;
        var customerReps = data.customerreps;
		$('#customerDetailsModal').modal('show');
		$.each(item,function(key,val){
			$("."+key).text(val);
		});
        var buyer_html ='<h3>Buyers</h3><table class="table table-striped"><tr><th>Image</th><th>Name</th><th>Email</th><th>Telephone</th><th>Ext</th><th>Cell Phone</th><th>Category</th><!--<th>Notes</th>--></tr>';
        var  salesRep_html = '<h3>Sales Rep</h3><table class="table table-striped"><tr><th>Image</th><th>Name</th><th>Email</th><th>Telephone</th><th>Ext</th><th>Cell Phone</th><!--<th>Skype Id</th>--><th>Category</th><!--<th>Notes</th>--></tr>';
        var internalSupport_html = '<h3>Internal Support</h3><table class="table table-striped"><tr><th>Image</th><th>Name</th><th>Email</th><th>Telephone</th><th>Ext</th><th>Cell Phone</th><!--<th>Skype Id</th>--><th>Category</th><!--<th>Notes</th>--></tr>';
        var buyer_tablerows = "";
        var salesRep_tablerows = "";
        var internalSupport_tablerows = "";
        $.each(customerReps,function(key,customerRep){
		    var dppic = "";
            var fullname = "";
			var email = "";
            var ext = "";
            var telephone = "";
			var cellPhone = "";
			var category = "";
			var notes = "";
            var lastmodifiedon = "";
            var skypeid = "";
            if(customerRep.imageextension != null){
                dppic = "<?php echo $ConstantsArray['buyerImagePath'];?>" + customerRep.imageextension;
            }else{
                dppic = "<?php echo $ConstantsArray['buyerImagePath'];?>" + "dummy.jpg";
            }
			if(customerRep.fullname  != null ){
				fullname = customerRep.fullname;
			}
			if(customerRep.email  != null ){
				email = customerRep.email;
                
			}   
			if(customerRep.cellphone  != null ){
				cellPhone =  customerRep.cellphone;
			}
			if(customerRep.category  != null ){
				category = customerRep.category;
			}
			if(customerRep.notes  != null ){
				notes = customerRep.notes;
			}
			if(customerRep.lastmodifiedon  != null ){
				lastmodifiedon = customerRep.lastmodifiedon;
            }
            if(customerRep.skypeid != null){
                skypeid = customerRep.skypeid;
            }
            if(customerRep.ext != null){
                ext = customerRep.ext;
            }
            if(customerRep.telephone != null){
                telephone = customerRep.telephone;
            }
            switch(customerRep.customerreptype){
                case "salesrep":
                    salesRep_tablerows += "<tr class='tabRows'><td><img src=" + dppic + " alt=\"images\" class=\"rounded-circle\" width=50 height=50></td><td>" + fullname + "</td><td>" + email + "</td><td>" + telephone + "</td><td>" + ext + "</td><td>" + cellPhone + "</td><td>" + category + "</td><!--<td>" + notes + "</td>--></tr>";
                    break;
                case "internalsupport":
                    internalSupport_tablerows += "<tr class='tabRows'><td><img src=" + dppic + " alt=\"images\" class=\"rounded-circle\" width=50 height=50></td><td>" + fullname + "</td><td>" + email + "</td><td>" + telephone + "</td><td>" + ext + "</td><td>" + cellPhone + "</td><td>" + category + "</td><!--<td>" + notes + "</td>--></tr>";
                    break;
                case "buyer":
                    buyer_tablerows += "<tr class='tabRows'><td><img src=" + dppic + " alt=\"images\" class=\"rounded-circle\" width=50 height=50></td><td>" + fullname + "</td><td>" + email + "</td><td>" + telephone + "</td><td>" + ext + "</td><td>" + cellPhone + "</td><td>" + category + "</td><!--<td>" + notes + "</td>--></tr>";
                    break;
            }
        });
        if(salesRep_tablerows == ""){
            salesRep_html =  "<label>No Sales Rep</label>";
        }else{
            salesRep_html += salesRep_tablerows;
        }
        if(internalSupport_tablerows == ""){
            internalSupport_html = "<label>No Internal Support</label>";
        }else{
            internalSupport_html += internalSupport_tablerows;
        }
        if(buyer_tablerows == ""){
            buyer_html = "<label>No Buyers</label";
        }else{
            buyer_html += buyer_tablerows;
        }
        $(".buyers").html(buyer_html);
        $(".salesRep").html(salesRep_html);
        $(".internalSupport").html(internalSupport_html);
	});
}
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
var ids = [];
isSelectAll = false;
function loadGrid(){
// 	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
//         data = $('#customerGrid').jqxGrid('getrowdata', row);
//         ids[row] = data["seq"];
//         var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
//             	html +="<a href='javascript:showCustomerDetails("+ data['seq'] + "," + row +")' ><i class='fa fa-search' title='ViewDetails'></i></a>";
//             html += "</div>";
//         return html;
//     }

	var showCustomerDetailAction = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#customerGrid').jqxGrid('getrowdata', row);
        ids[row] = data["seq"];
        var html = "<div style='text-align: center; margin-top:6px;'>"
            	html +="<a title='View Detail' href='javascript:showCustomerDetails("+ data['seq'] + "," + row +")' >"+data['customerid']+"</a>";
            html += "</div>";
        return html;
    }
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#customerGrid').jqxGrid('getrowdata', row);
        ids[row] = data["seq"];
        var html = "";
        if(data['isquestionnairerequired']==1){
            html = "<div style='margin-left:9px;margin-top:1px;font-size:18px;'>"
            	html +="<a title='Add Questionnaire ' href='javascript:addQuestionnaire("+ data['seq'] + ")'></i><i class='fa fa-list-ul' title='Add Questionnaire'></i></a>";
            	// html += "<span style='margin-left:10px'><a title='Add Questionnaire ' href='javascript:addSplProg("+ data['seq'] + ")'><i class='fa fa-calendar' title='Add Special Prog.'></i></a></span>"
            html += "</div>";
        }
        return html;
    }
    
	var columns = [
        { text: 'id', datafield: 'seq' , hidden:true},
        { text: 'Customer ID', datafield: 'customerid',width:"10%",cellsrenderer:showCustomerDetailAction},
        { text: 'Customer Name', datafield: 'fullname', width:"10%"},
        { text: 'Store ID', datafield: 'storeid', width:"10%"},
        { text: 'Chain Store Name', datafield: 'storename', width:"10%"},
    //   { text: 'Sales Rep', datafield: 'salesrep', width:"10%"},
        { text: 'Customer Type', datafield: 'customertype', width:"10%"},
        { text: 'Inside Account Manager', datafield: 'insideaccountmanagername', width:"15%"},
    //   { text: 'BusinessType', datafield: 'businesstype',width:"10%"},
        { text: 'Sales Admin Lead', datafield:'salesadminleadname', width:"10%"},
        { text: 'Chain Store Sales Admin', datafield:'chainstoresalesadmin', width:"10%"},
    //   { text: 'Inside Account Manager', datafield: 'insideaccountmanager', width:"8%"},
    //   { text: 'Category', datafield: 'businesscategory',width:"12%"},
    //   { text: 'Sales Person', datafield: 'salespersonname',width:"12%"},
        {text: 'Is Questionnaire Required', datafield: 'isquestionnairerequired', hidden:true},
        { text: 'Ques Completion ', datafield: 'questionnaireprogress',width:"8%",},
        { text: 'Actions', datafield: 'action',width:"5%",cellsrenderer:actions},
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'customerid',
        sortdirection: 'asc',
        datafields: [
                    { name: 'seq', type: 'integer' }, 
                    { name: 'customerid', type: 'string' },
                    { name: 'fullname', type: 'string' },
                    { name: 'customertype', type: 'string'},
                    // { name: 'businesstype', type: 'string' },
                    { name: 'insideaccountmanagername', type: 'string'},
                    { name: 'salesadminleadname', type: 'string'},
                    { name: 'chainstoresalesadmin', type: 'string'},  
                    { name: 'storeid', type: 'string' },
                    { name: 'storename', type: 'string' }, 
                    // { name: 'businesscategory', type: 'string' },
                    { name: 'salespersonname', type: 'string' },
                    { name: 'lastmodifiedon', type: 'date' },
                    { name: 'questionnaireprogress', type: 'string' },
                    { name: 'action', type: 'string' },
                    { name: 'isquestionnairerequired', type: ''}
                    ],                          
        url: 'Actions/CustomerAction.php?call=getAllCustomers',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
            ids = [];
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
		height: '600px',
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
            var importButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var templateButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-upload'><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            var addSpecialProgButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-squar'></i><span style='margin-left: 4px; position: relative;'>Add Special Prog.</span></div>");
            var addQuestionaire = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-squar'></i><span style='margin-left: 4px; position: relative;'>Add Questionnaire</span></div>");
            
            container.append(addButton);
            container.append(editButton);
            container.append(deleteButton);
            container.append(importButton);
            container.append(templateButton);
            container.append(reloadButton);
           // container.append(addSpecialProgButton);
           // container.append(addQuestionaire);
            
            statusbar.append(container);
            importButton.jqxButton({  width: 65, height: 18 });
            templateButton.jqxButton({  width: 65, height: 18 });
            addButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            editButton.jqxButton({  width: 70, height: 18 });
            deleteButton.jqxButton({  width: 70, height: 18 });
          //  addSpecialProgButton.jqxButton({  width: 120, height: 18 });
            //addQuestionaire.jqxButton({  width: 120, height: 18 });
            // create new row.
            addButton.click(function (event) {
                location.href = ("createCustomer.php");
            });
	        importButton.click(function (event) {
	        	location.href = ("importCustomers.php");
    	    });
            deleteButton.click(function (event) {
            	deleteRows("customerGrid","Actions/CustomerAction.php?call=deleteCustomers");
           	});
            templateButton.click(function (event) {
            	filterQstr = getFilterString("customerGrid");
          	  	exportCustomersConfirm(filterQstr);
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
//             addSpecialProgButton.click(function (event){
//             	var selectedrowindex = $("#customerGrid").jqxGrid('selectedrowindexes');
//                 var value = -1;
//                 indexes = selectedrowindex.filter(function(item) { 
//                     return item !== value
//                 })
//                 if(indexes.length != 1){
//                     bootbox.alert("Please Select single row.", function() {});
//                     return;    
//                 }
//                 var row = $('#customerGrid').jqxGrid('getrowdata', indexes);
//                 $("#form3").attr('action', 'createCustomerSpecialProgramForm.php');
//                 $("#customerSeq").val(row.seq);                        
//                 $("#form3").submit();    
//             });
//             addQuestionaire.click(function (event){
//             	var selectedrowindex = $("#customerGrid").jqxGrid('selectedrowindexes');
//                 var value = -1;
//                 indexes = selectedrowindex.filter(function(item) { 
//                     return item !== value
//                 })
//                 if(indexes.length != 1){
//                     bootbox.alert("Please Select single row.", function() {});
//                     return;    
//                 }
//                 var row = $('#customerGrid').jqxGrid('getrowdata', indexes);
//                 $("#form3").attr('action', 'createCustomerQuestionaire.php');
//                 $("#customerSeq").val(row.seq);                        
//                 $("#form3").submit();    
//             });
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

function addQuestionnaire(seq){
	$("#form3").attr('action', 'createCustomerQuestionaire.php');
    $("#customerSeq").val(seq);                        
    $("#form3").submit();
}
function addSplProg(seq){
	$("#form3").attr('action', 'createCustomerSpecialProgramForm.php');
    $("#customerSeq").val(seq);                        
    $("#form3").submit();
}

function exportCustomersConfirm(filterQstr){
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
		    	exportCustomers(filterQstr); 
		    }
	    }
	});
}
function exportCustomers(filterQstr){
	$("#queryString").val(filterQstr);
	$("#form2").submit();
}
</script>
