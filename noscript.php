<?php 

session_start();

if(!isset($_SESSION["administrador"])){
	
	header("location: index.php");
	
}else{
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta name="author" content="Julio Cesar Ruiz,Brayan Vasquez, Jhon Quiñones"/>
<title>Activar Javascript - SIAGYM</title>
<link rel="stylesheet" href="css/manifest-styles.css"/>
<link rel="stylesheet" href="css/background.css"/>
<link rel="stylesheet" href="css/dashboard.css"/>
<script src="js/activateJscript.js"></script>
<script src="js/jquery.js"></script>
<script>
$(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});
</script>
</head>

<body>
<setApp  data-app-version="1.0"  data-colaboration = "Julian Perdomo" data-app-name="siagym" data-client-software="sena"></setApp>
<div class="container-header-subheader noscript">
<div class="header flex between">
<div class="logo-container-sena-siagym">
<span style="background-image: url(img/sena-colombia-logo-siagym.png);background-size: 100% 100%; display: block;" class="logo-siagym"></span>
</div>
<div class="siagym-logo-container">
<strong class="logo-string"><span style="background-image: url(img/siagym-gymlog.png);background-size: 100% 100%; display: block;" class="img-log-sia"></span></strong>
<div class='form-salir'>
<form action='asset/logout.php' method='post'>
<input type='submit' value='salir' name='logout' class='submit-logout'>
</form>
</div>
</div>
</div>
<div class="subheader">
</div>
</div>

<div id="noscript" class="flex-center">
<div class="flex-center-complete" style="box-shadow: 0px 0px 5px #000000; padding: 20px;">
<h1 style="color: red">Se requiere Javascript</h1>

<p style="margin-top: 10px;">Lamentamos informarte que SIAGYM no funciona correctamente si JavaScript no está habilitado</p>
</div>
</div>
</body>
</html>

<?php
}
?>