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
	<div class="cabeza">Editar Usuario</div>
	<?php
	$conn = new mysqli( "localhost", "admin", "admin", "horarios" );
	$id = $_GET['u'];
	//Ejecutamos la sentencia SQL
	$result = mysqli_query( $conn, "select * from usuario u, roles r where u.rol_codigo=r.rol_codigo and u.usu_codigo='$id'" );
	$resrol = mysqli_query( $conn, "select * from roles where rol_estado = 1" ); 
	?>
	<div class="cuerpo2">
	<form name="form1" id="form1" method="post" action="editar_usuarios_actualizar.php">
	<div class="cont-tabla">	
	<?php
	//Mostramos los registros
	while ( $row = mysqli_fetch_array( $result ) ) {
		?>
		<input type="hidden" value="<?php echo $row["USU_CODIGO"]; ?>" name="ide">
		<input type="hidden" value="2020-05-05" name="idfecha" id="idfnacimiento">
		<div class="row formulario__grupo" id="grupo__rol"><p><label for="rol" class="formulario__label">Rol</label></p>
		<select name="rol" class="formulario__input" id="idrol">
			<?php while ($ver = mysqli_fetch_array($resrol)) {
				if($row["ROL_CODIGO"] == $ver["ROL_CODIGO"]){
					echo '<option value="'.$ver["ROL_CODIGO"].'" selected>'.$ver["ROL_NOMBRE"].'</option>';
				} else{
					echo '<option value="'.$ver["ROL_CODIGO"].'">'.$ver["ROL_NOMBRE"].'</option>';
				}
			}
			?>
		</select></div>	
		<div class="row formulario__grupo" id="grupo__user"><p><label for="user" class="formulario__label">Usuario </label></p>
		<input type="text" class="formulario__input" value="<?php echo $row[ "USU_USER" ]; ?>" name="user" id="iduser" required placeholder="Ingrese el usuario">
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Puede ingresar caracteres alfa-numéricos y algunos especiales (/ * # - .)</p></div>
		
		<div class="row formulario__grupo" id="grupo__clave"><p><label for="clave" class="formulario__label">Contraseña </label></p>
		<input type="text" class="formulario__input" value="<?php echo $row[ "USU_CLAVE" ]; ?>" name="clave" id="idclave" required placeholder="Ingrese la clave">
		<i class="formulario__validacion-estado fas fa-times-circle"></i>
		<p class="formulario__input-error"><i class="fas fa-exclamation-circle"></i> Debe ingresar al menos una mayúscula, una minúscula y un número</p></div>
		
		<?php
	}
	mysqli_free_result( $result );
	?>
	</div>
	<div class="opciones">
		<input type="submit" value="Actualizar">
		<a href="editar_usuarios.php" id="idcancelar"><button type="button" value="cancelar">Cancelar</button></a>	
	</div>
	</form>
		
	</div>
</div>
<script src="../js/validaciones_modificar.js"></script>
</body>
</html>