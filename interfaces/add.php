<script src="js/validate-rol.js"></script>
<script src="js/functions-actions-petition.js"></script>
<div id="form-action">
<div id="cont-title">
<h1>Registro de Usuario</h1>
</div>
<form action="asset/sendCrud.php" class="forms" method="post" id="form-add">
<div class="block-from">
<label id="nombre"class="">Nombre</label>
<input type="text" name="nombre" id="nombre" class="right"/>
</div>

<div class="block-from">
<label id="apellido"class="">Apellidos</label>
<input type="text" name="apellido" id="" class="right"/>
</div>

<div class="block-from">
<label class="identificacion">identificacion</label>
<input type="number" name="identificacion" id="identificacion" class="right"/>
</div>

<div class="block-from">
<label>Fecha de nacimiento</label>
<div class="select-date-float">
<select name="natalicio0" id="natalicio0" class="width-date">
</select>


<select name="natalicio1" id="natalicio1" class="width-date">
</select>




<select name="natalicio2" id="natalicio2" class="width-date">
</select>








</div>
</div>

<div class="block-from">
<label class="">Genero</label>
<select name="genero" id="genero" class="right">
<option value="0">seleccionar</option>
<option value="1">Femenino</option>
<option value="2">Masculino</option>

</select>
</div>


<div class="block-from">
<label for="rol"class="">Rol</label>
<select name="rol" id="rol" class="right">
<option value="0">seleccionar</option>
<option value="1">Aprendiz</option>
<option value="2">Funcionario</option>

</select>
</div>

<div class="block-from">
<label for="correo"class="">Correo electronico</label>
<input type="email" name="correo" id="correo" class="right"/>
</div>

<div class="block-from">
<label for="ficha"class="">ficha</label>
<div id="input-block" class='right'>

<div  id='block-hidden'></div>

</div>
</div>

<div class="block-from">
<label for="centro" class="">Centro</label>
<select id="centro" name="centro" class="right">

<option value='0'>Seleccionar</option>
<option value='1'>CEAI</option>
<option value='2'>CGTS</option>
<option value='3'>ASTIN</option>
</select>
</div>

<div class="block-from">
<label for="fecha_ven_carnet"class="">fecha de vencimiento de carnet</label>
<div class="select-date-float">
<select name="fecha_ven_carnet0" id="fecha_ven_carnet0" class="width-date">
</select>


<select name="fecha_ven_carnet1" id="fecha_ven_carnet1" class="width-date">
</select>




<select name="fecha_ven_carnet2" id="fecha_ven_carnet2" class="width-date">
</select>








</div>

</div>



<div class="block-from">
<label for="peso"class="">Peso</label>
<select  name="peso" id="peso" class="right">

</select>

</div>

<div class="block-from">
<label for="estatura"class="">Estatura</label>
<select name="estatura" id="estatura" class="right"/>

</select>
</div>

<div class="block-from">
<label class="" for="dia">Dias</label>
<select name="dia" id="dia" class="right">

<option value="0">seleccionar</option>

</select>
</div>

<div class="block-from">
<label class="" for="hora">Horas</label>
<select name="hora" id="hora" class="right">

<option value="0">seleccionar</option>
</select>
</div>


<div class="block-from">
<input type="hidden" name="send-add" value="this"/>
<input type="submit" id="send-add" value="Registrar">
</div>
<input type="hidden" name="ficha" id="ficha-hidden" class="right"/>
</form>
<div id="response"></div>
</div>

<script>

PesoAndEstatura();
</script>