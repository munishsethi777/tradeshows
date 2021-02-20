var filterFieldNameArr = new Array();
var isSourceChange = 1;


$(document).ready(function(){
    $(".reportFilterBlock").hover(function(event) {
        $(this).find(".reportFilterBlockTools" ).fadeIn(500); 
    }, function() {
        $( ".reportFilterBlockTools" ).fadeOut(100); 
    });
});

function clearFilters(gridId){
    for(var i=0; i<=filterFieldNameArr.length; i++){
        $("#"+gridId).jqxGrid('removefilter',filterFieldNameArr[i],false);

    }
}
function changeSourceUrl(gridId) {
    if(gridId == "instructionManualLogGrid"){
        source.url = "Actions/InstructionManualLogsAction.php?call=getAllInstructionManualLogs";
        isSourceChange = 0; 
    }else if(gridId == "qcscheduleGrid"){
        source.url = "Actions/QCScheduleAction.php?call=getAllQCSchedules";
        isSourceChange = 0;
    }
}
function applyReportingFilter(reportingDataParameter, gridId, currentFiterAppliedName = "", defaultFilterSelectionUserConfigKey) {
    var filtergroup = new $.jqx.filter();
    var filterGetGridDataByReportingParameter = "";
    var filter_or_operator = 0;
    var filterCondition = "EQUAL";
    var filterType = "";
    var filterValue = "";

    $("#currentFiterAppliedNameDiv #currentFiterAppliedName").html(currentFiterAppliedName);
    if(gridId == "instructionManualLogGrid"){
        clearFilters(gridId);
    }
    // ********************************* instruction manual filters starts here *********************************************************
    if (reportingDataParameter == "instruction_manual_all_count") {
        // if (isSourceChange) {
            changeSourceUrl(gridId);
        // }
        $("#" + gridId).jqxGrid('applyfilters');
    } else if (reportingDataParameter == "instruction_manual_total_projects_open") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterValue = "0";
        filterType = "numericfilter";
        filterFieldNameArr.push("iscompleted");
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter', "iscompleted", filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');

    }
    else if (reportingDataParameter == "instruction_manual_total_projects_completed") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterValue = "1";
        filterType = "numericfilter";
        filterFieldNameArr.push("iscompleted");
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter', "iscompleted", filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    } else if (reportingDataParameter == "instruction_manual_total_projects_overdue") {
        source.url = "Actions/InstructionManualLogsAction.php?call=getProjectsOverdueForGrid";
        $("#" + gridId).jqxGrid('applyfilters');
        isSourceChange = 1;

    }
    else if (reportingDataParameter == "instruction_manual_total_projects_in_supervisor_review") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterValue = "In Review - Supervisor";
        filterType = "stringfilter";
        filterFieldNameArr.push("instructionmanuallogstatus");
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter', "instructionmanuallogstatus", filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    } else if (reportingDataParameter == "instruction_manual_total_projects_in_manager_review") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterValue = "In Review - Manager";
        filterType = "stringfilter";
        filterFieldNameArr.push("instructionmanuallogstatus");
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter', "instructionmanuallogstatus", filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    } else if (reportingDataParameter == "instruction_manual_total_projects_in_buyer_review") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterValue = "In Review - Buyer";
        filterType = "stringfilter";
        filterFieldNameArr.push("instructionmanuallogstatus");
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter', "instructionmanuallogstatus", filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    } else if (reportingDataParameter == "instruction_manual_total_projects_due_today") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterFieldNameArr.push("approvedmanualdueprintdate");
        filterFieldNameArr.push("iscompleted");
        var filtergroupDate = new $.jqx.filter();
        var filtergroupIsCompleted = new $.jqx.filter();
        filterGetGridDataByReportingParameter1 = filtergroupDate.createfilter("datefilter", new Date(), "GREATER_THAN_OR_EQUAL");
        filterGetGridDataByReportingParameter2 = filtergroupDate.createfilter("datefilter", new Date(), "LESS_THAN_OR_EQUAL");
        filterGetGridDataByReportingParameter3 = filtergroupIsCompleted.createfilter("numericfilter", 0, "EQUAL");
        filtergroupDate.addfilter(filter_or_operator, filterGetGridDataByReportingParameter1);
        filtergroupDate.addfilter(filter_or_operator, filterGetGridDataByReportingParameter2);
        filtergroupIsCompleted.addfilter(filter_or_operator, filterGetGridDataByReportingParameter3);

        $("#" + gridId).jqxGrid('addfilter', "approvedmanualdueprintdate", filtergroupDate);
        $("#" + gridId).jqxGrid('addfilter', "iscompleted", filtergroupIsCompleted);
        $("#" + gridId).jqxGrid('applyfilters');
    } else if (reportingDataParameter == "instruction_manual_total_projects_due_in_next_14_days") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterCondition1 = "GREATER_THAN_OR_EQUAL";
        filterCondition2 = "LESS_THAN_OR_EQUAL";
        filterValue1 = new Date();
        filterValue1.setDate(filterValue1.getDate() + 1);
        filterValue2 = new Date();
        filterValue2.setDate(filterValue2.getDate() + 14);
        filterType = "datefilter";
        filterFieldNameArr.push("approvedmanualdueprintdate");
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue1, filterCondition1);
        var filterGetGridDataByReportingParameter1 = filtergroup.createfilter(filterType, filterValue2, filterCondition2);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter1);
        $("#" + gridId).jqxGrid('addfilter', "approvedmanualdueprintdate", filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    } else if (reportingDataParameter == "instruction_manual_total_projects_due_less_than_14_days_from_entry") {
        source.url = "Actions/InstructionManualLogsAction.php?call=getProjectsDueLessThan14DaysFromEntryForGrid";
        $("#" + gridId).jqxGrid('applyfilters');
        isSourceChange = 1;
    } else if (reportingDataParameter == "instruction_manual_total_projects_not_started") {
        if (isSourceChange) {
            changeSourceUrl(gridId);
        }
        filterValue = "Not Started";
        filterType = "stringfilter";
        filterFieldNameArr.push("instructionmanuallogstatus");
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter', "instructionmanuallogstatus", filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }
    // ************************************** IM filters ends here ***************************************************************

    // ************************************** QC filters starts here **************************************************************
    else if(reportingDataParameter == "qc_schedules_final_missing_appointments"){
        // alert();
        // source.url = "Actions/QCScheduleAction.php?call=getAllMissingAppoitmentForFinalInspectionDate";
        // $("#" + gridId).jqxGrid('applyfilters');
        // isSourceChange = 1;
    }
    // ************************************** QC filters ends here ***************************************************************
    setUserConfigForStickyAnalyticsDiv(defaultFilterSelectionUserConfigKey, reportingDataParameter);
}