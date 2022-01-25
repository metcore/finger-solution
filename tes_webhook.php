<?php 
require_once("src/WebHook.php");
$finger = new metcore\FingerSolustion\WebHook;
$SN = $finger->serialNumber;
$ip = $finger->ipAddress;

