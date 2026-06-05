<?php 


class Conexion extends Mysqli{
	
	
	private $conexion;
	private $host;
	private $user;
	private $pass;
	private $security;
	private $database;
	public function __construct(){
		
		self::config();
		$this->conexion = parent::__construct($this->host,$this->user,$this->pass,$this->database);
		$this->set_charset("utf8");
		return $this->conexion;
	}
	
	
	public function config(){
		
		$this->host = "localhost";
		
		$this->user = "root";
		//$this->user = "id3511256_julioruiz";
		
		//$this->pass = "julio ruiz";
		$this->pass = "";
		$this->database = "siagym";
		//$this->database = "id3511256_siagym";
		
	}
	
	
	
	
}

?>