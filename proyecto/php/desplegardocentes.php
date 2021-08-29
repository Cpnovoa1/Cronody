<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$docente=$_POST['docente'];
	
	$sql="Select * From docente Where DOC_CODIGO = 
			Any (Select DOC_CODIGO From materias Where NIV_CODIGO 
			IN (Select NIV_CODIGO From materias Where MAT_CODIGO = '$docente') AND MAT_NOMBRE 
			IN (Select MAT_NOMBRE From materias Where MAT_CODIGO = '$docente'))";

	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione un docente</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.$ver[2].' '.$ver[3].'</option>';
	}

	echo  $cadena;
	

?>