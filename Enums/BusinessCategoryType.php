<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class BusinessCategoryType extends BasicEnum{
    const top_120 = "Top 120";
    const ecomm = "eComm";
    const other = "Other";
    const previous_customer = "Previous Customer";
}
