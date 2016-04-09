<?php 
echo $this->Html->script('jquery.fancybox.pack');
echo $this->Html->script('bootstrap.min');
echo $this->Html->css('jquery.fancybox');
App::import('Vendor','carta');
$altoM  = 216;
$largoM = 279;
$pdf    = new CARTA('l', 'mm', array($largoM,$altoM), true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, 0);


$headerLogo = true;
$row        = 0;
$init       = true;
$total      = ceil(count($info)/38);
$pag = 0;
foreach ($info as $key => $value) {
	if($row%38 == 0){
		$headerLogo = true;
		$pdf->AddPage();
		$row = 0;
		$pag = $pag + 1;
	}
	$row = $row + 1;
	if($headerLogo){
		$headerLogo = false;
		$pdf->SetFont('Times','B',14);
		$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '90', '5', true);
		$pdf->SetFont('Times','B',11);
		$pdf->MultiCell(140, 1, "Nit: 811023661-1 Regimen Común", 0, 'C', 0, 0, '90', '11', true);
		$pdf->MultiCell(140, 1, "Carrera 46 No. 42-79 Tels:(4) 4446033 Medellín-Colombia", 0, 'C', 0, 0, '90', '16', true);
		$pdf->MultiCell(140, 1, "Pag. ".$pag." / ".$total, 0, 'L', 0, 0, '250', '5', true);
	}
	$pdf->SetFont('Times','',11);
	if($init){
		$init = false;
		$pdf->Line(1, 26, ($largoM-9), 26, null);
		$pdf->SetFont('Times','B',11);
	}

	$pdf->Cell2(1,16+(5*$row),15,$value[1]);
	$pdf->Cell2(16,16+(5*$row),22,$value[2]);
	$pdf->Cell2(38,16+(5*$row),35,$value[3]);
	$pdf->Cell2(73,16+(5*$row),22,$value[4]);
	$pdf->Cell2(95,16+(5*$row),35,$value[5]);
	$pdf->Cell2(130,16+(5*$row),19,$value[6]);
	$pdf->Cell2(149,16+(5*$row),25,$value[7]);
	$pdf->Cell2(174,16+(5*$row),25,$value[8]);
	$pdf->Cell2(199,16+(5*$row),22,$value[9]);
	$pdf->Cell2(221,16+(5*$row),35,$value[10]);
	$pdf->Cell2(256,16+(5*$row),11,$value[11]);


	$pdf->Line(1, 5, ($largoM-9), 5, null);
	$pdf->Line(1, 21, ($largoM-9), 21, null);
	$pdf->Line(1, ($altoM-5), ($largoM-9), ($altoM-5),null);

	$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-5),null);
	$pdf->Line(1, 5, 1, ($altoM-5),null);

	// Cuadrado
	
}
//$pdf->IncludeJS('print(true);');
$pdfString = $pdf->Output('separadorGuia.pdf', 'E'); 
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);
echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:1000px;height:500px" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>

