function PesoAndEstatura(){
	
html = "";
for(var i = 0; i<=200; i++){
	
	if(i==0){
		
		html += "<option value='"+0+"'>"+"seleccionar"+"</option>";
	}else{
		
		
		if(i<=50){
			
			if(i % 2 == 0){
				
				html += "<option value='"+(i)+"'>"+(i+" Kg")+"</option>";	

			}

			
		}else{
			
			html += "<option value='"+(i)+"'>"+(i+" Kg")+"</option>";	

		}
				
		

	}
		
	
}
$("#peso").html(html);
html = "";

for(var i = 0 ; i<= 250; i++){
	
	if(i==0){
		
		html += "<option value='"+0+"'>"+"seleccionar"+"</option>";
	}else{
	
		if(i<100){
			
			if(i % 2 == 0){
			
				
				//html += "<option value='"+(i)+"'>"+(i+" cm")+"</option>";
			
			}
			
		}else if(i>= 100){
			
			
			integer = i.toString()[0];
			firstNumber = i.toString()[1];
			secondNumber = i.toString()[2];
			
			
			if(firstNumber == 0){
				
				decimal = integer+"."+""+firstNumber+secondNumber;
				

			}else{
				
				decimal = integer+"."+firstNumber+""+secondNumber;
								

			}

			

			decimalIntern = Math.floor(decimal*100);

				

			html += "<option value='"+(decimalIntern)+"'>"+(decimal+" m")+"</option>";
	
		}
	
}

}

$("#estatura").html(html);
	
}

function fillSelectYear(year){
	
	html = '';
	for(i = 0; i<year.length; i++){
		
		html += "<option>"+year[i]["year"]+"</option>";
		
		
	}
	
	
	$("#ListarYear").html("<option value='0'>Seleccionar</option>"+html);
	

	$("#ListarYear").change(function(){
		
		
		var val = $("#ListarYear").val();
		$("#year-sta").val(val);
		
	});
	
	
	
	
}

function fillViewListar(response,tipo){
	

	var mes = new Array("","enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre")

	$("#form-action").addClass("left margin");
					  
	$("#Listar").html("<div id='vista' class='unique-listar'></div>");
	
	
	html = "";
	html += '<h2 id="subtitle">Gestionador de Reportes</h2>';
	
	var rt;
	
	if($("#mes").val() < 10){
		
		rt = mes[$("#mes").val()[1]]
		
	}else{
		
		rt = mes[$("#mes").val()];

		
	}
	
	
	if(tipo == 1){
		
		html += "<h3 style='margin-top: 30px; text-align:center; text-transform: capitalize;'>Mes: "+rt+" del año "+$("#ListarYear").val()+"</h3>";
		
	}else{
		
		var meses;
		
		if(document.getElementById("mes").value == 1){
			
			meses = mes[1]+", "+mes[2]+", "+mes[3];
			
		}else if(document.getElementById("mes").value == 2){
			
			meses = mes[4]+", "+mes[5]+", "+mes[6];
	
			
		}else if(document.getElementById("mes").value == 3){
			
			meses = mes[7]+", "+mes[8]+", "+mes[9];	
			
		}else if(document.getElementById("mes").value == 4){
			
			meses = mes[10]+", "+mes[11]+", "+mes[12]

		}
		
		
		html += "<h3 style='margin-top: 30px; text-align:center; text-transform: capitalize;'>Meses: "+meses+" del año "+$("#ListarYear").val()+"</h3>";

		
	}
	
	
	//centros
	ceai = 0;
	astin = 0;
	cgts = 0;
	
	//rols
	aprendiz = 0;
	funcionario = 0;
	
	var le = response[response.length-1].length;
	
	lae = le;
	
	for(var i = 1; i<lae; i++){
		
		if(response[response.length-1][i]["centro"] == "ceai"){
			
			ceai ++;
			
		}else if(response[response.length-1][i]["centro"] == "astin"){
			
			astin++;
			
		}else if(response[response.length-1][i]["centro"] == "cgts"){
			
			cgts++;
		}
		
		
		if(response[response.length-1][i]["rol"] == 1){
			
			aprendiz ++;
			
		}else if(response[response.length-1][i]["rol"] == 2){
			
			funcionario++;
			
		}
		
	}
	


	
	html += "<table id='report-table'>";
	
	html += "<tr><th>Numero de veces que ingresaron</th><th>Numero de personas que Ingresaron </th><th>A</th><th>F</th><th>N. CEAI</th><th>N. ASTIN</th><th>N. CGTS</th></tr>";
	
	
	html += "<tr><td>"+(response.length-1)+"</td><td>"+response[response.length-1][0]+"</td><td>"+aprendiz+"</td><td>"+funcionario+"</td><td>"+ceai+"</td><td>"+astin+"</td><td>"+cgts+"</td></tr>";

	html += "</table>";
	//html += "<div>ingresaron: "+(response.length-1)+" veces en el mes de "+rt+" del "+$("#ListarYear").val()+"</div>";
	

	//html += "Ingresaron "+response[response.length-1] +" personas";
	

	


	$("#vista").html(html);
	


	
}

