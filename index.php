<?php 
session_start();

if(isset($_SESSION["administrador"])){
	
	header("location: dashboard.php");
	
}else{

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<title>SIAGYM - Inicio de sesion</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta name="author" content="Julio Cesar Ruiz"/>
<link rel="stylesheet" href="css/manifest-styles.css"/>
<link rel="stylesheet" href="css/background.css"/>
<link rel="stylesheet" href="css/styles-init.css"/>
<link rel="shortcut icon" href="img/link-icon-sena.png" type="image/x-icon"/>
<script src="js/jquery.js"></script>
<script>
$(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});
</script>
</head>

<body class="overflow-hidden">
<setApp  data-app-version="1.0" data-colaboration = "Julian Perdomo" data-app-name="siagym" data-client-software="sena"></setApp>
<div class="background-body-main">
<div id="background-primary-color-main">
<span class="hidden"><br></span>
<div class="space-120">
</div>

<div class="fnd-init">

</div>
<div style="width: 100%; background: red">

</div>
</div>
<div id="background-second-color-main">
<span class="hidden"><br></span>
</div> 

</div>
<div class="main">
<div class="container-header-subheader">
<div class="header flex between">
<div class="logo-container-sena-siagym">
<span style="background-image: url(img/sena-colombia-logo-siagym.png);background-size: 100% 100%; display: block;" class="logo-siagym"></span>
</div>
<div class="siagym-logo-container">
<strong class="logo-string"><span style="background-image: url(img/siagym-gymlog.png);background-size: 100% 100%; display: block;" class="img-log-sia"></span></strong>
</div>
</div>
</div>
<div class="flex-center">
<div id="style-form-init" class="flex-center-complete">
<form action="asset/sendlogin.php" method="post" autocomplete="off">
<div class="flex">
<div id="style-inputs" class="flex-center-complete">
<label class="lbl-init select-false" for="username">nombre de usuario</label>
<input id="username" class="input-box int-init" type="text" name="user"/>
<label class="lbl-init select-false" for="password">contraseña</label>
<input  id="password" class="input-box int-init"type="password" name="pass"/>
<input type="submit" name="send" class="input-button-init"/>
</div>
</div>
</form>
</div>
</div>
</div>
</body>



</html>

<?php
}
?>
