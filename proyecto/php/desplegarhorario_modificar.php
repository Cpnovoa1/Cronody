<?php 
$conn = new mysqli("localhost", "admin", "admin", "horarios");
if ($conn ->connect_error) {
	die("Connection failed: " . $conn ->connect_error);
}
$paralelo=$_POST['paralelo'];
	
$hor;
$sql="Select * From paralelo Where AUL_CODIGO = '$paralelo' AND AUL_ESTADO=1";
$result1=mysqli_query($conn,$sql);
while($row1=mysqli_fetch_array($result1)){
	if($row1["AUL_CODIGO"] == $paralelo){
		$nivel = $row1["NIV_CODIGO"];
		$hor = $row1["HOR_CODIGO"];
	}
}

horario($hor, $paralelo, $nivel, $conn);

function horario($horar, $paralelo, $nivel, $conn){

	$cont = 1;
	$cadena = '<table class="tabla-horario">
					<thead class="hor-mostrar">
						<tr>
							<th width="5%">N°</th>
							<th>Materia</th>
							<th>Docente</th>
							<th>Dia</th>
							<th>Hora</th>
							<th align="center">Operaciones</th>
						</tr>
					</thead>
					<tbody>';

	$query="Select * From horarios_materias o, horarios h, dias d, materias m, paralelo p, docente c Where o.HOR_CODIGO = h.HOR_CODIGO and o.DIA_CODIGO = D.DIA_CODIGO and o.MAT_CODIGO = m.MAT_CODIGO and p.HOR_CODIGO = h.HOR_CODIGO and p.HOR_CODIGO = '$horar' and h.HOR_ESTADO = 1 and o.HMA_ESTADO = 1 and c.DOC_CODIGO = m.DOC_CODIGO and c.DOC_ESTADO = 1 and o.HMA_ESTADO = 1";
	$resultado = mysqli_query($conn,$query);
	while ( $row = mysqli_fetch_array( $resultado ) ) {
		if($row['HMA_ESTADO']=='1'){$estado = 'title="Eliminar" class="tabla-registro-elim btn-eliminar-a"><i class="fas fa-trash"></i>';}
		else {$estado = 'title="Activar" class="btn-eliminar-i"><i class="fas fa-trash-restore"></i>';}

		$cadena.='<tr><td width="5%">'.$cont.'</td>
					<td>'.$row['MAT_NOMBRE'].'</td>
					<td>'.$row['DOC_NOMBRE'].' '.$row['DOC_APELLIDO'].'</td>
					<td>'.$row['DIA_NOMBRE'].'</td>
					<td>'.$row['HMA_HORAINICIO'].' - '.$row['HMA_HORAFIN'].'</td>
					<td align="center"><a href="editar_horario_recibe.php?u='.$row[ "HMA_CODIGO" ].'&h='.$row["HOR_CODIGO"].'&p='.$paralelo.'&n='.$nivel.'" title="Editar" class="btn-editar"><i class="fas fa-edit"></i></a>
						<a href="eliminar_horario-materia.php?u='.$row[ "HMA_CODIGO" ].'" title="Eliminar" class="tabla-registro-elim btn-eliminar-a" onClick="confirmacion()"><i class="fas fa-trash"></i></a></td></tr>';
		$cont++;
	}

	if($resultado){
		echo $cadena;
	}else{
		echo "<script>alert('Error ".$cont."');</script>";
	}

}
?>