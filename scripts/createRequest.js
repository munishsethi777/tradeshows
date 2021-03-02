$(document).ready(()=>{
    $('.dateControl').datetimepicker({
        timepicker:false,
        format:'m-d-Y',
        scrollMonth : false,
        scrollInput : false,
        onSelectDate:function(ct,$i){
            //setDuration();
        }
    });
    $("#saveRequestLogComments").click(()=>{
        var requestSeq = $("#seq").val();
        var loggedInUserSeq = $("#loggedInUserSeq").val();
        var comment = $("#commentBox").val().trim();
        if(comment != ''){
            $.getJSON("Actions/RequestAction.php?call=saveComment&requestSeq="+requestSeq+"&loggedInUserSeq="+loggedInUserSeq+"&comment="+comment,(response)=>{
                $('#loadComments').append(response.data.requestLogCommentsHtml);
                $("#saveRequestLogComments").prop('disabled','true');
                $("#commentBox").val("");
            });  
        }
    });
    $("#commentBox").keyup(()=>{
        var comment = $("#commentBox").val().trim();
        if(comment == ''){
            $("#saveRequestLogComments").prop('disabled','true');
        }else{
            $("#saveRequestLogComments").prop('disabled',false);
        }
    });
    $("#commentCancelBtn").click(()=>{
        $("#commentBox").val("");
    });
    
    
});

function populateRequestTypes(data){
    $("#requesttypeseq").empty();
    $("#requesttypeseq").append("<option value=''>Select any</option>");
    $.each(data,function(text,value){
        var option = new Option(value,text);
        $("#requesttypeseq").append(option);
    });
}
function onChangeDepartment(departmentSeq){
    $("#requestFormDiv #requestSpecsFields").html("");
    $("#requestFormDiv #requesttypeseq").empty();
    $("#requestFormDiv #requeststatusseq").empty();
    $("#requestFormDiv #seq").val("");
    $("#duedate").val("");
    $("#assigneeduedate").val("");
    $("#estimatedhours").val("");
    $("#isrequiredapprovalfrommanager").val("yes");
    $("#isrequiredapprovalfromrequester").val("no");
    $("#isrequiredapprovalfromrobby").val("yes");
    $('#requestFormDiv').modal('show');
    $.getJSON("Actions/RequestAction.php?call=getRequestTypesByDepartmentSeq&departmentSeq=" + departmentSeq,(response)=>{
        populateRequestTypes(response.data);
    });
}
function onRequestTypeChange(thisObject){
    var requestTypeSeq = $(thisObject).val();
    if(typeof requestTypeSeq !== 'undefined' && requestTypeSeq !=null && requestTypeSeq != ""){
        $.getJSON("Actions/RequestAction.php?call=getRequestTypesBySeq&seq=" + requestTypeSeq,(response)=>{
            $("#requeststatusseq").empty();
            $("#requeststatusseq").append("<option value=''>Select any</option>");
            $("#requeststatusseq").append(response.data.requestStatusHTML);
            $("#requestSpecsFields").html(response.data.requestSpecsFieldsHTML);
            $('.datepicker').datetimepicker({
                timepicker:false,
                format:'m-d-Y',
                scrollMonth : false,
                scrollInput : false,
                onSelectDate:function(ct,$i){
                    //setDuration();
                }
            });
            $('.datetimepicker').datetimepicker({
                timepicker:true,
                format:'m-d-Y h:i: a',
                scrollMonth : false,
                scrollInput : false,
                onSelectDate:function(ct,$i){
                    //setDuration();
                }
            });
        });
    }
}
function closeRequestForm(){
	$('#requestFormDiv').modal('hide');
    // $("#requestGrid").jqxGrid('updatebounddata', 'cells');
};

