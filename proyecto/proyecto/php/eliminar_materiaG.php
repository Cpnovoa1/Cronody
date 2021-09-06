<?php
$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_GET['u'];
$e = $_GET['e'];

if($e == '1'){
	$e = '0';
	$msj = 'eliminado';
} else {
	$e = '1';
	$msj = 'activado';
}


$cont = "select * from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.doc_codigo is null) and m.niv_codigo=n.niv_codigo and m.MAT_CODIGO IN 
			(Select MAT_CODIGO from materias where 
				MAT_NOMBRE = (Select MAT_NOMBRE From materias where MAT_CODIGO='$id') AND
				MAT_AREA = (Select MAT_AREA From materias where MAT_CODIGO='$id') AND
				NIV_CODIGO = (Select NIV_CODIGO From materias where MAT_CODIGO='$id') 
			) 
			order by mat_nombre";
$contad = mysqli_query( $conn, $cont );
while($row = mysqli_fetch_array($contad)){
		$id = $row['MAT_CODIGO'];
		$actualizar = "UPDATE materias SET MAT_ESTADO='$e' WHERE MAT_CODIGO='$id'";
		$result2 = mysqli_query( $conn, $actualizar );
}

if($result2){
	echo '<script> 
			alert("Registro '.$msj.' correctamente");
			window.location="editar_materia.php";
		</script>';
} else{
	echo '<script>
			alert("Hubo un error al eliminar");
			window.history.go(-1);
		</script>';
}
?>
	