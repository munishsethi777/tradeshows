var filterFieldName = "";
// var oldSource = source.url;
var isSourceChange = 0;

function clearFilters(gridId){
    $("#"+gridId).jqxGrid('removefilter',filterFieldName,false);
}
function changeSourceUrl(){
    source.url = "Actions/instructionManualLogsAction.php?call=getAllInstructionManualLogs";
    isSourceChange = 0;
}
function AddReportingFilter(reportingDataParameter, gridId) {
    var filtergroup = new $.jqx.filter();
    var filterGetGridDataByReportingParameter = "";
    var filter_or_operator = 0;
    var filterCondition = "EQUAL";
    var filterType = "";
    var filterValue = "";
    
    clearFilters(gridId);
    if(reportingDataParameter == "instruction_manual_total_projects_open"){
        if(isSourceChange){
            changeSourceUrl();    
        }
        filterValue = "0";
        filterType = "numericfilter";
        filterFieldName = "iscompleted";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
        
    }
    else if(reportingDataParameter == "instruction_manual_total_projects_completed"){
        if(isSourceChange){
            changeSourceUrl();
        }
        filterValue = "1";
        filterType = "numericfilter";
        filterFieldName = "iscompleted";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }else if(reportingDataParameter == "instruction_manual_total_projects_open_overdue"){
        if(isSourceChange){
            changeSourceUrl();    
        }
        filterValue = "0";
        filterType = "numericfilter";
        filterFieldName = "iscompleted";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
        
    }
    else if(reportingDataParameter == "instruction_manual_total_projects_in_supervisor_review"){
        if(isSourceChange){
            changeSourceUrl();
        }
        filterValue = "In Review - Supervisor";
        filterType = "stringfilter";
        filterFieldName = "instructionmanuallogstatus";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }else if(reportingDataParameter == "instruction_manual_total_projects_in_manager_review"){
        if(isSourceChange){
            changeSourceUrl();
        }
        filterValue = "In Review - Manager";
        filterType = "stringfilter";
        filterFieldName = "instructionmanuallogstatus";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }else if(reportingDataParameter == "instruction_manual_total_projects_in_buyer_review"){
        if(isSourceChange){
            changeSourceUrl();
        }
        filterValue = "In Review - Buyer";
        filterType = "stringfilter";
        filterFieldName = "instructionmanuallogstatus";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }else if(reportingDataParameter == "instruction_manual_total_projects_due_today"){
        if(isSourceChange){
            changeSourceUrl();
        }
        filterCondition = "EQUAL";
        filterValue1 = new Date();
        filterValue2 = new Date();
        filterType = "datefilter";
        filterFieldName = "graphicduedate";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue2, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }else if(reportingDataParameter == "instruction_manual_total_projects_due_in_next_14_days"){
        if(isSourceChange){
            changeSourceUrl();
        }
        filterCondition1 = "GREATER_THAN_OR_EQUAL";
        filterCondition2 = "LESS_THAN_OR_EQUAL";
        filterValue1 = new Date();
        filterValue1.setDate(filterValue1.getDate() + 1);
        filterValue2 = new Date();
        filterValue2.setDate(filterValue2.getDate() + 14);
        filterType = "datefilter";
        filterFieldName = "graphicduedate";
        
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue1, filterCondition1); 
        var filterGetGridDataByReportingParameter1 = filtergroup.createfilter(filterType, filterValue2, filterCondition2);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter1);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }else if(reportingDataParameter == "instruction_manual_total_projects_due_less_than_14_days_from_entry"){
        source.url = "Actions/InstructionManualLogsAction.php?call=getProjectsDueLessThan14DaysFromEntry";
        $("#" + gridId).jqxGrid('applyfilters');
        isSourceChange = 1;
    }else if(reportingDataParameter == "instruction_manual_total_projects_not_started"){
        if(isSourceChange){
            changeSourceUrl();
        }
        filterValue = "Not Started";
        filterType = "stringfilter";
        filterFieldName = "instructionmanuallogstatus";
        filterGetGridDataByReportingParameter = filtergroup.createfilter(filterType, filterValue, filterCondition);
        filtergroup.addfilter(filter_or_operator, filterGetGridDataByReportingParameter);
        $("#" + gridId).jqxGrid('addfilter',filterFieldName, filtergroup);
        $("#" + gridId).jqxGrid('applyfilters');
    }
}
function getProjectsDueLessThan14DaysFromEntry(){
    $.getJSON("Actions/InstructionManualLogsAction.php?call=getProjectsDueLessThan14DaysFromEntry",
        function(response){
            console.log(response);
        }
    );
}