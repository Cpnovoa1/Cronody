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
			<div class="pag-icono"><img src="../img/logo-admin_osc.svg" width="100px" height="100px" alt="profileImg" class="menu3"></div>
			<div class="pag-box">
				<div class="titulo"></div>
				<div class="name-job">
                 <div class="profile_name" id="idrol"><div class="titulo" >Administrador</div></div>
                <div class="job" id="idnombre"><p>Usuario logueado:</p><ladel><?php echo '<p>'.$cadena.'</p>'; ?></ladel><p>CI de identidad:</p>
					<ladel><?php echo '<p>'.$identificador.'</p>'; ?></ladel></div>
          </div>
			</div>
		</div>
		<div class="cont-tabla">
		<div class="info-pag">
		    <div class="cont-tabla decoloracion letra"><div  class="principales" style="text-align: center"> <i class='fas fa-home' ></i>&nbsp;<label>Inicio</label></div>
			<a href="admin_bienvenidoprincipal.php">Pagina principal</a>
			</div>
			<div class="cont-tabla decoloracion letra"> <div  class="principales" style="text-align: center"><i class='fas fa-user'></i>&nbsp;<label>Usuarios</label></div>
			<a href="editar_usuarios.php">Acciones de usuario</a>
			</div>
			<div class="cont-tabla decoloracion letra"><div  class="principales" style="text-align: center"> <i class='fas fa-users'></i>&nbsp;<label >Perfiles</label></div>
			<a href="editar_admin.php">Administrador</a>
			<br>
			<a href="editar_supervisor.php">Supervisor</a>
			<br>
			<a href="editar_docente.php">Docente</a>
			<br>
			<div class="nombre letra"><a href="editar_alumno.php">Alumno</a></div></div>
			<br>
			<div class="cont-tabla decoloracion letra"><div class="principales" style="text-align: center"><i class="fas fa-book-open"></i>&nbsp;<label>Materias</label></div>
			<a href="editar_materia.php">Materias</a>
			</div>
			<div class="cont-tabla decoloracion letra"><div class="principales" style="text-align: center"><i class="fas fa-chalkboard"></i>&nbsp;<label >Aulas</label></div>
			<a href="editar_aulas.php">Aulas</a>
			</div>
			<div class="cont-tabla decoloracion letra" ><div class="principales" style="text-align: center"> <i class='fas fa-address-book' ></i>&nbsp;<label>Auditoria</label></div>
			<a href="mostrar_auditorias.php">Mostrar acciones</a>
		   
			</div>

		</div>
	</div>
	</div>
</div>
</body>
</html>