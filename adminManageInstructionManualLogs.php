<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] . "Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/ReportingDataParameterType.php");

$allReportingDataParameters = ReportingDataParameterType :: getAll(); 


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Instruction Manual Logs</title>
    <?include "ScriptsInclude.php"?>
    <style type="text/css">
        .itemDetailsModalDiv .lblDesc {
            font-weight: 500 !important;
        }

        .form-group {
            margin-bottom: 5px;
        }

        .reportDataCountRow .ibox-content {
            background-color: white;
            padding: 10px 10px 0px 20px !important;
        }

        .peity {
            margin-top: 10px;
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Peity -->
    <script src="scripts/plugins/peity/jquery.peity.min.js"></script>
    <script src="scripts/InstructionManualGridDataByReportingParameter.js"></script>
    <!--     <script src="scripts/demo/peity-demo.js"></script> -->

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
                                    <h4 class="p-h-sm font-normal">Manage Instruction Manual Logs</h4>
                                </nav>
                            </div>
                            <div class="ibox-content" style="background-color:#fafafa;padding-bottom:0px;">
                                <div class="ibox" style="border:1px #e7eaec solid">
                                    <div class="ibox-title">
                                        <h5>Instruction Manual Logs Analytics</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <!--<a class="close-link"> -->
                                            <!--<i class="fa fa-times"></i> -->
                                            <!--</a> -->
                                        </div>
                                    </div>
                                    
                                    <div class="ibox-content" style="background-color:#fafafa;padding-bottom:0px;">
                                        
                                        <div class="row reportDataCountRow">
                                            <input id="gridId" type="hidden" name="gridId" value="instructionManualLogGrid"/>
                                            <?php 
                                                foreach($allReportingDataParameters as $key => $value){
                                                    if(strpos($key,'instruction_manual_') !== false){
                                                        ?>
                                                        <div class="col-lg-2">
                                                            <div class="ibox float-e-margins get-grid-data-by-reporting-data" 
                                                                id="<?php echo $key?>" >
                                                                <div class="ibox-content text-center">
                                                                    <h1 class="no-margins" id='<?php echo $key ?>_current'></h1>
                                                                    <div class="col-lg-12 stat-percent font-bold text-info" id='<?php echo $key ?>_change_color' >
                                                                        <i class="fa" id='<?php echo $key ?>_change_arrow'></i>
                                                                        <span class="text-center" id='<?php echo $key ?>_diff'></span>
                                                                        <span id='<?php echo $key ?>_percent'></span>
                                                                    </div>
                                                                    <small class="dataName"><?php echo $value ?></small>
                                                                    <span class="bar" id='<?php echo $key ?>_thirty_days'></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php 
                                                    }
                                                } 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div id="instructionManualLogGrid"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form1" name="form1" method="GET" action="Actions/InstructionManualLogsAction.php">
        <input type="hidden" id="call" name="call" value="export" />
        <input type="hidden" id="queryString" name="queryString" />
    </form>
    <form id="form2" name="form2" method="post" action="adminCreateInstructionManualLogs.php" target='_self'>
        <input type="hidden" id="id" name="id" />
    </form>

</body>
<script type="text/javascript">
    var source ;
    $(document).ready(function() {
        loadGrid();
        loadReportingData();
        // $(".get-grid-data-by-reporting-data").click(function (){
        //     var reportingParameter = $(this).attr("id");
        //     var gridId = $("#gridId").val();
        //     AddReportingFilter(reportingParameter,gridId);
        // });
    });
    
    function editButtonClick(seq) {
        $("#id").val(seq);
        $("#form2").submit();
    }

    function loadGrid() {
        var actions = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#instructionManualLogGrid').jqxGrid('getrowdata', row);
            var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
            html += "<a href='javascript:editButtonClick(" + data['seq'] + ")' ><i class='fa fa-edit' title='Edit Instruction Manual Log'></i></a>";
            html += "</div>";
            return html;
        }
        var statusTypes = ["", "Not Started", "In Progress", "Awaiting Information From China", "Awaiting Information From Buyers", "In Review - Supervisor", "In Review - Manager", "In Review - Buyer", "Sent To China", "Cancelled", "Duplicate"];
        var columns = [{
                text: 'Actions',
                datafield: 'Actions',
                cellsrenderer: actions,
                width: '5%',
                filterable: false
            },
            {
                text: 'id',
                datafield: 'seq',
                hidden: true
            },
            {
                text: 'Completed',
                datafield: 'iscompleted',
                columntype: 'checkbox',
                width: "6%"
            },
            { text: 'Entered By', datafield: 'fullname',width:"10%"},
            {
                text: 'Item No',
                datafield: 'itemnumber',
                width: "12%",
                hidden: false
            },
            {
                text: 'Class',
                datafield: 'classcode',
                width: "7%",
                filtercondition: 'STARTS_WITH'
            },
            {
                text: 'Entry Date',
                datafield: 'entrydate',
                filtertype: 'date',
                width: "10%",
                cellsformat: 'M-dd-yyyy'
            },
            {
                text: 'Graphic Due Date',
                datafield: 'graphicduedate',
                filtertype: 'date',
                width: "10%",
                cellsformat: 'M-dd-yyyy'
            },
            {
                text: 'Status',
                datafield: 'instructionmanuallogstatus',
                width: "24%",
                hidden: false,
                filtertype: 'checkedlist',
                filteritems: statusTypes,
                filtercondition: 'equal'
            },
            {
                text: 'Modified On',
                datafield: 'instructionmanuallogs.lastmodifiedon',
                filtertype: 'date',
                width: "14%",
                cellsformat: 'M-dd-yyyy hh:mm tt'
            }
        ]

        source = {
            datatype: "json",
            id: 'id',
            pagesize: 20,
            sortcolumn: 'instructionmanuallogs.lastmodifiedon',
            sortdirection: 'desc',
            datafields: [{
                    name: 'seq',
                    type: 'integer'
                },
                { name: 'fullname', type: 'string' },
                {
                    name: 'itemnumber',
                    type: 'string'
                },
                {
                    name: 'classcode',
                    type: 'string'
                },
                {
                    name: 'entrydate',
                    type: 'date'
                },
                {
                    name: 'graphicduedate',
                    type: 'date'
                },
                {
                    name: 'instructionmanuallogstatus',
                    type: 'string'
                },
                {
                    name: 'iscompleted',
                    type: 'boolean'
                },
                {
                    name: 'instructionmanuallogs.lastmodifiedon',
                    type: 'date'
                },
            ],
            url: 'Actions/instructionManualLogsAction.php?call=getAllInstructionManualLogs',
            root: 'Rows',
            cache: false,
            beforeprocessing: function(data) {
                source.totalrecords = data.TotalRows;
            },
            filter: function() {
                // update the grid and send a request to the server.
                $("#instructionManualLogGrid").jqxGrid('updatebounddata', 'filter');
            },
            sort: function() {
                // update the grid and send a request to the server.
                $("#instructionManualLogGrid").jqxGrid('updatebounddata', 'sort');
            },
            addrow: function(rowid, rowdata, position, commit) {
                commit(true);
            },
            deleterow: function(rowid, commit) {
                commit(true);
            },
            updaterow: function(rowid, newdata, commit) {
                commit(true);
            }
        };

        var dataAdapter = new $.jqx.dataAdapter(source);
        // initialize jqxGrid
        $("#instructionManualLogGrid").jqxGrid({
            width: '100%',
            height: '600',
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
            rendergridrows: function(toolbar) {
                return dataAdapter.records;
            },
            ready: function() {
            },
            renderstatusbar: function(statusbar) {
                var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                var addButton = $("<div title='Add' alt='Add' style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
                //var editButton = $("<div title='Edit' alt='Edit' style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                var importButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
                var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
                var reloadButton = $("<div title='Reload' alt='Reload' style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
                //var downloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Download Template</span></div>");
                var deleteButton = $("<div title='Delete' alt='Delete' style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");

                container.append(addButton);
                //container.append(editButton);
                container.append(importButton);
                container.append(exportButton);
                container.append(reloadButton);
                //container.append(downloadButton);
                container.append(deleteButton);
                statusbar.append(container);
                addButton.jqxButton({
                    width: 65,
                    height: 18
                });
                //editButton.jqxButton({  width: 65, height: 18 });
                importButton.jqxButton({
                    width: 65,
                    height: 18
                });
                exportButton.jqxButton({
                    width: 65,
                    height: 18
                });
                reloadButton.jqxButton({
                    width: 70,
                    height: 18
                });
                //downloadButton.jqxButton({  width: 140, height: 18 });
                deleteButton.jqxButton({
                    width: 65,
                    height: 18
                });
                addButton.click(function(event) {
                    location.href = ("adminCreateInstructionManualLogs.php");
                });
                deleteButton.click(function(event) {
                    gridId = "instructionManualLogGrid";
                    deleteUrl = "Actions/InstructionManualLogsAction.php?call=deleteInstructionManualLog";
                    deleteGraphicLog(gridId, deleteUrl);
                });
                importButton.click(function(event) {
                    location.href = ("adminImportInstructionManualLogs.php");
                });
                exportButton.click(function(event) {
                    filterQstr = getFilterString("instructionManualLogGrid");
                    exportItemsConfirm(filterQstr);
                });
                reloadButton.click(function(event) {
                    $("#instructionManualLogGrid").jqxGrid("clearfilters");
                });
                $("#instructionManualLogGrid").bind('rowselect', function(event) {
                    var selectedRowIndex = event.args.rowindex;
                    var pageSize = event.args.owner.rows.records.length - 1;
                    if ($.isArray(selectedRowIndex)) {
                        if (isSelectAll) {
                            isSelectAll = false;
                        } else {
                            isSelectAll = true;
                        }
                        $('#instructionManualLogGrid').jqxGrid('clearselection');
                        if (isSelectAll) {
                            for (i = 0; i <= pageSize; i++) {
                                var index = $('#instructionManualLogGrid').jqxGrid('getrowboundindex', i);
                                $('#instructionManualLogGrid').jqxGrid('selectrow', index);
                            }
                        }
                    }
                });

            }
        });
    }
    function getDashboardCount() {
		$.ajax({
			url: "Actions/InstructionManualLogsAction.php?call=getInstructionManualDashboardCount",
			dataType: "json",
			success: (data) => {
				if (data.success == "1") {
					$(".final_missing_appointments_report").text(data.data["final_missing_appointments_report"]);
					$(".middle_missing_appointments_report").text(data.data["middle_missing_appointments_report"]);
					$(".first_missing_appointments_report").text(data.data["first_missing_appointments_report"]);
					$(".final_incompleted_schedules_report").text(data.data["final_incompleted_schedules_report"]);
					$(".middle_incompleted_schedules_report").text(data.data["middle_incompleted_schedules_report"]);
					$(".first_incompleted_schedules_report").text(data.data["first_incompleted_schedules_report"]);
					$(".pending_qc_approval_report").text(data.data["pending_qc_approval_report"]);
				} else {
					toaster.error(data.message, 'Failed');
				}
			}
		})
    }
    function loadReportingData() {
		$.getJSON("Actions/ReportingDataAction.php?call=getReportingData&for=instruction_manual_",
			function(response) {
				$.each(response.data, function(key, value) {
					if (key.includes("change_arrow")) {
						$("#" + key).addClass(value);
					} else if (key.includes("change_color")) {
						$("#" + key).css("color", value);
					} else {
						$("#" + key).text(value);
					}
					 	// console.log(key,value);									
				});
				$(".bar").peity("bar", {
					fill: ["rgba(26, 178, 147, 0.3)", "rgba(26, 178, 147, 0.3)"],
					width: "100%"
				})

			}
		);
    }
</script>