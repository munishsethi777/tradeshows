<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class DefectiveAllowanceDeductionsType extends BasicEnum{
    const discount_taken_off_so = "Discount taken Off SO";
    const deducted_from_payment = "Deducted from Payment";
}