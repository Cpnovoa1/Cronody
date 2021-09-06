<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<?php
	//declarar variables
	$paralelo = $_POST[ 'nombre' ];
	$curso = $_POST[ 'apellido' ];
	$nivel = $_POST[ 'nivel' ];

	$nombreServidor = "localhost";
	$nombreUsuario = "admin";
	$passwordBaseDeDatos = "admin";
	$nombreBaseDeDatos = "horarios";

	$conn = new mysqli( $nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos );

	if ( $conn->connect_error ) {
		die( "Connection failed: " . $conn->connect_error );
	}
	$query = "INSERT INTO paralelo(aul_nombre, aul_curso, niv_codigo, aul_estado) VALUES ('$paralelo','$curso','$nivel',1)";
	$resultado = mysqli_query( $conn, $query );
	if ( $resultado ) {
		echo '<script>window.alert("Los datos de Aula se han guardado con exito");
				window.location="../aula_form_ing.php";</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Aula');window.history.go(-1);</script>";
	}
	?>
</body>
</html>