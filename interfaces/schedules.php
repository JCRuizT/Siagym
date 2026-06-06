<script src="js/schedules.js"></script>
<div id="form-action">
<div id="cont-title">
<h1>Plantillas de Horario</h1>
</div>

<div id="schedule-list" style="margin-bottom:20px"></div>

<form action="asset/sendCrud.php" class="forms" method="post" id="form-schedule">
<input type="hidden" name="id" id="schedule-id" value="">

<div class="block-from">
<label>Rol</label>
<select name="role" id="role" class="right">
<option value="0">Seleccionar</option>
<option value="1">Aprendiz</option>
<option value="2">Funcionario</option>
</select>
</div>

<div class="block-from">
<label>Días</label>
<div class="days-container">
<label class="day-pill"><input type="checkbox" name="days[]" value="1"> Lun</label>
<label class="day-pill"><input type="checkbox" name="days[]" value="2"> Mar</label>
<label class="day-pill"><input type="checkbox" name="days[]" value="3"> Mié</label>
<label class="day-pill"><input type="checkbox" name="days[]" value="4"> Jue</label>
<label class="day-pill"><input type="checkbox" name="days[]" value="5"> Vie</label>
<label class="day-pill"><input type="checkbox" name="days[]" value="6"> Sáb</label>
<label class="day-pill"><input type="checkbox" name="days[]" value="0"> Dom</label>
</div>
</div>

<div class="block-from" style="overflow:hidden">
<label style="display:block;margin-bottom:6px">Rangos Horarios</label>
<div style="width:100%;max-width:400px">
<table class="schedule-table" style="width:100%">
<thead>
<tr><th style="width:40%">Hora inicio</th><th style="width:40%">Hora fin</th><th style="width:20%"></th></tr>
</thead>
<tbody id="time-slots-body">
</tbody>
</table>
<button type="button" id="add-time-slot" class="btn" style="float:right;margin-top:8px;width:auto;padding:6px 16px;font-size:13px">+ Agregar rango</button>
</div>
</div>

<div class="block-from">
<label style="cursor:pointer;user-select:none">
<input type="checkbox" name="active" id="active" value="1" checked style="width:auto;height:16px;vertical-align:middle;margin:0"> Activo
</label>
</div>

<div class="block-from">
<input type="submit" id="btn-save" value="Guardar" style="margin-right:8px">
<button type="button" id="btn-cancel" class="btn" onclick="cancelEdit()" style="display:none">Cancelar</button>
</div>
</form>

<div id="response" style="clear:both;padding-top:10px"></div>
</div>
