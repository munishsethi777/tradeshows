<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class BusinessCategoryType extends BasicEnum{
    const ecomm = "eComm";
    const leads = "Leads";
    const other = "Other";
    const previous_customer = "Previous Customer";
    const top_120 = "Top 120";
    
}
