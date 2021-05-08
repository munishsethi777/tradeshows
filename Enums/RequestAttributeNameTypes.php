<?php
    require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
    class RequestAttributeNameTypes extends BasicEnum{
        const priority = "Priority";
        const title = "Title";
        const descriptiontext = "DescriptionText";
        const department = "Department";
        const requesttypeseq = "Request Type";
        const requestspecifications = "Request Specifications";
        const assignedby = "Assigned By";
        const assignedto = "Assigned To";
        const duedate = "Due Date";
        const assigneeduedate = "Assigned Due Date";
        const startdate = "Start Date";
        const estimatedhours = "Estimated Hours";
        const requeststatusseq = "Request Status";
        const isrequiredapprovalfrommanager = "Is Required Approvel From Manager";
        const isrequiredapprovalfromrequester = "Is required Approvel From Requester";
        const isrequiredapprovalfromrobby = "Is Required Approvel From Robby";
        const approvedbymanagerdate = "Approved By Manager Date";
        const approvedbyrequesterdate = "Approved By Requester Date";
        const approvedbyrobbydate = "Approved By Robby Date";
        const completeddate = "Completed Date";
        const actualhours = "Actual Hours";
        const iscompleted  = "Is Completed";
        const createdon = "Created On";
        const lastmodifiedon = "Last Modified On";
        const deleteattachment = "Attachment";
        const attachment = "Attachment";
    }
?>