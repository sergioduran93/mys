<?php 
App::import('Vendor','tcpdf/tcpdf'); 
$altoM  = 350;
$largoM = 235;
class XTCPDF  extends TCPDF 
{ 

    var $xheadertext = 'PDF creado por Mandar y servir'; 
    var $xfootertext = 'Derechos reservados a Mandar y servir S.A.S.'; 
    var $xfooterfont = PDF_FONT_NAME_MAIN ;
    var $codigo = 0;
    var $remi   = 0;
    var $barraX = 3;
    var $barraY = 96;
    var $x = 0;
    var $y = 0;

    function Header() 
    {
        $this->Image('img/logo_pdf2.png', 6, 7, 45, '', '', false, '', false, 0);
        $this->SetFont('Times','B',14);
        $this->MultiCell(140, 1, "MANDAR Y SERVIR S.A.S.", 0, 'C', 0, 0, '40', '5', true);
       
        //$this->MultiCell(140, 1, "TOTAL RELACION: ".$factura['factura']['valor'], 0, 'L', 0, 0, '2', '269', true); //FALTA PONER ID RELACION
        $this->Ln(20);

        /*
        $this->MultiCell(50, 1, "DESDE:  ".$desde, 0, 'L', 0, 0, '10', '21', true);
    //  $fecha        = $envio['fecha'];

        $this->MultiCell(185, 1, "CLIENTE: ", 0, 'C', 0, 0, '.100', '25', true);
        $this->MultiCell(50, 1, "DOCUMENTO: ", 0, 'L', 0, 0, '57', '30', true);
        $this->MultiCell(50, 1, "FECHA:  ", 0, 'L', 0, 0, '145', '21', true,0,false,true,5,'T',false);
      //$this->MultiCell(50, 1, "Dirección:", 0, 'L', 0, 0, '2', '31', true);
        $this->MultiCell(50, 1, "HASTA:  ", 0, 'L', 0, 0, '58', '21', true);
      //$this->MultiCell(50, 1, "Celular:", 0, 'L', 0, 0, '102', '31', true);
        */



        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    }

    function Footer() 
    { 
        // Go to 1.5 cm from bottom
    //$this->SetY(-15);
    // Select Arial italic 8
        /*
    $this->SetLineWidth(0.3);
    $this->Line(7, 21, ($largoM-26), 21, null);//Segunda Linea
    $this->SetLineWidth(0.3);
    $this->Line(7, 36, ($largoM-26), 36, null);//Tercera Linea
    $this->SetLineWidth(0.3);
    $this->Line(7, 46, ($largoM-26), 46, null);//Cuarta Linea
    $this->SetLineWidth(0.3);
    $this->Line(7, 260, ($largoM-26), 260, null);//Quinta Linea
    $this->SetLineWidth(0.3);
    $this->Line(209, 5, 209, ($altoM-90)); //divisiones primer cuadro VERTICAL DERECHA
    $this->SetLineWidth(0.3);
    $this->Line(7, 5, 7, ($altoM-90)); //divisiones primer cuadro VERTICAL IZQUIERDA
    */
    $this->SetFont('Times','B',11);
    $this->MultiCell(140,1,'Pagina '.$this->PageNo(),0, 'C' , 0, 0, '120', '5' , true);
    
        $this->SetTextColor(71, 255, 0); 
        $style = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0,0,0),
        'bgcolor' => false, //array(255,255,255),
        'text' => true,
        'font' => 'helvetica',
        'fontsize' => 8,
        'stretchtext' => 4
        );
        //$this->write1DBarcode($this->codigo, 'C128', $this->barraX, $this->barraY+$this->remi, '', 14, 0.4, $style, 'N');
        //$this->write1DBarcode($this->codigo, 'C128', 3, 120, '', 13, 0.4, $style, 'N');
        //$this->Cell(140,1,'Pagina '.$this->PageNo().'/{nb}',0,'C', 0, 0, '120', '5' , true);
        
    }

    function SetXY2($xx = 0, $yy = 0) {
        $this->x = $xx;
        $this->y = $yy;


    }
    function Cell2($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M') {
        //$txt = substr($txt, 0, ($w/2));
       // $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign);
        
        $h = 5;
        $this->StartTransform();
        $this->Rect($this->x, $this->y, $w, $h, 'CNZ');
        $this->writeHTMLCell($w, $h, $this->x, $this->y, $txt);
        $this->StopTransform();
    }
   

}

$pdf = new XTCPDF();

$pdf->AddPage();

for($i=1;$i<=40;$i++)
$pdf->Cell(0,10,'Printing line number '.$i,0,1);

/*
//$pdf->SetFillColor(255, 255, 255);
    foreach ($informe as $key => $value) {
        $altoGuia = $altoGuia+7;
        $pdf->SetFont('times', '', 7); //nueva hoja
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(28, 0, $value['Venta']['remesa'], 0, 10, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(47, 1, $value['Venta']['documento1'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(67, 1, $value['Venta']['fecha'], 0, 1, 'C', 0, '', 1);
        $pdf->SetFont('times', '', 5.5); //nueva hoja
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(108, 1, $value['Venta']['origenNombre'], 10, 1, 'C', 0, '', 1);
        /*
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(119, 1, $value['Venta']['destinoNombre'], 0, 1, 'C', 0, '', 1);
        */
        /*
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(183, 1, $value['Venta']['nombreDest'], 0, 1, 'C', 0, 'C', 0);
        */
        /*
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(249, 1, $value['Venta']['cantidad'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(266, 1, $value['Venta']['empaque'], 0, 1, 'C', 0, '', 1);
        $pdf->SetFont('times', '', 7); //nueva hoja
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(291, 1, $value['Venta']['declarado'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(315, 1, $value['Venta']['desc_flete'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(335, 1, $value['Venta']['kilo_adic'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(355, 1, $value['Venta']['desc_kilo'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(375, 1, $value['Venta']['valorFlete'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(393, 1, $value['Venta']['valor_devolucion'], 0, 1, 'C', 0, '', 1);
        $pdf->SetXY(1,2+($altoGuia));
        $pdf->Cell(407, 1, $value['Venta']['valor_total'], 0, 1, 'C', 0, '', 1);

        //$pdf->SetXY(500,2+($altoGuia));
        //$pdf->Cell(151, 1, $value['Venta']['nombreDest'], 0, 1, 'L', 0, '', 1);
        //$pdf->SetXY(300,2+($altoGuia));
        //$pdf->Cell(242, 1, $value['Venta']['fecha'], 0, 1, 'L', 0, '', 1);
        //$pdf->SetXY(300,2+($altoGuia));
        //$pdf->Cell(290, 1, $value['Venta']['valor_total'], 0, 1, 'L', 0, '', 1);
        
        if($key == 25 && count($venta) > 26){
            $altoGuia = +7;
/*
            $pdf->AddPage();
            $pdf->Line(1, 5, ($largoM-24), 5, null); //ARRI
            $pdf->Line(1, 21, ($largoM-24), 21, null);
            */


//$pdf->Output();
      //  }
    //}


?>