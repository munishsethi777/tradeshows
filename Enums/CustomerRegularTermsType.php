<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class CustomerRegularTermsType extends BasicEnum{
    const net30 = "Net 30";
    const net60 = "Net 60";
    const net90 = "Net 90";
    const net120 = "Net 120";
    const net150 = "Net 150";
    
}