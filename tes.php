<?php 
require_once("src/FingerSolustion.php");


$finger = new metcore\FingerSolustion\FingerSolustion([
	'ipaddress'=> "192.168.0.196"
]);

// Get all user
$data = $finger->getUserInfo();

// Get all user with pin 
$data = $finger->getUserInfo(['pin'=>8]);

// Delete data user
$data = $finger->deleteUser(['pin'=>6]);

// get finger biometric hash data
// fingerId : 1 - 10 (Jari)
$dataTemplete = $finger->getUserTemplate(['pin'=>8, 'fingerId'=>6]);

// //Set finger biometric hash data
$setFinger = $finger->setUserTemplate([
	'templete'	=> $dataTemplete['Template'],
	'fingerId'	=> $dataTemplete['FingerID'],
	'pin'		=> 9,
]);

// // Add user
// // privilege : 0 user biasa , 14 Super admin
$data = $finger->setUserInfo([
	'name'	=> "Mamet",
	'pin'=> "8",
	'privilege'=>0,
	'password'=>12345
]);