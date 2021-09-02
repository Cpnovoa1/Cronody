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

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_docente.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al guardar");
			window.history.go(-1);
		</script>';
}
?>
	