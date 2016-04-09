<?php 
App::import('Vendor','xtcpdf');
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
$salto = 0;
$pagAct = 0;
$numPag = ceil((count($guias)+3)/23);
$pdf->SetFont('Times','B',11);

foreach ($guias as $key => $value) {
	if($key % 22 == 0){
		$pdf->AddPage();
		$pagAct += 1;
		if($pagAct == $numPag){
			$pdf->Line(1, ($altoM-20), ($largoM-9), ($altoM-20), null); //ABA
			$pdf->MultiCell(68, 1, "Op: ".$user['name'], 0, 'L', 0, 0, '2', ($altoM-16), true,0,false,true,5,'T',false);
			$pdf->MultiCell(69, 1, "Recibido por: ______________________", 0, 'L', 0, 0, '70', ($altoM-16), true,0,false,true,5,'T',false);
			$pdf->MultiCell(67, 1, "Cedula/Nit: ______________________", 0, 'L', 0, 0, '139', ($altoM-16), true,0,false,true,5,'T',false);

		}
		$pdf->SetFont('Times','B',14);
		$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '5', true);
		$pdf->SetFont('Times','B',11);
		$pdf->MultiCell(140, 1, "NOTA DE DEVOLUCIÓN #".$devolucion['Cartaporte']['id'], 0, 'C', 0, 0, '40', '11', true);
		$pdf->Line(1, 21, ($largoM-9), 21, null);
		$pdf->Line(1, 26, ($largoM-9), 26, null);
		$pdf->Line(1, 5, ($largoM-9), 5, null); //ARRI
		$pdf->Line(1, 5, 1, ($altoM-10), null); //IZQ
		$pdf->Line(($largoM-9), 5, ($largoM-9), ($altoM-10), null);  //DER
		$pdf->Line(1, ($altoM-10), ($largoM-9), ($altoM-10), null); //ABA
		$pdf->MultiCell(20, 1, "Remesa", 0, 'L', 0, 0, '2', '21', true,0,false,true,5,'T',false);
		$pdf->MultiCell(25, 1, "Fecha", 0, 'L', 0, 0, '21', '21', true,0,false,true,5,'T',false);
		$pdf->MultiCell(20, 1, "Remite", 0, 'L', 0, 0, '43', '21', true,0,false,true,5,'T',false);
		$pdf->MultiCell(30, 1, "Origen", 0, 'L', 0, 0, '77', '21', true,0,false,true,5,'T',false);
		$pdf->MultiCell(50, 1, "Destinatario", 0, 'L', 0, 0, '104', '21', true,0,false,true,5,'T',false);
		$pdf->MultiCell(20, 1, "Dirección", 0, 'L', 0, 0, '139', '21', true,0,false,true,5,'T',false);
		$pdf->MultiCell(20, 1, "Destino", 0, 'L', 0, 0, '179', '21', true,0,false,true,5,'T',false);
		$pdf->SetFont('Times','',11);
		$pdf->MultiCell(140, 1, "FECHA: ".date('Y-m-d  h:i'), 0, 'C', 0, 0, '40', '16', true,0,false,true,5,'T',false);
		$pdf->MultiCell(20, 1, "Pag: ".$pagAct."/".$numPag, 0, 'L', 0, 0, '179', '16', true,0,false,true,5,'T',false);

		$salto = 0;
	}
	$pdf->MultiCell(20, 1, $value['Venta']['remesa'], 0, 'L', 0, 0, '1', '26'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(22, 1, $value['Venta']['fecha'], 0, 'L', 0, 0, '21', '26'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(35, 1, $value['Venta']['nombreDest'], 0, 'L', 0, 0, '43', '26'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(27, 1, $value['Venta']['destinoNombre'], 0, 'L', 0, 0, '77', '26'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(35, 1, $value['Venta']['nombreClien'], 0, 'L', 0, 0, '104', '26'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(40, 1, $value['Venta']['direccionClien'], 0, 'L', 0, 0, '139', '26'+(5*$salto), true,0,false,true,5,'T',false);
	$pdf->MultiCell(27, 1, $value['Venta']['origenNombre'], 0, 'L', 0, 0, '179', '26'+(5*$salto), true,0,false,true,5,'T',false);
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
