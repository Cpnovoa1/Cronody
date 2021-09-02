<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
	<link href="../css/estiloMostrar.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>

<body>
<div class="contenedor2">
	<div class="cabeza">Editar Supervisor</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );
	$id = $_GET['u'];
	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from supervisor where sup_codigo='$id'" );
	?>
	<div class="cuerpo2">
	<form name="form1" id="form1" method="post" action="editar_supervisor_actualizar.php">
	<div class="cont-tabla">
	<?php
	//Mostramos los registros
	while ( $row = mysqli_fetch_array( $result ) ) {
		?>
		<input type="hidden" value="<?php echo $row["SUP_CODIGO"]; ?>" name="ide">
		
		<div class="row">
		<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
		<input type="text" class="formulario__input" name="nombre" id="idnombre" value="<?php echo $row[ "SUP_NOMBRE" ]; ?>" placeholder="Ingrese el nombre" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div>

		<div class="form-dividido2 formulario__grupo" id="grupo__apellido"><p><label for="apellido" class="formulario__label">Apellido </label></p>
		<input type="text" class="formulario__input" name="apellido" id="idapellido" value="<?php echo $row[ "SUP_APELLIDO" ]; ?>" placeholder="Ingrese el apellido" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div></div>
		
		<div class="row">
		<div class="form-dividido2 formulario__grupo" id="grupo__telefono"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
		<input type="tel" class="formulario__input" name="telefono" id="idtelefono" value="<?php echo $row[ "SUP_TELEFONO" ]; ?>" placeholder="Ingrese el teléfono" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo caracteres numéricos de 7 a 10 dígitos</p></div>

		<div class="form-dividido2 formulario__grupo" id="grupo__fnacimiento"><p><label for="fnac" class="formulario__label">Fecha de nacimiento </label></p>
		<input type="date" class="formulario__input" name="fnac" value="<?php echo $row[ "SUP_FNACIMIENTO" ]; ?>" id="idfnacimiento" required ></div></div>
		
		<div class="row formulario__grupo" id="grupo__direccion"><p><label for="direccion" class="formulario__label">Dirección </label></p>
		<input type="text" class="formulario__input" name="direccion" id="iddireccion" value="<?php echo $row[ "SUP_DIRECCION" ]; ?>" placeholder="Ingrese la dirección" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Puede ingresar caracteres alfa-numéricos y sólo algunos especiales (/ * # - .)</p></div>
		<?php
	}
	mysqli_free_result( $result );
	?>
	</div>
	<div class="opciones">
		<input type="submit" value="Actualizar">
		<a href="editar_supervisor.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
	</div>
	</form>
		
	</div>
</div>
<script src="../js/validaciones_modificar.js"></script>
</body>
</html>