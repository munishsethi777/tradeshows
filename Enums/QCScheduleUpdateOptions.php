<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class QCScheduleUpdateOptions extends BasicEnum{
    const updateLatestShipDate           = "Update Latest ShipDate (based on id)";
    const updateShipDateAndScheduleDates = "Update ShipDate and Schedule dates (based on id)";
    const updatePONumbers                = "Update PO Numbers (based on id)";
    const updatePOTypes                  = "Update Po Type (based on id)";
    const updateCompetionStatus          = "Update Completion Status (based on id)";
    const updatePOInchargeUser           = "Update Po Incharge User (based on id)";
    const updateClassCode                = "Update Class Code based on id";
    const updateQC                       = "Update QC (based on id)";
    const updateFirstInspectionDate      = "First Inspection Date";
}