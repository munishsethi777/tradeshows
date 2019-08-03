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
    <title>Manage Email Logs</title>
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
										<h4 class="p-h-sm font-normal">Manage Email Logs</h4>
								 </nav>
		                     </div>
		                     <div class="ibox-content">
		                     	<div id="emailLogGrid"></div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>
   </div>
   <form id="form1" name="form1" method="GET" action="Actions/EmailLogAction.php">
     	<input type="hidden" id="call" name="call" value="export" />
     	<input type="hidden" id="queryString" name="queryString"/>
   </form>
   <form id="form2" name="form2" method="post"  >
     	<input type="hidden" id="id" name="id"/>
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
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#emailLogGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            	html +="<a href='javascript:editShow("+ data['seq'] + ")' ><i class='fa fa-pencil-square-o' title='Edit'></i></a>";
            html += "</div>";
        return html;
    }
    var columns = [
      { text: 'FullName', datafield: 'fullname'},
      { text: 'Log Type', datafield: 'logtype'},
      { text: 'Email Id', datafield: 'emailid'},
      { text: 'Send On', datafield: 'sendon',filtertype: 'date',cellsformat: 'M-dd-yyyy H:mm'},
      { text: 'Sent On', datafield: 'senton',filtertype: 'date',cellsformat: 'M-dd-yyyy H:mm'}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'sendon',
        sortdirection: 'desc',
        datafields: [
                    {name: 'fullname', type: 'string'},
                    {name: 'logtype', type: 'string'},
                    {name: 'emailid', type: 'string'},
                    {name: 'sendon', type:'date'},
                    {name: 'senton',type:'date'}
                    ],                          
        url: 'Actions/EmailLogAction.php?call=getEmailLog',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#emailLogGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#emailLogGrid").jqxGrid('updatebounddata', 'sort');
        }
       
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    // initialize jqxGrid
    $("#emailLogGrid").jqxGrid(
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
		virtualmode: true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		 },
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
            container.append(reloadButton);
            container.append(exportButton);
            statusbar.append(container);
            reloadButton.jqxButton({  width: 70, height: 18 });
            exportButton.jqxButton({  width: 65, height: 18 });
             //Create new row
             exportButton.click(function (event) {
         	   filterQstr = getFilterString("emailLogGrid");
         	   exportItemsConfirm(filterQstr);
            });
             // reload grid data.
            reloadButton.click(function (event) {
                $("#emailLogGrid").jqxGrid({ source: dataAdapter });
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
