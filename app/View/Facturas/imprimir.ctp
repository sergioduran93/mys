<?php 
App::import('Vendor','xtcpdf');
$altoM  = 290;
$largoM = 215;
$pdf    = new XTCPDF('p', 'mm', array($largoM,$altoM), true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setPrintFooter(false);
$pdf->SetMargins(0, 0, 0, 0);

/*
$guias = array_merge($guias,$guias);
$guias = array_merge($guias,$guias);
$guias = array_merge($guias,$guias);*/
$salto = 0;
$pagAct = 0;
$numPag = ceil((count($guias)+3)/23);
$pdf->AddPage();

$pdf->SetFont('Times','B',14);
$pdf->MultiCell(100, 1, "FACTURA DE VENTA #".$factura['Factura']['numero'], 0, 'L', 0, 0, '100', '5', true);

$pdf->SetFont('Times','B',11);
$pdf->MultiCell(60, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '1', '21', true);
$pdf->MultiCell(60, 1, "NIT 811023661-1", 0, 'C', 0, 0, '1', '25', true,0,false,true,5,'T',false);
$pdf->MultiCell(60, 1, "Despachamos HOY mismo", 0, 'C', 0, 0, '1', '29', true,0,false,true,5,'T',false);

$pdf->MultiCell(140, 1, "FECHA:", 0, 'L', 0, 0, '60', '11', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "VENCE:", 0, 'L', 0, 0, '130', '11', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "CLIENTE:", 0, 'L', 0, 0, '60', '16', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "CC o NIT:", 0, 'L', 0, 0, '60', '21', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "TELEFONO:", 0, 'L', 0, 0, '130', '21', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "DIRECCIÓN:", 0, 'L', 0, 0, '60', '26', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, "Resolución:".$factura['Factura']['resolucion'], 0, 'C', 0, 0, '60', '31', true,0,false,true,5,'T',false);

$pdf->MultiCell(20, 1, "Remesa", 0, 'L', 0, 0, '2', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(25, 1, "Fecha", 0, 'L', 0, 0, '21', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(25, 1, "Destinatario", 0, 'L', 0, 0, '43', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(30, 1, "Destino", 0, 'L', 0, 0, '77', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(50, 1, "Dirección", 0, 'L', 0, 0, '104', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(20, 1, "Telefono", 0, 'L', 0, 0, '139', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(20, 1, "Doc. Ref.1", 0, 'L', 0, 0, '159', '36', true,0,false,true,5,'T',false);
$pdf->MultiCell(20, 1, "Valor", 0, 'L', 0, 0, '190', '36', true,0,false,true,5,'T',false);


$pdf->SetFont('Times','',11);
$pdf->MultiCell(140, 1, $factura['Factura']['fecha'], 0, 'L', 0, 0, '85', '11', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, $factura['Factura']['vence'], 0, 'L', 0, 0, '155', '11', true,0,false,true,5,'T',false);
$pdf->MultiCell(160, 1, $factura['Factura']['cliente_nom'], 0, 'L', 0, 0, '85', '16', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, $factura['Factura']['cliente_cc'], 0, 'L', 0, 0, '85', '21', true,0,false,true,5,'T',false);
$pdf->MultiCell(160, 1, $factura['Factura']['cliente_dir'], 0, 'L', 0, 0, '85', '26', true,0,false,true,5,'T',false);
$pdf->MultiCell(140, 1, $factura['Factura']['cliente_tel'], 0, 'L', 0, 0, '155', '21', true,0,false,true,5,'T',false);



$pdf->Line(1, 36, ($largoM-9), 36, null);
$pdf->Line(1, 41, ($largoM-9), 41, null);

foreach ($guias as $key => $value) {
	if($key % 22 == 0){
		$pagAct += 1;
		if($pagAct == $numPag){
			$pdf->Line(1, ($altoM-20), ($largoM-9), ($altoM-20), null); //ABA
			$pdf->MultiCell(68, 1, "Op: ".$user['name'], 0, 'L', 0, 0, '2', ($altoM-16), true,0,false,true,5,'T',false);
			$pdf->MultiCell(69, 1, "Recibido por: ______________________", 0, 'L', 0, 0, '70', ($altoM-16), true,0,false,true,5,'T',false);
			$pdf->MultiCell(67, 1, "Cedula/Nit: ______________________", 0, 'L', 0, 0, '139', ($altoM-16), true,0,false,true,5,'T',false);

		}
		$pdf->Line(1, 5, ($largoM-9), 5, null); //ARRI
		$pdf->Line(1, 5, 1, ($altoM-10), null); //IZQ
		$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-10), null);  //DER
		$pdf->Line(1, ($altoM-10), ($largoM-9), ($altoM-10), null); //ABA
		$pdf->SetFont('Times','',11);
		$pdf->MultiCell(20, 1, "Pag: ".$pagAct."/".$numPag, 0, 'L', 0, 0, ($largoM-28), '5', true,0,false,true,5,'T',false);

		$salto = 0;
	}
	$pdf->MultiCell(20, 1, $value['Venta']['remesa'], 0, 'L', 0, 0, '1', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(22, 1, $value['Venta']['fecha'], 0, 'L', 0, 0, '21', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(35, 1, $value['Venta']['nombreDest'], 0, 'L', 0, 0, '43', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(27, 1, $value['Venta']['destinoNombre'], 0, 'L', 0, 0, '77', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(35, 1, $value['Venta']['direccionDest'], 0, 'L', 0, 0, '104', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(20, 1, $value['Venta']['telefonoDest'], 0, 'L', 0, 0, '139', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(27, 1, $value['Venta']['documento1'], 0, 'L', 0, 0, '159', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(20, 1, $value['Venta']['valor_total'], 0, 'R', 0, 0, '186', '41'+(5*$salto), true,0,false,true,5,'T',false);
	$salto += 1;
}
//$pdf->IncludeJS('print(true);');
$pdfString = $pdf->Output('separadorGuia.pdf', 'E'); 
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);
echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:820px;height:520px;" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>


<script>
var link = <?php echo "'".$this->Html->link('Registrar Nota de Devolución', array('action'=>'notaDevolucion'),array('class'=>'btn btn-success'))."'";?>;
$(document).ready(function(){
	$("#btn-limpiar").after(link);
});
</script>
