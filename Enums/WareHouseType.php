<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class WareHouseType extends BasicEnum{
    const alpine = "Commerce – Alpine";
    const coi = "City of Industry – Alpine";
    const dcw_m_and_a = "DCW / M&A";
    const dhe = "DHE";
    const direct_to_customer = "Direct To Customer";
    const rbw_logistics = "GA-RBW Logistics";
    const sd_nordic ="SD-NORDIC";
    const uk_law_distribution = "UK-Law Distribution";
}