function btnCommon(event){
	
	

	$("#form-action").addClass("left margin");
	
	
	if(!document.getElementById("vista")){
	var parent = document.getElementById("container-siagym");
	var vista = document.createElement("div");
	vista.id="vista";
	parent.appendChild(vista);

	}
	
	$("#identificacion").attr("readonly","readonly");
	$("#change").html("<div id='btn-delete'>x</div>");

	if(document.getElementById("btn-delete")){
	
	$("#btn-delete").click(function(){
		
		$("#change").html('<input type="submit" id="send-search" name="send-search">');
		$("#identificacion").val("");
		document.getElementById("identificacion").removeAttribute("readonly");

	});
	
	
	
	}
	
	
}
function see(element,nombre,apellido,genero,identificacion,peso,estatura,natalicio,rol,centro,ficha,correo,dia,hora){
	
	btnCommon();
	
	
	if(element.dataset.active == "true"){
		
	u = document.getElementById("update");
	
	element.dataset.active = "false";
	u.dataset.active = "true";
	
	$("#see").addClass("disabled");		
	$("#update").removeClass("disabled");

	
	edad = yearOld(natalicio);
	
	if(genero == 1){
		
		genero = "Femenino";
	}else{
		
		genero = 'Masculino';
	}

	estatura = estatura/100;

	var html = null;
	
	html = "<h2 id='subtitle'>Visualizador de datos</h2>";
	
	html +="<div id='cmps'>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Nombre:</strong>";
	
	html+= "<span>"+nombre+"</span>"
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Apellido:</strong>";
	
	html+= "<span>"+apellido+"</span>"
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Identificacion:</strong>";
	
	html+= "<span>"+identificacion+"</span>"
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Edad:</strong>";
	
	html+= "<span>"+edad+"</span>"
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Genero:</strong>";
	
	html+= "<span>"+genero+"</span>"
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Estatura:</strong>";
	
	html+= "<span>"+estatura+" m</span>"
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Peso:</strong>";
	
	html+= "<span>"+peso+"</span>"
	
	html+="</div>";
	
	
	
	
	imc = (peso /(estatura*estatura)).toFixed(2);
	
	if(imc < 18.5){
		
		estado = "Por debajo de peso";
		
	}else if(imc >=18.5 && imc <= 24.9){
		
		
		estado = "Saludable";
	}else if(imc >= 25.0 && imc < 29.9){
		
		estado = "Con sobrepeso";
		
	}else if(imc >= 30 && imc < 39.9){
		
		estado = "Obeso";
		
	}else if(imc > 40){
		
		estado = "Obesidad Extrema";
	}
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>IMC:</strong>";
	
	html+= "<span>"+imc+"</span>"
	
	html+="</div>";
	
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Resultado IMC: </strong>";
	
	html+= "<span>"+estado+"</span>"
	
	html+="</div>";
	
	
	
	
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Rol:</strong>";
	
	if(rol == 1){
		
		html+= "<span>Aprendiz</span>";
	
	}else if(rol == 2){

		html+= "<span>Funcionario</span>";	
		
	}
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Ficha:</strong>";
	
	html+= "<span>"+ficha+"</span>"
	
	html+="</div>";
	
	
	html +="<div class='block-from ads'>";
	
	html += "<strong>Centro:</strong>";
	
	html+= "<span>"+centro+"</span>"
	
	html+="</div>";
	
	
	html +="</div>";
	
	$("#vista").html(html);
	
	}
}
function update(element,nombre,apellido,genero,identificacion,peso,estatura,natalicio,rol,centro,ficha,correo,fecha_vencimiento,dia,hora,schedule_time_id){
	
	btnCommon();
	
	
	
	if(centro == "ceai"){
		
		centro = 1;
		
	}else if(centro == "cgts"){
		
		centro = 2;
	}else if(centro == "astin"){
		
		centro = 3;
	}
	
	s = document.getElementById("see");
	
	if(element.dataset.active == "true"){
		
	element.dataset.active = "false";
	s.dataset.active = "true";
	
	
	$("#update").addClass("disabled");
	$("#see").removeClass("disabled");
	
	
	

	natalicio = separate(natalicio);
	vencimiento = separate(fecha_vencimiento);

	
	html = null;
	
	
	html = "<div id='update-include'></div>";	
	
	$("#vista").html(html);
	
	
	html = "<h2 id='subtitle'>Actualizador de datos</h2>";
	html += '<form action="asset/sendCrud.php" class="forms" method="post" id="form-update">'
	html += '<div class="block-from">'
	html += '<label class="">Nombre</label>'
	html += '<input type="text" name="nombre" id="nombre" class="right"/>'
	html += '</div>'

	html += '<div class="block-from">'
	html += '<label class="">Apellidos</label>'
	html += '<input type="text" name="apellido" id="apellido" class="right"/>'
	html += '</div>'

	html += '<div class="block-from">'
	html += '<input type="hidden" name="identificacion-temp" id="identificacion-temp" class="right"/>'
	html += '<input type="hidden" name="identificacion" id="identificacion1" class="right"/>'
	html += '</div>'

	html += '<div class="block-from">'
	html += '<label>Natalicio</label>'
	html += '<div class="select-date-float">'
	html += '<select name="natalicio0" id="natalicio0" class="width-date">'
	
	
	
	html += '</select>';

	
	html += '<select name="natalicio1" id="natalicio1" class="width-date">';
	
	
	var m = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
	
	
	
	
	html += '/<select>';
	
	
	
	html += '<select name="natalicio2" id="natalicio2" class="width-date">'
	
	
	
	
	
	html += '</select>';
	html += '</div></div>';
	
	
	
	
	html += '<div class="block-from">'
	html += '<label class="">Genero</label>'
	html += '<select name="genero" id="genero" class="right">'
	html += '<option value="0">seleccionar</option>'
	html += '<option value="1">Femenino</option>'
	html += '<option value="2">Masculino</option>'

	html += '</select>'
	html += '</div>'




	html += '<div class="block-from">'
	html += '<label for="correo"class="">Correo electronico</label>'
	html += '<input type="email" name="correo" id="correo" class="right"/>'
	html += '</div>'

	html += '<div class="block-from" id="ficha-content">'
	html += '</div>'
	
	html += '<div class="block-from">'
	html += '<label for="centro" class="">Centro</label>'
	html += '<select id="centro" name="centro" class="right">'
	
	
	html += '<option value="0">seleccionar</option>'
	html += '<option value="1">CEAI</option>'
	html += '<option value="2">CGTS</option>'
	html += '<option value="3">ASTIN</option>'


	html += '</select>'

	html += '</div>'

	html += '<div class="block-from">'
	html += '<label for="fecha_ven_carnet"class="">fecha de vencimiento de carnet</label>'
	html += '<div class="select-date-float">'
	html += '<select name="fecha_ven_carnet0"  id="fecha_ven_carnet0" class="width-date">'

	
	
	
	html += '</select>';
	
	html += '<select name="fecha_ven_carnet1" id="fecha_ven_carnet1" class="width-date">';
	

	html += '</select>';
	
	html += '<select name="fecha_ven_carnet2" id="fecha_ven_carnet2" class="width-date">';
	
	html += '</select>';
	html += '</div></div>';
	
	
	
	html += '<div class="block-from">'
	html += '<label for="peso"class="">Peso</label>'
	html += '<select id="peso" name="peso" class="right"/>'
	
	html += '</select>'
	html += '</div>'

	html += '<div class="block-from">'
	html += '<label for="estatura"class="">Estatura</label>'
	html += '<select name="estatura" id="estatura" class="right"/>'
	
	html += '</select>'
	html += '</div>'

	html += '<div class="block-from">'
	html += '<label class="" for="dia">Dias</label>'
	html += '<select name="dia" id="dia" class="right">'

	html += '<option value="0">seleccionar</option>'

	html += '</select>'
	html += '</div>'

	html += '<div class="block-from">'
	html += '<label class="" for="hora">Horas</label>'
	html += '<select name="hora" id="hora" class="right">'

	html += '<option value="0">seleccionar</option>'

	html += '</select>'
	html += '</div>'


	html += '<div class="block-from">'
	html += '<input type="hidden" name="send-update" value="this"/>'
	html += '<input type="submit" id="send-update" value="Actualizar">'
	html += '</div>'
	html += '</form>'
	html += '<div id="response-two"></div>'
	
	html += '<script src="js/functions-actions-petition.js"></script>'

	$("#update-include").html(html);
	
	
	fecha_date_now();
	PesoAndEstatura();


	if(rol == 1){
		$("#ficha-content").html('<label for="ficha"class="">ficha</label><input type="number" name="ficha" id="ficha" class="right"/>');
	}else if(rol == 2){
		$("#ficha-content").html('<input value="'+identificacion+'" type="hidden" name="ficha" id="ficha-hidden"/>');
	}

	if(document.getElementById("dia")){
		var dayNames = {0:"Dom",1:"Lun",2:"Mar",3:"Mié",4:"Jue",5:"Vie",6:"Sáb"};
		var $dia = $("#dia");
		var $hora = $("#hora");

		$dia.html("<option value='0'>Cargando...</option>");
		$.ajax({
			data: { "send-get-schedules-by-role": "1", "role": rol },
			async: true,
			url: "asset/sendCrud.php",
			type: 'post',
			dataType: "json",
			success: function(response){
				if(response.validar == 1 && response.aviso.length > 0){
					var opts = "<option value='0'>Seleccionar</option>";
					$.each(response.aviso, function(i, s){
						var daysStr = "";
						$.each(s.days, function(j, d){
							daysStr += dayNames[d] + " ";
						});
						var timesStr = "";
						$.each(s.times, function(j, t){
							if(j > 0) timesStr += ", ";
							timesStr += t.start_time.substring(0,5) + "-" + t.end_time.substring(0,5);
						});
						opts += "<option value='" + s.id + "'>#" + s.id + " " + daysStr + "- " + timesStr + "</option>";
					});
					$dia.html(opts);
				}else{
					$dia.html("<option value='0'>Sin horarios disponibles</option>");
				}

				if(schedule_time_id && schedule_time_id != ""){
					var foundSchedule = null;
					$.each(response.aviso, function(i, s){
						$.each(s.times, function(j, t){
							if(t.id == schedule_time_id){
								foundSchedule = s;
							}
						});
					});
					if(foundSchedule){
						$dia.val(foundSchedule.id).change();
					}
				}
			}
		});

		$dia.off("change").on("change", function(){
			var scheduleId = $(this).val();
			if(scheduleId == 0){
				$hora.html("<option value='0'>Seleccionar</option>");
				return;
			}
			$.ajax({
				data: { "send-get-schedules-by-role": "1", "role": rol },
				async: true,
				url: "asset/sendCrud.php",
				type: 'post',
				dataType: "json",
				success: function(response){
					if(response.validar == 1 && response.aviso.length > 0){
						var schedule = null;
						$.each(response.aviso, function(i, s){
							if(s.id == scheduleId) schedule = s;
						});
						if(schedule && schedule.times.length > 0){
							var opts = "<option value='0'>Seleccionar</option>";
							$.each(schedule.times, function(j, t){
								opts += "<option value='" + t.id + "'>#" + t.id + " " + t.start_time.substring(0,5) + "-" + t.end_time.substring(0,5) + "</option>";
							});
							$hora.html(opts);
						}else{
							$hora.html("<option value='0'>Sin horarios</option>");
						}
					}
					if(schedule_time_id && schedule_time_id != ""){
						$hora.val(schedule_time_id);
					}
				}
			});
		});
	}
	

	datosUptateInput("nombre",nombre);
	
	datosUptateSelect("natalicio0",natalicio[2]);
	
	datosUptateSelect("natalicio1",natalicio[1]);

	datosUptateSelect("natalicio2",natalicio[0]);

	datosUptateInput("apellido",apellido);

	datosUptateInput("identificacion-temp",identificacion)

	datosUptateInput("identificacion1",identificacion);

	datosUptateInput("genero",genero);

	datosUptateInput("correo",correo);

	datosUptateInput("ficha",ficha);
	
	datosUptateSelect("centro",centro);

	datosUptateSelect("fecha_ven_carnet0",vencimiento[2]);
	
	datosUptateSelect("fecha_ven_carnet1",vencimiento[1]);
	
	datosUptateSelect("fecha_ven_carnet2",vencimiento[0]);

	datosUptateSelect("peso",peso);

	datosUptateSelect("estatura",estatura);
	
	
	}
		
}

 function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0; i < vars.length; i++) {
            var pair = vars[i].split("="); 
            if (pair[0] == variable) {
                return pair[0] = variable ;
            }
        }
        return false;
    }


