<?php 
App::import('Vendor','XTCPDF');
$altoM  = 165;
$largoM = 215;
$pdf    = new XTCPDF('l', 'mm', array($largoM,$altoM), true, 'UTF-8', false);
	$pdf->AddPage();
	$pdf->setPrintFooter(false);

	$pdf->SetMargins(0, 0, 0, 0);
	$pdf->SetFont('times', '', 14);
	//$pdf->setPrintHeader(false);
	//$pdf->setPrintFooter(false);

	// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

	$pdf->SetFont('Times','B',14);
	$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '5', true);
	$pdf->SetFont('Times','B',11);
	$pdf->MultiCell(140, 1, "PLANILLA DE DESPACHO # ".$id, 0, 'C', 0, 0, '40', '11', true);
	//Line  ($x1,$y1,$x2,$y2,$style = array())

	// Divisiones
	$pdf->Line(1, 21, ($largoM-9), 21, null);
	$pdf->Line(1, 36, ($largoM-9), 36, null);
	$pdf->Line(1, 41, ($largoM-9), 41, null);
	

	$pdf->MultiCell(50, 1, "Negociador:", 0, 'L', 0, 0, '2', '21', true);
	$pdf->MultiCell(50, 1, "Conductor:", 0, 'L', 0, 0, '2', '26', true);
	$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', '31', true);
	$pdf->MultiCell(50, 1, "Placa:", 0, 'L', 0, 0, '102', '21', true);
	$pdf->MultiCell(50, 1, "Vehiculo:", 0, 'L', 0, 0, '102', '26', true);
	$pdf->MultiCell(50, 1, "Celular:", 0, 'L', 0, 0, '102', '31', true);
	$pdf->MultiCell(50, 1, "Remesa", 0, 'L', 0, 0, '2', '36', true);
	$pdf->MultiCell(50, 1, "Destinatario", 0, 'L', 0, 0, '22', '36', true);
	$pdf->MultiCell(50, 1, "Dirección", 0, 'L', 0, 0, '70', '36', true);
	$pdf->MultiCell(50, 1, "Destino", 0, 'L', 0, 0, '112', '36', true);
	$pdf->MultiCell(50, 1, "Teléfono", 0, 'L', 0, 0, '144', '36', true);
	$pdf->MultiCell(50, 1, "Cant", 0, 'L', 0, 0, '160', '36', true);
	$pdf->MultiCell(50, 1, "Empaque", 0, 'L', 0, 0, '170', '36', true);
	$pdf->MultiCell(50, 1, "($)", 0, 'L', 0, 0, '195', '36', true);


	// Cuadrado
	$pdf->Line(1, 5, ($largoM-9), 5, null); //ARRI

	$pdf->SetFont('Times','',11);
	//$pdf->MultiCell(140, 1, "Carrera 46 No. 42-79 Tels:(4) 4446033 Medellín-Colombia", 0, 'C', 0, 0, '40', '16', true);
	$pdf->MultiCell(120, 1, $despa['Despacho']['origen'].' - '.$despa['Despacho']['destino'], 0, 'C', 0, 0, '45', '16', true);
	$pdf->MultiCell(40, 1, $despa['Despacho']['fecha'], 0, 'R', 0, 0, '165', '16', true);

	$pdf->SetXY(25,21);
	$pdf->Cell(75, 1, $negoc['Auxiliar']['nombre'], 0, 1, 'L', 0, '', 1);
	$pdf->SetXY(25,26);
	$pdf->Cell(70, 1, $conductor['Conductor']['listNombre'], 0, 1, 'L', 0, '', 1);
	$pdf->SetXY(23,31);
	$pdf->Cell(80, 1, $conductor['Conductor']['direccion'], 0, 1, 'L', 0, '', 1);

	//$pdf->MultiCell(50, 1, $negoc['Auxiliar']['nombre'], 0, 'L', 0, 0, '25', '21', true);
	//$pdf->MultiCell(50, 1, $vehiculo['Conductor']['listNombre'], 0, 'L', 0, 0, '25', '26', true);
	//$pdf->MultiCell(50, 1, $vehiculo['Conductor']['direccion'], 0, 'L', 0, 0, '23', '31', true);
	$pdf->MultiCell(50, 1, $vehiculo['Vehiculo']['placa'], 0, 'L', 0, 0, '120', '21', true);
	$pdf->MultiCell(50, 1, $vehiculo['Vehiculo']['tipo'].' '.$vehiculo['Vehiculo']['marca'].' '.$vehiculo['Vehiculo']['modelo'], 0, 'L', 0, 0, '120', '26', true);
	$pdf->MultiCell(80, 1, $conductor['Conductor']['celular'], 0, 'L', 0, 0, '120', '31', true);
	$altoGuia = -5;
		$pdf->Line(1, 5, 1, ($altoM-25), null); //IZQ
	$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-25), null);  //DER
	$pdf->Line(1, ($altoM-25), ($largoM-9), ($altoM-25), null); //ABA

	$pdf->SetFillColor(255, 255, 255);
	foreach ($venta as $key => $value) {
		$altoGuia = $altoGuia+5;		
		$pdf->SetXY(1,41+($altoGuia));
		$pdf->Cell(19, 1, $value['Venta']['remesa'], 0, 1, 'C', 0, '', 1);
		$pdf->SetXY(20,41+($altoGuia));
		$pdf->Cell(51, 1, $value['Venta']['nombreDest'], 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(71,41+($altoGuia));
		$pdf->Cell(42, 1, $value['Venta']['direccionDest'], 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(113,41+($altoGuia));
		$pdf->Cell(30, 1, $value['Venta']['destinoNombre'], 0,1,'L',0,'',1);
		$pdf->SetXY(143,41+($altoGuia));
		$pdf->Cell(19, 1, $value['Venta']['telefonoDest'], 0,1,'L',0,'',1);
		$pdf->SetXY(162,41+($altoGuia));
		$pdf->Cell(8, 1, $value['Venta']['cantidad'], 0,1,'L',0,'',1);
		$pdf->SetXY(170,41+($altoGuia));
		$pdf->Cell(22, 1, $value['Venta']['empaque'], 0,1,'L',0,'',1);
		$pdf->SetXY(192,41+($altoGuia));
		$pdf->Cell(14, 1, $value['Venta']['valor'], 0,1,'R',0,'',1);
		if($key == 11 && count($venta) > 12){
			$altoGuia = -25;
			$pdf->AddPage();
			$pdf->Line(1, 5, ($largoM-9), 5, null); //ARRI
			$pdf->Line(1, 21, ($largoM-9), 21, null);
			$pdf->SetFont('Times','B',14);
			$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '5', true);
			$pdf->SetFont('Times','',11);
			$pdf->MultiCell(140, 1, "PLANILLA DE DESPACHO # ".$id, 0, 'C', 0, 0, '40', '11', true);
			$pdf->MultiCell(120, 1, $despa['Despacho']['origen'].' - '.$despa['Despacho']['destino'], 0, 'C', 0, 0, '45', '16', true);
			$pdf->MultiCell(40, 1, $despa['Despacho']['fecha'], 0, 'R', 0, 0, '165', '16', true);
		}
	}

	$pdf->Line(1, 46+$altoGuia, ($largoM-9), 46+$altoGuia, null);

	$pdf->MultiCell(140, 1, 'Op: '.$usuario, 0, 'L', 0, 0, '1', 46+$altoGuia, true);

	$pdf->SetFont('Times','B',11);
	$pdf->MultiCell(50, 1, 'Unidades: '.$cantTotal, 0, 'R', 0, 0, '118', 46+$altoGuia, true);
	$pdf->MultiCell(50, 1, 'Total: '.$despa['Despacho']['valor'], 0, 'R', 0, 0, '156', 46+$altoGuia, true);
	$pdf->MultiCell(100, 1, 'Firma Negociador:_________________________', 0, 'L', 0, 0, '1', 51+$altoGuia, true);

	$pdf->Line(1, 5, 1, ($altoM-25), null); //IZQ
	$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-25), null);  //DER
	$pdf->Line(1, ($altoM-25), ($largoM-9), ($altoM-25), null); //ABA




