<?php 
App::import('Vendor','tcpdf/tcpdf'); 

class Planilla  extends TCPDF 
{ 
    var $xheadertext = 'PDF creado por Mandar y servir'; 
    var $xfootertext = 'Derechos reservados a Mandar y servir S.A.S.'; 
    var $xfooterfont = PDF_FONT_NAME_MAIN ;
    function Header() 
    {
        $this->Image('img/logo_pdf2.png', 6, 7, 45, '', '', false, '', false, 0);
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    }

    function Footer() 
    { 

    } 
} 
?>