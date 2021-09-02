<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$rol = $_POST['rol'];
$user = $_POST['user'];
$clave = $_POST['clave'];

//Consulta para la comprobacion de la modificacion de contraseña
$consulta = mysqli_query($conn,"SELECT * from usuario where usu_user='$user'");
$row = mysqli_fetch_array( $consulta);
if($row[3] != $clave){
	//Encriptado de datos
	$encr_clave = password_hash($clave, PASSWORD_DEFAULT);
	$clave = $encr_clave;
}

$r=true;
$repetidos = "Select * From usuario Where usu_codigo<>'$ide'";
$result = mysqli_query( $conn, $repetidos );
while($row = mysqli_fetch_array($result)){
	if($user == $row['USU_USER']){
		echo '<script>alert("El usuario ingresado ya existe!");</script>';
		$r=false;
	}
}

if($r){$actualizar = "UPDATE usuario SET ROL_CODIGO='$rol', USU_USER='$user', USU_CLAVE='$clave' WHERE USU_CODIGO='$ide'";
$result2 = mysqli_query( $conn, $actualizar );}

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_usuarios.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al guardar");
			window.history.go(-1);
		</script>';
}
?>
	