# Project Title

SDK Fingerprint Solution

## Description

This is a calss for handle communiaction with device finger solution, 
Uses this class you can manupulation data on your device whitout iClock

And more documentation about data communcation with finger solution, you can see here
https://docplayer.net/187512891-Soap-development-manual.html

## Getting Started

### Dependencies

### Installing

### Using

Iitiated class
```bash
$finger = new metcore\FingerSolustion\FingerSolustion([
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
#### Delete A user
```bash
$data = $finger->deleteUser(['pin'=>6]);

```

## Depedency List

