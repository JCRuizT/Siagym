
$(document).ready(function(){
	
listar()
	
	
setInterval(function(){
$("#delete-now").load("asset/Delete.php");
},3000);
	


$("#form-assistance").submit(function(e){
	
	e.preventDefault();
	assistance();
	
	
});



$("#form-add").submit(function(e){
	
	e.preventDefault();
	add();
	
});


$("#form-search").submit(function(e){
	
	e.preventDefault();
	search();
	
});
	
	
$("#form-statistics").submit(function(e){

	e.preventDefault();
	statistics();

	
});


$("#form-update").submit(function(e){
	
	e.preventDefault();
	updates();

	
});
	
	
	
	
});


function listar(){
	
	
	var all = $("#form-ListarYear").serialize();
	$.ajax({
                data:  all,
				async:true, 
                url:   $("#form-ListarYear").attr("action"),
                type:  'post',
				dataType: "json",
                beforeSend: function () {
					

                },
                success:  function (response) {

					if(response.validar == 1){
						
						
						fillSelectYear(response.aviso);
												
						
					}
                }
				
    });
	
}


function assistance(){
		
	var all = $("#form-assistance").serialize();
	$.ajax({
                data:  all,
				async:true, 
                url:   $("#form-assistance").attr("action"),
                type:  'post',
				dataType: "json",
                beforeSend: function () {
						$("#response").html("<div class='divContent center-horizontal-margin black'>"+"Procesando..."+"</div>");
                },
                success:  function (response) {
					if(response.validar == 1){
						
                        $("#response").html("<div class='divContent center-margin center-horizontal-margin success'>"+response.aviso+"</div>");
						
						
					}else{
						
						$("#response").html("<div class='divContent center-margin center-horizontal-margin error'>"+response.aviso+"</div>");

						
					}
                }
    });
	
	
	
}

function add(){
	
	
	var all = $("#form-add").serialize();
	$.ajax({
                data:  all,
				async:true, 
                url:   $("#form-add").attr("action"),
                type:  'post',
				dataType: "json",
                beforeSend: function () {
                        $("#response").html("<div class='divContent center-horizontal-margin black'>"+"Procesando..."+"</div>");
                },
                success:  function (response) {
					

					if(response.validar == 1){
						

						$("#form-add")[0].reset();
                        $("#response").html("<div class='divContent center-margin center-horizontal-margin success'>"+response.aviso+"</div>");

						setTimeout(function(){
						
					
							var resp = document.getElementById("response");
							var div = $(".divContent")[0];
							
							resp.removeChild(div);
							
							
						},2000);
						
						
						
						
					}else{
						

						$("#response").html("<div class='divContent center-margin center-horizontal-margin error'>"+response.aviso+"</div>");
					}
						

                }
    });
	

}


function search(){
	
	var all = $("#form-search").serialize();
	$.ajax({
                data:  all,
				async:true, 
                url:   $("#form-search").attr("action"),
                type:  'post',
				dataType: "json",
                beforeSend: function () {
						$("#response").html("<div class='divContent center-horizontal-margin black'>"+"Procesando..."+"</div>");
               
			   },
                success:  function (response) {
					
					
					
					if(response.validar == 1){
					
						
					$("#response").html("<div id='table-content'><table><tr>"+"<th>Nombre</th>"+"<th>Apellido</th>"+"<th>Identificacion</th>"+"</tr>"+"<td id='nom'>"+response.aviso.nombre+"</td>"+"<td id='ape'>"+response.aviso.apellido+"</td>"+"<td id='id'>"+response.aviso.identificacion+"</td>"+"</tr>"+"<tr>"+"<td colspan='2'>"+"<div id='btn-see'></div>"+"</td>"+"<td colspan='2'>"+"<div id='btn-update'></div>"+"</td>"+"<tr>"+"</table></div>");
					$("#btn-see").html("<span class='btn' id='see' data-active='true'>Ver</span>");
					$("#btn-update").html("<span class='btn' id='update' data-active='true'>Editar</span>");
					
					
					document.getElementById("see").addEventListener("click",function(){
						
						see(this,response.aviso.nombre,response.aviso.apellido,response.aviso.genero,response.aviso.identificacion,response.aviso.peso,response.aviso.estatura,response.aviso.natalicio,response.aviso.rol,response.aviso.centro,response.aviso.ficha,response.aviso.correo,response.aviso.vencimiento,response.aviso.dia,response.aviso.hora);
						
					},false);
	

					document.getElementById("update").addEventListener("click",function(){
						
						update(this,response.aviso.nombre,response.aviso.apellido,response.aviso.genero,response.aviso.identificacion,response.aviso.peso,response.aviso.estatura,response.aviso.natalicio,response.aviso.rol,response.aviso.centro,response.aviso.ficha,response.aviso.correo,response.aviso.vencimiento,response.aviso.dia,response.aviso.hora,response.aviso.schedule_time_id);
					
					},false);
					
	
					}else{
						
						$("#response").html("<div class='divContent center-margin center-horizontal-margin error'>"+response.aviso+"</div>");
					}
                }
    });
}


function updates(){
	
	var all = $("#form-update").serialize();
	$.ajax({
                data:  all,
				async:true, 
                url:   $("#form-update").attr("action"),
                type:  'post',
				dataType: "json",
                beforeSend: function () {
						$("#response-two").html("<div class='divContent center-horizontal-margin black'>"+"Procesando..."+"</div>");
                },
                success:  function (response) {
	
					if(response.validar == 1){
					
                      $("#response-two").html("<div class='divContent center-margin center-horizontal-margin success'>"+response.aviso+"</div>");
					
					
					setTimeout(function(){
						if(document.getElementById("response-two")){
							var resp = document.getElementById("response-two");
							var div = $(".divContent")[0];
							
							resp.removeChild(div);
							
						}
					},2000);
					
					setTimeout(function(){
							
							document.getElementById("update").dataset.active = "false";
	
							document.getElementById("update").classList += " disabled";
							
					},100);
					
					search();
					
					}else{
						
						
						$("#response-two").html("<div class='divContent center-margin center-horizontal-margin error'>"+response.aviso+"</div>");

					}
					
				}
					
	});
					
				
	
}


function statistics(){
	
	var all = $("#form-statistics").serialize();
	$.ajax({
                data:  all,
				async:true, 
                url:   $("#form-statistics").attr("action"),
                type:  'post',
				dataType: "json",
                beforeSend: function () {
						//$("#response").html("<div class='divContent center-horizontal-margin black'><span>"+"Procesando..."+"</span></div>");
                },
                success:  function (response) {
				
					if(response.validar == 1){
					
					
						if(document.querySelector(".error")){
							
							var parent = document.getElementById("response");
							var children = document.querySelector(".error");
							
							parent.removeChild(children);
							
						}
						fillViewListar(response.aviso,$("#statistics").val());
					  
					}else{
						
						if(document.getElementById("vista")){
							
							var parent = document.getElementById("Listar");
							var children = document.getElementById("vista");
							var form = document.getElementById("form-action");
							
							parent.removeChild(children);
							form.classList = "";
							
							
						}
						$("#response").html("<div class='divContent center-margin center-horizontal-margin error' >"+response.aviso+"</div>");

					}
					
				}
					
	});
	
}


