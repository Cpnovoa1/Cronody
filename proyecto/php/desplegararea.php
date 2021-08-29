<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$paralelo=$_POST['paralelo'];
		
	$sql1="Select * From paralelo Where AUL_CODIGO = '$paralelo' AND AUL_ESTADO=1";
	$result1=mysqli_query($conexion,$sql1);
	while($row=mysqli_fetch_array($result1)){
		if($row["AUL_CODIGO"] == $paralelo){$nivel = $row["NIV_CODIGO"];}
	}

	$sql="Select * From materias Where NIV_CODIGO = '$nivel' AND MAT_ESTADO=1 Group by MAT_AREA  Order by MAT_AREA";
	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione un área</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.$ver[3].'</option>';
	}

	echo  $cadena;
	

?>