$(document).ready(function(){

fecha_date_now();

changeItem();


window.onpopstate = function(event) {
  
event.preventDefault();

	if(getQueryVariable("add") != false){
	
		$("#container-siagym").load("interfaces/add.php");
		
		fecha_date_now();
	
	}else if(getQueryVariable("assistance") != false){

		$("#container-siagym").load("interfaces/assistance.php");

	}else if(getQueryVariable("search") != false){
		
		$("#container-siagym").load("interfaces/search.php");

	}else if(getQueryVariable("statistics") != false){
		
		$("#container-siagym").load("interfaces/statistics.php");
		listar();

	}else if(getQueryVariable("schedules") != false){
		
		$("#container-siagym").load("interfaces/schedules.php");

	}
	
	changeItem();

}

setInterval(function(){
	
	
	
	
	if($("#identificacion").val()==""){
		if(document.getElementById("table-content")){
			document.getElementById("response").removeChild(document.getElementById("table-content"));
	}
		
		if(document.getElementById("vista")){
			
			var parent = document.getElementById("container-siagym");
			var vista = document.getElementById("vista");
			parent.removeChild(vista);
						
			
		}
			$("#form-action").removeClass("left margin");
			if(!document.getElementById("send-search")){
			$("#change").html('<input type="submit" id="send-search" name="send-search">');
			}

		
	}
		
	
	
	
},false);
	


var links = document.querySelectorAll(".link-menu");
var history = new Array();
for(var i=0; i<links.length; i++){
	
links[i].addEventListener("click",function(e) {
	
	
	e.preventDefault();
	history.push(this.getAttribute("data-link-vinculo"));

	if(this.getAttribute("data-link-vinculo") == history[history.length-2]){
		
		
	}else{
		
		
		$("#container-siagym").load(this.getAttribute("data-link-vinculo"), function(){
			if(getQueryVariable("statistics") != false){
				if(typeof listar === "function") listar();
			}
		});
		window.history.pushState(null, "", this.getAttribute("href"));
		changeItem();		
		
		
		
		
	}

	

},false);
}





});


