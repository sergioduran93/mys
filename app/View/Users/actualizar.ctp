<?php
//echo php_uname();
$ruta = 'C:/wamp/www'.Router::url('/')."app/update.bat'";
echo pclose(popen("start ".$ruta, "w"));

echo $ruta;
//$WshShell = new COM("WScript.Shell"); 
//$oExec = $WshShell->Run(Router::url('\\')."app\\config\\update.bat'", 8, false);
/*//$WshShell = new COM("WScript.Shell"); 
//$oExec = $WshShell->Run("notepad.exe", 7, false); 
*/

?>