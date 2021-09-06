<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_GET['u'];

$consultar = "SELECT * FROM horarios WHERE HOR_CODIGO='$id'";

$result = mysqli_query( $conn, $consultar );
$result3 = mysqli_query( $conn, $consultar2 );
$myIP=getRealIP();

while($row = mysqli_fetch_array($result )){
	$estado = $row["HOR_ESTADO"];
	
}

if($estado == '1'){
	$estado = '0';
	$horariocodigo=NULL;
	$msj = 'eliminado';
} else {
	$estado = '1';
	$msj = 'activado';
}

$eliminar = "UPDATE horarios SET HOR_ESTADO='$estado' WHERE HOR_CODIGO='$id'";
$eliminar2 = "UPDATE paralelo SET HOR_CODIGO='0' WHERE AUL_CURSO='1ro BGU'";

$result2 = mysqli_query( $conn, $eliminar);


if($result2){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="editar_horario.php";
		</script>';
	$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Modifico Estado Docente',curTime(),CURDATE())");
} else{
	echo '<script>
			alert("Hubo un error al eliminar");
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