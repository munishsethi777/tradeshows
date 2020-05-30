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
    <title>Manage Class Codes</title>
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
										<h4 class="p-h-sm font-normal">Manage Class Code</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     	<div id="classCodeGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="post" action="createClassCode.php">
     	<input type="hidden" id="id" name="id"/>
   	</form> 
</body>
<script type="text/javascript">
$(document).ready(function(){
	//$.get("Actions/TaskCategoryAction.php?call=getAllTaskCategories", function(data){
    	loadGrid()
	//});
});
function editButtonClick(seq){
	$("#id").val(seq);                        
	$("#form1").submit(); 
}
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}
function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#classCodeGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            	//html +="<a href='javascript:editShow("+ data['seq'] + ")' ><i class='fa fa-pencil-square-o' title='Edit'></i></a>";
                html +="&ensp;<a href='javascript:editButtonClick("+ data['seq'] + ")' ><i class='fa fa-edit' title='Edit Class Codes'></i></a>";
            html += "</div>";
        return html;
    }
    var columns = [
        {text: "Action", datafield:"actions",cellsrenderer:actions,width:"5%",filterable:false},
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Vendor id', datafield: 'vendorid',width:"10%"},
      { text: 'Vendor Name', datafield: 'vendorname',width:"10%"},
      { text: 'Code', datafield: 'classcode', width:"10%"},
      { text: 'Email', datafield: 'email', width:"10%",hidden:true},
      { text: 'Contact Name', datafield: 'contactname', width:"20%",hidden:true },
      { text: 'Port', datafield: 'port', width:"10%"},
      { text: 'Buyer Name', datafield: 'buyername', width:"20%",hidden:true},
      { text: 'Buyer Email', datafield: 'buyeremail', width:"20%",hidden:true},
      { text: 'Assistant Buyer', datafield: 'assistantbuyer', width:"20%",hidden:true},
      { text: 'Assistant Buyer Email', datafield: 'assistantbuyemail', width:140,hidden:true},
      { text: 'China Rep Name', datafield: 'chinarepname', width:"20%",hidden:true},
      { text: 'China Rep Email', datafield: 'chinarepemail', width:"20%",hidden:true},
      { text: 'Created By', datafield: 'fullname',width:"10%"},
      { text: 'Active', datafield: 'isenabled',width:"10%" ,columntype:'checkbox'},
      { text: 'Last Modified', datafield: 'lastmodifiedon',width:"38%",filtertype: 'date',cellsformat: 'M-dd-yyyy H:mm'}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [{ name: 'seq', type: 'integer' }, 
                    { name: 'classcode', type: 'string' }, 
                    { name: 'fullname', type: 'string' },
                    { name: 'isenabled', type: 'boolean' },
                    { name: 'lastmodifiedon', type: 'date' },
                    { name: 'vendorid', type: 'string'},
                    { name: 'vendorname', type: 'string'},
                    { name: 'email', type:'email'},
                    { name: 'contactname', type: 'string'},
                    { name: 'port', type: 'string'},
                    { name: 'buyername', type: 'string'},
                    { name: 'buyeremail', type: 'string'},
                    { name: 'assistantbuyer', type: 'string'},
                    { name: 'assistantbuyeremail', type: 'string'},
                    { name: 'chinarepname', type: 'string'},
                    { name: 'chinarepemail', type: 'string'}
                    ],                          
        url: 'Actions/ClassCodeAction.php?call=getClassCodes',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#classCodeGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#classCodeGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#classCodeGrid").jqxGrid(
    {
    	width: '100%',
		height: '600',
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
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            //var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var importButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
            container.append(addButton);
            //container.append(editButton);
            container.append(deleteButton);
            container.append(reloadButton);
            container.append(importButton);
            statusbar.append(container);
            //editButton.jqxButton({  width: 65, height: 18 });
            addButton.jqxButton({  width: 65, height: 18 });
            deleteButton.jqxButton({  width: 65, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            importButton.jqxButton({width: 70, height: 18});
            // create new row.
            addButton.click(function (event) {
                location.href = ("createClassCode.php");
            });
            deleteButton.click(function (event) {
                deleteRows("classCodeGrid","Actions/ClassCodeAction.php?call=deleteClassCode");
           	});
            // editButton.click(function (event){
            // 	var selectedrowindex = $("#classCodeGrid").jqxGrid('selectedrowindexes');
            //     var value = -1;
            //     indexes = selectedrowindex.filter(function(item) { 
            //         return item !== value
            //     })
            //     if(indexes.length != 1){
            //         bootbox.alert("Please Select single row for edit.", function() {});
            //         return;    
            //     }
            //     var row = $('#classCodeGrid').jqxGrid('getrowdata', indexes);
            //     editButtonClick(row.seq);  
            // });
             $("#classCodeGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#classCodeGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#classCodeGrid').jqxGrid('getrowboundindex', i);
                             $('#classCodeGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#classCodeGrid").jqxGrid({ source: dataAdapter });
            });
            importButton.click(function (event){
                location.href = ('adminImportClassCodes.php');
            });
        }
    });
}
</script>