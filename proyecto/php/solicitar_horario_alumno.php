<?php

 session_start();

if(!isset($_SESSION['rol'])){
	header('location: ../index.php');
}else{
	if($_SESSION['rol'] != 4){
		header('location: ../index.php');
	}
}

include('obtener_usuario.php');

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Horario</title>
	<link href="../css/estilocrearhorario.css" rel="stylesheet" type="text/css">
	<link href="../css/estiloMostrar_horario.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenedor">
	<div class="cabeza">Mi Horario</div>
	<?php
	$conn = new mysqli("localhost", "admin", "admin", "horarios");
	if ($conn ->connect_error) {
		die("Connection failed: " . $conn ->connect_error);
	}
	?>
	<div class="cuerpo" id="idtabla">
		
	</div>
</div>
<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous">
</script>
<script>
$(document).ready(function(){
	//Mediante jquery envio el dato del aula donde esta el alumno matriculado 
	paralelo = "<?php echo $aula_alum; ?>";
	$.post("desplegarhorario_mostrar_alumno.php", { paralelo: paralelo }, function(data){
		$("#idtabla").html(data);
	}); 
})	
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>