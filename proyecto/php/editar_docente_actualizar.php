<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$fnac = $_POST['fnac'];
$direccion = $_POST['direccion'];

$actualizar = "UPDATE docente SET DOC_NOMBRE='$nombre', DOC_APELLIDO='$apellido', DOC_TELEFONO='$telefono', DOC_FNACIMIENTO='$fnac', DOC_DIRECCION='$direccion'  WHERE DOC_CODIGO='$ide' ";
$result2 = mysqli_query( $conn, $actualizar );
$myIP=getRealIP();

session_start();
$user_session = $_SESSION['user'];

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_docente.php";
		</script>';
	$auditoria = mysqli_query( $conn,"INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES ($user_session,'$myIP','Actualizo Docente',curTime(),CURDATE())");
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
	