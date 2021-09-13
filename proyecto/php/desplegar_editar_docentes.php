<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$docente=$_POST['docente'];
$id = $_POST['id'];

	$buscar = mysqli_query($conexion, "Select * From horarios_materias h, materias m, docente d Where m.MAT_CODIGO = h.MAT_CODIGO AND d.DOC_CODIGO = m.DOC_CODIGO AND h.HMA_CODIGO = '$id'");
	while($row=mysqli_fetch_row($buscar)) {
		$doc = $row[8];
	}
	
	$sql="Select * From docente Where DOC_CODIGO = 
			Any (Select DOC_CODIGO From materias Where NIV_CODIGO 
			IN (Select NIV_CODIGO From materias Where MAT_CODIGO = '$docente') AND MAT_NOMBRE 
			IN (Select MAT_NOMBRE From materias Where MAT_CODIGO = '$docente')) AND DOC_ESTADO = 1";

	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione un docente</option>";

	while ($ver=mysqli_fetch_row($result)) {
		//if($doc == $ver[0]){$cadena=$cadena.'<option value="'.$ver[0].'" selected>'.$ver[2].' '.$ver[3].'</option>';}
		//else {$cadena=$cadena.'<option value="'.$ver[0].'">'.$ver[2].' '.$ver[3].'</option>';}
		$cadena=$cadena.'<option value="'.$ver[0].'">'.$ver[2].' '.$ver[3].'</option>';
	}

	echo  $cadena;
	

?>