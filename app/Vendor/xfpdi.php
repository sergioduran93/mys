<?php 
App::import('Vendor','fpdi/fpdi'); 

class XFPDI  extends FPDI 
{ 
   
    var $files = array();

    function setFiles($files) 
    {
        $this->files = $files;
    }

    function concat() 
    {
        foreach($this->files AS $file) 
        {
            $pagecount = $this->setSourceFile($file);

            for($i = 1; $i <= $pagecount; $i++) 
            {
                $this->AddPage('P');
                $tplidx = $this->ImportPage($i);
                $this->useTemplate($tplidx);
            }
        }
    }
} 
?>