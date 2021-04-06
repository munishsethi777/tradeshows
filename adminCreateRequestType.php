<?php
    include("SessionCheck.php");
    require_once('IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] . "Utils/DropdownUtil.php");
    require_once($ConstantsArray['dbServerUrl'] . "Managers/RequestTypeMgr.php");
    require_once($ConstantsArray['dbServerUrl'] . "Managers/RequestStatusMgr.php");
    require_once($ConstantsArray['dbServerUrl'] . "Managers/RequestSpecsFieldMgr.php");
    require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/RequestType.php");

    $requestType = new RequestType();
    $requestTypeMgr = RequestTypeMgr::getInstance();
    $requestStatusMgr = RequestStatusMgr::getInstance();
    $requestSpecsFeildTypeMgr = RequestSpecsFieldMgr::getInstance();
    if(isset($_POST['id'])){
        $seq = $_POST['id'];
        $requestType = $requestTypeMgr->findBySeq($seq);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project Type</title>
    <?include "ScriptsInclude.php"?>
</head>

<body>
    <div id="wrapper">
        <?php include("adminmenuInclude.php") ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                                <h5 class="pageTitle">Create/Edit Project Type</h5>
                            </nav>
                        </div>
                        <div class="ibox-content">
                            <?include "progress.php"?>
                            <form id="createRequestTypeForm" method="post" action="Actions/RequestTypeAction.php" class="m-t-sm">
                                <input type="hidden" id="call" name="call" value="saveRequestType" />
                                <input type="hidden" id="seq" name="seq" value="<?php echo $requestType->getSeq();?>" />
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                    </div>
                                    <div class="col-lg-2">
                                        <button id="saveRequestTypeBtn" class="btn btn-primary" type="button" style="width:85%">
                                            Save
                                        </button>
                                    </div>
                                    <div class="col-lg-2">
                                        <a class="btn btn-default" href="#" type="button" style="width:85%">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group row departmentName" style="">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Department</label>
                                    <div class="col-lg-4">
                                        <?php
                                            $select = DropDownUtils::getRequestDepartments("department", null, $requestType->getDepartment(), true, true);
                                            echo $select;
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label bg-formLabel">Project Type Title</label>
                                    <div class="col-lg-4">
                                        <input type="text" maxLength="250" value="<?php echo $requestType->getTitle();?>" id="title" name="title" class="form-control" placeholder="enter project type title" required>
                                    </div>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Project Type Code</label>
                                    <div class="col-lg-4">
                                        <input type="text" maxLength="250" value="<?php echo $requestType->getRequestTypeCode();?>" id="title" name="requesttypecode" class="form-control" placeholder="enter project type code" required>
                                    </div>
                                </div>

                                <div class="form-group row m-b-xs">
                                    <label class="col-lg-12 m-xxs txt-primary">Add Project Status</label>
                                </div>
                                
                                <div id="addRequestStatusLabelDiv" class="form-group row m-b-xs">
                                    <label class="col-lg-11 col-form-label bg-formLabel">Project status</label>
                                    <label class="col-lg-1 col-form-label bg-formLabel">Action</label>
                                </div>
                                
                                <div id="addRequestStatusDiv">
                                </div>
                                <div class="col-lg-1 pull-right addMoreRequestStatusBtnDiv">
                                    <button class="btn btn-xs btn-success" id="addMoreRequestStatusBtn" type="button" onclick="addMoreRequestStatus()">
                                        <i class="fa fa-plus"></i> Add more</button>
                                </div>
                                <div class="form-group row m-b-xs">
                                    <label class="col-lg-12 m-xxs txt-primary">Add Project Fields</label>
                                </div>
                                <div id="addRequestFieldsLabelDiv" class="form-group row m-b-xs">
                                    <label class="col-lg-4 col-form-label bg-formLabel">Field Title</label>
                                    <label class="col-lg-4 col-form-label bg-formLabel">Field Type</label>
                                    <label class="col-lg-2 col-form-label bg-formLabel">Required</label>
                                    <label class="col-lg-1 col-form-label bg-formLabel">Visible</label>
                                    <label class="col-lg-1 col-form-label bg-formLabel">Action</label>
                                </div>
                                <div id="requestFieldsDiv">
                                </div>
                                <div class="col-lg-1 pull-right addMoreRequestsFieldsBtnDiv">
                                    <button class="btn btn-xs btn-success" id="addMoreRequestsFieldsBtn" type="button" onclick="addMoreRequestsFields()">
                                        <i class="fa fa-plus"></i> Add more</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
<script>
    $(document).ready(() => {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
	    });
        populateRequestStatus();
    });
    $("#saveRequestTypeBtn").click(()=>{
        if($("#createRequestTypeForm")[0].checkValidity()) {
            showHideProgress()
            $('#createRequestTypeForm').ajaxSubmit(function( data ){
                showHideProgress();
                var flag = showResponseToastr(data,null,null,"ibox");
                if(flag){
                    window.setTimeout(function(){window.location.href = "adminManageRequestTypes.php"},100);
                }
            })	
        }else{
            $("#createRequestTypeForm")[0].reportValidity();
        }
    }); 
    function onFieldTypeChange(thisObject){
        if($(thisObject).val() == 'dropdown'){
            $(thisObject).parent().children('textarea').show();
        }else{
            $(thisObject).parent().children('textarea').hide();
        }
    }
    function populateRequestStatus(){
        var requestTypeSeq = $("#seq").val();
        if(requestTypeSeq != ""){
            $.getJSON("Actions/RequestTypeAction.php?call=getRequestStatusAndRequestsFieldsByRequestTypeSeq&requestTypeSeq=" + requestTypeSeq,(response)=>{
                $.each(response.data, function(key, arr) {
                    if(key == "requestStatus"){
                        $.each(arr,function(index,value){
                            addMoreRequestStatus(value);
                        });
                    }else if(key == "requestSpecsFields"){
                        $.each(arr,function(index,value){
                            addMoreRequestsFields(value);
                        });
                    }
                });
            });
        }else{
            addMoreRequestStatus();
            addMoreRequestsFields();
        }
    }
    function addMoreRequestStatus(requestStatus){
        var title = "";
        if(typeof requestStatus !== "undefined"){
            if(requestStatus.title != ""){
                title = requestStatus.title;
            }
        }
        var html = "<div class='form-group row m-b-xs requestStatusRow'>";
        html += "<div class='col-lg-11 p-xxs no-margins'>";
        html += "<input type='text' id='' maxLength='' value='" + title + "' name='requeststatus[]' class='form-control' placeholder='enter project status'>";
        html += "</div>";
        html += "<div class='col-lg-1 p-xxs no-margins'>";
        html += "<button class='btn btn-xs btn-success' id='removeRequestsFieldsBtn' type='button' onclick='deleteRequestStatusRow(this)'>";
        html += "<i class='fa fa-minus'></i> Remove</button>";
        html += "</div>";
        html += "</div>";
        $("#addRequestStatusDiv").append(html);
    }
    function addMoreRequestsFields(requestSpecsFields){
        var seq = "";
        var name = "";
        var title = "";
        var fieldType = "";
        var isRequired = "";
        var isVisible = ""
        var details = "";
        if(typeof requestSpecsFields !== "undefined"){
            seq = requestSpecsFields.seq;
            if(requestSpecsFields.name != ""){
                name = requestSpecsFields.name;
            }
            if(requestSpecsFields.title != ""){
                title = requestSpecsFields.title;
            }
            if(requestSpecsFields.fieldtype != ""){
                fieldType = requestSpecsFields.fieldtype;
            }
            if(requestSpecsFields.isrequired != ""){
                isRequired = requestSpecsFields.isrequired;
                if(isRequired == '1'){
                    isRequired = 'yes';
                }else{
                    isRequired = 'no';
                }
            }
            if(requestSpecsFields.isvisible != ""){
                isVisible = requestSpecsFields.isvisible;
                if(isVisible == '1'){
                    isVisible = 'yes';
                }else{
                    isVisible = 'no';
                }
            }
            if(requestSpecsFields.details != ""){
                details = requestSpecsFields.details;
            }
        }
        var html = "<div class='form-group row m-b-xs fieldTypeRow' id='fieldTypeRow"+ seq +"'>";
        html += "<div class='col-lg-4 p-xxs no-margins'>";
        html += "<input type='text' id='' maxLength='250' value='" + title + "' name='requestfieldtitle[]' class='form-control' placeholder='Enter field title'>";
        html += "</div>";
        html += "<div class='col-lg-4 p-xxs no-margins'>"; 
        html += "<?php $select = DropDownUtils::getRequestsSpecsFieldTypes('requestfieldtype[]', 'onFieldTypeChange(this)','', true, true);echo $select ?>";   
        html += "<textarea name='details[]' style='width:100%;display:none'></textarea>";
        html += "</div>";
        html += "<div class='col-lg-2 p-xxs no-margins'>";
        html += "<?php $select = DropDownUtils::getBooleanDropDown('required[]', null, '1', false, true); echo $select;?>";
        html += "</div>";
        html += "<div class='col-lg-1 p-xxs no-margins'>";
        html += "<?php $select = DropDownUtils::getBooleanDropDown('isvisible[]', null, '1', false, true); echo $select;?>";
        html += "</div>";
        html += "<div class='col-lg-1 p-xxs no-margins'>";
        html += "<button class='btn btn-xs btn-success' id='removeRequestsFieldsBtn' type='button' onclick = 'deleteFieldTypeRow(this)'>";
        html += "<i class='fa fa-minus'></i> Remove</button>";
        html += "</div>";
        $("#requestFieldsDiv").append(html);
        $("#fieldTypeRow"+requestSpecsFields.seq+" #requestfieldtype").val(fieldType);
        if(fieldType == "dropdown"){
            $("#fieldTypeRow"+requestSpecsFields.seq+" textarea").show();
        }
        $("#fieldTypeRow"+requestSpecsFields.seq+" #required").val(isRequired);
        $("#fieldTypeRow"+requestSpecsFields.seq+" #isvisible").val(isVisible);
        $("#fieldTypeRow"+requestSpecsFields.seq+" textarea").val(details);
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    }
    function deleteRequestStatusRow(btn){
	    $(btn).closest('.requestStatusRow').remove();
    }
    function deleteFieldTypeRow(btn){
        $(btn).closest('.fieldTypeRow').remove();
    }
</script>