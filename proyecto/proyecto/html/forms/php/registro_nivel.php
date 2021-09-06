<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<?php
	//declarar variables
	$nombre = $_POST[ 'nombre' ];
	$subnivel = $_POST[ 'apellido' ];
	$nombre = mb_strtoupper($nombre, 'UTF-8');
	$nnombre = mb_strtoupper($subnivel, 'UTF-8');
	$nombreServidor = "localhost";
	$nombreUsuario = "admin";
	$passwordBaseDeDatos = "admin";
	$nombreBaseDeDatos = "horarios";

	$conn = new mysqli( $nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos );

	if ( $conn->connect_error ) {
		die( "Connection failed: " . $conn->connect_error );
	}
	$query = "INSERT INTO nivel(niv_nombre, niv_subnivel, niv_estado) VALUES ('$nombre','$subnivel',1)";
	$resultado = mysqli_query( $conn, $query );
	if ( $resultado ) {
		echo '<script>window.alert("Los datos de Nivel se han guardado con exito");
				window.location="../nivel_form_ing.html";</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Nivel');window.history.go(-1);</script>";
	}
	?>
</body>
</html>