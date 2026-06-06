<?php 
session_start();
class CrudSiaGym{
	
	private $conexion;
	private $response;
	
	public function __construct(){
		
		if(isset($_SESSION["administrador"])){
			
			if(isset($_POST["send-add"])){
			
				self::conexion();
				self::add();
				
				
			

			}else if(isset($_POST["send-assistance"])){
				
				self::conexion();
				self::assistance();
				
				
			}else if(isset($_POST["send-update"])){
				
				self::conexion();
				self::update();
				
			}else if(isset($_POST["send-search"])){
				
				
				self::conexion();
				self::search();
				
				
			}else if(isset($_POST["send-statistics"])){
				
				
				self::conexion();
				self::statistics();
				
				
			}else if(isset($_POST["send-schedule-create"])){
				self::conexion();
				self::scheduleCreate();
				
			}else if(isset($_POST["send-schedule-update"])){
				self::conexion();
				self::scheduleUpdate();
				
			}else if(isset($_POST["send-schedule-delete"])){
				self::conexion();
				self::scheduleDelete();
				
			}else if(isset($_POST["send-get-schedules"])){
				self::conexion();
				self::scheduleGet();
				
			}else if(isset($_POST["send-schedule-toggle"])){
				self::conexion();
				self::scheduleToggle();
				
			}else if(isset($_POST["send-get-schedules-by-role"])){
				self::conexion();
				self::scheduleGetByRole();
				
			}else if(isset($_POST["ListarYear"])){
				
				
				self::conexion();
				self::ListarYear();
				
				
			}else{
				
				header("location: ../dashboard.php");
			}
		
		}else{
			
			header("location: ../index.php");
			
		}
		
	}
	

