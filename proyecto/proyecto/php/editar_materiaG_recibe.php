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
	<div class="cabeza">Editar Materia</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );
	$id = $_GET['u'];
	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from materias where MAT_CODIGO='$id'" );
	$resultdoc = mysqli_query( $conn, "Select * From docente Where DOC_ESTADO=1 order by DOC_NOMBRE" );
	$resultniv = mysqli_query( $conn, "Select * From nivel Where NIV_ESTADO=1 order by NIV_NOMBRE" );
	$resultarea = mysqli_query( $conn, "Select * From materias Where MAT_ESTADO=1 group by MAT_AREA order by MAT_AREA" );
	?>
	<div class="cuerpo2">
	<form name="form1" id="form1" method="post" action="editar_materiaG_actualizar.php">
	<div class="cont-tabla">
	<?php
	//Mostramos los registros
	while ( $row = mysqli_fetch_array( $result ) ) {
		?>
		<input type="hidden" value="<?php echo $row["MAT_CODIGO"]; ?>" name="ide">
		<input type="hidden" value="2020-05-05" name="idfecha" id="idfnacimiento">
		
		<div class="row formulario__grupo" id="grupo__materia"><p><label for="materia" class="formulario__label">Materia </label></p>
		<input type="text" class="formulario__input" name="materia" id="idmateria" value="<?php echo $row["MAT_NOMBRE"]; ?>" placeholder="Ingrese la materia" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Solo puede ingresar letras. Ejm: Matemática</p></div>
		
		<div class="row formulario__grupo" id="grupo__area"><p><label for="area" class="formulario__label">Área</label></p>
		<select name="area" class="formulario__input" id="idarea">
			<?php while ($ver = mysqli_fetch_array($resultarea)) {
				if($row["MAT_AREA"] == $ver["MAT_AREA"]){
					echo '<option value="'.$ver["MAT_AREA"].'" selected>'.$ver['MAT_AREA'].'</option>';
				} else{
					echo '<option value="'.$ver["MAT_AREA"].'">'.$ver['MAT_AREA'].'</option>';
				}
			}
			?>
		</select></div>	
		
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
		
		<div class="row formulario__grupo" id="grupo__horas"><p><label for="horas" class="formulario__label">Horas Pedagógicas </label></p>
		<input type="number" class="formulario__input" name="horas" id="idhoras" min="1" max="45" value="<?php echo $row[ "MAT_CARGAHORARIA" ]; ?>" placeholder="1" required><i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Solo puede ingresar números positivos</p></div>
		<?php
	}
	mysqli_free_result( $result );
	?>
	</div>
	<div class="opciones">
		<input type="submit" value="Actualizar">
		<a href="editar_materia.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>
	</div>
	</form>
		
	</div>
</div>
<script src="../js/validaciones_modificar.js"></script>
</body>
</html>