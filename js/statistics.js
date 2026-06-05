$(document).ready(function(){


 
$("#statistics").click(function(){
	
	if($("#statistics").val()==0){
		
		
		$("#mes").html("<option value='0'>Seleccionar</option>");		
		
	}else if($("#statistics").val()==1){
		
		
		options = "<option value='0'>Seleccionar</option>";
		options += "<option value='01'>Enero</option>";
		options += "<option value='02'>Febrero</option>";
		options += "<option value='03'>Marzo</option>";
		options += "<option value='04'>Abril</option>";
		options += "<option value='05'>Mayo</option>";
		options += "<option value='06'>Junio</option>";
		options += "<option value='07'>Julio</option>";
		options += "<option value='08'>Agosto</option>";
		options += "<option value='09'>Septiembre</option>";
		options += "<option value='10'>Octubre</option>";
		options += "<option value='11'>Noviembre</option>";
		options += "<option value='12'>Diciembre</option>";

	
	
		$("#mes").html(options);		

		
			

		
		}else if($("#statistics").val()==2){
		
			options = "<option value='0'>Seleccionar</option>";
			options += "<option value='1'>Enero,Febrero,Marzo</option>";
			options += "<option value='2'>Abril,Mayo,Junio</option>";
			options += "<option value='3'>Julio,Agosto,Septiembre</option>";
			options += "<option value='3'>Octubre,Noviembre,Diciembre</option>";

			$("#mes").html(options);		

		

		}
		
	
});




})