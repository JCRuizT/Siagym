
<script src="js/functions-actions-petition.js"></script>
<script src="js/statistics.js"></script>
<div id="form-action">
<div id="cont-title">
<h1>Reportes de asistencia</h1>
</div>
<form action="asset/sendCrud.php"  class="forms"id="form-statistics" method="post">
<div class="block-from">
<label>Tipo</label>
<select id="statistics" name="statistics" class="right">
<option value="0">Seleccionar</option>
<option value="1">Mensual</option>
<option value="2">Trimestral</option>
</select>
</div>

<div class="block-from">
<label>Mes</label>
<select id="mes" name="mes" class="right">
<option value='0'>Seleccionar</option>
</select>
</div>

<div class="block-from">
<label>Año</label>
<input type="hidden" name="year-sta" id="year-sta">
</div>


<input type="hidden" name="send-statistics" value="this"/>
<input type="submit" id="statistics-sub" name="send-statistics" value="Generar">
</form>
<form action="asset/sendCrud.php"  class="forms" id="form-ListarYear" method="post">
<input type="hidden" name="ListarYear" value="this">
<select id="ListarYear" name="ListarYear" class="right">
<option value="0">Seleccionar</option>
</select>

</form>
<div id="response" class="now-id"></div>
</div>
<div id="Listar">
</div>
