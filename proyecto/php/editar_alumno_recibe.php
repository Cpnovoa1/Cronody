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
	<div class="cabeza">Editar Alumno</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );
	$id = $_GET['u'];
	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from alumno where ALU_codigo='$id'" );
	$resultcur = mysqli_query( $conn, "Select * From paralelo Where AUL_ESTADO=1 group by AUL_CURSO, AUL_NOMBRE order by AUL_CURSO;" );
	
	?>
	<div class="cuerpo2">
	<form name="form1" id="form1" method="post" action="editar_alumno_actualizar.php">
	<div class="cont-tabla">
	<?php
	//Mostramos los registros
	while ( $row = mysqli_fetch_array( $result ) ) {
		?>
		<input type="hidden" value="<?php echo $row["ALU_CODIGO"]; ?>" name="ide">
		
		<div class="row">
		<div class="form-dividido2 formulario__grupo" id="grupo__nombre"><p><label for="nombre" class="formulario__label">Nombre </label></p>
		<input type="text" class="formulario__input" name="nombre" id="idnombre" value="<?php echo $row[ "ALU_NOMBRE" ]; ?>" placeholder="Ingrese el nombre" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div>

		<div class="form-dividido2 formulario__grupo" id="grupo__apellido"><p><label for="apellido" class="formulario__label">Apellido </label></p>
		<input type="text" class="formulario__input" name="apellido" id="idapellido" value="<?php echo $row[ "ALU_APELLIDO" ]; ?>" placeholder="Ingrese el apellido" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar letras</p></div></div>

		<div class="row formulario__grupo" id="grupo__rol"><p><label for="curso" class="formulario__label">Curso Actual</label></p>
		<select name="curso" class="formulario__input" id="idcurso">
			<?php while ($ver = mysqli_fetch_array($resultcur)) {
				if($row["AUL_CODIGO"] == $ver["AUL_CODIGO"]){
					echo '<option value="'.$ver["AUL_CODIGO"].'" selected>'.$ver['AUL_CURSO'].' "'.$ver['AUL_NOMBRE'].'"</option>';
				} else{
					echo '<option value="'.$ver["AUL_CODIGO"].'">'.$ver['AUL_CURSO'].' "'.$ver['AUL_NOMBRE'].'"</option>';
				}
			}
			?>
		</select></div>	
			
		<div class="row">
		<div class="form-dividido2 formulario__grupo" id="grupo__telefono"><p><label for="telefono" class="formulario__label">Teléfono </label></p>
		<input type="tel" class="formulario__input" name="telefono" id="idtelefono" value="<?php echo $row[ "ALU_TELEFONO" ]; ?>" placeholder="Ingrese el teléfono" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo caracteres numéricos de 7 a 10 dígitos</p></div>

		<div class="form-dividido2 formulario__grupo" id="grupo__fnacimiento"><p><label for="fnac" class="formulario__label">Fecha de nacimiento </label></p>
		<input type="date" class="formulario__input" name="fnac" value="<?php echo $row[ "ALU_FNACIMIENTO" ]; ?>" id="idfnacimiento" required ></div></div>
		
		<div class="row formulario__grupo" id="grupo__direccion"><p><label for="direccion" class="formulario__label">Dirección </label></p>
		<input type="text" class="formulario__input" name="direccion" id="iddireccion" value="<?php echo $row[ "ALU_DIRECCION" ]; ?>" placeholder="Ingrese la dirección" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Puede ingresar caracteres alfa-numéricos y sólo algunos especiales (/ * # - .)</p></div>
			
		<div class="row formulario__grupo" id="grupo__email"><p><label for="email" class="formulario__label">Email </label></p>
		<input type="email" class="formulario__input" name="email" id="idemail" value="<?php echo $row[ "ALU_EMAIL" ]; ?>" placeholder="Ingrese el correo electrónico" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Debe ingresar un formato de correo válido. Ej: ejemplo@ejemplo.com</p></div>
		<?php
	}
	mysqli_free_result( $result );
	?>
	</div>
	<div class="opciones">
		<input type="submit" value="Actualizar">
		<a href="editar_alumno.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
	</div>
	</form>
		
	</div>
</div>
<script src="../js/validaciones_modificar.js"></script>
</body>
</html>