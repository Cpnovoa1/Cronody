<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro</title>
</head>

<body>
	<?php
	$mensaje = "";//Mensaje si se repite cedula o usuario
	//declarar variables
	$nombre = $_POST[ 'nombre' ]; //recoger los datos del formulario enviado por POST - del arreglo POST seleccionamos el dato
	$user = $_POST[ 'nombreusuario' ];
	$clave = $_POST[ 'claveusuario' ];
	$apellido = $_POST[ 'apellido' ];
	$cedula = $_POST[ 'cedula' ];
	$ecivil = $_POST[ 'ecivil' ];
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
		switch ( $ecivil ) {
			case 'Administrador':
				$direccion = $_POST[ 'adm_direccion' ];
				$telefono = $_POST[ 'adm_telefono' ];
				$query = "INSERT INTO usuario(usu_user, usu_clave, usu_estado, rol_codigo) VALUES ('$user','$clave_encr',1,1)";
				$resultado = mysqli_query( $conn, $query );
				if ( $resultado ) {
					$query_u = "Select * from usuario";
					$resultado_u = mysqli_query( $conn, $query_u );
					while ( $row = mysqli_fetch_array( $resultado_u ) ) {
						$codigou = $row[ 0 ];
					}
					$query2 = "INSERT INTO administrador(USU_CODIGO, ADM_NOMBRE, ADM_APELLIDO, ADM_TELEFONO, ADM_CEDULA, ADM_FNACIMIENTO, ADM_DIRECCION, ADM_ESTADO) VALUES ('$codigou','$nombre','$apellido','$telefono','$cedula','$fnacimiento','$direccion',1)";
					$resultado2 = mysqli_query( $conn, $query2 );
					if ( $resultado2 ) {
						echo '<script>window.alert("Los datos de Administrador se han guardado exitosamente");
				window.location="../usuario_form_ing.php";</script>';
					} else {
						echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
					}
				} else {
					echo "<script>window.alert('Error al ingresar los datos de Usuario');window.history.go(-1);</script>";
				}
				break;
			case 'Supervisor':
				$direccion = $_POST[ 'sup_direccion' ];
				$telefono = $_POST[ 'sup_telefono' ];
				$query = "INSERT INTO usuario(usu_user, usu_clave, usu_estado, rol_codigo) VALUES ('$user','$clave_encr',1,2)";
				$resultado = mysqli_query( $conn, $query );
				if ( $resultado ) {
					$query_u = "Select * from usuario";
					$resultado_u = mysqli_query( $conn, $query_u );
					while ( $row = mysqli_fetch_array( $resultado_u ) ) {
						$codigou = $row[ 0 ];
					}
					$query2 = "INSERT INTO supervisor(USU_CODIGO, SUP_NOMBRE , SUP_APELLIDO, SUP_TELEFONO , SUP_CEDULA, SUP_FNACIMIENTO , SUP_DIRECCION , SUP_ESTADO ) VALUES ('$codigou','$nombre','$apellido','$telefono','$cedula','$fnacimiento','$direccion',1)";
					$resultado2 = mysqli_query( $conn, $query2 );
					if ( $resultado2 ) {
						echo '<script>window.alert("Los datos de Supervisor se han guardado exitosamente");
						window.location="../usuario_form_ing.php";</script>';
					} else {
						echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
					}
				} else {
					echo "<script>window.alert('Error al ingresar los datos de Usuario');window.history.go(-1);</script>";
				}
				break;
			case 'Docente':
				$direccion = $_POST[ 'doc_direccion' ];
				$telefono = $_POST[ 'doc_telefono' ];
				$carga = 30;//Carga horaria obligatoria por el ministerio de educacion
				$query = "INSERT INTO usuario(usu_user, usu_clave, usu_estado, rol_codigo) VALUES ('$user','$clave_encr',1,3)";
				$resultado = mysqli_query( $conn, $query );
				if ( $resultado ) {
					$query_u = "Select * from usuario";
					$resultado_u = mysqli_query( $conn, $query_u );
					while ( $row = mysqli_fetch_array( $resultado_u ) ) {
						$codigou = $row[ 0 ];
					}
					$query2 = "INSERT INTO docente(USU_CODIGO, DOC_NOMBRE, DOC_APELLIDO, DOC_TELEFONO, DOC_CEDULA, DOC_FNACIMIENTO, DOC_DIRECCION, DOC_CARGAHORARIA ,DOC_ESTADO) VALUES ('$codigou','$nombre','$apellido','$telefono','$cedula','$fnacimiento','$direccion','$carga',1)";
					$resultado2 = mysqli_query( $conn, $query2 );
					if ( $resultado2 ) {
						echo '<script>window.alert("Los datos de Docente se han guardado exitosamente");
				window.location="../usuario_form_ing.php";</script>';
					} else {
						echo "<script>window.alert('Error al ingresar los datos de Administador');window.history.go(-1);</script>";
					}
				} else {
					echo "<script>window.alert('Error al ingresar los datos de Usuario');window.history.go(-1);</script>";
				}
				break;
			case 'Alumno':
				$direccion = $_POST[ 'alu_direccion' ];
				$telefono = $_POST[ 'alu_telefono' ];
				$email = $_POST[ 'alu_email' ];
				$aula = $_POST[ 'aula' ];
				$query = "INSERT INTO usuario(usu_user, usu_clave, usu_estado, rol_codigo) VALUES ('$user','$clave_encr',1,4)";
				$resultado = mysqli_query( $conn, $query );
				if ( $resultado ) {
					$query_u = "Select * from usuario";
					$resultado_u = mysqli_query( $conn, $query_u );
					while ( $row = mysqli_fetch_array( $resultado_u ) ) {
						$codigou = $row[ 0 ];
					}

					$query2 = "INSERT INTO alumno(AUL_CODIGO ,USU_CODIGO, ALU_NOMBRE , ALU_APELLIDO ,ALU_EMAIL , ALU_TELEFONO, ALU_CEDULA, ALU_FNACIMIENTO, ALU_DIRECCION, ALU_ESTADO) VALUES ('$aula','$codigou','$nombre','$apellido','$email','$telefono','$cedula','$fnacimiento','$direccion',1)";
					$resultado2 = mysqli_query( $conn, $query2 );
					if ( $resultado2 ) {
						echo '<script>window.alert("Los datos de Alumno se han guardado exitosamente");
						window.location="../usuario_form_ing.php";</script>';
					} else {
						echo "<script>window.alert('Error al ingresar los datos de Alumno');window.history.go(-1);</script>";
					}
				} else {
					echo "<script>window.alert('Error al ingresar los datos de Usuario');window.history.go(-1);</script>";
				}
				break;
			default:
				echo "<script>window.alert('Algo salio mal');window.history.go(-1);</script>";
		}
	} else {
		echo "<script>window.alert('Error, $mensaje ya existe. Ingrese otro'); window.history.go(-1);</script>";
	}

	?>
</body>
</html>