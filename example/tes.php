<?php 
require_once("../src/FingerSolution.php");

$finger = new metcore\FingerSolution\FingerSolution([
	'ipaddress'=> "192.168.0.250"
]);

// Get all user
// $data = $finger->getUserInfo();

// // Get all user with pin 
// $data = $finger->getUserInfo(['pin'=>8]);

// // // Delete data user
// $data = $finger->deleteUser(['pin'=>6]);

// // get finger biometric hash data
// // fingerId : 1 - 10 (Jari)
// $dataTemplate = $finger->getUserTemplate(['pin'=>8, 'fingerId'=>6]);

// //Set finger biometric hash data
// $setFinger = $finger->setUserTemplate([
// 	'template'	=> $dataTemplate['Template'],
// 	'fingerId'	=> 6,
// 	'pin'		=> 87,
// ]);

// //Delete Template
// $deleteTemplate = $finger->deleteTemplate(["pin"=>"8"]);

// // // Add user
// // // privilege : 0 user biasa , 14 Super admin
// $data = $finger->setUserInfo([
// 	'name'	=> "Mamet",
// 	'pin'=> "8",
// 	'privilege'=>0,
// 	'password'=>12345
// ]);

// Get Date 

// $data = $finger->getDate();

$data = $finger->rebootDevice();
var_dump($data);