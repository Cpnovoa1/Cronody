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
	
	session_start();
	$user_session = $_SESSION['user'];
	$myIP=getRealIP();
	$query = "INSERT INTO nivel(niv_nombre, niv_subnivel, niv_estado) VALUES ('$nombre','$subnivel',1)";
	$resultado = mysqli_query( $conn, $query );
	if ( $resultado ) {
		echo '<script>window.alert("Los datos de Nivel se han guardado con exito");
				window.location="../nivel_form_ing.html";</script>';
		$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES ($user_session,'$myIP','Agrego Nivel: $subnivel $nombre',curTime(),CURDATE())");
	} else {
		echo "<script>window.alert('Error al ingresar los datos de Nivel');window.history.go(-1);</script>";
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