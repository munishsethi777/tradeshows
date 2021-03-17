<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] . "Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/ReportingDataParameterType.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/UserConfigurationMgr.php");
require_once($ConstantsArray['dbServerUrl'] . "Enums/UserConfigurationType.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/ExportUtil.php");

$sessionUtil = SessionUtil::getInstance();
$allReportingDataParameters = ReportingDataParameterType :: getAll(); 
$userConfigurationMgr = UserConfigurationMgr::getInstance();
$userSeq = $sessionUtil->getUserLoggedInSeq();
$analyticsDivExpandedUserConfigKey = "AnalyticsIMDivExpanded";
$isAnalyticsDivExpandedUserConfigValue = $userConfigurationMgr->getConfigurationValue($userSeq,$analyticsDivExpandedUserConfigKey,"1");
$analyticsDivState = "collapsed";
if($isAnalyticsDivExpandedUserConfigValue){
	$analyticsDivState = "";
}
$defaultFilterSelectionUserConfigKey = UserConfigurationType::getName("IMDefaultFilterSelection");
$defaultFilterSelectionReportDataType = $userConfigurationMgr->getConfigurationValue($userSeq,$defaultFilterSelectionUserConfigKey,"instruction_manual_all_count");
$exportLimit =5000;
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
            /* background-color: #ffffff; */
            padding: 10px 0px 0px 0px !important;
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="scripts/plugins/rickshaw/vendor/d3.v3.js"></script>    
    <script src="scripts/plugins/rickshaw/rickshaw.min.js"></script>
    <script src="scripts/GridDataByReportingParameter.js"></script>
    <script src="scripts/UserConfigurations.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> -->