function separate(fecha){
	
	
	year = fecha.substring(0,4);
	
	month = fecha.substring(5,7);
	
	day = fecha.substring(8,10);
	
	return new Array(year,month,day);
	
}

function datosUptateInput(selector,value){
	
	
	if(document.getElementById(selector)){
		
		setTimeout(function(){
			$("#"+selector).val(value);
		},10);
	}else{
		
		setTimeout(function(){
			$("#"+selector).val(value);
		},10);
		
	}
}

function datosUptateSelect(selector,value){
	
		if(document.getElementById(selector)){
		setTimeout(function(){
			
			$("#"+selector+'> option[value='+value+']').attr('selected', 'selected');
		},10);
		}else{
			
		setTimeout(function(){
			
			$("#"+selector+'> option[value='+value+']').attr('selected', 'selected');
		},10);
			
		}
	
}

function datosUptateFill(selector,value){
	
		if(document.getElementById(selector)){
		setTimeout(function(){
			
			$("#"+selector).html(value);
		},10);
		}else{

		setTimeout(function(){
			
			$("#"+selector).html(value);
		},10);
			
		}
	
}
function yearOld(fecha){
	
	date = separate(fecha);
	var dt = new Date();
	
	month = dt.getMonth()+1;
	day = dt.getDate();
	year = dt.getFullYear();
	
	
	yearTemp = 0;
	
	if(month > date[1]){
		
		
		yearTemp = year - date[0];
		
	}else if(month < date[1]){
		
		yearTemp = (year - date[0])-1;
		
	}else if(month == date[1]){
		
		
		
		if(day > date[2] || day == date[2]){
			
			yearTemp  = year - date[0];
			
		}else{
			
			yearTemp = (year - date[0])-1;
			
		}
		
	}
	
	return yearTemp;
	
	
}


