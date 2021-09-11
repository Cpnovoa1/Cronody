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
	
	$myIP=getRealIP();
	$query = "INSERT INTO materias(mat_nombre, mat_area, mat_cargahoraria, niv_codigo,mat_estado) VALUES ('$nombre','$area','$m_carga','$nivel',1)";
	$resultado = mysqli_query( $conn, $query );
	if ( $resultado ) {
		echo '<script>window.alert("Los datos de Materia se han guardado con exito");
				window.location="../materia_form_ing.php";</script>';
		
		$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Asigno Materia $nombre',curTime(),CURDATE())");
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Materia');window.history.go(-1);</script>";
	}
	
	function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];


		return $_SERVER['REMOTE_ADDR'];
	}	
	?>
</body>
</html>