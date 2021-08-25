<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: ../index.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: ../index.php');
        }
    }

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
          <i class='bx bxl-c-plus-plus'></i>
          <span class="logo_name">Cronody</span><i class='bx bx-menu' ></i>
        </div>
        <ul class="nav-links">
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-book-alt' ></i>
                <span class="link_name">Usuarios</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Usuarios</a></li>
              <li><a href="#">Crear usuarios</a></li>
              <li><a href="#">Modificar Usuarios</a></li>
              <li><a href="#">Eliminar usuarios</a></li>
			  <li><a href="#">Mostrar usuarios</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-collection' ></i>
                <span class="link_name">Perfiles</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="#">Perfiles</a></li>
              <li><a href="#" onmouseover="mostrarmenu('1')" onmouseout="quitarmenu('1')">Administrador</a>
				  <ul class="sub-menu" id="elemento1"  onmouseover="mostrarmenu('1')" onmouseout="quitarmenu('1')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  
				  <li><a href="#">Editar Datos</a></li>
				  
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="#">Mostrar Datos</a></li>
				</ul>
			  </li>
              <li><a href="#" onmouseover="mostrarmenu('2')" onmouseout="quitarmenu('2')">Supervisor</a>
				 <!-- OJO ACA-->
				<ul class="sub-menu" id="elemento2"  onmouseover="mostrarmenu('2')" onmouseout="quitarmenu('2')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="#">Mostrar Datos</a></li>
				</ul>
			  </li>
              <li><a href="#" onmouseover="mostrarmenu('3')" onmouseout="quitarmenu('3')">Docente</a>
				<ul class="sub-menu" id="elemento3" onmouseover="mostrarmenu('3')" onmouseout="quitarmenu('3')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="#">Mostrar Datos</a></li>
				</ul>
			  </li>
			  <li><a href="#" onmouseover="mostrarmenu('4')" onmouseout="quitarmenu('4')">Alumno</a>
				<ul class="sub-menu" id="elemento4" onmouseover="mostrarmenu('4')" onmouseout="quitarmenu('4')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="#">Mostrar Datos</a></li>
				</ul>
			  </li>
            </ul>
          </li>
		  <!-- Cursos-->
			<li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-collection' ></i>
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
				  <li><a href="#">Mostrar </a></li>
				</ul>
			  </li>
              <li><a href="#" onmouseover="mostrarmenu('6')" onmouseout="quitarmenu('6')">Aulas</a>
				 <!-- OJO ACA-->
				<ul class="sub-menu" id="elemento6"  onmouseover="mostrarmenu('6')" onmouseout="quitarmenu('6')" style="display: none">
				  <li><a href="#">Agregar</a></li>
				  <li><a href="#">Editar Datos</a></li>
				  <li><a href="#">Eliminar Datos</a></li>
				  <li><a href="#">Mostrar Datos</a></li>
				</ul>
			  </li>
              
			  
            </ul>
          </li>
		  <!-- cursofinal-->
          
          
          <li>
            <a href="#">
              <i class='bx bx-line-chart' ></i>
              <span class="link_name">Registros</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Registros</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="#">
                <i class='bx bx-plug' ></i>
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
            <img src="../img/logo-admin.svg" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name">Prem Shahi</div>
            <div class="job">Web Desginer</div>
          </div>
          <a onClick="mostrar()"><i class='bx bx-log-out'></i></a>
        </div>
	         </li>
    </ul>
      </div>
      <section class="home-section">
        <div class="home-content">
          <i class='bx bx-menu' ></i>
          <span class="text">Drop Down barralat</span>
        </div>
      </section>
      <script>
	  function mostrar(){
          document.getElementById('cuadroconfirmar').style.display = 'flex';
      }
	  function ocultar()
      {
		  document.getElementById('cuadroconfirmar').style.display = 'none';
	  }
	function mostrarmenu(index)
    {
		
	   document.getElementById('elemento'+index).style.display = 'block';
    }
    function quitarmenu(index)
    {
		document.getElementById('elemento'+index).style.display = 'none';
	}
		  
      let arrow = document.querySelectorAll(".arrow");
      for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e)=>{
       let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
       arrowParent.classList.toggle("showMenu");
        });
      }
      let barralat = document.querySelector(".barralat");
      let barralatBtn = document.querySelector(".bx-menu");
      console.log(barralatBtn);
      barralatBtn.addEventListener("click", ()=>{
        barralat.classList.toggle("close");
      });
		  
      function cerrar_sesion(){
		  document.getElementById("idcerrars").setAttribute("href","cerrarsesion.php")
	  }
	  
	  document.getElementById("idcerrars").addEventListener("click", cerrar_sesion());
    </script>
</body>
</html>