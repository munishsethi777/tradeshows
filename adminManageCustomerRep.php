<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] . "Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/ReportingDataParameterType.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/UserConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/UserConfigurationType.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/ExportUtil.php");

$sessionUtil = SessionUtil::getInstance();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Customer Reps</title>
    <?include "ScriptsInclude.php"?>
    <style type="text/css">
        .itemDetailsModalDiv .lblDesc {
            font-weight: 500 !important;
        }
        .form-group {
            margin-bottom: 5px;
        }
        .reportDataCountRow .ibox-content {
            /* background-color: #ffffff; */
            padding: 10px 0px 0px 0px !important;
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="scripts/plugins/rickshaw/vendor/d3.v3.js"></script>    
    <script src="scripts/plugins/rickshaw/rickshaw.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> -->
</head>
<body>
    <?include "exportInclude.php"?>
    <div id="wrapper">
        <?php include("adminmenuInclude.php") ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                    <h4 class="p-h-sm font-normal">Manage Customer Reps</h4>
                                </nav>
                            </div>
                            <div class="ibox-content">
                                <div id="customerRepGrid"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form2" name="form2" method="post" action="adminCreateCustomerRep.php" target='_self'>
        <input type="hidden" id="id" name="id" />
    </form>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        loadGrid();
    });
    
    function editButtonClick(seq) {
        $("#id").val(seq);
        $("#form2").submit();
    }

    function loadGrid(){
    var actions = function(row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#customerRepGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>";
        html += "<a href='javascript:editButtonClick(" + data['seq'] + ")' ><i class='fa fa-edit' title='Edit Customer Rep'></i></a>";
        html += "</div>";
        return html;
    }
	var columns = [
            {text: 'Edit',datafield: 'Actions',cellsrenderer: actions,width: '3%',filterable: false},
            {text: 'id',datafield: 'seq',hidden: true},
            {text: 'Fullname',datafield: 'fullname',width: "10%"},
            {text: 'email',datafield: 'email',width: "20%"},
            {text: 'Ext', datafield: 'ext',width:"10%"},
            {text: 'Cellphone',datafield: 'cellphone',width: "10%"},
            {text: 'Position',datafield: 'position',width: "15%"},
            {text: 'Category',datafield: 'category',width: "8%"},
            {text: 'Skype Id',datafield: 'skypeid',width: "12%",},
            {text: 'Cutomer Rep Type',datafield: 'customerreptype',width: "10%"}
        ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'createdon',
        sortdirection: 'asc',
        datafields: [
				{name: 'id',type: 'integer'},
                {name: 'seq',type: 'integer'},
                {name: 'fullname', type: 'string' },
                {name: 'email',type: 'string'},
                {name: 'ext',type: 'string'},
                {name: 'cellphone',type: 'string'},
                {name: 'position',type: 'string'},
                {name: 'category',type: 'string'},
                {name: 'skypeid',type: 'string'},
                {name: 'customerreptype',type: 'string'},
            ],                      
        url: 'Actions/CustomerRepAction.php?call=getAllCustomersRep',
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            // update the grid and send a request to the server.
            $("#customerRepGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            // update the grid and send a request to the server.
            $("#customerRepGrid").jqxGrid('updatebounddata', 'sort');
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
    $("#customerRepGrid").jqxGrid(
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
        selectionmode: 'checkbox',
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		},
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
            var deleteButton = $("<div title='Delete' alt='Delete' style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            container.append(addButton);
            container.append(deleteButton);
            statusbar.append(container);
            container.append(reloadButton);
            addButton.jqxButton({  width: 65, height: 18 });
            deleteButton.jqxButton({ width: 65, height:18 });
            reloadButton.jqxButton({  width: 70, height: 18 });
            addButton.click(function (event) {
                location.href = ("adminCreateCustomerRep.php");
            });
            deleteButton.click(function(event){ 
               deleteRows("customerRepGrid","Actions/CustomerRepAction.php?call=deleteCustomerRep");
            });
            reloadButton.click(function (event) {
                $("#customerRepGrid").jqxGrid({ source: dataAdapter });
            });
            $("#customerRepGrid").bind('rowselect', function (event) {
                var selectedRowIndex = event.args.rowindex;
                var pageSize = event.args.owner.rows.records.length - 1;                       
                if($.isArray(selectedRowIndex)){           
                    if(isSelectAll){
                        isSelectAll = false;    
                    } else{
                        isSelectAll = true;
                    }                                                                     
                    $('#customerRepGrid').jqxGrid('clearselection');
                    if(isSelectAll){
                        for (i = 0; i <= pageSize; i++) {
                            var index = $('#customerRepGrid').jqxGrid('getrowboundindex', i);
                            $('#customerRepGrid').jqxGrid('selectrow', index);
                        }    
                    }
                }                        
            });
        }
    });
}
</script>