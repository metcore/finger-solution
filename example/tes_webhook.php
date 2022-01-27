<?php 
require_once("src/WebHook.php");
$finger = new metcore\FingerSolution\WebHook;
$SN = $finger->serialNumber;
$ip = $finger->ipAddress;


$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $SN;
fwrite($myfile, $txt);
$txt = $ip;
fwrite($myfile, $txt);
fclose($myfile);