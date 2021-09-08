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
	$direccion = $_POST[ 'adm_direccion' ];
	$telefono = $_POST[ 'adm_telefono' ];

	$fnacimiento = $_POST[ 'fnacimiento' ];
	//encriptado de clave
	$clave_encr = password_hash( $clave, PASSWORD_DEFAULT );

	$nombreServidor = "localhost";
	$nombreUsuario = "admin";
	$passwordBaseDeDatos = "admin";
	$nombreBaseDeDatos = "horarios";

	$conn = new mysqli( $nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos );

	if ( $conn->connect_error ) {
		die( "Connection failed: " . $conn->connect_error );
	}

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
		$query = "INSERT INTO usuario(usu_user, usu_clave, usu_estado, rol_codigo) VALUES ('$user','$clave_encr',1,1)";
		$resultado = mysqli_query( $conn, $query );
		if ( $resultado ) {
			$query_u = "Select * from usuario";
			$resultado_u = mysqli_query($conn,$query_u);
			while($row = mysqli_fetch_array($resultado_u)){
				$codigou = $row[0];
			}
			$query2 = "INSERT INTO administrador(USU_CODIGO, ADM_NOMBRE, ADM_APELLIDO, ADM_TELEFONO, ADM_CEDULA, ADM_FNACIMIENTO, ADM_DIRECCION, ADM_ESTADO) VALUES ('$codigou','$nombre','$apellido','$telefono','$cedula','$fnacimiento','$direccion',1)";
			$resultado2 = mysqli_query( $conn, $query2 );
			if ( $resultado2 ) {
				echo '<script>window.alert("Los datos de Administrador se han guardado con exito");
				window.location="../admin_form_ing.html";</script>';
			} else {
				echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
			}
		} else {
			echo "<script>window.alert('Error al ingresar los datos de Usuario');window.history.go(-1);</script>";
		}
	}else {
			echo "<script>window.alert('Error, $mensaje ya existe. Ingrese otro'); window.history.go(-1);</script>";
		}

	?>
</body>
</html>