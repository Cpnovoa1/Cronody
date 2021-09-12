<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$rol = $_POST['rol'];
$user = $_POST['user'];
$clave = $_POST['clave'];

//Consulta para la comprobacion de la modificacion de contraseña
$consulta = mysqli_query($conn,"SELECT * from usuario where usu_user='$user'");
$row = mysqli_fetch_array( $consulta);
if($row[3] != $clave){
	//Encriptado de datos
	$encr_clave = password_hash($clave, PASSWORD_DEFAULT);
	$clave = $encr_clave;
}

$r=true;
$repetidos = "Select * From usuario Where usu_codigo<>'$ide'";
$result = mysqli_query( $conn, $repetidos );
while($row = mysqli_fetch_array($result)){
	if($user == $row['USU_USER']){
		echo '<script>alert("El usuario ingresado ya existe!");</script>';
		$r=false;
	}
}

$myIP=getRealIP();
session_start();
$user_session = $_SESSION['user'];

if($r){$actualizar = "UPDATE usuario SET ROL_CODIGO='$rol', USU_USER='$user', USU_CLAVE='$clave' WHERE USU_CODIGO='$ide'";
$result2 = mysqli_query( $conn, $actualizar );}

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_usuarios.php";
		</script>';
	$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES ($user_session,'$myIP','Actualizo Registro',curTime(),CURDATE())");
} else{
	echo '<script>
			alert("Hubo un error al guardar");
			window.history.go(-1);
		</script>';
}

function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];


	return $_SERVER['REMOTE_ADDR'];
}	

?>
	