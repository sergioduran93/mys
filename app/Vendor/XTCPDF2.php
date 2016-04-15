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
        $this->MultiCell(140, 1, "PLANILLA RECIBO DE MERCANCIAS #", 0, 'C', 0, 0, '40', '11', true); //FALTA PONER ID RELACION
        $this->MultiCell(140, 1, "Nit: 811.023.661-1 Régimen Común", 0, 'C', 0, 0, '40', '16', true);
        //$this->MultiCell(140, 1, "TOTAL RELACION: ".$factura['factura']['valor'], 0, 'L', 0, 0, '2', '269', true); //FALTA PONER ID RELACION
        $this->Ln(20);


        $this->SetFont('times', '', 9); //FUENTE
        $this->MultiCell(50, 1, "GUIA", 0, 'L', 0, 0, '10', '38', true);
        $this->MultiCell(50, 1, "DESTINATARIO", 0, 'L', 0, 0, '25', '38', true);
        $this->MultiCell(50, 1, "DESTINO", 0, 'L', 0, 0, '55', '38', true);
        $this->MultiCell(50, 1, "DIRECCION", 0, 'L', 0, 0, '77', '38', true);
        $this->MultiCell(50, 1, "TELEFONO", 0, 'L', 0, 0, '100', '38', true);
        $this->MultiCell(50, 1, "CANTIDAD", 0, 'L', 0, 0, '122', '38', true);
         $this->MultiCell(50, 1, "EMPAQUE", 0, 'L', 0, 0, '145', '38', true);
        $this->MultiCell(50, 1, "VALOR", 0, 'L', 0, 0, '166', '38', true);
        $this->MultiCell(50, 1, "DOCUMENTO", 0, 'L', 0, 0, '184', '38', true);
       


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