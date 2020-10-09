<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class SellerResponsibilitiesType extends BasicEnum{
    const account_manager = "Account Manager";
    const assistant_account_manager = "Assistant Account Manager";
    const advertising = "Advertising";
    const principal = "Principal";
    const distributor_sales_rep = "Distributor Sales Rep";
}