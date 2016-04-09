<?php 
App::import('Vendor','XTCPDF');
$altoM  = 147;
$largoM = 215;
$pdf    = new XTCPDF('l', 'mm', array($largoM,$altoM), true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->AddPage(); 
$pdf->setPrintFooter(false);
$pdf->SetMargins(0, 0, 0, 0);


$pdf->SetFont('Times','B',14);
$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '5', true);
$pdf->SetFont('Times','B',11);
$pdf->MultiCell(140, 1, "ANTICIPOS DE CAJA", 0, 'C', 0, 0, '40', '11', true);

// Divisiones
$pdf->Line(1, 21, ($largoM-9), 21, null);
$pdf->Line(1, 26, ($largoM-9), 26, null);

	// Cuadrado
$pdf->Line(1, 5, ($largoM-9), 5, null); //ARRI
$pdf->Line(1, 5, 1, ($altoM-40), null); //IZQ
$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-40), null);  //DER
$pdf->Line(1, ($altoM-40), ($largoM-9), ($altoM-40), null); //ABA

$pdf->MultiCell(20, 1, "Número", 0, 'L', 0, 0, '2', '21', true);
$pdf->MultiCell(25, 1, "Transacción", 0, 'L', 0, 0, '22', '21', true);
$pdf->MultiCell(20, 1, "Fecha", 0, 'L', 0, 0, '47', '21', true);
$pdf->MultiCell(30, 1, "Fecha Digito", 0, 'L', 0, 0, '85', '21', true);
$pdf->MultiCell(20, 1, "Realizo", 0, 'L', 0, 0, '128', '21', true);
$pdf->MultiCell(20, 1, "Valor", 0, 'L', 0, 0, '190', '21', true);

$pdf->SetFont('Times','',11);
$pdf->MultiCell(140, 1, "Oficina: ".$oficinas[$oficina]."   (".$desde." / ".$hasta.")", 0, 'C', 0, 0, '40', '16', true);
foreach ($anticipos as $key => $value) {
	$pdf->MultiCell(20, 1, $value['Anticipo']['retiro_no'], 0, 'L', 0, 0, '2', '26'+(5*$key), true);
	$pdf->MultiCell(20, 1, $value['Anticipo']['transaccion'], 0, 'L', 0, 0, '22', '26'+(5*$key), true);
	$pdf->MultiCell(45, 1, $value['Anticipo']['fecha'].' '.$value['Anticipo']['hora'], 0, 'L', 0, 0, '47', '26'+(5*$key), true);
	$pdf->MultiCell(43, 1, $value['Anticipo']['fecha_digito'].' '.$value['Anticipo']['hora_digito'], 0, 'L', 0, 0, '85', '26'+(5*$key), true);
	$pdf->MultiCell(62, 1, $value['Anticipo']['realizo'], 0, 'L', 0, 0, '128', '26'+(5*$key), true);
	$pdf->MultiCell(16, 1, $value['Anticipo']['valor'], 0, 'L', 0, 0, '190', '26'+(5*$key), true);
	
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
