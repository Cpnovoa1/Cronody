<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_GET['u'];

$consultar = "SELECT * FROM paralelo WHERE AUL_CODIGO='$id'";
$result = mysqli_query( $conn, $consultar );

while($row = mysqli_fetch_array($result)){
	$estado = $row["AUL_ESTADO"];
}

if($estado == '1'){
	$estado = '0';
	$msj = 'eliminado';
} else {
	$estado = '1';
	$msj = 'activado';
}

$eliminar = "UPDATE paralelo SET AUL_ESTADO='$estado' WHERE AUL_CODIGO='$id'";
$result2 = mysqli_query( $conn, $eliminar );

if($result2){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="editar_aulas.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al eliminar");
			window.history.go(-1);
		</script>';
}
?>
	