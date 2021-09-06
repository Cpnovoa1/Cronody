<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_GET['u'];

$consultar = "SELECT * FROM administrador WHERE ADM_CODIGO='$id'";
$result = mysqli_query( $conn, $consultar );

while($row = mysqli_fetch_array($result)){
	$estado = $row["ADM_ESTADO"];
	$usu = $row["USU_CODIGO"];
}

if($estado == '1'){
	$estado = '0';
	$msj = 'eliminado';
} else {
	$estado = '1';
	$msj = 'activado';
}

$eliminar = "UPDATE administrador SET ADM_ESTADO='$estado' WHERE ADM_CODIGO='$id'";
$result2 = mysqli_query( $conn, $eliminar );
$eliminaru = "UPDATE usuario SET USU_ESTADO='$estado' WHERE USU_CODIGO='$usu'";
$resultu = mysqli_query( $conn, $eliminaru );

$myIP=getRealIP();

if($result2 && $resultu){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="editar_admin.php";
		</script>';
	$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Modifico Estado Administrador',curTime(),CURDATE())");
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
	