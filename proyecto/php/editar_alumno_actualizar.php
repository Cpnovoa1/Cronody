<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$fnac = $_POST['fnac'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$curso = $_POST['curso'];

$actualizar = "UPDATE alumno SET ALU_NOMBRE='$nombre', ALU_APELLIDO='$apellido', ALU_TELEFONO='$telefono', ALU_FNACIMIENTO='$fnac', ALU_DIRECCION='$direccion', ALU_EMAIL='$email', AUL_CODIGO='$curso'  WHERE ALU_CODIGO='$ide' ";
$result2 = mysqli_query( $conn, $actualizar );

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_alumno.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al guardar");
			window.history.go(-1);
		</script>';
}
?>
	