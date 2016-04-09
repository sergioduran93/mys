<?php 
class ExcelWriteComponent extends Component {
	public $inputFileType = 'Excel2007';

	public function downloadFile($file = null){
		if (file_exists($file)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
			exit;
		}
	}

	public function generateCode($length = 3){
        $password = "";
        $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
        $maxlength = strlen($possible);
      
        // check for length overflow and truncate if necessary
        if ($length > $maxlength) {
            $length = $maxlength;
        }
        
        $i = 0; 
        while ($i < $length) { 
          $char = substr($possible, mt_rand(0, $maxlength-1), 1);
            
          if (!strstr($password, $char)) { 
            $password .= $char;
            $i++;
          }
        }
        return $password;
    }

	public function initialize(Controller $controller){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		set_include_path(get_include_path() . PATH_SEPARATOR . '../../Vendor/excel_writer/Classes/');
		
		/** PHPExcel_IOFactory */
		include './../Vendor/excel_writer/Classes/PHPExcel/IOFactory.php';
	}

	public function startup(Controller $controller){}

	public function beforeRender(Controller $controller){}

	public function shutdown(Controller $controller){}

    public function descuentos($data = null){
		/*
			$pathDetails = pathinfo(dirname(__FILE__));
			$this->log($pathDetails);
			$libsPath = $pathDetails['dirname'];
			$libsPath    = substr($libsPath,0,-10);
			$rendererName        = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
			$rendererLibrary     = 'dompdf';
			$rendererLibraryPath = $libsPath.'/Vendor/excel_writer/Classes/PHPExcel/Writer/'.$rendererName;
			if(!PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath)){
				die($rendererLibraryPath);
			}
		*/

    	$inputFileName      = 'templates/descuentos.xlsx';
		$inputFileNameShort = basename($inputFileName);

		$objReader = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel  = $objReader->load($inputFileName);
		$objWorksheet = $objPHPExcel->getActiveSheet();

		$objPHPExcel->getActiveSheet()->setCellValue('B7', $data[0]['Cliente']['documento']);
		$objPHPExcel->getActiveSheet()->setCellValue('B8', $data[0]['Cliente']['nombres']);
		$objPHPExcel->getActiveSheet()->setCellValue('B9', $data[0]['Cliente']['apellidos']);
		$objPHPExcel->getActiveSheet()->setCellValue('B10', $data[0]['Cliente']['telefono']);
		$objPHPExcel->getActiveSheet()->setCellValue('B11', $data[0]['Cliente']['direccion']);
		$objPHPExcel->getActiveSheet()->setCellValue('B12', $data[0]['Cliente']['email']);

		$row = 16;
		foreach ($data as $key => $value) {
			if(!empty($data[$key]['Descuento']['unidad_inicial'])){
				$row = $row + 1;				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $data[$key]['Descuento']['origen']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $data[$key]['Descuento']['destino']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $data[$key]['Descuento']['unidad_inicial']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $data[$key]['Descuento']['unidad_final']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $data[$key]['Descuento']['unidad_porcentaje']);
			}
		}

