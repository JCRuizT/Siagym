function fecha_date_now(){


var html = "";
for(var i=0;i<=31;i++){
	
		if(i<10){
			
			html += '<option value=0'+i+'>';


		}else{
			
			html += '<option value='+i+'>';

		}
		
		if(i == 0){
			
			html += 'Dia';
			


		}else{
			
			if(i<10){
				
				html += '0'+i;
				
			}else{
				
				html += i;

			}
		}
		
		
		html += '</option>';
	
}

$("#natalicio0").html(html);
$("#fecha_ven_carnet0").html(html);

	
	
html1 = "";
var m = new Array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	
	for(var i=0;i<m.length;i++){
		
		if(i<10){
			
			html1 += '<option value=0'+i+'>';

		}else{
			
			html1 += '<option value='+i+'>';

		}
		
		if(i==0){
			
			html1 += 'Mes';


		}else{
			
			html1 += m[i];

		}
		
		html1 += '</option>';

		
	}
	

$("#natalicio1").html(html1);
$("#fecha_ven_carnet1").html(html1);



html2 = "";

	var fecha = new Date();
	var year = fecha.getFullYear();
	
	for(var i= year; i>1899; i--){
		
		
		if(i==year){
			
			html2 += "<option value='0'>";

		}else{
			
			html2 += "<option value="+(i+1)+">";

		}
		
		if(i==year){
			
			html2 += "Año";


		}else{
			
			html2 += i+1;

		}
		

		html2 += '</option>';
	}
		
		
	html3 = "";
	for(var i= year; i<2050; i++){
		
		
		if(i==year){
			
			html3 += "<option value='0'>";

		}else{
			
			html3 += "<option value="+(i-1)+">";

		}
		
		if(i==year){
			
			html3 += "Año";


		}else{
			
			html3 += i-1;

		}
		
		html3 += '</option>';


		
	}

$("#natalicio2").html(html2);
$("#fecha_ven_carnet2").html(html3);




}