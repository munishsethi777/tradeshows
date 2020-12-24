<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class CustomerBusinessType extends BasicEnum{
    //const direct = "Direct";
    //const domestic = "Domestic/Import";
    const ecomm = "eComm";
    const coop = "Coop";
    const distributor = "Distributor";
    const grocery = "Grocery";
    const dealer = "Dealer";
    const regional_mass_merchant = "Regional Mass Merchant";
}
