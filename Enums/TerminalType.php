<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class TerminalType extends BasicEnum{
    const apl = "APL";
    const apm = "APM";
    const everport = "EVERPORT TERMINAL SERVICES";
    const garden_city = "GARDEN CITY";
    const its = "ITS";
    const lbct = "LBCT";
    const pct = "PCT";
    const shippers = "SHIPPERS";
    const ssa_pier_a="SSA PIER A";
    const trapac = "TRAPAC";
    const tti = "TTI";
    const wbct = "WBCT";
    const yti = "YTI";
    const yusen = "YUSEN";
}