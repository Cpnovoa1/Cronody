<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$fnac = $_POST['fnac'];
$direccion = $_POST['direccion'];

$actualizar = "UPDATE administrador SET ADM_NOMBRE='$nombre', ADM_APELLIDO='$apellido', ADM_TELEFONO='$telefono', ADM_FNACIMIENTO='$fnac', ADM_DIRECCION='$direccion'  WHERE ADM_CODIGO='$ide' ";
$result2 = mysqli_query( $conn, $actualizar );
$myIP=getRealIP();
if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_admin.php";
		</script>';
	$auditoria = mysqli_query( $conn,"INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Actualizo Administrador',curTime(),CURDATE())");
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
	