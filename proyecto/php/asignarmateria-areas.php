<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$nivel=$_POST['nivel'];

	$sql="Select * From materias Where NIV_CODIGO = '$nivel' AND MAT_ESTADO=1 Group by MAT_AREA  Order by MAT_AREA";
	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione un área</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.$ver[3].'</option>';
	}

	echo  $cadena;
	

?>