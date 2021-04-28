<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] . "Utils/SessionUtil.php");
$sessionUtil = SessionUtil::getInstance();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Project Types</title>
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script> -->
</head>

<body>
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
                                    <h4 class="p-h-sm font-normal">Manage Project Types</h4>
                                </nav>
                            </div>
                            <div class="ibox-content">
                                <div id="requestFieldsGrid"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form2" name="form2" method="post" action="adminCreateRequestType.php" target='_self'>
        <input type="hidden" id="id" name="id" />
    </form>
</body>
<script type="text/javascript">
    var source;
    $(document).ready(function() {
        loadGrid();
    });
    function loadGrid() {
        var actions = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#requestFieldsGrid').jqxGrid('getrowdata', row);
            var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>";
            html += "<a href='javascript:editButtonClick(" + data['seq'] + ")' ><i class='fa fa-edit' title='Edit Requests Fields'></i></a>";
            html += "</div>";
            return html;
        }
        var columns = [{
                text: 'Edit',
                datafield: 'Actions',
                cellsrenderer: actions,
                width: '3%',
                filterable: false
            },
            {
                text: 'id',
                datafield: 'seq',
                hidden: true
            },
            {
                text: 'Departments',
                datafield: 'departmenttitle',
                width: "22%"
            },
            {
                text: 'Request Title',
                datafield: 'title',
                width: "22%"
            },
            {
                text: 'Request Type Code',
                datafield: 'requesttypecode',
                width:"10%"
            },
            {
                text: 'Created   By',
                datafield: 'createdbyfullname',
                width: "17%"
            },
            {
                text: 'Created On',
                datafield: 'createdon',
                filtertype: 'date',
                width: "12%",
                cellsformat: 'M-dd-yyyy hh:mm tt'
            },
            {
                text: 'Modified On',
                datafield: 'lastmodifiedon',
                filtertype: 'date',
                width: "12%",
                cellsformat: 'M-dd-yyyy hh:mm tt'
            }
        ]

        source = {
            datatype: "json",
            id: 'seq',
            pagesize: 20,
            sortcolumn: 'lastmodifiedon',
            sortdirection: 'desc',
            datafields: [{
                    name: 'id',
                    type: 'integer'
                },
                {
                    name: 'seq',
                    type: 'integer'
                },
                {
                    name: 'departmenttitle',
                    type: 'string'
                },
                {
                    name: 'title',
                    type: 'string'
                },
                {
                    name: 'createdbyfullname',
                    type: 'string'
                },
                {
                    name: 'requesttypecode',
                    type: 'string'
                },
                {
                    name: 'createdon',
                    type: 'date'
                },
                {
                    name: 'lastmodifiedon',
                    type: 'date'
                },
            ],
            url: 'Actions/RequestTypeAction.php?call=getAllRequestTypesForGrid',
            root: 'Rows',
            cache: false,
            beforeprocessing: function(data) {
                source.totalrecords = data.TotalRows;
            },
            filter: function() {
                $("#requestFieldsGrid").jqxGrid('updatebounddata', 'filter');
            },
            sort: function() {
                $("#requestFieldsGrid").jqxGrid('updatebounddata', 'sort');
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
        $("#requestFieldsGrid").jqxGrid({
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
            ready: function() {},
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
                    location.href = ("adminCreateRequestType.php");
                });
                deleteButton.click(function(event) {
                    deleteRows("requestFieldsGrid", "Actions/");
                });
                importButton.click(function(event) {
                    location.href = ("adminImportInstructionManualLogs.php");
                });
                exportButton.click(function(event) {
                    filterQstr = getFilterString("requestFieldsGrid");
                    exportItemsConfirm(filterQstr);
                });
                reloadButton.click(function(event) {
                    $("#requestFieldsGrid").jqxGrid("clearfilters");
                });
                $("#requestFieldsGrid").bind('rowselect', function(event) {
                    var selectedRowIndex = event.args.rowindex;
                    var pageSize = event.args.owner.rows.records.length - 1;
                    if ($.isArray(selectedRowIndex)) {
                        if (isSelectAll) {
                            isSelectAll = false;
                        } else {
                            isSelectAll = true;
                        }
                        $('#requestFieldsGrid').jqxGrid('clearselection');
                        if (isSelectAll) {
                            for (i = 0; i <= pageSize; i++) {
                                var index = $('#requestFieldsGrid').jqxGrid('getrowboundindex', i);
                                $('#requestFieldsGrid').jqxGrid('selectrow', index);
                            }
                        }
                    }
                });
            }
        });
        $('#requestFieldsGrid').on('rowselect', function(event) {
            var args = event.args;
            var rowBoundIndex = args.rowindex;
            var rowData = args.row;
            selectedRows[rowBoundIndex] = rowData;
        });
        $('#requestFieldsGrid').on('rowunselect', function(event) {
            var args = event.args;
            var rowBoundIndex = args.rowindex;
            delete selectedRows[rowBoundIndex];
        });
    }
    function editButtonClick(seq) {
        $("#id").val(seq);
        $("#form2").submit();
    }
</script>