<?php 
App::import('Vendor','xtcpdf');
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

$otro_remi  = $envio['otro_remi'];
$remitente  = $envio['remitente'];
$nitR       = $envio['nitR'];
$direccionR = $envio['direccionR'];
$telefonoR  = $envio['telefonoR'];

for ($i=0; $i < $n; $i++) { 
	$tipoHoja = $hoja[$i];
	$pdf->SetMargins(0, 0, 0, 0);
	$pdf->SetFont('times', '', 14);
	//$pdf->setPrintHeader(false);
	//$pdf->setPrintFooter(false);

	$pdf->codigo = $envio['barras'];
	$pdf->AddPage(); 
	// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

	$pdf->SetFont('Times','B',14);
	$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '70', '5', true);
	$pdf->SetFont('Times','B',11);
	$pdf->MultiCell(140, 1, "Nit: 811023661-1 Regimen Común", 0, 'C', 0, 0, '70', '11', true);
	//Line  ($x1,$y1,$x2,$y2,$style = array())

	// Divisiones
	$pdf->Line(5, 21, ($largoM-5), 21, null);
	$pdf->Line(5, 36, ($largoM-5), 36, null);
	$pdf->Line(5, 51, ($largoM-5), 51, null);
	if($otro_remi){
		$pdf->Line(5, 61, ($largoM-5), 61, null);
		$remi = 10;
		$pdf->MultiCell(50, 1, "Remitente:", 0, 'L', 0, 0, '6', '51', true);
		$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '6', '56', true);
		$pdf->MultiCell(50, 1, "Ced-Nit:", 0, 'L', 0, 0, '106', '51', true);
		$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '106', '56', true);
		$pdf->SetFont('Times','',11);
		$pdf->MultiCell(50, 1, $remitente, 0, 'C', 0, 0, '18', '51', true);
		$pdf->MultiCell(50, 1, $direccionR, 0, 'L', 0, 0, '25', '56', true);
		$pdf->MultiCell(50, 1, $nitR, 0, 'L', 0, 0, '126', '51', true);
		$pdf->MultiCell(50, 1, $telefonoR, 0, 'L', 0, 0, '126', '56', true);
		$pdf->SetFont('Times','B',11);
	} else {
		$remi = 0;
	}

	// Cuadrado
	$pdf->Line(5, 5, 5, ($altoM-29+$remi), null); //IZQ
	$pdf->Line(5, 5, ($largoM-5), 5, null); //ARRI
	$pdf->Line(($largoM-5), 5, ($largoM-5), ($altoM-29+$remi), null);  //DER
	$pdf->Line(5, ($altoM-29+$remi), ($largoM-5), ($altoM-29+$remi), null);

	$pdf->remi   = $remi;
	$pdf->Line(5, 76+$remi, ($largoM-5), 76+$remi, null);
	$pdf->Line(5, 81+$remi, ($largoM-5), 81+$remi, null);
	$pdf->Line(5, 96+$remi, ($largoM-5), 96+$remi, null);

	$pdf->MultiCell(50, 1, "Guía No.", 0, 'L', 0, 0, '6', '21', true);
	$pdf->MultiCell(50, 1, "Oficina:", 0, 'L', 0, 0, '6', '26', true);
	$pdf->MultiCell(50, 1, "Servicio Prestado:", 0, 'L', 0, 0, '6', '31', true);
	$pdf->MultiCell(50, 1, "Factura de Venta No.:", 0, 'L', 0, 0, '106', '21', true);
	$pdf->MultiCell(50, 1, "Fecha:", 0, 'L', 0, 0, '106', '26', true);
	$pdf->MultiCell(50, 1, "Vence:", 0, 'L', 0, 0, '146', '26', true);
	$pdf->MultiCell(50, 1, "Doc.Ref:", 0, 'L', 0, 0, '106', '31', true);
	$pdf->MultiCell(50, 1, "Cliente:", 0, 'L', 0, 0, '6', '36', true);
	$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '6', '41', true);
	$pdf->MultiCell(50, 1, "Origen:", 0, 'L', 0, 0, '6', '46', true);
	$pdf->MultiCell(50, 1, "Ced-Nit:", 0, 'L', 0, 0, '106', '36', true);
	$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '106', '41', true);
	$pdf->MultiCell(50, 1, "Destino:", 0, 'L', 0, 0, '106', '46', true);
	
	$pdf->MultiCell(50, 1, "Destinatario:", 0, 'L', 0, 0, '6', 51+$remi, true);
	$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '6', 56+$remi, true);
	$pdf->MultiCell(50, 1, "Contacto:", 0, 'L', 0, 0, '6', 61+$remi, true);
	$pdf->MultiCell(50, 1, "Empaque:", 0, 'L', 0, 0, '6', 66+$remi, true);
	$pdf->MultiCell(50, 1, "Observación:", 0, 'L', 0, 0, '6', 71+$remi, true);
	$pdf->MultiCell(50, 1, "Ced:", 0, 'L', 0, 0, '106', 51+$remi, true);
	$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '106', 56+$remi, true);
	$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '106', 61+$remi, true);
	$pdf->MultiCell(50, 1, "Cantidad:", 0, 'L', 0, 0, '60', 66+$remi, true);
	$pdf->MultiCell(50, 1, "Kilos Adi:", 0, 'L', 0, 0, '106', 66+$remi, true);
	$pdf->MultiCell(50, 1, "Contenido:", 0, 'L', 0, 0, '146', 66+$remi, true);
	$pdf->MultiCell(50, 1, "Vr.Declara:", 0, 'L', 0, 0, '6', 81+$remi, true);
	$pdf->MultiCell(50, 1, "Vr.Flete:", 0, 'L', 0, 0, '60', 81+$remi, true);
	$pdf->MultiCell(50, 1, "Vr.Kilos Adicional:", 0, 'L', 0, 0, '106', 81+$remi, true);
	$pdf->MultiCell(50, 1, "Vr.Total Pagar:", 0, 'L', 0, 0, '156', 81+$remi, true);
	$pdf->MultiCell(50, 1, "Vr.Seguro:", 0, 'L', 0, 0, '6', 86+$remi, true);
	$pdf->MultiCell(50, 1, "Dscto Flete:", 0, 'L', 0, 0, '60', 86+$remi, true);
	$pdf->MultiCell(50, 1, "Dscto Kilos Adicional:", 0, 'L', 0, 0, '106', 86+$remi, true);
	$pdf->MultiCell(50, 1, "Vr.Devolver Firmado:", 0, 'L', 0, 0, '6', 91+$remi, true);
	$pdf->MultiCell(50, 1, "Kilos Negociados:", 0, 'L', 0, 0, '82', 91+$remi, true);
	$pdf->MultiCell(50, 1, "Forma de Pago:", 0, 'L', 0, 0, '150', 91+$remi, true);

	$pdf->SetFont('Times','',11);
	$pdf->MultiCell(140, 1, "Carrera 46 No. 42-79 Tels:(4) 4446033 Medellín-Colombia", 0, 'C', 0, 0, '70', '16', true);
	$pdf->MultiCell(50, 1, "Peso Real:", 0, 'L', 0, 0, '6', 76+$remi, true);
	$pdf->MultiCell(50, 1, "Peso Volumen:", 0, 'L', 0, 0, '47', 76+$remi, true);
	$pdf->MultiCell(50, 1, "Largo:", 0, 'L', 0, 0, '92', 76+$remi, true);
	$pdf->MultiCell(50, 1, "Ancho:", 0, 'L', 0, 0, '129', 76+$remi, true);
	$pdf->MultiCell(50, 1, "Alto:", 0, 'L', 0, 0, '170', 76+$remi, true);
	$pdf->MultiCell(80, 1,  $tipoHoja, 0, 'L', 0, 0, '89', 96+$remi, true);
	$pdf->MultiCell(120, 1, $resolucion, 0, 'L', 0, 0, '89', 101+$remi, true);

	$pdf->MultiCell(50, 1, $hora, 0, 'L', 0, 0, '170', '31', true);
	$pdf->MultiCell(50, 1, $guia, 0, 'L', 0, 0, '22', '21', true);
	$pdf->MultiCell(50, 1, $oficina, 0, 'L', 0, 0, '22', '26', true);
	$pdf->MultiCell(50, 1, $servicio, 0, 'L', 0, 0, '38', '31', true);
	$pdf->MultiCell(50, 1, $factura, 0, 'L', 0, 0, '146', '21', true);
	$pdf->MultiCell(50, 1, $fecha, 0, 'L', 0, 0, '120', '26', true);
	$pdf->MultiCell(50, 1, $vence, 0, 'L', 0, 0, '160', '26', true);
	$pdf->MultiCell(50, 1, $docRef, 0, 'L', 0, 0, '126', '31', true);
	$pdf->MultiCell(71, 1, $cliente, 0, 'L', 0, 0, '20', '36', true);
	$pdf->MultiCell(80, 1, $direccionC, 0, 'L', 0, 0, '26', '41', true);
	$pdf->MultiCell(50, 1, $origen, 0, 'L', 0, 0, '26', '46', true);
	$pdf->MultiCell(50, 1, $nit, 0, 'L', 0, 0, '126', '36', true);
	$pdf->MultiCell(50, 1, $telefonoC, 0, 'L', 0, 0, '126', '41', true);
	$pdf->MultiCell(50, 1, $destino, 0, 'L', 0, 0, '126', '46', true);

	$pdf->MultiCell(71, 1, $destinatario, 0, 'L', 0, 0, '30', 51+$remi, true);
	$pdf->MultiCell(80, 1, $direccionD, 0, 'L', 0, 0, '26', 56+$remi, true);
	$pdf->MultiCell(80, 1, $contacto, 0, 'L', 0, 0, '26', 61+$remi, true);
	$pdf->MultiCell(50, 1, $empaque, 0, 'L', 0, 0, '26', 66+$remi, true);
	$pdf->MultiCell(50, 1, $observacion, 0, 'L', 0, 0, '29', 71+$remi, true);
	$pdf->MultiCell(50, 1, $ced, 0, 'L', 0, 0, '126', 51+$remi, true);
	$pdf->MultiCell(50, 1, $telefonoD1, 0, 'L', 0, 0, '126', 56+$remi, true);
	$pdf->MultiCell(50, 1, $telefonoD2, 0, 'L', 0, 0, '126', 61+$remi, true);
	$pdf->MultiCell(50, 1, $cantidad, 0, 'L', 0, 0, '80', 66+$remi, true);
	$pdf->MultiCell(50, 1, $kiloAd, 0, 'L', 0, 0, '126', 66+$remi, true);
	$pdf->MultiCell(50, 1, $contenido, 0, 'L', 0, 0, '166', 66+$remi, true);
	$pdf->MultiCell(50, 1, $valorDecla, 0, 'L', 0, 0, '26', 81+$remi, true);
	$pdf->MultiCell(50, 1, $valorFlete, 0, 'L', 0, 0, '80', 81+$remi, true);
	$pdf->MultiCell(50, 1, $valorKiloAd, 0, 'L', 0, 0, '141', 81+$remi, true);
	$pdf->MultiCell(50, 1, $valorTotal, 0, 'L', 0, 0, '185', 81+$remi, true);
	$pdf->MultiCell(50, 1, $valorSeguro, 0, 'L', 0, 0, '26', 86+$remi, true);
	$pdf->MultiCell(50, 1, $descFlete, 0, 'L', 0, 0, '80', 86+$remi, true);
	$pdf->MultiCell(50, 1, $descKilo, 0, 'L', 0, 0, '146', 86+$remi, true);
	$pdf->MultiCell(50, 1, $valorFirmado, 0, 'L', 0, 0, '46', 91+$remi, true);
	$pdf->MultiCell(50, 1, $kiloNegoc, 0, 'L', 0, 0, '118', 91+$remi, true);
	$pdf->MultiCell(50, 1, $formaPago, 0, 'L', 0, 0, '178', 91+$remi, true);
	$pdf->MultiCell(50, 1, $peso, 0, 'L', 0, 0, '24', 76+$remi, true);
	$pdf->MultiCell(50, 1, $pesoVol, 0, 'L', 0, 0, '72', 76+$remi, true);
	$pdf->MultiCell(50, 1, $largo, 0, 'L', 0, 0, '103', 76+$remi, true);
	$pdf->MultiCell(50, 1, $ancho, 0, 'L', 0, 0, '141', 76+$remi, true);
	$pdf->MultiCell(50, 1, $alto, 0, 'L', 0, 0, '179', 76+$remi, true);
	$pdf->MultiCell(70, 1, 'Operario: '.$nombre, 0, 'L', 0, 0, '145', 96+$remi, true);

}
$pdf->IncludeJS('print(true);');
$pdfString = $pdf->Output('separadorGuia.pdf', 'E'); 
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);
echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:820px;height:520px;" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>


<script>
var link = <?php echo "'".$this->Html->link('Registrar venta', array('action'=>'crear'),array('class'=>'btn btn-success'))."'";?>;
$(document).ready(function(){
	$("#btn-limpiar").after(link);
});
</script>
