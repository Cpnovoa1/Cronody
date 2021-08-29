<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
	$rol= $_SESSION['rol'];
	$user = $_SESSION['user'];
	$tabla = "";
	$incremento = 0;

	switch($rol){
		case 1:
			$sql="Select * From administrador Where USU_CODIGO = '$user'";
			break;
		case 2:
			$sql="Select * From supervisor Where USU_CODIGO = '$user'";
			break;
		case 3:
			$sql="Select * From docente Where USU_CODIGO = '$user'";
			break;
		case 4:
			$sql="Select * From alumno Where USU_CODIGO = '$user'";
			$incremento = 1;
			break;
	}

	$result=mysqli_query($conexion,$sql);

	$cadena="";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena = $cadena.$ver[2+$incremento].' '.$ver[3+$incremento];
	}
	

?>