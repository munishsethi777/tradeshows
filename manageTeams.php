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
    <title>Manage Teams</title>
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
										<h4 class="p-h-sm font-normal">Manage Teams</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     	<div id="teamGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="post" action="createTeam.php"  >
     	<input type="hidden" id="id" name="id"/>
   	</form> 
   </body>
   <script type="text/javascript">
   $(document).ready(function(){
	//$.get("Actions/TaskCategoryAction.php?call=getAllTeams", function(data){
    	loadGrid()
});
function editShow(seq){
	$("#id").val(seq);                        
    $("#form1").submit();
}

function loadGrid(){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#teamGrid').jqxGrid('getrowdata', row);
        /*var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            	html +="<a href='javascript:editShow("+ data['seq'] + ")' ><i class='fa fa-pencil-square-o' title='Edit'></i></a>";
            html += "</div>";
        return html;*/
    }
    var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'Title', datafield: 'title', width:"35%"},
      { text: 'Description', datafield: 'description' , width:"35%"},
      { text: 'Enabled', datafield: 'isenable',columntype: 'checkbox', width:"8%"},
      { text: 'Lastmodifiedon', datafield:'lastmodifiedon', filtertype: 'date', cellsformat: 'M-dd-yyyy H:mm'}   
       
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'lastmodifiedon',
        sortdirection: 'desc',
        datafields: [
        	        {name: 'seq', type: 'integer', hidden:true },
                    {name: 'title', type: 'string'},
                    {name: 'description', type: 'string'},
                    {name: 'isenable', type: 'boolean'},
                    {name: 'lastmodifiedon', type:'date'},
                         
                    ],                          
        url: 'Actions/TeamAction.php?call=getAllTeam',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#teamGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#teamGrid").jqxGrid('updatebounddata', 'sort');
        },
        addrow: function (rowid, rowdata, position, commit) {
            commit(true);
        },
        updaterow: function (rowid, newdata, commit) {
            commit(true);
        },
        deleterow: function (rowid, commit) {
            commit(true);
        }
       
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    // initialize jqxGrid
    $("#teamGrid").jqxGrid(
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
		showstatusbar: true,
	    selectionmode: 'checkbox',
		virtualmode: true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
            var deleteButton =  $("<div style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            container.append(addButton);
            container.append(editButton);
            container.append(deleteButton);
            container.append(reloadButton);
            statusbar.append(container);
            addButton.jqxButton({  width: 65, height: 18 });
            editButton.jqxButton({width: 70, height: 18 });
            deleteButton.jqxButton({width: 70, height: 18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            // create new row.
            addButton.click(function (event) {
                location.href = ("createTeam.php");
            });
            // Update data
            editButton.click(function (event){
        	var selectedrowindex = $("#teamGrid").jqxGrid('selectedrowindexes');
            var value = -1;
            indexes = selectedrowindex.filter(function(item) { 
                return item !== value
            })
            if(indexes.length != 1){
                bootbox.alert("Please Select single row for edit.", function() {});
                return;    
            }
            var row = $('#teamGrid').jqxGrid('getrowdata', indexes);
            $("#id").val(row.seq);                        
            $("#form1").submit();    
            });
            
            //Delete Data
            deleteButton.click(function(event){
            	deleteRows("teamGrid","Actions/TeamAction.php?call=deleteTeams");
            });
            
          $("#teamGrid").bind('rowselect', function (event) {
                var selectedRowIndex = event.args.rowindex;
                 var pageSize = event.args.owner.rows.records.length - 1;                       
                if($.isArray(selectedRowIndex)){           
                    if(isSelectAll){
                        isSelectAll = false;    
                    } else{
                        isSelectAll = true;
                    }                                                                     
                    $('#teamGrid').jqxGrid('clearselection');
                    if(isSelectAll){
                        for (i = 0; i <= pageSize; i++) {
                            var index = $('#teamGrid').jqxGrid('getrowboundindex', i);
                            $('#teamGrid').jqxGrid('selectrow', index);
                        }    
                    }
                }                        
           });  
          // reload grid data.
            reloadButton.click(function (event) {
                $("#teamGrid").jqxGrid({ source: dataAdapter });
            }); 
        }
    });
   }
</script>
