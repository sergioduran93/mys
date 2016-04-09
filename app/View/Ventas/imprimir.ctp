<?php 
App::import('Vendor','XTCPDF');
$altoM  = 147;
$largoM = 215;
$pdf    = new XTCPDF('l', 'mm', array($largoM,$altoM), true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, 0);

$guia         = $envio['guia'];
$factura      = $envio['factura'];
$oficina      = $envio['oficina'];
$fecha        = $envio['fecha'];
$vence        = $envio['vence'];
$servicio     = $envio['servicio'];
$docRef       = $envio['docRef'];
$hora         = $envio['hora'];
$cliente      = $envio['cliente'];
$nit          = $envio['nit'];
$direccionC   = $envio['direccionC'];
$telefonoC    = $envio['telefonoC'];
$origen       = $envio['origen'];
$destino      = $envio['destino'];
$destinatario = $envio['destinatario'];
$ced          = $envio['ced'];
$direccionD   = $envio['direccionD'];
$telefonoD1   = $envio['telefonoD1'];
$telefonoD2   = $envio['telefonoD2'];
$contacto     = $envio['contacto'];
$peso         = $envio['peso'];
$pesoVol      = $envio['pesoVol'];
$largo        = $envio['largo'];
$ancho        = $envio['ancho'];
$alto         = $envio['alto'];
$cantidad     = $envio['cantidad'];
$empaque      = $envio['empaque'];
$observacion  = $envio['observacion'];
$contenido    = $envio['contenido'];
$valorDecla   = $envio['valorDecla'];
$valorFlete   = $envio['valorFlete'];
$nombre       = $envio['nombre'];
$formaPago    = $envio['formaPago'];
$kiloAd       = $envio['kiloAd'];
$valorKiloAd  = $envio['valorKiloAd'];
$descFlete    = $envio['descFlete'];
$descKilo     = $envio['descKilo'];
$valorFirmado = $envio['valorFirmado'];
$valorSeguro  = $envio['valorSeguro'];
$valorTotal   = $envio['valorTotal'];
$kiloNegoc    = $envio['kiloNegoc'];
$resolucion   = $envio['resolucion'];
$n            = $envio['n'];
$hoja         = $envio['hoja'];

