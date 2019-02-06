<?php
class ExportUtil{
	public static function exportCustomers($customers){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("Customers")
		->setSubject("Customers")
		->setDescription("Customers")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "customerid");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "name");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "phone");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "address");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "address1");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "city");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "st");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "zip");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "email");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "attention");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "fax");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "terms");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales1");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales2");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales3");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "sales4");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "createdate");
		$count = 2;
		$i = 0;
		foreach($customers as $customer){
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getCustomerId());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getCustomerName());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getPhone());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getAddress());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$customer->getAddress1());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getCity());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getState());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getZip());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getEmail());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getAttention());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getFax());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getTerms());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales1());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales2());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales3());
			
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $customer->getSales4());
			
			$createdDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $customer->getCreateDate());
			$colName = $alphas[$i++]. $count;
			$createdDateStr = $createdDate->format("m/d/y"); 
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $createdDateStr);
			
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Report");
		 
		 
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		 
		 
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Customers.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		 
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	
	public static function exportItems($items){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin")
		->setLastModifiedBy("Admin")
		->setTitle("customers")
		->setSubject("Items")
		->setDescription("Items")
		->setKeywords("office 2007 openxml php")
		->setCategory("Report");
		$alphas = range('A', 'Z');
		$rowCount = 1;
		$count = 1;
		$i = 0;
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item No");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Description");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Class");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Dept#");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Status ( Color )");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Unit");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Pc/Cs");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Disc.");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "In Stock Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Alloc. Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "S/O Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "A/V Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "P/O Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "OW Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Proj.Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "YTD Sold Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Last Year Sold Qty");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, ".Com D Ship");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "ShowSpecial");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Distributor");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "DealerPrice");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Crzy Dis Sp");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Qty Wt");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "MIn Stk");
		$colName = $alphas[$i++]. $count;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, "Item Cost");
	
		$count = 2;
		$i = 0;
		foreach($items as $item){
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItemNo());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDescription());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getClass());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDept());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName,$item->getStatus());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getUnit());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPccs());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDisc());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getInStockQty());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getAllocQty());
	
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getSoQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getAvQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getPoQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getOwQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getProjQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getYtdSoldQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getLastYearSoldQty());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getComdShip());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getShowSpecial());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDistributor());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getDealerPrice());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getCrzyDissp());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getQtyWt());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getMinStk());
				
			$colName = $alphas[$i++]. $count;
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($colName, $item->getItemCost());
			$count++;
			$i = 0;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Report");
			
			
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
			
			
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="items.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
			
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
}