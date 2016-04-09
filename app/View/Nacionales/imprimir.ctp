<?php 
App::import('Vendor','planilla');
$altoM  = 147;
$largoM = 215;
$pdf    = new Planilla('l', 'mm', array($largoM,$altoM), true, 'UTF-8', false);
		$pdf->AddPage();

	$pdf->SetMargins(0, 0, 0, 0);
	$pdf->SetFont('times', '', 14);
	//$pdf->setPrintHeader(false);
	//$pdf->setPrintFooter(false);

	// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

	$pdf->SetFont('Times','B',14);
	$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '5', true);
	$pdf->SetFont('Times','B',11);
	$pdf->MultiCell(140, 1, "PLANILLA DE TRASLADO NACIONAL # ".$id, 0, 'C', 0, 0, '40', '11', true);
	//Line  ($x1,$y1,$x2,$y2,$style = array())

	// Divisiones
	$pdf->Line(1, 21, ($largoM-9), 21, null);
	$pdf->Line(1, 36, ($largoM-9), 36, null);
	$pdf->Line(1, 41, ($largoM-9), 41, null);
	

	$pdf->MultiCell(50, 1, "Negociador:", 0, 'L', 0, 0, '2', '21', true);
	$pdf->MultiCell(50, 1, "Representante:", 0, 'L', 0, 0, '2', '26', true);
	$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', '31', true);
	$pdf->MultiCell(50, 1, "Código:", 0, 'L', 0, 0, '102', '21', true);
	$pdf->MultiCell(50, 1, "Teléfono:", 0, 'L', 0, 0, '102', '26', true);
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
	$pdf->MultiCell(120, 1, $reemp['Nacional']['origen'].' - '.$reemp['Nacional']['destino'], 0, 'C', 0, 0, '45', '16', true);
	$pdf->MultiCell(40, 1, $reemp['Nacional']['fecha'], 0, 'R', 0, 0, '165', '16', true);
	$pdf->MultiCell(50, 1, $negoc['Auxiliar']['nombre'], 0, 'L', 0, 0, '25', '21', true);
	$pdf->MultiCell(50, 1, $repre['Representante']['listNombre'], 0, 'L', 0, 0, '30', '26', true);
	$pdf->MultiCell(50, 1, $repre['Representante']['direccion'], 0, 'L', 0, 0, '23', '31', true);
	$pdf->MultiCell(50, 1, $repre['Representante']['codigo'], 0, 'L', 0, 0, '120', '21', true);
	$pdf->MultiCell(50, 1, $repre['Representante']['telefono1'], 0, 'L', 0, 0, '120', '26', true);
	$pdf->MultiCell(80, 1, $repre['Representante']['celular'], 0, 'L', 0, 0, '120', '31', true);
	$altoGuia = -5;
		$pdf->Line(1, 5, 1, ($altoM-25), null); //IZQ
	$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-25), null);  //DER
	$pdf->Line(1, ($altoM-25), ($largoM-9), ($altoM-25), null); //ABA
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
			$pdf->MultiCell(140, 1, "PLANILLA DE TRASLADO NACIONAL # ".$id, 0, 'C', 0, 0, '40', '11', true);
			$pdf->MultiCell(120, 1, $reemp['Nacional']['origen'].' - '.$reemp['Nacional']['destino'], 0, 'C', 0, 0, '45', '16', true);
			$pdf->MultiCell(40, 1, $reemp['Nacional']['fecha'], 0, 'R', 0, 0, '165', '16', true);
		}
	}

	$pdf->Line(1, 46+$altoGuia, ($largoM-9), 46+$altoGuia, null);

	$pdf->MultiCell(50, 1, 'Op: '.$usuario, 0, 'L', 0, 0, '1', 46+$altoGuia, true);

	$pdf->SetFont('Times','B',11);
	$pdf->MultiCell(50, 1, 'Unidades: '.$cantTotal, 0, 'R', 0, 0, '115', 46+$altoGuia, true);
	$pdf->MultiCell(50, 1, 'Total: '.$reemp['Nacional']['valor'], 0, 'R', 0, 0, '156', 46+$altoGuia, true);
	$pdf->MultiCell(100, 1, 'Firma Negociador:_________________________', 0, 'L', 0, 0, '1', 51+$altoGuia, true);

	$pdf->Line(1, 5, 1, ($altoM-25), null); //IZQ
	$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-25), null);  //DER
	$pdf->Line(1, ($altoM-25), ($largoM-9), ($altoM-25), null); //ABA

$pdf->IncludeJS('print(true);');
$pdfString = $pdf->Output('separadorGuia.pdf', 'E'); 
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);
echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:820px;height:520px;" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>


<script>
var link = <?php echo "'".$this->Html->link('Registrar Traslado Nacional', array('controller'=>'reempaques','action'=>'traslado'),array('class'=>'btn btn-success'))."'";?>;
$(document).ready(function(){
	$("#btn-limpiar").after(link);
});
</script>
