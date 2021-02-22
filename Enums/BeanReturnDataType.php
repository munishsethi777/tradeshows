<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class BeanReturnDataType extends BasicEnum{
    const grid = "Grid";
    const export = "Export";
    const count = "Count";
}