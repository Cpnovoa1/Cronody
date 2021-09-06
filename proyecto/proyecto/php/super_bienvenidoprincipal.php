<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
    }else{
        if($_SESSION['rol'] != 2){
            header('location: ../index.php');
        }
    }

	include('obtener_usuario.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bienvenido</title>
<link href="../css/estilobienvenido.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel='stylesheet'>
</head>

<body>
<div class="contenedor">
	<div class="cabeza">Bienvenido</div>
	<div class="cuerpo">
		<div class="info-user">
			<div class="pag-icono"><img src="../img/logo-supervisor_osc.svg" width="100px" height="100px" alt="profileImg" class="menu3"></div>
			<div class="pag-box">
				<div class="titulo"></div>
				<div class="name-job">
                 <div class="profile_name" id="idrol"><div class="titulo" >Supervisor</div></div>
                <div class="job" id="idnombre"><p>Usuario logueado:</p><ladel><?php echo '<p>'.$cadena.'</p>'; ?></ladel><p>CI de identidad:</p>
					<ladel><?php echo '<p>'.$identificador.'</p>'; ?></ladel></div>
          </div>
			</div>
		</div>
		<div class="cont-tabla">
		<div class="info-pag">
		    
			<div class="cont-tabla decoloracion letra"><div class="principales" style="text-align: center"><i class='fas fa-home' ></i>&nbsp;<label>Inicio</label></div>
			<a href="">Pagina principal</a>
			</div>
			<br>
			<div class="cont-tabla decoloracion letra"><div  class="principales" style="text-align: center"> <i class='fa fa-calendar' ></i>&nbsp;<label >Horarios</label></div>
			<a href="inicializar.php">Crear Horario</a>
			<br>
			<a href="">Modificar horario</a>
			<br>
			<a href="editar_horario.php">Eliminar Horario</a>
			<br>
			<div class="solucion"><a href="solicitar_horario.php">Mostrar Horario</a></div></div>
			<br>
			
			

		</div>
	</div>
	</div>
</div>
</body>
</html>