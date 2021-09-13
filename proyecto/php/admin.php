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
	<link rel="shortcut icon" href="../img/logo_login_icono.svg">
    <title>Cronody - Admin</title>
</head>
<body>
	<div class="confirmacion" id="cuadroconfirmar">
		<div class="contenedor centrar">
			<div class="info-icono centrar-flex"><i class="fas fa-question fa-5x"></i></div>
			<div class="info-contenido">
				<div class="info-titulo">Confirmación</div>
				<div class="info-texto">Está a punto de cerrar sesión! &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¿Está seguro?</div>
				<div class="botones" align="center">
					<a id="idcerrars"><button type="button" value="Aceptar" onclick="return getSuccessOutput();">
					Aceptar
					</button></a>
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
            <a href="admin_bienvenidoprincipal.php" target="iframe_a">
              <i class='fas fa-home' ></i>
              <span class="link_name">Inicio</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="admin_bienvenidoprincipal.php" target="iframe_a">Inicio</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="editar_usuarios.php" target="iframe_a">
                <i class='fas fa-user' ></i>
                <span class="link_name">Usuarios</span>
              </a>
            </div>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="editar_usuarios.php" target="iframe_a">Usuarios</a></li>
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
              <li><a href="editar_admin.php" target="iframe_a" onmouseover="mostrarmenu('1')" onmouseout="quitarmenu('1')">Administrador</a>
			  </li>
              <li><a href="editar_supervisor.php" target="iframe_a" onmouseover="mostrarmenu('2')" onmouseout="quitarmenu('2')">Supervisor</a>
			  </li>
              <li><a href="editar_docente.php" target="iframe_a" onmouseover="mostrarmenu('3')" onmouseout="quitarmenu('3')">Docente</a>
			  </li>
			  <li><a href="editar_alumno.php" target="iframe_a" onmouseover="mostrarmenu('4')" onmouseout="quitarmenu('4')">Alumno</a>
			  </li>
            </ul>
          </li>
		  <!-- Cursos-->
			<li>
            <div class="iocn-link">
              <a href="editar_materia.php" target="iframe_a">
                <i class="fas fa-book-open"></i>
                <span class="link_name">Materias</span>
              </a>
            </div>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="editar_materia.php" target="iframe_a">Materias</a></li>
            </ul>
          </li>
	       <li>
            <div class="iocn-link">
              <a href="editar_aulas.php" target="iframe_a">
                <i class="fas fa-chalkboard"></i>
                <span class="link_name">Aulas</span>
              </a>
            </div>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="editar_aulas.php" target="iframe_a">Aulas</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="mostrar_auditorias.php" target="iframe_a">
                <i class='fas fa-address-book' ></i>
                <span class="link_name">Auditoria</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Auditoria</a></li>
              <li><a href="mostrar_auditorias.php"  target="iframe_a">Mostrar Acciones</a></li>

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
      <iframe src="../php/admin_bienvenidoprincipal.php" name="iframe_a" height="100%" width="100%" title="Iframe Example" style="border: none;"></iframe>
    </section>
    
    
<script>
// handles the click event for link 1, sends the query
function getSuccessOutput() {
  getRequest(
      'Myajax.php', // demo-only URL
       drawError
  );
  return true;
}

// handles drawing an error message
function drawError () {
    var container = document.getElementById('output');
    container.innerHTML = 'Bummer: there was an error!';
}
// handles the response, adds the html
function drawOutput(responseText) {
    var container = document.getElementById('output');
    //container.innerHTML = responseText;
}
// helper function for cross-browser request object
function getRequest(url, success, error) {
    var req = false;
    try{
        // most browsers
        req = new XMLHttpRequest();
    } catch (e){
        // IE
        try{
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            // try an older version
            try{
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
                return false;
            }
        }
    }
    if (!req) return false;
    if (typeof success != 'function') success = function () {};
    if (typeof error!= 'function') error = function () {};
    req.onreadystatechange = function(){
        if(req .readyState == 4){
            return req.status === 200 ? 
                success(req.responseText) : error(req.status)
            ;
        }
    }
    req.open("GET", url, true);
    req.send(null);
    return req;
}
</script> 
    
    
<script src="../js/barra.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</body>
</html>
