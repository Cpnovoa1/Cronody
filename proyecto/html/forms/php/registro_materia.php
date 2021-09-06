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
	$area = $_POST[ 'apellido' ];
	$m_carga = $_POST[ 'm_carga' ];
	$nivel = $_POST['nivel'];
	
	$nombreServidor = "localhost";
	$nombreUsuario = "admin";
	$passwordBaseDeDatos = "admin";
	$nombreBaseDeDatos = "horarios";

	$conn = new mysqli( $nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos );

	if ( $conn->connect_error ) {
		die( "Connection failed: " . $conn->connect_error );
	}
	$query = "INSERT INTO materias(mat_nombre, mat_area, mat_cargahoraria, niv_codigo,mat_estado) VALUES ('$nombre','$area','$m_carga','$nivel',1)";
	$resultado = mysqli_query( $conn, $query );
	if ( $resultado ) {
		echo '<script>window.alert("Los datos de Materia se han guardado con exito");
				window.location="../materia_form_ing.php";</script>';
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Materia');window.history.go(-1);</script>";
	}
	?>
</body>
</html>