<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class InstructionManualNotificationType extends BasicEnum{
    const date_diagram_saved_instant = "Date Diagram Saved (instant)";
    const notes_to_usa_office_saved_instant = "Notes to USA office saved (instant)";
    const diagram_saved_by_instant = "Email Notification to \"Diagram Saved by\" user if 'Waiting Information from China' is selected with notes (instant )";
    const entered_by_instant = "Email Notification to \"Entered By\" user  if 'Waiting Information from Buyer' is selected with notes (instant)";
}