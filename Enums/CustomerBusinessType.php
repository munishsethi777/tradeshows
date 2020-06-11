<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class CustomerBusinessType extends BasicEnum{
    const direct = "Direct";
    const domestic = "Domestic/Import";
    const dot_com = "DotCom";
}
