<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$materia = $_POST['materia'];
$area = $_POST['area'];
$nivel = $_POST['nivel'];
$doc = $_POST['docente'];
$horas = $_POST['horas'];

$r=true;
$repetidos = "Select * From materias Where MAT_CODIGO<>'$ide'";
$result = mysqli_query( $conn, $repetidos );
$myIP=getRealIP();
while($row = mysqli_fetch_array($result)){
	if($materia == $row['MAT_NOMBRE'] && $area == $row['MAT_AREA'] && $nivel == $row['NIV_CODIGO'] && $doc == $row['DOC_CODIGO']){
		echo '<script>alert("El registro ingresado ya existe!");</script>';
		$r=false;
	}
}

if($r){$actualizar = "UPDATE materias SET MAT_NOMBRE='$materia', MAT_AREA='$area', NIV_CODIGO='$nivel', DOC_CODIGO='$doc', MAT_CARGAHORARIA='$horas' WHERE MAT_CODIGO='$ide' ";
$result2 = mysqli_query( $conn, $actualizar );}

if($result2){
	echo '<script>
			alert("Los datos se han actualizado correctamente");
			window.location="editar_materia.php";
		</script>';
	$auditoria = mysqli_query($conn, "INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Actualizo Materia',curTime(),CURDATE())");
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
	