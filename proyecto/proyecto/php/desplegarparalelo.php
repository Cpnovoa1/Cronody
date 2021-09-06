<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$curso=$_POST['curso'];
		
	//$sql="Select * From paralelo Where AUL_CURSO = '$curso' AND HOR_CODIGO IS NULL AND AUL_ESTADO=1 Order by AUL_NOMBRE";
	$sql="Select * From paralelo p, horarios h Where ((p.HOR_CODIGO=h.HOR_CODIGO and h.HOR_ESTADO = 0 ) or p.HOR_CODIGO is null) AND p.AUL_ESTADO=1 AND p.AUL_CURSO = '$curso' Group by p.AUL_CURSO, p.AUL_NOMBRE  Order by p.AUL_NOMBRE";

	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione un paralelo</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.$ver[2].'</option>';
	}

	echo  $cadena;
	

?>