<?php 
session_start();

	class Logout{
		
		
		
		public function __construct(){
			
			
			if(isset($_SESSION["administrador"])){
				
				
				
				if(isset($_POST["logout"])){
					
					
					session_destroy();
					header("location: ../index.php");
					
					
				}else{
					
					header("location: ../dashboard.php");
				}
				
			}else{
				
				header("location: ../index.php");
			}
		}
		
		
		
	}

	
new Logout();


?>