<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_GET['u'];

$consultar = "SELECT * FROM horarios_materias WHERE HMA_CODIGO='$id'";

$result = mysqli_query( $conn, $consultar );
$result3 = mysqli_query( $conn, $consultar2 );
$myIP=getRealIP();

while($row = mysqli_fetch_array($result )){
	$estado = $row["HMA_ESTADO"];
	
}

if($estado == '1'){
	$estado = '0';
	$horariocodigo=NULL;
	$msj = 'eliminado';
} else {
	$estado = '1';
	$msj = 'activado';
}

$eliminar = "UPDATE horarios_materias SET HMA_ESTADO='$estado' WHERE HMA_CODIGO='$id'";

$result2 = mysqli_query( $conn, $eliminar);


if($result2){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="modificarHorairo.php";
		</script>';
	$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Eliminó materia de horario',curTime(),CURDATE())");
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