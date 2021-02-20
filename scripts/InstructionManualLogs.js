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
        {text: 'IM Due Date',datafield: 'approvedmanualdueprintdate',filtertype: 'date',width: "10%",cellsformat: 'M-dd-yyyy'},
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
            {name: 'approvedmanualdueprintdate',type: 'date'},
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