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
<div class="cabeza">Ingresar Materia</div>
<div class="contenido">
<div class="form-contenedor">
<form id="form1" name="form1" method="post" action="php/registro_materia.php">
	<input type="hidden" id="idfnacimiento" value="2000-01-02">
	<h1 class="centrar titulo">Formulario materia</h1>
	<div class="row">
	<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Asigntura</label></p>
	<input type="text" class="formulario__input" name="nombre" id="idnombre" placeholder="Ejemplo: Trigonometria" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div>

	<div class="form-dividido2 formulario__grupo" id="grupo__apellido"><p><label for="apellido" class="formulario__label">Área de conocimiento </label></p>
	<input type="text" class="formulario__input" name="apellido" id="idarea" placeholder="Ejemplo: Matematicas " required>
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div></div>
	
	<div class="row">
	<div class="formulario__grupo" id="grupo__adm_telefono"><p><label for="telefono" class="formulario__label">Carga horaria </label></p>
	<input type="number" class="formulario__input" name="m_carga" id="idtelefono" placeholder="Ingrese la carga horaria" step="1" min="1" max="30" required>
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo caracteres numéricos del 1 a 2 dígitos</p></div>
	</div>
	<input type="hidden" value="Materia" id="idecivil">
	<div class="row formulario__grupo" id="grupo__ecivil"><p><label for="ecivil" class="formulario__label">Nivel</label></p>
	<select name="nivel" class="formulario__input" id="nivel" required>
		<?php
		$conn = new mysqli("localhost", "admin", "admin", "horarios");
		if ($conn ->connect_error) {
			die("Connection failed: " . $conn ->connect_error);
		}
		$result=mysqli_query($conn,"Select * From nivel Order By niv_codigo");
		while ($row=mysqli_fetch_array($result))
		{
			echo '<option value = "'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
		}
		?>
    </select></div>
	
	<div class="row"><p class="centrar4">
		<button type="submit" name="enviar" id="idsubmit" value="ingresar"><i class="fas fa-save fa-fw"></i>&nbsp;&nbsp;Guardar</button>
		<button type="reset" name="resetear" id="idreset" value="limpiar"><i class="fas fa-times-circle fa-fw"></i></button>
		<div class="volver2"><a href="../../php/editar_materia.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a></div>
	</p></div>
</form>
</div>
</div>
<script src="js/validaciones.js"></script>
</body>
</html>
