<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_GET['u'];

$consultar = "SELECT * FROM docente WHERE DOC_CODIGO='$id'";
$result = mysqli_query( $conn, $consultar );

while($row = mysqli_fetch_array($result)){
	$estado = $row["DOC_ESTADO"];
	$usu = $row["USU_CODIGO"];
}

if($estado == '1'){
	$estado = '0';
	$msj = 'eliminado';
} else {
	$estado = '1';
	$msj = 'activado';
}

$eliminar = "UPDATE docente SET DOC_ESTADO='$estado' WHERE DOC_CODIGO='$id'";
$result2 = mysqli_query( $conn, $eliminar );
$eliminaru = "UPDATE usuario SET USU_ESTADO='$estado' WHERE USU_CODIGO='$usu'";
$resultu = mysqli_query( $conn, $eliminaru );

if($result2 && $resultu){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="editar_docente.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al eliminar");
			window.history.go(-1);
		</script>';
}
?>
	