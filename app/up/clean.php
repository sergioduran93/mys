<?php
//echo php_uname();
$rutaC = "D:\wamp\www\MyS\app\up\clean.bat";
echo pclose(popen("start ".$rutaC, "w"));
echo $rutaC;
//$WshShell = new COM("WScript.Shell"); 
//$oExec = $WshShell->Run(Router::url('\\')."app\\config\\update.bat'", 8, false);
/*//$WshShell = new COM("WScript.Shell"); 
//$oExec = $WshShell->Run("notepad.exe", 7, false); 
*/

?>