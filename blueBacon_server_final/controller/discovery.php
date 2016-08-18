<?php
/**
 * Class Network
 * 
 */
class Discovery  {
	
	/**
	 * Versenden eins Bradcast
	 */
	 
	 const HMAC_SECRET = "eFqqDnFNeLLJ";
	 
	 function __construct(){
	 	$this->listen();
	 }
	 
	function listen()
	{
		if(!$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);		
				
			die("Couldn't create socket: [$errorcode] $errormsg");
		} 
		if(!socket_bind($sock, "0.0.0.0", 9996))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);		
			die("Couldn't bind socket: [$errorcode] $errormsg");
		}
		while(true) 
		{
		  $ret = socket_recvfrom($sock, $buf, 100, 0, $ip, $port);
		  
		  if($ret === false || strlen($ret) != 32) continue;
		  
		  $hash_value = hash_hmac("sha256", $ret, HMAC_SECRET);
		  send($hash_value, $ip);
		}
		
		socket_close($sock);
		
	}
	
	function send($data, $ip){
		
		if(!$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);		
				
			die("Couldn't create socket: [$errorcode] $errormsg");
		} 
		socket_sendto($sock, $data, strlen($data), 0, $ip, 9996);
		socket_close($sock);
	}
}
$test = new Discovery();
