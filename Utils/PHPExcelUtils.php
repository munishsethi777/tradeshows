<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualNewOrRevised.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/CustomerNameType.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualRequestedChanges.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/InstructionManualLogStatus.php");

class PHPExcelUtil {
	
	public static function exportQCSchedules($qcSchedules,$isEmail = false,$fileName,$isRevision=false){
		$objPHPExcel = self::cookQCScheduledPHPExcelHeader($isRevision);
		$objPHPExcel = self::loadQCSchedulesInExcel($qcSchedules, $objPHPExcel, 3,$isRevision);
		
		if($isEmail){
			ob_start();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			$excelOutput = ob_get_contents();
			ob_end_clean();
			return $excelOutput;
		}
		// der ( 'Content-Type: application/vnd.ms-excel' );
		header ( "Content-Disposition: attachment;filename=".$fileName.".xls" );
		header ( 'Cache-Control: max-age=0' );
		header ( 'Cache-Control: max-age=1' );
		header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); // Date in the past
		header ( 'Last-Modified: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' ); // always modified
		header ( 'Cache-Control: cache, must-revalidate' ); // HTTP/1.1
		header ( 'Pragma: public' ); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean ();
		$objWriter->save ( 'php://output' );
	}

	public static function exportRejectedQCSchedules($rejectedQcSchedules, $isEmail = false) {
		$objPHPExcel = self::cookRejectedQCScheduledPHPExcelHeader();
		$objPHPExcel = self::loadRejectedQCSchedulesInExcel($rejectedQcSchedules, $objPHPExcel);
		
		if($isEmail){
			ob_start();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			$excelOutput = ob_get_contents();
			ob_end_clean();
			return $excelOutput;
		}
		// der ( 'Content-Type: application/vnd.ms-excel' );
		$date = new DateTime();
		$fileName = "Rejected_QC_Schedule".$date->format('Y-m-d H-i-s');
		header ( "Content-Disposition: attachment;filename=".$fileName.".xls" );
		header ( 'Cache-Control: max-age=0' );
		header ( 'Cache-Control: max-age=1' );
		header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); // Date in the past
		header ( 'Last-Modified: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' ); // always modified
		header ( 'Cache-Control: cache, must-revalidate' ); // HTTP/1.1
		header ( 'Pragma: public' ); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean ();
		$objWriter->save ( 'php://output' );
	}
	
	public static function exportQCSchedulesBulkUpdate($qcSchedules,$qcScheduleNew,$isEmail=false){
		$arr = array();
		array_push($arr, $qcScheduleNew);
		$allSchedules = array_merge($arr,$qcSchedules);
		
		$objPHPExcel = self::cookQCScheduledPHPExcelHeader();
		$objPHPExcel = self::loadQCSchedulesInExcel($allSchedules, $objPHPExcel, 3);
 		$worksheet = $objPHPExcel->getActiveSheet();
		$row = 3;
		$lastColumn = $worksheet->getHighestColumn();
		$lastRow = $worksheet->getHighestRow();
		$lastColumn++;
		for ($column = 'A'; $column != $lastColumn; $column++) {
			$cell = $worksheet->getCell($column.$row);
			if($cell->getValue() != null){
				$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( $column.$row )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( '00FF00' );
				for($i=4; $i<=$lastRow; $i++){
					$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( $column.$i )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'FF0000' );
				}
			}
		}
		if($isEmail){
			ob_start();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			$excelOutput = ob_get_contents();
			ob_end_clean();
			return $excelOutput;
		}
		// der ( 'Content-Type: application/vnd.ms-excel' );
		header ( 'Content-Disposition: attachment;filename="QCSchedules.xls"' );
		header ( 'Cache-Control: max-age=0' );
		header ( 'Cache-Control: max-age=1' );
		header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); // Date in the past
		header ( 'Last-Modified: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' ); // always modified
		header ( 'Cache-Control: cache, must-revalidate' ); // HTTP/1.1
		header ( 'Pragma: public' ); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean ();
		$objWriter->save ( 'php://output' );
	}
	
	private static function loadQCSchedulesInExcel($qcSchedules,$objPHPExcel,$startFromRow,$isRevision=false){
		$count = $startFromRow;
		$i = 0;
		foreach ( $qcSchedules as $qcSchedule ) {
			if($isRevision){
				$colName = self::getColName($i ++, $count);
				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["revisedbyusername"] );

				$colName = self::getColName($i ++, $count);
				$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["lastmodifiedon"] );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["scheduleseq"] );
			
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["qccode"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["poqccode"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["classcode"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["po"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["potype"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["itemnumbers"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["poquantity"] );

			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $qcSchedule ["samplequantity"] );

			$shipDate = $qcSchedule ["shipdate"];
			if (! empty ( $shipDate )) {
				$shipDate = self::getDateStr ( $shipDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $shipDate );
			
			$latestShipDate = $qcSchedule ["latestshipdate"];
			if (! empty ( $latestShipDate )) {
				$latestShipDate = self::getDateStr ( $latestShipDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $latestShipDate );
		
			$scReadyDate = $qcSchedule ["screadydate"];
			if (! empty ( $scReadyDate )) {
				$scReadyDate = self::getDateStr ( $scReadyDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $scReadyDate );
		
			$scFinalInspectionDate = $qcSchedule ["scfinalinspectiondate"];
			if (! empty ( $scFinalInspectionDate )) {
				$scFinalInspectionDate = self::getDateStr ( $scFinalInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $scFinalInspectionDate );
		
			$scMiddleInspectionDate = $qcSchedule ["scmiddleinspectiondate"];
			if (! empty ( $scMiddleInspectionDate )) {
				$scMiddleInspectionDate = self::getDateStr ( $scMiddleInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $scMiddleInspectionDate );
		
			$scFirstInspectionDate = $qcSchedule ["scfirstinspectiondate"];
			if (! empty ( $scFirstInspectionDate )) {
				$scFirstInspectionDate = self::getDateStr ( $scFirstInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $scFirstInspectionDate );
		
			$scProductionStartDate = $qcSchedule ["scproductionstartdate"];
			if (! empty ( $scProductionStartDate )) {
				$scProductionStartDate = self::getDateStr ( $scProductionStartDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $scProductionStartDate );
		
			$scGraphicReceiveDate = $qcSchedule ["scgraphicsreceivedate"];
			if (! empty ( $scGraphicReceiveDate )) {
				$scGraphicReceiveDate = self::getDateStr ( $scGraphicReceiveDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $scGraphicReceiveDate );
		
			$apReadyDate = $qcSchedule ["apreadydate"];
			if (! empty ( $apReadyDate )) {
				$apReadyDate = self::getDateStr ( $apReadyDate );
			}
			
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apReadyDate );
			
			$apFinalInspectionDate = $qcSchedule ["apfinalinspectiondate"];
			if (! empty ( $apFinalInspectionDate )) {
				$apFinalInspectionDate = self::getDateStr ( $apFinalInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apFinalInspectionDate );
			
			$apMiddleInspectionDate = $qcSchedule ["apmiddleinspectiondate"];
			if (! empty ( $apMiddleInspectionDate )) {
				$apMiddleInspectionDate = self::getDateStr ( $apMiddleInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apMiddleInspectionDate );
			
			$apFirstInspectionDate = $qcSchedule ["apfirstinspectiondate"];
			if (! empty ( $apFirstInspectionDate )) {
				$apFirstInspectionDate = self::getDateStr ( $apFirstInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apFirstInspectionDate );
			
			$apProductionStartDate = $qcSchedule ["approductionstartdate"];
			if (! empty ( $apProductionStartDate )) {
				$apProductionStartDate = self::getDateStr ( $apProductionStartDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apProductionStartDate );
			
			$apGraphicReceiveDate = $qcSchedule ["apgraphicsreceivedate"];
			if (! empty ( $apGraphicReceiveDate )) {
				$apGraphicReceiveDate = self::getDateStr ( $apGraphicReceiveDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apGraphicReceiveDate );
				
			$apFirstInspectionDateNaReason = $qcSchedule ["apfirstinspectiondatenareason"];
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apFirstInspectionDateNaReason );
			
			$apMiddleInspectionDateNaReason = $qcSchedule ["apmiddleinspectiondatenareason"];
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apMiddleInspectionDateNaReason );
			
			$apGraphicReceiveDateNaReason = $qcSchedule ["apgraphicsreceivedatenareason"];
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $apGraphicReceiveDateNaReason );
			
			
			$acReadyDate = $qcSchedule ["acreadydate"];
			if (! empty ( $acReadyDate )) {
				$acReadyDate = self::getDateStr ( $acReadyDate );
			}
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acReadyDate );
		
			$acFinalInspectionDate = $qcSchedule ["acfinalinspectiondate"];
			if (! empty ( $acFinalInspectionDate )) {
				$acFinalInspectionDate = self::getDateStr ( $acFinalInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acFinalInspectionDate );
		
			$acMiddleInspectionDate = $qcSchedule ["acmiddleinspectiondate"];
			if (! empty ( $acMiddleInspectionDate )) {
				$acMiddleInspectionDate = self::getDateStr ( $acMiddleInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acMiddleInspectionDate );
		
			$acFirstInspectionDate = $qcSchedule ["acfirstinspectiondate"];
			if (! empty ( $acFinalInspectionDate )) {
				$acFirstInspectionDate = self::getDateStr ( $acFirstInspectionDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acFirstInspectionDate );
		
			$acProductionStartDate = $qcSchedule ["acproductionstartdate"];
			if (! empty ( $acProductionStartDate )) {
				$acProductionStartDate = self::getDateStr ( $acProductionStartDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acProductionStartDate );
		
			$acGraphicReceiveDate = $qcSchedule ["acgraphicsreceivedate"];
			if (! empty ( $acGraphicReceiveDate )) {
				$acGraphicReceiveDate = self::getDateStr ( $acGraphicReceiveDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acGraphicReceiveDate );
		
			$acFirstInspectionNotes = strip_tags ( $qcSchedule ["acfirstinspectionnotes"] );
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acFirstInspectionNotes );
				
			$acMiddleInspectionNotes = strip_tags ( $qcSchedule ["acmiddleinspectionnotes"] );
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $acMiddleInspectionNotes );
			
			$notes = strip_tags ( $qcSchedule ["notes"] );
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $notes );
			
			$status = strip_tags ( $qcSchedule ["status"] );
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $status );
			
			$approvalResponse = strip_tags ( $qcSchedule ["responsetype"] );
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $approvalResponse );
			
			$iscompleted = strip_tags ( $qcSchedule ["iscompleted"] );
			if($iscompleted == 1){
				$iscompleted = "Yes";
			}else{
				$iscompleted = "";
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $iscompleted );
			
			
			
			$count ++;
			$i = 0;
		}
		if($isRevision){
			$objPHPExcel->getActiveSheet()->getStyle ( 'A1:B1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'dff9d8');
			$objPHPExcel->getActiveSheet()->getStyle ( 'A2:B2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'dff9d8' );

			$objPHPExcel->getActiveSheet()->getStyle ( 'C1:S1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'cce6ff' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'C2:S2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'cce6ff' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'T1:AB1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'e6ffcc' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'T2:AB2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'e6ffcc' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AC1:AK1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffccdd' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AC2:AK2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffccdd' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AL1:AN1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffc2b3' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AL2:AN2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffc2b3' );
			$objPHPExcel->getActiveSheet()->mergeCells ( 'A1:B1' );
			$objPHPExcel->getActiveSheet()->mergeCells ( 'C1:S1' );
			$objPHPExcel->getActiveSheet()->mergeCells ( 'T1:AB1' );
			$objPHPExcel->getActiveSheet()->mergeCells ( 'AC1:AK1' );
			$objPHPExcel->getActiveSheet()->getStyle('A1:AN1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A1:AN1')->getFont()->setSize(16);
		}else{
			$objPHPExcel->setActiveSheetIndex ( 0 );
			$objPHPExcel->getActiveSheet()->setTitle ( "QCSchedules" );
			$objPHPExcel->getActiveSheet()->getStyle ( 'A1:Q1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'cce6ff' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'A2:Q2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'cce6ff' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'R1:Z1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'e6ffcc' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'R2:Z2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'e6ffcc' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AA1:AI1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffccdd' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AA2:AI2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffccdd' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AJ1:AL1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffc2b3' );
			$objPHPExcel->getActiveSheet()->getStyle ( 'AJ2:AL2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffc2b3' );
			$objPHPExcel->getActiveSheet()->mergeCells ( 'A1:Q1' );
			$objPHPExcel->getActiveSheet()->mergeCells ( 'R1:Z1' );
			$objPHPExcel->getActiveSheet()->mergeCells ( 'AA1:AI1' );
			$objPHPExcel->getActiveSheet()->getStyle('A1:AL1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A1:AL1')->getFont()->setSize(16);
		}
		
		return $objPHPExcel;
	}
	private static function cookQCScheduledPHPExcelHeader($isRevision=false){
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$objPHPExcel = new PHPExcel ();
		$objPHPExcel->getProperties ()->setCreator ( "AlpineBIAdmin" )->setLastModifiedBy ( "AlpineBIAdmin" )->setTitle ( "QCSchedules" )->setSubject ( "QCSchedules" )->setDescription ( "QCSchedules" )->setKeywords ( "office 2007 openxml php" )->setCategory ( "Report" );
		
		if($isRevision){
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Revisions" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( $colName )->getAlignment ()->applyFromArray ( array (
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			) );
			$i++;
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Scheduled" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( $colName )->getAlignment ()->applyFromArray ( array (
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			) );
			
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "T1", "Appointment" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "T1" )->getAlignment ()->applyFromArray ( array (
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			) );
			
			
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "AC1", "Actual" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "AC1" )->getAlignment ()->applyFromArray ( array (
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			) );
		}else{
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Scheduled" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( $colName )->getAlignment ()->applyFromArray ( array (
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			) );
			
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "R1", "Appointment" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "R1" )->getAlignment ()->applyFromArray ( array (
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			) );
			
			
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "AA1", "Actual" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "AA1" )->getAlignment ()->applyFromArray ( array (
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			) );
		}
		//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "S1", "Review" );
		
		$count = 2;
		$i = 0;
		
		if($isRevision){
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Revised By" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );

			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Revised On" );
			$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		}
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "ID" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "QC" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "PoIncharge" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Class Code" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "PO#" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "PO Type" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Item No" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Po Quantity" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Sample Quantity" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Ship Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Latest Ship Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Ready Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Final \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Middle \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "First \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Production \nStart Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Graphics Receive \nDate" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		//APPOINTMENT HEADERS
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Ready Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Final \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Middle \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "First \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Production \nStart Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Graphics \nReceive Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "First Inspection \nDate NA Reason" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Middle Inspection \nDate NA Reason" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Graphics Receive \nDate NA Reason" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		//ACTUAL HEADERS
		$colName = PHPExcel_Cell::stringFromColumnIndex($i ++) . $count;
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Ready Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Final \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Middle \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "First \nInspection Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Production \nStart Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Graphics \nReceive Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "First \nInspection Notes" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Middle \nInspection Notes" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Final \nInspection Notes" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Status" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Approval" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Completed" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		return $objPHPExcel;
	}
	private static function cookRejectedQCScheduledPHPExcelHeader(){
		$count = 1;
		$i = 0;
		$objPHPExcel = new PHPExcel ();
		$objPHPExcel->getProperties ()->setCreator ( "AlpineBIAdmin" )->setLastModifiedBy ( "AlpineBIAdmin" )->setTitle ( "RejectedQCSchedules" )->setSubject ( "RejectedQCSchedules" )->setDescription ( "RejectedQCSchedules" )->setKeywords ( "office 2007 openxml php" )->setCategory ( "Report" );
		$count = 1;
		$i = 0;
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "PO" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Item Number" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Class Code" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "QC" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "PO Incharge" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Applied By" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Applied On" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Responded By" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Responded On" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Status" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Comments" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );

		$objPHPExcel->setActiveSheetIndex ( 0 );
		$objPHPExcel->getActiveSheet()->setTitle ( "QC Rejected" );
		$objPHPExcel->getActiveSheet()->getStyle ( 'A1:K1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'f8cbad' );
		$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(14);
		return $objPHPExcel;
	}
	private static function loadRejectedQCSchedulesInExcel($rejectedQcSchedules, $objPHPExcel){
		$count = 2;
		$i = 0;
		foreach ( $rejectedQcSchedules as $rejectedQcSchedule ) {
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["po"] );

			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["itemnumbers"] );

			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["classcode"] );
			
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["qcname"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["poinchargeusername"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["appliedbyuser"] );

			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["appliedon"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["respondedbyuser"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["respondedon"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["responsetype"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $rejectedQcSchedule ["responsecomments"] );
			
			$count ++;
			$i = 0;
		}
		return $objPHPExcel;
	}
	private static function getDateStr($date){
		$format = 'Y-m-d';
		if(!empty($date)){
			if(!$date instanceof DateTime){
				$date = DateUtil::StringToDateByGivenFormat($format, $date);
			}
			$date = $date->format("n/j/y");
		}
		return $date;
	}
	private static function getColName($i,$rowNum=null){
		$colName = PHPExcel_Cell::stringFromColumnIndex($i);
		if($rowNum != null){
			return $colName . $rowNum;
		}
		return $colName;
	}
	public static function exportInstructionManuals($instructionManuals,$fileName,$isEmail = false){
		$objPHPExcel = self::cookInstructionManualsPHPExcelHeader();
		$objPHPExcel = self::loadInstructionManualsInExcel($instructionManuals, $objPHPExcel, 3);
		
		if($isEmail){
			ob_start();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			$excelOutput = ob_get_contents();
			ob_end_clean();
			return $excelOutput;
		}
		// der ( 'Content-Type: application/vnd.ms-excel' );
		header ( "Content-Disposition: attachment;filename=".$fileName.".xls" );
		header ( 'Cache-Control: max-age=0' );
		header ( 'Cache-Control: max-age=1' );
		header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); // Date in the past
		header ( 'Last-Modified: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' ); // always modified
		header ( 'Cache-Control: cache, must-revalidate' ); // HTTP/1.1
		header ( 'Pragma: public' ); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean ();
		$objWriter->save ( 'php://output' );
	}
	private static function loadInstructionManualsInExcel($instructionManuals,$objPHPExcel,$startFromRow){
		$count = $startFromRow;
		$i = 0;
		foreach ( $instructionManuals as $instructionManual ) {
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["enteredbyname"] );

			$entrydate = $instructionManual ["entrydate"];
			if (! empty ( $entrydate )) {
				$entrydate = self::getDateStr ( $entrydate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $entrydate );

			$poShipDate = $instructionManual ["poshipdate"];
			if (! empty ( $poShipDate )) {
				$poShipDate = self::getDateStr ( $poShipDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $poShipDate );
		
			$approvedManualDueDate = $instructionManual ["approvedmanualdueprintdate"];
			if (! empty ( $approvedManualDueDate )) {
				$approvedManualDueDate = self::getDateStr ( $approvedManualDueDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $approvedManualDueDate );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["itemnumber"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["classcode"] );

			$graphicDueDate = $instructionManual ["graphicduedate"];
			if (! empty ( $graphicDueDate )) {
				$graphicDueDate = self::getDateStr ( $graphicDueDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $graphicDueDate );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, InstructionManualNewOrRevised::getValue($instructionManual ["neworrevised"]) );
			
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, InstructionManualType::getValue($instructionManual ["instructionmanualtype"]) );
		
			$customerNameString = "";
			$customersNameArray = array();
			if(!empty($instructionManual ["customernames"])){
			    $tempCustomersNameArray = explode(",",$instructionManual ["customernames"]);
			    foreach ($tempCustomersNameArray as $customerName){
			        array_push($customersNameArray,CustomerNameType::getValue($customerName)) ;
			    }
			}
			$customerNameString = implode(",",$customersNameArray);
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $customerNameString );

			$requestTypeString = "";
			$requestTypeArray = array();
			if(!empty($instructionManual ["requesttypes"])){
			    $tempRequestTypeArray = explode(",",$instructionManual ["requesttypes"]);
			    foreach ($tempRequestTypeArray as $requestType){
			        array_push($requestTypeArray,InstructionManualRequestedChanges::getValue($requestType));
			    }
			}
			$requestTypeString = implode(",",$requestTypeArray);
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $requestTypeString );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["isprivatelabel"] == "1" ? "Yes" : "No");
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["notestochina"] );
		
			$diagramSavedDate = $instructionManual ["diagramsaveddate"];
			if (! empty ( $diagramSavedDate )) {
				$diagramSavedDate = self::getDateStr ( $diagramSavedDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $diagramSavedDate );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["diagramsavedbyname"] );
			
			//my changes....
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["finalduedate"] );
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["confirmedshipdate"] );
			$colName = self::getColName($i ++, $count);

			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["notestousa"] );
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["assignedtoname"] );
		
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, InstructionManualLogStatus::getValue($instructionManual ["instructionmanuallogstatus"]));
			
			$startedDate = $instructionManual ["starteddate"];
			if (! empty ( $startedDate )) {
				$startedDate = self::getDateStr ( $startedDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $startedDate );
			
			$supervisorReturnDate = $instructionManual ["supervisorreturndate"];
			if (! empty ( $supervisorReturnDate )) {
				$supervisorReturnDate = self::getDateStr ( $supervisorReturnDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $supervisorReturnDate );
			
			$managerReturnDate = $instructionManual ["managerreturndate"];
			if (! empty ( $managerReturnDate )) {
				$managerReturnDate = self::getDateStr ( $managerReturnDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $managerReturnDate );

			$buyerReturnDate = $instructionManual ["buyerreturndate"];
			if (! empty ( $buyerReturnDate )) {
				$buyerReturnDate = self::getDateStr ( $buyerReturnDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $buyerReturnDate );

			$sentToChinaDate = $instructionManual ["senttochinadate"];
			if (! empty ( $sentToChinaDate )) {
				$sentToChinaDate = self::getDateStr ( $sentToChinaDate );
			}
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $sentToChinaDate );
			
			$colName = self::getColName($i ++, $count);
			$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, $instructionManual ["iscompleted"] == "1" ? "Yes" : "No" );
		
			$count ++;
			$i = 0;
		}
		$objPHPExcel->setActiveSheetIndex ( 0 );
		$objPHPExcel->getActiveSheet()->setTitle ( "InstructionManual" );
		$objPHPExcel->getActiveSheet()->getStyle ( 'A1:M2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'f8cbad' );
		//$objPHPExcel->getActiveSheet()->getStyle ( 'A2:M2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'f8cbad' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'N1:R2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffffb9' );
		//$objPHPExcel->getActiveSheet()->getStyle ( 'N2:P2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffffb9' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'S1:Z2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'a4c2f4' );
		//$objPHPExcel->getActiveSheet()->getStyle ( 'Q2:X2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'a4c2f4' );
		$objPHPExcel->getActiveSheet()->mergeCells ( 'A1:M1' );
		$objPHPExcel->getActiveSheet()->mergeCells ( 'N1:R1' );
		$objPHPExcel->getActiveSheet()->mergeCells ( 'S1:Z1' );
		//$objPHPExcel->getActiveSheet()->mergeCells ( 'Q1:X1' );
		$objPHPExcel->getActiveSheet()->getStyle('A1:AI1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:AI1')->getFont()->setSize(16);
		return $objPHPExcel;
	}
	private static function cookInstructionManualsPHPExcelHeader(){
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$objPHPExcel = new PHPExcel ();
		$objPHPExcel->getProperties ()->setCreator ( "AlpineBIAdmin" )->setLastModifiedBy ( "AlpineBIAdmin" )->setTitle ( "InstructionManual" )->setSubject ( "InstructionManual" )->setDescription ( "InstructionManual" )->setKeywords ( "office 2007 openxml php" )->setCategory ( "Report" );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "To be Filled by USA Team" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( $colName )->getAlignment ()->applyFromArray ( array (
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		) );
		
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "N1", "To be Filled by China Team" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "N1" )->getAlignment ()->applyFromArray ( array (
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		) );
		
		
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "S1", "To be Filled by Technical Writer" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "S1" )->getAlignment ()->applyFromArray ( array (
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		) );
		//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "S1", "Review" );
		
		$count = 2;
		$i = 0;

		// TO BE FILLED BY USA TEAM
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Entered By" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Entry Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "PO Ship Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Approved manual due for print" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Item no." );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Class Code" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Diagram due date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "New or Revised" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Instruction Manual Type" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Customers" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Requested changes" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Is Private Label" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Notes to China Office" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		// TO BE FILLED BY CHINA TEAM
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Date diagram saved" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Diagram saved by" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		//my changes from here...
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Final Due Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Confirmed Ship Date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Notes to USA Office" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		// TO BE FILLED BY TECHNICAL WRITER
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Assigned to" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Status" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Start date" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Supervisor return" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Manager Return" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Buyer return" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Sent to china" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Is Completed" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		
		return $objPHPExcel;
	}
	// Export Requests
	public static function exportRequests($requestTypesArr,$fileName,$isEmail = false){
		$objPHPExcel = new PHPExcel ();
		$objPHPExcel->getProperties ()->setCreator ( "AlpineBIAdmin" )->setLastModifiedBy ( "AlpineBIAdmin" )->setTitle ( "Project" )->setSubject ( "Project" )->setDescription ( "Project" )->setKeywords ( "office 2007 openxml php" )->setCategory ( "Report" );
		$sheetNo = 0;
		
		foreach($requestTypesArr as $key => $value){
			
			$objPHPExcel->setActiveSheetIndex($sheetNo)->setTitle($key);
			self::cookRequestsPHPExcelHeader($value,$objPHPExcel,$sheetNo);
			self::loadRequestsInExcel($value, $objPHPExcel, 3, $sheetNo);
			if($sheetNo < count($requestTypesArr) - 1){
				$objPHPExcel->createSheet();
			}
			$sheetNo++;
		}
		$objPHPExcel->setActiveSheetIndex ( 0 );
		if($isEmail){
			ob_start();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			$excelOutput = ob_get_contents();
			ob_end_clean();
			return $excelOutput;
		}
		// der ( 'Content-Type: application/vnd.ms-excel' );
		header ( "Content-Disposition: attachment;filename=".$fileName.".xls" );
		header ( 'Cache-Control: max-age=0' );
		header ( 'Cache-Control: max-age=1' );
		header ( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); // Date in the past
		header ( 'Last-Modified: ' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' ); // always modified
		header ( 'Cache-Control: cache, must-revalidate' ); // HTTP/1.1
		header ( 'Pragma: public' ); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' );
		ob_end_clean ();
		$objWriter->save ( 'php://output' );
	}
	private static function cookRequestsPHPExcelHeader($records,$objPHPExcel,$sheetNo){
		$count = 1;
		$i = 0;
		$colName = self::getColName($i, $count);
		
		$objPHPExcel->setActiveSheetIndex ( $sheetNo )->setCellValue ( $colName, $records[0] );
		$objPHPExcel->setActiveSheetIndex ( $sheetNo )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
		$count++;
		$colName = self::getColName($i++, $count);
		$headerArr = explode(",",$records[1]);
		
		foreach($headerArr as $key => $value){
			$objPHPExcel->setActiveSheetIndex ( $sheetNo )->setCellValue ( $colName, $value );
			$objPHPExcel->setActiveSheetIndex ( $sheetNo )->getColumnDimension ( self::getColName($i) )->setAutoSize ( true );
			$colName = self::getColName($i ++, $count);
		}
		$i-=2;
		$colName = self::getColName($i, $count);
		$objPHPExcel->setActiveSheetIndex ( $sheetNo );
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $colName)->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'f8cbad' );
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $colName)->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $colName)->getFont()->setSize(12);
		$colName = self::getColName($i, --$count);
		$objPHPExcel->getActiveSheet()->mergeCells ( 'A1:' . $colName );
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $colName)->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'dbeaee' );
		$objPHPExcel->getActiveSheet()->getStyle('A1:' . $colName)->getFont()->setSize(16);
	}
	private static function loadRequestsInExcel($records,$objPHPExcel,$startFromRow,$sheetNo){
		$colName = '';
		$count = $startFromRow;
		foreach ( $records as $key => $recordStr ) {
			if($key == 0 || $key == 1){
				continue;
			}
			$recordArr = explode(",",$recordStr);
			$i = 0;
			foreach($recordArr as $record){
				$colName = self::getColName($i ++, $count);
				$objPHPExcel->setActiveSheetIndex ( $sheetNo )->setCellValue ( $colName, $record );
			}
			$count ++;
			$i = 0;
		}
	}
}