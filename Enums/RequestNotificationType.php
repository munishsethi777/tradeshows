<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class RequestNotificationType extends BasicEnum{
    const new_request_creation = "New Project Creation";
    const request_assignee_assignment = "Project Assignee assignment";
    const request_assigner_assignment = "Project Assigner assignment";
    const status_change = "Status Change";
    const request_due_in_next_week = "Projects due in next week";
    const request_passed_due_in_last_week = "Projects past due in last week";
    const assignee_due_in_next_week = "Assignee due in next week";
    const assignee_passed_due_in_last_week = "Assignee past due in last week";
    const comments_added = "Comments added";
    const files_uploaded = "Files uploaded";
    const marked_completed = "Marked Completed";
}