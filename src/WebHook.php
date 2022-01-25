<?php 
namespace metcore\FingerSolustion;

/**
 * Class for getit 
 */
class WebHook
{
	public $ipAddress ;
	public $serialNumber;
	/* 
	 * This funct
	 */
	function __construct()
	{
		$this->ipAddress = $_SERVER['REMOTE_ADDR'];
		
		if(isset($_GET) && isset($_GET['SN']))
			$this->serialNumber = $_GET['SN'];
	}

}