foreach ($envio['guia'] as $key5 => $value5) {


	$guia         = $envio['guia'][$key5];
	$factura      = $envio['factura'][$key5];
	$oficina      = $envio['oficina'][$key5];
	$fecha        = $envio['fecha'][$key5];
	$vence        = $envio['vence'][$key5];
	$servicio     = $envio['servicio'][$key5];
	$docRef       = $envio['docRef'][$key5];
	$hora         = $envio['hora'][$key5];
	$cliente      = $envio['cliente'][$key5];
	$nit          = $envio['nit'][$key5];
	$direccionC   = $envio['direccionC'][$key5];
	$telefonoC    = $envio['telefonoC'][$key5];
	$origen       = $envio['origen'][$key5];
	$destino      = $envio['destino'][$key5];
	$destinatario = $envio['destinatario'][$key5];
	$ced          = $envio['ced'][$key5];
	$direccionD   = $envio['direccionD'][$key5];
	$telefonoD1   = $envio['telefonoD1'][$key5];
	$telefonoD2   = $envio['telefonoD2'][$key5];
	$contacto     = $envio['contacto'][$key5];
	$peso         = $envio['peso'][$key5];
	$pesoVol      = $envio['pesoVol'][$key5];
	$largo        = $envio['largo'][$key5];
	$ancho        = $envio['ancho'][$key5];
	$alto         = $envio['alto'][$key5];
	$cantidad     = $envio['cantidad'][$key5];
	$empaque      = $envio['empaque'][$key5];
	$observacion  = $envio['observacion'][$key5];
	$contenido    = $envio['contenido'][$key5];
	$valorDecla   = $envio['valorDecla'][$key5];
	$valorFlete   = $envio['valorFlete'][$key5];
	$nombre       = $envio['nombre'][$key5];
	$formaPago    = $envio['formaPago'][$key5];
	$kiloAd       = $envio['kiloAd'][$key5];
	$valorKiloAd  = $envio['valorKiloAd'][$key5];
	$descFlete    = $envio['descFlete'][$key5];
	$descKilo     = $envio['descKilo'][$key5];
	$valorFirmado = $envio['valorFirmado'][$key5];
	$valorSeguro  = $envio['valorSeguro'][$key5];
	$valorTotal   = $envio['valorTotal'][$key5];
	$kiloNegoc    = $envio['kiloNegoc'][$key5];
	$resolucion   = $envio['resolucion'][$key5];
	$n            = $envio['n'][$key5];
	$hoja         = $envio['hoja'][$key5];

	$otro_remi    = $envio['otro_remi'][$key5];
	$remitente    = $envio['remitente'][$key5];
	$nitR         = $envio['nitR'][$key5];
	$direccionR   = $envio['direccionR'][$key5];
	$telefonoR    = $envio['telefonoR'][$key5];
	$contactoR    = $envio['contactoR'][$key5];
	$contactoTelR = $envio['contactoTelR'][$key5];
	$leyenda      = "El firmar este papel acepta las condiciones de la empresa Mandar y Servir.";
		$tipoHoja = $hoja;
		$pdf->SetMargins(0, 0, 0, 0);
		$pdf->SetFont('times', '', 14);
		//$pdf->setPrintHeader(false);

		$pdf->codigo = $envio['guia'][$key5].'#';
		$pdf->AddPage(); 
		$pdf->setPrintFooter(true);

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

		$pdf->SetFont('Times','B',14);
		$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '5', true);
		$pdf->SetFont('Times','B',11);
		$pdf->MultiCell(140, 1, "Nit: 811023661-1 Regimen Común", 0, 'C', 0, 0, '40', '11', true);
		//Line  ($x1,$y1,$x2,$y2,$style = array())

		// Divisiones
		$pdf->Line(1, 21, ($largoM-9), 21, null);
		$pdf->Line(1, 36, ($largoM-9), 36, null);
		$pdf->Line(1, 51, ($largoM-9), 51, null);
		if($otro_remi){
			$pdf->Line(1, 66, ($largoM-9), 66, null);
			$remi = 15;
			$pdf->MultiCell(50, 1, "Remitente:", 0, 'L', 0, 0, '2', '51', true);
			$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', '56', true);
			$pdf->MultiCell(50, 1, "Ced-Nit:", 0, 'L', 0, 0, '102', '51', true);
			$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '102', '56', true);
			$pdf->MultiCell(50, 1, "Contacto:", 0, 'L', 0, 0, '2', '61', true);
			$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '102', '61', true);
			$pdf->SetFont('Times','',11);
			$pdf->MultiCell(50, 1, $remitente, 0, 'C', 0, 0, '18', '51', true);
			$pdf->MultiCell(50, 1, $direccionR, 0, 'L', 0, 0, '21', '56', true);
			$pdf->MultiCell(50, 1, $nitR, 0, 'L', 0, 0, '122', '51', true);
			$pdf->MultiCell(50, 1, $telefonoR, 0, 'L', 0, 0, '122', '56', true);
			$pdf->MultiCell(50, 1, $contactoR, 0, 'L', 0, 0, '21', '61', true);
			$pdf->MultiCell(50, 1, $contactoTelR, 0, 'L', 0, 0, '122', '61', true);
			$pdf->SetFont('Times','B',11);
		} else {
			$remi = 0;
		}

		$pdf->remi   = $remi;
		$pdf->Line(1, 76+$remi, ($largoM-9), 76+$remi, null);
		$pdf->Line(1, 81+$remi, ($largoM-9), 81+$remi, null);



		$pdf->MultiCell(50, 1, "Guía No.", 0, 'L', 0, 0, '2', '21', true);
		$pdf->MultiCell(50, 1, "Oficina:", 0, 'L', 0, 0, '2', '26', true);
		$pdf->MultiCell(50, 1, "Servicio Prestado:", 0, 'L', 0, 0, '2', '31', true);
		$pdf->MultiCell(50, 1, "Factura de Venta No.:", 0, 'L', 0, 0, '102', '21', true);
		$pdf->MultiCell(50, 1, "Fecha:", 0, 'L', 0, 0, '102', '26', true);
		$pdf->MultiCell(50, 1, "Vence:", 0, 'L', 0, 0, '142', '26', true);
		$pdf->MultiCell(50, 1, "Doc.Ref:", 0, 'L', 0, 0, '102', '31', true);
		$pdf->MultiCell(50, 1, "Cliente:", 0, 'L', 0, 0, '2', '36', true);
		$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', '41', true);
		$pdf->MultiCell(50, 1, "Origen:", 0, 'L', 0, 0, '2', '46', true);
		$pdf->MultiCell(50, 1, "Ced-Nit:", 0, 'L', 0, 0, '102', '36', true);
		$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '102', '41', true);
		$pdf->MultiCell(50, 1, "Destino:", 0, 'L', 0, 0, '102', '46', true);

		$pdf->MultiCell(50, 1, "Destinatario:", 0, 'L', 0, 0, '2', 51+$remi, true);
		$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', 56+$remi, true);
		$pdf->MultiCell(50, 1, "Contacto:", 0, 'L', 0, 0, '2', 61+$remi, true);
		$pdf->MultiCell(50, 1, "Empaque:", 0, 'L', 0, 0, '2', 66+$remi, true);
		$pdf->MultiCell(50, 1, "Observación:", 0, 'L', 0, 0, '2', 71+$remi, true);
		$pdf->MultiCell(50, 1, "Ced:", 0, 'L', 0, 0, '102', 51+$remi, true);
		$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '102', 56+$remi, true);
		$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '102', 61+$remi, true);
		$pdf->MultiCell(50, 1, "Cantidad:", 0, 'L', 0, 0, '54', 66+$remi, true);
		$pdf->MultiCell(50, 1, "Kilos Adi:", 0, 'L', 0, 0, '102', 66+$remi, true);
		$pdf->MultiCell(50, 1, "Contenido:", 0, 'L', 0, 0, '142', 66+$remi, true);

		// Cuadrado
		$pdf->Line(1, 5, ($largoM-9), 5, null); //ARRI
		

		if($hoja == '**DESTINATARIO**') {
			$pdf->MultiCell(140, 1, $leyenda, 0, 'L', 0, 0, '1', ($altoM-60+$remi), true);
			$pdf->barraY = 81;
			$pdf->Line(1, 5, 1, ($altoM-60+$remi), null); //IZQ
			$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-60+$remi), null);  //DER
			$pdf->Line(1, ($altoM-60+$remi), ($largoM-9), ($altoM-60+$remi), null); //ABA
		} else if($hoja == '**PRUEBA DE ENTREGA**') {
			$pdf->MultiCell(128, 1, $leyenda, 0, 'L', 0, 0, '1', ($altoM-40+$remi), true);
			$pdf->SetFont('Times','B',14);
			$pdf->Line(1, 5, 1, ($altoM-40+$remi), null); //IZQ
			$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-40+$remi), null);  //DER
			$pdf->Line(1, ($altoM-40+$remi), ($largoM-9), ($altoM-40+$remi), null); //ABA
			$pdf->barraY = 82;
			$pdf->barraX = 19;
			$pdf->Line(106, ($altoM-40+$remi), 106, 81+$remi, null);
			$pdf->Line(1, 96+$remi, 106, 97+$remi, null);

			$pdf->Line(127, 86+$remi, $largoM-12, 86+$remi, null);
			$pdf->Line(133, 91+$remi, $largoM-12, 91+$remi, null);
			$pdf->Line(120, 96+$remi, $largoM-12, 96+$remi, null);
			$pdf->Line(128, 101+$remi, 160, 101+$remi, null);
			$pdf->Line(178, 101+$remi, $largoM-12, 101+$remi, null);
			$pdf->Line(138, 106+$remi, $largoM-12, 106+$remi, null);
			$pdf->Line(127, 111+$remi, $largoM-12, 111+$remi, null);
			$pdf->SetFont('Times','BI',13);
			$pdf->MultiCell(60, 1, "FIRMA:", 0, 'L', 0, 0, '107', 81+$remi, true);
			$pdf->MultiCell(60, 1, "NOMBRE:", 0, 'L', 0, 0, '107', 86+$remi, true);
			$pdf->MultiCell(60, 1, "C.C.:", 0, 'L', 0, 0, '107', 91+$remi, true);
			$pdf->MultiCell(60, 1, "FECHA:", 0, 'L', 0, 0, '107', 96+$remi, true);
			$pdf->MultiCell(60, 1, "HORA:", 0, 'L', 0, 0, '161', 96+$remi, true);
			$pdf->MultiCell(60, 1, "TELÉFONO:", 0, 'L', 0, 0, '107', 101+$remi, true);
			$pdf->MultiCell(60, 1, "CARGO:", 0, 'L', 0, 0, '107', 106+$remi, true);
			$pdf->MultiCell(66, 1, "***DEVOLVER FIRMADO***", 0, 'L', 0, 0, '130',($altoM-41+$remi), true);
		}



		$pdf->SetFont('Times','',11);
		$pdf->MultiCell(140, 1, "Carrera 46 No. 42-79 Tels:(4) 4446033 Medellín-Colombia", 0, 'C', 0, 0, '40', '16', true);
		$pdf->MultiCell(50, 1, "Peso Real:", 0, 'L', 0, 0, '2', 76+$remi, true);
		$pdf->MultiCell(50, 1, "Peso Volumen:", 0, 'L', 0, 0, '47', 76+$remi, true);
		$pdf->MultiCell(50, 1, "Largo:", 0, 'L', 0, 0, '92', 76+$remi, true);
		$pdf->MultiCell(50, 1, "Ancho:", 0, 'L', 0, 0, '129', 76+$remi, true);
		$pdf->MultiCell(50, 1, "Alto:", 0, 'L', 0, 0, '170', 76+$remi, true);
		
		$pdf->MultiCell(50, 1, $hora, 0, 'L', 0, 0, '180', '26', true);
		$pdf->MultiCell(50, 1, $guia, 0, 'L', 0, 0, '18', '21', true);
		$pdf->MultiCell(50, 1, $oficina, 0, 'L', 0, 0, '18', '26', true);
		$pdf->MultiCell(50, 1, $servicio, 0, 'L', 0, 0, '38', '31', true);
		$pdf->MultiCell(50, 1, $factura, 0, 'L', 0, 0, '142', '21', true);
		$pdf->MultiCell(50, 1, $fecha, 0, 'L', 0, 0, '120', '26', true);
		$pdf->MultiCell(50, 1, $vence, 0, 'L', 0, 0, '155', '26', true);
		$pdf->MultiCell(80, 1, $docRef, 0, 'L', 0, 0, '122', '31', true);
		
		$pdf->SetXY(20,36);
		$pdf->Cell(71, 1, $cliente, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(24,41);
		$pdf->Cell(78, 1, $direccionC, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(26,46);
		$pdf->Cell(50, 1, $origen, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(122,36);
		$pdf->Cell(50, 1, $nit, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(122,41);
		$pdf->Cell(50, 1, $telefonoC, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(122,46);
		$pdf->Cell(50, 1, $destino, 0, 1, 'L', 0, '', 1);

		$pdf->SetXY(30,51+$remi);
		$pdf->Cell(71, 1, $destinatario, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(23,56+$remi);
		$pdf->Cell(80, 1, $direccionD, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(26,61+$remi);
		$pdf->Cell(80, 1, $contacto, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(26,66+$remi);
		$pdf->Cell(50, 1, $empaque, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY(29,71+$remi);
		$pdf->Cell(50, 1, $observacion, 0, 1, 'L', 0, '', 1);

		$pdf->MultiCell(50, 1, $ced, 0, 'L', 0, 0, '122', 51+$remi, true);
		$pdf->MultiCell(50, 1, $telefonoD1, 0, 'L', 0, 0, '122', 56+$remi, true);
		$pdf->MultiCell(50, 1, $telefonoD2, 0, 'L', 0, 0, '122', 61+$remi, true);
		$pdf->MultiCell(50, 1, $cantidad, 0, 'L', 0, 0, '80', 66+$remi, true);
		$pdf->MultiCell(50, 1, $kiloAd, 0, 'L', 0, 0, '122', 66+$remi, true);
		$pdf->MultiCell(50, 1, $contenido, 0, 'L', 0, 0, '166', 66+$remi, true);
		if($hoja == '**DESTINATARIO**') {
			$pdf->MultiCell(80, 1,  $tipoHoja, 0, 'L', 0, 0, '89', 82+$remi, true);
			//$pdf->MultiCell(120, 1, $resolucion, 0, 'L', 0, 0, '89', 87+$remi, true);
			$pdf->SetXY(89,87+$remi);
			$pdf->Cell(116, 1, $resolucion, 0, 1, 'L', 0, '', 1);
			$pdf->SetXY(132,82+$remi);
			$pdf->Cell(71, 1, 'Operario: '.$nombre, 0, 1, 'L', 0, '', 1);
		} else if($hoja == '**PRUEBA DE ENTREGA**') {
			$pdf->MultiCell(80, 1,  $tipoHoja, 0, 'L', 0, 0, '2', 97+$remi, true);
			//$pdf->MultiCell(120, 1, $resolucion, 0, 'L', 0, 0, '2', 102+$remi, true);
			$pdf->SetXY(2,102+$remi);
			$pdf->Cell(104, 1, $resolucion, 0, 1, 'L', 0, '', 1);
			$pdf->SetXY(2,107+$remi);
			$pdf->Cell(104, 1, 'Operario: '.$nombre, 0, 1, 'L', 0, '', 1);
		}
		$pdf->MultiCell(50, 1, $peso, 0, 'L', 0, 0, '24', 76+$remi, true);
		$pdf->MultiCell(50, 1, $pesoVol, 0, 'L', 0, 0, '72', 76+$remi, true);
		$pdf->MultiCell(50, 1, $largo, 0, 'L', 0, 0, '103', 76+$remi, true);
		$pdf->MultiCell(50, 1, $ancho, 0, 'L', 0, 0, '141', 76+$remi, true);
		$pdf->MultiCell(50, 1, $alto, 0, 'L', 0, 0, '179', 76+$remi, true);
	

}












$pdf->IncludeJS('print(true);');
$pdfString  = $pdf->Output('separadorGuia.pdf', 'E'); 
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);

echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:820px;height:520px;" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>


<script>
var link = <?php echo "'".$this->Html->link('Registrar despacho', array('action'=>'crear'),array('class'=>'btn btn-success'))."'";?>;
$(document).ready(function(){
	$("#btn-limpiar").after(link);
});
</script>
