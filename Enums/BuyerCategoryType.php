<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class BuyerCategoryType extends BasicEnum{
    const fountains = "Fountains";
    const bird_bath = "Bird Bath";
    const furniture = "Furniture";
    const other = "Other";
    const christmas_lighted = "Christmas Lighted";
    const outdoor_lighted = "Outdoor Lighted";
    const christmas = "Christmas";
    const outdoor_decor = "Outdoor Decor";
    const patriotic = "Patriotic";
}