<?php

$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$ide = $_POST['ide'];
$materia = $_POST['materia'];
$area = $_POST['area'];
$nivel = $_POST['nivel'];
$horas = $_POST['horas'];

$r=true;
$repetidos = "select * from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.doc_codigo is null) and m.niv_codigo=n.niv_codigo and m.MAT_CODIGO <> 
				all(Select MAT_CODIGO from materias where 
					MAT_NOMBRE = (Select MAT_NOMBRE From materias where MAT_CODIGO='$ide') AND
					MAT_AREA = (Select MAT_AREA From materias where MAT_CODIGO='$ide') AND
					NIV_CODIGO = (Select NIV_CODIGO From materias where MAT_CODIGO='$ide') 
				) 
				group by m.MAT_NOMBRE, m.NIV_CODIGO order by mat_nombre";
$result = mysqli_query( $conn, $repetidos );
while($row = mysqli_fetch_array($result)){
	if($materia == $row['MAT_NOMBRE'] && $area == $row['MAT_AREA'] && $nivel == $row['NIV_CODIGO']){
		echo '<script>alert("El registro ingresado ya existe!");</script>';
		$r=false;
	}
}

if($r){
	
	$cont = "select * from materias m, docente d, nivel n where (m.doc_codigo=d.doc_codigo or m.doc_codigo is null) and m.niv_codigo=n.niv_codigo and m.MAT_CODIGO IN 
				(Select MAT_CODIGO from materias where 
					MAT_NOMBRE = (Select MAT_NOMBRE From materias where MAT_CODIGO='$ide') AND
					MAT_AREA = (Select MAT_AREA From materias where MAT_CODIGO='$ide') AND
					NIV_CODIGO = (Select NIV_CODIGO From materias where MAT_CODIGO='$ide') 
				) 
				order by mat_nombre";
	$contad = mysqli_query( $conn, $cont );
	while($row = mysqli_fetch_array($contad)){
			$id = $row['MAT_CODIGO'];
			$actualizar = "UPDATE materias SET MAT_NOMBRE='$materia', MAT_AREA='$area', NIV_CODIGO='$nivel', MAT_CARGAHORARIA='$horas' WHERE MAT_CODIGO='$id'";
			$result2 = mysqli_query( $conn, $actualizar );
	}
	
}

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
	