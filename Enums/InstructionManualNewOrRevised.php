<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class InstructionManualNewOrRevised extends BasicEnum{
    const newInstructionManual = "New";
    const revisedInstructionManual = "Revised";
    const revisedInternationInstructionManual = "Revised - Internation";
}