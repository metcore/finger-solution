<?php 

namespace metcore\FingerSolustion;

/**
 * 
 */
class FingerSolustion 
{
	//ip address mesin absen
	public $ipaddress;
	public $port = 80;

	public $connect;
	public $soapRequest;
	public $outPutParams;
	public $comKey = 0;

	public $data;
	public $errno;
	public $errorMessage;

	// User data
	public $pin = "ALL";
	public $fingerId;
	// 14 Superadmin, 0 user biasa
	public $privilege;
	public $password;
	public $name;
	public $card = 0;
	public $group = 0;
	// Password
	public $tz1 = 0;
	// FIngerprint
	public $tz2 = 0;
	// PIN
	public $tz3 = 0;
	public $size;
	public $valid = 1;
	
	public function __construct(array $options=[]){
		$this->ipaddress = $options['ipaddress'];
		if(isset($options['port']))
			$this->port = $options['port'];
	}
	
	public function getAttende(array $condition=[]){
		$this->connect();
		$this->setCondition($condition);
		$this->soapRequest = "<GetAttLog>
			<ArgComKey xsi:type=\"xsd:integer\">".$this->comKey."</ArgComKey>
			<Arg><PIN xsi:type=\"xsd:integer\">".$this->pin."</PIN></Arg>
		  </GetAttLog>";
		$this->outPutParams = '/<GetAttLogResponse>(.*)<\/GetAttLogResponse>/ms';
		$this->execute();
		return $this->data;
	}
	
	public function getUserInfo(array $condition=[]){
		$this->connect();
		$this->setCondition($condition);
		$this->soapRequest = "<GetUserInfo><ArgComKey>".$this->comKey."</ArgComKey><Arg><PIN>".$this->pin."</PIN></Arg></GetUserInfo>";
		$this->outPutParams = '/<GetUserInfoResponse>(.*)<\/GetUserInfoResponse>/ms';
		$this->execute();
		return $this->data;
	}
	
	public function setUserInfo(array $condition=[]){
		$this->connect();
		$this->setCondition($condition);
		$this->soapRequest = "<SetUserInfo><ArgComKey>".$this->comKey."</ArgComKey><Arg><Name>".$this->name."</Name><Password>".$this->password."</Password><Group>".$this->group."</Group><Privilege>".$this->privilege."</Privilege><Card>".$this->card."</Card><PIN2>".$this->pin."</PIN2><TZ1>".$this->tz1."</TZ1><TZ2>".$this->tz2."</TZ2><TZ3>".$this->tz3."</TZ3></Arg></SetUserInfo>";
		$this->outPutParams = '/<SetUserInfoResponse>(.*)<\/SetUserInfoResponse>/ms';
		$this->execute();
		return $this->data;
	}

	public function getCombination(array $condition=[]){
		$this->connect();
		$this->setCondition($condition);
		$this->soapRequest = '<GetCombination><ArgComKey>0</ArgComKey></GetCombination>';
		$this->execute();
		return $this->data;
	}

	public function deleteUser(array $condition=[]){
		$this->connect();
		$this->setCondition($condition);
		$this->soapRequest = '<DeleteUser><ArgComKey>'.$this->comKey.'</ArgComKey><Arg><PIN>'.$this->pin.'</PIN></Arg></DeleteUser>';
		$this->outPutParams = '/<DeleteUserResponse>(.*)<\/DeleteUserResponse>/ms';
		$this->execute();
		return $this->data;
	}
	
	/**
	 * For get templete user / data finger print
	 * @param array [1 = pin, 2 = fingger_id]
	 * @return data finger
	 * */
	public function getUserTemplate(array $condition=[]){
		$this->connect();
		$this->setCondition($condition);
		var_dump($this->pin);
		var_dump($this->fingerId);
		$this->soapRequest = "<GetUserTemplate><ArgComKey>0</ArgComKey><Arg><PIN>".$this->pin."</PIN><FingerID>".$this->fingerId."</FingerID></Arg></GetUserTemplate>";
		$this->outPutParams = '/<GetUserTemplateResponse>(.*)<\/GetUserTemplateResponse>/ms';
		$this->execute();
		return $this->data;
	}

	public function setUserTemplate(array $condition=[]){
		$this->connect();
		$this->setCondition($condition);
		$this->soapRequest = "<SetUserTemplate><ArgComKey>".$this->comKey."</ArgComKey><Arg><PIN>".$this->pin."</PIN><FingerID>".$this->fingerId."</FingerID><Size>".$this->size."</Size><Valid>".$this->valid."</Valid><Template>".$this->templete."</Template></Arg></SetUserTemplate>";
		$this->outPutParams = '/<SetUserTemplateResponse>(.*)<\/SetUserTemplateResponse>/ms';
		$this->execute();
		return $this->data;
	}

	protected function setCondition($options){
		isset($options['pin']) ? $this->pin = $options['pin'] : false;
		isset($options['finger_id']) ? $this->fingerId = $options['finger_id'] : false;
		isset($options['name']) ? $this->name = $options['name'] : false;
		isset($options['privilege']) ? $this->privilege = $options['privilege'] : false;
		isset($options['password']) ? $this->password = $options['password'] : false;
		isset($options['fingerId']) ? $this->fingerId = $options['fingerId'] : false;
		isset($options['templete']) ? $this->templete = $options['templete'] : false;
		isset($options['templete']) ? $this->size = strlen($options['templete']) : 0;
		isset($options['valid']) ? $this->valid = $options['valid'] : false;
	}

	protected function connect(){
		$this->connect = @fsockopen($this->ipaddress, $this->port, $errno, $errstr, 1);
		if(!$this->connect){
			$this->errno = $errno;
			$this->errorMessage = $errstr;
			return false;
		}
	}

	protected function execute(){
		$newLine = "\r\n";
		fputs($this->connect, "POST /iWsService HTTP/1.0".$newLine);
		fputs($this->connect, "Content-Type: text/xml".$newLine);
		fputs($this->connect, "Content-Length: ".strlen($this->soapRequest).$newLine.$newLine);
		fputs($this->connect, $this->soapRequest.$newLine);
 		$buffer = "";

		while($response = fgets($this->connect, 1024)) {
			$buffer = $buffer.$response;
		};
		
		fclose($this->connect);
		$this->data = $buffer ? $this->normalize($buffer) : null;
	}

	public function normalize($data){
		preg_match_all($this->outPutParams, $data, $matches, PREG_SET_ORDER, 0);
		if(!$matches){
			return null;
		}

		$xml = simplexml_load_string("<tes>".$matches[0][1]."</tes>");
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		return $array ? $array["Row"] : null;
	}
}