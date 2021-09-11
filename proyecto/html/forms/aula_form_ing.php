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
<div class="cabeza">Ingresar Aula</div>
<div class="contenido">
<div class="form-contenedor">
<form id="form1" name="form1" method="post" action="php/registro_aula.php">
	<h1 class="centrar titulo">Formulario aula</h1>
	
	<div class="row">
	<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Paralelo </label></p>
	<input type="text" class="formulario__input" name="nombre" id="idnombre" placeholder="Ejemplo: A" pattern="[A-Z]{1}" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i>No puede ingresar caracteres especiales. Ejm: 1ro Básica ó 1ro BGU</p></div>

	<div class="form-dividido2 formulario__grupo" id="grupo__curso"><p><label for="curso" class="formulario__label">Aula curso </label></p>
	<input type="text" class="formulario__input" name="curso" id="idcurso" placeholder="Ejemplo: 2do Básica" required>
	<i class="formulario__validacion-estado fas fa-times-circle"></i>
	<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar una letra mayúscula. Ejm: A</p></div></div>
	<input type="hidden" value="2000-01-02" id="idfnacimiento">
	<input type="hidden" id="idecivil" value="Aula">
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
		<div class="volver2"><a href="../../php/editar_aulas.php" target="_self"><button type="button" name="volver" id="idvolver" value="Volver"><i class="fas fa-chevron-left fa-fw"></i>Volver</button></a></div>
	</p></div>
</form>
</div>
</div>
<script src="js/validaciones.js"></script>
</body>
</html>