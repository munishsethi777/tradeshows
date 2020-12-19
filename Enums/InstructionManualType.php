<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class InstructionManualType extends BasicEnum{
    const booklet = "Booklet";
    const fold = "Fold";
    const international = "International";
}