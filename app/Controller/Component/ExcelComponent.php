<?php
App::import('Vendor', 'Spreadsheet_Excel_Reader', array('file' => 'excelreader/reader.php'));
class ExcelComponent extends Component {
	var $key;
	var $controller;

	public function startup(&$controller) {
		$this->controller=&$controller;
		$this->key = $this->controller->params['controller'];
	}

	public function readVenta($fileName){
		$filaExcel = 6;
		Configure::write('debug', 0);
		try {
			$inputFileType = PHPExcel_IOFactory::identify($fileName);
			$objReader     = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($fileName);
		} catch (Exception $e) {
		    die('Error loading file "' . pathinfo($fileName, PATHINFO_BASENAME) 
		    . '": ' . $e->getMessage());
		}
		$sheet      = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();

		$result = array();
		for ($i = $filaExcel; $i <= $highestRow ; $i++) {
			$row = array();
			for ($j = 0; $j < 31; $j++) {
				$row[] = utf8_encode($sheet->getCellByColumnAndRow($j,$i)->getCalculatedValue());
			}
			$result[] = $row;
		}
		return $result;

	}

}