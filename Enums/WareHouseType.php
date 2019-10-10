<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class WareHouseType extends BasicEnum{
    const alpine = "Alpine";
    const dcw_m_and_a = "DCW / M&A";
    const dhe = "DHE";
    const direct_to_customer = "Direct To Customer";
}