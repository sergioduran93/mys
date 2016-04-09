<?php
//echo php_uname();
$ruta = "D:\wamp\www\MyS\app\up\update.bat";
$rutaLog = 'D:\wamp\www\MyS\app\tmp\logs\error.log';
$rutaDeb = 'D:\wamp\www\MyS\app\tmp\logs\debug.log';

$myTextFileHandler  = @fopen($rutaLog,"r+");
$myTextFileHandler2 = @fopen($rutaDeb,"r+");
@ftruncate($myTextFileHandler, 0);
@ftruncate($myTextFileHandler2, 0);

echo pclose(popen("start ".$ruta, "w"));

echo $ruta.": 01";
//$WshShell = new COM("WScript.Shell"); 
//$oExec = $WshShell->Run(Router::url('\\')."app\\config\\update.bat'", 8, false);
/*//$WshShell = new COM("WScript.Shell"); 
//$oExec = $WshShell->Run("notepad.exe", 7, false); 
*/

?>