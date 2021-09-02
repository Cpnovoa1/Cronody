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

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_admin.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al guardar");
			window.history.go(-1);
		</script>';
}
?>
	