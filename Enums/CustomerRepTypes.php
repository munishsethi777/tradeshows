<?php
    require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
    class CustomerRepTypes extends BasicEnum{
        const salesrep = "Sales Rep";   
        const sales_admin_lead = "Sales Admin Lead";
        const internalsupport = "Internal Support";
        const inside_account_manager= "Inside Account Manager";
        // const buyer = "Buyer";
    }
?>