$otro_remi    = $envio['otro_remi'];
$remitente    = $envio['remitente'];
$nitR         = $envio['nitR'];
$direccionR   = $envio['direccionR'];
$telefonoR    = $envio['telefonoR'];
$contactoR    = $envio['contactoR'];
$contactoTelR = $envio['contactoTelR'];
$leyenda      = "";
for ($i=0; $i < $n; $i++) { 
	$tipoHoja = $hoja[$i];
	$pdf->SetMargins(0, 0, 0, 0);
	$pdf->SetFont('times', '', 14);
	//$pdf->setPrintHeader(false);
	//$pdf->setPrintFooter(false);

	$pdf->codigo = $envio['guia'].'#';
	$pdf->AddPage(); 
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
		$pdf->SetXY2(18,51);
		$pdf->Cell2(50, 1, $remitente, 0, 1, 'C', 0, '', 1);
		$pdf->SetXY2(21,56);
		$pdf->Cell2(50, 1, $direccionR, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY2(122,51);
		$pdf->Cell2(50, 1, $nitR, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY2(122,56);
		$pdf->Cell2(50, 1, $telefonoR, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY2(21,61);
		$pdf->Cell2(50, 1, $contactoR, 0, 1, 'L', 0, '', 1);
		$pdf->SetXY2(122,61);
		$pdf->Cell2(50, 1, $contactoTelR, 0, 1, 'L', 0, '', 1);
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
	

	if($hoja[$i] == '**DESTINATARIO**') {
		$pdf->MultiCell(140, 1, $leyenda, 0, 'L', 0, 0, '1', ($altoM-40+$remi), true);
		$pdf->barraY = 81;
		$pdf->Line(1, 5, 1, ($altoM-40+$remi), null); //IZQ
		$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-40+$remi), null);  //DER
		$pdf->Line(1, ($altoM-40+$remi), ($largoM-9), ($altoM-40+$remi), null); //ABA
	} else if($hoja[$i] == '**PRUEBA DE ENTREGA**') {
		$pdf->MultiCell(140, 1, $leyenda, 0, 'L', 0, 0, '1', ($altoM-25+$remi), true);
		$pdf->SetFont('Times','B',14);
		$pdf->Line(1, 5, 1, ($altoM-25+$remi), null); //IZQ
		$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-25+$remi), null);  //DER
		$pdf->Line(1, ($altoM-25+$remi), ($largoM-9), ($altoM-25+$remi), null); //ABA
		$pdf->barraY = 82;
		$pdf->barraX = 19;
		$pdf->Line(106, ($altoM-25+$remi), 106, 81+$remi, null);
		$pdf->Line(1, 96+$remi, 106, 97+$remi, null);

		$pdf->Line(127, 86+$remi, $largoM-12, 86+$remi, null);
		$pdf->Line(133, 91+$remi, $largoM-12, 91+$remi, null);
		$pdf->Line(120, 96+$remi, $largoM-12, 96+$remi, null);
		$pdf->Line(128, 101+$remi, 160, 101+$remi, null);
		$pdf->Line(178, 101+$remi, $largoM-12, 101+$remi, null);
		$pdf->Line(138, 106+$remi, $largoM-12, 106+$remi, null);
		$pdf->Line(127, 111+$remi, $largoM-12, 111+$remi, null);
	//	$pdf->Line(170, 97, 205, 97, null);
	//	$pdf->Line(100, 102, 150, 102, null);
		$pdf->SetFont('Times','BI',13);
		$pdf->MultiCell(60, 1, "FIRMA:", 0, 'L', 0, 0, '107', 81+$remi, true);
		$pdf->MultiCell(60, 1, "NOMBRE:", 0, 'L', 0, 0, '107', 86+$remi, true);
		$pdf->MultiCell(60, 1, "C.C.:", 0, 'L', 0, 0, '107', 91+$remi, true);
		$pdf->MultiCell(60, 1, "FECHA:", 0, 'L', 0, 0, '107', 96+$remi, true);
		$pdf->MultiCell(60, 1, "HORA:", 0, 'L', 0, 0, '161', 96+$remi, true);
		$pdf->MultiCell(60, 1, "TELÉFONO:", 0, 'L', 0, 0, '107', 101+$remi, true);
		$pdf->MultiCell(60, 1, "CARGO:", 0, 'L', 0, 0, '107', 106+$remi, true);
		$pdf->MultiCell(100, 1, "***DEVOLVER FIRMADO***", 0, 'L', 0, 0, '126', 112+$remi, true);
	} else {
		$pdf->MultiCell(140, 1, $leyenda, 0, 'L', 0, 0, '1', ($altoM-25+$remi), true);
		$pdf->Line(1, 5, 1, ($altoM-25+$remi), null); //IZQ
		$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-25+$remi), null);  //DER
		$pdf->Line(1, ($altoM-25+$remi), ($largoM-9), ($altoM-25+$remi), null); //ABA
		$pdf->Line(1, 96+$remi, ($largoM-9), 97+$remi, null);
		$pdf->MultiCell(50, 1, "Vr.Declara:", 0, 'L', 0, 0, '2', 81+$remi, true);
		$pdf->MultiCell(50, 1, "Vr.Flete:", 0, 'L', 0, 0, '54', 81+$remi, true);
		$pdf->MultiCell(50, 1, "Vr.Kilos Adicional:", 0, 'L', 0, 0, '102', 81+$remi, true);
		$pdf->MultiCell(50, 1, "Vr.Total Pagar:", 0, 'L', 0, 0, '156', 81+$remi, true);
		$pdf->MultiCell(50, 1, "Vr.Seguro:", 0, 'L', 0, 0, '2', 86+$remi, true);
		$pdf->MultiCell(50, 1, "Dscto Flete:", 0, 'L', 0, 0, '54', 86+$remi, true);
		$pdf->MultiCell(50, 1, "Dscto Kilos Adicional:", 0, 'L', 0, 0, '102', 86+$remi, true);
		$pdf->MultiCell(50, 1, "Vr.Devolver Firmado:", 0, 'L', 0, 0, '2', 91+$remi, true);
		$pdf->MultiCell(50, 1, "Kilos Negociados:", 0, 'L', 0, 0, '82', 91+$remi, true);
		$pdf->MultiCell(50, 1, "Forma de Pago:", 0, 'L', 0, 0, '150', 91+$remi, true);
		if($hoja[$i] == '**ARCHIVO**') {
			$pdf->MultiCell(50, 1, "Firma:", 0, 'L', 0, 0, '125', ($altoM-25+$remi), true);
			$pdf->Line(140, ($altoM-20+$remi), ($largoM-9), ($altoM-20+$remi), null); //FIRMA
		}
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

	$pdf->SetXY2(20,36);
	$pdf->Cell2(71, 1, $cliente, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(24,41);
	$pdf->Cell2(78, 1, $direccionC, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(26,46);
	$pdf->Cell2(50, 1, $origen, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(122,36);
	$pdf->Cell2(50, 1, $nit, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(122,41);
	$pdf->Cell2(50, 1, $telefonoC, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(122,46);
	$pdf->Cell2(50, 1, $destino, 0, 1, 'L', 0, '', 1);

	$pdf->SetXY2(30,51+$remi);
	$pdf->Cell2(71, 1, $destinatario, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(26,56+$remi);
	$pdf->Cell2(80, 1, $direccionD, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(26,61+$remi);
	$pdf->Cell2(80, 1, $contacto, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(26,66+$remi);
	$pdf->Cell2(50, 1, $empaque, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(29,71+$remi);
	$pdf->Cell2(50, 1, $observacion, 0, 1, 'L', 0, '', 1);

	$pdf->SetXY2(122,51+$remi);
	$pdf->Cell2(50, 1, $ced, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(122,56+$remi);
	$pdf->Cell2(50, 1, $telefonoD1, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(122,61+$remi);
	$pdf->Cell2(50, 1, $telefonoD2, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(80,66+$remi);
	$pdf->Cell2(50, 1, $cantidad, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(122,66+$remi);
	$pdf->Cell2(50, 1, $kiloAd, 0, 1, 'L', 0, '', 1);
	$pdf->SetXY2(166,66+$remi);
	$pdf->Cell2(50, 1, $contenido, 0, 1, 'L', 0, '', 1);

	if($hoja[$i] == '**DESTINATARIO**') {
		$pdf->MultiCell(80, 1,  $tipoHoja, 0, 'L', 0, 0, '89', 82+$remi, true);
		$pdf->MultiCell(120, 1, $resolucion, 0, 'L', 0, 0, '89', 87+$remi, true);
		$pdf->MultiCell(70, 1, 'Operario: '.$nombre, 0, 'L', 0, 0, '145', 82+$remi, true);
	} else if($hoja[$i] == '**PRUEBA DE ENTREGA**') {
		$pdf->MultiCell(80, 1,  $tipoHoja, 0, 'L', 0, 0, '2', 97+$remi, true);
		$pdf->SetXY2(2,102+$remi);
		$pdf->Cell2(103, 1, $resolucion, 0, 1, 'L', 0, '', 1);
		//$pdf->MultiCell(120, 1, $resolucion, 0, 'L', 0, 0, '2', 102+$remi, true);
		$pdf->MultiCell(70, 1, 'Operario: '.$nombre, 0, 'L', 0, 0, '61', 97+$remi, true);
	} else {
		$pdf->MultiCell(50, 1, $valorDecla, 0, 'L', 0, 0, '26', 81+$remi, true);
		$pdf->MultiCell(50, 1, $valorFlete, 0, 'L', 0, 0, '80', 81+$remi, true);
		$pdf->MultiCell(50, 1, $valorKiloAd, 0, 'L', 0, 0, '141', 81+$remi, true);
		$pdf->MultiCell(50, 1, $valorTotal, 0, 'L', 0, 0, '185', 81+$remi, true);
		$pdf->MultiCell(50, 1, $valorSeguro, 0, 'L', 0, 0, '26', 86+$remi, true);
		$pdf->MultiCell(50, 1, $descFlete, 0, 'L', 0, 0, '80', 86+$remi, true);
		$pdf->MultiCell(50, 1, $descKilo, 0, 'L', 0, 0, '142', 86+$remi, true);
		$pdf->MultiCell(50, 1, $valorFirmado, 0, 'L', 0, 0, '46', 91+$remi, true);
		$pdf->MultiCell(50, 1, $kiloNegoc, 0, 'L', 0, 0, '118', 91+$remi, true);
		$pdf->MultiCell(50, 1, $formaPago, 0, 'L', 0, 0, '178', 91+$remi, true);
		$pdf->MultiCell(80, 1,  $tipoHoja, 0, 'L', 0, 0, '89', 97+$remi, true);
		//$pdf->SetXY2(89,102+$remi);
		$pdf->SetXY2(89,102+$remi);
		$pdf->Cell2(116, 1, $resolucion, 1, 1, 'L', 0, '', 1);
		$pdf->SetXY2(145,97+$remi);
		$pdf->Cell2(62, 1, 'Operario: '.$nombre, 1, 1, 'L', 0, '', 1);
	}
	$pdf->MultiCell(50, 1, $peso, 0, 'L', 0, 0, '24', 76+$remi, true);
	$pdf->MultiCell(50, 1, $pesoVol, 0, 'L', 0, 0, '72', 76+$remi, true);
	$pdf->MultiCell(50, 1, $largo, 0, 'L', 0, 0, '103', 76+$remi, true);
	$pdf->MultiCell(50, 1, $ancho, 0, 'L', 0, 0, '141', 76+$remi, true);
	$pdf->MultiCell(50, 1, $alto, 0, 'L', 0, 0, '179', 76+$remi, true);

}
$pdf->IncludeJS('print(true);');
$pdfString = $pdf->Output('separadorGuia.pdf', 'E');
//$pdfString = $pdf->Close();
//$pdfString = $pdf->Output('separadorGuia.pdf', 'I');
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);
echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:820px;height:520px;" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>


<script>
var link = <?php echo "'".$this->Html->link('Registrar venta', array('action'=>'crear'),array('class'=>'btn btn-success'))."'";?>;
$(document).ready(function(){
	$("#btn-limpiar").after(link);
});
</script>
