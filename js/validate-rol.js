$(document).ready(function(){


fecha_date_now();

if(document.getElementById("rol")){
$("#rol").click(function(){
	
	var ficha = document.getElementById("ficha");
			$("#hora").html("<option value='0'>Seleccionar</option>");
	if($("#rol").val()==0){
		
		block = $("#input-block").html("<div class='right' id='block-hidden'></div>");
		
		if(!document.getElementById("ficha-hidden")){
		var form = document.getElementById("form-add");
		
		create = document.createElement("input");
		
		create.id = "ficha-hidden";
		
		create.name= "ficha";
		
		create.type = "hidden";
		
		form.appendChild(create);
		
		
		$("#dia").html("<option value='0'>Seleccionar</option>");		
		}
		
	}else if($("#rol").val()==1){
		
		block = $("#input-block").html("<input type='text' class='right' name='ficha'>");
		
		if(document.getElementById("ficha-hidden")){
			
			var form = document.getElementById("form-add");
			
			var hidden = document.getElementById("ficha-hidden");
			
			form.removeChild(hidden);
			

		}
		
		if(document.getElementById("dia")){
			
		$("#dia").html("<option value='0'>Seleccionar</option><option value='1'>Lunes,Miercoles,Viernes</option><option value='2'>Martes,Jueves.Sabado</option>");
		
		
		$("#dia").click(function(){
			
			if($("#dia").val()==1){
			$("#hora").html("<option value='0'>Seleccionar</option><option value='1'>7:00 Am a 1:20 Pm</option><option value='2'>2:00 Pm a 8:00 Pm</option>");
			}else if($("#dia").val()==2){
				
				
				$("#hora").html("<option value='0'>Seleccionar</option><option value='1'>7:00 Am a 1:20 Pm</option>");

			}
			
		});
		
		}
		
		
	}else if($("#rol").val()==2){
		
		

		block = $("#input-block").html("<div class='right' id='block-hidden'></div>");

		if(!document.getElementById("ficha-hidden")){
		var form = document.getElementById("form-add");
		
		create = document.createElement("input");
		
		create.id = "ficha-hidden";
		
		create.name= "ficha";
		
		setInterval(function(){
			
			create.value = "funcionario";
			
		},10);
		create.type="hidden";
		
		form.appendChild(create);
		

		}
		
		
		if(document.getElementById("dia")){
		
		$("#dia").html("<option value='0'>Seleccionar</option><option value='1'>Martes,Jueves</option>");
		
		$("#dia").click(function(){
			
			
			$("#hora").html("<option value='0'>Seleccionar</option><option value='1'>2:00 Pm a 8:00 Pm</option>");
			
			
		});
		
		}
	}
	
});
}

})