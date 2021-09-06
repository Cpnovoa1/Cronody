<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$curso = $_POST['curso'];
$paralelo = $_POST['paralelo'];
$nivel = $_POST['nivel'];

$paral = mb_strtoupper($paralelo, 'UTF-8');

$r=true;
$repetidos = "Select * From paralelo Where AUL_CODIGO<>'$ide'";
$result = mysqli_query( $conn, $repetidos );
$myIP=getRealIP();
while($row = mysqli_fetch_array($result)){
	if($curso == $row['AUL_CURSO'] && $paral == $row['AUL_NOMBRE'] && $nivel == $row['NIV_CODIGO']){
		echo '<script>alert("El registro ingresado ya existe!");</script>';
		$r=false;
	}
}

if($r){$actualizar = "UPDATE paralelo SET AUL_NOMBRE='$paral', AUL_CURSO='$curso', NIV_CODIGO='$nivel' WHERE AUL_CODIGO='$ide' ";
$result2 = mysqli_query( $conn, $actualizar );}

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_aulas.php";
		</script>';
	$auditoria = mysqli_query( $conn,"INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Actualizo Aula',curTime(),CURDATE())");
} else{
	echo '<script>
			alert("Hubo un error al guardar");
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
	