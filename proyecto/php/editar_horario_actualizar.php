<?php

include("validarDatos.php");

$conn = new mysqli( "localhost", "admin", "admin", "horarios" );

$id = $_POST['id'];
$mat = $_POST['mat'];
$doc = $_POST['doc'];
$dia = $_POST['dia'];
$hora = $_POST['hora'];
$horario = $_POST['horario'];

$horaIni = substr($hora,0,8);
$horaFin = substr($hora,11,8);

$validacion = verificarDatos($doc,$mat,$horario,$horaIni,$horaFin,$dia,$id);

if($validacion == '1'){
	$buscar = mysqli_query($conn, "Select MAT_CODIGO From materias m, docente d Where m.DOC_CODIGO = d.DOC_CODIGO AND m.MAT_NOMBRE in (
									Select MAT_NOMBRE From materias Where MAT_CODIGO = '$mat') AND m.MAT_AREA in (
									Select MAT_AREA From materias Where MAT_CODIGO = '$mat') AND m.NIV_CODIGO in (
									Select NIV_CODIGO From materias Where MAT_CODIGO = '$mat') AND d.DOC_CODIGO = '$doc'");
	while($row = mysqli_fetch_array($buscar)){
		$materia = $row[0];
	}
	
	$actualizar = "UPDATE horarios_materias SET HOR_CODIGO='$horario', MAT_CODIGO='$materia', DIA_CODIGO='$dia', HMA_HORAINICIO='$horaIni', HMA_HORAFIN='$horaFin' WHERE HMA_CODIGO='$id' ";
	$result2 = mysqli_query( $conn, $actualizar );
	$myIP=getRealIP();
	if($result2){
		echo '<script>
				alert("Los datos se han actualizado correctamente");
				window.location="modificarHorairo.php";
			</script>';
		$auditoria = mysqli_query( $conn,"INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Modificó horario',curTime(),CURDATE())");
	} else{
		echo '<script>
				alert("Hubo un error al guardar");
				window.history.go(-1);
			</script>';
	}
} else if($validacion == '0'){
	echo '<script>
			alert("No ingresó todos los datos id: '.$id.' mat: '.$mat.' doc: '.$doc.' dia: '.$dia.' hora: '.$hora.' horaIni: '.$horaIni.' horaFin: '.$horaFin.' horario: '.$horario.'");
			window.history.go(-1);
		</script>';
} else if($validacion == '2'){
	echo '<script>
			alert("El docente ya no está disponible");
			window.history.go(-1);
		</script>';
} else if($validacion == '3'){
	echo '<script>
			alert("Ya se cumplió el total de horas pedagógicas de esa materia");
			window.history.go(-1);
		</script>';
} else if($validacion == '4'){
	echo '<script>
			alert("El docente ya imparte una materia ese día a esa hora");
			window.history.go(-1);
		</script>';
} else if($validacion == '5'){
	echo '<script>
			alert("No puede colocar más de 2 horas por día de una misma materia");
			window.history.go(-1);
		</script>';
} else if($validacion == '6'){
	echo '<script>
			alert("Ya existe una materia ese dia a esa hora");
			window.history.go(-1);
		</script>';
}

/*$conn = new mysqli( "localhost", "admin", "admin", "horarios" );
	$actualizar = "UPDATE horarios_materias SET HOR_CODIGO='$horario', MAT_CODIGO='$mat', DIA_CODIGO='$dia', HMA_HORAINICIO='$horaIni', HMA_HORAFIN='$horaFin' WHERE HMA_CODIGO='$id' ";
	$result2 = mysqli_query( $conn, $actualizar );
	$myIP=getRealIP();
	if($result2){
		echo '<script>
				alert("Los datos se han actualizado correctamente");
				window.location="modificarHorairo.php";
			</script>';
		$auditoria = mysqli_query( $conn,"INSERT INTO `auditoria`(`USU_CODIGO`, `AUD_IP`, `AUD_EVENTO`, `AUD_HORA`, `AUD_FECHA`) VALUES (1,'$myIP','Modificó horario',curTime(),CURDATE())");
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
	}*/	

function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];


	return $_SERVER['REMOTE_ADDR'];
}
?>
	