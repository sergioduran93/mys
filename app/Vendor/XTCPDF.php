<?php 
App::import('Vendor','tcpdf/tcpdf'); 

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
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    }

    function Footer() 
    { 
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
        $this->write1DBarcode($this->codigo, 'C128', $this->barraX, $this->barraY+$this->remi, '', 14, 0.4, $style, 'N');
        //$this->write1DBarcode($this->codigo, 'C128', 3, 120, '', 13, 0.4, $style, 'N');
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
?>