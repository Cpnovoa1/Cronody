<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_GET['u'];

$consultar = "SELECT * FROM alumno WHERE ALU_CODIGO='$id'";
$result = mysqli_query( $conn, $consultar );
$myIP=getRealIP();
while($row = mysqli_fetch_array($result)){
	$estado = $row["ALU_ESTADO"];
	$usu = $row["USU_CODIGO"];
}

if($estado == '1'){
	$estado = '0';
	$msj = 'eliminado';
} else {
	$estado = '1';
	$msj = 'activado';
}

$eliminar = "UPDATE alumno SET ALU_ESTADO='$estado' WHERE ALU_CODIGO='$id'";
$result2 = mysqli_query( $conn, $eliminar );
$eliminaru = "UPDATE usuario SET USU_ESTADO='$estado' WHERE USU_CODIGO='$usu'";
$resultu = mysqli_query( $conn, $eliminaru );

if($result2 && $resultu){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="editar_alumno.php";
		</script>';
	$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Modifico Estado Alumno',curTime(),CURDATE())");
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
	