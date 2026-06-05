<?php

class Delete{
	
	public function __construct(){
		
		include_once("conexion.php");
		$conexion = new Conexion();
		$select = "select id_aprendiz,fecha_vencimiento from carnet";
		$query = $conexion->query($select);
		$row  = $query->num_rows;
		if($row > 0){
			
			while($datos = $query->fetch_assoc()){
				
				$id = $datos["id_aprendiz"];
				$fecha = $datos["fecha_vencimiento"];
				$validation = $this->fecha($fecha);
				if($validation == false){
					
					$delete1 = "delete from carnet where id_aprendiz ='".$id."'";
					$delete2 = "delete from asistencia where id_aprendiz ='".$id."'";
					$delete3 = "delete from horario where id_aprendiz ='".$id."'";
					$delete4 = "delete from usuarios where identificacion ='".$id."'";

					$query1 = $conexion->query($delete1);
					$query2 = $conexion->query($delete2);
					$query3 = $conexion->query($delete3);
					$query4 = $conexion->query($delete4);

				}
			}
			
		}
			

		
	}
	
	public function fecha($valor){
		
		date_default_timezone_set ("America/Bogota");
				
		$diaactual = date("d");
		$mesactual = date("m");
		$yearactual = date("Y");
		$diavencimiento = substr($valor,8,9); 
		$mesvencimiento = substr($valor,5,-3);
		$yearvencimiento = substr($valor,0,4);
		
		if($yearvencimiento < $yearactual){
			
			return false;
		}else if($yearvencimiento > $yearactual){
			
			return true;
		}else if($mesvencimiento < $mesactual){
			
			
			return false;
		}else if($mesvencimiento > $mesactual){
			
			return true;
		}else if($diavencimiento < $diaactual){
			
			return false;
		}else{
			
			return true;
		}
	}
		
}
new Delete();
?>