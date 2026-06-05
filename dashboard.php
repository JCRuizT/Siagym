<?php 

session_start();

if(!isset($_SESSION["administrador"])){
	
	header("location: index.php");
	
}else{
	
	if(!isset($_GET["assistance"])  and !isset($_GET["add"]) and !isset($_GET["search"]) and !isset($_GET["statistics"])){
		
		
		header("location: ?assistance");
	

	}






	

?>

<!DOCTYPE html>
<html lang="es">
<head>
<noscript>
<meta http-equiv="refresh" content="0;noscript.php">
</noscript>
<meta charset="utf-8"/>

<title>Dashboard - SIAGYM</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<meta name="author" content="Julio Cesar Ruiz"/>

<link rel="stylesheet" href="css/manifest-styles.css"/>
<link rel="stylesheet" href="css/background.css"/>
<link rel="stylesheet" href="css/dashboard.css"/>
<link rel="shortcut icon" href="img/link-icon-sena.png" type="image/x-icon"/>


<script src="js/jquery.js"></script>
<script src="js/fecha-date-now.js"></script>
<script src="js/assets-jquery-nice-val-men.js"></script>
<script>
$(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});
</script>
</head>

<body>
<setApp  data-app-version="1.0" data-colaboration = "Julian Perdomo" data-app-name="siagym" data-client-software="sena"></setApp>
<div id="petitions.php">
<script src="js/functions-actions-petition.js"></script>
</div>
<div class="container-header-subheader">
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

<ul class="menu">
<a class="link-menu" href="?assistance" data-link-vinculo="interfaces/assistance.php"><li class="items-menu" id="link-assistance"><span>Asistencia</span></li></a>
<a class="link-menu" href="?add" data-link-vinculo="interfaces/add.php"><li id="link-add" class="items-menu"><span>Registrar</span></li></a>
<a class="link-menu" href="?search" data-link-vinculo="interfaces/search.php"><li id="link-search" class="items-menu"><span>Buscar</span></li></a>

<a class="link-menu" href="?statistics" data-link-vinculo="interfaces/statistics.php"><li id="link-statistics" class="items-menu"><span>Reportes</span></li></a>

</ul>

</div>
</div>
<div class="container">
<div id="container-siagym">

<?php 

if(isset($_GET["assistance"])){
	include("interfaces/assistance.php");
}else if(isset($_GET["add"])){
	
	include("interfaces/add.php");


}else if(isset($_GET["search"])){
	
	include("interfaces/search.php");

}else if(isset($_GET["statistics"])){
	
	include("interfaces/statistics.php");
	
}

?>



</div>

</div>




</div>


<div id="delete-now"></div>
</body>
</html>
<?php
}
?>
