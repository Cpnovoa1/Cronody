<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<?php
	//declarar variables
	$mensaje = "";//Mensaje si se repite cedula o usuario
	$nombre = $_POST[ 'nombre' ]; 
	$apellido = $_POST[ 'apellido' ];
	$user = $_POST[ 'nombreusuario' ];
	$clave = $_POST[ 'claveusuario' ];
	$cedula = $_POST[ 'cedula' ];
	
	$direccion = $_POST[ 'alu_direccion' ];
	$telefono = $_POST[ 'alu_telefono' ];
	$email = $_POST['alu_email'];
	$aula = $_POST['aula'];
	
	$fnacimiento = $_POST[ 'fnacimiento' ];
	//encriptado de clave
	$clave_encr = password_hash( $clave, PASSWORD_DEFAULT );

	$nombreServidor = "localhost";
	$nombreUsuario = "admin";
	$passwordBaseDeDatos = "admin";
	$nombreBaseDeDatos = "horarios";
	$myIP=getRealIP();
	$conn = new mysqli( $nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos );

	if ( $conn->connect_error ) {
		die( "Connection failed: " . $conn->connect_error );
	}

	
	session_start();
	$user_session = $_SESSION['user'];
	$repetido = 0;
	$query_rep1 = "Select u.USU_USER, a.ADM_CEDULA, s.SUP_CEDULA, d.DOC_CEDULA, al.ALU_CEDULA From administrador a, supervisor s, docente d, alumno al, usuario u";
	
	$result_rep = mysqli_query( $conn, $query_rep1 );
	while ( $row = mysqli_fetch_array( $result_rep ) ) {
		if ( $user == $row[ "USU_USER" ]) {
			$repetido = 1;
			$mensaje .= "nombre de usuario";
			break;
		}
	}
	$result_rep = mysqli_query( $conn, $query_rep1 );
	while ( $row = mysqli_fetch_array( $result_rep ) ) {
		if ( $cedula == $row[ "ADM_CEDULA" ] || $cedula == $row[ "SUP_CEDULA" ]|| $cedula == $row[ "DOC_CEDULA" ] || $cedula == $row[ "DOC_CEDULA" ]) {
			if($repetido == 1){$mensaje .= " y ";}
			$repetido = 1;
			$mensaje .= "cédula";
			break;
		}
	}
	if ( $repetido == 0 ) {
		$query = "INSERT INTO usuario(usu_user, usu_clave, usu_estado, rol_codigo) VALUES ('$user','$clave_encr',1,4)";
		$resultado = mysqli_query( $conn, $query );
		if ( $resultado ) {
			$query_u = "Select * from usuario";
			$resultado_u = mysqli_query($conn,$query_u);
			while($row = mysqli_fetch_array($resultado_u)){
				$codigou = $row[0];
			}
			
			$query2 = "INSERT INTO alumno(AUL_CODIGO ,USU_CODIGO, ALU_NOMBRE , ALU_APELLIDO ,ALU_EMAIL , ALU_TELEFONO, ALU_CEDULA, ALU_FNACIMIENTO, ALU_DIRECCION, ALU_ESTADO) VALUES ('$aula','$codigou','$nombre','$apellido','$email','$telefono','$cedula','$fnacimiento','$direccion',1)";
			$resultado2 = mysqli_query( $conn, $query2 );
			if ( $resultado2 ) {
				echo '<script>window.alert("Los datos de Alumno se han guardado con exito");
				window.location="../alu_form_ing.php";</script>';
				
				$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES ($user_session,'$myIP','Agrego usuario: $user Tipo: Alumno',curTime(),CURDATE())");
			} else {
				echo "<script>window.alert('Error al ingresar los datos de Alumno');window.history.go(-1);</script>";
			}
		} else {
			echo "<script>window.alert('Error al ingresar los datos de Usuario');window.history.go(-1);</script>";
		}
	}else {
			echo "<script>window.alert('Error, $mensaje ya existe. Ingrese otro'); window.history.go(-1);</script>";
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