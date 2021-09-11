<?php 
$conn = new mysqli("localhost", "admin", "admin", "horarios");
if ($conn ->connect_error) {
	die("Connection failed: " . $conn ->connect_error);
}
$paralelo=$_POST['paralelo'];
	
	$hor;
	$sql="Select * From horarios h, paralelo p, supervisor s Where h.HOR_CODIGO = p.HOR_CODIGO AND h.SUP_CODIGO = s.SUP_CODIGO AND p.AUL_CODIGO = ".$paralelo." and h.HOR_ESTADO = 1";
	$result1=mysqli_query($conn,$sql);
	while($row1=mysqli_fetch_array($result1)){
		if($row1["AUL_CODIGO"] == $paralelo){
			$nivel = $row1["NIV_CODIGO"];
			$hor = $row1["HOR_CODIGO"];
		}
	}

	switch($nivel){
		case '7':
			horarioInicial($hor, $conn);
			//llenarInicial();
			break;
		case '1':
		case '2':
		case '3':
			horario($hor, $conn);
			//llenarBasica_BGU();
			break;
		case '4':
		case '5':
		case '6':
			horario($hor, $conn);
			//llenarBasica_BGU();
			break;
		case '';
			sinDatos();
			break;
	}

	function horario($horar, $conn){
				
		//Traemos los arreglos para las respectivas clases
		include("areas_assets.php");
		
		$query="Select * From horarios h, paralelo p, supervisor s Where h.HOR_CODIGO = p.HOR_CODIGO AND h.SUP_CODIGO = s.SUP_CODIGO AND h.HOR_CODIGO = '$horar'";
		$resultado = mysqli_query($conn,$query);
		while ($dat = mysqli_fetch_array( $resultado ) ) {
			$supervisor = $dat['SUP_NOMBRE'].' '.$dat['SUP_APELLIDO'];
			$alectivo = $dat['HOR_ALECTIVO'];
			$paralelo = $dat['AUL_CURSO'].' "'.$dat['AUL_NOMBRE'].'"';
		}
		
		$cont = 1;
		$cadena = '<div class="opciones-desc2"><span>Curso: '.$paralelo.'</span><span> Año lectivo: '.$alectivo.'</span> <span>Horario creado por: '.$supervisor.'</span></div>
					<div class="cont-tabla">
					<table  class="tabla-horario">
						<thead class="hor-mostrar">
							<tr>
								<th>Hora</th>
								<th>Lunes</th>
								<th>Martes</th>
								<th>Miercoles</th>
								<th>Jueves</th>
								<th>Viernes</th>
							</tr>
						</thead>
						<tbody>';
		$horaInicial="07:15";
		$minutoAnadir=40;
		$minutoReceso=20;
		$ver = 9;
		$cont2 = 5;
		while ($ver!=0) {
			if($ver == 3 || $ver == 6){
				$nuevaHora = sumarHora($horaInicial,$minutoReceso);
				$cadena=$cadena.'<tr><td>'.$horaInicial.' A '.$nuevaHora.'</td><td colspan="5" class="colspan">RECESO</td></tr>';
				$horaInicial = $nuevaHora;
			} else {
				$cont2 = 1;
				$cadena=$cadena.'<tr>';
				$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
				$cadena=$cadena.'<td>'.$horaInicial.' A '.$nuevaHora.'</td>';
				
				while($cont2 != 6){
					$cadena=$cadena.'<td class="dropzone" idhoraIni="'.$horaInicial.'" idhoraFin="'.$nuevaHora.'" iddia="'.$cont2.'" idhorario="5" >';	
					
					$query="Select * From horarios_materias o, horarios h, dias d, materias m, paralelo p, docente c Where o.HOR_CODIGO = h.HOR_CODIGO and o.DIA_CODIGO = D.DIA_CODIGO and o.MAT_CODIGO = m.MAT_CODIGO and p.HOR_CODIGO = h.HOR_CODIGO and p.HOR_CODIGO = '$horar' and h.HOR_ESTADO = 1 and o.HMA_ESTADO = 1 and c.DOC_CODIGO = m.DOC_CODIGO and c.DOC_ESTADO = 1";
					$resultado = mysqli_query($conn,$query);
					while ( $row = mysqli_fetch_array( $resultado ) ) {
						//Comparamos los datos obtenidos con los arreglos y obtenemos el tipo y el icono respectivo
						$tipo = array_search(mb_strtoupper($row['MAT_AREA']), $a);
						$icon =  array_search($tipo, $b);

						if($tipo == ""){ $tipo = "nah";}
						if($icon == ""){ $icon = "fas fa-question";}
						
						if($row["HMA_HORAINICIO"] == $horaInicial+":00" && $row["HMA_HORAFIN"] == $nuevaHora+":00" && $row["DIA_CODIGO"] == $cont2){
							$cadena=$cadena.'<div class="cont-elem-drop '.$tipo.'">
										<div class="elem-icono"><i class="'.$icon.' fa-2x"></i></div>
										<div class="elem-box">
											<div class="box-docen">'.$row["MAT_NOMBRE"].'</div>
											<div class="box-info">'.$row["DOC_NOMBRE"].' '.$row["DOC_APELLIDO"].'</div>
										</div>
									</div>';
						}
					}
					$cadena.='</td>';
					$cont2++;
				}
				$cadena=$cadena.'</tr>';
				$horaInicial = $nuevaHora;
			}
			$ver--;
		}
	
		if($resultado){
			$cadena .= '</tbody></table>';
			echo $cadena;
		}else{
			echo "<tr><td>Nada</td><td>Nada</td><td>Nada</td><td>Nada</td><td>Nada</td><td>Nada</td></tr><script>alert('Error ".$cont."');</script>";
		}
		
	}

	function horarioInicial($horar, $conn){
				
		//Traemos los arreglos para las respectivas clases
		include("areas_assets.php");
		
		$query="Select * From horarios h, paralelo p, supervisor s Where h.HOR_CODIGO = p.HOR_CODIGO AND h.SUP_CODIGO = s.SUP_CODIGO AND h.HOR_CODIGO = '$horar'";
		$resultado = mysqli_query($conn,$query);
		while ($dat = mysqli_fetch_array( $resultado ) ) {
			$supervisor = $dat['SUP_NOMBRE'].' '.$dat['SUP_APELLIDO'];
			$alectivo = $dat['HOR_ALECTIVO'];
			$paralelo = $dat['AUL_CURSO'].' "'.$dat['AUL_NOMBRE'].'"';
		}
		
		$cont = 1;
		
		$cadena = '<div class="opciones-desc"><span>Curso: '.$paralelo.'</span><span> Año lectivo: '.$alectivo.'</span> <span>Horario creado por: '.$supervisor.'</span></div>
					<table  class="tabla-horario">
						<thead class="hor-mostrar">
							<tr>
								<th>Hora</th>
								<th>Lunes</th>
								<th>Martes</th>
								<th>Miercoles</th>
								<th>Jueves</th>
								<th>Viernes</th>
							</tr>
						</thead>
						<tbody>';
		
		$horaInicial="07:15";
		$minutoAnadir=15;
		$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
		$ver = 3;
		$cont2 = 5;
		while ($ver!=0) {
			$cont2 = 1;
			$cadena=$cadena.'<tr>';
			$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
			$cadena=$cadena.'<td>'.$horaInicial.' A '.$nuevaHora.'</td>';

			while($cont2 != 6){
				$cadena=$cadena.'<td class="dropzone" idhoraIni="'.$horaInicial.'" idhoraFin="'.$nuevaHora.'" iddia="'.$cont2.'" idhorario="5" >';	

				$query="Select * From horarios_materias o, horarios h, dias d, materias m, paralelo p, docente c Where o.HOR_CODIGO = h.HOR_CODIGO and o.DIA_CODIGO = D.DIA_CODIGO and o.MAT_CODIGO = m.MAT_CODIGO and p.HOR_CODIGO = h.HOR_CODIGO and p.HOR_CODIGO = '$horar' and h.HOR_ESTADO = 1 and o.HMA_ESTADO = 1 and c.DOC_CODIGO = m.DOC_CODIGO and c.DOC_ESTADO = 1";
				$resultado = mysqli_query($conn,$query);
				while ( $row = mysqli_fetch_array( $resultado ) ) {
					//Comparamos los datos obtenidos con los arreglos y obtenemos el tipo y el icono respectivo
					$tipo = array_search(mb_strtoupper($row['MAT_AREA']), $a);
					$icon =  array_search($tipo, $b);

					if($tipo == ""){ $tipo = "nah";}
					if($icon == ""){ $icon = "fas fa-question";}

					if($row["HMA_HORAINICIO"] == $horaInicial+":00" && $row["HMA_HORAFIN"] == $nuevaHora+":00" && $row["DIA_CODIGO"] == $cont2){
						$cadena=$cadena.'<div class="cont-elem-drop '.$tipo.'">
									<div class="elem-icono"><i class="'.$icon.' fa-2x"></i></div>
									<div class="elem-box">
										<div class="box-docen">'.$row["MAT_NOMBRE"].'</div>
										<div class="box-info">'.$row["DOC_NOMBRE"].' '.$row["DOC_APELLIDO"].'</div>
									</div>
								</div>';
					}
				}
				$cadena.='</td>';
				$cont2++;
			}
			$cadena=$cadena.'</tr>';
			$horaInicial = $nuevaHora;
			$minutoAnadir = 270;
			if($ver == 2){$minutoAnadir = 35;}
			$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
			$ver--;
		}
	
		if($resultado){
			echo $cadena;
		}else{
			echo "<tr><td>Nada</td><td>Nada</td><td>Nada</td><td>Nada</td><td>Nada</td><td>Nada</td></tr><script>alert('Error ".$cont."');</script>";
		}
		
	}

	function sinDatos(){
		$cadena = '<div class="opciones-desc2"><label>Lamentablemente tu curso aun no cuenta con un horario.</label></div>';
		echo $cadena;
	}
		
	function llenarInicial(){
		$horaInicial="07:15";
		$minutoAnadir=15;
		$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
		$ver = 3;
		$cadena="";
		while ($ver!=0) {
			$cadena=$cadena.'<tr><td>'.$horaInicial.' A '.$nuevaHora.'</td><td></td><td></td><td></td><td></td><td></td></tr>';
			$horaInicial = $nuevaHora;
			$minutoAnadir = 270;
			if($ver == 2){$minutoAnadir = 35;}
			$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
			$ver--;
		}
		echo  $cadena;
	}

	function llenarBasica_BGU(){
		$horaInicial="07:15";
		$minutoAnadir=40;
		$minutoReceso=20;
		$ver = 9;
		$cadena="";
		while ($ver!=0) {
			if($ver == 3 || $ver == 6){
				$nuevaHora = sumarHora($horaInicial,$minutoReceso);
				$cadena=$cadena.'<tr><td>'.$horaInicial.' A '.$nuevaHora.'</td><td colspan="5" class="colspan">RECESO</td></tr>';
				$horaInicial = $nuevaHora;
			} else {
				$nuevaHora = sumarHora($horaInicial,$minutoAnadir);
				$cadena=$cadena.'<tr><td>'.$horaInicial.' A '.$nuevaHora.'</td>
				<td class="dropzone" idhoraIni="'.$horaInicial.'" idhoraFin="'.$nuevaHora.'" iddia="1" idhorario="5" ><a style="margin-left:4px;" href="javascript:void(0)" ></a></td>
				<td class="dropzone" idhoraIni="'.$horaInicial.'" idhoraFin="'.$nuevaHora.'" iddia="2" idhorario="5" ><a style="margin-left:4px;" href="javascript:void(0)" ></a></td>
				<td class="dropzone" idhoraIni="'.$horaInicial.'" idhoraFin="'.$nuevaHora.'" iddia="3" idhorario="5" ><a style="margin-left:4px;" href="javascript:void(0)" ></a></td>
				<td class="dropzone" idhoraIni="'.$horaInicial.'" idhoraFin="'.$nuevaHora.'" iddia="4" idhorario="5" ><a style="margin-left:4px;" href="javascript:void(0)" ></a></td>
				<td class="dropzone" idhoraIni="'.$horaInicial.'" idhoraFin="'.$nuevaHora.'" iddia="5" idhorario="5" > <a style="margin-left:4px;" href="javascript:void(0)" ></a></td></tr>';
				
				$horaInicial = $nuevaHora;
			}
			$ver--;
		}
		echo  $cadena;
	}
		
	function sumarHora($horaInicial,$minutoAnadir){
		$segundos_horaInicial=strtotime($horaInicial);
		$segundos_minutoAnadir=$minutoAnadir*60;
		$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
		return $nuevaHora;
	}
	
	

?>