		$row = 16;
		foreach ($data as $key => $value) {
			if(!empty($data[$key]['Descuento']['kilo_inicial'])){
				$row = $row + 1;
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $data[$key]['Descuento']['origen']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $data[$key]['Descuento']['destino']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $data[$key]['Descuento']['kilo_inicial']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $data[$key]['Descuento']['kilo_final']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $data[$key]['Descuento']['kilo_porcentaje']);
			}
		}
		$nombreArchivo = "Convenios_".date('Y-m-d').'_'.$data[0]['Cliente']['apellidos'].'.pdf';
		$outputFileName = basename($nombreArchivo);


		ob_end_clean();        
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		
		/*
				header('Content-Type: application/pdf');
				header('Content-Disposition: attachment;filename="myExportFile.pdf"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
		*/

		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');

		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }
    public function Tarifas($cli = null ,$data = null, $emp = null, $preview = null){
    	if(empty($preview)){
  		  	$inputFileName = 'templates/convenios.xlsx';
			$row = 15;
		} else {
  		  	$inputFileName = 'templates/conveniosVer.xlsx';
			$row = 9;
		}

		$inputFileNameShort = basename($inputFileName);

		$objReader = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel  = $objReader->load($inputFileName);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Convenios");

		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-8), $cli['Cliente']['documento']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-7), $cli['Cliente']['nombres']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-6), $cli['Cliente']['apellidos']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-5), $cli['Cliente']['telefono']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-4), $cli['Cliente']['direccion']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-3), $cli['Cliente']['email']);

		$abcd = 65;
		$columnEmp = array();
		foreach ($emp as $key => $value) {
			$abcd = $abcd + 2;
			$columnEmp[$value.'Tarifa'] = chr($abcd);
			$columnEmp[$value.'Max']    = chr($abcd+1);
			$objPHPExcel->getActiveSheet()->setCellValue(chr($abcd).$row, $value);
			$objPHPExcel->getActiveSheet()->setCellValue(chr($abcd+1).$row, 'Kg. Máx. ('.$value.')');
		}
		
		$abcd = $abcd + 2;
		$objPHPExcel->getActiveSheet()->setCellValue(chr($abcd).$row, 'Kg. adicional');
		$columnEmp['Adicion'] = chr($abcd);


		foreach ($data as $origen => $todo) {
			foreach ($todo as $destino => $valores) {
				$row = $row + 1;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $origen);		
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $destino);

				foreach ($valores as $tipo => $valor) {
					if($tipo != 'Adicion'){
						foreach ($valor as $key => $value) {
						//	$this->log($origen.' - '.$destino.' => '.$tipo.' ('.$key.' - '.$value.')');
							$objPHPExcel->getActiveSheet()->setCellValue($columnEmp[$tipo.$key].$row, $value);
						}
					} else {
						$objPHPExcel->getActiveSheet()->setCellValue($columnEmp['Adicion'].$row, $valor);
					}
				}
			}
		}

		$nombreArchivo = "Tarifas_".date('Y-m-d').'_'.$data[0]['Cliente']['apellidos'].'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();        
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		
		if(empty($preview)){
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		} else {
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
		}

		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

	public function TarifasD($cli = null ,$data = null, $preview = null){
    	if(empty($preview)){
  		  	$inputFileName = 'templates/descuentos.xlsx';
			$row = 15;
		} else {
  		  	$inputFileName = 'templates/descuentosVer.xlsx';
			$row = 9;
		}

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Descuentos");

		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-8), $cli['Cliente']['documento']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-7), $cli['Cliente']['nombres']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-6), $cli['Cliente']['apellidos']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-5), $cli['Cliente']['telefono']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-4), $cli['Cliente']['direccion']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.($row-3), $cli['Cliente']['email']);

		foreach ($data as $origen => $todo) {
			foreach ($todo as $destino => $valores) {
				if(count($valores['Uni']['Desde']) > count($valores['Kil']['Desde'])){
					$mayor = 'Uni';
				} else {
					$mayor = 'Kil';
				}
				foreach ($valores[$mayor]['Desde'] as $key => $value) {
					$row = $row + 1;
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $origen);		
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $destino);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $valores['Uni']['Desde'][$key]);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $valores['Uni']['Hasta'][$key]);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $valores['Uni']['Porce'][$key]);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $valores['Kil']['Desde'][$key]);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $valores['Kil']['Hasta'][$key]);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valores['Kil']['Porce'][$key]);
				}
			}
		}

		$nombreArchivo = "Descuentos_".date('Y-m-d').'_'.$cli['Cliente']['apellidos'].'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();        
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		
		if(empty($preview)){
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		} else {
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
		}

		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function destinos($data = null, $preview = null){
    	if(empty($preview)){
  		  	$inputFileName = 'templates/destinos.xlsx';
			$row = 7;
		} else {
  		  	$inputFileName = 'templates/destinosVer.xlsx';
			$row = 1;
		}

		$inputFileNameShort = basename($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel  = $objReader->load($inputFileName);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Destinos");

		foreach ($data as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $data[$key]['Destino']['codigo']);		
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $data[$key]['Destino']['nombre']);		
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $data[$key]['Region']['codigo']);		
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $data[$key]['Region']['nombre']);		
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $data[$key]['Departamento']['codigo']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $data[$key]['Departamento']['nombre']);
		}

		$nombreArchivo = "Destinos_".date('Y-m-d').'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
		if(empty($preview)){
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		} else {
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');
		}

		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');





		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function anticiposCaja($anticipos = null,$oficina = null,$desde = null, $hasta = null){
		$row = 4;
		$inputFileName = 'templates/anticiposCaja.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Anticipos de caja");
		$valorSuma = 0;
		foreach ($anticipos as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Anticipo']['retiro_no']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Anticipo']['transaccion']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Anticipo']['fecha'].' '.$value['Anticipo']['hora']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Anticipo']['fecha_digito'].' '.$value['Anticipo']['hora_digito']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Anticipo']['realizo']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value['Anticipo']['valor']);
			$valorSuma = $valorSuma + floatval($value['Anticipo']['valor']);
		}
		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $valorSuma);

		$nombreArchivo = "Anticipos de Caja - Ofic_".$oficina." (".$desde.' - '.$hasta.')'.'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }
    
    public function contadosCaja($tipo = null,$contados = null,$empaques = null,$oficina = null,$desde = null, $hasta = null){
		$row = 4;
		$inputFileName = 'templates/contadosCaja.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Anticipos de caja");

		$valorSuma = 0;
		foreach ($contados as $key => $value) {
			$row = $row + 1;
			$empaInfo = json_decode($value['Venta']['empaque_info'],true);
			$cant = 0;
			$empa = 'Otros';
			if(count(array_unique($empaInfo['empaques'])) <= 1){
				$empa = $empaques[$empaInfo['empaques'][0]];
			}
			foreach ($empaInfo['empaques'] as $key2 => $value2) {
				$cant = $cant + floatval($empaInfo['cantidad'][$key2]);
			}
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Venta']['fecha']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Venta']['remesa']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Venta']['destinoNombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Venta']['nombreDest']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Venta']['nombreClien']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $empa);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $cant);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value['Venta']['valor_total']);
			$valorSuma = $valorSuma + floatval($value['Venta']['valor_total']);
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valorSuma);
		
		if($oficina == "-1"){
			$of = "";
		} else {
			$of = " - Ofic_".$oficina;
		}

		if($tipo == "contado"){
			$nombreArchivo = "Ventas de contado".$of." (".$desde.' - '.$hasta.')'.'.xlsx';
		} elseif($tipo == "credito"){
			$nombreArchivo = "Ventas de credito".$of." (".$desde.' - '.$hasta.')'.'.xlsx';
		} elseif($tipo == "cliente"){
			$nombreArchivo = "Ventas de cliente".$of." (".$desde.' - '.$hasta.')'.'.xlsx';
		} elseif($tipo == "contra"){
			$nombreArchivo = "Ventas de contraentrega".$of." (".$desde.' - '.$hasta.')'.'.xlsx';
		} elseif($tipo == "contrat"){
			$nombreArchivo = "Ventas de contraentrega".$of." (".$desde.' - '.$hasta.')'.'.xlsx';
		} elseif($tipo == "credicon"){
			$nombreArchivo = "Ventas de credicontado".$of." (".$desde.' - '.$hasta.')'.'.xlsx';
		}
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function fletesCaja($fleteArray = null,$oficina = null,$desde = null, $hasta = null){
		$row = 4;
		$inputFileName = 'templates/fletesCaja.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Fletes");

		$valorSuma = 0;

		foreach ($fleteArray as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['fecha']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['tipo']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['numero']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['destino']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['documento']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value['nombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value['remesas']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value['valor']);
			$valorSuma = $valorSuma + floatval($value['valor']);
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valorSuma);
		
		if($oficina == "-1"){
			$of = "";
		} else {
			$of = " - Ofic_".$oficina;
		}
		$nombreArchivo = "Fletes".$of." (".$desde.' - '.$hasta.')'.'.xlsx';

		
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function planillasRepre($planillas = null,$representante = null,$desde = null, $hasta = null){
		$row = 5;
		$inputFileName = 'templates/planillasRepre.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Representante Planillas");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $representante['Representante']['codigo'].' - '.$representante['Representante']['listNombre']);

		$valorSuma = 0;
		foreach ($planillas as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Reempaque']['fecha']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Reempaque']['id']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Reempaque']['auxiliar']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Reempaque']['origen']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Reempaque']['destino']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value['Reempaque']['remesas']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value['Reempaque']['valor']);
			$valorSuma = $valorSuma + floatval($value['Reempaque']['valor']);
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $valorSuma);

		$nombreArchivo = "Planillas - (".$desde.' - '.$hasta.')'.'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function confirmasRepre($ventas = null,$representante = null,$empaques = null,$desde = null, $hasta = null){
		$row = 5;
		$inputFileName = 'templates/confirmaRepre.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Representante Planillas");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $representante['Representante']['codigo'].' - '.$representante['Representante']['listNombre']);

		$valorSuma = 0;
		foreach ($ventas as $key => $value) {
			$row = $row + 1;
			if($value['Venta']['usuario_confirm'] == $representante['Representante']['usuario']){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Venta']['fecha']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Venta']['remesa']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Venta']['destinoNombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Venta']['nombreDest']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Venta']['nombreClien']);
				
				$empaInfo = json_decode($value['Venta']['empaque_info'],true);
				$cant = 0;
				$empa = 'Otros';
				if(count(array_unique($empaInfo['empaques'])) <= 1){
					$empa = $empaques[$empaInfo['empaques'][0]];
				}
				foreach ($empaInfo['empaques'] as $key2 => $value2) {
					$cant = $cant + floatval($empaInfo['cantidad'][$key2]);
				}

				$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $empa);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $cant);

				if($value['Venta']['clase'] == 'Especial'){
					$valorSuma = $valorSuma + floatval($representante['Representante']['digitar_espe']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $representante['Representante']['digitar_espe']);
				} else {
					$valorSuma = $valorSuma + floatval($representante['Representante']['digitar']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $representante['Representante']['digitar']);
				}
			}
			
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valorSuma);

		$nombreArchivo = "Confirmadas - (".$desde.' - '.$hasta.')'.'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function escaneasRepre($ventas = null,$representante = null,$empaques = null,$desde = null, $hasta = null){
		$row = 5;
		$inputFileName = 'templates/escaneaRepre.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Representante Planillas");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $representante['Representante']['codigo'].' - '.$representante['Representante']['listNombre']);

		$valorSuma = 0;
		foreach ($ventas as $key => $value) {
			$row = $row + 1;
			if($value['Venta']['usuario_escan'] == $representante['Representante']['usuario']){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Venta']['fecha']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Venta']['remesa']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Venta']['destinoNombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Venta']['nombreDest']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Venta']['nombreClien']);
				
				$empaInfo = json_decode($value['Venta']['empaque_info'],true);
				$cant = 0;
				$empa = 'Otros';
				if(count(array_unique($empaInfo['empaques'])) <= 1){
					$empa = $empaques[$empaInfo['empaques'][0]];
				}
				foreach ($empaInfo['empaques'] as $key2 => $value2) {
					$cant = $cant + floatval($empaInfo['cantidad'][$key2]);
				}

				$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $empa);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $cant);

				if($value['Venta']['clase'] == 'Especial'){
					$valorSuma = $valorSuma + floatval($representante['Representante']['escanear_espe']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $representante['Representante']['escanear_espe']);
				} else {
					$valorSuma = $valorSuma + floatval($representante['Representante']['escanear']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $representante['Representante']['escanear']);
				}
			}
			
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valorSuma);

		$nombreArchivo = "Escaneadas - (".$desde.' - '.$hasta.')'.'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function digitasRepre($ventas = null,$representante = null,$empaques = null,$desde = null, $hasta = null){
		$row = 5;
		$inputFileName = 'templates/digitaRepre.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Representante Planillas");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $representante['Representante']['codigo'].' - '.$representante['Representante']['listNombre']);

		$valorSuma = 0;
		foreach ($ventas as $key => $value) {
			$row = $row + 1;
			if($value['Venta']['usuario'] == $representante['Representante']['usuario']){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Venta']['fecha']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Venta']['remesa']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Venta']['destinoNombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Venta']['nombreDest']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Venta']['nombreClien']);
				
				$empaInfo = json_decode($value['Venta']['empaque_info'],true);
				$cant = 0;
				$empa = 'Otros';
				if(count(array_unique($empaInfo['empaques'])) <= 1){
					$empa = $empaques[$empaInfo['empaques'][0]];
				}
				foreach ($empaInfo['empaques'] as $key2 => $value2) {
					$cant = $cant + floatval($empaInfo['cantidad'][$key2]);
				}

				$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $empa);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $cant);

				if($value['Venta']['clase'] == 'Especial'){
					$valorSuma = $valorSuma + floatval($representante['Representante']['digitar_espe']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $representante['Representante']['digitar_espe']);
				} else {
					$valorSuma = $valorSuma + floatval($representante['Representante']['digitar']);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $representante['Representante']['digitar']);
				}
			}
			
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valorSuma);

		$nombreArchivo = "Digitadas - (".$desde.' - '.$hasta.')'.'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function fletesRepre($fletes = null,$representante = null,$destinos = null,$desde = null, $hasta = null){
		$row = 5;
		$inputFileName = 'templates/fleteRepre.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Representante Planillas");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $representante['Representante']['codigo'].' - '.$representante['Representante']['listNombre']);

		$valorSuma = 0;
		foreach ($fletes as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Recibo']['fecha']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Recibo']['numero']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Recibo']['remesa']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $destinos[$value['Recibo']['destino']]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Recibo']['tipo']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value['Recibo']['documento']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value['Recibo']['razon']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value['Recibo']['negociador_nom']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value['Recibo']['seguro']);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value['Recibo']['flete']);
			$valorSuma = $valorSuma + floatval($value['Recibo']['flete']);
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $valorSuma);

		$nombreArchivo = "Fletes - (".$desde.' - '.$hasta.')'.'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function contrasRepre($ventas = null,$representante = null,$empaques = null,$desde = null, $hasta = null){
		$row = 5;
		$inputFileName = 'templates/contraRepre.xlsx';
		$this->log($ventas);
		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Representante Planillas");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $representante['Representante']['codigo'].' - '.$representante['Representante']['listNombre']);

		$valorSuma = 0;
		foreach ($ventas as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Venta']['fecha']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Venta']['remesa']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Venta']['destinoNombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Venta']['nombreDest']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Venta']['nombreClien']);
			
			$empaInfo = json_decode($value['Venta']['empaque_info'],true);
			$cant = 0;
			$empa = 'Otros';
			if(count(array_unique($empaInfo['empaques'])) <= 1){
				$empa = $empaques[$empaInfo['empaques'][0]];
			}
			foreach ($empaInfo['empaques'] as $key2 => $value2) {
				$cant = $cant + floatval($empaInfo['cantidad'][$key2]);
			}

			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $empa);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $cant);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value['Venta']['valor_total']);
			$valorSuma = $valorSuma + floatval($value['Venta']['valor_total']);
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valorSuma);

		$nombreArchivo = "Recaudo Contraentrega - (".$desde.' - '.$hasta.')'.'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		ob_end_clean();        
        $objWriter->save('php://output');


		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }

    public function contadoCliente($clase = null,$ventas = null,$cliente = null,$empaques = null,$desde = null, $hasta = null){
		$row = 5;

		$inputFileName = 'templates/contadoCliente.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Cliente Informe");
		$objPHPExcel->getActiveSheet()->setCellValue('B4', $cliente['Cliente']['documento'].' - '.$cliente['Cliente']['listNombre']);

		if($clase == "contado") {
			$nombreArchivo = "Contado - (".$desde.' - '.$hasta.')'.'.xlsx';
			$objPHPExcel->getActiveSheet()->setCellValue('G4', "CONTADO");
		} elseif($clase == "credito") {
			$nombreArchivo = "Credito - (".$desde.' - '.$hasta.')'.'.xlsx';
			$objPHPExcel->getActiveSheet()->setCellValue('G4', "CREDITO");
		} elseif($clase == "credicontado") {
			$nombreArchivo = "Credicontado - (".$desde.' - '.$hasta.')'.'.xlsx';
			$objPHPExcel->getActiveSheet()->setCellValue('G4', "CREDICONTADO");
		} elseif($clase == "contraentrega") {
			$nombreArchivo = "Contraentrega - (".$desde.' - '.$hasta.')'.'.xlsx';
			$objPHPExcel->getActiveSheet()->setCellValue('G4', "CONTRAENTREGA");
		} elseif($clase == "especial") {
			$nombreArchivo = "Especial - (".$desde.' - '.$hasta.')'.'.xlsx';
			$objPHPExcel->getActiveSheet()->setCellValue('G4', "ESPECIAL");
		}

		$valorSuma = 0;
		foreach ($ventas as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value['Venta']['fecha']);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value['Venta']['remesa']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value['Venta']['origenNombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value['Venta']['destinoNombre']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value['Venta']['nombreDest']);
			
			$empaInfo = json_decode($value['Venta']['empaque_info'],true);
			$cant     = 0;
			$empa     = 'Otros';
			if(count(array_unique($empaInfo['empaques'])) <= 1){
				$empa = $empaques[$empaInfo['empaques'][0]];
			}
			foreach ($empaInfo['empaques'] as $key2 => $value2) {
				$cant = $cant + floatval($empaInfo['cantidad'][$key2]);
			}

			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $empa);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $cant);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value['Venta']['valor_total']);
			$valorSuma = $valorSuma + floatval($value['Venta']['valor_total']);
			
		}

		$row = $row + 1;
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, "VALOR TOTAL");
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $valorSuma);

		$outputFileName = basename($nombreArchivo);

		ob_end_clean();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);
		ob_end_clean();        
        $objWriter->save('php://output');

		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		exit();
    }


    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/
    /********************* INFORMES ***********************************************/

	public function movCliente($data){
		$row = 3;
		$inputFileName = 'templates/movCliente.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Informe");
		foreach ($data as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value[1]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value[2]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value[3]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value[4]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value[5]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value[6]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value[7]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value[8]);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value[9]);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value[10]);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $value[11]);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $value[12]);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $value[13]);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $value[14]);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $value[15]);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $value[16]);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $value[17]);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $value[18]);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $value[19]);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$row, $value[20]);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$row, $value[21]);
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$row, $value[22]);
			$objPHPExcel->getActiveSheet()->setCellValue('W'.$row, $value[23]);
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$row, $value[24]);
		}
		for($col = 'A'; $col !== 'X'; $col++) {
			$objPHPExcel->getActiveSheet()
			->getColumnDimension($col)
			->setAutoSize(true);
		}
		$nombreArchivo = 'movCliente'.mt_rand().'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		$objWriter->save("informes/".$nombreArchivo);
		
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		return $nombreArchivo;
	}
	public function movJuridica($data){
		$row = 3;
		$inputFileName = 'templates/movCliente.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Informe");
		foreach ($data as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value[1]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value[2]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value[3]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value[4]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value[5]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value[6]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value[7]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value[8]);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value[9]);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value[10]);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $value[11]);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $value[12]);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $value[13]);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $value[14]);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $value[15]);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $value[16]);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $value[17]);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $value[18]);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $value[19]);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$row, $value[20]);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$row, $value[21]);
		}
		for($col = 'A'; $col !== 'U'; $col++) {
			$objPHPExcel->getActiveSheet()
			->getColumnDimension($col)
			->setAutoSize(true);
		}
		$nombreArchivo = 'movTransportadora'.mt_rand().'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		$objWriter->save("informes/".$nombreArchivo);
		
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		return $nombreArchivo;
	}
	public function movNatural($data){
		$row = 3;
		$inputFileName = 'templates/movNatural.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Informe");
		foreach ($data as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value[1]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value[2]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value[3]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value[4]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value[5]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value[6]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value[7]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value[8]);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value[9]);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value[10]);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $value[11]);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $value[12]);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $value[13]);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $value[14]);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $value[15]);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $value[16]);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $value[17]);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $value[18]);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $value[19]);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$row, $value[20]);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$row, $value[21]);
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$row, $value[21]);
		}
		for($col = 'A'; $col !== 'V'; $col++) {
			$objPHPExcel->getActiveSheet()
			->getColumnDimension($col)
			->setAutoSize(true);
		}
		$nombreArchivo = 'movNatural'.mt_rand().'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		$objWriter->save("informes/".$nombreArchivo);
		
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		return $nombreArchivo;
	}
	public function despachoRepre($data){
		$row = 3;
		$inputFileName = 'templates/despachoRepre.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Informe");
		foreach ($data as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value[1]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value[2]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value[3]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value[4]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value[5]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value[6]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value[7]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value[8]);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value[9]);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value[10]);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $value[11]);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $value[12]);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $value[13]);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $value[14]);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $value[15]);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $value[16]);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $value[17]);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $value[18]);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $value[19]);
		}
		for($col = 'A'; $col !== 'S'; $col++) {
			$objPHPExcel->getActiveSheet()
			->getColumnDimension($col)
			->setAutoSize(true);
		}
		$nombreArchivo = 'despachoRepre'.mt_rand().'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		$objWriter->save("informes/".$nombreArchivo);
		
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		return $nombreArchivo;
	}
	public function despachoXRepre($data){
		$row = 3;
		$inputFileName = 'templates/movCliente.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Informe");
		foreach ($data as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value[1]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value[2]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value[3]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value[4]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value[5]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value[6]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value[7]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value[8]);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value[9]);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value[10]);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $value[11]);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $value[12]);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $value[13]);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $value[14]);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $value[15]);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $value[16]);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $value[17]);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $value[18]);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $value[19]);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$row, $value[20]);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$row, $value[21]);
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$row, $value[22]);
			$objPHPExcel->getActiveSheet()->setCellValue('W'.$row, $value[23]);
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$row, $value[24]);
		}
		for($col = 'A'; $col !== 'X'; $col++) {
			$objPHPExcel->getActiveSheet()
			->getColumnDimension($col)
			->setAutoSize(true);
		}
		$nombreArchivo = 'despachoXRepre'.mt_rand().'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		$objWriter->save("informes/".$nombreArchivo);
		
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		return $nombreArchivo;
	}

	public function merConfirmada($data){
		$row = 3;
		$inputFileName = 'templates/movCliente.xlsx';

		$inputFileNameShort = basename($inputFileName);
		$objReader          = PHPExcel_IOFactory::createReader($this->inputFileType);
		$objReader->setIncludeCharts(TRUE);
		$objPHPExcel        = $objReader->load($inputFileName);
		$objWorksheet       = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getProperties()->setCreator("Mandar y servir")->setTitle("Informe");
		foreach ($data as $key => $value) {
			$row = $row + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $value[1]);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $value[2]);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $value[3]);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $value[4]);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $value[5]);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $value[6]);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $value[7]);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $value[8]);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $value[9]);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $value[10]);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $value[11]);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $value[12]);
			$objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $value[13]);
			$objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $value[14]);
			$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $value[15]);
			$objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $value[16]);
			$objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $value[17]);
			$objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $value[18]);
			$objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $value[19]);
			$objPHPExcel->getActiveSheet()->setCellValue('T'.$row, $value[20]);
			$objPHPExcel->getActiveSheet()->setCellValue('U'.$row, $value[21]);
			$objPHPExcel->getActiveSheet()->setCellValue('V'.$row, $value[22]);
			$objPHPExcel->getActiveSheet()->setCellValue('W'.$row, $value[23]);
			$objPHPExcel->getActiveSheet()->setCellValue('X'.$row, $value[24]);
		}
		for($col = 'A'; $col !== 'X'; $col++) {
			$objPHPExcel->getActiveSheet()
			->getColumnDimension($col)
			->setAutoSize(true);
		}
		$nombreArchivo = 'Mercancia confirmada'.mt_rand().'.xlsx';
		$outputFileName = basename($nombreArchivo);

		ob_end_clean();
	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$outputFileName.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
		$objWriter->setIncludeCharts(TRUE);

		$objWriter->save("informes/".$nombreArchivo);
		
		$objPHPExcel->disconnectWorksheets();
		unset($objPHPExcel);
		return $nombreArchivo;
	}

























}
?>