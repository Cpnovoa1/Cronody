<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
    }else{
        if($_SESSION['rol'] != 1){
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
            <div class="iocn-link">
              <a href="#">
                <i class='fas fa-user' ></i>
                <span class="link_name">Usuarios</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Usuarios</a></li>
              <li><a href="#">Crear usuarios</a></li>
              <li><a href="#">Modificar Usuarios</a></li>
              <li><a href="#">Eliminar usuarios</a></li>
			  <li><a href="mostrar_usuarios.php" target="iframe_a">Mostrar usuarios</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='fas fa-users'></i></i>
                <span class="link_name">Perfiles</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Perfiles</a></li>
              <li><a href="#" onmouseover="mostrarmenu('1')" onmouseout="quitarmenu('1')">Administrador</a>
				  <ul class="sub-menu" id="elemento1"  onmouseover="mostrarmenu('1')" onmouseout="quitarmenu('1')" style="display: none">
				  <li><a href="#">Agregar</a></li>

				  <li><a href="#">Editar Datos</a></li>

				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="mostrar_administrador.php" target="iframe_a">Mostrar Datos</a></li>
				</ul>
			  </li>
              <li><a href="#" onmouseover="mostrarmenu('2')" onmouseout="quitarmenu('2')">Supervisor</a>
				 <!-- OJO ACA-->
				<ul class="sub-menu" id="elemento2"  onmouseover="mostrarmenu('2')" onmouseout="quitarmenu('2')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="mostrar_supervisores.php" target="iframe_a">Mostrar Datos</a></li>
				</ul>
			  </li>
              <li><a href="#" onmouseover="mostrarmenu('3')" onmouseout="quitarmenu('3')">Docente</a>
				<ul class="sub-menu" id="elemento3" onmouseover="mostrarmenu('3')" onmouseout="quitarmenu('3')" style="display: none">
				  <li><a href="form_alumno.php" target="iframe_a">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="mostrar_docente.php" target="iframe_a">Mostrar Datos</a></li>
				</ul>
			  </li>
			  <li><a href="#" onmouseover="mostrarmenu('4')" onmouseout="quitarmenu('4')">Alumno</a>
				<ul class="sub-menu" id="elemento4" onmouseover="mostrarmenu('4')" onmouseout="quitarmenu('4')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="mostrar_alumnos.php" target="iframe_a">Mostrar Datos</a></li>
				</ul>
			  </li>
            </ul>
          </li>
		  <!-- Cursos-->
			<li>
            <div class="iocn-link">
              <a href="#">
                <i class='fas fa-school' ></i>
                <span class="link_name">Cursos</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Cursos</a></li>
              <li><a href="#" onmouseover="mostrarmenu('5')" onmouseout="quitarmenu('5')">Materia</a>
				  <ul class="sub-menu" id="elemento5"  onmouseover="mostrarmenu('5')" onmouseout="quitarmenu('5')" style="display: none">
				  <li><a href="#">Agregar</a></li>

				  <li><a href="#">Editar </a></li>

				  <li><a href="#">Eliminar </a></li>
				  <li><a href="mostrar_materia.php" target="iframe_a">Mostrar </a></li>
				</ul>
			  </li>
              <li><a href="#" onmouseover="mostrarmenu('6')" onmouseout="quitarmenu('6')">Aulas</a>
				 <!-- OJO ACA-->
				<ul class="sub-menu" id="elemento6"  onmouseover="mostrarmenu('6')" onmouseout="quitarmenu('6')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="mostrar_aulas.php" target="iframe_a">Mostrar Datos</a></li>
				</ul>
			  </li>


            </ul>
          </li>
		  <!-- cursofinal-->


          <li>
            <a href="#">
              <i class='fas fa-book' ></i>
              <span class="link_name">Registros</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Registros</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='fas fa-address-book' ></i>
                <span class="link_name">Auditoria</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Auditoria</a></li>
              <li><a href="#">Mostrar Acciones</a></li>

            </ul>
          </li>
          <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="../img/logo-admin.svg" alt="profileImg" class="menu3">
          </div>
          <div class="name-job">
            <div class="profile_name" id="idrol">Administrador</div>
            <div class="job" id="idnombre"><?php echo $cadena; ?></div>
          </div>
          <div onClick="mostrar()"><a id="idsalir1"><i class='fas fa-sign-out-alt fa-rotate-180 fa-10x'></i></a></div>
			<div class="cerrarses cerrarses-out" id="idcerrarses">Cerrar Sesion</div>
        </div>
	    </li>
    </ul>
      </div>
    <section class="home-section">
      <iframe src="../html/admin-bienvenido.html" name="iframe_a" height="100%" width="100%" title="Iframe Example" style="border: none;"></iframe>
    </section>
<script src="../js/barra.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</body>
</html>
