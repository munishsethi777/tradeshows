<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class WareHouseType extends BasicEnum{
    const alpine = "Alpine";
    const coi = "COI - City of Industry";
    const dcw_m_and_a = "DCW / M&A";
    const dhe = "DHE";
    const direct_to_customer = "Direct To Customer";
    const sd_nordic ="SD-NORDIC";
}