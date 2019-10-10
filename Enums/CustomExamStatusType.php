<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class CustomExamStatusType extends BasicEnum{
    const pendingMovement = "Pending Movement";
    const inExam = "In Exam";
    const clearedExam = "Cleared Exam";
}