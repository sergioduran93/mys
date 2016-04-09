<?php 
App::import('Vendor','XTCPDF');
$altoM  = 147;
$largoM = 215;
$pdf    = new XTCPDF('l', 'mm', array($largoM,$altoM), true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setPrintFooter(false);
$pdf->SetMargins(0, 0, 0, 0);

/*
$guias = array_merge($guias,$guias);
$guias = array_merge($guias,$guias);
$guias = array_merge($guias,$guias);*/
$pdf->SetFont('Times','B',11);

$pdf->AddPage();
$pdf->MultiCell(60, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '1', '21', true);
$pdf->MultiCell(60, 1, "NIT 811023661-1", 0, 'C', 0, 0, '1', '25', true,0,false,true,5,'T',false);
$pdf->MultiCell(60, 1, "Despachamos HOY mismo", 0, 'C', 0, 0, '1', '29', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "Oficina: ".$oficina['Oficina']['listNombre'], 0, 'R', 0, 0, '60', '6', true,0,false,true,5,'T',false);

$pdf->MultiCell(140, 1, "FECHA:", 0, 'L', 0, 0, '60', '11', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "CEDULA:", 0, 'L', 0, 0, '60', '16', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "NOMBRES:", 0, 'L', 0, 0, '60', '21', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "NRO. FACTURA:", 0, 'L', 0, 0, '60', '26', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "COD. CONTABLE:", 0, 'L', 0, 0, '60', '31', true,0,false,true,5,'T',false);

$pdf->MultiCell(50, 1, "COD CONCEPTO", 0, 'C', 0, 0, '1', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(120, 1, "DETALLE", 0, 'C', 0, 0, '51', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(35, 1, "VALOR", 0, 'C', 0, 0, '171', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(100, 1, "FIRMA NIT Y SELLO DEL BENEFICIARIO", 0, 'C', 0, 0, 100, ($altoM-21), true,0,false,true,5,'T',false);


$pdf->Line(1, 36, ($largoM-9), 36, null);
$pdf->Line(1, 41, ($largoM-9), 41, null);
$pdf->Line(1, 5, ($largoM-9), 5, null); //ARRI
$pdf->Line(1, 5, 1, ($altoM-16), null); //IZQ
$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-16), null);  //DER
$pdf->Line(1, ($altoM-16), ($largoM-9), ($altoM-16), null); //ABA

$pdf->MultiCell(68, 1, "Op: ".$user['User']['listNombre'], 0, 'L', 0, 0, '2', ($altoM-16), true,0,false,true,5,'T',false);

$pdf->SetFont('Times','B',14);
$pdf->MultiCell(100, 1, $cont['Contabl']['tipo']." #".$cont['Contabl']['numero'], 0, 'L', 0, 0, '100', '5', true);

$pdf->SetFont('Times','',11);
$pdf->MultiCell(140, 1, $cont['Contabl']['fecha'], 0, 'L', 0, 0, '100', '11', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, $cont['Contabl']['cedula'], 0, 'L', 0, 0, '100', '16', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, $cont['Contabl']['nombres'], 0, 'L', 0, 0, '100', '21', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, $cont['Contabl']['factura'], 0, 'L', 0, 0, '100', '26', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, $cont['Contabl']['contable'], 0, 'L', 0, 0, '100', '31', true,0,false,true,5,'T',false);

$renglon = 36;
foreach ($conceptos as $key => $value) {
	$renglon += 5;
	$pdf->MultiCell(50, 1, $value['Concepto']['codigo'], 0, 'L', 0, 0, '1', $renglon, true,0,false,true,5,'T',false);
	$pdf->MultiCell(120, 1, $value['Concepto']['descrip'], 0, 'L', 0, 0, '51', $renglon, true,0,false,true,5,'T',false);
	$pdf->MultiCell(34, 1, "$".number_format($value['Concepto']['valor'],0,'',','), 0, 'R', 0, 0, '171', $renglon, true,0,false,true,5,'T',false);
}

$pdf->MultiCell(99, 50, 'OBSERVACIONES', 0, 'L', 0, 0, '1', $renglon+10, true,0,false,true,5,'T',false);
$pdf->MultiCell(99, 50, $cont['Contabl']['obs'], 0, 'L', 0, 0, '1', $renglon+15);
$pdf->MultiCell(120, 1, "TOTAL COMPROBANTE: ", 0, 'R', 0, 0, '51', $renglon+5, true,0,false,true,5,'T',false);
$pdf->MultiCell(34, 1, "$".number_format($cont['Contabl']['total'],0,'',','), 0, 'R', 0, 0, '171', $renglon+5, true,0,false,true,5,'T',false);

$pdf->Line(50, 36, 50, $renglon+5, null);
$pdf->Line(170, 36, 170, $renglon+5, null);

$pdf->Line(1, $renglon+5, ($largoM-9), $renglon+5, null);
$pdf->Line(1, $renglon+10, ($largoM-9), $renglon+10, null);
$pdf->Line(100, $renglon+10, 100, ($altoM-16), null);  //DIV
$pdf->Line(100, ($altoM-21), ($largoM-9), ($altoM-21), null);



//$pdf->IncludeJS('print(true);');
$pdfString = $pdf->Output('separadorGuia.pdf', 'E'); 
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);
echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:820px;height:520px;" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>


<script>
var link = <?php echo "'".$this->Html->link('Nuevo Egreso', array('action'=>'egresos'),array('class'=>'btn btn-success'))."'";?>;
var link2 = <?php echo "'".$this->Html->link('Nuevo Ingreso', array('action'=>'ingresos'),array('class'=>'btn btn-success'))."'";?>;
$(document).ready(function(){
	$("#btn-limpiar").after(link);
	$("#btn-limpiar").after(link2);
});
</script>
