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
} else{
	echo '<script>
			alert("Hubo un error al guardar");
			window.history.go(-1);
		</script>';
}
?>
	