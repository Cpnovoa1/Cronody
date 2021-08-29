<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$curso=$_POST['curso'];
		
	$sql="Select * From paralelo Where AUL_CURSO = '$curso' AND HOR_CODIGO IS NULL AND AUL_ESTADO=1 Order by AUL_NOMBRE";

	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione un paralelo</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.$ver[2].'</option>';
	}

	echo  $cadena;
	

?>