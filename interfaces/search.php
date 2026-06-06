<script src="js/functions-actions-petition.js"></script>
<div id="form-action">
<div id="cont-title">
<h1>Buscar</h1>
</div>
<form action="asset/sendCrud.php" class="forms" id="form-search" method="post">

<div class="block-from">
<label>Identificación</label>
<input type="number" id="identificacion" name="identificacion2" class="right">
</div>

<input type="hidden" name="send-search" value="this">
<div class="block-from">
<div id="change">
<input type="submit" id="send-search" name="send-search" value="Buscar"> 
</div>
</div>
<div id="response"></div>
</form>
</div>




