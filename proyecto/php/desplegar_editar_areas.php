<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$nivel=$_POST['nivel'];
$id = $_POST['id'];

	$buscar = mysqli_query($conexion, "Select * From horarios_materias h, materias m Where m.MAT_CODIGO = h.MAT_CODIGO AND h.HMA_CODIGO = '$id'");
	while($row=mysqli_fetch_row($buscar)) {
		$area = $row[10];
	}

	$sql="Select * From materias Where NIV_CODIGO = '$nivel' AND MAT_ESTADO=1 Group by MAT_AREA  Order by MAT_AREA";
	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione un área</option>";

	while ($ver=mysqli_fetch_row($result)) {
		//if($area == $ver[3]){$cadena=$cadena.'<option value="'.$ver[0].'" selected>'.$ver[3].'</option>';}
		//else {$cadena=$cadena.'<option value="'.$ver[0].'">'.$ver[3].'</option>';}
		$cadena=$cadena.'<option value="'.$ver[0].'">'.$ver[3].'</option>';
	}

	echo  $cadena;
	

?>