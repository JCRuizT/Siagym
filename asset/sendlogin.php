<?php 
session_start();
require("conexion.php");

class Login{
	
	private $username;
	private $password;
	private $query;
	private $rows;
	private $conexion;
	private $ResultSet;
	private $sql;
	public function __construct(){
		
		
		if(isset($_POST["send"])){
			
			$this->conexion = new Conexion();
			
			$this->username =  $_POST["user"];
			
			$this->username = mysqli_real_escape_string($this->conexion,$this->username);
			
			$this->password = $_POST["pass"];
			
			$this->password = strtolower($this->password);
			
			$this->password = base64_encode($this->password);

			$this->password = mysqli_real_escape_string($this->conexion,$this->password);
			
			$this->query = self::Query();
			
			$this->rows = $this->query->num_rows;
			
			if($this->query){
				
				if($this->rows == 1){

					
					$_SESSION["administrador"] = $this->username;
					
					header("location: ../dashboard.php");
					
				}else{
					
					header("location: ../index.php");
				}
				
			}
			
		}else{
			header("location: ../index.php");
		}
	}
		
		
	private function Query(){
			
		$this->sql = "select * from admin where username="."'".$this->username."' AND password= '".$this->password."'";
			
		$this->ResultSet = $this->conexion->query($this->sql);
			
		return $this->ResultSet;
		
	}
			
	
}


new Login();

?>