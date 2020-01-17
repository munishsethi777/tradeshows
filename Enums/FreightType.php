<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class FreightType extends BasicEnum{
    const prepaid = "Prepaid";
    const collect = "Collect";
}