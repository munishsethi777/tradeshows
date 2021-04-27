<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class CustomerDomesticCommissionTypes extends BasicEnum{
    const bonus_plan = "Bonus Plan";
    const sales_orders_written = "Sales Orders written";
    const igc = "IGC";
    const distr_keyaccounts_coops = "Distr/Key Accounts/Coops";
    const dropship = "Dropship";
    const rsc_dom = "RSC DOM";
    const rsc_co = "RSC CO";
    const rsc = "RSC";
    const cvs_domestic = "CVS Domestic";
    const containers = "Containers";
    const e_commerce = "E-commerce";
    const domestic = "Domestic";
    const military = "Military";
    const military_accounts = "Military Accounts";
    const direct = "Direct";
}
