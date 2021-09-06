<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario</title>
<link href="css/estiloform.css" rel="stylesheet" type="text/css">
<link href="css/estilohtmls.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="cabeza">Ingresar Usuario</div>
<div class="contenido">
<div class="form-contenedor">
<form id="form1" name="form1" method="post" action="php/registro_usu.php">
	<h1 class="centrar titulo">Formulario</h1>
	
	<div class="row">
	<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
	<input type="text" class="formulario__input" name="nombre" id="idnombre" placeholder="Ingrese el nombre" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div>

	<div class="form-dividido2 formulario__grupo" id="grupo__apellido"><p><label for="apellido" class="formulario__label">Apellido </label></p>
	<input type="text" class="formulario__input" name="apellido" id="idapellido" placeholder="Ingrese el apellido" required onChange="generarnombreusuario()">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div></div>
	
	<div class="row">
	<div class="form-dividido2 formulario__grupo" id="grupo__cedula"><p><label for="cedula" class="formulario__label">Cédula </label></p>
	<input type="text" class="formulario__input" name="cedula" id="idcedula" placeholder="Ingrese la cédula" required>
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Debe ingresar una cédula ecuatoriana válida</p></div>
		
	<div class="form-dividido2 formulario__grupo" id="grupo__fnacimiento"><p><label for="fnacimiento" class="formulario__label">Fecha de nacimiento </label></p>
	<input type="date" class="formulario__input" name="fnacimiento" id="idfnacimiento" required  ></div></div>
	
	<div class="row"><div class="info"><i class="far fa-question-circle"></i> El usuario y la clave se generan automáticamente, si desea cambiarlos modifique el contenido</div>
	<div class="form-dividido2 formulario__grupo" id="grupo__nombreusuario"><p><label for="nombreusuario" class="formulario__label" >Nombre de usuario </label></p>
	<input type="text" class="formulario__input" name="nombreusuario" id="idnombreusuario" value="" placeholder="Usuario" required ><i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> No puede ingresar caracteres especiales ni espacios</p></div>
		
	<div class="form-dividido2 formulario__grupo" id="grupo__claveusuario">
	<p><label for="usuario" class="formulario__label" >Clave</label></p>
	<input type="text" class="formulario__input" name="claveusuario" id="idclaveusuario" value="" placeholder="Contraseña" required ><i class="formulario__validacion-estado fas fa-times-circle"></i><p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> La clave debe contener al menos 1 mayúscula, 1 minúscula y 1 número. Debe tener entre 8 a 16 caracteres.</p>
	</div></div>
	
	<div class="row formulario__grupo" id="grupo__ecivil"><p><label for="ecivil" class="formulario__label">Perfil</label></p>
	<select name="ecivil" class="formulario__input" id="idecivil" required onChange="validarRol()">
	  <option value="" selected>Elija una opcion</option>
      <option value="Administrador">Administrador</option>
	  <option value="Supervisor">Supervisor</option>
	  <option value="Docente">Docente</option>
	  <option value="Alumno">Alumno</option>
    </select></div>
	
	<div id="grupo__admin"><div class="row">
	<div class="formulario__grupo" id="grupo__adm_telefono"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
	<input type="tel" class="formulario__input" name="adm_telefono" id="idtelefono" placeholder="Ingrese el teléfono" >
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo caracteres numéricos del 7 a 10 dígitos</p></div></div>
	<div class="row formulario__grupo" id="grupo__adm_direccion"><p><label for="direccion" class="formulario__label">Dirección </label></p>
	<input type="text" class="formulario__input" name="adm_direccion" id="adm_direccion" placeholder="Ingrese la dirección" >
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Puede ingresar caracteres alfa-numéricos y sólo algunos especiales (/ * # - .)</p></div>
	</div>
	
	<div id="grupo__docente"><div class="row formulario__grupo" id="grupo__doc_direccion"><p><label for="direccion" class="formulario__label">Dirección </label></p>
	<input type="text" class="formulario__input" name="doc_direccion" id="doc_direccion" placeholder="Ingrese la dirección">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Puede ingresar caracteres alfa-numéricos y sólo algunos especiales (/ * # - .)</p></div><div class="row">
	<div class="formulario__grupo" id="grupo__doc_telefono"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
	<input type="tel" class="formulario__input" name="doc_telefono" id="doc_telefono" placeholder="Ingrese el teléfono">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo caracteres numéricos del 7 a 10 dígitos</p></div></div></div>
	
	<div id="grupo__supervisor"><div class="row formulario__grupo" id="grupo__sup_direccion"><p><label for="direccion" class="formulario__label">Dirección </label></p>
	<input type="text" class="formulario__input" name="sup_direccion" id="sup_direccion" placeholder="Ingrese la dirección">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Puede ingresar caracteres alfa-numéricos y sólo algunos especiales (/ * # - .)</p></div>
	<div class="row">
	<div class="formulario__grupo" id="grupo__sup_telefono"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
	<input type="tel" class="formulario__input" name="sup_telefono" id="sup_telefono" placeholder="Ingrese el teléfono">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo caracteres numéricos del 7 a 10 dígitos</p></div></div>
	</div>

	<div id="grupo__alumno"><div class="row formulario__grupo" id="grupo__alu_email"><p><label for="email" class="formulario__label">Email </label></p>
	<input type="email" class="formulario__input" name="alu_email" id="alu_email" placeholder="Ingrese el correo electrónico">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Debe ingresar un formato de correo válido. Ej: ejemplo@ejemplo.com</p></div><div class="row formulario__grupo" id="grupo__alu_direccion"><p><label for="direccion" class="formulario__label">Dirección </label></p>
	<input type="text" class="formulario__input" name="alu_direccion" id="alu_direccion" placeholder="Ingrese la dirección">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Puede ingresar caracteres alfa-numéricos y sólo algunos especiales (/ * # - .)</p></div><div class="row">
	<div class="row formulario__grupo" id="grupo__alu_telefono"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
	<input type="tel" class="formulario__input" name="alu_telefono" id="alu_telefono" placeholder="Ingrese el teléfono">
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo caracteres numéricos del 7 a 10 dígitos</p></div></div>
		<div class="row formulario__grupo"><p><label for="ecivil" class="formulario__label">Aula</label></p>
	<select name="aula" class="formulario__input" id="idecivil">
		<?php
		$conn = new mysqli("localhost", "admin", "admin", "horarios");
		if ($conn ->connect_error) {
			die("Connection failed: " . $conn ->connect_error);
		}
		$result=mysqli_query($conn,"Select * From paralelo Order By hor_codigo");
		while ($row=mysqli_fetch_array($result))
		{
			echo '<option value = "'.$row[0].'">'.$row[3].' '.$row[2].'</option>';
		}
		?>
    </select></div></div>
	<div class="row"><p class="centrar4">
		<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
		<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
		<div class="volver2"><a href="../../php/editar_usuarios.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a></div>
	</div>
</form>
</div>
</div>
<script src="js/validaciones.js"></script>
</body>
</html>
