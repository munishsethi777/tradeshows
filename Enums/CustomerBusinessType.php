<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class CustomerBusinessType extends BasicEnum{
    const direct = "Direct";
    const domesitc = "Domesitc";
    const dot_com = "DotCom";
    const chain_store = "Chain Store";
    const top_150 = "Top 150";
}
