<?php

    session_start();

	if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // destroy the session 
        session_destroy(); 
    }

    if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
    }else{
        if($_SESSION['rol'] != 2){
            header('location: ../index.php');
        }
    }

	include('obtener_usuario.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/barra_lateral.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
	<div class="confirmacion" id="cuadroconfirmar">
		<div class="contenedor centrar">
			<div class="info-icono centrar-flex"><i class="fas fa-question fa-5x"></i></div>
			<div class="info-contenido">
				<div class="info-titulo">Confirmación</div>
				<div class="info-texto">Está a punto de cerrar sesión! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¿Está seguro?</div>
				<div class="botones" align="center">
					<a id="idcerrars"><button type="button" value="Aceptar">Aceptar</button></a>
					 &nbsp;&nbsp;&nbsp;&nbsp; 
					<button type="button" onClick="ocultar()">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
    <div class="barralat close">
        <div class="logo-details">
          <img src="../img/logo_loginmini.svg" alt="logo" class="menu">
          <span class="logo_name">Cronody</span> 
		  <i class='bx bx-menu menu2 logo_name'></i>
        </div> 
        <ul class="nav-links">
            <li>
            <a href="super_bienvenidoprincipal.php" target="iframe_a">
              <i class='fas fa-home' ></i>
              <span class="link_name">Inicio</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="super_bienvenidoprincipal.php" target="iframe_a">Inicio</a></li>
            </ul>
          </li>
			<li>
            <div class="iocn-link">
              <a href="#">
                <i class='fa fa-calendar' ></i>
                <span class="link_name">Horarios</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
			  <li><a class="link_name" href="#">Horarios</a></li>
              <li><a href="inicializar.php" target="iframe_a">Crear horario</a></li>
              <li><a href="#">Modificar horario</a></li>
              <li><a href="editar_horario.php" target="iframe_a">Eliminar horario</a></li>
			  <li><a href="solicitar_horario.php" target="iframe_a">Mostrar horario</a></li>
            </ul>
          </li>         
          <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="../img/logo-supervisor.svg" alt="profileImg" class="menu3">
          </div>
          <div class="name-job">
            <div class="profile_name">Supervisor</div>
            <div class="job"><?php echo $cadena; ?></div>
          </div>
          <div onClick="mostrar()"><a id="idsalir1"><i class='fas fa-sign-out-alt fa-rotate-180 fa-10x'></i></a></div>
			<div class="cerrarses cerrarses-out" id="idcerrarses">Cerrar Sesion</div>
        </div>
	    </li>
    </ul>
      </div>
    <section class="home-section">
      <iframe src="super_bienvenidoprincipal.php" name="iframe_a" height="100%" width="100%" title="Iframe Example" style="border: none;"></iframe>
    </section>
    <script src="../js/barra.js"></script>
</body>
</html>