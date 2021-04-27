<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class CustomerDirectImportCommissionTypes extends BasicEnum{
    const bonus_plan = "Bonus Plan";
    const dropship = "Dropship";
    const rsc_dom = "RSC DOM";
    const rsc_co = "RSC CO";
    const rsc = "RSC";
    const cvs_domestic = "CVS Domestic";
    const containers = "Containers";
    const e_commerce = "E-commerce";
    const direct = "Direct";
}