</head>
<body>
    <?include "exportInclude.php"?>
    <input id="isAnalyticsDivExpandedUserConfigValue" class="isAnalyticsDivExpandedUserConfigValue" type="hidden" name="isAnalyticsDivExpandedUserConfigValue" value="<?php echo $isAnalyticsDivExpandedUserConfigValue;?>" />
    <input id="analyticsDivExpandedUserConfigKey" class="analyticsDivExpandedUserConfigKey" type="hidden" value="<?php echo $analyticsDivExpandedUserConfigKey; ?>" />
    <input id="defaultFilterSelectionUserConfigKey" class="defaultFilterSelectionUserConfigKey" type="hidden" value="<?php echo $defaultFilterSelectionUserConfigKey; ?>" />
    <input id="defaultFilterSelectionReportDataType" class="defaultFilterSelectionReportDataType" type="hidden" value="<?php echo $defaultFilterSelectionReportDataType; ?>" />
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
                                <div class="ibox <?php echo $analyticsDivState ?>" style="border:1px #e7eaec solid">
                                    <div class="ibox-title">
                                        <h5>Instruction Manual Logs Analytics</h5>&nbsp;
                                        <div id="currentFiterAppliedNameDiv" style="display:inline;">
                                            &nbsp;Current Filter Applied : 
                                            <span id="currentFiterAppliedName"></span>
                                        </div>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up" id="analyticsDivExpandedIcon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content" style="background-color:#fafafa;padding-bottom:0px;">
                                        <div class="row reportDataCountRow">
                                            <input id="gridId" type="hidden" name="gridId" value="instructionManualLogGrid"/>
                                            <?php 
                                                foreach($allReportingDataParameters as $key => $value){
                                                    if(strpos($key,'instruction_manual_') !== false){
                                                        ?>
                                                        
                                                        <div class="col-lg-2 reportBlock" >
                                                            <div class="ibox float-e-margins reportFilterBlock bg-white" id="<?php echo $key ?>">
                                                                <div class="ibox-content text-center" id="<?php echo $key."_ibox_content"?>">
                                                                	<div class='reportFilterBlockTools floatRightTools'>
                                                                    	<i title="Apply Filter" alt="Apply Filter" style="font-size:14px" class="fa fa-filter" id="<?php echo $key;?>" ></i>
                                                                    	<i title="Show Graph" alt="Show Graph" class="fa fa-bar-chart" id="<?php echo $key . "_show_graph";?>" ></i>
                                                                    	<i title="Export Data" alt="Export Data" style="font-size:14px" class="fa fa-file-excel-o filterExportDataIcon" id="<?php echo $key . "_export_date";?>" ></i>
                                                                	</div>
                                                                	
                                                                    <h1 class="no-margins" id='<?php echo $key ?>_current'></h1>
                                                                    <div class="col-lg-12 stat-percent font-bold text-info" id='<?php echo $key ?>_change_color' >
                                                                        <i class="fa" id='<?php echo $key ?>_change_arrow'></i>
                                                                        <span class="text-center" id='<?php echo $key ?>_diff'></span>
                                                                        <span id='<?php echo $key ?>_percent'></span>
                                                                    </div>
                                                                    <small id="analyticName" class="analyticName"><?php echo $value ?></small>
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
                            <div class="modal fade" aria-hidden="true" id="instructionManualFilterGraphModal">
                                <div class="modal-dialog modal-lg modal-dialog-centered" style="width:70%">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 id="graphTitle"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12" id="graphContainer">
                                                    <canvas id="instructionManualFilterGraph"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="exportLogsForm" name="exportLogsForm" method="post" action="Actions/InstructionManualLogsAction.php">
    	<input type="hidden" name="call" value="exportFilterData" />
    	<input type="hidden" name="filterId" id="filterId" />
    </form>
    <form id="form2" name="form2" method="post" action="adminCreateInstructionManualLogs.php" target='_blank'>
        <input type="hidden" id="id" name="id" />
    </form>

</body>
<script type="text/javascript">
	var coll = document.getElementsByClassName("collapsible");
    var i;
    for (i = 0; i < coll.length; i++) {
    	coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
            	content.style.maxHeight = null;
            } else {
            	content.style.maxHeight = content.scrollHeight + "px";
            } 
        });
    }
    var source ;
    var defaultFilterSelectionReportDataType = $("#defaultFilterSelectionReportDataType").val();
    var defaultFilterSelectionUserConfigKey = $("#defaultFilterSelectionUserConfigKey").val();
    var selectedRows = [];
    var style = getComputedStyle(document.body);
    var filterGraphColor = style.getPropertyValue("--filterGraphColor");
    $(document).ready(function() {
        loadGrid();
        loadReportingData();
        var gridId = $("#gridId").val();
        $(".fa-filter").click(function (){
            var reportingParameter = $(this).attr("id");
            var dataName = $(this).find("dataName").html();
            var currentFiterAppliedName = $("#" + reportingParameter).find("#analyticName").html();
            applyReportingFilter(reportingParameter,gridId,currentFiterAppliedName,defaultFilterSelectionUserConfigKey);
            $(".get-grid-data-by-reporting-data, .ibox-content").removeClass("dataFilterBlockSelected");
            $("#"+reportingParameter +" .ibox-content").removeClass("bg-white");
            $("#"+reportingParameter + " .ibox-content").addClass("dataFilterBlockSelected");
            $("#exportFormForInstructionManualLog input[name=filterId").val(reportingParameter);
        });
        if(defaultFilterSelectionReportDataType != ''){
            $("#" + defaultFilterSelectionReportDataType + " .ibox-content").addClass("dataFilterBlockSelected");
            $("#" + defaultFilterSelectionReportDataType +" .fa-filter").click();
        } 
        $("#exportBtnForInstructionManualLog").click(function(e) {
			exportFinal(e, this);
        });
        $(".filterExportDataIcon").click(function(){
            var filterId = $(this).attr('id');
			$("#exportLogsForm #filterId").val(filterId);
			$("#exportLogsForm").submit();
        });
        $(".fa-bar-chart").click(function(){
            $("#graphContainer").html("");
            $("#graphContainer").html("<canvas id='instructionManualFilterGraph'></canvas>");
            var graphIconId = $(this).attr("id");
            $.getJSON("Actions/InstructionManualLogsAction.php?call=showFilterGraph&graphIconId=" + graphIconId, (response)=>{
                var graphTitle = response.data.graphTitle;
                $("#instructionManualFilterGraphModal").modal('show');
                $("#graphTitle").text(graphTitle);
                $("#instructionManualFilterGraph").html("");
                var ctx = null;
                ctx = document.getElementById("instructionManualFilterGraph").getContext("2d");
                var chart = null;
                chart = new Chart(ctx,{
                    type:"line",
                    data: {
                        labels: response.data.labels.split(','),
                        datasets: [{
                            label: graphTitle,
                            backgroundColor: filterGraphColor,
                            borderColor: filterGraphColor,
                            data: response.data.data.split(',')
                        }]
                    },
                    options:{
                        scales:{
                            xAxes:[{
                                ticks: {
                                    // to tilt the xaxes labels
                                    maxRotation: 0,
                                    minRotation: 0,
                                    // to skip axces labels 
                                    callback: function(tick, index, array){
                                        return (index % 3) ? "" : tick;
                                    },
                                } 
                            }],
                            yAxes:[{
                                ticks: {
                                    beginAtZero : true,
                                }
                            }]
                        }
                    }
                });
            });
        });
        $("#instructionManualFilterGraphModal").on("hide",function(){
            alert();
        });
    });
    
    function editButtonClick(seq) {
        $("#id").val(seq);
        $("#form2").submit();
    }

    function loadGrid() {
        var actions = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#instructionManualLogGrid').jqxGrid('getrowdata', row);
            var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>";
            html += "<a href='javascript:editButtonClick(" + data['seq'] + ")' ><i class='fa fa-edit' title='Edit Instruction Manual Log'></i></a>";
            html += "</div>";
            return html;
        }
        var newRevisedCellRenderer = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#instructionManualLogGrid').jqxGrid('getrowdata', row);
            var html = "<div style='text-align: left; margin-top:4px;padding-left:4px'>"
			if(data['neworrevised'] == "newInstructionManual"){
				html += "New"; 
			}else if(data['neworrevised'] == "revisedInstructionManual"){
				html += "Revised"
			}else if(data['neworrevised'] == "revisedInternationInstructionManual"){
				html += "Revised-International"
			}else if(data['neworrevised'] == "newInternationInstructionManual"){
				html += "New-International"
			}else{
				html += "";
			}
           html += "</div>";
           return html;
        }
        var statusTypes = ["", "Not Started", "In Progress", "Awaiting Information From China", "Awaiting Information From Buyers", "In Review - Supervisor", "In Review - Manager", "In Review - Buyer", "Sent To China", "Cancelled", "Duplicate"];
        var columns = [
			{text: 'Edit',datafield: 'Actions',cellsrenderer: actions,width: '3%',filterable: false},
            {text: 'id',datafield: 'seq',hidden: true},
            {text: 'Completed',datafield: 'iscompleted',columntype: 'checkbox',width: "5%"},
            {text: 'New/Revised',datafield: 'neworrevised',cellsrenderer: newRevisedCellRenderer,width: "6%"},
            {text: 'Entered By', datafield: 'fullname',width:"10%"},
            {text: 'Item datafield',datafield: 'itemnumber',width: "10%"},
            {text: 'Class',datafield: 'classcode',width: "5%",filtercondition: 'STARTS_WITH'},
            {text: 'Entry Date',datafield: 'entrydate',filtertype: 'date',width: "8%",cellsformat: 'M-dd-yyyy'},
            {text: 'PO Ship Date',datafield: 'poshipdate',filtertype: 'date',width: "8%",cellsformat: 'M-dd-yyyy'},
            {text: 'IM Due Date',datafield: 'finalduedate',filtertype: 'date',width: "10%",cellsformat: 'M-dd-yyyy'},
            {text: 'Status',datafield: 'instructionmanuallogstatus',width: "20%",hidden: false,filtertype: 'checkedlist',filteritems: statusTypes,filtercondition: 'equal'},
            {text: 'Modified On',datafield: 'instructionmanuallogs.lastmodifiedon',filtertype: 'date',width: "12%",cellsformat: 'M-dd-yyyy hh:mm tt'}
        ]

        source = {
            datatype: "json",
            id: 'seq',
            pagesize: 20,
            sortcolumn: 'instructionmanuallogs.lastmodifiedon',
            sortdirection: 'desc',
            datafields: [
				{name: 'id',type: 'integer'},
                {name: 'seq',type: 'integer'},
                {name: 'fullname', type: 'string' },
                {name: 'itemnumber',type: 'string'},
                {name: 'classcode',type: 'string'},
                {name: 'entrydate',type: 'date'},
                {name: 'poshipdate',type: 'date'},
                {name: 'finalduedate',type: 'date'},
                {name: 'instructionmanuallogstatus',type: 'string'},
                {name: 'iscompleted',type: 'boolean'},
                {name: 'neworrevised',type: 'string'},
                {name: 'instructionmanuallogs.lastmodifiedon',type: 'date'},
            ],
            url: '',
            root: 'Rows',
            cache: false,
            beforeprocessing: function(data) {
                source.totalrecords = data.TotalRows;
            },
            filter: function() {
                $("#instructionManualLogGrid").jqxGrid('updatebounddata', 'filter');
            },
            sort: function() {
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
                var importButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'>Import</span></div>");
                var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
                var reloadButton = $("<div title='Reload' alt='Reload' style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
                var deleteButton = $("<div title='Delete' alt='Delete' style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");

                container.append(addButton);
                container.append(importButton);
                container.append(exportButton);
                container.append(reloadButton);
                container.append(deleteButton);
                statusbar.append(container);
                addButton.jqxButton({
                    width: 65,
                    height: 18
                });
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
                deleteButton.jqxButton({
                    width: 65,
                    height: 18
                });
                addButton.click(function(event) {
                    location.href = ("adminCreateInstructionManualLogs.php");
                });
                deleteButton.click(function(event) {
                	deleteRows("instructionManualLogGrid","Actions/InstructionManualLogsAction.php?call=deleteInstructionManualLog");
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
        $('#instructionManualLogGrid').on('rowselect', function(event) {
			var args = event.args;
			var rowBoundIndex = args.rowindex;
			var rowData = args.row;
			selectedRows[rowBoundIndex] = rowData;
        });
        $('#instructionManualLogGrid').on('rowunselect', function(event) {
			var args = event.args;
			var rowBoundIndex = args.rowindex;
			delete selectedRows[rowBoundIndex];
		});
    }
    function exportItemsConfirm(filterString) {
		var selectedRowIndexes = $("#instructionManualLogGrid").jqxGrid('selectedrowindexes');
		$('#exportModalFormForInstructionManualLogs').modal('show');
		$("#queryStringForInstructionManualLog").val(filterString);
	}
    function exportFinal(e, btn) {
		var exportOption = $('input[name=exportOptionForInstructionManualLogs]:checked').val()
		var rowscount = 0;
		var limit = <?php echo $exportLimit ?>;
		if (exportOption == "selectedRows") {
			var selectedRowIndexes = $("#instructionManualLogGrid").jqxGrid('selectedrowindexes');
			if (selectedRowIndexes.length > 0) {} else {
				noRowSelectedAlert();
				return;
			}
			rowscount = selectedRowIndexes.length;
			if (rowscount > limit) {
				bootbox.alert("Cannot export more than <?php echo $exportLimit ?> rows!", function() {});
				return;
			}
			var ids = [];
			$.each(selectedRowIndexes, function(index, value) {
				if (value != -1) {
					var dataRow = selectedRows[value] //$("#instructionManualLogGrid").jqxGrid('getrowdata', value);
					ids.push(dataRow.seq);
				}
			});
			$("#instructionmanuallogseq").val(ids);


		} else {
			var datainformation = $('#instructionManualLogGrid').jqxGrid('getdatainformation');
			rowscount = datainformation.rowscount;
			$("#instructionmanuallogseq").val("");
		}
		e.preventDefault();
		var l = Ladda.create(btn);
		l.start();
		$('#exportFormForInstructionManualLog').submit();
		l.stop();
		$('#exportFormForInstructionManualLog').modal('hide');
		$('#instructionManualLogGrid').jqxGrid('clearselection');
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
					} else if (key.includes("thirty_days")) {//graph case
						if(value != ""){
    						var graph = new Rickshaw.Graph( {
    					        element: document.querySelector("#"+key),
    					        height:'50',
    					        width:'180',
    					        series: [{
    						        color: '#1ab394',
    					            data: value,
    					        }]
    					    });
    						var barElement = document.getElementById(key); 
    						var resize = function () {
        						graph.configure({
            						width: barElement.clientWidth, //html is "auto-magically" rendering size
            						height: barElement.clientHeight //leverage this for precise re-size scalling
        						});
        						graph.render();
    						}
    						window.addEventListener('resize', resize);
    						resize();
						}
					} else {
						$("#" + key).text(value);
					}
				});
			});
    }
        
</script>