function changeItem(){
	
	
	
	var fondo = "#8bc34a";
	var borde = "#8bc34a";
	var color = "#ffffff";
	
	if(getQueryVariable("add") != false){
	
	
	
	ResetItem("#link-assistance","#link-assistance > span","#ffffff","#000000");
	ResetItem("#link-search","#link-search > span","#ffffff","#000000");
	ResetItem("#link-statistics","#link-statistics > span","#ffffff","#000000");
	ResetItem("#link-schedules","#link-schedules > span","#ffffff","#000000");


		$("#link-add").css({
			
			background: fondo,
			borderTop: borde
		});
		
		$("#link-add > span").css({
			
			color: color
		});
	
	}else if(getQueryVariable("assistance") != false){
		
	ResetItem("#link-add","#link-add > span","#ffffff","#000000");
	ResetItem("#link-search","#link-search > span","#ffffff","#000000");
	ResetItem("#link-statistics","#link-statistics > span","#ffffff","#000000");
	ResetItem("#link-schedules","#link-schedules > span","#ffffff","#000000");
	
	
		$("#link-assistance").css({
			
			background: fondo,
			borderTop: borde
		});
		
		$("#link-assistance > span").css({
			
			color: color
		});
	

	}else if(getQueryVariable("search") != false){
		
	ResetItem("#link-assistance","#link-assistance > span","#ffffff","#000000");
	ResetItem("#link-add","#link-add > span","#ffffff","#000000");
	ResetItem("#link-statistics","#link-statistics > span","#ffffff","#000000");
	ResetItem("#link-schedules","#link-schedules > span","#ffffff","#000000");
		$("#link-search").css({
			
			background: fondo,
			borderTop: borde
		});
		
		$("#link-search > span").css({
			
			color: color
		});

	}else if(getQueryVariable("statistics") != false){
		
	ResetItem("#link-assistance","#link-assistance > span","#ffffff","#000000");
	ResetItem("#link-search","#link-search > span","#ffffff","#000000");
	ResetItem("#link-add","#link-add > span","#ffffff","#000000");
	ResetItem("#link-schedules","#link-schedules > span","#ffffff","#000000");
	
		$("#link-statistics").css({
			
			background: fondo,
			borderTop: borde
		});
		
		$("#link-statistics > span").css({
			
			color: color
		});
		
	}else if(getQueryVariable("schedules") != false){
		
	ResetItem("#link-assistance","#link-assistance > span","#ffffff","#000000");
	ResetItem("#link-search","#link-search > span","#ffffff","#000000");
	ResetItem("#link-statistics","#link-statistics > span","#ffffff","#000000");
	ResetItem("#link-add","#link-add > span","#ffffff","#000000");
	
		$("#link-schedules").css({
			
			background: fondo,
			borderTop: borde
		});
		
		$("#link-schedules > span").css({
			
			color: color
		});
		
	}
	
}

function ResetItem(selector1,selector2,fondo,color){
	
	borde = fondo
		$(selector1).css({
			
			background: fondo,
			borderTop: borde
		});
		
		$(selector2).css({
			
			color: color
		});
	
}

