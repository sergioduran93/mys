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
        $this->SetFont('Times','B',11);
        $this->MultiCell(140, 1, "INFORME DE CUENTA REPRESENTANTE #".$id, 0, 'C', 0, 0, '40', '11', true); //FALTA PONER ID RELACION
        $this->MultiCell(140, 1, "Nit: 811.023.661-1 Régimen Común", 0, 'C', 0, 0, '40', '16', true);
        //$this->MultiCell(140, 1, "TOTAL RELACION: ".$factura['factura']['valor'], 0, 'L', 0, 0, '2', '269', true); //FALTA PONER ID RELACION
        $this->Ln(20);
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
        $this->Line(7, 268, ($largoM-26), 268, null);//sexta Linea
        $this->SetLineWidth(0.3);
        $this->Line(209, 5, 209, ($altoM-82)); //divisiones primer cuadro VERTICAL DERECHA
        $this->SetLineWidth(0.3);
        $this->Line(7, 5, 7, ($altoM-82)); //divisiones primer cuadro VERTICAL IZQUIERDA
*/
        $this->SetFont('Times','B',11);
        $this->MultiCell(50, 1, "TIPO", 0, 'L', 0, 0, '20', '36', true);
        $this->MultiCell(50, 1, "DOC REF1", 0, 'L', 0, 0, '57', '36', true);
        $this->MultiCell(50, 1, "FECHA", 0, 'L', 0, 0, '90', '36', true);
        $this->MultiCell(50, 1, "SALDO", 0, 'L', 0, 0, '130', '36', true);
        $this->MultiCell(50, 1, "CONCEPTO", 0, 'L', 0, 0, '170', '36', true);

        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    }

    function Footer() 
    { 
        // Go to 1.5 cm from bottom
    //$this->SetY(-15);
    // Select Arial italic 8
       
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




?>