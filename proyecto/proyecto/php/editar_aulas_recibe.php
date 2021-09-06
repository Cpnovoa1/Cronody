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
	<div class="cabeza">Editar Aula</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );
	$id = $_GET['u'];
	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from paralelo where AUL_CODIGO='$id'" );
	$resultniv = mysqli_query( $conn, "Select * From nivel Where NIV_ESTADO=1 order by NIV_NOMBRE" );
	?>
	<div class="cuerpo2">
	<form name="form1" id="form1" method="post" action="editar_aulas_actualizar.php">
	<div class="cont-tabla">
	<?php
	//Mostramos los registros
	while ( $row = mysqli_fetch_array( $result ) ) {
		?>
		<input type="hidden" value="<?php echo $row["AUL_CODIGO"]; ?>" name="ide">
		<input type="hidden" value="2020-05-05" name="idfecha" id="idfnacimiento">
		
		<div class="row">
		<div class="form-dividido2 formulario__grupo" id="grupo__curso"><p><label for="curso" class="formulario__label">Curso </label></p>
		<input type="text" class="formulario__input" name="curso" id="idcurso" value="<?php echo $row["AUL_CURSO"]; ?>" placeholder="Ingrese el curso" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> No puede ingresar caracteres especiales. Ejm: 1ro Básica ó 1ro BGU</p></div>

		<div class="form-dividido2 formulario__grupo" id="grupo__paralelo"><p><label for="paralelo" class="formulario__label">Paralelo </label></p>
		<input type="text" class="formulario__input" name="paralelo" id="idapellido" value="<?php echo $row["AUL_NOMBRE"]; ?>" placeholder="Ingrese el paralelo" required>
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Sólo puede ingresar una letra mayúscula. Ejm: A</p></div></div>
		
		<div class="row formulario__grupo" id="grupo__nivel"><p><label for="nivel" class="formulario__label">Nivel</label></p>
		<select name="nivel" class="formulario__input" id="idnivel">
			<?php while ($ver = mysqli_fetch_array($resultniv)) {
				if($row["NIV_CODIGO"] == $ver["NIV_CODIGO"]){
					echo '<option value="'.$ver["NIV_CODIGO"].'" selected>'.$ver['NIV_NOMBRE'].' '.$ver['NIV_SUBNIVEL'].'</option>';
				} else{
					echo '<option value="'.$ver["NIV_CODIGO"].'">'.$ver['NIV_NOMBRE'].' '.$ver['NIV_SUBNIVEL'].'</option>';
				}
			}
			?>
		</select></div>
		<?php
	}
	mysqli_free_result( $result );
	?>
	</div>
	<div class="opciones">
		<input type="submit" value="Actualizar">
		<a href="editar_aulas.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
	</div>
	</form>
		
	</div>
</div>
<script src="../js/validaciones_modificar.js"></script>
</body>
</html>