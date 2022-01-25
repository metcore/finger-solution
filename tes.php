<?php 
require_once("src/FirstExtention.php");


$finger = new metcore\FingerSolustion\FingerSolustion([
	'ipaddress'=> "192.168.0.196"
]);

// Dapetin data user 
// $data = $finger->getUserInfo();
// var_dump($data);
// exit();

// Delete data user
// $data = $finger->deleteUser(['pin'=>6]);

// Add user templete
// 0 user biasa , 14 Super admin
// $data = $finger->setUserInfo([
// 	'name'	=> "Mamet tes",
// 	'pin'=> "123",
// 	'privilege'=>0,
// 	'password'=>12345
// ]);


// $data = $finger->getUserTemplete(['pin'=>8, 'fingerId'=>6]);
// var_dump($data);
// exit();

//Set user templete
$setFinger = $finger->setUserTemplete([
	'templete'	=> $data[0]['Template'],
	'fingerId'	=> $data[0]['FingerID'],
	'pin'		=> 123,
]);
exit();

// var_dump($data);
// exit();