	public function sql($sql){
		
		return $sql;
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
	public function getConfiDateAsistencia($valor){
		
		date_default_timezone_set ("America/Bogota");

		$dia = substr($valor,8,9); 
		$mes = substr($valor,5,-3);
		$year= substr($valor,0,4);
		
		
		return array("dia"=>$dia,"mes",$mes,"año",$year);
	}
	
	public function configDate($y,$m,$d){
		
		
		return $y."-".$m."-".$d;
		
	}
	
	
	private function add(){


		$nombre = $_POST["nombre"];
		$nombre = strtolower($nombre);
		$apellido = $_POST["apellido"];
		$apellido = strtolower($apellido);
		$identificacion = $_POST["identificacion"];
		
		$natalicio0 = $_POST["natalicio0"];
		$natalicio1 = $_POST["natalicio1"];
		$natalicio2 = $_POST["natalicio2"];
		
		$natalicio = $this->configDate($natalicio2,$natalicio1,$natalicio0);
		
		$genero = $_POST["genero"];
		$rol = $_POST["rol"];
		$correo = $_POST["correo"];
		$correo = strtolower($correo);
		$ficha = $_POST["ficha"];
		
		if($rol == 1){
			

		}else if($rol == 2){
			
			$ficha = 0;
		}
		$centro = $_POST["centro"];
		
		
		if($centro == 1){
			
			$centro = "ceai";
		}else if($centro == 2){
			
			$centro = "cgts";
			
		}else if($centro == 3){
			
			$centro = "astin";
		}
		
		$fecha_ven_carnet0 =  $_POST["fecha_ven_carnet0"];
		$fecha_ven_carnet1 =  $_POST["fecha_ven_carnet1"];
		$fecha_ven_carnet2 =  $_POST["fecha_ven_carnet2"];
		
		$fecha_ven_carnet = $this->configDate($fecha_ven_carnet2,$fecha_ven_carnet1,$fecha_ven_carnet0);
		
		
		
		
		$peso = $_POST["peso"];
		$estatura = $_POST["estatura"];
		$dia = $_POST["dia"];
		$hora = $_POST["hora"];
		
		
		if(!empty($nombre) and $rol!=0 and !empty($apellido) and !empty($identificacion) and $natalicio0!=00 and  $natalicio1!=00 and $natalicio2!=0 and $fecha_ven_carnet0 !=00 and $fecha_ven_carnet1 != 00 and $fecha_ven_carnet2 !=0  and !empty($genero) and !empty($correo) and !empty($centro) and $peso!=0 and  $estatura!=0 and $hora!=0 and $genero!=0){
			
			if(is_numeric($identificacion) and is_numeric($estatura) and is_numeric($peso)  and is_numeric($hora) and is_numeric($ficha) and is_string($nombre) and is_string($apellido) and is_numeric($fecha_ven_carnet0) and is_numeric($fecha_ven_carnet1) and is_numeric($fecha_ven_carnet2) and is_numeric($natalicio0) and is_numeric($natalicio1) and is_numeric($natalicio2)){
				
			$select = $this->sql("select identificacion from usuarios where identificacion = ".$identificacion);
			
			$query = $this->conexion->query($select);
			
			$row = $query->num_rows;			
			
			if($row != 0){
				
				$this->response["aviso"] = "Este usuario ya existe";
				$this->response["validar"] = 0;
			}else{
				
				$fecha = $this->fecha($fecha_ven_carnet);

				if($fecha == true){
					
	
				
					$insert1 = $this->sql("insert into usuarios(identificacion,peso,estatura,natalicio,nombre,apellido,genero,correo,rol) values(".$identificacion.",".$peso.",".$estatura.",'".$natalicio."','".$nombre."','".$apellido."','".$genero."','".$correo."',".$rol.")") ;
				
					$query = $this->conexion->query($insert1);
				
					$insert2 = $this->sql("insert into carnet(ficha,centro,fecha_vencimiento,id_aprendiz)values(".$ficha.",'".$centro."','".$fecha_ven_carnet."',".$identificacion.")");
				
					$query2 = $this->conexion->query($insert2);
					
					$insert3 = $this->sql("insert into horario(schedule_time_id,id_aprendiz)values(".$hora.",".$identificacion.")");
				
					$query3 = $this->conexion->query($insert3);
				
					if($query and $query2 and $query3){
						$this->response["aviso"] = "registro exitoso";
						$this->response["validar"] = 1;
					}else{
						$this->response["aviso"] =  "Ha ocurrido un error en el registro";
						$this->response["validar"] = 0;
					}
				
				}else{
					
					$this->response["aviso"] =  "fecha de vencimiento no valida";
					$this->response["validar"] = 0;
				}
				
			}
			

		}else{
			
			$this->response["aviso"] = "Ha ocurrido un error";
			$this->response["validar"] = 0;
		}	
			
		}else{
			
			$this->response["aviso"] = "rellene todos los campos";
			$this->response["validar"] = 0;
		}
		
			
		echo json_encode($this->response);
	}

	
	
	public function dia($fecha) {
		
		
		setlocale(LC_ALL,"es_ES@euro","es_ES","esp","es");
		$fecha =  date("w",strtotime($fecha));
		$dias= array('d','l','m','x','j','v','s');	

		$dia = $dias[$fecha];
		
		return $dia;
	}
	
	
	private function assistance(){
		
		date_default_timezone_set ("America/Bogota");
		$identificacion = $_POST["identificacion"];

		if($identificacion != "" && is_numeric($identificacion)){
			
			$select = $this->sql("select identificacion from usuarios where identificacion = ".$identificacion);
			$queryuser = $this->conexion->query($select);
			$row = $queryuser->num_rows;

			if($row == 0){
				$this->response["aviso"] = "Este usuario no existe";
				$this->response["validar"] = 0;
				echo json_encode($this->response);
				return;
			}

			$fecha = $_POST["fecha"];
			$hora = (int)$_POST["hora"];
			$yearl = substr($fecha,0,4);

			$selectconfirm = $this->sql("select * from asistencia where id_aprendiz = ".$identificacion." and fecha = '".$fecha."'");
			$queryConfim = $this->conexion->query($selectconfirm);

			if($queryConfim->num_rows > 0){
				$this->response["aviso"] = "Este Usuario ya ingreso";
				$this->response["validar"] = 0;
				echo json_encode($this->response);
				return;
			}

			$selecall = $this->sql("select * from horario where id_aprendiz = ".$identificacion);
			$queryll = $this->conexion->query($selecall);
			$assocl = $queryll->fetch_assoc();

			if(!$assocl || empty($assocl["schedule_time_id"])){
				$this->response["aviso"] = "El usuario no tiene un horario asignado";
				$this->response["validar"] = 0;
				echo json_encode($this->response);
				return;
			}

			$timeId = (int)$assocl["schedule_time_id"];

			$selectTime = $this->sql("SELECT t.start_time, t.end_time, t.schedule_days_id, d.schedule_id, d.day_of_week FROM schedule_days_times t JOIN schedule_days d ON d.id = t.schedule_days_id WHERE t.id=$timeId");
			$queryTime = $this->conexion->query($selectTime);
			$timeRow = $queryTime->fetch_assoc();

			if(!$timeRow){
				$this->response["aviso"] = "El horario asignado ya no está disponible";
				$this->response["validar"] = 0;
				echo json_encode($this->response);
				return;
			}

			$scheduleId = (int)$timeRow["schedule_id"];

			$checkActive = $this->sql("SELECT estado FROM schedules WHERE id=$scheduleId");
			$qActive = $this->conexion->query($checkActive);
			$activeRow = $qActive->fetch_assoc();

			if(!$activeRow || $activeRow["estado"] == 0){
				$this->response["aviso"] = "El horario asignado no está activo";
				$this->response["validar"] = 0;
				echo json_encode($this->response);
				return;
			}
			$dayOfWeek = (int)date("w", strtotime($fecha));

			$selectDays = $this->sql("SELECT id FROM schedule_days WHERE schedule_id=$scheduleId AND day_of_week=$dayOfWeek");
			$queryDays = $this->conexion->query($selectDays);

			if($queryDays->num_rows == 0){
				$this->response["aviso"] = "Este usuario no puede ingresar el dia de hoy";
				$this->response["validar"] = 0;
				echo json_encode($this->response);
				return;
			}

			$startH = (int)substr($timeRow["start_time"], 0, 2);
			$startM = (int)substr($timeRow["start_time"], 3, 2);
			$endH = (int)substr($timeRow["end_time"], 0, 2);
			$endM = (int)substr($timeRow["end_time"], 3, 2);

			$horaMinutos = $hora * 60;
			$inicioMinutos = $startH * 60 + $startM;
			$finMinutos = $endH * 60 + $endM;

			if(!($horaMinutos >= $inicioMinutos && $horaMinutos < $finMinutos)){
				$this->response["aviso"] = "Este usuario no puede ingresar en esta hora";
				$this->response["validar"] = 0;
				echo json_encode($this->response);
				return;
			}

			$insertAsistencia = $this->sql("insert into asistencia(fecha,year,hora,id_aprendiz) values('".$fecha."',".$yearl.",".$hora.",".$identificacion.")");
			$queryInsert = $this->conexion->query($insertAsistencia);

			if($queryInsert){
				$this->response["aviso"] = "Asistencia registrada correctamente";
				$this->response["validar"] = 1;
			}else{
				$this->response["aviso"] = "Ha ocurrido un error";
				$this->response["validar"] = 0;
			}
		}else{
			$this->response["aviso"] = $identificacion == "" ? "llene el campo" : "(solo numeros)";
			$this->response["validar"] = 0;
		}
		
		echo json_encode($this->response);
	}
	
	
	private function update(){
		
		$identificacion = $_POST["identificacion"];
		$identificacion_temp = $_POST["identificacion-temp"];

		$nombre = $_POST["nombre"];
		$nombre = strtolower($nombre);
		$apellido = $_POST["apellido"];
		$apellido = strtolower($apellido);
		
		$natalicio0 = $_POST["natalicio0"];
		$natalicio1 = $_POST["natalicio1"];
		$natalicio2 = $_POST["natalicio2"];
		
		$natalicio = $this->configDate($natalicio2,$natalicio1,$natalicio0);
		
		$genero = $_POST["genero"];
		$correo = $_POST["correo"];
		$correo = strtolower($correo);
		$ficha = $_POST["ficha"];
		$centro = $_POST["centro"];
		
		if($centro == 1){
			
			$centro = "ceai";
		}else if($centro == 2){
			
			$centro = "cgts";
			
		}else if($centro == 3){
			
			$centro = "astin";
		}
		
		$fecha_ven_carnet0 =  $_POST["fecha_ven_carnet0"];
		$fecha_ven_carnet1 =  $_POST["fecha_ven_carnet1"];
		$fecha_ven_carnet2 =  $_POST["fecha_ven_carnet2"];
		
		$fecha_ven_carnet = $this->configDate($fecha_ven_carnet2,$fecha_ven_carnet1,$fecha_ven_carnet0);
		
		
		
		
		$peso = $_POST["peso"];
		$estatura = $_POST["estatura"];
		$dia = $_POST["dia"];
		$hora = $_POST["hora"];
		
		
		if(!empty($nombre) and !empty($identificacion_temp) and !empty($identificacion) and !empty($apellido) and $natalicio0!=00 and  $natalicio1!=00 and $natalicio2!=0 and $fecha_ven_carnet0 !=00 and $fecha_ven_carnet1 != 00 and $fecha_ven_carnet2 !=0  and $genero!=0 and !empty($correo) and !empty($ficha) and !empty($centro) and !empty($fecha_ven_carnet) and $peso!=0 and $estatura!=0 and $dia!=0 and $hora!=0 and $genero!=0){
			
			if(is_numeric($identificacion) and is_numeric($peso) and is_numeric($estatura) and is_numeric($dia) and is_numeric($hora)and is_numeric($identificacion_temp) and is_numeric($ficha) and is_string($nombre) and is_string($apellido) and is_numeric($fecha_ven_carnet0) and is_numeric($fecha_ven_carnet1) and is_numeric($fecha_ven_carnet2) and is_numeric($natalicio0) and is_numeric($natalicio1) and is_numeric($natalicio2)){
				
			$select = $this->sql("select identificacion from usuarios where identificacion = ".$identificacion);
			
			$query = $this->conexion->query($select);
			
			$row = $query->num_rows;
			
			
			if($row == 0){
				
				$this->response["aviso"] = "Este usuario no existe";
				$this->response["validar"] = 0;
			}else{
				
				$fecha = $this->fecha($fecha_ven_carnet);

				if($fecha == true){
					
	
				
					$update = $this->sql("update usuarios set nombre="."'".$nombre."',apellido='".$apellido."',genero='".$genero."',correo='".$correo."',natalicio='".$natalicio."',peso=".$peso.",estatura=".$estatura.",identificacion =".$identificacion." where identificacion = ".$identificacion_temp);
					
					$query = $this->conexion->query($update);
				
					$update2 = $this->sql("update carnet set ficha=".$ficha.",centro='".$centro."',fecha_vencimiento='".$fecha_ven_carnet."',id_aprendiz=".$identificacion." where id_aprendiz =".$identificacion_temp);
				
					$query2 = $this->conexion->query($update2);
				
				
					$update3 = $this->sql("update horario set schedule_time_id=".$hora." where id_aprendiz =".$identificacion_temp);
				
					$query3 = $this->conexion->query($update3);
					
					
					if($query and $query2 and $query3){

						
						$this->response["aviso"] = "Registro Actualizado";
						$this->response["validar"] = 1;
					}else{
						$this->response["aviso"] =  "Ha ocurrido un error en la actualizacion";
						$this->response["validar"] = 0;
					}
				
				}else{
					
					$this->response["aviso"] =  "fecha de vencimiento no valida";
					$this->response["validar"] = 0;
				}
				
			}
			

		}else{
			
			$this->response["aviso"] = "Ha ocurrido un error";
			$this->response["validar"] = 0;
		}	
			
		}else{
			
			$this->response["aviso"] = "rellene todos los campos";
			$this->response["validar"] = 0;
		}
		
		
		
		echo json_encode($this->response);
	}
	
	
	
	private function search(){
		
		$identificacion = $_POST["identificacion2"];
		if($identificacion!=""){
			
		if(is_numeric($identificacion)){
			
			$select = $this->sql("select * from usuarios where identificacion = ".$identificacion);
			
			$query = $this->conexion->query($select);
			
			$row = $query->num_rows;
			
			if(!$query){
				$this->response["aviso"] = "error";
				$this->response["validar"] = 0;
			}
			if($row >0){
				
				$assoc = $query->fetch_assoc();
				$select2 = $this->sql("select * from carnet where id_aprendiz = ".$identificacion);
				$query2 = $this->conexion->query($select2);
				$assoc1 = $query2->fetch_assoc();
				
				$select3 = $this->sql("select * from horario where id_aprendiz =".$identificacion);
				$query3 = $this->conexion->query($select3);
				$assoc2 = $query3->fetch_assoc();
				
				$this->response["aviso"] =  array("nombre"=>$assoc["nombre"],"apellido"=>$assoc["apellido"],"identificacion"=>$assoc["identificacion"],"genero"=>$assoc["genero"],"peso"=>$assoc["peso"],"estatura"=>$assoc["estatura"],"natalicio"=>$assoc["natalicio"],"rol"=>$assoc["rol"],"centro"=>$assoc1["centro"],"ficha"=>$assoc1["ficha"],"correo"=>$assoc["correo"],"vencimiento"=>$assoc1["fecha_vencimiento"],"hora"=>"","dia"=>"","schedule_time_id"=>$assoc2["schedule_time_id"]);
				$this->response["validar"] = 1;
			}else{
				
				$this->response["aviso"] = "Este usuario no existe";
				$this->response["validar"] = 0;
				
			}
		}else{
			
			
				$this->response["aviso"] = "(solo numeros)";
				$this->response["validar"] =  0;
		}
		}else{
				
				$this->response["aviso"] = "llene el campo";
				$this->response["validar"] = 0;
				
		}
		
		echo json_encode($this->response);
	}
	
	
	public function ListarYear(){
		
		
		$select = $this->sql("SELECT DISTINCT (year)from asistencia");
		$query = $this->conexion->query($select);

		$lista = array();
		
		
		while($elementos = $query->fetch_assoc()){
			
			array_push($lista,$elementos)["year"];
			
		}
		
		$this->response["aviso"] = $lista;
		$this->response["validar"] = 1; 
		
		
		echo json_encode($this->response);
	}
	
	private function statistics(){
		
		$stati = $_POST["statistics"];
		$mes = $_POST["mes"];	
		$year = $_POST["year-sta"];
	

		if($stati == 1 || $stati == 2  and $mes !=0 and $year != 0){
		
		
			if($stati == 1){
				
			$val = $year."-".$mes;
	
			$select1 = $this->sql("select * from asistencia,usuarios,carnet  where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha like '".$val."%'");
				
			$query1 = $this->conexion->query($select1);
				
				
				if($query1){
					
					$row = $query1->num_rows;
					
					
					if($row == 0){
						
						$this->response["aviso"] = "No existen registros de asistencia";
						$this->response["validar"] = 0;
						
					
						
					}else{
						
						$all = array();
						
						while($assoc = $query1->fetch_assoc()){
							
							array_push($all,$assoc);
							
						}
												
						$person = $this->sql("select DISTINCT (asistencia.id_aprendiz),usuarios.rol,carnet.centro from asistencia,carnet,usuarios where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and year like '".$year."%' and fecha like '".$val."%'");
						$queryperson = $this->conexion->query($person);
						
						
						if($queryperson){
							
						$count = array($queryperson->num_rows);
						
						while($s = $queryperson->fetch_assoc()){
							
							array_push($count,$s);
							
						}
						
						array_push($all,$count);
						
						}
						
	
						
						$this->response["aviso"] = $all;
						$this->response["validar"] = 1;
						
					}

				
				}
				
			}else if($stati == 2){
				
				
				if($mes == 1){
					
					$select1 = $this->sql("select * from asistencia,usuarios,carnet  where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha between '$year-01-01' and '$year-03-31'");
				
					$person = $this->sql("select DISTINCT (asistencia.id_aprendiz),usuarios.rol,carnet.centro from asistencia,carnet,usuarios where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha between '$year-01-01' and '$year-03-31'");

				}else if($mes == 2){
					
					$select1 = $this->sql("select * from asistencia,usuarios,carnet  where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha between '$year-04-01' and '$year-06-31'");
					
					$person = $this->sql("select DISTINCT (asistencia.id_aprendiz),usuarios.rol,carnet.centro from asistencia,carnet,usuarios where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha between '$year-04-01' and '$year-06-31'");

					
				}else if($mes == 3){
					
					$select1 = $this->sql("select * from asistencia,usuarios,carnet  where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha between '$year-07-01' and '$year-09-31'");

					$person = $this->sql("select DISTINCT (asistencia.id_aprendiz),usuarios.rol,carnet.centro from asistencia,carnet,usuarios where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha between '$year-07-01' and '$year-09-31'");

					
				}else if($mes == 4){
					
					$select1 = $this->sql("select * from asistencia,usuarios,carnet  where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and  year like '".$year."%' and fecha between '$year-10-01' and '$year-12-31'");

					$person = $this->sql("select DISTINCT (asistencia.id_aprendiz),usuarios.rol,carnet.centro from asistencia,carnet,usuarios where usuarios.identificacion = asistencia.id_aprendiz and usuarios.identificacion = carnet.id_aprendiz and   year like '".$year."%' and fecha between '$year-10-01' and '$year-12-31'");

					
				}
				
				$query1 = $this->conexion->query($select1);
				
				$query1 = $this->conexion->query($select1);
				
				
				
				if($query1){
					
					$row = $query1->num_rows;
					
					
					if($row == 0){
						
						$this->response["aviso"] = "No existen registros de asistencia";
						$this->response["validar"] = 0;
						
					
						
					}else{
						
						$all = array();
						
						while($assoc = $query1->fetch_assoc()){
							
							
							array_push($all,$assoc);
							
						}
												
						$queryperson = $this->conexion->query($person);
						

						if($queryperson){
							
						$count = array($queryperson->num_rows);
						
						while($s = $queryperson->fetch_assoc()){
							
							array_push($count,$s);
							
						}
						
						array_push($all,$count);
						
						}
						
	
						
						$this->response["aviso"] = $all;
						$this->response["validar"] = 1;
						
					}

				
				}

					
				
				
				
				
			}
			
		
		}else{
			
			$this->response["aviso"] = "llene todos los campos";
			$this->response["validar"] = 0;
		}
		echo json_encode($this->response);

	}
	
	
	private function scheduleCreate(){
		$role = (int)$_POST["role"];
		$active = (isset($_POST["active"]) && $_POST["active"] === "1") ? 1 : 0;

		if($role == 0){
			$this->response["aviso"] = "Seleccione un rol";
			$this->response["validar"] = 0;
			echo json_encode($this->response);
			return;
		}

		$this->conexion->query("START TRANSACTION");

		$insert = $this->sql("INSERT INTO schedules (role, estado) VALUES ($role, $active)");
		$query = $this->conexion->query($insert);

		if(!$query){
			$this->conexion->query("ROLLBACK");
			$this->response["aviso"] = "Error al crear la plantilla";
			$this->response["validar"] = 0;
			echo json_encode($this->response);
			return;
		}

		$scheduleId = $this->conexion->insert_id;
		$days = $_POST["days"] ?? [];
		$timeStarts = $_POST["time_start"] ?? [];
		$timeEnds = $_POST["time_end"] ?? [];

		$scheduleDayIds = [];
		$ok = true;

		foreach($days as $day){
			$day = (int)$day;
			$insert = $this->sql("INSERT INTO schedule_days (schedule_id, day_of_week) VALUES ($scheduleId, $day)");
			$q = $this->conexion->query($insert);
			if(!$q){ $ok = false; break; }
			$scheduleDayIds[] = $this->conexion->insert_id;
		}

		if($ok){
			foreach($timeStarts as $i => $start){
				$end = $timeEnds[$i] ?? '';
				if(empty($start) || empty($end)) continue;
				foreach($scheduleDayIds as $sdId){
					$insert = $this->sql("INSERT INTO schedule_days_times (schedule_days_id, start_time, end_time) VALUES ($sdId, '$start', '$end')");
					$q = $this->conexion->query($insert);
					if(!$q){ $ok = false; break; }
				}
				if(!$ok) break;
			}
		}

		if($ok){
			$this->conexion->query("COMMIT");
			$this->response["aviso"] = "Plantilla de horario creada correctamente";
			$this->response["validar"] = 1;
		}else{
			$this->conexion->query("ROLLBACK");
			$this->response["aviso"] = "Error al guardar los días y horarios";
			$this->response["validar"] = 0;
		}

		echo json_encode($this->response);
	}

	private function scheduleUpdate(){
		$id = (int)($_POST["id"] ?? 0);
		if($id == 0){
			$this->response["aviso"] = "ID de plantilla inválido";
			$this->response["validar"] = 0;
			echo json_encode($this->response);
			return;
		}

		$role = (int)$_POST["role"];
		$active = (isset($_POST["active"]) && $_POST["active"] === "1") ? 1 : 0;

		$this->conexion->query("START TRANSACTION");

		$update = $this->sql("UPDATE schedules SET role=$role, estado=$active WHERE id=$id");
		$q = $this->conexion->query($update);

		if(!$q){
			$this->conexion->query("ROLLBACK");
			$this->response["aviso"] = "Error al actualizar la plantilla";
			$this->response["validar"] = 0;
			echo json_encode($this->response);
			return;
		}

		$days = $_POST["days"] ?? [];
		$timeStarts = $_POST["time_start"] ?? [];
		$timeEnds = $_POST["time_end"] ?? [];

		$timeRanges = [];
		foreach($timeStarts as $i => $start){
			$end = $timeEnds[$i] ?? '';
			if(!empty($start) && !empty($end)){
				$timeRanges[] = ["start" => $start, "end" => $end];
			}
		}

		$existingDays = [];
		$qDays = $this->conexion->query($this->sql("SELECT id, day_of_week FROM schedule_days WHERE schedule_id=$id"));
		while($row = $qDays->fetch_assoc()){
			$existingDays[(int)$row["day_of_week"]] = (int)$row["id"];
		}

		$daysToRemove = array_diff(array_keys($existingDays), $days);
		$daysToAdd = array_diff($days, array_keys($existingDays));
		$daysToKeep = array_intersect($days, array_keys($existingDays));

		$ok = true;

		foreach($daysToRemove as $day){
			$sdId = $existingDays[$day];
			$this->conexion->query($this->sql("DELETE FROM schedule_days_times WHERE schedule_days_id=$sdId"));
			$this->conexion->query($this->sql("DELETE FROM schedule_days WHERE id=$sdId"));
			if($this->conexion->error){ $ok = false; break; }
		}

		$newDayIds = [];
		if($ok){
			foreach($daysToAdd as $day){
				$day = (int)$day;
				$this->conexion->query($this->sql("INSERT INTO schedule_days (schedule_id, day_of_week) VALUES ($id, $day)"));
				if($this->conexion->error){ $ok = false; break; }
				$newDayIds[] = $this->conexion->insert_id;
			}
		}

		$allDayIds = [];
		if($ok){
			foreach($daysToKeep as $day){
				$allDayIds[] = $existingDays[$day];
			}
			$allDayIds = array_merge($allDayIds, $newDayIds);

			foreach($allDayIds as $sdId){
				$existingTimes = [];
				$qTimes = $this->conexion->query($this->sql("SELECT id, start_time, end_time FROM schedule_days_times WHERE schedule_days_id=$sdId ORDER BY start_time"));
				while($row = $qTimes->fetch_assoc()){
					$existingTimes[] = $row;
				}

				$numExisting = count($existingTimes);
				$numNew = count($timeRanges);

				for($i = 0; $i < min($numExisting, $numNew); $i++){
					$tid = $existingTimes[$i]["id"];
					$start = $timeRanges[$i]["start"];
					$end = $timeRanges[$i]["end"];
					$this->conexion->query($this->sql("UPDATE schedule_days_times SET start_time='$start', end_time='$end' WHERE id=$tid"));
					if($this->conexion->error){ $ok = false; break; }
				}
				if(!$ok) break;

				for($i = $numNew; $i < $numExisting; $i++){
					$tid = $existingTimes[$i]["id"];
					$this->conexion->query($this->sql("UPDATE horario SET schedule_time_id=NULL WHERE schedule_time_id=$tid"));
					$this->conexion->query($this->sql("DELETE FROM schedule_days_times WHERE id=$tid"));
					if($this->conexion->error){ $ok = false; break; }
				}
				if(!$ok) break;

				for($i = $numExisting; $i < $numNew; $i++){
					$start = $timeRanges[$i]["start"];
					$end = $timeRanges[$i]["end"];
					$this->conexion->query($this->sql("INSERT INTO schedule_days_times (schedule_days_id, start_time, end_time) VALUES ($sdId, '$start', '$end')"));
					if($this->conexion->error){ $ok = false; break; }
				}
				if(!$ok) break;
			}
		}

		if($ok){
			$this->conexion->query("COMMIT");
			$this->response["aviso"] = "Plantilla de horario actualizada correctamente";
			$this->response["validar"] = 1;
		}else{
			$this->conexion->query("ROLLBACK");
			$this->response["aviso"] = "Error al actualizar los días y horarios";
			$this->response["validar"] = 0;
		}

		echo json_encode($this->response);
	}

	private function scheduleDelete(){
		$id = (int)($_POST["id"] ?? 0);
		if($id == 0){
			$this->response["aviso"] = "ID de plantilla inválido";
			$this->response["validar"] = 0;
			echo json_encode($this->response);
			return;
		}

		$update = $this->sql("UPDATE schedules SET estado=0 WHERE id=$id");
		$q = $this->conexion->query($update);

		if($q){
			$this->response["aviso"] = "Plantilla de horario desactivada correctamente";
			$this->response["validar"] = 1;
		}else{
			$this->response["aviso"] = "Error al desactivar la plantilla";
			$this->response["validar"] = 0;
		}

		echo json_encode($this->response);
	}

	private function scheduleToggle(){
		$id = (int)($_POST["id"] ?? 0);
		if($id == 0){
			$this->response["aviso"] = "ID de plantilla inválido";
			$this->response["validar"] = 0;
			echo json_encode($this->response);
			return;
		}

		$select = $this->sql("SELECT estado FROM schedules WHERE id=$id");
		$query = $this->conexion->query($select);
		$row = $query->fetch_assoc();

		if(!$row){
			$this->response["aviso"] = "Plantilla no encontrada";
			$this->response["validar"] = 0;
			echo json_encode($this->response);
			return;
		}

		$nuevoEstado = $row["estado"] == 1 ? 0 : 1;
		$update = $this->sql("UPDATE schedules SET estado=$nuevoEstado WHERE id=$id");
		$q = $this->conexion->query($update);

		if($q){
			$mensaje = $nuevoEstado == 1 ? "Plantilla activada correctamente" : "Plantilla desactivada correctamente";
			$this->response["aviso"] = $mensaje;
			$this->response["validar"] = 1;
		}else{
			$this->response["aviso"] = "Error al cambiar el estado de la plantilla";
			$this->response["validar"] = 0;
		}

		echo json_encode($this->response);
	}

	private function scheduleGet(){
		$select = $this->sql("SELECT * FROM schedules ORDER BY estado DESC, id DESC");
		$query = $this->conexion->query($select);

		$schedules = array();

		while($row = $query->fetch_assoc()){
			$scheduleId = $row["id"];

			$selectDays = $this->sql("SELECT day_of_week FROM schedule_days WHERE schedule_id=$scheduleId ORDER BY day_of_week");
			$queryDays = $this->conexion->query($selectDays);

			$days = array();
			while($dayRow = $queryDays->fetch_assoc()){
				$days[] = (int)$dayRow["day_of_week"];
			}

			$selectTimes = $this->sql("SELECT DISTINCT start_time, end_time FROM schedule_days_times WHERE schedule_days_id IN (SELECT id FROM schedule_days WHERE schedule_id=$scheduleId) ORDER BY start_time");
			$queryTimes = $this->conexion->query($selectTimes);

			$times = array();
			while($timeRow = $queryTimes->fetch_assoc()){
				$times[] = array(
					"start_time" => $timeRow["start_time"],
					"end_time" => $timeRow["end_time"]
				);
			}

			$schedules[] = array(
				"id" => (int)$row["id"],
				"role" => (int)$row["role"],
				"estado" => (int)$row["estado"],
				"days" => $days,
				"times" => $times,
				"active" => (int)$row["estado"]
			);
		}

		$this->response["aviso"] = $schedules;
		$this->response["validar"] = 1;
		echo json_encode($this->response);
	}

	private function scheduleGetByRole(){
		$role = (int)($_POST["role"] ?? 0);
		if($role == 0){
			$this->response["aviso"] = array();
			$this->response["validar"] = 1;
			echo json_encode($this->response);
			return;
		}

		$select = $this->sql("SELECT * FROM schedules WHERE role=$role AND estado=1 ORDER BY id DESC");
		$query = $this->conexion->query($select);

		$schedules = array();

		while($row = $query->fetch_assoc()){
			$scheduleId = $row["id"];

			$selectDays = $this->sql("SELECT day_of_week FROM schedule_days WHERE schedule_id=$scheduleId ORDER BY day_of_week");
			$queryDays = $this->conexion->query($selectDays);

			$days = array();
			while($dayRow = $queryDays->fetch_assoc()){
				$days[] = (int)$dayRow["day_of_week"];
			}

			$selectTimes = $this->sql("SELECT MIN(id) as id, start_time, end_time FROM schedule_days_times WHERE schedule_days_id IN (SELECT id FROM schedule_days WHERE schedule_id=$scheduleId) GROUP BY start_time, end_time ORDER BY start_time");
			$queryTimes = $this->conexion->query($selectTimes);

			$times = array();
			while($timeRow = $queryTimes->fetch_assoc()){
				$times[] = array(
					"id" => (int)$timeRow["id"],
					"start_time" => $timeRow["start_time"],
					"end_time" => $timeRow["end_time"]
				);
			}

			$schedules[] = array(
				"id" => (int)$row["id"],
				"days" => $days,
				"times" => $times
			);
		}

		$this->response["aviso"] = $schedules;
		$this->response["validar"] = 1;
		echo json_encode($this->response);
	}

	private function conexion(){
		
		include("conexion.php");
		$this->conexion = new Conexion();
		
	}
	
	
}

$CRUD = new CrudSiaGym();

	
	
	
?>