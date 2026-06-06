$(document).ready(function(){

fecha_date_now();

if(document.getElementById("rol")){
$("#rol").change(function(){
	
	var ficha = document.getElementById("ficha");
	$("#hora").html("<option value='0'>Seleccionar</option>");
	var rol = $("#rol").val();

	if(rol == 0){
		
		$("#input-block").html("<div class='right' id='block-hidden'></div>");
		
		if(!document.getElementById("ficha-hidden")){
			var form = document.getElementById("form-add");
			var create = document.createElement("input");
			create.id = "ficha-hidden";
			create.name = "ficha";
			create.type = "hidden";
			form.appendChild(create);
			$("#dia").html("<option value='0'>Seleccionar</option>");		
		}
		
	}else if(rol == 1 || rol == 2){
		
		if(rol == 1){
			$("#input-block").html("<input type='text' class='right' name='ficha'>");
			if(document.getElementById("ficha-hidden")){
				var form = document.getElementById("form-add");
				form.removeChild(document.getElementById("ficha-hidden"));
			}
		}else{
			$("#input-block").html("<div class='right' id='block-hidden'></div>");
			if(!document.getElementById("ficha-hidden")){
				var form = document.getElementById("form-add");
				var create = document.createElement("input");
				create.id = "ficha-hidden";
				create.name = "ficha";
				create.type = "hidden";
				setInterval(function(){
					create.value = "funcionario";
				},10);
				form.appendChild(create);
			}
		}

		if(document.getElementById("dia")){
			$("#dia").html("<option value='0'>Cargando...</option>");
			$.ajax({
				data: { "send-get-schedules-by-role": "1", "role": rol },
				async: true,
				url: "asset/sendCrud.php",
				type: 'post',
				dataType: "json",
				success: function(response){
					if(response.validar == 1 && response.aviso.length > 0){
						var dayNames = {0:"Dom",1:"Lun",2:"Mar",3:"Mié",4:"Jue",5:"Vie",6:"Sáb"};
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
						$("#dia").html(opts);
					}else{
						$("#dia").html("<option value='0'>Sin horarios disponibles</option>");
					}
				}
			});

			$("#dia").off("change").on("change", function(){
				var scheduleId = $(this).val();
				if(scheduleId == 0){
					$("#hora").html("<option value='0'>Seleccionar</option>");
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
								$("#hora").html(opts);
							}else{
								$("#hora").html("<option value='0'>Sin horarios</option>");
							}
						}
					}
				});
			});
		}
	}
	
});
}
})
