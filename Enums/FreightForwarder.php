<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class FreightForwarder extends BasicEnum{
    const transmodal = "Transmodal";
    const oecGroup = "OEC Group";
    const transfer = "Transfer";
}