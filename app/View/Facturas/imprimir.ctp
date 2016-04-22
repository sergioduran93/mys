<?php 
App::import('Vendor','XTCPDF');
$altoM  = 150;
$largoM = 235;

$pdf    = new XTCPDF('p', 'mm', 'legal', array($largoM,$altoM), true, 'UTF-8', false);

	$pdf->AddPage();
	$pdf->setPrintFooter(false);
	//$pdf->SetMargins(0, 0, 0, 0);
	$pdf->SetFont('times', '', 14); //nueva hoja
	//$pdf->setPrintHeader(false);
	//$pdf->setPrintFooter(false);
	// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
	$pdf->SetFont('Times','B',15);
	$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '43', '5', true);
	$pdf->SetFont('Times','B',9);
	$pdf->MultiCell(140, 1, "Carrera 46 No.42-79 Tel:4446033 Medellin-Colombia", 0, 'C', 0, 0, '43', '10', true);
	$pdf->SetFont('Times','B',14);
	$pdf->MultiCell(140, 1, "FACTURA DE VENTA No. ".$factura['Factura']['id'], 0, 'C', 0, 0, '80', '14', true);
	//$pdf->MultiCell(140, 1, "Nit: 811.023.661-1 Régimen Común", 0, 'C', 0, 0, '40', '16', true);
	$pdf->SetFont('Times','B',9.6);
	//Line  ($x1,$y1,$x2,$y2,$style = array())
	// Divisiones
	//$pdf->Line(1, 21, ($largoM-19), 21, null);
	$pdf->SetLineWidth(0.2);
	$pdf->Line(7, 45, ($largoM-25.8), 45); //Linea superior del cuadro
	$pdf->SetLineWidth(0.2); //Linea superior del cuadro
	$pdf->Line(7, 53, ($largoM-25.8), 53); //Linea secundaria  de
		//$pdf->MultiCell(50, 1, "DESDE:  ".$desde, 0, 'L', 0, 0, '6', '21', true);
		$fecha        = $envio['fecha'];
    $pdf->MultiCell(50, 1, "MANDAR Y SERVIR S.A.S", 0, 'C', 0, 0, '5', '21', true);
    $pdf->MultiCell(50, 1, "NIT. 811023661-1 ", 0, 'C', 0, 0, '6', '26', true);
    $pdf->SetFont('Times','B',6.5);
    $pdf->MultiCell(50, 1, "Despachamos hoy mismo sus mercancias, sobres, paquetes y encomiendas a todos los municipio de Antioquia", 0, 'C', 0, 0, '7', '32', true);
    $pdf->SetFont('Times','B',11);
	$pdf->MultiCell(115, 1, "Cliente: ".$factura['Factura']['cliente_nom'], 0, 'C', 0, 0, '43', '26', true);
	//$pdf->MultiCell(50, 1, $informe['Factura'][cliente_nom], 0, 'C', 0, 0, '80', '26', true);
	$pdf->MultiCell(88, 1, "C.c. o Nit: ".$factura['Factura']['cliente_cc'], 0, 'C', 0, 0, '45', '30', true);
	$pdf->MultiCell(50, 1, "Telefono: ".$factura['Factura']['cliente_tel'], 0, 'C', 0, 0, '135', '30', true);
	$pdf->MultiCell(110, 1, "Dirección: ".$factura['Factura']['cliente_dir'], 0, 'C', 0, 0, '45', '34', true);
	$pdf->SetFont('Times','B',8);
	$pdf->MultiCell(120, 1, "Res. 110000609470 de 2014/12/18 Autoriza del: 15001 a 25000", 0, 'L', 0, 0, '80', '40', true);
    $pdf->SetFont('Times','B',11);
	$pdf->MultiCell(50, 1, "Fecha:  ".$factura['Factura']['fecha'], 0, 'L', 0, 0, '60', '21', true,0,false,true,5,'T',false);
	$pdf->MultiCell(50, 1, "Fecha Vence:  ".$factura['Factura']['vence'], 0, 'L', 0, 0, '140', '21', true,0,false,true,5,'T',false);
	//$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', '31', true);
	//$pdf->MultiCell(50, 1, "HASTA:  ".$hasta, 0, 'L', 0, 0, '50', '21', true);
	//$pdf->MultiCell(50, 1, "Celular:", 0, 'L', 0, 0, '102', '31', true);
	//$pdf->SetFont('Times','B',12);
	$pdf->MultiCell(50, 1, "CODIGO", 0, 'L', 0, 0, '8', '46', true);
	//$pdf->MultiCell(50, 1, "Mys", 0, 'L', 0, 0, '3', '41', true);
	$pdf->MultiCell(50, 1, "CANT ", 0, 'L', 0, 0, '33', '46', true);
	$pdf->MultiCell(50, 1, "DETALLE", 0, 'L', 0, 0, '50', '46', true);
	$pdf->SetFont('Times','',8);
	$pdf->MultiCell(90, 1, "Transpore de Mercancias a diferentes destinos según", 0, 'L', 0, 0, '50', '53', true);
	$pdf->MultiCell(50, 1, "Relación adjunta No     ".$factura['Factura']['relacionfactura_id'], 0, 'L', 0, 0, '85', '60', true);
	
	$pdf->SetFont('Times','B',11);
	$pdf->MultiCell(50, 1, "VR UNITARIO", 0, 'L', 0, 0, '135', '46', true);
	$pdf->MultiCell(50, 1, "VR TOTAL", 0, 'L', 0, 0, '175', '46', true);
	$pdf->SetFont('Times','B',9);
	$pdf->MultiCell(50, 1, "".$factura['Factura']['valor'], 0, 'L', 0, 0, '178', '54', true);

	$pdf->SetLineWidth(0.2);
	$pdf->Line(7, 82, ($largoM-25.8), 82);//divisiones primer cuadro horizontal
    $pdf->SetLineWidth(0.2);
	$pdf->Line(30, 45, 30, ($altoM-68)); //divisiones primer cuadro VERTICAL 1 LINEA
    $pdf->SetLineWidth(0.2);
	$pdf->Line(50, 45, 50, ($altoM-68)); //divisiones primer cuadro VERTICAL 2 LINEA
    $pdf->SetLineWidth(0.2);
	$pdf->Line(135, 45, 135, ($altoM-68)); //divisiones primer cuadro VERTICAL 3 LINEA
    $pdf->SetLineWidth(0.2);
	$pdf->Line(175, 45, 175, ($altoM-68)); //divisiones primer cuadro VERTICAL 4 LINEA
	$pdf->SetLineWidth(0.2);
	$pdf->Line(115, 130, 115, ($altoM-68)); //divisiones primer cuadro VERTICAL 5 LINEA 1 DE SUBTOTAL
    $pdf->SetLineWidth(0.2);
	$pdf->Line(155, 130, 155, ($altoM-68)); //divisiones primer cuadro VERTICAL 4 LINEA 2 CONTIGUA
	$pdf->SetLineWidth(0.3);
	$pdf->Line(209, 5, 209, ($altoM-17)); //divisiones primer cuadro VERTICAL DERECHA
	$pdf->SetLineWidth(0.3);
	$pdf->Line(7, 5, 7, ($altoM-17)); //divisiones primer cuadro VERTICAL IZQUIERDA

	$pdf->MultiCell(50, 1, "SUB TOTAL:", 0, 'L', 0, 0, '117', '84', true);
	$pdf->MultiCell(50, 1, "".$factura['Factura']['valor'], 0, 'L', 0, 0, '155', '84', true);
	$pdf->SetLineWidth(0.2);
	$pdf->Line(115, 90, ($largoM-25.8), 90, null); //DIVISION LINEA HORIZONTAL SUBTOTAL
	$pdf->MultiCell(50, 1, "DESCUENTO", 0, 'L', 0, 0, '117', '92', true);
	$pdf->MultiCell(50, 1, "0", 0, 'L', 0, 0, '190', '92', true);
	$pdf->MultiCell(50, 1, "EXENTA:", 0, 'L', 0, 0, '117', '97', true);
	$pdf->MultiCell(50, 1, "BASE IVA:", 0, 'L', 0, 0, '117', '102', true);
	$pdf->SetLineWidth(0.2);
	$pdf->Line(115, 110, ($largoM-25.8), 110, null); //DIVISION LINEA HORIZONTAL BASE IVA
	$pdf->MultiCell(50, 1, "IVA:", 0, 'L', 0, 0, '117', '111', true);
	$pdf->MultiCell(50, 1, "0", 0, 'L', 0, 0, '190', '111', true);
	$pdf->SetLineWidth(0.2);
	$pdf->Line(115, 117, ($largoM-25.8), 117, null); //DIVISION LINEA HORIZONTAL IVA
	$pdf->SetFont('Times','B',15);
	$pdf->MultiCell(50, 1, "TOTAL:", 0, 'L', 0, 0, '117', '120', true);
	$pdf->SetFont('Times','B',10);
	$pdf->MultiCell(50, 1, "".$factura['Factura']['valor'], 0, 'L', 0, 0, '155', '120', true);
	$pdf->SetLineWidth(0.2);
	$pdf->Line(115, 130, ($largoM-25.8), 130, null); //DIVISION LINEA HORIZONTAL TOTAL
    $pdf->SetFont('times', '', 13); //nueva hoja
	$pdf->MultiCell(50, 1, "....ORIGINAL....", 0, 'L', 0, 0, '68', '123', true);
	$pdf->SetFont('times', 'B', 10); //nueva hoja
	$pdf->MultiCell(50, 1, "Vendido Por:         ", 0, 'L', 0, 0, '8', '85', true);
	$pdf->SetFont('times', '', 10); //nueva hoja
	$pdf->MultiCell(50, 1, "OFICINA", 0, 'L', 0, 0, '38', '85', true);
	$pdf->SetFont('times', 'B', 10); //nueva hoja
	$pdf->MultiCell(50, 1, "Forma de Pago:         ", 0, 'L', 0, 0, '8', '94', true);
	$pdf->SetFont('times', 'B', 10); //nueva hoja
	$pdf->MultiCell(50, 1, "Plazo en días:   ".$factura['Cliente']['dias_facturacion'], 0, 'L', 0, 0, '65', '94', true);
	$pdf->SetFont('times', 'B', 10); //nueva hoja
	$pdf->MultiCell(50, 1, "Elaboró:         ", 0, 'L', 0, 0, '8', '104', true);
	$pdf->SetFont('times', 'B', 10); //nueva hoja
	$pdf->MultiCell(50, 1, "Recibí Conforme:     ", 0, 'L', 0, 0, '8', '114', true);
	$pdf->SetFont('times', '', 10); //nueva hoja
	$pdf->MultiCell(50, 1, "F.Imp:  26/01/2016", 0, 'L', 0, 0, '8', '128', true);
	$pdf->SetFont('times', 'B', 8); //nueva hoja
	$pdf->MultiCell(170, 1, "Esta factura de compraventa se asimila en todo sus efectos a una letra de cambio (Art.621-772-773 Cod de Comercio)", 0, 'L', 0, 0, '35', '133', true);
	 $pdf->SetLineWidth(0.3);
	$pdf->Line(7, 133, ($largoM-25.8), 133); //Linea ABAJO
	//$pdf->SetLineWidth(0.2);
	//$pdf->Line(0, 122, ($largoM-168), 122);//divisiones primer cuadro horizontal
	$pdf->SetFont('times', '', 9); //nueva hoja
	
	$pdf->SetXY2(18,51);
		$pdf->Cell2(50, 1, $remitente, 0, 1, 'C', 0, '', 1);

	// Cuadrado
		$pdf->SetLineWidth(0.3);
	$pdf->Line(7, 5, ($largoM-25.8), 5, null); //ARRI

	$pdf->SetFont('Times','',11);

	$altoGuia = 40;

		if($key == 11 && count($venta) > 12){
			
			$altoGuia = -25;
			$pdf->AddPage();
            $pdf->SetLineWidth(0.2);
			$pdf->Line(1, 5, ($largoM-24), 5, null); //ARRI
			$pdf->SetLineWidth(0.2);
			$pdf->Line(1, 21, ($largoM-24), 21, null);

			$pdf->SetFont('Times','B',14);
			$pdf->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '400', true);
			$pdf->SetFont('Times','B',11);
			$pdf->MultiCell(140, 1, "RELACION FACTURACION  #".$id, 0, 'C', 0, 0, '40', '411', true);
			$pdf->MultiCell(140, 1, "Nit: 811.023.661-1 Régimen Común", 0, 'C', 0, 0, '40', '416', true);
			$pdf->MultiCell(50, 1, "Desde: ".$desde, 0, 'L', 0, 0, '2', '21', true);
			$fecha        = $envio['fecha'];

			$pdf->MultiCell(50, 1, "CLIENTE: ".$cliente, 0, 'C', 0, 0, '2', '25', true);
			$pdf->MultiCell(50, 1, "DOCUMENTO: ".$documentoDest, 0, 'L', 0, 0, '110', '25', true);
			$pdf->MultiCell(50, 1, "FECHA:".$fecha, 0, 'L', 0, 0, '120', '21', true);
			//$pdf->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', '31', true);
			$pdf->MultiCell(50, 1, "Hasta: ".$hasta, 0, 'L', 0, 0, '50', '21', true);
			//$pdf->MultiCell(120, 1, $despa['Despacho']['origen'].' - '.$despa['Despacho']['destino'], 0, 'C', 0, 0, '45', '16', true);
			//$pdf->MultiCell(40, 1, $despa['Despacho']['fecha'], 0, 'R', 0, 0, '165', '16', true);
		}
	
	$pdf->SetFont('Times','B',11);
    $pdf->SetXY(20,36);

$pdf->IncludeJS('print(true);');
$pdfString  = $pdf->Output('separadorGuia.pdf', 'E'); 
$pdfArray  = explode('"separadorGuia.pdf"', $pdfString);

echo '<div style="padding-bottom:10px;"><iframe id="PDFtoPrint" style="width:820px;height:520px;" src="data:application/pdf;base64,'.$pdfArray[2].'"></iframe></div>';
?>