function showRequestsDetails(seq, rowId){
    currentRowId = rowId;
    showHideProgress();
    $.getJSON("Actions/RequestAction.php?call=getRequestsDetails&seq=" + seq ,function(data){
	});		
}
const saveRequest = () => {
    var requestSpecsFieldsFormData = $("#requestSpecsFieldsForm").serializeArray();
    var jsonObj = [];
    item = {};
    $(requestSpecsFieldsFormData).each((i,field)=>{
        item[field.name] = field.value;
        // jsonObj.push(item);
    })
    var requestSpecsFieldsFormJson = JSON.stringify(item);
    var departmentSeq = $("#departmentseq").val();
    var requestTypeSeq = $("#requesttypeseq").val();
    var priority = $("#priority").val();
    var requestStatusSeq = $("#requeststatusseq").val();
    var seq = $("#seq").val();
    var assignedBySeq = $("#assignedbyseq").val();
    var assignedToSeq = $("#assignedtoseq").val();
    var dueDate = $("#duedate").val();
    var assigneeDueDate = $("#assigneeduedate").val();
    var estimatedHours = $("#estimatedhours").val();
    var isRequiredApprovalFromManager = $("#isrequiredapprovalfrommanager").val();
    var isRequiredApprovalFromRequester = $("#isrequiredapprovalfromrequester").val();
    var isRequiredApprovalFromRobby = $("#isrequiredapprovalfromrobby").val();
    var approvedByManagerDate = $("#approvedbymanagerdate").val();
    var approvedByRequesterDate = $("#approvedbyrequesterdate").val();
    var approvedByRobbyDate = $("#approvedbyrobbydate").val();
    var attachmentfilename = $("input[name='attachmentfilename']").val();
    $.post("Actions/RequestAction.php?call=saveRequest&requestSpecsFieldsFormJson=" + requestSpecsFieldsFormJson + "&departmentSeq=" + departmentSeq 
            + "&requestTypeSeq=" + requestTypeSeq + "&priority=" + priority + "&requestStatusSeq=" + requestStatusSeq + "&seq=" + seq 
            + "&assignedBySeq=" + assignedBySeq + "&assignedToSeq=" + assignedToSeq + "&dueDate=" + dueDate + "&assigneeDueDate=" + assigneeDueDate
            + "&estimatedHours=" + estimatedHours + "&isRequiredApprovalFromManager=" + isRequiredApprovalFromManager 
            + "&isRequiredApprovalFromRequester=" + isRequiredApprovalFromRequester + "&isRequiredApprovalFromRobby=" + isRequiredApprovalFromRobby 
            + "&approvedByManagerDate=" + approvedByManagerDate + "&approvedByRequesterDate=" + approvedByRequesterDate + "&approvedByRobbyDate=" 
            + approvedByRobbyDate + "&attachmentfilename=" + attachmentfilename
            ,(response)=>{
                var responseObj = JSON.parse(response);
                $("#requestSeqForRequestAttachment,#seq").val(responseObj.data);
                Dropzone.autoDiscover = true;
                requestAttachmentDropzone.processQueue();        
                // closeRequestForm();
                // $("#requestGrid").jqxGrid('updatebounddata', 'cells');
        
    });
}
function editButtonClick(seq) {
    requestAttachmentDropzone.options.autoProcessQueue = true;
    requestAttachmentDropzone.removeAllFiles(true);
    $("#requestFormDiv #requestSpecsFields").html("");
    $("#requestFormDiv #departmentseq").val("");
    $("#requestFormDiv #requeststatusseq").empty();
    $("#requestFormDiv #requesttypeseq").val("");
    $("#requestFormDiv #requeststatusseq").val("");
    $("#requestFormDiv #seq").val(seq);
    $("#requestFormDiv #dueDate").val('');
    $("#requestFormDiv #estimatedhours").val('');
    $("#requestFormDiv #isrequiredapprovalfrommanager").val('yes');
    $("#requestFormDiv #isrequiredapprovalfromrequester").val('no');
    $("#requestFormDiv #isrequiredapprovalfromrobby").val('yes');
    $("#requestFormDiv #assigneeduedate").val('');
    $("#requestFormDiv #assignedbyseq").val('');
    $("#requestFormDiv #assignedtoseq").val('');
    $("#requestFormDiv #approvedbymanagerdate").val('');
    $("#requestFormDiv #approvedbyrequesterdate").val('');
    $("#requestFormDiv #approvedbyrobbydate").val('');
    $("#loadHistory,#loadComments").html("");
    $("#saveRequestLogComments").prop('disabled','true');
    // $("#requestAttachmentDropzoneForm").empty('');
    // requestAttachmentDropzone.removeFile(file);
    $("#attachmentsRow").html("");
    $('#requestFormDiv').modal('show');
    $.getJSON("Actions/RequestAction.php?call=getRequestDataBySeqForEdit&requestSeq=" + seq,(response)=>{
        $("#requestFormDiv #departmentseq").val(response.data.departmentseq);
        populateRequestTypes(response.data.requestformotherfields.requesttypes);
        $("#requeststatusseq").append(response.data.requestspecsformhtml.requestStatusHTML);
        $("#requestSpecsFields").html(response.data.requestspecsformhtml.requestSpecsFieldsHTML);
        $('.datepicker').datetimepicker({
            timepicker:false,
            format:'m-d-Y',
            scrollMonth : false,
            scrollInput : false,
            onSelectDate:function(ct,$i){
                //setDuration();
            }
        });
        $('.datetimepicker').datetimepicker({
            timepicker:true,
            format:'m-d-Y h:i: a',
            scrollMonth : false,
            scrollInput : false,
            onSelectDate:function(ct,$i){
                //setDuration();
            }
        });
        $.each(response.data.requestformotherfields,(key,value)=>{
            $("#requestFormDiv #" + key).val(value);
        });
        $.each($.parseJSON(response.data.requestspecificationjson),function(index,value){
            $("#" + index).val(value);
        });
        $('#loadComments').html(response.data.requestLogCommentsHtml);
        $('#loadHistory').append(response.data.requestLogHistoryHtml);
        $("#requestAttachmentDropzoneForm #requestSeqForRequestAttachment").val(seq);
        $("#attachmentsRow").html(response.data.requestAttachmentsHtml);
    });
}
