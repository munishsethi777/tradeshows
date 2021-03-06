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
    $("#deleteRequestAttachmentBtn").click(()=>{
        var attachmentSeq = $("#deleteAttachmentModalForm #attachmentseq").val();
        $("#deleteAttachmentModalForm").ajaxSubmit((response)=>{
            $("#deleteAttachmentModal").modal('hide');
            $("#attachmentsMainOuter" + attachmentSeq).remove();
            loadHistory();
        });
    });
    
});
const saveComment = (btn)=>{
    var requestSeq = $("#seq").val();
    var loggedInUserSeq = $("#loggedInUserSeq").val();
    var comment = $("#commentBox").val().trim();
    var l = Ladda.create(btn);
    if(comment != ''){
        l.start();
        $.getJSON("Actions/RequestAction.php?call=saveComment&requestSeq="+requestSeq+"&loggedInUserSeq="+loggedInUserSeq+"&comment="+comment,(response)=>{
            $('#loadComments').prepend(response.data.requestLogCommentsHtml);
            $("#saveRequestLogComments").prop('disabled','true');
            $("#commentBox").val("");
            l.stop();
        });  
    }
}
function populateRequestTypes(data){
    $("#requesttypeseq").empty();
    $("#requesttypeseq").append("<option value=''>Select any</option>");
    $.each(data,function(text,value){
        var option = new Option(value,text);
        $("#requesttypeseq").append(option);
    });
}
function populateAssignedByUsers(data){
    $("#assignedbyseq").empty();
    $("#assignedbyseq").append("<option value=''>Select any</option>");
    $.each(data,function(text,value){
        var option = new Option(value,text);
        $("#assignedbyseq").append(option);
    });
}
function populateAssignedToUsers(data){
    $("#assignedtoseq").empty();
    $("#assignedtoseq").append("<option value=''>Select any</option>");
    $.each(data,function(text,value){
        var option = new Option(value,text);
        $("#assignedtoseq").append(option);
    });
}
function onChangeDepartment(department){
    $("#requestFormDiv #requestSpecsFields").html("");
    $("#requestFormDiv #requesttypeseq").empty();
    $("#requestFormDiv #requeststatusseq").empty();
    $("#isrequiredapprovalfrommanager").val("yes");
    $("#isrequiredapprovalfromrequester").val("no");
    $("#isrequiredapprovalfromrobby").val("yes");
    $('#requestFormDiv').modal('show');
    $.getJSON("Actions/RequestAction.php?call=getRequestTypesAndAssignedByAndAssignedToUsersForDDByDepartmentSeq&department=" + department,(response)=>{
        populateRequestTypes(response.data.requesttypes);
        populateAssignedByUsers(response.data.assignedbyusers);
        populateAssignedToUsers(response.data.assignedtousers);
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
    }else{
        $("#requestSpecsFields").html("");
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
const saveRequest = (btn) => {
    var requestSpecsFieldsFormData = $("#requestSpecsFieldsForm").serializeArray();
    var jsonObj = [];
    item = {};
    $(requestSpecsFieldsFormData).each((i,field)=>{
        item[field.name] = field.value;
        // jsonObj.push(item);
    })
    var requestSpecsFieldsFormJson = JSON.stringify(item);
    var title = "";
    var department="";
    var requestTypeSeq="";
    var priority="";
    var requestStatusSeq="";
    var seq="";
    var assignedBySeq="";
    var assignedToSeq="";
    var dueDate="";
    var assigneeDueDate="";
    var estimatedHours="";
    var isRequiredApprovalFromManager="";
    var isRequiredApprovalFromRequester="";
    var isRequiredApprovalFromRobby="";
    var checkValidity = true;
    var validateInput = "";
    var isCompleted = 0;

    
    if(!document.getElementById("duedate").checkValidity()) {
        checkValidity = false;
        validateInput = "duedate";
    }
    if(!document.getElementById("requesttypeseq").checkValidity()) {
        checkValidity = false;
        validateInput = "requesttypeseq";
    }
    if(!document.getElementById("title").checkValidity()) {
        checkValidity = false;
        validateInput = "title";
    }
    if($("#title").val()) {
        title = $("#title").val();
    }
    if(!document.getElementById("department").checkValidity()) {
        checkValidity = false;
        validateInput = "department";
    }
    if($("#department").val()){
    	department = $("#department").val();
    }
    if($("#requesttypeseq").val()){
    	requestTypeSeq = $("#requesttypeseq").val();
    }
    if($("#priority").val()){
    	priority = $("#priority").val();
    }
    if($("#requeststatusseq").val()){
    	requestStatusSeq = $("#requeststatusseq").val();
    }
    if($("#seq").val()){
    	seq = $("#seq").val();
    }
    if($("#assignedbyseq").val()){
    	assignedBySeq = $("#assignedbyseq").val();
    }
    if($("#assignedtoseq").val()){
    	assignedToSeq = $("#assignedtoseq").val();
    }
    if($("#duedate").val()){
    	dueDate = $("#duedate").val();
    }
    if($("#assigneeduedate").val()){
    	assigneeDueDate = $("#assigneeduedate").val();
	}
    if($("#estimatedhours").val()){
    	estimatedHours = $("#estimatedhours").val();
    }
    if($("#isrequiredapprovalfrommanager").val()){
    	isRequiredApprovalFromManager = $("#isrequiredapprovalfrommanager").val();
    }
    if($("#isrequiredapprovalfromrequester").val()){
    	isRequiredApprovalFromRequester = $("#isrequiredapprovalfromrequester").val();
    }
    if($("#isrequiredapprovalfromrobby").val()){
    	isRequiredApprovalFromRobby = $("#isrequiredapprovalfromrobby").val();
    }
    if($("#iscompleted").prop("checked")){
    	isCompleted = 1;
    }
    var approvedByManagerDate = "";
    var approvedByRequesterDate = "";
    var approvedByRobbyDate = "";
    var attachmentfilename = $("input[name='attachmentfilename']").val();
    var l = Ladda.create(btn);
    l.start();
    if($("#requestSpecsFieldsForm")[0].checkValidity() == true && checkValidity == true){
        var url = "Actions/RequestAction.php?call=saveRequest&requestSpecsFieldsFormJson=" + encodeURIComponent(requestSpecsFieldsFormJson) + "&department=" + department 
                + "&requestTypeSeq=" + requestTypeSeq + "&priority=" + priority + "&requestStatusSeq=" + requestStatusSeq + "&seq=" + seq 
                + "&assignedBySeq=" + assignedBySeq + "&assignedToSeq=" + assignedToSeq + "&dueDate=" + dueDate + "&assigneeDueDate=" + assigneeDueDate
                + "&estimatedHours=" + estimatedHours + "&isRequiredApprovalFromManager=" + isRequiredApprovalFromManager 
                + "&isRequiredApprovalFromRequester=" + isRequiredApprovalFromRequester + "&isRequiredApprovalFromRobby=" + isRequiredApprovalFromRobby 
                + "&approvedByManagerDate=" + approvedByManagerDate + "&approvedByRequesterDate=" + approvedByRequesterDate + "&approvedByRobbyDate=" 
                + approvedByRobbyDate + "&attachmentfilename=" + attachmentfilename + "&isCompleted=" + isCompleted + "&title=" + title;
        $.get(url,(response)=>{
                    var responseObj = JSON.parse(response);
                    $("#requestFormDiv #code").text(responseObj.data.code);
                    $("#requestSeqForRequestAttachment,#seq").val(responseObj.data.seq);
                    $("#requestTypeSeqForRequestAttachment").val(responseObj.data.requesttypeseq);
                    Dropzone.autoDiscover = true;
                    requestAttachmentDropzone.processQueue();
                    var flag = showResponseToastr(response,null,null,"ibox");
                    if(flag){
                        $(".commentsAndHistoryDiv").show();
                        requestAttachmentDropzone.options.autoProcessQueue = true;
                        requestAttachmentDropzone.removeAllFiles(true);
                        loadHistory();
                        $("#requestGrid").jqxGrid('updatebounddata', 'cells');
                    }else{
                        toastr.error(responseObj.message,'Failed');
                    }
                    loadReportingData('request_management_');
                    l.stop();
        });
        return true;
    }else{
        if(!checkValidity){
            document.getElementById(validateInput).reportValidity();
        }else{
            $("#requestSpecsFieldsForm")[0].reportValidity();
        }
        l.stop();
        return false;
    }
}
const saveRequestAndClose = (btn) =>{
    if(saveRequest(btn)){
        $('#requestFormDiv').modal('hide');
    }
}
const loadHistory = () => {
    var requestSeq = $("#seq").val();
    var lastUpdatedHistorySeq = $("#lastUpdatedHistorySeq").val();
    var url = "Actions/RequestAction.php?call=loadHistory&lastUpdatedHistorySeq=" + lastUpdatedHistorySeq + "&requestSeq=" + requestSeq;

    $.getJSON(url,(response)=>{
        if(response.data.lastUpdatedHistorySeq != null && response.data.lastUpdatedHistorySeq > lastUpdatedHistorySeq){
            $('#loadHistory').prepend(response.data.historyLogHtml);
            $('#lastUpdatedHistorySeq').val(response.data.lastUpdatedHistorySeq);
        }
    });
}
function editButtonClick(seq) {
	$(".commentsAndHistoryDiv").show();
    requestAttachmentDropzone.options.autoProcessQueue = true;
    requestAttachmentDropzone.removeAllFiles(true);
    $("#requestFormDiv #requestcode").text("");
    $("#requestFormDiv #requestSpecsFields").html("");
    $("#requestFormDiv #title").val("");
    $("#requestFormDiv #department").val("");
    $("#requestFormDiv #requeststatusseq").empty();
    $("#requestFormDiv #requesttypeseq").val("");
    $("#requestFormDiv #requeststatusseq").val("");
    $("#requestFormDiv #seq").val(seq);
    $("#requestFormDiv #code").text("");
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
    $("#lastUpdatedHistorySeq").val('');
    $("#iscompleted").iCheck("uncheck")
    // $("#requestAttachmentDropzoneForm").empty('');
    // requestAttachmentDropzone.removeFile(file);
    $("#attachmentsRow").html("");
    $('#requestFormDiv').modal('show');
    $.getJSON("Actions/RequestAction.php?call=getRequestDataBySeqForEdit&requestSeq=" + seq,(response)=>{
        $("#requestFormDiv #department").val(response.data.department);
        populateRequestTypes(response.data.requestformotherfields.requesttypes);
        populateAssignedByUsers(response.data.requestformotherfields.assignedbyusers);
        populateAssignedToUsers(response.data.requestformotherfields.assignedtousers);
        $("#requeststatusseq").append(response.data.requestspecsformhtml.requestStatusHTML);
        $("#requestSpecsFields").html(response.data.requestspecsformhtml.requestSpecsFieldsHTML);
        $('.datepicker').datetimepicker({
            timepicker:false,
            format:'m-d-Y',
            scrollMonth : false,
            scrollInput : false,
            minDate : 0,
            onSelectDate:function(ct,$i){
                //setDuration();
            }
        });
        $('.datetimepicker').datetimepicker({
            timepicker:true,
            format:'m-d-Y h:i: a',
            scrollMonth : false,
            scrollInput : false,
            minDate : 0,
            onSelectDate:function(ct,$i){
                //setDuration();
            }
        });
        $.each(response.data.requestformotherfields,(key,value)=>{
            $("#requestFormDiv #" + key).val(value);
        });
        $("#requestFormDiv #code").text(response.data.requestformotherfields.code);
        if(response.data.requestformotherfields.isCompleted == 1){
        	$('#iscompleted').iCheck('check');
        }else{
        	$('#iscompleted').iCheck('uncheck');
        }
        $.each($.parseJSON(response.data.requestspecificationjson),function(index,value){
            $("#" + index).val(value);
        });
        $('#loadComments').html(response.data.requestLogCommentsHtml);
        $('#loadHistory').append(response.data.historyLog.historyLogHtml);
        $('#lastUpdatedHistorySeq').val(response.data.historyLog.lastUpdatedHistorySeq);
        $("#requestAttachmentDropzoneForm #requestSeqForRequestAttachment").val(seq);
        $("#requestAttachmentDropzoneForm #requestTypeSeqForRequestAttachment").val(response.data.requestTypeSeq);
        $("#attachmentsRow").html(response.data.requestAttachmentsHtml);
    });
}

const deleteAttachment = (attachmentSeq,attachmentName,requestseq) => {
    var attachmentTitle = $("#attachmentTitle" + attachmentSeq).text();
    $("#deleteAttachmentModal").modal('show');
    $('#deleteAttachmentModalForm #attachmentseq').val(attachmentSeq);
    $('#deleteAttachmentModalForm #attachmentname').val(attachmentName);
    $('#deleteAttachmentModalForm #requestseq').val(requestseq);
    $('#deleteAttachmentModalForm #attachmenttitle').val(attachmentTitle);
}
