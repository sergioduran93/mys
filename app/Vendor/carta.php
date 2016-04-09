<?php 
App::import('Vendor','tcpdf/tcpdf'); 

class CARTA  extends TCPDF 
{ 
    var $xheadertext = 'PDF creado por Mandar y servir'; 
    var $xfootertext = 'Derechos reservados a Mandar y servir S.A.S.'; 
    var $xfooterfont = PDF_FONT_NAME_MAIN ;

    function Header() 
    {
        $this->Image('img/logo_pdf2.png', 56, 7, 45, '', '', false, '', false, 0);
        // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    }

    function Footer(){
    }
/*
    function Cell2($x, $y, $txt='') {
        $this->StartTransform();
        $this->Rect($x, $y, $w, 5, 'CNZ');
        $this->writeHTMLCell($w, 5, $x, $y, $txt);
        $this->StopTransform();
    }
*/
    function Cell2($x, $y, $w, $txt='',$border=0) {
        $this->StartTransform();
        if($border== 0){
            $this->Rect($x, $y, $w, 5, 'CNZ');
        } else {
            $this->Rect($x, $y, $w, 5, 'D');
        }
        $this->writeHTMLCell($w, 5, $x, $y, $txt);
        $this->StopTransform();
    }
} 
?>