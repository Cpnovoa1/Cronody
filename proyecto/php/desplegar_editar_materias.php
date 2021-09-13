<?php 
$conexion=mysqli_connect('localhost','admin','admin','horarios');
$materia=$_POST['materia'];
$id = $_POST['id'];

	$buscar = mysqli_query($conexion, "Select * From horarios_materias h, materias m Where m.MAT_CODIGO = h.MAT_CODIGO AND h.HMA_CODIGO = '$id'");
	while($row=mysqli_fetch_row($buscar)) {
		$mate = $row[9];
	}

	$sql1="Select * From materias Where MAT_CODIGO = '$materia' AND MAT_ESTADO=1";
	$result1=mysqli_query($conexion,$sql1);
	while($row=mysqli_fetch_array($result1)){
		if($row["MAT_CODIGO"] == $materia){
			$nivel = $row["NIV_CODIGO"];
			$mat = $row["MAT_AREA"];
		}
	}
	
	$sql="Select * From materias Where MAT_AREA = '$mat' AND NIV_CODIGO = '$nivel' AND MAT_ESTADO=1 Group by MAT_AREA, MAT_NOMBRE  Order by MAT_NOMBRE";

	$result=mysqli_query($conexion,$sql);

	$cadena="<option value=''>Seleccione una materia</option>";

	while ($ver=mysqli_fetch_row($result)) {
		//if($mate == $ver[2]){$cadena=$cadena.'<option value="'.$ver[0].'" selected>'.$ver[2].'</option>';}
		//else {$cadena=$cadena.'<option value="'.$ver[0].'">'.$ver[2].'</option>';}
		$cadena=$cadena.'<option value="'.$ver[0].'">'.$ver[2].'</option>';
	}

	echo  $cadena;
	

?>