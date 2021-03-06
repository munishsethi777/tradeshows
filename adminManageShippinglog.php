<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] . "Utils/SessionUtil.php");
//require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] . "Utils/PermissionUtil.php");
require_once($ConstantsArray['dbServerUrl'] . "Managers/ShippinglogMgr.php");

$sessionUtil = SessionUtil::getInstance();
$isSessionAdmin = $sessionUtil->isSessionAdmin();
$permissionUtil = PermissionUtil::getInstance();
//$hasQcPlannerButtonPermission = $permissionUtil->hasQCPlannerButtonPermission() || $isSessionAdmin;
$hasWeeklyReportButtonPermission = $permissionUtil->hasWeeklyMailButtonPermission() || $isSessionAdmin;
//$hasQCReadonly = $permissionUtil->hasQCReadonly();
//$exportLimit = ExportUtil::$EXPORT_ROW_LIMIT;
//$qcscheduleseq = "";

/*$QcscheduleApprovals = "";
$QcQcscheduleApprovalMgr= QcscheduleApprovalMgr::getInstance();
$QcscheduleApprovals = $QcQcscheduleApprovalMgr->getQcScheduleApproval(5800);*/



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Shippinglog</title>
    <?include "ScriptsInclude.php"?>
    <style type="text/css">
        .itemDetailsModalDiv .lblDesc {
            font-weight: 500 !important;
        }

        .form-group {
            margin-bottom: 5px;
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
    <div id="wrapper">
        <?php
        include("adminmenuInclude.php"); ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                    <h4 class="p-h-sm font-normal">Manage Shippinglog</h4>
                                </nav>
                            </div>
                            <div class="ibox-content">
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <select id="fieldNameDD" name="fieldNameDD" class="form-control">
                                            <option value=''>Select Field</option>
                                            <option value="shipdate">Ship Date</option>
                                            <option value="latestshipdate">Latest Ship Date</option>
                                            <optgroup label="Schedule Dates">
                                                <option value="scproductionstartdate">Scheduled Production Start</option>
                                                <option value="scgraphicsreceivedate">Scheduled Graphics Receive</option>
                                                <option value="scfirstinspectiondate">Scheduled First Inspection</option>
                                                <option value="scmiddleinspectiondate">Scheduled Middle Inspection</option>
                                                <option value="scfinalinspectiondate">Scheduled Final Inspection</option>
                                                <option value="screadydate">Scheduled Ready</option>
                                            </optgroup>
                                            <optgroup label="Appointment Dates">
                                                <option value="approductionstartdate">Appointment Production Start</option>
                                                <option value="apgraphicsreceivedate">Appointment Graphics Receive</option>
                                                <option value="apfirstinspectiondate">Appointment First Inspection</option>
                                                <option value="apmiddleinspectiondate">Appointment Middle Inspection</option>
                                                <option value="apfinalinspectiondate">Appointment Final Inspection</option>
                                                <option value="apreadydate">Appointment Ready</option>
                                            </optgroup>
                                            <optgroup label="Actual Dates">
                                                <option value="acproductionstartdate">Actual Production Start</option>
                                                <option value="acgraphicsreceivedate">Actual Graphics Receive</option>
                                                <option value="acfirstinspectiondate">Actual First Inspection</option>
                                                <option value="acmiddleinspectiondate">Actual Middle Inspection</option>
                                                <option value="acfinalinspectiondate">Actual Final Inspection</option>
                                                <option value="acreadydate">Actual Ready</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <div id="daterange" style="display:none;background: #fff; cursor: pointer; padding: 5px 5px; border: 1px solid #ccc; width: 100%">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 pull-right">
                                        <select id="iscompletedDD" name="iscompletedDD" class="form-control">
                                            <option value="all">All</option>
                                            <option value="1">Completed</option>
                                            <option value="0">Incompleted</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2" style="display:none">
                                        <select id="approvalstatus" name="approvalstatus" class="form-control">
                                            <option value="all">All</option>
                                            <option value="approved">Approved</option>
                                            <option value="pending">Pending</option>
                                            <option value="open">Open</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="shippinglogGrid"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form1" name="form1" method="GET" action="Actions/ShippinglogAction.php">
        <input type="hidden" id="call" name="call" value="export" />
    </form>
    <form id="form2" name="form2" method="post" action="adminCreateShippinglog.php" target='_blank'>
        <input type="hidden" id="id" name="id" />
        <input type="hidden" id="itemnumbers" name="itemnumbers" />
        <input type="hidden" id="seq" name="seq" />
    </form>
    <form id="form3" name="form3" method="post" action="Actions/ShippinglogAction.php">
        <input type="hidden" id="call" name="call" value="exportPlanner" />
        <input type="hidden" id="isCompleted" name="isCompleted" value="1" />
    </form>
    <?include "exportInclude.php"?>
    <!-- <div class="modal inmodal bs-example-modal-lg" id="updateQCScheduleApprovalModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Approve/Reject QC Schedule</h4>
                </div>
                <div class="modal-body updateQCScheduleApprovalModalDiv mainDiv">
                    <div class="ibox">
                        <!--              <div class="ibox-content">
                        <form id="updateQCScheduleApprovalForm" method="post" action="Actions/QcscheduleApprovalAction.php" class="m-t-lg">
                            <input type="hidden" id="call" name="call" value="updateApprovalStatus" />
                            <input type="hidden" id="approvalSeq" name="approvalSeq" />
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">QC:</label>
                                <label class="col-lg-4 col-form-label" id="modalQcLabel"></label>
                                <label class="col-lg-2 col-form-label bg-formLabel">Poincharge:</label>
                                <label class="col-lg-4 col-form-label" id="modalPoInchargeLabel"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Class Code:</label>
                                <label class="col-lg-4 col-form-label" id="modalCodeLabel"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">PO </label>
                                <label class="col-lg-4 col-form-label" id="modalPoLabel"></label>

                                <label class="col-lg-2 col-form-label bg-formLabel">ITEM NO </label>
                                <label class="col-lg-4 col-form-label" id="modalItemnumberLabel"></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Status</label>
                                <div class="col-lg-6">
                                    <select id="approvalStatusDD" name="approvalStatusDD" class="form-control">
                                        <option id="pending">Pending</option>
                                        <option id="approved">Approved</option>
                                        <option id="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label bg-formLabel">Comments</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="comments" id="comment"></textarea>
                                </div>
                            </div>
                            <div id="earlierApprovals" style="margin-top:10px"></div>
                            <div class="modal-footer">
                                <?php //if (!$hasQCReadonly) { ?>
                                    <button class="btn btn-primary" data-style="expand-right" id="updateApprovalStatusBtn" type="button">
                                        <span class="ladda-label">Submit</span>
                                    </button>
                                <?php //} ?>
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                        <!--              </div> -->
                    </div>
                </div>
            </div>
        </div> -->

</body>
<script type="text/javascript">
    function initDateRanges() {
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#daterange').daterangepicker({
            startDate: start,
            endDate: end,
            alwaysShowCalendars: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Next 7 Days': [moment(), moment().add(6, 'days')],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'Next 30 Days': [moment(), moment().add(29, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
            }
        }, cb);

        cb(start, end);
    }
    $(document).ready(function() {
        // function updateApprovalStatus() {
        //     if ($("#updateQCScheduleApprovalForm")[0].checkValidity()) {
        //         showHideProgress()
        //         $('#updateQCScheduleApprovalForm').ajaxSubmit(function(data) {
        //             showHideProgress();
        //             var flag = showResponseToastr(data, "updateQCScheduleApprovalModal", "updateQCScheduleApprovalForm", "ibox");
        //             if (flag) {
        //                 $('#itemDetailsModal').modal('hide');
        //                 window.setTimeout(function() {
        //                     window.location.href = "adminManageQCSchedules.php"
        //                 }, 100);
        //             }
        //         })
        //     } else {
        //         $("#createQCScheduleForm")[0].reportValidity();
        //     }
        // }
        // $("#updateApprovalStatusBtn").click(function(e) {
        //     updateApprovalStatus()
        // });
        loadGrid();
        initDateRanges();
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        var applyFilter = function() {
            var addedFilterFields = [];
            var existingFilter = $('#shippinglogGrid').jqxGrid('getfilterinformation')
            var datafield = $("#fieldNameDD").val();
            $("#shippinglogGrid").jqxGrid('clearfilters');
            //if(datafield != ''){
            showFilterFieldColumn();
            $("#shippinglogGrid").jqxGrid('clear');
            var filtertype = 'stringfilter';
            var conditionDDVal = $("#conditionDD").val();
            filtertype = 'datefilter';
            var filterData = getFilterQueryData();
            var isCompleted = 0;
            $.each(filterData, function(key, value) {
                var fieldName = key;
                var filtergroup = new $.jqx.filter();
                if (value != null && value != "" && value != "all") {
                    $.each(value, function(k, v) {
                        var filter_or_operator = 0;
                        var filtervalue = v;
                        var filtercondition = 'less_than_or_equal';
                        if (k == "completedStatus") {
                            if (value.completedStatus == "all") {
                                return;
                            }
                            filtergroup = new $.jqx.filter();
                            filtertype = 'stringfilter';
                            filtercondition = 'EQUAL';
                            filter_or_operator = 0;
                            fieldName = "iscompleted";
                        } else if (k == "from") {
                            var filtercondition = 'greater_than_or_equal';
                        } else if (k == "naReason") {
                            filtergroup = new $.jqx.filter();
                            filtertype = 'stringfilter';
                            fieldName = v;
                            if (isCompleted > 0) {
                                filtercondition = 'not_null';
                            } else {
                                filtercondition = 'null';
                            }
                            filter_or_operator = 1;
                        }
                        var filter = filtergroup.createfilter(filtertype, filtervalue, filtercondition);
                        filtergroup.addfilter(filter_or_operator, filter);

                        $("#shippinglogGrid").jqxGrid('addfilter', fieldName, filtergroup);
                        // add the filters.
                    });

                }
            });
            // apply the filters.
            $("#shippinglogGrid").jqxGrid('applyfilters');
            //}
            //$("#approvalStatusDD").chosen({rtl: true}); 
        }

        // applies the filter.
        $("#fieldNameDD").change(function() {
            var datafield = $("#fieldNameDD").val();
            if (datafield == "") {
                $("#daterange").hide();
            } else {
                $("#daterange").show();
            }
            $('#isCompleted').removeAttr('checked');
            $('#isCompleted').iCheck('uncheck')
            if (datafield.substr(0, 2) == "sc" || datafield.substr(0, 2) == "ap") {
                $(".taskCompleted").show();
            } else {
                //$(".taskCompleted").hide();
                $(".taskCompleted").show();
            }
            applyFilter()
        });
        $("#conditionDD").change(function() {
            applyFilter()
        });
        $("#iscompletedDD").change(function() {
            applyFilter()
        });
        $("#valueDD").change(function() {
            applyFilter()
        });
        $("#isCompleted").change(function() {
            applyFilter()
        });
        $('.i-checks').on('ifChanged', function(event) {
            applyFilter()
        });
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            applyFilter();
        });
        $("#exportBtn").click(function(e) {
            exportFinal(e, this);
        });
    });

    function getFilterQueryData() {
        var datafield = $("#fieldNameDD").val()

        //$('#qcscheduleGrid').jqxGrid('showcolumn', datafield);
        var textData = new Array();
        var cols = $("#shippinglogGrid").jqxGrid("columns");
        for (var i = 0; i < cols.records.length; i++) {
            textData[i] = cols.records[i].text;
        }


        var conditionDD = $("#conditionDD").val();
        var completedDD = $("#iscompletedDD").val();
        var dayValue = $("#valueDD").val();
        var isCompletedCheck = $("input[type='checkbox'][name='isCompleted']:checked").val()
        var isCompleted = 0;
        if (isCompletedCheck == "on") {
            isCompleted = 1
        }
        var fromDate = new Date();
        var toDate = new Date();
        if (conditionDD == "past") {
            fromDate = subtractDays(fromDate, dayValue);
        } else {
            toDate = addDays(toDate, dayValue);
        }
        var fromDateStr = dateToStr(fromDate);
        var toDateStr = dateToStr(toDate);

        //new code of daterange picker
        var drp = $('#daterange').data('daterangepicker');
        fromDateStr = drp.startDate.format('MM-DD-YYYY');
        toDateStr = drp.endDate.format('MM-DD-YYYY');

        var data = {
            from: fromDateStr,
            to: toDateStr
        };
        isScheduleFeild = datafield.startsWith("sc")
        isAPFeild = datafield.startsWith("ap")
        var dataArr = {};
        if (isScheduleFeild || isAPFeild) {
            var naReason = "";
            if (datafield.indexOf("middle") != -1) {
                naReason = "apmiddleinspectiondatenareason";
            } else if (datafield.indexOf("first") != -1) {
                naReason = "apfirstinspectiondatenareason";
            }
            data = {
                from: fromDateStr,
                to: toDateStr,
                completedStatus: completedDD
            }
            //data = {from:fromDateStr,to:toDateStr,isCompleted:isCompleted,completedStatus:completedDD}
            if (naReason != "") {
                //data = {from:fromDateStr,to:toDateStr,isCompleted:isCompleted,naReason:naReason,completedStatus:completedDD}
                data = {
                    from: fromDateStr,
                    to: toDateStr,
                    naReason: naReason,
                    completedStatus: completedDD
                }
            }
        }
        if (completedDD != "all") {
            dataArr['completedStatus'] = {
                completedStatus: completedDD
            };
        }
        dataArr[datafield] = data;
        return dataArr
    }

    function showFilterFieldColumn() {
        var cols = $("#shippinglogGrid").jqxGrid("columns");
        for (var i = 0; i < cols.records.length; i++) {
            if (cols.records[i].datafield.substr(0, 2) == "sc" ||
                cols.records[i].datafield.substr(0, 2) == "ac" ||
                cols.records[i].datafield.substr(0, 2) == "ap") {
                //if(cols.records[i].hidden == true){
                $('#shippinglogGrid').jqxGrid('hidecolumn', cols.records[i].datafield);
            }
        }
        var datafield = $("#fieldNameDD").val()
        $('#shippinglogGrid').jqxGrid('showcolumn', datafield);

    }

    function editShow(seq) {
        $("#id").val(seq);
        $("#form1").submit();
    }

    function showApprovalModel(qcscheduleSeq, isDisabled) {
        if (isDisabled == 1) {
            $('#comment').attr("disabled", true);
            $('#approvalStatusDD').attr("disabled", true);
            $('#updateApprovalStatusBtn').attr("disabled", true);
        }
        // $.get("Actions/QcscheduleApprovalAction.php?call=getQCSchedules" + "&qcscheduleseq=" + qcscheduleSeq, function(data) {
        //     arr = $.parseJSON(data);
        //     var html = '<h3>Earlier Requests</h3><table class="table table-striped"><tr><th>Applied by</th><th>QC</th><th>Response</th><th>Applied On</th><th>Responded On</th><th>Comments</th></tr>';
        //     var tablerows = "";
        //     if (arr.length > 0) {
        //         var approvalInfo = arr[0];
        //         $('#comment').val(approvalInfo.responsecomments);
        //         $('#approvalStatusDD').val(approvalInfo.responsetype);
        //         $("#modalQcLabel").text(approvalInfo.qc);
        //         $("#modalPoInchargeLabel").text(approvalInfo.poincharge);
        //         $("#modalCodeLabel").text(approvalInfo.classcode);
        //         $("#modalPoLabel").text(approvalInfo.po);
        //         $("#modalItemnumberLabel").text(approvalInfo.itemnumbers);
        //         $("#approvalSeq").val(approvalInfo.seq);
        //         // arr.shift()
        //         var flag = false;
        //         $.each(arr, function(key, value) {
        //             flag = true;
        //             qcCode = value["qccode"];
        //             if (value["qccode"] == null) {
        //                 qcCode = "n.a";
        //             }
        //             respondedon = value["respondedon"];
        //             if (value["respondedon"] == null) {
        //                 respondedon = "n.a";
        //             }
        //             tablerows += "<tr class='tabRows'><td>" + value["fullname"] + "</td><td>" + qcCode + "</td><td>" + value["responsetype"] + "</td><td>" + value["appliedon"] + "</td><td>" + respondedon + "</td><td>" + value["responsecomments"] + "</td></tr>";
        //         });
        //         if (flag) {
        //             html += tablerows;
        //             $("#earlierApprovals").html(html);
        //         }
        //         $("#updateQCScheduleApprovalModal").modal('show');
        //     }
        // });
    }
    var state;
    var isSelectAll = false;
    var selectedRows = [];
    // var seqs = [];
    // var itemIds = [];
    // function editButtonClick(seq,itemid){
    // 	$("#id").val(seq);  
    //     $("#seqs").val(seq);   
    //     $("#itemnumbers").val(itemid);
    //     $("#form2").attr('action', 'adminCreateQCSchedule.php');                         
    //     $("#form2").submit(); 
    // }
    function loadGrid() {
        var actions = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#shippinglogGrid').jqxGrid('getrowdata', row);
            // var qc = data["qccode"];
            // var poincharge = data["poincharge"];
            // var po = data["pocode"];
            // var code = data["classcode"];
            // var po = data["po"];
            // var itemno = data["itemnumbers"];
            // var qcscheduleseq = data["seq"];

            if (responseComments == null) {
                responseComments = "";
            }
            var isSV = data["isSv"];
            var html = "<div style='text-align: center; margin-top:1px;font-size:12px'>"
            var isDisable = 1;
            if (isSV) {
                isDisable = 0;
            }
            if (responseType != null) {
                html += "<a title='" + responseComments + "' href='javascript:showApprovalModel(" + data['seq'] + "," + isDisable + ")'>" + responseType + "</a>";
            }
            html += "</div>";
            return html;
        }

        var renderCompletedColumn = function(row, columnfield, value, defaulthtml, columnproperties) {
            data = $('#shippinglogGrid').jqxGrid('getrowdata', row);
            var isCompleted = data["iscompleted"];
            if (isCompleted) {
                return '<div title="Completed" alt="Completed" style="text-align:left;color:#19aa8d;padding-bottom: 2px; margin-right: 2px; margin-left: 4px; margin-top: 7px;"><i style="font-size:16px" class="fa fa-check"></i></div>';
            } else {
                return '<div title="Incompleted" alt="Incompleted" style="text-align:left;color:red;padding-bottom: 2px; margin-right: 2px; margin-left: 4px; margin-top: 7px;"><i style="font-size:16px" class="fa fa-square-o"></i></div>';
            }
        }

        // var editrow = function (row, columnfield, value, defaulthtml, columnproperties) {
        //     data = $('#qcscheduleGrid').jqxGrid('getrowdata', row);
        // 	itemIds.push(data['itemnumbers']);
        // 	var html = "<div style='text-align: center; margin-top:1px;font-size:18px'>"
        //         	html +="<a href='javascript:editButtonClick("+ data['seq'] + ",\"" + data['itemnumbers'] +"\")' ><i class='fa fa-edit' title='Edit QC Schedules'></i></a>";
        //         html += "</div>";
        //     return html;
        // }
        var columns = [{
                text: 'id',
                datafield: 'seq',
                hidden: true
            },
            
            {
                text: 'Order Issue',
                datafield: 'orderissue',
                filtertype: 'date',
                cellsformat: 'M-d-yyyy',
                width: "10%"
            },
            {
                text: 'Customer Name',
                datafield: 'customername',
                width: "15%"
            },
            {
                text: 'Batch Number',
                datafield: 'batchno',
                width: "15%"
            },
            {
                text: 'Entered By',
                datafield: 'enteredby',
                width: "15%"
            },
            {
                text: 'Business',
                datafield: 'business',
                width: "12%"
            },
            {
                text: 'Is Edi',
                datafield: 'isedi',
                width: "12%",
                columntype:'checkbox'
            },
            {
                text: 'Modified On',
                datafield: 'lastmodifiedon',
                filtertype: 'date',
                cellsformat: 'M-d-yyyy hh:mm tt',
                width: "15%"
            },
        ]

        var source = {
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
                    name: 'orderissue',
                    type: 'date'
                },
                {
                    name: 'customername',
                    type: 'string'
                },
                {
                    name: 'batchno',
                    type: 'string'
                },
                {
                    name: 'enteredby',
                    type: 'string'
                },
                {
                    name: 'business',
                    type: 'string'
                },
                {
                    name: 'isedi',
                    type: 'boolean'
                },
                {
                    name: 'createdon',
                    type: 'date'
                },
                {
                    name: 'lastmodifiedon',
                    type: 'date'
                }
            ],
            url: 'Actions/ShippinglogAction.php?call=getAllShippinglogs',
            root: 'Rows',
            cache: false,
            beforeprocessing: function(data) {
                source.totalrecords = data.TotalRows;
            },
            filter: function() {
                // update the grid and send a request to the server.
                $("#shippinglogGrid").jqxGrid('updatebounddata', 'filter');
            },
            sort: function() {
                // update the grid and send a request to the server.
                $("#shippinglogGrid").jqxGrid('updatebounddata', 'sort');
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
        $("#shippinglogGrid").jqxGrid({
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
            showtoolbar: true,
            virtualmode: true,
            rendergridrows: function(toolbar) {
                return dataAdapter.records;
            },
            renderstatusbar: function(statusbar) {
                var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                var addButton = $("<div title='Add' alt='Add' style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>Add</span></div>");
                var editButton = $("<div title='Edit' style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                //var bulkEditButton = $("<div title='Bulk Edit' style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Bulk Edit</span></div>");
                //var importButton = $("<div title='Import Data' alt='Import Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'></span></div>");
                //var importCompletedButton = $("<div title='Import Completed Data' alt='Import Completed Data' style='float: left; margin-left: 5px;'><i class='fa fa-upload'></i><span style='margin-left: 4px; position: relative;'></span></div>");
                //var exportButton = $("<div title='Export Data' alt='Export Data' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export</span></div>");
                var reloadButton = $("<div title='Reload Data' alt='Reload Data' style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
                //var downloadButton = $("<div title='Download Template' alt='Download Template' style='float: left; margin-left: 5px;'><i class='fa fa-download'></i><span style='margin-left: 4px; position: relative;'>Template</span></div>");
                var deleteButton = $("<div title='Delete' alt='Delete'  style='float: left; margin-left: 5px;'><i class='fa fa-remove'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                //var weeklyReportButton = $("<div title='Mail Weekly Report' alt='Mail Weekly Report' style='float: left; margin-left: 5px;'><i class='fa fa-send'></i><span style='margin-left: 4px; position: relative;'>Weekly Report</span></div>");
                //var exportPlannerButton = $("<div title='Export Planner Report' alt='Export Planner Report' style='float: left; margin-left: 5px;'><i class='fa fa-file-excel-o'></i><span style='margin-left: 4px; position: relative;'>Export Planner</span></div>");
                //var updateButton = $("<div title='Update ShipDates' alt='Update ShipDates' style='float: left; margin-left: 5px;'><i class='fa fa-truck'></i><span style='margin-left: 4px; position: relative;'></span></div>");

                
                container.append(addButton);
                
                container.append(editButton);
                

                //container.append(exportButton);
                container.append(reloadButton);
                container.append(deleteButton);


                //container.append(importButton);
                //container.append(importCompletedButton);
                //container.append(updateButton);
                
                statusbar.append(container);
                addButton.jqxButton({
                    width: 55,
                    height: 18
                });
                editButton.jqxButton({
                    width: 55,
                    height: 18
                });
                // bulkEditButton.jqxButton({
                //     width: 75,
                //     height: 18
                // });

                // <?php //if ($sessionUtil->isSessionAdmin()) { ?>
                //     importButton.jqxButton({
                //         width: 40,
                //         height: 18
                //     });
                //     //importCompletedButton.jqxButton({ width: 40, height: 18 });
                //     updateButton.jqxButton({
                //         width: 40,
                //         height: 18
                //     })
                // <?php //} ?>
                // exportButton.jqxButton({
                //     width: 65,
                //     height: 18
                // });
                reloadButton.jqxButton({
                    width: 70,
                    height: 18
                });
                //downloadButton.jqxButton({width:70, height: 18 });

                deleteButton.jqxButton({  width: 65, height: 18 });
                <?php //if ($hasWeeklyReportButtonPermission) { ?>
                    // weeklyReportButton.jqxButton({
                    //     width: 110,
                    //     height: 18
                    // });
                <?php //} ?>
                
                // create new row.
                addButton.click(function(event) {
                    location.href = ("adminCreateShippinglog.php");
                });
                // weeklyReportButton.click(function(event) {
                //     window.open('http://localhost:8080/tradeshows/Crons/PendingQCScheduleCron.php');
                // });
                editButton.click(function(event) {
                    var selectedrowindex = $("#shippinglogGrid").jqxGrid('selectedrowindexes');
                    if (selectedrowindex.length == 0) {
                        bootbox.alert("Please Select QC Schedule to edit.", function() {});
                        return;
                    }
                    var value = -1;
                    indexes = selectedrowindex.filter(function(item) {
                        return item !== value
                    })
                    var itemIds = [];
                    var seq = [];
                    var selectedPOs = [];
                    $.each(indexes, function(index, value) {
                        var row = $('#shippinglogGrid').jqxGrid('getrowdata', value);
                        selectedPOs.push(row.po);
                        seq.push(row.id);
                        itemIds.push(row.itemnumbers);
                    });
                    selectedPOs = removeDuplicates(selectedPOs);
                    if (selectedPOs.length > 1) {
                        bootbox.alert("Please Select single row to edit.", function() {});
                        isValid = false;
                        return;
                    }
                    var row = $('#shippinglogGrid').jqxGrid('getrowdata', indexes);
                    $("#id").val(seq[0]);
                    $("#seq").val(seq);
                    $("#itemnumbers").val(itemIds);
                    $("#form2").attr('action', 'adminCreateShippinglog.php');
                    $("#form2").submit();
                });
                
                // updateButton.click(function(event) {
                //     location.href = ("adminUpdateShippinglog.php");
                // });
                // delete row.
                     deleteButton.click(function (event) {
                       gridId = "shippinglogGrid";
                       deleteUrl = "Actions/ShippinglogAction.php?call=deleteShippinglog";
                       deleteQCSchedule(gridId,deleteUrl);
                   });
                // importButton.click(function(event) {
                //     location.href = ("adminImportQCSchedules.php");
                // });
                // importCompletedButton.click(function (event) {
                // 	importCompeleted();
                // });
                // exportButton.click(function(event) {
                //     filterQstr = getFilterString("shippinglogGrid");
                //     exportItemsConfirm(filterQstr);
                // });
                // exportPlannerButton.click(function(event) {
                //     exportPlanner();
                // });
                // reload grid data.
                reloadButton.click(function(event) {
                    $("#shippinglogGrid").jqxGrid("clearfilters");
                    $('#fieldNameDD').prop('selectedIndex', 0);
                    initDateRanges();
                    $('#isCompleted').removeAttr('checked');
                    $(".taskCompleted").hide()
                });
                //downloadButton.click(function (event) {
                //location.href = ("files/QCSchedules_template.xlsx");
                //});
                $("#shippinglogGrid").bind('rowselect', function(event) {
                    var selectedRowIndex = event.args.rowindex;
                    var pageSize = event.args.owner.rows.records.length - 1;
                    if ($.isArray(selectedRowIndex)) {
                        if (isSelectAll) {
                            isSelectAll = false;
                        } else {
                            isSelectAll = true;
                        }
                        $('#shippinglogGrid').jqxGrid('clearselection');
                        if (isSelectAll) {
                            for (i = 0; i <= pageSize; i++) {
                                var index = $('#shippinglogGrid').jqxGrid('getrowboundindex', i);
                                $('#shippinglogGrid').jqxGrid('selectrow', index);
                            }
                        }
                    }
                });
            }
        });

        function removeDuplicates(arr) {
            let outputArray = arr.filter(function(v, i, self) {
                return i == self.indexOf(v);
            });
            return outputArray;
        }
        $('#shippinglogGrid').on('rowselect', function(event) {
            var args = event.args;
            var rowBoundIndex = args.rowindex;
            var rowData = args.row;
            selectedRows[rowBoundIndex] = rowData;
        });
        $('#shippinglogGrid').on('rowunselect', function(event) {
            var args = event.args;
            var rowBoundIndex = args.rowindex;
            delete selectedRows[rowBoundIndex];
        });
    }

    function exportFinal(e, btn) {
        var exportOption = $('input[name=exportOption]:checked').val()
        var rowscount = 0;
        //var limit = <?php //echo $exportLimit ?>;
        if (exportOption == "selectedRows") {
            var selectedRowIndexes = $("#shippinglogGrid").jqxGrid('selectedrowindexes');
            if (selectedRowIndexes.length > 0) {} else {
                noRowSelectedAlert();
                return;
            }
            rowscount = selectedRowIndexes.length;
            if (rowscount > limit) {
                bootbox.alert("Cannot export more than rows!", function() {});
                return;
            }
            var ids = [];
            $.each(selectedRowIndexes, function(index, value) {
                if (value != -1) {
                    var dataRow = selectedRows[value] //$("#qcscheduleGrid").jqxGrid('getrowdata', value);
                    ids.push(dataRow.id);
                }
            });
            $("#shippinglogseq").val(ids);


        } else {
            var datainformation = $('#shippinglogGrid').jqxGrid('getdatainformation');
            rowscount = datainformation.rowscount;
            $("#shippinglogseq").val("");
            if (rowscount > limit) {
                bootbox.alert("Cannot export more than <?php //echo $exportLimit ?> rows!", function() {});
                return;
            }
        }
        e.preventDefault();
        var l = Ladda.create(btn);
        l.start();
        //$('#exportForm').submit();
        l.stop();
        $('#exportModalForm').modal('hide');
        $('#shippinglogGrid').jqxGrid('clearselection');
    }

    function exportItemsConfirm(filterString) {
        var selectedRowIndexes = $("#shippinglogGrid").jqxGrid('selectedrowindexes');
        $('#exportModalForm').modal('show');
        $("#queryString").val(filterString);
    }

    function exportItems(filterString) {
        $("#queryString").val(filterString);
        $("#form1").submit();
    }

    function exportPlanner() {
        $("#form3").attr("action", "Actions/ShippinglogAction.php");
        $("#form3 #call").val("exportPlanner");
        $("#form3").submit();
    }

    function importCompeleted() {
        $("#form3").attr("action", "adminImportShippinglog.php");
        $("#form3 #call").val("");
        $("#form3").submit();
    }

    function dateToStr(date) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1;
        var yyyy = date.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        var dateStr = mm + '-' + dd + '-' + yyyy;
        return dateStr;
    }

    function addDays(date, days) {
        days = parseInt(days);
        date.setDate(date.getDate() + days);
        return date;
    }

    function subtractDays(date, days) {
        var sDate = date;
        sDate.setDate(sDate.getDate() - days);
        return sDate;
    }
    function deleteQCSchedule(gridId,deleteURL){
        var selectedRowIndexes = $("#" + gridId).jqxGrid('selectedrowindexes');
        if(selectedRowIndexes.length > 0){
            bootbox.confirm("Are you sure you want to delete selected row(s)?", function(result) {
                if(result){
                    var ids = [];
                    var po = [];
                    $.each(selectedRowIndexes, function(index , value){
                        if(value != -1){
                            var dataRow = $("#" + gridId).jqxGrid('getrowdata', value);
                            if(dataRow != undefined){
                                if(dataRow.id != undefined){
                                	ids.push(dataRow.id);
                                 }else{
                                	ids.push(dataRow.seq); 
                                }
                                po.push(dataRow.po);
                            }
                        }

                    });
                    $.get( deleteURL + "&seqs=" + ids + "&po=" + po,function( data ){
                        if(data != ""){
                            var obj = $.parseJSON(data);
                            var message = obj.message;
                            if(obj.success == 1){

                                toastr.success(message,'Success');
                               //$.each(selectedRowIndexes, function(index , value){
                                  //  var id = $("#"  + gridId).jqxGrid('getrowid', value);
                                    var commit = $("#"  + gridId).jqxGrid('deleterow', ids);
                                    //$("#"+gridId).jqxGrid('clearselection');
                                    $("#"+gridId).jqxGrid('updatebounddata');
                                    $("#"+gridId).jqxGrid('clearselection');
                                //});
                            }else{
                                toastr.error(message,'Failed');
                            }
                        }

                    });

                }
            });
        }else{
             bootbox.alert("No row selected.Please select row to delete!", function() {});
        }

        

    }
</script>