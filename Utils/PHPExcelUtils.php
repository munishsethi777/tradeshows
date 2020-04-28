<?php
class PHPExcelUtil {
	
	public static function exportQCSchedules($qcSchedules,$isEmail = false){
		$objPHPExcel = self::cookQCScheduledPHPExcelHeader();
		$objPHPExcel = self::loadQCSchedulesInExcel($qcSchedules, $objPHPExcel, 3);
		
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
	
	private static function loadQCSchedulesInExcel($qcSchedules,$objPHPExcel,$startFromRow){
		$count = $startFromRow;
		$i = 0;
		foreach ( $qcSchedules as $qcSchedule ) {
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
		$objPHPExcel->setActiveSheetIndex ( 0 );
		$objPHPExcel->getActiveSheet()->setTitle ( "QCSchedules" );
		$objPHPExcel->getActiveSheet()->getStyle ( 'A1:O1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'cce6ff' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'A2:O2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'cce6ff' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'P1:X1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'e6ffcc' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'P2:X2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'e6ffcc' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'Y1:AG1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffccdd' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'Y2:AG2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffccdd' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'AH1:AJ1' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffc2b3' );
		$objPHPExcel->getActiveSheet()->getStyle ( 'AH2:AJ2' )->getFill ()->setFillType ( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor ()->setRGB ( 'ffc2b3' );
		$objPHPExcel->getActiveSheet()->mergeCells ( 'A1:N1' );
		$objPHPExcel->getActiveSheet()->mergeCells ( 'P1:X1' );
		$objPHPExcel->getActiveSheet()->mergeCells ( 'Y1:AG1' );
		$objPHPExcel->getActiveSheet()->getStyle('A1:AI1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1:AI1')->getFont()->setSize(16);
		
		return $objPHPExcel;
	}
	private static function cookQCScheduledPHPExcelHeader(){
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$objPHPExcel = new PHPExcel ();
		$objPHPExcel->getProperties ()->setCreator ( "AlpineBIAdmin" )->setLastModifiedBy ( "AlpineBIAdmin" )->setTitle ( "QCSchedules" )->setSubject ( "QCSchedules" )->setDescription ( "QCSchedules" )->setKeywords ( "office 2007 openxml php" )->setCategory ( "Report" );
		
		$colName = self::getColName($i ++, $count);
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( $colName, "Scheduled" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( $colName )->getAlignment ()->applyFromArray ( array (
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		) );
		
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "P1", "Appointment" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "P1" )->getAlignment ()->applyFromArray ( array (
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		) );
		
		
		$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "Y1", "Actual" );
		$objPHPExcel->setActiveSheetIndex ( 0 )->getStyle ( "Y1" )->getAlignment ()->applyFromArray ( array (
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		) );
		//$objPHPExcel->setActiveSheetIndex ( 0 )->setCellValue ( "S1", "Review" );
		
		$count = 2;
		$i = 0;
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
	
}