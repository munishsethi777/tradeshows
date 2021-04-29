<?php
    require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
    class RequestDepartments extends BasicEnum{
        const qc_schedules = "QC Schedules";   
        const graphics_logs = "Graphics Logs";
        const item_specs = "Item Specs";
        const container_schedules= "Container Schedules";
        const users= "Users";
        const teams= "Teams";
        const manage_customers= "Manage Customers";
        // const department1 = "Department 1";
        // const department2 = "Department 2";
        // const department3 = "Department 3";
        const marketing = "Marketing";
        const product_development = "Product Development";
    }
?>