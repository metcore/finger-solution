# Project Title

SDK Fingerprint Solution

## Description

This is a calss for handle communiaction with device finger solution, 
Uses this class you can manupulation data on your device whitout iClock

And more documentation about data communcation with finger solution, you can see here
https://docplayer.net/187512891-Soap-development-manual.html

## Getting Started

### Installing
To install, either run
```bash
composer require metcore/finger-solution "@dev"
```
### Using Communication

Initiated class
```bash
$finger = new metcore\FingerSolution\FingerSolution([
	'ipaddress'=> "***.***.*.***"
]);
```
#### Get All User
```bash
$data = $finger->getUserInfo();
```
#### Get Single User
```bash
$data = $finger->getUserInfo(['pin'=>8]);
```
#### Add a User
```bash
// // privilege : 0 user  , 14 SuperAdmin
$data = $finger->setUserInfo([
	'name'	=> "User",
	'pin'=> "8",
	'privilege'=>0,
	'password'=>12345
]);
```
#### Delete A user
```bash
$data = $finger->deleteUser(['pin'=>6]);

```
#### Get List finger biometric 
```bash
$dataTemplete = $finger->getUserTemplate(['pin'=>8, 'fingerId'=>6]);
```
#### Set Finger biometric to a user 
```bash
$setFinger = $finger->setUserTemplate([
	'templete'	=> $dataTemplete['Template'],
	'fingerId'	=> $dataTemplete['FingerID'],
	'pin'		=> 9,
]);
```
#### Delete Finger biometric
```bash
$data = $finger->deleteTemplate(['pin'=>6]);

```


### Using WebHook


Before you start, you must have an device ip address,
to get the ip address, just point the url on the device to your url
and this will return the device id and ip address
```bash
$finger = new metcore\FingerSolution\WebHook;
$SN = $finger->serialNumber;
$ip = $finger->ipAddress;

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $SN`;
fwrite($myfile, $txt);
$txt = $ip;
fwrite($myfile, $txt);
fclose($myfile);
```
